<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'userinfo.php';

require ('hysInit.php');

require ('hysDBinit.php');

$DisplayUserProxyType = 'U';

//----------------------------------------------------------------------------------------------------------
// What are we being asked to do?  Here we go to func based on action
//----------------------------------------------------------------------------------------------------------
switch ($_POST[Action])
{
	case 'Add':
		//--------------------------------------------------------------------------------------------------
		// Add a UserID
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// Usersm must have passwords
		//--------------------------------------------------------------------------------------------------
		if (!isset($_POST[userproxypassword]) || ($_POST[userproxypassword] == "") )
		{
			// error - Users must have passwords
			$errmsg = "No password entred.  Must have password..";
			$location = "Location: if_userinfo.php?userproxyid=$_POST[userproxyid]";
			$shortmsg = "No password entred. Must Add Password.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------
		// Now it is time to insert AddrTBL entry.  After successfull insert we must get auto increment id
		// to add to UserTBL.  We only add what is given.  The rest will default.
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
			$location = "Location: if_userinfo.php?userproxyid=$_POST[userproxyid]";
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
			$location = "Location: if_userinfo.php?msgTxt=$errmsg&userproxyid=";
			$shortmsg = "Unable to save Address information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// get AddrTBL id for UserTBL
		//--------------------------------------------------------------------------------------------------
		$NewAddrID =  mysql_insert_id ($conn);
		if ($NewAddrID == 0)
		{
			// error
			$errmsg = "Could not get unique Address ID. Please try again.";
			$location = "Location: if_userinfo.php?msgTxt=$errmsg&userproxyid=";
			$shortmsg = "Unable to save Address information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------
		// Add a FullName
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// Now it is time to insert FullNameTBL entry.  After successfull insert we must get auto increment id
		// to add to UserTBL.  We only add what is given.  The rest will default.
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO FullNameTBL 
					(Prefix, FirstName, MI, LastName, Suffix, eMailAddr)  
					VALUES ('$_POST[prefix]', '$_POST[firstname]',
					'$_POST[mi]', '$_POST[lastname]', '$_POST[suffix]', '$_POST[email]')";
					
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert FullNameTBL (695)";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_userinfo.php?userproxyid=$_POST[userproxyid]";
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
			$location = "Location: if_userinfo.php?msgTxt=$errmsg&userproxyid=";
			$shortmsg = "Unable to save Name information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// get FullNameTBL id for UserTBL
		//--------------------------------------------------------------------------------------------------
		$NewFullNameID =  mysql_insert_id ($conn);
		if ($NewFullNameID == 0)
		{
			// error
			$errmsg = "Could not get unique FullName ID. Please try again.";
			$location = "Location: if_userinfo.php?msgTxt=$errmsg&userproxyid=";
			$shortmsg = "Unable to save Name information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		//--------------------------------------------------------------------------------------------------
		// Second create UserTBL insert.  We only add what is given.  The rest will default.
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO UserTBL 
					(ID, FullNameID, AddrID)                    
					VALUES ('$_POST[userproxyid]', '$NewFullNameID', '$NewAddrID')";

		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert UserTBL (695)";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_userinfo.php?userproxyid=$_POST[userproxyid]";
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
			$errmsg = "Unable to insert User information.  Please try again. Insert failed.";
			$location = "Location: if_userinfo.php?msgTxt=$errmsg&userproxyid=";
			$shortmsg = "Unable to save User information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// User password
		//--------------------------------------------------------------------------------------------------
		$pwCheck = spookEStr($_POST[userproxypassword]);
		
		//--------------------------------------------------------------------------------------------------
		// Add a Authentication info
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO AuthenticationTBL 
					(USERID,  Pword, TypeID)  
					VALUES ('$_POST[userproxyid]', '$pwCheck', '$DisplayUserProxyType')";
					
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert AuthenticationTBL (695)";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_userinfo.php?userproxyid=$_POST[userproxyid]";
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
			$errmsg = "Unable to save User Authentication information. Please try again. Insert Failed.";
			$location = "Location: if_userinfo.php?userproxyid=$_POST[userproxyid]";
			$shortmsg = "Unable to save User information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}

		//--------------------------------------------------------------------------------------------------
		// set our display variables
		//--------------------------------------------------------------------------------------------------
		$Displayuserproxyid = $_POST[userproxyid];
		$DisplayMsg = "User Information Added successfully!";
		
		//--------------------------------------------------------------------------------------------------
		// end of Add 
		//--------------------------------------------------------------------------------------------------
		break;
		
	case 'Update':
		//--------------------------------------------------------------------------------------------------
		// Update a Host
		//--------------------------------------------------------------------------------------------------

		//--------------------------------------------------------------------------------------------------
		// if id to update not passed in then error
		//--------------------------------------------------------------------------------------------------
		if (!isset($_POST[userproxyid]))
		{
			// error
			$errmsg = "Error doing update for sql. no userproxyid userproxyid= '$_POST[userproxyid]' (595)";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_userinfo.php?userproxyid=$_POST[userproxyid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------
		// Get AddrID and Full Name ID
		//--------------------------------------------------------------------------------------------------	
		$sql = "SELECT  AddrID, FullNameID
			from UserTBL 
			where (UserTBL.ID = '$_POST[userproxyid]')"; 
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for UserTBL (195) sql = '$sql'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_userinfo.php?userproxyid=$_POST[userproxyid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
			
		// Now lets first see if there is anything to run through.  If more then 1 we have an error
		$countRows = mysql_num_rows($sql_result);
		if ($countRows > 1)
		{
			$errmsg = " Error more then 1 rows returned in select on UserTBL. count = '$countRows'  - userproxyid =  '$_POST[userproxyid]'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_userinfo.php?userproxyid=$_POST[userproxyid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
	
		//----------------------------------------------------------------------------------------------------------
		// Get the Pharmacy Data
		//----------------------------------------------------------------------------------------------------------
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
			$errmsg = "$sqlerr - Error doing mysql_query update AddrTBL (77) userproxyid = '$_POST[userproxyid]'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_userinfo.php?userproxyid=$_POST[userproxyid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
	
		//--------------------------------------------------------------------------------------------------
		// Update the FullNameTBL
		//--------------------------------------------------------------------------------------------------
		$sql = "UPDATE FullNameTBL 
					set Prefix =  '$_POST[prefix]', FirstName = '$_POST[firstname]', MI = '$_POST[mi]', 
					LastName = '$_POST[lastname]', Suffix = '$_POST[suffix]', eMailAddr = '$_POST[email]'
						where (FullNameTBL.ID = '$result_array[FullNameID]')";
									
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query update FullNameTBL (77) userproxyid = '$_POST[userproxyid]'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_userinfo.php?userproxyid=$_POST[userproxyid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}

		//--------------------------------------------------------------------------------------------------
		// Pharmacists are not required to have passwords.  If they have them they can access clients.  If 
		// Not they can not.  A client can also exclude a pharmacy through Authorization table
		//--------------------------------------------------------------------------------------------------
		if (isset($_POST[userproxypassword]) && ($_POST[userproxypassword] != "") )
		{
			//-----------------------------------------------------------------------------------------------
			// We may or may bot have a provider password - therefore we must check
			//-----------------------------------------------------------------------------------------------
			$pwCheck = spookEStr($_POST[userproxypassword]);
			
			//----------------------------------------------------------------------------------------------------------
			// First we will get the password if it is available
			//----------------------------------------------------------------------------------------------------------
			$sql = "SELECT  *
				from AuthenticationTBL 
					where (AuthenticationTBL.USERID = '$_POST[userproxyid]'
					and AuthenticationTBL.TypeID = '$DisplayUserProxyType')"; 
					
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query for AutenticationTBL (83) - '$DisplayUserProxyType'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "Location: if_userinfo.php?userproxyid=$_POST[userproxyid]";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}	
			
			//------------------------------------------
			// if ==  0 do add otherwise update
			//------------------------------------------
			$num_rows = mysql_num_rows($sql_result);
			if ($num_rows == 0)
			{
				//--------------------------------------------------------------------------------------------------
				// Add a Authentication info
				//--------------------------------------------------------------------------------------------------
				$sql = "INSERT INTO AuthenticationTBL 
							(USERID,  Pword, TypeID)  
							VALUES ('$_POST[userproxyid]', '$pwCheck', '$DisplayUserProxyType')";
							
				if (!$sql_result = mysql_query($sql, $conn))
				{
					$sqlerr = mysql_error();
					$errmsg = "$sqlerr - Error doing mysql_query insert AuthenticationTBL (695)";
					$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
					$location = "Location: if_userinfo.php?userproxyid=$_POST[userproxyid]";
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
					$errmsg = "Unable to save User Authentication information. Please try again. Insert Failed.";
					$location = "Location: if_userinfo.php?userproxyid=$_POST[userproxyid]";
					$shortmsg = "Unable to save User information.";
					$severity = 1;
					LogErr($shortmsg, $errmsg, $location, $module, $severity);
				}
			}
			else
			{
				//--------------------------------------------------------------------------------------------------
				// Update Authentication info
				//--------------------------------------------------------------------------------------------------
				$sql = "UPDATE AuthenticationTBL 
					set Pword = '$pwCheck'
						where AuthenticationTBL.USERID = '$_POST[userproxyid]' and 
							AuthenticationTBL.TypeID = '$DisplayUserProxyType'";
		
				if (!$sql_result = mysql_query($sql, $conn))
				{
					$sqlerr = mysql_error();
					$errmsg = "$sqlerr - Error doing mysql_query insert AuthenticationTBL (695)";
					$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
					$location = "Location: if_userinfo.php?userproxyid=$_POST[userproxyid]";
					$severity = 1;
					LogErr($shortmsg, $errmsg, $location, $module, $severity);
				}
			}	
		}
		else
		{
			//--------------------------------------------------------------------------------------------------
			// next delete from ClientVaccinationTBL
			//--------------------------------------------------------------------------------------------------
			$sql = "DELETE from AuthenticationTBL 
						where where AuthenticationTBL.USERID = '$_POST[userproxyid]' and 
							AuthenticationTBL.TypeID = '$DisplayUserProxyType'";
			
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query for delete on AuthenticationTBL (695) - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "Location: if_userinfo.php?userproxyid=$_POST[userproxyid]";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
		}	
		
		//--------------------------------------------------------------------------------------------------
		// update display variables
		//--------------------------------------------------------------------------------------------------
		$Displayuserproxyid = $_POST[userproxyid];
		$DisplayMsg = "User Information update successfull!";
		
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
			if (isset($_POST[userproxyid]) and ($_POST[userproxyid] != ""))
				$Displayuserproxyid = $_POST[userproxyid];
			else
				$Displayuserproxyid = "";
				
			$DisplayMsg = "No action selected.  Hit default.";
			break;
			
} // end of switch
		
//--------------------------------------------------------------------------------------------------		
// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_userinfo.php?msgTxt=$DisplayMsg&userproxyid=$Displayuserproxyid");

?>
