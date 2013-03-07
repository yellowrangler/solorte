<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'RQuprequest.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

// first check parms passed and date is valid
switch ($_POST[Action])
{
	case 'Add':
		//--------------------------------------------------------------------------------------------------
		// Add a Request
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// to add we must first make sure we have valid service dates 
		//--------------------------------------------------------------------------------------------------
		if (!ValiDate($_POST[sermonth], $_POST[serday], $_POST[seryear]) )
		{
			// error
			$errmsg = "Invalid+Date.+Please+try+again.";
			$location = "Location: if_RQuprequestdetail.php?msgTxt=$errmsg&requestid=";
			$shortmsg = "Invalid date.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
	
		//--------------------------------------------------------------------------------------------------
		// Build date for insert
		//--------------------------------------------------------------------------------------------------
		$tmpServiceDate = sprintf("%s-%02s-%02s", $_POST[seryear], $_POST[sermonth], $_POST[serday]);
		
		//--------------------------------------------------------------------------------------------------
		// validate service time if present
		//--------------------------------------------------------------------------------------------------
		$tmpServiceTime = "";
		if (! ( (empty($_POST[serhour])) and (empty($_POST[sermin])) ) )
		{
			if (!ValiTime($_POST[serhour], $_POST[sermin], $_POST[serampm]) )
			{
				// error
				$errmsg = "Invalid+Time.+Please+try+again.";
				$location = "Location: if_RQuprequestdetail.php?msgTxt=$errmsg&requestid=";
				$shortmsg = "Invalid time.";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}	
			
			//----------------------------------------------------------------------------------------------
			// Build service time for insert
			//----------------------------------------------------------------------------------------------
			$tmpServiceTimehold = $_POST[serhour];
			if (isPM($_POST[serampm]) )
			{
				$tmpServiceTimehold = $_POST[serhour] + 12;
			}
			
			$tmpServiceTime = sprintf("%02s:%02s:00", $tmpServiceTimehold, $_POST[sermin]);
		}
		
		//--------------------------------------------------------------------------------------------------
		// Build request date time stamp for insert
		//--------------------------------------------------------------------------------------------------
		$tmpDateTime = date("Y-m-d H:i:s");
		
		//--------------------------------------------------------------------------------------------------
		// Our request is really an event in waiting (pending is another term).  We start our new request 
		// by first creating a new entry into out ClientEventTBL giving it a status of 0.  We will fill as 
		// many fields as we can - leaving fullness of ClientEvent to evolve during request process.  After
		// succesful ClienEntry (which includes calendarTBL) we will create an entry in ClientRequestTBL
		// which will always show current request status; and we will make a History table entry to server
		// as a Client log.
		//--------------------------------------------------------------------------------------------------
		
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
			VALUES ('$tmpServiceDate', '$tmpServiceTime', '3')";
			
		if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query insert CalendarTBL (695) - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
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
				$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
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
				$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
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
				$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
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
				$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
				$shortmsg = "Unable to add add Diagnosis Information.";
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
				$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
				$shortmsg = "Unable to add add Diagnosis Information..";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}			
			
			//--------------------------------------------------------------------------------------------------
			// Second create ClientEventTBL entry.  We only add what is given.  The rest will default.
			// Note that current status MUST be set to 0!
			//--------------------------------------------------------------------------------------------------
			$sql = "INSERT INTO ClientEventTBL 
						(MEDPAL, EventTypeID, CalendarID, Event, ProviderID, HostID, DiagnosisID, CurrentStatus) 
						VALUES ('$Medpal',  '$_POST[eventtype]', '$NewCalendarID',  '$_POST[desc]', '$_POST[provider]', '$_POST[location]', '$NewDiagnosisID', '0')";
			
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query insert ClientEventTBL (695) - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
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
				$location = "Location: if_RQrequest.php?msgTxt=$errmsg&eventid=";
				$shortmsg = "Unable to add Medical Event record.";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
			
			//--------------------------------------------------------------------------------------------------
			// get ClientEvent id for ClientRequestTBL
			//--------------------------------------------------------------------------------------------------
			$NewClientEventID =  mysql_insert_id ($conn);
			if ($NewClientEventID == 0)
			{
				// error
				$errmsg = "Could not get Client Event ID. Please try again.";
				$location = "Location: if_RQrequest.php?msgTxt=$errmsg&eventid=";
				$shortmsg = "Unable to get Client Event ID.";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}	
			
			$sql = "INSERT INTO ClientRequestTBL 
						(MEDPAL, RequestDateTime, CurrentStatus, Request, ClientEventID)  
						VALUES ('$Medpal', '$tmpDateTime', '1', '$_POST[desc]', $NewClientEventID)";
						
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query insert ClientRequestTBL (695) - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
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
				$errmsg = "Unable to Add Request. Please try again. Request Insert Failed.";
				$location = "Location: if_RQrequest.php?msgTxt=$errmsg";
				$shortmsg = "Unable to add Request.";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
			
			//--------------------------------------------------------------------------------------------------
			// get ClientRequestTBL id for ClientRequestHistoryTBL
			//--------------------------------------------------------------------------------------------------
			$NewRequestID =  mysql_insert_id ($conn);
			if ($NewRequestID == 0)
			{
				// error
				$errmsg = "Could not get Request ID. Please try again.";
				$location = "Location: if_RQrequest.php?msgTxt=$errmsg";
				$shortmsg = "Unable to add Request.";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}	
			
			//--------------------------------------------------------------------------------------------------
			// Second create ClientRequestHistoryTBL entry.  
			//--------------------------------------------------------------------------------------------------
			$sql = "INSERT INTO ClientRequestHistoryTBL 
						(MEDPAL, RequestID, RequestHistDateTime, RequestStatus) 
						VALUES ('$Medpal', '$NewRequestID', '$tmpDateTime', '1')";
			
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query insert ClientRequestHistoryTBL (695) - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
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
				$errmsg = "Unable to Add Request History. Please try again. Insert Failed.";
				$location = "Location: if_RQrequest.php?msgTxt=$errmsg";
				$shortmsg = "Unable to add Request History.";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
			
			$DisplayID = $NewRequestID;
			$DisplayMsg = "Request successfully Added.";
		//--------------------------------------------------------------------------------------------------
		// end of Add 
		//--------------------------------------------------------------------------------------------------
		break;
		
	case 'Update':
		//--------------------------------------------------------------------------------------------------
		// Update a Request. 
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// if id to update not passed in then error
		//--------------------------------------------------------------------------------------------------
		if (!isset($_POST[requestid]))
		{
			// error
			$errmsg = "Error doing update for sql. no requestid requestid= '$_POST[requestid]' (595) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------
		// First make sure we have valid service date 
		//--------------------------------------------------------------------------------------------------
		if (!ValiDate($_POST[sermonth], $_POST[serday], $_POST[seryear]) )
		{
			// error
			$errmsg = "Invalid+Date.+Please+try+again.";
			$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
			$shortmsg = "Invalid Date.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
	
		//--------------------------------------------------------------------------------------------------
		// Build date for update
		//--------------------------------------------------------------------------------------------------
		$tmpServiceDate = sprintf("%s-%02s-%02s", $_POST[seryear], $_POST[sermonth], $_POST[serday]);
		
		//--------------------------------------------------------------------------------------------------
		// validate service time if present
		//--------------------------------------------------------------------------------------------------
		$tmpServiceTime = "";
		if (! ( (empty($_POST[serhour])) and (empty($_POST[sermin])) ) )
		{
			if (!ValiTime($_POST[serhour], $_POST[sermin], $_POST[serampm]) )
			{
				// error
				$errmsg = "Invalid+Time.+Please+try+again.";
				$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
				$shortmsg = "Invalid Time.";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}	
			
			//----------------------------------------------------------------------------------------------
			// Build service time for insert
			//----------------------------------------------------------------------------------------------
			$tmpServiceTimehold = $_POST[serhour];
			if (isPM($_POST[serampm]) )
			{
				$tmpServiceTimehold = $_POST[serhour] + 12;
			}
			
			$tmpServiceTime = sprintf("%02s:%02s:00", $tmpServiceTimehold, $_POST[sermin]);
		}
		
		//--------------------------------------------------------------------------------------------------
		// Build request date time stamp for insert
		//--------------------------------------------------------------------------------------------------
		$tmpDateTime = date("Y-m-d H:i:s");
		
		//--------------------------------------------------------------------------------------------------
		// get ClientEventID and CalendarID from client app tbl
		//--------------------------------------------------------------------------------------------------
		$sql = "SELECT ClientEventID, CalendarID, DiagnosisID
			from ClientRequestTBL
			left join ClientEventTBL on ClientRequestTBL.ClientEventID = ClientEventTBL.ID
				where ( ClientRequestTBL.ID = '$_POST[requestid]' and ClientRequestTBL.MEDPAL = '$Medpal' )";
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for ClientRequestTBL/ClientEventTBL (795) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
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
			$errmsg = "Can+not+find+Request.+Please+try+again.";
			$location = "Location: if_RQuprequestdetail.php?msgTxt=$errmsg&appid=$_POST[appid]";
			$shortmsg = "Unable to find Request.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// get calendartblid from clientevent tbl
		//--------------------------------------------------------------------------------------------------
		$result_arr = mysql_fetch_assoc($sql_result);
		
		$wrkClientEventID = $result_arr[ClientEventID];
		$wrkCalendarID = $result_arr[CalendarID];
		$wrkDiagnosisID = $result_arr[DiagnosisID];
		
		//--------------------------------------------------------------------------------------------------
		// Now it is time to update CalendarTBL, ClientEventTBL, ClientRequestTBL and ClientRequestHistory 
		// records. We only add what is given.  The rest will default.
		//--------------------------------------------------------------------------------------------------
		$sql = "UPDATE CalendarTBL 
					set StartDate = '$tmpServiceDate', StartTime = '$tmpServiceTime'
					where ( CalendarTBL.ID = '$wrkCalendarID')"; 
				
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query update calendar (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// Now it is time to update Diagnosis tbl.  We only update what is given. 
		//--------------------------------------------------------------------------------------------------
		if (is_null($wrkDiagnosisID))
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
				$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
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
				$location = "Location: if_RQuprequestdetail.php?msgTxt=$errmsg&eventid=$_POST[eventid]";
				$shortmsg = "Unable to add Diagnosis.";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
			
			//--------------------------------------------------------------------------------------------------
			// get calendar id for ClientEventTBL
			//--------------------------------------------------------------------------------------------------
			$wrkDiagnosisID =  mysql_insert_id ($conn);
			if ($wrkDiagnosisID == 0)
			{
				// error
				$errmsg = "Could not get Diagnosis ID. Please try again 2.";
				$location = "Location: if_RQuprequestdetail.php?msgTxt=$errmsg&eventid=$_POST[eventid]";
				$shortmsg = "Unable to add Diagnosis 2.";
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
						where ClientDiagnosisTBL.MEDPAL = '$Medpal' and ClientDiagnosisTBL.ID = '$wrkDiagnosisID'";
										
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query update ClientDiagnosisTBL (222) - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
		}
		
		//--------------------------------------------------------------------------------------------------
		// Now lets update the ClientEventTBL
		//--------------------------------------------------------------------------------------------------
		if ($_POST[status] == '12')
		{
			$wrkClientEventStatus = 1;
			$DisplayID = "";
		}
		else
		{
			$wrkClientEventStatus = 0;
			$DisplayID = $_POST[requestid];
		}	
		
		$sql = "UPDATE ClientEventTBL 
					set CurrentStatus = '$wrkClientEventStatus', Event = '$_POST[desc]', ProviderID = '$_POST[provider]',
					HostID = '$_POST[location]', EventTypeID = '$_POST[eventtype]', DiagnosisID = '$wrkDiagnosisID'
					where ( ClientEventTBL.ID = '$wrkClientEventID' and ClientEventTBL.MEDPAL = '$Medpal')"; 
				
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query update ClientEventTBL (778) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// Now lets update the ClientRequestTBL
		//--------------------------------------------------------------------------------------------------
		$sql = "UPDATE ClientRequestTBL 
					set CurrentStatus = '$_POST[status]', Request = '$_POST[desc]', Comments = '$_POST[comments]'
					where ( ClientRequestTBL.ID = '$_POST[requestid]' and ClientRequestTBL.MEDPAL = '$Medpal' )"; 
				
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query update ClientRequestTBL (778) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// Second create ClientRequestHistoryTBL entry.  
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO ClientRequestHistoryTBL 
					(MEDPAL, RequestID, RequestHistDateTime, RequestStatus) 
					VALUES ('$Medpal', '$_POST[requestid]', '$tmpDateTime', '$_POST[status]')";
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert ClientRequestHistoryTBL (795) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
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
			$errmsg = "Unable to Add Request History. Please try again. Insert Failed.";
			$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
			$shortmsg = "Unable to add Request History.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		$DisplayMsg = "Request successfully Updated. Request History Added.";
		
		//--------------------------------------------------------------------------------------------------
		// end of Update 
		//--------------------------------------------------------------------------------------------------
		break;
		
	case 'Delete':
		//--------------------------------------------------------------------------------------------------
		// Delete a Request
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// if id to delete not passed in then error
		//--------------------------------------------------------------------------------------------------
		if (!isset($_POST[requestid]))
		{
			// error
			$errmsg = "Error doing delete before sql. no requestid. requestid= '$_POST[requestid]' (595) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------
		// get ClientEventID and CalendarID from client app tbl
		//--------------------------------------------------------------------------------------------------
		$sql = "SELECT ClientEventID, CalendarID, DiagnosisID
			from ClientRequestTBL
			left join ClientEventTBL on ClientRequestTBL.ClientEventID = ClientEventTBL.ID
				where ( ClientRequestTBL.ID = '$_POST[requestid]' and ClientRequestTBL.MEDPAL = '$Medpal' )";
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - (Delete) Error doing mysql_query for ClientRequestTBL/ClientEventTBL (795) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
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
			$errmsg = "Can+not+find+Request.+Please+try+again.";
			$location = "Location: if_RQuprequestdetail.php?msgTxt=$errmsg&appid=$_POST[appid]";
			$shortmsg = "Unable to find Request.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// get calendartblid from clientevent tbl
		//--------------------------------------------------------------------------------------------------
		$result_arr = mysql_fetch_assoc($sql_result);
		
		$wrkClientEventID = $result_arr[ClientEventID];
		$wrkCalendarID = $result_arr[CalendarID];
	
		//--------------------------------------------------------------------------------------------------
		// first delete from CalendarTBL
		//--------------------------------------------------------------------------------------------------
		$sql = "DELETE from CalendarTBL where CalendarTBL.ID = '$wrkCalendarID'";
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for delete on CalendarTBL (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
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
			$errmsg = "Error doing delete for CalendarTBL. rows affected = '$affRows'. (996)  Too many or too few rows - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
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
			$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// build sql statement to delete any scaned documents in EventScanTBL
		//--------------------------------------------------------------------------------------------------
		$sql = "DELETE from EventScanTBL where EventScanTBL.ClientEventID = '$result_arr[ClientEventID]'";
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for delete on EventScanTBL (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// first delete from ClientEventTBL
		//--------------------------------------------------------------------------------------------------
		$sql = "DELETE from ClientEventTBL 
			where (ClientEventTBL.ID = '$wrkClientEventID' and ClientEventTBL.MEDPAL = '$Medpal')";
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientEventTBL (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
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
			$errmsg = "Error doing delete for ClientEventTBL. rows affected = '$affRows'. (996)  Too many or too few rows - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
				
		//--------------------------------------------------------------------------------------------------
		// Delete from ClientRequestTBL
		//--------------------------------------------------------------------------------------------------
		$sql = "DELETE from ClientRequestTBL 
			where ( ClientRequestTBL.ID = '$_POST[requestid]' and ClientRequestTBL.MEDPAL = '$Medpal' )"; 
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientRequestTBL (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
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
			$errmsg = "Error doing delete for ClientRequestTBL.  rows affected = '$affRows'. (996)  Too many or too few rows - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// build sql statement to delete all RequestHistoryTBL related records
		//--------------------------------------------------------------------------------------------------
		$sql = "DELETE from ClientRequestHistoryTBL 
			where ClientRequestHistoryTBL.RequestID = '$_POST[requestid]' and ClientRequestHistoryTBL.MEDPAL = '$Medpal'";
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientRequestHistoryTBL (694) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_RQuprequestdetail.php?requestid=$_POST[requestid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		$DisplayMsg = "All related Client Request and History records successfully Deleted.";
		$DisplayID = "";
		
		//--------------------------------------------------------------------------------------------------
		// end of Delete 
		//--------------------------------------------------------------------------------------------------
		break;
			
	default:
		if (isset($_POST[requestid]) and ($_POST[requestid] != ""))
			$DisplayID = $_POST[requestid];
		else
			$DisplayID = "";
			
		$DisplayMsg = "No action selected.  Please select Add, Update or Delete from action list.";
		break;
		
} // end of switch
		
//--------------------------------------------------------------------------------------------------
// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_RQuprequestdetail.php?msgTxt=$DisplayMsg&requestid=$DisplayID");

?>
