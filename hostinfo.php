<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'hostinfo.php';

require ('hysInit.php');

require ('hysDBinit.php');

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
		// to add to HostTBL.  We only add what is given.  The rest will default.
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
			$location = "Location: if_hostinfo.php?hostid=";	
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
			$location = "Location: if_hostinfo.php?hostid=";
			$shortmsg = "Unable to save Address information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// get AddrTBL id for HostTBL
		//--------------------------------------------------------------------------------------------------
		$NewAddrID =  mysql_insert_id ($conn);
		if ($NewAddrID == 0)
		{
			// error
			$errmsg = "Could not get unique Address ID. Please try again.";
			$location = "Location: if_hostinfo.php?hostid=";
			$shortmsg = "Could not get unique Address ID.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------
		// Second create HostTBL insert.  We only add what is given.  The rest will default.
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO HostTBL 
					(TypeID, Name, AddrID, URL, EmergNbr)                    
					VALUES ('$_POST[hosttype]',  '$_POST[hostname]', '$NewAddrID', '$_POST[url]', '$_POST[emergnbr]')";

		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert HostTBL (695)";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_hostinfo.php?hostid=";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// Now lets process the result set 
		//--------------------------------------------------------------------------------------------------
		$affRows = mysql_affected_rows($conn);
		if ($affRows != 1)
		{
			// error
			$errmsg = "Unable to insert Host information.  Please try again. Insert failed.";
			$location = "Location: if_hostinfo.php?hostid=";
			$shortmsg = "Unable to insert Host information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// get HostTBL id for Display
		//--------------------------------------------------------------------------------------------------
		$NewHostID =  mysql_insert_id ($conn);
		if ($NewHostID == 0)
		{
			// error
			$errmsg = "Could not get unique Host ID. Please try again.";
			$location = "Location: if_hostinfo.php?hostid=";
			$shortmsg = "Could not get unique Host ID.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		//--------------------------------------------------------------------------------------------------
		// set our display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayHostID = $NewHostID;
		$DisplayMsg = "Host Information Added successfully!";
		
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
		if (!isset($_POST[hostid]))
		{
			// error
			$errmsg = "Error doing update for sql. no hostid hostid= '$_POST[hostid]' (595)";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_hostinfo.php?hostid=";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------
		// Get AddrID
		//--------------------------------------------------------------------------------------------------	
		$sql = "SELECT  AddrID
			from HostTBL 
			where (HostTBL.ID = '$_POST[hostid]')"; 
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query join for HostTBL (195) sql = '$sql'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_hostinfo.php?hostid=$_POST[hostid]";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
			
		// Now lets first see if there is anything to run through.  If more then 1 we have an error
		$countRows = mysql_num_rows($sql_result);
		if ($countRows > 1)
		{
			$errmsg = " Error more then 1 rows returned in select on HostTBL. count = '$countRows'  - HostID =  '$_POST[hostid]'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_hostinfo.php?hostid=$_POST[hostid]";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
	
		//----------------------------------------------------------------------------------------------------------
		// Get the Host Data
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
			$errmsg = "$sqlerr - Error doing mysql_query update AddrTBL (77) HostID = '$_POST[hostid]'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_hostinfo.php?hostid=$_POST[hostid]";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
	
		//--------------------------------------------------------------------------------------------------
		// Update HostTBL entry.  We only update what is given. 
		//--------------------------------------------------------------------------------------------------
		$sql = "UPDATE HostTBL 
			set TypeID = '$_POST[hosttype]', Name = '$_POST[hostname]', URL = '$_POST[url]', EmergNbr = '$_POST[emergnbr]'
			where HostTBL.ID = '$_POST[hostid]'";
									
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query update HostTBL (77) HostID = '$_POST[hostid]'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_hostinfo.php?hostid=$_POST[hostid]";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
	
		//--------------------------------------------------------------------------------------------------
		// update display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayHostID = $_POST[hostid];
		$DisplayMsg = "Host Information update successfull!";
		
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
			if (isset($_POST[hostid]) and ($_POST[hostid] != ""))
				$DisplayHostID = $_POST[hostid];
			else
				$DisplayHostID = "";
				
			$DisplayMsg = "No action selected.  Hit default.";
			break;
			
} // end of switch
		
//--------------------------------------------------------------------------------------------------		
// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_hostinfo.php?msgTxt=$DisplayMsg&hostid=$DisplayHostID");

?>
