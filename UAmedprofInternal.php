<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'UAmedprofInternal.php';

require ('hysInit.php');

require ('hysDBinit.php');

//--------------------------------------------------------------------------------------------------
// initialize pass back values
//--------------------------------------------------------------------------------------------------
$DisplayErr = "N";

//----------------------------------------------------------------------------------------------------------
// create the SQL statement to get our External information.  
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT * from ClientInternalTBL 
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

//----------------------------------------------------------------------------------------------------------
// Now lets see if twe are an add or update.
//----------------------------------------------------------------------------------------------------------
$countRows = mysql_num_rows($sql_result);
if ($countRows > 0)
{
	//--------------------------------------------------------------------------------------------------
	// Update the ClientTBL and the ClientInternalTBL 
	//--------------------------------------------------------------------------------------------------
	$sql = "UPDATE ClientInternalTBL 
				set Skeletal =  '$_POST[profskel]', Muscular = '$_POST[profmusc]', Digestive = '$_POST[profdig]', 
					Respiratory = '$_POST[profresp]', Urinary = '$_POST[profuring]', Nervous = '$_POST[profnerv]', 
					Circulatory = '$_POST[profcirc]',  Endocrine = '$_POST[profendo]', Reproductive = '$_POST[profrepro]',
					Immune = '$_POST[profimm]',  SystolicPressure = '$_POST[profsys]', DiastolicPressure = '$_POST[profdias]',
					LDL = '$_POST[profldl]',  HDL = '$_POST[profhdl]', BloodType = '$_POST[profbloodtype]'
				where (ClientInternalTBL.MEDPAL = '$Medpal')";
								
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query update ClientInternalTBL (77) - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "";
		$severity = 1;
		LogErr($errmsg, $location);
	}
}
else
{
	//--------------------------------------------------------------------------------------------------
	// Insert the ClientTBL and the ClientInternalTBL 
	//--------------------------------------------------------------------------------------------------
	$sql = "INSERT into ClientInternalTBL 
	(MEDPAL, Skeletal, Muscular, Digestive,	Respiratory, Urinary, Nervous, Circulatory,  
				 Endocrine, Reproductive, Immune,  SystolicPressure, DiastolicPressure, 
				 LDL,  HDL, BloodType)
				 
				VALUES ('$Medpal', '$_POST[profskel]', '$_POST[profmusc]', '$_POST[profdig]', 
					'$_POST[profresp]', '$_POST[profuring]', '$_POST[profnerv]', 
					'$_POST[profcirc]',  '$_POST[profendo]', '$_POST[profrepro]',
					'$_POST[profimm]',  '$_POST[profsys]', '$_POST[profdias]',
					'$_POST[profldl]',  '$_POST[profhdl]', '$_POST[profbloodtype]')";
								
	if (!$sql_result = mysql_query($sql, $conn))
	{
		$sqlerr = mysql_error();
		$errmsg = "$sqlerr - Error doing mysql_query update ClientInternalTBL (77) - '$Medpal'";
		$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
		$location = "";
		$severity = 1;
		LogErr($errmsg, $location);
	}
	
}	

//----------------------------------------------------------------------------------------------------------
// Write to Access Log Table
//----------------------------------------------------------------------------------------------------------
AccessLogAdd("Internal Medical Information update.", "Ok", $module, "", $conn);

//--------------------------------------------------------------------------------------------------
// update display variables
//--------------------------------------------------------------------------------------------------
$DisplayMsg = "Internal Medical Information update successfull!";


//--------------------------------------------------------------------------------------------------
// end of Update 
//--------------------------------------------------------------------------------------------------
		
//--------------------------------------------------------------------------------------------------		
// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_UAmedprofInternal.php?msgTxt=$DisplayMsg&err=$DisplayErr");

?>
