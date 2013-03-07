<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$moduleName = 'if_adminList.html';

require ('hysInit.php');

?>

<html>

<head>
<title>HealthYourSelf Manage Account Information</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />
<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>

<style type="text/css">

.topicBorder {
		border: 1px; 
		font: 700 15px Arial,Helvetica;
		color: #49482d;
		text-align: left;
		background: #d8c78c;
		}

.topicBorder2 {
		border: 1px; 
		font: 700 15px Arial,Helvetica;
		color: #49482d;
		text-align: center;
		background: #d8c78c;
		}		
					
</style>

<script type="text/javascript">
function startUp() 
{	
	<?php print $JavaScriptLogMsg; ?>
		
	<?php print $JavaScriptMsg; ?>
}

function changeUpdateADMImage(i)
{
	document.getElementById('client').src="images/goldbulsquare.gif"
	document.getElementById('provider').src="images/goldbulsquare.gif"
	document.getElementById('host').src="images/goldbulsquare.gif"
	document.getElementById('pharmacy').src="images/goldbulsquare.gif"
	document.getElementById('payor').src="images/goldbulsquare.gif"

	switch (i)
	{
		case 1:
			document.getElementById('client').src="images/goldsel.gif"
			break
			
		case 2:
			document.getElementById('provider').src="images/goldsel.gif"
			break
		
		case 3:
			document.getElementById('host').src="images/goldsel.gif"
			break
		
		case 4:
			document.getElementById('pharmacy').src="images/goldsel.gif"
			break
		
		case 5:
			document.getElementById('payor').src="images/goldsel.gif"
			break
	}		
}

function changeUpdateCRMImage(i)
{
	document.getElementById('clientfamily').src="images/goldbulsquare.gif"
	document.getElementById('clientprovider').src="images/goldbulsquare.gif"
	document.getElementById('clientpharmacy').src="images/goldbulsquare.gif"
	document.getElementById('clientpayor').src="images/goldbulsquare.gif"
		
	switch (i)
	{
		case 1:
			document.getElementById('clientfamily').src="images/goldsel.gif"
			break

		case 2:
			document.getElementById('clientprovider').src="images/goldsel.gif"
			break
		
		case 3:
			document.getElementById('clientpharmacy').src="images/goldsel.gif"
			break	
					
		case 4:
			document.getElementById('clientpayor').src="images/goldsel.gif"
			break	
	}		
}
</script>

</head>

<body onload="startUp()">
<table width="100%" cellspacing="0" cellpadding="0">
	<tr> 
		<td width=10>&nbsp;</td>
		<td width=25 valign="center" align="center" height=25><img id="curinfo" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td valign="center" align="left" height=25><a href="if_curinfo.html" onclick="changeButtonImg(1)" target="mainFrame" class="leftLink">Calendar</a></td> 
  	</tr>
	<tr> 
		<td width=10>&nbsp;</td>
   		<td width=25 valign="center" align="center" height=25><img id="prescrip" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
   		<td valign="center" align="left" height=25><a href="if_prescript.html" onclick="changeButtonImg(2)" target="mainFrame" class="leftLink">Prescription Detail</a></td> 
   </tr>
    <tr> 
		<td width=10>&nbsp;</td>
   		<td width=25 valign="center" align="center" height=25><img id="medhist" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
   		<td valign="center" align="left" height=25><a href="if_medhistory.html" onclick="changeButtonImg(3)" target="mainFrame" class="leftLink">Medical History</a></td> 
   </tr>
   <tr> 
   		<td width=10>&nbsp;</td>
   		<td width=25 valign="center" align="center" height=25><img id="medinsur" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
   		<td valign="center" align="left" height=25><a href="if_medinsure.html" onclick="changeButtonImg(4)" target="mainFrame" class="leftLink">Insurance Information</a></td> 
   </tr>
   <tr> 
   		<td width=10>&nbsp;</td>
		<td width=25 valign="center" align="center" height=25><img id="profile" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td valign="center" align="left" height=25><a href="if_medprofile.html" onclick="changeButtonImg(5)" target="mainFrame" class="leftLink">Medical Profile</a></td> 
  	</tr>	
	<tr>
		<td width=10>&nbsp;</td>
		<td width=25 valign="center" align="center" height=25><img id="medap" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td valign="center" align="left" height=25><a href="if_UAmedapp.html" onclick="changeButtonImg(1)" target="mainFrame" class="leftLink">Appointments</a></td> 
  	</tr>
  	<tr> 
		<td width=10>&nbsp;</td>
		<td width=25 valign="center" align="center" height=25><img id="presc" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td valign="center" align="left" height=25><a href="if_UApresc.html" onclick="changeButtonImg(2)" target="mainFrame" class="leftLink">Prescriptions</a></td> 
  	</tr>
   <tr> 
   		<td width=10>&nbsp;</td>
   		<td width=25 valign="center" align="center" height=25><img id="medhist" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td valign="center" align="left" height=25><a href="if_UAmedhist.html" onclick="changeButtonImg(3)" target="mainFrame" class="leftLink">Medical History Detail</a></td> 
   </tr>
   <tr> 
   		<td width=10>&nbsp;</td>
   		<td width=25 valign="center" align="center" height=25><img id="ext" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td valign="center" align="left" height=25><a href="if_UAmedprofExternal.html" onclick="changeButtonImg(4)" target="mainFrame" class="leftLink">External Profile</a></td> 
   </tr>
    <tr> 
		<td width=10>&nbsp;</td>
   		<td width=25 valign="center" align="center" height=25><img id="int" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td valign="center" align="left" height=25><a href="if_UAmedprofInternal.html" onclick="changeButtonImg(5)" target="mainFrame" class="leftLink">Internal Profile</a></td> 
   </tr>
   <tr> 
   		<td width=10>&nbsp;</td>
   		<td width=25 valign="center" align="center" height=25><img id="alleg" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td valign="center" align="left" height=25><a href="if_UAmedprofAllergies.html?msgTxt=You can Delete Entries by Typing the word None in the Description" onclick="changeButtonImg(6)" target="mainFrame" class="leftLink">Allergy Profile</a></td> 
   </tr>
    <tr> 
		<td width=10>&nbsp;</td>
   		<td width=25 valign="center" align="center" height=25><img id="lt" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td valign="center" align="left" height=25><a href="if_UAmedprofLongTerm.html?msgTxt=You can Delete Entries by Typing the word None in the Description" onclick="changeButtonImg(7)" target="mainFrame" class="leftLink">Long Term Profile</a></td> 
   </tr>
   <tr> 
   		<td width=10>&nbsp;</td>
   		<td width=25 valign="center" align="center" height=25><img id="behave" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td valign="center" align="left" height=25><a href="if_UAmedprofBehavioral.html?msgTxt=You can Delete Entries by Typing the word None in the Description" onclick="changeButtonImg(8)" target="mainFrame" class="leftLink">Behavior Profile</a></td> 
   </tr>
    <tr> 
		<td width=10>&nbsp;</td>
   		<td width=25 valign="center" align="center" height=25><img id="si" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td valign="center" align="left" height=25><a href="if_UAmedprofSI.html?msgTxt=You can Delete Entries by Typing the word None in the Description" onclick="changeButtonImg(9)" target="mainFrame" class="leftLink">Special Instructions</a></td> 
   </tr>
    <tr> 
		<td width=10>&nbsp;</td>
   		<td width=25 valign="center" align="center" height=25><img id="vi" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td valign="center" align="left" height=25><a href="if_UAmedvi.html" onclick="changeButtonImg(10)" target="mainFrame" class="leftLink">Vaccination/Inoculations</a></td> 
   </tr>
	<tr> 
		<td width=10>&nbsp;</td>
		<td width=25 valign="center" align="center" height=25><img id="name" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td valign="center" align="left" height=25><a href="if_UAnameaddrName.html" onclick="changeButtonImg(5);" target="mainFrame" class="leftLink">Client Name</a></td> 
  	</tr>
	<tr> 
		<td width=10>&nbsp;</td>
		<td width=25 valign="center" align="center" height=25><img id="addr" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td valign="center" align="left" height=25><a href="if_UAnameaddrAddr.html" onclick="changeButtonImg(6);" target="mainFrame" class="leftLink">Client Address</a></td> 
  	</tr>
	<tr> 
		<td width=10>&nbsp;</td>
		<td width=25 valign="center" align="center" height=25><img id="photo" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td valign="center" align="left" height=25><a href="if_UAnameaddrPhoto.html" onclick="changeButtonImg(7);" target="mainFrame" class="leftLink">Client Photo</a></td> 
  	</tr>
  	<tr> 
		<td width=10>&nbsp;</td>
		<td width=25 valign="center" align="center" height=25><img id="bill" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td valign="center" align="left" height=25><a href="if_UAbilling.html" onclick="changeButtonImg(8);" target="mainFrame" class="leftLink">Billing Information</a></td> 
  	</tr>
   <tr> 
		<td width=10>&nbsp;</td>
   		<td width=25 valign="center" align="center" height=25><img id="access" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td valign="center" align="left" height=25><a href="if_UAaccesspriv.html" onclick="changeButtonImg(9);" target="mainFrame" class="leftLink">Access Privileges</a></td> 
   </tr>
	 <tr> 
	 	<td width=10>&nbsp;</td>
   		<td width=25 valign="center" align="center" height=25><img id="rules" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td valign="center" align="left" height=25><a href="if_UArules.html" onclick="changeButtonImg(10);" target="mainFrame" class="leftLink">Action Rules</a></td> 
   </tr>	
	<tr>
		<td width=10>&nbsp;</td>
		<td width=25 valign="center" align="center" height=25><img id="status" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td valign="center" align="left" height=25><a href="if_RQstatus.html" onclick="changeButtonImg(11)" target="mainFrame" class="leftLink">Oustanding Requests</a></td> 
  	</tr>
	<tr> 
		<td width=10>&nbsp;</td>
   		<td width=25 valign="center" align="center" height=25><img id="request" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
   		<td valign="center" align="left" height=25><a href="if_RQrequest.html" onclick="changeButtonImg(12)" target="mainFrame" class="leftLink">Initiate a Request</a></td> 
   </tr>
    <tr> 
		<td width=10>&nbsp;</td>
   		<td width=25 valign="center" align="center" height=25><img id="history" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
   		<td valign="center" align="left" height=25><a href="if_RQhistory.html" onclick="changeButtonImg(13)" target="mainFrame" class="leftLink">View Request History</a></td> 
   </tr>
   <tr> 
		<td width=10>&nbsp;</td>
   		<td width=25 valign="center" align="center" height=25><img id="uprequest" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
   		<td valign="center" align="left" height=25><a href="if_RQuprequest.html" onclick="changeButtonImg(13)" target="mainFrame" class="leftLink">Update Request</a></td> 
   </tr>
	<tr> 
		<td width=10>&nbsp;</td>
		<td width=25 valign="center" align="center" height=25><img id="client" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td valign="center" align="left" height=25><a href="if_ADMclient.html" onclick="changeUpdateADMImage(1)" target="mainFrame" class="leftLink">Client Information</a></td> 
  	</tr>
	<tr> 
		<td width=10>&nbsp;</td>
		<td width=25 valign="center" align="center" height=25><img id="provider" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td valign="center" align="left" height=25><a href="if_ADMprovider.html" onclick="changeUpdateADMImage(2)" target="mainFrame" class="leftLink">Provider Information</a></td> 
  	</tr>
	<tr> 
		<td width=10>&nbsp;</td>
		<td width=25 valign="center" align="center" height=25><img id="host" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td valign="center" align="left" height=25><a href="if_ADMhost.html" onclick="changeUpdateADMImage(3)" target="mainFrame" class="leftLink">Host Information</a></td> 
  	</tr>
	<tr> 
		<td width=10>&nbsp;</td>
		<td width=25 valign="center" align="center" height=25><img id="pharmacy" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td valign="center" align="left" height=25><a href="if_ADMpharmacy.html" onclick="changeUpdateADMImage(4)" target="mainFrame" class="leftLink">Pharmacy Information</a></td> 
  	</tr>
	<tr> 
		<td width=10>&nbsp;</td>
		<td width=25 valign="center" align="center" height=25><img id="payor" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td valign="center" align="left" height=25><a href="if_ADMpayor.html" onclick="changeUpdateADMImage(5)" target="mainFrame" class="leftLink">Payor Information</a></td> 
  	</tr>
	<tr> 
		<td width=10>&nbsp;</td>
		<td width=25 valign="center" align="center" height=25><img id="clientfamily" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td valign="center" align="left" height=25><a href="if_ADMclientfamily.html" onclick="changeUpdateCRMImage(1)" target="mainFrame" class="leftLink">Client Family Information</a></td> 
  	</tr>
	<tr> 
		<td width=10>&nbsp;</td>
		<td width=25 valign="center" align="center" height=25><img id="clientprovider" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>	
		<td valign="center" align="left" height=25><a href="if_ADMclientprovider.html" onclick="changeUpdateCRMImage(2)" target="mainFrame" class="leftLink">Client Provider Information</a></td>
	</tr>	
	<tr> 
		<td width=10>&nbsp;</td>
		<td width=25 valign="center" align="center" height=25><img id="clientpharmacy" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td valign="center" align="left" height=25><a href="if_ADMclientpharmacy.html" onclick="changeUpdateCRMImage(3)" target="mainFrame" class="leftLink">Client Pharmacy Information</a></td> 
  	</tr>
	<tr>
		<td width=10>&nbsp;</td>
		<td width=25 valign="center" align="center" height=25><img id="clientpayor" border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td valign="center" align="left" height=25><a href="if_ADMclientpayor.html" onclick="changeUpdateCRMImage(4)" target="mainFrame" class="leftLink">Client Payor Information</a></td> 
  	</tr>
</table>
