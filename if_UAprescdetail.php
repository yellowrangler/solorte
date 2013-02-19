<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_UAprescdetail.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

require ('hysStatusMsg.php');

//----------------------------------------------------------------------------------------------------------
// get doctors names
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT DISTINCT FirstName, LastName, Suffix, ClientProviderTBL.ProviderID as ProvID from 
			ClientProviderTBL left join ProviderTBL on ClientProviderTBL.ProviderID = ProviderTBL.ID	
			inner join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID 
			where ClientProviderTBL.MEDPAL = '$Medpal'";

// Make the call
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ClientPrescriptionTBL left join FullNameTBL  (395) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// initialize display block
$DisplayProviderList = "";
$DisplayProviderID = "None";

// Now lets first see if there is anything to run through
$countRows = mysql_num_rows($sql_result);
if ($countRows >  0) 
{	
	// now lets run the table and get our provider names
	while ($result_arr = mysql_fetch_assoc($sql_result))
	{
		$DisplayProviderList .= "\t\t\t<option value=\"".$result_arr[ProvID]."\" >".$result_arr[FirstName]." ".$result_arr[LastName]." ".$result_arr[Suffix]."\n ";
	}
}	

//----------------------------------------------------------------------------------------------------------
// now lets get pharmacy names
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT PharmacyTBL.Name, PharmacyID from 
			ClientPharmacyTBL inner join PharmacyTBL on PharmacyTBL.ID = ClientPharmacyTBL.PharmacyID
			where ClientPharmacyTBL.MEDPAL = '$Medpal' 
			order by ClientPharmacyTBL.OrderID";

// Make the call
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ClientPharmacyTBL left join PharmacyTBL  (495) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// initialize display block
$DisplayPharmacyList = "";
$DisplayPharmacyID = "None";

// Now lets first see if there is anything to run through
$countRows = mysql_num_rows($sql_result);
if ($countRows >  0) 
{	
	// now lets run the table and get our provider names
	while ($result_arr = mysql_fetch_assoc($sql_result))
	{
		$DisplayPharmacyList .= "\t\t\t<option value=\"".$result_arr[PharmacyID]."\" >".$result_arr[Name]."\n ";
	}
}	

// set prescid to default
$DisplayPrescID = "";

//----------------------------------------------------------------------------------------------------------
// we are either being called by default (user selects presc udate OR someone has clicked on a prescription to 
// update or delete in which case we need the prescid OR we have sent a request to add, update or delete
// a prescription and we are now getting back results.  So we need to see first of all is our GET
// set and act accordingly
//----------------------------------------------------------------------------------------------------------
if ( isset($_GET[prescid]) and ($_GET[prescid] != "") )
{
	$DisplayPrescID = $_GET[prescid];
	
	//------------------------------------------------------------------------------------------------------
	// Ok so we are either returning from an action OR selected from a list either way all we do is 
	// build screen and msgtxt
	//------------------------------------------------------------------------------------------------------
	$sql = "SELECT * from ClientPrescriptionTBL inner join CalendarTBL on ClientPrescriptionTBL.CalendarID = CalendarTBL.ID
			inner join ProviderTBL on ClientPrescriptionTBL.ProviderID = ProviderTBL.ID
			inner join PharmacyTBL on ClientPrescriptionTBL.PharmacyID = PharmacyTBL.ID
			inner join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID
			where ( (MEDPAL = $Medpal) and (ClientPrescriptionTBL.ID = '$_GET[prescid]') )";
			
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query for ClientPrescriptionTBL multiple joins (295) - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
	
	// Now lets process the result set 
	$countRows = mysql_num_rows($sql_result);
	if ($countRows == 1) 
	{
		// fetch the results
		$result_arr = mysql_fetch_assoc($sql_result);
		
		//------------------------------------------------------------------------------------------------------
		// first the start date 
		//------------------------------------------------------------------------------------------------------
		$tmpDate = CovertMySQLDate($result_arr["StartDate"], 1, 9);
		
		$DisplayStartMonth = $tmpDate[1];
		$DisplayStartDay = $tmpDate[2];
		$DisplayStartYear = $tmpDate[0];
		
		//------------------------------------------------------------------------------------------------------
		// first the end date 
		//------------------------------------------------------------------------------------------------------
		$tmpDate = CovertMySQLDate($result_arr["EndDate"], 1, 9);
		
		$DisplayEndMonth = $tmpDate[1];
		$DisplayEndDay = $tmpDate[2];
		$DisplayEndYear = $tmpDate[0];
			
		//------------------------------------------------------------------------------------------------------	
		// second the provider
		//------------------------------------------------------------------------------------------------------
		$DisplayProvider = $result_arr["FirstName"]." ".$result_arr["LastName"]." ".$result_arr["Suffix"];
		$DisplayProviderID = $result_arr["ProviderID"];
		
		//------------------------------------------------------------------------------------------------------
		// third the condition
		//------------------------------------------------------------------------------------------------------
		$DisplayCondition = $result_arr["Condition"];
		
		//------------------------------------------------------------------------------------------------------
		// fourth the pharmacy
		//------------------------------------------------------------------------------------------------------
		$DisplayPharmacy = $result_arr["Name"];
		$DisplayPharmacyID = $result_arr["PharmacyID"];
		
		//------------------------------------------------------------------------------------------------------
		// fith the precription number
		//------------------------------------------------------------------------------------------------------
		$DisplayNbr = $result_arr["PrescrNbr"];
		
		//------------------------------------------------------------------------------------------------------
		// sixth the medication
		//------------------------------------------------------------------------------------------------------
		$DisplayMedication = $result_arr["Medication"];
		
		//------------------------------------------------------------------------------------------------------
		// seventh the unit sz
		//------------------------------------------------------------------------------------------------------
		$DisplayUnitSz = $result_arr["UnitSz"];
		
		//------------------------------------------------------------------------------------------------------
		// eigth the Quantity
		//------------------------------------------------------------------------------------------------------
		$DisplayQty = $result_arr["Quantity"];
		
		//------------------------------------------------------------------------------------------------------
		// ninth the dosage
		//------------------------------------------------------------------------------------------------------
		$DisplayDosage = $result_arr["Dosage"];
		
		//------------------------------------------------------------------------------------------------------
		// fith the description
		//------------------------------------------------------------------------------------------------------
		$DisplayDirections = $result_arr["Directions"];
	}
	else
	{
		//------------------------------------------------------------------------------------------------------
		// error
		//------------------------------------------------------------------------------------------------------
		$errmsg = "Error doing mysql_query for client prescointment. Get prescid = '$_GET[prescid]'. (296)  Too many or too few rows countrow = '$countRows' - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
}

?>
<html>

<head>
<title>HealthYourSelf Customer Information</title>

<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>

<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css"> 

.detailArea {
		position: absolute;
		left:0px;
		top:0px; 
		width:660;
		height:345px;
		background: white;
		border:1px solid black;
		}					

.outerBorderTitleBlue {
		color: white;
		font: 700 13px Arial,Helvetica;
		text-align: center;
		border-top:1px solid #052faf;
		border-left:1px solid #052faf;
		border-right:1px solid #052faf;
		border-bottom:1px solid #052faf;
		background: #052faf;	
		}	
		
.linkTitletype {
		color: white;
		font: 700 13px Arial,Helvetica;
		text-align: center;
		text-decoration: none;
		}			

.linkTitletype:hover {
		color: yellow;
		font: 700 13px Arial,Helvetica;
		text-align: center;
		text-decoration: underline;
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
	var fieldRequired = Array("prescstartmonth", "prescstartday", "prescstartyear", "prescendmonth", "prescendday", "prescendyear", "prescprovider", "prescconditionc",
								"prescpharmacy", "prescnbr", "prescmedication", "prescunitsz",
								"prescqty", "prescdosage", "prescdirections");
	// field description to appear in the dialog box
	var fieldDescription = Array("Start Month", "Start Day", "Start Year", "Renew Month", "Renew Day", "Renew Year", "Provider", "Condition", "Pharmacy",
								"RX Number", "Medication", "Unit Size",
								"Quantity", "Dosage", "Directions");
	// field description to appear in the dialog box
	var fieldEdit = Array("MM", "DD", "YYYY", "MM", "DD", "YYYY", "None", "None", "None",
							"None", "None", "None",	"None", "None", "None");
							
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

<div name="detailArea" class="detailArea">
<form  action="UApresc.php" method=post onsubmit="return formCheck(this);">
<table width="100%" class="outerBorderMessageTitleBlue">
	<tr>
		 <td height=20 align="center">Prescription Detail</td>
	</tr>	
</table>
<table width="100%" class="SmTxt">
	<tr>
		<td align=right colspan=4 height=15>&nbsp;</td>
	</tr>
	<tr>
		<td align=right height=35>Start Date:</td>
		<td align=left>
			<input size=2 type="text" name="prescstartmonth" value="<? print $DisplayStartMonth; ?>">/
			<input size=2 type="text" name="prescstartday" value="<? print $DisplayStartDay; ?>">/
			<input size=4 type="text" name="prescstartyear" value="<? print $DisplayStartYear; ?>"> (MM/DD/YYYY)
		</td>
		<td align=right height=35>Renew Date:</td>
		<td align=left>
			<input size=2 type="text" name="prescendmonth" value="<? print $DisplayEndMonth; ?>">/
			<input size=2 type="text" name="prescendday" value="<? print $DisplayEndDay; ?>">/
			<input size=4 type="text" name="prescendyear" value="<? print $DisplayEndYear; ?>"> (MM/DD/YYYY)
		</td>
	</tr>
	<tr>
		<td align=right height=35>Provider:</td>
		<td align=left>
			<select name="prescprovider"> <option class="smallTxtGry" value="<? print $DisplayProviderID; ?>"><? print $DisplayProvider; ?> 
			<? print $DisplayProviderList; ?>
			</select>
		</td>
		<td align=right height=35>Condition:</td>
		<td align=left><input size=30 maxlength=255 type="text" name="prescconditionc" value="<? print $DisplayCondition; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=35>Pharmacy:</td>
		<td align=left>
			<select name="prescpharmacy"> 
				<option class="smallTxtGry" value="<? print $DisplayPharmacyID; ?>"><? print $DisplayPharmacy; ?> 
				<? print $DisplayPharmacyList; ?>
			</select>
		</td>
		<td align=right height=35>Precription Nbr:</td>
		<td align=left><input size=20 maxlength=40 type="text" name="prescnbr" value="<? print $DisplayNbr; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=35>Medication:</td>
		<td align=left colspan=3><input size=45 maxlength=255 type="text" name="prescmedication" value="<? print $DisplayMedication; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=35>Unit Size:</td>
		<td align=left><input size=25 maxlength=25 type="text" name="prescunitsz" value="<? print $DisplayUnitSz; ?>"> </td>

		<td align=right height=35>Quantity:</td>
		<td align=left><input size=25 maxlength=25 type="text" name="prescqty" value="<? print $DisplayQty; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=35>Dosage:</td>
		<td align=left colspan=3><input size=25 maxlength=45 type="text" name="prescdosage" value="<? print $DisplayDosage; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=35>Directions:</td>
		<td align=left colspan=3><input size=70 maxlength=255 type="text" name="prescdirections" value="<? print $DisplayDirections; ?>"> </td>
	</tr>
</table>	
<center>
<table class="SmTxt" border=0 cellspacing=0 cellpadding=0>
	<tr>
		<td width=15>&nbsp;</td>
		<td align=center  height=15><input type="submit" name="Action" value="Add"></td>
		<td width=15>&nbsp;</td>
		<td align=center  height=15><input type="submit" name="Action" value="Update"></td> 
		<td width=15>&nbsp;</td>
		<td align=center  height=15><input type="submit" name="Action" value="Delete"></td> 
		<td width=10>&nbsp;</td>
		<td align=center  height=15><input type=reset size=150 NAME="RESET" VALUE="Reset"></td>
		<td>&nbsp;</td>
	</tr>
</table>
</center>
<input type='hidden' name='prescid'  value='<? print $DisplayPrescID; ?>'>
</form>
</div>
</div>
</body>
</html>
