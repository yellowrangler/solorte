<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_proxylist.php';

require ('hysInitAdminClient.php');

require ('hysDBinit.php');

//----------------------------------------------------------------------------------------------------------
// now lets get the list we are working on
//----------------------------------------------------------------------------------------------------------
if ( !isset($_GET[proxytype]) || ($_GET[proxytype] == "" ) )
{	
	//Error - must have proxy type sent
	$errmsg = "No proxy type received. proxytype = '$_GET[proxytype]'";
	$location = "";
	$severity = 1;	
$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

$ProxyType = $_GET[proxytype];

switch ($ProxyType)
{
	case $DisplayClientType:
		//----------------------------------------------------------------------------------------------------------
		// create the SQL statement -- Note:  This is default (no get or post data 
		//----------------------------------------------------------------------------------------------------------
		if (isset($_POST[Search]))
		{
			$sql = "SELECT  FirstName, LastName, Suffix, MI, Prefix, ClientTBL.MEDPAL as ProxyUserID
					from ClientTBL 
					left join FullNameTBL  on ClientTBL.FullNameID = FullNameTBL.ID
					inner join AuthenticationTBL on ClientTBL.MEDPAL = AuthenticationTBL.USERID
						WHERE (LastName LIKE '%$_POST[Search]%' and AuthenticationTBL.TypeID = '$ProxyType')
							ORDER BY LastName, FirstName";   
				
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query join for ClientTBL with LIKE (194) sql = '$sql'";
				$location = "";
				$severity = 1;	
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
		}
		else
		{	
			$sql = "SELECT  FirstName, LastName, Suffix, MI, Prefix, ClientTBL.MEDPAL as ProxyUserID
				from ClientTBL 
				left join FullNameTBL  on ClientTBL.FullNameID = FullNameTBL.ID
				inner join AuthenticationTBL on ClientTBL.MEDPAL = AuthenticationTBL.USERID
					WHERE (AuthenticationTBL.TypeID = '$ProxyType')
						ORDER BY LastName, FirstName";    
				
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query join for ClientTBL (195) sql = '$sql'";
				$location = "";
				$severity = 1;	
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}	
		}
		break;
		
	case $DisplayPharmacyType:
		if (isset($_POST[Search]))
		{
			$sql = "SELECT  Name, PharmacyID as ProxyUserID
				from ClientPharmacyTBL 
				left join PharmacyTBL on PharmacyTBL.ID = ClientPharmacyTBL.PharmacyID
				inner join AuthenticationTBL on ClientPharmacyTBL.PharmacyID = AuthenticationTBL.USERID
					WHERE (Name LIKE '%$_POST[Search]%' and MEDPAL = '$Medpal' and AuthenticationTBL.TypeID = '$ProxyType')
						ORDER BY Name"; 	 
					
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
			$sql = "SELECT  Name, PharmacyID as ProxyUserID
				from ClientPharmacyTBL 
				left join PharmacyTBL on PharmacyTBL.ID = ClientPharmacyTBL.PharmacyID
				inner join AuthenticationTBL on ClientPharmacyTBL.PharmacyID = AuthenticationTBL.USERID
					WHERE (MEDPAL = '$Medpal' and AuthenticationTBL.TypeID = '$ProxyType')
						ORDER BY Name"; 	 
				
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
		break;
		
	case $DisplayProviderType:
		if (isset($_POST[Search]))
		{
			$sql = "SELECT  Prefix, FirstName, MI, LastName, Suffix, ProviderID as ProxyUserID
				from ClientProviderTBL 
				left join  ProviderTBL on ProviderTBL.ID = ClientProviderTBL.ProviderID 
				left join FullNameTBL  on ProviderTBL.FullNameID = FullNameTBL.ID
				inner join AuthenticationTBL on ClientProviderTBL.ProviderID = AuthenticationTBL.USERID
					WHERE (LastName LIKE '%$_POST[Search]%' and MEDPAL = '$Medpal' and AuthenticationTBL.TypeID = '$ProxyType')
						ORDER BY LastName, FirstName";  
				
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query join for ProviderTBL with LIKE (194) sql = '$sql'";
				$location = "";
				$severity = 1;	
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
		}
		else
		{	
			$sql = "SELECT  Prefix, FirstName, MI, LastName, Suffix, ProviderID as ProxyUserID
				from ClientProviderTBL 
				left join  ProviderTBL on ProviderTBL.ID = ClientProviderTBL.ProviderID 
				left join FullNameTBL  on ProviderTBL.FullNameID = FullNameTBL.ID
				inner join AuthenticationTBL on ClientProviderTBL.ProviderID = AuthenticationTBL.USERID
					WHERE MEDPAL = ('$Medpal' and AuthenticationTBL.TypeID = '$ProxyType')
						ORDER BY LastName, FirstName";   
				
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query join for ProviderTBL (195) sql = '$sql'";
				$location = "";
				$severity = 1;	
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}	
		}
		break;
		
	case $DisplayUserProxyType:
		//----------------------------------------------------------------------------------------------------------
		// create the SQL statement -- Note:  This is default (no get or post data 
		//----------------------------------------------------------------------------------------------------------
		if (isset($_POST[Search]))
		{
			$sql = "SELECT  FirstName, LastName, Suffix, MI, Prefix, UserTBL.ID as ProxyUserID
					from UserTBL 
					left join FullNameTBL  on UserTBL.FullNameID = FullNameTBL.ID
					inner join AuthenticationTBL on UserTBL.ID = AuthenticationTBL.USERID
						WHERE (LastName LIKE '%$_POST[Search]%' and AuthenticationTBL.TypeID = '$ProxyType')
							ORDER BY LastName, FirstName";   
				
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query join for UserTBL with LIKE (194) sql = '$sql'";
				$location = "";
				$severity = 1;	
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
		}
		else
		{	
			$sql = "SELECT  FirstName, LastName, Suffix, MI, Prefix, UserTBL.ID as ProxyUserID
				from UserTBL 
				left join FullNameTBL  on UserTBL.FullNameID = FullNameTBL.ID
				inner join AuthenticationTBL on UserTBL.ID = AuthenticationTBL.USERID
					WHERE AuthenticationTBL.TypeID = '$ProxyType'
						ORDER BY LastName, FirstName";    
				
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query join for UserTBL (195) sql = '$sql'";
				$location = "";
				$severity = 1;	
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}	
		} 
		break;
		
} // end of switch
		
			
// Now lets first see if there is anything to run through.  If more then 1 we have an error
$countRows = mysql_num_rows($sql_result);
if ($countRows < 0)
{
	$errmsg = " Error less then 0 rows returned in select on UserTBL. count = '$countRows'";
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
	if ($ProxyType == $DisplayPharmacyType)
	{
		$DisplayName = $result_array[Name];
	}
	else
	{	
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

	if ($FlipFlag == 1)
	{	
		$DisplayList .= " 
			<tr> 
				<td valign=left class=\"tblDetailsmTextOff\" id=\"td".$i."\" align=left height=20>
					<a id=\"a".$i."\" href=\"if_proxyaccess.php?proxyuserid=".$result_array[ProxyUserID]."&proxytype=".$ProxyType."\" target=\"mainFrame\"  class=\"tblDetailsmTextOff\">".$DisplayName."</a>
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
					<a id=\"a".$i."\" href=\"if_proxyaccess.php?proxyuserid=".$result_array[ProxyUserID]."&proxytype=".$ProxyType."\" target=\"mainFrame\" class=\"tblDetailsmTextOn\">".$DisplayName."</a>
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
<title>HealthYourSelf Manage Client User Information</title>
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
	<?php print $JavaScriptLogMsg; ?>
		
	<?php print $JavaScriptMsg; ?>
}
</script> 
</head>

<body onload="startUp()">
<table width="100%" cellspacing="0" cellpadding="0">
	<?php print $DisplayList; ?>
</table>
</body>
</html>
