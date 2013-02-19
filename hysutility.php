<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'hysutility.php';
$selection = 'utility';

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
	<? print $JavaScriptLogMsg; ?> 
		
	<? print $JavaScriptMsg; ?>
}
</script>
<style type="text/css">

.tableTitleUtilityList {
		position: absolute;
		left:10px;
		top:50px; 
		width:132px;
		height:20px;
		}	
		
.innerleftList {
		position: absolute;
		left:10px;
		top:66px;
		width:130px;
		height:600px;
		background: white;
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
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

.rightcontent {
		position: absolute;
		left:175px;
		top:0px;
		width:799px;
		height:799px;
		background: #ccccff;
		border-top:0px #ccccff;
		border-right:0px #ccccff;
		border-left:0px #ccccff;
		border-bottom:0px #ccccff;
		}
			
</style>

</head>

<<body onload="startUp()">
<? require ('hysTopLegend.php'); ?>

<? require ('hysMainNavAdmin.php'); ?>

<div class="selectedContent">
 
<div class="tableTitleUtilityList">
<table width="100%" cellspacing=0 class="outerBorderTitleGreenLetterSpace">
	<tr>
		<td align="center"><b>Utility List</b></td>
	</tr>	
</table>
</div>

<IFRAME name="listFrame" src="if_utilitylist.php"  class="innerleftList" scrolling=yes></IFRAME>

<div align="center" >
<IFRAME name="mainFrame" src="if_utilityintro.php"  class="rightcontent" scrolling=no frameborder=0></IFRAME>
</div>

</div>

<? require ('hysFooter.php'); ?>

</body>

</html>
