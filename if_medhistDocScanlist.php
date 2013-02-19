<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_medhistDocScanlist.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

//------------------------------------------------------------------------------------------------------
// First look for thumbnail toggle
//------------------------------------------------------------------------------------------------------
if (isset($_GET[thumbnail]))
{
	if ($_GET[thumbnail] == "toggle")
	{
		$ShowThumbNails = ToggleThumbNailValue();
	}
}

//------------------------------------------------------------------------------------------------------
// If we ARE a post then we may need to augment the Search and or Filter (2 filters 
// one on search one for all viewing) We must set cookies for searching and desplaying.  Once we 
// are finished we will drop into our sql.
//------------------------------------------------------------------------------------------------------

// Initialize variables

$_SESSION[DSFtype] = "EMPTY";
$_SESSION[DSFdef] = "EMPTY";
$_SESSION[DSFprov] = "EMPTY";

$Where_Search = "";
	
if ($_POST[selType] == 'searchFilter')
{
	//--------------------------------------------------------------------------------------------------
	// First look for pure filter variables.  We must set
	//--------------------------------------------------------------------------------------------------
	// now adjust for search request
	//--------------------------------------------------------------------------------------------------
	if ($_POST[dsftype] == 1)
	{
		// We are selected for type filter
		if ($_POST[scantype] != "")
		{
			$_SESSION[DSFtype] = $_POST[scantype];
			
			if ($_POST[dsfdef] == 1)
			{
				// We are selected for definition filter
				if ($_POST[scandefinition] != "")
				{
					$_SESSION[DSFdef] = $_POST[scandefinition];
				}
				else
				{
					$_SESSION[DSFdef] = "EMPTY";
				}	
			}
			else
			{
				$_SESSION[DSFdef] = "EMPTY";
			}	
		}	
		else
		{
			$_SESSION[DSFtype] = "EMPTY";
			$_SESSION[DSFdef] = "EMPTY";
		}
	}
	else
	{
		$_SESSION[DSFtype] = "EMPTY";
		$_SESSION[DSFdef] = "EMPTY";
	}		
	
	if ($_POST[dsfprov] == 1)
	{
		// We are selected for type filter
		if ($_POST[dfprovider] != "")
		{
			$_SESSION[DSFprov] = $_POST[dfprovider];
		}
		else
		{
			$_SESSION[DSFprov] = "EMPTY";
		}
	}
	else
	{
		$_SESSION[DSFprov] = "EMPTY";
	}	
			
	$Where_Search = "";
	if ($_POST[Search] != "")
	{
		switch ($_POST[dssfilter])
		{
			case 't':
				// search within type
				$Where_Search = 
				" ( ScanTypeTBL.ScanType LIKE '%$_POST[Search]%' ) ";
				break;

			case 'd':
				// search within definition
					$Where_Search = 
					" ( ScanDefinitionTBL.ScanDefinition LIKE '%$_POST[Search]%' ) ";
				break;
				
			case 'p':
				// search within provider
					$Where_Search = 
				" ( ( FullNameTBL.FirstName LIKE '%$_POST[Search]%' ) 
				OR ( FullNameTBL.LastName LIKE '%$_POST[Search]%') ) ";
				break;
				
			case 'r':
				// search within all includeing description
				$Where_Search = "";
				break;	
				
			default:
				// search within all includeing description
				$Where_Search = "";
				break;
		} // end of switch
		
	} // end of if
	
}  // end of if


//------------------------------------------------------------------------------------------------------
// are we a GET
//------------------------------------------------------------------------------------------------------
if (isset($_GET[order]))
{
	// echo "WE are get\n";
	
	//--------------------------------------------------------------------------------------------------
	// We ARE a get
	//
	// First lets see if our sort cookie is set.  If not lets set it up (WE will be using cookies
	// via the php session service.  Another chance for us to learn.
	//--------------------------------------------------------------------------------------------------
	if (empty($_SESSION[MHType]))
	{
		//	echo "WE are empty session\n";
		//----------------------------------------------------------------------------------------------
		// Ok nothing here to see folks.  But honestly - we need to set our variables for first time
		//----------------------------------------------------------------------------------------------
		$_SESSION[MHType] = "ASC";
		$_SESSION[MHDef] = "ASC";
		$_SESSION[MHProv] = "ASC";
		$_SESSION[MHSDate] = "ASC";
	}
			
	//--------------------------------------------------------------------------------------------------
	// close the where clause
	//--------------------------------------------------------------------------------------------------
	$Order = "";
	
	//--------------------------------------------------------------------------------------------------
	// Now that the session Variables are set it is time to build our sql based on what was passed
	//--------------------------------------------------------------------------------------------------
	switch ($_GET[order])
	{
		case 'stype':
			$Order .= " ORDER BY ScanTypeTBL.ScanType ".$_SESSION[MHType];
			if ($_SESSION[MHType] == "ASC")
				$_SESSION[MHType] = "DESC";
			else
				$_SESSION[MHType] = "ASC";
			break;
		
		case 'def':
			$Order .= " ORDER BY ScanDefinitionTBL.ScanDefinition ".$_SESSION[MHDef];
			if ($_SESSION[MHDef] == "ASC")
				$_SESSION[MHDef] = "DESC";
			else
				$_SESSION[MHDef] = "ASC";
			break;
			
		case 'provider':
			$Order .= " ORDER BY LastName, FirstName ".$_SESSION[MHProv];
			if ($_SESSION[MHProv] == "ASC")
				$_SESSION[MHProv] = "DESC";
			else
				$_SESSION[MHProv] = "ASC";
			break;
			
		case 'sdate':
			$Order .= " ORDER BY StartDate ".$_SESSION[MHSDate];
			if ($_SESSION[MHSDate] == "ASC")
				$_SESSION[MHSDate] = "DESC";
			else
				$_SESSION[MHSDate] = "ASC";
			break;	
		}  // End of Switch
		
		// echo "SQL = ".$sql."\n";
	
}  // End of if GET

//----------------------------------------------------------------------------------------------------------
// create the SQL statement to get our scanned documents
//----------------------------------------------------------------------------------------------------------
			
$sql = "	SELECT DISTINCT ScanID, EventScanInfo, EventScanTBL.ScanTypeID as Scan_TypeID, ClientEventID, ScanType, URL, ScanDefinition,
				ProviderID, StartDate, FirstName, LastName, Suffix, Prefix
				
	from ClientEventTBL		
		inner join EventScanTBL on ClientEventTBL.ID = EventScanTBL.ClientEventID
		inner join ScanTypeTBL on EventScanTBL.ScanTypeID = ScanTypeTBL.ID
		inner join ScanDefinitionTBL on EventScanTBL.ScanDefinitionkeyID = ScanDefinitionTBL.keyID
		
		inner join CalendarTBL on ClientEventTBL.CalendarID = CalendarTBL.ID
		inner join ProviderTBL on ClientEventTBL.ProviderID = ProviderTBL.ID
		inner join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID
 		inner join ScanInfoTBL on EventScanTBL.ScanID = ScanInfoTBL.ID
			where ( (ClientEventTBL.MEDPAL = $Medpal  and ClientEventTBL.CurrentStatus = '1') " ;
			
if ($_SESSION[DSFtype] != "EMPTY")
{
	$sql .= " AND (EventScanTBL.ScanTypeID = '$_SESSION[DSFtype]') ";
}

if ($_SESSION[DSFdef] != "EMPTY")
{
	$sql .= " AND (EventScanTBL.ScanDefinitionkeyID = '$_SESSION[DSFdef]') ";
}

if ($_SESSION[DSFprov] != "EMPTY")
{
	$sql .= " AND (ClientEventTBL.ProviderID = '$_SESSION[DSFprov]') ";
}

if ($Where_Search != "")
{
	$sql .= " AND $Where_Search ";
}	

$sql .= " )";

$sql .= $Order;

//echo $sql;
// Now make the call
			
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for big big join (195) sql = '$sql' - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}
	
//----------------------------------------------------------------------------------------------------------
// Now lets first see if there is anything to run through.  If more or less then 1 we have an error
//----------------------------------------------------------------------------------------------------------
$countRows = mysql_num_rows($sql_result);
if ($countRows > 0)
{
// Used to turn colors on and off 
	$FlipFlag = 1;
	
	// initialize display block
	$DisplayBlock = "";
	$bigCount = 1;
		
	// now lets run the table and get our medical appointments
	while ($result_arr = mysql_fetch_assoc($sql_result))
	{
		switch ($result_arr[Scan_TypeID])
		{
			case 12:
				$DisplayImage = "images/audioicon3.jpg";
				$DisplayBorders = 0;
				break;
				
			case 13:
				$DisplayImage = "images/videoicon.jpg";
				$DisplayBorders = 0;
				break;
				
			default:
				if ($ShowThumbNails == 'Y')
				{
					// Temp fix for person using dialup
					$DisplayImage = $result_arr[URL];
					$DisplayBorders = 1;
					$imgHeightWidth = " width=40 height=40 ";
					$lineHeight = 50;
				}
				else
				{
					$DisplayImage = "images/camera.gif";
					$DisplayBorders = 0;
					$imgHeightWidth = " ";
					$lineHeight = 25;	
				}	
				break;
				
		} //End nof Switch	
		
		//----------------------------------------------------------------------------------------------------------
		// Build Name
		//----------------------------------------------------------------------------------------------------------
		
		$DisplayName = $result_arr[LastName];
		if ($result_arr[Suffix] != "")
		{
			$DisplayName .= " ".$result_arr[Suffix];
		}
		
		$DisplayName .= ", ";
		
		if ($result_arr[Prefix] != "")
		{
			$DisplayName .= $result_arr[Prefix]." ";
		}
		
		$DisplayName .= $result_arr[FirstName]." ".$result_arr[MI];	
		
		//----------------------------------------------------------------------------------------------------------
		// Get date
		//----------------------------------------------------------------------------------------------------------
		$AppDate = CovertMySQLDate($result_arr["StartDate"], 1, 1);
		
		
		
					
		$ExpandedURL = "puscandoc.php?eventid=".$result_arr[ClientEventID]."&scanid=".$result_arr[ScanID]."&ScanDocList=Y";
			
		if ($FlipFlag == 1)
		{
			$DisplayBlock .= "
				<tr>
					<td width=\"20%\" align=center class=\"tblDetailsmTextOff\">".$result_arr[ScanType]."</td>
					<td width=\"20%\" align=center class=\"tblDetailsmTextOff\">".$result_arr[ScanDefinition]."</td>	
					<td width=\"25%\" align=center class=\"tblDetailsmTextOff\">".$DisplayName."</td>	
					<td width=\"20%\" align=center class=\"tblDetailsmTextOff\">".$AppDate."</td>
					<td width=\"15%\" align=right class=\"tblDetailsmTextOff\">
						<a href=\"#\" onClick=\"(PopUpScanWindow('".$ExpandedURL."'))\" class=\"tblDetailsmTextLinkOff\">
							<img align=right ".$imgHeightWidth." id=\"scandetail".$bigCount."\" border=\"$DisplayBorders\" src=\"".$DisplayImage."\">
						</a>
					</td>
				</tr>
			";
			
			$FlipFlag = 0;
		}
		else
		{
			$DisplayBlock .= "
				<tr>
					<td width=\"20%\" align=center class=\"tblDetailsmTextOn\">".$result_arr[ScanType]."</td>
					<td width=\"20%\" align=center class=\"tblDetailsmTextOn\">".$result_arr[ScanDefinition]."</td>	
					<td width=\"25%\" align=center class=\"tblDetailsmTextOn\">".$DisplayName."</td>	
					<td width=\"20%\" align=center class=\"tblDetailsmTextOn\">".$AppDate."</td>
					<td width=\"15%\" align=right class=\"tblDetailsmTextOn\">
						<a href=\"#\" onClick=\"(PopUpScanWindow('".$ExpandedURL."'))\" class=\"tblDetailsmTextLinkOff\">
							<img align=right ".$imgHeightWidth." id=\"scandetail".$bigCount."\" border=\"$DisplayBorders\" src=\"".$DisplayImage."\">
						</a>
					</td>
				</tr>
			";
			
			$FlipFlag = 1;
		}
		
		$bigCount += 1;
	}  // end of while
}
else
{
	$DisplayBlock .= "
		<tr>
			<td width=\"25%\" align=center height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>
			<td width=\"25%\" align=center height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>
			<td width=\"35%\" align=left height=17 class=\"tblDetailsmTextOff\">There are no scaned documents.</td>
			<td width=\"15%\" align=left height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>
		</tr>
		";
}

?>
<html>

<head>
<title>HealthYourSelf History Scan</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />
<style type="text/css"> 

.SmTxt   { 
		font: 400 13px Arial, Geneva;
		}			
	
</style>		
<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>
<script type="text/javascript">
function startUp() 
{	
	<? print $JavaScriptLogMsg; ?> 
		
	<? print $JavaScriptMsg; ?>
}

function PopUpScanWindow (hname) 
{
	var setHeight, setWidth;
	

	setWidth = screen.availWidth - 200;
	setHeight = screen.availHeight - 200;

	popScanNew = window.open(hname,"puScan","toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=yes,width="+setWidth+",height="+setHeight+",left=100,top=100"); 
					
	return false;
}
</script>
</head>

<body onload="startUp()">
<center>
<table width="100%" cellspacing=0 border=0>
		<? print $DisplayBlock; ?>
</table>

</center>
</body>
</html>
