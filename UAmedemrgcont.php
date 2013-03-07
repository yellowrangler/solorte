<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'UAmedemrgcont.php';

require ('hysInit.php');

require ('hysDBinit.php');

//--------------------------------------------------------------------------------------------------
// initialize pass back values
//--------------------------------------------------------------------------------------------------
$DisplayErr = "";

//--------------------------------------------------------------------------------------------------
// First we see if we are new or update.   
//--------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------------
// create the SQL statement 
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT AddrID, FullNameID
	from ClientEmergContactsTBL 
	left join FullNameTBL  on ClientEmergContactsTBL.FullNameID = FullNameTBL.ID
	left join AddrTBL  on ClientEmergContactsTBL.AddrID = AddrTBL.ID
		where (ClientEmergContactsTBL.MEDPAL = '$Medpal' and ClientEmergContactsTBL.ID = '$_POST[emrgtype]')";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query join for ClientEmergContactsTBL (321) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "Location: if_UAmedemrgcont.php";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}
	
//----------------------------------------------------------------------------------------------------------
// Now lets see if twe are an add or update.
//----------------------------------------------------------------------------------------------------------
$countRows = mysql_num_rows($sql_result);
if ($countRows > 0)
{
	//------------------------------------------------------------------------------------------------------
	// We update 
	//------------------------------------------------------------------------------------------------------
	$result_array = mysql_fetch_assoc($sql_result);
	
	//--------------------------------------------------------------------------------------------------
	// Update AddrTBL entry.  We only update what is given. 
	//--------------------------------------------------------------------------------------------------
	$sql = "UPDATE AddrTBL 
		set OrderID = '1', AddrLine1 = '$_POST[addr1]', AddrLine2 = '$_POST[addr2]',
		City = '$_POST[city]', State = '$_POST[state]', ZIP = '$_POST[zip]', PhoneNbr = '$_POST[phonenbr]'
		where AddrTBL.ID = '$result_array[AddrID]'";
								
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query update AddrTBL (77) - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "Location: if_UAmedemrgcont.php";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}

	//--------------------------------------------------------------------------------------------------
	// Update the FullNameTBL
	//--------------------------------------------------------------------------------------------------
	$sql = "UPDATE FullNameTBL 
				set Prefix =  '$_POST[prefix]', FirstName = '$_POST[firstname]', MI = '$_POST[mi]', 
				LastName = '$_POST[lastname]', Suffix = '$_POST[suffix]', MobilePhone = '$_POST[mobilenbr]'
				where (FullNameTBL.ID = '$result_array[FullNameID]')";
								
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query update FullNameTBL (77) - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "Location: if_UAmedemrgcont.php";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	
		//--------------------------------------------------------------------------------------------------
	// Second create ClientAddrTBL insert.  We only add what is given.  The rest will default.
	//--------------------------------------------------------------------------------------------------
	$sql = "UPDATE ClientEmergContactsTBL 
				set RelationsID = '$_POST[relationship]'
				where (ClientEmergContactsTBL.MEDPAL = '$Medpal' and ClientEmergContactsTBL.ID = '$_POST[emrgtype]')";

	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query update ClientEmergContactsTBL (777) - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "Location: if_UAmedemrgcont.php";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	
	//--------------------------------------------------------------------------------------------------
	// update display variables
	//--------------------------------------------------------------------------------------------------
	if ($_POST[emrgtype] == 1)
	{
		//----------------------------------------------------------------------------------------------------------
		// Write to Access Log Table
		//----------------------------------------------------------------------------------------------------------
		AccessLogAdd("Primary Emergency Medical Contact Information update", "Ok", $module, "", $conn);
		
		$DisplayMsg = "Primary Emergency Medical Contact Information update successfull!";	
	}
	else
	{
		//----------------------------------------------------------------------------------------------------------
		// Write to Access Log Table
		//----------------------------------------------------------------------------------------------------------
		AccessLogAdd("Secondary Emergency Medical Contact Information update", "Ok", $module, "", $conn);
		
		$DisplayMsg = "Secondary Emergency Medical Contact Information update successfull!";	
	}

	//------------------------------------------------------------------------------------------------------
	// Update is finished
	//------------------------------------------------------------------------------------------------------
}
else
{
	//------------------------------------------------------------------------------------------------------
	// We Add 
	//------------------------------------------------------------------------------------------------------
	
	//--------------------------------------------------------------------------------------------------
	// Add a Address
	//--------------------------------------------------------------------------------------------------
	$sql = "INSERT INTO AddrTBL 
				(OrderID,  AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr)  
				VALUES ('1', '$_POST[addr1]', '$_POST[addr2]',
				'$_POST[city]', '$_POST[state]', '$_POST[zip]', '$_POST[phonenbr]')";
				
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query insert AddrTBL (695) - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "Location: if_UAmedemrgcont.php";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	
	//--------------------------------------------------------------------------------------------------
	// Now lets process the result set 
	//--------------------------------------------------------------------------------------------------
	$affRows = mysql_affected_rows($conn);
	if ($affRows != 1)
	{
		// error
		$errmsg = "Unable to save Address information. Please try again. Insert Failed.";
		$location = "Location: if_UAmedemrgcont.php";
		$shortmsg = "Unable to save Address.";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	
	//--------------------------------------------------------------------------------------------------
	// get AddrTBL id later insert
	//--------------------------------------------------------------------------------------------------
	$NewAddrID =  mysql_insert_id ($conn);
	if ($NewAddrID == 0)
	{
		// error
		$errmsg = "Could not get unique Address ID. Please try again.";
		$location = "Location: if_UAmedemrgcont.php";
		$shortmsg = "Unable to save Address.";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
	
	//--------------------------------------------------------------------------------------------------
	// Add a Full Name
	//--------------------------------------------------------------------------------------------------
	$sql = "INSERT INTO FullNameTBL 
				(Prefix,  FirstName, MI, LastName, Suffix, MobilePhone)  
				VALUES ('$_POST[prefix]', '$_POST[firstname]', '$_POST[mi]',
				'$_POST[lastname]', '$_POST[suffix]', '$_POST[mobilenbr]')";
				
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query insert FullNameTBL (695) - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "Location: if_UAmedemrgcont.php";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}

	//--------------------------------------------------------------------------------------------------
	// Now lets process the result set 
	//--------------------------------------------------------------------------------------------------
	$affRows = mysql_affected_rows($conn);
	if ($affRows != 1)
	{
		// error
		$errmsg = "Unable to save Name information. Please try again. Insert Failed.";
		$location = "Location: if_UAmedemrgcont.php";
		$shortmsg = "Unable to save Name.";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	
	//--------------------------------------------------------------------------------------------------
	// get AddrTBL id later insert
	//--------------------------------------------------------------------------------------------------
	$NewFullNameID =  mysql_insert_id ($conn);
	if ($NewFullNameID == 0)
	{
		// error
		$errmsg = "Could not get unique Full Name ID. Please try again.";
		$location = "Location: if_UAmedemrgcont.php";
		$shortmsg = "Unable to save Name.";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
	
	//--------------------------------------------------------------------------------------------------
	// Second create ClientAddrTBL insert.  We only add what is given.  The rest will default.
	//--------------------------------------------------------------------------------------------------
	$sql = "INSERT INTO ClientEmergContactsTBL 
				(MEDPAL, OrderID, FullNameID, AddrID, RelationsID) 
				VALUES ('$Medpal', '$_POST[emrgtype]', '$NewFullNameID', '$NewAddrID', '$_POST[relationship]')";

	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query insert ClientEmergContactsTBL (695) - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "Location: if_UAmedemrgcont.php";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	
	//--------------------------------------------------------------------------------------------------
	// Now lets process the result set 
	//--------------------------------------------------------------------------------------------------
	$affRows = mysql_affected_rows($conn);
	if ($affRows != 1)
	{
		// error
		$errmsg = "Unable to insert Emergency Contact information.  Please try again. Insert failed.";
		$location = "Location: if_UAmedemrgcont.php";
		$shortmsg = "Unable to save Contact Infortmation.";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	
	//--------------------------------------------------------------------------------------------------
	// update display variables
	//--------------------------------------------------------------------------------------------------
	if ($_POST[emrgtype] == 1)
	{
		//----------------------------------------------------------------------------------------------------------
		// Write to Access Log Table
		//----------------------------------------------------------------------------------------------------------
		AccessLogAdd("Primary Emergency Medical Contact Information Added", "Ok", $module, "", $conn);
		
		$DisplayMsg = "Primary Emergency Medical Contact Information Addition successfull!";	
	}
	else
	{
		//----------------------------------------------------------------------------------------------------------
		// Write to Access Log Table
		//----------------------------------------------------------------------------------------------------------
		AccessLogAdd("Secondary Emergency Medical Contact Information Added", "Ok", $module, "", $conn);
		
		$DisplayMsg = "Secondary Emergency Medical Contact Information Addition successfull!";	
	}
	
	//------------------------------------------------------------------------------------------------------
	// Add is finished
	//------------------------------------------------------------------------------------------------------
} // End of Else	

//--------------------------------------------------------------------------------------------------		
// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_UAmedemrgcont.php?msgTxt=$DisplayMsg");

?>
