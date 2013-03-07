<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_UAnameaddrAddrlist.php';

require ('hysInit.php');

require ('hysDBinit.php');

//----------------------------------------------------------------------------------------------------------
// create the SQL statement to get our addresses for our client
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT 	* from ClientAddrTBL 
			inner join AddrTBL on ClientAddrTBL.AddrID = AddrTBL.ID 
			where (MEDPAL = '$Medpal') 
			ORDER BY OrderID";
			
			
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ClientAddrTBL AddrTBL (195) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}
	
//----------------------------------------------------------------------------------------------------------
// Now lets first see if there is anything to run through
//----------------------------------------------------------------------------------------------------------
$countRows = mysql_num_rows($sql_result);
if ($countRows >  0) 
{	
	// Used to turn colors on and off 
	$FlipFlag = 1;
	
	// initialize display block
	$DisplayBlock = "";
	
	// now lets run the table and get our medical appointments
	while ($result_array = mysql_fetch_assoc($sql_result))
	{	
		if ($FlipFlag == 1)
		{
			$DisplayBlock .= "\t<tr>\n\t\t<td width=\"10%\" align=center height=17 class=\"tblDetailsmTextOff\">";
			$DisplayBlock .= "<a href=\"if_UAnameaddrAddrdetail.php?msgTxt=Welcome to Update Address!&addrid=".$result_array[AddrID]."\" target=\"addrdetailFrame\"><img id=\"moredetail\" border=\"0\" height=20 width=20 src=\"images/binoculars.gif\"></a></td>\n";
			$DisplayBlock .= "\t\t<td width=\"10%\" align=center height=17 class=\"tblDetailsmTextOff\">".$result_array[OrderID]."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"35%\" align=left height=17 class=\"tblDetailsmTextOff\">".$result_array[AddrLine1]."</td>\n";
			$DisplayBlock .= "\t\t <td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOff\">".$result_array[City]."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"10%\" align=left height=17 class=\"tblDetailsmTextOff\">".$result_array[State]."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"10%\" align=left height=17 class=\"tblDetailsmTextOff\">".$result_array[ZIP]."</td>\n\t</tr>\n";
			
			
			$FlipFlag = 0;
		}
		else
		{
			$DisplayBlock .= "\t<tr>\n\t\t<td width=\"10%\" align=center height=17 class=\"tblDetailsmTextOn\">";
			$DisplayBlock .= "<a href=\"if_UAnameaddrAddrdetail.php?msgTxt=Welcome to Update Address!&addrid=".$result_array[AddrID]."\" target=\"addrdetailFrame\"><img id=\"moredetail\" border=\"0\" height=20 width=20 src=\"images/binocularsOn.gif\"></a></td>\n";
			$DisplayBlock .= "\t\t<td width=\"10%\" align=center height=17 class=\"tblDetailsmTextOn\">".$result_array[OrderID]."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"35%\" align=left height=17 class=\"tblDetailsmTextOn\">".$result_array[AddrLine1]."</td>\n";
			$DisplayBlock .= "\t\t <td width=\"25%\" align=left height=17 class=\"tblDetailsmTextOn\">".$result_array[City]."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"10%\" align=left height=17 class=\"tblDetailsmTextOn\">".$result_array[State]."</td>\n";
			$DisplayBlock .= "\t\t<td width=\"10%\" align=left height=17 class=\"tblDetailsmTextOn\">".$result_array[ZIP]."</td>\n\t</tr>\n";
			
			$FlipFlag = 1;
		}
	}  // end of while
}
else
{
	$errmsg = "You have no Address. - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

?>
<html>

<head>
<title>HealthYourSelf Customer Address Update</title>
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
