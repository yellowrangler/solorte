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

if ($NoMedpalState != 'Y')
{
	if ( !isset($_SESSION[Medpal]) ||  ($_SESSION[Medpal] == "") ) 
	{
		$errmsg = "Error - auth session cookie not set (91)";
		$location = "Location: invalidcookie.php";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	} 
	
	$Medpal = $_SESSION[Medpal];
}

if (!isset($_SESSION['UserID']) || ($_SESSION['UserID'] == "") )
{
	$errmsg = "Error - Userid cookie not set corretly (92)";
	$location = "Location: invalidcookie.php";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
} 

//---------------------------------------------------------------------------------------------------------
// Set Global Variables 
//---------------------------------------------------------------------------------------------------------
$AuthorizationLevel = $_SESSION[AuthLevel];
$UserID = $_SESSION[UserID];
$MedpalList = $_SESSION[MedpalList];
$WhichHost = $_SESSION[WhichHost];       
$UserType = $_SESSION[UserType]; 
$ShowThumbNails = $_SESSION[ShowThumbNails];
?>
