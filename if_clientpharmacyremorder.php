<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_clientpharmacyremorder.php';

require ('hysInitAdminClient.php');

require ('hysDBinit.php');

//----------------------------------------------------------------------------------------------------------
// create the SQL statement.  If we have id do call otherwise empty set 
//----------------------------------------------------------------------------------------------------------
if (isset($_GET[clientid]) && ($_GET[clientid] != "") )
{
	$ClientID = $_GET[clientid];
	
	$sql = "SELECT ClientPharmacyTBL.OrderID as CP_OrderID, ClientPharmacyTBL.PharmacyID as pharmacyID, Name,
		AddrLine1, City, State
		from ClientPharmacyTBL 
		left join PharmacyTBL on ClientPharmacyTBL.PharmacyID = PharmacyTBL.ID
		left join AddrTBL on PharmacyTBL.AddrID = AddrTBL.ID
			where (ClientPharmacyTBL.MEDPAL = '$ClientID' and AddrTBL.OrderID = '1')
			ORDER BY ClientPharmacyTBL.OrderID"; 
		
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr -  Error doing mysql_query join for ClientPharmacyTBL AddrTBL. clientid = '$_GET[clientid]'count = '$countRows' sql = '$sql'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
		
	//----------------------------------------------------------------------------------------------------------
	// Initialize Variables
	//----------------------------------------------------------------------------------------------------------
	$DisplayList = "";
	$i = 1;
	$FlipFlag = 0;
	
	//----------------------------------------------------------------------------------------------------------
	// Get the data
	//----------------------------------------------------------------------------------------------------------
	while ($result_array = mysql_fetch_assoc($sql_result))
	{
		//----------------------------------------------------------------------------------------------------------
		// Build Name
		//----------------------------------------------------------------------------------------------------------
		$DisplayName = $result_array[Name]."    ".$result_array[City].", ".$result_array[State];
		
	
		if ($FlipFlag == 1)
		{
			$DisplayList .= " 
				<tr> 
					<td width=\"10%\" valign=center align=center height=20 class=\"tblDetailsmTextOn\">
						<a href=\"clientpharmacy.php?clientid=".$ClientID."&Action=remove&pharmacyid=".$result_array[pharmacyID]."\" target=\"clientpharmacymainFrame\"><img id=\"removehost\" height=15 width=15 border=\"0\" src=\"images/axe1ton.gif\" 
						alt=\"Remove Pharmacy from Client List\"></a>
					</td>
			
					<td width=\"10%\" valign=center align=center height=20 class=\"tblDetailsmTextOn\">
						<a href=\"clientpharmacy.php?clientid=".$ClientID."&Action=reorder&pharmacyid=".$result_array[pharmacyID]."\" target=\"clientpharmacymainFrame\"><img id=\"reorderhost\" height=15 width=15 border=\"0\" src=\"images/crown.gif\" 
						alt=\"Make Pharmacy Primary for Client\"></a>
					</td>
					
					<td width=\"10%\" align=center height=20 class=\"tblDetailsmTextOn\">&nbsp;</td>
					
					<td valign=left class=\"tblDetailsmTextOn\" id=\"td".$i."\" align=left height=20>".$DisplayName."</td> 
				</tr>
				";
				
			$FlipFlag = 0;	
		}
		else
		{
			$DisplayList .= " 
				<tr> 
					<td width=\"10%\" valign=center align=center height=20 class=\"tblDetailsmTextOff\">
						<a href=\"clientpharmacy.php?clientid=".$ClientID."&Action=remove&pharmacyid=".$result_array[pharmacyID]."\" target=\"clientpharmacymainFrame\"><img id=\"removehost\" height=15 width=15 border=\"0\" src=\"images/axe1t.gif\" 
						alt=\"Remove Pharmacy from Client List\"></a>
					</td>
			
					<td width=\"10%\" valign=center align=center height=20 class=\"tblDetailsmTextOff\">
						<a href=\"clientpharmacy.php?clientid=".$ClientID."&Action=reorder&pharmacyid=".$result_array[pharmacyID]."\" target=\"clientpharmacymainFrame\"><img id=\"reorderhost\" height=15 width=15 border=\"0\" src=\"images/crown.gif\" 
						alt=\"Make Pharmacy Primary for Client\"></a>
					</td>
					
					<td width=\"10%\" align=center height=20 class=\"tblDetailsmTextOff\">&nbsp;</td>
					
					<td valign=left class=\"tblDetailsmTextOff\" id=\"td".$i."\" align=left height=20>".$DisplayName."</td> 
				</tr>
				";
				
			$FlipFlag = 1;		
		}
		
		$i++;
		
	} // End of While	

}

?>

<html>

<head>
<title>HealthYourSelf Manage Provider Host Relationships</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />
<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>

<style type="text/css">

.leftLink   { 
		font: 700 13px Helvetica, Arial,Geneva;
		color: black; 
		line-height: 15px; 
		text-decoration: none;
		}
				
.leftLink:hover   { 
		color: blue;
		font: 700 13px Helvetica, Arial,Geneva;
		line-height: 15px; 
		text-decoration: underline;
		}

.leftLinkSelect   { 
		font: 700 13px Helvetica, Arial,Geneva;
		color: black; 
		line-height: 15px; 
		text-decoration: none;
		background-color:#99CC99;
		}
				
.leftLinkSelect:hover   { 
		color: black;
		font: 700 13px Helvetica, Arial,Geneva;
		line-height: 15px; 
		text-decoration: underline;
		background-color:#99CC99;
		}
		
</style>

<script type="text/javascript">
function startUp() 
{	
	<? print $JavaScriptLogMsg; ?> 
		
	<? print $JavaScriptMsg; ?>
}
</script>
 
</head>

<body onload="startUp()">
<table width="100%" cellspacing="0" cellpadding="0">
	<? print $DisplayList; ?>
</table>
</body>
</html>
