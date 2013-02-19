<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'clienthost.php';

require ('hysInit.php');

require ('hysDBinit.php');


//----------------------------------------------------------------------------------------------------------
// We must be passed a Client ID and Action
//----------------------------------------------------------------------------------------------------------

if (!isset($_GET[clientid]) || ($_GET[clientid] == "") )
{
	if (!isset($_POST[clientid]) || ($_POST[clientid] == "") )
	{
		$errmsg = "System Error: ClientID not passed in. Client ID passed in is '$_GET[clientid]'";
		$location = "Location: if_clienthostinfo.php?hostid=$_GET[hostid]";
		$shortmsg = "System Error: ClientID not passed in.";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	else
	{
		// We are either POST data or in error
		if(!isset($_POST[hostid]) || ($_POST[hostid] == "") )
		{
			$errmsg = "System Error: HostID not passed in. Host ID passed in is '$_POST[hostid]'";
			$location = "Location: if_clienthostinfo.php?hostid=$_POST[hostid]";
			$shortmsg = "System Error: HostID not passed in.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}

		//Get host id and set flag to is update
		$HostID = $_POST[hostid];
		$ClientID = $_POST[clientid];
		$Action = $_POST[Action];
	}	
}	
else
{	
	// We are either GET data or in error
	if(!isset($_GET[hostid]) || ($_GET[hostid] == "") )
	{
		$errmsg = "System Error: HostID not passed in. Host ID passed in is '$_GET[hostid]'";
		$location = "Location: if_clienthostinfo.php?hostid=$_GET[hostid]";
		$shortmsg = "System Error: HostID not passed in.";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}

	//Get host id and set flag to is update
	$HostID = $_GET[hostid];
	$ClientID = $_GET[clientid];
	$Action = $_GET[Action];
}
		

//----------------------------------------------------------------------------------------------------------
// What are we being asked to do?  Here we go to func based on action
//----------------------------------------------------------------------------------------------------------
switch ($Action)
{
	case 'add':
		//--------------------------------------------------------------------------------------------------
		// Add a Client to Host
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// First check what is there to look for duplicate and to get next order id entry
		//--------------------------------------------------------------------------------------------------
		$sql = "SELECT ID, MEDPAL, HostID
			from ClientHostTBL 
			where (ClientHostTBL.MEDPAL = '$ClientID')";
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query join for ClientHostTBL (195) sql = '$sql' clientid = '$ClientID'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clienthostinfo.php?hostid=$HostID";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
			
		//----------------------------------------------------------------------------------------------------------
		// Get the Host Client Data
		//----------------------------------------------------------------------------------------------------------
		while ($result_array = mysql_fetch_assoc($sql_result))
		{
			if ($HostID == $result_array[HostID])
			{
				$errmsg = "Duplicate Host. No action taken. Host = '$HostID' Client = '$ClientID' ";
				$location = "Location: if_clienthostinfo.php?hostid=$HostID";
				$shortmsg = "Duplicate Host. No action taken.";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}	
		
		} // End of While
	
		//--------------------------------------------------------------------------------------------------
		// Insert new relation into Host Client TBL
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO ClientHostTBL 
					(MEDPAL, HostID)  
					VALUES ('$ClientID', '$HostID')";
					
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert ClientHostTBL (695) cleintid = '$ClientID'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clienthostinfo.php?hostid=$HostID";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// Now lets process the result set 
		//--------------------------------------------------------------------------------------------------
		$affRows = mysql_affected_rows($conn);
		if ($affRows != 1)
		{
			// error
			$errmsg = "Unable to save Client Host information. Please try again. Insert Failed.";
			$location = "Location: if_clienthostinfo.php?hostid=$HostID";
			$shortmsg = "Unable to save Client Host information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// set our display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayHostID = $HostID;
		$DisplayMsg = "Host Added successfully to Client!";
		
		//--------------------------------------------------------------------------------------------------
		// end of Add 
		//--------------------------------------------------------------------------------------------------
		break;
		
	case 'remove':
		//--------------------------------------------------------------------------------------------------
		// Remove  a Host Client relationship
		//--------------------------------------------------------------------------------------------------

		//--------------------------------------------------------------------------------------------------
		// We will just do the delete - no checking
		//--------------------------------------------------------------------------------------------------
		$sql = "DELETE from ClientHostTBL 
			WHERE (ClientHostTBL.HostID = '$HostID' AND ClientHostTBL.MEDPAL = '$ClientID')";
			
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query delete ClientHostTBL (695)";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clienthostinfo.php?hostid=$HostID";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// now check that only 1 row was effected
		//--------------------------------------------------------------------------------------------------
		$affRows = mysql_affected_rows($conn);
		if ($affRows != 1)
		{
			$errmsg = "Error doing delete for ClientHostTBL.  rows affected = '$affRows'. (996)  Too many or too few rows hostid='$HostID' clientid = '$ClientID'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clienthostinfo.php?hostid=$HostID";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// update display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayHostID = $HostID;
		$DisplayMsg = "Host removed successfully from Client!";
		
		//--------------------------------------------------------------------------------------------------
		// end of Remove 
		//--------------------------------------------------------------------------------------------------
		break;		
		
		default:
			$DisplayMsg = "No action selected.  Hit default.";
			break;
			
} // end of switch
		
//--------------------------------------------------------------------------------------------------		
// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_clienthostinfo.php?msgTxt=$DisplayMsg&hostid=$DisplayHostID");

?>
