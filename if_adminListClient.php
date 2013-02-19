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
	<? print $JavaScriptLogMsg; ?> 
		
	<? print $JavaScriptMsg; ?>
}

function changeCellClass(id) 
{
	var selArray = new Array('apprescvidetail',  'medhistEvent', 'medhistDocScan', 'medinsure','profile', 'emrgcont', 'acclog');
	
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
		
		window.parent.listFrameMedUpdate.changeCellClass(0); 
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
   		<td valign="center" class="leftLink" id="tdapprescvidetail" align=center height=25><a id="aapprescvidetail" href="if_appprescvi.php" onclick="changeCellClass(1)" target="mainFrame" class="leftLink">Personal Calendar</a></td>
	</tr>
    <tr> 
   		<td valign="center" class="leftLink" id="tdmedhistEvent" align=center height=25><a id="amedhistEvent" href="if_medhistory.php" onclick="changeCellClass(2)" target="mainFrame" class="leftLink">Medical History Events</a></td>
	</tr>
	 <tr> 
   		<td valign="center" class="leftLink" id="tdmedhistDocScan" align=center height=25><a id="amedhistDocScan" href="if_medhistoryDocScan.php" onclick="changeCellClass(3)" target="mainFrame" class="leftLink">Scanned Documents</a></td>
	</tr>
   	<tr> 
   		<td valign="center" class="leftLink" id="tdmedinsure" align=center height=25><a id="amedinsure" href="if_medinsure.php" onclick="changeCellClass(4)" target="mainFrame" class="leftLink">Insurance Information</a></td>
	</tr>
   	<tr> 
		<td valign="center" class="leftLink" id="tdprofile" align=center height=25><a id="aprofile" href="if_medprofile.php" onclick="changeCellClass(5)" target="mainFrame" class="leftLink">Medical Profile</a></td>
	</tr>	
	<tr> 
		<td valign="center" class="leftLink" id="tdemrgcont" align="center" height=25><a id="aemrgcont" href="if_medemrgcont.php" onclick="changeCellClass(6)" target="mainFrame" class="leftLink">Emergency Contacts</a></td>
	</tr>
	<tr> 
		<td valign="center" class="leftLink" id="tdacclog" align="center" height=25><a id="aacclog" href="if_accesslog.php" onclick="changeCellClass(7)" target="mainFrame" class="leftLink">Access Log</a></td>
	</tr>	
</table>
</body>
</html>
