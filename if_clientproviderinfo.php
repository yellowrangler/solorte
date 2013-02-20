<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_clientproviderinfo.php';

require ('hysInitAdminClient.php');

require ('hysDBinit.php');

require ('hysStatusMsg.php');

//----------------------------------------------------------------------------------------------------------
//  we need to see if we have been passed a ProviderID
//----------------------------------------------------------------------------------------------------------
$displayTitle = "Provider Detail";
$ClientID = $Medpal;

if (isset($_GET[providerid]) && ($_GET[providerid] != "") )
{
	//Get host id and set flag to is update
	$ProviderID = $_GET[providerid];
	$ButtonHidden = "";
	
	//----------------------------------------------------------------------------------------------------------
	// create the SQL statement
	//----------------------------------------------------------------------------------------------------------
	$sql = "SELECT distinct ProviderTBL.ID as providerID, 
		FirstName, LastName, Suffix, MI, Prefix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone,
		SpecTypeTBL.ID as SpecialtyID, SpecTypeTBL.Description as SpecialtyDesc, 
		ProviderTypeTBL.Description as ProviderTypeDesc, ProviderTypeTBL.ID as ProviderTypeID,
		AddrLine1, AddrLine2, City, State
		from ProviderTBL 
		left join FullNameTBL  on ProviderTBL.FullNameID = FullNameTBL.ID
		left join SpecTypeTBL on ProviderTBL.SpecialtyID = SpecTypeTBL.ID
		left join ProviderTypeTBL on ProviderTBL.TypeID = ProviderTypeTBL.ID
		left join ProviderHostTBL on ProviderTBL.ID = ProviderHostTBL.ProviderID
		left join HostTBL on ProviderHostTBL.HostID = HostTBL.ID
		left join AddrTBL on HostTBL.AddrID = AddrTBL.ID
			where (ProviderTBL.ID = '$ProviderID' and ProviderHostTBL.OrderID = '1')"; 
		
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query join for ProviderTBL, SpecTypeTBL, ProviderTypeTBL and FullNameTBL (195) sql = '$sql'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
		
	// Now lets first see if there is anything to run through.  If more then 1 we have an error
	$countRows = mysql_num_rows($sql_result);
	if ($countRows > 1)
	{
		$errmsg = " Error more then 1 rows returned in select on ProviderTBL. count = '$countRows'  - ProviderID =  '$ProviderID'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
	
	//----------------------------------------------------------------------------------------------------------
	// Get the data
	//----------------------------------------------------------------------------------------------------------
	$result_array = mysql_fetch_assoc($sql_result);
	
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
	
	$DisplayName .= $result_array[FirstName]." ".$result_array[MI];	

}
else
{
	//----------------------------------------------------------------------------------------------------------
	// Build empty screen - This is an add
	//----------------------------------------------------------------------------------------------------------
	$ButtonHidden = "type=\"hidden\"";
	
	$DisplayName = "";
}	
	
?>
<html>

<head>
<title>HealthYourSelf Customer Intro</title>

<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css"> 

.outerBorderTitleGreenLetterSpace {
		color: white;
		font: 700 13px Arial,Helvetica;
		text-align: center;
		letter-spacing: 8px;
		border-top:0px solid #006633;
		border-left:1px solid #006633;
		border-right:1px solid #006633;
		border-bottom:0px solid #006633;
		background: #006633;
		}

.providerdetailBody {
		position: absolute;
		left:20px;
		top:38px; 
		width:422px;
		height:300px;
		background-color: white;
		border:1px solid black;
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
		
.SmTxt   { 
		font: 400 13px Arial, Geneva;
		}			
						
.tableTextName {
		font: 400 13px Arial, Geneva;
		line-height: 15px; 
		border-top:0px solid black;
		border-right:0px solid black;
		border-left:0px solid black;
		border-bottom:0px solid black;
		background: white;
		}
		
.tableHdrRow {
		font: 400 13px Arial, Geneva;
		line-height: 15px; 
		border-top:0px solid black;
		border-right:0px solid black;
		border-left:0px solid black;
		border-bottom:0px solid black;
		color:black;
		background: #99FFCC;
		}	
		
.remordertitleClientProviderList {
		position: absolute;
		left:20px;
		top:370px;
		width:422px;
		height:272px;
		background: white;
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		}

.innerremorderClientProviderList {
		position: absolute;
		left:0px;
		top:20px;
		width:420px;
		height:250px;
		background: white;
		border-top:0px solid black;
		border-left:0px solid black;
		border-right:0px solid black;
		border-bottom:0px solid black;
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

<div class="providerdetailBody">
<form  action="clientprovider.php" target="clientprovidermainFrame" method=post>
<table width="100%" class="outerBorderMessageTitleBlue">
	<tr>
		 <td height=20 align="center"><?php print $displayTitle; ?></td>
	</tr>	
</table>

<table width="100%" class="SmTxt">
	<tr>
		<td align=right colspan=4 height=15>&nbsp;</td>
	</tr>
	<tr>
		<td align=right height=35>Provider Name:</td>
		<td align=left><input class ="readonlyText" readonly size=35 maxlength=35 type="text" name="providername" value="<?php print $DisplayName; ?>"></td>
	</tr>
	<tr>
		<td align=right>Provider Type:</td>
		<td align=left><input class ="readonlyText" readonly size=25 maxlength=25 type="text" name="specialtytype" value="<?php print $result_array[ProviderTypeDesc]; ?>"></td>
	</tr>
	<tr>		
		<td align=right>Specialty Type:</td>
		<td align=left><input class ="readonlyText" readonly size=25 maxlength=25 type="text" name="specialtytype" value="<?php print $result_array[SpecialtyDesc]; ?>"></td>
	</tr>
	<tr>
		<td align=right>Address:</td>
		<td align=left><input class ="readonlyText" readonly size=40 maxlength=40 type="text" name="address" value="<?php print $result_array[AddrLine1]; ?>"></td>
	</tr>
	<tr>		
		<td align=right>City:</td>
		<td align=left><input class ="readonlyText" readonly size=15 maxlength=15 type="text" name="city" value="<?php print $result_array[City]; ?>"></td>
	</tr>
	<tr>		
		<td align=right>State:</td>
		<td align=left><input class ="readonlyText" readonly size=2 maxlength=2 type="text" name="city" value="<?php print $result_array[State]; ?>"></td>
	</tr>
</table>
<input type="hidden" name="providerid" value="<?php print $result_array[providerID]; ?>">	
<input type="hidden" name="clientid" value="<?php print $ClientID; ?>">	
<input type="hidden" name="Action" value="add">	
<br><center>
<table>
	<tr>
		<td align=center><input <?php print $ButtonHidden; ?> type=submit size=150 NAME="SUBMIT" VALUE="Add"></td>
	</tr>
</table>	
</center>	
</form>
</div>

<div class="remordertitleClientProviderList">
<table width="100%" height=20 class="outerBorderTitleGreenLetterSpace">
	<tr>
		<td align="center"><b>Remove or Re-Order</b></td>
	</tr>	
</table>

<IFRAME name="remorderClientHostFrame" src="if_clientproviderremorder.php?clientid=<?php print $ClientID; ?>"  target="clientprovidermainFrame" class="innerremorderClientProviderList" scrolling="yes"></IFRAME>
</div>
</body>
</html>
