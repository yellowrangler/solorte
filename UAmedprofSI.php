<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'UAmedprofSI.php';

require ('hysInit.php');

require ('hysDBinit.php');

//--------------------------------------------------------------------------------------------------
// initialize pass back values
//--------------------------------------------------------------------------------------------------
$DisplayErr = "N";

//--------------------------------------------------------------------------------------------------
// Update the ClientSpecialInstructionsTBL
//
// We need to run through a loop.  If None is found then we must Delete otherwise Add
//--------------------------------------------------------------------------------------------------

for ($i = 1; $i < 13; $i++)
{	
	$PostSI = "profsi".$i;
	$PostSIOrderID = "profsiorder".$i;
	if ($_POST[$PostSI] == "None")
	{
		//------------------------------------------------------------------------------------------
		// we must first see if it existed before.  If so we must delete it.  If not Ignore.
		//------------------------------------------------------------------------------------------
		
		//------------------------------------------------------------------------------------------
		// create the SQL statement to get our clients SI medical profile.  
		//------------------------------------------------------------------------------------------
		$sql = "SELECT * from ClientSpecialInstructionsTBL 
				where (ClientSpecialInstructionsTBL.MEDPAL = '$Medpal' and ClientSpecialInstructionsTBL.OrderID = '$_POST[$PostSIOrderID]')";
					
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query ClientSpecialInstructionsTBL (195) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedprofLongTerm.php?appid=";
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
				$sql = "DELETE from ClientSpecialInstructionsTBL 
					where (ClientSpecialInstructionsTBL.MEDPAL = '$Medpal' and ClientSpecialInstructionsTBL.OrderID = '$_POST[$PostSIOrderID]')";
		
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientSpecialInstructionsTBL (695) - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "Location: if_UAmedprofLongTerm.php?appid=";
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
				$errmsg = "Error doing delete for ClientSpecialInstructionsTBL.  rows affected = '$affRows'. (996)  Too many or too few rows - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "Location: if_UAmedprofLongTerm.php?appid=";
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
		$sql = "SELECT * from ClientSpecialInstructionsTBL 
				where (ClientSpecialInstructionsTBL.MEDPAL = '$Medpal' and ClientSpecialInstructionsTBL.OrderID = '$_POST[$PostSIOrderID]')";
					
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query ClientSpecialInstructionsTBL (195) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedprofLongTerm.php?appid=";
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
			$sql = "UPDATE ClientSpecialInstructionsTBL set OrderID = '$_POST[$PostSIOrderID]', SpecialInstructions ='$_POST[$PostSI]'
					where (ClientSpecialInstructionsTBL.MEDPAL = '$Medpal' and ClientSpecialInstructionsTBL.OrderID = '$_POST[$PostSIOrderID]')";
									
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query update ClientSpecialInstructionsTBL (695) - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "Location: if_UAmedprofLongTerm.php?appid=";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
		}
		else
		{
			//---------------------------------------------------------------------------------------
			// There is nothing so lets Add it (Insert)
			//---------------------------------------------------------------------------------------
			$sql = "INSERT INTO ClientSpecialInstructionsTBL 
					(MEDPAL, OrderID, SpecialInstructions) 
					VALUES ('$Medpal', '$_POST[$PostSIOrderID]', '$_POST[$PostSI]')";

			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query insert ClientSpecialInstructionsTBL (695) - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "Location: if_UAmedprofLongTerm.php?appid=";
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
				$errmsg = "Error trying to add SI entry. Insert Failed.";
				$location = "Location: if_UAmedprofLongTerm.php?appid=";
				$shortmsg = "Unable to save SI information.";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
		} // End of Eles	
	} // End of Else to If = None
} // End of For loop	

//----------------------------------------------------------------------------------------------------------
// Write to Access Log Table
//----------------------------------------------------------------------------------------------------------
AccessLogAdd("Special Instruction Information update.", "Ok", $module, "", $conn);

//--------------------------------------------------------------------------------------------------
// update display variables
//--------------------------------------------------------------------------------------------------
$DisplayMsg = "Special Instruction Information update successfull!";


//--------------------------------------------------------------------------------------------------
// end of Update 
//--------------------------------------------------------------------------------------------------
		
//--------------------------------------------------------------------------------------------------		
// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_UAmedprofSI.php?msgTxt=$DisplayMsg&err=$DisplayErr");

?>
