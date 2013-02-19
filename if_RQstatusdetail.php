<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_RQstatusdetail.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

//----------------------------------------------------------------------------------------------------------
// If we have information display it otherwise error
//----------------------------------------------------------------------------------------------------------
if (! (isset($_GET[requestid]) and ($_GET[requestid] != "")) )
{
	$errmsg = "GET variable not set.  Get = '$_GET[requestid]' (194) - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

//----------------------------------------------------------------------------------------------------------
// create the SQL statement to get our request detail information,
//----------------------------------------------------------------------------------------------------------

$sql = "SELECT distinct FirstName, LastName, Suffix, StartDate, StartTime, Name, EventType, Comments,
						ClientRequestTBL.ID as crID, RequestDateTime, Request, Description
					from ClientEventTBL 
						left join ClientRequestTBL on ClientRequestTBL.ClientEventID = ClientEventTBL.ID
						left join RequestStatusTBL on  ClientRequestTBL.CurrentStatus = RequestStatusTBL.ID
						left join CalendarTBL on ClientEventTBL.CalendarID = CalendarTBL.ID
						left join EventTypeTBL on ClientEventTBL.EventTypeID = EventTypeTBL.ID
						left join HostTBL on ClientEventTBL.HostID = HostTBL.ID
						left join ProviderTBL on ClientEventTBL.ProviderID = ProviderTBL.ID
						left join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID
							where ( ClientRequestTBL.MEDPAL = '$Medpal' and ClientRequestTBL.ID = '$_GET[requestid]'
							and ClientEventTBL.CurrentStatus = '0') ";
		
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ClientRequestTBL and join RequestStatusTBL EventTypeTBL\n sql = '$sql'\n (195) - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}
	
//----------------------------------------------------------------------------------------------------------	
// Now lets first see if there is anything to run through.  If more or less then 1 we have an error
//----------------------------------------------------------------------------------------------------------
$countRows = mysql_num_rows($sql_result);
if ($countRows != 1)
{
	$errmsg = " Error No rows or more then 1 row returned in select on ClientRequestTBL. count = '$countRows'  - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

//----------------------------------------------------------------------------------------------------------
// now lets fetch our request information
//----------------------------------------------------------------------------------------------------------
$result_array = mysql_fetch_assoc($sql_result);

//----------------------------------------------------------------------------------------------------------
// Format the date for display
//----------------------------------------------------------------------------------------------------------

// First Service date
$DisplayServiceDate = CovertMySQLDate($result_array["StartDate"], 1, 1);

// Second Service time
$DisplayServiceTime = CovertMySQLTime($result_array["StartTime"], 1, 2);

// Third request date
$DispalyRequestDate =  CovertMySQLDate($result_array["RequestDateTime"], 2, 1);

// Third request time
$DisplayRequestTime = CovertMySQLTime($result_array["RequestDateTime"], 2, 2);
?>
<html>

<head>
<title>HealthYourSelf Customer Request Status</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />
<style type="text/css">
.outerBorderMessageTitleBlue {
		color: white;
		font: 700 13px Arial,Helvetica;
		text-align: center;
		letter-spacing: 8px;
		border-top:1px solid #052faf;
		border-left:1px solid #052faf;
		border-right:1px solid #052faf;
		border-bottom:1px solid #052faf;
		background: #052faf;
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
<table align=left width="90%" class="tblDetailsmTextOff">
	<tr>
		<td align=right height=25 >Status:&nbsp;</td>
		<td align=left><b><? print  $result_array[Description]; ?></b></td> 
	</tr>
 	
	<tr >
  		<td align=right height=25 >Request Date:&nbsp;</td>
		<td align=left><b><? print $DispalyRequestDate; ?></b></td> 
		
		<td align=right height=25 >Request Time:&nbsp;</td>
		<td align=left><b><? print $DisplayRequestTime; ?></b></td> 
	</tr> 

	<tr >
  		<td align=right height=25 >Service Date:&nbsp;</td>
		<td align=left><b><? print $DisplayServiceDate; ?></b></td>
		
		<td align=right height=25 >Service Time:&nbsp;
		<td align=left><b><? print $DisplayServiceTime; ?></b></td> 
	</tr> 
	
	<tr >
		<td align=right height=25 >Type:&nbsp;</td>
		<td align=left><b><? print $result_array[EventType]; ?></b></td>
		
		<td align=right height=25 >Provider:&nbsp;
		<td align=left><b><? print $result_array[FirstName]." ".$result_array[LastName]." ".$result_array[Suffix]; ?></b></td>
		
	</tr> 

	<tr >
		<td align=right height=25 >Location:&nbsp;</td>
		<td align=left colspan=5><b><? print $result_array[Name]; ?></b></td>
	</tr> 

	<tr >
		<td align=right height=25 >Description:&nbsp;</td>
		<td align=left colspan=5><b><? print $result_array[Request]; ?></b></td> 
	</tr>
	
	<tr >
		<td align=right height=25 >Service Comments:&nbsp;</td>
		<td align=left colspan=5><b><? print $result_array[Comments]; ?></b></td> 
	</tr>
</table>
</div>
</body>
</html>
