<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_clienthostinfo.php';

require ('hysInitAdminClient.php');

require ('hysDBinit.php');

require ('hysStatusMsg.php');

//----------------------------------------------------------------------------------------------------------
//  we need to see if we have been passed a HostID
//----------------------------------------------------------------------------------------------------------
$displayTitle = "Host Detail";
$ClientID = $Medpal;

if (isset($_GET[hostid]) && ($_GET[hostid] != "") )
{
	//Get host id and set flag to is update
	$HostID = $_GET[hostid];
	$ButtonHidden = "";
	
	//----------------------------------------------------------------------------------------------------------
	// create the SQL statement
	//----------------------------------------------------------------------------------------------------------
	$sql = "SELECT distinct HostTBL.ID as hostID, 
		Name, HostTypeTBL.Description as HostTypeDesc,
		AddrLine1, AddrLine2, City, State
		from HostTBL 
		left join HostTypeTBL on HostTBL.TypeID = HostTypeTBL.ID
		left join AddrTBL on HostTBL.AddrID = AddrTBL.ID
			where (HostTBL.ID = '$HostID')"; 
		
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query join for HostTBL, HostTypeTBL and AddrTBL (195) sql = '$sql'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
		
	// Now lets first see if there is anything to run through.  If more then 1 we have an error
	$countRows = mysql_num_rows($sql_result);
	if ($countRows > 1)
	{
		$errmsg = " Error more then 1 rows returned in select on HostTBL. count = '$countRows'  - HostID =  '$HostID'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
	
	//----------------------------------------------------------------------------------------------------------
	// Get the data
	//----------------------------------------------------------------------------------------------------------
	$result_array = mysql_fetch_assoc($sql_result);
}
else
{
	//----------------------------------------------------------------------------------------------------------
	// Build empty screen - This is an add
	//----------------------------------------------------------------------------------------------------------
	$ButtonHidden = "type=\"hidden\"";
	
	$DisplayName = "";
}	
	
?>
<html>

<head>
<title>HealthYourSelf Customer Intro</title>

<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css"> 

.outerBorderTitleGreenLetterSpace {
		color: white;
		font: 700 13px Arial,Helvetica;
		text-align: center;
		letter-spacing: 8px;
		border-top:0px solid #006633;
		border-left:1px solid #006633;
		border-right:1px solid #006633;
		border-bottom:0px solid #006633;
		background: #006633;
		}

.hostdetailBody {
		position: absolute;
		left:20px;
		top:38px; 
		width:422px;
		height:300px;
		background-color: white;
		border:1px solid black;
		}
			
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
		
.SmTxt   { 
		font: 400 13px Arial, Geneva;
		}			
						
.tableTextName {
		font: 400 13px Arial, Geneva;
		line-height: 15px; 
		border-top:0px solid black;
		border-right:0px solid black;
		border-left:0px solid black;
		border-bottom:0px solid black;
		background: white;
		}
		
.tableHdrRow {
		font: 400 13px Arial, Geneva;
		line-height: 15px; 
		border-top:0px solid black;
		border-right:0px solid black;
		border-left:0px solid black;
		border-bottom:0px solid black;
		color:black;
		background: #99FFCC;
		}	
		
.remordertitleClientHostList {
		position: absolute;
		left:20px;
		top:370px;
		width:422px;
		height:272px;
		background: white;
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		}

.innerremorderClientHostList {
		position: absolute;
		left:0px;
		top:20px;
		width:420px;
		height:250px;
		background: white;
		border-top:0px solid black;
		border-left:0px solid black;
		border-right:0px solid black;
		border-bottom:0px solid black;
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

<body <? print $BodySelectColor ?> onload="startUp()">

<div class="hostdetailBody">
<form  action="clienthost.php" target="clienthostmainFrame" method=post>
<table width="100%" class="outerBorderMessageTitleBlue">
	<tr>
		 <td height=20 align="center"><? print $displayTitle; ?></td>
	</tr>	
</table>

<table width="100%" class="SmTxt">
	<tr>
		<td align=right colspan=4 height=15>&nbsp;</td>
	</tr>
	<tr>
		<td align=right height=35>Host Name:</td>
		<td align=left><input class ="readonlyText" readonly size=35 maxlength=35 type="text" name="hostname" value="<? print $result_array[Name]; ?>"></td>
	</tr>
	<tr>
		<td align=right>Host Type:</td>
		<td align=left><input class ="readonlyText" readonly size=25 maxlength=25 type="text" name="specialtytype" value="<? print $result_array[HostTypeDesc]; ?>"></td>
	</tr>
	<tr>
		<td align=right>Address:</td>
		<td align=left><input class ="readonlyText" readonly size=40 maxlength=40 type="text" name="address" value="<? print $result_array[AddrLine1]; ?>"></td>
	</tr>
	<tr>		
		<td align=right>City:</td>
		<td align=left><input class ="readonlyText" readonly size=15 maxlength=15 type="text" name="city" value="<? print $result_array[City]; ?>"></td>
	</tr>
	<tr>		
		<td align=right>State:</td>
		<td align=left><input class ="readonlyText" readonly size=2 maxlength=2 type="text" name="city" value="<? print $result_array[State]; ?>"></td>
	</tr>
</table>
<input type="hidden" name="hostid" value="<? print $result_array[hostID]; ?>">	
<input type="hidden" name="clientid" value="<? print $ClientID; ?>">	
<input type="hidden" name="Action" value="add">	
<br><center>
<table>
	<tr>
		<td align=center><input <? print $ButtonHidden; ?> type=submit size=150 NAME="SUBMIT" VALUE="Add"></td>
	</tr>
</table>	
</center>	
</form>
</div>

<div class="remordertitleClientHostList">
<table width="100%" height=20 class="outerBorderTitleGreenLetterSpace">
	<tr>
		<td align="center"><b>Remove</b></td>
	</tr>	
</table>

<IFRAME name="remorderClientHostFrame" src="if_clienthostremorder.php?clientid=<? print $ClientID; ?>"  target="clienthostmainFrame" class="innerremorderClientHostList" scrolling="yes"></IFRAME>
</div>
</body>
</html>
