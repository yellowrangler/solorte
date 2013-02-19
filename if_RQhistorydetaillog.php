<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_RQhistorydetaillog.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

//----------------------------------------------------------------------------------------------------------
// If we have information display it otherwise error
//----------------------------------------------------------------------------------------------------------
if (! (isset($_GET[requestid]) and ($_GET[requestid] != "")) )
{
	$errmsg = "GET variable not set.  Get = '$_GET[requestid]' (294) - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

//----------------------------------------------------------------------------------------------------------
// We now build the sql to get all requests history for selected request.
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT  * from  ClientRequestHistoryTBL 
			left join RequestStatusTBL on  ClientRequestHistoryTBL.RequestStatus = RequestStatusTBL.ID
				where ( ClientRequestHistoryTBL.RequestID = '$_GET[requestid]')
					ORDER BY ClientRequestHistoryTBL.RequestHistDateTime";
					
//------------------------------------------------------------------------------------------------------
// now lets run the sql that was built
//------------------------------------------------------------------------------------------------------
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ClientRequestHistoryTBL (195) sql = '$sql' - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//------------------------------------------------------------------------------------------------------
// Now lets first see if there is anything to run through
//------------------------------------------------------------------------------------------------------
$countRows = mysql_num_rows($sql_result);
if ($countRows >  0) 
{	
	// Used to turn colors on and off 
	$FlipFlag = 1;
	
	// initialize display block
	$DisplayBlock = "";
	
	// now lets run the table and get our medical appointments
	while ($result_arr = mysql_fetch_assoc($sql_result))
	{
		//----------------------------------------------------------------------------------------------------------
		// get request dates and time into readable format
		//----------------------------------------------------------------------------------------------------------
		$DispalyRequestDate = CovertMySQLDate($result_arr["RequestHistDateTime"], 2, 1);
		
		// Get access time
		$DisplayRequestTime = CovertMySQLTime($result_arr["RequestHistDateTime"], 2, 4);
			
		if ($FlipFlag == 1)
		{
			$DisplayBlock .= "\t<tr>\n\t\t<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOff\">".$result_arr[RequestID]."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOff\">".$DispalyRequestDate."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"20%\" align=center height=17 class=\"tblDetailsmTextOff\">".$DisplayRequestTime."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"50%\" align=left height=17 class=\"tblDetailsmTextOff\">".$result_arr[Description]."</td>\n\t</tr>\n";
			
			$FlipFlag = 0;
		}
		else
		{
			$DisplayBlock .= "\t<tr>\n\t\t<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOn\">".$result_arr[RequestID]."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOn\">".$DispalyRequestDate."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"20%\" align=left height=17 class=\"tblDetailsmTextOn\">".$DisplayRequestTime."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"50%\" align=left height=17 class=\"tblDetailsmTextOn\">".$result_arr[Description]."</td>\n\t</tr>\n";
			
			$FlipFlag = 1;
		}
	}  // end of while
}
else
{
	$DisplayBlock .= "\t<tr>\n\t\t<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>\n";
	$DisplayBlock .= "\t\t<td width=\"15%\" align=center height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>\n";
	$DisplayBlock .= "\t\t<td width=\"20%\" align=left height=17 class=\"tblDetailsmTextOff\">&nbsp;</td>\n";
	$DisplayBlock .= "\t\t<td width=\"50%\" align=left height=17 class=\"tblDetailsmTextOff\">No History</td>\n\t</tr>\n";
			
}

?>
<html>
<head>
<title>HealthYourSelf request history list</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css">

.tblDetailsmTextOn  { 
		color: black; 
		font-size: 11px; 
		line-height: 20px; 
		font-family: Arial, Geneva; 
		border-left:1px solid #CCFFFF;
		border-right:1px solid #CCFFFF;
		text-decoration:none;
		background:#CCFFFF;
		}
				
.tblDetailsmTextOff  { 
		color: black; 
		font-size: 11px; 
		line-height: 20px; 
		font-family: Arial, Geneva; 
		border-left:1px solid white;
		border-right:1px solid white;
		text-decoration: none;
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
</script>
</head>

<body onload="startUp()">

<center>
<table width="100%" cellspacing=0 cellpadding=0 border=0>
		<? print $DisplayBlock; ?>
</table>

</center>

</div>
</body>
</html>
