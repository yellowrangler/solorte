<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_UAaccesspriv.php';

require ('hysInit.php');

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
	$ProxyType = $_GET[proxytype];

	switch ($ProxyType)
	{
		case $DisplayClientType:
			$ProxyDetailTitle = "Client Detail";
			break;
			
		case $DisplayPharmacyType:
			$ProxyDetailTitle = "Pharmacy Detail";
			break;
		
		case $DisplayProviderType:
		 	$ProxyDetailTitle = "Provider Detail";
			break;
		
		case $DisplayUserProxyType:	
			$ProxyDetailTitle = "User Detail";
			break;
	}		
}
else
{
	$ProxyType = $DisplayUserProxyType;
	$ProxyDetailTitle = "User Detail";
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
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}

	// Now lets first see if there is anything to run through.  If more then 1 we have an error
	$countRows = mysql_num_rows($sql_result);
	if ($countRows != 1)
	{
		$errmsg = " Error more or less then 1 rows returned in select on AuthorizationTBL. 
						count = '$countRows'  - ProxyUserID =  '$ProxyUserID',  ProxyType =  '$ProxyType', Medpal = '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
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
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
				
			// Now lets first see if there is anything to run through.  If more then 1 we have an error
			$countRows = mysql_num_rows($sql_result);
			if ($countRows > 1)
			{
				$errmsg = " Error more then 1 rows returned in select on ClientTBL. count = '$countRows'  - ProxyUserID =  '$ProxyUserID'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "";
				$severity = 1;
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
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
				
			// Now lets first see if there is anything to run through.  If more then 1 we have an error
			$countRows = mysql_num_rows($sql_result);
			if ($countRows > 1)
			{
				$errmsg = " Error more then 1 rows returned in select on PharmacyTBL. count = '$countRows'  - ProxyUserID =  '$ProxyUserID'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "";
				$severity = 1;
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
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
				
			// Now lets first see if there is anything to run through.  If more then 1 we have an error
			$countRows = mysql_num_rows($sql_result);
			if ($countRows > 1)
			{
				$errmsg = " Error more then 1 rows returned in select on ProviderTBL. count = '$countRows'  - ProxyUserID =  '$ProxyUserID'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "";
				$severity = 1;
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
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
				
			// Now lets first see if there is anything to run through.  If more then 1 we have an error
			$countRows = mysql_num_rows($sql_result);
			if ($countRows > 1)
			{
				$errmsg = " Error more then 1 rows returned in select on UserTBL. count = '$countRows'  - ProxyUserID =  '$ProxyUserID'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "";
				$severity = 1;
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
<script type="text/javascript" language="JavaScript">
function startUp() 
{	
	<?php print $JavaScriptLogMsg; ?>
		
	<?php print $JavaScriptMsg; ?>
}
<!--
// Copyright information must stay intact
// FormCheck v1.10
// Copyright NavSurf.com 2002, all rights reserved
// Creative Solutions for JavaScript navigation menus, scrollers and web widgets
// Affordable Services in JavaScript consulting, customization and trouble-shooting
// Visit NavSurf.com at http://navsurf.com

function formCheck(formobj){
	// name of mandatory fields
	var fieldRequired = Array("proxyrelationship", "level");
	// field description to appear in the dialog box
	var fieldDescription = Array("Relationship", "Access Level");
	// field description to appear in the dialog box
	var fieldEdit = Array("None", "None");
							
	// dialog message
	var alertMsg = "Please complete the following fields:\n";
	
	var l_Msg = alertMsg.length;
	
	for (var i = 0; i < fieldRequired.length; i++)
	{
		var obj = formobj.elements[fieldRequired[i]];
		if (obj)
		{
			if (obj.type == null)
			{
				var blnchecked = false;
				for (var j = 0; j < obj.length; j++)
				{
					if (obj[j].checked){
						blnchecked = true;
					}
				}
				if (!blnchecked)
				{
					alertMsg += " - " + fieldDescription[i] + "\n";
				}
				continue;
			}

			switch(obj.type)
			{
				case "select-one":
					if (obj.selectedIndex == -1 || obj.options[obj.selectedIndex].text == "")
					{
						alertMsg += " - " + fieldDescription[i] + "\n";
					}
					break;
				case "select-multiple":
					if (obj.selectedIndex == -1)
					{
						alertMsg += " - " + fieldDescription[i] + "\n";
					}
					break;
				case "text":
				case "textarea":
					if (obj.value == "" || obj.value == null)
					{
						alertMsg += " - " + fieldDescription[i] + "\n";
					}
					
					if (fieldEdit[i] != "None")
					{	
						var x = fieldCheck(obj.value, fieldEdit[i]);
						if (!x)
						{
							alertMsg += " - Invalid " + fieldDescription[i] + "\n";
						}
					}	
					break;
				default:
			}
		}
	}

	if (alertMsg.length == l_Msg)
	{
		return true;
	}
	else
	{
		alert(alertMsg);
		return false;
	}
}

function fieldCheck(strValue, strEdit)
{
	var res = true;
	var i;
	
	switch(strEdit)
	{
			case "MM":
				i = parseFloat(strValue);
				if (i <= 0 || i > 12)
				{
					res = false;
				}
				break;
			case "DD":
				i = parseFloat(strValue);
				if (i <= 0 || i > 31)
				{
					res = false;
				}
				break;
			case "YYYY":
					i = parseFloat(strValue);
				if (i < 1850)
				{
					res = false;
				}
				break;
			case "HH":
				i = parseFloat(strValue);
				if (i < 0 || i > 12)
				{
					res = false;
				}
				break;
			case "MI":
				i = parseFloat(strValue);
				if (i < 0 || i > 60)
				{
					res = false;
				}
				break;
			default:
	}		
	return res;
}
// -->
</script>

<style type="text/css">	

.tablePosclientaccesslist {
		position: absolute;
		left:20px;
		top:38px; 
		width:662px;
		height:20px;
		}

.innerframeproxyaccesslist {
		position: absolute;
		left:20px;
		top:58px; 
		width:660px;
		height:100px;
		background-color: white;
		border:1px solid black;
		}

.tablePosclientdetail {
		position: absolute;
		left:20px;
		top:250px; 
		width:662px;
		height: 400px;
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

<div class="tablePosclientaccesslist">
<table width="100%" height=20 class="outerBorderTitleGreenLetterSpace">
	<tr>
		 <td width="5%" align="center">&nbsp;</td>
		 <td width="5%" align="center">&nbsp;</td>
		 <td width="25%" align="center"><a href="if_UAaccessprivlist.php?order=atype&medpal=<?php print $Medpal; ?>" class="linkTitletype" target="proxylistaccessFrame">Type</a></td>
		 <td width="25%" align="center">Name</a></td>
		 <td width="20%" align="center"><a href="if_UAaccessprivlist.php?order=alevel&medpal=<?php print $Medpal; ?>" class="linkTitletype" target="proxylistaccessFrame">Level</a></td>
		 <td width="20%" align="center"><a href="if_UAaccessprivlist.php?order=arelation&medpal=<?php print $Medpal; ?>" class="linkTitletype" target="proxylistaccessFrame">Relation</a></td>
	</tr>	
</table>
</div>
<IFRAME name="proxylistaccessFrame" src="if_UAaccessprivlist.php?medpal=<?php print $Medpal; ?>"  class="innerframeproxyaccesslist" scrolling=yes></IFRAME>



<div class="tablePosclientdetail">
<form  action="UAaccesspriv.php" target="mainFrame" method=post onsubmit="return formCheck(this);">
<table height=20 width="100%" class="outerBorderTitleBlueLetterSpace">
	<tr>
		<td><b>Access Privilege Detail</b></td>
	</tr>
</table>
<table width="100%" class="SmTxt">
	<tr>
		<td align=right colspan=4 height=15>&nbsp;</td>
	</tr>
	<tr>
		<td align=right height=35>Proxy Name:</td>
		<td align=left><input class="readonlyText" readonly size=35 maxlength=35 type="text" name="clientname" value="<?php print $DisplayName; ?>"></td>
	</tr>
	<tr>		
		<td height=35 align=right>Affiliation:</td>
		<td align=left><input class="readonlyText" readonly size=40 maxlength=40 type="text" name="affiliation" value="<?php print $DisplayAffiliation;  ?>"></td>
	</tr>
	<tr>
		<td align=right>Address:</td>
		<td align=left ><input class="readonlyText" readonly size=40 maxlength=40 type="text" name="address" value="<?php print $result_array[AddrLine1]; ?>"></td>
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
<input type="hidden" name="Action" value="update">
<br><center>
<table>
	<tr>
		<td align=center><input <?php print $ButtonHidden; ?> type=submit size=150 NAME="SUBMIT" VALUE="Update"></td>
	</tr>
</table>	
</center>	
</form>
</div>

</body>
</html>
