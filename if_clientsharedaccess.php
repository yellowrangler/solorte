<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_clientsharedaccess.php';

require ('hysInitAdminClient.php');

require ('hysDBinit.php');

require ('hysStatusMsg.php');

//----------------------------------------------------------------------------------------------------------
// lets get Authorization Level names
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT ID, Level from AuthorizationLevelTypeTBL"; 

//----------------------------------------------------------------------------------------------------------
// Make the call
//----------------------------------------------------------------------------------------------------------
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for AuthorizationLevelTypeTBL  (495)";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------
// initialize display block
//----------------------------------------------------------------------------------------------------------
$DisplayAuthorizationLevelTypeList = "";

//----------------------------------------------------------------------------------------------------------
// Now lets first see if there is anything to run through
//----------------------------------------------------------------------------------------------------------
$countRows = mysql_num_rows($sql_result);
if ($countRows >  0) 
{	
	// now lets run the table and get our provider names
	while ($result_arr = mysql_fetch_assoc($sql_result))
	{
		$DisplayAuthorizationLevelTypeList .= "\t\t\t<option value=\"".$result_arr[ID]."\" >".$result_arr[Level]."\n ";
	}
}	

//----------------------------------------------------------------------------------------------------------
//  we need to see if we have been passed a AccessClientID
//----------------------------------------------------------------------------------------------------------
$AccessClientID = "";
$DisplayName = "";
$DisplayDOB = "";

if (isset($_GET[accessuserid]) && ($_GET[accessuserid] != "") )
{
	//Get host id and set flag to is update
	$AccessClientID = $_GET[accessuserid];
	$ButtonHidden = "";
	
	//----------------------------------------------------------------------------------------------------------
	// create the SQL statement
	//----------------------------------------------------------------------------------------------------------
	$sql = "SELECT 	DOB, FirstName, LastName, Suffix, MI, Prefix,
		AddrLine1, AddrLine2, City, State
		from ClientTBL 
		left join FullNameTBL  on ClientTBL.FullNameID = FullNameTBL.ID
		left join ClientAddrTBL on ClientTBL.MEDPAL = ClientAddrTBL.MEDPAL
		left join AddrTBL on ClientAddrTBL.AddrID = AddrTBL.ID
			where (ClientTBL.MEDPAL = '$AccessClientID' and AddrTBL.OrderID = '1')"; 
		
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query join for ClientTBL, ClientAddrTBL, AddrTBL and FullNameTBL (195) sql = '$sql'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
		
	// Now lets first see if there is anything to run through.  If more then 1 we have an error
	$countRows = mysql_num_rows($sql_result);
	if ($countRows > 1)
	{
		$errmsg = " Error more then 1 rows returned in select on ClientTBL. count = '$countRows'  - AccessClientID =  '$AccessClientID'";
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

	//------------------------------------------------------------------------------------------------------
	// convert the date of birth  
	//------------------------------------------------------------------------------------------------------
	$tmpDate = explode("-", $result_array["DOB"]);
	$DisplayDOB = sprintf("%02s/%02s/%04s",$tmpDate[1], $tmpDate[2], $tmpDate[0]);
}
else
{
	//----------------------------------------------------------------------------------------------------------
	// Build empty screen - This is an add
	//----------------------------------------------------------------------------------------------------------
	$ButtonHidden = "type=\"hidden\"";
}	

?>

<html>

<head>
<title>HealthYourSelf Manage Client Client Access </title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />
<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>
<script type="text/javascript">
function startUp() 
{	
	<?php print $JavaScriptLogMsg; ?>
		
	<?php print $JavaScriptMsg; ?>
}
</script>
<style type="text/css">	

.leftClientSearch {
		position: absolute;
		left:10px;
		top:38px;
		width:230px;
		height:45px;
		background: white;
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		}
		
.titleClientList {
		position: absolute;
		left:10px;
		top:100px;
		width:232px;
		height:235px;
		background: white;
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		}
		
.innerleftClientList {
		position: absolute;
		left:0px;
		top:20px;
		width:230px;
		height:208px;
		background: white;
		border-top:0px solid black;
		border-left:0px solid black;
		border-right:0px solid black;
		border-bottom:0px solid black;
		}		

.tablePosclientdetail {
		position: absolute;
		left:270px;
		top:38px; 
		width:422px;
		height:300px;
		background-color: white;
		border:1px solid black;
		}

.tablePosclientaccesslist {
		position: absolute;
		left:20px;
		top:375px; 
		width:662px;
		height:20px;
		}

.innerSelectframeclientaccesslist {
		position: absolute;
		left:20px;
		top:395px; 
		width:660px;
		height:150px;
		background-color: white;
		border:1px solid black;
		}

.outerBorderTitleBlue {
		color: white;
		font: 700 13px Arial,Helvetica;
		text-align: center;
		border-top:1px solid #052faf;
		border-left:1px solid #052faf;
		border-right:1px solid #052faf;
		border-bottom:1px solid #052faf;
		background: #052faf;
		}	
		
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
		
.linkTitletype {
		color: white;
		font: 700 13px Arial,Helvetica;
		text-align: center;
		text-decoration: none;
		}			

.linkTitletype:hover {
		color: yellow;
		font: 700 13px Arial,Helvetica;
		text-align: center;
		text-decoration: underline;
		}		
		
</style>

</head>

<body <?php print $BodySelectColor ?> onload="startUp()">

<div class="leftClientSearch">
<form name="search" method="post" ACTION="if_clientlistforaccess.php" target="ClientListFrame">
<!-- Second outer column of Search -->
<table height=20 width="100%" class="outerBorderTitleBlueLetterSpace">
	<tr>
		<td><b>Search</b></td>
	</tr>
</table>
<table height=20 width="100%" class="outerBorderSMtxt">
	<tr>
		<td><input type="text" name="Search" size="29" maxlength="255"></td> 
		<td><INPUT TYPE="IMAGE" SRC="images/go_global_search.gif" ALT="Submit button" border="0"></td>
	</tr>
</table>
<input type='hidden' name='selType'  value='search'>
</form>
</div>

<div class="titleClientList">
<table width="100%" height=20 class="outerBorderTitleGreenLetterSpace">
	<tr>
		<td align="center"><b>Client List</b></td>
	</tr>	
</table>

<IFRAME name="ClientListFrame" src="if_clientsharedaccesslistSelect.php"  class="innerleftClientList" scrolling=yes></IFRAME>
</div>

<div class="tablePosclientdetail">
<form  action="clientsharedaccess.php" target="mainFrame" method=post>
<table height=20 width="100%" class="outerBorderTitleBlueLetterSpace">
	<tr>
		<td><b>Client Detail</b></td>
	</tr>
</table>
<table width="100%" class="SmTxt">
	<tr>
		<td align=right colspan=4 height=15>&nbsp;</td>
	</tr>
	<tr>
		<td align=right height=35>Client Name:</td>
		<td align=left><input class="readonlyText" readonly size=35 maxlength=35 type="text" name="clientname" value="<?php print $DisplayName; ?>"></td>
	</tr>
	<tr>
		<td align=right>Address:</td>
		<td align=left><input class="readonlyText" readonly size=40 maxlength=40 type="text" name="address" value="<?php print $result_array[AddrLine1]; ?>"></td>
	</tr>
	<tr>		
		<td align=right>City:</td>
		<td align=left><input class="readonlyText" readonly size=15 maxlength=15 type="text" name="city" value="<?php print $result_array[City]; ?>"></td>
	</tr>
	<tr>		
		<td align=right>State:</td>
		<td align=left><input class="readonlyText" readonly size=2 maxlength=2 type="text" name="state" value="<?php print $result_array[State]; ?>"></td>
	</tr>
	<tr>		
		<td align=right>Date of Birth:</td>
		<td align=left><input class="readonlyText" readonly size=10 maxlength=10 type="text" name="dob" value="<?php print $DisplayDOB; ?>"></td>
	</tr>
</table>	
<input type="hidden" name="accessuserid" value="<?php print $AccessClientID; ?>">
<input type="hidden" name="medpal" value="<?php print $Medpal; ?>">
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

<div class="tablePosclientaccesslist">
<table width="100%" height=20 class="outerBorderTitleGreenLetterSpace">
		<tr>
		 <td width="10%" align="center">Del</td>
		 <td width="25%" align="center"><a href="if_clientsharedaccesslist.php?order=atype&medpal=<?php print $Medpal; ?>" class="linkTitletype" target="ClientaccessListFrame">Type</a></td>
		 <td width="25%" align="center"><a href="if_clientsharedaccesslist.php?order=alevel&medpal=<?php print $Medpal; ?>" class="linkTitletype" target="ClientaccessListFrame">Level</a></td>
		 <td width="40%" align="center"><a href="if_clientsharedaccesslist.php?order=aname&medpal=<?php print $Medpal; ?>" class="linkTitletype" target="ClientaccessListFrame">Name</a></td>
	</tr>	
</table>
</div>
<IFRAME name="ClientaccessListFrame" src="if_clientsharedaccesslist.php?medpal=<?php print $Medpal; ?>"  class="innerSelectframeclientaccesslist" scrolling=yes></IFRAME>
</body>
</html>
