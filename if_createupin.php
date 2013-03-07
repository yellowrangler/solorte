<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_createupin.php';

require ('hysInitAdmin.php');;

require ('hysDBinit.php');

?>
<html>

<head>
<title>HealthYourSelf Manage Account Information</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />
<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>
<script type="text/javascript">
function startUp() 
{	
	<?php print $JavaScriptLogMsg; ?>
		
	<?php print $JavaScriptMsg; ?>
}
</script>
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

.tableTitleEDTest {
		position: absolute;
		left:152px;
		top:50px;
		width:450px;
		height:130px;
		background:white;
		border-top:0px solid #006633;
		border-left:1px solid #006633;
		border-right:1px solid #006633;
		border-bottom:1px solid #006633;
		}	

.tableTitleEDInfo {
		position: absolute;
		left:20px;
		top:300px;
		width:755px;
		height:75px;
		background:white;
		border-top:0px solid #006633;
		border-left:1px solid #006633;
		border-right:1px solid #006633;
		border-bottom:1px solid #006633;
		}	
.detailPara {
		padding-left: 10px;
		padding-right: 10px;
		}			
			
.outerBorderTitleGreenLetterSpace {
		color: white;
		font: 700 11px Arial,Helvetica;
		text-align: center;
		border-top:1px solid #006633;
		border-left:1px solid #006633;
		border-right:1px solid #006633;
		border-bottom:1px solid #006633;
		background: #006633;
		}			
</style>
</head>

<body onload="startUp()">

<div class="selectedContent">
<form  action="createupin.php" method=post>
<div class="tableTitleEDTest">
<table width="100%" cellspacing=0 class="outerBorderTitleGreenLetterSpace">
	<tr>
		<td align="center"><b>Create UPIN Table</b></td>
	</tr>	
</table>
<table width="100%">
	<tr>
		 <td height=10 colspan=2 align=center>&nbsp;</td>
	</tr>	
	<tr>
		<td align=right height=35>File to use to Create UPIN Table:</td>
		<td align=left><input size=30 maxlength=50 type="text" name="upinfile" value=""> </td>
	</tr>
	<tr>
		<td align=right height=35>Records per file:</td>
		<td align=left><input size=10 maxlength=10 type="text" name="filenbr" value=""> </td>
	</tr>
</table>
<input type="hidden" name="dummy" value="">		
<br><center>
<table  border=0 width="100%">
	<tr>
		<td align=center><input type=submit size=150 NAME="SUBMIT" VALUE="Submit"></td>
	</tr>
</table>
</center>		
</form>
</div>

<div class="tableTitleEDInfo">
<table width="100%" cellspacing=0 class="outerBorderTitleGreenLetterSpace">
	<tr>
		<td align="center"><b>What this is for</b></td>
	</tr>	
</table>
<p class="detailPara">Use this to add providers to UPIN table. This does an insert so table must be empty.</p>
</div>
</body>

</html>
