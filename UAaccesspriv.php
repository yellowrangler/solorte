<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'UAaccesspriv.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

//----------------------------------------------------------------------------------------------------------
// Initialize variables.
//----------------------------------------------------------------------------------------------------------
$ProxyUserID = "";
$ProxyType = "";
$medpal = "";
$Action = "";
$ProxyRelationship = "";
$ProxyLevel = "";

//----------------------------------------------------------------------------------------------------------
// We must be passed a Proxy user id, medpal, proxy user type and action.
// Gets come from if_UAaccessprivlist Posts come from if_UAaccesspriv
//----------------------------------------------------------------------------------------------------------
if (isset($_GET[medpal]) && ($_GET[medpal] != "") )
{
	//-------------------------------------------------------------------------------------------------
	// Assume we are a GET for all data and that we have been called by if_UAaccessprivlist
	//-------------------------------------------------------------------------------------------------
	$medpal = $_GET[medpal];
	$ProxyUserID = $_GET[proxyuserid];
	$ProxyType =  $_GET[proxytype];
	$Action =  $_GET[Action];
}
else
{
	if(isset($_POST[medpal]) && ($_POST[medpal] != "") )
	{
		//-------------------------------------------------------------------------------------------------
		// Assume we are a GET for all data and that we have been called by if_UAaccessprivlist
		//-------------------------------------------------------------------------------------------------
		$medpal = $_POST[medpal];
		$ProxyUserID = $_POST[proxyuserid];
		$ProxyType =  $_POST[proxytype];
		$ProxyRelationship = $_POST[proxyrelationship];
		$ProxyLevel = $_POST[level];
		$Action =  $_POST[Action];
	}
	else
	{	
		$errmsg = "System Error: ProxyUserID not passed in. Access Client ID passed in is '$_POST[ProxyUserID]'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "Location: if_UAaccesspriv.php";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
}	

//----------------------------------------------------------------------------------------------------------
// What are we being asked to do?  Here we go to func based on action
//----------------------------------------------------------------------------------------------------------
switch ($Action)
{
	case 'add':
		//--------------------------------------------------------------------------------------------------
		// Add a User Proxy Access
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// First check to look for duplicate 
		//--------------------------------------------------------------------------------------------------
		$sql = "SELECT  USERID, TypeID, MEDPAL, Level, RelationsID
				from AuthorizationTBL
				where (AuthorizationTBL.USERID = '$ProxyUserID' and AuthorizationTBL.TypeID = '$ProxyType' and AuthorizationTBL.MEDPAL = '$medpal')"; 
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query join for AuthorizationTBL (195) sql = '$sql' medpal = '$medpal' ProxyUserID = '$ProxyUserID' typeid = '$ProxyType'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAaccesspriv.php";
			$severity = 1;
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
			$errmsg = "Duplicate Client. No action taken. Proxy User ID = '$ProxyUserID' Userid = '$medpal' TypeID = '$ProxyType'";
			$location = "Location: if_UAaccesspriv.php";
			$shortmsg = "Duplicate Client. No action taken.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
	
		//--------------------------------------------------------------------------------------------------
		// Insert new relation into Authorization TBL
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO AuthorizationTBL 
					(USERID, TypeID, MEDPAL, Level, RelationsID)  
					VALUES ('$ProxyUserID', '$ProxyType', '$medpal', '$ProxyLevel', '$ProxyRelationship')";
					
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert AuthorizationTBL (695) Proxy User ID = '$ProxyUserID' Userid = '$medpal' TypeID = '$ProxyType'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAaccesspriv.php";
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
			$errmsg = "Unable to save AuthorizationTBL information. Please try again. Insert Failed.";
			$location = "Location: if_UAaccesspriv.php";
			$shortmsg = "Unable to Save Authorization information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// set our display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayMsg = "Proxy Grant Added successfully!";
		
		//--------------------------------------------------------------------------------------------------
		// end of Add 
		//--------------------------------------------------------------------------------------------------
		break;
		
	case 'update':
		//--------------------------------------------------------------------------------------------------
		// Update a User Proxy Access
		//--------------------------------------------------------------------------------------------------		
		$sql = "UPDATE  AuthorizationTBL 
				 set USERID = '$ProxyUserID', TypeID = '$ProxyType', MEDPAL = '$medpal', Level = '$ProxyLevel', RelationsID = '$ProxyRelationship'
					  where (AuthorizationTBL.USERID = '$ProxyUserID' and AuthorizationTBL.TypeID = '$ProxyType' and AuthorizationTBL.MEDPAL = '$medpal')";
			
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query update AuthorizationTBL (695) Proxy User ID = '$ProxyUserID' Userid = '$medpal' TypeID = '$ProxyType'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAaccesspriv.php";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// set our display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayMsg = "Proxy Grant Updated successfully!";
		
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
				where (AuthorizationTBL.USERID = '$ProxyUserID' and AuthorizationTBL.TypeID = '$ProxyType' and AuthorizationTBL.MEDPAL = '$medpal')"; 
			
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query delete AuthorizationTBL (695)";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAaccesspriv.php";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// now check that only 1 row was effected
		//--------------------------------------------------------------------------------------------------
		$affRows = mysql_affected_rows($conn);
		if ($affRows != 1)
		{
			$errmsg = "Error doing delete for AuthorizationTBL.  rows affected = '$affRows'. (996)  Too many or too few rows Proxy User ID = '$ProxyUserID' Userid = '$medpal' TypeID = '$ProxyType'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAaccesspriv.php";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// update display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayMsg = "Proxy Grant removed successfully!";
		
		$ProxyUserID = "";
		
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
header("Location: if_UAaccesspriv.php?proxyuserid=$ProxyUserID&proxytype=$ProxyType&medpal=$medpal&msgTxt=$DisplayMsg");

?>
