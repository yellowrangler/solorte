<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_medhistoryDocScan.php';

require ('hysInit.php');

require ('hysDBinit.php');

//----------------------------------------------------------------------------------------------------------
// This will build the Scan Def Type drop downs and jscript to manage them
//----------------------------------------------------------------------------------------------------------
$formName = "searchFilter";

require ('ScanTypeDefInclude.php');

//----------------------------------------------------------------------------------------------------------
// get doctors names
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT DISTINCT FirstName, LastName, Suffix, ClientProviderTBL.ProviderID as ProvID 
			from ClientProviderTBL 
				left join ProviderTBL on ClientProviderTBL.ProviderID = ProviderTBL.ID	
				left join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID 
					where ClientProviderTBL.MEDPAL = '$Medpal'";

// Make the call
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ClientProviderTBL left join FullNameTBL  (395) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

// initialize display block
$DisplayProviderList = "";
$DisplayProviderID = "None";

// Now lets first see if there is anything to run through
$countRows = mysql_num_rows($sql_result);
if ($countRows >  0) 
{	
	// now lets run the table and get our provider names
	while ($result_arr = mysql_fetch_assoc($sql_result))
	{
		$DisplayProviderList .= "\t\t\t<option value=\"".$result_arr[ProvID]."\" >".$result_arr[FirstName]." ".$result_arr[LastName]." ".$result_arr[Suffix]."\n ";
	}
}	

?>
<html>
<head>
<title>HealthYourSelf Customer History</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css">

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

		.thumblinkTitletype {
		color: yellow;
		font: 500 11px Arial,Helvetica;
		text-align: center;
		text-decoration: none;
		border-top:1px solid yellow;
		border-left:1px solid yellow;
		border-right:1px solid yellow;
		border-bottom:1px solid yellow;
		}			

.thumblinkTitletype:hover {
		color: black;
		font: 500 11px Arial,Helvetica;
		text-align: center;
		text-decoration: none;
		background: white;
		}		
		
.rightcontentUpper {
		position: absolute;
		left:20px;
		top:40px;
		width:685px;
		height:175px;
		background: #ccccff;
		border:0px solid white;
		}
		
.tableDetailtitlepos {
		position: absolute;
		left:20px;
		top:200px; 
		width:685;
		height:40px;
		background: white;
		border:0px solid black;
		}
				
.innerDocScanlistframeTableTitle   { 
		color: white;
		font: 700 15px Arial, Geneva;
		background: blue;
		}

.innerSelectframe {
		position: absolute;
		left:20px;
		top:245px; 
		width:683px;
		height:455px;
		background: white;
		border:1px solid black;
		}
		
.outerBorderSMtxt {
		font: 400 10px Verdana, Arial, Helvetica;
		border-top:1px solid #052faf;
		border-left:1px solid #052faf;
		border-right:1px solid #052faf;
		border-bottom:1px solid #052faf;
		}
		
.outerBorderSMtxt2 {
		font: 400 10px Verdana, Arial, Helvetica;
		border-top:1px solid #052faf;
		border-left:1px solid #052faf;
		border-right:1px solid #052faf;
		border-bottom:1px solid #052faf;
		background: white;
		}		
		
</style>
		
<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>
<script type="text/javascript">
function startUp() 
{	
	<? print $JavaScriptLogMsg; ?> 
		
	<? print $JavaScriptMsg; ?>
}


<? print $jscriptScanDefSelect; ?>

</script>
</head>
<body <? print $BodySelectColor ?> onload="startUp()">

<form name="searchFilter" method="post" ACTION="if_medhistDocScanlist.php" target="docscanFramelist">
<div class="rightcontentUpper">
<table width="100%" class="outerBorderSMtxt">	
	<tr>
		<td class="outerBorderTitleBlueLetterSpace"><b>Filter</b></td>
		<td class="outerBorderTitleBlueLetterSpace"><b>Search</b></td>
	</tr>

	<tr>
		<td width="50%" class="outerBorderSMtxt2">
			<table width="100%">
				<tr>
					<td class="smallText2"><input type="checkbox" name="dsftype" value=1>Type</td>
					<td align=left>
						<select name="scantype" onchange="buildScanDef();"> 
							<option class="smallTxtGry" value="">
							<? print $DisplayScanTypeList; ?>
						</select>
					</td>
				</tr>	
				<tr>
					<td class="smallText2"><input type="checkbox" name="dsfdef" value=1>Definition</td>
					<td align=left>
						<select name="scandefinition"> 
							<option class="smallTxtGry" value=""> 
						</select>
					</td>
				</tr>	
				<tr>
					<td class="smallText2"><input type="checkbox" name="dsfprov" value=1>Provider</td>
					<td align=left>
						<select name="dfprovider"> 
							<option class="smallTxtGry" value="<? print $DisplayProviderID; ?>"><? print $DisplayProvider; ?> 
							<? print $DisplayProviderList; ?>
						</select>
					</td>
				</tr>	
			</table>
		</td>
		<td width="50%" class="outerBorderSMtxt2">
			<table  align=center>
				<tr>
					<td align=right class="smallText2">Search:</td>
					<td><input type="text" name="Search" size="25" maxlength="255"></td>
				</tr>
			</table>
			<table align=center class="outerBorderSMtxt">
				<tr>
					<td align=left>&nbsp;<input  class="smallText2" type="radio" name="dssfilter" value="t"> Type &nbsp;</td>
					<td align=left>&nbsp;<input  class="smallText2" type="radio" name="dssfilter" value="d"> Definition &nbsp;</td>
					<td align=left>&nbsp;<input  class="smallText2" type="radio" name="dssfilter" value="p"> Provider &nbsp;</td>
					<td align=left>&nbsp;<input  class="smallText2" type="radio" name="dssfilter" value="r"> Reset &nbsp;</td>	
				</tr>
			</table>
		</td>
	</tr>
</table>	
<table align=center width="100%">
	<tr>
	
		<td align=center  height=15><input type="submit" name="Action" value="Enter to Filter and Search"></td> 
		
	</tr>
</table>

<input type='hidden' name='selType'  value='searchFilter'>
</div>
</form>

<div class="tableDetailtitlepos">
<table width="100%" class="innerDocScanlistframeTableTitle" cellspacing=0>
	<tr>
		<td width="40%" align=center height=20 colspan=2>&nbsp;</td>
		<td width="25%" align=center height=20>Scanned Documents</td>
		<td width="35%" align=right height=20 colspan=2>
			<a href="if_medhistDocScanlist.php?thumbnail=toggle"  class="thumblinkTitletype" target="docscanFramelist">Toggle Thumb nails
			</a>
		</td>
	</tr>	
	<tr>
		<td width="20%" align="center" height="20"><a href="if_medhistDocScanlist.php?order=stype"  class="linkTitletype" target="docscanFramelist">Type</a></td>
		<td width="20%" align="center"><a href="if_medhistDocScanlist.php?order=def"  class="linkTitletype" target="docscanFramelist">Def</a></td>
		<td width="25%" align="center"><a href="if_medhistDocScanlist.php?order=provider"  class="linkTitletype" target="docscanFramelist">Provider</a></td>
		<td width="20%" align="center"><a href="if_medhistDocScanlist.php?order=sdate"  class="linkTitletype" target="docscanFramelist">Date</a></td>
		<td width="15%" align="center">Image</td>
	</tr>	
</table>
</div>
 
<IFRAME name="docscanFramelist" src="if_medhistDocScanlist.php" class="innerSelectframe" scrolling=auto frameborder=0> </IFRAME>

</body>
</html>
