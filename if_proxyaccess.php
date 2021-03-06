<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_proxyaccess.php';

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
// now lets get RelationshipType Values
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT ID as RelationshipTypeID, RelationshipType 
	from RelationshipTypeTBL";

// Make the call
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for RelationshipTypeTBL  (555) - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// initialize display block
$DisplayRelationshipTypeList = "";
$DisplayRelationshipTypeID = "None";

// Now lets first see if there is anything to run through
$countRows = mysql_num_rows($sql_result);
if ($countRows >  0) 
{	
	// now lets run the table and get our provider names
	while ($result_arr = mysql_fetch_assoc($sql_result))
	{
		$DisplayRelationshipTypeList .= "\t\t\t<option value=\"".$result_arr[RelationshipTypeID]."\" >".$result_arr[RelationshipType]."\n ";
	}
}	

//----------------------------------------------------------------------------------------------------------
// now lets get the list we are working on if get method we get ProxyType code if post method we get button 
// value verbose.
//----------------------------------------------------------------------------------------------------------
if ( isset($_GET[proxytype]) && ($_GET[proxytype] != "" ) )
{	
	switch ($_GET[proxytype])
	{
		case $DisplayClientType:
			$DisplayProxyType = 'Client';
			break;
			
		case $DisplayPharmacyType:
			$DisplayProxyType = 'Pharmacy';
			break;
		
		case $DisplayProviderType:
		 	$DisplayProxyType = 'Provider';
			break;
		
		case $DisplayUserProxyType:	
			$DisplayProxyType = 'User';
			break;
	}		
}
else
{
	if ( isset($_POST[proxytypeverbose]) && ($_POST[proxytypeverbose] != "" ) )
	{	
		$DisplayProxyType = $_POST[proxytypeverbose];	
	}
	else
	{
		$DisplayProxyType = "";
	}	
}	
	
switch ($DisplayProxyType)
{	
	case "Client":
		$ProxyDetailTitle = "Client Detail";
		$ProxyListTitle = "Client List";
		$ProxyType = $DisplayClientType;
		break;
	
	case "Pharmacy":
		$ProxyDetailTitle = "Pharmacy Detail";
		$ProxyListTitle = "Pharmacy List";
		$ProxyType = $DisplayPharmacyType;
		break;
		
	case "Provider":
		$ProxyDetailTitle = "Provider Detail";
		$ProxyListTitle = "Provider List";
		$ProxyType = $DisplayProviderType;
		break;
		
	case "User":
		$ProxyDetailTitle = "User Detail";
		$ProxyListTitle = "User List";
		$ProxyType = $DisplayUserProxyType;
		break;
		
	default:
		$ProxyType = $DisplayUserProxyType;
		$ProxyDetailTitle = "User Detail";
		$ProxyListTitle = "User List";
		break;	
}

//----------------------------------------------------------------------------------------------------------
//  we need to see if we have been passed a ProxyUserID
//----------------------------------------------------------------------------------------------------------
$ProxyUserID = "";
$DisplayName = "";
$DisplayAffiliation = "";
$DisplayRelationship = "";
$DisplayRelationshipValue = "";
$DisplayLevel = "";
$DisplayLevelValue = "";
$isType = "";

if (isset($_GET[proxyuserid]) && ($_GET[proxyuserid] != "") )
{
	//Get host id and set flag to is update
	$ProxyUserID = $_GET[proxyuserid];
	$ButtonHidden = "";
	
	//----------------------------------------------------------------------------------------------------------
	// create the SQL statement to make sure this id is in AuthenticationTBL (ie valid)
	//----------------------------------------------------------------------------------------------------------
	$sql = "SELECT 	USERID
		from AuthenticationTBL
			where (AuthenticationTBL.USERID = '$ProxyUserID' and AuthenticationTBL.TypeID = '$ProxyType')"; 
				
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query join for AuthenticationTBL  (889) sql = '$sql'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
		
	// Now lets first see if there is anything to run through.  If more then 1 we have an error
	$countRows = mysql_num_rows($sql_result);
	if ($countRows != 1)
	{
		$errmsg = " Error Invalid User id selected for access. count = '$countRows'  - ProxyUserID =  '$ProxyUserID'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
	
	//----------------------------------------------------------------------------------------------------------
	// create the SQL statement to get the client info
	//----------------------------------------------------------------------------------------------------------
	$sql = "SELECT 	AuthorizationTBL.Level as LevelID, AuthorizationLevelTypeTBL.Level as LevelDesc, RelationshipType, RelationsID
		from AuthorizationTBL
		left join AuthorizationLevelTypeTBL on AuthorizationLevelTypeTBL.ID = AuthorizationTBL.Level
		left join RelationshipTypeTBL on RelationshipTypeTBL.ID = AuthorizationTBL.RelationsID
			where (AuthorizationTBL.USERID = '$ProxyUserID' and AuthorizationTBL.TypeID = '$ProxyType' and AuthorizationTBL.MEDPAL = '$Medpal')"; 
				
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query join for AuthorizationTBL, RelationshipTypeTBL, AuthorizationLevelTypeTBL  (889) sql = '$sql'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
		
	// Now lets first see if there is anything to run through.  If more then 1 we have an error
	$countRows = mysql_num_rows($sql_result);
	if ($countRows > 1)
	{
		$errmsg = " Error more then 1 rows returned in select on AuthorizationTBL. count = '$countRows'  - ProxyUserID =  '$ProxyUserID'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
	else
	{
		if ($countRows > 0)
		{
			$isType = "update";
			$DisplayButtonTitle = "Update Access";
		}
		else
		{
			$isType = "add";
			$DisplayButtonTitle = "Add Access";
		}
	}
	//----------------------------------------------------------------------------------------------------------
	// Get the data
	//----------------------------------------------------------------------------------------------------------
	$result_array = mysql_fetch_assoc($sql_result);	
	
	$DisplayRelationship = $result_array[RelationshipType];
	$DisplayRelationshipValue = $result_array[RelationsID];
	
	$DisplayLevel = $result_array[LevelDesc];
	$DisplayLevelValue = $result_array[LevelID];
	
	switch ($ProxyType)
	{
		case $DisplayClientType:
			//----------------------------------------------------------------------------------------------------------
			// create the SQL statement to get the client info
			//----------------------------------------------------------------------------------------------------------
			$sql = "SELECT FirstName, LastName, Suffix, MI, Prefix,
				AddrLine1, City, State, Zip
				from ClientTBL
				left join FullNameTBL  on ClientTBL.FullNameID = FullNameTBL.ID
				left join ClientAddrTBL on ClientTBL.MEDPAL = ClientAddrTBL.MEDPAL
				left join AddrTBL on ClientAddrTBL.AddrID = AddrTBL.ID
					where (ClientTBL.MEDPAL = '$ProxyUserID' and  AddrTBL.OrderID = '1')";  
				
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query join for ClientTBL, ClientAddrTBL, AddrTBL,  and FullNameTBL (195) sql = '$sql'";
				$location = "";
				$severity = 1;	
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
				
			// Now lets first see if there is anything to run through.  If more then 1 we have an error
			$countRows = mysql_num_rows($sql_result);
			if ($countRows > 1)
			{
				$errmsg = " Error more then 1 rows returned in select on ClientTBL. count = '$countRows'  - ProxyUserID =  '$ProxyUserID'";
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
			break;
		
		case $DisplayPharmacyType:
			$sql = "SELECT  Name, AddrLine1, City, State, Zip,
				 Prefix, FirstName, MI, LastName, Suffix
				from PharmacyTBL 
				left join AddrTBL on PharmacyTBL.AddrID = AddrTBL.ID
				left join FullNameTBL on PharmacyTBL.FullNameID = FullNameTBL.ID
					WHERE (PharmacyTBL.ID = '$ProxyUserID' and AddrTBL.OrderID = '1')"; 
					
			 if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query join for PharmacyTBL,  AddrTBL (195) sql = '$sql'";
				$location = "";
				$severity = 1;	
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
				
			// Now lets first see if there is anything to run through.  If more then 1 we have an error
			$countRows = mysql_num_rows($sql_result);
			if ($countRows > 1)
			{
				$errmsg = " Error more then 1 rows returned in select on PharmacyTBL. count = '$countRows'  - ProxyUserID =  '$ProxyUserID'";
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
			
			//----------------------------------------------------------------------------------------------------------
			// get pharmacy name
			//----------------------------------------------------------------------------------------------------------
			$DisplayAffiliation = $result_array[Name];
			break;
			
		case $DisplayProviderType:
			$sql = "SELECT Name, AddrLine1, City, State, Zip,
				Prefix, FirstName, MI, LastName, Suffix
				from ProviderTBL 
				left join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID 
				left join ProviderHostTBL on ProviderHostTBL.ProviderID = ProviderTBL.ID
				left join HostTBL on ProviderHostTBL.HostID = HostTBL.ID 
				left join AddrTBL on HostTBL.AddrID = AddrTBL.ID
						where (ProviderTBL.ID = '$ProxyUserID' and ProviderHostTBL.OrderID = '1' and  AddrTBL.OrderID = '1')";
			
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query join for ProviderTBL, HostTBL, AddrTBL,  and FullNameTBL (195) sql = '$sql'";
				$location = "";
				$severity = 1;	
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
				
			// Now lets first see if there is anything to run through.  If more then 1 we have an error
			$countRows = mysql_num_rows($sql_result);
			if ($countRows > 1)
			{
				$errmsg = " Error more then 1 rows returned in select on ProviderTBL. count = '$countRows'  - ProxyUserID =  '$ProxyUserID'";
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
			
			//----------------------------------------------------------------------------------------------------------
			// get practice name
			//----------------------------------------------------------------------------------------------------------
			$DisplayAffiliation = $result_array[Name];
			break;
			
		case $DisplayUserProxyType:
			//----------------------------------------------------------------------------------------------------------
			// create the SQL statement to get the User info
			//----------------------------------------------------------------------------------------------------------
			$sql = "SELECT FirstName, LastName, Suffix, MI, Prefix,
				AddrLine1, City, State, Zip
				from UserTBL
				left join FullNameTBL  on UserTBL.FullNameID = FullNameTBL.ID
				left join AddrTBL on UserTBL.AddrID = AddrTBL.ID
					where (UserTBL.ID = '$ProxyUserID' and  AddrTBL.OrderID = '1')";  
				
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query join for UserTBL, AddrTBL,  and FullNameTBL (195) sql = '$sql'";
				$location = "";
				$severity = 1;	
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
				
			// Now lets first see if there is anything to run through.  If more then 1 we have an error
			$countRows = mysql_num_rows($sql_result);
			if ($countRows > 1)
			{
				$errmsg = " Error more then 1 rows returned in select on UserTBL. count = '$countRows'  - ProxyUserID =  '$ProxyUserID'";
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
			break;
		
	} // end of switch
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

.tablePosproxyAccesslist {
		position: absolute;
		left:0px;
		top:20px; 
		width:702px;
		height:20px;
		}

.innerSelectframeproxyAccesslist {
		position: absolute;
		left:0px;
		top:38px; 
		width:700px;
		height:150px;
		background-color: white;
		border:1px solid black;
		}

.leftProxySearch {
		position: absolute;
		left:0px;
		top:220px;
		width:230px;
		height:55px;
		background: white;
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		}
		
.tablePosproxydetail {
		position: absolute;
		left:250px;
		top:220px; 
		width:450px;
		height:461px;
		background-color: white;
		border:1px solid black;
		}

.tablePosproxylist {
		position: absolute;
		left:0px;
		top:280px;
		width:232px;
		height:20px;
		background: white;
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		}
		
.innerleftProxyList {
		position: absolute;
		left:0px;
		top:300px;
		width:232px;
		height:380px;
		background: white;
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		}
		
.buttonPos {
		position: absolute;
		left:0px;
		top:700px; 
		width:700px;
		height:20px;
		border:0px solid black;
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
		
.outerBorderTitleGreen {
		color: white;
		font: 700 13px Arial,Helvetica;
		text-align: center;
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

<div class="tablePosproxyAccesslist">
<table width="100%" height=20 class="outerBorderTitleGreen">
	<tr>
		 <td width="5%" align="center">&nbsp;</td>
		 <td width="5%" align="center">&nbsp;</td>
		 <td width="25%" align="center"><a href="if_proxyaccesslist.php?order=atype&medpal=<?php print $Medpal; ?>" class="linkTitletype" target="proxylistaccessFrame">Type</a></td>
		 <td width="25%" align="center">Name</a></td>
		 <td width="20%" align="center"><a href="if_proxyaccesslist.php?order=alevel&medpal=<?php print $Medpal; ?>" class="linkTitletype" target="proxylistaccessFrame">Level</a></td>
		 <td width="20%" align="center"><a href="if_proxyaccesslist.php?order=arelation&medpal=<?php print $Medpal; ?>" class="linkTitletype" target="proxylistaccessFrame">Relation</a></td>
	</tr>	
</table>
</div>
<IFRAME name="proxylistaccessFrame" src="if_proxyaccesslist.php?medpal=<?php print $Medpal; ?>"  class="innerSelectframeproxyAccesslist" scrolling=yes></IFRAME>


<div class="leftProxySearch">
<form name="search" method="post" ACTION="if_proxylist.php?proxytype=<?php print $ProxyType; ?>" target="proxyListFrame">
<!-- Second outer column of Search -->
<table height=20 width="100%" class="outerBorderTitleBlueLetterSpace">
	<tr>
		<td><b>Search</b></td>
	</tr>
</table>
<table height=20 width="100%" class="outerBorderSMtxt">
	<tr>
		<td><input type="text" name="Search" size="25" maxlength="255"></td> 
		<td><INPUT TYPE="IMAGE" SRC="images/go_global_search.gif" ALT="Submit button" border="0"></td>
	</tr>
</table>
<input type='hidden' name='selType'  value='search'>
</form>
</div>

<div class="tablePosproxylist">
<table width="100%" height=20 class="outerBorderTitleGreen">
	<tr>
		<td align="center"><b><?php print $ProxyListTitle; ?></b></td>
	</tr>	
</table>
</div>
<IFRAME name="proxyListFrame" src="if_proxylist.php?proxytype=<?php print $ProxyType; ?>"  class="innerleftProxyList" scrolling="yes"></IFRAME>

<div class="tablePosproxydetail">
<form  action="proxyaccess.php" target="mainFrame" method=post>
<table height=20 width="100%" class="outerBorderTitleBlueLetterSpace">
	<tr>
		<td><b><?php print $ProxyDetailTitle; ?></b></td>
	</tr>
</table>
<table width="100%" class="SmTxt">
	<tr>
		<td align=right colspan=4 height=25>&nbsp;</td>
	</tr>
	<tr>		
		<td height=35 align=right>Proxy Type:</td>
		<td align=left><input class="readonlyText" readonly size=10 maxlength=10 type="text" name="proxytype" value="<?php print $DisplayProxyType;  ?>"></td>
	</tr>
	<tr>
		<td align=right height=35>Name:</td>
		<td align=left><input class="readonlyText" readonly size=35 maxlength=35 type="text" name="clientname" value="<?php print $DisplayName; ?>"></td>
	</tr>
	<tr>		
		<td height=35 align=right>Affiliation:</td>
		<td align=left><input class="readonlyText" readonly size=40 maxlength=40 type="text" name="affiliation" value="<?php print $DisplayAffiliation;  ?>"></td>
	</tr>
	<tr>
		<td height=35 align=right>Address:</td>
		<td align=left><input class="readonlyText" readonly size=40 maxlength=40 type="text" name="address" value="<?php print $result_array[AddrLine1]; ?>"></td>
	</tr>
	<tr>		
		<td height=35 align=right>City:</td>
		<td align=left><input class="readonlyText" readonly size=15 maxlength=15 type="text" name="city" value="<?php print $result_array[City]; ?>"></td>
	</tr>
	<tr>		
		<td height=35 align=right>State:</td>
		<td align=left><input class="readonlyText" readonly size=2 maxlength=2 type="text" name="state" value="<?php print $result_array[State]; ?>"></td>
	</tr>
	<tr>		
		<td height=35 align=right>Zip:</td>
		<td align=left><input class="readonlyText" readonly size=10 maxlength=10 type="text" name="zip" value="<?php print $result_array[Zip];  ?>"></td>
	</tr>
	<tr>
		<td height=35 align=right>Relationship:</td>
		<td align=left>
			<select name="proxyrelationship"> 
				<option class="smallTxtGry" value="<?php print $DisplayRelationshipValue; ?>"><?php print $DisplayRelationship; ?> 
				<?php print $DisplayRelationshipTypeList; ?>
			</select>
		</td>		
	</tr>
	<tr>
		<td height=35 align=right>Level:</td>
		<td align=left>
			<select name="level"> 
				<option class="smallTxtGry" value="<?php print $DisplayLevelValue; ?>"><?php print $DisplayLevel; ?> 
				<?php print $DisplayAuthorizationLevelTypeList; ?>
			</select>
		</td>		
	</tr>
</table>	
<input type="hidden" name="proxyuserid" value="<?php print $ProxyUserID; ?>">
<input type="hidden" name="medpal" value="<?php print $Medpal; ?>">
<input type="hidden" name="proxytype" value="<?php print $ProxyType; ?>">
<input type="hidden" name="Action" value="<?php print $isType; ?>">	
<br><center>
<table>
	<tr>
		<td align=center><input <?php print $ButtonHidden; ?> type=submit size=150 NAME="SUBMIT" VALUE="<?php print $DisplayButtonTitle; ?>"></td>
	</tr>
</table>	
</center>	
</form>
</div>

<div class="buttonPos">
<form  action="if_proxyaccess.php" target="mainFrame" method=post> 
<center>
<table class="SmTxt" border=0 cellspacing=0 cellpadding=0>
	<tr>
		<td width=35>&nbsp;</td>
		<td align=center  height=15><input type="submit" name="proxytypeverbose" value="User"></td>
		<td width=35>&nbsp;</td>
		<td align=center  height=15><input type="submit" name="proxytypeverbose" value="Client"></td> 
		<td width=35>&nbsp;</td>
		<td align=center  height=15><input type="submit" name="proxytypeverbose" value="Provider"></td> 
		<td width=35>&nbsp;</td>
		<td align=center height=35><input type="submit" name="proxytypeverbose" value="Pharmacy"></td>
		<td width=35>&nbsp;</td>
	</tr>
</table>
<input type="hidden" name="dummy" value="">
</form>
</div>

</body>
</html>
