<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'hysupdate.php';
$selection = 'maintain';

require ('hysInit.php');

require ('hysDBinit.php');

?>
<html>

<head>
<title>HealthYourSelf Manage Account Information</title>

<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css">

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
	<? print $JavaScriptLogMsg; ?> 
		
	<? print $JavaScriptMsg; ?>
	
	changeCellClass(1);
}

function changeCellClass(id) 
{
	var selArray = new Array('medap', 'presc', 'medinsure', 'ext', 'social', 'family', 'name','addr', 'photo', 'bill','access', 'rules', 'emrgcont');

	
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
		<td valign="center" class="leftLink">&nbsp;</td>
  	</tr>
	<tr>
		<td valign="center" id="tdmedap" class="leftLink" align="center"  height=25><a id="amedap" href="if_UAmedapp.php" onclick="changeCellClass(1)" target="mainFrame" class="leftLink">Appointments</a></td>
  	</tr>
  	<tr> 
		<td valign="center" id="tdpresc" class="leftLink" align="center" align="right" height=25><a id="apresc" href="if_UApresc.php" onclick="changeCellClass(2)" target="mainFrame" class="leftLink">Prescriptions</a></td>
  	</tr>
    <tr>
  		<td valign="center" id="tdmedinsure" class="leftLink" align="center" align="right" height=25><a id="amedinsure" href="if_UAmedinsure.php" onclick="changeCellClass(3)" target="mainFrame" class="leftLink">Insurance Information</a></td>
	</tr>
   	<tr> 
  		<td valign="center" id="tdext" class="leftLink" align="center" align="right" height=25><a id="aext" href="if_UAmedprofExternal.php" onclick="changeCellClass(4)" target="mainFrame" class="leftLink">External Profile</a></td>
	</tr>
	<tr> 
  		<td valign="center" id="tdsocial" class="leftLink" align="center" align="right" height=25><a id="asocial" href="if_UAmedprofSocial.php" onclick="changeCellClass(5)" target="mainFrame" class="leftLink">Social Health Profile</a></td>
	</tr>
	<tr> 
  		<td valign="center" id="tdfamily" class="leftLink" align="center" align="right" height=25><a id="afamily" href="if_UAmedproffamhist.php" onclick="changeCellClass(6)" target="mainFrame" class="leftLink">Family History</a></td>
	</tr>
	<tr> 
		<td valign="center" id="tdname" class="leftLink" align="center" align="right" height=25><a id="aname" href="if_UAnameaddrName.php" onclick="changeCellClass(7);" target="mainFrame" class="leftLink">Client Name</a></td>
  	</tr>
	<tr> 
		<td valign="center" id="tdaddr" class="leftLink" align="center" align="right" height=25><a id="aaddr" href="if_UAnameaddrAddr.php" onclick="changeCellClass(8);" target="mainFrame" class="leftLink">Client Address</a></td>
  	</tr>
	<tr> 
		<td valign="center" id="tdphoto" class="leftLink" align="center" align="right" height=25><a id="aphoto" href="if_UAnameaddrPhoto.php" onclick="changeCellClass(9);" target="mainFrame" class="leftLink">Client Photo</a></td>
  	</tr>
  	<tr> 
		<td valign="center" id="tdbill" class="leftLink" align="center" align="right" height=25><a id="abill" href="if_UAempty.php" onclick="changeCellClass(10);" target="mainFrame" class="leftLink">Billing Information</a></td>
	</tr>
	<tr> 
  		<td valign="center" id="tdaccess" class="leftLink" align="center" align="right" height=25><a id="aaccess" href="if_UAaccesspriv.php" onclick="changeCellClass(11);" target="mainFrame" class="leftLink">Access Privileges</a></td>
	</tr>
	<tr> 
		<td valign="center" id="tdrules" class="leftLink" align="center" align="right" height=25><a id="arules" href="if_UArules.php" onclick="changeCellClass(12);" target="mainFrame" class="leftLink">Action Rules</a></td>
	</tr>	
	<tr> 
		<td valign="center" class="leftLink" id="tdemrgcont" align="center" height=25><a id="aemrgcont" href="if_UAmedemrgcont.php" onclick="changeCellClass(13)" target="mainFrame" class="leftLink">Emergency Contacts</a></td>
	</tr>	
	<tr>
		<td valign="center" class="leftLink">&nbsp;</td>
  	</tr>
</table>
</center>
<br><br>
<? require ('hysNamePhoto.php'); ?>
</div>

<IFRAME name="mainFrame" src="if_UAmedapp.php"  class="rightcontent" scrolling="no" frameborder="0"></IFRAME>
</div>
<? require ('hysFooter.php'); ?>

</body>

</html>
