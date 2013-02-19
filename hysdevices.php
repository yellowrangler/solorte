<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'hysEmpty.php';
$selection = 'devices';

require ('hysInit.php');

require ('hysDBinit.php');

?>

<html>

<head>
<title>HealthYourSelf Manage Account Information</title>

<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css">

.leftLink   { 
		font: 700 13px Helvetica, Arial,Geneva;
		color: black; 
		line-height: 15px; 
		text-decoration: none;
		}
				
.leftLink:hover   { 
		color: blue;
		font: 700 13px Helvetica, Arial,Geneva;
		line-height: 15px; 
		text-decoration: underline;
		}

.leftLinkSelect   { 
		font: 700 13px Helvetica, Arial,Geneva;
		color: black; 
		line-height: 15px; 
		text-decoration: none;
		background-color:#99CC99;
		}
				
.leftLinkSelect:hover   { 
		color: black;
		font: 700 13px Helvetica, Arial,Geneva;
		line-height: 15px; 
		text-decoration: underline;
		background-color:#99CC99;
		}

.smallTextLink3 {
		font: 700  13px Arial, Geneva;
		color: black;
		line-height: 15px;
		text-decoration: none;
		}
		
.smallTextLink3:Hover {
		font: 700  13px Arial, Geneva;
		line-height: 15px;
		color: red;
		text-decoration: underline;
		}		
	
</style>

<script type="text/javascript">
function startUp() 
{	
	<? print $JavaScriptLogMsg; ?> 
		
	<? print $JavaScriptMsg; ?>
}

function changeCellClass(id) 
{
	var selArray = new Array('usb', 'palm',  'pocketpc');
	
	for (i = 0; i < selArray.length; i++)
	{
		var test = 'a'+ selArray[i];
		
		identity=document.getElementById('a' + selArray[i]);
		identity.className='leftLink';
		
		identity=document.getElementById('td' + selArray[i]);
		identity.className='leftLink';
	}	

	
	if (id > 0)
	{		
		identity=document.getElementById('a' + selArray[id - 1]);
		identity.className='leftLinkSelect';
		
		identity=document.getElementById('td' + selArray[id - 1]);
		identity.className='leftLinkSelect';		
	}	
	
}
</script>

</head>

<body onload="startUp()">

<? require ('hysTopLegend.php'); ?>

<? require ('hysMainNav.php'); ?>

<div class="selectedContent">
<div id="leftcontent" class="leftcontent">
<br><br>
<center>
<table width=230 class="outerBorderblackSelect" cellspacing=0 cellpadding=0>
	<tr> 
		<td valign="center" class="leftLink" align="left" height=25>&nbsp;</td>
  	</tr>
	<tr> 
		<td valign="center" class="leftLink" id="tdusb" align="center" height=25><a id="ausb" href="if_UAempty.php" onclick="changeCellClass(1)" target="mainFrame" class="leftLink">Download for USB</a></td>
  	</tr>
  	<tr> 
		<td valign="center" class="leftLink" id="tdpalm" align="center" height=25><a id="apalm" href="if_UAempty.php" onclick="changeCellClass(2)" target="mainFrame" class="leftLink">Download for Palm OS</a></td>
  	</tr>
	<tr> 
		<td valign="center" class="leftLink" id="tdpocketpc" align="center" height=25><a id="apocketpc" href="if_UAempty.php" onclick="changeCellClass(3)" target="mainFrame" class="leftLink">Download for Pocket PC</a></td>
	</tr>
	<tr> 
		<td valign="center" class="leftLink" align="center" height=25>&nbsp;</td>
  	</tr>
</table>
</center>
<br><br>
<? require ('hysNamePhoto.php'); ?>
</div>

<IFRAME name="mainFrame" src="if_deviceintro.php"  class="rightcontent" scrolling="no" frameborder="0"></IFRAME>
</div>
<? require ('hysFooter.php'); ?>

</body>

</html>
