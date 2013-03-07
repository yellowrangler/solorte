<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'puscandoc.php';

require ('hysInit.php');

require ('hysDBinit.php');

//----------------------------------------------------------------------------------------------------------
// Make sure we have all our stuff
//----------------------------------------------------------------------------------------------------------

// If we come from scan doc list we will hide prev next
$ButtonHidden = "";

if (isset($_GET[ScanDocList]) and ($_GET[ScanDocList] != "") )
{
	if ($_GET[ScanDocList] == 'Y')
	{
		$ButtonHidden = "type=\"hidden\"";
	}	
}	

if (isset($_GET[eventid]) and ($_GET[eventid] != ""))
{
	if (isset($_GET[scanid]) and ($_GET[scanid] != ""))
	{
		//---------------------------------------
		// We are Gold
		//---------------------------------------
		$DisplayEventID = $_GET[eventid]; 
		$DisplayScanID = $_GET[scanid];
	}
	else
	{
		$errmsg = "Did not get scanid. - '$Medpal' eventid = '$_GET[eventid]' scanid = '$_GET[scanid]'";
		$shortmsg = "System sequence error.  If this persists, Please call Customer Support.";
		$location = "";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
}
else
{
	$errmsg = "Did not get eventid. - '$Medpal' eventid = '$_GET[eventid]' scanid = '$_GET[scanid]'";
	$shortmsg = "System sequence error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

$ControlImageWidth = 600;

if (isset($_GET[zoom]) and ($_GET[zoom] != ""))
{
	$ControlImageWidth = $_GET[zoom];
}	

$ZoomConstant = 100;

// Initialize basic SQL call

$sqlBasic = "SELECT ScanID, EventScanInfo, ScanType, EventScanTBL.ScanTypeID as ES_ScanTypeID, URL, ClientEventID, ScanDefinition
				from EventScanTBL		
					inner join ScanInfoTBL on EventScanTBL.ScanID = ScanInfoTBL.ID
					inner join ScanTypeTBL on EventScanTBL.ScanTypeID = ScanTypeTBL.ID
					inner join ScanDefinitionTBL on EventScanTBL.ScanDefinitionkeyID = ScanDefinitionTBL.keyID ";

//---------------------------------------------------------------------------------------------------------
// What is the action
//---------------------------------------------------------------------------------------------------------
if (isset($_GET[Action]) and ($_GET[Action] != ""))
{
	switch ($_GET[Action])
	{
		case 'Next':
			$sql = $sqlBasic." where (EventScanTBL.ClientEventID = '$DisplayEventID' && ScanInfoTBL.ID > '$DisplayScanID')";
						
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query join for EventScanTBL, ScanInfoTBL, ScanTypeTBL (195) - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
				
			// Now lets first see if there is anything to run through.  If more then 1 we have an error
			$countRows = mysql_num_rows($sql_result);
			if ($countRows == 0)
			{
				$sql = $sqlBasic." where (EventScanTBL.ClientEventID = '$DisplayEventID' && ScanInfoTBL.ID > '0')";
							
				if (!$sql_result = mysql_query($sql, $conn))
				{
					$sqlerr = mysql_error();
					$errmsg = "$sqlerr - Error doing mysql_query join for EventScanTBL, ScanInfoTBL, ScanTypeTBL (195) - '$Medpal'";
					$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
					$location = "";
					$severity = 1;
					LogErr($shortmsg, $errmsg, $location, $module, $severity);
				}
					
				// Now lets first see if there is anything to run through.  If more then 1 we have an error
				$countRows = mysql_num_rows($sql_result);
				if ($countRows == 0)
				{
					$errmsg = " Error 0 rows returned in select on join for EventScanTBL, ScanInfoTBL, ScanTypeTBL. count = '$countRows'  - '$Medpal'";
					$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
					$location = "";
					$severity = 1;
					LogErr($shortmsg, $errmsg, $location, $module, $severity);
				}
			}	
			
			$result_array = mysql_fetch_assoc($sql_result);
			break;
			
		case 'Prev':
			$sql = $sqlBasic." where (EventScanTBL.ClientEventID = '$DisplayEventID' && ScanInfoTBL.ID < '$DisplayScanID')";
						
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query join for EventScanTBL, ScanInfoTBL, ScanTypeTBL (195) - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
				
			// Now lets first see if there is anything to run through.  If more then 1 we have an error
			$countRows = mysql_num_rows($sql_result);
			if ($countRows == 0)
			{
				$sql = $sqlBasic." where (EventScanTBL.ClientEventID = '$DisplayEventID')";
							
				if (!$sql_result = mysql_query($sql, $conn))
				{
					$sqlerr = mysql_error();
					$errmsg = "$sqlerr - Error doing mysql_query join for EventScanTBL, ScanInfoTBL, ScanTypeTBL (195) - '$Medpal'";
					$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
					$location = "";
					$severity = 1;
					LogErr($shortmsg, $errmsg, $location, $module, $severity);
				}
					
				// Now lets first see if there is anything to run through.  If more then 1 we have an error
				$countRows = mysql_num_rows($sql_result);
				if ($countRows == 0)
				{
					$errmsg = " Error 0 rows returned in select on join for EventScanTBL, ScanInfoTBL, ScanTypeTBL. (99) count = '$countRows'  - '$Medpal'";
					$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
					$location = "";
					$severity = 1;
					LogErr($shortmsg, $errmsg, $location, $module, $severity);
				}
			}
			
			for ($i = $countRows; $i > 1;  $i--)
			{
				$result_array = mysql_fetch_assoc($sql_result);
			}
			
			$result_array = mysql_fetch_assoc($sql_result);
			break;
			
		case "Larger":
			switch ($DisplayScanTypeID)
			{
			
				case 12:
				case 13:
					break;
					
				default:
					$ControlImageWidth = $ControlImageWidth + $ZoomConstant;		
					break;
			} //end of switch
			
			$sql = $sqlBasic." where (EventScanTBL.ClientEventID = '$DisplayEventID' && ScanInfoTBL.ID = '$DisplayScanID')";
						
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query join for EventScanTBL, ScanInfoTBL, ScanTypeTBL (195) - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
				
			// Now lets first see if there is anything to run through.  If more then 1 we have an error
			$countRows = mysql_num_rows($sql_result);
			if ($countRows != 1)
			{
				$errmsg = " Error more or less then 1 rows returned in select on join for EventScanTBL, ScanInfoTBL, ScanTypeTBL.(100) count = '$countRows'  - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}	
			
			$result_array = mysql_fetch_assoc($sql_result);
			break;
			
		case "Smaller":
			switch ($DisplayScanTypeID)
			{
			
				case 12:
				case 13:
					break;
					
				default:
					$ControlImageWidth = $ControlImageWidth - $ZoomConstant;		
					break;
			} //end of switch	
			
			$sql = $sqlBasic." where (EventScanTBL.ClientEventID = '$DisplayEventID' && ScanInfoTBL.ID = '$DisplayScanID')";
						
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query join for EventScanTBL, ScanInfoTBL, ScanTypeTBL (195) - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
				
			// Now lets first see if there is anything to run through.  If more then 1 we have an error
			$countRows = mysql_num_rows($sql_result);
			if ($countRows != 1)
			{
				$errmsg = " Error more or less then 1 rows returned in select on join for EventScanTBL, ScanInfoTBL, ScanTypeTBL.(100) count = '$countRows'  - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}	
			
			$result_array = mysql_fetch_assoc($sql_result);
			break;
			
		default:
			$sql = $sqlBasic." where (EventScanTBL.ClientEventID = '$DisplayEventID' && ScanInfoTBL.ID = '$DisplayScanID')";
						
			if (!$sql_result = mysql_query($sql, $conn))
			{
				$sqlerr = mysql_error();
				$errmsg = "$sqlerr - Error doing mysql_query join for EventScanTBL, ScanInfoTBL, ScanTypeTBL (195) - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}
				
			// Now lets first see if there is anything to run through.  If more then 1 we have an error
			$countRows = mysql_num_rows($sql_result);
			if ($countRows != 1)
			{
				$errmsg = " Error more or less then 1 rows returned in select on join for EventScanTBL, ScanInfoTBL, ScanTypeTBL.(100) count = '$countRows'  - '$Medpal'";
				$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
				$location = "";
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}	
			
			$result_array = mysql_fetch_assoc($sql_result);
			break;
	} // end of Switch	
}
else
{
	$sql = $sqlBasic." where (EventScanTBL.ClientEventID = '$DisplayEventID' && ScanInfoTBL.ID = '$DisplayScanID')";
				
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query join for EventScanTBL, ScanInfoTBL, ScanTypeTBL (195) - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
		
	// Now lets first see if there is anything to run through.  If more then 1 we have an error
	$countRows = mysql_num_rows($sql_result);
	if ($countRows != 1)
	{
		$errmsg = " Error more or less then 1 rows returned in select on join for EventScanTBL, ScanInfoTBL, ScanTypeTBL. (101) count = '$countRows'  - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}	
	
	$result_array = mysql_fetch_assoc($sql_result);
}			

 	

// now lets fetch and build our display
$DisplayEventID = $result_array[ClientEventID]; 
$DisplayScanID = $result_array[ScanID];
$DisplayScanType = $result_array[ScanType];
$DisplayScanDefinition = $result_array[ScanDefinition];
$DisplayURL = $result_array[URL];
$DisplayDescription = $result_array[EventScanInfo];
$DisplayScanTypeID = $result_array[ES_ScanTypeID];
$DisplayItemArea = "";

$ControlVideoWidth = 200;
$ControlVideoHeight = 180;

$ControlAudioWidth = 170;
$ControlAudioHeight = 45;

switch ($DisplayScanTypeID)
{

	case 12:
		$DisplayItemArea = "
			<embed src=".$DisplayURL." autostart=\"false\" loop=\"false\" height=".$ControlAudioHeight." width=".$ControlAudioWidth."></embed>
		";	
		break;
		
	case 13:
		$DisplayItemArea = "
			<embed src=".$DisplayURL." autostart=\"false\" loop=\"false\" height=".$ControlVideoHeight." width=".$ControlVideoWidth."></embed>
		";	
		break;
		
	default:
		$DisplayItemArea = "
			<img border=1 src=".$DisplayURL." width=".$ControlImageWidth.">
		";		
		break;
} //end of switch		

?>

<html>
<head>
<title>Pop-Up Information</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css">

.ArticleHeader {
		font: 700 15px Arial,Helvetica; 
		font-style: italic;
		text-align: left;
		color:#666666;
		}
		
.topBanner {
		position: absolute;
		left:1px;
		top:1px;
		height:50px;
		border-top:1px solid white;
		border-right:1px solid white;
		border-left:1px solid white;
		background:#fff;
		}
		
.topLine   { 
		color: #008080;
		}

.topLinearea {
		position: absolute;
		left:1px;
		top:50px;
		color: black; 
		line-height: 20px; 
		font: 400 15px Arial, Geneva; 
		text-decoration: none;
		text-align: left;
		}		

.scanArea {
		position: absolute;
	/*	float:center; */
		top:140px;
		height:600px;
	/*	width:1100px; */ 
		border-top:1px solid white;
		border-right:1px solid white;
		border-left:1px solid white;
		border-bottom:1px solid white;
		background:#fff;
		}
		
</style>

<script language="JavaScript" type="text/javascript" src="hyspufunc.js"> </script>
<script type="text/javascript" language="JavaScript">
function startUp() 
{	
	<?php print $JavaScriptLogMsg; ?>
		
	<?php print $JavaScriptMsg; ?>
}

</script>
</head>

<body>

<div id="topBanner" class="topBanner">
<table width="100%" border=0 cellspacing=0 cellpadding=0>
	<tr>
     	<td align="left" width="75%"><img border="0" src="images/healthyourselflogo.JPG"></td> 
	 </tr>
</table>
<hr align="left" size="1" width="100%" class="topLine">
</div>

<div id="topLinearea" class="topLinearea">
<table width="100%">
	<tr>
		<td align=left valign=top width="25%" class="smallText"><i><a href="#" onClick="window.close()">Close Window</a></i></td>
		<td align=center width="50%">
			<table>
				<tr>
					<td align=right class="smallText2">Description:</td>
					<td align=left class="smallText2Bold"><?php print $DisplayDescription; ?></td>
					
					<td width=20>&nbsp;</td>
					
					<td align=right class="smallText2">Scan Type:</td>
					<td align=left class="smallText2Bold"><?php print $DisplayScanType; ?></td>
					
					<td width=20>&nbsp;</td>
					
					<td align=right class="smallText2">Scan Definition:</td>
					<td align=left class="smallText2Bold"><?php print $DisplayScanDefinition; ?></td>
				</tr>
			</table>
		</td>	
		<td align=right valign=top width="25%" class="smallText"><i><a href="#" onClick="printDoc()">Print Window</a></i></td>
	</tr>
</table>

<form action="puscandoc.php" method=get>
<center>
<table class="smallText" border=0 cellspacing=0 cellpadding=0 width="100%" align=center>
	<tr>
		<td align=left width="25%">
			<table>
				<tr>
					<td width=5>&nbsp;</td>
					<td align=right height=15><b>Zoom</b></td>
					<td width=5>&nbsp;</td>
					<td align=left  height=15><input type="submit" name="Action" value="Larger"></td>
					<td width=10>&nbsp;</td>
					<td align=left  height=15><input type="submit" name="Action" value="Smaller"></td>
				</tr>
			</table>
		</td>	
		<td align=center width="50%">
			<table>
				<tr>
					<td width=15>&nbsp;</td>
					<td align=right  height=15><input  <?php print $ButtonHidden; ?> type="submit" name="Action" value="Prev"></td>
					<td width=15>&nbsp;</td>
					<td align=left  height=15><input  <?php print $ButtonHidden; ?> type="submit"  name="Action" value="Next"></td>
				</tr>
			</table>
		</td>	
		<td align=right valign=top width="25%" class="smallText">&nbsp;</td>
	</tr>
</table>
<input type="hidden" name="eventid" value="<?php print $DisplayEventID; ?>">	
<input type="hidden" name="scanid" value="<?php print $DisplayScanID; ?>">		
<input type="hidden" name="zoom" value="<?php print $ControlImageWidth; ?>">	
</form>
</center>	
</div>

<div class="scanArea">
<center>
<table width="100%">
	<tr>
		<td  height="100%" align=center valign=center>
<?php print $DisplayItemArea; ?>
		</td>
	</tr>
</table>	
</center>
</div>

</body>
</html>		
