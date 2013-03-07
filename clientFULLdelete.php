<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'clientFULLdelete.php';

require ('hysInitAdmin.php');

require ('hysDBinit.php');

//--------------------------------------------------------------------------------------------------
// Delete a medpal client FULLY
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// if id to delete not passed in then error
//--------------------------------------------------------------------------------------------------
if (!isset($_POST[clientid]))
{
	// error
	$errmsg = "Error doing delete before sql. no clientid. clientid= '$_POST[clientid]' (000)";
	$shortmsg = "";
	$location = "if_clientFULLdelete.php";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

$ClientID = $_POST[clientid];

//--------------------------------------------------------------------------------------------------
// delete from AccessLogTBL
//--------------------------------------------------------------------------------------------------

// First remove stuff others did for me
$sql = "DELETE from AccessLogTBL where MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on AccessLogTBL (999) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// next remove stuff I did for me
$sql = "DELETE from AccessLogTBL where USERID = '$ClientID' and TypeID = 'M'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on AccessLogTBL (999) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}
$logmsg = "Deleted AccessLogTBL records for MEDPAL '$ClientID'";
$shortmsg = "";
$location = "";
$severity = 0;
LogErr($shortmsg, $logmsg, $location, $module, $severity);

//--------------------------------------------------------------------------------------------------
// delete from AuthenticationTBL
//--------------------------------------------------------------------------------------------------

// First people who I authorized to see me have my medpal removed. We run the risk of having teatherless users
$sql = "DELETE from AuthenticationTBL 
			where USERID = '$ClientID' AND TypeID = 'M'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on AuthenticationTBL (999) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}
$logmsg = "Deleted AuthenticationTBL records for MEDPAL '$ClientID'";
$shortmsg = "";
$location = "";
$severity = 0;
LogErr($shortmsg, $logmsg, $location, $module, $severity);

//--------------------------------------------------------------------------------------------------
// delete from AuthorizationTBL
//--------------------------------------------------------------------------------------------------

// First people who I authorized to see me have my medpal removed. We run the risk of having teatherless users
$sql = "DELETE from AuthorizationTBL where MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on AuthorizationTBL (999) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// Second I remove myself AND all users I have access to - I will need to come back as USER 
$sql = "DELETE from AuthorizationTBL 
			where USERID = '$ClientID' AND TypeID = 'M'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on AuthorizationTBL (998) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

$logmsg = "Deleted AuthorizationTBL records for USER  MEDPAL '$ClientID'";
$shortmsg = "";
$location = "";
$severity = 0;
LogErr($shortmsg, $logmsg, $location, $module, $severity);

//--------------------------------------------------------------------------------------------------
// delete from AddrTBL and ClientAddrTBL
//--------------------------------------------------------------------------------------------------

// First set up loop to go through client addres tbl and delete AddrTBL
$sql = "SELECT * from ClientAddrTBL where MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ClientAddrTBL (997) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// Now lets process the result set 
while($result_arr = mysql_fetch_assoc($sql_result))
{
	$sql = "DELETE from AddrTBL where AddrTBL.ID = '$result_arr[AddrID]'";

	if (!$sql_tmp_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query for delete on AddrTBL (999) - '$ClientID'";
		$shortmsg = "";
		$location = "";
		$severity = 0;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
}

// Now delete ClientAddrTBL
$sql = "DELETE from ClientAddrTBL where ClientAddrTBL.MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientAddrTBL (999) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

$logmsg = "Deleted ClientAddrTBL AddrTBL records for MEDPAL '$ClientID'";
$shortmsg = "";
$location = "";
$severity = 0;
LogErr($shortmsg, $logmsg, $location, $module, $severity);

//--------------------------------------------------------------------------------------------------
// delete from ClientAllergyTBL
//--------------------------------------------------------------------------------------------------
$sql = "DELETE from ClientAllergyTBL where ClientAllergyTBL.MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientAllergyTBL (999) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

$logmsg = "Deleted ClientAllergyTBL records for MEDPAL '$ClientID'";
$shortmsg = "";
$location = "";
$severity = 0;
LogErr($shortmsg, $logmsg, $location, $module, $severity);

//--------------------------------------------------------------------------------------------------
// delete from CalendarTBL and ClientAppointmentTBL
//--------------------------------------------------------------------------------------------------

// First set up loop to go through ClientAppointmentTBL and delete CalendarTBL
$sql = "SELECT * from ClientAppointmentTBL where MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ClientAppointmentTBL (996) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// Now lets process the result set 
while($result_arr = mysql_fetch_assoc($sql_result))
{
	$sql = "DELETE from CalendarTBL where CalendarTBL.ID = '$result_arr[CalendarID]'";

	if (!$sql_tmp_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query for delete on CalendarTBL (999) - '$ClientID'";
		$shortmsg = "";
		$location = "";
		$severity = 0;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
}

// Now delete ClientAppointmentTBL
$sql = "DELETE from ClientAppointmentTBL where ClientAppointmentTBL.MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientAppointmentTBL (999) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

$logmsg = "Deleted ClientAppointmentTBL CalendarTBL records for MEDPAL '$ClientID'";
$shortmsg = "";
$location = "";
$severity = 0;
LogErr($shortmsg, $logmsg, $location, $module, $severity);

//--------------------------------------------------------------------------------------------------
// delete from ClientBehavioralTBL
//--------------------------------------------------------------------------------------------------
$sql = "DELETE from ClientBehavioralTBL where ClientBehavioralTBL.MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientBehavioralTBL (999) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

$logmsg = "Deleted ClientBehavioralTBL records for MEDPAL '$ClientID'";
$shortmsg = "";
$location = "";
$severity = 0;
LogErr($shortmsg, $logmsg, $location, $module, $severity);

//--------------------------------------------------------------------------------------------------
// delete from ClientCronicConditionTBL
//--------------------------------------------------------------------------------------------------
$sql = "DELETE from ClientCronicConditionTBL where ClientCronicConditionTBL.MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientCronicConditionTBL (999) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

$logmsg = "Deleted ClientCronicConditionTBL records for MEDPAL '$ClientID'";
$shortmsg = "";
$location = "";
$severity = 0;
LogErr($shortmsg, $logmsg, $location, $module, $severity);

//--------------------------------------------------------------------------------------------------
// delete from ClientDiagnosisTBL
//--------------------------------------------------------------------------------------------------
$sql = "DELETE from ClientDiagnosisTBL where ClientDiagnosisTBL.MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientDiagnosisTBL (999) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

$logmsg = "Deleted ClientDiagnosisTBL records for MEDPAL '$ClientID'";
$shortmsg = "";
$location = "";
$severity = 0;
LogErr($shortmsg, $logmsg, $location, $module, $severity);

//--------------------------------------------------------------------------------------------------
// delete from ClientDispositionTBL
//--------------------------------------------------------------------------------------------------
$sql = "DELETE from ClientDispositionTBL where ClientDispositionTBL.MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientDispositionTBL (999) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

$logmsg = "Deleted ClientDispositionTBL records for MEDPAL '$ClientID'";
$shortmsg = "";
$location = "";
$severity = 0;
LogErr($shortmsg, $logmsg, $location, $module, $severity);

//--------------------------------------------------------------------------------------------------
// delete from ClientEmergContactsTBL
//--------------------------------------------------------------------------------------------------
$sql = "DELETE from ClientEmergContactsTBL where ClientEmergContactsTBL.MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientEmergContactsTBL (999) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

$logmsg = "Deleted ClientEmergContactsTBL records for MEDPAL '$ClientID'";
$shortmsg = "";
$location = "";
$severity = 0;
LogErr($shortmsg, $logmsg, $location, $module, $severity);

//--------------------------------------------------------------------------------------------------
// delete from CalendarTBL, EventScanTBL, ScanInfoTBL and ClientEventTBL - We will not delete Diag, Symp or Disp TBLs
// They have MEDPAL's associated with them and will be taken out later
//--------------------------------------------------------------------------------------------------

// First set up loop to go through ClientEventTBL and delete CalendarTBL
$sql = "SELECT * from ClientEventTBL where MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ClientEventTBL (996) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// Now lets process the result set 
while($result_arr = mysql_fetch_assoc($sql_result))
{
	// Delete the CalendarTBL entry
	$sql = "DELETE from CalendarTBL where CalendarTBL.ID = '$result_arr[CalendarID]'";

	if (!$sql_tmp_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query for delete on CalendarTBL (999) - '$ClientID'";
		$shortmsg = "";
		$location = "";
		$severity = 0;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	
	// Now start another loop to get scan stuff
	$sql = "SELECT * from EventScanTBL where ClientEventID = '$result_arr[ID]'";
	
	if (!$sql_tmp_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query for EventScanTBL (996) - '$result_arr[ID]'";
		$shortmsg = "";
		$location = "";
		$severity = 0;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	
	while($result_arr_inner = mysql_fetch_assoc($sql_tmp_result))
	{
		// Now lets process the result set 
		$ScanID = $result_arr_inner[ScanID];
		
		// Now start another loop to get scan stuff
		$sql = "SELECT URL from ScanInfoTBL where ID = '$ScanID'";
		
		if (!$sql_tmp2_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for ScanInfoTBL (996) - '$ScanID'";
			$shortmsg = "";
			$location = "";
			$severity = 0;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		// Now lets process the result set 
		$countRows = mysql_num_rows($sql_tmp2_result);
		if ($countRows != 1)
		{
			$errmsg = " Error more or less then 1 rows returned in select on ScanInfoTBL. count = '$countRows'  - ScanID =  '$ScanID'";
			$location = "";
			$severity = 0;	
			$shortmsg = "";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		// We can reuse this array
		$result_arr_inner = mysql_fetch_assoc($sql_tmp2_result);
		
		$FileName = $result_arr_inner[URL];
		
		if (file_exists($FileName)) 
		{
			$result = unlink($FileName);
			if (!$result)
			{
				$errmsg = "Error in unlinking file named '$FileName'";
				$location = "";
				$severity = 0;	
				$shortmsg = "";
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
			else
			{
				$errmsg = "Unlinked scan file named '$FileName'";
				$location = "";
				$severity = 0;	
				$shortmsg = "";
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
		}	
		else
		{
			$errmsg = "Error. Can not find file named '$FileName'";
			$location = "";
			$severity = 0;	
			$shortmsg = "";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		// Now we save the name of the scan dirctory (always the same for this client
		$tmpHold = explode("/", $FileName);
		$tmpDir = sprintf("%s/%s", $tmpHold[0], $tmpHold[1]);
		
		// Now we can delete the ScanInfoTBL
		$sql = "DELETE from ScanInfoTBL where ScanInfoTBL.ID = '$ScanID'";
		
		if (!$sql_tmp2_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for delete on ScanInfoTBL (999) - '$ScanID'";
			$shortmsg = "";
			$location = "";
			$severity = 0;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
	} // end of while
		
	// Now we can delete the EventScanTBL
	$sql = "DELETE from EventScanTBL where ClientEventID = '$result_arr[ID]'";
	
	if (!$sql_tmp_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query for delete on EventScanTBL (999) - '$result_arr[ID]'";
		$shortmsg = "";
		$location = "";
		$severity = 0;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
} // end of while there are client events

// Now we can delete the scan dir
if (is_dir($tmpDir))
{
	if (!rmdir($tmpDir))
	{
		$errmsg = "Error. Could not remove directory named '$tmpDir'";
		$location = "";
		$severity = 0;	
		$shortmsg = "";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	else
	{
		$errmsg = "Removed directory named '$tmpDir'";
		$location = "";
		$severity = 0;	
		$shortmsg = "";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
}
else
{
	$errmsg = "Error. Can not find directory named '$tmpDir'";
	$location = "";
	$severity = 0;	
	$shortmsg = "";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// Now delete ClientEventTBL
$sql = "DELETE from ClientEventTBL where ClientEventTBL.MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientEventTBL (999) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

$logmsg = "Deleted ClientEventTBL CalendarTBL records for MEDPAL '$ClientID'";
$shortmsg = "";
$location = "";
$severity = 0;
LogErr($shortmsg, $logmsg, $location, $module, $severity);

//--------------------------------------------------------------------------------------------------
// delete from ClientExternalTBL
//--------------------------------------------------------------------------------------------------
$sql = "DELETE from ClientExternalTBL where ClientExternalTBL.MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientExternalTBL (999) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

$logmsg = "Deleted ClientExternalTBL records for MEDPAL '$ClientID'";
$shortmsg = "";
$location = "";
$severity = 0;
LogErr($shortmsg, $logmsg, $location, $module, $severity);

//--------------------------------------------------------------------------------------------------
// delete from ClientFamilyHistoryTBL
//--------------------------------------------------------------------------------------------------
$sql = "DELETE from ClientFamilyHistoryTBL where ClientFamilyHistoryTBL.MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientFamilyHistoryTBL (999) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

$logmsg = "Deleted ClientFamilyHistoryTBL records for MEDPAL '$ClientID'";
$shortmsg = "";
$location = "";
$severity = 0;
LogErr($shortmsg, $logmsg, $location, $module, $severity);

//--------------------------------------------------------------------------------------------------
// delete from ClientHostTBL
//--------------------------------------------------------------------------------------------------
$sql = "DELETE from ClientHostTBL where ClientHostTBL.MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientHostTBL (999) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

$logmsg = "Deleted ClientHostTBL records for MEDPAL '$ClientID'";
$shortmsg = "";
$location = "";
$severity = 0;
LogErr($shortmsg, $logmsg, $location, $module, $severity);

//--------------------------------------------------------------------------------------------------
// delete from ClientInternalTBL
//--------------------------------------------------------------------------------------------------
$sql = "DELETE from ClientInternalTBL where ClientInternalTBL.MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientInternalTBL (999) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

$logmsg = "Deleted ClientInternalTBL records for MEDPAL '$ClientID'";
$shortmsg = "";
$location = "";
$severity = 0;
LogErr($shortmsg, $logmsg, $location, $module, $severity);

//--------------------------------------------------------------------------------------------------
// delete from ClientPayorTBL
//--------------------------------------------------------------------------------------------------
$sql = "DELETE from ClientPayorTBL where ClientPayorTBL.MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientPayorTBL (999) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

$logmsg = "Deleted ClientPayorTBL records for MEDPAL '$ClientID'";
$shortmsg = "";
$location = "";
$severity = 0;
LogErr($shortmsg, $logmsg, $location, $module, $severity);

//--------------------------------------------------------------------------------------------------
// delete from ClientPharmacyTBL
//--------------------------------------------------------------------------------------------------
$sql = "DELETE from ClientPharmacyTBL where ClientPharmacyTBL.MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientPharmacyTBL (999) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

$logmsg = "Deleted ClientPharmacyTBL records for MEDPAL '$ClientID'";
$shortmsg = "";
$location = "";
$severity = 0;
LogErr($shortmsg, $logmsg, $location, $module, $severity);

//--------------------------------------------------------------------------------------------------
// delete from ClientPrescriptionTBL
//--------------------------------------------------------------------------------------------------
$sql = "DELETE from ClientPrescriptionTBL where ClientPrescriptionTBL.MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientPrescriptionTBL (999) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

$logmsg = "Deleted ClientPrescriptionTBL records for MEDPAL '$ClientID'";
$shortmsg = "";
$location = "";
$severity = 0;
LogErr($shortmsg, $logmsg, $location, $module, $severity);

//--------------------------------------------------------------------------------------------------
// delete from ClientProviderTBL
//--------------------------------------------------------------------------------------------------
$sql = "DELETE from ClientProviderTBL where ClientProviderTBL.MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientProviderTBL (999) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

$logmsg = "Deleted ClientProviderTBL records for MEDPAL '$ClientID'";
$shortmsg = "";
$location = "";
$severity = 0;
LogErr($shortmsg, $logmsg, $location, $module, $severity);

//--------------------------------------------------------------------------------------------------
// delete from ClientRequestHistoryTBL
//--------------------------------------------------------------------------------------------------
$sql = "DELETE from ClientRequestHistoryTBL where ClientRequestHistoryTBL.MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientRequestHistoryTBL (999) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

$logmsg = "Deleted ClientRequestHistoryTBL records for MEDPAL '$ClientID'";
$shortmsg = "";
$location = "";
$severity = 0;
LogErr($shortmsg, $logmsg, $location, $module, $severity);

//--------------------------------------------------------------------------------------------------
// delete from ClientRequestTBL
//--------------------------------------------------------------------------------------------------
$sql = "DELETE from ClientRequestTBL where ClientRequestTBL.MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientRequestTBL (999) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

$logmsg = "Deleted ClientRequestTBL records for MEDPAL '$ClientID'";
$shortmsg = "";
$location = "";
$severity = 0;
LogErr($shortmsg, $logmsg, $location, $module, $severity);

//--------------------------------------------------------------------------------------------------
// delete from ClientRulesTBL
//--------------------------------------------------------------------------------------------------
$sql = "DELETE from ClientRulesTBL where ClientRulesTBL.MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientRulesTBL (999) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

$logmsg = "Deleted ClientRulesTBL records for MEDPAL '$ClientID'";
$shortmsg = "";
$location = "";
$severity = 0;
LogErr($shortmsg, $logmsg, $location, $module, $severity);

//--------------------------------------------------------------------------------------------------
// delete from ClientSocialProfileTBL
//--------------------------------------------------------------------------------------------------
$sql = "DELETE from ClientSocialProfileTBL where ClientSocialProfileTBL.MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientSocialProfileTBL (999) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

$logmsg = "Deleted ClientSocialProfileTBL records for MEDPAL '$ClientID'";
$shortmsg = "";
$location = "";
$severity = 0;
LogErr($shortmsg, $logmsg, $location, $module, $severity);

//--------------------------------------------------------------------------------------------------
// delete from ClientSpecialInstructionsTBL
//--------------------------------------------------------------------------------------------------
$sql = "DELETE from ClientSpecialInstructionsTBL where ClientSpecialInstructionsTBL.MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientSpecialInstructionsTBL (999) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

$logmsg = "Deleted ClientSpecialInstructionsTBL records for MEDPAL '$ClientID'";
$shortmsg = "";
$location = "";
$severity = 0;
LogErr($shortmsg, $logmsg, $location, $module, $severity);

//--------------------------------------------------------------------------------------------------
// delete from ClientSymptomTBL
//--------------------------------------------------------------------------------------------------
$sql = "DELETE from ClientSymptomTBL where ClientSymptomTBL.MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientSymptomTBL (999) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

$logmsg = "Deleted ClientSymptomTBL records for MEDPAL '$ClientID'";
$shortmsg = "";
$location = "";
$severity = 0;
LogErr($shortmsg, $logmsg, $location, $module, $severity);

//--------------------------------------------------------------------------------------------------
// delete from PhotoTBL and ClientTBL 
//--------------------------------------------------------------------------------------------------

// First get ClientTBL record to get PhotoTBL.ID
$sql = "SELECT * from ClientTBL where MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ClientTBL (996) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// Now lets process the result set 
$countRows = mysql_num_rows($sql_result);
if ($countRows != 1)
{
	$errmsg = " Error more or less then 1 rows returned in select on ClientTBL. count = '$countRows'  - MEDPAL =  '$ClientID'";
	$location = "";
	$severity = 0;	
	$shortmsg = "";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

$result_arr = mysql_fetch_assoc($sql_result);

$PhotoID = $result_arr[PhotoID];

// Now get UEL from PhotoID so we can delete photo
$sql = "SELECT URL from PhotoTBL where ID = '$PhotoID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for PhotoTBL (996) - '$PhotoID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// Now lets process the result set 
$countRows = mysql_num_rows($sql_result);
if ($countRows != 1)
{
	$errmsg = " Error more or less then 1 rows returned in select on PhotoTBL. count = '$countRows'  - PhotoID =  '$PhotoID'";
	$location = "";
	$severity = 0;	
	$shortmsg = "";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

$result_arr = mysql_fetch_assoc($sql_result);

$FileName = $result_arr[URL];

if (file_exists($FileName)) 
{
	$result = unlink($FileName);
	if (!$result)
	{
		$errmsg = "Error in unlinking file named '$FileName'";
		$location = "";
		$severity = 0;	
		$shortmsg = "";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	else
	{
		$errmsg = "Unlinked Photo file named '$FileName'";
		$location = "";
		$severity = 0;	
		$shortmsg = "";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
}	
else
{
	$errmsg = "Error. Can not find file named '$FileName'";
	$location = "";
	$severity = 0;	
	$shortmsg = "";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// Now we remove the dirctory
$tmpHold = explode("/", $FileName);
$tmpDir = sprintf("%s/%s", $tmpHold[0], $tmpHold[1]);

if (is_dir($tmpDir))
{
	if (!rmdir($tmpDir))
	{
		$errmsg = "Error. Could not remove directory named '$tmpDir'";
		$location = "";
		$severity = 0;	
		$shortmsg = "";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	else
	{
		$errmsg = "Removed directory named '$tmpDir'";
		$location = "";
		$severity = 0;	
		$shortmsg = "";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
}
else
{
	$errmsg = "Error. Can not find directory named '$tmpDir'";
	$location = "";
	$severity = 0;	
	$shortmsg = "";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

// Now we can delete the PhotoTBL
$sql = "DELETE from PhotoTBL where PhotoTBL.ID = '$PhotoID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on PhotoTBL (999) - '$PhotoID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// Now delete ClientTBL
$sql = "DELETE from ClientTBL where ClientTBL.MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientTBL (999) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

$logmsg = "Deleted ClientTBL PhotoTBL records for MEDPAL '$ClientID'";
$shortmsg = "";
$location = "";
$severity = 0;
LogErr($shortmsg, $logmsg, $location, $module, $severity);

//--------------------------------------------------------------------------------------------------
// delete from CalendarTBL and ClientVaccInocTBL
//--------------------------------------------------------------------------------------------------

// First set up loop to go through ClientVaccInocTBL and delete CalendarTBL
$sql = "SELECT * from ClientVaccInocTBL where MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ClientVaccInocTBL (996) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// Now lets process the result set 
while($result_arr = mysql_fetch_assoc($sql_result))
{
	$sql = "DELETE from CalendarTBL where CalendarTBL.ID = '$result_arr[CalendarID]'";

	if (!$sql_tmp_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query for delete on CalendarTBL (999) - '$ClientID'";
		$shortmsg = "";
		$location = "";
		$severity = 0;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	
}

// Now delete ClientVaccInocTBL
$sql = "DELETE from ClientVaccInocTBL where ClientVaccInocTBL.MEDPAL = '$ClientID'";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientVaccInocTBL (999) - '$ClientID'";
	$shortmsg = "";
	$location = "";
	$severity = 0;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

$logmsg = "Deleted ClientVaccInocTBL CalendarTBL records for MEDPAL '$ClientID'";
$shortmsg = "";
$location = "";
$severity = 0;
LogErr($shortmsg, $logmsg, $location, $module, $severity);

// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_clientFULLdelete.php?msgTxt=Deleted Client '$ClientID'.");

?>
