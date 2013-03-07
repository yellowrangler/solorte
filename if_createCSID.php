<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_createCSID.php';

require ('hysInitAdmin.php');

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
		height:100px;
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
<div class="tableTitleEDTest">
<form  action="makecustservid.php" method=post>
<table width="100%" class="outerBorderTitleGreenLetterSpace">
	<tr>
		 <td height=20 align="center">Create Customer Service ID</td>
	</tr>	
</table>

<table width="100%" class="SmTxt">
	<tr>
		<td align=right colspan=4 height=15>&nbsp;</td>
	</tr>
	</tr>
		<tr>
		<td align=right>Customer Service ID:</td>
		<td align=left><input size=10  maxlength=10 type="text" name="custservid" value=""</td>
		
		<td align=right height=35>Password:</td>
		<td align=left><input size=10 maxlength=10 type="text" name="custservpass" value=""> </td>
	</tr>
</table>
<input type="hidden" name="Action" value="">	
<br><center>
<table>
	<tr>
		<td align=center><input type=submit size=150 NAME="SUBMIT" VALUE="Submit"></td>
		<td>&nbsp;</td>
		<td align=center><input type=reset size=150 NAME="RESET" VALUE="Reset"></td>
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
<p class="detailPara">Ok Ok.  You must be a big shot if you are here! You can add a Customer Service ID.  May the Force be with you..</p>
</div>
</body>

</html>
