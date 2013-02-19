<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------

$module = 'if_UAmedprofSocial.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysStatusMsg.php');

//----------------------------------------------------------------------------------------------------------
// create the SQL statement to get our clients external medical profile.  
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT * from ClientSocialProfileTBL 
		where ClientSocialProfileTBL.MEDPAL = '$Medpal'";
			
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query join for ClientSocialProfileTBL tbl (195) - '$Medpal'";
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
	$errmsg = " Error more then 1 rows returned in select for ClientSocialProfileTBL. count = '$countRows'  - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

//----------------------------------------------------------------------------------------------------------
// now lets fetch for our display
//----------------------------------------------------------------------------------------------------------
$result_array = mysql_fetch_assoc($sql_result);

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
		height:730px;
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
		
.ittyTxt   { 
		font: 400 5px Arial, Geneva;
		}
		
.titlextBoxSmoker   { 
		font: 700 15px Arial, Geneva;
		font-style: italic;
		position: absolute;
		left:40px;
		top:-15px; 
		width:150px;
		height:15px;
		background: white;
		border:1px solid blue;
		}
		
.SmTxtBoxSmoker   { 
		font: 400 11px Arial, Geneva;
		position: absolute;
		left:20px;
		top:60px; 
		width:610px;
		height:215px;
		background: white;
		border:1px solid blue;
		}			

.titlextBoxAlcohol   { 
		font: 700 15px Arial, Geneva;
		font-style: italic;
		position: absolute;
		left:40px;
		top:-15px; 
		width:150px;
		height:15px;
		background: white;
		border:1px solid blue;
		}
		
.SmTxtBoxAlcohol   { 
		font: 400 11px Arial, Geneva;
		position: absolute;
		left:20px;
		top:305px; 
		width:610px;
		height:110px;
		background: white;
		border:1px solid blue;
		}		

.titlextBoxExersizeandDiet   { 
		font: 700 15px Arial, Geneva;
		font-style: italic;
		position: absolute;
		left:40px;
		top:-15px; 
		width:150px;
		height:15px;
		background: white;
		border:1px solid blue;
		}
		
.SmTxtBoxExersizeandDiet   { 
		font: 400 11px Arial, Geneva;
		position: absolute;
		left:20px;
		top:450px; 
		width:610px;
		height:235px;
		background: white;
		border:1px solid blue;
		}		
		
.buttonPos   { 
		font: 400 13px Arial, Geneva;
		position: absolute;
		left:20px;
		top:690px; 
		width:610px;
		height:20px;
		background: white;
		border:0px solid red;
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

function formCheck(formobj)
{
	// name of mandatory fields
	var fieldRequired = Array("profcursmoke", "profformersmoke", "profalcohol", "profexersize");
	// field description to appear in the dialog box
	var fieldDescription = Array("Do you smoke", "Former smoker", "Do you consume Alcohol", "Do you exersize");
	// field description to appear in the dialog box
	var fieldEdit = Array("None", "None", "None", "None");
							
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
<form  action="UAmedprofSocial.php" method=post onsubmit="return formCheck(this);">
<table width="100%" class="outerBorderMessageTitleBlue">
	<tr>
		 <td height=20 align="center">Social Health Profile</td>
	</tr>	
</table>

<center>
<div class="SmTxtBoxSmoker">
<table class="titlextBoxSmoker">
	<tr>
		<td align=center>Smoking History</td>
	</tr>
</table>	
<br>
<table width="95%" class="SmTxt">
	<tr>
		<td height=5 class="ittyTxt">&nbsp;</td>
	</tr>
	<tr>
		<td align=left height=20>Do you currently smoke?	
			<select name="profcursmoke"> <option  value="<? print $result_array[CurSmoker]; ?>"> <? print $result_array[CurSmoker]; ?>
				<option value="Y" >Y
				<option value="N" >N
 			</select>
		</td>
	</tr>
	<tr>
		<td align=left height=20>If you are not a current smoker, are you a <i>former</i> smoker?
			<select name="profformersmoke"> <option  value="<? print $result_array[FormerSmoker]; ?>"> <? print $result_array[FormerSmoker]; ?>
				<option value="Y" >Y
				<option value="N" >N
 			</select>
		</td>
	</tr>
	<tr>
		<td height=10 class="ittyTxt">&nbsp;</td>
	</tr>
	<tr>
		<td align=left height=20>If you are either a current or former smoker please answer the following:</td>
	</tr>
</table>

<table width="95%" class="SmTxt">
	<tr>
		<td width=5>&nbsp;</td>
		<td height=15>A: What did you/do you smoke? <input size=15 maxlength=15 type="text" name="profsmokertype" value="<? print $result_array[SmokerType]; ?>"></td>
	</tr>
	<tr>
		<td width=5>&nbsp;</td>
		<td height=15>B: How many did you/do you smoke per month? <input size=5 maxlength=5 type="text" name="profsmokermonth" value="<? print $result_array[SmokerperMonth]; ?>"></td>
	</tr>
	<tr>
		<td width=5>&nbsp;</td>
		<td height=15>C: How many years have you smoked? <input size=5 maxlength=5 type="text" name="profsmokeryears" value="<? print $result_array[SmokerYears]; ?>"></td>
	</tr>	
</table>
</div>

<div class="SmTxtBoxAlcohol">
<table class="titlextBoxAlcohol">
	<tr>
		<td align=center>Alcohol Use</td>
	</tr>
</table>	
<br>
<table width="95%" class="SmTxt">
	<tr>
		<td height=5 class="ittyTxt">&nbsp;</td>
	</tr>
	<tr>
		<td align=left height=20>Do you currently drink alcohol?	
			<select name="profalcohol"> <option  value="<? print $result_array[Alcohol]; ?>"> <? print $result_array[Alcohol]; ?>
				<option value="Y" >Y
				<option value="N" >N
 			</select>
		</td>
	</tr>
	<tr>
		<td height=10 class="ittyTxt">&nbsp;</td>
	</tr>
	<tr>
		<td align=left height=20>If you do drink alcohol, How many drinks do you have per month? <input size=5 maxlength=5 type="text" name="profalcoholperrmonth" value="<? print $result_array[AlcoholperMonth]; ?>"></td>
	</tr>
</table>
</div>

<div class="SmTxtBoxExersizeandDiet">
<table class="titlextBoxExersizeandDiet">
	<tr>
		<td align=center>Exersize and Diet</td>
	</tr>
</table>	
<br>
<table width="95%" class="SmTxt">
	<tr>
		<td height=5 class="ittyTxt">&nbsp;</td>
	</tr>
	<tr>
		<td align=left height=20>Do you exersize regularly?	
			<select name="profexersize"> <option  value="<? print $result_array[Exersize]; ?>"> <? print $result_array[Exersize]; ?>
				<option value="Y" >Y
				<option value="N" >N
 			</select>
		</td>
	</tr>
	<tr>
		<td height=10 class="ittyTxt">&nbsp;</td>
	</tr>
	<tr>
		<td align=left height=20>If you do exersize regularly,  please answer the following:</td>
	</tr>
</table>

<table width="95%" class="SmTxt">
	<tr>
		<td width=5 height=15>&nbsp;</td>
		<td>A: How often do you exersize per month? <input size=5 maxlength=5 type="text" name="profexersizepermonth" value="<? print $result_array[ExersizeperMonth]; ?>"></td>
	</tr>
	<tr>
		<td width=5>&nbsp;</td>
		<td height=15>B: Please describe: <input size=50 maxlength=50 type="text" name="profexersizedescription" value="<? print $result_array[ExersizeDescription]; ?>"></td>
	</tr>
</table>
		

<table width="95%" class="SmTxt">
	<tr>
		<td height=10 class="ittyTxt">&nbsp;</td>
	</tr>
	<tr>
		<td align=left height=20>Are you on a diet?	
			<select name="profdiet"> <option  value="<? print $result_array[Diet]; ?>"> <? print $result_array[Diet]; ?>
				<option value="Y" >Y
				<option value="N" >N
 			</select>
		</td>
	</tr>
	<tr>
		<td height=5 class="ittyTxt">&nbsp;</td>
	</tr>
	<tr>
		<td align=left height=15>If you are on a diet, can you describe it? <input size=30 maxlength=50 type="text" name="profdietdescription" value="<? print $result_array[DietDescription]; ?>"></td>
	</tr>
</table>
</div>

</center>
<div class="buttonPos">
<center>
<table>
	<tr>
		<td align=center><input type=submit size=150 NAME="SUBMIT" VALUE="Submit"></td>
		<td>&nbsp;</td>
		<td align=center><input type=reset size=150 NAME="RESET" VALUE="Reset"></td>
	</tr>
</table>	
</center>
</div>
</form>
</div>

</body>
</html>
