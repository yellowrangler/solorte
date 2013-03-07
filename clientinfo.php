<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'clientinfo.php';

require ('hysInitAdmin.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

$DisplayClientType = 'M';

//----------------------------------------------------------------------------------------------------------
// What are we being asked to do?  Here we go to func based on action
//  But first we validate input
//----------------------------------------------------------------------------------------------------------

//------------------------------------------------------------------------------------------------------
// convert the date of birth for edit
//------------------------------------------------------------------------------------------------------
$tmpDate = explode("/", $_POST["dob"]);

//--------------------------------------------------------------------------------------------------
// validate date and time
//--------------------------------------------------------------------------------------------------
if (!ValiDate($tmpDate[0], $tmpDate[1], $tmpDate[2]) )
{
	// error
	$errmsg = "Invalid Date. Please try again.";
	$location = "Location: if_clientinfo.php?clientid=$_POST[clientid]";
	$shortmsg = "Invalid Date. Please try again.";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

//------------------------------------------------------------------------------------------------------
// convert the date of birth back to DB format
//------------------------------------------------------------------------------------------------------
$sqlDate = sprintf("%s-%02s-%02s",  $tmpDate[2], $tmpDate[0], $tmpDate[1]);


switch ($_POST[Action])
{
	case 'Add':
	
		$pwCheck = spookEStr($_POST[clientpassword]);
		
		//--------------------------------------------------------------------------------------------------
		// Add a Authentication info
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO AuthenticationTBL 
					(USERID,  Pword, TypeID)  
					VALUES ('$_POST[clientid]', '$pwCheck', '$DisplayClientType')";
					
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert AuthenticationTBL (695)";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clientinfo.php?clientid=$_POST[clientid]";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// Now lets process the result set 
		//--------------------------------------------------------------------------------------------------
		$affRows = mysql_affected_rows($conn);
		if ($affRows != 1)
		{
			// error
			$errmsg = "Unable to save Client Authentication information. Please try again. Insert Failed.";
			$location = "Location: if_clientinfo.php?clientid=$_POST[clientid]";
			$shortmsg = "Unable to save Client Authentication information. Please try again. Insert Failed.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// Add a Authorization info
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO AuthorizationTBL 
					(USERID, MEDPAL, Level)  
					VALUES ('$_POST[clientid]', '$_POST[clientid]', '1')";
					
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert AuthorizationTBL (695)";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clientinfo.php?clientid=$_POST[clientid]";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// Now lets process the result set 
		//--------------------------------------------------------------------------------------------------
		$affRows = mysql_affected_rows($conn);
		if ($affRows != 1)
		{
			// error
			$errmsg = "Unable to save Client Authorization information. Please try again. Insert Failed.";
			$location = "Location: if_clientinfo.php?clientid=$_POST[clientid]";
			$shortmsg = "Unable to save Client Authorization information. Please try again. Insert Failed.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// Add a FullName
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO FullNameTBL 
					(Prefix, FirstName, MI, LastName, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone)  
					VALUES ('$_POST[prefix]', '$_POST[firstname]', '$_POST[mi]', '$_POST[lastname]', '$_POST[suffix]', '$_POST[email]',
					'$_POST[pagerid]', '$_POST[pagerphonenbr]', '$_POST[mobilenbr]')";
					
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert FullNameTBL (695)";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clientinfo.php?clientid=$_POST[clientid]";
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
			$location = "Location: if_clientinfo.php?clientid=$_POST[clientid]";
			$shortmsg = "Unable to save Name information. Please try again. Insert Failed.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// get FullNameTBL id for ClientTBL
		//--------------------------------------------------------------------------------------------------
		$NewFullNameID =  mysql_insert_id ($conn);
		if ($NewFullNameID == 0)
		{
			// error
			$errmsg = "Could not get unique FullName ID. Please try again.";
			$location = "Location: if_clientinfo.php?clientid=$_POST[clientid]";
			$shortmsg = "Could not get unique FullName ID. Please try again.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
			
		//--------------------------------------------------------------------------------------------------
		// Add  to ClientTBL info
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO ClientTBL 
					(MEDPAL,  FullNameID, DOB)  
					VALUES ('$_POST[clientid]', '$NewFullNameID', '$sqlDate')";
					
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert ClientTBL (695)";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clientinfo.php?clientid=$_POST[clientid]";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// Now lets process the result set 
		//--------------------------------------------------------------------------------------------------
		$affRows = mysql_affected_rows($conn);
		if ($affRows != 1)
		{
			// error
			$errmsg = "Unable to save Client information. Please try again. Insert Failed.";
			$location = "Location: if_clientinfo.php?clientid=$_POST[clientid]";
			$shortmsg = "Unable to save Client information. Please try again. Insert Failed.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
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
			$errmsg = "$sqlerr - Error doing mysql_query insert AddrTBL (695)";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clientinfo.php?clientid=$_POST[clientid]";
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
			$location = "Location: if_clientinfo.php?clientid=$_POST[clientid]";
			$shortmsg = "Unable to save Address information. Please try again. Insert Failed.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// get AddrTBL id for ClientAddrTBL
		//--------------------------------------------------------------------------------------------------
		$NewAddrID =  mysql_insert_id ($conn);
		if ($NewAddrID == 0)
		{
			// error
			$errmsg = "Could not get unique Address ID. Please try again.";
			$location = "Location: if_clientinfo.php?clientid=$_POST[clientid]";
			$shortmsg = "Could not get unique Address ID. Please try again.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		
		//--------------------------------------------------------------------------------------------------
		// Second create ClientAddrTBL insert.  We only add what is given.  The rest will default.
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO ClientAddrTBL 
					(MEDPAL, AddrID)                    
					VALUES ('$_POST[clientid]', '$NewAddrID')";

		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert ClientAddrTBL (695)";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clientinfo.php?clientid=$_POST[clientid]";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// Now lets process the result set 
		//--------------------------------------------------------------------------------------------------
		$affRows = mysql_affected_rows($conn);
		if ($affRows != 1)
		{
			// error
			$errmsg = "Unable to insert Client information.  Please try again(2). Insert failed.";
			$location = "Location: if_clientinfo.php?clientid=$_POST[clientid]";
			$shortmsg = "Unable to insert Client information.  Please try again(2). Insert failed.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// set our display variables
		//--------------------------------------------------------------------------------------------------
		$Displayclientid = $_POST[clientid];
		$DisplayMsg = "Client Information Added successfully!";
		
		//--------------------------------------------------------------------------------------------------
		// end of Add 
		//--------------------------------------------------------------------------------------------------
		break;
		
	case 'Update':
	
		$pwCheck = spookEStr($_POST[clientpassword]);
		
		//--------------------------------------------------------------------------------------------------
		// Update Authentication info 
		//--------------------------------------------------------------------------------------------------
		$sql = "UPDATE AuthenticationTBL 
			set Pword = '$pwCheck'
			where AuthenticationTBL.USERID = '$_POST[clientid]' and 
			AuthenticationTBL.TypeID = '$DisplayClientType'";
									
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query update AuthenticationTBL (77) clientid = '$_POST[clientid]'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clientinfo.php?clientid=$_POST[clientid]";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// Get Full Name ID
		//--------------------------------------------------------------------------------------------------	
		$sql = "SELECT  FullNameID
			from ClientTBL 
			where (ClientTBL.MEDPAL = '$_POST[clientid]')"; 
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for ClientTBL (195) sql = '$sql'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clientinfo.php?clientid=$_POST[clientid]";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
			
		// Now lets first see if there is anything to run through.  If more then 1 we have an error
		$countRows = mysql_num_rows($sql_result);
		if ($countRows > 1)
		{
			$errmsg = " Error more then 1 rows returned in select on ClientTBL. count = '$countRows'  - clientid =  '$_POST[clientid]'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clientinfo.php?clientid=$_POST[clientid]";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
	
		//----------------------------------------------------------------------------------------------------------
		// Get the Client Data
		//----------------------------------------------------------------------------------------------------------
		$result_array = mysql_fetch_assoc($sql_result);
	
		//--------------------------------------------------------------------------------------------------
		// Update the FullNameTBL
		//--------------------------------------------------------------------------------------------------
		$sql = "UPDATE FullNameTBL 
					set Prefix =  '$_POST[prefix]', FirstName = '$_POST[firstname]', MI = '$_POST[mi]', 
					LastName = '$_POST[lastname]', Suffix = '$_POST[suffix]', eMailAddr = '$_POST[email]',
					PagerID ='$_POST[pagerid]', PagerTeleNbr ='$_POST[pagerphonenbr]', MobilePhone ='$_POST[mobilenbr]'
						where (FullNameTBL.ID = '$result_array[FullNameID]')";
									
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query update FullNameTBL (77) clientid = '$_POST[clientid]'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clientinfo.php?clientid=$_POST[clientid]";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}

		//--------------------------------------------------------------------------------------------------
		// Update ClientTBL entry.   
		//--------------------------------------------------------------------------------------------------
		$sql = "UPDATE ClientTBL 
			set DOB = '$sqlDate'
			where ClientTBL.MEDPAL = '$_POST[clientid]'";
									
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query update ClientTBL (77) clientid = '$_POST[clientid]'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clientinfo.php?clientid=$_POST[clientid]";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
	
		//--------------------------------------------------------------------------------------------------
		// Get AddrID 
		//--------------------------------------------------------------------------------------------------	
		$sql = "SELECT  AddrID, OrderID 
			from ClientAddrTBL 
			left join AddrTBL on ClientAddrTBL.AddrID = AddrTBL.ID
			where (ClientAddrTBL.MEDPAL = '$_POST[clientid]' and AddrTBL.OrderID = '1')"; 
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for ClientAddrTBL, AddrID (195) sql = '$sql'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clientinfo.php?clientid=$_POST[clientid]";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
	
		//----------------------------------------------------------------------------------------------------------
		// Get the Address Data
		//----------------------------------------------------------------------------------------------------------
		$result_array = mysql_fetch_assoc($sql_result);
		
		//--------------------------------------------------------------------------------------------------
		// Update AddrTBL entry.  We only update what is given. 
		//--------------------------------------------------------------------------------------------------
		$sql = "UPDATE AddrTBL 
			set AddrLine1 = '$_POST[addr1]', AddrLine2 = '$_POST[addr2]',
			City = '$_POST[city]', State = '$_POST[state]', ZIP = '$_POST[zip]', PhoneNbr = '$_POST[phonenbr]'
			where AddrTBL.ID = '$result_array[AddrID]'";
									
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query update AddrTBL (77) PharmacyID = '$_POST[clientid]'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clientinfo.php?clientid=$_POST[clientid]";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
	

		//--------------------------------------------------------------------------------------------------
		// update display variables
		//--------------------------------------------------------------------------------------------------
		$Displayclientid = $_POST[clientid];
		$DisplayMsg = "Client Information update successfull!";
		
		//--------------------------------------------------------------------------------------------------
		// end of Update 
		//--------------------------------------------------------------------------------------------------
		break;
		
	case 'Delete':
			
		//--------------------------------------------------------------------------------------------------
		// end of Delete 
		//--------------------------------------------------------------------------------------------------
		break;
		
		
		default:
			$DisplayMsg = "No action selected.  Hit default.";
			break;
			
} // end of switch
		
//--------------------------------------------------------------------------------------------------		
// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_clientinfo.php?msgTxt=$DisplayMsg&clientid=$Displayclientid");

?>
