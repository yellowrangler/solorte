<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_prescript.php';

require ('hysInit.php');

?>
<html>

<head>
<title>HealthYourSelf Prescription list</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />
<style type="text/css"> 

.headerBorderGold {
		color:#23708e;
		font: 700 15px Arial,Helvetica;
		border-top:0px solid #d1b60c;
		border-left:0px solid #d1b60c;
		border-right:0px solid #d1b60c;
		border-bottom:2px solid #d1b60c;
		}		

.tablePos {
		position: absolute;
		left:20px;
		top:40px; 
		width:662px;
		height:20px;
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

.innerSelectframe {
		position: absolute;
		left:20px;
		top:60px; 
		width:660px;
		height:100px;
		background-color: white;
		border:1px solid black;
		}
		

.prescripNext2 {
		position: absolute;
		left:20px;
		top:225px; 
		width:650px;
		height:375px;
		background: white;
		border:1px solid black;
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

<div class="tablePos">
<table width="100%"  class="outerBorderTitleBlue">
	<tr>
		 <td width="10%" align="center">Select</td>
		 <td width="15%" align="center"><a href="if_presclist.php?order=rdate" class="linkTitletype" target="presclistFrame">Renew Date</a></td>
		 <td width="25%" align="center"><a href="if_presclist.php?order=med" class="linkTitletype" target="presclistFrame">Medication</a></td>
		 <td width="35%" align="center"><a href="if_presclist.php?order=provider" class="linkTitletype" target="presclistFrame">Prescribing Doctor</a></td>
		 <td width="15%" align="center"><a href="if_presclist.php?order=reorder" class="linkTitletype" target="presclistFrame">Re-order ID</a></td>
	</tr>	
</table>
</div>
 
<IFRAME name="presclistFrame" src="if_presclist.php" scrolling=auto frameborder=0 class="innerSelectframe"></IFRAME>
<iframe name="prescdetailFrame" src="if_prescempty.php" scrolling="auto" frameborder="0" class="prescripNext2"> </iframe>

</body>
</html>
