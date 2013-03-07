<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_RQupscanlist.php.php';

require ('hysInit.php');

require ('hysDBinit.php');

//----------------------------------------------------------------------------------------------------------
// create the SQL statement to get our scanned documents
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT ScanID, EventScanInfo, ScanTypeID, ClientEventID, ScanType, URL
	from ClientEventTBL		
		inner join EventScanTBL on ClientEventTBL.ID = EventScanTBL.ClientEventID
 		inner join ScanInfoTBL on EventScanTBL.ScanID = ScanInfoTBL.ID
		inner join ScanTypeTBL on EventScanTBL.ScanTypeID = ScanTypeTBL.ID
			where (ClientEventTBL.ID = '$_GET[eventid]'";

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
		$_SESSION[MHDesc] = "ASC";
	}
			
	//--------------------------------------------------------------------------------------------------
	// close the where clause
	//--------------------------------------------------------------------------------------------------
	$sql .= ")";
	
	//--------------------------------------------------------------------------------------------------
	// Now that the session Variables are set it is time to build our sql based on what was passed
	//--------------------------------------------------------------------------------------------------
	switch ($_GET[order])
	{
		case 'type':
			$sql .= " ORDER BY ScanTypeTBL.ScanType ".$_SESSION[MHType];
			if ($_SESSION[MHType] == "ASC")
				$_SESSION[MHType] = "DESC";
			else
				$_SESSION[MHType] = "ASC";
			break;
		
		case 'desc':
			$sql .= " ORDER BY EventScanTBL.EventScanInfo ".$_SESSION[MHDesc];
			if ($_SESSION[MHDesc] == "ASC")
				$_SESSION[MHDesc] = "DESC";
			else
				$_SESSION[MHDesc] = "ASC";
			break;
			
		}  // End of Switch
		
		// echo "SQL = ".$sql."\n";
	
}  // End of if GET
else
{
	// echo "WE are default\n";
	//----------------------------------------------------------------------------------------------
	// first time thru so default to desc sort of all info
	//----------------------------------------------------------------------------------------------
	
	$sql .= ")";
}  // End of Else
				
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
		switch ($result_arr[ScanTypeID])
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
				$DisplayImage = $result_arr[URL];
				$DisplayBorders = 1;
				break;
				
		} //End nof Switch	
					
		$ExpandedURL = "puscandoc.php?eventid=".$result_arr[ClientEventID]."&scanid=".$result_arr[ScanID];
			
		if ($FlipFlag == 1)
		{
			$DisplayBlock .= "
				<tr>
					<td width=\"35%\" align=center class=\"tblDetailsmTextOff\">".$result_arr[ScanType]."</td>
					<td width=\"40%\" align=center class=\"tblDetailsmTextOff\">".$result_arr[EventScanInfo]."</td>
					<td width=\"25%\" align=center class=\"tblDetailsmTextOff\">
						<a href=\"#\" onClick=\"(PopUpScanWindow('".$ExpandedURL."'))\" class=\"tblDetailsmTextLinkOff\">
							<img align=center width=20 height=20 id=\"scandetail".$bigCount."\" border=\"$DisplayBorders\" src=\"".$DisplayImage."\">
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
					<td width=\"35%\" align=center class=\"tblDetailsmTextOn\">".$result_arr[ScanType]."</td>
					<td width=\"40%\" align=center class=\"tblDetailsmTextOn\">".$result_arr[EventScanInfo]."</td>
					<td width=\"25%\" align=center class=\"tblDetailsmTextOn\">
						<a href=\"#\" onClick=\"(PopUpScanWindow('".$ExpandedURL."'))\" class=\"tblDetailsmTextLinkOn\">
							<img align=center width=20 height=20 id=\"scandetail".$bigCount."\" border=\"$DisplayBorders\" src=\"".$DisplayImage."\">
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
			<td width=\"35%\" align=center height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>
			<td width=\"40%\" align=center height=17 class=\"tblDetailsmTextOff\">There are no scaned documents.</td>
			<td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>
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
	<?php print $JavaScriptLogMsg; ?>
		
	<?php print $JavaScriptMsg; ?>
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
		<?php print $DisplayBlock; ?>
</table>

</center>
</body>
</html>
