<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_providerinfo.php';

require ('hysInitAdmin.php');

require ('hysDBinit.php');

require ('hysStatusMsg.php');

//----------------------------------------------------------------------------------------------------------
// lets get Provider type names
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT ID, Description from ProviderTypeTBL ORDER BY Description"; 

//----------------------------------------------------------------------------------------------------------
// Make the call
//----------------------------------------------------------------------------------------------------------
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ProviderTypeTBL  (495)";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------
// initialize display block
//----------------------------------------------------------------------------------------------------------
$DisplayProviderTypeList = "";

//----------------------------------------------------------------------------------------------------------
// Now lets first see if there is anything to run through
//----------------------------------------------------------------------------------------------------------
$countRows = mysql_num_rows($sql_result);
if ($countRows >  0) 
{	
	// now lets run the table and get our provider names
	while ($result_arr = mysql_fetch_assoc($sql_result))
	{
		$DisplayProviderTypeList .= "\t\t\t<option value=\"".$result_arr[ID]."\" >".$result_arr[Description]."\n ";
	}
}	

//----------------------------------------------------------------------------------------------------------
// lets get Provider Specialty Type names
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT ID, Description from SpecTypeTBL ORDER BY Description"; 

//----------------------------------------------------------------------------------------------------------
// Make the call
//----------------------------------------------------------------------------------------------------------
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for SpecTypeTBL  (445)";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------
// initialize display block
//----------------------------------------------------------------------------------------------------------
$DisplaySpecialtyTypeList = "";

//----------------------------------------------------------------------------------------------------------
// Now lets first see if there is anything to run through
//----------------------------------------------------------------------------------------------------------
$countRows = mysql_num_rows($sql_result);
if ($countRows >  0) 
{	
	// now lets run the table and get our provider names
	while ($result_arr = mysql_fetch_assoc($sql_result))
	{
		$DisplaySpecialtyTypeList .= "\t\t\t<option value=\"".$result_arr[ID]."\" >".$result_arr[Description]."\n ";
	}
}	


//----------------------------------------------------------------------------------------------------------
// lets get Provider ID Types
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT ID, ProviderIdentifierType from ProviderIdentifierTypeTBL ORDER BY ProviderIdentifierType"; 

//----------------------------------------------------------------------------------------------------------
// Make the call
//----------------------------------------------------------------------------------------------------------
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ProviderIdentifierTypeTBL  (445)";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------
// initialize display block
//----------------------------------------------------------------------------------------------------------
$DisplayProviderIndentifierTypeList = "";

//----------------------------------------------------------------------------------------------------------
// Now lets first see if there is anything to run through
//----------------------------------------------------------------------------------------------------------
$countRows = mysql_num_rows($sql_result);
if ($countRows >  0) 
{	
	// now lets run the table and get our provider names
	while ($result_arr = mysql_fetch_assoc($sql_result))
	{
		$DisplayProviderIndentifierTypeList .= "\t\t\t<option value=\"".$result_arr[ID]."\" >".$result_arr[ProviderIdentifierType]."\n ";	}
}	

//----------------------------------------------------------------------------------------------------------
//  we need to see if we have been passed a ProviderID
//----------------------------------------------------------------------------------------------------------
$isType = "";
$UpdateState = "";

if (isset($_GET[providerid]) && ($_GET[providerid] != "") )
{
	//Get host id and set flag to is update
	$DisplayProviderID = $_GET[providerid];
	$isType = "Update";
	$UpdateState = "readonly";
	$UpdateClass = " class=\"readonlyText\" ";
	$displayTitle = "Update Provider Information";
	
	//----------------------------------------------------------------------------------------------------------
	// First we will get the password if it is available
	//----------------------------------------------------------------------------------------------------------
	// create the SQL statement
	//----------------------------------------------------------------------------------------------------------
	$sql = "SELECT  Pword
		from AuthenticationTBL 
			where (AuthenticationTBL.USERID = '$DisplayProviderID'
			and AuthenticationTBL.TypeID = '$DisplayProviderType')"; 
			
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query for AutenticationTBL (83) - '$DisplayProviderID'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
	
	// make sure only 1 row was returned.  More then 1 means big problem - less then 1 means user not on file
	$num_rows = mysql_num_rows($sql_result);
	if ($num_rows == 1)
	{
		// get the password from our db and check it against what was entered
		$result_arr = mysql_fetch_assoc($sql_result);
		
		$DisplayPassword  = spookDStr($result_arr[Pword]);
	}
	else
	{
		$DisplayPassword = "";
	}	
	
	//----------------------------------------------------------------------------------------------------------
	// create the SQL statement
	//----------------------------------------------------------------------------------------------------------
	$sql = "SELECT  ProviderTBL.ID as providerID, ProviderTBL.TypeID as ProvTypeID, 
		FirstName, LastName, Suffix, MI, Prefix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone,
		SpecTypeTBL.ID as SpecialtyID, SpecTypeTBL.Description as SpecialtyDesc, 
		ProviderTypeTBL.Description as ProviderTypeDesc, ProviderTypeTBL.ID as ProviderTypeID,
		ProviderIdentifierType, ProviderIdentifier, ProviderIdentifierTypeID
		from ProviderTBL 
		left join FullNameTBL  on ProviderTBL.FullNameID = FullNameTBL.ID
		left join SpecTypeTBL on ProviderTBL.SpecialtyID = SpecTypeTBL.ID
		left join ProviderTypeTBL on ProviderTBL.TypeID = ProviderTypeTBL.ID
		left join ProviderIdentifierTBL on ProviderIdentifierTBL.ProviderID = ProviderTBL.ID
		left join ProviderIdentifierTypeTBL on ProviderIdentifierTBL.ProviderIdentifierTypeID = ProviderIdentifierTypeTBL.ID
			where (ProviderTBL.ID = '$DisplayProviderID')";
		
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
		$errmsg = " Error more then 1 rows returned in select on ProviderTBL. count = '$countRows'  - ProviderID =  '$DisplayProviderID'";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
	
	//----------------------------------------------------------------------------------------------------------
	// Get the data
	//----------------------------------------------------------------------------------------------------------
	$result_array = mysql_fetch_assoc($sql_result);
}
else
{
	//----------------------------------------------------------------------------------------------------------
	// Build empty screen - This is an add
	//----------------------------------------------------------------------------------------------------------
	$isType = "Add";
	$displayTitle = "Add New Provider";
	
	$UpdateClass = "";
	
	//----------------------------------------------------------------------------------------------------------
	// create the SQL statement
	//----------------------------------------------------------------------------------------------------------
	$sql = "SELECT MAX(ID) as MaxProviderID	from ProviderTBL"; 
		
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query MAX for ProviderTBL(195)";
		$location = "";
		$severity = 1;	
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	
	//----------------------------------------------------------------------------------------------------------
	// Get the data
	//----------------------------------------------------------------------------------------------------------
	$result_array = mysql_fetch_assoc($sql_result);
	
	//------------------------------------------------------------------------------------------------------
	// convert the date of birth  
	//------------------------------------------------------------------------------------------------------
	$DisplayProviderID = $result_array[MaxProviderID] + 1;
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

.detailBody {
		position: absolute;
		left:20px;
		top:38px; 
		width:650px;
		height:390px;
		background-color: white;
		border:1px solid black;
		}
		
.outerBorderblackfillSiennaSmTxt {
		font: 400 13px Arial, Geneva;
		line-height: 14px; 
		border-top:0px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		background: #ccccff;
		}	

.outerBorderblackSmTxt {
		font: 400 13px Arial, Geneva;
		line-height: 14px; 
		border-top:0px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		background: #ffffff;
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

.addHostSearch {
		position: absolute;
		left:20px;
		top:440px;
		width:225px;
		height:55px;
		background: white;
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		}
		
.addtitleHostList {
		position: absolute;
		left:20px;
		top:510px;
		width:227px;
		height:232px;
		background: white;
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		}

.inneraddHostList {
		position: absolute;
		left:0px;
		top:30px;
		width:225px;
		height:200px;
		background: white;
		border-top:0px solid black;
		border-left:0px solid black;
		border-right:0px solid black;
		border-bottom:0px solid black;
		}
		
.remordertitleHostList {
		position: absolute;
		left:290px;
		top:510px;
		width:382px;
		height:232px;
		background: white;
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		}

.innerremorderHostList {
		position: absolute;
		left:0px;
		top:30px;
		width:380px;
		height:200px;
		background: white;
		border-top:0px solid black;
		border-left:0px solid black;
		border-right:0px solid black;
		border-bottom:0px solid black;
		}				
				
</style>

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
	var fieldRequired = Array("firstname", "lastname", "providerid", "providertype", "specialtytype");
	// field description to appear in the dialog box
	var fieldDescription = Array("First Name", "Last Name", "Provider ID", "Provider Type", "Specialty");
	// field description to appear in the dialog box
	var fieldEdit = Array("None", "None", "None", "None", "None");
							
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

</head>

<body <?php print $BodySelectColor ?> onload="startUp()">

<div class="detailBody">
<form  action="providerinfo.php" method=post onsubmit="return formCheck(this);">
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
		<td align=right height=35 valign=bottom>Provider Name:</td>
		<td align=left colspan=5 valign=bottom>
			<table class="tableTextName" border=0>
				<tr class="tableHdrRow">
					<td align=center><b>Prefix</b></td>
					<td align=center><b>First Name</b></td>
					<td align=center><b>MI</b></td>
					<td align=center><b>LastName</b></td>
					<td align=center><b>Suffix</b></td>
				</tr>	
				<tr>
					<td valign=bottom align=center><input size=3 maxlength=5 type="text" name="prefix" value="<?php print $result_array[Prefix]; ?>"></td>
					<td valign=bottom align=center><input size=15 maxlength=45 type="text" name="firstname" value="<?php print $result_array[FirstName]; ?>"></td>
					<td valign=bottom align=center><input size=1 maxlength=1 type="text" name="mi" value="<?php print $result_array[MI]; ?>"></td>
					<td valign=bottom align=center><input size=15 maxlength=45 type="text" name="lastname" value="<?php print $result_array[LastName]; ?>"></td>
					<td valign=bottom align=center><input size=3 maxlength=5 type="text" name="suffix" value="<?php print $result_array[Suffix]; ?>"></td>
				</tr>	 
			</table>
		</td>
	</tr>
	<tr>
		<td align=right>Provider ID:</td>
		<td align=left><input <?php print $UpdateState; print $UpdateClass; ?> size=10  maxlength=10 type="text" name="providerid" value="<?php print $DisplayProviderID; ?>"</td>
		
		<td align=right height=35>Password:</td>
		<td align=left><input size=10 maxlength=10 type="text" name="providerpassword" value="<?php print $DisplayPassword; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=35>License:</td>
		<td align=left><input size=10 maxlength=20 type="text" name="license" value="<?php print $result_array[ProviderIdentifier]; ?>"> </td>
		
		<td align=right>Licensing Authority:</td>
		<td align=left>
			<select name="licensingauthority"> 
				<option class="smallTxtGry" value="<?php print  $result_array[ProviderIdentifierTypeID]; ?>"><?php print  $result_array[ProviderIdentifierType]; ?> 
				<?php print $DisplayProviderIndentifierTypeList; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td align=right height=35>Provider Type:</td>
		<td align=left>
			<select name="providertype"> 
				<option class="smallTxtGry" value="<?php print  $result_array[ProvTypeID]; ?>"><?php print  $result_array[ProviderTypeDesc]; ?> 
				<?php print $DisplayProviderTypeList; ?>
			</select>
		</td>
		
		<td align=right>Specialty Type:</td>
		<td align=left>
			<select name="specialtytype"> 
				<option class="smallTxtGry" value="<?php print  $result_array[SpecialtyID]; ?>"><?php print  $result_array[SpecialtyDesc]; ?> 
				<?php print $DisplaySpecialtyTypeList; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td align=right height=35>Mobile Phone Number:</td>
		<td align=left colspan=5><input size=15 maxlength=15 type="text" name="mobilenbr" value="<?php print $result_array[MobilePhone]; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=35>Pager ID:</td>
		<td align=left><input size=15 maxlength=15 type="text" name="pagerid" value="<?php print $result_array[PagerID]; ?>"> </td>
		
		<td align=right height=35>Pager Phone Number:</td>
		<td align=left colspan=3><input size=15 maxlength=15 type="text" name="pagerphonenbr" value="<?php print $result_array[PagerTeleNbr]; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=35>eMail Address:</td>
		<td align=left colspan=5><input size=40 maxlength=255 type="text" name="email" value="<?php print $result_array[eMailAddr]; ?>"> </td>
	</tr>
</table>
<input type="hidden" name="Action" value="<?php print $isType; ?>">	
<br><center>
<table>
	<tr>
		<td align=center><input type=submit size=150 NAME="SUBMIT" VALUE="Submit"></td>
		<td>&nbsp;</td>
		<td align=center><input type=reset size=150 NAME="RESET" VALUE="Reset"></td>
	</tr>
</table>	
</center>	
</form>
</div>

<div class="addHostSearch">
<form name="search" method="post" ACTION="if_providerhostadd.php?providerid=<?php print $DisplayProviderID; ?>" target="addHostFrame">
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

<div class="addtitleHostList">
<table width="100%" height=20 class="outerBorderTitleGreenLetterSpace">
	<tr>
		<td align="center"><b>Add</b></td>
	</tr>	
</table>

<IFRAME name="addHostFrame" src="if_providerhostadd.php?providerid=<?php print $DisplayProviderID; ?>"  class="inneraddHostList" scrolling="yes"></IFRAME>
</div>

<div class="remordertitleHostList">
<table width="100%" height=20 class="outerBorderTitleGreenLetterSpace">
	<tr>
		<td align="center"><b>Remove or Re-Order</b></td>
	</tr>	
</table>

<IFRAME name="remorderHostFrame" src="if_providerhostremorder.php?providerid=<?php print $DisplayProviderID; ?>"  class="innerremorderHostList" scrolling="yes"></IFRAME>
</div>
</body>
</html>
