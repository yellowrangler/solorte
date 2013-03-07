<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'RQrequest.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

//--------------------------------------------------------------------------------------------------
// Add a Client Request
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// to add a request we must first make sure we have valid dates and times
//--------------------------------------------------------------------------------------------------
if (!ValiDate($_POST[month], $_POST[day], $_POST[year]) )
{
	// error
	$errmsg = "Invalid+Date.+Please+try+again.";
	$location = "Location: if_RQrequest.php";
	$shortmsg = "Invalid Date.";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

//--------------------------------------------------------------------------------------------------
// Build date for insert
//--------------------------------------------------------------------------------------------------
$tmpServiceDate = sprintf("%s-%02s-%02s", $_POST[year], $_POST[month], $_POST[day]);

//--------------------------------------------------------------------------------------------------
// validate service time if present
//--------------------------------------------------------------------------------------------------
$tmpServiceTime = "";
if (! ( (empty($_POST[serhour])) and (empty($_POST[sermin])) ) )
{
	if (!ValiTime($_POST[serhour], $_POST[sermin], $_POST[ampm]) )
	{
		// error
		$errmsg = "Invalid+Time.+Please+try+again.";
		$location = "Location: if_RQrequest.php";
		$shortmsg = "Invalid Time.";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	
	//--------------------------------------------------------------------------------------------------
	// validate and adjst  time
	//--------------------------------------------------------------------------------------------------
	$tmpServiceTimehold = $_POST[serhour];
	if (isPM($_POST[ampm]) )
	{
		$tmpServiceTimehold = $_POST[serhour] + 12;
	}
	
	//--------------------------------------------------------------------------------------------------
	// put date and time into insertable format
	//--------------------------------------------------------------------------------------------------
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
	$location = "Location: if_RQrequest.php";
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
	$location = "Location: if_RQrequest.php&eventid=";
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
	$location = "Location: if_RQrequest.php&eventid=";
	$shortmsg = "Unable to add Event date.";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

//--------------------------------------------------------------------------------------------------
// Second create ClientEventTBL entry.  We only add what is given.  The rest will default.
// Note that current status MUST be set to 0!
//--------------------------------------------------------------------------------------------------
$sql = "INSERT INTO ClientEventTBL 
			(MEDPAL, EventTypeID, CalendarID, Event, ProviderID, HostID, CurrentStatus) 
			VALUES ('$Medpal',  '$_POST[eventtype]', '$NewCalendarID',  '$_POST[desc]', '$_POST[provider]', '$_POST[location]', '0')";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query insert ClientEventTBL (695) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "Location: if_RQrequest.php";
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
	$location = "Location: if_RQrequest.php&eventid=";
	$shortmsg = "Unable to add Medical Event Record.";
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
	$location = "Location: if_RQrequest.php&eventid=";
	$shortmsg = "Unable to get client event id.";
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
	$location = "Location: if_RQrequest.php";
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
	$location = "Location: if_RQrequest.php";
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
	$location = "Location: if_RQrequest.php";
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
	$location = "Location: if_RQrequest.php";
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
	$location = "Location: if_RQrequest.php";
	$shortmsg = "Unable to add Request Histoty.";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

$DisplayID =  mysql_insert_id ($conn);
$DisplayMsg = "Request successfully Initiated. You can follow status of request via Outstanding Requets selection";

//--------------------------------------------------------------------------------------------------
// end of Add 
//--------------------------------------------------------------------------------------------------	

		
//--------------------------------------------------------------------------------------------------
// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_RQrequest.php?msgTxt=$DisplayMsg");

?>
