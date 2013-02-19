<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_UAaccessprivlist.php';

require ('hysInit.php');

require ('hysDBinit.php');

//----------------------------------------------------------------------------------------------------------
// create the SQL statement.  If we have id do call otherwise empty set 
//----------------------------------------------------------------------------------------------------------
if (isset($_GET[medpal]) && ($_GET[medpal] != "") )
{
	$medpal = $_GET[medpal];

	// create the SQL statement to get our calendar events for prescription appointments only
	$sql = "SELECT AuthorizationTBL.USERID as ProxyUserID, AuthType, TypeID as ProxyType, 
					AuthorizationTBL.Level as AuthLevel, RelationshipType, 
					AuthorizationLevelTypeTBL.Level as AuthLevelDesc
					from AuthorizationTBL
					left join AuthTypeTBL on AuthorizationTBL.TypeID = AuthTypeTBL.ID
					left join AuthorizationLevelTypeTBL on AuthorizationTBL.Level = AuthorizationLevelTypeTBL.ID
					left join RelationshipTypeTBL on AuthorizationTBL.RelationsID = RelationshipTypeTBL.ID
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
			$_SESSION[ALLevel] = "ASC";
			$_SESSION[ALRelation] = "ASC";
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
				
			case 'alevel':
				$sql .= " ORDER BY AuthLevelDesc ".$_SESSION[ALLevel];
				if ($_SESSION[ALLevel] == "ASC")
					$_SESSION[ALLevel] = "DESC";
				else
					$_SESSION[ALLevel] = "ASC";
				break;
				
			case 'arelation':
				$sql .= " ORDER BY RelationshipType ".$_SESSION[ALRelation];
				if ($_SESSION[ALRelation] == "ASC")
					$_SESSION[ALRelation] = "DESC";
				else
					$_SESSION[ALRelation] = "ASC";
				break;	
				
			}  // End of Switch
	}  // End of if GET
	else
	{
		// echo "WE are default\n";
		//----------------------------------------------------------------------------------------------
		// first time thru so default to desc sort of all info
		//----------------------------------------------------------------------------------------------
		
		$sql .= " ";
	}  // End of Else
	
	// now lets run the sql that was built
	if (!$sql_auth_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query for AuthenticationTBL, AuthorizationTBL FullNameTBL (195) - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "";
		$severity = 1;
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
while ($result_auth_array = mysql_fetch_assoc($sql_auth_result))
{
	$ProxyType = $result_auth_array[ProxyType];
	$ProxyUserID = $result_auth_array[ProxyUserID];
	
	switch ($ProxyType)
	{
		case $DisplayClientType:
			//----------------------------------------------------------------------------------------------------------
			// create the SQL statement to get the client info
			//----------------------------------------------------------------------------------------------------------
			$sql = "SELECT FirstName, LastName, Suffix, MI, Prefix
				from ClientTBL
				left join FullNameTBL  on ClientTBL.FullNameID = FullNameTBL.ID
					where (ClientTBL.MEDPAL = '$ProxyUserID')";  
				
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query join for ClientTBL, and FullNameTBL (195) sql = '$sql'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
				
			// Now lets first see if there is anything to run through.  If more then 1 we have an error
			$countRows = mysql_num_rows($sql_result);
			if ($countRows != 1)
			{
				$errmsg = " Error more or less then 1 rows returned in select on ClientTBL. count = '$countRows'  - ProxyUserID =  '$ProxyUserID'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}	
			
			//----------------------------------------------------------------------------------------------------------
			// Get the data
			//----------------------------------------------------------------------------------------------------------
			$result_array = mysql_fetch_assoc($sql_result);
			break;
			
		case $DisplayPharmacyType:
			//----------------------------------------------------------------------------------------------------------
			// create the SQL statement to get the pharmacy info
			//----------------------------------------------------------------------------------------------------------
			$sql = "SELECT  Prefix, FirstName, MI, LastName, Suffix
				from PharmacyTBL 
				left join FullNameTBL on PharmacyTBL.FullNameID = FullNameTBL.ID
					WHERE (PharmacyTBL.ID = '$ProxyUserID')"; 
					
			 if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query join for PharmacyTBL, FullNameTBL (195) sql = '$sql'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
				
			// Now lets first see if there is anything to run through.  If more then 1 we have an error
			$countRows = mysql_num_rows($sql_result);
			if ($countRows != 1)
			{
				$errmsg = " Error more or less then 1 rows returned in select on PharmacyTBL. count = '$countRows'  - ProxyUserID =  '$ProxyUserID'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}		
			
			//----------------------------------------------------------------------------------------------------------
			// Get the data
			//----------------------------------------------------------------------------------------------------------
			$result_array = mysql_fetch_assoc($sql_result);
			break;
		
		case $DisplayProviderType:
		 	$sql = "SELECT 	Prefix, FirstName, MI, LastName, Suffix
				from ProviderTBL 
				left join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID 
					where (ProviderTBL.ID = '$ProxyUserID')";
			
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query join for ProviderTBL and FullNameTBL (195) sql = '$sql'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
				
			// Now lets first see if there is anything to run through.  If more then 1 we have an error
			$countRows = mysql_num_rows($sql_result);
			if ($countRows != 1)
			{
				$errmsg = " Error more or less then 1 rows returned in select on ProviderTBL. count = '$countRows'  - ProxyUserID =  '$ProxyUserID'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}		
			
			//----------------------------------------------------------------------------------------------------------
			// Get the data
			//----------------------------------------------------------------------------------------------------------
			$result_array = mysql_fetch_assoc($sql_result);
			break;
		
		case $DisplayUserProxyType:	
			//----------------------------------------------------------------------------------------------------------
			// create the SQL statement to get the User info
			//----------------------------------------------------------------------------------------------------------
			$sql = "SELECT FirstName, LastName, Suffix, MI, Prefix
				from UserTBL
				left join FullNameTBL  on UserTBL.FullNameID = FullNameTBL.ID
					where (UserTBL.ID = '$ProxyUserID')";  
				
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query join for UserTBL,  and FullNameTBL (195) sql = '$sql'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
				
			// Now lets first see if there is anything to run through.  If more then 1 we have an error
			$countRows = mysql_num_rows($sql_result);
			if ($countRows != 1)
			{
				$errmsg = " Error more or less then 1 rows returned in select on UserTBL. count = '$countRows'  - ProxyUserID =  '$ProxyUserID'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
			
			//----------------------------------------------------------------------------------------------------------
			// Get the data
			//----------------------------------------------------------------------------------------------------------
			$result_array = mysql_fetch_assoc($sql_result);
			break;
	}
		
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
				<td width=\"5%\" align=center height=20 class=\"tblDetailsmTextOn\">
					<a href=\"UAaccesspriv.php?proxytype=".$result_auth_array[ProxyType]."&medpal=".$medpal."&proxyuserid=".$result_auth_array[ProxyUserID]."&Action=remove\" target=\"mainFrame\">
						<img id=\"removehost\" height=15 width=15 border=\"0\" src=\"images/axe1ton.gif\" 
							alt=\"Remove Name from Access List\">
					</a>
				</td>
				
				<td width=\"5%\" align=center height=20 class=\"tblDetailsmTextOn\">
						<a href=\"if_UAaccesspriv.php?proxytype=".$result_auth_array[ProxyType]."&proxyuserid=".$result_auth_array[ProxyUserID]."\" target=\"mainFrame\">
							<img id=\"moredetail\" border=\"0\" height=20 width=20 src=\"images/binocularsOn.gif\"
								alt=\"Look at Detail on Proxy User\">
						</a>
				</td>
				
				<td width=\"25%\" align=center class=\"tblDetailsmTextOn\" id=\"td".$i."\" align=left height=20>".$result_auth_array[AuthType]."</td> 
							
				<td width=\"20%\" align=left class=\"tblDetailsmTextOn\" id=\"td".$i."\" align=left height=20>".$DisplayName."</td> 
			
				<td width=\"25%\" align=center class=\"tblDetailsmTextOn\" id=\"td".$i."\" align=left height=20>".$result_auth_array[AuthLevelDesc]."</td> 
				
				<td width=\"20%\" align=left class=\"tblDetailsmTextOn\" id=\"td".$i."\" align=left height=20>".$result_auth_array[RelationshipType]."</td> 
			</tr>
			";
			
		$FlipFlag = 0;	
	}
	else
	{
		$DisplayList .= " 
			<tr> 
				<td width=\"5%\" align=center height=20 class=\"tblDetailsmTextOff\">
					<a href=\"proxyaccess.php?proxytype=".$result_auth_array[ProxyType]."&medpal=".$medpal."&proxyuserid=".$result_auth_array[ProxyUserID]."&Action=remove\" target=\"mainFrame\">
						<img id=\"removehost\" height=15 width=15 border=\"0\" src=\"images/axe1t.gif\" 
							alt=\"Remove Name from Access List\">
					</a>
				</td>
				
				<td width=\"5%\" align=center height=20 class=\"tblDetailsmTextOff\">
						<a href=\"if_UAaccesspriv.php?proxytype=".$result_auth_array[ProxyType]."&proxyuserid=".$result_auth_array[ProxyUserID]."\" target=\"mainFrame\">
							<img id=\"moredetail\" border=\"0\" height=20 width=20 src=\"images/binoculars.gif\"
								alt=\"Look at Detail on Proxy User\">
						</a>
				</td>
				
				<td width=\"25%\" align=center class=\"tblDetailsmTextOff\" id=\"td".$i."\" align=left height=20>".$result_auth_array[AuthType]."</td> 
							
				<td width=\"20%\" align=left class=\"tblDetailsmTextOff\" id=\"td".$i."\" align=left height=20>".$DisplayName."</td> 
			
				<td width=\"25%\" align=center class=\"tblDetailsmTextOff\" id=\"td".$i."\" align=left height=20>".$result_auth_array[AuthLevelDesc]."</td> 
				
				<td width=\"20%\" align=left class=\"tblDetailsmTextOff\" id=\"td".$i."\" align=left height=20>".$result_auth_array[RelationshipType]."</td> 
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
	<? print $JavaScriptLogMsg; ?> 
		
	<? print $JavaScriptMsg; ?>
}
</script>
</head>

<body onload="startUp()">

<div>
<center>
<table width="100%" cellspacing=0 cellpadding=0 border=0>
		<? print $DisplayList; ?>
</table>

</center>
</div>
</body>
</html>
