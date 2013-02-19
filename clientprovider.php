<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'clientprovider.php';

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
		$location = "Location: if_clientproviderinfo.php?providerid=$_GET[providerid]";
		$shortmsg = "System Error: ClientID not passed in.";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	else
	{
		// We are either POST data or in error
		if(!isset($_POST[providerid]) || ($_POST[providerid] == "") )
		{
			$errmsg = "System Error: ProviderID not passed in. Provider ID passed in is '$_POST[providerid]'";
			$location = "Location: if_clientproviderinfo.php?providerid=$_POST[providerid]";
			$shortmsg = "System Error: ProviderID not passed in.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}

		//Get host id and set flag to is update
		$ProviderID = $_POST[providerid];
		$ClientID = $_POST[clientid];
		$Action = $_POST[Action];
	}	
}	
else
{	
	// We are either GET data or in error
	if(!isset($_GET[providerid]) || ($_GET[providerid] == "") )
	{
		$errmsg = "System Error: ProviderID not passed in. Provider ID passed in is '$_GET[providerid]'";
		$location = "Location: if_clientproviderinfo.php?providerid=$_GET[providerid]";
		$shortmsg = "System Error: ProviderID not passed in.";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}

	//Get host id and set flag to is update
	$ProviderID = $_GET[providerid];
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
		// Add a Client to Provider
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// First check what is there to look for duplicate and to get next order id entry
		//--------------------------------------------------------------------------------------------------
		$sql = "SELECT ID, OrderID, MEDPAL, ProviderID
			from ClientProviderTBL 
			where (ClientProviderTBL.MEDPAL = '$ClientID')
			ORDER BY OrderID"; 
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query join for ClientProviderTBL (195) sql = '$sql' clientid = '$ClientID'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clientproviderinfo.php?providerid=$ProviderID";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
			
		//---------------------------------------------------------------------------------------------------------
		// initialize some variables
		//---------------------------------------------------------------------------------------------------------
		$i = 1;
		
		
		//----------------------------------------------------------------------------------------------------------
		// Get the Provider Client Data
		//----------------------------------------------------------------------------------------------------------
		while ($result_array = mysql_fetch_assoc($sql_result))
		{
			if ($ProviderID == $result_array[ProviderID])
			{
				$errmsg = "Duplicate Provider. No action taken. Provider = '$ProviderID' Client = '$ClientID' ";
				$location = "Location: if_clientproviderinfo.php?providerid=$ProviderID";
				$shortmsg = "Duplicate Provider. No action taken.";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}	
			
			$i++;
		
		} // End of While
	
		//--------------------------------------------------------------------------------------------------
		// Insert new relation into Provider Client TBL
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO ClientProviderTBL 
					(OrderID, MEDPAL, ProviderID)  
					VALUES ('$i', '$ClientID', '$ProviderID')";
					
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert ClientProviderTBL (695) cleintid = '$ClientID'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clientproviderinfo.php?providerid=$ProviderID";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// Now lets process the result set 
		//--------------------------------------------------------------------------------------------------
		$affRows = mysql_affected_rows($conn);
		if ($affRows != 1)
		{
			// error
			$errmsg = "Unable to save Client Provider information. Please try again. Insert Failed.";
			$location = "Location: if_clientproviderinfo.php?providerid=$ProviderID";
			$shortmsg = "Unable to save Client Provider information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// set our display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayProviderID = $ProviderID;
		$DisplayMsg = "Provider Added successfully to Client!";
		
		//--------------------------------------------------------------------------------------------------
		// end of Add 
		//--------------------------------------------------------------------------------------------------
		break;
		
	case 'remove':
		//--------------------------------------------------------------------------------------------------
		// Remove  a Provider Client relationship
		//--------------------------------------------------------------------------------------------------

		//--------------------------------------------------------------------------------------------------
		// We will just do the delete - no checking
		//--------------------------------------------------------------------------------------------------
		$sql = "DELETE from ClientProviderTBL 
			WHERE (ClientProviderTBL.ProviderID = '$ProviderID' AND ClientProviderTBL.MEDPAL = '$ClientID')";
			
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query delete ClientProviderTBL (695)";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clientproviderinfo.php?providerid=$ProviderID";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// now check that only 1 row was effected
		//--------------------------------------------------------------------------------------------------
		$affRows = mysql_affected_rows($conn);
		if ($affRows != 1)
		{
			$errmsg = "Error doing delete for ClientProviderTBL.  rows affected = '$affRows'. (996)  Too many or too few rows providerid='$ProviderID' clientid = '$ClientID'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clientproviderinfo.php?providerid=$ProviderID";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// update display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayProviderID = $ProviderID;
		$DisplayMsg = "Provider removed successfully from Client!";
		
		//--------------------------------------------------------------------------------------------------
		// end of Remove 
		//--------------------------------------------------------------------------------------------------
		break;
		
	case 'reorder':
		//--------------------------------------------------------------------------------------------------
		// Add a Client to Provider
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// First check what is there to look for duplicate and to get next order id entry
		//--------------------------------------------------------------------------------------------------
		$sql = "SELECT ID, OrderID, MEDPAL, ProviderID
			from ClientProviderTBL 
			where (ClientProviderTBL.MEDPAL = '$ClientID')
			ORDER BY OrderID"; 
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query join for ClientProviderTBL (196) sql = '$sql' providerid = '$ProviderID' clientid = '$ClientID'";;
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clientproviderinfo.php?providerid=$ProviderID";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
			
		//---------------------------------------------------------------------------------------------------------
		// initialize some variables
		//---------------------------------------------------------------------------------------------------------
		$i = 0;
		$MoveFrom = ""; 
		$ProviderClientArray[] = "";
		
		//----------------------------------------------------------------------------------------------------------
		// Get the Provider Client Data into an array
		//----------------------------------------------------------------------------------------------------------
		while ($result_array = mysql_fetch_assoc($sql_result))
		{
			$ProviderClientArray[$i] = $result_array[ProviderID];
			
			if ($ProviderID == $result_array[ProviderID])
			{
				$MoveFrom = $i;	
			}	
			
			$i++;
		
		} // End of While
	
		if ($i == 0)
		{
			
			$errmsg = " Original Provider position not found. No action taken (2).";
			$location = "Location: if_clientproviderinfo.php?providerid=$ProviderID";
			$shortmsg = "Original Provider position not found. No action taken.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		else
		{
			if ($MoveFrom == "")
			{
				$errmsg = " Original Provider position not found. No action taken.";
				$location = "Location: if_clientproviderinfo.php?providerid=$ProviderID";
				$shortmsg = "Original Provider position not found. No action taken.";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}	
		
			$tmpHold = $ProviderClientArray[0];
			$ProviderClientArray[0] = $ProviderID;
			$ProviderClientArray[$MoveFrom] = $tmpHold;
		}	
		
		for ($j = 0; $j < $i; $j++)
		{
			//--------------------------------------------------------------------------------------------------
			// Update ProviderTBL entry.  We only update what is given. 
			//--------------------------------------------------------------------------------------------------
			$k = $j + 1;
			
			$sql = "UPDATE ClientProviderTBL 
				set OrderID = '$k', MEDPAL = '$ClientID', ProviderID = '$ProviderClientArray[$j]' 
				where (ClientProviderTBL.MEDPAL = '$ClientID' AND ClientProviderTBL.OrderID = '$k')";
										
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query update ClientProviderTBL (77) ProviderID = '$ProviderID' clientid = '$ClientID'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$severity = 1;
				$location = "Location: if_clientproviderinfo.php?providerid=$ProviderID";
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
	
		} // End of While
	
		//--------------------------------------------------------------------------------------------------
		// set our display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayProviderID = $ProviderID;
		$DisplayMsg = "Selected Provider now Primary to Client!";	
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
header("Location: if_clientproviderinfo.php?msgTxt=$DisplayMsg&providerid=$DisplayProviderID");

?>
