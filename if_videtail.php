<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_videtail.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

//----------------------------------------------------------------------------------------------------------
// we are either being called by default  OR someone has clicked on list
//----------------------------------------------------------------------------------------------------------
if ( isset($_GET[viid]) and ($_GET[viid] != "") )
{
	
	// create the SQL statement to get our information 
		$sql = "SELECT FirstName, LastName, Suffix, ClientVaccInocTBL.ProviderID as ProvID, 
			VaccInocType, CalendarID, Medication, ClientVaccInocTBL.ID as VaccInocID,
			StartDate, StartTime, EndDate, EndTime, Duration, AppType
			from ClientVaccInocTBL
			left join ProviderTBL on ClientVaccInocTBL.ProviderID = ProviderTBL.ID	
			left join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID
			left join CalendarTBL on ClientVaccInocTBL.CalendarID = CalendarTBL.ID
			left join VaccInocTypeTBL on ClientVaccInocTBL.VaccInocTypeID = VaccInocTypeTBL.ID
			where (ClientVaccInocTBL.MEDPAL = '$Medpal' and ClientVaccInocTBL.ID = '$_GET[viid]')";
			
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
	if ($countRows != 1)
	{
		$errmsg = " Error No rows or more then 1 row returned in select on ClientVaccInocTBL. count = '$countRows'  - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
		
	// fetch the results
	$result_arr = mysql_fetch_assoc($sql_result);
	
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
	$DisplayBlock = "
		<tr>
			<td colspan=2 class=\"headerBorderGold\">Vaccination and Immunization Information</td> 
		</tr>
		<tr>
			<td  height=30 colspan=2 align=left>Vaccination:&nbsp;<b>".$DisplayVaccInoc."</b></td>
		</tr>
		<tr>
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
<title>HealthYourSelf Customer Vaccination Detail</title>
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
