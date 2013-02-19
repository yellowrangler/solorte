<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'UAmedvi.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

//----------------------------------------------------------------------------------------------------------
// What are we being asked to do?  Here we go to func based on action
//----------------------------------------------------------------------------------------------------------
switch ($_POST[Action])
{
	case 'Add':
		//--------------------------------------------------------------------------------------------------
		// Add a vaccinocription
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// to add we must first make sure we have valid date
		//--------------------------------------------------------------------------------------------------
		
		//Start Date
		if (!ValiDate($_POST[vaccinocStartmonth], $_POST[vaccinocStartday], $_POST[vaccinocStartyear]) )
		{
			// error
			$errmsg = "Invalid+Vaccination Date.+Please+try+again.";
			$location = "Location: if_UAmedvidetail.php";
			$shortmsg = "Invalid Date.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------		
		// put date into addable format
		//--------------------------------------------------------------------------------------------------
		$tmpStartdate = sprintf("%s-%02s-%02s", $_POST[vaccinocStartyear], $_POST[vaccinocStartmonth], $_POST[vaccinocStartday]);
		
		// End Date
		if (!ValiDate($_POST[vaccinocEndmonth], $_POST[vaccinocEndday], $_POST[vaccinocEndyear]) )
		{
			// error
			$errmsg = "Invalid+Rnew Date.+Please+try+again.";
			$location = "Location: if_UAmedvidetail.php";
			$shortmsg = "Invalid Date.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------		
		// put date into addable format
		//--------------------------------------------------------------------------------------------------
		$tmpEnddate = sprintf("%s-%02s-%02s", $_POST[vaccinocEndyear], $_POST[vaccinocEndmonth], $_POST[vaccinocEndday]);
		
		//--------------------------------------------------------------------------------------------------
		// Now it is time to insert to calender 
		//
		// first create calendartbl entry.  after successfull insert we must get auto increment id
		// to add to ClientVaccInocTBL.  We only add what is given.  The rest will default.
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO CalendarTBL 
					(StartDate, EndDate,  AppType)  
					VALUES ('$tmpStartdate', '$tmpEnddate', '1')";
					
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert calendar (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedvidetail.php?vaccinocid=$_POST[vaccinocid]";
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
			$errmsg = "Unable to save Calendar date. Please try again. Insert Failed.";
			$location = "Location: if_UAmedvidetail.php";
			$shortmsg = "Unable to save vaccination information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// get calendar id for clientvaccinocriptiontbl
		//--------------------------------------------------------------------------------------------------
		$NewCalendarID =  mysql_insert_id ($conn);
		if ($NewCalendarID == 0)
		{
			// error
			$errmsg = "Could not get unique Calendar ID. Please try again.";
			$location = "Location: if_UAmedvidetail.php";
			$shortmsg = "Unable to save vaccination information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------
		// Second create clientvaccinocription entry.  We only add what is given.  The rest will default.
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO ClientVaccInocTBL 
					(MEDPAL, CalendarID, ProviderID, VaccInocTypeID, Medication) 
					VALUES ('$Medpal', '$NewCalendarID', '$_POST[vaccinocprovider]', '$_POST[vaccinoctype]','$_POST[vaccinocmedication]')"; 

		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert ClientVaccInocTBL (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedvidetail.php?vaccinocid=$_POST[vaccinocid]";
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
			$errmsg = "Unable to insert Vaccination information.  Please try again. Insert failed.";
			$location = "Location: if_UAmedvidetail.php";
			$shortmsg = "Unable to save vaccination information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		$tmpNewID =  mysql_insert_id ($conn);
		
		//----------------------------------------------------------------------------------------------------------
		// Write to Access Log Table
		//----------------------------------------------------------------------------------------------------------
		AccessLogAdd("Client Vaccination Information Added.", "Ok", $module, "", $conn);

		//--------------------------------------------------------------------------------------------------
		// set our display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayID = $tmpNewID;
		$DisplayMsg = "Vaccination Information Added successfully!";
		
		//--------------------------------------------------------------------------------------------------
		// end of Add 
		//--------------------------------------------------------------------------------------------------
		break;
		
	case 'Update':
		//--------------------------------------------------------------------------------------------------
		// Update a vaccinocription
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// if id to update not passed in then error
		//--------------------------------------------------------------------------------------------------
		if (!isset($_POST[vaccinocid]))
		{
			// error
			$errmsg = "Error doing update for sql. no vaccinocid vaccinocid= '$_POST[vaccinocid]' (595) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedvidetail.php?vaccinocid=$_POST[vaccinocid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//Start Date
		if (!ValiDate($_POST[vaccinocStartmonth], $_POST[vaccinocStartday], $_POST[vaccinocStartyear]) )
		{
			// error
			$errmsg = "Invalid+Vaccination Date.+Please+try+again.";
			$location = "Location: if_UAmedvidetail.php";
			$shortmsg = "Invalid Date.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------		
		// put date into updateable format
		//--------------------------------------------------------------------------------------------------
		$tmpStartdate = sprintf("%s-%02s-%02s", $_POST[vaccinocStartyear], $_POST[vaccinocStartmonth], $_POST[vaccinocStartday]);
		
		// End Date
		if (!ValiDate($_POST[vaccinocEndmonth], $_POST[vaccinocEndday], $_POST[vaccinocEndyear]) )
		{
			// error
			$errmsg = "Invalid+Rnew Date.+Please+try+again.";
			$location = "Location: if_UAmedvidetail.php";
			$shortmsg = "Invalid Date.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------		
		// put date into updateable format
		//--------------------------------------------------------------------------------------------------
		$tmpEnddate = sprintf("%s-%02s-%02s", $_POST[vaccinocEndyear], $_POST[vaccinocEndmonth], $_POST[vaccinocEndday]);
		
		//--------------------------------------------------------------------------------------------------
		// get calendarid from ClientVaccInocTBL
		//--------------------------------------------------------------------------------------------------
		$sql = "SELECT * from ClientVaccInocTBL 
			where ( (MEDPAL = '$Medpal') and (ClientVaccInocTBL.ID = '$_POST[vaccinocid]') )";
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for ClientVaccInocTBL (795) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedvidetail.php?vaccinocid=$_POST[vaccinocid]";
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
			$errmsg = "Can not find Calendar entry for original Vaccination. Please try again.";
			$location = "Location: if_UAmedvidetail.php?vaccinocid=$_POST[vaccinocid]";
			$shortmsg = "Unable to save vaccination information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// get calendartbl.id from ClientVaccinationTBL
		//--------------------------------------------------------------------------------------------------
		$result_arr = mysql_fetch_assoc($sql_result);
		$tmpCalID = $result_arr[CalendarID];
		
		//--------------------------------------------------------------------------------------------------
		// Now it is time to update both a calender event and a client ClientVaccinationTBL
		//
		// first update calendartbl entry.  We only update what is given. 
		//--------------------------------------------------------------------------------------------------
		$sql = "UPDATE CalendarTBL set StartDate = '$tmpStartdate', EndDate = '$tmpEnddate',  AppType = '1'
					where CalendarTBL.ID = '$tmpCalID'";
									
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query update calendar (77) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedvidetail.php?vaccinocid=$_POST[vaccinocid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// now lets update ClientVaccInocTBL
		//--------------------------------------------------------------------------------------------------
		$sql = "UPDATE ClientVaccInocTBL
					set ProviderID = '$_POST[vaccinocprovider]', VaccInocTypeID = '$_POST[vaccinoctype]',  Medication = '$_POST[vaccinocmedication]'
						where ClientVaccInocTBL.ID =' $_POST[vaccinocid]'";
						
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query update ClientVaccInocTBL (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedvidetail.php?vaccinocid=$_POST[vaccinocid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//----------------------------------------------------------------------------------------------------------
		// Write to Access Log Table
		//----------------------------------------------------------------------------------------------------------
		AccessLogAdd("Client Vaccination Information Updated.", "Ok", $module, "", $conn);

		//--------------------------------------------------------------------------------------------------
		// update display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayID = $_POST[vaccinocid];
		$DisplayMsg = "Vaccination update successfull!";
		
		//--------------------------------------------------------------------------------------------------
		// end of Update 
		//--------------------------------------------------------------------------------------------------
		break;
		
	case 'Delete':
		//--------------------------------------------------------------------------------------------------
		// Delete a vaccinocription
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// to delete we must get PrecID and CalendarID to delete if no vaccinocid error
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// if id to delete not passed in then error
		//--------------------------------------------------------------------------------------------------
		if (!isset($_POST[vaccinocid]))
		{
			// error
			$errmsg = "Error doing delete before sql. no vaccinocid. vaccinocid= '$_POST[vaccinocid]' (595) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedvidetail.php?vaccinocid=$_POST[vaccinocid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------
		// build sql statement to get calenderid
		//--------------------------------------------------------------------------------------------------
		$sql = "SELECT * from ClientVaccInocTBL 
			inner join CalendarTBL on ClientVaccInocTBL.CalendarID = CalendarTBL.ID
				where ( (MEDPAL = '$Medpal') and (ClientVaccInocTBL.ID = '$_POST[vaccinocid]') )";
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for ClientVaccInocTBL (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedvidetail.php?vaccinocid=$_POST[vaccinocid]";
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
			$errmsg = "Error doing mysql_query for ClientVaccInocTBL and CalendarTBL. (996)  Too many or too few rows countrow = '$countRows' - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedvidetail.php?vaccinocid=$_POST[vaccinocid]";
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
			$errmsg = "$sqlerr - Error doing mysql_query for delete on CalendarTBL (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedvidetail.php?vaccinocid=$_POST[vaccinocid]";
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
			$location = "Location: if_UAmedvidetail.php?vaccinocid=$_POST[vaccinocid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// next delete from ClientVaccinationTBL
		//--------------------------------------------------------------------------------------------------
		$sql = "DELETE from ClientVaccInocTBL where ClientVaccInocTBL.ID = '$_POST[vaccinocid]'";
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientVaccInocTBL (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedvidetail.php?vaccinocid=$_POST[vaccinocid]";
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
			$errmsg = "Error doing delete for ClientVaccInocTBL.  rows affected = '$affRows'. (996)  Too many or too few rows. - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedvidetail.php?vaccinocid=$_POST[vaccinocid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//----------------------------------------------------------------------------------------------------------
		// Write to Access Log Table
		//----------------------------------------------------------------------------------------------------------
		AccessLogAdd("Client Vaccination Information Deleted.", "Ok", $module, "", $conn);

		//--------------------------------------------------------------------------------------------------
		// sey our display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayMsg = "Vaccination Information successfully Deleted.";
		$DisplayID = "";
		
		//--------------------------------------------------------------------------------------------------
		// end of Delete 
		//--------------------------------------------------------------------------------------------------
		break;
		
		
		default:
			if (isset($_POST[vaccinocid]) and ($_POST[vaccinocid] != ""))
				$DisplayID = $_POST[vaccinocid];
			else
				$DisplayID = "";
				
			$DisplayMsg = "No action selected.  Please select Add, Update or Delete from action list.";
			break;
			
} // end of switch
		
//--------------------------------------------------------------------------------------------------		
// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_UAmedvidetail.php?msgTxt=$DisplayMsg&vaccinocid=$DisplayID");

?>
