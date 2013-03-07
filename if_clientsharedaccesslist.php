<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_clientsharedaccesslist.php';

require ('hysInit.php');

require ('hysDBinit.php');

//----------------------------------------------------------------------------------------------------------
// lets get Authentication type names
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT ID, AuthenticationType from AuthenticationTypeTBL"; 

//----------------------------------------------------------------------------------------------------------
// Make the call
//----------------------------------------------------------------------------------------------------------
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for AuthenticationTypeTBL  (495)";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------
// initialize display block
//----------------------------------------------------------------------------------------------------------
$DisplayAuthenticationTypeList = "";

//----------------------------------------------------------------------------------------------------------
// Now lets first see if there is anything to run through
//----------------------------------------------------------------------------------------------------------
$countRows = mysql_num_rows($sql_result);
if ($countRows >  0) 
{	
	// now lets run the table and get our provider names
	while ($result_arr = mysql_fetch_assoc($sql_result))
	{
		$DisplayAuthenticationTypeList .= "\t\t\t<option value=\"".$result_arr[ID]."\" >".$result_arr[AuthenticationType]."\n ";
	}
}	

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
		$DisplayAuthorizationLevelTypeList .= "\t\t\t<option value=\"".$result_arr[ID]."\" >".$result_arr[Description]."\n ";
	}
}	

//----------------------------------------------------------------------------------------------------------
// create the SQL statement.  If we have id do call otherwise empty set 
//----------------------------------------------------------------------------------------------------------
if (isset($_GET[medpal]) && ($_GET[medpal] != "") )
{
	$medpal = $_GET[medpal];

	// create the SQL statement to get our calendar events for prescription appointments only
	$sql = "SELECT AuthenticationTBL.USERID as AuthUserID, AuthenticationType, TypeID, AuthorizationTBL.Level as AuthLevel, 
					FirstName, LastName, Suffix, Prefix, MI,
					AuthorizationLevelTypeTBL.Level as LevelDesc
					from AuthorizationTBL
					left join AuthenticationTBL on AuthenticationTBL.USERID = AuthorizationTBL.USERID
					left join ClientTBL on AuthorizationTBL.USERID = ClientTBL.MEDPAL
					left join FullNameTBL on ClientTBL.FullNameID = FullNameTBL.ID
					left join AuthenticationTypeTBL on AuthenticationTBL.TypeID = AuthenticationTypeTBL.ID
					left join AuthorizationLevelTypeTBL on AuthorizationTBL.Level = AuthorizationLevelTypeTBL.ID
					where (AuthorizationTBL.MEDPAL = '$medpal')";
				
	if (isset($_GET[order]))
	{
		//--------------------------------------------------------------------------------------------------
		// We ARE a get
		//
		// First lets see if our sort cookie is set.  If not lets set it up (WE will be using cookies
		// via the php session service.  Another chance for us to learn.
		//--------------------------------------------------------------------------------------------------
		if (empty($_SESSION[ALType]))
		{
			//	echo "WE are empty session\n";
			//----------------------------------------------------------------------------------------------
			// Ok nothing here to see folks.  But honestly - we need to set our variables for first time
			//----------------------------------------------------------------------------------------------
			$_SESSION[ALType] = "ASC";
			$_SESSION[ALName] = "ASC";
			$_SESSION[ALLevel] = "ASC";
		}
				
		//--------------------------------------------------------------------------------------------------
		// Now that the session Variables are set it is time to build our sql based on what was passed
		//--------------------------------------------------------------------------------------------------
		switch ($_GET[order])
		{
			case 'atype':
				$sql .= " ORDER BY TypeID ".$_SESSION[ALType];
				if ($_SESSION[ALType] == "ASC")
					$_SESSION[ALType] = "DESC";
				else
					$_SESSION[ALType] = "ASC";
				break;
				
			case 'aname':
				$sql .= " ORDER BY LastName, FirstName ".$_SESSION[ALName];
				if ($_SESSION[ALName] == "ASC")
					$_SESSION[ALName] = "DESC";
				else
					$_SESSION[ALName] = "ASC";
				break;	
		
			case 'alevel':
				$sql .= " ORDER BY AuthLevel ".$_SESSION[ALLevel];
				if ($_SESSION[ALLevel] == "ASC")
					$_SESSION[ALLevel] = "DESC";
				else
					$_SESSION[ALLevel] = "ASC";
				break;
				
			}  // End of Switch
	}  // End of if GET
	else
	{
		// echo "WE are default\n";
		//----------------------------------------------------------------------------------------------
		// first time thru so default to desc sort of all info
		//----------------------------------------------------------------------------------------------
		
		$sql .= " ORDER BY LastName, FirstName ASC";
	}  // End of Else
	
	// now lets run the sql that was built
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query for AuthenticationTBL, AuthorizationTBL FullNameTBL (195) - '$Medpal'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
} // End of if Get

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
	
	$DisplayName .= $result_array[FirstName]." ".$result_array[MI];
	

	if ($FlipFlag == 1)
	{
		$DisplayList .= " 
			<tr> 
				<td width=\"10%\" align=center height=20 class=\"tblDetailsmTextOn\">
					<a href=\"clientsharedaccess.php?medpal=".$medpal."&accessuserid=".$result_array[AuthUserID]."&Action=remove\" target=\"mainFrame\">
						<img id=\"removehost\" height=15 width=15 border=\"0\" src=\"images/axe1ton.gif\" 
					alt=\"Remove Name from Client Access List\"></a>
				</td>
		
				<td width=\"25%\" align=center class=\"tblDetailsmTextOn\" id=\"td".$i."\" align=left height=20>".$result_array[AuthenticationType]."</td> 
				
				<td width=\"25%\" align=center class=\"tblDetailsmTextOn\" id=\"td".$i."\" align=left height=20>".$result_array[LevelDesc]."</td> 
				
				<td width=\"50%\" align=left class=\"tblDetailsmTextOn\" id=\"td".$i."\" align=left height=20>".$DisplayName."</td> 
			</tr>
			";
			
		$FlipFlag = 0;	
	}
	else
	{
		$DisplayList .= " 
			<tr> 
				<td width=\"10%\" align=center height=20 class=\"tblDetailsmTextOff\">
					<a href=\"clientsharedaccess.php?medpal=".$medpal."&accessuserid=".$result_array[AuthUserID]."&Action=remove\" target=\"mainFrame\">
						<img id=\"removehost\" height=15 width=15 border=\"0\" src=\"images/axe1t.gif\" 
					alt=\"Remove Name from Client Access List\"></a>
				</td>
		
				<td width=\"25%\" align=center class=\"tblDetailsmTextOff\" id=\"td".$i."\" align=left height=20>".$result_array[AuthenticationType]."</td> 
				
				<td width=\"25%\" align=center class=\"tblDetailsmTextOff\" id=\"td".$i."\" align=left height=20>".$result_array[LevelDesc]."</td> 
				
				<td width=\"50%\" align=left class=\"tblDetailsmTextOff\" id=\"td".$i."\" align=left height=20>".$DisplayName."</td> 
			</tr>
			";
			
		$FlipFlag = 1;		
	}
	
	$i++;
	
} // End of While	

?>
<html>

<head>
<title>HealthYourSelf Customer Access Auth Update</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>
<script type="text/javascript">
function startUp() 
{	
	<?php print $JavaScriptLogMsg; ?>
		
	<?php print $JavaScriptMsg; ?>
}
</script>
</head>

<body onload="startUp()">

<div>
<center>
<table width="100%" cellspacing=0 cellpadding=0 border=0>
		<?php print $DisplayList; ?>
</table>

</center>
</div>
</body>
</html>
