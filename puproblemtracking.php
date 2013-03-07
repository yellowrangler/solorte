<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'puproblemtracking.php';

require ('hysInit.php');

require ('hysDBinit.php');

//----------------------------------------------------------------------------------------------------------
// if we are post action add information to prob tracking system first
//----------------------------------------------------------------------------------------------------------

if (isset($_POST[Action]) && ($_POST[Action] != "") )
{
	$time = time();
	$strDateTime = date("Y-m-d H:i:s", $time);
	
	//--------------------------------------------------------------------------------------------------
	// we can only do adds here so no need to check action type
	//--------------------------------------------------------------------------------------------------
	$sql = "INSERT INTO ProblemTrackingTBL 
				(DateTimeStamp, USERID, UserTypeID, ProblemTypeID, ProblemAreaID, BrowserTypeID, 
				BrowserOther, OperatingSystemID, OperatingSystemOther, Problem, ProblemStatusID)
				VALUES ('$strDateTime', '$_POST[userid]', '$_POST[usertype]', '$_POST[problemtype]', '$_POST[problemarea]', '$_POST[browser]',
					'$_POST[browserother]', '$_POST[os]', '$_POST[osother]', '$_POST[problem]', '1')";

	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query insert ProblemTrackingTBL (695) - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "Location: puproblemtracking.php";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	
	//--------------------------------------------------------------------------------------------------
	// Now lets process the result set 
	//--------------------------------------------------------------------------------------------------
	$affRows = mysql_affected_rows($conn);
	if ($affRows != 1)
	{
		// error
		$errmsg = "Unable to add problem. Please try again. Insert Failed.";
		$location = "Location: puproblemtracking.php";
		$shortmsg = "Unable to Save problem.";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	
	$DisplayMSG = "Problem Tracking successfully Added.";
	
	$NextPage = "Location: $module?msgTxt=$DisplayMSG";
	
	//--------------------------------------------------------------------------------------------------
	// Send email to myself that someone has enterd problem
	//--------------------------------------------------------------------------------------------------
	mail("$user@$host", "Problem Tracking Report Submited", "Submited by ".$_POST[name]."\n");
	
	header($NextPage);
		
} // End of if isset

//----------------------------------------------------------------------------------------------------------
// get problem types names
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT ID, ProblemType from ProblemTypeTBL"; 
		
// Make the call
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ProblemTypeTBL (395) - '$UserID' '$UserType'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "Location: puproblemtracking.php";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// initialize display block
$DisplayProblemTypeList = "";
$DisplayProblemType = "";
$DisplayProblemTypeID = "None";

// Now lets first see if there is anything to run through
$countRows = mysql_num_rows($sql_result);
if ($countRows >  0) 
{	
	// now lets run the table and get our provider names
	while ($result_arr = mysql_fetch_assoc($sql_result))
	{
		$DisplayProblemTypeList .= "\t\t\t<option value=\"".$result_arr[ID]."\">".$result_arr[ProblemType]."\n ";
	}
}	

//----------------------------------------------------------------------------------------------------------
// get problem area names
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT ID, ProblemArea from ProblemAreaTBL"; 
		
// Make the call
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ProblemAreaTBL (395) - '$UserID' '$UserType'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "Location: puproblemtracking.php";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// initialize display block
$DisplayProblemAreaList = "";
$DisplayProblemArea = "";
$DisplayProblemAreaID = "None";

// Now lets first see if there is anything to run through
$countRows = mysql_num_rows($sql_result);
if ($countRows >  0) 
{	
	// now lets run the table and get our provider names
	while ($result_arr = mysql_fetch_assoc($sql_result))
	{
		$DisplayProblemAreaList .= "\t\t\t<option value=\"".$result_arr[ID]."\">".$result_arr[ProblemArea]."\n ";
	}
}	

//----------------------------------------------------------------------------------------------------------
// get browser type names
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT ID, BrowserType from BrowserTypeTBL"; 
		
// Make the call
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for BrowserTypeTBL (395) - '$UserID' '$UserType'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "Location: puproblemtracking.php";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// initialize display block
$DisplayBrowserList = "";
$DisplayBrowser = "";
$DisplayBrowserID = "None";

// Now lets first see if there is anything to run through
$countRows = mysql_num_rows($sql_result);
if ($countRows >  0) 
{	
	// now lets run the table and get our provider names
	while ($result_arr = mysql_fetch_assoc($sql_result))
	{
		$DisplayBrowserList .= "\t\t\t<option value=\"".$result_arr[ID]."\">".$result_arr[BrowserType]."\n ";
	}
}	

//----------------------------------------------------------------------------------------------------------
// get os type names
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT ID, OperatingSystem from OperatingSystemTBL"; 
		
// Make the call
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for OperatingSystemTBL (395) - '$UserID' '$UserType'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "Location: puproblemtracking.php";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// initialize display block
$DisplayOSList = "";
$DisplayOS = "";
$DisplayOSID = "None";

// Now lets first see if there is anything to run through
$countRows = mysql_num_rows($sql_result);
if ($countRows >  0) 
{	
	// now lets run the table and get our provider names
	while ($result_arr = mysql_fetch_assoc($sql_result))
	{
		$DisplayOSList .= "\t\t\t<option value=\"".$result_arr[ID]."\">".$result_arr[OperatingSystem]."\n ";
	}
}	

//----------------------------------------------------------------------------------------------------------
// get  name of person submitting the bug
//----------------------------------------------------------------------------------------------------------
$ProxyType = $UserType;
$ProxyUserID = $UserID;

switch ($ProxyType)
{
	case $DisplayClientType:
		//----------------------------------------------------------------------------------------------------------
		// create the SQL statement to get the client info
		//----------------------------------------------------------------------------------------------------------
		$sql = "SELECT FullNameID, FirstName, LastName, Suffix, MI, Prefix
			from ClientTBL
			left join FullNameTBL  on ClientTBL.FullNameID = FullNameTBL.ID
				where (ClientTBL.MEDPAL = '$ProxyUserID')";  
			
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query join for ClientTBL, and FullNameTBL (195) sql = '$sql'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: puproblemtracking.php";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
			
		// Now lets first see if there is anything to run through.  If more then 1 we have an error
		$countRows = mysql_num_rows($sql_result);
		if ($countRows != 1)
		{
			$errmsg = " Error more or less then 1 rows returned in select on ClientTBL. count = '$countRows'  - ProxyUserID =  '$ProxyUserID'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: puproblemtracking.php";
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
		$sql = "SELECT FullNameID, Prefix, FirstName, MI, LastName, Suffix
			from PharmacyTBL 
			left join FullNameTBL on PharmacyTBL.FullNameID = FullNameTBL.ID
				WHERE (PharmacyTBL.ID = '$ProxyUserID')"; 
				
		 if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query join for PharmacyTBL, FullNameTBL (195) sql = '$sql'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: puproblemtracking.php";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
			
		// Now lets first see if there is anything to run through.  If more then 1 we have an error
		$countRows = mysql_num_rows($sql_result);
		if ($countRows != 1)
		{
			$errmsg = " Error more or less then 1 rows returned in select on PharmacyTBL. count = '$countRows'  - ProxyUserID =  '$ProxyUserID'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: puproblemtracking.php";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}		
		
		//----------------------------------------------------------------------------------------------------------
		// Get the data
		//----------------------------------------------------------------------------------------------------------
		$result_array = mysql_fetch_assoc($sql_result);
		break;
	
	case $DisplayProviderType:
		$sql = "SELECT FullNameID, Prefix, FirstName, MI, LastName, Suffix
			from ProviderTBL 
			left join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID 
				where (ProviderTBL.ID = '$ProxyUserID')";
		
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query join for ProviderTBL and FullNameTBL (195) sql = '$sql'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: puproblemtracking.php";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
			
		// Now lets first see if there is anything to run through.  If more then 1 we have an error
		$countRows = mysql_num_rows($sql_result);
		if ($countRows != 1)
		{
			$errmsg = " Error more or less then 1 rows returned in select on ProviderTBL. count = '$countRows'  - ProxyUserID =  '$ProxyUserID'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: puproblemtracking.php";
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
		$sql = "SELECT FullNameID, FirstName, LastName, Suffix, MI, Prefix
			from UserTBL
			left join FullNameTBL  on UserTBL.FullNameID = FullNameTBL.ID
				where (UserTBL.ID = '$ProxyUserID')";  
			
		if (!$sql_result = mysql_query($sql, $conn))
		{
			$sqlerr = mysql_error();
			$errmsg = "$sqlerr - Error doing mysql_query join for UserTBL,  and FullNameTBL (195) sql = '$sql'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: puproblemtracking.php";
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}
			
		// Now lets first see if there is anything to run through.  If more then 1 we have an error
		$countRows = mysql_num_rows($sql_result);
		if ($countRows != 1)
		{
			$errmsg = " Error more or less then 1 rows returned in select on UserTBL. count = '$countRows'  - ProxyUserID =  '$ProxyUserID'";
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			$location = "Location: puproblemtracking.php";
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
if ($ProxyType == $DisplayCustomerServiceType)
{
	$DisplayName = "CSID".$ProxyUserID;
}
else
{	
	$DisplayName = "";
	
	if ($result_array[Prefix] != "")
	{
		$DisplayName .= $result_array[Prefix]." ";
	}
	
	$DisplayName .= $result_array[FirstName]." ";
	
	if ($result_array[MI] != "")
	{
		$DisplayName .= $result_array[MI]." ";
	}
	
	$DisplayName .= $result_array[LastName]." ";
	
	if ($result_array[Suffix] != "")
	{
		$DisplayName .= $result_array[Suffix];
	}
}

//----------------------------------------------------------------------------------------------------------
// create the SQL statement to get next problem tracking id
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT MAX(ID) as MaxProblemTrackingID from ProblemTrackingTBL"; 
	
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query MAX for ProblemTrackingTBL(195)";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "Location: puproblemtracking.php";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------
// Get the data
//----------------------------------------------------------------------------------------------------------
$result_array = mysql_fetch_assoc($sql_result);

//------------------------------------------------------------------------------------------------------
// convert the date of birth  
//------------------------------------------------------------------------------------------------------
$DisplayProblemTrackingID = $result_array[MaxProblemTrackingID] + 1;

?>

<html>
<head>

<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>

<title>New Page 1</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css">

.topicBorder {
		color: white;
		font: 700 15px Arial,Helvetica;
		border-top:0px solid #8da98d;
		border-left:1px solid #8da98d;
		border-right:1px solid #8da98d;
		border-bottom:0px solid white;
		text-align: left;
		background: #8da98d;
		}	
		
.mainBar {
		position: absolute;
		left:3px;
		top:32px;
		height:5px;
		border-top:3px solid #008080;
		border-right:1px solid white;
		border-left:1px solid white;
		background:#fff;
		}
		
.dateLine {
		position:absolute;
		left:5px;
		top:39px;
		height:10px;
		border-top:1px solid white;
		border-right:1px solid white;
		border-left:1px solid white;
		background:#fff;
		}
		
.logincrumbLineBorder {
		border: 1px; 
		font: 700 italic 10px Veranda, Arial,Helvetica;
		border-top:0px solid white;
		border-right:0px solid white;
		border-left:0px solid white;
		background: solid white;
		}	
		

.middlecontent {
		position: absolute;
		left:10px;
		top:70px;
		height:600px;
		width:675px;
		background-color: white;
		border:1px solid white;
		}
						
		
.outerBorder {
		border-top:1px solid #8da98d;
		border-left:1px solid #8da98d;
		border-right:1px solid #8da98d;
		border-bottom:1px solid #8da98d;
		}	

.SmTxt   { 
		font: 400 13px Arial, Geneva;
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

<div id="banner" class="banner">
<table width="100%" border=0 cellspacing=0 cellpadding=0>
		<tr>
      <td width="65%" align="left"><img border="0" src="images/healthyourselflogo.JPG"></td>
      <td align="left">&nbsp;</td>  
  </tr>
</table>
</div>

<!-- thin bar -->
<div align="left">
<table class="mainBar" width="90%">
  <tr>
    <td></td>
  </tr>
</table>
</div>   

<!-- Third line within top set shows date and allows for user to print page -->
<div name="dateLine" class="dateLine">
<table width="100%">
  <tr>
    <td width="100%" valign="center" align="left" class="logincrumbLineBorder" height="15"><?php print currDate(); ?></t
  </tr>
</table>
</div>  

<!-- This is the beginning of main display -->
<div id="middlecontent" class="middlecontent">

<form method="POST" name="problemtracking"  ACTION="puproblemtracking.php">
<center>
<table width="100%">
	<tr>
		 <td height=20 align="center"><h2>Problem Tracking System</h2></td>
	</tr>	
</table>

<table width="100%" class="SmTxt">
	<tr>
		<td align=right colspan=4 height=15>&nbsp;</td>
	</tr>	
	<tr>
		<td align=right valign=center height=15>User Name:</td>
		<td align=left><input readonly class="readonlyText" size=50 maxlength=50 type="text" name="name" value="<?php print $DisplayName; ?>"></td>
	</tr>
	<tr>
		<td align=right height=35>Problem Tracking ID:</td>
		<td align=left><input readonly class="readonlyText" size=10  maxlength=10 type="text" name="problemtrackingid" value="<?php print $DisplayProblemTrackingID; ?>"</td>
	</tr>
	<tr>
		<td align=right height=35>Problem Type:</td>
		<td align=left>
			<select name="problemtype"> 
				<option class="smallTxtGry" value="<?php print $DisplayProblemTypeID; ?>"><?php print $DisplayProblemType; ?> 
				<?php print $DisplayProblemTypeList; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td align=right height=35>Problem Area:</td>
		<td align=left>
			<select name="problemarea"> 
				<option class="smallTxtGry" value="<?php print $DisplayProblemAreaID; ?>"><?php print $DisplayProblemArea; ?> 
				<?php print $DisplayProblemAreaList; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td align=right height=35>Browser:</td>
		<td align=left>
			<select name="browser"> 
				<option class="smallTxtGry" value="<?php print $DisplayBrowserID; ?>"><?php print $DisplayBrowser; ?> 
				<?php print $DisplayBrowserList; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td align=right height=35>Browser Other:</td>
		<td align=left><input size=30 maxlength=50 type="text" name="browserother" value="<?php print $DisplayBrowserOther; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=35>Operating System:</td>
		<td align=left>
			<select name="os"> 
				<option class="smallTxtGry" value="<?php print $DisplayOSID; ?>"><?php print $DisplayOS; ?> 
				<?php print $DisplayOSList; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td align=right height=35>Operating System Other:</td>
		<td align=left><input size=30 maxlength=50 type="textarea" name="osother" value="<?php print $DisplayOSOther; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=35 valign=top>Problem Statement:</td>
		<td align=left><textarea rows=5 cols=50 name="problem"> </textarea></td>
	</tr>
</table>
<input type="hidden" name="Action" value="add">
<input type="hidden" name="userid" value="<?php print $ProxyUserID; ?>">
<input type="hidden" name="usertype" value="<?php print $ProxyType; ?>">		
<br>
<table>
	<tr>
		<td align=center><input type=submit size=150 NAME="SUBMIT" VALUE="Submit"></td>
		<td>&nbsp;</td>
		<td align=center><input type=reset size=150 NAME="RESET" VALUE="Reset"></td>
	</tr>
</table>	
</center>	
</form>

<br>
<center>
<table width="90%">
	<tr>
		<td align=center>
			<h4><?php print $_GET[msgTxt]; ?> &nbsp;</h4>
		</td>
	</tr> 
</table>	
</center>

</div>

</body>

</html>
