<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_UAmedproffamhist.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysStatusMsg.php');

?>
<html>

<head>
<title>HealthYourSelf Customer Family History Info</title>

<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css">

.outerBorderMessageTitleBlue {
		position: absolute;
		left:20px;
		top:35px;
		width:650px;
		height:20px;
		color: white;
		font: 700 13px Arial,Helvetica;
		text-align: center;
		letter-spacing: 8px;
		border-top:1px solid #052faf;
		border-left:1px solid #052faf;
		border-right:1px solid #052faf;
		border-bottom:1px solid #052faf;
		background: #052faf;
		}				

.detailArea {
		position: absolute;
		left:20px;
		top:55px;
		width:648px;
		height:700px;
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
	<? print $JavaScriptLogMsg; ?> 
		
	<? print $JavaScriptMsg; ?>
}
</script>
</head>

<body <? print $BodySelectColor ?> onload="startUp()">

<table class="outerBorderMessageTitleBlue">
	<tr>
		<td align=center>Family History Profile</td>
	</tr>
</table>	
<iframe name="detailFrame" src="if_UAmedproffamhistdetail.php" scrolling="auto" frameborder="0" class="detailArea"> </iframe>

</body>
</html>
