<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_probtracklist.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

// create the SQL statement 
$sql = "SELECT ProblemTrackingTBL.ID as PT_ID, USERID,
				UserTypeID, ProblemTypeID, ProblemAreaID,
				BrowserTypeID, BrowserOther, ProblemSeverityID, ProblemStatusID,
				ProblemSeverity, ProblemStatus, BrowserType, ProblemArea
				from ProblemTrackingTBL
				left join ProblemAreaTBL on ProblemTrackingTBL.ProblemAreaID = ProblemAreaTBL.ID
				left join BrowserTypeTBL on ProblemTrackingTBL.BrowserTypeID = BrowserTypeTBL.ID
				left join ProblemSeverityTBL on ProblemTrackingTBL.ProblemSeverityID = ProblemSeverityTBL.ID
				left join ProblemStatusTBL on ProblemTrackingTBL.ProblemStatusID = ProblemStatusTBL.ID";
			
if (isset($_GET[order]))
{
	//--------------------------------------------------------------------------------------------------
	// We ARE a get
	//
	// First lets see if our sort cookie is set.  If not lets set it up (WE will be using cookies
	// via the php session service.  Another chance for us to learn.
	//--------------------------------------------------------------------------------------------------
	if (empty($_SESSION[PTid]))
	{
		//	echo "WE are empty session\n";
		//----------------------------------------------------------------------------------------------
		// Ok nothing here to see folks.  But honestly - we need to set our variables for first time
		//----------------------------------------------------------------------------------------------
		$_SESSION[PTid] = "DESC";
		$_SESSION[PTarea] = "ASC";
		$_SESSION[PTbrowser] = "ASC";
		$_SESSION[PTsev] = "ASC";
		$_SESSION[PTstat] = "ASC";
	}
			
	//--------------------------------------------------------------------------------------------------
	// Now that the session Variables are set it is time to build our sql based on what was passed
	//--------------------------------------------------------------------------------------------------
	switch ($_GET[order])
	{
		case 'bugid':
			$sql .= " ORDER BY PT_ID ".$_SESSION[PTid];
			if ($_SESSION[PTid] == "ASC")
				$_SESSION[PTid] = "DESC";
			else
				$_SESSION[PTid] = "ASC";
			break;
			
		case 'area':
			$sql .= " ORDER BY ProblemArea ".$_SESSION[PTarea];
			if ($_SESSION[PTarea] == "ASC")
				$_SESSION[PTarea] = "DESC";
			else
				$_SESSION[PTarea] = "ASC";
			break;	
	
		case 'browser':
			$sql .= " ORDER BY BrowserType ".$_SESSION[PTbrowser];
			if ($_SESSION[PTbrowser] == "ASC")
				$_SESSION[PTbrowser] = "DESC";
			else
				$_SESSION[PTbrowser] = "ASC";
			break;
			
		case 'severity':
			$sql .= " ORDER BY ProblemSeverity ".$_SESSION[PTsev];
			if ($_SESSION[PTsev] == "ASC")
				$_SESSION[PTsev] = "DESC";
			else
				$_SESSION[PTsev] = "ASC";
			break;	
		
		case 'status':
			$sql .= " ORDER BY ProblemStatus ".$_SESSION[PTstat];
			if ($_SESSION[PTstat] == "ASC")
				$_SESSION[PTstat] = "DESC";
			else
				$_SESSION[PTstat] = "ASC";
			break;	
			
		}  // End of Switch
}  // End of if GET
else
{
	// echo "WE are default\n";
	//----------------------------------------------------------------------------------------------
	// first time thru so default to desc sort of all info
	//----------------------------------------------------------------------------------------------
	
	$sql .= " ORDER BY ProblemTrackingTBL.ID DESC";
}  // End of Else

// now lets run the sql that was built
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ProblemTrackingTBL (195) - '$sql'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
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
		$ProxyType = $result_arr[UserTypeID];
		$ProxyUserID = $result_arr[USERID];
	
		switch ($ProxyType)
		{
			case $DisplayClientType:
				//----------------------------------------------------------------------------------------------------------
				// create the SQL statement to get the client info
				//----------------------------------------------------------------------------------------------------------
				$sql = "SELECT FullNameID, FirstName, LastName, Suffix, MI, Prefix
					from ClientTBL
					left join FullNameTBL  on ClientTBL.FullNameID = FullNameTBL.ID
						where (ClientTBL.MEDPAL = '$ProxyUserID')";  
					
				if (!$sql_name_result = mysql_query($sql, $conn))
				{
					$sqlerr = mysql_error();
					$errmsg = "$sqlerr - Error doing mysql_query join for ClientTBL, and FullNameTBL (195) sql = '$sql'";
					$location = "";
					$severity = 1;	
					$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
					LogErr($shortmsg, $errmsg, $location, $module, $severity);
				}
					
				// Now lets first see if there is anything to run through.  If more then 1 we have an error
				$countRows = mysql_num_rows($sql_name_result);
				if ($countRows != 1)
				{
					$errmsg = " Error more or less then 1 rows returned in select on ClientTBL. count = '$countRows'  - ProxyUserID =  '$ProxyUserID'";
					$location = "";
					$severity = 1;	
					$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
					LogErr($shortmsg, $errmsg, $location, $module, $severity);
				}	
				
				//----------------------------------------------------------------------------------------------------------
				// Get the data
				//----------------------------------------------------------------------------------------------------------
				$result_name_array = mysql_fetch_assoc($sql_name_result);
				break;
				
			case $DisplayPharmacyType:
				//----------------------------------------------------------------------------------------------------------
				// create the SQL statement to get the pharmacy info
				//----------------------------------------------------------------------------------------------------------
				$sql = "SELECT FullNameID, Prefix, FirstName, MI, LastName, Suffix
					from PharmacyTBL 
					left join FullNameTBL on PharmacyTBL.FullNameID = FullNameTBL.ID
						WHERE (PharmacyTBL.ID = '$ProxyUserID')"; 
						
				 if (!$sql_name_result = mysql_query($sql, $conn))
				{
					$sqlerr = mysql_error();
					$errmsg = "$sqlerr - Error doing mysql_query join for PharmacyTBL, FullNameTBL (195) sql = '$sql'";
					$location = "";
					$severity = 1;	
					$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
					LogErr($shortmsg, $errmsg, $location, $module, $severity);
				}
					
				// Now lets first see if there is anything to run through.  If more then 1 we have an error
				$countRows = mysql_num_rows($sql_name_result);
				if ($countRows != 1)
				{
					$errmsg = " Error more or less then 1 rows returned in select on PharmacyTBL. count = '$countRows'  - ProxyUserID =  '$ProxyUserID'";
					$location = "";
					$severity = 1;	
					$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
					LogErr($shortmsg, $errmsg, $location, $module, $severity);
				}		
				
				//----------------------------------------------------------------------------------------------------------
				// Get the data
				//----------------------------------------------------------------------------------------------------------
				$result_name_array = mysql_fetch_assoc($sql_name_result);
				break;
			
			case $DisplayProviderType:
				$sql = "SELECT FullNameID, Prefix, FirstName, MI, LastName, Suffix
					from ProviderTBL 
					left join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID 
						where (ProviderTBL.ID = '$ProxyUserID')";
				
				if (!$sql_name_result = mysql_query($sql, $conn))
				{
					$sqlerr = mysql_error();
					$errmsg = "$sqlerr - Error doing mysql_query join for ProviderTBL and FullNameTBL (195) sql = '$sql'";
					$location = "";
					$severity = 1;	
					$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
					LogErr($shortmsg, $errmsg, $location, $module, $severity);
				}
					
				// Now lets first see if there is anything to run through.  If more then 1 we have an error
				$countRows = mysql_num_rows($sql_name_result);
				if ($countRows != 1)
				{
					$errmsg = " Error more or less then 1 rows returned in select on ProviderTBL. count = '$countRows'  - ProxyUserID =  '$ProxyUserID'";
					$location = "";
					$severity = 1;	
					$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
					LogErr($shortmsg, $errmsg, $location, $module, $severity);
				}		
				
				//----------------------------------------------------------------------------------------------------------
				// Get the data
				//----------------------------------------------------------------------------------------------------------
				$result_name_array = mysql_fetch_assoc($sql_name_result);
				break;
			
			case $DisplayUserProxyType:	
				//----------------------------------------------------------------------------------------------------------
				// create the SQL statement to get the User info
				//----------------------------------------------------------------------------------------------------------
				$sql = "SELECT FullNameID, FirstName, LastName, Suffix, MI, Prefix
					from UserTBL
					left join FullNameTBL  on UserTBL.FullNameID = FullNameTBL.ID
						where (UserTBL.ID = '$ProxyUserID')";  
					
				if (!$sql_name_result = mysql_query($sql, $conn))
				{
					$sqlerr = mysql_error();
					$errmsg = "$sqlerr - Error doing mysql_query join for UserTBL,  and FullNameTBL (195) sql = '$sql'";
					$location = "";
					$severity = 1;	
					$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
					LogErr($shortmsg, $errmsg, $location, $module, $severity);
				}
					
				// Now lets first see if there is anything to run through.  If more then 1 we have an error
				$countRows = mysql_num_rows($sql_name_result);
				if ($countRows != 1)
				{
					$errmsg = " Error more or less then 1 rows returned in select on UserTBL. count = '$countRows'  - ProxyUserID =  '$ProxyUserID'";
					$location = "";
					$severity = 1;	
					$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
					LogErr($shortmsg, $errmsg, $location, $module, $severity);
				}
				
				//----------------------------------------------------------------------------------------------------------
				// Get the data
				//----------------------------------------------------------------------------------------------------------
				$result_name_array = mysql_fetch_assoc($sql_name_result);
				break;
				
			case $DisplayCustomerServiceType:	
				break;
		}
	
		// lets build our variables
		if ($ProxyType == $DisplayCustomerServiceType)
		{
			$DisplayName = "CSID".$ProxyUserID;
		}
		else
		{
			$DisplayName = $result_name_array[LastName];
			if ($result_name_array[Suffix] != "")
			{
				$DisplayName .= " ".$result_name_array[Suffix];
			}
			
			$DisplayName .= ", ".$result_name_array[FirstName]." ".$result_name_array[MI];
		}
		
		$DisplayTrackingID = $result_arr[PT_ID];
		$DisplayArea = $result_arr[ProblemArea];
		if ($result_arr[BrowserType] == "")
		{
			$DisplayBrowser = $result_arr[BrowserOther];
		}
		else
		{
			$DisplayBrowser = $result_arr[BrowserType];
		}
		
		$DisplaySeverity = $result_arr[ProblemSeverity];
		$DisplayStatus = $result_arr[ProblemStatus];
		
		if ($FlipFlag == 1)
		{
			$DisplayBlock .= "
				<tr>
					<td width=\"5%\" align=center height=17 class=\"tblDetailsmTextOff\">
						<a href=\"if_probtrackdetail.php?probtrackid=".$DisplayTrackingID."\" target=\"detailFrame\">
							<img id=\"moredetail\" border=\"0\" height=20 width=20 src=\"images/binoculars.gif\"></a>
					</td>
					<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOff\">".$DisplayTrackingID."</td>
					<td width=\"15%\" align=left height=17 class=\"tblDetailsmTextOff\">".$DisplayName."</td>
					<td width=\"15%\" align=left height=17 class=\"tblDetailsmTextOff\">".$DisplayArea."</td>
					<td width=\"20%\" align=left height=17 class=\"tblDetailsmTextOff\">".$DisplayBrowser."</td>
					<td width=\"15%\" align=left height=17 class=\"tblDetailsmTextOff\">".$DisplaySeverity."</td>
					<td width=\"15%\" align=left height=17 class=\"tblDetailsmTextOff\">".$DisplayStatus."</td>
				</tr>
			";
			
			$FlipFlag = 0;
		}
		else
		{
			$DisplayBlock .= "
				<tr>
					<td width=\"5%\" align=center height=17 class=\"tblDetailsmTextOn\">
						<a href=\"if_probtrackdetail.php?probtrackid=".$DisplayTrackingID."\" target=\"detailFrame\">
							<img id=\"moredetail\" border=\"0\" height=20 width=20 src=\"images/binocularsOn.gif\"></a>
					</td>
					<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOn\">".$DisplayTrackingID."</td>
					<td width=\"15%\" align=left height=17 class=\"tblDetailsmTextOn\">".$DisplayName."</td>
					<td width=\"15%\" align=left height=17 class=\"tblDetailsmTextOn\">".$DisplayArea."</td>
					<td width=\"20%\" align=left height=17 class=\"tblDetailsmTextOn\">".$DisplayBrowser."</td>
					<td width=\"15%\" align=left height=17 class=\"tblDetailsmTextOn\">".$DisplaySeverity."</td>
					<td width=\"15%\" align=left height=17 class=\"tblDetailsmTextOn\">".$DisplayStatus."</td>
				</tr>
			";
			
			$FlipFlag = 1;
		}
	}  // end of while
}
else
{
	$DisplayBlock .= "
		<tr>
			<td width=\"5%\" align=center height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>
			<td width=\"15%\" align=left height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>
			<td width=\"20%\" align=left height=17 class=\"tblDetailsmTextOff\">No Problems</td>
			<td width=\"15%\" align=left height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>
			<td width=\"15%\" align=left height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>
			<td width=\"15%\" align=left height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>
			<td width=\"15%\" align=left height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>
		</tr>
		";
}

?>
<html>

<head>
<title>HealthYourSelf Customer Prescription Update</title>
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
