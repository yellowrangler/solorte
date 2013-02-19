<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$moduleName = 'if_adminListRelationships.html';

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
	var selArray = new Array('provider', 'host', 'pharmacy', 'access');
	
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
		window.parent.listFramePersonal.changeCellClass(0);
	}	
}

</script>

</head>

<body onload="startUp()">
<table width="100%" cellspacing="0" cellpadding="0">
  	<tr> 
		<td valign="center" align=center id="tdprovider" class="leftLink" height=25><a id="aprovider" href="if_clientprovider.php" onclick="changeCellClass(1);" target="mainFrame" class="leftLink">Provider</a></td>
  	</tr>
	<tr> 
		<td valign="center" align=center id="tdhost" class="leftLink" height=25><a id="ahost" href="if_clienthost.php" onclick="changeCellClass(2);" target="mainFrame" class="leftLink">Host</a></td>
  	</tr>
	<tr> 
		<td valign="center" align=center id="tdpharmacy" class="leftLink" height=25><a id="apharmacy" href="if_clientpharmacy.php" onclick="changeCellClass(3);" target="mainFrame" class="leftLink">Pharmacy</a></td>
	</tr>	
	<tr> 
		<td valign="center" align=center id="tdaccess" class="leftLink" height=25><a id="aaccess" href="if_proxyaccess.php" onclick="changeCellClass(43);" target="mainFrame" class="leftLink">Grant Access</a></td>
	</tr>
</table>
</body>
</html>
