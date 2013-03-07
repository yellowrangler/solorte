<?php
//---------------------------------------------------------------------------------------------------------
// Set Global Constants
//---------------------------------------------------------------------------------------------------------
$BodySelectColor = "bgcolor=#ccccff";   // Select Background Color

$DisplayClientType = 'M';
$DisplayPharmacyType = 'P';
$DisplayProviderType = 'D';
$DisplayUserProxyType = 'U';
$DisplayCustomerServiceType = 'C';

//----------------------------------------------------------------------------------------------------------
// get current date for display
//----------------------------------------------------------------------------------------------------------
function currDate() 
{
   $time = time();
   return(date("F j, Y", $time));
} // end of currDate func

require ('hysSpook.php');

//----------------------------------------------------------------------------------------------------------
// LogErr funtion -- gets cur date time then writes errmsg to file.  Then displays msg to user. 
//----------------------------------------------------------------------------------------------------------
function LogErr($shortmsg, $errmsg, $location, $module, $severity)
{
   
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
// LogErrSevere funtion -- gets cur date time then writes errmsg to file. Then terminates session. 
//----------------------------------------------------------------------------------------------------------
function LogErrSevere($errmsg, $module) 
{
	$time = time();
	$strDateTime = date("Y-m-d H:i:s", $time);
   
	$logname="logs/errlog.log";
	$fp = fopen($logname, "a") or die("could not open errlog.log");
	$logmsg = "$strDateTime : SEVERE : $errmsg $module\n";
	fwrite($fp, $logmsg);
	fclose($fp);
	
	exit;
	
} // end of LogErre func

//----------------------------------------------------------------------------------------------------------
// function to set host variables for connection
//----------------------------------------------------------------------------------------------------------
function AccessLogAdd($Action, $Result, $module, $location, $conn)
{
	$time = time();
	$strDateTime = date("Y-m-d H:i:s", $time);
	
	$sql = "INSERT INTO AccessLogTBL 
				(DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result)  
				VALUES ('$strDateTime', '$_SESSION[UserID]', '$_SESSION[UserType]', 
				'$_SESSION[Medpal]', '$module', '$Action', '$Result')";
				
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query insert AccessLogTBL (1000)";
					
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	
		
}  // end of func AccessLogAdd

//----------------------------------------------------------------------------------------------------------
// function to toggle thumbnail show value
//----------------------------------------------------------------------------------------------------------
function ToggleThumbNailValue()
{
	if ($_SESSION[ShowThumbNails] == 'N')
	{
		$_SESSION[ShowThumbNails] = 'Y';
		$ShowThumbNails = 'Y';
	}
	else
	{
		$_SESSION[ShowThumbNails] = 'N';
		$ShowThumbNails = 'N';
	}
	
	return $ShowThumbNails;
	
}  // end of func ToggleThumbNailValue


//----------------------------------------------------------------------------------------------------------
// first we make sure the cookie has been set
//----------------------------------------------------------------------------------------------------------
session_start();

if (!isset($_SESSION['UserID']) || ($_SESSION['UserID'] == "") )
{
	$errmsg = "Error - Userid cookie not set corretly (92). Userid = '$_SESSION[UserID]'";
	$location = "Location: invalidcookie.php";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
} 
else
{
	if ($_SESSION['UserType'] != $DisplayCustomerServiceType)
	{
		$errmsg = "Error - auth cookie not set corretly. Wrong type (93) UserType = '$_SESSION[UserType]'";
		$location = "Location: invalidcookie.php";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
} 


//----------------------------------------------------------------------------------------------------------
// now we parse out the vales
//----------------------------------------------------------------------------------------------------------
if (!isset($_SESSION['Medpal']) || ($_SESSION['Medpal'] == "") ) 
{
	$msg = "Must select client for this fucntion!";
	$location = "Location: hysclient.php?msg=$msg";
	header($location);
} 

//---------------------------------------------------------------------------------------------------------
// Set Global Variables 
//---------------------------------------------------------------------------------------------------------
$Medpal = $_SESSION[Medpal];
$WhichHost = $_SESSION[WhichHost];
$UserID = $_SESSION[UserID];
$UserType = $_SESSION[UserType]; 
$AuthorizationLevel = $_SESSION[AuthLevel];
$MedpalList = $_SESSION[MedpalList];
$ShowThumbNails = $_SESSION[ShowThumbNails];
?>
