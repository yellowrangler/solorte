<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_providerhostremorder.php';

require ('hysInitAdmin.php');

require ('hysDBinit.php');

//----------------------------------------------------------------------------------------------------------
// create the SQL statement.  If we have id do call otherwise empty set 
//----------------------------------------------------------------------------------------------------------
if (isset($_GET[providerid]) && ($_GET[providerid] != "") )
{
	$sql = "SELECT  Name, HostTBL.ID as hostID
		from HostTBL 
			left join ProviderHostTBL on HostTBL.ID = ProviderHostTBL.HostID
			WHERE ProviderHostTBL.ProviderID = '$_GET[providerid]'
			ORDER BY OrderID"; 
		
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query join for ProviderHostTBL HostTBL (195) sql = '$sql' Provider id = '$_GET[providerid]'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
			
	// Now lets first see if there is anything to run through.  If more then 1 we have an error
	$countRows = mysql_num_rows($sql_result);
	if ($countRows < 0)
	{
		$errmsg = " Error less then 0 rows returned in select on HostTBL ProviderHostTBL. count = '$countRows'";
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
		$DisplayName = $result_array[Name];
	
		if ($FlipFlag == 1)
		{
			$DisplayList .= " 
				<tr> 
					<td width=\"10%\" valign=center align=center height=20 class=\"tblDetailsmTextOn\">
						<a href=\"providerhost.php?hostid=".$result_array[hostID]."&Action=remove&providerid=".$_GET[providerid]."\" target=\"mainFrame\"><img id=\"removehost\" height=15 width=15 border=\"0\" src=\"images/axe1ton.gif\" 
						alt=\"Remove Host from Provider List\"></a>
					</td>
			
					<td width=\"10%\" valign=center align=center height=20 class=\"tblDetailsmTextOn\">
						<a href=\"providerhost.php?hostid=".$result_array[hostID]."&Action=reorder&providerid=".$_GET[providerid]."\" target=\"mainFrame\"><img id=\"reorderhost\" height=15 width=15 border=\"0\" src=\"images/crown.gif\" 
						alt=\"Make Host Primary for Provider\"></a>
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
						<a href=\"providerhost.php?hostid=".$result_array[hostID]."&Action=remove&providerid=".$_GET[providerid]."\" target=\"mainFrame\"><img id=\"removehost\" height=15 width=15 border=\"0\" src=\"images/axe1t.gif\" 
						alt=\"Remove Host from Provider List\"></a>
					</td>
			
					<td width=\"10%\" valign=center align=center height=20 class=\"tblDetailsmTextOff\">
						<a href=\"providerhost.php?hostid=".$result_array[hostID]."&Action=reorder&providerid=".$_GET[providerid]."\" target=\"mainFrame\"><img id=\"reorderhost\" height=15 width=15 border=\"0\" src=\"images/crown.gif\" 
						alt=\"Make Host Primary for Provider\"></a>
					</td>
					
					<td width=\"10%\" align=center height=20 class=\"tblDetailsmTextOff\">&nbsp;</td>
								
					<td valign=left class=\"tblDetailsmTextOff\" id=\"td".$i."\" align=left height=20>".$DisplayName."	</td> 
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
