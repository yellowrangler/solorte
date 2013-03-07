<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_updateintro.php';

require ('hysInit.php');
?>

<html>

<head>
<title>HealthYourSelf Customer Appointment Calander</title>

<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css">
		
</style>

<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>
<script type="text/javascript">
function startUp() 
{	
	<?php print $JavaScriptLogMsg; ?>
		
	<?php print $JavaScriptMsg; ?>
}
</script>
</head>

<body <?php print $BodySelectColor ?> onload="startUp()">
<br><br>
<table width="100%">	
	<tr>
		<td align="left" width="80%"><b>Here you can update your personel device with current medical information.  
		Please select from one of the items on the left.</b></td>  
	</tr>
	<tr>
		<td><img align="left" src="images/arrowleft.gif"></td>
	</tr>
	<tr>
		<td height=15>&nbsp;</td>
	</tr>
	<tr>
		<td>If you are unsure about what to do please select the <i>Help</i> link located at the top right of this screen.</b></td>
	</tr>	
</table>

</body>
</html>
