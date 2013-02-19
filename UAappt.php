<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'UAappt.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

// first check parms passed and date is valid
switch ($_POST[Action])
{
	case 'Add':
		//--------------------------------------------------------------------------------------------------
		// Add a prescription
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// to add we must first make sure we have valid dates 
		// and then make sure this is not a duplicate
		//
		// validate date and time
		//--------------------------------------------------------------------------------------------------
		if (!ValiDate($_POST[appmonth], $_POST[appday], $_POST[appyear]) )
		{
			// error
			$errmsg = "Invalid+Date.+Please+try+again.";
			$location = "Location: if_UAmedappdetail.php?appid=";
			$shortmsg = "Invalid Date.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		if (!ValiTime($_POST[apphour], $_POST[appmin], $_POST[appampm]) )
		{
			// error
			$errmsg = "Invalid+Time.+Please+try+again.";
			$location = "Location: if_UAmedappdetail.php?appid=";
			$shortmsg = "Invalid Time.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
	
		//--------------------------------------------------------------------------------------------------
		// validate that appointment for same day time is not already present
		//--------------------------------------------------------------------------------------------------
		$tmpdate = sprintf("%s-%02s-%02s", $_POST[appyear], $_POST[appmonth], $_POST[appday]);
		
		$tmptimehold = $_POST[apphour];
		if (isPM($_POST[appampm]) )
		{
			$tmptimehold = $_POST[apphour] + 12;
		}
		
		$tmptime = sprintf("%02s:%02s:00", $tmptimehold, $_POST[appmin]);
		
		$sql = "SELECT * from ClientAppointmentTBL inner join CalendarTBL on ClientAppointmentTBL.CalendarID = CalendarTBL.ID
			where ( (MEDPAL = '$Medpal') and (CalendarTBL.StartDate = '$tmpdate' and CalendarTBL.StartTime = '$tmptime') )";
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for client appointment (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedappdetail.php?appid=$_POST[appid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// Lets now see if we have a match
		// if we do it is an error
		//--------------------------------------------------------------------------------------------------
		$countRows = mysql_num_rows($sql_result);
		if ($countRows > 0) 
		{
			// error
			$errmsg = "Already+have+appointment+for+that+date+and+time.+Please+try+again.";
			$location = "Location: if_UAmedappdetail.php?appid=";
			$shortmsg = "Duplicate appointment time and date.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// Now it is time to insert both a calender event and a client appointment
		//
		// first create calendartbl entry.  after successfull insert we must get auto increment id
		// to add to clientappointmenttnl.  We only add what is given.  The rest will default.
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO CalendarTBL 
					(StartDate, StartTime, AppType)  
					VALUES ('$tmpdate', '$tmptime', '1')";
					
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert calendar (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedappdetail.php?appid=$_POST[appid]";
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
			$errmsg = "Already+have+appointment+for+that+date+and+time.+Please+try+again.+Insert+Failed.";
			$location = "Location: if_UAmedappdetail.php?appid=";
			$shortmsg = "Duplicate appointment time and date.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// get calendar id for clientappointmenttbl
		//--------------------------------------------------------------------------------------------------
		$NewCalendarID =  mysql_insert_id ($conn);
		if ($NewCalendarID == 0)
		{
			// error
			$errmsg = "Could+not+get+Calendar+ID.+Please+try+again.";
			$location = "Location: if_UAmedappdetail.php?appid=";
			$shortmsg = "Unable to save appointment.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------
		// Second create clientappointmenttbl entry.  We only add what is given.  The rest will default.
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO ClientAppointmentTBL 
					(MEDPAL, CalendarID, Appointment, ProviderID, HostID, EventTypeID) 
					VALUES ('$Medpal', '$NewCalendarID', '$_POST[appdesc]', '$_POST[approvider]', '$_POST[applocation]', '$_POST[eventtype]')";

		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert clientappointmenttbl (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedappdetail.php?appid=$_POST[appid]";
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
			$errmsg = "Already+have+appointment+for+that+date+and+time.+Please+try+again.+Insert+Client+App+Failed.";
			$location = "Location: if_UAmedappdetail.php?appid=";
			$shortmsg = "Duplicate appointment for date and timet.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		$tmpappID = mysql_insert_id ($conn);
		
		//----------------------------------------------------------------------------------------------------------
		// Write to Access Log Table
		//----------------------------------------------------------------------------------------------------------
		AccessLogAdd("Appointment successfully Added", "Ok", $module, "", $conn);
		
		$DisplayID =  $tmpappID;
		$DisplayMsg = "Appointment+successfully+Added.";
		
		//--------------------------------------------------------------------------------------------------
		// end of Add 
		//--------------------------------------------------------------------------------------------------
		break;
		
	case 'Update':
		//--------------------------------------------------------------------------------------------------
		// Update an Appointment
		//
		// to update we must first make sure we have id then valid dates 
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// if id to update not passed in then error
		//--------------------------------------------------------------------------------------------------
		if (!isset($_POST[appid]))
		{
			// error
			$errmsg = "Error doing update for sql. no appid appid= '$_POST[appid]' (595) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedappdetail.php?appid=$_POST[appid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------
		// validate date and time
		//--------------------------------------------------------------------------------------------------
		if (!ValiDate($_POST[appmonth], $_POST[appday], $_POST[appyear]) )
		{
			// error
			$errmsg = "Invalid+Date.+Please+try+again.";
			$location = "Location: if_UAmedappdetail.php?appid=$_POST[appid]";
			$shortmsg = "Invalid Date.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		if (!ValiTime($_POST[apphour], $_POST[appmin], $_POST[appampm]) )
		{
			// error
			$errmsg = "Invalid+Time.+Please+try+again.";
			$location = "Location: if_UAmedappdetail.php?appid=$_POST[appid]";
			$shortmsg = "Invalid Time.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
	
		//--------------------------------------------------------------------------------------------------
		// validate that appointment for same day time is not already present
		//--------------------------------------------------------------------------------------------------
		$tmpdate = sprintf("%s-%02s-%02s", $_POST[appyear], $_POST[appmonth], $_POST[appday]);

		$tmptimehold = $_POST[apphour];
		if (isPM($_POST[appampm]) )
		{
			$tmptimehold = $_POST[apphour] + 12;
		}
		
		$tmptime = sprintf("%02s:%02s:00", $tmptimehold, $_POST[appmin]);
	
		//--------------------------------------------------------------------------------------------------
		// get calendarid from client app tbl
		//--------------------------------------------------------------------------------------------------
		$sql = "SELECT * from ClientAppointmentTBL 
			where ( (MEDPAL = '$Medpal') and (ClientAppointmentTBL.ID = '$_POST[appid]') )";
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for client appointment (795) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedappdetail.php?appid=$_POST[appid]";
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
			$errmsg = "Can+not+find+Appointment.+Please+try+again.";
			$location = "Location: if_UAmedappdetail.php?appid=$_POST[appid]";
			$shortmsg = "Unable to find appointment.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// get calendartblid from clientapp tbl
		//--------------------------------------------------------------------------------------------------
		$result_arr = mysql_fetch_assoc($sql_result);
		$tmpCalID = $result_arr[CalendarID];
		
		//--------------------------------------------------------------------------------------------------
		// Now it is time to update both a calender event and a client appointment
		//
		// first update calendartbl entry.  We only update what is given. 
		//--------------------------------------------------------------------------------------------------
		$sql = "UPDATE CalendarTBL set StartDate = '$tmpdate', StartTime ='$tmptime', AppType = '1'
					where CalendarTBL.ID = '$tmpCalID'";
									
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query update calendar (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedappdetail.php?appid=$_POST[appid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// now lets update clientappointmenttbl
		//--------------------------------------------------------------------------------------------------
		$sql = "UPDATE ClientAppointmentTBL 
					set Appointment = '$_POST[appdesc]', ProviderID = '$_POST[approvider]', 
					HostID = '$_POST[applocation]', EventTypeID ='$_POST[eventtype]'
					where (MEDPAL = '$Medpal' and ClientAppointmentTBL.ID = '$_POST[appid]')";		
									
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query update clientappointment (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedappdetail.php?appid=$_POST[appid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
	
		//----------------------------------------------------------------------------------------------------------
		// Write to Access Log Table
		//----------------------------------------------------------------------------------------------------------
		AccessLogAdd("Appointment successfully Updated", "Ok", $module, "", $conn);
		
		$DisplayID = $_POST[appid];
		$DisplayMsg = "Appointment+successfully+Updated.";
		
		//--------------------------------------------------------------------------------------------------
		// end of Update 
		//--------------------------------------------------------------------------------------------------
		break;
		
	case 'Delete':
		//--------------------------------------------------------------------------------------------------
		// Delete an appointment
		//
		// to delete we must get Appid and CalendarID to delete if no appid error
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// if id to delete not passed in then error
		//--------------------------------------------------------------------------------------------------
		if (!isset($_POST[appid]))
		{
			// error
			$errmsg = "Error doing delete before sql. no appid. appid= '$_POST[appid]' (595) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedappdetail.php?appid=$_POST[appid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------
		// build sql statement to get calenderid
		//--------------------------------------------------------------------------------------------------
		$sql = "SELECT * from ClientAppointmentTBL inner join CalendarTBL on ClientAppointmentTBL.CalendarID = CalendarTBL.ID
			where ( (MEDPAL = '$Medpal') and (ClientAppointmentTBL.ID = '$_POST[appid]') )";
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for client appointment (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedappdetail.php?appid=$_POST[appid]";
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
			$errmsg = "Error doing mysql_query for client appointment. (996)  Too many or too few rows countrow = '$countRows' - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedappdetail.php?appid=$_POST[appid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// first delete from calendartbl
		//--------------------------------------------------------------------------------------------------
		$sql = "DELETE from CalendarTBL where CalendarTBL.ID = '$result_arr[CalendarID]'";
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for delete on calendartbl (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedappdetail.php?appid=$_POST[appid]";
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
			$errmsg = "Error doing delete for caltbl.  rows affected = '$affRows'. (996)  Too many or too few rows - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedappdetail.php?appid=$_POST[appid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// next delete from clientappointmenttbl
		//--------------------------------------------------------------------------------------------------
		$sql = "DELETE from ClientAppointmentTBL where ClientAppointmentTBL.ID = '$_POST[appid]'";
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for delete on clientapttbl (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedappdetail.php?appid=$_POST[appid]";
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
			$errmsg = "Error doing delete for client app tbl.  rows affected = '$affRows'. (996)  Too many or too few rows. - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedappdetail.php?appid=$_POST[appid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//----------------------------------------------------------------------------------------------------------
		// Write to Access Log Table
		//----------------------------------------------------------------------------------------------------------
		AccessLogAdd("Appointment successfully Deleted", "Ok", $module, "", $conn);
		
		$DisplayMsg = "Appointment+successfully+Deleted.";
		$DisplayID = "";
		
		//--------------------------------------------------------------------------------------------------
		// end of Delete 
		//--------------------------------------------------------------------------------------------------
		break;
		
	default:
		if (isset($_POST[appid]) and ($_POST[appid] != ""))
			$DisplayID = $_POST[appid];
		else
			$DisplayID = "";
			
		$DisplayMsg = "No action selected.";
		break;
			
} // end of switch
		
//--------------------------------------------------------------------------------------------------
// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_UAmedappdetail.php?msgTxt=$DisplayMsg&appid=$DisplayID");

?>
