<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_UAmedhist.php';

require ('hysInit.php');

?>
<html>
<head>
<title>HealthYourSelf Update Customer History</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css">

.outerBorderTitleBlue {
		color: white;
		font: 700 11px Arial,Helvetica;
		text-align: center;
		border-top:1px solid #052faf;
		border-left:1px solid #052faf;
		border-right:1px solid #052faf;
		border-bottom:1px solid #052faf;
		background: #052faf;
		}				
	
.outerBorderMessageTitleBlue {
		color: white;
		font: 700 11px Arial,Helvetica;
		text-align: center;
		letter-spacing: 8px;
		border-top:1px solid #052faf;
		border-left:1px solid #052faf;
		border-right:1px solid #052faf;
		border-bottom:1px solid #052faf;
		background: #052faf;
		}	
		
.outerBorderSMtxt {
		font: 400 10px Verdana, Arial, Helvetica;
		border-top:0px solid #008080;
		border-left:1px solid #008080;
		border-right:1px solid #008080;
		border-bottom:1px solid #008080;
		background: white;
		}
		
.linkTitletype {
		color: white;
		font: 700 11px Arial,Helvetica;
		text-align: center;
		text-decoration: none;
		}			

.linkTitletype:hover {
		color: yellow;
		font: 700 11px Arial,Helvetica;
		text-align: center;
		text-decoration: underline;
		}

.rightcontentUpperLeft {
		position: absolute;
		left:20px;
		top:20px;
		width:300px;
		height:65px;
		background: #ccccff;
		border:0px solid white;
		}
		
.tableDetailtitlepos {
		position: absolute;
		left:20px;
		top:95px; 
		width:685px;
		height:20px;
		}		
		
.innerSelectframe {
		position: absolute;
		left:20px;
		top:115px; 
		width:683px;
		height:90px;
		background-color: white;
		border:1px solid black;
		}
		
.buttonPos {
		position: absolute;
		left:20px;
		top:215px; 
		width:660px;
		height:25px;
		font: 400 11px Arial, Geneva;
		border:0px solid black;
		}
						
.detailFrame {
		position: absolute;
		left:20px;
		top:255px; 
		width:690px;
		height:545px;
		background: #ccccff;
		border:0px solid black;
		}	
		
.SmTxt   { 
		font: 400 13px Arial, Geneva;
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
<div class="rightcontentUpperLeft">
<form name="search" method="post" ACTION="if_UAmedhistlist.php" target="listFrame">
<!-- Second outer column of Search -->
<table width="100%" class="outerBorderTitleBlueLetterSpace">
	<tr>
		<td><b>Search</b></td>
	</tr>
</table>

<table width="100%" class="outerBorderSMtxt">
	<tr>
		<td align=right class="smallText2">Search:</td>
		<td><input type="text" name="Search" size="25" maxlength="255"></td> 
		<td><INPUT TYPE="IMAGE" SRC="images/go_global_search.gif" ALT="Submit button" border="0"></td>
	</tr>
</table>
<input type='hidden' name='selType'  value='search'>
</form>
</div>

<div class="tableDetailtitlepos">
<table width="100%" class="outerBorderTitleBlue">
	<tr>
		<td width="5%" align="center" height=15>&nbsp;</td>
		<td width="25%" align="center" height=15><a href="if_UAmedhistlist.php?order=type"  class="linkTitletype" target="listFrame">Type</a></td>
		<td width="15%" align="center" height=15><a href="if_UAmedhistlist.php?order=date"  class="linkTitletype" target="listFrame">Date</a></td>
		<td width="25%" align="center" height=15><a href="if_UAmedhistlist.php?order=event"  class="linkTitletype" target="listFrame">Description</a></td>
		<td width="20%" align="center" height=15><a href="if_UAmedhistlist.php?order=provider"  class="linkTitletype" target="listFrame">Provider</a></td>
		<td width="5%" align="center" height=15>&nbsp;</td>
	</tr>	
</table>
</div>
 
<IFRAME name="listFrame" src="if_UAmedhistlist.php" class="innerSelectframe" scrolling=auto frameborder=0> </IFRAME>

<form class="buttonPos" action="if_UAmedhistlist.php" target="listFrame" method=post> 
<center><input type=submit NAME="RefreshList" VALUE="Refresh List"></center>
</form>
 
<IFRAME name="detailFrame" src="if_UAmedhistdetail.php"  class="detailFrame" scrolling=auto frameborder=0> </IFRAME>

</body>
</html>
