<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_medhistory.php';

require ('hysInit.php');

require ('hysDBinit.php');


?>
<html>
<head>
<title>HealthYourSelf Customer History</title>
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

.rightcontentUpperLeft {
		position: absolute;
		left:20px;
		top:40px;
		width:300px;
		height:150px;
		background: #ccccff;
		border:0px solid white;
		}
		
.rightcontentUpperRight {
		position: absolute;
		left:330px;
		top:40px;
		width:375px;
		height:150px;
		background: #ccccff;
		border:0px solid white;
		}
		
.tableDetailtitlepos {
		position: absolute;
		left:20px;
		top:135px; 
		width:685px;
		height:20px;
		}		
		
.innerSelectframe {
		position: absolute;
		left:20px;
		top:155px; 
		width:683px;
		height:90px;
		background: white;
		border:1px solid black;
		}
	
.detailFrame {
		position: absolute;
		left:20px;
		top:275px; 
		width:690px;
		height:500px;
		background: #ccccff;
		border:0px solid black;
		}

.outerBorderSMtxt {
		font: 400 10px Verdana, Arial, Helvetica;
		border-top:0px solid #008080;
		border-left:1px solid #008080;
		border-right:1px solid #008080;
		border-bottom:1px solid #008080;
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
<div class="rightcontentUpperLeft">
<form name="search" method="post" ACTION="if_medhistlist.php" target="listFrame">
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

<div class="rightcontentUpperRight">
<table width="100%" class="outerBorderTitleBlueLetterSpace">
	<tr>
		<td><b>What to do</b></td>
	</tr>
</table>
<table width="100%" class="outerBorderSMtxt">	
	<tr>
		<td class="smallText2">The <b>Search</b> will select medical history items based on the criteria you type in. Clicking on column titles will create sorts on those columns.  Click again and sort reverses.
		</td>
	</tr>	
</table>
</div>

<div class="tableDetailtitlepos">
<table width="100%" cellspacing=0 class="outerBorderTitleBlue">
	<tr>
		<td width="5%" align="center" height="20">&nbsp;</td>
		<td width="25%" align="center" height="20"><a href="if_medhistlist.php?order=type"  class="linkTitletype" target="listFrame">Type</a></td>
		<td width="15%" align="center"><a href="if_medhistlist.php?order=date"  class="linkTitletype" target="listFrame">Date</a></td>
		<td width="25%" align="center"><a href="if_medhistlist.php?order=event"  class="linkTitletype" target="listFrame">Description</a></td>
		<td width="25%" align="center"><a href="if_medhistlist.php?order=provider"  class="linkTitletype" target="listFrame">Provider</a></td>
		<td width="5%" align="center">&nbsp;</td>
	</tr>	
</table>
</div>
 
<IFRAME name="listFrame" src="if_medhistlist.php?eventid=<? print $DisplayEventID; ?>" class="innerSelectframe" scrolling=auto frameborder=0> </IFRAME>

<IFRAME name="detailFrame" src="if_medhistdetail.php?eventid=<? print $DisplayEventID; ?>" class="detailFrame" scrolling=auto frameborder=0> </IFRAME>

</body>
</html>
