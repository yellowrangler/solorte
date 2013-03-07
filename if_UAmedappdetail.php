<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_UAmedappdetail.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

require ('hysStatusMsg.php');

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
// now lets get host names
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

// set appid to default
$DisplayAppID = "";

//----------------------------------------------------------------------------------------------------------
// we are either being called by default (user selects app udate OR someone has clicked a appointment to 
// update or delete in which case we need the appid OR we have sent a request to add, update or delete
// an appointment and we are now getting back results.  So we need to see first of all is our GET
// set and act accordingly
//----------------------------------------------------------------------------------------------------------
if ( isset($_GET[appid]) and ($_GET[appid] != "") )
{
	$DisplayAppID = $_GET[appid];
	
	// Ok so we are either returning from an action OR selected from a list either way all we do is 
	// build screen and msgtxt
	$sql = "SELECT * from ClientAppointmentTBL inner join CalendarTBL on ClientAppointmentTBL.CalendarID = CalendarTBL.ID
			left join EventTypeTBL on ClientAppointmentTBL.EventTypeID = EventTypeTBL.ID
			left join ProviderTBL on ClientAppointmentTBL.ProviderID = ProviderTBL.ID
			left join HostTBL on ClientAppointmentTBL.HostID = HostTBL.ID
			left join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID
			where ( (MEDPAL = $Medpal) and (ClientAppointmentTBL.ID = '$_GET[appid]') )";
			
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query for client appointment (295) - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
	
	// Now lets process the result set 
	$countRows = mysql_num_rows($sql_result);
	if ($countRows == 1) 
	{
		$result_arr = mysql_fetch_assoc($sql_result);
		// first the date and second the time
		$tmpDate = CovertMySQLDate($result_arr["StartDate"], 1, 9);
			
		$DisplayMonth = $tmpDate[1];
		$DisplayDay = $tmpDate[2];
		$DisplayYear = $tmpDate[0];
		
		
		$tmpTime = CovertMySQLTime($result_arr["StartTime"], 1, 9);
	
		$DisplayHour = $tmpTime[0];
		$DisplayMinute = $tmpTime[1];
		$DisplaySelectedAMPM = $tmpTime[3];
			
		// third the provider
		$DisplayProvider = $result_arr["FirstName"]." ".$result_arr["LastName"]." ".$result_arr["Suffix"];
		$DisplayProviderID = $result_arr["ProviderID"];
		
		// fourth the location
		$DisplayHost = $result_arr["Name"];
		$DisplayHostID = $result_arr["HostID"];
		
		// fith the event type
		$DisplayEventType = $result_arr["EventType"];
		$$DisplayEventTypeID = $result_arr["EventTypeID"];
		
		// sixth the description
		$DisplayDesc = $result_arr["Appointment"];
	}
	else
	{
		// error
		$errmsg = "Error doing mysql_query for client appointment. Get appid = '$_GET[appid]'. (296)  Too many or too few rows countrow = '$countRows' - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
}

?>
<html>

<head>
<title>HealthYourSelf Customer Appointment Calander Update</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css"> 

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
		width:660px;
		height:310px;
		background: white;
		border:1px solid black;
		}

</style>

<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>
<script type="text/javascript" language="JavaScript">
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
	var fieldRequired = Array("appmonth", "appday", "appyear", "apphour", "appmin",
								"appampm", "approvider", "applocation", "eventtype", "appdesc");
	// field description to appear in the dialog box
	var fieldDescription = Array("Month", "Day", "Year", "Hour", "Minute", "AMPM",
								"Provider", "Location", "Type", "Desrciption");
	// field description to appear in the dialog box
	var fieldEdit = Array("MM", "DD", "YYYY", "HH", "MI", "None",
								"None", "None", "None", "None");
							
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

<div name="detailArea" class="detailArea">
<form  action="UAappt.php" method=post  onsubmit="return formCheck(this);">
<table width="100%" class="outerBorderMessageTitleBlue">
	<tr>
		 <td height=20 align="center">Appointment Detail</td>
	</tr>	
</table>
<table width="100%" class="SmTxt">
	<tr>
		<td align=right colspan=2 height=25>&nbsp;</td>
	</tr>
	<tr>
		<td align=right height=40>Date:</td>
		<td align=left colspan=3>
			<input size=2 type="text" name="appmonth" value="<?php print $DisplayMonth; ?>">/
			<input size=2 type="text" name="appday" value="<?php print $DisplayDay; ?>">/
			<input size=4 type="text" name="appyear" value="<?php print $DisplayYear; ?>"> (Format MM/DD/YYYY)
		</td>
	</tr>
	<tr>
		<td align=right height=40>Time:</td>
		<td align=left colspan=3>
			<input size=2 type="text" name="apphour" value="<?php print $DisplayHour; ?>">:
			<input size=2 type="text" name="appmin" value="<?php print $DisplayMinute; ?>">&nbsp;  
			<SELECT name="appampm"> 
				<option value="<?php print $DisplaySelectedAMPM; ?>"><?php print $DisplaySelectedAMPM; ?>
				<OPTION value="AM">AM 
				<OPTION value="PM">PM
			</SELECT> (Format is HH:MM AM or PM)
		</td>
	</tr>
	<tr>
		<td align=right height=40>Provider:</td>
		<td align=left>
			<select name="approvider"> 
				<option class="smallTxtGry" value="<?php print $DisplayProviderID; ?>"><?php print $DisplayProvider; ?> 
				<?php print $DisplayProviderList; ?>
			</select>
		</td>
		<td align=right height=40>Location:</td>
		<td align=left colspan=2>
			<select name="applocation"> 
				<option class="smallTxtGry" value="<?php print $DisplayHostID; ?>"><?php print $DisplayHost; ?> 
				<?php print $DisplayHostList; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td align=right height=40>Type:</td>
		<td align=left colspan=2>
			<select name="eventtype"> 
				<option class="smallTxtGry" value="<?php print $DisplayEventTypeID; ?>"><?php print $DisplayEventType; ?> 
				<?php print $DisplayEventTypeList; ?>
			</select>
		</td>
	</tr>	
	<tr>
		<td align=right height=40>Description:</td>
		<td align=left colspan=3><input size=40 maxlength=255 type="text" name="appdesc" value="<?php print $DisplayDesc; ?>"> </td>
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
		<td width=20>&nbsp;</td>
		<td align=center  height=15><input type=reset size=150 NAME="RESET" VALUE="Reset"></td>
		<td>&nbsp;</td>
	</tr>
</table>
</center>
<input type='hidden' name='appid'  value='<?php print $DisplayAppID; ?>'>
</form>
</div>
</body>
</html>
