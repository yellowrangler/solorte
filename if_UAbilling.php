<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_UAempty.php';

require ('hysInit.php');

?>
<html>

<head>
<title>HealthYourSelf Empty</title>

<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css">
.detailArea {
		position: absolute;
		left:20px;
		top:65px;
		width:650px;
		height:200px;
		border-top:1px solid black;
		border-right:1px solid black;
		border-left:1px solid black;
		border-bottom:1px solid black;
		background: white;
		}

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
<div class="detailArea">
<center>
<br><br>
<table>
	<tr>
		<td><img border=0 src="images/underconstr.gif"></td>
		<td width=10>&nbsp;</td>
		<td><b>This Service is currently under Construction.</b></td>
	</tr>
</table>
</center>	
</div>
</body>
</html>
