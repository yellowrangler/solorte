<?php

//---------------------------------------------------------------------------------------------------
// Function to Get start and end dates of current calendar
// Input: Timestamp
// Output: Array 0=startDate 1=endDate
//---------------------------------------------------------------------------------------------------
function GetCalendarStartEndDates($timestamp)
{
	// berak down date to get to first day of month
	$datePassed = getdate($timestamp);
	
	//---------------------------------------------------------------------------------------------------
	// this provides us with time stamp format date
	// by setting time to 0 and day to 1 with current year we will get a start date
	//---------------------------------------------------------------------------------------------------
	$timestampStart = mktime( 0, 0, 0, $datePassed[mon], 1, $datePassed[year]);
	
	//---------------------------------------------------------------------------------------------------
	// now we need to get end date so we want next months first day
	//---------------------------------------------------------------------------------------------------
	if ($datePassed[mon] == 12)
	{
		$endmonth = 1;
		$endyear = $datePassed[year] + 1;
	}
	else
	{
		$endmonth = $datePassed[mon] + 1;
		$endyear = $datePassed[year];
	}
	
	$timestampEnd = mktime( 0, 0, 0, $endmonth, 1, $endyear);
	
	//---------------------------------------------------------------------------------------------------
	// put timestamp into mysql date format
	//---------------------------------------------------------------------------------------------------
	$mysqlDateStart = date("Y-m-d", $timestampStart);
	$mysqlDateEnd = date("Y-m-d", $timestampEnd);
	
	$result = Array ($mysqlDateStart, $mysqlDateEnd);

	return($result);
	
} // End of Fuction

//---------------------------------------------------------------------------------------------------
// Function to buuild calendar
// Input: month year and event array (array with days of month marked Y or N)
// Output: Display Block to print
//---------------------------------------------------------------------------------------------------
function buildCalendar($month, $year, $eventArray)
{
	//-----------------------------------------------------------------------------------------------
	// First Initialize Days of the week
	//-----------------------------------------------------------------------------------------------
	$days = Array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");
	
	// What is the first day of the month in question? 
	$firstDayOfMonth = mktime(0,0,0,$month,1,$year); 
	
	// How many days does this month contain? 
	$numberDays = date('t',$firstDayOfMonth); 
	
	// Retrieve some information about the first day of the 
	// month in question. 
	$dateComponents = getdate($firstDayOfMonth); 
	 
	// What is the name of the month in question? 
	$monthName = $dateComponents['month']; 
	
	// What is the index value (0-6) of the first day of the 
	// month in question. 
	$dayOfWeek = $dateComponents['wday']; 
 	
	//-----------------------------------------------------------------------------------------------
	// Build Calendar Title Bar
	//-----------------------------------------------------------------------------------------------
	$DisplayCalendarBlock = "
	<table class=\"calendar\">
		<tr>
			<td align=center colspan=7 class=\"caption\"><b>$monthName - $year</b></td>
		</tr> 
	";
	
	// Build Days of week caption
	$DisplayCalendarBlock .= "\t<tr>\n";
	foreach ($days as $day) 
	{
		$DisplayCalendarBlock .= "\t\t<td class=\"header\" align=center>&nbsp;<b>$day</b>&nbsp;</td>\n";
	}	
	$DisplayCalendarBlock .= "\t</tr>\n";
	
	// Fill in Calendar
	$currentDay = 1; 
	
	$DisplayCalendarBlock .= "<tr>\n"; 
	
	//---------------------------------------------------------------------------------------------------------
	// The variable $dayOfWeek is used to 
	// ensure that the calendar 
	// display consists of exactly 7 columns. 
	//---------------------------------------------------------------------------------------------------------
	if ($dayOfWeek > 0) 
	{  
	  $DisplayCalendarBlock .= "<td colspan=$dayOfWeek>&nbsp;</td>\n";  
	} 
	 
	while ($currentDay <= $numberDays) 
	{ 
		// Get current time stamp for get
		$currentTimestamp = mktime(0, 0, 0, $month, $currentDay, $year);
		
		//-------------------------------------------------------
		// Seventh column (Saturday) reached. Start a new row. 
		//------------------------------------------------------
		if ($dayOfWeek == 7) 
		{ 
		   $dayOfWeek = 0; 
		   $DisplayCalendarBlock .= "</tr><tr>\n"; 
		} 
		 
		//------------------------------------------------------
		// Is the $currentDay a member of $dateArray? If so, 
		// the day should be linked. 
		//-------------------------------------------------------
	
		if ($eventArray[$currentDay] == 'Y') 
		{ 
			$DisplayCalendarBlock .= "\t\t<td align=center class=\"linkedday\">
				<a href=\"if_caldetail.php?timestamp=$currentTimestamp\" class=\"calendarlink\" target=\"detailFrame\">$currentDay</td>\n";
		} 
		else 
		{ 
			//-------------------------------------------------------
			// $currentDay is not a member of $dateArray. 
			//-------------------------------------------------------
		
		   	$DisplayCalendarBlock .= "\t\t<td align=center class=\"day\">$currentDay</td>\n";
		} 
		  
		//-------------------------------------------------------
		// Increment counters 
		//-------------------------------------------------------
		$currentDay++; 
		$dayOfWeek++; 
		
	} 

	//---------------------------------------------------------------------
    // Complete the row of the last week in month, if necessary 
	//---------------------------------------------------------------------
    if ($dayOfWeek != 7) 
	{  
      
          $remainingDays = 7 - $dayOfWeek; 
          $DisplayCalendarBlock .= "\t\t<td colspan=$remainingDays>&nbsp;</td>\n";  
    } 
	
	$DisplayCalendarBlock .=  "\t</tr>\n</table>\n";
	
	return($DisplayCalendarBlock);
	
} // End of buildCalendar Func

//---------------------------------------------------------------------------------------------------
// Function to get Next and Prev Month Year Timestamp
// Input: Current Month/Year Timestamp
// Output: Array as follows 0=NextMonthYearTimestamp 1=PrevYearTimestamp
//---------------------------------------------------------------------------------------------------
function getNextPrevMonthYear($timestamp)
{	
	$datePassed = getdate($timestamp);
	//---------------------------------------------------------------------------------------------------
	// now we need to get prev  date so we want prev months first day
	//---------------------------------------------------------------------------------------------------
	if ($datePassed[mon] == 1)
	{
		$prevmonth = 12;
		$prevyear = $datePassed[year] - 1;
		
		$nextmonth = 2;
		$nextyear = $datePassed[year];
	}
	else
	{
		if ($datePassed[mon] == 12)
		{
			$nextmonth = 1;
			$nextyear = $datePassed[year] + 1;
		}
		else
		{
			$nextmonth = $datePassed[mon] + 1;
			$nextyear = $datePassed[year];
		}
		
		$prevmonth = $datePassed[mon] - 1;
		$prevyear = $datePassed[year];
	}
	
	$PrevTimestamp = mktime( 0, 0, 0, $prevmonth, 1, $prevyear);
	$NextTimestamp = mktime( 0, 0, 0, $nextmonth, 1, $nextyear);
		
	$result = Array ($NextTimestamp, $PrevTimestamp); 
	
	return ($result);
}

//---------------------------------------------------------------------------------------------------
// Function to fill calendar event array with appt/prec/vacc info
// Input: Mysql format date start, Mysql date format end date
// Output: Event Array 
//---------------------------------------------------------------------------------------------------
function fillCalendarEventArrays($mysqlDateStart, $mysqlDateEnd)
{
	//Identify global variables
	global $conn;
	global $module;
	global $Medpal;
	
	//---------------------------------------------------------------------------------------------------	
	// lets initialize  our event array
	//---------------------------------------------------------------------------------------------------
	$eventArr = array_fill(0, 31, "N");

	//---------------------------------------------------------------------------------------------------
	// create the SQL statement to get our calendar events for start dates that fit - Appointments
	//---------------------------------------------------------------------------------------------------
	$sql = "SELECT * from ClientAppointmentTBL 
				left join CalendarTBL on ClientAppointmentTBL.CalendarID =  CalendarTBL.ID
					where (MEDPAL = '$Medpal')  AND
						(StartDate >= '$mysqlDateStart' and StartDate < '$mysqlDateEnd')";
	
					
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query for ClientAppointmentTBL (195) - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$severity = 1;
		$location = "";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
		
	//---------------------------------------------------------------------------------------------------	
	// Now lets first see if there is anything to run through
	//---------------------------------------------------------------------------------------------------
	$countRows = mysql_num_rows($sql_result);
	if ($countRows >  0) 
	{	
		// now lets match hits and add to array with Y
		while ($result_arr = mysql_fetch_assoc($sql_result))
		{
			// now we parse out the vales
			$tmpDate = explode("-", $result_arr["StartDate"]);
			$eventArr[intval($tmpDate[2])] = 'Y';
		}
	}
	
	//---------------------------------------------------------------------------------------------------
	// create the SQL statement to get our calendar events for start dates that fit - Prescriptions
	//---------------------------------------------------------------------------------------------------
	$sql = "SELECT * from ClientPrescriptionTBL 
				inner join CalendarTBL on ClientPrescriptionTBL.CalendarID =  CalendarTBL.ID
					where ( (ClientPrescriptionTBL.MEDPAL = '$Medpal') and 
						(EndDate >= '$mysqlDateStart' and EndDate < '$mysqlDateEnd') )";
						
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query for ClientPrescriptionTBL (195) - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$severity = 1;
		$location = "";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	
	//---------------------------------------------------------------------------------------------------	
	// Now lets first see if there is anything to run through
	//---------------------------------------------------------------------------------------------------
	$countRows = mysql_num_rows($sql_result);
	if ($countRows >  0) 
	{	
		// now lets match hits and add to array with Y
		while ($result_arr = mysql_fetch_assoc($sql_result))
		{
			// now we parse out the vales
			$tmpDate = explode("-", $result_arr["EndDate"]);
			$eventArr[intval($tmpDate[2])] = 'Y';
		}
	}
		
	//---------------------------------------------------------------------------------------------------
	// create the SQL statement to get our calendar events for start dates that fit - Vaccinations
	//---------------------------------------------------------------------------------------------------
	$sql = "SELECT * from ClientVaccInocTBL 
				inner join CalendarTBL on ClientVaccInocTBL.CalendarID =  CalendarTBL.ID
					where ( (ClientVaccInocTBL.MEDPAL = '$Medpal') and 
						(EndDate >= '$mysqlDateStart' and EndDate < '$mysqlDateEnd') )";
						
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query for ClientVaccInocTBL (195) - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$severity = 1;
		$location = "";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	
	//---------------------------------------------------------------------------------------------------	
	// Now lets first see if there is anything to run through
	//---------------------------------------------------------------------------------------------------
	$countRows = mysql_num_rows($sql_result);
	if ($countRows >  0) 
	{	
		// now lets match hits and add to array with Y
		while ($result_arr = mysql_fetch_assoc($sql_result))
		{
			// now we parse out the vales
			$tmpDate = explode("-", $result_arr["EndDate"]);
			$eventArr[intval($tmpDate[2])] = 'Y';
		}
	}
	
	$result = $eventArr;
	
	return $result;
	
}  // End of Function	
?>
