<?php
//----------------------------------------------------------------------------------------------------------
// Check for status messages
//----------------------------------------------------------------------------------------------------------

if (isset($_GET[msgTxt]) && $_GET[msgTxt] != "")
{
	$JavaScriptMsg = "window.status = \"".$_GET[msgTxt]."\";";
}

if (isset($_SESSION[LogMsg]) && $_SESSION[LogMsg] != "")
{
	$JavaScriptLogMsg = $_SESSION[LogMsg];
	$_SESSION[LogMsg] = "";
}	

?>
