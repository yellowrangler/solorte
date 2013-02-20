<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_adminList.php';

require ('hysInit.php');

?>

<html>

<head>
<title>HealthYourSelf Manage Account Information</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />
<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>

<style type="text/css">

.leftLink   { 
		font: 700 11px Helvetica, Arial,Geneva;
		color: black; 
		line-height: 13px; 
		text-decoration: none;
		}
				
.leftLink:hover   { 
		color: blue;
		font: 700 11px Helvetica, Arial,Geneva;
		line-height: 13px; 
		text-decoration: underline;
		}

.leftLinkSelect   { 
		font: 700 11px Helvetica, Arial,Geneva;
		color: black; 
		line-height: 13px; 
		text-decoration: none;
		background-color:#99CC99;
		}
				
.leftLinkSelect:hover   { 
		color: black;
		font: 700 11px Helvetica, Arial,Geneva;
		line-height: 13px; 
		text-decoration: underline;
		background-color:#99CC99;
		}	
					
</style>

<script type="text/javascript">
function startUp() 
{	
	<?php print $JavaScriptLogMsg; ?>
		
	<?php print $JavaScriptMsg; ?>
}

function changeCellClass(id) 
{
	var selArray = new Array('medap', 'presc', 'medinsur', 'ext', 'social', 'family','int', 'alleg', 'lt', 'behave', 'si','vi', 'emrgcont');

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
		
		window.parent.listFrameClient.changeCellClass(0); 
		window.parent.listFrameRequestHist.changeCellClass(0); 
		window.parent.listFramePersonal.changeCellClass(0); 
		window.parent.listFrameRelationships.changeCellClass(0);
	}	
}

</script>

</head>

<body onload="startUp()">
<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="center" align=center  id="tdmedap" class="leftLink" height=25><a id="amedap" href="if_UAmedapp.php" onclick="changeCellClass(1)" target="mainFrame" class="leftLink">Appointments</a></td>
	</tr>
  	<tr> 
		<td valign="center" align=center  id="tdpresc" class="leftLink" height=25><a id="apresc" href="if_UApresc.php" onclick="changeCellClass(2)" target="mainFrame" class="leftLink">Prescriptions</a></td>
  	</tr>
	<tr>
		<td valign="center" align=center  id="tdmedinsur" class="leftLink" height=25><a id="amedinsur" href="if_UAmedinsure.php" onclick="changeCellClass(3)" target="mainFrame" class="leftLink">Insurance Information</a></td>
	</tr>
    <tr> 
   		<td valign="center" align=center  id="tdext" class="leftLink" height=25><a id="aext" href="if_UAmedprofExternal.php" onclick="changeCellClass(4)" target="mainFrame" class="leftLink">External Profile</a></td>
    </tr>
    <tr> 
  		<td valign="center" align=center  id="tdsocial" class="leftLink" height=25><a id="asocial" href="if_UAmedprofSocial.php" onclick="changeCellClass(5)" target="mainFrame" class="leftLink">Social Health Profile</a></td>
	</tr>
    <tr> 
  		<td valign="center" align=center  id="tdfamily" class="leftLink" height=25><a id="afamily" href="if_UAmedproffamhist.php" onclick="changeCellClass(6)" target="mainFrame" class="leftLink">Family History</a></td>
	</tr>
	<tr> 
  		<td valign="center" align=center  id="tdint" class="leftLink" height=25><a id="aint" href="if_UAmedprofInternal.php" onclick="changeCellClass(7)" target="mainFrame" class="leftLink">Internal Profile</a></td>
	</tr>
	<tr> 
   		<td valign="center" align=center  id="tdalleg" class="leftLink" height=25><a id="aalleg" href="if_UAmedprofAllergies.php?msgTxt=You can Delete Entries by Typing the word None in the Description" onclick="changeCellClass(8)" target="mainFrame" class="leftLink">Allergy Profile</a></td>
	</tr>
    <tr> 
		<td valign="center" align=center  id="tdlt" class="leftLink" height=25><a id="alt" href="if_UAmedprofLongTerm.php?msgTxt=You can Delete Entries by Typing the word None in the Description" onclick="changeCellClass(9)" target="mainFrame" class="leftLink">Long Term Profile</a></td>
	</tr>
	<tr> 
   		<td valign="center" align=center  id="tdbehave" class="leftLink" height=25><a id="abehave" href="if_UAmedprofBehavioral.php?msgTxt=You can Delete Entries by Typing the word None in the Description" onclick="changeCellClass(10)" target="mainFrame" class="leftLink">Behavior Profile</a></td>
	</tr>
    <tr> 
  		<td valign="center" align=center  id="tdsi" class="leftLink" height=25><a id="asi" href="if_UAmedprofSI.php?msgTxt=You can Delete Entries by Typing the word None in the Description" onclick="changeCellClass(11)" target="mainFrame" class="leftLink">Special Instructions</a></td>
	</tr>
    <tr> 
  		<td valign="center" align=center  id="tdvi" class="leftLink" height=25><a id="avi" href="if_UAmedvi.php" onclick="changeCellClass(12)" target="mainFrame" class="leftLink">Vaccinations</a></td>
   </tr>
   	<tr> 
		<td valign="center"  align=center class="leftLink" id="tdemrgcont"  height=25><a id="aemrgcont" href="if_UAmedemrgcont.php" onclick="changeCellClass(13)" target="mainFrame" class="leftLink">Emergency Contacts</a></td>
	</tr>	
</table>
</body>
</html>
