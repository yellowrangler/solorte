<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_useridclientlist.php';

$NoMedpalState = 'Y';

require ('hysInit.php');

require ('hysDBinit.php');

//----------------------------------------------------------------------------------------------------------
// create the SQL statement -- Note:  This is default (no get or post data 
//----------------------------------------------------------------------------------------------------------
if (isset($_POST[Search]))
{
	//------------------------------------------------------------------------------------------
	// If we are customer service we get all the clients otherwiae we check for constraints
	//------------------------------------------------------------------------------------------
	if ($UserType == $DisplayCustomerServiceType)
	{
		$sql = "SELECT  Prefix, FirstName, MI, LastName, Suffix,
			ClientTBL.MEDPAL as AuthMedpal,
			DOB, Sex, State, Zip
			from ClientTBL
			left join FullNameTBL  on ClientTBL.FullNameID = FullNameTBL.ID
			left join ClientAddrTBL on ClientAddrTBL.MEDPAL = ClientTBL.MEDPAL
			left join AddrTBL on ClientAddrTBL.AddrID = AddrTBL.ID
			left join ClientExternalTBL on ClientTBL.MEDPAL = ClientExternalTBL.MEDPAL
				WHERE (LastName LIKE '%$_POST[Search]%' and AddrTBL.OrderID = '1')
					ORDER BY LastName, FirstName"; 
	}
	else
	{
		$sql = "SELECT  Prefix, FirstName, MI, LastName, Suffix, 
			AuthorizationTBL.MEDPAL as AuthMedpal,
			DOB, Sex, State, Zip
			from AuthorizationTBL
			left join ClientTBL on AuthorizationTBL.MEDPAL = ClientTBL.MEDPAL
			left join FullNameTBL  on ClientTBL.FullNameID = FullNameTBL.ID
			left join ClientAddrTBL on ClientAddrTBL.MEDPAL = AuthorizationTBL.MEDPAL
			left join AddrTBL on ClientAddrTBL.AddrID = AddrTBL.ID
			left join ClientExternalTBL  on AuthorizationTBL.MEDPAL = ClientExternalTBL.MEDPAL
				WHERE (AuthorizationTBL.USERID = '$UserID' and AuthorizationTBL.TypeID = '$UserType') and 
						(LastName LIKE '%$_POST[Search]%' and AddrTBL.OrderID = '1')
							ORDER BY LastName, FirstName"; 
	}	
}
else
{	
	if ($UserType == $DisplayCustomerServiceType)
	{
		$sql = "SELECT  Prefix, FirstName, MI, LastName, Suffix, 
			ClientTBL.MEDPAL as AuthMedpal,
			DOB, Sex, State, Zip
			from ClientTBL
			left join FullNameTBL  on ClientTBL.FullNameID = FullNameTBL.ID
			left join ClientAddrTBL on ClientAddrTBL.MEDPAL = ClientTBL.MEDPAL
			left join AddrTBL on ClientAddrTBL.AddrID = AddrTBL.ID
			left join ClientExternalTBL on ClientTBL.MEDPAL = ClientExternalTBL.MEDPAL
				WHERE (AddrTBL.OrderID = '1')
					ORDER BY LastName, FirstName"; 
	}
	else
	{
		$sql = "SELECT  Prefix, FirstName, MI, LastName, Suffix, 
			AuthorizationTBL.MEDPAL as AuthMedpal,
			DOB, Sex, State, Zip
			from AuthorizationTBL
			left join ClientTBL on AuthorizationTBL.MEDPAL = ClientTBL.MEDPAL
			left join FullNameTBL  on ClientTBL.FullNameID = FullNameTBL.ID
			left join ClientAddrTBL on ClientAddrTBL.MEDPAL = AuthorizationTBL.MEDPAL
			left join AddrTBL on ClientAddrTBL.AddrID = AddrTBL.ID
			left join ClientExternalTBL  on AuthorizationTBL.MEDPAL = ClientExternalTBL.MEDPAL
				WHERE (AuthorizationTBL.USERID = '$UserID' and AuthorizationTBL.TypeID = '$UserType') and 
						(AddrTBL.OrderID = '1')
							ORDER BY LastName, FirstName"; 
	}	  
}

//--------------------------------------------------------
// Run the query
//--------------------------------------------------------	
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query join for AuthorizationTBL, ClientTBL, FullNameTBL and ClientExternalTBL (195) sql = '$sql'- '$UserID'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// Used to turn colors on and off 
$FlipFlag = 1;

// initialize display block
$DisplayBlock = "";

// now lets run the table and get our medical appointments
while ($result_array = mysql_fetch_assoc($sql_result))
{
	
	//----------------------------------------------------------------------------------------------------------
	// Build Name
	//----------------------------------------------------------------------------------------------------------
	$DisplayName ="";
	
	$DisplayName .= $result_array[LastName];
	if ($result_array[Suffix] != "")
	{
		$DisplayName .= " ".$result_array[Suffix];
	}
	
	$DisplayName .= ", ".$result_array[FirstName]." ".$result_array[MI];	
	
	if ($FlipFlag == 1)
	{
		$DisplayBlock .= "
		<tr>
			<td width=\"5%\" align=center height=17 class=\"tblDetailsmTextOff\">
				<a href=\"setmedpal.php?medpal=".$result_array[AuthMedpal]."\" target=\"_top\">
					<img id=\"moredetail\" height=20 width=20 border=\"0\" src=\"images/binoculars.gif\">
				</a>
			</td>
			<td width=\"30%\" align=center height=17 class=\"tblDetailsmTextOff\">".$DisplayName."</td>
			<td width=\"25%\" align=center height=17 class=\"tblDetailsmTextOff\">".$result_array[DOB]."</td>
			<td width=\"10%\" align=center height=17 class=\"tblDetailsmTextOff\">".$result_array[Sex]."</td>
			<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOff\">".$result_array[State]."</td>
			<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOff\">".$result_array[Zip]."</td>
		</tr>
		";
		
		$FlipFlag = 0;
	}
	else
	{
		$DisplayBlock .= "
		<tr>
			<td width=\"5%\" align=center height=17 class=\"tblDetailsmTextOn\">
				<a href=\"setmedpal.php?medpal=".$result_array[AuthMedpal]."\" target=\"_top\">
					<img id=\"moredetail\" height=20 width=20 border=\"0\" src=\"images/binocularsOn.gif\">
				</a>
			</td>
			<td width=\"30%\" align=center height=17 class=\"tblDetailsmTextOn\">".$DisplayName."</td>
			<td width=\"25%\" align=center height=17 class=\"tblDetailsmTextOn\">".$result_array[DOB]."</td>
			<td width=\"10%\" align=center height=17 class=\"tblDetailsmTextOn\">".$result_array[Sex]."</td>
			<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOn\">".$result_array[State]."</td>
			<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOn\">".$result_array[Zip]."</td>
		</tr>
		";
		
		$FlipFlag = 1;
	}
}  // end of while

?>
<html>

<head>
<title>HealthYourSelf userid medpal list</title>
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
		<?php print $DisplayBlock; ?>
</table>

</center>

</div>
</body>
</html>
