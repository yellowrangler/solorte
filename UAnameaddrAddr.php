<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'UAnameaddrAddr.php';

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
		// Now it is time to insert both an AddrTBL entry and a ClientAddrTBL entry 
		//
		// first insert AddrID entry.  after successfull insert we must get auto increment id
		// to add to ClientAddrTBL.  We only add what is given.  The rest will default.
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO AddrTBL 
					(OrderID,  AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr)  
					VALUES ('$_POST[order]', '$_POST[addr1]', '$_POST[addr2]',
					'$_POST[city]', '$_POST[state]', '$_POST[zip]', '$_POST[phonenbr]')";
					
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert AddrTBL (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAnameaddrAddrdetail.php?addrid=$_POST[addrid]";
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
			$location = "Location: if_UAnameaddrAddrdetail.php?msgTxt=$errmsg&addrid=";
			$shortmsg = "Unable to save Address information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// get AddrTBL id for ClientAddrTBL
		//--------------------------------------------------------------------------------------------------
		$NewAddrID =  mysql_insert_id ($conn);
		if ($NewAddrID == 0)
		{
			// error
			$errmsg = "Could not get unique Address ID. Please try again.";
			$location = "Location: if_UAnameaddrAddrdetail.php?msgTxt=$errmsg&addrid=";
			$shortmsg = "Unable to save Address information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------
		// Second create ClientAddrTBL insert.  We only add what is given.  The rest will default.
		//--------------------------------------------------------------------------------------------------
		$sql = "INSERT INTO ClientAddrTBL 
					(MEDPAL, AddrID) 
					VALUES ('$Medpal', '$NewAddrID')";

		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert ClientAddrTBL (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAnameaddrAddrdetail.php?addrid=$_POST[addrid]";
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
			$errmsg = "Unable to insert Address information.  Please try again. Insert failed 2.";
			$location = "Location: if_UAnameaddrAddrdetail.php?msgTxt=$errmsg&addrid=";
			$shortmsg = "Unable to save Address information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//----------------------------------------------------------------------------------------------------------
		// Write to Access Log Table
		//----------------------------------------------------------------------------------------------------------
		AccessLogAdd("Address Information Added.", "Ok", $module, "", $conn);

		//--------------------------------------------------------------------------------------------------
		// set our display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayID = $NewAddrID;
		$DisplayMsg = "Address Information Added successfully! Hit the Resfresh burron to refresh the list";
		
		//--------------------------------------------------------------------------------------------------
		// end of Add 
		//--------------------------------------------------------------------------------------------------
		break;
		
	case 'Update':
		//--------------------------------------------------------------------------------------------------
		// Update a Address
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// if id to update not passed in then error
		//--------------------------------------------------------------------------------------------------
		if (!isset($_POST[addrid]))
		{
			// error
			$errmsg = "Error doing update for sql. no addrid addrid= '$_POST[addrid]' (595) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAnameaddrAddrdetail.php?addrid=$_POST[addrid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------
		// Update AddrTBL entry.  We only update what is given. 
		//--------------------------------------------------------------------------------------------------
		$sql = "UPDATE AddrTBL 
			set OrderID = '$_POST[order]', AddrLine1 = '$_POST[addr1]', AddrLine2 = '$_POST[addr2]',
			City = '$_POST[city]', State = '$_POST[state]', ZIP = '$_POST[zip]', PhoneNbr = '$_POST[phonenbr]'
			where AddrTBL.ID = '$_POST[addrid]'";
									
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query update AddrTBL (77) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAnameaddrAddrdetail.php?addrid=$_POST[addrid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
	
		//----------------------------------------------------------------------------------------------------------
		// Write to Access Log Table
		//----------------------------------------------------------------------------------------------------------
		AccessLogAdd("Address Information updated.", "Ok", $module, "", $conn);

		//--------------------------------------------------------------------------------------------------
		// update display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayID = $_POST[addrid];
		$DisplayMsg = "Address update successfull! Hit the Refresh button to refresh the list";
		
		//--------------------------------------------------------------------------------------------------
		// end of Update 
		//--------------------------------------------------------------------------------------------------
		break;
		
	case 'Delete':
		//--------------------------------------------------------------------------------------------------
		// Delete a Address
		//--------------------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------------------
		// if id to delete not passed in then error
		//--------------------------------------------------------------------------------------------------
		if (!isset($_POST[addrid]))
		{
			$errmsg = "Error doing delete before sql. no addrid. addrid= '$_POST[addrid]' (595) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAnameaddrAddrdetail.php?addrid=$_POST[addrid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------
		// if id to delete not passed in then error
		//--------------------------------------------------------------------------------------------------
		if ($_POST[order] == '1')
		{
			$errmsg = "Error.  It is invalid to delete Primary address.";
			$location = "Location: if_UAnameaddrAddrdetail.php?addrid=$_POST[addrid]";
			$shortmsg = "Invalid to delete primary Address information.";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
		
		//--------------------------------------------------------------------------------------------------
		// first delete from AddrTBL
		//--------------------------------------------------------------------------------------------------
		$sql = "DELETE from AddrTBL where AddrTBL.ID = '$_POST[addrid]'";
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for delete on AddrTBL (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAnameaddrAddrdetail.php?addrid=$_POST[addrid]";
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
			$errmsg = "Error doing delete for AddrTBL.  rows affected = '$affRows'. (996)  Too many or too few rows - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAnameaddrAddrdetail.php?addrid=$_POST[addrid]";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
	
		//----------------------------------------------------------------------------------------------------------
		// Write to Access Log Table
		//----------------------------------------------------------------------------------------------------------
		AccessLogAdd("Address Information Deleted.", "Ok", $module, "", $conn);

		//--------------------------------------------------------------------------------------------------
		// sey our display variables
		//--------------------------------------------------------------------------------------------------
		$DisplayMsg = "Address successfully Deleted. Hit the Refresh button to refresh the list";
		$DisplayID = "";
		
		//--------------------------------------------------------------------------------------------------
		// end of Delete 
		//--------------------------------------------------------------------------------------------------
		break;
		
		
		default:
			if (isset($_POST[addrid]) and ($_POST[addrid] != ""))
				$DisplayID = $_POST[addrid];
			else
				$DisplayID = "";
				
			$DisplayMsg = "No action selected.  Please select Add, Update or Delete from action list.";
			break;
			
} // end of switch
		
//--------------------------------------------------------------------------------------------------		
// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_UAnameaddrAddrdetail.php?msgTxt=$DisplayMsg&addrid=$DisplayID");

?>
