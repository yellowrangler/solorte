<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_UAnameaddrAddrdetail.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysStatusMsg.php');

//----------------------------------------------------------------------------------------------------------
// set addrid to default
//----------------------------------------------------------------------------------------------------------
$Displayaddrid = "";

//----------------------------------------------------------------------------------------------------------
// we are either being called by default (user has clicked on a address to  update or delete in which case
// we need the addrid OR we have sent a request to add, update or delete
// an address and we are now getting back results.  So we need to see first of all is our GET
// set and act accordingly
//----------------------------------------------------------------------------------------------------------
if ( isset($_GET[addrid]) and ($_GET[addrid] != "") )
{
	$Displayaddrid = $_GET[addrid];
	
	//------------------------------------------------------------------------------------------------------
	// Ok so we are either returning from an action OR selected from a list either way all we do is 
	// build screen and msgtxt
	//------------------------------------------------------------------------------------------------------
	$sql = "SELECT * from AddrTBL 
			where (AddrTBL.ID = '$Displayaddrid')";
		
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query for AddrTBL (295) - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
	
	//------------------------------------------------------------------------------------------------------
	// Now lets process the result set 
	//------------------------------------------------------------------------------------------------------
	$countRows = mysql_num_rows($sql_result);
	if ($countRows == 1) 
	{
		// fetch the results
		$result_array = mysql_fetch_assoc($sql_result);
	}
	else
	{
		//------------------------------------------------------------------------------------------------------
		// error
		//------------------------------------------------------------------------------------------------------
		$errmsg = "Error doing mysql_query for client AddrTBL. Get addrid = '$_GET[addrid]'. (296)  Too many or too few rows countrow = '$countRows' - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
}

?>
<html>

<head>
<title>HealthYourSelf Customer Prescription Update</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css"> 


.outerBorderblackfillActionSmTxt {
		font: 700 13px Arial, Geneva;
		line-height: 14px; 
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		background: #ccccff;
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
		
.fillSiennaSmTxt   { 
		font: 400 13px Arial, Geneva;
		background: #e8e188;
		}
		
.SmTxt   { 
		font: 400 13px Arial, Geneva;
		}		
		
.detailformPos {
		position: absolute;
		left:0px;
		top:30px; 
		width:650;
		height:235px;
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
	var fieldRequired = Array("addr1", "city", "state", "zip", "order", "phonenbr");
	// field description to appear in the dialog box
	var fieldDescription = Array("Address Line 1", "City", "State", "Zip", "Order", "Phone Number");
	// field description to appear in the dialog box
	var fieldEdit = Array("None", "None", "None", "None", "None", "None");
							
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

<div class="detailformPos">
<form  action="UAnameaddrAddr.php" method=post onsubmit="return formCheck(this);">
<table width="100%" class="outerBorderMessageTitleBlue">
	<tr>
		 <td height=20 align="center">Address Detail</td>
	</tr>	
</table>
<table width="100%" class="SmTxt">
	<tr valign=top>
		<td align=right colspan=4 height=15>&nbsp;</td>
	</tr>
	<tr valign=top>
		<td align=right height=35>Address Line 1:</td>
		<td align=left colspan=5><input size=40 maxlength=255 type="text" name="addr1" value="<?php print $result_array[AddrLine1]; ?>"> </td>
	</tr>
	<tr valign=top>
		<td align=right height=35>Address Line 2:</td>
		<td align=left colspan=5><input size=40 maxlength=255 type="text" name="addr2" value="<?php print $result_array[AddrLine2]; ?>"> </td>
	</tr>
	<tr valign=top>
		<td align=right height=35>City:</td>
		<td align=left><input size=25 maxlength=45 type="text" name="city" value="<?php print $result_array[City]; ?>"> </td>

		<td align=right height=35>State:</td>
		<td align=left><input size=2 maxlength=2 type="text" name="state" value="<?php print $result_array[State]; ?>"> </td>
		
		<td align=right height=35>Zip Code:</td>
		<td align=left><input size=10 maxlength=45 type="text" name="zip" value="<?php print $result_array[ZIP]; ?>"> </td>
	</tr>
	<tr valign=top>
		<td align=right height=35>Order:</td>
		<td align=left><input size=2 maxlength=3 type="text" name="order" value="<?php print $result_array[OrderID]; ?>"> </td>
		
		<td align=right height=35>Phone Number:</td>
		<td align=left colspan=3><input size=15 maxlength=15 type="text" name="phonenbr" value="<?php print $result_array[PhoneNbr]; ?>"> </td>
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
<input type='hidden' name='addrid'  value='<?php print $Displayaddrid; ?>'>
</form>
</div>

</body>
</html>
