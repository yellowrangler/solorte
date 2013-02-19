<?php

//----------------------------------------------------------------------------------------------------------
// create the SQL statement to get the photo url
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT * from ClientTBL inner join PhotoTBL on ClientTBL.PhotoID = PhotoTBL.ID where MEDPAL = '$Medpal'";
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for PhotoTBL join client (95) - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

//----------------------------------------------------------------------------------------------------------
// make sure only 1 row was returned.  More then 1 means toomany pictures - less then 1 means no picture so 
// ignore
//----------------------------------------------------------------------------------------------------------
$num_rows = mysql_num_rows($sql_result);
$photo_url = "";
if ($num_rows == 1)
{
	// get the photo url from our db and set variable
	$result_arr = mysql_fetch_assoc($sql_result);
	$photo_url = $result_arr[URL];
}

//----------------------------------------------------------------------------------------------------------
// create the SQL statement to get the clients name
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT * from ClientTBL inner join FullNameTBL on ClientTBL.FullNameID = FullNameTBL.ID where ClientTBL.MEDPAL = '$Medpal'";
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for join to FullName PhotoTBL (96) - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

//----------------------------------------------------------------------------------------------------------
// make suer only 1 row was returned.  More then 1 means too many names - less then 1 means no name so 
// ignore. first initialize
//----------------------------------------------------------------------------------------------------------
$FullName = "No Name";

$num_rows = mysql_num_rows($sql_result);
if ($num_rows == 1)
{
	// get the Full name and set variable
	$result_arr = mysql_fetch_assoc($sql_result);
	
	$tmpFirstName = trim($result_arr[FirstName]);
	$tmpLastName = trim($result_arr[LastName]);
	$tmpSuffix = trim($result_arr[Suffix]);
	$tmpString = sprintf("%s %s %s", $tmpFirstName, $tmpLastName, $tmpSuffix);
	$FullName = $tmpString;
}

$DisplayCP = " 
<center>
<table width=230 class=\"outerBorderblackSelect\" cellspacing=0 cellpadding=0>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td align=center><font size=\"3\" face=\"Arial Rounded MT Bold\"><b>Welcome</b></font></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td align=center>
			<table width=150 cellspacing=0 cellpadding=0>
				<tr>
					<td  colspan=2 align=center>
";	
				
if ($photo_url != "")
{
	$DisplayCP .= "<img border=1 src=".$photo_url." width=175>";
}
else
{
	$DisplayCP .= "No Photo";
}		
						
$DisplayCP .= "
					</td>
				</tr>
			</table>
		</td>
	</tr>	
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td align=center><b>".$FullName."</b></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>	
</table>
</center>
";

print $DisplayCP;
?>
