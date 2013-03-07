<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_mysqldump.php';

require ('hysInit.php');

$FileName = "MySQLDump.sql"; 

?>
<html>
<head>
<title>HealthYourSelf Manage mysql dump Information</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css">
.selectedContent {
		position: absolute;
		left:0px;
		top:0px;
		width:1001px;
		height:801px;
		border-top:0px #ccccff;
		border-right:0px solid black;
		border-left:0px solid black;
		border-bottom:0px solid black;
		background: #ccccff;
		}
		
.smallTableTitle   { 
		height:15px;
		color: white;
		font: 700 11px Arial, Geneva;
		background: #052faf;;
		}
		
.fileContentsPos {
		position: absolute;
		left:20px;
		top:50px; 
		width:772;
		height:15px;
		background: white;
		border:0px solid black;
		}
		
.innerframe {
		position: absolute;
		font: 200 8px Verdana, Geneva;
		left:20px;
		top:65px; 
		width:770;
		height:600px;
		background: springgreen;
		border:1px solid black;
		}
		
.buttonPos {
		position: absolute;
		left:20px;
		top:700px; 
		width:772px;
		height:20px;
		border:0px solid black;
		}
		
.SmTxt   { 
		font: 400 11px Arial, Geneva;
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

<body onload="startUp()"> 
<div class="selectedContent">
<div class="fileContentsPos">
<form  action="mysqldump.php" method=post>
<table width="100%" class="smallTableTitle">
	<tr>
		 <td height=15 align="center">MySQL DB Utility</td>
	</tr>	
</table>
</div>
<IFRAME name="dumpFrame" src="<?php print $FileName; ?>" class="innerframe" scrolling=auto frameborder=0> </IFRAME>

<div class="buttonPos">
<center>
<table class="SmTxt" border=0 cellspacing=0 cellpadding=0>
	<tr>
		<td>&nbsp;</td>
		<td align=center  height=15><input type="submit" name="Action" value="Dump"></td> 
		<td>&nbsp;</td>
	</tr>
</table>
</center>	
</div>
<input type="hidden" name="filename" value="<?php print $FileName; ?>">
</form>
</div>
</body>
</html>
