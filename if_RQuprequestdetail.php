<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_RQuprequestdetail.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

require ('hysStatusMsg.php');

//----------------------------------------------------------------------------------------------------------
// get Scan Types
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT * from ScanTypeTBL"; 

//----------------------------------------------------------------------------------------------------------
// Make the call
//----------------------------------------------------------------------------------------------------------
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ScanTypeTBL  (395) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------
// initialize display block
//----------------------------------------------------------------------------------------------------------
$DisplayScanTypeList = "";

//----------------------------------------------------------------------------------------------------------
// Now lets first see if there is anything to run through
//----------------------------------------------------------------------------------------------------------
$countRows = mysql_num_rows($sql_result);
if ($countRows >  0) 
{	
	// now lets run the table and get our Event types
	while ($result_arr = mysql_fetch_assoc($sql_result))
	{
		$DisplayScanTypeList .= "\t\t\t<option value=\"".$result_arr[ID]."\" >".$result_arr[ScanType]."\n ";
	}
}	

//----------------------------------------------------------------------------------------------------------
// get doctors names for drop down list
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT DISTINCT FirstName, LastName, Suffix, ClientProviderTBL.ProviderID as ProvID 
		from ClientProviderTBL 
			left join ProviderTBL on ClientProviderTBL.ProviderID = ProviderTBL.ID	
			inner join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID where ClientProviderTBL.MEDPAL = '$Medpal'";

// Make the call
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ClientProviderTBL left join FullNameTBL  (395) - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
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
// now lets get host names for drop down list
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT DISTINCT Name, HostTBL.ID as HostID 
	from ClientHostTBL  
		left join HostTBL on ClientHostTBL.HostID = HostTBL.ID 
			where ClientHostTBL.MEDPAL = '$Medpal'";

// Make the call
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ClientProviderTBL left join HostTBL  (495) - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// initialize display block
$DisplayHostList = "";
$DisplayHostID = "None";

// Now lets first see if there is anything to run through
$countRows = mysql_num_rows($sql_result);
if ($countRows >  0) 
{	
	// now lets run the table and get our provider names
	while ($result_arr = mysql_fetch_assoc($sql_result))
	{
		$DisplayHostList .= "\t\t\t<option value=\"".$result_arr[HostID]."\" >".$result_arr[Name]."\n ";
	}
}	

//----------------------------------------------------------------------------------------------------------
// get Event Types for our drop down list
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT * from EventTypeTBL ORDER BY EventType"; 

//----------------------------------------------------------------------------------------------------------
// Make the call
//----------------------------------------------------------------------------------------------------------
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for EventTypeTBL  (395) - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------
// initialize Event list display block
//----------------------------------------------------------------------------------------------------------
$DisplayEventTypeList = "";

//----------------------------------------------------------------------------------------------------------
// Now lets first see if there is anything to run through
//----------------------------------------------------------------------------------------------------------
$countRows = mysql_num_rows($sql_result);
if ($countRows >  0) 
{	
	// now lets run the table and get our Event types
	while ($result_arr = mysql_fetch_assoc($sql_result))
	{
		$DisplayEventTypeList .= "\t\t\t<option value=\"".$result_arr[ID]."\" >".$result_arr[EventType]."\n ";
	}
}	

//----------------------------------------------------------------------------------------------------------
// get Event Types for our drop down list
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT * from RequestStatusTBL
	ORDER BY ID"; 

//----------------------------------------------------------------------------------------------------------
// Make the call
//----------------------------------------------------------------------------------------------------------
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for RequestStatusTBL  (395) - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------
// initialize RequestStatus list display block
//----------------------------------------------------------------------------------------------------------
$DisplayRequestStatusList = "";

//----------------------------------------------------------------------------------------------------------
// Now lets first see if there is anything to run through
//----------------------------------------------------------------------------------------------------------
$countRows = mysql_num_rows($sql_result);
if ($countRows >  0) 
{	
	// now lets run the table and get our Event types
	while ($result_arr = mysql_fetch_assoc($sql_result))
	{
		$DisplayRequestStatusList .= "\t\t\t<option value=\"".$result_arr[ID]."\" >".$result_arr[Description]."\n ";
	}
}	

//----------------------------------------------------------------------------------------------------------
// Initialize some display variables
//----------------------------------------------------------------------------------------------------------
$readonly = "class =\"readonlyText\" readonly";
$DisplayReadOnly = $readonly;
$DisplaySubmitButton = "hidden";

if (isset($_GET[requestid]) and ($_GET[requestid] != ""))
{
	$DisplayRequestID = $_GET[requestid];
	
	//----------------------------------------------------------------------------------------------------------
	// create the SQL statement to get our request detail information,
	//----------------------------------------------------------------------------------------------------------
	$sql = "SELECT distinct FirstName, LastName, Suffix, StartDate, StartTime, Name, EventType, EventTypeID, Comments,
						ClientRequestTBL.ID as crID, RequestDateTime, Request, Description, ProviderID, ClientEventID,
						ClientEventTBL.HostID as CEHostID, ClientRequestTBL.CurrentStatus as rsID, ICD9Text, ICD9Code
					from ClientEventTBL 
						left join ClientRequestTBL on ClientRequestTBL.ClientEventID = ClientEventTBL.ID
						left join RequestStatusTBL on  ClientRequestTBL.CurrentStatus = RequestStatusTBL.ID
						left join CalendarTBL on ClientEventTBL.CalendarID = CalendarTBL.ID
						left join EventTypeTBL on ClientEventTBL.EventTypeID = EventTypeTBL.ID
						left join HostTBL on ClientEventTBL.HostID = HostTBL.ID
						left join ProviderTBL on ClientEventTBL.ProviderID = ProviderTBL.ID
						left join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID
						left join ClientDiagnosisTBL on ClientDiagnosisTBL.ID = ClientEventTBL.DiagnosisID
							where ( ClientRequestTBL.MEDPAL = '$Medpal' and ClientRequestTBL.ID = '$_GET[requestid]'
							and ClientEventTBL.CurrentStatus = '0') ";
		
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query for ClientRequestTBL and join RequestStatusTBL EventTypeTBL\n sql = '$sql'\n (195) - '$Medpal'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
			
	//----------------------------------------------------------------------------------------------------------	
	// Now lets first see if there is anything to run through.  If more or less then 1 we have an error
	//----------------------------------------------------------------------------------------------------------
	$countRows = mysql_num_rows($sql_result);
	if ($countRows != 1)
	{
		$errmsg = " Error No rows or more then 1 row returned in select on ClientRequestTBL. count = '$countRows'  - '$Medpal'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
	
	//----------------------------------------------------------------------------------------------------------
	// Set flag to open file upload field
	//----------------------------------------------------------------------------------------------------------
	$DisplayReadOnly = "";
	$DisplaySubmitButton = "submit";
	
	//----------------------------------------------------------------------------------------------------------
	// now lets fetch our request information
	//----------------------------------------------------------------------------------------------------------
	$result_array = mysql_fetch_assoc($sql_result);
	
	//----------------------------------------------------------------------------------------------------------
	// Format the date for display
	//----------------------------------------------------------------------------------------------------------
	
	// First Service date
	$tmpDate = CovertMySQLDate($result_array["StartDate"], 1, 9);
	
	$DisplayServiceMonth = $tmpDate[1];
	$DisplayServiceDay =  $tmpDate[2];
	$DisplayServiceYear = $tmpDate[0];
	
	// Second Service time
	$tmpTime = CovertMySQLTime($result_array["StartTime"], 1, 9);
	
	$DisplayServiceHour = $tmpTime[0];
	$DisplayServiceMin = $tmpTime[1];
	$DisplayServiceAMPM = $tmpTime[3];
	
	// Third request date
	$tmpDate = CovertMySQLDate($result_array["RequestDateTime"], 2, 9);
	
	$DisplayRequestMonth = $tmpDate[1];
	$DisplayRequestDay =  $tmpDate[2];
	$DisplayRequestYear = $tmpDate[0];
	
	// Third request time
	$tmpTime = CovertMySQLTime($result_array["RequestDateTime"], 2, 9);
	
	$DisplayRequestHour = $tmpTime[0];
	$DisplayRequestMin = $tmpTime[1];
	$DisplayRequestAMPM = $tmpTime[3];
	
} // End of IF GET
	
?>
<html>

<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css"> 
		
.outerBorderblackSmTxt {
		font: 400 13px Arial, Geneva;
		line-height: 14px; 
		border-top:0px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		background: #ffffff;
		}	

.outerBorderblackfillSiennaSmTxt {
		font: 400 13px Arial, Geneva;
		line-height: 14px; 
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		background: #ccccff;
		}	
		
.outerBorderMessageTitleBlue {
		color: white;
		font: 700 11px Arial,Helvetica;
		text-align: center;
		letter-spacing: 8px;
		border-top:1px solid #052faf;
		border-left:1px solid #052faf;
		border-right:1px solid #052faf;
		border-bottom:1px solid #052faf;
		background: #052faf;
		}		
		
.outerBorderblackfillActionSmTxt {
		font: 700 13px Arial, Geneva;
		line-height: 14px; 
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		background: #ccccff;
		}
		
.outerBorderblackfillSiennaSmTxt3 {
		font: 700  13px Arial, Geneva;
		line-height: 15px; 
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		background: #ccccff;
		}

.linkTitletype {
		color: white;
		font: 700 11px Arial,Helvetica;
		text-align: center;
		text-decoration: none;
		}			

.linkTitletype:hover {
		color: yellow;
		font: 700 11px Arial,Helvetica;
		text-align: center;
		text-decoration: underline;
		}
		
.detailBody {
		position: absolute;
		left:0px;
		top:0px; 
		width:685px;
		height:292px;
		font: 400 11px Arial, Geneva;
		background: white;
		border:1px solid black;
		}		

.scanUploadBody {
		position: absolute;
		left:0px;
		top:320px; 
		width:685px;
		height:95px;
		font: 400 11px Arial, Geneva;
		background: white;
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		}

.innerScanlistframeTitle {
		position: absolute;
		left:0px;
		top:450px; 
		width:685;
		height:40px;
		background: white;
		border:0px solid black;
		}


.innerScanlistframe {
		position: absolute;
		left:0px;
		top:490px; 
		width:683;
		height:95px;
		background: white;
		border:1px solid black;
		}
		
.readonlyText {
		font: 400 11px Arial, Geneva;
		line-height: 11px; 
		background: #ccff99;
		color: black;
		}	
		
.SmTxt   { 
		font: 400 11px Arial, Geneva;
		line-height: 11px; 
		}
</style>		
<head>
<title>HealthYourSelf Customer Request Status</title>
<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>
<script type="text/javascript">
function startUp() 
{	
	<?php print $JavaScriptLogMsg; ?>
		
	<?php print $JavaScriptMsg; ?>
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
	var fieldRequired = Array("sermonth", "serday", "seryear", "serhour", "sermin", "serampm", "provider", "location",
								"eventtype", "desc");
	// field description to appear in the dialog box
	var fieldDescription = Array("Month", "Day", "Year", "Hour", "Minute", "AMPM",  "Provider", "Location", 
							"Type", "Description");
	// field description to appear in the dialog box
	var fieldEdit = Array("MM", "DD", "YYYY", "HH", "MI",  "None", "None", "None", "None", "None");
							
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


function formCheck2(formobj){
	// name of mandatory fields
	var fieldRequired = Array("fileupload", "scantype", "desc");
	// field description to appear in the dialog box
	var fieldDescription = Array("File Name", "Scan Type",  "Description");
	// field description to appear in the dialog box
	var fieldEdit = Array("None", "None", "None");
							
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

<body <?php print $BodySelectColor ?> onload="startUp()">

<div class="detailBody">
<form  action="RQuprequest.php" name="uprequest"  method=post onsubmit="return formCheck(this);">
<table width="100%" class="outerBorderMessageTitleBlue">
	<tr>
		 <td height=11 align="center">Maintain Request Status Detail</td>
	</tr>	
</table>
<table cellspacing=0 border=0 cellpadding=0 width="100%" class="SmTxt">
	<tr>
		<td height=1 class="SmTxt" colspan=4>&nbsp;</td>
	</tr>
	<tr>
		<td align=right height=25>Status:&nbsp;</td>
		<td align=left colspan=1>
			<select name="status"> 
				<option class="smallTxtGry" value="<?php print $result_array[rsID]; ?>"><?php print $result_array[Description]; ?>
				<?php print $DisplayRequestStatusList; ?>
			</select>
		</td>
		
		<td align=right height=25>Request ID:</td>
		<td align=left><input <?php print $readonly; ?> size=10 maxlength=10 type="text" name="requestid" value="<?php print $result_array[crID]; ?>"> </td>
	
	</tr>	
	<tr>
		<td align=right height=25>Request Date:</td>
		<td align=left> 
			<input <?php print $readonly; ?> size=2 type="text" name="reqmonth" value="<?php print $DisplayRequestMonth; ?>">/
			<input <?php print $readonly; ?> size=2 type="text" name="reqday" value="<?php print $DisplayRequestDay; ?>">/
			<input <?php print $readonly; ?> size=4 type="text" name="reqyear" value="<?php print $DisplayRequestYear; ?>">
		</td>
	
		<td align=right height=25>Request Time:</td>
		<td align=left>
			<input <?php print $readonly; ?> size=2 type="text" name="reqhour" value="<?php print $DisplayRequestHour; ?>">:
			<input <?php print $readonly; ?> size=2 type="text" name="reqmin" value="<?php print $DisplayRequestMin; ?>">&nbsp;  
			<input <?php print $readonly; ?> size=2 type="text" name="reqampm" value="<?php print $DisplayRequestAMPM; ?>">
		</td>
	</tr>

	<tr>
		<td align=right height=25>Service Date:</td>
		<td align=left colspan=3>
			<input class="SmTxt" size=2 type="text" name="sermonth" value="<?php print $DisplayServiceMonth; ?>">/
			<input class="SmTxt" size=2 type="text" name="serday" value="<?php print $DisplayServiceDay; ?>">/
			<input class="SmTxt" size=4 type="text" name="seryear" value="<?php print $DisplayServiceYear; ?>"> (MM/DD/YYYY)
		</td>
	</tr>
	
	<tr>
		<td align=right height=25>Service Time:</td>
		<td align=left colspan=3>
			<input class="SmTxt" size=2 type="text" name="serhour" value="<?php print $DisplayServiceHour; ?>">:
			<input class="SmTxt" size=2 type="text" name="sermin" value="<?php print $DisplayServiceMin; ?>">&nbsp;  
			<SELECT name="serampm"> 
				<option value="<?php print $DisplayServiceAMPM; ?>"><?php print $DisplayServiceAMPM; ?>
				<OPTION value="AM">AM 
				<OPTION value="PM">PM
			</SELECT> (HH:MM AM or PM)
		</td>
	</tr>
	
	<tr >
		<td align=right height=25>Type:</td>
		<td align=left colspan=4>
			<select name="eventtype"> 
				<option class="smallTxtGry" value="<?php print $result_array[EventTypeID]; ?>"><?php print $result_array[EventType]; ?> 
				<?php print $DisplayEventTypeList; ?>
			</select>
		</td>
	</tr>
	<tr>	
		<td align=right height=25>Provider:</td>
		<td align=left>
			<select name="provider"> 
				<option class="smallTxtGry" value="<?php print $result_array[ProviderID]; ?>"><?php print $result_array[FirstName]." ".$result_array[LastName]." ".$result_array[Suffix]; ?>
				<?php print $DisplayProviderList; ?>
			</select>
		</td>
	
		<td align=right height=25>Location:</td>
		<td align=left>
			<select name="location"> 
				<option class="smallTxtGry" value="<?php print $result_array[CEHostID]; ?>"><?php print $result_array[Name]; ?> 
				<?php print $DisplayHostList; ?>
			</select>
		</td>
	</tr> 
	
	<tr>
		<td align=right height=25>ICD:</td>
		<td align=left><input class="SmTxt" size=15 maxlength=25 type="text" name="icd" value="<?php print $result_array[ICD9Code]; ?>"> </td>
	
		<td align=right height=25>Diagnosis:</td>
		<td align=left><input class="SmTxt" size=30 maxlength=255 type="text" name="diag" value="<?php print $result_array[ICD9Text]; ?>"> </td>
	</tr>
	
	<tr >
		<td align=right height=25>Description:&nbsp;</td>
		<td align=left colspan=4><input class="SmTxt" size=60 maxlength=255 type="text" name="desc" value="<?php print $result_array[Request]; ?>"> </td>
	</tr>
	
	<tr >
		<td align=right height=25>Service Comments:&nbsp;</td>
		<td align=left colspan=4><input class="SmTxt" size=60 maxlength=255 type="text" name="comments" value="<?php print $result_array[Comments]; ?>"> </td>
	</tr>

	<tr>
		<td colspan=4 align=center>
			<table>
				<tr>
					<td width=15>&nbsp;</td>
					<td align=center  height=15><input class="SmTxt" type="submit" name="Action" value="Add"></td>
					<td width=15>&nbsp;</td>
					<td align=center  height=15><input class="SmTxt" type="submit" name="Action" value="Update"></td> 
					<td width=15>&nbsp;</td>
					<td align=center  height=15><input class="SmTxt" type="submit" name="Action" value="Delete"></td> 
					<td width=10>&nbsp;</td>
					<td align=center  height=15><input class="SmTxt" type=reset size=150 NAME="RESET" VALUE="Reset"></td>
					<td>&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</center>
<input class="SmTxt" type="hidden" name="dummy" value="">	
</form>
</div>

<div class="scanUploadBody">
<form  action="RQupscan.php" enctype="multipart/form-data" method=post onsubmit="return formCheck2(this);">
<input type="hidden" name="MAX_FILE_SIZE" value="512000">
<table width="100%" class="outerBorderMessageTitleBlue">
	<tr>
		 <td height=15 align="center">Upload Scaned Documents and Images</td>
	</tr>	
</table>
<table cellspacing=0 cellpadding=0 width="100%" class="SmTxt" align=center>
	<tr>	
		<td class="SmTxt" width=10>&nbsp;</td>
		<td class="SmTxt" height=15 valign=center align=right>Scanned Document to Upload:</td>
		<td class="SmTxt" height=15 valign=center align=left><input size=50 type="file" <?php print $DisplayReadOnly; ?>  name="fileupload"></td>
		<td class="SmTxt" width=10>&nbsp;</td>
	</tr>
	
	<tr>
		<td class="SmTxt" width=10>&nbsp;</td>
		<td class="SmTxt" height=15 valign=center align=right>Description:&nbsp;</td>
		<td class="SmTxt" height=15 valign=center align=left>
			<input <?php print $DisplayReadOnly; ?> size=50 maxlength=255 type="text" name="desc" value="">
			<input <?php print $DisplayReadOnly; ?> type=<?php print $DisplaySubmitButton; ?> size=150 NAME="SUBMIT"  VALUE="Send File">
		</td>
		<td class="SmTxt">&nbsp;</td>
	</tr>
	<tr>	
		<td width=10>&nbsp;</td>
		<td height=15 valign=center align=right>Scan Type:</td>
		<td align=left>
			<select name="scantype" <?php print $DisplayReadOnly; ?>> 
				<option class="smallTxtGry" value="<?php print $result_array[ScanTypeID]; ?>"><?php print $result_array[ScanType]; ?> 
				<?php print $DisplayScanTypeList; ?>
			</select>
		</td>
		<td>&nbsp;</td>
	</tr>
</table>
<input type="hidden" name="eventid" value="<?php print $result_array[ClientEventID]; ?>">
<input type="hidden" name="requestid" value="<?php print $result_array[crID]; ?>">
</form>
</div>

<div class="innerScanlistframeTitle">
<table width="100%" class="outerBorderMessageTitleBlue">
	<tr>
		<td width="100%" align=center height=15 colspan=3>Scanned Documents</td>
	</tr>	
	<tr>
		<td width="35%" align="center" height=15><a href="if_UAmedhistscanlist.php?eventid=<?php print $result_array[ClientEventID] ?>&order=type"  class="linkTitletype" target="scanFramelist">Type</a></td>
		<td width="40%" align="center"><a href="if_UAmedhistscanlist.php?eventid=<?php print $result_array[ClientEventID] ?>&order=desc"  class="linkTitletype" target="scanFramelist">Description</a></td>
		<td width="25%" align="center">Image</td>
	</tr>
</table>
</div>

<IFRAME name="scanFramelist" src="if_RQupscanlist.php?eventid=<?php print $result_array[ClientEventID]; ?>" class="innerScanlistframe" scrolling=auto frameborder=0> </IFRAME>

</body>
</html>
