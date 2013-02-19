<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'RQupscan.php';

require ('hysInit.php');

require ('hysDBinit.php');

//
// VALIDATION
//

//----------------------------------------------------------------------------------------------------------
// We must have a valid eventid.  If not we bail
//----------------------------------------------------------------------------------------------------------
if (isset($_POST[eventid]))
{
	//----------------------------------------------------------------------------------------------------------
	// create the SQL statement to validate our event id
	//----------------------------------------------------------------------------------------------------------
	$sql = "SELECT *  from ClientEventTBL 
					where ( ClientEventTBL.MEDPAL = '$Medpal' and ClientEventTBL.ID = '$_POST[eventid]')";
					
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query for ClientEventTBL\n sql = '$sql'\n (195) - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "Location: if_RQuprequestdetail.php?eventid=$_POST[eventid]";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
		
	//----------------------------------------------------------------------------------------------------------	
	// Now lets first see if there is anything to run through.  If more or less then 1 we have an error
	//----------------------------------------------------------------------------------------------------------
	$countRows = mysql_num_rows($sql_result);
	if ($countRows != 1)
	{
		$errmsg = " Error We were not passed in an EventID. EventID = '$_POST[eventid]' (445) - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "Location: if_RQuprequestdetail.php?eventid=$_POST[eventid]";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
	
}	// End of IF Update
else
{
	$sqlerr = mysql_error();
	$errmsg = "Error - We were not passed in an EventID \n EventID = '$_POST[eventid]'\n (444) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "Location: if_RQuprequestdetail.php?eventid=$_POST[eventid]";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------
// OK! Now comes the fun part.  We need to upload the file to a temp dir.  Once it is sucessfully uploaded
// we must move it to a permanent directory.  Then we must add name to ScanTBL - get the ID, add that 
// and description to EventScanTBL - get that ID and add that to ClientEventTBL.  Not bad for an honest
// days work.
//----------------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------------
// Lets set up some variable we will need.  These are fairly consistent.  We may want to create an ini
// file for each client or global one
//----------------------------------------------------------------------------------------------------------
$EventID = $_POST[eventid];
$ScanDirectory = "scan";
$ClientScanDirectory = sprintf("%s/%06s", $ScanDirectory, $Medpal);

//----------------------------------------------------------------------------------------------------------
// First we check to see if directory exists.  If it does not we will create it
//----------------------------------------------------------------------------------------------------------
if (!is_dir($ClientScanDirectory))
{
	if (!mkdir($ClientScanDirectory, 0700))
	{		
		$errmsg = "Error - Unable to create client directory.  Please try again.";
		$location = "Location: if_RQuprequestdetail.php?eventid=$_POST[eventid]";
		$shortmsg = "Unable to create client directory.";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
}

//----------------------------------------------------------------------------------------------------------
// Now we loop through files passed to us
//----------------------------------------------------------------------------------------------------------
foreach($_FILES as $file_name => $file_array)
{
	$tmpDateTime = date("U");
	$tmpFileName = $tmpDateTime.$file_array[name]; 
	
	//------------------------------------------------------------------------------------------------------		
	// First we check to see if file already exists
	//------------------------------------------------------------------------------------------------------	
	if (is_file("$ClientScanDirectory/$file_array[name]"))
	{		
		$errmsg = "Error - ".$tmpFileName." already exists.  Please try again.";
		$location = "Location: if_RQuprequestdetail.php?eventid=$_POST[eventid]";
		$shortmsg = "$file_array[name] already exists.";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	
	//------------------------------------------------------------------------------------------------------		
	// Next we check to see if file was uploaded
	//------------------------------------------------------------------------------------------------------
	if (is_uploaded_file($file_array['tmp_name']))
	{	
		//--------------------------------------------------------------------------------------------------
		// Now we try to move the file to our clients diretcory
		//--------------------------------------------------------------------------------------------------
		if (!move_uploaded_file($file_array['tmp_name'], "$ClientScanDirectory/$tmpFileName"))
		{
			$errmsg = "Error - Unable to move file".$tmpFileName." to client directory.  Please try again.";
			$location = "Location: if_RQuprequestdetail.php?eventid=$_POST[eventid]";
			$shortmsg = "Unable to move file.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
	}	
	else
	{
		$errmsg = "Error - Unable to upload file".$tmpFileName." Please try again";
		$location = "Location: if_RQuprequestdetail.php?eventid=$_POST[eventid]";
		$shortmsg = "Unable to upload file $tmpFileName";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);	
	}	
	
	//------------------------------------------------------------------------------------------------------
	// The file is now in the proper diretory.  Time to update our tables.  First the ScanInfoTBL
	//------------------------------------------------------------------------------------------------------
	$ClientFullDirFile = $ClientScanDirectory."/".$tmpFileName;
	$sql = "INSERT INTO ScanInfoTBL 
				(URL)  
				VALUES ('$ClientFullDirFile')";
				
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query insert ScanInfoTBL (111) - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "Location: if_RQuprequestdetail.php?eventid=$_POST[eventid]";
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
		$errmsg = "Unable to add Scaned images to DB. Please try again. Insert Failed.";
		$location = "Location: if_RQuprequestdetail.php&eventid=";
		$shortmsg = "Unable to add Scaned images to DB.";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	
	//--------------------------------------------------------------------------------------------------
	// get calendar id for ScanInfoTBL
	//--------------------------------------------------------------------------------------------------
	$NewScanID =  mysql_insert_id ($conn);
	if ($NewScanID == 0)
	{
		// error
		$errmsg = "Could not get ScanInfo ID. Please try again.";
		$location = "Location: if_RQuprequestdetail.php&eventid=";
		$shortmsg = "Unable to add Scaned images to DB.";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	

	//------------------------------------------------------------------------------------------------------
	// Now insert into our EventScanTBL
	//------------------------------------------------------------------------------------------------------
	$sql = "INSERT INTO EventScanTBL 
				(ClientEventID, ScanID, EventScanInfo, ScanTypeID)  
				VALUES ('$EventID', '$NewScanID', '$_POST[desc]', '$_POST[scantype]')";
				
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query insert EventScanTBL (111) - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "Location: if_RQuprequestdetail.php?eventid=$_POST[eventid]";
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
		$errmsg = "Unable to add detail to EventScanDB. Please try again. Insert Failed.";
		$location = "Location: if_RQuprequestdetail.php&eventid=";
		$shortmsg = "Unable to add Scaned images to DB.";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	
	//--------------------------------------------------------------------------------------------------
	// Done like dinner.  Can I get a witness... Please!
	//--------------------------------------------------------------------------------------------------	
	
}  // End of Foreach

$DisplayID = $EventID;
$DisplayMsg = "Files successfully added.";
	
//--------------------------------------------------------------------------------------------------
// end of Add  and Update 
//--------------------------------------------------------------------------------------------------
		
//--------------------------------------------------------------------------------------------------
// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_RQuprequestdetail.php?msgTxt=$DisplayMsg&requestid=$_POST[requestid]");

?>
