<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_caldetail.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');


// now lets get our appointments based on appointment type (either medical or prescription)
// first - put timestamp into mysql date format
$mysqlDate = date("Y-m-d", $_GET[timestamp]);
$DisplayBlock = "";

// second - create the SQL statement to get our calendar events for date that equates
// first we will look for appointments
	// create the SQL statement to get our information 
$sql = "SELECT * from ClientAppointmentTBL 
		left join CalendarTBL on ClientAppointmentTBL.CalendarID = CalendarTBL.ID
		left join EventTypeTBL on ClientAppointmentTBL.EventTypeID = EventTypeTBL.ID
		left join ProviderTBL on ClientAppointmentTBL.ProviderID = ProviderTBL.ID
		left join HostTBL on ClientAppointmentTBL.HostID = HostTBL.ID
		left join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID
		where (ClientAppointmentTBL.MEDPAL = '$Medpal' and (StartDate = '$mysqlDate') )";
		
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ClientAppointmentTBL multiple joins (295) - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

// Now lets first see if there is anything to run through.  If more or less then 1 we have an error
$countRows = mysql_num_rows($sql_result);
if ($countRows > 0)
{
	$GotOne = 1;
	
	// fetch the results
	while ($result_arr = mysql_fetch_assoc($sql_result))
	{
		//------------------------------------------------------------------------------------------------------
		// Start date 
		//------------------------------------------------------------------------------------------------------
		$StartDate = CovertMySQLDate($result_arr["StartDate"], 1, 1);
		$StartTime = CovertMySQLTime($result_arr["StartTime"], 1, 1);
		
		//------------------------------------------------------------------------------------------------------	
		// provider
		//------------------------------------------------------------------------------------------------------
		$DisplayProvider = $result_arr["FirstName"]." ".$result_arr["LastName"]." ".$result_arr["Suffix"];
		$DisplayProviderID = $result_arr["ProviderID"];
		
		//------------------------------------------------------------------------------------------------------
		// the host information
		//------------------------------------------------------------------------------------------------------
		$DisplayHost = $result_arr["Name"];
		$DisplayHostID = $result_arr["HostID"];
		
		$DisplayEventType = $result_arr["EventType"];
		
		//------------------------------------------------------------------------------------------------------
		// the description
		//------------------------------------------------------------------------------------------------------
		$DisplayDesc = $result_arr["Appointment"];
		
		// Now lets build our html
		$DisplayBlock .= "
			<br>
			<table width=\"100%\" class=\"tblDetailsmTextOff\">
				<tr>
					<td colspan=2 class=\"headerBorderGold\">Appointment Information</td> 
				</tr>
			
				<tr>
					<td width=\"50%\" align=left>Date:&nbsp;<b>".$StartDate."</b></td>
					<td width=\"50%\" align=left>Time:&nbsp;<b>".$StartTime."</b></td>
				</tr>
				
				<tr>
					<td  height=30 colspan=2 align=left>Provider:&nbsp;<b>
						<a href=\"#\" onClick=\"(PopUpWindow('pudoctor.php?ProviderID=".$DisplayProviderID."&HostID=".$DisplayHostID."', 'r', 4))\" class=\"tblDetailsmTextLinkOff\">".$DisplayProvider."</a>	</b>
					</td>
				</tr>
				<tr>
					<td align=left colspan=2>Location:&nbsp;<b>".$DisplayHost."</b></td>
				</tr>
				<tr>
					<td align=left colspan=2>Type:&nbsp;<b>".$DisplayEventType."</b></td>
				</tr>
				<tr>
					<td  height=30 colspan=2 align=left>Description:&nbsp;<b>".$DisplayDesc."</b></td>
				</tr>
			</table>
			";
	} // end of while	
} // end of if rows > 0

// Second we will look for Prescriptions
$sql = "SELECT * from ClientPrescriptionTBL 
	inner join PharmacyTBL on ClientPrescriptionTBL.PharmacyID = PharmacyTBL.ID  
	inner join CalendarTBL on ClientPrescriptionTBL.CalendarID = CalendarTBL.ID 
		where (ClientPrescriptionTBL.MEDPAL = '$Medpal' and (EndDate = '$mysqlDate') )";
		
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
if ($countRows > 0)
{
	$GotOne = 1;
	
	while ($result_array = mysql_fetch_assoc($sql_result))
	{
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
		if ($countRows != 1) 
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
		$DisplayBlock .= "
			<br>
			<table width=\"100%\" class=\"tblDetailsmTextOff\">
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
					<td height=30 colspan=2 align=left>Pharmacy:&nbsp;<b>
						<a href=\"#\" onClick=\"(PopUpWindow('".$PharmacyURL."', 'f', 2))\" class=\"tblDetailsmTextLinkOff\">".$Pharmacy."</a></b>
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
			</table>
			";
	} //end of while	
}	

// Third we will look for Vaccinations
$sql = "SELECT FirstName, LastName, Suffix, ClientVaccInocTBL.ProviderID as ProvID, 
		VaccInocType, CalendarID, Medication, ClientVaccInocTBL.ID as VaccInocID,
		StartDate, StartTime, EndDate, EndTime, Duration, AppType
		from ClientVaccInocTBL
		left join ProviderTBL on ClientVaccInocTBL.ProviderID = ProviderTBL.ID	
		left join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID
		left join CalendarTBL on ClientVaccInocTBL.CalendarID = CalendarTBL.ID
		left join VaccInocTypeTBL on ClientVaccInocTBL.VaccInocTypeID = VaccInocTypeTBL.ID
		where (ClientVaccInocTBL.MEDPAL = '$Medpal' and EndDate = '$mysqlDate')";
		
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ClientVaccInocTBL multiple joins (295) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

// Now lets first see if there is anything to run through.  If more or less then 1 we have an error
$countRows = mysql_num_rows($sql_result);
if ($countRows > 0)
{
	$GotOne = 1;
	
	// fetch the results
	while($result_arr = mysql_fetch_assoc($sql_result))
	{
				//------------------------------------------------------------------------------------------------------
		// Start date 
		//------------------------------------------------------------------------------------------------------
		$StartDate = CovertMySQLDate($result_arr["StartDate"], 1, 1);
		
		//------------------------------------------------------------------------------------------------------
		// End date 
		//------------------------------------------------------------------------------------------------------
		$EndDate = CovertMySQLDate($result_arr["EndDate"], 1, 1);
	
		//------------------------------------------------------------------------------------------------------	
		// provider
		//------------------------------------------------------------------------------------------------------
		$DisplayProvider = $result_arr["FirstName"]." ".$result_arr["LastName"]." ".$result_arr["Suffix"];
		$DisplayProviderID = $result_arr["ProvID"];
		
		//------------------------------------------------------------------------------------------------------
		// the medication
		//------------------------------------------------------------------------------------------------------
		$DisplayMedication = $result_arr["Medication"];
		
		//------------------------------------------------------------------------------------------------------
		// the description
		//------------------------------------------------------------------------------------------------------
		$DisplayVaccInoc = $result_arr["VaccInocType"];
		
		// Now lets build our html
		$DisplayBlock .= "
			<br>
			<table width=\"100%\" class=\"tblDetailsmTextOff\">
				<tr>
					<td colspan=2 class=\"headerBorderGold\">Vaccination and Immunization Information</td> 
				</tr>
				<tr>
					<td  height=30 colspan=2 align=left>Vaccination:&nbsp;<b>".$DisplayVaccInoc."</b></td>
				</tr>
				<tr>http://solorte/beta/if_UAmedvidetail.php?msgTxt=Welcome to Update Vaccinations!&vaccinocid=3
					<td colspan=2 align=left>Provider:&nbsp;<b>
						<a href=\"#\" onClick=\"(PopUpWindow('pudoctor.php?ProviderID=".$DisplayProviderID."', 'r', 4))\" class=\"tblDetailsmTextLinkOff\">".$DisplayProvider."</a>	</b>
					</td>
				</tr>
			
				<tr>
					<td  height=30 width=\"50%\" align=left>Start Date:&nbsp;<b>".$StartDate."</b></td>
					<td width=\"50%\" align=left>Renew Date:&nbsp;<b>".$EndDate."</b></td>
				</tr>
			
				<tr>
					<td  height=30 colspan=2 width=\"50%\" align=left>Medication:&nbsp;<b>".$DisplayMedication."</b></td>
				</tr>
			</table>
			";		
	} // end of while	
}	


// if we did not get one event we should not have come here
if ($GotOne != 1)
{
	$errmsg = "No hits on calendar.  - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}


?>	
<html>  
<head> 
<title>Calander Detail Information</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />
<style type="text/css">
.headerBorderGold {
		color:#23708e;
		font: 700 15px Arial,Helvetica;
		border-top:0px solid #d1b60c;
		border-left:0px solid #d1b60c;
		border-right:0px solid #d1b60c;
		border-bottom:1px solid #d1b60c;
		}		
		
.smallText2 {
		font: 400 13px Arial, Geneva;
		line-height: 14px; 
		}
</style>
<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>
<script type="text/javascript">
function startUp() 
{	
	<?php print $JavaScriptLogMsg; ?>
		
	<?php print $JavaScriptMsg; ?>
}
</script>
</head>  
<body onload="startUp()">
<div class="smallText2">

<?php print $DisplayBlock; ?>

</div>
</body>
</html>