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
	var selArray = new Array('status', 'request',  'history', 'uprequest', 'upmedhist');
	
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
		window.parent.listFramePersonal.changeCellClass(0); 
		window.parent.listFrameRelationships.changeCellClass(0);
	}	
	
}
</script>

</head>

<body onload="startUp()">
<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="center" align=center id="tdstatus" class="leftLink" height=25><a id="astatus" href="if_RQstatus.php" onclick="changeCellClass(1)" target="mainFrame" class="leftLink">Oustanding Requests</a></td>
 	</tr>
	<tr> 
 		<td valign="center" align=center id="tdrequest" class="leftLink" height=25><a id="arequest" href="if_RQrequest.php" onclick="changeCellClass(2)" target="mainFrame" class="leftLink">Initiate a Request</a></td>
	</tr>
    <tr> 
   		<td valign="center" align=center id="tdhistory" class="leftLink" height=25><a id="ahistory" href="if_RQhistory.php" onclick="changeCellClass(3)" target="mainFrame" class="leftLink">View Request History</a></td>
	</tr>
   <tr> 
   		<td valign="center" align=center id="tduprequest" class="leftLink" height=25><a id="auprequest" href="if_RQuprequest.php" onclick="changeCellClass(4)" target="mainFrame" class="leftLink">Manage Requests</a></td>
   </tr>  
   <tr> 
		<td valign="center" align=center id="tdupmedhist" class="leftLink" height=25><a id="aupmedhist" href="if_UAmedhist.php" onclick="changeCellClass(5)" target="mainFrame" class="leftLink">Update Medical History</a></td>
   </tr>
</table>
</body>
</html>
