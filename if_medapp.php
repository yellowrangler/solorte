<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_medapp.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

// create the SQL statement to get our calendar events for medical appointments only
$sql = "SELECT * from ClientAppointmentTBL 
	inner join CalendarTBL on ClientAppointmentTBL.CalendarID = CalendarTBL.ID 
	where MEDPAL = '$Medpal' order by StartDate";
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ClientCalendarTBL join apptment(195) - '$Medpal'";
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
		$Description = "Empty";
		$Provider = "Not Supplied";
		$AppDate = "Not Supplied";
		$AppTime = "Not Supplied";
	
		$AppDate = CovertMySQLDate($result_arr["StartDate"], 1, 1);
		$AppTime = CovertMySQLTime($result_arr["StartTime"], 1, 2);
		
		// update some more required display fields
		$Description = $result_arr[Appointment];
		
		// lets get the provider full name
		// create the SQL statement to get our provider full name information.  join to get name
		$sql3 = "SELECT * from ProviderTBL inner join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID Where (ProviderTBL.ID = '$result_arr[ProviderID]')";
		if (!$sql_result3 = mysql_query($sql3, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query join for Provider FullName (397) - '$Medpal'  sql = '$sql3'";
			$location = "";
			$severity = 1;	
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			LogErr($errmsg, $location);
		}	
		
		// should only get one row that matches full name 
		$countRows3 = mysql_num_rows($sql_result3);
		if ($countRows3 !=  1) 
		{
			$errmsg = " Error No rows or more then 1 row returned in join prov fullname.  count = '$countRows3 - '$Medpal'";
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
		
	
		if ($FlipFlag == 1)
		{
			$DisplayBlock .= "\t<tr>\n\t <td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOff\">".$AppDate."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOff\">".$AppTime."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOff\">".$Provider."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"45%\" align=left height=17 class=\"tblDetailsmTextOff\">".$Description."</td>\n\t</tr>\n";
			
			$FlipFlag = 0;
		}
		else
		{
			$DisplayBlock .= "\t<tr>\n\t <td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOn\">".$AppDate."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOn\">".$AppTime."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOn\">".$Provider."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"45%\" align=left height=17 class=\"tblDetailsmTextOn\">".$Description."</td>\n\t</tr>\n";
			
			$FlipFlag = 1;
		}
	}  // end of while
}
else
{
	$DisplayBlock = "\t<tr>\n\t <td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>\n";
	$DisplayBlock .= "\t\t<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>\n ";
	$DisplayBlock .= "\t\t<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>\n ";
	$DisplayBlock .= "\t\t<td width=\"45%\" align=left height=17 class=\"tblDetailsmTextOff\">No Appointments</td>\n\t</tr>";
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
