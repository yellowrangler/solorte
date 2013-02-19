<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_RQupscan.php';

require ('hysInit.php');

require ('hysDBinit.php');

//----------------------------------------------------------------------------------------------------------
// Initialize some display variables
//----------------------------------------------------------------------------------------------------------
$DisplayScannedImages = "<tr><td>There are no scanned documents.</td></tr>";
 
//----------------------------------------------------------------------------------------------------------
// We test to see if get was passed to us.  If not get then it is an error
//----------------------------------------------------------------------------------------------------------
if (isset($_GET[eventid]) and ($_GET[eventid] != ""))
{
	//----------------------------------------------------------------------------------------------------------
	// create the SQL statement to get our scanned documents
	//----------------------------------------------------------------------------------------------------------
	$sql = "SELECT * from ScanInfoTBL 
					inner join EventScanTBL on EventScanTBL.ScanID = ScanInfoTBL.ID
					inner join ClientEventTBL on ClientEventTBL.ID = EventScanTBL.ClientEventID
					where (ClientEventTBL.ID = '$_GET[eventid]')";
					
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query for ScanInfoTBL,  EventScanTBL and ClientEventTBL \n sql = '$sql'\n (195) - '$Medpal'";
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
		//----------------------------------------------------------------------------------------------------------
		// We have images so now lets fetch our scanned information - we run 4 accross then down and accross again
		//----------------------------------------------------------------------------------------------------------
		$DisplayScannedImages = "<tr>"; 
		
		$Count = 0; 
		$bigCount = 0;
		while ($result_array = mysql_fetch_assoc($sql_result))
		{
			if ($Count > 3)
			{
				$DisplayScannedImages .= "</tr><tr>"; 
				
				$Count = 0;
			}
			//------------------------------------------------------------------------------------------------------
			// In order to have our image titles appear bellow our images we need this elaborate table arrangement
			//------------------------------------------------------------------------------------------------------
			$DisplayScannedImages .="
				<td align=left>
					<table align=left>
						 <tr align=left>
							 <td width=\"25%\" align=center>
							 	<a href=\"#\" onClick=\"(PopUpWindow('".$result_array[URL]."', 'r', 2))\" class=\"tblDetailsmTextLinkOff\">
									 <img align=center width=25 height=30 id=\"scandetail".$bigCount."\" border=\"1\" src=\"".$result_array[URL]."\">
								 </a>
							 </td>
						 </tr>
			
						 <tr>
							 <td width=\"25%\" align=center class=\"Footnote\">".$result_array[EventScanInfo]."</td>
						 </tr>
					 </table>
				 </td>
			";
			
			$bigCount += 1;
			$Count += 1;
		}
		
		$DisplayScannedImages .= "</tr>";
	}
	else
	{
		//----------------------------------------------------------------------------------------------------------
		// We have no images to present
		//----------------------------------------------------------------------------------------------------------
		$DisplayScannedImages = "<tr><td>There is no scanned documentation on file for this Medical event</td></tr>"; 
	}
}	// End of IF Update
else
{
	//----------------------------------------------------------------------------------------------------------
	// We have no images to present
	//----------------------------------------------------------------------------------------------------------
	$DisplayScannedImages = "<tr><td>There is no scanned documentation on file for this Medical event</td></tr>"; 
}
?>
<html>

<head>
<title>HealthYourSelf History Scan</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />
<style type="text/css"> 

.SmTxt   { 
		font: 400 11px Arial, Geneva;
		}			
	
</style>		
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

<table width="100%" class="SmTxt">
	<? print $DisplayScannedImages; ?>
</table>

</body>
</html>
