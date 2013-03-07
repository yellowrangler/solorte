<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'UAmedprofSocial.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

//--------------------------------------------------------------------------------------------------
// initialize pass back values
//--------------------------------------------------------------------------------------------------
$DisplayErr = "N";

//----------------------------------------------------------------------------------------------------------
// create the SQL statement to get our ClientSocialProfileTBL information.  
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT * from ClientSocialProfileTBL 
			where (ClientSocialProfileTBL.MEDPAL = '$Medpal')";
		
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query join for ClientSocialProfileTBL (321) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------
// Now lets see if twe are an add or update.
//----------------------------------------------------------------------------------------------------------
$countRows = mysql_num_rows($sql_result);
if ($countRows > 0)
{
	
	//--------------------------------------------------------------------------------------------------
	// Update the ClientSocialProfileTBL 
	//--------------------------------------------------------------------------------------------------
	$sql = "UPDATE ClientSocialProfileTBL 
				set CurSmoker = '$_POST[profcursmoke]', FormerSmoker = '$_POST[profformersmoke]',  
					SmokerType = '$_POST[profsmokertype]', SmokerperMonth = '$_POST[profsmokermonth]', 
					SmokerYears = '$_POST[profsmokeryears]', Alcohol = '$_POST[profalcohol]', 
					AlcoholperMonth = '$_POST[profalcoholperrmonth]', Exersize = '$_POST[profexersize]',	
					ExersizeperMonth = '$_POST[profexersizepermonth]', ExersizeDescription = '$_POST[profexersizedescription]',
					Diet = '$_POST[profdiet]', DietDescription = '$_POST[profdietdescription]'
				where (ClientSocialProfileTBL.MEDPAL = '$Medpal')";

	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query update ClientSocialProfileTBL (77) - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
}
else
{
	//--------------------------------------------------------------------------------------------------
	// Add the ClientSocialProfileTBL 
	//--------------------------------------------------------------------------------------------------
	$sql = "INSERT into ClientSocialProfileTBL 
				(MEDPAL, CurSmoker, FormerSmoker, SmokerType, SmokerperMonth, SmokerYears, Alcohol, 
					AlcoholperMonth, Exersize, ExersizeperMonth, ExersizeDescription, Diet, DietDescription)
				
				VALUES('$Medpal', '$_POST[profcursmoke]','$_POST[profformersmoke]', '$_POST[profsmokertype]', '$_POST[profsmokermonth]', 
					'$_POST[profsmokeryears]', '$_POST[profalcohol]', '$_POST[profalcoholperrmonth]', '$_POST[profexersize]',	
					'$_POST[profexersizepermonth]', '$_POST[profexersizedescription]',	'$_POST[profdiet]', '$_POST[profdietdescription]')";
								
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query insert ClientSocialProfileTBL (77) - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	
}	

//----------------------------------------------------------------------------------------------------------
// Write to Access Log Table
//----------------------------------------------------------------------------------------------------------
AccessLogAdd("Social Health Profile Information update.", "Ok", $module, "", $conn);

//--------------------------------------------------------------------------------------------------
// update display variables
//--------------------------------------------------------------------------------------------------
$DisplayMsg = "Social Health Profile Information update successfull!";


//--------------------------------------------------------------------------------------------------
// end of Update 
//--------------------------------------------------------------------------------------------------
		
//--------------------------------------------------------------------------------------------------		
// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_UAmedprofSocial.php?msgTxt=$DisplayMsg&err=$DisplayErr");

?>
