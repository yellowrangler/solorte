<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'clientsharedaccess.php';

require ('hysInitAdmin.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');
//----------------------------------------------------------------------------------------------------------
// We must be passed a Client ID and Action
//----------------------------------------------------------------------------------------------------------

if (!isset($_GET[medpal]) || ($_GET[medpal] == "") )
{
	if (!isset($_POST[medpal]) || ($_POST[medpal] == "") )
	{
		$errmsg = "System Error: medpal not passed in. User ID passed in is '$_GET[medpal]'";
		$location = "Location: if_clientsharedaccess.php";
		$shortmsg = "System Error: medpal not passed in.";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	else
	{
		// We are either POST data or in error
		if(!isset($_POST[accessuserid]) || ($_POST[accessuserid] == "") )
		{
			$errmsg = "System Error: accessuserid not passed in. Access Client ID passed in is '$_POST[accessuserid]'";
			$location = "Location: if_clientsharedaccess.php";
			$shortmsg = "System Error: accessuserid not passed in.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}

		//Get host id and set flag to is update
		$accessuserid = $_POST[accessuserid];
		$medpal = $_POST[medpal];
		$Action = $_POST[Action];
	}	
}	
else
{	
	// We are either GET data or in error
	if(!isset($_GET[accessuserid]) || ($_GET[accessuserid] == "") )
	{
		$errmsg = "System Error: accessuserid not passed in. Access Client ID passed in is '$_GET[accessuserid]'";
		$location = "Location: if_clientsharedaccess.php";
		$shortmsg = "System Error: accessuserid not passed in.";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}

	//Get host id and set flag to is update
	$accessuserid = $_GET[accessuserid];
	$medpal = $_GET[medpal];
	$Action = $_GET[Action];
}
		

//----------------------------------------------------------------------------------------------------------
// What are we being asked to do?  Here we go to func based on action
//----------------------------------------------------------------------------------------------------------
switch ($Action)
{
	case 'add':
		//--------------------------------------------------------------------------------------------------
		// Add a User Client Relationship
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// First check what is there to look for duplicate and to get next order id entry
		//--------------------------------------------------------------------------------------------------
			$sql = "SELECT  USERID, MEDPAL, Level
					from AuthorizationTBL
					where (AuthorizationTBL.USERID = '$accessuserid' and AuthorizationTBL.MEDPAL = '$medpal')"; 
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query join for AuthorizationTBL (195) sql = '$sql' medpal = '$medpal' accessuserid = '$accessuserid'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clientsharedaccess.php";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
			
		//----------------------------------------------------------------------------------------------------------
		// Get the Authorization Data
		//----------------------------------------------------------------------------------------------------------
		$result_array = mysql_fetch_assoc($sql_result);
		
		//----------------------------------------------------------------------------------------------------------
		// Now lets first see if there is anything to run through
		//----------------------------------------------------------------------------------------------------------
		$countRows = mysql_num_rows($sql_result);
		if ($countRows >  0) 
		{
			$errmsg = "Duplicate Client. No action taken. Client = '$accessuserid' Userid = '$medpal' ";
			$location = "Location: if_clientsharedaccess.php";
			$shortmsg = "Duplicate Client. No action taken.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
	
		//--------------------------------------------------------------------------------------------------
		// Insert new relation into Authorization TBL
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO AuthorizationTBL 
					(USERID, MEDPAL, Level)  
					VALUES ('$accessuserid', '$medpal', '1')";
					
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert AuthorizationTBL (695) userid = '$accessuserid' medpal = '$medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clientsharedaccess.php";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// Now lets process the result set 
		//--------------------------------------------------------------------------------------------------
		$affRows = mysql_affected_rows($conn);
		if ($affRows != 1)
		{
			// error
			$errmsg = "Unable to save AuthorizationTBL information. Please try again. Insert Failed.";
			$location = "Location: if_clientsharedaccess.php";
			$shortmsg = "Unable to save AuthorizationTBL information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// set our display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayMsg = "Client Grant Added successfully to User Access!";
		
		//--------------------------------------------------------------------------------------------------
		// end of Add 
		//--------------------------------------------------------------------------------------------------
		break;
		
	case 'remove':
		//--------------------------------------------------------------------------------------------------
		// Remove  a User Client relationship
		//--------------------------------------------------------------------------------------------------

		//--------------------------------------------------------------------------------------------------
		// We will just do the delete - no checking
		//--------------------------------------------------------------------------------------------------
		$sql = "DELETE from AuthorizationTBL 
			where (AuthorizationTBL.USERID = '$accessuserid' and AuthorizationTBL.MEDPAL = '$medpal')";
			
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query delete AuthorizationTBL (695)";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clientsharedaccess.php";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// now check that only 1 row was effected
		//--------------------------------------------------------------------------------------------------
		$affRows = mysql_affected_rows($conn);
		if ($affRows != 1)
		{
			$errmsg = "Error doing delete for AuthorizationTBL.  rows affected = '$affRows'. (996)  Too many or too few rows accessuserid='$accessuserid' medpal = '$medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$severity = 1;
			$location = "Location: if_clientsharedaccess.php";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// update display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayMsg = "Client Grant removed successfully from User Access!";
		
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
header("Location: if_clientsharedaccess.php?msgTxt=$DisplayMsg");

?>
