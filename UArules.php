<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'UArules.php';

require ('hysInit.php');

require ('hysDBinit.php');

//--------------------------------------------------------------------------------------------------
// We must either add, update or delete based on what is passed.  If check box off then just 
// delete and dont bother checking affected rows.  If box checked then do select - If there do
// Update otherwise do insert.  Easy right?   rrrriiiigggghhtt...
//
// We loop thru all actions applying our stated direction as stated above
//--------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------
// Start by getting Rule Action
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT * from RuleActionTBL
	ORDER BY ID"; 
			
// Make the call
if (!$sql_Action_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for RuleEventTypeTBL  (895) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "Location: if_UArules.php";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// Now lets first see if there is anything to run through
$countActionRows = mysql_num_rows($sql_Action_result);
if ($countActionRows == 0)
{
	$errmsg = "Error doing mysql_query for RuleActionTBL. Got 0 rows  (334) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "Location: if_UArules.php";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}


//----------------------------------------------------------------------------------------------------------
// Now we loop thru actual rule event types matching them with client records
//----------------------------------------------------------------------------------------------------------
while($resultAction_array = mysql_fetch_assoc($sql_Action_result))
{
	//--------------------------------------------------------------------------------------------------
	// set up post names
	//--------------------------------------------------------------------------------------------------
	$tmpCheckBoxAction = "action".$resultAction_array[ID];
	$tmpCheckBoxRuleevente = "ruleevent".$resultAction_array[ID];
	$tmpCheckBoxInterval = "interval".$resultAction_array[ID];
	
	//------------------------------------------------------------------------------------------------------
	// if we are checked then we add or update
	//------------------------------------------------------------------------------------------------------
	if ($_POST[$tmpCheckBoxAction] == $resultAction_array[ID])
	{
		//--------------------------------------------------------------------------------------------------
		// create the SQL statement to get our clients rules. 
		//--------------------------------------------------------------------------------------------------
		$sql = "SELECT * from ClientRulesTBL 
				where (MEDPAL = '$Medpal' and RuleActionID = '$resultAction_array[ID]')"; 
					
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for ClientRulesTBL (195) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UArules.php";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		//--------------------------------------------------------------------------------------------------
		// If rows > 0 then we update otherwise insert
		//--------------------------------------------------------------------------------------------------
		$countRows = mysql_num_rows($sql_result);
		if ($countRows > 0)
		{		
			$sql = "UPDATE ClientRulesTBL 
					set RuleEventTypeID = '$_POST[$tmpCheckBoxRuleevente]', RuleInterval = '$_POST[$tmpCheckBoxInterval]', 
					RuleActionID = '$_POST[$tmpCheckBoxAction]'
					where (MEDPAL = '$Medpal' and RuleActionID = '$resultAction_array[ID]')"; 
				
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query update ClientRulesTBL (778) - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "Location: if_UArules.php";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
		}
		else
		{
			//--------------------------------------------------------------------------------------------------
			// Now it is time to insert.
			//--------------------------------------------------------------------------------------------------
			$sql = "INSERT INTO ClientRulesTBL 
						(MEDPAL, RuleEventTypeID, RuleActionID, RuleInterval)  
						VALUES ('$Medpal', '$_POST[$tmpCheckBoxRuleevente]', '$_POST[$tmpCheckBoxAction]',
						'$_POST[$tmpCheckBoxInterval]')";
						
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query insert ClientRulesTBL (695) - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "Location: if_UArules.php";
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
				$errmsg = "Unable to Add Rule for ".$resultAction_array[Action]." Please try again.";
				$location = "Location: if_UArules.php";
				$shortmsg = "Unable to Add rule for $resultAction_array[Action]";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
		} // End of Else	
	}	// End of IF CheckboxAction
	else
	{
		//--------------------------------------------------------------------------------------------------
		// We are NOT checked then so we delete
		//--------------------------------------------------------------------------------------------------
		$sql = "DELETE from ClientRulesTBL 
				where (MEDPAL = '$Medpal' and RuleActionID = '$resultAction_array[ID]')"; 
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query for delete on ClientRulesTBL (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: if_UArules.php";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
	} // End of Else - Delete	
}  // End of While

//----------------------------------------------------------------------------------------------------------
// Write to Access Log Table
//----------------------------------------------------------------------------------------------------------
AccessLogAdd("Client Rules Updated.", "Ok", $module, "", $conn);

$DisplayMsg = "Rules successfully Updated.";
		
//--------------------------------------------------------------------------------------------------
// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_UArules.php?msgTxt=$DisplayMsg");

?>
