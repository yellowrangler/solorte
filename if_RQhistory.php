<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_RQhistory.php';

require ('hysInit.php');

?>
<html>

<head>
<title>HealthYourSelf Request History</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />
<style type="text/css"> 

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

.tableTitlepos {
		position: absolute;
		left:20px;
		top:45px; 
		width:652px;
		height:20px;
		}		
		
.innerSelectframe {
		position: absolute;
		left:20px;
		top:65px; 
		width:650px;
		height:90px;
		background-color: white;
		border:1px solid black;
		}

.rightDetail {
		position: absolute;
		left:20px;
		top:210px; 
		width:650px;
		height:950px;
		background: #ccccff;
		border:0px solid black;
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

<div class="tableTitlepos">
<table width="100%" class="outerBorderTitleBlue">
	<tr>
		<td width="5%" align="center" height="10">Detail</td>
		<td width="5%" align="center" height="10"><a href="if_RQhistorylist.php?order=id"  class="linkTitletype" target="listFrame">ID</a></td>
		<td width="30%" align="center" height="10"><a href="if_RQhistorylist.php?order=status"  class="linkTitletype" target="listFrame">Status</a></td>
		<td width="15%" align="center" height="10"><a href="if_RQhistorylist.php?order=sdate"  class="linkTitletype" target="listFrame">Service Date</a></td>
		<td width="25%" align="center" height="10"><a href="if_RQhistorylist.php?order=request"  class="linkTitletype" target="listFrame">Description</a></td>
		<td width="20%" align="center" height="10"><a href="if_RQhistorylist.php?order=provider"  class="linkTitletype" target="listFrame">Provider</a></td>
	</tr>	
</table>
</div>
 
<IFRAME name="listFrame" src="if_RQhistorylist.php" class="innerSelectframe" scrolling=auto frameborder=0> </IFRAME>

<IFRAME name="detailFrame" src="if_RQhistoryempty.php" class="rightDetail" scrolling=auto frameborder=0 </IFRAME>
</body>
</html>
