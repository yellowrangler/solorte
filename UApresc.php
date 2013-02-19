<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'UApresc.php';

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
		// Add a prescription
		//--------------------------------------------------------------------------------------------------
	
		//--------------------------------------------------------------------------------------------------		
		// put dates into addable format
		//--------------------------------------------------------------------------------------------------
		$tmpstartdate = sprintf("%s-%02s-%02s", $_POST[prescstartyear], $_POST[prescstartmonth], $_POST[prescstartday]);
		$tmpenddate = sprintf("%s-%02s-%02s", $_POST[prescendyear], $_POST[prescendmonth], $_POST[prescendday]);
			
		//--------------------------------------------------------------------------------------------------
		// Now it is time to insert both a calender event and a client prescription
		//
		// first create calendartbl entry.  after successfull insert we must get auto increment id
		// to add to clientprescriptiontbl.  We only add what is given.  The rest will default.
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO CalendarTBL 
					(StartDate, EndDate,  AppType)  
					VALUES ('$tmpstartdate', '$tmpenddate', '2')";
					
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert calendar (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAprescdetail.php?prescid=$_POST[prescid]";
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
			$location = "Location: if_UAprescdetail.php?prescid=";
			$shortmsg = "Unable to Add Prescription.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// get calendar id for clientprescriptiontbl
		//--------------------------------------------------------------------------------------------------
		$NewCalendarID =  mysql_insert_id ($conn);
		if ($NewCalendarID == 0)
		{
			// error
			$errmsg = "Could not get unique Calendar ID. Please try again.";
			$location = "Location: if_UAprescdetail.php?prescid=";
			$shortmsg = "Unable to Add Prescription.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------
		// Second create clientprescription entry.  We only add what is given.  The rest will default.
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO ClientPrescriptionTBL 
					(MEDPAL, CalendarID, ProviderID, Condition, PharmacyID, PrescrNbr, Medication, UnitSz, Quantity, Dosage, Directions) 
					VALUES ('$Medpal', '$NewCalendarID', '$_POST[prescprovider]', '$_POST[prescconditionc]',
							'$_POST[prescpharmacy]', 	'$_POST[prescnbr]', 	'$_POST[prescmedication]', 
							'$_POST[prescunitsz]', 	'$_POST[prescqty]', 	'$_POST[prescdosage]', 
							'$_POST[prescdirections]')";

		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert ClientPrescriptionTBL (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAprescdetail.php?prescid=$_POST[prescid]";
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
			$errmsg = "Unable to insert prescription information.  Please try again. Insert failed.";
			$location = "Location: if_UAprescdetail.php?prescid=";
			$shortmsg = "Unable to Add Prescription.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		$tmpNewID =  mysql_insert_id ($conn);
		
		//----------------------------------------------------------------------------------------------------------
		// Write to Access Log Table
		//----------------------------------------------------------------------------------------------------------
		AccessLogAdd("Client Prescription Information Added.", "Ok", $module, "", $conn);

		//--------------------------------------------------------------------------------------------------
		// set our display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayID = $tmpNewID;
		$DisplayMsg = "Prescription Information Added successfully!";
		
		//--------------------------------------------------------------------------------------------------
		// end of Add 
		//--------------------------------------------------------------------------------------------------
		break;
		
	case 'Update':
		//--------------------------------------------------------------------------------------------------
		// Update a prescription
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// if id to update not passed in then error
		//--------------------------------------------------------------------------------------------------
		if (!isset($_POST[prescid]))
		{
			// error
			$errmsg = "Error doing update for sql. no prescid prescid= '$_POST[prescid]' (595) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAprescdetail.php?prescid=$_POST[prescid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------		
		// put dates into addable format
		//--------------------------------------------------------------------------------------------------
		$tmpstartdate = sprintf("%s-%02s-%02s", $_POST[prescstartyear], $_POST[prescstartmonth], $_POST[prescstartday]);
		$tmpenddate = sprintf("%s-%02s-%02s", $_POST[prescendyear], $_POST[prescendmonth], $_POST[prescendday]);
		
		//--------------------------------------------------------------------------------------------------
		// get calendarid from client app tbl
		//--------------------------------------------------------------------------------------------------
		$sql = "SELECT * from ClientPrescriptionTBL 
			where ( (MEDPAL = '$Medpal') and (ClientPrescriptionTBL.ID = '$_POST[prescid]') )";
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for ClientPrescriptionTBL (795) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAprescdetail.php?prescid=$_POST[prescid]";
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
			$errmsg = "Can not find Calendar entry for original prescription. Please try again.";
			$location = "Location: if_UAprescdetail.php?prescid=$_POST[prescid]";
			$shortmsg = "Unable to Add Prescription.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// get calendartbl.id from ClientPrescriptionTBL
		//--------------------------------------------------------------------------------------------------
		$result_arr = mysql_fetch_assoc($sql_result);
		$tmpCalID = $result_arr[CalendarID];
		
		//--------------------------------------------------------------------------------------------------
		// Now it is time to update both a calender event and a client prescription
		//
		// first update calendartbl entry.  We only update what is given. 
		//--------------------------------------------------------------------------------------------------
		$sql = "UPDATE CalendarTBL set StartDate = '$tmpstartdate', EndDate = '$tmpenddate', AppType = '2'
					where CalendarTBL.ID = '$tmpCalID'";
									
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query update calendar (77) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAprescdetail.php?prescid=$_POST[prescid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// now lets update ClientPrescriptionTBL
		//--------------------------------------------------------------------------------------------------
		$sql = "UPDATE ClientPrescriptionTBL
					set ProviderID =  '$_POST[prescprovider]', Condition = '$_POST[prescconditionc]', PharmacyID = '$_POST[prescpharmacy]', 
						PrescrNbr = '$_POST[prescnbr]', Medication = '$_POST[prescmedication]', UnitSz = '$_POST[prescunitsz]', 
						Quantity = '$_POST[prescqty]',  Dosage = '$_POST[prescdosage]', Directions = '$_POST[prescdirections]'
						where ClientPrescriptionTBL.ID =' $_POST[prescid]'";
							
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query update ClientPrescriptionTBL (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAprescdetail.php?prescid=$_POST[prescid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//----------------------------------------------------------------------------------------------------------
		// Write to Access Log Table
		//----------------------------------------------------------------------------------------------------------
		AccessLogAdd("Client Prescription Information Updated.", "Ok", $module, "", $conn);

		//--------------------------------------------------------------------------------------------------
		// update display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayID = $_POST[prescid];
		$DisplayMsg = "Prescription update successfull!";
		
		//--------------------------------------------------------------------------------------------------
		// end of Update 
		//--------------------------------------------------------------------------------------------------
		break;
		
	case 'Delete':
		//--------------------------------------------------------------------------------------------------
		// Delete a prescription
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// to delete we must get PrecID and CalendarID to delete if no prescid error
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// if id to delete not passed in then error
		//--------------------------------------------------------------------------------------------------
		if (!isset($_POST[prescid]))
		{
			// error
			$errmsg = "Error doing delete before sql. no prescid. prescid= '$_POST[prescid]' (595) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAprescdetail.php?prescid=$_POST[prescid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------
		// build sql statement to get calenderid
		//--------------------------------------------------------------------------------------------------
		$sql = "SELECT * from ClientPrescriptionTBL inner join CalendarTBL on ClientPrescriptionTBL.CalendarID = CalendarTBL.ID
			where ( (MEDPAL = '$Medpal') and (ClientPrescriptionTBL.ID = '$_POST[prescid]') )";
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for ClientPrescriptionTBL (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAprescdetail.php?prescid=$_POST[prescid]";
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
			$errmsg = "Error doing mysql_query for ClientPrescriptionTBL and CalendarTBL. (996)  Too many or too few rows countrow = '$countRows' - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAprescdetail.php?prescid=$_POST[prescid]";
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
			$location = "Location: if_UAprescdetail.php?prescid=$_POST[prescid]";
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
			$location = "Location: if_UAprescdetail.php?prescid=$_POST[prescid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// next delete from ClientPrescriptionTBL
		//--------------------------------------------------------------------------------------------------
		$sql = "DELETE from ClientPrescriptionTBL where ClientPrescriptionTBL.ID = '$_POST[prescid]'";
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientPrescriptionTBL (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAprescdetail.php?prescid=$_POST[prescid]";
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
			$errmsg = "Error doing delete for ClientPrescriptionTBL.  rows affected = '$affRows'. (996)  Too many or too few rows. - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAprescdetail.php?prescid=$_POST[prescid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//----------------------------------------------------------------------------------------------------------
		// Write to Access Log Table
		//----------------------------------------------------------------------------------------------------------
		AccessLogAdd("Client Prescription Information Deleted.", "Ok", $module, "", $conn);

		//--------------------------------------------------------------------------------------------------
		// sey our display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayMsg = "Prescription successfully Deleted.";
		$DisplayID = "";
		
		//--------------------------------------------------------------------------------------------------
		// end of Delete 
		//--------------------------------------------------------------------------------------------------
		break;
		
		
		default:
			if (isset($_POST[prescid]) and ($_POST[prescid] != ""))
				$DisplayID = $_POST[prescid];
			else
				$DisplayID = "";
				
			$DisplayMsg = "No action selected.  Please select Add, Update or Delete from action list.";
			break;
			
} // end of switch
		
//--------------------------------------------------------------------------------------------------		
// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_UAprescdetail.php?msgTxt=$DisplayMsg&prescid=$DisplayID");

?>
