<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_vilist.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

// create the SQL statement to get our calendar events for medical appointments only
$sql = "SELECT FirstName, LastName, Suffix, ClientVaccInocTBL.ProviderID as ProvID, 
			VaccInocType, CalendarID, Medication, ClientVaccInocTBL.ID as VaccInocID,
			StartDate, StartTime, EndDate, EndTime, Duration, AppType
			from ClientVaccInocTBL
			left join ProviderTBL on ClientVaccInocTBL.ProviderID = ProviderTBL.ID	
			left join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID
			left join CalendarTBL on ClientVaccInocTBL.CalendarID = CalendarTBL.ID
			left join VaccInocTypeTBL on ClientVaccInocTBL.VaccInocTypeID = VaccInocTypeTBL.ID
			where (ClientVaccInocTBL.MEDPAL = '$Medpal')";
			
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
		$_SESSION[MHDesc] = "ASC";
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
			$sql .= " ORDER BY VaccInocType ".$_SESSION[MHDesc];
			if ($_SESSION[MHDesc] == "ASC")
				$_SESSION[MHDesc] = "DESC";
			else
				$_SESSION[MHDesc] = "ASC";
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
	
	$sql .= " ORDER BY StartDate DESC";
}  // End of Else

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ClientCalendarTBL join vacinoc  (195) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
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
		//------------------------------------------------------------------------------------------------------
		// End date 
		//------------------------------------------------------------------------------------------------------
		$EndDate = CovertMySQLDate($result_arr["EndDate"], 1, 1);
	
		//------------------------------------------------------------------------------------------------------	
		// provider
		//------------------------------------------------------------------------------------------------------
		$DisplayProvider = $result_arr["FirstName"]." ".$result_arr["LastName"]." ".$result_arr["Suffix"];
		
		//------------------------------------------------------------------------------------------------------
		// the medication
		//------------------------------------------------------------------------------------------------------
		$DisplayMedication = $result_arr["Medication"];
		
		//------------------------------------------------------------------------------------------------------
		// the description
		//------------------------------------------------------------------------------------------------------
		$DisplayVaccInoc = $result_arr["VaccInocType"];
		
		$DisplayVaccInocID = $result_arr["VaccInocID"];
		
		if ($FlipFlag == 1)
		{
			$DisplayBlock .= "
				<tr> 	
					<td width=\"10%\" align=center height=17 class=\"tblDetailsmTextOff\">
						<a href=\"if_videtail.php?viid=".$DisplayVaccInocID."\" target=\"detailFrame\">
							<img id=\"moredetail\" border=\"0\" height=20 width=20 src=\"images/binoculars.gif\"></a>
					</td>
					<td width=\"10%\" align=center height=17 class=\"tblDetailsmTextOff\">".$EndDate."</td>
					<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOff\">".$DisplayVaccInoc."</td>
					<td width=\"30%\" align=left height=17 class=\"tblDetailsmTextOff\">".substr($DisplayMedication, 0, 24)."</td>
					<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOff\">".$DisplayProvider."</td>
				</tr>
				";
			
			$FlipFlag = 0;
		}
		else
		{
			$DisplayBlock .= "
			<tr> 	
				<td width=\"10%\" align=center height=17 class=\"tblDetailsmTextOn\">
					<a href=\"if_videtail.php?viid=".$DisplayVaccInocID."\" target=\"detailFrame\">
						<img id=\"moredetail\" border=\"0\" height=20 width=20 src=\"images/binocularsOn.gif\">
					</a>
				</td>
				<td width=\"10%\" align=center height=17 class=\"tblDetailsmTextOn\">".$EndDate."</td>
				<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOn\">".$DisplayVaccInoc."</td>
				<td width=\"30%\" align=left height=17 class=\"tblDetailsmTextOn\">".substr($DisplayMedication, 0, 24)."</td>
				<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOn\">".$DisplayProvider."</td>
			</tr>
			";
			
			$FlipFlag = 1;
		}
	}  // end of while
}
else
{
	$DisplayBlock = " 
		<tr> 	
			<td width=\"10%\" align=center height=17 class=\"tblDetailsmTextOff\">
				<a href=\"if_videtail.php?viid=".$DisplayVaccInocID."\" target=\"detailFrame\">
					<img id=\"moredetail\" border=\"0\" height=20 width=20 src=\"images/binoculars.gif\">
				</a>
			</td>
			<td width=\"10%\" align=center height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>
			<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>
			<td width=\"30%\" align=left height=17 class=\"tblDetailsmTextOff\">No Vaccinations</td>
			<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>
		</tr>
		";
}


?>
<html>

<head>
<title>HealthYourSelf Vaccination Detail</title>
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

<table  width="100%" cellspacing=0>
		
	<?php print $DisplayBlock; ?>

</table>

</div>
</body>
</html>
