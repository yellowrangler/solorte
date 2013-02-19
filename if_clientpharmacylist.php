<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_clientpharmacylist.php';

require ('hysInitAdminClient.php');

require ('hysDBinit.php');

//----------------------------------------------------------------------------------------------------------
// create the SQL statement -- Note:  This is default (no get or post data 
//----------------------------------------------------------------------------------------------------------
if (isset($_POST[Search]))
{
	$sql = "SELECT  PharmacyTBL.ID as PharmID, Name, AddrLine1, City, State
		from PharmacyTBL 
		left join AddrTBL on PharmacyTBL.AddrID = AddrTBL.ID
			WHERE (Name LIKE '%$_POST[Search]%' and AddrTBL.OrderID = '1')
			ORDER BY Name, State";  
		
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query join for PharmacyTBL with LIKE (194) sql = '$sql'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
}
else
{	
	$sql = "SELECT  PharmacyTBL.ID as PharmID, Name, AddrLine1, City, State
		from PharmacyTBL 
		left join AddrTBL on PharmacyTBL.AddrID = AddrTBL.ID
			WHERE (AddrTBL.OrderID = '1')
			ORDER BY Name, State";    
		
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query join for PharmacyTBL (195) sql = '$sql'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
}
	
// Now lets first see if there is anything to run through.  If more then 1 we have an error
$countRows = mysql_num_rows($sql_result);
if ($countRows < 0)
{
	$errmsg = " Error less then 0 rows returned in select on PharmacyTBL. count = '$countRows'";
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
	// $DisplayName = $result_array[Name]."-".$result_array[City].", ".$result_array[State];
	$DisplayName = $result_array[Name];

	if ($FlipFlag == 1)
	{	
		$DisplayList .= " 
			<tr> 
				<td valign=left class=\"tblDetailsmTextOff\" id=\"td".$i."\" align=left height=20>
					<a id=\"a".$i."\" href=\"if_clientpharmacyinfo.php?pharmacyid=".$result_array[PharmID]."\" target=\"clientpharmacymainFrame\" target=\"ClientProviderListFrame\" class=\"tblDetailsmTextOff\">".$DisplayName."</a>
				</td> 
			</tr>
			";
			
		$FlipFlag = 0;		
	}
	else
	{
		$DisplayList .= " 
			<tr> 
				<td valign=left class=\"tblDetailsmTextOn\" id=\"td".$i."\" align=left height=20>
					<a id=\"a".$i."\" href=\"if_clientpharmacyinfo.php?pharmacyid=".$result_array[PharmID]."\" target=\"clientpharmacymainFrame\" class=\"tblDetailsmTextOn\">".$DisplayName."</a>
				</td> 
			</tr>
			";
			
		$FlipFlag = 1;		
	}
		
	$i++;
	
} // End of While	

?>

<html>

<head>
<title>HealthYourSelf Manage Client Pharmacy Information</title>
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
