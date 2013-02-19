<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_UAmedapp.php';

require ('hysInit.php');


?>
<html>

<head>
<title>HealthYourSelf Customer Information</title>

<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>

<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css"> 

.tableTitlepos {
		position: absolute;
		left:20px;
		top:20px; 
		width:662px;
		height:20px;
		}		
		
.innerSelectframe {
		position: absolute;
		left:20px;
		top:40px; 
		width:660px;
		height:90px;
		background-color: white;
		border:1px solid black;
		}

.buttonPos {
		position: absolute;
		left:20px;
		top:140px; 
		width:660px;
		height:13px;
		border:0px solid black;
		}
		
.detailFrame {
		position: absolute;
		left:20px;
		top:185px; 
		width:670px;
		height:750px;
		background: #ccccff;
		border:0px solid black;
		}		

.outerBorderTitleBlue {
		color: white;
		font: 700 13px Arial,Helvetica;
		text-align: center;
		border-top:1px solid #052faf;
		border-left:1px solid #052faf;
		border-right:1px solid #052faf;
		border-bottom:1px solid #052faf;
		background: #052faf;	
		}			

.linkTitletype {
		color: white;
		font: 700 13px Arial,Helvetica;
		text-align: center;
		text-decoration: none;
		}			

.linkTitletype:hover {
		color: yellow;
		font: 700 13px Arial,Helvetica;
		text-align: center;
		text-decoration: underline;
		}

.outerBorderMessageTitleBlue {
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
		
.SmTxt   { 
		font: 400 13px Arial, Geneva;
		}		
</style>

<script type="text/javascript">
function startUp() 
{	
	<? print $JavaScriptLogMsg; ?> 
		
	<? print $JavaScriptMsg; ?>
}
</script>
  
</head>

<body <? print $BodySelectColor ?> onload="startUp()">

<div class="tableTitlepos">
<table width="100%"  class="outerBorderTitleBlue">
	<tr>
		 <td width="10%" height=20 align="center">&nbsp;</td>
		 <td width="15%" align="center"><a href="if_UAmedapplist.php?order=sdate" class="linkTitletype" target="listFrame">Date</a></td>
		 <td width="15%" align="center"><a href="if_UAmedapplist.php?order=stime" class="linkTitletype" target="listFrame">Time</a></td>
		 <td width="25%" align="center"><a href="if_UAmedapplist.php?order=provider" class="linkTitletype" target="listFrame">Provider</a></td>
		 <td width="35%" align="center"><a href="if_UAmedapplist.php?order=appointment"  class="linkTitletype" target="listFrame">Description</a></td>
	</tr>	
</table>
</div>
 
<IFRAME name="listFrame" src="if_UAmedapplist.php" scrolling=auto frameborder=0 class="innerSelectframe"></IFRAME>

<form class="buttonPos" action="if_UAmedapplist.php" target="listFrame" method=post> 
<center><input type=submit NAME="RefreshList" VALUE="Refresh List"></center>
</form>
 
<IFRAME name="detailFrame" src="if_UAmedappdetail.php"  class="detailFrame" scrolling=auto frameborder=0> </IFRAME>

</body>
</html>
