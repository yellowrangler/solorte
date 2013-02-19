<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_prescdetail.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

//----------------------------------------------------------------------------------------------------------
// we are either being called by default  OR someone has clicked on list
//----------------------------------------------------------------------------------------------------------
if ( isset($_GET[prescid]) and ($_GET[prescid] != "") )
{
	
	// create the SQL statement to get our prescription, date, provider and pharmacy information for the row selected from if_presclist
	$sql = "SELECT * from ClientPrescriptionTBL 
		inner join PharmacyTBL on ClientPrescriptionTBL.PharmacyID = PharmacyTBL.ID  
		inner join CalendarTBL on ClientPrescriptionTBL.CalendarID = CalendarTBL.ID 
			where (ClientPrescriptionTBL.MEDPAL = '$Medpal' and ClientPrescriptionTBL.ID = '$_GET[prescid]')";
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query for PrescriptionTBL (195) - '$Medpal'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
		
	// Now lets first see if there is anything to run through.  If more or less then 1 we have an error
	$countRows = mysql_num_rows($sql_result);
	if ($countRows != 1)
	{
		$errmsg = " Error No rows or more then 1 row returned in select on prescr tbl. count = '$countRows'  - '$Medpal'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
	
	// lets initialize our display variables
	$Provider = "Not Supplied";
	$StartDate = "Not Supplied";
	$RenewDate = "Not Supplied";
	$PrescrID = "Not Supplied";
	$Medication = "Not Supplied";
	$Pharmacy = "Not Supplied";
	$Condition = "Not Supplied";
	$PharmacyContact = "Not Supplied";
	$PharmacyPhoneNbr = "Not Supplied";
	$PharmacyURL = "";
	$MedDosage = "Not Supplied";
	$MedQuantity = "Not Supplied";
	$MedSize = "Not Supplied";
	$Directions = "Not Supplied";
	$DisplayBlock = "";
	
	// now lets fetch our prescription information
	$result_array = mysql_fetch_assoc($sql_result);
	
	// lets start assigning values to our display fields
	// from the prescription table
	$PrescrID = $result_array["PrescrNbr"];
	$Medication = $result_array["Medication"];
	$Condition = $result_array["Condition"];
	$MedSize = $result_array["UnitSz"];
	$MedQuantity = $result_array["Quantity"];
	$MedDosage = $result_array["Dosage"];
	$Directions = $result_array["Directions"];
	
	// some tmp fields from prescr tbl
	$tmpProviderID = $result_array["ProviderID"];
	$tmpPharmacyID = $result_array["PharmacyID"];
	
	// from pharmacy table
	$Pharmacy = $result_array["Name"];
	$PharmacyURL = $result_array["URL"];
	
	// from the date table
	// create time stamp dates so we can turn them into human dates
	// first the start date
	
	$StartDate = CovertMySQLDate($result_array["StartDate"], 1, 1);
	$RenewDate = CovertMySQLDate($result_array["EndDate"], 1, 1);
	
	// lets get the provider full name
	// create the SQL statement to get our provider full name information.  join to get name
	$sql = "SELECT * from ProviderTBL inner join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID Where (ProviderTBL.ID = '$result_array[ProviderID]')";
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query join for Provider FullName prescr (397) - '$Medpal'  sql = '$sql'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
	
	// should only get one row that matches full name 
	$countRows = mysql_num_rows($sql_result);
	if ($countRows !=  1) 
	{
		$errmsg = " Error No rows or more then 1 row returned in join provider with  fullname. count = '$countRows'. sql = '$sql' - '$Medpal'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	
	// now get results of join
	$result_array = mysql_fetch_assoc($sql_result);
	// $tmpPrefix = trim($result_array[Prefix]);
	$tmpFirstName = trim($result_array[FirstName]);
	$tmpLastName = trim($result_array[LastName]);
	// $tmpSuffix = trim($result_array[Suffix]);
	$tmpString = sprintf("%s %s", $tmpFirstName, $tmpLastName);
	
	// set display variable provider
	$Provider = $tmpString;
	
	// lets get the pharmacy contact and phone number.  The name comes from full name db but the phone nbr comes from pharm address
	$sql = "SELECT * from PharmacyTBL inner join FullNameTBL on PharmacyTBL.FullNameID = FullNameTBL.ID
				inner join AddrTBL on PharmacyTBL.AddrID = AddrTBL.ID
				where PharmacyTBL.ID = '$tmpPharmacyID'";
				
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query  for PharmacyTBL  (396) - '$Medpal'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
	
	// should only get one row that matches id 
	$countRows = mysql_num_rows($sql_result);
	if ($countRows !=  1) 
	{
		$errmsg = " Error No rows or more then 1 row returned in pharmacy.  count = '$countRows' - '$Medpal'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	
	// now get results of select and update more fields
	$result_array = mysql_fetch_assoc($sql_result);
	
	// from address  table
	$PharmacyPhoneNbr = trim($result_array[PhoneNbr]);
	
	// from full name table
	// $tmpPrefix = trim($result_array[Prefix]);
	$tmpFirstName = trim($result_array[FirstName]);
	$tmpLastName = trim($result_array[LastName]);
	// $tmpSuffix = trim($result_array[Suffix]);
	$tmpString = sprintf("%s %s", $tmpFirstName, $tmpLastName);
	
	// set last display value
	$PharmacyContact = $tmpString;
	
	// Now lets build our html
	$DisplayBlock = "
		<tr>
			<td colspan=2 class=\"headerBorderGold\">Prescription Information</td> 
		</tr>
		
		<tr>
			<td height=30 width=\"50%\" align=left>Start Date:&nbsp;<b>".$StartDate."</b></td>
			<td width=\"50%\" align=left>Renew Date:&nbsp;<b>".$RenewDate."</b></td>
		</tr>
		
		<tr>
			<td colspan=2 align=left>Provider:&nbsp;<b>
				<a href=\"#\" onClick=\"(PopUpWindow('pudoctor.php?ProviderID=".$tmpProviderID."', 'r', 4))\" class=\"tblDetailsmTextLinkOff\">".$Provider."</a>	</b>
			</td>
		</tr>
		
		<tr>
			<td height=30 colspan=2 align=left>Condition:&nbsp;<b>".$Condition."</b></td>
		</tr>
			
		<tr>
			<td height=30 colspan=2 align=left>Medication:&nbsp;<b>".$Medication."</b></td>
		</tr>
		
		<tr>
			<td width=\"50%\" align=left>Quantity:&nbsp;<b>".$MedQuantity."</b></td>
			<td height=30 width=\"50%\" align=left>Size:&nbsp;<b>".$MedSize."</b></td>
		</tr>
	
		<tr>
			<td colspan=2 align=left>Dosage:&nbsp;<b>".$MedDosage."</b></td>
		</tr>
	
		<tr>
			<td height=30 width=\"50%\" colspan=2 align=left>Directions:&nbsp;<b>".$Directions."</b></td>
		</tr>
	
		<tr>
			<td height=30 colspan=2 align=left>Pharmacy:&nbsp;
				<a href=\"#\" onClick=\"(PopUpWindow('".$PharmacyURL."', 'f', 2))\" class=\"tblDetailsmTextLinkOff\">".$Pharmacy."</a>
			</td>
		</tr>
		<tr>
			<td colspan=2 align=left>Prescription ID:&nbsp;<b>".$PrescrID."</b></td>
		</tr>
	
		<tr>
			<td height=30 colspan=2 align=left>Pharmacy Contact:&nbsp;<b>".$PharmacyContact."</b></td>
		</tr>
		<tr>
			<td colspan=2 align=\"left\">PharmacyPhone Nbr:&nbsp;<b>".$PharmacyPhoneNbr."</b></td>
		</tr>
		";
		
} // end of If Get
else
{
	$DisplayBlock = "
						<tr>
							<td align=center><h2>Please select from List Above</h2></td>
						</tr>
						";
}	
?>
<html>

<head>
<title>HealthYourSelf Customer Appointment Calander</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />
<style type="text/css"> 

.smallText2 {
		font: 400 13px Arial, Geneva;
		line-height: 14px; 
		}
		
</style>
<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>
<script type="text/javascript">
function startUp() 
{	
	<? print $JavaScriptLogMsg; ?> 
		
	<? print $JavaScriptMsg; ?>
}
</script>
</head>

<body onload="startUp()">

<div>
<br>
<table width="100%" class="tblDetailsmTextOff">
	<? print $DisplayBlock; ?>
</table>

</div>
</body>
</html>
