<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_clientproviderremorder.php';

require ('hysInitAdminClient.php');

require ('hysDBinit.php');

//----------------------------------------------------------------------------------------------------------
// create the SQL statement.  If we have id do call otherwise empty set 
//----------------------------------------------------------------------------------------------------------
if (isset($_GET[clientid]) && ($_GET[clientid] != "") )
{
	$ClientID = $_GET[clientid];
	
	$sql = "SELECT ClientProviderTBL.OrderID as CP_OrderID, ClientProviderTBL.ProviderID as providerID,
		FirstName, LastName, Suffix, MI, Prefix, 
		SpecTypeTBL.Description as SpecialtyDesc,	ProviderTypeTBL.Description as ProviderTypeDesc,
		AddrLine1, City, State
		from ClientProviderTBL 
		left join ProviderTBL on ClientProviderTBL.ProviderID = ProviderTBL.ID
		left join FullNameTBL  on ProviderTBL.FullNameID = FullNameTBL.ID
		left join SpecTypeTBL on ProviderTBL.SpecialtyID = SpecTypeTBL.ID
		left join ProviderTypeTBL on ProviderTBL.TypeID = ProviderTypeTBL.ID
		left join ProviderHostTBL on ClientProviderTBL.ProviderID = ProviderHostTBL.ProviderID
		left join HostTBL on ProviderHostTBL.HostID = HostTBL.ID
		left join AddrTBL on HostTBL.AddrID = AddrTBL.ID
			where (ClientProviderTBL.MEDPAL = '$ClientID' and AddrTBL.OrderID = '1' and ProviderHostTBL.OrderID = '1')
			ORDER BY ClientProviderTBL.OrderID"; 
		
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr -  Error doing mysql_query join for SpecTypeTBL FullNameTBL ClientProviderTBL ProviderHostTBL. clientid = '$_GET[clientid]'count = '$countRows' sql = '$sql'";
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
		
		$DisplayName = $result_array[LastName];
		if ($result_array[Suffix] != "")
		{
			$DisplayName .= " ".$result_array[Suffix];
		}
		
		$DisplayName .= ", ";
		
		if ($result_array[Prefix] != "")
		{
			$DisplayName .= $result_array[Prefix]." ";
		}
		
		$DisplayName .= $result_array[FirstName]." ".$result_array[MI]."    ".$result_array[City].", ".$result_array[State];
		
	
		if ($FlipFlag == 1)
		{
			$DisplayList .= " 
				<tr> 
					<td width=\"10%\" valign=center align=center height=20 class=\"tblDetailsmTextOn\">
						<a href=\"clientprovider.php?clientid=".$ClientID."&Action=remove&providerid=".$result_array[providerID]."\" target=\"clientprovidermainFrame\"><img id=\"removehost\" height=15 width=15 border=\"0\" src=\"images/axe1ton.gif\" 
						alt=\"Remove Provider from Client List\"></a>
					</td>
			
					<td width=\"10%\" valign=center align=center height=20 class=\"tblDetailsmTextOn\">
						<a href=\"clientprovider.php?clientid=".$ClientID."&Action=reorder&providerid=".$result_array[providerID]."\" target=\"clientprovidermainFrame\"><img id=\"reorderhost\" height=15 width=15 border=\"0\" src=\"images/crown.gif\" 
						alt=\"Make Provider Primary for Client\"></a>
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
						<a href=\"clientprovider.php?clientid=".$ClientID."&Action=remove&providerid=".$result_array[providerID]."\" target=\"clientprovidermainFrame\"><img id=\"removehost\" height=15 width=15 border=\"0\" src=\"images/axe1t.gif\" 
						alt=\"Remove Provider from Client List\"></a>
					</td>
			
					<td width=\"10%\" valign=center align=center height=20 class=\"tblDetailsmTextOff\">
						<a href=\"clientprovider.php?clientid=".$ClientID."&Action=reorder&providerid=".$result_array[providerID]."\" target=\"clientprovidermainFrame\"><img id=\"reorderhost\" height=15 width=15 border=\"0\" src=\"images/crown.gif\" 
						alt=\"Make Provider Primary for Client\"></a>
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
