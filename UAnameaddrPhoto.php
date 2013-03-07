<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'UAnameaddrPhoto.php';

require ('hysInit.php');

require ('hysDBinit.php');

//----------------------------------------------------------------------------------------------------------
// OK! Now comes the fun part.  We need to upload the file to a temp dir.  Once it is sucessfully uploaded
// we must move it to a permanent directory.  Then we must add name to PhotoTBL - get the ID, add that 
// and description to ClientTBL.
//----------------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------------
// Lets set up some variable we will need.  These are fairly consistent.  We may want to create an ini
// file for each client or global one
//----------------------------------------------------------------------------------------------------------
$PhotoDirectory = "images";
$ClientPhotoDirectory = sprintf("%s/%06s", $PhotoDirectory, $Medpal);

//----------------------------------------------------------------------------------------------------------
// First we check to see if directory exists.  If it does not we will create it
//----------------------------------------------------------------------------------------------------------
if (!is_dir($ClientPhotoDirectory))
{
	if (!mkdir($ClientPhotoDirectory, 0777))
	{		
		$errmsg = "Error - Unable to create client directory.  Please try again.";
		$location = "Location: if_UAnameaddrPhoto.php";
		$shortmsg = "Unable create direcrtory.";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
}

//----------------------------------------------------------------------------------------------------------
// Now we loop through files passed to us - This is standard code.  We will only have one file
//----------------------------------------------------------------------------------------------------------
foreach($_FILES as $file_name => $file_array)
{	
	//------------------------------------------------------------------------------------------------------		
	// We check to see if file was uploaded
	//------------------------------------------------------------------------------------------------------
	if (is_uploaded_file($file_array['tmp_name']))
	{
		//--------------------------------------------------------------------------------------------------
		// Now we try to move the file to our clients diretcory
		//--------------------------------------------------------------------------------------------------
		if (!move_uploaded_file($file_array['tmp_name'], "$ClientPhotoDirectory/$file_array[name]"))
		{
			$errmsg = "Error - Unable to move file".$file_array[name]." to client directory.  Please try again.";
			$location = "Location: if_UAnameaddrPhoto.php";
			$shortmsg = "Unable to move file.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
	}	
	else
	{
		$errmsg = "Error - Unable to upload file".$file_array[name]." Please try again";
		$location = "Location: if_UAnameaddrPhoto.php";
		$shortmsg = "Unable to upload file.";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);	
	}	
	
	//------------------------------------------------------------------------------------------------------
	// The file is now in the proper diretory.  Time to update our tables.  First the PhotoTBL
	//------------------------------------------------------------------------------------------------------
	$ClientFullDirFile = $ClientPhotoDirectory."/".$file_array[name];
	
	//------------------------------------------------------------------------------------------------------
	// This may be changed later but for now I want this file updateable
	//------------------------------------------------------------------------------------------------------	
	chmod($ClientFullDirFile, 0777);  
	
	//--------------------------------------------------------------------------------------------------
	// first detremine if update or add to PhotoTBL. If update just update photo tbl.  If add insert to 
	// PhotoTBL and update ClientTBL 
	//--------------------------------------------------------------------------------------------------
	$sql = "SELECT PhotoTBL.ID as PhID 
		from PhotoTBL
		inner join  ClientTBL on ClientTBL.PhotoID = PhotoTBL.ID 
			where ClientTBL.MEDPAL = '$Medpal'";
	
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query for Select on ClientTBL (695) - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "Location: if_UAnameaddrPhoto.php";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	
	//----------------------------------------------------------------------------------------------------------	
	// Now lets first see if there is something there
	//----------------------------------------------------------------------------------------------------------
	$countRows = mysql_num_rows($sql_result);
	
	if ($countRows != 0)
	{
		//----------------------------------------------------------------------------------------------------------
		// Get the Photo Data
		//----------------------------------------------------------------------------------------------------------
		$result_array = mysql_fetch_assoc($sql_result);
		
		//------------------------------------------------------------------------------------------------------
		// Update PhotoTBL only
		//------------------------------------------------------------------------------------------------------
		$sql = "UPDATE PhotoTBL 
				set URL = '$ClientFullDirFile'
				where PhotoTBL.ID = '$result_array[PhID]'";
					
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query update PhotoTBL (111) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAnameaddrPhoto.php";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//----------------------------------------------------------------------------------------------------------
		// Write to Access Log Table
		//----------------------------------------------------------------------------------------------------------
		AccessLogAdd("Client Photo Information update.", "Ok", $module, "", $conn);
	}
	else
	{
		//------------------------------------------------------------------------------------------------------
		// Insert to Photo Update ClientTBL
		//------------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO PhotoTBL 
					(URL)  
					VALUES ('$ClientFullDirFile')";
					
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert PhotoTBL (111) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAnameaddrPhoto.php";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// Now lets review the results  
		//--------------------------------------------------------------------------------------------------
		$affRows = mysql_affected_rows($conn);
		if ($affRows != 1)
		{
			// error
			$errmsg = "Unable to add Client Photo to DB. Please try again. Insert Failed.";
			$location = "Location: if_UAnameaddrPhoto.php";
			$shortmsg = "Unable to Add Photo.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// get PhotoTBL ID for ClientTBL
		//--------------------------------------------------------------------------------------------------
		$NewPhotoID =  mysql_insert_id ($conn);
		if ($NewPhotoID == 0)
		{
			// error
			$errmsg = "Could not get PhotoTBL ID. Please try again.";
			$location = "Location: if_UAnameaddrPhoto.php";
			$shortmsg = "Unable to Add Photo.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
	
		//------------------------------------------------------------------------------------------------------
		// Now update  our ClientTBL.  We will only update the PhotoID
		//------------------------------------------------------------------------------------------------------
		$sql = "UPDATE ClientTBL
				set PhotoID =  '$NewPhotoID' 
				where (ClientTBL.MEDPAL = '$Medpal')";
				
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query update ClientTBL (111) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAnameaddrPhoto.php";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// Now lets review the results  
		//--------------------------------------------------------------------------------------------------
		$affRows = mysql_affected_rows($conn);
		if ($affRows != 1)
		{
			// error
			$errmsg = "Unable to add Client Photo to ClientTBL. Please try again. Insert Failed.";
			$location = "Location: if_UAnameaddrPhoto.php";
			$shortmsg = "Unable to Add Photo.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//----------------------------------------------------------------------------------------------------------
		// Write to Access Log Table
		//----------------------------------------------------------------------------------------------------------
		AccessLogAdd("Client Photo Information Added.", "Ok", $module, "", $conn);

	}	// End of Else 
		
}  // End of Foreach

$DisplayMsg = "Client Photo successfully added.";
			
//--------------------------------------------------------------------------------------------------
// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_UAnameaddrPhoto.php?msgTxt=$DisplayMsg");

?>
