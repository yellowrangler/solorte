<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'UAmedprofExternal.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

//--------------------------------------------------------------------------------------------------
// initialize pass back values
//--------------------------------------------------------------------------------------------------
$DisplayErr = "N";

//----------------------------------------------------------------------------------------------------------
// create the SQL statement to get our External information.  
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT * from ClientExternalTBL 
			where (MEDPAL = '$Medpal')";
		
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query join for ClientExternalTBL (321) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//---------------------------------------------------------------------------------------------------------
// Put height inot correct format for db
//---------------------------------------------------------------------------------------------------------
$DisplayHeight = sprintf("%s~%s", $_POST[profheightft], $_POST[profheightinches]);

//----------------------------------------------------------------------------------------------------------
// Now lets see if twe are an add or update.
//----------------------------------------------------------------------------------------------------------
$countRows = mysql_num_rows($sql_result);
if ($countRows > 0)
{
	
	//--------------------------------------------------------------------------------------------------
	// Update the ClientExternalTBL 
	//--------------------------------------------------------------------------------------------------
	$sql = "UPDATE ClientExternalTBL 
				set Height = '$DisplayHeight', Weight = '$_POST[profweight]', EyeColor = '$_POST[profeyecolor]', 
					Eyes = '$_POST[profeyes]', Glasses = '$_POST[profglasses]', Vision = '$_POST[profvision]', 
					Sex = '$_POST[profsex]', , HairColor = '$_POST[profhaircolor]', Skin = '$_POST[profskin]',
					Nose = '$_POST[profnose]', Mouth = '$_POST[profmouth]', Teeth = '$_POST[profteeth]',
					Ears = '$_POST[profears]',  Hearing = '$_POST[profhearing]', HearingAide = '$_POST[profhearingaide]',
					Prosthesis = '$_POST[profprosthesis]'
				where (ClientExternalTBL.MEDPAL = '$Medpal')";

	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query update ClientExternalTBL (77) - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
}
else
{
	//--------------------------------------------------------------------------------------------------
	// Add the ClientExternalTBL 
	//--------------------------------------------------------------------------------------------------
	$sql = "INSERT into ClientExternalTBL 
				(MEDPAL, Height, Weight, EyeColor, Eyes, Glasses, Vision, Sex, HairColor, Skin, Nose, Mouth, Teeth,  
				Ears, Hearing, HearingAide, Prosthesis)
				
				VALUES ('$Medpal', '$DisplayHeight','$_POST[profweight]', '$_POST[profeyecolor]', '$_POST[profeyes]',
					'$_POST[profglasses]', '$_POST[profvision]', '$_POST[profsex]', 
					'$_POST[profhaircolor]', '$_POST[profskin]', '$_POST[profnose]', '$_POST[profmouth]', '$_POST[profteeth]',
					'$_POST[profears]', '$_POST[profhearing]', '$_POST[profhearingaide]', '$_POST[profprosthesis]')";
								
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query insert ClientExternalTBL (77) - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "";
		$severity = 1;
		LogErr($shortmsg, $errmsg, $location, $module, $severity);
	}
	
}	

//----------------------------------------------------------------------------------------------------------
// Write to Access Log Table
//----------------------------------------------------------------------------------------------------------
AccessLogAdd("External Medical Information update.", "Ok", $module, "", $conn);

//--------------------------------------------------------------------------------------------------
// update display variables
//--------------------------------------------------------------------------------------------------
$DisplayMsg = "External Medical Information update successfull!";


//--------------------------------------------------------------------------------------------------
// end of Update 
//--------------------------------------------------------------------------------------------------
		
//--------------------------------------------------------------------------------------------------		
// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_UAmedprofExternal.php?msgTxt=$DisplayMsg&err=$DisplayErr");

?>
