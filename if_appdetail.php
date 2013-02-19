<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_appdetail.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

//----------------------------------------------------------------------------------------------------------
// we are either being called by default  OR someone has clicked on list
//----------------------------------------------------------------------------------------------------------
if ( isset($_GET[appid]) and ($_GET[appid] != "") )
{
	
	// create the SQL statement to get our information 
	$sql = "SELECT * from ClientAppointmentTBL 
			left join CalendarTBL on ClientAppointmentTBL.CalendarID = CalendarTBL.ID
			left join EventTypeTBL on ClientAppointmentTBL.EventTypeID = EventTypeTBL.ID
			left join ProviderTBL on ClientAppointmentTBL.ProviderID = ProviderTBL.ID
			left join HostTBL on ClientAppointmentTBL.HostID = HostTBL.ID
			left join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID
			where (ClientAppointmentTBL.MEDPAL = '$Medpal' and ClientAppointmentTBL.ID = '$_GET[appid]')";
			
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
	if ($countRows != 1)
	{
		$errmsg = " Error No rows or more then 1 row returned in select on ClientAppointmentTBL. count = '$countRows'  - '$Medpal'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
		
	// fetch the results
	$result_arr = mysql_fetch_assoc($sql_result);
	
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
	$DisplayBlock = "
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
<title>HealthYourSelf Customer Appointment Detail</title>
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
