<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'UAmedprofLongTerm.php';

require ('hysInit.php');

require ('hysDBinit.php');
 
//--------------------------------------------------------------------------------------------------
// initialize pass back values
//--------------------------------------------------------------------------------------------------
$DisplayErr = "N";

//--------------------------------------------------------------------------------------------------
// Update the ClientCronicConditionTBL
//
// We need to run through a loop.  If None is found then we must Delete otherwise Add
//--------------------------------------------------------------------------------------------------

for ($i = 1; $i < 13; $i++)
{	
	$PostCronic = "profcronic".$i;
	$PostCronOrderID = "profcronorder".$i;
	if ($_POST[$PostCronic] == "None")
	{
		//------------------------------------------------------------------------------------------
		// we must first see if it existed before.  If so we must delete it.  If not Ignore.
		//------------------------------------------------------------------------------------------
		
		//------------------------------------------------------------------------------------------
		// create the SQL statement to get our clients Long Term medical profile.  
		//------------------------------------------------------------------------------------------
		$sql = "SELECT * from ClientCronicConditionTBL 
				where (ClientCronicConditionTBL.MEDPAL = '$Medpal' and ClientCronicConditionTBL.OrderID = '$_POST[$PostCronOrderID]')";
					
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query ClientCronicConditionTBL (195) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//------------------------------------------------------------------------------------------
		// Now lets first see if there is anything to Delete  
		//------------------------------------------------------------------------------------------
		$countRows = mysql_num_rows($sql_result);
		if ($countRows > 0)
		{
			//---------------------------------------------------------------------------------------
			// There is something so lets delete it 
			//---------------------------------------------------------------------------------------
				$sql = "DELETE from ClientCronicConditionTBL 
					where (ClientCronicConditionTBL.MEDPAL = '$Medpal' and ClientCronicConditionTBL.OrderID = '$_POST[$PostCronOrderID]')";
		
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientCronicConditionTBL (695) - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "";
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
				$errmsg = "Error doing delete for ClientCronicConditionTBL.  rows affected = '$affRows'. (996)  Too many or too few rows - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
		}	
	}	// end of If = None
	else
	{
		//------------------------------------------------------------------------------------------
		// we must first see if it existed before.  If so we must update it.  If not Add.
		//------------------------------------------------------------------------------------------
		
		//------------------------------------------------------------------------------------------
		// create the SQL statement to get our clients external medical profile.  
		//------------------------------------------------------------------------------------------
		$sql = "SELECT * from ClientCronicConditionTBL 
				where (ClientCronicConditionTBL.MEDPAL = '$Medpal' and ClientCronicConditionTBL.OrderID = '$_POST[$PostCronOrderID]')";
					
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query ClientCronicConditionTBL (195) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//------------------------------------------------------------------------------------------
		// Now lets first see if there is anything to Update  
		//------------------------------------------------------------------------------------------
		$countRows = mysql_num_rows($sql_result);
		if ($countRows > 0)
		{
			//---------------------------------------------------------------------------------------
			// There is something so lets Update it 
			//---------------------------------------------------------------------------------------
			$sql = "UPDATE ClientCronicConditionTBL set OrderID = '$_POST[$PostCronOrderID]', Condition ='$_POST[$PostCronic]'
					where (ClientCronicConditionTBL.MEDPAL = '$Medpal' and ClientCronicConditionTBL.OrderID = '$_POST[$PostCronOrderID]')";
									
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query update ClientCronicConditionTBL (695) - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
		}
		else
		{
			//---------------------------------------------------------------------------------------
			// There is nothing so lets Add it (Insert)
			//---------------------------------------------------------------------------------------
			$sql = "INSERT INTO ClientCronicConditionTBL 
					(MEDPAL, OrderID, Condition) 
					VALUES ('$Medpal', '$_POST[$PostCronOrderID]', '$_POST[$PostCronic]')";

			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query insert ClientCronicConditionTBL (695) - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
			
			//----------------------------------------------------------------------------------------
			// Now lets process the result set 
			//----------------------------------------------------------------------------------------
			$affRows = mysql_affected_rows($conn);
			if ($affRows != 1)
			{
				// error
				$errmsg = "Error trying to add Long Term entry. Insert Failed.";
				$location = "Location: if_UAmedprofLongTerm.php?msgTxt=$errmsg&appid=";
				$shortmsg = "Unable to save Long Term information.";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
		} // End of Eles	
	} // End of Else to If = None
} // End of For loop	

//----------------------------------------------------------------------------------------------------------
// Write to Access Log Table
//----------------------------------------------------------------------------------------------------------
AccessLogAdd("Long Term Medical Information update.", "Ok", $module, "", $conn);

//--------------------------------------------------------------------------------------------------
// update display variables
//--------------------------------------------------------------------------------------------------
$DisplayMsg = "Long Term Medical Information update successfull!";


//--------------------------------------------------------------------------------------------------
// end of Update 
//--------------------------------------------------------------------------------------------------
		
//--------------------------------------------------------------------------------------------------		
// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_UAmedprofLongTerm.php?msgTxt=$DisplayMsg&err=$DisplayErr");

?>
