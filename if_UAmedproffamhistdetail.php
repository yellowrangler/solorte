<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_UAmedproffamhistdetail.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

require ('hysStatusMsg.php');

//----------------------------------------------------------------------------------------------------------
// create the SQL statement 
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT RelationshipTypeID, MedicalConditionID, FamilyResponce 
			from ClientFamilyHistoryTBL 
				 where ClientFamilyHistoryTBL.MEDPAL = '$Medpal'
				 	ORDER BY MedicalConditionID, RelationshipTypeID";
 			
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query join for MedicalConditionTBL and ClientFamilyHistoryTBL tbls (195) - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------	
// Now lets first see if there is anything to run through.  If have 0 then build ClientFamilyHistoryTBL
//----------------------------------------------------------------------------------------------------------
$countRows = mysql_num_rows($sql_result);
if ($countRows == 0)
{
	// Populate DB
	$sql = "SELECT MedicalCondition, ID as MedCondID 
				from MedicalConditionTBL 
					ORDER BY MedicalCondition";
					
	if (!$sql_result = mysql_query($sql, $conn))				
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query join for MedicalConditionTBL and ClientFamilyHistoryTBL tbls (195) - '$Medpal'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}		
	
	while ($result_array = mysql_fetch_assoc($sql_result))
	{
		// Enter Self
		$sql = "INSERT INTO ClientFamilyHistoryTBL 
					(MEDPAL, MedicalConditionID, RelationshipTypeID, FamilyResponce)  
					VALUES ('$Medpal', '$result_array[MedCondID]', '0', '')";
					
		if (!$sql_inner_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert ClientFamilyHistoryTBL (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
	
		// Enter Sibling
		$sql = "INSERT INTO ClientFamilyHistoryTBL 
					(MEDPAL, MedicalConditionID, RelationshipTypeID, FamilyResponce)  
					VALUES ('$Medpal', '$result_array[MedCondID]', '3', '')";
					
		if (!$sql_inner_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert ClientFamilyHistoryTBL (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		// Enter Parents
		$sql = "INSERT INTO ClientFamilyHistoryTBL 
					(MEDPAL, MedicalConditionID, RelationshipTypeID, FamilyResponce)  
					VALUES ('$Medpal', '$result_array[MedCondID]', '4', '')";
					
		if (!$sql_inner_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert ClientFamilyHistoryTBL (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
			// Enter Child
		$sql = "INSERT INTO ClientFamilyHistoryTBL 
					(MEDPAL, MedicalConditionID, RelationshipTypeID, FamilyResponce)  
					VALUES ('$Medpal', '$result_array[MedCondID]', '5', '')";
					
		if (!$sql_inner_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query insert ClientFamilyHistoryTBL (695) - '$Medpal'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
		
		
	} // End of While	
}	// End of if 0 count

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
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// start the display area 
$DisplayBlock = "";

$DisplayBlock .= "
	<form  action=\"UAmedproffamhist.php\" target=\"detailFrame\" method=post>
	<br>
	<center>
	<table width=\"80%\"class=\"OuterBordersmallText2\" border=1 cellspacing=0 cellpadding=5>
		<tr>
			<td align=center><b>Medical Condition</b></td>
			<td align=center><b>Self</b></td>
			<td align=center><b>Parent</b></td>	
			<td align=center><b>Sibling</b></td>
			<td align=center><b>Child</b></td>
		</tr>
	";
	
// now lets fetch and build our display
while ($result_array = mysql_fetch_assoc($sql_result))
{
	$DisplayBlock .= "
		<tr>
			<td align=left class=\"smTxt\">".$result_array[MedicalCondition]."</td>
			
			<td align=center class=\"smTxt\">
				<select class=\"smTxt\"
					name=\"M".$result_array[MedicalConditionID]."F".$result_array[RelationshipTypeID]."\"> 
					<option value=\"".$result_array[FamilyResponce]."\">".$result_array[FamilyResponce]."				
					<option value=\"Y\" >Y
					<option value=\"N\" >N
				</select>
			</td>
	";
		
	for ($i = 0; $i < 3; $i++)
	{
		$result_array = mysql_fetch_assoc($sql_result);
				
		$DisplayBlock .= "
		
			<td align=center class=\"smTxt\">
				<select class=\"smTxt\"
					name=\"M".$result_array[MedicalConditionID]."F".$result_array[RelationshipTypeID]."\"> 
					<option value=\"".$result_array[FamilyResponce]."\">".$result_array[FamilyResponce]."				
					<option value=\"Y\" >Y
					<option value=\"N\" >N
				</select>
			</td>
		";
	} // End of for
	
	$DisplayBlock .= "
		</tr>
	";
	
} // End of While	

$DisplayBlock .= "
	</table>
";

$DisplayBlock .= "
	<br>
	<center>
	<table>
		<tr>
			<td align=center><input type=submit size=150 NAME=\"SUBMIT\" VALUE=\"Submit\"></td>
			<td>&nbsp;</td>
			<td align=center><input type=reset size=150 NAME=\"RESET\" VALUE=\"Reset\"></td>
		</tr>
	</table>	
	</center>
	</form>
";

?>
<html>

<head>
<title>HealthYourSelf Customer IntrMedical Info</title>

<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css">

.OuterBordersmallText2 {
		font: 400 13px Arial, Geneva;
		line-height: 20px; 
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		background: white;
		}
		
.smTxt {
		font: 400 11px Arial, Geneva;
		line-height: 15px; 
		}		
</style>

<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>
<script type="text/javascript">
function startUp() 
{	
	<? print $JavaScriptLogMsg; ?> 
		
	<? print $JavaScriptMsg; ?>
}
</script>
</head>

<body onload="startUp()">

<? print $DisplayBlock; ?>

</body>
</html>
