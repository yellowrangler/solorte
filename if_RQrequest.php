<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_RQrequest.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysStatusMsg.php');

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
	$errmsg = "$sqlerr - Error doing mysql_query for ClientHostTBL left join HostTBL  (495) - '$Medpal'";
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

?>
<html>

<head>
<title>HealthYourSelf Customer Request</title>

<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />
<style type="text/css"> 


.detailArea {
		position: absolute;
		left:20px;
		top:40px; 
		width:650px;
		height:310px;
		background: white;
		border:1px solid black;
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
		line-height: 25px; 
		}			
		
.smallTxtGry {
		font:400 13px Arial,Geneva;
		color:#333;
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
	var fieldRequired = Array("month", "day", "year", "serhour", "sermin", "ampm", "provider", "location",
								"eventtype", "desc");
	// field description to appear in the dialog box
	var fieldDescription = Array("Month", "Day", "Year", "Hour", "Minute", "AMPM", "Provider", "Location", 
							"Type", "Description");
	// field description to appear in the dialog box
	var fieldEdit = Array("MM", "DD", "YYYY", "HH", "MI", "None", "None", "None", "None", "None");
							
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

<div class="detailArea">
<form  action="RQrequest.php" method=post onsubmit="return formCheck(this);">
<table width="100%" class="outerBorderMessageTitleBlue">
	<tr>
		 <td height=20 align="center">Enter Request Information</td>
	</tr>	
</table>
<table width="100%" class="SmTxt">
	<tr>
		<td align=right height=40>Service Date:</td>
		<td align=left>
			<input size=2 type="text" name="month" value="">&nbsp;/&nbsp;
			<input size=2 type="text" name="day" value="">&nbsp;/&nbsp;
			<input size=4 type="text" name="year" value=""> (MM/DD/YYYY)
		</td>
	</tr>	
	<tr>
		<td align=right height=40>Service Time:</td>
		<td align=left colspan=5>
			<input size=2 type="text" name="serhour" value="">&nbsp;:&nbsp;
			<input size=2 type="text" name="sermin" value="">&nbsp;  
			<SELECT name="ampm"> 
				<OPTION label="am" value="AM">AM </OPTION>
				<OPTION label="pm" value="PM">PM</OPTION>
			</SELECT> (HH:MM AM/PM)
		</td>
	</tr>
	
	<tr>
		<td align=right height=40>Provider:</td>
		<td align=left>
			<select name="provider"> 
				<option class="smallTxtGry" value="<?php print $DisplayProviderID; ?>"><?php print $DisplayProvider; ?> 
				<?php print $DisplayProviderList; ?>
			</select>
		</td>
		
		<td  height=40 align=right>Location: </td>
		<td align=left>
			<select name="location"> 
				<option class="smallTxtGry" value="<?php print $DisplayHostID; ?>"><?php print $DisplayHost; ?> 
				<?php print $DisplayHostList; ?>
			</select>
		</td>
	</tr>
		
	</tr> 
		<td align=right height=40>Type:</td>
		<td align=left>
			<select name="eventtype"> 
				<option class="smallTxtGry" value="">
				<?php print $DisplayEventTypeList; ?>
			</select>
		</td>
	<tr>
		<td align=right height=40>Description:</td>
		<td align=left colspan=3><input size=60 maxlength=255 type="text" name="desc" value=""> </td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td colspan=6 align=center>
			<table>
				<tr>
					<td align=center><input type=submit size=150 NAME="SUBMIT" VALUE="Submit"></td>
					<td>&nbsp;</td>
					<td align=center><input type=reset size=150 NAME="RESET" VALUE="Reset"></td>
				</tr>
			</table>
		</td>	
	</tr>
</table>	
</form>
</div>

</body>
</html>
