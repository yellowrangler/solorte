<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_UAmedhistdetaillist.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

//----------------------------------------------------------------------------------------------------------
// We are quite complicated.  We either are being built for the first time in which case  we build a list
// in descending date order.  If however we have been activated by a POST via the search then we need 
// to fashion a query to get the get description info that matches. On the otherhand we might have been 
// activated by a column click whic comes to us as a GET.  If thi sis true then we need to see if a sort
//  cookie has been created - if it has we toggle the value and do a reverse sort so that next time for 
// that column we reverse again and so on..  If thete is no cookie we make one and sort ascending.
//
// Regardless our sql always starts out as follows
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT distinct FirstName, LastName, Suffix, StartDate, Event, 
				ClientEventTBL.ProviderID, ClientEventTBL.HostID, EventTypeTBL.EventType, 
				ClientEventTBL.ID as EventID 
					from ClientEventTBL 
						left join CalendarTBL on ClientEventTBL.CalendarID = CalendarTBL.ID
						left join EventTypeTBL on ClientEventTBL.EventTypeID = EventTypeTBL.ID
						left join ClientProviderTBL on ClientEventTBL.MEDPAL = ClientProviderTBL.MEDPAL
						left join ProviderTBL on ClientEventTBL.ProviderID = ProviderTBL.ID
						left join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID
							where ( ClientProviderTBL.MEDPAL = '$Medpal' and ClientEventTBL.CurrentStatus = '1'";
					
//----------------------------------------------------------------------------------------------------------
// are we a POST
//----------------------------------------------------------------------------------------------------------
if ( isset($_POST[selType]) )
{
	// echo "WE are post\n";
	//------------------------------------------------------------------------------------------------------
	// We ARE a post.  There is only one POST type for now - but we still make sure who (Futire enhancement)
	//------------------------------------------------------------------------------------------------------
	if ($_POST[selType] == 'search')
	{
		//--------------------------------------------------------------------------------------------------
		// now adjust for search request
		//--------------------------------------------------------------------------------------------------
		if ($_POST[Search] != "")
		{
			$sql .= " AND ClientEventTBL.Event LIKE '%$_POST[Search]%'";
		}
		
		//--------------------------------------------------------------------------------------------------
		// close the where clause
		//--------------------------------------------------------------------------------------------------
		$sql .= ")";
		
		//--------------------------------------------------------------------------------------------------
		// now build the sort
		//--------------------------------------------------------------------------------------------------
		$sql .= " ORDER BY CalendarTBL.StartDate ASC";
		
		// echo "sql=".$sql."\n";
	}
	else
	{
		// error
		$errmsg = "Error - selType invalid selType = '$_POST[selType]'  - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
}
else 
{
	//------------------------------------------------------------------------------------------------------
	// are we a GET
	//------------------------------------------------------------------------------------------------------
	if (isset($_GET[order]))
	{
		// echo "WE are get\n";
		
		//--------------------------------------------------------------------------------------------------
		// We ARE a get
		//
		// First lets see if our sort cookie is set.  If not lets set it up (WE will be using cookies
		// via the php session service.  Another chance for us to learn.
		//--------------------------------------------------------------------------------------------------
		if (empty($_SESSION[MHType]))
		{
			//	echo "WE are empty session\n";
			//----------------------------------------------------------------------------------------------
			// Ok nothing here to see folks.  But honestly - we need to set our variables for first time
			//----------------------------------------------------------------------------------------------
			$_SESSION[MHType] = "ASC";
			$_SESSION[MHDate] = "DESC";
			$_SESSION[MHDesc] = "ASC";
			$_SESSION[MHProv] = "ASC";
		}
				
		//--------------------------------------------------------------------------------------------------
		// close the where clause
		//--------------------------------------------------------------------------------------------------
		$sql .= ")";
		
		//--------------------------------------------------------------------------------------------------
		// Now that the session Variables are set it is time to build our sql based on what was passed
		//--------------------------------------------------------------------------------------------------
		switch ($_GET[order])
		{
			case 'type':
				$sql .= " ORDER BY EventTypeTBL.EventType ".$_SESSION[MHType];
				if ($_SESSION[MHType] == "ASC")
					$_SESSION[MHType] = "DESC";
				else
					$_SESSION[MHType] = "ASC";
				break;
				
			case 'date':
				$sql .= " ORDER BY CalendarTBL.StartDate ".$_SESSION[MHDate];
				if ($_SESSION[MHDate] == "ASC")
					$_SESSION[MHDate] = "DESC";
				else
					$_SESSION[MHDate] = "ASC";
				break;	
			
			case 'event':
				$sql .= " ORDER BY ClientEventTBL.Event ".$_SESSION[MHDesc];
				if ($_SESSION[MHDesc] == "ASC")
					$_SESSION[MHDesc] = "DESC";
				else
					$_SESSION[MHDesc] = "ASC";
				break;
				
			case 'provider':
				$sql .= " ORDER BY FullNameTBL.LastName ".$_SESSION[MHProv];
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
			
			$sql .= ") ORDER BY CalendarTBL.StartDate DESC";
		}  // End of Else
}	// End of Else POST

// now lets run the sql that was built
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for big big join (195) sql = '$sql' - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
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
		//----------------------------------------------------------------------------------------------------------
		// create the SQL statement to see if we have scanned documents
		//----------------------------------------------------------------------------------------------------------
		$sql = "SELECT * from EventScanTBL 
			inner join ClientEventTBL on EventScanTBL.ClientEventID = ClientEventTBL.ID
			where (ClientEventTBL.ID = '$result_arr[EventID]'and ClientEventTBL.CurrentStatus = '1')";
						
		if (!$sql_scan_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for EventScanTBL and ClientEventTBL \n sql = '$sql'\n (195) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
			
		//----------------------------------------------------------------------------------------------------------
		// Now lets first see if there is anything to run through.  If more or less then 1 we have an error
		//----------------------------------------------------------------------------------------------------------
		$countRows = mysql_num_rows($sql_scan_result);
		if ($countRows > 0)
		{
			//----------------------------------------------------------------------------------------------------------
			// We have images to present
			//----------------------------------------------------------------------------------------------------------
			$DoIt = 1;
		}
		else
		{
			//----------------------------------------------------------------------------------------------------------
			// We have no images to present
			//----------------------------------------------------------------------------------------------------------
			$DoIt = 0;
		}	
	
		//--------------------------------------------------------------------------------------------------------------
		// Now on to the rest of our original query
		//
		// get start date in readable format
		//----------------------------------------------------------------------------------------------------------
		$showDate = CovertMySQLDate($result_arr["StartDate"], 1, 1);
		
		if ($FlipFlag == 1)
		{
			$DisplayBlock .= " 
				<tr>
					<td width=\"5%\" align=center height=17 class=\"tblDetailsmTextOff\">
						<a href=\"if_UAmedhistdetail.php?eventid=".$result_arr[EventID]."\" target=\"detailFrame\">
							<img id=\"moredetail\" height=20 width=20 border=\"0\" src=\"images/binoculars.gif\">
						</a>
					</td>
					<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOff\">".substr($result_arr[EventType], 0, 23)."</td>
					<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOff\">".$showDate."</td>
					<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOff\">".substr($result_arr[Event], 0, 23)."</td>
					<td width=\"20%\" align=left height=17 class=\"tblDetailsmTextOff\">".$result_arr[FirstName]." ".$result_arr[LastName]." ".$result_arr[Suffix]."</td>
				";
				
			if ( $DoIt == 0 )
			{
				$DisplayBlock .= "<td width=\"5%\" align=center height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>";
			}
			else
			{
				$DisplayBlock .= "
					<td width=\"5%\" align=center height=17 class=\"tblDetailsmTextOff\">
						<a href=\"if_UAmedhistdetail.php?eventid=".$result_arr[EventID]."\"  target=\"detailFrame\" class=\"tblDetailsmTextLinkOff\">
							<img align=center id=\"scandetail\" border=\"0\" src=\"images/camera.gif\">
						</a>
					</td>
				";	
			}
	
			$DisplayBlock .= "</tr>";
			
			$FlipFlag = 0;
		}
		else
		{
			$DisplayBlock .= " 	
				<tr>
					<td width=\"5%\" align=center height=17 class=\"tblDetailsmTextOn\">
						<a href=\"if_UAmedhistdetail.php?eventid=".$result_arr[EventID]."\" target=\"detailFrame\">
							<img id=\"moredetail\" height=20 width=20 border=\"0\" src=\"images/binocularsOn.gif\">
						</a>
					</td>
					<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOn\">".substr($result_arr[EventType], 0, 23)."</td>
					<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOn\">".$showDate."</td>
					<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOn\">".substr($result_arr[Event], 0, 23)."</td>
					<td width=\"20%\" align=left height=17 class=\"tblDetailsmTextOn\">".$result_arr[FirstName]." ".$result_arr[LastName]." ".$result_arr[Suffix]."</td>
				";				
					
			if ( $DoIt == 0 )
			{
				$DisplayBlock .= "<td width=\"5%\" align=center height=17 class=\"tblDetailsmTextOn\">&nbsp;</td>";
			}
			else
			{
				$DisplayBlock .= " 
					<td width=\"5%\" align=center height=17 class=\"tblDetailsmTextOn\">
						<a href=\"if_UAmedhistdetail.php?eventid=".$result_arr[EventID]."\" target=\"detailFrame\" class=\"tblDetailsmTextLinkOff\">
							<img align=center id=\"scandetail\" border=\"0\" src=\"images/camera.gif\">
						</a>
					</td>
				";	
			}
			
			$DisplayBlock .= "</tr>";
			
			$FlipFlag = 1;
		}
	}  // end of while
}
else
{
	$DisplayBlock .= "
		<tr>
			<td width=\"5%\" align=center height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>
			<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>
			<td width=\"15%\" align=left height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>
			<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOff\">No History</td>
			<td width=\"20%\" align=left height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>
			<td width=\"5%\" align=left height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>
		</tr>
	";	
}

?>
<html>
<head>
<title>HealthYourSelf Date soet medical historyo</title>
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

<center>
<table width="100%" cellspacing=0 cellpadding=0 border=0>
		<?php print $DisplayBlock; ?>
</table>

</center>

</div>
</body>
</html>
