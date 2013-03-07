<?php

//----------------------------------------------------------------------------------------------------------
// create the SQL statement to get the clients name
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT * 
	from ClientTBL 
	inner join FullNameTBL on ClientTBL.FullNameID = FullNameTBL.ID 
	where ClientTBL.MEDPAL = '$Medpal'";
	
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for join to FullName  (96) - '$Medpal'";
	$location = "";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$severity = 1;
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
<b>".$FullName."</b>
</center>
";

print $DisplayCP;
?>
