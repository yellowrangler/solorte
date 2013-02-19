<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_probtrack.php';

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
		top:20px; 
		width:772px;
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
		top:40px; 
		width:770px;
		height:100px;
		background-color: white;
		border:1px solid black;
		}
		
.buttonPos {
		position: absolute;
		left:20px;
		top:150px; 
		width:770px;
		height:13px;
		border:0px solid black;
		}
		
.anchorPos {
		position: absolute;
		font: 700  13px Arial, Geneva;
		font-style: italic;
		line-height: 13px; 
		left:550px;
		top:150px; 
		width:220px;
		height:13px;
		border:0px solid black;
		}
				
.probtrackDetail {
		position: absolute;
		left:20px;
		top:200px; 
		width:780px;
		height:600px;
		background: #ccccff;
		border:0px solid black;
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
		 <td width="5%" align="center">&nbsp;</td>
		 <td width="15%" align="center"><a href="if_probtracklist.php?order=bugid" class="linkTitletype" target="listFrame">ID</a></td>
		 <td width="15%" align="center">Name</td>
		 <td width="15%" align="center"><a href="if_probtracklist.php?order=area" class="linkTitletype" target="listFrame">Area</a></td>
		 <td width="20%" align="center"><a href="if_probtracklist.php?order=browser" class="linkTitletype" target="listFrame">Browser</a></td>
		 <td width="15%" align="center"><a href="if_probtracklist.php?order=severity" class="linkTitletype" target="listFrame">Severity</a></td>
		 <td width="15%" align="center"><a href="if_probtracklist.php?order=status" class="linkTitletype" target="listFrame">Status</a></td>
	</tr>	
</table>
</div>
 
<IFRAME name="listFrame" src="if_probtracklist.php" scrolling=auto frameborder=0 class="innerSelectframe"></IFRAME>

<form class="buttonPos" action="if_probtracklist.php" target="listFrame" method=post> 
<center><input type=submit NAME="RefreshList" VALUE="Refresh List"></center>
</form>

<a href="#" onClick="(PopUpWindow('puproblemtracking.php', 'r', 6))" class="anchorPos">Add Problem</a>

<iframe name="detailFrame" src="if_probtrackdetail.php" scrolling="auto" frameborder="0" class="probtrackDetail"> </iframe>

</body>
</html>
