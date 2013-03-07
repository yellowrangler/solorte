<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'login.php';

$WhichHost = 4;

require ('hysSpook.php');

//---------------------------------------------------------------------------------------------------------- 
// Check for required fields
//----------------------------------------------------------------------------------------------------------
if ( (!isset($_POST[MP])) || (!isset($_POST[password])) )
{
	$errmsg = "Empty field $_POST[MP] $_POST[password]";
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
	$logmsg = "$strDateTime : $errmsg $module\n";
	fwrite($fp, $logmsg);
	fclose($fp);
	
	header($location);
	exit;
	
} // end of LogErre func

//----------------------------------------------------------------------------------------------------------
// function to set host variables for connection
//----------------------------------------------------------------------------------------------------------
function AccessLogAdd($Action, $Result, $module, $location, $conn)
{
	$time = time();
	$strDateTime = date("Y-m-d H:i:s", $time);
	
	$ActionCS = "Customer Support: ".$Action; 
	$sql = "INSERT INTO AccessLogTBL 
				(DateTimeStamp, UserID, MEDPAL, Module, Activity, Result)  
				VALUES ('$strDateTime', '$_SESSION[UserID]', '$_SESSION[Medpal]', '$module', '$ActionCS', '$Result')";
				
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
	$errmsg = "$sqlerr - Error doing mysql_connect (81) - '$_POST[MP]'";
	$location ="Location: invalidlogin.php";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------
// pick the database to use
//----------------------------------------------------------------------------------------------------------
if (!mysql_select_db("clientinfodb", $conn)) 
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_select_db for clientinfodb (82b) - '$_POST[MP]'";
	$location ="Location: invalidlogin.php";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

//----------------------------------------------------------------------------------------------------------
// create the SQL statement to build the cursor
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT * from AdminAuthTBL where ID = '$_POST[MP]'";
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for AdminAuthTBL (83) - '$_POST[MP]'";
	$location ="Location: invalidlogin.php";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

//This is a kludge - later we either scrap admin auth or add type id 
$userTypeID = 0;

//----------------------------------------------------------------------------------------------------------
// make sure only 1 row was returned.  More then 1 means big problem - less then 1 means user not on file
//----------------------------------------------------------------------------------------------------------
$num_rows = mysql_num_rows($sql_result);
if ($num_rows != 1)
{
	$errmsg = "User id not found  = '$num_rows' - '$_POST[MP]'";
	$location ="Location: invalidlogin.php";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------
// get the password from our db and check it against what was entered
//----------------------------------------------------------------------------------------------------------
$result_arr = mysql_fetch_assoc($sql_result);

$pwCheck = spookEStr($_POST[password]);

if (strcmp($result_arr[Pword], $pwCheck) != 0)
{
	$errmsg = "Invalid Password - '$_POST[MP]' '$result_arr[Pword]', '$_POST[password]'";
	$location ="Location: invalidlogin.php";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------
// start session and then add enformation to them
//----------------------------------------------------------------------------------------------------------
session_start();

$_SESSION[Medpal] = "";
$_SESSION[UserID] = "";
$_SESSION[UserType] = "$userTypeID";
$_SESSION[CustServID] = "$_POST[MP]";
$_SESSION[WhichHost] = $WhichHost;
$_SESSION[MedpalList] = "";
$_SESSION[AuthLevel] = "";

// Move to next page
header("Location: hysclient.php");

?>
