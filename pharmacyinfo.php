<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'pharmacyinfo.php';

require ('hysInit.php');

require ('hysDBinit.php');

$DisplayPharmacyType = 'P';

//----------------------------------------------------------------------------------------------------------
// What are we being asked to do?  Here we go to func based on action
//----------------------------------------------------------------------------------------------------------
switch ($_POST[Action])
{
	case 'Add':
		//--------------------------------------------------------------------------------------------------
		// Add a Address
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// Now it is time to insert AddrTBL entry.  After successfull insert we must get auto increment id
		// to add to PharmacyTBL.  We only add what is given.  The rest will default.
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
			$location = "Location: if_pharmacyinfo.php?pharmacyid=$_POST[pharmacyid]";
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
			$location = "Location: if_pharmacyinfo.php?pharmacyid=$_POST[pharmacyid]";
			$shortmsg = "Unable to save Address information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// get AddrTBL id for PharmacyTBL
		//--------------------------------------------------------------------------------------------------
		$NewAddrID =  mysql_insert_id ($conn);
		if ($NewAddrID == 0)
		{
			// error
			$errmsg = "Could not get unique Address ID. Please try again.";
			$location = "Location: if_pharmacyinfo.php?pharmacyid=$_POST[pharmacyid]";
			$shortmsg = "Unable to save Address information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------
		// Add a FullName
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// Now it is time to insert FullNameTBL entry.  After successfull insert we must get auto increment id
		// to add to PharmacyTBL.  We only add what is given.  The rest will default.
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
			$location = "Location: if_pharmacyinfo.php?pharmacyid=$_POST[pharmacyid]";
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
			$location = "Location: if_pharmacyinfo.php?pharmacyid=$_POST[pharmacyid]";
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
			$location = "Location: if_pharmacyinfo.php?pharmacyid=$_POST[pharmacyid]";
			$shortmsg = "Unable to save Name information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		//--------------------------------------------------------------------------------------------------
		// Second create PharmacyTBL insert.  We only add what is given.  The rest will default.
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO PharmacyTBL 
					(ID, Name, URL, FullNameID, AddrID)                    
					VALUES ('$_POST[pharmacyid]', '$_POST[pharmacyname]', '$_POST[url]', '$NewFullNameID', '$NewAddrID')";

		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert PharmacyTBL (695)";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_pharmacyinfo.php?pharmacyid=$_POST[pharmacyid]";
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
			$errmsg = "Unable to insert Pharmacy information.  Please try again. Insert failed.";
			$location = "Location: if_pharmacyinfo.php?pharmacyid=$_POST[pharmacyid]";
			$shortmsg = "Unable to save Pharmacy information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// Providers are not required to have passwords.  If they have them they can access clients.  If 
		// Not they can not.  A client can also exclude a provider through Authorization table
		//--------------------------------------------------------------------------------------------------
		if (isset($_POST[pharmacypassword]) && ($_POST[pharmacypassword] != "") )
		{
			$pwCheck = spookEStr($_POST[pharmacypassword]);
			
			//--------------------------------------------------------------------------------------------------
			// Add a Authentication info
			//--------------------------------------------------------------------------------------------------
			$sql = "INSERT INTO AuthenticationTBL 
						(USERID,  Pword, TypeID)  
						VALUES ('$_POST[pharmacyid]', '$pwCheck', '$DisplayPharmacyType')";
						
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query insert AuthenticationTBL (695)";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "Location: if_pharmacyinfo.php?pharmacyid=$_POST[pharmacyid]";
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
				$errmsg = "Unable to save Pharmacy Authentication information. Please try again. Insert Failed.";
				$location = "Location: if_pharmacyinfo.php?pharmacyid=$_POST[pharmacyid]";
				$shortmsg = "Unable to save Pharmacy information.";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
		}
	
		//--------------------------------------------------------------------------------------------------
		// set our display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayPharmacyID = $_POST[pharmacyid];
		$DisplayMsg = "Pharmacy Information Added successfully!";
		
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
		if (!isset($_POST[pharmacyid]))
		{
			// error
			$errmsg = "Error doing update for sql. no pharmacyid pharmacyid= '$_POST[pharmacyid]' (595)";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_pharmacyinfo.php?pharmacyid=$_POST[pharmacyid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------
		// Get AddrID and Full Name ID
		//--------------------------------------------------------------------------------------------------	
		$sql = "SELECT  AddrID, FullNameID
			from PharmacyTBL 
			where (PharmacyTBL.ID = '$_POST[pharmacyid]')"; 
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for PharmacyTBL (195) sql = '$sql'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_pharmacyinfo.php?pharmacyid=$_POST[pharmacyid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
			
		// Now lets first see if there is anything to run through.  If more then 1 we have an error
		$countRows = mysql_num_rows($sql_result);
		if ($countRows > 1)
		{
			$errmsg = " Error more then 1 rows returned in select on PharmacyTBL. count = '$countRows'  - PharmacyID =  '$_POST[pharmacyid]'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_pharmacyinfo.php?pharmacyid=$_POST[pharmacyid]";
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
			$errmsg = "$sqlerr - Error doing mysql_query update AddrTBL (77) PharmacyID = '$_POST[pharmacyid]'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_pharmacyinfo.php?pharmacyid=$_POST[pharmacyid]";
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
			$errmsg = "$sqlerr - Error doing mysql_query update FullNameTBL (77) PharmacyID = '$_POST[pharmacyid]'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_pharmacyinfo.php?pharmacyid=$_POST[pharmacyid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}

		//--------------------------------------------------------------------------------------------------
		// Update PharmacyTBL entry.  We only update what is given. 
		//--------------------------------------------------------------------------------------------------
		$sql = "UPDATE PharmacyTBL 
			set Name = '$_POST[pharmacyname]', URL = '$_POST[url]'
			where PharmacyTBL.ID = '$_POST[pharmacyid]'";
									
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query update PharmacyTBL (77) PharmacyID = '$_POST[pharmacyid]'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_pharmacyinfo.php?pharmacyid=$_POST[pharmacyid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// Pharmacists are not required to have passwords.  If they have them they can access clients.  If 
		// Not they can not.  A client can also exclude a pharmacy through Authorization table
		//--------------------------------------------------------------------------------------------------
		if (isset($_POST[pharmacypassword]) && ($_POST[pharmacypassword] != "") )
		{
			//-----------------------------------------------------------------------------------------------
			// We may or may bot have a provider password - therefore we must check
			//-----------------------------------------------------------------------------------------------
			$pwCheck = spookEStr($_POST[pharmacypassword]);
			
			//----------------------------------------------------------------------------------------------------------
			// First we will get the password if it is available
			//----------------------------------------------------------------------------------------------------------
			$sql = "SELECT  *
				from AuthenticationTBL 
					where (AuthenticationTBL.USERID = '$_POST[pharmacyid]'
					and AuthenticationTBL.TypeID = '$DisplayPharmacyType')"; 
					
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query for AutenticationTBL (83) - '$DisplayPharmacyType'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "Location: if_pharmacyinfo.php?pharmacyid=$_POST[pharmacyid]";
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
							VALUES ('$_POST[pharmacyid]', '$pwCheck', '$DisplayPharmacyType')";
							
				if (!$sql_result = mysql_query($sql, $conn))
				{
					$sqlerr = mysql_error();
					$errmsg = "$sqlerr - Error doing mysql_query insert AuthenticationTBL (695)";
					$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
					$location = "Location: if_pharmacyinfo.php?pharmacyid=$_POST[pharmacyid]";
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
					$errmsg = "Unable to save Pharmacy Authentication information. Please try again. Insert Failed.";
					$location = "Location: if_pharmacyinfo.php?pharmacyid=$_POST[pharmacyid]";
					$shortmsg = "Unable to save Pharmacy information.";
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
						where AuthenticationTBL.USERID = '$_POST[pharmacyid]' and 
							AuthenticationTBL.TypeID = '$DisplayPharmacyType'";
		
				if (!$sql_result = mysql_query($sql, $conn))
				{
					$sqlerr = mysql_error();
					$errmsg = "$sqlerr - Error doing mysql_query insert AuthenticationTBL (695)";
					$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
					$location = "Location: if_pharmacyinfo.php?pharmacyid=$_POST[pharmacyid]";
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
						where  AuthenticationTBL.USERID = '$_POST[pharmacyid]' and 
							AuthenticationTBL.TypeID = '$DisplayPharmacyType'";
			
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query for delete on AuthenticationTBL (695) - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "Location: if_pharmacyinfo.php?pharmacyid=$_POST[pharmacyid]";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
		}	
		
	
		//--------------------------------------------------------------------------------------------------
		// update display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayPharmacyID = $_POST[pharmacyid];
		$DisplayMsg = "Pharmacy Information update successfull!";
		
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
			if (isset($_POST[pharmacyid]) and ($_POST[pharmacyid] != ""))
				$DisplayPharmacyID = $_POST[pharmacyid];
			else
				$DisplayPharmacyID = "";
				
			$DisplayMsg = "No action selected.  Hit default.";
			break;
			
} // end of switch
		
//--------------------------------------------------------------------------------------------------		
// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_pharmacyinfo.php?msgTxt=$DisplayMsg&pharmacyid=$DisplayPharmacyID");

?>
