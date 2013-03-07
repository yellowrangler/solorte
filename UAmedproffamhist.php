<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'UAmedproffamhist.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

//----------------------------------------------------------------------------------------------------------
// create the SQL statement to Update our ClientFamilyHistoryTBL information.  
//----------------------------------------------------------------------------------------------------------

// First build an array of Name sfor update
$MedRelResponce =array();;
$MedCondID = array();
$RelTypeID = array();
//----------------------------------------------------------------------------------------------------------
// create the SQL statement 
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT MedicalCondition, MedicalConditionTBL.ID as MedCondID, 
	RelationshipTypeID, MedicalConditionID, FamilyResponce 
	from MedicalConditionTBL 
		left join ClientFamilyHistoryTBL on ClientFamilyHistoryTBL.MedicalConditionID = MedicalConditionTBL.ID
			 where ClientFamilyHistoryTBL.MEDPAL = '$Medpal'
			 	ORDER BY MedicalCondition, RelationshipTypeID";
 			
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query join for MedicalConditionTBL and ClientFamilyHistoryTBL tbls (195) - '$Medpal'";
	$location = "location: if_UAmedproffamhistdetail?msgTxt=$shortmsg";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// now lets fetch and build our Array
$i = 0;
while ($result_array = mysql_fetch_assoc($sql_result))
{
	$MedCondID[$i] = $result_array[MedicalConditionID];
	$RelTypeID[$i] = $result_array[RelationshipTypeID];
	$MedRelResponce[$i] = "M".$result_array[MedicalConditionID]."F".$result_array[RelationshipTypeID];
	
	$i++;
	
} // End of While	

// Now we update all the fields
for ($x = 0; $x < $i; $x++)
{
	//--------------------------------------------------------------------------------------------------
	// Update the ClientExternalTBL 
	//--------------------------------------------------------------------------------------------------
	$tmpResponce = $MedRelResponce[$x];
	$sql = "UPDATE ClientFamilyHistoryTBL 
				set FamilyResponce = '$_POST[$tmpResponce]'
				where (MEDPAL = '$Medpal' AND MedicalConditionID = '$MedCondID[$x]' AND RelationshipTypeID = '$RelTypeID[$x]')";
	
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query update ClientFamilyHistoryTBL (77) - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "location: if_UAmedproffamhistdetail?msgTxt=$shortmsg";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	
} // End of for

//----------------------------------------------------------------------------------------------------------
// Write to Access Log Table
//----------------------------------------------------------------------------------------------------------
AccessLogAdd("Family History Information update.", "Ok", $module, "", $conn);

//--------------------------------------------------------------------------------------------------
// update display variables
//--------------------------------------------------------------------------------------------------
$DisplayMsg = "Family History Information update successfull!";


//--------------------------------------------------------------------------------------------------
// end of Update 
//--------------------------------------------------------------------------------------------------
		
//--------------------------------------------------------------------------------------------------		
// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_UAmedproffamhistdetail.php?msgTxt=$DisplayMsg");

?>
