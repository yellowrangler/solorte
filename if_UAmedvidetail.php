<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_UAmedvidetail.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

require ('hysStatusMsg.php');

//----------------------------------------------------------------------------------------------------------
// get Event Types
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT * from VaccInocTypeTBL ORDER BY VaccInocType"; 

//----------------------------------------------------------------------------------------------------------
// Make the call
//----------------------------------------------------------------------------------------------------------
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for VaccInocTypeTBL  (395) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------
// initialize display block
//----------------------------------------------------------------------------------------------------------
$DisplayVaccInocTypeList = "";

//----------------------------------------------------------------------------------------------------------
// Now lets first see if there is anything to run through
//----------------------------------------------------------------------------------------------------------
$countRows = mysql_num_rows($sql_result);
if ($countRows >  0) 
{	
	// now lets run the table and get our Event types
	while ($result_arr = mysql_fetch_assoc($sql_result))
	{
		$DisplayVaccInocTypeList .= "\t\t\t<option value=\"".$result_arr[ID]."\" >".$result_arr[VaccInocType]."\n ";
	}
}	

//----------------------------------------------------------------------------------------------------------
// get doctors names
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT DISTINCT FirstName, LastName, Suffix, ClientProviderTBL.ProviderID as ProvID 
			from ClientProviderTBL 
			left join ProviderTBL on ClientProviderTBL.ProviderID = ProviderTBL.ID	
			inner join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID 
			where ClientProviderTBL.MEDPAL = '$Medpal'";

// Make the call
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ClientProviderTBL left join FullNameTBL  (395) - '$Medpal'";
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

// set vaccinocid to default
$DisplayVaccInocID = "";

//----------------------------------------------------------------------------------------------------------
// we are either being called by default (user selects vaccinoc udate OR someone has clicked on a vaccinocription to 
// update or delete in which case we need the vaccinocid OR we have sent a request to add, update or delete
// a vaccinocription and we are now getting back results.  So we need to see first of all is our GET
// set and act accordingly
//----------------------------------------------------------------------------------------------------------
if ( isset($_GET[vaccinocid]) and ($_GET[vaccinocid] != "") )
{
	$DisplayVaccInocID = $_GET[vaccinocid];
	
	//------------------------------------------------------------------------------------------------------
	// Ok so we are either returning from an action OR selected from a list either way all we do is 
	// build screen and msgtxt
	//------------------------------------------------------------------------------------------------------
	$sql = "SELECT FirstName, LastName, Suffix, ClientVaccInocTBL.ProviderID as ProvID, 
			VaccInocType, VaccInocTypeID, CalendarID, Medication, ClientVaccInocTBL.ID as VaccInocID,
			StartDate, StartTime, EndDate, EndTime, Duration, AppType
			from ClientVaccInocTBL
			left join ProviderTBL on ClientVaccInocTBL.ProviderID = ProviderTBL.ID	
			left join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID
			left join CalendarTBL on ClientVaccInocTBL.CalendarID = CalendarTBL.ID
			left join VaccInocTypeTBL on ClientVaccInocTBL.VaccInocTypeID = VaccInocTypeTBL.ID
			where (ClientVaccInocTBL.MEDPAL = '$Medpal' and ClientVaccInocTBL.ID = '$_GET[vaccinocid]')";
			
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query for ClientVaccInocTBL multiple joins (295) - '$Medpal'";
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
		// Start date 
		//------------------------------------------------------------------------------------------------------
		$tmpDate = CovertMySQLDate($result_arr["StartDate"], 1, 9);
		
		$DisplayStartMonth = $tmpDate[1];
		$DisplayStartDay = $tmpDate[2];
		$DisplayStartYear = $tmpDate[0];
			
		//------------------------------------------------------------------------------------------------------
		// End date 
		//------------------------------------------------------------------------------------------------------
		$tmpDate = CovertMySQLDate($result_arr["EndDate"], 1, 9);
		
		$DisplayEndMonth = $tmpDate[1];
		$DisplayEndDay = $tmpDate[2];
		$DisplayEndYear = $tmpDate[0];	
		
		//------------------------------------------------------------------------------------------------------	
		// provider
		//------------------------------------------------------------------------------------------------------
		$DisplayProvider = $result_arr["FirstName"]." ".$result_arr["LastName"]." ".$result_arr["Suffix"];
		$DisplayProviderID = $result_arr["ProvID"];
		
		//------------------------------------------------------------------------------------------------------
		// the medication
		//------------------------------------------------------------------------------------------------------
		$DisplayMedication = $result_arr["Medication"];
		
		//------------------------------------------------------------------------------------------------------
		// the description
		//------------------------------------------------------------------------------------------------------
		$DisplayVaccInoc = $result_arr["VaccInocType"];
		$DisplayVaccInocTypeID = $result_arr["VaccInocTypeID"];
	}
	else
	{
		//------------------------------------------------------------------------------------------------------
		// error
		//------------------------------------------------------------------------------------------------------
		$errmsg = "Error doing mysql_query for client vaccinocointment. Get vaccinocid = '$_GET[vaccinocid]'. (296)  Too many or too few rows countrow = '$countRows' - '$Medpal'";
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
		
.detailArea {
		position: absolute;
		left:0px;
		top:0px; 
		width:660;
		height:275px;
		background: white;
		border:1px solid black;
		}
		
</style>

<script language="JavaScript" type="text/javascript"> </script>
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
	var fieldRequired = Array("vaccinocStartmonth", "vaccinocStartday", "vaccinocStartyear", 
								"vaccinocEndmonth", "vaccinocEndday", "vaccinocEndyear",
								"vaccinocprovider", "vaccinoctype", "vaccinocmedication");
	// field description to appear in the dialog box
	var fieldDescription = Array("Vaccination Month", "Vaccination Day", "Vaccination Year", "Renew Month", 
									"Renew Day", "Renew Year", "Provider", "Vaccination", "Medication");
	// field description to appear in the dialog box
	var fieldEdit = Array("MM", "DD", "YYYY", "MM", "DD", "YYYY", "None", "None", "None");
							
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
<div class="detailformPos">
<form  action="UAmedvi.php" method=post onsubmit="return formCheck(this);">
<table width="100%" class="outerBorderMessageTitleBlue">
	<tr>
		 <td height=20 align="center">Update Vaccination Detail</td>
	</tr>	
</table>
<table width="100%" class="SmTxt">
	<tr valign=top>
		<td align=right colspan=4 height=15>&nbsp;</td>
	</tr>
	<tr valign=top>
		<td align=right height=35>Vaccination Date:</td>
		<td align=left colspan=3>
			<input size=2 type="text" name="vaccinocStartmonth" value="<? print $DisplayStartMonth; ?>">/
			<input size=2 type="text" name="vaccinocStartday" value="<? print $DisplayStartDay; ?>">/
			<input size=4 type="text" name="vaccinocStartyear" value="<? print $DisplayStartYear; ?>"> (MM/DD/YYYY)
		</td>
	</tr>	
	<tr>
		<td align=right height=35>Renew Date:</td>
		<td align=left colspan=3>
			<input size=2 type="text" name="vaccinocEndmonth" value="<? print $DisplayEndMonth; ?>">/
			<input size=2 type="text" name="vaccinocEndday" value="<? print $DisplayEndDay; ?>">/
			<input size=4 type="text" name="vaccinocEndyear" value="<? print $DisplayEndYear; ?>"> (MM/DD/YYYY)
		</td>
	</tr>
	<tr>
		<td align=right height=35>Provider:</td>
		<td colspan=3 align=left>
			<select name="vaccinocprovider"> <option class="smallTxtGry" value="<? print $DisplayProviderID; ?>"><? print $DisplayProvider; ?> 
			<? print $DisplayProviderList; ?>
			</select>
		</td>
	</tr>
	<tr valign=top>
		<td align=right height=35>Vaccination:</td>
		<td align=left>
			<select name="vaccinoctype"> 
					<option class="smallTxtGry" value="<? print $DisplayVaccInocTypeID; ?>"><? print $DisplayVaccInoc; ?> 
					<? print $DisplayVaccInocTypeList; ?>
				</select>
		</td>	
	</tr>
	<tr valign=top>
		<td align=right height=35>Medication:</td>
		<td colspan=3 align=left><input size=45 maxlength=255 type="text" name="vaccinocmedication" value="<? print $DisplayMedication; ?>"> </td>
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
<input type='hidden' name='vaccinocid'  value='<? print $DisplayVaccInocID; ?>'>
</form>
</div>
</div>
</body>
</html>
