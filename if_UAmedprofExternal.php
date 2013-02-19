<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------

$module = 'if_UAmedprofExternal.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysStatusMsg.php');

//----------------------------------------------------------------------------------------------------------
// create the SQL statement to get our clients external medical profile.  
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT * from ClientExternalTBL 
		where ClientExternalTBL.MEDPAL = '$Medpal'";
			
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query join for external and client tbls (195) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------	
// Now lets first see if there is anything to run through.  If more then 1 we have an error
//----------------------------------------------------------------------------------------------------------
$countRows = mysql_num_rows($sql_result);
if ($countRows > 1)
{
	$errmsg = " Error more then 1 rows returned in select for external and client tbls. count = '$countRows'  - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

//----------------------------------------------------------------------------------------------------------
// now lets fetch for our display
//----------------------------------------------------------------------------------------------------------
$result_array = mysql_fetch_assoc($sql_result);

//------------------------------------------------------------------------------------------------------
// convert the date of birth and weight and build height
//------------------------------------------------------------------------------------------------------
$DisplayWeight = sprintf("%s",$result_array["Weight"]);
$tmpHeight = explode("~",$result_array["Height"]);
$DisplayHeightFT = $tmpHeight[0];
$DisplayHeightInches = $tmpHeight[1];
	
?>
<html>

<head>                                      
<title>HealthYourSelf Customer IntrMedical Info</title>

<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css"> 

.detailArea {
		position: absolute;
		left:20px;
		top:40px; 
		width:650px;
		height:430px;
		background: white;
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
	var fieldRequired = Array("profheightft", "profheightinch", "profweight", "profeyecolor", "profglasses", "profvision",
								"profsex", "profprosthesis", "profhaircolor", "profhearing", "profhearingaide", "profskin", 
								"profeyes", "profears", "profnose", "profmouth", "profteeth");
	// field description to appear in the dialog box
	var fieldDescription = Array("Height Feet", "Height Inches", "Weight", "Eye Color", "Glasses", "Vision", "Sex",
								"Prosthesis", "Hair Color", "Hearing", "Hearing Aide", "Skin Conditions". 
								"Eyes", "Ears", "Nose", "Mouth", "Teeth");
	// field description to appear in the dialog box
	var fieldEdit = Array("None", "None", "None", "None", "None", "None", "None", "None", "None", "None", "None", "None", "None", "None", "None", "None", "None");
							
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
<div class="detailArea">
<form  action="UAmedprofExternal.php" method=post onsubmit="return formCheck(this);">
<table width="100%" class="outerBorderMessageTitleBlue">
	<tr>
		 <td height=20 align="center">External Anatomy Profile</td>
	</tr>	
</table>
<table width="100%" class="SmTxt">
	<tr>
		<td align=right height=40>Height:</td>
		<td align=left>
			<table>
				<tr>
					<td>
						<input size=2 maxlength=2 type="text" name="profheightft" value="<? print  $DisplayHeightFT; ?>"> 
						&nbsp;'
						<input size=2 maxlength=2 type="text" name="profheightinches" value="<? print  $DisplayHeightInches; ?>">
						&nbsp;&quot;
					</td>
				</tr>
			</table>	
		</td>
	
		<td align=right height=40>Weight:</td>
		<td align=left><input size=3 maxlength=4 type="text" name="profweight" value="<? print $DisplayWeight; ?>"> Lbs </td>
	</tr>
	
	<tr>
		<td align=right height=40>Sex:</td>
		<td align=left>
			<select name="profsex"> <option  value="<? print $result_array[Sex]; ?>"> <? print $result_array[Sex]; ?>
				<option value="M" >M
				<option value="F" >F
 			</select>
		</td>
		
		<td align=right height=40>Hair Color:</td>
		<td align=left><input size=15 maxlength=25 type="text" name="profhaircolor" value="<? print $result_array[HairColor]; ?>"> </td>

	</tr>
	
	<tr>
		<td align=right height=40>Eye Color:</td>
		<td align=left><input size=10 maxlength=10 type="text" name="profeyecolor" value="<? print $result_array[EyeColor]; ?>"> </td>
		
		<td align=right height=40>Eyes:</td>
		<td align=left><input size=25 maxlength=25 type="text" name="profeyes" value="<? print $result_array[Eyes]; ?>"> </td>
	</tr>
	
	<tr>
		<td align=right height=40>Vision:</td>
		<td align=left><input size=25 maxlength=25 type="text" name="profvision" value="<? print $result_array[Vision]; ?>"> </td>
		
		<td align=right height=40>Glasses:</td>
		<td align=left>
			<select name="profglasses"> <option  value="<? print $result_array[Glasses]; ?>"> <? print $result_array[Glasses]; ?>
				<option value="Y" >Y
				<option value="N" >N
 			</select>
		</td>
	</tr>
		<td align=right height=40>Ears:</td>
		<td align=left><input size=25 maxlength=25 type="text" name="profears" value="<? print $result_array[Ears]; ?>"> </td>
	
		<td align=right height=40>Hearing:</td>
		<td align=left><input size=25 maxlength=25 type="text" name="profhearing" value="<? print $result_array[Hearing]; ?>"> </td>
	<tr>
		
		
	</tr>
	<tr>
		<td align=right height=40>Hearing Aide:</td>
		<td align=left>
			<select name="profhearingaide"> <option  value="<? print $result_array[HearingAide]; ?>"> <? print $result_array[HearingAide]; ?>
				<option value="Y" >Y
				<option value="N" >N
 			</select>
		</td>
		
		<td align=right height=40>Prosthesis:</td>
		<td align=left><input size=25 maxlength=45 type="text" name="profprosthesis" value="<? print $result_array[Prosthesis]; ?>"> </td>
	</tr>

	<tr>
		<td align=right height=40>Skin:</td>
		<td align=left><input size=25 maxlength=25 type="text" name="profskin" value="<? print $result_array[Skin]; ?>"> </td>
		
		<td align=right height=40>Nose:</td>
		<td align=left><input size=25 maxlength=25 type="text" name="profnose" value="<? print $result_array[Nose]; ?>"> </td>
	</tr>
	
	<tr>
		<td align=right height=40>Mouth:</td>
		<td align=left><input size=25 maxlength=25 type="text" name="profmouth" value="<? print $result_array[Mouth]; ?>"> </td>
		
		<td align=right height=40>Teeth:</td>
		<td align=left><input size=25 maxlength=25 type="text" name="profteeth" value="<? print $result_array[Teeth]; ?>"> </td>
	</tr>
</table>	
<br><center>
<table>
	<tr>
		<td align=center><input type=submit size=150 NAME="SUBMIT" VALUE="Submit"></td>
		<td>&nbsp;</td>
		<td align=center><input type=reset size=150 NAME="RESET" VALUE="Reset"></td>
	</tr>
</table>	
</center>	
</div>

</body>
</html>
