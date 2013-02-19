<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_clientlistforaccess.php';

require ('hysInitAdmin.php');

require ('hysDBinit.php');

//----------------------------------------------------------------------------------------------------------
// create the SQL statement -- Note:  This is default (no get or post data 
//----------------------------------------------------------------------------------------------------------
if (isset($_POST[Search]))
{
	$sql = "SELECT  Prefix, FirstName, MI, LastName, Suffix, MEDPAL
		from ClientTBL 
		left join FullNameTBL  on ClientTBL.FullNameID = FullNameTBL.ID
			WHERE LastName LIKE '%$_POST[Search]%'
			ORDER BY LastName, FirstName"; 
		
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query join for ClientTBL, and FullNameTBL with LIKE (194) sql = '$sql'- '$Medpal'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
}
else
{	
	$sql = "SELECT  Prefix, FirstName, MI, LastName, Suffix, MEDPAL
		from ClientTBL 
		left join FullNameTBL  on ClientTBL.FullNameID = FullNameTBL.ID
			ORDER BY LastName, FirstName"; 
		
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query join for ClientTBL, and FullNameTBL (195) sql = '$sql'- '$Medpal'";
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
	$errmsg = " Error less then 0 rows returned in select on ClientTBL. count = '$countRows'  - '$Medpal'";
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
	
	$DisplayName .= ", ".$result_array[FirstName]." ".$result_array[MI];	

	if ($FlipFlag == 1)
	{	
		$DisplayList .= " 
			<tr> 
				<td valign=left class=\"tblDetailsmTextOff\" id=\"td".$i."\" align=left height=20>
					<a id=\"a".$i."\" href=\"if_clientsharedaccess.php?accessuserid=".$result_array[MEDPAL]."\" target=\"mainFrame\" class=\"tblDetailsmTextOff\">".$DisplayName."</a>
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
					<a id=\"a".$i."\" href=\"if_clientsharedaccess.php?accessuserid=".$result_array[MEDPAL]."\" target=\"mainFrame\" class=\"tblDetailsmTextOn\">".$DisplayName."</a>
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
<title>HealthYourSelf Manage Account Information</title>
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
