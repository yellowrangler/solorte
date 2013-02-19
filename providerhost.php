<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'providerhost.php';

require ('hysInit.php');

require ('hysDBinit.php');


//----------------------------------------------------------------------------------------------------------
// We must be passed a Host ID and Action
//----------------------------------------------------------------------------------------------------------

if (!isset($_GET[hostid]) || ($_GET[hostid] == "") )
{
	$errmsg = "System Error: HostID not passed in. Host ID passed in is '$_GET[hostid]'";
	$location = "Location: if_providerinfo.php?providerid=$_GET[providerid]";
	$shortmsg = "System Error: HostID not passed in.";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}
	
if(!isset($_GET[providerid]) || ($_GET[providerid] == "") )
{
	$errmsg = "System Error: ProviderID not passed in. Provider ID passed in is '$_GET[providerid]'";
	$location = "Location: if_providerinfo.php?providerid=$_GET[providerid]";
	$shortmsg = "System Error: ProviderID not passed in.";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//Get host id and set flag to is update
$ProviderID = $_GET[providerid];
$HostID = $_GET[hostid];

//----------------------------------------------------------------------------------------------------------
// What are we being asked to do?  Here we go to func based on action
//----------------------------------------------------------------------------------------------------------
switch ($_GET[Action])
{
	case 'add':
		//--------------------------------------------------------------------------------------------------
		// Add a Host to Provider
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// First check what is there to look for duplicate and to get next order id entry
		//--------------------------------------------------------------------------------------------------
		$sql = "SELECT ID, OrderID, ProviderID, HostID
			from ProviderHostTBL 
			where (ProviderHostTBL.ProviderID = '$ProviderID')
			ORDER BY OrderID"; 
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query join for ProviderHostTBL (195) sql = '$sql' providerid = '$ProviderID'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_providerinfo.php?providerid=$_GET[providerid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
			
		//---------------------------------------------------------------------------------------------------------
		// initialize some variables
		//---------------------------------------------------------------------------------------------------------
		$i = 1;
		
		
		//----------------------------------------------------------------------------------------------------------
		// Get the Provider Host Data
		//----------------------------------------------------------------------------------------------------------
		while ($result_array = mysql_fetch_assoc($sql_result))
		{
			if ($HostID == $result_array[HostID])
			{
				$errmsg = "Duplicate Host. No action taken.";
				$location = "Location: if_providerinfo.php?msgTxt=$errmsg&providerid=$_GET[providerid]";
				$shortmsg = "Duplicate Host. No action taken.";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}	
			
			$i++;
		
		} // End of While
	
		//--------------------------------------------------------------------------------------------------
		// Insert new relation into Provider Host TBL
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO ProviderHostTBL 
					(OrderID, ProviderID, HostID)  
					VALUES ('$i', '$ProviderID', '$HostID')";
					
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert ProviderHostTBL (695)";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_providerinfo.php?providerid=$_GET[providerid]";
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
			$errmsg = "Unable to save Provider Host information. Please try again. Insert Failed.";
			$location = "Location: if_providerinfo.php?msgTxt=$errmsg&providerid=$_GET[providerid]";
			$shortmsg = "Unable to save Provider Host information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// set our display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayProviderID = $ProviderID;
		$DisplayMsg = "Host Added successfully to Provider!";
		
		//--------------------------------------------------------------------------------------------------
		// end of Add 
		//--------------------------------------------------------------------------------------------------
		break;
		
	case 'remove':
		//--------------------------------------------------------------------------------------------------
		// Remove  a Provider Host relationship
		//--------------------------------------------------------------------------------------------------

		//--------------------------------------------------------------------------------------------------
		// We will just do the delete - no checking
		//--------------------------------------------------------------------------------------------------
		$sql = "DELETE from ProviderHostTBL 
			WHERE (ProviderHostTBL.ProviderID = '$ProviderID' AND ProviderHostTBL.HostID = '$HostID')";
			
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query delete ProviderHostTBL (695)";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_providerinfo.php?providerid=$_GET[providerid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// now check that only 1 row was effected
		//--------------------------------------------------------------------------------------------------
		$affRows = mysql_affected_rows($conn);
		if ($affRows != 1)
		{
			$errmsg = "Error doing delete for ProviderHostTBL.  rows affected = '$affRows'. (996)  Too many or too few rows providerid='$ProviderID' hostid = '$HostID'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_providerinfo.php?providerid=$_GET[providerid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// update display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayProviderID = $ProviderID;
		$DisplayMsg = "Host removed successfully from Provider!";
		
		//--------------------------------------------------------------------------------------------------
		// end of Remove 
		//--------------------------------------------------------------------------------------------------
		break;
		
	case 'reorder':
		//--------------------------------------------------------------------------------------------------
		// Add a Host to Provider
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// First check what is there to look for duplicate and to get next order id entry
		//--------------------------------------------------------------------------------------------------
		$sql = "SELECT ID, OrderID, ProviderID, HostID
			from ProviderHostTBL 
			where (ProviderHostTBL.ProviderID = '$ProviderID')
			ORDER BY OrderID"; 
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query join for ProviderHostTBL (196) sql = '$sql' providerid = '$ProviderID'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_providerinfo.php?providerid=$_GET[providerid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
			
		//---------------------------------------------------------------------------------------------------------
		// initialize some variables
		//---------------------------------------------------------------------------------------------------------
		$i = 0;
		$MoveFrom = ""; 
		$ProviderHostArray[] = "";
		
		//----------------------------------------------------------------------------------------------------------
		// Get the Provider Host Data into an array
		//----------------------------------------------------------------------------------------------------------
		while ($result_array = mysql_fetch_assoc($sql_result))
		{
			$ProviderHostArray[$i] = $result_array[HostID];
			
			if ($HostID == $result_array[HostID])
			{
				$MoveFrom = $i;	
			}	
			
			$i++;
		
		} // End of While
	
		if ($i == 0)
		{
			
			$errmsg = "Original Host position not found. No action taken (2).";
			$location = "Location: if_providerinfo.php?msgTxt=$errmsg&providerid=$ProviderID";
			$shortmsg = "Original Host position not found. No action taken.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		else
		{
			if ($MoveFrom == "")
			{
				$errmsg = " Original Host position not found. No action taken.";
				$location = "Location: if_providerinfo.php?msgTxt=$errmsg&providerid=$ProviderID";
				$shortmsg = "Original Host position not found. No action taken.";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}	
		
			$tmpHold = $ProviderHostArray[0];
			$ProviderHostArray[0] = $HostID;
			$ProviderHostArray[$MoveFrom] = $tmpHold;
		}	
		
		for ($j = 0; $j < $i; $j++)
		{
			//--------------------------------------------------------------------------------------------------
			// Update ProviderTBL entry.  We only update what is given. 
			//--------------------------------------------------------------------------------------------------
			$k = $j + 1;
			
			$sql = "UPDATE ProviderHostTBL 
				set OrderID = '$k', ProviderID = '$ProviderID', HostID = '$ProviderHostArray[$j]'
				where (ProviderHostTBL.ProviderID = '$ProviderID' AND ProviderHostTBL.OrderID = '$k')";
										
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query update ProviderHostTBL (77) ProviderID = '$ProviderID'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "Location: if_providerinfo.php?providerid=$_GET[providerid]";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
	
		} // End of While
	
		//--------------------------------------------------------------------------------------------------
		// set our display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayProviderID = $ProviderID;
		$DisplayMsg = "Selected Host now Primary to Provider!";	
		//--------------------------------------------------------------------------------------------------
		// end of Re-Order 
		//--------------------------------------------------------------------------------------------------
		break;
		
		
		default:
			$DisplayMsg = "No action selected.  Hit default.";
			break;
			
} // end of switch
		
//--------------------------------------------------------------------------------------------------		
// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_providerinfo.php?msgTxt=$DisplayMsg&providerid=$DisplayProviderID");

?>
