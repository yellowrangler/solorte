<?php

//----------------------------------------------------------------------------------------------------------
// Set select background color
//----------------------------------------------------------------------------------------------------------
$BodySelectColor = "bgcolor=#ccccff";

require ('hysInitAdmin.php');

require ('hysDBinit.php');

//----------------------------------------------------------------------------------------------------------
//  we need to see if we have been passed a PharmacyID
//----------------------------------------------------------------------------------------------------------

if (isset($_POST[custservid]) && ($_POST[custservid] != "") )
{
	if (isset($_POST[custservpass]) && ($_POST[custservpass] != "") )
	{
		$CustServID = $_POST[custservid];
	
		//----------------------------------------------------------------------------------------------------------
		// First we will get the password if it is available
		//----------------------------------------------------------------------------------------------------------
		// create the SQL statement
		//----------------------------------------------------------------------------------------------------------
		$sql = "SELECT  Pword
			from AuthenticationTBL 
				where (AuthenticationTBL.USERID = '$CustServID'
					and AuthenticationTBL.TypeID = '$DisplayCustomerServiceType')"; 
				
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			echo  "$sqlerr - Error doing mysql_query for AutenticationTBL (83) - '$CustServID'";
		}	
		
		// make sure only 1 row was returned.  More then 1 means big problem - less then 1 means user not on file
		$num_rows = mysql_num_rows($sql_result);
		
		//-----------------------------------------------------------------------------------------------
		// We may or may bot have a password - therefore we must check
		//-----------------------------------------------------------------------------------------------
		$pwCheck = spookEStr($_POST[custservpass]);
		
		// see if any row was returned.  
		$num_rows = mysql_num_rows($sql_result);
		if ($num_rows == 0)
		{
			//--------------------------------------------------------------------------------------------------
			// Add a Authentication info
			//--------------------------------------------------------------------------------------------------
			$sql = "INSERT INTO AuthenticationTBL 
						(USERID,  Pword, TypeID)  
						VALUES ('$CustServID', '$pwCheck', '$DisplayCustomerServiceType')";
						
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				echo "$sqlerr - Error doing mysql_query insert AuthenticationTBL (695)";
			}
			
			//--------------------------------------------------------------------------------------------------
			// Now lets process the result set 
			//--------------------------------------------------------------------------------------------------
			$affRows = mysql_affected_rows($conn);
			if ($affRows != 1)
			{
				// error
				echo "Unable to save Client Authentication information. Please try again. Insert Failed.";
			}
		}
		else
		{
			//--------------------------------------------------------------------------------------------------
			// Update Authentication info
			//--------------------------------------------------------------------------------------------------
			$sql = "UPDATE AuthenticationTBL 
				set Pword = '$pwCheck'
					where AuthenticationTBL.USERID = '$CustServID' and 
						AuthenticationTBL.TypeID = '$DisplayCustomerServiceType'";
	
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				echo  "$sqlerr - Error doing mysql_query insert AuthenticationTBL (695)";
			}
		}
	}	
}

//--------------------------------------------------------------------------------------------------		
// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_createCSID.php?msgTxt=OK");

?>
