<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_medprofile.php';

require ('hysInit.php');

?>
<html>

<head>
<title>HealthYourSelf Customer IntrMedical Info</title>

<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css">
.medProfileArea {
		position: absolute;
		left:20px;
		top:35px;
		width:650px;
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

<iframe name="detailFrame" src="if_medprofiledetail.php" scrolling="auto" frameborder="0" class="medProfileArea"> </iframe>

</body>
</html>
