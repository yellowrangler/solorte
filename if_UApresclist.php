<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_UAprescdetaillist.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

// create the SQL statement to get our calendar events for prescription appointments only
$sql = "SELECT 	ClientPrescriptionTBL.ID as CP_ID, MEDPAL, PrescrNbr, CalendarID, PharmacyID, Medication, 
				Condition, ProviderID, UnitSZ, Quantity, Dosage, Directions, StartDate, StartTime, 
				EndDate, EndTime, CalendarTBL.ID as Cal_ID, FirstName, LastName, Suffix
				from ClientPrescriptionTBL inner join CalendarTBL on ClientPrescriptionTBL.CalendarID = CalendarTBL.ID
				left join ProviderTBL on ClientPrescriptionTBL.ProviderID = ProviderTBL.ID
				left join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID
				where (MEDPAL = $Medpal)";
			
if (isset($_GET[order]))
{
	//--------------------------------------------------------------------------------------------------
	// We ARE a get
	//
	// First lets see if our sort cookie is set.  If not lets set it up (WE will be using cookies
	// via the php session service.  Another chance for us to learn.
	//--------------------------------------------------------------------------------------------------
	if (empty($_SESSION[MHDate]))
	{
		//	echo "WE are empty session\n";
		//----------------------------------------------------------------------------------------------
		// Ok nothing here to see folks.  But honestly - we need to set our variables for first time
		//----------------------------------------------------------------------------------------------
		$_SESSION[MHDate] = "DESC";
		$_SESSION[MHMed] = "ASC";
		$_SESSION[MHReord] = "ASC";
		$_SESSION[MHProv] = "ASC";
	}
			
	//--------------------------------------------------------------------------------------------------
	// Now that the session Variables are set it is time to build our sql based on what was passed
	//--------------------------------------------------------------------------------------------------
	switch ($_GET[order])
	{
		case 'rdate':
			$sql .= " ORDER BY EndDate ".$_SESSION[MHDate];
			if ($_SESSION[MHDate] == "ASC")
				$_SESSION[MHDate] = "DESC";
			else
				$_SESSION[MHDate] = "ASC";
			break;
			
		case 'med':
			$sql .= " ORDER BY Medication ".$_SESSION[MHMed];
			if ($_SESSION[MHMed] == "ASC")
				$_SESSION[MHMed] = "DESC";
			else
				$_SESSION[MHMed] = "ASC";
			break;	
	
		case 'reorder':
			$sql .= " ORDER BY PrescrNbr ".$_SESSION[MHReord];
			if ($_SESSION[MHReord] == "ASC")
				$_SESSION[MHReord] = "DESC";
			else
				$_SESSION[MHReord] = "ASC";
			break;
			
		case 'provider':
			$sql .= " ORDER BY LastName ".$_SESSION[MHProv];
			if ($_SESSION[MHProv] == "ASC")
				$_SESSION[MHProv] = "DESC";
			else
				$_SESSION[MHProv] = "ASC";
			break;	
			
		}  // End of Switch
}  // End of if GET
else
{
	// echo "WE are default\n";
	//----------------------------------------------------------------------------------------------
	// first time thru so default to desc sort of all info
	//----------------------------------------------------------------------------------------------
	
	$sql .= " ORDER BY EndDate DESC";
}  // End of Else

// now lets run the sql that was built
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ClientPrescriptionTBL (195) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
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
		$PrescrNbr = "Not Supplied";
		
		// create dates so we can turn them into human dates
		$RenewDate = CovertMySQLDate($result_arr["EndDate"], 1, 1);
	
		// now we set some of our display variables 
		$PrescrNbr = $result_arr[PrescrNbr];
		$Medication = $result_arr[Medication];
		
		$PrescID = $result_arr[CP_ID];
									
		$Provider = $result_arr[FirstName]." ".$result_arr[LastName]." ".$result_arr[Suffix];
		
		if ($FlipFlag == 1)
		{
			$DisplayBlock .= "
				<tr>
					<td width=\"10%\" align=center height=17 class=\"tblDetailsmTextOff\">
						<a href=\"if_UAprescdetail.php?msgTxt=Welcome to Update Prescriptions!&prescid=".$PrescID."\" target=\"detailFrame\">
							<img id=\"moredetail\" border=\"0\" height=20 width=20 src=\"images/binoculars.gif\">
						</a>
					</td>
					<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOff\">".$RenewDate."</td>
					<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOff\">".$Medication."</td>
					<td width=\"35%\" align=left height=17 class=\"tblDetailsmTextOff\">".$Provider."</td>
					<td width=\"15%\" align=left height=17 class=\"tblDetailsmTextOff\">".$PrescrNbr."</td>
				</tr>
			";		
						
			$FlipFlag = 0;
		}
		else
		{
			$DisplayBlock .= "
				<tr>
					<td width=\"10%\" align=center height=17 class=\"tblDetailsmTextOn\">
						<a href=\"if_UAprescdetail.php?msgTxt=Welcome to Update Prescriptions!&prescid=".$PrescID."\" target=\"detailFrame\">
							<img id=\"moredetail\" border=\"0\" height=20 width=20 src=\"images/binocularsOn.gif\">
						</a>
					</td>
					<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOn\">".$RenewDate."</td>
					<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOn\">".$Medication."</td>
					<td width=\"35%\" align=left height=17 class=\"tblDetailsmTextOn\">".$Provider."</td>
					<td width=\"15%\" align=left height=17 class=\"tblDetailsmTextOn\">".$PrescrNbr."</td>
				</tr>
			";	
				
			$FlipFlag = 1;
		}
	}  // end of while
}
else
{
	$DisplayBlock .= "
		<tr>
			<td width=\"10%\" align=center height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>
			<td width=\"15%\" align=left height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>
			<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOff\">No Prescription</td>
			<td width=\"35%\" align=left height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>
			<td width=\"15%\" align=left height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>
		</tr>
	";	
}

?>
<html>

<head>
<title>HealthYourSelf Customer Prescription Update</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

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

<div>
<center>
<table width="100%" cellspacing=0 cellpadding=0 border=0>
		<?php print $DisplayBlock; ?>
</table>

</center>
</div>
</body>
</html>
