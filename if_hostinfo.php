<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_hostinfo.php';

require ('hysInitAdmin.php');

require ('hysDBinit.php');

require ('hysStatusMsg.php');

//----------------------------------------------------------------------------------------------------------
// lets get host type names
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT ID, Description from HostTypeTBL"; 

//----------------------------------------------------------------------------------------------------------
// Make the call
//----------------------------------------------------------------------------------------------------------
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for HostTypeTBL  (495)";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------
// initialize display block
//----------------------------------------------------------------------------------------------------------
$DisplayHostTypeList = "";

//----------------------------------------------------------------------------------------------------------
// Now lets first see if there is anything to run through
//----------------------------------------------------------------------------------------------------------
$countRows = mysql_num_rows($sql_result);
if ($countRows >  0) 
{	
	// now lets run the table and get our provider names
	while ($result_arr = mysql_fetch_assoc($sql_result))
	{
		$DisplayHostTypeList .= "\t\t\t<option value=\"".$result_arr[ID]."\" >".$result_arr[Description]."\n ";
	}
}	

//----------------------------------------------------------------------------------------------------------
//  we need to see if we have been passed a HostID
//----------------------------------------------------------------------------------------------------------
$isType = "";

if (isset($_GET[hostid]) && ($_GET[hostid] != "") )
{
	//Get host id and set flag to is update
	$HostID = $_GET[hostid];
	$isType = "Update";
	$displayTitle = "Update Host Information";
	
	//----------------------------------------------------------------------------------------------------------
	// create the SQL statement
	//----------------------------------------------------------------------------------------------------------
	$sql = "SELECT  HostTBL.ID as hostID, TypeID, Name, Description AS HostDesc, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr, URL, EmergNbr
		from HostTBL 
		left join AddrTBL on HostTBL.AddrID = AddrTBL.ID
		left join HostTypeTBL  on HostTBL.TypeID = HostTypeTBL.ID
			where (HostTBL.ID = '$HostID' and AddrTBL.OrderID = '1')"; 
		
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query join for HostTBL, AddrTBL and HostTypeTBL (195) sql = '$sql'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
		
	// Now lets first see if there is anything to run through.  If more then 1 we have an error
	$countRows = mysql_num_rows($sql_result);
	if ($countRows > 1)
	{
		$errmsg = " Error more then 1 rows returned in select on HostTBL. count = '$countRows'  - HostID =  '$HostID'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
	
	//----------------------------------------------------------------------------------------------------------
	// Get the data
	//----------------------------------------------------------------------------------------------------------
	$result_array = mysql_fetch_assoc($sql_result);
}
else
{
	//----------------------------------------------------------------------------------------------------------
	// Build empty screen - This is an add
	//----------------------------------------------------------------------------------------------------------
	$isType = "Add";
	$displayTitle = "Add Host Information";
}	
	
?>
<html>

<head>
<title>HealthYourSelf Customer Intro</title>

<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css"> 

.detailBody {
		position: absolute;
		left:20px;
		top:38px; 
		width:650px;
		height:365px;
		background-color: white;
		border:1px solid black;
		}
		
.outerBorderblackfillSiennaSmTxt {
		font: 400 13px Arial, Geneva;
		line-height: 14px; 
		border-top:0px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		background: #ccccff;
		}	

.outerBorderblackSmTxt {
		font: 400 13px Arial, Geneva;
		line-height: 14px; 
		border-top:0px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		background: #ffffff;
		}	

.outerBorderMessageTitleBlue {
		color: white;
		font: 700 13px Arial,Helvetica;
		text-align: center;
		letter-spacing: 8px;
		border-top:1px solid #052faf;
		border-left:1px solid #052faf;
		border-right:1px solid #052faf;
		border-bottom:1px solid #052faf;
		background: #052faf;
		}				
		
.SmTxt   { 
		font: 400 13px Arial, Geneva;
		}			
						
</style>

<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>
<script type="text/javascript" language="JavaScript">
function startUp() 
{	
	<? print $JavaScriptLogMsg; ?> 
		
	<? print $JavaScriptMsg; ?>
}
<!--
// Copyright information must stay intact
// FormCheck v1.10
// Copyright NavSurf.com 2002, all rights reserved
// Creative Solutions for JavaScript navigation menus, scrollers and web widgets
// Affordable Services in JavaScript consulting, customization and trouble-shooting
// Visit NavSurf.com at http://navsurf.com

function formCheck(formobj){
	// name of mandatory fields
	var fieldRequired = Array("hostname", "hosttype", "addr1", "city", "state", "zip", "phonenbr");
	// field description to appear in the dialog box
	var fieldDescription = Array("Host Name", "Host Type", "Address Line 1", "City", "State", "Zip",	"Phone Number");
	// field description to appear in the dialog box
	var fieldEdit = Array("None", "None", "None", "None", "None", "None", "None");
							
	// dialog message
	var alertMsg = "Please complete the following fields:\n";
	
	var l_Msg = alertMsg.length;
	
	for (var i = 0; i < fieldRequired.length; i++)
	{
		var obj = formobj.elements[fieldRequired[i]];
		if (obj)
		{
			if (obj.type == null)
			{
				var blnchecked = false;
				for (var j = 0; j < obj.length; j++)
				{
					if (obj[j].checked){
						blnchecked = true;
					}
				}
				if (!blnchecked)
				{
					alertMsg += " - " + fieldDescription[i] + "\n";
				}
				continue;
			}

			switch(obj.type)
			{
				case "select-one":
					if (obj.selectedIndex == -1 || obj.options[obj.selectedIndex].text == "")
					{
						alertMsg += " - " + fieldDescription[i] + "\n";
					}
					break;
				case "select-multiple":
					if (obj.selectedIndex == -1)
					{
						alertMsg += " - " + fieldDescription[i] + "\n";
					}
					break;
				case "text":
				case "textarea":
					if (obj.value == "" || obj.value == null)
					{
						alertMsg += " - " + fieldDescription[i] + "\n";
					}
					
					if (fieldEdit[i] != "None")
					{	
						var x = fieldCheck(obj.value, fieldEdit[i]);
						if (!x)
						{
							alertMsg += " - Invalid " + fieldDescription[i] + "\n";
						}
					}	
					break;
				default:
			}
		}
	}

	if (alertMsg.length == l_Msg)
	{
		return true;
	}
	else
	{
		alert(alertMsg);
		return false;
	}
}

function fieldCheck(strValue, strEdit)
{
	var res = true;
	var i;
	
	switch(strEdit)
	{
			case "MM":
				i = parseFloat(strValue);
				if (i <= 0 || i > 12)
				{
					res = false;
				}
				break;
			case "DD":
				i = parseFloat(strValue);
				if (i <= 0 || i > 31)
				{
					res = false;
				}
				break;
			case "YYYY":
					i = parseFloat(strValue);
				if (i < 1850)
				{
					res = false;
				}
				break;
			case "HH":
				i = parseFloat(strValue);
				if (i < 0 || i > 12)
				{
					res = false;
				}
				break;
			case "MI":
				i = parseFloat(strValue);
				if (i < 0 || i > 60)
				{
					res = false;
				}
				break;
			default:
	}		
	return res;
}
// -->
</script>
</head>

<body <? print $BodySelectColor ?> onload="startUp()">

<div class="detailBody">
<form  action="hostinfo.php" method=post onsubmit="return formCheck(this);">
<table width="100%" class="outerBorderMessageTitleBlue">
	<tr>
		 <td height=20 align="center"><? print $displayTitle; ?></td>
	</tr>	
</table>

<table width="100%" class="SmTxt">
	<tr>
		<td align=right colspan=4 height=15>&nbsp;</td>
	</tr>
	<tr>
		<td align=right height=35>Host Name:</td>
		<td align=left colspan=5><input size=40 maxlength=255 type="text" name="hostname" value="<? print $result_array[Name]; ?>"> </td>
	</tr>
	<tr>
		<td align=right>Host Type:</td>
		<td align=left>
			<select name="hosttype"> 
				<option class="smallTxtGry" value="<? print  $result_array[TypeID]; ?>"><? print  $result_array[HostDesc]; ?> 
				<? print $DisplayHostTypeList; ?>
			</select>
		</td>
	</tr>	
	<tr>
		<td align=right height=35>Address Line 1:</td>
		<td align=left colspan=5><input size=40 maxlength=255 type="text" name="addr1" value="<? print $result_array[AddrLine1]; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=35>Address Line 2:</td>
		<td align=left colspan=5><input size=40 maxlength=255 type="text" name="addr2" value="<? print $result_array[AddrLine2]; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=35>City:</td>
		<td align=left><input size=25 maxlength=45 type="text" name="city" value="<? print $result_array[City]; ?>"> </td>

		<td align=right height=35>State:</td>
		<td align=left><input size=2 maxlength=2 type="text" name="state" value="<? print $result_array[State]; ?>"> </td>
		
		<td align=right height=35>Zip Code:</td>
		<td align=left><input size=10 maxlength=45 type="text" name="zip" value="<? print $result_array[ZIP]; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=35>Phone Number:</td>
		<td align=left colspan=3><input size=15 maxlength=15 type="text" name="phonenbr" value="<? print $result_array[PhoneNbr]; ?>"> </td>
		
		<td align=right height=35>Emergency Number:</td>
		<td align=left colspan=3><input size=15 maxlength=15 type="text" name="emergnbr" value="<? print $result_array[EmergNbr]; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=35>URL</td>
		<td align=left colspan=5><input size=40 maxlength=255 type="text" name="url" value="<? print $result_array[URL]; ?>"> </td>
	</tr>
</table>
<input type="hidden" name="Action" value="<? print $isType; ?>">	
<input type="hidden" name="hostid" value="<? print $result_array[hostID]; ?>">	
<br><center>
<table>
	<tr>
		<td align=center><input type=submit size=150 NAME="SUBMIT" VALUE="Submit"></td>
		<td>&nbsp;</td>
		<td align=center><input type=reset size=150 NAME="RESET" VALUE="Reset"></td>
	</tr>
</table>	
</center>	
</form>
</div>

</body>
</html>
