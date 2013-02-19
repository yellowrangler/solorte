<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'hyslogoffAdmin.php';

require ('hysInitAdmin.php');

//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'hyslogoff.php';
$selection = 'logoff';

//----------------------------------------------------------------------------------------------------------
// Destroy session variables
//----------------------------------------------------------------------------------------------------------
session_unset();
 
session_destroy();

// setcookie( session_name() ,"",0,"/");

?>
<html>
<head>
<title>Logoff</title>

<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>
<script type="text/javascript">
function startUp() 
{	
	<? print $JavaScriptLogMsg; ?> 
		
	<? print $JavaScriptMsg; ?>
}
</script>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css">

.mainBar {
		position: absolute;
		left:3px;
		top:32px;
		height:5px;
		border-top:3px solid #008080;
		border-right:1px solid white;
		border-left:1px solid white;
		background:#fff;
		}

.middlecontent {
		position: absolute;
		left:10px;
		top:70px;
		height:1000px;
		background-color: white;
		border:1px solid white;
		}
				
.outerBorderTitle {
		color: black;
		font: 700 15px Arial,Helvetica;
		text-align: left;
		border-top:0px solid #C6D7C6;
		border-left:1px solid #C6D7C6;
		border-right:1px solid #C6D7C6;
		border-bottom:0px solid #C6D7C6;
		background: #C6D7C6;
}					 

</style>
		
</head>

<body onload="startUp()">

<div id="banner" class="banner">
<table width="100%" border=0 cellspacing=0 cellpadding=0>
	<tr>
      <td width="30%" align="left"><img border="0" src="images/healthyourselflogo.JPG"></td>
      <td width="15%" align="right" class="smallTextLegend"><a href="hysmain.php">Logon</a></td>
	  <td width="15%" align="right" class="smallTextLegend"><a href="#" OnClick="printDoc()">Print this Page</a></td>
      <td width="15%" align="right" class="smallTextLegend"><a href="#" onClick="(PopUpWindow('puhelp.php?selection=".$selection."', 'r', 3))">Help</a></td>
	  <td width="20%" align="right" class="smallTextLegend"><? print currDate(); ?></td>
  </tr>
</table>
</div>


<!-- thin bar -->
<div align="left">
<table class="mainBar" width="100%">
  <tr>
    <td></td>
  </tr>
</table>
</div>  

<!-- This is the beginning of main display -->
<div id="middlecontent" class="middlecontent">

<br>

<table border="0" width="100%">  
  	<tr>
    	<td align="center"><h2>Please remember to keep all Client Information Confidential!</h2></td>
	</tr>
	<tr>
    	<td align="center"><h2>Have a nice Day!</h2></td>
	</tr>
</table>		

<br><br>

<table width = "100%" border="0">  
  <tr>
    <td width="10%" align="left">&nbsp;</td>
    <td width="70%" align="left" class="outerBorderTitle"><b>You are now logged out.</b></td>
    <td width="20%" align="left">&nbsp;</td>
		</tr>
</table>

<table width = "100%" border="0"> 	
   <tr>
    <td width="10%" align="left">&nbsp;</td>
    <td width="70%" align="left">We recommend that you close your Web browser when you have finished your online session. The medical information screens that you just viewed will remain in your browser's memory until the browser is closed.</td>
    <td width="20%" align="left">&nbsp;</td>
		</tr>
</table>
<br><br>		
<table width = "100%" border="0"> 		
	<tr>
		<td width="10%" align="left">&nbsp;</td>
		<td width="70%" align="left" class="outerBorderTitle"><b>PIN Security Reminder</b></td>
		<td width="20%" align="left">&nbsp;</td>
  	</tr>
  	<tr>
		<td width="10%" align="left">&nbsp;</td>
		<td width="70%" align="left">Please treat your PIN as confidential, and protect it as you would protect your bank ATM PIN. As a security measure, we recommend that you periodically change your PIN.</td>
		<td width="20%" align="left">&nbsp;</td>
  	</tr>
</table>

</div>

<? require ('hysFooter.php'); ?>

</body>

</html>
