<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'UAmedhist.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

// first check parms passed and date is valid
switch ($_POST[Action])
{
	case 'Add':
		//--------------------------------------------------------------------------------------------------
		// Add an Event
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// to add we must first make sure we have valid dates 
		//--------------------------------------------------------------------------------------------------
		if (!ValiDate($_POST[month], $_POST[day], $_POST[year]) )
		{
			// error
			$errmsg = "Invalid+Date.+Please+try+again.";
			$location = "Location: if_UAmedhistdetail.php?eventid=";
			$shortmsg = "Invalid Date.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
	
		//--------------------------------------------------------------------------------------------------
		// Build date for insert
		//--------------------------------------------------------------------------------------------------
		$tmpdate = sprintf("%s-%02s-%02s", $_POST[year], $_POST[month], $_POST[day]);
		
		//----------------------------------------------------------------------------------------------
		// Build time for insert
		//----------------------------------------------------------------------------------------------
		$tmpTimehold = $_POST[hour];
		if (isPM($_POST[ampm]) )
		{
			$tmpServiceTimehold = $_POST[hour] + 12;
		}
		
		$tmpTime = sprintf("%02s:%02s:00", $tmpServiceTimehold, $_POST[min]);

		//--------------------------------------------------------------------------------------------------
		// Now it is time to insert a calender event
		//
		// First create calendartbl entry.  After successfull insert we must get auto increment id
		// to add to ClientEventTBL.  Then we will create a ClientDiagnosisTBL entry and again get the 
		// ID so theat it too can be added to ClientEventTBL. We only add what is given.  The rest 
		// will default.
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO CalendarTBL 
					(StartDate, StartTime, AppType)  
					VALUES ('$tmpdate', '3', $tmpTime)";
					
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert calendar (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedhistdetail.php?eventid=$_POST[eventid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// Now lets review the results  
		//--------------------------------------------------------------------------------------------------
		$affRows = mysql_affected_rows($conn);
		if ($affRows != 1)
		{
			// error
			$errmsg = "Unable to add Event date. Please try again. Insert Failed.";
			$location = "Location: if_UAmedhistdetail.php?eventid=";
			$shortmsg = "Unable to add Event date.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// get calendar id for ClientEventTBL
		//--------------------------------------------------------------------------------------------------
		$NewCalendarID =  mysql_insert_id ($conn);
		if ($NewCalendarID == 0)
		{
			// error
			$errmsg = "Could+not+get+Calendar+ID.+Please+try+again.";
			$location = "Location: if_UAmedhistdetail.php?eventid=";
			$shortmsg = "Unable to add Event date.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------
		// Next create ClientDiagnosisTBL entry.  After successfull insert we must get auto increment id
		// to add to ClientEventTBL.  We only add what is given.  The rest will default.
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO ClientDiagnosisTBL 
					(MEDPAL, ICD9Code, ICD9Text)  
					VALUES ('$Medpal', '$_POST[icd]', '$_POST[diag]')";
					
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert ClientDiagnosisTBL (777) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedhistdetail.php?eventid=$_POST[eventid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// Now lets review the results  
		//--------------------------------------------------------------------------------------------------
		$affRows = mysql_affected_rows($conn);
		if ($affRows != 1)
		{
			// error
			$errmsg = "Unable to add Diagnosis Information. Please try again. Insert Failed.";
			$location = "Location: if_UAmedhistdetail.php?eventid=";
			$shortmsg = "Unable to add Diagnosis info.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// get diagnosis id for ClientEventTBL
		//--------------------------------------------------------------------------------------------------
		$NewDiagnosisID =  mysql_insert_id ($conn);
		if ($NewDiagnosisID == 0)
		{
			// error
			$errmsg = "Could not get Diagnosis ID. Please try again.";
			$location = "Location: if_UAmedhistdetail.php?eventid=";
			$shortmsg = "Unable to add Diagnosis info.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		
		//--------------------------------------------------------------------------------------------------
		// Second create ClientEventTBL entry.  We only add what is given.  The rest will default.
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO ClientEventTBL 
					(MEDPAL, EventTypeID, CalendarID, Event, ProviderID, HostID, DiagnosisID, CurrentStatus) 
					VALUES ('$Medpal',  '$_POST[eventtype]', '$NewCalendarID',  '$_POST[desc]', '$_POST[provider]', '$_POST[hosts]', '$NewDiagnosisID', '1')";

		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert ClientEventTBL (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedhistdetail.php?eventid=$_POST[eventid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// Now lets process the result set 
		//--------------------------------------------------------------------------------------------------
		$affRows = mysql_affected_rows($conn);
		if ($affRows != 1)
		{
			// error
			$errmsg = "Unable to add Medical Event record.+Please+try+again.+Insert+Client+Event+Failed.";
			$location = "Location: if_UAmedhistdetail.php?eventid=";
			$shortmsg = "Unable to add Medical Event record.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		$tmpNewID =  mysql_insert_id ($conn);
		
		//----------------------------------------------------------------------------------------------------------
		// Write to Access Log Table
		//----------------------------------------------------------------------------------------------------------
		AccessLogAdd("Medical Event successfully Added.", "Ok", $module, "", $conn);
		
		$DisplayID = $tmpNewID;
		$DisplayMsg = "Medical Event successfully Added.";
		
		//--------------------------------------------------------------------------------------------------
		// end of Add 
		//--------------------------------------------------------------------------------------------------
		break;
		
	case 'Update':
		//--------------------------------------------------------------------------------------------------
		// Update an Event. We will need to update CalendarTBL, ClientDiagnosisTBL and ClientEventTBL
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// if id to update not passed in then error
		//--------------------------------------------------------------------------------------------------
		if (!isset($_POST[eventid]))
		{
			// error
			$errmsg = "Error doing update for sql. no eventid eventid= '$_POST[eventid]' (595) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedhistdetail.php?eventid=$_POST[eventid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------
		// validate date and time
		//--------------------------------------------------------------------------------------------------
		if (!ValiDate($_POST[month], $_POST[day], $_POST[year]) )
		{
			// error
			$errmsg = "Invalid+Date.+Please+try+again.";
			$location = "Location: if_UAmedhistdetail.php?eventid=$_POST[eventid]";
			$shortmsg = "Invalid Date.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------
		// prepare the date for sql
		//--------------------------------------------------------------------------------------------------
		$tmpdate = sprintf("%s-%02s-%02s", $_POST[year], $_POST[month], $_POST[day]);
		//----------------------------------------------------------------------------------------------
		// Build time for insert
		//----------------------------------------------------------------------------------------------
		$tmpTimehold = $_POST[hour];
		if (isPM($_POST[ampm]) )
		{
			$tmpServiceTimehold = $_POST[hour] + 12;
		}
		
		$tmpTime = sprintf("%02s:%02s:00", $tmpServiceTimehold, $_POST[min]);

		//--------------------------------------------------------------------------------------------------
		// get calendarid and DiagnosisID from ClientEventTBL 
		//--------------------------------------------------------------------------------------------------
		$sql = "SELECT * from ClientEventTBL 
			where ( (MEDPAL = '$Medpal') and (ClientEventTBL.ID = '$_POST[eventid]') )";
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for ClientEventTBL (795) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedhistdetail.php?eventid=$_POST[eventid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// Lets now see if we have a match
		// if we do NOT it is an error
		//--------------------------------------------------------------------------------------------------
		$countRows = mysql_num_rows($sql_result);
		if ($countRows != 1) 
		{
			// error
			$errmsg = "Can+not+find+Event.+Please+try+again.";
			$location = "Location: if_UAmedhistdetail.php?eventid=$_POST[eventid]";
			$shortmsg = "Unable to find event.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// get calendartblid from ClientEventTBL
		//--------------------------------------------------------------------------------------------------
		$result_arr = mysql_fetch_assoc($sql_result);
		$tmpCalID = $result_arr[CalendarID];
		$tmpDiagID = $result_arr[DiagnosisID];
		
		//--------------------------------------------------------------------------------------------------
		// Now it is time to update calender event.  We only update what is given. 
		//--------------------------------------------------------------------------------------------------
		$sql = "UPDATE CalendarTBL set StartDate = '$tmpdate', StartTime = '$tmpTime', AppType = '3'
					where CalendarTBL.ID = '$tmpCalID'";
									
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query update calendar (235) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedhistdetail.php?eventid=$_POST[eventid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
	
		//--------------------------------------------------------------------------------------------------
		// Now it is time to update Diagnosis tbl.  We only update what is given. 
		//--------------------------------------------------------------------------------------------------
		if (is_null($tmpDiagID))
		{
			//--------------------------------------------------------------------------------------------------
			// If DianosisID is NULL then we need to add it 
			//--------------------------------------------------------------------------------------------------
			$sql = "INSERT INTO ClientDiagnosisTBL 
						(MEDPAL, ICD9Code, ICD9Text)  
						VALUES ('$Medpal', '$_POST[icd]', '$_POST[diag]')";
						
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query insert ClientDiagnosisTBL (789) - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "Location: if_UAmedhistdetail.php?eventid=$_POST[eventid]";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
			
			//--------------------------------------------------------------------------------------------------
			// Now lets review the results  
			//--------------------------------------------------------------------------------------------------
			$affRows = mysql_affected_rows($conn);
			if ($affRows != 1)
			{
				// error
				$errmsg = "Unable to add Diagnosis Information. Please try again. Insert Failed 2.";
				$location = "Location: if_UAmedhistdetail.php?eventid=$_POST[eventid]";
				$shortmsg = "Unable to add Diagnosis info.";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
			
			//--------------------------------------------------------------------------------------------------
			// get calendar id for ClientEventTBL
			//--------------------------------------------------------------------------------------------------
			$tmpDiagID =  mysql_insert_id ($conn);
			if ($tmpDiagID == 0)
			{
				// error
				$errmsg = "Could not get Diagnosis ID. Please try again 2.";
				$location = "Location: if_UAmedhistdetail.php?eventid=$_POST[eventid]";
				$shortmsg = "Unable to add Diagnosis info.";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}	
		}
		else
		{
			//--------------------------------------------------------------------------------------------------
			// If DianosisID is NOT NULL then we need to UPDATE it 
			//--------------------------------------------------------------------------------------------------
			$sql = "UPDATE ClientDiagnosisTBL set ICD9Code = '$_POST[icd]',  ICD9Text = '$_POST[diag]'
						where ClientDiagnosisTBL.MEDPAL = '$Medpal' and ClientDiagnosisTBL.ID = '$tmpDiagID'";
										
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query update ClientDiagnosisTBL (222) - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "Location: if_UAmedhistdetail.php?eventid=$_POST[eventid]";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
		}
			
		//--------------------------------------------------------------------------------------------------
		// Next lets update ClientEventTBL
		//--------------------------------------------------------------------------------------------------
		$sql = "UPDATE ClientEventTBL 
					set Event = '$_POST[desc]', EventTypeID = '$_POST[eventtype]', ProviderID = '$_POST[provider]', HostID = '$_POST[hosts]', DiagnosisID = '$tmpDiagID'
					where (MEDPAL = '$Medpal' and ClientEventTBL.ID = '$_POST[eventid]')";		
					
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query update ClientEventTBL (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedhistdetail.php?eventid=$_POST[eventid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
	
		//----------------------------------------------------------------------------------------------------------
		// Write to Access Log Table
		//----------------------------------------------------------------------------------------------------------
		AccessLogAdd("Medical Event successfully Updated.", "Ok", $module, "", $conn);
		
		$DisplayID = $_POST[eventid];
		$DisplayMsg = "Medical Event successfully Updated.";
		
		//--------------------------------------------------------------------------------------------------
		// end of Update 
		//--------------------------------------------------------------------------------------------------
		break;
		
	case 'Delete':
		//--------------------------------------------------------------------------------------------------
		// Delete an Event
		//
		// to delete we must get Eventid and CalendarID to delete if no eventid error.  We must also look to
		// see if there are any scanned images asociated with these events and if they are they too
		// must be deleted (Not the actual images them selves just links to them in EventScanTBL 
		// (Note to self: we must have table whose sole purpose is to point to orphaned images)
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// if id to delete not passed in then error
		//--------------------------------------------------------------------------------------------------
		if (!isset($_POST[eventid]))
		{
			// error
			$errmsg = "Error doing delete before sql. no eventid. eventid= '$_POST[eventid]' (595) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedhistdetail.php?eventid=$_POST[eventid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------
		// build sql statement to get CalendarID and DiagnosisID
		//--------------------------------------------------------------------------------------------------
		$sql = "SELECT * from ClientEventTBL 
			where ( (MEDPAL = '$Medpal') and (ClientEventTBL.ID = '$_POST[eventid]') )";
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for ClientEventTBL (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedhistdetail.php?eventid=$_POST[eventid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// Now lets process the result set 
		//--------------------------------------------------------------------------------------------------
		$countRows = mysql_num_rows($sql_result);
		if ($countRows == 1) 
		{
			$result_arr = mysql_fetch_assoc($sql_result);
		}
		else
		{
			// error
			$errmsg = "Error doing mysql_query for ClientEventTBL join ClientEventTB. (996)  Too many or too few rows countrow = '$countRows' - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedhistdetail.php?eventid=$_POST[eventid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// Delete from CalendarTBL
		//--------------------------------------------------------------------------------------------------
		$sql = "DELETE from CalendarTBL where CalendarTBL.ID = '$result_arr[CalendarID]'";
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for delete on CalendarTBL (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedhistdetail.php?eventid=$_POST[eventid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// now check that only 1 row was effected
		//--------------------------------------------------------------------------------------------------
		$affRows = mysql_affected_rows($conn);
		if ($affRows != 1)
		{
			// error
			$errmsg = "Error doing delete for CalendarTBL.  rows affected = '$affRows'. (996)  Too many or too few rows - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedhistdetail.php?eventid=$_POST[eventid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// build sql statement to delete any diagnosis info in ClientDiagnosisTBL
		//--------------------------------------------------------------------------------------------------
		$sql = "DELETE from ClientDiagnosisTBL where ClientDiagnosisTBL.ID = '$result_arr[DiagnosisID]'";
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientDiagnosisTBL (694) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedhistdetail.php?eventid=$_POST[eventid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// build sql statement to delete any scaned documents in EventScanTBL
		//--------------------------------------------------------------------------------------------------
		$sql = "DELETE from EventScanTBL where EventScanTBL.ClientEventID = '$result_arr[ID]'";
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for delete on EventScanTBL (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedhistdetail.php?eventid=$_POST[eventid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// For ClientDiagnosisTBL and EventScanTBL
		// I am not going to check for success because I did not check to see if there were any to begin 
		// with.  I will assume that if the SQL finished without error then everything is OkDokay
		//--------------------------------------------------------------------------------------------------
	
		//--------------------------------------------------------------------------------------------------
		// next delete from ClientEventTBL
		//--------------------------------------------------------------------------------------------------
		$sql = "DELETE from ClientEventTBL where ClientEventTBL.ID = '$_POST[eventid]'";
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientEventTBL (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedhistdetail.php?eventid=$_POST[eventid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// now check that only 1 row was effected
		//--------------------------------------------------------------------------------------------------
		$affRows = mysql_affected_rows($conn);
		if ($affRows != 1)
		{
			// error
			$errmsg = "Error doing delete for ClientEventTBL.  rows affected = '$affRows'. (996)  Too many or too few rows. - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedhistdetail.php?eventid=$_POST[eventid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//----------------------------------------------------------------------------------------------------------
		// Write to Access Log Table
		//----------------------------------------------------------------------------------------------------------
		AccessLogAdd("Medical Event successfully Deleted.", "Ok", $module, "", $conn);
		
		$DisplayMsg = "Medical Event successfully Deleted.";
		$DisplayID = "";
		
		//--------------------------------------------------------------------------------------------------
		// end of Delete 
		//--------------------------------------------------------------------------------------------------
		break;
			
	default:
		if (isset($_POST[eventid]) and ($_POST[eventid] != ""))
			$DisplayID = $_POST[eventid];
		else
			$DisplayID = "";
			
		$DisplayMsg = "No action selected.  Please select Add, Update or Delete from action list.";
		break;
		
} // end of switch
		
//--------------------------------------------------------------------------------------------------
// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_UAmedhistdetail.php?msgTxt=$DisplayMsg&eventid=$DisplayID");

?>
