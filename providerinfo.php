<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'providerinfo.php';

require ('hysInit.php');

require ('hysDBinit.php');

$DisplayProviderType = 'D';

//----------------------------------------------------------------------------------------------------------
// What are we being asked to do?  Here we go to func based on action
//----------------------------------------------------------------------------------------------------------
switch ($_POST[Action])
{
	case 'Add':
	
		//--------------------------------------------------------------------------------------------------
		// Add a FullName
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// Now it is time to insert FullNameTBL entry.  After successfull insert we must get auto increment id
		// to add to ProviderTBL.  We only add what is given.  The rest will default.
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO FullNameTBL 
					(Prefix, FirstName, MI, LastName, Suffix, PagerID, PagerTeleNbr, MobilePhone, eMailAddr)  
					VALUES ('$_POST[prefix]', '$_POST[firstname]','$_POST[mi]', '$_POST[lastname]', '$_POST[suffix]', 
					'$_POST[pagerid]', '$_POST[pagerphonenbr]', '$_POST[mobilenbr]', '$_POST[email]')";
					
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert FullNameTBL (8695)";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_providerinfo.php?providerid=$_POST[providerid]";
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
			$location = "Location: if_providerinfo.php?providerid=$_POST[providerid]";
			$shortmsg = "Unable to save Name information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// get FullNameTBL id for ProviderTBL
		//--------------------------------------------------------------------------------------------------
		$NewFullNameID =  mysql_insert_id ($conn);
		if ($NewFullNameID == 0)
		{
			// error
			$errmsg = "Could not get unique FullName ID. Please try again.";
			$location = "Location: if_providerinfo.php?providerid=$_POST[providerid]";
			$shortmsg = "Unable to save Name information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		//--------------------------------------------------------------------------------------------------
		// Second create ProviderTBL insert.  We only add what is given.  The rest will default.
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO ProviderTBL 
					(ID, TypeID, FullNameID, SpecialtyID)                    
					VALUES ('$_POST[providerid]', '$_POST[providertype]', '$NewFullNameID', '$_POST[specialtytype]')";

		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert ProviderTBL (9695)";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_providerinfo.php?providerid=$_POST[providerid]";
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
			$errmsg = "Unable to insert Provider information.  Please try again. Insert failed.";
			$location = "Location: if_providerinfo.php?providerid=$_POST[providerid]";
			$shortmsg = "Unable to save Provider information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// create ProviderIdentifierTBL insert.  We only add what is given.  The rest will default.
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO ProviderIdentifierTBL 
					(ProviderID, ProviderIdentifier, ProviderIdentifierTypeID)                    
					VALUES ('$_POST[providerid]', '$_POST[license]', '$_POST[licensingauthority]')";

		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert ProviderIdentifierTBL (9695)";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_providerinfo.php?providerid=$_POST[providerid]";
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
			$errmsg = "Unable to insert Provider license information.  Please try again. Insert failed.";
			$location = "Location: if_providerinfo.php?providerid=$_POST[providerid]";
			$shortmsg = "Unable to save Provider information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// Providers are not required to have passwords.  If they have them they can access clients.  If 
		// Not they can not.  A client can also exclude a provider through Authorization table
		//--------------------------------------------------------------------------------------------------
		if (isset($_POST[providerpassword]) && ($_POST[providerpassword] != "") )
		{
			$pwCheck = spookEStr($_POST[providerpassword]);
			
			//--------------------------------------------------------------------------------------------------
			// Add a Authentication info
			//--------------------------------------------------------------------------------------------------
			$sql = "INSERT INTO AuthenticationTBL 
						(USERID,  Pword, TypeID)  
						VALUES ('$_POST[clientid]', '$pwCheck', '$DisplayProviderType')";
						
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query insert AuthenticationTBL (2695)";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "Location: if_providerinfo.php?providerid=$_POST[providerid]";
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
				$errmsg = "Unable to save Provider Authentication information. Please try again. Insert Failed.";
				$location = "Location: if_providerinfo.php?providerid=$_POST[providerid]";
				$shortmsg = "Unable to save Provider information.";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
		}
		
		//--------------------------------------------------------------------------------------------------
		// set our display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayProviderID = $_POST[providerid];
		$DisplayMsg = "Provider Information Added successfully!";
		
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
		if (!isset($_POST[providerid]) || ($_POST[providerid] == "") )
		{
			// error
			$errmsg = "Error doing update for sql. no providerid providerid= '$_POST[providerid]' (595)";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_providerinfo.php?providerid=$_POST[providerid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------
		// Get AddrID and Full Name ID
		//--------------------------------------------------------------------------------------------------	
		$sql = "SELECT  FullNameID
			from ProviderTBL 
			where (ProviderTBL.ID = '$_POST[providerid]')"; 
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for ProviderTBL (195) sql = '$sql'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_providerinfo.php?providerid=$_POST[providerid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
			
		// Now lets first see if there is anything to run through.  If more then 1 we have an error
		$countRows = mysql_num_rows($sql_result);
		if ($countRows != 1)
		{
			$errmsg = " Error more then 1 row or less returned in select on ProviderTBL. count = '$countRows'  - ProviderID =  '$_POST[providerid]'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_providerinfo.php?providerid=$_POST[providerid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
	
		//----------------------------------------------------------------------------------------------------------
		// Get the Provider Data
		//----------------------------------------------------------------------------------------------------------
		$result_array = mysql_fetch_assoc($sql_result);
		
		//--------------------------------------------------------------------------------------------------
		// Update the FullNameTBL
		//--------------------------------------------------------------------------------------------------
		$sql = "UPDATE FullNameTBL 
					set Prefix =  '$_POST[prefix]', FirstName = '$_POST[firstname]', MI = '$_POST[mi]', 
					LastName = '$_POST[lastname]', Suffix = '$_POST[suffix]',
					PagerID = '$_POST[pagerid]', PagerTeleNbr = '$_POST[pagerphonenbr]', 
					MobilePhone = '$_POST[mobilenbr]', 	eMailAddr = '$_POST[email]'
						where (FullNameTBL.ID = '$result_array[FullNameID]')";
									
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query update FullNameTBL (77) ProviderID = '$_POST[providerid]'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_providerinfo.php?providerid=$_POST[providerid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}

		//--------------------------------------------------------------------------------------------------
		// Update ProviderTBL entry.  We only update what is given. 
		//--------------------------------------------------------------------------------------------------
		$sql = "UPDATE ProviderTBL 
			set TypeID = '$_POST[providertype]', SpecialtyID = '$_POST[specialtytype]' 
			where ProviderTBL.ID = '$_POST[providerid]'";
									
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query update ProviderTBL (77) ProviderID = '$_POST[providerid]'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_providerinfo.php?providerid=$_POST[providerid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
	
		//--------------------------------------------------------------------------------------------------
		// Update ProviderIdentifierTBL entry.  We only update what is given. 
		//--------------------------------------------------------------------------------------------------
		$sql = "UPDATE ProviderIdentifierTBL 
			set ProviderIdentifier = '$_POST[license]', ProviderIdentifierTypeID = '$_POST[licensingauthority]'
			where ProviderIdentifierTBL.ProviderID = '$_POST[providerid]'";
									
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query update ProviderIdentifierTBL (77) ProviderID = '$_POST[providerid]'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_providerinfo.php?providerid=$_POST[providerid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//echo "sql = ".$sql;
		
		//--------------------------------------------------------------------------------------------------
		// Providers are not required to have passwords.  If they have them they can access clients.  If 
		// Not they can not.  A client can also exclude a provider through Authorization table
		//--------------------------------------------------------------------------------------------------
		if (isset($_POST[providerpassword]) && ($_POST[providerpassword] != "") )
		{
			//-----------------------------------------------------------------------------------------------
			// We may or may bot have a provider password - therefore we must check
			//-----------------------------------------------------------------------------------------------
			$pwCheck = spookEStr($_POST[providerpassword]);
			
			//----------------------------------------------------------------------------------------------------------
			// First we will get the password if it is available
			//----------------------------------------------------------------------------------------------------------
			$sql = "SELECT  *
				from AuthenticationTBL 
					where (AuthenticationTBL.USERID = '$_POST[providerid]'
					and AuthenticationTBL.TypeID = '$DisplayProviderType')"; 
					
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query for AutenticationTBL (83) - '$DisplayProviderID'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "Location: if_providerinfo.php?providerid=$_POST[providerid]";
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
							VALUES ('$_POST[providerid]', '$pwCheck', '$DisplayProviderType')";
							
				if (!$sql_result = mysql_query($sql, $conn))
				{
					$sqlerr = mysql_error();
					$errmsg = "$sqlerr - Error doing mysql_query insert AuthenticationTBL (1695)";
					$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
					$location = "Location: if_providerinfo.php?providerid=$_POST[providerid]";
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
					$errmsg = "Unable to save Provider Authentication information. Please try again. Insert Failed.";
					$location = "Location: if_providerinfo.php?providerid=$_POST[providerid]";
					$shortmsg = "Unable to save Provider information.";
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
						where AuthenticationTBL.USERID = '$_POST[providerid]' and 
							AuthenticationTBL.TypeID = '$DisplayProviderType'";
		
				if (!$sql_result = mysql_query($sql, $conn))
				{
					$sqlerr = mysql_error();
					$errmsg = "$sqlerr - Error doing mysql_query insert AuthenticationTBL (3695)";
					$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
					$location = "Location: if_providerinfo.php?providerid=$_POST[providerid]";
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
						where AuthenticationTBL.USERID = '$_POST[providerid]' and 
							AuthenticationTBL.TypeID = '$DisplayProviderType'";
			
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query for delete on AuthenticationTBL (4695) - '$Medpal' sql= '$sql'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "Location: if_providerinfo.php?providerid=$_POST[providerid]";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
		}	
		
		//--------------------------------------------------------------------------------------------------
		// update display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayProviderID = $_POST[providerid];
		$DisplayMsg = "Provider Information update successfull!";
		
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
			if (isset($_POST[providerid]) and ($_POST[providerid] != ""))
				$DisplayProviderID = $_POST[providerid];
			else
				$DisplayProviderID = "";
				
			$DisplayMsg = "No action selected.  Hit default.";
			break;
			
} // end of switch
		
//--------------------------------------------------------------------------------------------------		
// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_providerinfo.php?msgTxt=$DisplayMsg&providerid=$DisplayProviderID");

?>
