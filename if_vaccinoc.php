<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_vaccinoc.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

// create the SQL statement to get our calendar events for medical appointments only
$sql = "SELECT * from ClientVaccInocTBL inner join CalendarTBL on ClientVaccInocTBL.CalendarID = CalendarTBL.ID 
			left join ProviderTBL on ClientVaccInocTBL.ProviderID = ProviderTBL.ID
			inner join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID
			where MEDPAL = '$Medpal'";
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
		// lets initialize some of our variables
		$EndDate = "Not Supplied";
	
		$EndDate = CovertMySQLDate($result_arr["EndDate"], 1, 1);
		
		if ($FlipFlag == 1)
		{
			$DisplayBlock .= "\t<tr>\n\t <td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOff\">".$EndDate."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOff\">".$result_arr[VaccInoc]."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"35%\" align=left height=17 class=\"tblDetailsmTextOff\">".$result_arr[Medication]."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOff\">".$result_arr[FirstName]." ".$result_arr[LastName]." ".$result_arr[Suffix]."</td>\n\t</tr>\n";
			
			$FlipFlag = 0;
		}
		else
		{
			$DisplayBlock .= "\t<tr>\n\t <td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOn\">".$EndDate."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOn\">".$result_arr[VaccInoc]."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"35%\" align=left height=17 class=\"tblDetailsmTextOn\">".$result_arr[Medication]."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOn\">".$result_arr[FirstName]." ".$result_arr[LastName]." ".$result_arr[Suffix]."</td>\n\t</tr>\n";
			
			$FlipFlag = 1;
		}
	}  // end of while
}
else
{
	$DisplayBlock = "\t<tr>\n\t <td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>\n";
	$DisplayBlock .= "\t\t<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>\n ";
	$DisplayBlock .= "\t\t<td width=\"35%\" align=left height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>\n ";
	$DisplayBlock .= "\t\t<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOff\">No Vaccinations</td>\n\t</tr>";
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
