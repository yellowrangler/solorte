<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_RQuprequest.php';

require ('hysInit.php');


?>
<html>

<head>
<title>HealthYourSelf Prescription list</title>
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

.tableDetailtitlepos {
		position: absolute;
		left:20px;
		top:20px; 
		width:685px;
		height:20px;
		}		
		
.innerSelectframe {
		position: absolute;
		left:20px;
		top:40px; 
		width:683px;
		height:90px;
		background: white;
		border:1px solid black;
		}
			
.buttonPos {
		position: absolute;
		left:10px;
		top:140px; 
		width:660px;
		height:13px;
		font: 400 11px Arial, Geneva;
		border:0px solid black;
		}
			
			
.detailFrame {
		position: absolute;
		left:20px;
		top:185px; 
		width:690px;
		height:610px;
		background: #ccccff;
		border:0px solid black;
		}	
		
.SmTxt   { 
		font: 400 11px Arial, Geneva;
		line-height: 11px; 
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

<div class="tableDetailtitlepos">
<table width="100%" class="outerBorderTitleBlue">
	<tr>
		<td width="5%" align="center">&nbsp;</td>
		<td width="10" align="center"><a href="if_RQuprequestlist.php?order=id"  class="linkTitletype" target="listFrame">ID</a></td>
		<td width="25%" align="center"><a href="if_RQuprequestlist.php?order=status"  class="linkTitletype" target="listFrame">Status</a></td>
		<td width="15%" align="center"><a href="if_RQuprequestlist.php?order=sdate"  class="linkTitletype" target="listFrame">Service Date</a></td>
		<td width="20%" align="center"><a href="if_RQuprequestlist.php?order=request"  class="linkTitletype" target="listFrame">Description</a></td>
		<td width="20%" align="center"><a href="if_RQuprequestlist.php?order=provider"  class="linkTitletype" target="listFrame">Provider</a></td>
		<td width="5%" align="center">&nbsp;</td>
	</tr>	
</table>
</div>
 
<IFRAME name="listFrame" src="if_RQuprequestlist.php" class="innerSelectframe" scrolling=auto frameborder=0> </IFRAME>

<form class="buttonPos" action="if_RQuprequestlist.php" target="listFrame" method=post> 
<center><input type=submit NAME="RefreshList" VALUE="Refresh List"></center>
</form>
 
<IFRAME name="detailFrame" src="if_RQuprequestdetail.php"  class="detailFrame" scrolling=auto frameborder=0> </IFRAME>

</body>
</html>
