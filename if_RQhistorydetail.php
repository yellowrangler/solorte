<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_RQhistorydetail.php';

require ('hysInit.php');

require ('hysDBinit.php');

//----------------------------------------------------------------------------------------------------------
// If we have information display it otherwise error
//----------------------------------------------------------------------------------------------------------
if (! (isset($_GET[requestid]) and ($_GET[requestid] != "")) )
{
	$errmsg = "GET variable not set.  Get = '$_GET[requestid]' (294) - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

//----------------------------------------------------------------------------------------------------------
// Set up reqestid variable
//----------------------------------------------------------------------------------------------------------
$DisplayRequestID = $_GET[requestid];

//----------------------------------------------------------------------------------------------------------
// initialize request status array
//----------------------------------------------------------------------------------------------------------
$RequestStatusArray = array("Not Used","N","N","N","N","N","N","N","N","N","N","N","N");
$RequestStatusArrayNbr = 12;
$HighestStatus = "0";

//----------------------------------------------------------------------------------------------------------
// create the SQL statement to get our request detail information,
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT  * from  ClientRequestHistoryTBL 
			where ( ClientRequestHistoryTBL.RequestID = '$_GET[requestid]')
			ORDER BY ClientRequestHistoryTBL.RequestHistDateTime ASC";
			
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ClientRequestHistoryTBL  \n sql = '$sql'\n (195) - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}
	
//----------------------------------------------------------------------------------------------------------	
// Now lets first see if there is anything to run through.  If more or less then 1 we have an error
//----------------------------------------------------------------------------------------------------------
$countRows = mysql_num_rows($sql_result);
if ($countRows == 0)
{
	$errmsg = " Error No rows returned in select on ClientRequestHistoryTBL. count = '$countRows'  - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

//----------------------------------------------------------------------------------------------------------
// now lets fetch our request information
//----------------------------------------------------------------------------------------------------------
while ($result_array = mysql_fetch_assoc($sql_result))
{
	if ($result_array[RequestStatus] < $HighestStatus)
	{
		$FinalStatus = $result_array[RequestStatus];
	}
	else
	{
		$FinalStatus = $result_array[RequestStatus];
		$HighestStatus = $result_array[RequestStatus];
	}
	
} // End of While

// Make all status's up to final ststus as green and all Problems marked with an X
for ($idx = 1; $idx < $FinalStatus + 1; $idx++)
{
	$RequestStatusArray[$idx] = "Y";
}

If ($FinalStatus < $HighestStatus)
{
	for ($idx = $FinalStatus + 1; $idx < $HighestStatus + 1; $idx++)
	{
		$RequestStatusArray[$idx] = "W";
	}
}	

//----------------------------------------------------------------------------------------------------------
// create the SQL statement to get our list of statuses,
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT  * from RequestStatusTBL 
			ORDER BY ID";
			
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for RequestStatusTBL \n sql = '$sql'\n (295) - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

$DisplayBlock = "";
//----------------------------------------------------------------------------------------------------------
// now lets fetch our request information
//----------------------------------------------------------------------------------------------------------
while ($result_array = mysql_fetch_assoc($sql_result))
{

	$DisplayBlock .= "\t<tr>\n";
	
	$tmpID = $result_array[ID];
	switch ($RequestStatusArray[$tmpID])
	{
		case 'Y':
			$DisplayBlock .= "\t\t<td width=25 align=center height=17 class=\"tblDetailsmTextOff\"><img id=\"done\" height=20 width=20 border=\"0\" src=\"images/done.gif\"></td>\n";
			break;
	
		case 'N':
			$DisplayBlock .= "\t\t<td width=25 align=center height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>\n";
			break;
	
		case 'W':
			$DisplayBlock .= "\t\t<td width=25 align=center height=17 class=\"tblDetailsmTextOff\"><img id=\"warning\" height=20 width=20 border=\"0\" src=\"images/notdone.gif\"></td>\n";
			break;
	}  // End of Switch
	
	$DisplayBlock .= "\t\t<td width=5 align=left height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>\n";
	$DisplayBlock .= "\t\t<td align=left height=17 class=\"tblDetailsmTextOff\">".$result_array[Description]."</td>\n";
	
	$DisplayBlock .= "\t</tr>\n";

} // End of While

?>
<html>
<style type="text/css"> 

.SmTxt   { 
		font: 400 13px Arial, Geneva;
		}			

.outerBorderTitleBlue {
		color: white;
		font: 700 13px Arial,Helvetica;
		text-align: center;
		border-top:1px solid #052faf;
		border-left:1px solid #052faf;
		border-right:1px solid #052faf;
		border-bottom:1px solid #052faf;
		background: #052faf;
		}				
		
.detailLeft {
		position: absolute;
		left:0px;
		top:45px; 
		width:250px;
		height:325px;
		background: white;
		border:1px solid black;
		}
		
.tableTitlepos {
		position: absolute;
		left:275px;
		top:45px; 
		width:367px;
		height:20px;
		}		
		
.innerListSelectframe {
		position: absolute;
		left:275px;
		top:65px;
		width:365px;
		height:225px;
		background: white;
		border:1px solid black;
		}
</style>		
<head>
<title>HealthYourSelf Customer Request Status</title>
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

<body <? print $BodySelectColor ?> onload="startUp()">

<div class="detailLeft">
<table width="100%" class="outerBorderTitleBlue">
	<tr>
		<td align="center" height="10">Request Steps</td>
	</tr>	
</table>
<table width="100%">
	<tr>
		<? print $DisplayBlock; ?>
	</tr>	
</table>

</div>

<div class="tableTitlepos">
<table width="100%" class="outerBorderTitleBlue">
	<tr>
		<td width="15%" align="center" height="10">ID</td>
		<td width="15%" align="center" height="10">Date</td>
		<td width="20%" align="center" height="10">Time</td>
		<td width="50%" align="center" height="10">Status</td>
	</tr>	
</table>
</div>

<IFRAME name="innerlistFrame" src="if_RQhistorydetaillog.php?requestid=<? print $DisplayRequestID; ?>" class="innerListSelectframe" scrolling=auto frameborder=0> </IFRAME>
</body>
</html>
