<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_pharmacyinfo.php';

require ('hysInitAdmin.php');

require ('hysDBinit.php');

require ('hysStatusMsg.php');

require ('hysStatusMsg.php');

//----------------------------------------------------------------------------------------------------------
//  we need to see if we have been passed a PharmacyID
//----------------------------------------------------------------------------------------------------------
$isType = "";
$UpdateState = "";

if (isset($_GET[pharmacyid]) && ($_GET[pharmacyid] != "") )
{
	//Get host id and set flag to is update
	$DisplayPharmacyID = $_GET[pharmacyid];
	$isType = "Update";
	$UpdateState = "readonly";
	$UpdateClass = " class=\"readonlyText\" ";
	$displayTitle = "Update Pharmacy Information";
	
	//----------------------------------------------------------------------------------------------------------
	// First we will get the password if it is available
	//----------------------------------------------------------------------------------------------------------
	// create the SQL statement
	//----------------------------------------------------------------------------------------------------------
	$sql = "SELECT  Pword
		from AuthenticationTBL 
			where (AuthenticationTBL.USERID = '$DisplayPharmacyID'
			and AuthenticationTBL.TypeID = '$DisplayPharmacyType')"; 
			
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query for AutenticationTBL (83) - '$DisplayPharmacyID'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
	
	// make sure only 1 row was returned.  More then 1 means big problem - less then 1 means user not on file
	$num_rows = mysql_num_rows($sql_result);
	if ($num_rows == 1)
	{
		// get the password from our db and check it against what was entered
		$result_arr = mysql_fetch_assoc($sql_result);
		
		$DisplayPassword  = spookDStr($result_arr[Pword]);
	}
	else
	{
		$DisplayPassword = "";
	}	
	
	//----------------------------------------------------------------------------------------------------------
	// create the SQL statement
	//----------------------------------------------------------------------------------------------------------
	$sql = "SELECT  PharmacyTBL.ID as pharmacyID, Name, URL, 
		FirstName, LastName, Suffix, MI, Prefix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone,
		AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr 
		from PharmacyTBL 
		left join AddrTBL on PharmacyTBL.AddrID = AddrTBL.ID
		left join FullNameTBL  on PharmacyTBL.FullNameID = FullNameTBL.ID
			where (PharmacyTBL.ID = '$DisplayPharmacyID' and AddrTBL.OrderID = '1')"; 
		
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query join for PharmacyTBL, AddrTBL and FullNameTBL (195) sql = '$sql'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
		
	// Now lets first see if there is anything to run through.  If more then 1 we have an error
	$countRows = mysql_num_rows($sql_result);
	if ($countRows > 1)
	{
		$errmsg = " Error more then 1 rows returned in select on PharmacyTBL. count = '$countRows'  - PharmacyID =  '$DisplayPharmacyID'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
	
	//----------------------------------------------------------------------------------------------------------
	// Get the data
	//----------------------------------------------------------------------------------------------------------
	$result_array = mysql_fetch_assoc($sql_result);
}
else
{
	//----------------------------------------------------------------------------------------------------------
	// Build empty screen - This is an add
	//----------------------------------------------------------------------------------------------------------
	$isType = "Add";
	$displayTitle = "Add New Pharmacy";
	
	$UpdateClass = "";
	
	//----------------------------------------------------------------------------------------------------------
	// create the SQL statement
	//----------------------------------------------------------------------------------------------------------
	$sql = "SELECT MAX(ID) as MaxPharmacyID	from PharmacyTBL"; 
		
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query MAX for PharmacyTBL(195)";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	
	//----------------------------------------------------------------------------------------------------------
	// Get the data
	//----------------------------------------------------------------------------------------------------------
	$result_array = mysql_fetch_assoc($sql_result);
	
	//------------------------------------------------------------------------------------------------------
	// convert the date of birth  
	//------------------------------------------------------------------------------------------------------
	$DisplayPharmacyID = $result_array[MaxPharmacyID] + 1;
}	
	
?>
<html>

<head>
<title>HealthYourSelf Customer Intro</title>

<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css"> 

.detailBody {
		position: absolute;
		left:20px;
		top:38px; 
		width:650px;
		height:465px;
		background-color: white;
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
						
.tableTextName {
		font: 400 13px Arial, Geneva;
		line-height: 15px; 
		border-top:0px solid black;
		border-right:0px solid black;
		border-left:0px solid black;
		border-bottom:0px solid black;
		background: white;
		}
		
.tableHdrRow {
		font: 400 13px Arial, Geneva;
		line-height: 15px; 
		border-top:0px solid black;
		border-right:0px solid black;
		border-left:0px solid black;
		border-bottom:0px solid black;
		color:black;
		background: #99FFCC;
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
	var fieldRequired = Array("pharmacyname", "addr1", "city", "state", "zip", "phonenbr", "firstname", "lastname");
	// field description to appear in the dialog box
	var fieldDescription = Array("Pharmacy Name", "Address Line 1", "City", "State", "Zip",	"Phone Number", "First Name", "Last Name");
	// field description to appear in the dialog box
	var fieldEdit = Array("None", "None", "None", "None", "None", "None", "None", "None");
							
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
<form  action="pharmacyinfo.php" method=post onsubmit="return formCheck(this);">
<table width="100%" class="outerBorderMessageTitleBlue">
	<tr>
		 <td height=20 align="center"><?php print $displayTitle; ?></td>
	</tr>	
</table>

<table width="100%" class="SmTxt">
	<tr>
		<td align=right colspan=4 height=15>&nbsp;</td>
	</tr>
	<tr>
		<td align=right height=35>Pharmacy Name:</td>
		<td align=left colspan=5><input size=40 maxlength=255 type="text" name="pharmacyname" value="<?php print $result_array[Name]; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=35>Address Line 1:</td>
		<td align=left colspan=5><input size=40 maxlength=255 type="text" name="addr1" value="<?php print $result_array[AddrLine1]; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=35>Address Line 2:</td>
		<td align=left colspan=5><input size=40 maxlength=255 type="text" name="addr2" value="<?php print $result_array[AddrLine2]; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=35>City:</td>
		<td align=left><input size=25 maxlength=45 type="text" name="city" value="<?php print $result_array[City]; ?>"> </td>

		<td align=right height=35>State:</td>
		<td align=left><input size=2 maxlength=2 type="text" name="state" value="<?php print $result_array[State]; ?>"> </td>
		
		<td align=right height=35>Zip Code:</td>
		<td align=left><input size=10 maxlength=45 type="text" name="zip" value="<?php print $result_array[ZIP]; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=35>Phone Number:</td>
		<td align=left colspan=5><input size=15 maxlength=15 type="text" name="phonenbr" value="<?php print $result_array[PhoneNbr]; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=35>URL:</td>
		<td align=left colspan=5><input size=40 maxlength=255 type="text" name="url" value="<?php print $result_array[URL]; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=35 valign=bottom>Contact:</td>
		<td align=left  valign=bottom colspan=5>
			<table class="tableTextName" border=0>
				<tr class="tableHdrRow">
					<td align=center><b>Prefix</b></td>
					<td align=center><b>First Name</b></td>
					<td align=center><b>MI</b></td>
					<td align=center><b>LastName</b></td>
					<td align=center><b>Suffix</b></td>
				</tr>	
				<tr>
					<td valign=bottom align=center><input size=3 maxlength=5 type="text" name="prefix" value="<?php print $result_array[Prefix]; ?>"></td>
					<td valign=bottom align=center><input size=15 maxlength=45 type="text" name="firstname" value="<?php print $result_array[FirstName]; ?>"></td>
					<td valign=bottom align=center><input size=1 maxlength=1 type="text" name="mi" value="<?php print $result_array[MI]; ?>"></td>
					<td valign=bottom align=center><input size=15 maxlength=45 type="text" name="lastname" value="<?php print $result_array[LastName]; ?>"></td>
					<td valign=bottom align=center><input size=3 maxlength=5 type="text" name="suffix" value="<?php print $result_array[Suffix]; ?>"></td>
				</tr>	 
			</table>
		</td>
	</tr>
		<tr>
		<td align=right>Pharmacist ID:</td>
		<td align=left><input <?php print $UpdateState; print $UpdateClass; ?> size=10  maxlength=10 type="text" name="pharmacyid" value="<?php print $DisplayPharmacyID; ?>"</td>
		
		<td align=right height=35>Password:</td>
		<td align=left><input size=10 maxlength=10 type="text" name="pharmacypassword" value="<?php print $DisplayPassword; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=35>eMail Address:</td>
		<td align=left colspan=5><input size=40 maxlength=255 type="text" name="email" value="<?php print $result_array[eMailAddr]; ?>"> </td>
	</tr>
</table>
<input type="hidden" name="Action" value="<?php print $isType; ?>">	
<br><center>
<table>
	<tr>
		<td align=center><input type=submit size=150 NAME="SUBMIT" VALUE="Submit"></td>
		<td>&nbsp;</td>
		<td align=center><input type=reset size=150 NAME="RESET" VALUE="Reset"></td>
	</tr>
</table>	
</center>	
</form>
</div>
</body>
</html>
