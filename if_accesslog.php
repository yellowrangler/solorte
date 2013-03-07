<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_accesslog.php';

require ('hysInit.php');

?>
<html>

<head>
<title>HealthYourSelf Access Log</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />
<style type="text/css"> 


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
		height:500px;
		background-color: white;
		border:1px solid black;
		}
		
.buttonPos {
		position: absolute;
		left:20px;
		top:575px; 
		width:650px;
		height:20px;
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
	<?php print $JavaScriptLogMsg; ?>
		
	<?php print $JavaScriptMsg; ?>
}
</script>
</head>

<body <?php print $BodySelectColor ?> onload="startUp()">

<div class="tablePos">
<table width="100%"  class="outerBorderTitleBlue">
	<tr>
		 <td width="15%" align="center"><a href="if_accessloglist.php?order=adate" class="linkTitletype" target="accesslogFrame"> Date</a></td>
		 <td width="15%" align="center"><a href="if_accessloglist.php?order=adate" class="linkTitletype" target="accesslogFrame">Time</a></td>
		 <td width="20%" align="center">Name</td>
		 <td width="20%" align="center"><a href="if_accessloglist.php?order=atype" class="linkTitletype" target="accesslogFrame">Type</a></td>
		 <td width="30%" align="center"><a href="if_accessloglist.php?order=adesc" class="linkTitletype" target="accesslogFrame">Description</a></td>
	</tr>	
</table>
</div>
 
<IFRAME name="accesslogFrame" src="if_accessloglist.php" scrolling=yes frameborder=0 class="innerSelectframe"></IFRAME>

<form class="buttonPos" action="accesslogdelete.php" target="mainFrame" method=post> 
<center><input type=submit NAME="DeleteLog" VALUE="Clear Log"></center>
</form>
</div>

</body>
</html>
