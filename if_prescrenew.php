<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_prescrenew.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

// create the SQL statement to get our calendar events for medical appointments only
$sql = "SELECT * from ClientPrescriptionTBL inner join CalendarTBL on ClientPrescriptionTBL.CalendarID = CalendarTBL.ID	where MEDPAL = '$Medpal'";
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ClientCalendarTBL (195) - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($errmsg, $location);
}
	
// Now lets first see if there is anything to run through
$countRows = mysql_num_rows($sql_result);
if ($countRows >  0) 
{	
	// Used to turn colors on and off 
	$FlipFlag = 1;
	
	// initialize display block
	$DisplayBlock = "";
	
	// now lets run the table and get our medical appointments
	while ($result_arr = mysql_fetch_assoc($sql_result))
	{
		// lets initialize some of our variables
		$Provider = "Not Supplied";
		$RenewDate = "Not Supplied";
		$PrescID = "Not Supplied";
		$Medication = "Not Supplied";
		$Pharmacy = "Not Supplied";
	
		// set these display variable
		$RenewDate = CovertMySQLDate($result_arr["EndDate"], 1, 1);
		
		// now we set some of our display variables 
		$PrescID = $result_arr[PrescrNbr];
		$Medication = $result_arr[Medication];
									
		// lets get the provider full name
		// create the SQL statement to get our provider full name information.  join to get name
		$sql3 = "SELECT * from ProviderTBL inner join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID Where (ProviderTBL.ID = '$result_arr[ProviderID]')";
		if (!$sql_result3 = mysql_query($sql3, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query join for Provider FullName prescr (397) - '$Medpal'  sql = '$sql3'";
			$location = "";
			$severity = 1;	
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			LogErr($errmsg, $location);
		}	
		
		// should only get one row that matches full name 
		$countRows3 = mysql_num_rows($sql_result3);
		if ($countRows3 !=  1) 
		{
			$errmsg = " Error No rows or more then 1 row returned in join prov fullname.  prescrip count = '$countRows3 - '$Medpal'";
			$location = "";
			$severity = 1;	
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			LogErr($errmsg, $location);
		}
		
		// now get results of join
		$result_arr3 = mysql_fetch_assoc($sql_result3);
		// $tmpPrefix = trim($result_arr3[Prefix]);
		$tmpFirstName = trim($result_arr3[FirstName]);
		$tmpLastName = trim($result_arr3[LastName]);
		// $tmpSuffix = trim($result_arr3[Suffix]);
		$tmpString = sprintf("%s %s", $tmpFirstName, $tmpLastName);
		$Provider = $tmpString;
		
		// lets get the pharmacy  name
		// create the SQL statement to get our host name information.
		$sql4 = "SELECT * from PharmacyTBL where PharmacyTBL.ID = '$result_arr[PharmacyID]'";
		if (!$sql_result4 = mysql_query($sql4, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query  for PharmacyTBL  (396) - '$Medpal'";
			$location = "";
			$severity = 1;	
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			LogErr($errmsg, $location);
		}	
		
		// should only get one row that matches id 
		$countRows4 = mysql_num_rows($sql_result4);
		if ($countRows4 !=  1) 
		{
			$errmsg = " Error No rows or more then 1 row returned in pharmacy.  count = '$countRows4' - '$Medpal'";
			$location = "";
			$severity = 1;	
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			LogErr($errmsg, $location);
		}
		
		// now get results of select and update more fields
		$result_arr4 = mysql_fetch_assoc($sql_result4);
		$Pharmacy = trim($result_arr4[Name]);

		
	
		if ($FlipFlag == 1)
		{
			$DisplayBlock .= "\t<tr>\n\t\t<td width=\"15%\" height=17 align=center height=17 class=\"tblDetailsmTextOff\">".$RenewDate."</td>\n";
			$DisplayBlock .= "\t\t <td width=\"25%\" align=left class=\"tblDetailsmTextOff\">".$Medication."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"25%\" align=left class=\"tblDetailsmTextOff\">".$Provider."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"15%\" align=left class=\"tblDetailsmTextOff\">".$PrescID."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"20%\" align=left class=\"tblDetailsmTextOff\">".$Pharmacy."</td>\n\t</tr>\n";
			
			$FlipFlag = 0;
		}
		else
		{
			$DisplayBlock .= "\t<tr>\n\t\t<td width=\"15%\"  height=17 align=center height=17 class=\"tblDetailsmTextOn\">".$RenewDate."</td>\n";
			$DisplayBlock .= "\t\t <td width=\"25%\" align=left class=\"tblDetailsmTextOn\">".$Medication."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"25%\" align=left class=\"tblDetailsmTextOn\">".$Provider."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"15%\" align=left class=\"tblDetailsmTextOn\">".$PrescID."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"20%\" align=left class=\"tblDetailsmTextOn\">".$Pharmacy."</td>\n\t</tr>\n";
			
			$FlipFlag = 1;
		}
	}  // end of while
}
else
{
	$DisplayBlock .= "\t\t<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>\n";
	$DisplayBlock .= "\t<tr>\n\t <td width=\"25%\" align=left class=\"tblDetailsmTextOff\">&nbsp;</td>\n";
	$DisplayBlock .= "\t\t<td width=\"25%\" align=left class=\"tblDetailsmTextOff\">No Prescription</td>\n";
	$DisplayBlock .= "\t\t<td width=\"15%\" align=left class=\"tblDetailsmTextOff\">&nbsp;</td>\n";
	$DisplayBlock .= "\t\t<td width=\"20%\" align=left class=\"tblDetailsmTextOff\">&nbsp;</td>\n\t</tr>\n";
	
}


?>
<html>

<head>
<title>HealthYourSelf Customer Appointment Calander</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />
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

<table  width="100%" cellspacing=0>
	
		<? print $DisplayBlock; ?>

</table>

</div>
</body>
</html>
