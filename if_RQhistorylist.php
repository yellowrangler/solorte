<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_RQhistorylist.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

//----------------------------------------------------------------------------------------------------------
// Build the sql
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT distinct FirstName, LastName, Suffix, StartDate, ClientRequestTBL.ID as crID, Request, Description
					from ClientEventTBL 
						left join ClientRequestTBL on ClientRequestTBL.ClientEventID = ClientEventTBL.ID
						left join RequestStatusTBL on  ClientRequestTBL.CurrentStatus = RequestStatusTBL.ID
						left join CalendarTBL on ClientEventTBL.CalendarID = CalendarTBL.ID
						left join EventTypeTBL on ClientEventTBL.EventTypeID = EventTypeTBL.ID
						left join ProviderTBL on ClientEventTBL.ProviderID = ProviderTBL.ID
						left join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID
							where ( ClientRequestTBL.MEDPAL = '$Medpal' and ClientEventTBL.CurrentStatus = '0') ";
			
//------------------------------------------------------------------------------------------------------
// are we a GET
//------------------------------------------------------------------------------------------------------
if (isset($_GET[order]))
{
	//--------------------------------------------------------------------------------------------------
	// We ARE a get
	//
	// First lets see if our sort cookie is set.  If not lets set it up (WE will be using cookies
	// via the php session service.  Another chance for us to learn.
	//--------------------------------------------------------------------------------------------------
	if (empty($_SESSION[MHid]))
	{
		//	echo "WE are empty session\n";
		//----------------------------------------------------------------------------------------------
		// Ok nothing here to see folks.  But honestly - we need to set our variables for first time
		//----------------------------------------------------------------------------------------------
		$_SESSION[MHid] = "ASC";
		$_SESSION[MHstatus] = "ASC";
		$_SESSION[MHsdate] = "DESC";
		$_SESSION[MHrequest] = "ASC";
		$_SESSION[MHprovider] = "ASC";
	}
			
	//--------------------------------------------------------------------------------------------------
	// Now that the session Variables are set it is time to build our sql based on what was passed
	//--------------------------------------------------------------------------------------------------
	switch ($_GET[order])
	{
		case 'id':
			$sql .= " ORDER BY ClientRequestTBL.ID ".$_SESSION[MHid];
			if ($_SESSION[MHid] == "ASC")
				$_SESSION[MHid] = "DESC";
			else
				$_SESSION[MHid] = "ASC";
			break;
			
		case 'status':
			$sql .= " ORDER BY ClientRequestTBL.CurrentStatus ".$_SESSION[MHstatus];
			if ($_SESSION[MHstatus] == "ASC")
				$_SESSION[MHstatus] = "DESC";
			else
				$_SESSION[MHstatus] = "ASC";
			break;	
		
		case 'sdate':
			$sql .= " ORDER BY CalendarTBL.StartDate ".$_SESSION[MHsdate];
			if ($_SESSION[MHsdate] == "ASC")
				$_SESSION[MHsdate] = "DESC";
			else
				$_SESSION[MHsdate] = "ASC";
			break;
			
		case 'request':
			$sql .= " ORDER BY ClientRequestTBL.Request ".$_SESSION[MHrequest];
			if ($_SESSION[MHrequest] == "ASC")
				$_SESSION[MHrequest] = "DESC";
			else
				$_SESSION[MHrequest] = "ASC";
			break;
			
		case 'provider':
			$sql .= " ORDER BY FullNameTBL.LastName ".$_SESSION[MHprovider];
			if ($_SESSION[MHprovider] == "ASC")
				$_SESSION[MHprovider] = "DESC";
			else
				$_SESSION[MHprovider] = "ASC";
			break;	
			
		}  // End of Switch
}  // End of if GET
else
{
	// echo "WE are default\n";
	//----------------------------------------------------------------------------------------------
	// first time thru so default to desc sort of all info
	//----------------------------------------------------------------------------------------------
	
	$sql .= " ORDER BY ClientRequestTBL.ID ASC";
}  // End of Else

//------------------------------------------------------------------------------------------------------
// now lets run the sql that was built
//------------------------------------------------------------------------------------------------------
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ClientRequestTBL (195) sql = '$sql' - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//------------------------------------------------------------------------------------------------------
// Now lets first see if there is anything to run through
//------------------------------------------------------------------------------------------------------
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
		//----------------------------------------------------------------------------------------------------------
		// get start date in readable format
		//----------------------------------------------------------------------------------------------------------
		$showDate = CovertMySQLDate($result_arr["StartDate"], 1, 1);
		$DisplayProvider = $result_arr[FirstName]." ".$result_arr[LastName]." ".$result_arr[Suffix];
			
		if ($FlipFlag == 1)
		{
			$DisplayBlock .= "\t<tr>\n\t\t<td width=\"5%\" align=center height=17 class=\"tblDetailsmTextOff\">";
			$DisplayBlock .= "<a href=\"if_RQhistorydetail.php?requestid=".$result_arr[crID]."\" target=\"detailFrame\"><img id=\"moredetail\" height=20 width=20 border=\"0\" src=\"images/binoculars.gif\"></a></td>\n";
			$DisplayBlock .= "\t\t<td width=\"5%\" align=center height=17 class=\"tblDetailsmTextOff\">".$result_arr[crID]."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"30%\" align=left height=17 class=\"tblDetailsmTextOff\">".$result_arr[Description]."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOff\">".$showDate."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOff\">".$result_arr[Request]."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"20%\" align=left height=17 class=\"tblDetailsmTextOff\">".substr($DisplayProvider, 0, 15)."</td>\n\t</tr>\n";
	
			$FlipFlag = 0;
		}
		else
		{
			$DisplayBlock .= "\t<tr>\n\t\t<td width=\"5%\" align=center height=17 class=\"tblDetailsmTextOn\">";
			$DisplayBlock .= "<a href=\"if_RQhistorydetail.php?requestid=".$result_arr[crID]."\" target=\"detailFrame\"><img id=\"moredetail\" height=20 width=20 border=\"0\" src=\"images/binocularsOn.gif\"></a></td>\n";
			$DisplayBlock .= "\t\t<td width=\"5%\" align=center height=17 class=\"tblDetailsmTextOn\">".$result_arr[crID]."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"30%\" align=left height=17 class=\"tblDetailsmTextOn\">".$result_arr[Description]."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOn\">".$showDate."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOn\">".$result_arr[Request]."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"20%\" align=left height=17 class=\"tblDetailsmTextOn\">".substr($DisplayProvider, 0, 15)."</td>\n\t</tr>\n";
			
			$FlipFlag = 1;
		}
	}  // end of while
}
else
{
	$DisplayBlock .= "\t<tr>\n\t\t<td width=\"5%\" align=center height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>\n";
	$DisplayBlock .= "\t\t <td width=\"5%\" align=left height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>\n";
	$DisplayBlock .= "\t\t<td width=\"30%\" align=left height=17 class=\"tblDetailsmTextOff\">No History</td>\n";
	$DisplayBlock .= "\t\t<td width=\"15%\" align=left height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>\n";
	$DisplayBlock .= "\t\t<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>\n";
	$DisplayBlock .= "\t\t<td width=\"20%\" align=left height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>\n\t</tr>\n";
}

?>
<html>
<head>
<title>HealthYourSelf request history list</title>
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

<center>
<table width="100%" cellspacing=0 cellpadding=0 border=0>
		<? print $DisplayBlock; ?>
</table>

</center>

</div>
</body>
</html>
