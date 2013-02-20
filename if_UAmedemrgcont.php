<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_UAmedemrgcont.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysStatusMsg.php');

//----------------------------------------------------------------------------------------------------------
// now lets get RelationshipType Values
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT ID as RelationshipTypeID, RelationshipType 
	from RelationshipTypeTBL";

// Make the call
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for RelationshipTypeTBL  (555) - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// initialize display block
$DisplayRelationshipTypeList = "";
$DisplayRelationshipTypeID = "None";

// Now lets first see if there is anything to run through
$countRows = mysql_num_rows($sql_result);
if ($countRows >  0) 
{	
	// now lets run the table and get our provider names
	while ($result_arr = mysql_fetch_assoc($sql_result))
	{
		$DisplayRelationshipTypeList .= "\t\t\t<option value=\"".$result_arr[RelationshipTypeID]."\" >".$result_arr[RelationshipType]."\n ";
	}
}	

//----------------------------------------------------------------------------------------------------------
// create the SQL statement
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr, 
	Prefix, FirstName, MI, LastName, Suffix, RelationsID, RelationshipType,
	MobilePhone, ClientEmergContactsTBL.OrderID as CECOrderID, ClientEmergContactsTBL.ID as CECID
	from ClientEmergContactsTBL 
	left join FullNameTBL  on ClientEmergContactsTBL.FullNameID = FullNameTBL.ID
	left join AddrTBL  on ClientEmergContactsTBL.AddrID = AddrTBL.ID
	left join RelationshipTypeTBL on ClientEmergContactsTBL.RelationsID = RelationshipTypeTBL.ID
		where (ClientEmergContactsTBL.MEDPAL = '$Medpal') 
		ORDER BY ClientEmergContactsTBL.OrderID";
	
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query join for ClientEmergContactsTBL, AddrTBL and FullNameTBL (195) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------
// Now lets first see if there is anything to run through.  If more then 2 we have an error
//----------------------------------------------------------------------------------------------------------
$countRows = mysql_num_rows($sql_result);
if ($countRows > 2)
{
	$errmsg = " Error more then 2 rows returned in select on ClientEmergContactsTBL. count = '$countRows'  - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

//----------------------------------------------------------------------------------------------------------
// lets initialize our variables
//----------------------------------------------------------------------------------------------------------

while ($result_array = mysql_fetch_assoc($sql_result))
{
	
	//------------------------------------------------------------------------------------------------------
	// lets start assigning values to our display fields
	//------------------------------------------------------------------------------------------------------
	$KeyIndex = $result_array[CECOrderID];
	
	$Prefix[$KeyIndex] = $result_array[Prefix];
	$FirstName[$KeyIndex] = $result_array[FirstName];
	$MI[$KeyIndex] = $result_array[MI];
	$LastName[$KeyIndex] = $result_array[LastName];
	$Suffix[$KeyIndex] = $result_array[Suffix];
	$AddrL1[$KeyIndex] = $result_array[AddrLine1];
	$AddrL2[$KeyIndex] = $result_array[AddrLine2];
	$City[$KeyIndex] = $result_array[City];
	$State[$KeyIndex] = $result_array[State];
	$ZIP[$KeyIndex] = $result_array[ZIP];
	$Relationship[$KeyIndex] = $result_array[RelationshipType];
	$RelationshipID[$KeyIndex] = $result_array[RelationsID];
	$PhoneNbr[$KeyIndex] = $result_array[PhoneNbr];
	$MobileNbr[$KeyIndex] = $result_array[MobilePhone];
			
}  // End of While	


?>
<html>

<head>
<title>HealthYourSelf Customer Intro</title>

<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />
<style type="text/css"> 

.primaryContactArea {
		position: absolute;
		left:20px;
		top:35px;
		width:650px;
		height:320px;
		border-top:1px solid black;
		border-right:1px solid black;
		border-left:1px solid black;
		border-bottom:1px solid black;
		border:1px solid black;
		background: white;
		}

.secondaryContactArea {
		position: absolute;
		left:20px;
		top:385px;
		width:650px;
		height:320px;
		border-top:1px solid black;
		border-right:1px solid black;
		border-left:1px solid black;
		border-bottom:1px solid black;
		border:1px solid black;
		background: white;
		}
		
		
.tableTextName {
		font: 400 13px Arial, Geneva;
		line-height: 15px; 
		border-top:1px solid black;
		border-right:1px solid black;
		border-left:1px solid black;
		border-bottom:1px solid black;
		background: white;
		}
		
.tableHdrRow {
		font: 400 13px Arial, Geneva;
		line-height: 15px; 
		border-top:1px solid black;
		border-right:1px solid black;
		border-left:1px solid black;
		border-bottom:1px solid black;
		color:black;
		background: #99FFCC;
		}		
		
.tableText {
		font: 400 13px Arial, Geneva;
		line-height: 15px; 
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
	var fieldRequired = Array("firstname", "lastname", "addr1", "city", "state", "zip", "relationship", "phonenbr");
	// field description to appear in the dialog box
	var fieldDescription = Array("First Name", "Last Name", "Address Line 1", "City", "State", "Zip",	"Relationship",	"Phone Number");
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
<div class="primaryContactArea">
<form  action="UAmedemrgcont.php" method=post onsubmit="return formCheck(this);">
<table width="100%" class="outerBorderMessageTitleBlue">
	<tr>
		 <td height=20 align="center">Primary Emergency Medical Contact</td>
	</tr>	
</table>
<br>
<center>
<table class="tableTextName" border=0>
	<tr class="tableHdrRow">
		<td align=center><b>Prefix</b></td>
		<td align=center><b>First Name</b></td>
		<td align=center><b>MI</b></td>
		<td align=center><b>LastName</b></td>
		<td align=center><b>Suffix</b></td>
	</tr>	
	<tr>
		<td align=center><input size=3 maxlength=5 type="text" name="prefix" value="<?php print $Prefix[1]; ?>"></td>
		<td align=center><input size=15 maxlength=45 type="text" name="firstname" value="<?php print $FirstName[1]; ?>"></td>
		<td align=center><input size=1 maxlength=1 type="text" name="mi" value="<?php print $MI[1]; ?>"></td>
		<td align=center><input size=15 maxlength=45 type="text" name="lastname" value="<?php print $LastName[1]; ?>"></td>
		<td align=center><input size=3 maxlength=5 type="text" name="suffix" value="<?php print $Suffix[1]; ?>"></td>
	</tr>	 
</table>

<br>
</center>
<table width="100%" class="tblDetailsmTextOff">
	<tr>
		<td  height=30 align=right>Address:</td>
		<td  height=30 align=left colspan=2><input size=20 maxlength=255 type="text" name="addr1" value="<?php print $AddrL1[1]; ?>"></td>
	</tr> 
	
		<tr>
		<td  height=30 align=right>&nbsp;</td>
		<td  height=30 align=left colspan=2><input size=20 maxlength=255 type="text" name="addr2" value="<?php print $AddrL2[1]; ?>"></td>
	</tr> 
	
	<tr>
		<td align=right>City:</td>
		<td  height=30 align=left><input size=15 maxlength=45 type="text" name="city" value="<?php print $City[1]; ?>"></td>
		
		<td align=right>State:</td>
		<td  height=30 align=left><input size=2 maxlength=2 type="text" name="state" value="<?php print $State[1]; ?>"></td>
		
		<td align=right>ZIP:</td>
		<td  height=30 align=left><input size=5 maxlength=10 type="text" name="zip" value="<?php print $ZIP[1]; ?>"></td>
	</tr>
	
	<tr>
		<td height=30 align=right>Relationship:</td>
		<td align=left colspan=2>
			<select name="relationship"> 
				<option class="smallTxtGry" value="<?php print $RelationshipID[1]; ?>"><?php print $Relationship[1]; ?> 
				<?php print $DisplayRelationshipTypeList; ?>
			</select>
		</td>		
	</tr>
	
	<tr>
		<td align=right>Phone Nbr:</td>
		<td  height=30 align=left colspan=2><input size=15 maxlength=15 type="text" name="phonenbr" value="<?php print $PhoneNbr[1]; ?>"></td>
		
		<td align=right>Mobile Nbr:</td>
		<td  height=30 align=lef colspan=2><input size=15 maxlength=15 type="text" name="mobilenbr" value="<?php print $MobileNbr[1]; ?>"></td>
	</tr>

</table>
<center>
<table>
	<tr>
		<td align=center><input type=submit size=150 NAME="SUBMIT" VALUE="Submit"></td>
		<td>&nbsp;</td>
		<td align=center><input type=reset size=150 NAME="RESET" VALUE="Reset"></td>
	</tr>
</table>	
</center>
<input type='hidden' name='emrgtype'  value='1'>
</form>
</div>

<div class="secondaryContactArea">
<form  action="UAmedemrgcont.php" method=post onsubmit="return formCheck(this);">
<table width="100%" class="outerBorderMessageTitleBlue">
	<tr>
		 <td height=20 align="center">Secondary Emergency Medical Contact</td>
	</tr>	
</table>
<br>
<center>
<table class="tableTextName" border=0>
	<tr class="tableHdrRow">
		<td align=center><b>Prefix</b></td>
		<td align=center><b>First Name</b></td>
		<td align=center><b>MI</b></td>
		<td align=center><b>LastName</b></td>
		<td align=center><b>Suffix</b></td>
	</tr>	
	<tr>
		<td align=center><input size=3 maxlength=5 type="text" name="prefix" value="<?php print $Prefix[2]; ?>"></td>
		<td align=center><input size=15 maxlength=45 type="text" name="firstname" value="<?php print $FirstName[2]; ?>"></td>
		<td align=center><input size=1 maxlength=1 type="text" name="mi" value="<?php print $MI[2]; ?>"></td>
		<td align=center><input size=15 maxlength=45 type="text" name="lastname" value="<?php print $LastName[2]; ?>"></td>
		<td align=center><input size=3 maxlength=5 type="text" name="suffix" value="<?php print $Suffix[2]; ?>"></td>
	</tr>	 
</table>

<br>
</center>
<table width="100%" class="tblDetailsmTextOff">
	<tr>
		<td  height=30 align=right>Address:</td>
		<td  height=30 align=left colspan=2><input size=20 maxlength=255 type="text" name="addr1" value="<?php print $AddrL1[2]; ?>"></td>
	</tr> 
	
	<tr>
		<td  height=30 align=right>&nbsp;</td>
		<td  height=30 align=left colspan=2><input size=20 maxlength=255 type="text" name="addr2" value="<?php print $AddrL2[2]; ?>"></td>
	</tr> 
	
	<tr>
		<td align=right>City:</td>
		<td  height=30 align=left><input size=15 maxlength=45 type="text" name="city" value="<?php print $City[2]; ?>"></td>
		
		<td align=right>State:</td>
		<td  height=30 align=left><input size=2 maxlength=2 type="text" name="state" value="<?php print $State[2]; ?>"></td>
		
		<td align=right>ZIP:</td>
		<td  height=30 align=left><input size=5 maxlength=10 type="text" name="zip" value="<?php print $ZIP[2]; ?>"></td>
	</tr>
	
	<tr>
		<td height=30 align=right>Relationship:</td>
		<td align=left colspan=2>
			<select name="relationship"> 
				<option class="smallTxtGry" value="<?php print $RelationshipID[2]; ?>"><?php print $Relationship[2]; ?> 
				<?php print $DisplayRelationshipTypeList; ?>
			</select>
		</td>		
	</tr>
	
	<tr>
		<td align=right>Phone Nbr:</td>
		<td  height=30 align=left colspan=2><input size=15 maxlength=15 type="text" name="phonenbr" value="<?php print $PhoneNbr[2]; ?>"></td>
		
		<td align=right>Mobile Nbr:</td>
		<td  height=30 align=lef colspan=2><input size=15 maxlength=15 type="text" name="mobilenbr" value="<?php print $MobileNbr[2]; ?>"></td>
	</tr>

</table>
<center>
<table>
	<tr>
		<td align=center><input type=submit size=150 NAME="SUBMIT" VALUE="Submit"></td>
		<td>&nbsp;</td>
		<td align=center><input type=reset size=150 NAME="RESET" VALUE="Reset"></td>
	</tr>
</table>	
</center>
<input type='hidden' name='emrgtype'  value='2'>
</form>
</div>

</body>
</html>
