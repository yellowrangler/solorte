<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_accessloglist.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

// create the SQL statement to get our calendar events for prescription appointments only
$sql = "SELECT DateTimeStamp, USERID, TypeID, Activity, AuthType
				from AccessLogTBL
				left join AuthTypeTBL on AuthTypeTBL.ID = AccessLogTBL.TypeID
				where (AccessLogTBL.MEDPAL = '$Medpal')";
			
if (isset($_GET[order]))
{
	//--------------------------------------------------------------------------------------------------
	// We ARE a get
	//
	// First lets see if our sort cookie is set.  If not lets set it up (WE will be using cookies
	// via the php session service.  Another chance for us to learn.
	//--------------------------------------------------------------------------------------------------
	if (empty($_SESSION[ALDate]))
	{
		//	echo "WE are empty session\n";
		//----------------------------------------------------------------------------------------------
		// Ok nothing here to see folks.  But honestly - we need to set our variables for first time
		//----------------------------------------------------------------------------------------------
		$_SESSION[ALDate] = "DESC";
		$_SESSION[ALDesc] = "ASC";
		$_SESSION[ALType] = "ASC";
	}
			
	//--------------------------------------------------------------------------------------------------
	// Now that the session Variables are set it is time to build our sql based on what was passed
	//--------------------------------------------------------------------------------------------------
	switch ($_GET[order])
	{
		case 'adate':
			$sql .= " ORDER BY DateTimeStamp ".$_SESSION[ALDate];
			if ($_SESSION[ALDate] == "ASC")
				$_SESSION[ALDate] = "DESC";
			else
				$_SESSION[ALDate] = "ASC";
			break;
	
		case 'adesc':
			$sql .= " ORDER BY Activity ".$_SESSION[ALDesc];
			if ($_SESSION[ALDesc] == "ASC")
				$_SESSION[ALDesc] = "DESC";
			else
				$_SESSION[ALDesc] = "ASC";
			break;
			
		case 'atype':
			$sql .= " ORDER BY TypeID ".$_SESSION[ALType];
			if ($_SESSION[ALType] == "ASC")
				$_SESSION[ALType] = "DESC";
			else
				$_SESSION[ALType] = "ASC";
			break;	
			
		}  // End of Switch
}  // End of if GET
else
{
	// echo "WE are default\n";
	//----------------------------------------------------------------------------------------------
	// first time thru so default to desc sort of all info
	//----------------------------------------------------------------------------------------------
	
	$sql .= " ORDER BY DateTimeStamp DESC";
}  // End of Else

// now lets run the sql that was built
if (!$sql_auth_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for AccessLogTBL FullNameTBL (195) - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}
	
	
// Now lets first see if there is anything to run through
$countRows = mysql_num_rows($sql_auth_result);
if ($countRows >  0) 
{	
	// Used to turn colors on and off 
	$FlipFlag = 1;
	
	// initialize display block
	$DisplayBlock = "";
	$DispalyAccessLogDate = "";
	$DisplayAccessLogTime = "";
	$DisplayAccessLogName = "";
	$DisplayAccessLogType = "";	
	$DislayAccessLogActivity = "Empty Log";
	
	// now lets run the table and get our medical appointments
	while ($result_auth_array = mysql_fetch_assoc($sql_auth_result))
	{
		//----------------------------------------------------------------------------------------------------------
		// get name of person on log
		//----------------------------------------------------------------------------------------------------------
		$ProxyType = $result_auth_array[TypeID];
		$ProxyUserID = $result_auth_array[USERID];
		
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
					
				if (!$sql_result = mysql_query($sql, $conn))
				{
					$sqlerr = mysql_error();
					$errmsg = "$sqlerr - Error doing mysql_query join for ClientTBL, and FullNameTBL (195) sql = '$sql'";
					$location = "";
					$severity = 1;	
					$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
					LogErr($shortmsg, $errmsg, $location, $module, $severity);
				}
					
				// Now lets first see if there is anything to run through.  If more then 1 we have an error
				$countRows = mysql_num_rows($sql_result);
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
				$result_array = mysql_fetch_assoc($sql_result);
				break;
				
			case $DisplayPharmacyType:
				//----------------------------------------------------------------------------------------------------------
				// create the SQL statement to get the pharmacy info
				//----------------------------------------------------------------------------------------------------------
				$sql = "SELECT FullNameID, Prefix, FirstName, MI, LastName, Suffix
					from PharmacyTBL 
					left join FullNameTBL on PharmacyTBL.FullNameID = FullNameTBL.ID
						WHERE (PharmacyTBL.ID = '$ProxyUserID')"; 
						
				 if (!$sql_result = mysql_query($sql, $conn))
				{
					$sqlerr = mysql_error();
					$errmsg = "$sqlerr - Error doing mysql_query join for PharmacyTBL, FullNameTBL (195) sql = '$sql'";
					$location = "";
					$severity = 1;	
					$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
					LogErr($shortmsg, $errmsg, $location, $module, $severity);
				}
					
				// Now lets first see if there is anything to run through.  If more then 1 we have an error
				$countRows = mysql_num_rows($sql_result);
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
				$result_array = mysql_fetch_assoc($sql_result);
				break;
			
			case $DisplayProviderType:
				$sql = "SELECT FullNameID, Prefix, FirstName, MI, LastName, Suffix
					from ProviderTBL 
					left join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID 
						where (ProviderTBL.ID = '$ProxyUserID')";
				
				if (!$sql_result = mysql_query($sql, $conn))
				{
					$sqlerr = mysql_error();
					$errmsg = "$sqlerr - Error doing mysql_query join for ProviderTBL and FullNameTBL (195) sql = '$sql'";
					$location = "";
					$severity = 1;	
					$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
					LogErr($shortmsg, $errmsg, $location, $module, $severity);
				}
					
				// Now lets first see if there is anything to run through.  If more then 1 we have an error
				$countRows = mysql_num_rows($sql_result);
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
				$result_array = mysql_fetch_assoc($sql_result);
				break;
			
			case $DisplayUserProxyType:	
				//----------------------------------------------------------------------------------------------------------
				// create the SQL statement to get the User info
				//----------------------------------------------------------------------------------------------------------
				$sql = "SELECT FullNameID, FirstName, LastName, Suffix, MI, Prefix
					from UserTBL
					left join FullNameTBL  on UserTBL.FullNameID = FullNameTBL.ID
						where (UserTBL.ID = '$ProxyUserID')";  
					
				if (!$sql_result = mysql_query($sql, $conn))
				{
					$sqlerr = mysql_error();
					$errmsg = "$sqlerr - Error doing mysql_query join for UserTBL,  and FullNameTBL (195) sql = '$sql'";
					$location = "";
					$severity = 1;	
					$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
					LogErr($shortmsg, $errmsg, $location, $module, $severity);
				}
					
				// Now lets first see if there is anything to run through.  If more then 1 we have an error
				$countRows = mysql_num_rows($sql_result);
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
				$result_array = mysql_fetch_assoc($sql_result);
				break;
				
			case $DisplayCustomerServiceType:	
				break;
		}

		$DisplayAccessLogName = "";
		
		if ($ProxyType == $DisplayCustomerServiceType)
		{
			$DisplayAccessLogName = "CSID".$ProxyUserID;
		}
		else
		{
			$DisplayAccessLogName = $result_array[LastName];
			if ($result_array[Suffix] != "")
			{
				$DisplayAccessLogName .= " ".$result_array[Suffix];
			}
			
			$DisplayAccessLogName .= ", ".$result_array[FirstName]." ".$result_array[MI];
		}	
	
		// Get access Date and time
		$DispalyAccessLogDate = CovertMySQLDate($result_auth_array["DateTimeStamp"], 2, 1);
		$DisplayAccessLogTime = CovertMySQLTime($result_auth_array["DateTimeStamp"], 2, 2);
		 
		// Get Type
		$DislayAccessLogType = $result_auth_array[AuthType];
	
		// Get access Activity
		$DislayAccessLogActivity = $result_auth_array[Activity];
		
		if ($FlipFlag == 1)
		{
			$DisplayBlock .= " 
				<tr>
					<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOff\">".$DispalyAccessLogDate."</td>
					<td width=\"15%\" align=left height=17 class=\"tblDetailsmTextOff\">".$DisplayAccessLogTime."</td>
					<td width=\"20%\" align=left height=17 class=\"tblDetailsmTextOff\">".$DisplayAccessLogName."</td>
					<td width=\"20%\" align=left height=17 class=\"tblDetailsmTextOff\">".$DislayAccessLogType."</td>
					<td width=\"30%\" align=left height=17 class=\"tblDetailsmTextOff\">".$DislayAccessLogActivity."</td>
				</tr>
				";

			$FlipFlag = 0;
		}
		else
		{
			$DisplayBlock .= " 
				<tr>
					<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOn\">".$DispalyAccessLogDate."</td>
					<td width=\"15%\" align=left height=17 class=\"tblDetailsmTextOn\">".$DisplayAccessLogTime."</td>
					<td width=\"20%\" align=left height=17 class=\"tblDetailsmTextOn\">".$DisplayAccessLogName."</td>
					<td width=\"20%\" align=left height=17 class=\"tblDetailsmTextOn\">".$DislayAccessLogType."</td>
					<td width=\"30%\" align=left height=17 class=\"tblDetailsmTextOn\">".$DislayAccessLogActivity."</td>
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
					<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOff\">".$DispalyAccessLogDate."</td>
					<td width=\"15%\" align=left height=17 class=\"tblDetailsmTextOff\">".$DisplayAccessLogTime."</td>
					<td width=\"20%\" align=left height=17 class=\"tblDetailsmTextOff\">".$DisplayAccessLogName."</td>
					<td width=\"20%\" align=left height=17 class=\"tblDetailsmTextOff\">".$DislayAccessLogType."</td>					
					<td width=\"30%\" align=left height=17 class=\"tblDetailsmTextOff\">".$DislayAccessLogActivity."</td>
				</tr>
				";	
}

?>
<html>

<head>
<title>HealthYourSelf Customer Access Log Update</title>
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
