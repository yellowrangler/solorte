<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_UAmedinsure.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysStatusMsg.php');

//----------------------------------------------------------------------------------------------------------
// now lets get Payor names for drop down list.  
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT Name, TypeID, PayorTBL.ID as PayorID from PayorTBL ORDER BY Name";
 
//----------------------------------------------------------------------------------------------------------
// Make the call
//----------------------------------------------------------------------------------------------------------
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for PayorTBL  (495) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------
// Now lets first see if there is anything to run through
//----------------------------------------------------------------------------------------------------------
$countRows = mysql_num_rows($sql_result);
if ($countRows >  0) 
{	
	// now lets run the table and get our provider names
	while ($result_arr = mysql_fetch_assoc($sql_result))
	{
		$KeyIndex = $result_arr[TypeID];
		$PayorNameList[$KeyIndex] .= "\t\t\t<option value=\"".$result_arr[PayorID]."\" >".$result_arr[Name]."\n ";
	}
}	

//----------------------------------------------------------------------------------------------------------
// get doctors names
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT DISTINCT FirstName, LastName, Suffix, ClientProviderTBL.ProviderID as ProvID from ClientProviderTBL 
			left join ProviderTBL on ClientProviderTBL.ProviderID = ProviderTBL.ID	
			inner join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID 
			where ClientProviderTBL.MEDPAL = '$Medpal'";

//----------------------------------------------------------------------------------------------------------
// Make the call
//----------------------------------------------------------------------------------------------------------
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ClientProviderTBL left join FullNameTBL sql = '$sql' (395) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------
// Now lets first see if there is anything to run through
//----------------------------------------------------------------------------------------------------------
$countRows = mysql_num_rows($sql_result);
if ($countRows >  0) 
{	
	// now lets run the table and get our provider names
	while ($result_arr = mysql_fetch_assoc($sql_result))
	{
		$ProviderList .= "\t\t\t<option value=\"".$result_arr[ProvID]."\" >".$result_arr[FirstName]." ".$result_arr[LastName]." ".$result_arr[Suffix]."\n ";
	}
}	

//----------------------------------------------------------------------------------------------------------
// lets initialize our display variables
//----------------------------------------------------------------------------------------------------------
$DisplayBlock = "";

//----------------------------------------------------------------------------------------------------------
// create the SQL statement to get our insurance information.  We assume here that at most you have one 
// medical and one dental plan. We do not yet provide for additional insurance (aflac, supplamental 
// disbality etc.). 
// 
// We will loop through Payors adding both  medical and  display info to array indexed by TypeID
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT * from ClientPayorTBL 
		inner join PayorTBL on ClientPayorTBL.PayorID = PayorTBL.ID 
		where (MEDPAL = '$Medpal')";
		
if (!$sql_result_global = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query join for ClientPayorTBL and PayorTBL (195) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}
	
//----------------------------------------------------------------------------------------------------------
// Now lets first see if there is anything to run through.  If more then 2 we have an error
//----------------------------------------------------------------------------------------------------------
$NbrLoops = 1;

$countRows = mysql_num_rows($sql_result_global);
if ($countRows > 0)
{
	// if we have medical insurance then start building display
	// now lets fetch our prescription information
	while ($result_array = mysql_fetch_assoc($sql_result_global))
	{
		
		//------------------------------------------------------------------------------------------------------
		// lets start assigning values to our display fields
		//------------------------------------------------------------------------------------------------------
		$KeyIndex = $result_array[TypeID];
		$NbrLoops += 1;
		
		$TypeID[$KeyIndex] = $result_array[TypeID];
		$GroupID[$KeyIndex] = $result_array[GroupID];
		$SubscriberID[$KeyIndex] = $result_array[SubscriberID];
		$OfficeCoPay[$KeyIndex] = $result_array[OfficeCoPay];
		$PayorName[$KeyIndex] = $result_array[Name];
		$PayorID[$KeyIndex] = $result_array[PayorID];
		$PayorURL[$KeyIndex] = $result_array[URL];
			
		//------------------------------------------------------------------------------------------------------	
		// lets set some temp variables
		//------------------------------------------------------------------------------------------------------
		$PrimaryInsuredID[$KeyIndex] = $result_array[PrimaryInsuredID];
		$ProviderID[$KeyIndex] = $result_array[PrimaryProviderID];
		$tmpPayorAddr = $result_array[AddrID];
		
		//------------------------------------------------------------------------------------------------------
		// get the full name of the primary insured
		//------------------------------------------------------------------------------------------------------
		$sql = "SELECT * from FullNameTBL where (ID = '$PrimaryInsuredID[$KeyIndex]')";
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for FullNameTBL  (195) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//------------------------------------------------------------------------------------------------------	
		// Now lets first see if there is anything to run through.
		//------------------------------------------------------------------------------------------------------
		// $countRows = mysql_num_rows($sql_result);
		// if ($countRows != 1)
		// {
		// 	$errmsg = " Error No rows or more then 1 row returned in select on FullNameTBL. count = '$countRows'  - '$Medpal'";
		// 	$location = "Location: invalidsql.php";
		// 	LogErr($shortmsg, $errmsg, $location, $module, $severity);
		// }	
		
		//------------------------------------------------------------------------------------------------------
		// now lets fetch our information
		//------------------------------------------------------------------------------------------------------
		$result_array = mysql_fetch_assoc($sql_result);
	
		//------------------------------------------------------------------------------------------------------
		// set our display value
		//------------------------------------------------------------------------------------------------------
		$PINamePrefix[$KeyIndex] = $result_array[Prefix];
		$PINameFirst[$KeyIndex] = $result_array[FirstName];
		$PINameLast[$KeyIndex] = $result_array[LastName];
		$PINameMI[$KeyIndex] = $result_array[MI];
		$PINameSuffix[$KeyIndex] = $result_array[Suffix];
		
		//------------------------------------------------------------------------------------------------------
		// now lets get our primary provider information
		//------------------------------------------------------------------------------------------------------
		$sql = "SELECT * from ProviderTBL inner join 
				FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID 
				where (ProviderTBL.ID = '$ProviderID[$KeyIndex]')";
				
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for join ProviderTBL and FullNameTBL  (195) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
			
		//------------------------------------------------------------------------------------------------------	
		// Now lets first see if there is anything to run through.  If do not get our 2 names  we have an error
		//------------------------------------------------------------------------------------------------------
		// $countRows = mysql_num_rows($sql_result);
		// if ($countRows != 1)
		// {
		// 	$errmsg = " Error No rows or more then 1 row returned in select on join ProviderTBL and FullNameTBL. count = '$countRows'  - '$Medpal'";
		// 	$location = "Location: invalidsql.php";
		// 	LogErr($shortmsg, $errmsg, $location, $module, $severity);
		// }	
		
		//------------------------------------------------------------------------------------------------------
		// fetch results
		//------------------------------------------------------------------------------------------------------
		$result_array = mysql_fetch_assoc($sql_result);
		
		//------------------------------------------------------------------------------------------------------
		// set our display value
		//------------------------------------------------------------------------------------------------------
		$PrimaryProvider[$KeyIndex] = $result_array[FirstName]." ".$result_array[MI]." ".$result_array[LastName]." ".$result_array[Suffix];
		
		//------------------------------------------------------------------------------------------------------
		// create the SQL statement to get our payor tele nbr
		//------------------------------------------------------------------------------------------------------
		$sql = "SELECT * from AddrTBL where (ID = '$tmpPayorAddr')";
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for AddrTBL (195) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//------------------------------------------------------------------------------------------------------
		// Now lets first see if there is anything to run through.  If do not get our 2 names  we have an error
		//------------------------------------------------------------------------------------------------------
		// $countRows = mysql_num_rows($sql_result);
		// if ($countRows != 1)
		// {
		// 	$errmsg = " Error No rows or more then 1 row returned in select on AddrTBL count = '$countRows'  - '$Medpal'";
		// 	$location = "Location: invalidsql.php";
		// 	LogErr($shortmsg, $errmsg, $location, $module, $severity);
		// }	
		
		//------------------------------------------------------------------------------------------------------
		// fetch results
		//------------------------------------------------------------------------------------------------------
		$result_array = mysql_fetch_assoc($sql_result);
		
		//------------------------------------------------------------------------------------------------------
		// build final display variable
		//------------------------------------------------------------------------------------------------------
		$PayorTeleNbr[$KeyIndex] = $result_array[PhoneNbr];
		
	}  // End of While	
}  // End of If > 0	

?>
<html>

<head>
<title>HealthYourSelf Customer Intro</title>

<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />
<style type="text/css"> 

.medInsureArea {
		position: absolute;
		left:20px;
		top:35px;
		width:650px;
		height:270px;
		border-top:1px solid black;
		border-right:1px solid black;
		border-left:1px solid black;
		border-bottom:1px solid black;
		background: white;
		}

.dentalInsureArea {
		position: absolute;
		left:20px;
		top:325px;
		width:650px;
		height:270px;
		border-top:1px solid black;
		border-right:1px solid black;
		border-left:1px solid black;
		border-bottom:1px solid black;
		background: white;
		}
		
.tableText {
		font: 400 13px Arial, Geneva;
		line-height: 25px; 
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
	var fieldRequired = Array("payorname", "provider", "groupid", "subscriber", "copay",
								"firstname", "lastname", "applocation", "Description");
	// field description to appear in the dialog box
	var fieldDescription = Array("Insurer", "Primary Provider", "Group ID", "Subscriber ID", "Co Pay", "First Name", "Last Name");
	// field description to appear in the dialog box
	var fieldEdit = Array("None", "None", "None", "None", "None", "None", "None");
							
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
<div class="medInsureArea">
<form  action="UAmedinsure.php" method=post onsubmit="return formCheck(this);">
<table width="100%" class="outerBorderMessageTitleBlue">
	<tr>
		 <td height=20 align="center">Medical Insurance</td>
	</tr>	
</table>
<table width="100%" class="tblDetailsmTextOff">
	<tr> 
		<td height=30 width="50%" align=left>Insurer:&nbsp;<select name="payorname"> 
			<option class="smallTxtGry" value="<? print $PayorID[1]; ?>"><? print $PayorName[1]; ?> 
			<? print $PayorNameList[1]; ?>
			</select>
		</td>
		<td height=30 width="50%" align=left>Primary Care Doctor:&nbsp;<select name="provider"> <option class="smallTxtGry" value="<? print $ProviderID[1]; ?>"><? print $PrimaryProvider[1]; ?> 
			<? print $ProviderList; ?>
			</select>
		</td>
	</tr> 
	
	<tr>
		<td  height=30 width="50%" align=left>Group ID:&nbsp;<input size=15 maxlength=25 type="text" name="groupid" value="<? print $GroupID[1]; ?>"></td>
		<td  height=30 width="50%" align=left>Subscriber ID:&nbsp;<input size=15 maxlength=25 type="text" name="subscriber" value="<? print $SubscriberID[1]; ?>"></td>
	</tr> 
	
	<tr> 
		<td  height=30 width="50%" align=left>Office visit Co-Pay:&nbsp;<input size=15 maxlength=45 type="text" name="copay" value="<? print $OfficeCoPay[1]; ?>"></td>
		<td  height=30 width="50%" align=left>Insurance Telephone Nbr:&nbsp;<? print $PayorTeleNbr[1]; ?></td>
	</tr>
	
	<tr> 
		<td  height=30  align=center colspan=2><hr width="75%"></td>
	</tr>
	
	<tr>
		<td colspan=2>
			<table width="100%">
				<tr>
					<td align=left valign=center class="smTxt" height=35 width=100>Primary Insured:&nbsp;</td>
					<td align=left height=35>
						<table class="tableTextName" border=0>
							<tr class="tableHdrRow">
								<td align=center class="smTxt"><b>Prefix</b></td>
								<td align=center class="smTxt"><b>First Name</b></td>
								<td align=center class="smTxt"><b>MI</b></td>
								<td align=center class="smTxt"><b>LastName</b></td>
								<td align=center class="smTxt"><b>Suffix</b></td>
							</tr>	
							<tr>
								<td align=center><input size=3 maxlength=5 type="text" name="prefix" value="<? print $PINamePrefix[1]; ?>"></td>
								<td align=center><input size=15 maxlength=45 type="text" name="firstname" value="<? print $PINameFirst[1]; ?>"></td>
								<td align=center><input size=1 maxlength=1 type="text" name="mi" value="<? print $PINameMI[1]; ?>"></td>
								<td align=center><input size=15 maxlength=45 type="text" name="lastname" value="<? print $PINameLast[1]; ?>"></td>
								<td align=center><input size=3 maxlength=5 type="text" name="suffix" value="<? print $PINameSuffix[1]; ?>"></td>
							</tr>	 
						</table>
					</td>
				</tr>
			</table>
		</td>						
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
<input type='hidden' name='typeid'  value='1'>
</form>
</div>

<div class="dentalInsureArea">
<form  action="UAmedinsure.php" method=post onsubmit="return formCheck(this);">
<table width="100%" class="outerBorderMessageTitleBlue">
	<tr>
		 <td height=20 align="center">Dental Insurance</td>
	</tr>	
</table>
<table width="100%" class="tblDetailsmTextOff">
	<tr> 
		<td  height=30 width="50%" align=left>Insurer:&nbsp;<select name="payorname"> 
			<option class="smallTxtGry" value="<? print $PayorID[2]; ?>"><? print $PayorName[2]; ?> 
			<? print $PayorNameList[2]; ?>
			</select>
		</td>
		<td  height=30 width="50%" align=left>Primary Care Doctor:&nbsp;<select name="provider"> <option class="smallTxtGry" value="<? print $ProviderID[2]; ?>"><? print $PrimaryProvider[2]; ?> 
			<? print $ProviderList; ?>
			</select>
		</td>
	</tr> 
	
	<tr>
		<td  height=30 width="50%" align=left>Group ID:&nbsp;<input size=15 maxlength=25 type="text" name="groupid" value="<? print $GroupID[2]; ?>"></td>
		<td  height=30 width="50%" align=left>Subscriber ID:&nbsp;<input size=15 maxlength=25 type="text" name="subscriber" value="<? print $SubscriberID[2]; ?>"></td>
	</tr> 
	
	<tr> 
		<td  height=30 width="50%" align=left>Office visit Co-Pay:&nbsp;<input size=15 maxlength=45 type="text" name="copay" value="<? print $OfficeCoPay[2]; ?>"></td>
		<td  height=30 width="50%" align=left>Insurance Telephone Nbr:&nbsp;<? print $PayorTeleNbr[2]; ?></td>
	</tr>
	
	<tr> 
		<td  height=30  align=center colspan=2><hr width="75%"></td>
	</tr>
	
	<tr>
		<td colspan=2>
			<table width="100%">
				<tr>
					<td align=left valign=center class="smTxt" height=35 width=100>Primary Insured:&nbsp;</td>
					<td align=left height=35>
						<table class="tableTextName" border=0>
							<tr class="tableHdrRow">
								<td align=center class="smTxt"><b>Prefix</b></td>
								<td align=center class="smTxt"><b>First Name</b></td>
								<td align=center class="smTxt"><b>MI</b></td>
								<td align=center class="smTxt"><b>LastName</b></td>
								<td align=center class="smTxt"><b>Suffix</b></td>
							</tr>	
							<tr>
								<td align=center><input size=3 maxlength=5 type="text" name="prefix" value="<? print $PINamePrefix[2]; ?>"></td>
								<td align=center><input size=15 maxlength=45 type="text" name="firstname" value="<? print $PINameFirst[2]; ?>"></td>
								<td align=center><input size=1 maxlength=1 type="text" name="mi" value="<? print $PINameMI[2]; ?>"></td>
								<td align=center><input size=15 maxlength=45 type="text" name="lastname" value="<? print $PINameLast[2]; ?>"></td>
								<td align=center><input size=3 maxlength=5 type="text" name="suffix" value="<? print $PINameSuffix[2]; ?>"></td>
							</tr>	 
						</table>
					</td>			
				</tr>
			</table>
		</td>	
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
<input type='hidden' name='typeid'  value='2'>
</form>
</div>

</body>
</html>
