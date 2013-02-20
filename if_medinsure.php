<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_medinsure.php';

require ('hysInit.php');

require ('hysDBinit.php');

//----------------------------------------------------------------------------------------------------------
// create the SQL statement to get our insurance information.  We assume here that at most you have one 
// medical and one dental plan
// we do not yet provide for additional insurance (aflac, supplamental disbality etc.)
// first we look for insurance if we find it we build our display
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT * from ClientPayorTBL inner join PayorTBL on ClientPayorTBL.PayorID = PayorTBL.ID where (MEDPAL = '$Medpal')";
if (!$sql_result_global = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query join for client payor and payorTBL (195) - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}
	
// Now lets first see if there is anything to run through.  If more then 1 we have an error
$countRows = mysql_num_rows($sql_result_global);
if ($countRows > 2)
{
	$errmsg = " Error more then 2 rows returned in select on client payor table. count = '$countRows'  - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

// initialize our display block
$DisplayBlock = "";

// if we have no insurance 
if ($countRows == 0)
{
	$DisplayBlock = "<br><br><br><br><center><h2>You have no Medical Insurance on file with us.</h2></center>";
}
	
// if we have medical insurance then start building display
// now lets fetch our prescription information
while ($result_array = mysql_fetch_assoc($sql_result_global))
{
	// lets initialize our display variables
	$PayorName = "Not Supplied";
	$PayorURL = "Not Supplied";
	$GroupID = "Not Supplied";
	$SubscriberID = "Not Supplied";
	$PrimaryInsured = "Not Supplied";
	$PrimaryProvider = "Not Supplied";
	$OficeCoPay = "Not Supplied";
	$PayorTeleNbr = "Not Supplied";
	$ProviderID = "Not Found";
	
	// lets start assigning values to our display fields
	$TypeID = $result_array[TypeID];
	$GroupID = $result_array[GroupID];
	$SubscriberID = $result_array[SubscriberID];
	$OfficeCoPay = $result_array[OfficeCoPay];
	$PayorName = $result_array[Name];
	$PayorURL = $result_array[URL];
		
	// lets set some temp variables
	$tmpPrimaryInsuredID = $result_array[PrimaryInsuredID];
	$ProviderID = $result_array[PrimaryProviderID];
	$tmpPayorAddr = $result_array[AddrID];
	
	// get the full name of the primary insured
	$sql = "SELECT * from FullNameTBL where (ID = '$tmpPrimaryInsuredID')";
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query for full name  (195) - '$Medpal'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
		
	// Now lets first see if there is anything to run through.
	$countRows = mysql_num_rows($sql_result);
	if ($countRows != 1)
	{
		$errmsg = " Error No rows or more then 1 row returned in select on addr tbl. count = '$countRows'  - '$Medpal'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
	
	// now lets fetch our information
	$result_array = mysql_fetch_assoc($sql_result);

	// $tmpPrefix = trim($result_array[Prefix]);
	$tmpFirstName = trim($result_array[FirstName]);
	$tmpMI = trim($result_array[MI]);
	$tmpLastName = trim($result_array[LastName]);
	$tmpSuffix = trim($result_array[Suffix]);
	$tmpString = sprintf("%s %s %s %s", $tmpFirstName, $tmpMI, $tmpLastName, $tmpSuffix);
	
	// set our display value
	$PrimaryInsured = $tmpString;
	
	// now lets get our primary provider information
	$sql = "SELECT * from ProviderTBL inner join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID where (ProviderTBL.ID = '$ProviderID')";
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query for join provider and full name  (195) - '$Medpal'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
		
	// Now lets first see if there is anything to run through.  If do not get our 2 names  we have an error
	$countRows = mysql_num_rows($sql_result);
	if ($countRows != 1)
	{
		$errmsg = " Error No rows or more then 1 row returned in select on join provider and addr tbl. count = '$countRows'  - '$Medpal'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
	
	// now lets fetch our information
	$result_array = mysql_fetch_assoc($sql_result);

	// $tmpPrefix = trim($result_array[Prefix]);
	$tmpFirstName = trim($result_array[FirstName]);
	$tmpMI = trim($result_array[MI]);
	$tmpLastName = trim($result_array[LastName]);
	$tmpSuffix = trim($result_array[Suffix]);
	$tmpString = sprintf("%s %s %s %s", $tmpFirstName, $tmpMI, $tmpLastName, $tmpSuffix);
	$PrimaryProvider = $tmpString;

	// create the SQL statement to get our payor tele nbr
	$sql = "SELECT * from AddrTBL where (ID = '$tmpPayorAddr')";
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query for addr (2 ids) (195) - '$Medpal'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
		
	// Now lets first see if there is anything to run through.  If do not get our 2 names  we have an error
	$countRows = mysql_num_rows($sql_result);
	if ($countRows != 1)
	{
		$errmsg = " Error No rows or more then 1 row returned in select on addrtbl count = '$countRows'  - '$Medpal'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
	
	// fetch results
	$result_array = mysql_fetch_assoc($sql_result);
	
	// build final display variable
	$PayorTeleNbr = $result_array[PhoneNbr];
	
	switch ($TypeID)
	{
		case 1:
			$DisplayBlock .= "
				<div class=\"medInsureArea\">
				<table width=\"100%\" class=\"outerBorderMessageTitleBlue\">
					<tr>
						 <td height=20 align=center>Medical Insurance</td>
					</tr>	
				</table>
				";
				
			break;
		
		case 2:
			$DisplayBlock .= " 
				<div class=\"dentalInsureArea\">
				<table width=\"100%\" class=\"outerBorderMessageTitleBlue\">
					<tr>
						 <td height=20 align=center>Dental Insurance</td>
					</tr>	
				</table>
				";
				
			break;
			
		default:
			$errmsg = " Error TypeID is invalid  TypeID = '$TypeID'  - '$Medpal'";
			$location = "";
			$severity = 1;	
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
			break;
	}
	
	$DisplayBlock .= "
		<table class=\"tableText\" width=\"100%\">
			<tr>
				<td colspan=3>&nbsp;</td>
			</tr>		
	
			<tr>
				<td width=5>&nbsp;</td>
				<td align=left>Insurer:&nbsp;<a href=\"#\" onClick=\"(PopUpWindow('".$PayorURL."', 'f', 2))\" class=\"tblDetailsmTextLinkOff\">".$PayorName."</a></td>
				<td align=left>Group ID:&nbsp;<b>".$GroupID."</b></td>
			</tr>
	
			<tr>
				<td width=5>&nbsp;</td>
				<td align=left>Subscriber ID:&nbsp;<b>".$SubscriberID."</b></td>
				<td align=left>Primary Care Doctor:&nbsp;<a href=\"#\" onClick=\"(PopUpWindow('pudoctor.php?ProviderID=".$ProviderID."', 'r', 4))\" class=\"tblDetailsmTextLinkOff\">".$PrimaryProvider."</a></td>
			</tr>
	
			<tr>
				<td width=5>&nbsp;</td>
				<td align=left>Primary Insured:&nbsp;<b>".$PrimaryInsured."</b></td>
				<td align=left>Insurance Telephone Nbr:&nbsp;<b>".$PayorTeleNbr."</b></td>
			</tr>
	
			<tr>
				<td width=5>&nbsp;</td>
				<td align=left>Office visit Co-Pay:&nbsp;<b>".$OfficeCoPay."</b></td>
				<td align=left>&nbsp;</td>
			</tr>
	
			<tr>
				<td colspan=3>&nbsp;</td>
			</tr>
		
	</table>
	
	</div>
	";
	
} // end of while

?>
<html>

<head>
<title>HealthYourSelf Customer Intro</title>

<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css">
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


.medInsureArea {
		position: absolute;
		left:20px;
		top:35px;
		width:650px;
		height:215px;
		border-top:1px solid black;
		border-right:1px solid black;
		border-left:1px solid black;
		border-bottom:1px solid black;
		background: white;
		}

.dentalInsureArea {
		position: absolute;
		left:20px;
		top:320px;
		width:650px;
		height:215px;
		border-top:1px solid black;
		border-right:1px solid black;
		border-left:1px solid black;
		border-bottom:1px solid black;
		background: white;
		}
		
.tableText {
		font: 400 13px Arial, Geneva;
		line-height: 25px; 
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

<?php print $DisplayBlock; ?> 

</body>
</html>
