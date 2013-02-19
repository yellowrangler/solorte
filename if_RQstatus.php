<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_RQstatus.php';

require ('hysInit.php');

?>
<html>
<head>
<title>HealthYourSelf Prescription list</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />
<style type="text/css"> 
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

.tablelistTitlepos {
		position: absolute;
		left:20px;
		top:40px; 
		width:662px;
		height:20px;
		}		
		
.innerSelectframe {
		position: absolute;
		left:20px;
		top:60px; 
		width:660px;
		height:90px;
		background: white;
		border:1px solid black;
		}

.tabledetailTitlepos {
		position: absolute;
		left:20px;
		top:200px; 
		width:662px;
		height:20px;
		}		

.detailArea {
		position: absolute;
		left:20px;
		top:220px; 
		width:660px;
		height:230px;
		background: white;
		border:1px solid black;
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

<div class="tablelistTitlepos">
<table width="100%" class="outerBorderTitleBlue">
	<tr>
		<td width="5%" align="center" height="10">Detail</td>
		<td width="5%" align="center" height="10"><a href="if_RQstatuslist.php?order=id"  class="linkTitletype" target="listFrame">ID</a></td>
		<td width="30%" align="center" height="10"><a href="if_RQstatuslist.php?order=status"  class="linkTitletype" target="listFrame">Status</a></td>
		<td width="15%" align="center" height="10"><a href="if_RQstatuslist.php?order=sdate"  class="linkTitletype" target="listFrame">Service Date</a></td>
		<td width="25%" align="center" height="10"><a href="if_RQstatuslist.php?order=request"  class="linkTitletype" target="listFrame">Description</a></td>
		<td width="20%" align="center" height="10"><a href="if_RQstatuslist.php?order=provider"  class="linkTitletype" target="listFrame">Provider</a></td>
	</tr>	
</table>
</div>
 
<IFRAME name="listFrame" src="if_RQstatuslist.php" class="innerSelectframe" scrolling=auto frameborder=0> </IFRAME>

<div class="tabledetailTitlepos">
<table width="100%" class="outerBorderMessageTitleBlue">
	<tr>
		 <td height=20 align=center>Client Request Status Detail</td>
	</tr>	
</table>
</div>
<IFRAME name="detailFrame" src="if_RQstatusempty.php" class="detailArea" scrolling=auto frameborder=0 </IFRAME>
</body>
</html>

