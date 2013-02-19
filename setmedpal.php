<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'setmedpal.php';

$NoMedpalState = 'Y';

require ('hysInit.php');

require ('hysDBinit.php');

//----------------------------------------------------------------------------------------------------------
// Make sure we were passed in medpal
//----------------------------------------------------------------------------------------------------------
if ( !isset($_GET[medpal]) || ($_GET[medpal] == "") )
{
	$errmsg = "Medpal was not passed not found  = '$num_rows' UID - '$UserID'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

switch ($UserType)
{
	case $DisplayCustomerServiceType:
		//----------------------------------------------------------------------------------------------------------
		// DisplayCustomerServiceType needs no authorization beyond being cust service
		//----------------------------------------------------------------------------------------------------------
		
		$NextPage = "Location: hysclient.php";
		break;
		
	case $DisplayClientType:
		//----------------------------------------------------------------------------------------------------------
		// DisplayClientType must have userid medpal type match 
		//----------------------------------------------------------------------------------------------------------	
		$sql = "SELECT USERID, MEDPAL, Level
			 from AuthorizationTBL 
				where USERID = '$UserID' and MEDPAL = '$_GET[medpal]' and TypeID = '$UserType'";
				
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for AuthorizationTBL (83) - '$UserID'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		// make sure only 1 row returned. 
		$num_rows = mysql_num_rows($sql_result);
		if ($num_rows != 1)
		{
			$errmsg = "User id Medpal combination invalid. Row not = 1. rows '$num_rows' - '$UserID'. Medpal = '$_GET[medpal]'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		$result_array  = mysql_fetch_assoc($sql_result);
		
		$NextPage = "Location: hyscusthome.php";
		break;
	
	case $DisplayPharmacyType:
		//----------------------------------------------------------------------------------------------------------
		// DisplayPharmacyType has it's own inherent restrictions.  It can be added to by level but not required
		//----------------------------------------------------------------------------------------------------------
		$sql = "SELECT USERID, MEDPAL, Level
			 from AuthorizationTBL 
				where USERID = '$UserID' and MEDPAL = '$_GET[medpal]' and TypeID = '$UserType'";
				
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for AuthorizationTBL (83) - '$UserID'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		// make sure only 1 row returned. 
		$num_rows = mysql_num_rows($sql_result);
		if ($num_rows > 0)
		{
			$result_array  = mysql_fetch_assoc($sql_result);
		}
		
		$NextPage = "Location: hyscusthome.php";
		break;
		
	case $DisplayProviderType:
		//----------------------------------------------------------------------------------------------------------
		// DisplayProviderType has it's own inherent restrictions.  It can be added to by level but not required
		//----------------------------------------------------------------------------------------------------------
		$sql = "SELECT USERID, MEDPAL, Level
			 from AuthorizationTBL 
				where USERID = '$UserID' and MEDPAL = '$_GET[medpal]' and TypeID = '$UserType'";
				
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for AuthorizationTBL (83) - '$UserID'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		// make sure only 1 row returned. 
		$num_rows = mysql_num_rows($sql_result);
		if ($num_rows > 0)
		{
			$result_array  = mysql_fetch_assoc($sql_result);
		}
		
		$NextPage = "Location: hyscusthome.php";
		break;
		
	case $DisplayUserProxyType:
		//----------------------------------------------------------------------------------------------------------
		// DisplayUserProxyType must have userid medpal type match 
		//----------------------------------------------------------------------------------------------------------	
		$sql = "SELECT USERID, MEDPAL, Level
			 from AuthorizationTBL 
				where USERID = '$UserID' and MEDPAL = '$_GET[medpal]' and TypeID = '$UserType'";
				
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for AuthorizationTBL (83) - '$UserID'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		 
		// make sure only 1 row returned. 
		$num_rows = mysql_num_rows($sql_result);
		if ($num_rows != 1)
		{
			$errmsg = "User id Medpal combination invalid. Row not = 1. rows '$num_rows' - '$UserID'. Medpal = '$_GET[medpal]'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		$result_array  = mysql_fetch_assoc($sql_result);
		
		$NextPage = "Location: hyscusthome.php";
		break;
		
} //End of switch

$_SESSION[MedpalList] = "Y";
$_SESSION[Medpal] = $_GET[medpal];
$_SESSION[AuthLevel] = $result_array[Level];

//----------------------------------------------------------------------------------------------------------
// Write to Access Log Table
//----------------------------------------------------------------------------------------------------------
AccessLogAdd("Choose Medpal from list", "Ok", $module, "", $conn);

// Move to next page
header($NextPage);

?>
