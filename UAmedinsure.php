<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'UAmedinsure.php';

require ('hysInit.php');

require ('hysDBinit.php');

//--------------------------------------------------------------------------------------------------
// initialize pass back values
//--------------------------------------------------------------------------------------------------
$DisplayErr = "N";

//--------------------------------------------------------------------------------------------------
// Ok - fun, fun fun (untill daddy takes the t-bird away) - But I digress...
//
// First we see if we are new or update.  Then we update or add ClientPayorTBL  
// We find out what type (dental or medical) we are via hidden fields passed to us in post
//--------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------------
// create the SQL statement to get our insurance information.  
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT * from ClientPayorTBL 
			where (MEDPAL = '$Medpal' and TypeID = '$_POST[typeid]')";
		
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query join for ClientPayorTBL (321) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "Location: if_UAmedinsure.php";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------
// Now lets see if twe are an add or update.
//----------------------------------------------------------------------------------------------------------
$countRows = mysql_num_rows($sql_result);
if ($countRows > 0)
{
	//--------------------------------------------------------------------------------------------------
	// We are update
	//--------------------------------------------------------------------------------------------------
	$result_array = mysql_fetch_assoc($sql_result);
	
	//--------------------------------------------------------------------------------------------------
	// Update the FullNameTBL
	//--------------------------------------------------------------------------------------------------
	$sql = "UPDATE FullNameTBL 
				set Prefix =  '$_POST[prefix]', FirstName = '$_POST[firstname]', MI = '$_POST[mi]', 
				LastName = '$_POST[lastname]', Suffix = '$_POST[suffix]'
					where (FullNameTBL.ID = '$result_array[PrimaryInsuredID]')";
								
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query update FullNameTBL (77) PrimaryInsuredID = '$result_array[PrimaryInsuredID]'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "Location: if_UAmedinsure.php";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}

	//------------------------------------------------------------------------------------------------------
	// We update ClientPayorTBL 
	//------------------------------------------------------------------------------------------------------
	$sql = "UPDATE ClientPayorTBL 
				set PayorID = '$_POST[payorname]', GroupID = '$_POST[groupid]', SubscriberID = '$_POST[subscriber]', 
				PrimaryProviderID = '$_POST[provider]', 
				OfficeCoPay = '$_POST[copay]'
					where (MEDPAL = '$Medpal' and TypeID = '$_POST[typeid]')";
								
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query update ClientPayorTBL (695) - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "Location: if_UAmedinsure.php";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	
	//--------------------------------------------------------------------------------------------------
	// update display variables
	//--------------------------------------------------------------------------------------------------
	if ($_POST[typeid] == 1)
	{
		//----------------------------------------------------------------------------------------------------------
		// Write to Access Log Table
		//----------------------------------------------------------------------------------------------------------
		AccessLogAdd("Medical Insurance Information update.", "Ok", $module, "", $conn);
		
		$DisplayMsg = "Medical Insurance Information update successfull!";	
	}
	else
	{
		//----------------------------------------------------------------------------------------------------------
		// Write to Access Log Table
		//----------------------------------------------------------------------------------------------------------
		AccessLogAdd("Dental Insurance Information update.", "Ok", $module, "", $conn);
		
		$DisplayMsg = "Dental Insurance Information update successfull!";	
	}

	//------------------------------------------------------------------------------------------------------
	// Update is finished
	//------------------------------------------------------------------------------------------------------
}
else
{
	//--------------------------------------------------------------------------------------------------
	// Add a FullName
	//--------------------------------------------------------------------------------------------------
	
	//--------------------------------------------------------------------------------------------------
	// Now it is time to insert FullNameTBL entry.  After successfull insert we must get auto increment id
	// to add to PharmacyTBL.  We only add what is given.  The rest will default.
	//--------------------------------------------------------------------------------------------------
	$sql = "INSERT INTO FullNameTBL 
				(Prefix, FirstName, MI, LastName, Suffix)  
				VALUES ('$_POST[prefix]', '$_POST[firstname]',
				'$_POST[mi]', '$_POST[lastname]', '$_POST[suffix]')";
				
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query insert FullNameTBL (695)";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "Location: if_UAmedinsure.php";
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
		$location = "Location: if_UAmedinsure.php";
		$shortmsg = "Unable to save Name information.";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	
	//--------------------------------------------------------------------------------------------------
	// get FullNameTBL id for PharmacyTBL
	//--------------------------------------------------------------------------------------------------
	$NewFullNameID =  mysql_insert_id ($conn);
	if ($NewFullNameID == 0)
	{
		// error
		$errmsg = "Could not get unique FullName ID. Please try again.";
		$location = "Location: if_UAmedinsure.php";
		$shortmsg = "Unable to save Name information.";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	

	//------------------------------------------------------------------------------------------------------
	// We Add to ClientPayorTBL 
	//------------------------------------------------------------------------------------------------------
	$sql = "INSERT INTO ClientPayorTBL 
				(MEDPAL, TypeID, PayorID, GroupID, SubscriberID, PrimaryInsuredID, PrimaryProviderID, OfficeCoPay)
				VALUES ('$Medpal', '$_POST[typeid]', '$_POST[payorname]', '$_POST[groupid]', '$_POST[subscriber]', 
				'$NewFullNameID', '$_POST[provider]', '$_POST[copay]')";
								
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query insert ClientPayorTBL (695) - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "Location: if_UAmedinsure.php";
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
		$errmsg = "Unable to add Primary Insured Information. Insert Failed.";
		$location = "Location: if_UAmedinsure.php";
		$shortmsg = "Unable to save Insured  information.";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	
	//--------------------------------------------------------------------------------------------------
	// update display variables
	//--------------------------------------------------------------------------------------------------
	if ($_POST[typeid] == 1)
	{
		//----------------------------------------------------------------------------------------------------------
		// Write to Access Log Table
		//----------------------------------------------------------------------------------------------------------
		AccessLogAdd("Medical Insurance Information Added.", "Ok", $module, "", $conn);
		
		$DisplayMsg = "Medical Insurance Information Addition successfull!";	
	}
	else
	{
		//----------------------------------------------------------------------------------------------------------
		// Write to Access Log Table
		//----------------------------------------------------------------------------------------------------------
		AccessLogAdd("Dental Insurance Information Added.", "Ok", $module, "", $conn);
		
		$DisplayMsg = "Dental Insurance Information Addition successfull!";	
	}
	
	//------------------------------------------------------------------------------------------------------
	// Add is finished
	//------------------------------------------------------------------------------------------------------
} // End of Else	

//--------------------------------------------------------------------------------------------------		
// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_UAmedinsure.php?msgTxt=$DisplayMsg&err=$DisplayErr");

?>
