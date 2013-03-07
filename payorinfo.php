<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'payorinfo.php';

require ('hysInit.php');

require ('hysDBinit.php');

//----------------------------------------------------------------------------------------------------------
// What are we being asked to do?  Here we go to func based on action
//----------------------------------------------------------------------------------------------------------
switch ($_POST[Action])
{
	case 'Add':
		//--------------------------------------------------------------------------------------------------
		// Add a Address
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// Now it is time to insert AddrTBL entry.  After successfull insert we must get auto increment id
		// to add to PayorTBL.  We only add what is given.  The rest will default.
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO AddrTBL 
					(OrderID,  AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr)  
					VALUES ('1', '$_POST[addr1]', '$_POST[addr2]',
					'$_POST[city]', '$_POST[state]', '$_POST[zip]', '$_POST[phonenbr]')";
					
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert AddrTBL (695)'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_payorinfo.php?errmsg&payorid=";
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
			$errmsg = "Unable to save Address information. Please try again. Insert Failed.";
			$location = "Location: if_payorinfo.php?errmsg&payorid=";
			$shortmsg = "Unable to save Address information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// get AddrTBL id for PayorTBL
		//--------------------------------------------------------------------------------------------------
		$NewAddrID =  mysql_insert_id ($conn);
		if ($NewAddrID == 0)
		{
			// error
			$errmsg = "Could not get unique Address ID. Please try again.";
			$location = "Location: if_payorinfo.php?errmsg&payorid=";
			$shortmsg = "Could not get unique Address ID.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------
		// Second create PayorTBL insert.  We only add what is given.  The rest will default.
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO PayorTBL 
					(TypeID, Name, AddrID, URL)                    
					VALUES ('$_POST[payortype]',  '$_POST[payorname]', '$NewAddrID', '$_POST[url]')";

		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert PayorTBL (695)";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_payorinfo.php?errmsg&payorid=";
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
			$errmsg = "Unable to insert Payor information.  Please try again. Insert failed.";
			$location = "Location: if_payorinfo.php?errmsg&payorid=";
			$shortmsg = "Unable to insert Payor information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// get PayorTBL id for Display
		//--------------------------------------------------------------------------------------------------
		$NewPayorID =  mysql_insert_id ($conn);
		if ($NewPayorID == 0)
		{
			// error
			$errmsg = "Could not get unique Payor ID. Please try again.";
			$location = "Location: if_payorinfo.php?errmsg&payorid=";
			$shortmsg = "Could not get unique Payor ID. Please try again.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		//--------------------------------------------------------------------------------------------------
		// set our display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayPayorID = $NewPayorID;
		$DisplayMsg = "Payor Information Added successfully!";
		
		//--------------------------------------------------------------------------------------------------
		// end of Add 
		//--------------------------------------------------------------------------------------------------
		break;
		
	case 'Update':
		//--------------------------------------------------------------------------------------------------
		// Update a Host
		//--------------------------------------------------------------------------------------------------

		//--------------------------------------------------------------------------------------------------
		// if id to update not passed in then error
		//--------------------------------------------------------------------------------------------------
		if (!isset($_POST[payorid]) || ($_POST[payorid] == "") )
		{
			// error
			$errmsg = "Error doing update for sql. no payorid payorid= '$_POST[payorid]' (595)";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_payorinfo.php?errmsg&payorid=";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------
		// Get AddrID
		//--------------------------------------------------------------------------------------------------	
		$sql = "SELECT  AddrID
			from PayorTBL 
			where (PayorTBL.ID = '$_POST[payorid]')"; 
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query join for PayorTBL (195) sql = '$sql'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_payorinfo.php?errmsg&payorid=";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
			
		// Now lets first see if there is anything to run through.  If more then 1 we have an error
		$countRows = mysql_num_rows($sql_result);
		if ($countRows > 1)
		{
			$errmsg = " Error more then 1 rows returned in select on PayorTBL. count = '$countRows'  - PayorID =  '$_POST[payorid]'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_payorinfo.php?errmsg&payorid=";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
	
		//----------------------------------------------------------------------------------------------------------
		// Get the Host Data
		//----------------------------------------------------------------------------------------------------------
		$result_array = mysql_fetch_assoc($sql_result);
		
		//--------------------------------------------------------------------------------------------------
		// Update AddrTBL entry.  We only update what is given. 
		//--------------------------------------------------------------------------------------------------
		$sql = "UPDATE AddrTBL 
			set OrderID = '1', AddrLine1 = '$_POST[addr1]', AddrLine2 = '$_POST[addr2]',
			City = '$_POST[city]', State = '$_POST[state]', ZIP = '$_POST[zip]', PhoneNbr = '$_POST[phonenbr]'
			where AddrTBL.ID = '$result_array[AddrID]'";
									
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query update AddrTBL (77) PayorID = '$_POST[payorid]'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_payorinfo.php?errmsg&payorid=";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
	
		//--------------------------------------------------------------------------------------------------
		// Update PayorTBL entry.  We only update what is given. 
		//--------------------------------------------------------------------------------------------------
		$sql = "UPDATE PayorTBL 
			set TypeID = '$_POST[payortype]', Name = '$_POST[payorname]', URL = '$_POST[url]'
			where PayorTBL.ID = '$_POST[payorid]'";
									
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query update PayorTBL (77) PayorID = '$_POST[payorid]'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_payorinfo.php?errmsg&payorid=";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
	
		//--------------------------------------------------------------------------------------------------
		// update display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayPayorID = $_POST[payorid];
		$DisplayMsg = "Payor Information update successfull!";
		
		//--------------------------------------------------------------------------------------------------
		// end of Update 
		//--------------------------------------------------------------------------------------------------
		break;
		
	case 'Delete':
			
		//--------------------------------------------------------------------------------------------------
		// end of Delete 
		//--------------------------------------------------------------------------------------------------
		break;
		
		
		default:
			if (isset($_POST[payorid]) and ($_POST[payorid] != ""))
				$DisplayPayorID = $_POST[payorid];
			else
				$DisplayPayorID = "";
				
			$DisplayMsg = "No action selected.  Hit default.";
			break;
			
} // end of switch
		
//--------------------------------------------------------------------------------------------------		
// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_payorinfo.php?msgTxt=$DisplayMsg&payorid=$DisplayPayorID");

?>
