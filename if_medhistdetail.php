<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_medhistdetail.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

//----------------------------------------------------------------------------------------------------------
// We must have gotten here via medhistlist so we need to make sure get is set
//----------------------------------------------------------------------------------------------------------
if (isset($_GET[eventid])  && ($_GET[eventid] != ""))
{
	$DisplayEventID = $_GET[eventid];
	
	//----------------------------------------------------------------------------------------------------------
	// create the SQL statement to get our prescription, date, provider and pharmacy information for the row 
	// selected from if_presclist
	//----------------------------------------------------------------------------------------------------------
	$sql = "SELECT FirstName, LastName, Suffix, StartDate, StartTime, Event, ICD9Text, 
					ProviderID, HostID, EventType, Name, URL, ClientEventTBL.ID as EventID 
					from ClientEventTBL 
						left join CalendarTBL on ClientEventTBL.CalendarID = CalendarTBL.ID
						left join EventTypeTBL on ClientEventTBL.EventTypeID = EventTypeTBL.ID
						left join ProviderTBL on ClientEventTBL.ProviderID = ProviderTBL.ID
						left join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID
						left join HostTBL on ClientEventTBL.HostID = HostTBL.ID
						left join ClientDiagnosisTBL on ClientDiagnosisTBL.ID = ClientEventTBL.DiagnosisID
							where (ClientEventTBL.ID = '$_GET[eventid]' and ClientEventTBL.CurrentStatus = '1')";
					
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query for ClientEventTBL and large join \n sql = '$sql'\n (195) - '$Medpal'";
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
		$errmsg = " Error No rows or more then 1 row returned in select on ClientEventTBL. count = '$countRows'  - '$Medpal'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
	
	//----------------------------------------------------------------------------------------------------------
	// now lets fetch our prescription information
	//----------------------------------------------------------------------------------------------------------
	$result_array = mysql_fetch_assoc($sql_result);
	
	//----------------------------------------------------------------------------------------------------------
	// Format the date for display
	//----------------------------------------------------------------------------------------------------------
	$DisplayDate = CovertMySQLDate($result_array["StartDate"], 1, 1);
	$DisplayTime = CovertMySQLTime($result_array["StartTime"], 1, 1);
	
	//----------------------------------------------------------------------------------------------------------
	// Build Name
	//----------------------------------------------------------------------------------------------------------
	$DisplayName = $result_array[LastName];
	if ($result_array[Suffix] != "")
	{
		$DisplayName .= " ".$result_array[Suffix];
	}
	
	$DisplayName .= ", ".$result_array[FirstName]." ".$result_array[MI];	
	
	$DisplayBlock = "
		<table width=\"100%\" class=\"outerBorderTitleBlueLetterSpace\">	
			<tr>
				<td class=\"smallText2\" align=center><b>Medical History Summary</b></td>
			</tr>	
		</table>
		<table width=\"100%\" class=\"tblDetailsmTextOff\">	
			<tr>
				<td align=right>Date:</td>
				<td height=25 align=left><b>".$DisplayDate."</b></td> 
				
				<td align=right>Time:</td>
				<td height=25 align=left><b>".$DisplayTime."</b></td> 
			</tr> 
			<tr>
				<td align=right>Type:</td>
				<td height=25 align=left colspan=2><b>".$result_array[EventType]."</b></td> 
			</tr> 
			<tr>
				<td align=right>Provider</td>
					<td height=25 align=left>
						<b><a href=\"#\" onClick=\"(PopUpWindow('pudoctor.php?ProviderID=".$result_array[ProviderID]."&HostID=".$result_array[HostID]."', 'r', 4))\" class=\"tblDetailsmTextLinkOff\">
							".$DisplayName."
						</a></b> 
					</td>
				<td align=right>Location:</td>
				<td  height=25 align=left>
					<b><a href=\"#\" onClick=\"(PopUpWindow('".$result_array[URL]."', 'f', 2))\" class=\"tblDetailsmTextLinkOff\">
						".$result_array[Name]."
					</a></b>
				</td>
			</tr> 
			
			<tr>
				<td align=right>Description:</td>
				<td height=25 align=left colspan=2><b>".$result_array[Event]."</b></td> 
			</tr> 
			
			<tr>
				<td align=right>Diagnosis:</td>
				<td height=25 align=left colspan=2><b>".$result_array[ICD9Text]."</b></td> 
			</tr> 
		</table>

	";	

}	
else
{
	$DisplayBlock = "
		<table width=\"100%\" class=\"outerBorderTitleBlueLetterSpace\">	
			<tr>
				<td class=\"smallText2\" align=center><b>Medical History Summary</b></td>
			</tr>	
		</table>
	";
}	
	
$readonly = "class =\"readonlyText\" readonly";

$readonlyURL = "class =\"readonlyURLText\" readonly";
	
?>
<html>
<style type="text/css">

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
	
.linkTitletype {
		color: white;
		font: 700 13px Arial,Helvetica;
		text-align: center;
		text-decoration: none;
		}			

.linkTitletype:hover {
		color: yellow;
		font: 700 13px Arial,Helvetica;
		text-align: center;
		text-decoration: underline;
		}
		
.thumblinkTitletype {
		color: yellow;
		font: 500 11px Arial,Helvetica;
		text-align: center;
		text-decoration: none;
		border-top:1px solid yellow;
		border-left:1px solid yellow;
		border-right:1px solid yellow;
		border-bottom:1px solid yellow;
		}			

.thumblinkTitletype:hover {
		color: black;
		font: 500 11px Arial,Helvetica;
		text-align: center;
		text-decoration: none;
		background: white;
		}		
		
.historyDetail {
		position: absolute;
		left:0px;
		top:0px; 
		width:685px;
		height:165px;
		background: white;
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		}

.innerScanlistframeTitle   { 
		position: absolute;
		left:0px; 
		top:195px;
		width:684px;
		height:50px;
		color: white;
		font: 700 15px Arial, Geneva;
		background: blue;
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black
		}	

		
.innerScanlistframeTableTitle   { 
		color: white;
		font: 700 15px Arial, Geneva;
		background: blue;
		}
		
.innerScanlistframe	{
		position: absolute;
		left:0px; 
		top:245px;
		width:683px;
		height:250px;
		background: white;
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		}

		
.outerBorderSMtxt {
		font: 400 10px Verdana, Arial, Helvetica;
		border-top:0px solid #008080;
		border-left:1px solid #008080;
		border-right:1px solid #008080;
		border-bottom:1px solid #008080;
		background: white;
		}

</style>
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

<body <? print $BodySelectColor; ?> onload="startUp()">

<div class="historyDetail">

<? print $DisplayBlock; ?>

</div>

<div class="innerScanlistframeTitle">
<table width="100%" class="innerScanlistframeTableTitle" cellspacing=0>
	<tr>
		<td width="25%" align=center height=20>&nbsp;</td>
		<td width="50%" align=center colspan=2>Scanned Documents</td>
		<td width="25%" align=center height=20>
			<a href="if_medhistscanlist.php?eventid=<? print $DisplayEventID ?>&thumbnail=toggle"  class="thumblinkTitletype" target="scanFramelist">Toggle Thumb nails
			</a>
		</td>
	</tr>	
	<tr>
		<td width="25%" align="center" height="20">
			<a href="if_medhistscanlist.php?eventid=<? print $DisplayEventID ?>&order=type"  class="linkTitletype" target="scanFramelist">Type
			</a>
		</td>
		<td width="25%" align="center">
			<a href="if_medhistscanlist.php?eventid=<? print $DisplayEventID ?>&order=def"  class="linkTitletype" target="scanFramelist">Define
			</a>
		</td>
		<td width="35%" align="center">
			<a href="if_medhistscanlist.php?eventid=<? print $DisplayEventID ?>&order=desc"  class="linkTitletype" target="scanFramelist">Description
			</a>
		</td>
		<td width="15%" align="center">Image</td>
	</tr>	
</table>
</div>
<iframe name="scanFramelist" src="if_medhistscanlist.php?eventid=<? print $DisplayEventID ?>" scrolling=auto frameborder=0 class="innerScanlistframe"> </iframe>

</body>
</html>
