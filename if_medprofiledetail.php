<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_medprofiledetail.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

require ('hysStatusMsg.php');

//----------------------------------------------------------------------------------------------------------
// create the SQL statement to get our clients medical profile.  This will involve a join between the 
// external and internal medical tables
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT * from ClientExternalTBL 
	left join ClientInternalTBL on ClientExternalTBL.MEDPAL = ClientInternalTBL.MEDPAL
	left join ClientSocialProfileTBL on ClientExternalTBL.MEDPAL = ClientSocialProfileTBL.MEDPAL
	left join ClientTBL on ClientExternalTBL.MEDPAL = ClientTBL.MEDPAL
	 where ClientExternalTBL.MEDPAL = '$Medpal'";
 			
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query join for internal and external and client tbls (195) - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------	
// Now lets first see if there is anything to run through.  If more then 1 we have an error
//----------------------------------------------------------------------------------------------------------
$countRows = mysql_num_rows($sql_result);
if ($countRows > 1)
{
	$errmsg = " Error more then 1 rows returned in select for internal and external and client tbls. count = '$countRows'  - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

// now lets fetch and build our display
$result_array = mysql_fetch_assoc($sql_result);

//---------------------------------------------------------------------------------------------------------
// Build Height and date
//---------------------------------------------------------------------------------------------------------
$tmpHeight = explode("~",$result_array["Height"]);
$DisplayHeight = sprintf("%s feet %s inches", $tmpHeight[0], $tmpHeight[0]);
$DisplayDOB = CovertMySQLDate($result_array["DOB"], 1, 1);

// initialize display block
$DisplayBlock = "";

// lets build display block for  external
$DisplayBlock .= "
		<table class=\"OuterBordersmallText2\" width=\"100%\">
			<tr>
				<td width=5>&nbsp;</td>
				<td colspan=2 class=\"headerBorderGold\"><i>External Anatomy</i></td>
			</tr>
			
			<tr>
				<td width=5>&nbsp;</td>
				<td align=left> Height: <b>".$DisplayHeight."</b></td>
				<td align=left> Weight: <b>".$result_array[Weight]."</b></td>
			</tr>
			
			<tr>
				<td width=5>&nbsp;</td>
				<td align=left> Eye Color: <b>".$result_array[EyeColor]."</b></td>
				<td align=left> Eyes: <b>".$result_array[Eyes]."</b></td>
			</tr>
			
			<tr>
				<td width=5>&nbsp;</td>
				<td align=left> Sex: <b>".$result_array[Sex]."</b></td>
				<td align=left> Hair Color: <b>".$result_array[HairColor]."</b></td>
			</tr>		
			
			<tr>
				<td width=5>&nbsp;</td>
				<td align=left> Vision: <b>".$result_array[Vision]."</b></td>
				<td align=left> Glasses: <b>".$result_array[Glasses]."</b></td>
			</tr>	
			<tr>
				<td width=5>&nbsp;</td>
				<td align=left> Date of Birth: <b>".$DisplayDOB."</b></td>
				<td align=left> Ears: <b>".$result_array[Ears]."</b></td>
			</tr>
			
			<tr>
				<td width=5>&nbsp;</td>
				<td align=left> Hearing: <b>".$result_array[Hearing]."</b></td>
				<td align=left> Hearing Aide: <b>".$result_array[HearingAide]."</b></td>
			</tr>
			
			<tr>
				<td width=5>&nbsp;</td>
				<td align=left> Skin: <b>".$result_array[Skin]."</b></td>
				<td align=left> Nose: <b>".$result_array[Nose]."</b></td>
			</tr>
			<tr>
				<td width=5>&nbsp;</td>
				<td align=left> Mouth: <b>".$result_array[Mouth]."</b></td>
				<td align=left> Teeth: <b>".$result_array[Teeth]."</b></td>
			</tr>
			<tr>
				<td width=5>&nbsp;</td>
				<td align=left colspan=2> Prosthesis: <b>".$result_array[Prosthesis]."</b></td>
			</tr>
		</table>	
			
		<br>
		
		<table class=\"OuterBordersmallText2\" width=\"100%\">
			<tr>
				<td width=5>&nbsp;</td>
				<td colspan=2 class=\"headerBorderGold\"><i>Social Health</i></td>
			</tr>
			
			<tr>
				<td width=5>&nbsp;</td>
				<td align=left> Current Smoker (Y/N): <b>".$result_array[CurSmoker]."</b></td>
				<td align=left> Former Smoker (Y/N): <b>".$result_array[FormerSmoker]."</b></td>
			</tr>
			
			<tr>
				<td width=5>&nbsp;</td>
				<td colspan=2 align=left>What was smokeed: <b>".$result_array[SmokerType]."</b></td>
			</tr>
			
			<tr>
				<td width=5>&nbsp;</td>
				<td align=left>  Smoked per month: <b>".$result_array[SmokerperMonth]."</b></td>
				<td align=left>  Years smoked: <b>".$result_array[SmokerYears]."</b></td>
			</tr>
			
			<tr>
				<td width=5>&nbsp;</td>
				<td align=left> Alcohol use (Y/N): <b>".$result_array[Alcohol]."</b></td>
				<td align=left> Alcohol drinks per month: <b>".$result_array[AlcoholperMonth]."</b></td>
			</tr>
			
			<tr>
				<td width=5>&nbsp;</td>
				<td align=left> Exersize regularly (Y/N): <b>".$result_array[Exersize]."</b></td>
				<td align=left> Exersize per month: <b>".$result_array[ExersizeperMonth]."</b></td>
			</tr>
			
			<tr>
				<td width=5>&nbsp;</td>
				<td colspan=2 align=left>Describe exersize: <b>".$result_array[ExersizeDescription]."</b></td>
			</tr>
		</table>	
	
	<br>
		
		<table class=\"OuterBordersmallText2\" width=\"100%\">
			<tr>
				<td width=5>&nbsp;</td>
				<td colspan=2 class=\"headerBorderGold\"><i>Internal Anatomy</i></td>
			</tr>
			
			<tr>
				<td width=5>&nbsp;</td>
				<td align=left> Systolic Pressure: <b>".$result_array[SystolicPressure]."</b></td>
				<td align=left> Diastolic Pressure: <b>".$result_array[DiastolicPressure]."</b></td>
			</tr>
			
			<tr>
				<td width=5>&nbsp;</td>
				<td align=left> Cholesterol LDL: <b>".$result_array[LDL]."</b></td>
				<td align=left> Cholesterol HDL: <b>".$result_array[HDL]."</b></td>
			</tr>
			
			<tr>
				<td width=5>&nbsp;</td>
				<td align=left>  Blood Type: <b>".$result_array[BloodType]."</b></td>
				<td align=left> &nbsp;</td>
			</tr>
			
			<tr>
				<td width=5>&nbsp;</td>
				<td colspan=2 width=\"100%\" align=left> &nbsp;</td>
			</tr>
			
			<tr>
				<td width=5>&nbsp;</td>
				<td colspan=2 width=\"100%\" align=left> Skeletal: <b>".$result_array[Skeletal]."</b></td>
			</tr>
			
			<tr>
				<td width=5>&nbsp;</td>
				<td colspan=2 width=\"100%\" align=left> Muscular: <b>".$result_array[Muscular]."</b></td>
			</tr>
			
			<tr>
				<td width=5>&nbsp;</td>
				<td colspan=2 width=\"100%\" align=left>  Digestive: <b>".$result_array[Digestive]."</b></td>
			</tr>
			
			<tr>
				<td width=5>&nbsp;</td>
				<td colspan=2 width=\"100%\" align=left> Respiratory: <b>".$result_array[Respiratory]."</b></td>
			</tr>
			
			<tr>
				<td width=5>&nbsp;</td>
				<td colspan=2 width=\"100%\" align=left> Urinary: <b>".$result_array[Urinary]."</b></td>
			</tr>
			
			<tr>
				<td width=5>&nbsp;</td>
				<td colspan=2 width=\"100%\" align=left> Nervous:> <b>".$result_array[Nervous]."</b></td>
			</tr>		
			
			<tr>
				<td width=5>&nbsp;</td>
				<td colspan=2 width=\"100%\" align=left> Circulatory: <b>".$result_array[Circulatory]."</b></td>
			</tr>
			
			<tr>
				<td width=5>&nbsp;</td>
				<td colspan=2 width=\"100%\" align=left> Endocrine: <b>".$result_array[Endocrine]."</b></td>
			</tr>
			
			<tr>
				<td width=5>&nbsp;</td>
				<td colspan=2 width=\"100%\" align=left> Reproductive: <b>".$result_array[Reproductive]."</b></td>
			</tr>
			
			<tr>
				<td width=5>&nbsp;</td>
				<td colspan=2 width=\"100%\" align=left> Immune: <b>".$result_array[Immune]."</b></td>
			</tr>
		</table>	
	";

// create the SQL statement to get our clients medical profile for alergies. The client may have many so we need to set up an iteritive process
$sql = "SELECT * from ClientAllergyTBL where (MEDPAL = '$Medpal') order by OrderID";			
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query allergyl tbls (195) - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// build the allergy header here for display
// lets build display block for  external
$DisplayBlock .= "<br><table class=\"smallText2\" width=\"100%\">\n\t<tr>\n\t\t<td class=\"headerBorderGold\"><i>Allergies</i></td>\n\t</tr>\n</table><br>";
$DisplayBlock .= "<table width=\"100%\" class=\"tblDetailsmTextOff\">";
	
// Now lets first see if there is anything to run through.  If 0 then build block that says nothing otherwise iterate thru
$countRows = mysql_num_rows($sql_result);
if ($countRows == 0)
{
	$DisplayBlock .= "\t<tr>\n\t\t<td width=\"100%\" align=left class=\"tblDetailsmTextLinkOff\">No Allergies on File</td>\n\t</tr>\n";
}	
else
{
	$i = 1;
	
	// now lets fetch and build our display
	while ($result_array = mysql_fetch_assoc($sql_result))
	{
		// lets build display block for allergies
		$DisplayBlock .= "\t<tr>\t\t<td width=\"2%\" valign=top align=right>".$i.":</td>\n\t\t<td align=left><b>".$result_array[Allergy]."</b></td>\n\t</tr>\n";
		
		$i++;
	}
}

// add final table end
$DisplayBlock .= "</table>\n";	

// now lets get long term conditions
// create the SQL statement to get our clients medical profile for chronic diseases. The client may have many so we need to set up an iteritive process
$sql = "SELECT * from ClientCronicConditionTBL where (MEDPAL = '$Medpal') order by OrderID";			
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query chronic cond tbls (195) - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// build the allergy header here for display
// lets build display block for  external
$DisplayBlock .= "<br><table class=\"smallText2\" width=\"100%\">\n\t<tr>\n\t\t<td class=\"headerBorderGold\"><i>Long Term Medical Conditions</i></td>\n\t</tr>\n</table><br>";
$DisplayBlock .= "<table width=\"100%\" class=\"tblDetailsmTextOff\">";
	
// Now lets first see if there is anything to run through.  If 0 then build block that says nothing otherwise iterate thru
$countRows = mysql_num_rows($sql_result);
if ($countRows == 0)
{
	$DisplayBlock .= "\t<tr>\n\t\t<td width=\"100%\" align=left class=\"tblDetailsmTextLinkOff\">No Long Term Issues on File</td>\n\t</tr>\n";
}	
else
{
	$i = 1;
	
	// now lets fetch and build our display
	while ($result_array = mysql_fetch_assoc($sql_result))
	{
		// lets build display block for allergies
		$DisplayBlock .= "\t<tr>\t\t<td width=\"2%\" valign=top align=right>".$i.":</td>\n\t\t<td align=left><b>".$result_array[Condition]."</b></td>\n\t</tr>\n";
		
		$i++;
	}	
}

// add final table end
$DisplayBlock .= "</table>\n";	

// now lets get Behavioral Conditions
// create the SQL statement to get our clients medical profile for chronic diseases. The client may have many so we need to set up an iteritive process
$sql = "SELECT * from ClientBehavioralTBL where (MEDPAL = '$Medpal') order by OrderID";			
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query beahvioral tbls (195) - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// build the allergy header here for display
// lets build display block for  external
$DisplayBlock .= "<br><table class=\"smallText2\" width=\"100%\">\n\t<tr>\n\t\t<td class=\"headerBorderGold\"><i>Behavioral Conditions</i></td>\n\t</tr>\n</table><br>";
$DisplayBlock .= "<table width=\"100%\" class=\"tblDetailsmTextOff\">";
	
// Now lets first see if there is anything to run through.  If 0 then build block that says nothing otherwise iterate thru
$countRows = mysql_num_rows($sql_result);
if ($countRows == 0)
{
	$DisplayBlock .= "\t<tr>\n\t\t<td width=\"100%\" align=left class=\"tblDetailsmTextLinkOff\">No Behavioral Conditions on File</td>\n\t</tr>\n";
}	
else
{
	$i = 1;
	
	// now lets fetch and build our display
	while ($result_array = mysql_fetch_assoc($sql_result))
	{
		// lets build display block for allergies
		$DisplayBlock .= "\t<tr>\t\t<td width=\"2%\" valign=top align=right>".$i.":</td>\n\t\t<td align=left><b>".$result_array[Behavior]."</b></td>\n\t</tr>\n";
		
		$i++;
	}
}

// add final table end
$DisplayBlock .= "</table>\n";	

// now lets get Special Instructions
// create the SQL statement to get our clients medical profile for chronic diseases. The client may have many so we need to set up an iteritive process
$sql = "SELECT * from ClientSpecialInstructionsTBL where (MEDPAL = '$Medpal') order by OrderID";			
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query special instructions tbls (195) - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// build the allergy header here for display
// lets build display block for  external
$DisplayBlock .= "<br><table class=\"smallText2\" width=\"100%\">\n\t<tr>\n\t\t<td class=\"headerBorderGold\"><i>Special Instructions</i></td>\n\t</tr>\n</table><br>";
$DisplayBlock .= "<table width=\"100%\" class=\"tblDetailsmTextOff\">";
	
// Now lets first see if there is anything to run through.  If 0 then build block that says nothing otherwise iterate thru
$countRows = mysql_num_rows($sql_result);
if ($countRows == 0)
{
	$DisplayBlock .= "\t<tr>\n\t\t<td width=\"100l%\" align=left class=\"tblDetailsmTextLinkOff\">No Special Instructions on File</td>\n\t</tr>\n";
}	
else
{
	$i = 1;
			
	// now lets fetch and build our display
	while ($result_array = mysql_fetch_assoc($sql_result))
	{	
		// lets build display block for allergies
		$DisplayBlock .= "\t<tr>\t\t<td width=\"2%\" valign=top align=right>".$i.":</td>\n\t\t<td align=left><b>".$result_array[SpecialInstructions]."</b></td>\n\t</tr>\n";
		
		$i++;
	}
}

// add final table end
$DisplayBlock .= "</table>\n";	

//----------------------------------------------------------------------------------------------------------
// Family History
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

$DisplayBlock .= "
	<br>
	<table class=\"OuterBordersmallText2\" width=\"100%\">
		<tr>
			<td width=5>&nbsp;</td>
			<td colspan=2 class=\"headerBorderGold\"><i>Family History</i></td>
		</tr>
	</table>	
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
	";		
			if (($result_array[FamilyResponce] == " ") OR ($result_array[FamilyResponce] == ""))
			{
				$DisplayBlock .= "
					<td align=center class=\"smTxt\">&nbsp;</td>
				";	
			}
			else
			{
				$DisplayBlock .= "
					<td align=center class=\"smTxt\">".$result_array[FamilyResponce]."</td>
				";	
			}	
		
	for ($i = 0; $i < 3; $i++)
	{
		$result_array = mysql_fetch_assoc($sql_result);
					
		if (($result_array[FamilyResponce] == " ") OR ($result_array[FamilyResponce] == ""))
		{
			$DisplayBlock .= "
				<td align=center class=\"smTxt\">&nbsp;</td>
			";	
		}
		else
		{
			$DisplayBlock .= "
				<td align=center class=\"smTxt\">".$result_array[FamilyResponce]."</td>
			";	
		}	
	} // End of for
	
	$DisplayBlock .= "
		</tr>
	";
	
} // End of While	

$DisplayBlock .= "
	</table>
	<br>
";

?>
<html>

<head>
<title>HealthYourSelf Customer IntrMedical Info</title>

<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css">

.OuterBordersmallText2 {
		font: 400 13px Arial, Geneva;
		line-height: 25px; 
		border-top:0px solid black;
		border-left:0px solid black;
		border-right:0px solid black;
		border-bottom:0px solid black;
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
	<?php print $JavaScriptLogMsg; ?>
		
	<?php print $JavaScriptMsg; ?>
}
</script>
</head>

<body onload="startUp()">

<?php print $DisplayBlock; ?>

</body>
</html>
