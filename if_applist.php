<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_applist.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

//----------------------------------------------------------------------------------------------------------
// create the SQL statement to get our calendar events for medical appointments only
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT ClientAppointmentTBL.ID as AppID, CalendarID, ProviderID, Appointment, 
			MEDPAL, StartDate, StartTime, FirstName, LastName, Suffix 
			from ClientAppointmentTBL inner join CalendarTBL on ClientAppointmentTBL.CalendarID = CalendarTBL.ID 
			left join ProviderTBL on ClientAppointmentTBL.ProviderID = ProviderTBL.ID
			left join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID
			WHERE (MEDPAL = '$Medpal')";
			
if (isset($_GET[order]))
{
	//--------------------------------------------------------------------------------------------------
	// We ARE a get
	//
	// First lets see if our sort cookie is set.  If not lets set it up (WE will be using cookies
	// via the php session service.  Another chance for us to learn.
	//--------------------------------------------------------------------------------------------------
	if (empty($_SESSION[MHApp]))
	{
		//	echo "WE are empty session\n";
		//----------------------------------------------------------------------------------------------
		// Ok nothing here to see folks.  But honestly - we need to set our variables for first time
		//----------------------------------------------------------------------------------------------
		$_SESSION[MHDate] = "DESC";
		$_SESSION[MHTime] = "DESC";
		$_SESSION[MHApp] = "ASC";
		$_SESSION[MHProv] = "ASC";
	}
			
	//--------------------------------------------------------------------------------------------------
	// Now that the session Variables are set it is time to build our sql based on what was passed
	//--------------------------------------------------------------------------------------------------
	switch ($_GET[order])
	{
		case 'adate':
			$sql .= " ORDER BY StartDate ".$_SESSION[MHDate];
			if ($_SESSION[MHDate] == "ASC")
				$_SESSION[MHDate] = "DESC";
			else
				$_SESSION[MHDate] = "ASC";
			break;
			
		case 'atime':
			$sql .= " ORDER BY StartDate ".$_SESSION[MHDate].", StartTime ".$_SESSION[MHTime];
			if ($_SESSION[MHTime] == "ASC")
				$_SESSION[MHTime] = "DESC";
			else
				$_SESSION[MHTime] = "ASC";
			break;	
	
		case 'desc':
			$sql .= " ORDER BY Appointment ".$_SESSION[MHApp];
			if ($_SESSION[MHApp] == "ASC")
				$_SESSION[MHApp] = "DESC";
			else
				$_SESSION[MHApp] = "ASC";
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

// now lets run the sql that was built
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ClientCalendarTBL join apptment(195) - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
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
		$Description = "Empty";
		$Provider = "Not Supplied";
		$AppDate = "Not Supplied";
		$AppTime = "Not Supplied";
		$AppID = "Not Supplied";
	
		// set these display variable
		$AppDate = CovertMySQLDate($result_arr["StartDate"], 1, 1);
		$AppTime = CovertMySQLTime($result_arr["StartTime"], 1, 2);
		
		// update some more required display fields
		$Description = $result_arr[Appointment];
		$AppID = $result_arr[AppID];
		
		$tmpString = sprintf("%s %s", $tmpFirstName, $tmpLastName);
		$Provider = $result_arr[FirstName]." ".$result_arr[LastName]." ".$result_arr[Suffix];
		
	
		if ($FlipFlag == 1)
		{
			$DisplayBlock .= "
				<tr>
					<td width=\"5%\" align=center height=17 class=\"tblDetailsmTextOff\">
						<a href=\"if_appdetail.php?appid=".$AppID."\" target=\"detailFrame\">
							<img id=\"moredetail\" border=\"0\" height=20 width=20 src=\"images/binoculars.gif\">
						</a>
					</td>
					<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOff\">".$AppDate."</td>
					<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOff\">".$AppTime."</td>
					<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOff\">".$Provider."</td>
					<td width=\"35%\" align=left height=17 class=\"tblDetailsmTextOff\">".$Description."</td>
				</tr>
				";
			
			$FlipFlag = 0;
		}
		else
		{
			$DisplayBlock .= "
				<tr>
					<td width=\"5%\" align=center height=17 class=\"tblDetailsmTextOn\">
						<a href=\"if_appdetail.php?appid=".$AppID."\" target=\"detailFrame\">
							<img id=\"moredetail\" border=\"0\" height=20 width=20 src=\"images/binocularsOn.gif\">
						</a>
					</td>
					<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOn\">".$AppDate."</td>
					<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOn\">".$AppTime."</td>
					<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOn\">".$Provider."</td>
					<td width=\"35%\" align=left height=17 class=\"tblDetailsmTextOn\">".$Description."</td>
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
			<td width=\"5%\" align=center height=17 class=\"tblDetailsmTextOff\">
				<a href=\"if_appdetail.php?appid=".$AppID."\" target=\"detailFrame\">
					<img id=\"moredetail\" border=\"0\" height=20 width=20 src=\"images/binoculars.gif\">
				</a>
			</td>
			<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>
			<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>
			<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>
			<td width=\"35%\" align=left height=17 class=\"tblDetailsmTextOff\">No Appointments</td>
		</tr>
		";
}


?>
<html>

<head>
<title>HealthYourSelf Customer Appointment List</title>
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
