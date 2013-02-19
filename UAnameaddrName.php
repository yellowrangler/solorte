<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'UAnameaddrName.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

//--------------------------------------------------------------------------------------------------
// initialize pass back values
//--------------------------------------------------------------------------------------------------
$DisplayErr = "N";

//--------------------------------------------------------------------------------------------------
// validate date and time
//--------------------------------------------------------------------------------------------------
if (!ValiDate($_POST[month], $_POST[day], $_POST[year]) )
{
	// error
	$errmsg = "Invalid+Date.+Please+try+again.";
	$location = "Location: if_UAnameaddrName.php";
	$shortmsg = "Invalid Date.";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

//--------------------------------------------------------------------------------------------------
// Update the FullNameTBL for client
//--------------------------------------------------------------------------------------------------
$sql = "UPDATE FullNameTBL 
			set Prefix =  '$_POST[prefix]', FirstName = '$_POST[firstname]', MI = '$_POST[mi]', 
			LastName = '$_POST[lastname]', Suffix = '$_POST[suffix]', eMailAddr = '$_POST[email]', 
			MobilePhone = '$_POST[mphone]',  PagerID = '$_POST[pagerid]', PagerTeleNbr = '$_POST[pagertelenbr]'
			where (FullNameTBL.ID = '$_POST[fullnameid]')";
							
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query update FullNameTBL (77) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "Location: if_UAnameaddrName.php";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//--------------------------------------------------------------------------------------------------
// prepare the date for sql
//--------------------------------------------------------------------------------------------------
$tmpdate = sprintf("%s-%02s-%02s", $_POST[year], $_POST[month], $_POST[day]);

//--------------------------------------------------------------------------------------------------
// Update the ClientTBL for client for DOB
//--------------------------------------------------------------------------------------------------
$sql = "UPDATE ClientTBL 
			set DOB = '$tmpdate'
			where (ClientTBL.MEDPAL = '$Medpal')";

if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query update ClientTBL (77) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "Location: if_UAnameaddrName.php";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------
// Write to Access Log Table
//----------------------------------------------------------------------------------------------------------
AccessLogAdd("Client Name Information update.", "Ok", $module, "", $conn);

//--------------------------------------------------------------------------------------------------
// update display variables
//--------------------------------------------------------------------------------------------------
$DisplayMsg = "Client Name Information update successfull!";


//--------------------------------------------------------------------------------------------------
// end of Update 
//--------------------------------------------------------------------------------------------------
		
//--------------------------------------------------------------------------------------------------		
// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_UAnameaddrName.php?msgTxt=$DisplayMsg&err=$DisplayErr");

?>
