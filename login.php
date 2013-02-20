<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'login.php';

$WhichHost = 3;

require ('hysSpook.php');

$DisplayClientType = 'M';
$DisplayPharmacyType = 'P';
$DisplayProviderType = 'D';
$DisplayUserProxyType = 'U';
$DisplayCustomerServiceType = 'C';

//---------------------------------------------------------------------------------------------------------- 
// Check for required fields
//----------------------------------------------------------------------------------------------------------
if ( (!isset($_POST[userid])) || (!isset($_POST[password])) )
{
	$errmsg = "Empty field $_POST[userid] $_POST[password]";
	$location ="Location: invalidlogin.php";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------
// function to set host variables for connection
//----------------------------------------------------------------------------------------------------------
function setHostVariables($HostID, &$host, &$user, &$password)
{
	switch ($HostID)
	{
		case 1:
			$host = "localhost";
			$user = "server";
			$password = "server";
			break;
			
		case 2:
			$host = "localhost";
			$user = "hysuser";
			$password = "pearl";
			
		case 3:
			$host = "localhost";
			$user = "root";
			$password = "tarryc";
			break;
			
		case 4:
			$host = "localhost";
			$user = "root";
			$password = "tarryc";
			break;		
	}			
}  // end of func

//----------------------------------------------------------------------------------------------------------
// LogErr funtion -- gets cur date time then writes errmsg to file.  Then displays msg to user. Then exit.
//----------------------------------------------------------------------------------------------------------
function LogErr($shortmsg, $errmsg, $location, $module, $severity){
   
	$time = time();
	$strDateTime = date("Y-m-d H:i:s", $time);
   
	$logname="logs/errlog.log";
	$fp = fopen($logname, "a") or die("could not open errlog.log");
	$logmsg = "$strDateTime : $severity : $errmsg : $module\n";
	fwrite($fp, $logmsg);
	fclose($fp);
	
	if ($severity > 0)
	{
		//-------------------------------------
		// Do Alert
		//-------------------------------------
		$tmpMsg = "alert(\"".$shortmsg."\");";
	}
	else
	{
		//-------------------------------------
		// Do Status Bar
		//-------------------------------------
		$tmpMsg = "window.status = \"".$shortmsg."\";";
	}	
	
	$_SESSION[LogMsg] = $tmpMsg;
	
	if ($location != "")
	{
		header($location);
		exit;
	}
	
} // end of LogErre func

//----------------------------------------------------------------------------------------------------------
// function to set host variables for connection
//----------------------------------------------------------------------------------------------------------
function AccessLogAdd($Action, $Result, $module, $location, $conn)
{
	$time = time();
	$strDateTime = date("Y-m-d H:i:s", $time);
	
	$sql = "INSERT INTO AccessLogTBL 
				(DateTimeStamp, UserID, MEDPAL, Module, Activity, Result)  
				VALUES ('$strDateTime', '$_SESSION[UserID]', '$_SESSION[Medpal]', '$module', '$Action', '$Result')";
				
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query insert AccessLogTBL (1000)";
					
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
		
}  // end of func AccessLogAdd

//----------------------------------------------------------------------------------------------------------
// open mysql connection for solorte
//----------------------------------------------------------------------------------------------------------
setHostVariables($WhichHost, $host, $user, $password);

$conn = mysql_connect($host, $user, $password);
if (!$conn) 
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr -  Error doing mysql_select_db for ClientInfoDB (82a) - '$_POST[userid]'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "Location: hysmain.php";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------
// pick the database to use
//----------------------------------------------------------------------------------------------------------
if (!mysql_select_db("ClientInfoDB", $conn)) 
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr -  Error doing mysql_connect (81) - '$_POST[userid]'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "Location: hysmain.php";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

//----------------------------------------------------------------------------------------------------------
// The way our authentication works is that the user id is comprised of a one byte type identifier
// and a 'n' byte id.  We need to break the userid from the type so that we can set the type in our
// session variable.  All Authorizations are based on a type / leve comination. 
//----------------------------------------------------------------------------------------------------------

$userTypeID = ltrim(strtoupper($_POST[userid]));
$userType = $userTypeID[0];
$userTypeID[0] = ' ';
$userID = ltrim($userTypeID);

//----------------------------------------------------------------------------------------------------------
// We see if the user id is valid
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT USERID, Pword, TypeID
	 from AuthenticationTBL 
	 	where USERID = '$userID' and TypeID = '$userType'";
		
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for AutenticationTBL (83) - '$_POST[userid]' userType = '$userType' userID = '$userID' ";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "Location: hysmain.php";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

// make sure only 1 row was returned.  More then 1 means big problem - less then 1 means user not on file
$num_rows = mysql_num_rows($sql_result);
if ($num_rows != 1)
{
	$errmsg = "User id not found  = '$num_rows' - '$_POST[userid]'  userType = '$userType' userID = '$userID' num_rows = '$num_rows' ";
	$shortmsg = "Invalid User ID.";
	$location = "Location: hysmain.php";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// get the password from our db and check it against what was entered
$result_arr = mysql_fetch_assoc($sql_result);

$pwCheck = spookEStr($_POST[password]);

if (strcmp($result_arr[Pword], $pwCheck) != 0)
{
	$errmsg = "Invalid Password - '$_POST[userid]' '$result_arr[Pword]', '$pwCheck'";
	$shortmsg = "Invalid Password.";
	$location = "Location: hysmain.php";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------
// Now we need to find this users Autherization Information
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT USERID, MEDPAL, Level
	 from AuthorizationTBL 
		where USERID = '$userID' and TypeID = '$userType'";
		
if (!$sql_result = mysql_query($sql, $conn))
{
	$errmsg = "$sqlerr - Error doing mysql_query for AuthorizationTBL (83) - '$_POST[userid]'  userType = '$userType' userID = '$userID' ";
	$shortmsg = "Authorization Denied.";
	$location = "Location: hysmain.php";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);	
}

$num_rows = mysql_num_rows($sql_result);
switch ($userType)
{
	case $DisplayCustomerServiceType:
		$num_rows = 2;
		break;
		
	case $DisplayClientType:
		if ($num_rows < 1)
		{
			$errmsg = "User id not found (Client Type) AuthorizationTBL = '$num_rows' - '$_POST[userid]'";
			$shortmsg = "Authorization Denied.";
			$location = "Location: hysmain.php";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);	
		}
		break;
	
	case $DisplayPharmacyType:
		if ($num_rows < 1)
		{
			$errmsg = "User id not found (Pharmacy Type) AuthorizationTBL = '$num_rows' - '$_POST[userid]'";
			$shortmsg = "Authorization Denied.";
			$location = "Location: hysmain.php";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);	
		}
		
		$num_rows = 2;
		break;
		
	case $DisplayProviderType:
		if ($num_rows < 1)
		{	$errmsg = "User id not found (Provider Type)  AuthorizationTBL = '$num_rows' - '$_POST[userid]'";
			$shortmsg = "Authorization Denied.";
			$location = "Location: hysmain.php";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		$num_rows = 2;
		break;
		
	case $DisplayUserProxyType:
		if ($num_rows < 1)
		{
			$errmsg = "User id not found(User Type) AuthorizationTBL = '$num_rows' - '$_POST[userid]'";
			$shortmsg = "Authorization Denied.";
			$location = "Location: hysmain.php";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		break;
} //End of switch

// Start session 
session_start();

//----------------------------------------------------------------------------------------------------------
// If we are here then we have not errored out.  So lets process results.
//----------------------------------------------------------------------------------------------------------
$result_arr = mysql_fetch_assoc($sql_result);

if ($num_rows > 1)
{
	$_SESSION[MedpalList] = "Y";
	$_SESSION[Medpal] = "";
	$_SESSION[UserID] = $userID;
	$_SESSION[AuthLevel] = "";
	$_SESSION[UserType] = "$userType";
	
	$NextPage = "Location: hysmedpalSelect.php";
}
else
{
	if ($num_rows == 1)
	{
		switch ($userType)
		{
			case $DisplayClientType:
				$_SESSION[MedpalList] = "N";
				$_SESSION[Medpal] = $result_arr[MEDPAL];
				$_SESSION[UserID] = $userID;
				$_SESSION[AuthLevel] = $result_arr[Level];
				$_SESSION[UserType] = "$userType";
				
				//----------------------------------------------------------------------------------------------------------
				// Write to Access Log Table
				//----------------------------------------------------------------------------------------------------------
				AccessLogAdd("Login", "Ok", $module, "", $conn);
				
				$NextPage = "Location: hyscusthome.php";
				break;
				
			case $DisplayUserProxyType:
				$_SESSION[MedpalList] = "N";
				$_SESSION[Medpal] = $result_arr[MEDPAL];
				$_SESSION[UserID] = $userID;
				$_SESSION[AuthLevel] = $result_arr[Level];
				$_SESSION[UserType] = "$userType";
				
				//----------------------------------------------------------------------------------------------------------
				// Write to Access Log Table
				//----------------------------------------------------------------------------------------------------------
				AccessLogAdd("Login", "Ok", $module, "", $conn);
				
				$NextPage = "Location: hyscusthome.php";
				break;
			
			default:
				break;
				
		}
	}	
	else
	{
		$errmsg = "User id not Valid  = '$num_rows' - '$_POST[userid]'";
		$shortmsg = "Authorization Denied.";
		$location = "Location: hysmain.php";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
			
}

$_SESSION[WhichHost] = $WhichHost;
// This should be changed to db call of preferences
$_SESSION[ShowThumbNails] = 'N';

// Move to next page
header($NextPage);

?>
