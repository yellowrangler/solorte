<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'clientpharmacy.php';

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
		$location = "Location: if_clientpharmacyinfo.php?pharmacyid=$_GET[pharmacyid]";
		$shortmsg = "System Error: ClientID not passed in.";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	else
	{
		// We are either POST data or in error
		if(!isset($_POST[pharmacyid]) || ($_POST[pharmacyid] == "") )
		{
			$errmsg = "System Error: PharmacyID not passed in. Provider ID passed in is '$_POST[pharmacyid]'";
			$location = "Location: if_clientpharmacyinfo.php?pharmacyid=$_POST[pharmacyid]";
			$shortmsg = "System Error: PharmacyID not passed in.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}

		//Get host id and set flag to is update
		$PharmacyID = $_POST[pharmacyid];
		$ClientID = $_POST[clientid];
		$Action = $_POST[Action];
	}	
}	
else
{	
	// We are either GET data or in error
	if(!isset($_GET[pharmacyid]) || ($_GET[pharmacyid] == "") )
	{
		$errmsg = "System Error: PharmacyID not passed in. PharmacyID passed in is '$_GET[pharmacyid]'";
		$location = "Location: if_clientpharmacyinfo.php?pharmacyid=$_GET[pharmacyid]";
		$shortmsg = "System Error: PharmacyID not passed in.";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}

	//Get host id and set flag to is update
	$PharmacyID = $_GET[pharmacyid];
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
		$sql = "SELECT ID, OrderID, MEDPAL, PharmacyID
			from ClientPharmacyTBL 
			where (ClientPharmacyTBL.MEDPAL = '$ClientID')
			ORDER BY OrderID"; 
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query join for ClientPharmacyTBL (195) sql = '$sql' clientid = '$ClientID'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clientpharmacyinfo.php?pharmacyid=$_GET[pharmacyid]";
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
			if ($PharmacyID == $result_array[PharmacyID])
			{
				$errmsg = "Duplicate Pharmacy. No action taken. Pharmacy = '$PharmacyID' Client = '$ClientID' ";
				$location = "Location: if_clientpharmacyinfo.php?pharmacyid=$PharmacyID";
				$shortmsg = "Duplicate Pharmacy. No action taken.";
				$severity = 1;
				$location = "Location: if_clientpharmacyinfo.php?pharmacyid=$_GET[pharmacyid]";
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}	
			
			$i++;
		
		} // End of While
	
		//--------------------------------------------------------------------------------------------------
		// Insert new relation into Provider Client TBL
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO ClientPharmacyTBL 
					(OrderID, MEDPAL, PharmacyID)  
					VALUES ('$i', '$ClientID', '$PharmacyID')";
					
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert ClientPharmacyTBL (695) clientid = '$ClientID'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clientpharmacyinfo.php?pharmacyid=$_GET[pharmacyid]";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// Now lets process the result set 
		//--------------------------------------------------------------------------------------------------
		$affRows = mysql_affected_rows($conn);
		if ($affRows != 1)
		{
			// error
			$errmsg = "Unable to save Client Pharmacy information. Please try again. Insert Failed.";
			$location = "Location: if_clientpharmacyinfo.php?pharmacyid=$PharmacyID";
			$shortmsg = "Unable to save Client Pharmacy information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// set our display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayPharmacyID = $PharmacyID;
		$DisplayMsg = "Pharmacy Added successfully to Client!";
		
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
		$sql = "DELETE from ClientPharmacyTBL 
			WHERE (ClientPharmacyTBL.PharmacyID = '$PharmacyID' AND ClientPharmacyTBL.MEDPAL = '$ClientID')";
			
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query delete ClientPharmacyTBL (695)";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clientpharmacyinfo.php?pharmacyid=$_GET[pharmacyid]";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// now check that only 1 row was effected
		//--------------------------------------------------------------------------------------------------
		$affRows = mysql_affected_rows($conn);
		if ($affRows != 1)
		{
			$errmsg = "Error doing delete for ClientPharmacyTBL.  rows affected = '$affRows'. (996)  Too many or too few rows pharmacyid='$PharmacyID' clientid = '$ClientID'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clientpharmacyinfo.php?pharmacyid=$_GET[pharmacyid]";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// update display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayPharmacyID = $PharmacyID;
		$DisplayMsg = "Pharmacy removed successfully from Client!";
		
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
		$sql = "SELECT ID, OrderID, MEDPAL, PharmacyID
			from ClientPharmacyTBL 
			where (ClientPharmacyTBL.MEDPAL = '$ClientID')
			ORDER BY OrderID"; 
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query join for ClientPharmacyTBL (196) sql = '$sql' pharmacyid = '$PharmacyID' clientid = '$ClientID'";;
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clientpharmacyinfo.php?pharmacyid=$_GET[pharmacyid]";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
			
		//---------------------------------------------------------------------------------------------------------
		// initialize some variables
		//---------------------------------------------------------------------------------------------------------
		$i = 0;
		$MoveFrom = ""; 
		$PharmacyClientArray[] = "";
		
		//----------------------------------------------------------------------------------------------------------
		// Get the Provider Client Data into an array
		//----------------------------------------------------------------------------------------------------------
		while ($result_array = mysql_fetch_assoc($sql_result))
		{
			$PharmacyClientArray[$i] = $result_array[PharmacyID];
			
			if ($PharmacyID == $result_array[PharmacyID])
			{
				$MoveFrom = $i;	
			}	
			
			$i++;
		
		} // End of While
	
		if ($i == 0)
		{
			
			$errmsg = "Original Pharmacy position not found. No action taken (2).";
			$location = "Location: if_clientpharmacyinfo.php?pharmacyid=$PharmacyID";
			$shortmsg = "Original Pharmacy position not found. No action taken.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		else
		{
			if ($MoveFrom == "")
			{
				$errmsg = " Original Pharmacy position not found. No action taken.";
				$location = "Location: if_clientpharmacyinfo.php?pharmacyid=$PharmacyID";
				$shortmsg = "Original Pharmacy position not found. No action taken.";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}	
		
			$tmpHold = $PharmacyClientArray[0];
			$PharmacyClientArray[0] = $PharmacyID;
			$PharmacyClientArray[$MoveFrom] = $tmpHold;
		}	
		
		for ($j = 0; $j < $i; $j++)
		{
			//--------------------------------------------------------------------------------------------------
			// Update ProviderTBL entry.  We only update what is given. 
			//--------------------------------------------------------------------------------------------------
			$k = $j + 1;
			
			$sql = "UPDATE ClientPharmacyTBL 
				set OrderID = '$k', MEDPAL = '$ClientID', PharmacyID = '$PharmacyClientArray[$j]' 
				where (ClientPharmacyTBL.MEDPAL = '$ClientID' AND ClientPharmacyTBL.OrderID = '$k')";
										
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query update ClientPharmacyTBL (77) PharmacyID = '$PharmacyID' clientid = '$ClientID'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$severity = 1;
				$location = "Location: if_clientpharmacyinfo.php?pharmacyid=$_GET[pharmacyid]";
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
	
		} // End of While
	
		//--------------------------------------------------------------------------------------------------
		// set our display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayPharmacyID = $PharmacyID;
		$DisplayMsg = "Selected Pharmacy now Primary to Client!";	
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
header("Location: if_clientpharmacyinfo.php?msgTxt=$DisplayMsg&pharmacyid=$DisplayPharmacyID");

?>
