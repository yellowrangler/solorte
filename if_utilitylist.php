<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$moduleName = 'if_utilitylist.html';

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
	var selArray = new Array('encrypt', 'mysqldump',  'problemtrack', "createcsid", "deleteclient", "createupin");
	

	
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
<table width="100%" cellspacing="0" cellpadding="0">
	<tr> 
		<td valign="center" class="leftLink" id="tdencrypt" align=center height=25><a id="aencrypt" href="if_encrypt.php" onclick="changeCellClass(1)" target="mainFrame" class="leftLink">Encryption Utility</a></td> 
  	</tr>
	<tr> 
   		<td valign="center" class="leftLink" id="tdmysqldump" align=center height=25><a id="amysqldump" href="if_mysqldump.php" onclick="changeCellClass(2)" target="mainFrame" class="leftLink">Dump Database</a></td>
	</tr>
    <tr> 
   		<td valign="center" class="leftLink" id="tdproblemtrack" align=center height=25><a id="aproblemtrack" href="if_probtrack.php" onclick="changeCellClass(3)" target="mainFrame" class="leftLink">Problem Tracking</a></td>
	</tr>
	<tr> 
   		<td valign="center" class="leftLink" id="tdcreatecsid" align=center height=25><a id="acreatecsid" href="if_createCSID.php" onclick="changeCellClass(4)" target="mainFrame" class="leftLink">Creat CSID</a></td>
	</tr>
	<tr> 
   		<td valign="center" class="leftLink" id="tddeleteclient" align=center height=25><a id="adeleteclient" href="if_clientFULLdelete.php" onclick="changeCellClass(5)" target="mainFrame" class="leftLink">Delete Client</a></td>
	</tr>
	<tr> 
   		<td valign="center" class="leftLink" id="tdcreateupin" align=center height=25><a id="acreateupin" href="if_createupin.php" onclick="changeCellClass(6)" target="mainFrame" class="leftLink">Create UPIN Table</a></td>
	</tr>
</table>
</body>
</html>
