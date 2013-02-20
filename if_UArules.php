<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_UArules.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysStatusMsg.php');

//----------------------------------------------------------------------------------------------------------
// get EventTypeTypes - Appointments, Vacc or Prescript renewals etc.
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT * from RuleEventTypeTBL
	ORDER BY ID"; 
			
// Make the call
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for RuleEventTypeTBL  (999) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// initialize display block
$DisplayEventTypeList = "";
$DisplayEventTypeID = "None";

// Now lets first see if there is anything to run through
$countRows = mysql_num_rows($sql_result);
if ($countRows >  0) 
{	
	// now lets run the table and get our EventType names
	while ($result_arr = mysql_fetch_assoc($sql_result))
	{
		$DisplayEventTypeList .= "\t\t\t\t<option value=\"".$result_arr[ID]."\" >".$result_arr[EventType]."\n ";
	}
}	

//----------------------------------------------------------------------------------------------------------
// Okay.  Big deal here.  We get all event types and then we use them in while loop for Rules that have
// been set.  Otherwise we build empty fields
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT * from RuleActionTBL
	ORDER BY ID"; 
			
// Make the call
if (!$sql_Action_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for RuleActionTBL  (999) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// Now lets first see if there is anything to run through
$countActionRows = mysql_num_rows($sql_Action_result);
if ($countActionRows == 0)
{
	$errmsg = "Error doing mysql_query for RuleActionTBL. Got 0 rows  (909) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------
// create the SQL statement to get our clients rules. 
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT * from ClientRulesTBL 
		inner join RuleActionTBL on ClientRulesTBL.RuleActionID = RuleActionTBL.ID
		inner join RuleEventTypeTBL on ClientRulesTBL.RuleEventTypeID = RuleEventTypeTBL.ID
		where ClientRulesTBL.MEDPAL = '$Medpal'
		ORDER BY ClientRulesTBL.RuleActionID";
			
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query join for ClientRulesTBL, RuleEventTypeTBL and RuleActionTBL (195) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------
// Initialize some variables
//----------------------------------------------------------------------------------------------------------
$DisplayBlock = "";

//----------------------------------------------------------------------------------------------------------
// Another goodie (not). We read in client record
//----------------------------------------------------------------------------------------------------------
$result_array = mysql_fetch_assoc($sql_result);

//----------------------------------------------------------------------------------------------------------
// Now we loop thru actual rule event types matching them with client records
//----------------------------------------------------------------------------------------------------------
while($resultActionArray = mysql_fetch_assoc($sql_Action_result))
{
	//------------------------------------------------------------------------------------------------------
	// if we have client records we check to see if we have match betwen cur client record and expected 
	// order of action types.  No match means build empty display and advance to next logical record
	// While at the same time do NOT advance client record.  When we match we advance both and create
	// filled out display
	//------------------------------------------------------------------------------------------------------
	if ($resultActionArray[ID] == $result_array[RuleActionID])
	{
		$DisplayBlock .= "\t<tr>\n";
		
		$DisplayBlock .= "\t\t<td align=left height=40><input type=\"checkbox\" name=\"action".$resultActionArray[ID]."\" value=\"".$result_array[RuleActionID]."\" checked></td>\n";
		
		$DisplayBlock .= "\t\t<td width=2 height=40>&nbsp;</td>\n";
		
		$DisplayBlock .= "\t\t<td align=left height=40>I wish to be notified by</td>\n";
		
		$DisplayBlock .= "\t\t<td width=2 height=40>&nbsp;</td>\n";
		
		$DisplayBlock .= "\t\t<td align=left height=40>\n";
		$DisplayBlock .= "\t\t\t<select name=\"ruleevent".$resultActionArray[ID]."\">\n";
		$DisplayBlock .= "\t\t\t\t<option class=\"smallTxtGry\" value=\"".$result_array[RuleEventTypeID]."\">".$result_array[EventType]."\n";
		$DisplayBlock .= $DisplayEventTypeList;
		$DisplayBlock .= "\t\t\t</select>\n";
		$DisplayBlock .= "\t\t</td>\n";
		
		$DisplayBlock .= "\t\t<td width=2 height=40>&nbsp;</td>\n";
		
		$DisplayBlock .= "\t\t<td align=left height=40><input size=2 maxlength=3 type=\"text\" name=\"interval".$resultActionArray[ID]."\" value=\"".$result_array[RuleInterval]."\"></td>\n";
		
		$DisplayBlock .= "\t\t<td width=2 height=40>&nbsp;</td>\n";
		
		$DisplayBlock .= "\t\t<td align=left height=40>DAYS before my</td>\n";
		
		$DisplayBlock .= "\t\t<td width=2 height=40>&nbsp;</td>\n";
		
		$DisplayBlock .= "\t\t<td align=left height=40><b>".$result_array[Action]."</b></td>\n";
		
		$DisplayBlock .= "\t</tr>\n";
		
		// Get the next record
		$result_array = mysql_fetch_assoc($sql_result);
	}
	else
	{
		$DisplayBlock .= "\t<tr>\n";
			
		$DisplayBlock .= "\t\t<td align=left height=40><input type=\"checkbox\" name=\"action".$resultActionArray[ID]."\" value=\"".$resultActionArray[ID]."\"></td>\n";
		
		$DisplayBlock .= "\t\t<td width=2 height=40>&nbsp;</td>\n";
		
		$DisplayBlock .= "\t\t<td align=left height=40>I wish to be notified by</td>\n";
		
		$DisplayBlock .= "\t\t<td width=2 height=40>&nbsp;</td>\n";
		
		$DisplayBlock .= "\t\t<td align=left height=40>\n";
		$DisplayBlock .= "\t\t\t<select name=\"ruleevent".$resultActionArray[ID]."\">\n";
		$DisplayBlock .= "\t\t\t\t<option class=\"smallTxtGry\" value=\"\">\n";
		$DisplayBlock .= $DisplayEventTypeList;
		$DisplayBlock .= "\t\t\t</select>\n";
		$DisplayBlock .= "\t\t</td>\n";
		
		$DisplayBlock .= "\t\t<td width=2 height=40>&nbsp;</td>\n";
		
		$DisplayBlock .= "\t\t<td align=left height=40><input size=2 maxlength=3 type=\"text\" name=\"interval".$resultActionArray[ID]."\" value=\"\"></td>\n";
		
		$DisplayBlock .= "\t\t<td width=2 height=40>&nbsp;</td>\n";
		
		$DisplayBlock .= "\t\t<td align=left height=40>DAYS before my</td>\n";
		
		$DisplayBlock .= "\t\t<td width=2 height=40>&nbsp;</td>\n";
		
		$DisplayBlock .= "\t\t<td align=left height=40><b>".$resultActionArray[Action]."</b></td>\n";
		
		$DisplayBlock .= "\t</tr>\n";
	}	
} // End of WHILE

?>
<html>

<head>
<title>HealthYourSelf Clinet Name Info</title>

<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css"> 

.detailBody {
		position: absolute;
		left:20px;
		top:45px; 
		width:650px;
		height:215px;
		background: white;
		border:1px solid black;
		}
		
.outerBorderblackfillSiennaSmTxt {
		font: 400 13px Arial, Geneva;
		line-height: 14px; 
		border-top:0px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		background: #ccccff;
		}	

.outerBorderblackSmTxt {
		font: 400 13px Arial, Geneva;
		line-height: 14px; 
		border-top:0px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		background: #ffffff;
		}	

.outerBorderMessageTitleBlue {
		color: white;
		font: 700 13px Arial,Helvetica;
		text-align: center;
		letter-spacing: 8px;
		border-top:1px solid #052faf;
		border-left:1px solid #052faf;
		border-right:1px solid #052faf;
		border-bottom:1px solid #052faf;
		background: #052faf;
}				
		
.fillSiennaSmTxt   { 
		font: 400 13px Arial, Geneva;
		background: #e8e188;
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

<body <?php print $BodySelectColor ?> onload="startUp()">

<div class="detailBody">
<form  action="UArules.php" method=post>
<table width="100%" class="outerBorderMessageTitleBlue">
	<tr>
		 <td height=20 align="center">Client Rules</td>
	</tr>	
</table>
<table width="100%" class="tblDetailsmTextOff">
	<?php print $DisplayBlock; ?>
</table>	

<br><center>
<table>
	<tr>
		<td align=center><input type=submit size=150 NAME="SUBMIT" VALUE="Submit"></td>
		<td>&nbsp;</td>
		<td align=center><input type=reset size=150 NAME="RESET" VALUE="Reset"></td>
	</tr>
</table>	
</center>	
</form>
</div>

</body>
</html>
