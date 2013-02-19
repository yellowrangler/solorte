<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'UAmedprofAllergies.php';

require ('hysInit.php');

require ('hysDBinit.php');

//--------------------------------------------------------------------------------------------------
// initialize pass back values
//--------------------------------------------------------------------------------------------------
$DisplayErr = "N";

//--------------------------------------------------------------------------------------------------
// Update the ClientAllergyTBL
//
// We need to run through a loop.  If None is found then we must Delete otherwise Add
//--------------------------------------------------------------------------------------------------

for ($i = 1; $i < 13; $i++)
{	
	$PostAlleg = "profalleg".$i;
	$PostAllOrderID = "profallorder".$i;
	if ($_POST[$PostAlleg] == "None")
	{
		//------------------------------------------------------------------------------------------
		// we must first see if it existed before.  If so we must delete it.  If not Ignore.
		//------------------------------------------------------------------------------------------
		
		//------------------------------------------------------------------------------------------
		// create the SQL statement to get our clients Allergy medical profile.  
		//------------------------------------------------------------------------------------------
		$sql = "SELECT * from ClientAllergyTBL 
				where (ClientAllergyTBL.MEDPAL = '$Medpal' and ClientAllergyTBL.OrderID = '$_POST[$PostAllOrderID]')";
					
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query ClientAllergyTBL (195) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedprofAllergies.php?appid=";
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
				$sql = "DELETE from ClientAllergyTBL 
					where (ClientAllergyTBL.MEDPAL = '$Medpal' and ClientAllergyTBL.OrderID = '$_POST[$PostAllOrderID]')";
		
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientAllergyTBL (695) - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "Location: if_UAmedprofAllergies.php?appid=";
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
				$errmsg = "Error doing delete for ClientAllergyTBL.  rows affected = '$affRows'. (996)  Too many or too few rows - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "Location: if_UAmedprofAllergies.php?appid=";
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
		$sql = "SELECT * from ClientAllergyTBL 
				where (ClientAllergyTBL.MEDPAL = '$Medpal' and ClientAllergyTBL.OrderID = '$_POST[$PostAllOrderID]')";
					
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query ClientAllergyTBL (195) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UAmedprofAllergies.php?appid=";
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
			$sql = "UPDATE ClientAllergyTBL set OrderID = '$_POST[$PostAllOrderID]', Allergy ='$_POST[$PostAlleg]'
					where (ClientAllergyTBL.MEDPAL = '$Medpal' and ClientAllergyTBL.OrderID = '$_POST[$PostAllOrderID]')";
									
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query update ClientAllergyTBL (695) - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "Location: if_UAmedprofAllergies.php?appid=";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
		}
		else
		{
			//---------------------------------------------------------------------------------------
			// There is nothing so lets Add it (Insert)
			//---------------------------------------------------------------------------------------
			$sql = "INSERT INTO ClientAllergyTBL 
					(MEDPAL, OrderID, Allergy) 
					VALUES ('$Medpal', '$_POST[$PostAllOrderID]', '$_POST[$PostAlleg]')";

			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query insert ClientAllergyTBL (695) - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "Location: if_UAmedprofAllergies.php?appid=";
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
				$errmsg = "Error trying to add Allergy entry. Insert Failed.";
				$location = "Location: if_UAmedprofAllergies.php?appid=";
				$shortmsg = "Unable to save Allergy information.";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
		} // End of Eles	
	} // End of Else to If = None
} // End of For loop	

//----------------------------------------------------------------------------------------------------------
// Write to Access Log Table
//----------------------------------------------------------------------------------------------------------
AccessLogAdd("Allergy Information update.", "Ok", $module, "", $conn);

//--------------------------------------------------------------------------------------------------
// update display variables
//--------------------------------------------------------------------------------------------------
$DisplayMsg = "Allergy Information update successfull!";


//--------------------------------------------------------------------------------------------------
// end of Update 
//--------------------------------------------------------------------------------------------------
		
//--------------------------------------------------------------------------------------------------		
// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_UAmedprofAllergies.php?msgTxt=$DisplayMsg&err=$DisplayErr");

?>
