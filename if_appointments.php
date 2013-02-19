<html>

<head>
<title>HealthYourSelf Customer Appointment Calander</title>

<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>
<script type="text/javascript">
function startUp() 
{	
	<? print $JavaScriptLogMsg; ?> 
		
	<? print $JavaScriptMsg; ?>
}
</script>

</head>

<body onload="startUp()">
<div class="centerSelectServicePos">
<table border=0 width="100%">
	<tr>
		<td valign="bottom" align="left" class="selectServiceHdr">Medical Appointments</td>
	</tr>
</table>
</div>
<div>

<div class="headerBorderPos">
<table border=0 width="100%">
	<tr>
		<td valign="bottom" align="right" class="headerBorder"><i>Current Monthly Appointments</i></td>
	</tr>
</table>
<br>

</div>

<IFRAME name="leftFrame" src="if_calendar_app_august.php" width="300" height="300" scrolling="auto" frameborder="0" class="centercontentSplitLeft"> </IFRAME>
<IFRAME name="rightFrame" src="if_empty.php" width="300" height="300" scrolling="auto" frameborder="0" class="centercontentSplitRight"> </IFRAME>
 
<div class="centercontentNext2">
<table border=0 width="100%">
	<tr>
		<td valign="bottom" align="right" class="headerBorder"><i>Future Appointments - List</i></td>
	</tr>
</table>
<br><br>

<table width="100%" cellspacing=0 class="outerBorderTitleRed">
	<tr>
 		<td width="15%" align="center" height="10">Date</td>
		<td width="15%" align="center" height="10">Time</td>
		<td width="40%" align="center" height="10">Doctor</td>
	</tr>	
</table>
<table width="100%" cellspacing=0 class="outerBorderRed"><tr><td>  
   <tr>
    <td width="15%" align="center" height="17" class="tblDetailsmTextOff">08/22/2003</td>
    <td width="15%" align="center" height="17" class="tblDetailsmTextOff">12:00PM</td>
    <td width="40%" align="left" height="17" class="tblDetailsmTextOff">Physical</td>
    <td width="30%" align="left" height="17" class="tblDetailsmTextOff"><a href="#" onClick="(PopUpWindow('pudrlist.php', 'r', 3))" class="tblDetailsmTextLinkOff">Andrew Mason</a></td>
  </tr>
  <tr>
    <td width="15%" align="center" height="17" class="tblDetailsmTextOn">09/21/2003</td>
    <td width="15%" align="center" height="17" class="tblDetailsmTextOn">3:00PM</td>
    <td width="40%" align="left" height="17" class="tblDetailsmTextOn">Teeth Cleaning</td>
    <td width="30%" align="left" height="17" class="tblDetailsmTextOn"><a href="#" onClick="(PopUpWindow('pudrlist.php', 'r', 3))" class="tblDetailsmTextLinkOn">Robert Anderson</a></td>
  </tr>
  <tr>
    <td width="15%" align="center" height="17" class="tblDetailsmTextOff">08/22/2004</td>
    <td width="15%" align="center" height="17" class="tblDetailsmTextOff">12:00PM</td>
    <td width="40%" align="left" height="17" class="tblDetailsmTextOff">Physical</td>
    <td width="30%" align="left" height="17" class="tblDetailsmTextOff"><a href="#" onClick="(PopUpWindow('pudrlist.php', 'r', 3))"  class="tblDetailsmTextLinkOff">Andrew Mason</a></td>
  </tr>
  <tr>
    <td width="15%" align="center" height="17" class="tblDetailsmTextOn">08/22/2006</td>
    <td width="15%" align="center" height="17" class="tblDetailsmTextOn">8:00AM</td>
    <td width="40%" align="left" height="17" class="tblDetailsmTextOn">Colonoscophy</td>
    <td width="30%" align="left" height="17" class="tblDetailsmTextOn"><a href="#" onClick="(PopUpWindow('pudrlist.php', 'r', 3))"  class="tblDetailsmTextLinkOn">Jack Siene</a></td>
  </tr>
</table>
</div>
</body>
</html>
