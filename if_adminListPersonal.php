<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$moduleName = 'if_adminListPersonal.php';

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
	var selArray = new Array('name', 'addr', 'photo', 'bill', 'rules', 'forms');
	

	
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
		window.parent.listFrameMedUpdate.changeCellClass(0); 
		window.parent.listFrameRequestHist.changeCellClass(0); 
		window.parent.listFrameRelationships.changeCellClass(0);
	}	
}

</script>

</head>

<body onload="startUp()">
<table width="100%" cellspacing="0" cellpadding="0">
	<tr> 
		<td valign="center" align=center id="tdname" class="leftLink" height=25><a id="aname" href="if_UAnameaddrName.php" onclick="changeCellClass(1);" target="mainFrame" class="leftLink">Client Name</a></td>
  	</tr>
	<tr> 
		<td valign="center" align=center id="tdaddr" class="leftLink" height=25><a id="aaddr" href="if_UAnameaddrAddr.php" onclick="changeCellClass(2);" target="mainFrame" class="leftLink">Client Address</a></td>
  	</tr>
	<tr> 
		<td valign="center" align=center id="tdphoto" class="leftLink" height=25><a id="aphoto" href="if_UAnameaddrPhoto.php" onclick="changeCellClass(3);" target="mainFrame" class="leftLink">Client Photo</a></td>
  	</tr>
  	<tr> 
		<td valign="center" align=center id="tdbill" class="leftLink" height=25><a id="abill" href="if_UAbilling.php" onclick="changeCellClass(4);" target="mainFrame" class="leftLink">Billing Information</a></td>
  	</tr>
	<tr> 
		<td valign="center" align=center id="tdrules" class="leftLink" height=25><a id="arules" href="if_UArules.php" onclick="changeCellClass(5);" target="mainFrame" class="leftLink">Action Rules</a></td>
	</tr>	
	<tr> 
		<td valign="center" align=center id="tdforms" class="leftLink" height=25><a id="aforms" href="if_forms.php" onclick="changeCellClass(6);" target="mainFrame" class="leftLink">Medical Forms</a></td>
	</tr>
</table>
</body>
</html>
