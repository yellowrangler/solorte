<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_UAmedhistdetail.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

require ('hysStatusMsg.php');

//----------------------------------------------------------------------------------------------------------
// It is now time to build some of our display blocks that will fit within our select groups
//----------------------------------------------------------------------------------------------------------


// This will build the Scan Def Type drop downs and jscript to manage them
$formName = "addScan";
require ('ScanTypeDefInclude.php');

//----------------------------------------------------------------------------------------------------------
// get Event Types
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT * from EventTypeTBL ORDER BY EventType"; 

//----------------------------------------------------------------------------------------------------------
// Make the call
//----------------------------------------------------------------------------------------------------------
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for EventTypeTBL  (395) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------
// initialize display block
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
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
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
// get doctors names
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT DISTINCT FirstName, LastName, Suffix, ClientProviderTBL.ProviderID as ProvID 
			from ClientProviderTBL 
			left join ProviderTBL on ClientProviderTBL.ProviderID = ProviderTBL.ID	
			left join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID 
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

//----------------------------------------------------------------------------------------------------------
// Initialize some display variables
//----------------------------------------------------------------------------------------------------------
$readonly = "class =\"readonlyText\" readonly";
$DisplayReadOnly = $readonly;
$DisplaySubmitButton = "hidden";

$DisplaySubmitButton = "hidden";
 
//----------------------------------------------------------------------------------------------------------
// The rest of the db calls require an event to be present.  So we test to see if get was passed to us.
//  If not get then it is assumed to be new event.
//
// We have gotten here via UAmedhistlist or we are adding new event
//----------------------------------------------------------------------------------------------------------
if (isset($_GET[eventid]) and ($_GET[eventid] != ""))
{
			
	//----------------------------------------------------------------------------------------------------------
	// create the SQL statement to get our prescription, date, provider and pharmacy information for the row 
	// selected from if_presclist
	//----------------------------------------------------------------------------------------------------------
	$sql = "SELECT distinct FirstName, LastName, Suffix, StartDate, StartTime, Event, ICD9Text, ICD9Code,
					ClientEventTBL.ProviderID as ProvID, ClientEventTBL.HostID, EventTypeTBL.EventType, 
					EventTypeTBL.ID as EventTypeID, HostTBL.ID as HostID,
					HostTBL.Name, HostTBL.URL as HostURL, ClientEventTBL.ID as EventID 
						from ClientEventTBL 
						left join CalendarTBL on ClientEventTBL.CalendarID = CalendarTBL.ID
						left join EventTypeTBL on ClientEventTBL.EventTypeID = EventTypeTBL.ID
						left join ClientProviderTBL on ClientEventTBL.MEDPAL = ClientProviderTBL.MEDPAL
						left join ProviderTBL on ClientEventTBL.ProviderID = ProviderTBL.ID
						left join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID
						left join HostTBL on ClientEventTBL.HostID = HostTBL.ID
						left join ClientDiagnosisTBL on ClientDiagnosisTBL.ID = ClientEventTBL.DiagnosisID
							where ( ClientProviderTBL.MEDPAL = '$Medpal' and ClientEventTBL.ID = '$_GET[eventid]')";
					
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query for ClientEventTBL and large join \n sql = '$sql'\n (195) - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
		
	//----------------------------------------------------------------------------------------------------------	
	// Now lets first see if there is anything to run through.  If more or less then 1 we have an error
	//----------------------------------------------------------------------------------------------------------
	$countRows = mysql_num_rows($sql_result);
	if ($countRows != 1)
	{
		$errmsg = " Error No rows or more then 1 row returned in select on ClientEventTBL. count = '$countRows'  - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
	
	//----------------------------------------------------------------------------------------------------------
	// Set flag to open file upload field
	//----------------------------------------------------------------------------------------------------------
	$DisplayReadOnly = "";
	$DisplaySubmitButton = "submit";
	
	//----------------------------------------------------------------------------------------------------------
	// now lets fetch our prescription information
	//----------------------------------------------------------------------------------------------------------
	$result_array = mysql_fetch_assoc($sql_result);
	
	//----------------------------------------------------------------------------------------------------------
	// Format the date for display
	//----------------------------------------------------------------------------------------------------------
	$tmpDate = CovertMySQLDate($result_array["StartDate"], 1, 9);
	
	$DisplayMonth = $tmpDate[1];
	$DisplayDay = $tmpDate[2];
	$DisplayYear = $tmpDate[0];
	
	// Second Service time
	$tmpTime = CovertMySQLTime($result_array["StartTime"], 1, 9);
	
	$DisplayHour = $tmpTime[0];
	$DisplayMin = $tmpTime[1];
	$DisplayAMPM = $tmpTime[3];

	// This field is needed for the update
	$EventID = $result_array["EventID"];
	
}	// End of IF Update
?>
<html>

<head>
<title>HealthYourSelf Customer Appointment Calander</title>
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
		
.readonlyText {
		font: 400 13px Arial, Geneva;
		background: #ccff99;
		color: black;
		}	

.SmTxt   { 
		font: 400 13px Arial, Geneva;
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
		
.detailBody {
		position: absolute;
		left:0px;
		top:0px; 
		width:685px;
		height:220px;
		background: white;
		border:1px solid black;
		}		
	
.scanUploadBody {
		position: absolute;
		left:0px;
		top:235px; 
		width:685px;
		height:110px;
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
		top:380px; 
		width:685;
		height:40px;
		background: white;
		border:0px solid black;
		}
		
.innerScanlistframeTableTitle   { 
		color: white;
		font: 700 15px Arial, Geneva;
		background: blue;
		}
		
		
.innerScanlistframe {
		position: absolute;
		left:0px;
		top:425px; 
		width:683;
		height:100px;
		background: white;
		border:1px solid black;
		}
		
</style>		
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
	var fieldRequired = Array("month", "day", "year", "serhour", "sermin", "serampm", "provider", "hosts", "eventtype", "desc");
	// field description to appear in the dialog box
	var fieldDescription = Array("Month", "Day", "Year",  "Hour", "Minute", "AMPM", "Provider", "Location", "Type", "Description");
	// field description to appear in the dialog box
	var fieldEdit = Array("MM", "DD", "YYYY",  "HH", "MI",  "None", "None", "None", "None", "None");
							
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

<?php print $jscriptScanDefSelect; ?>

// -->	
</script>
		
</head>

<body <?php print $BodySelectColor ?> onload="startUp()">

<div class="detailBody">
<form  action="UAmedhist.php" name="histupdate"  method=post onsubmit="return formCheck(this);">
<table width="100%" class="outerBorderMessageTitleBlue">
	<tr>
		 <td height=15 align="center">Maintain History Detail</td>
	</tr>	
</table>
<table width="100%" class="SmTxt">
	<tr>
		<td align=right>Date:</td>
		<td align=left>
			<input size=2 type="text" name="month" value="<?php print $DisplayMonth; ?>">/
			<input size=2 type="text" name="day" value="<?php print $DisplayDay; ?>">/
			<input size=4 type="text" name="year" value="<?php print $DisplayYear; ?>"> (MM/DD/YYYY)
		</td>
	
		<td align=right height=25>Time:</td>
		<td align=left>
			<input class="SmTxt" size=2 type="text" name="hour" value="<?php print $DisplayHour; ?>">:
			<input class="SmTxt" size=2 type="text" name="min" value="<?php print $DisplayMin; ?>">&nbsp;  
			<SELECT name="ampm"> 
				<option value="<?php print $DisplayAMPM; ?>"><?php print $DisplayAMPM; ?>
				<OPTION value="AM">AM 
				<OPTION value="PM">PM
			</SELECT> (HH:MM)
		</td>
	</tr> 
	
	<tr>
		<td align=right height=25>Type:</td>
		<td align=left colspan=2>
			<select name="eventtype"> 
				<option class="smallTxtGry" value="<?php print $result_array[EventTypeID]; ?>"><?php print $result_array[EventType]; ?> 
				<?php print $DisplayEventTypeList; ?>
			</select>
		</td>
	</tr>	
	
	<tr>
		<td align=right height=25>Provider:</td>
		<td align=left>
			<select name="provider" onChange="UpdateHostList();"> 
				<option class="smallTxtGry" value="<?php print $result_array[ProvID]; ?>"><?php  print $result_array[FirstName]; ?> <?php print $result_array[LastName]; ?> <?php print $result_array[Suffix]; ?> 
				<?php print $DisplayProviderList; ?>
			</select>
		</td>
		<td align=right height=25>Location:</td>
		<td align=left>
			<select name="hosts"> 
				<option class="smallTxtGry" value="<?php print $result_array[HostID]; ?>"><?php print $result_array[Name]; ?> 
					<?php print $DisplayHostList; ?>
			</select>
		</td>
	</tr> 

	<tr>
		<td align=right height=25>Description:</td>
		<td align=left colspan=3><input size=60 maxlength=255 type="text" name="desc" value="<?php print $result_array[Event]; ?>"> </td>
	</tr> 
	<tr>
		<td align=right height=25>ICD:</td>
		<td align=left><input size=15 maxlength=25 type="text" name="icd" value="<?php print $result_array[ICD9Code]; ?>"> </td>
	
		<td align=right height=25>Diagnosis:</td>
		<td align=left><input size=30 maxlength=255 type="text" name="diag" value="<?php print $result_array[ICD9Text]; ?>"> </td>
	</tr> 
</table>
<br>
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
<input type="hidden" name="eventid" value="<?php print $EventID; ?>">	
</form>
</div>

<div class="scanUploadBody">
<form  action="UAmedhistscan.php" enctype="multipart/form-data" method=post name="addScan" onsubmit="return formCheck2(this);">
<table width="100%" class="outerBorderMessageTitleBlue">
	<tr>
		 <td height=15 align="center">Upload Scanned Images</td>
	</tr>	
</table>
<table cellspacing=0 cellpadding=0 width="100%" class="SmTxt" align=left>
	<tr>
		<td width=35>&nbsp;</td>
		
		<td height=25 valign=center align=right>Upload:</td>
		<td height=25 valign=center align=left><input size=50 type="file" <?php print $DisplayReadOnly; ?>  name="fileupload"></td>
	</tr>
	
	<tr>
		<td>&nbsp;</td>	
		
		<td height=25 valign=center align=right>Description:&nbsp;</td>
		<td height=25 valign=center align=left>
			<input size=50 maxlength=255 type="text" <?php print $DisplayReadOnly; ?>  name="desc" value="">
			<input type=<?php print $DisplaySubmitButton; ?> size=150 NAME="SUBMIT" <?php print $DisplayReadOnly; ?>  VALUE="Send File">
		</td>
	</tr>
	
	<tr>	
		<td>&nbsp;</td>	
		
		<td colspan=2>
			<table align=left class="SmTxt">
				<tr>
					<td width=20>&nbsp;</td>
					
					<td height=25 valign=center align=right>Scan Type:</td>
					<td align=left>
						<select name="scantype" onchange="buildScanDef();"> 
							<option class="smallTxtGry" value="<?php print $result_array[ScanTypeID]; ?>"><?php print $result_array[ScanType]; ?> 
							<?php print $DisplayScanTypeList; ?>
						</select>
					</td>
					
					<td width=50>&nbsp;</td>
					
					<td height=25 valign=center align=right>Scan Definition:</td>
					<td align=left colspan=2>
						<select name="scandefinition"> 
							<option class="smallTxtGry" value="            "> 
						</select>
					</td>
					
				</tr>
			</table>
		</td>
		
	</tr>
	
</table>
<input type="hidden" name="eventid" value="<?php print $EventID; ?>">
<input type="hidden" name="MAX_FILE_SIZE" value="512000">
</form>
</div>

<div class="innerScanlistframeTitle">
<table width="100%" class="innerScanlistframeTableTitle" cellspacing=0>
	<tr>
		<td width="100%" align=center height=20 colspan=3>Scanned Documents</td>
	</tr>	
	<tr>
		<td width="25%" align="center" height="20"><a href="if_UAmedhistscanlist.php?eventid=<?php print $EventID ?>&order=type"  class="linkTitletype" target="scanFramelist">Type</a></td>
		<td width="25%" align="center" height="20"><a href="if_UAmedhistscanlist.php?eventid=<?php print $EventID ?>&order=def"  class="linkTitletype" target="scanFramelist">Def</a></td>
		<td width="35%" align="center"><a href="if_UAmedhistscanlist.php?eventid=<?php print $EventID ?>&order=desc"  class="linkTitletype" target="scanFramelist">Description</a></td>
		<td width="15%" align="center">Image</td>
	</tr>	
</table>
</div>
<IFRAME name="scanFramelist" src="if_UAmedhistscanlist.php?eventid=<?php print $EventID; ?>" class="innerScanlistframe" scrolling=auto frameborder=0> </IFRAME>
</body>
</html>
