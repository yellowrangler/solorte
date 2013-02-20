<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_UAnameaddrPhoto.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysStatusMsg.php');

//----------------------------------------------------------------------------------------------------------
// create the SQL statement to get our clients name. 
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT * from ClientTBL 
		inner join PhotoTBL on ClientTBL.PhotoID = PhotoTBL.ID
		where ClientTBL.MEDPAL = '$Medpal'";
			
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query join for ClientTBL and PhotoTBL (195) - '$Medpal'";
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
	$errmsg = " Error more then 1 rows returned in select for ClientTBL and PhotoTBL. count = '$countRows'  - '$Medpal'";
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
<title>HealthYourSelf Clinet Name Info</title>

<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css"> 

.detailBody {
		position: absolute;
		left:20px;
		top:30px; 
		width:650px;
		height:475px;
		background: white;
		border:1px solid black;
		}

.buttonpos {
		position: absolute;
		left:0px;
		top:420px; 
		width:640px;
		height:35px;
		background: white;
		border:0px solid black;
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

.outerBorderblack {
		font: 700 13px Arial, Geneva;
		border-top:1px solid black;
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
		
.fillSiennaSmTxt   { 
		font: 400 13px Arial, Geneva;
		background: #e8e188;
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
	var fieldRequired = Array("fileupload");
	// field description to appear in the dialog box
	var fieldDescription = Array("File Name");
	// field description to appear in the dialog box
	var fieldEdit = Array("None");
							
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
				case "file":
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
<table width="100%" class="outerBorderMessageTitleBlue">
	<tr>
		 <td height=20 align="center">Client Photo</td>
	</tr>	
</table>
<center>
<br><br>
<table width=175>
	<tr>
		<td  valign=center align=center>
			<?php	if ($result_array[URL] != "")
				{
					print "<img border=1 src=".$result_array[URL]." width=175>";
				}
				else
				{
					print "No Photo";
				}
			?>
		</td>
	</tr>
</table>	
</center>
<br><br>
<hr width="80%" align=center>
<br><br>
<form  action="UAnameaddrPhoto.php" ENCTYPE="multipart/form-data" method=post onsubmit="return formCheck(this);"> 
<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
<table cellspacing=0 cellpadding=0 width="100%" class="smallText3" align=center> 
	<tr> 
		<td width=10>&nbsp;</td> 
		<td height=40 valign=center align=right><b>Photo Image to Upload:<b>&nbsp;</td> 
		<td height=40 valign=center align=left><input size=50 type="file" name="fileupload"></td> 
		<td width=10>&nbsp;</td> 
	</tr> 
</table> 
<div class="buttonpos">
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
