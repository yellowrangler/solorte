<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'hyscusthome.php';
$selection = 'home';

require ('hysInit.php');

require ('hysDBinit.php');

?>
<html>

<head>
<title>HealthYourSelf Customer Information</title>

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


</style>

<script type="text/javascript">

function startUp() 
{
	changeCellClass(1);
	
	<?php print $JavaScriptLogMsg; ?>
}

function changeCellClass(id) 
{
	var selArray = new Array('apprescvidetail',  'medhist', 'scandoc', 'medinsure','profile', 'emrgcont', 'acclog');
	

	
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

<?php require ('hysTopLegend.php'); ?>

<?php require ('hysMainNav.php'); ?>

<div class="selectedContent">
<div id="leftcontent" class="leftcontent">
<br><br>
<center>
<table width=230 class="outerBorderblackSelect" cellspacing=0 cellpadding=0>
	<tr> 
		<td valign="center" class="leftLink" height=25>&nbsp;</td>
  	</tr>
	<tr> 
   		<td valign="center" class="leftLink" id="tdapprescvidetail" align="center" height=25><a id="aapprescvidetail" href="if_appprescvi.php" onclick="changeCellClass(1)" target="mainFrame" class="leftLink">Personal Calendar</a></td>
	</tr>
    <tr> 
   		<td valign="center" class="leftLink" id="tdmedhist" align="center" height=25><a id="amedhist" href="if_medhistory.php" onclick="changeCellClass(2)" target="mainFrame" class="leftLink">Medical History Events</a></td>
	</tr>
	 <tr> 
   		<td valign="center" class="leftLink" id="tdscandoc" align="center" height=25><a id="ascandoc" href="if_medhistoryDocScan.php" onclick="changeCellClass(3)" target="mainFrame" class="leftLink">Scanned Documents</a></td>
	</tr>
   	<tr> 
   		<td valign="center" class="leftLink" id="tdmedinsure" align="center" height=25><a id="amedinsure" href="if_medinsure.php" onclick="changeCellClass(4)" target="mainFrame" class="leftLink">Insurance Information</a></td>
	</tr>
   	<tr> 
		<td valign="center" class="leftLink" id="tdprofile" align="center" height=25><a id="aprofile" href="if_medprofile.php" onclick="changeCellClass(5)" target="mainFrame" class="leftLink">Medical Profile</a></td>
	</tr>	
	<tr> 
		<td valign="center" class="leftLink" id="tdemrgcont" align="center" height=25><a id="aemrgcont" href="if_medemrgcont.php" onclick="changeCellClass(6)" target="mainFrame" class="leftLink">Emergency Contacts</a></td>
	</tr>
	<tr> 
		<td valign="center" class="leftLink" id="tdacclog" align="center" height=25><a id="aacclog" href="if_accesslog.php" onclick="changeCellClass(7)" target="mainFrame" class="leftLink">Access Log</a></td>
	</tr>	
	<tr> 
		<td valign="center" class="leftLink" height=25>&nbsp;</td>
  	</tr>
</table>
</center>

<br><br>
 <?php require ('hysNamePhoto.php'); ?>
</div>

<div align="center">
<IFRAME name="mainFrame" src="if_appprescvi.php"  class="rightcontent" scrolling="no" frameborder="0"></IFRAME>
</div>
</div>

<?php require ('hysFooter.php'); ?>

</body>

</html>
