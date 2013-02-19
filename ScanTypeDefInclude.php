<?php

//----------------------------------------------------------------------------------------------------------
// get Scan Types
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT * from ScanTypeTBL"; 

//----------------------------------------------------------------------------------------------------------
// Make the call
//----------------------------------------------------------------------------------------------------------
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ScanTypeTBL  (395) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------
// initialize display block
//----------------------------------------------------------------------------------------------------------
$DisplayScanTypeList = "";

//----------------------------------------------------------------------------------------------------------
// Now lets first see if there is anything to run through
//----------------------------------------------------------------------------------------------------------
$countRows = mysql_num_rows($sql_result);
if ($countRows >  0) 
{	
	// now lets run the table and get our Event types
	while ($result_arr = mysql_fetch_assoc($sql_result))
	{
		$DisplayScanTypeList .= "\t\t\t<option value=\"".$result_arr[ID]."\" >".$result_arr[ScanType]."\n ";
	}
}	
		
//----------------------------------------------------------------------------------------------------------
// BuildScanDef jscript
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT * from ScanDefinitionTBL ORDER BY ScanTypeID, ID"; 

//----------------------------------------------------------------------------------------------------------
// Make the call
//----------------------------------------------------------------------------------------------------------
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query for ScanDefinitionTBL  (396) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------
// initialize display block
//----------------------------------------------------------------------------------------------------------
$jscriptScanDefSelect = "";
$javascriptTmp = "";

$jscriptScanDefSelect = "
							
function buildScanDef()
{
	idx = document.$formName.scantype.value
	
	switch (idx)
	{
							";		
							
//----------------------------------------------------------------------------------------------------------
// Now lets first see if there is anything to run through
//----------------------------------------------------------------------------------------------------------
$countRows = mysql_num_rows($sql_result);
if ($countRows >  0) 
{	
	$tmpID = "";
	$FirstTime = 1;
	$break = "\t\tbreak\n\n";
	
	// now lets run the table and get our Event types
	while ($result_arr = mysql_fetch_assoc($sql_result))
	{
		if ($result_arr[ScanTypeID] == $tmpID)
		{
			$i= $i + 1;
		}
		else
		{	
			$tmpID = $result_arr[ScanTypeID];
			
			if ($FirstTime == 1)
			{
				$FirstTime = 0;
			}
			else
			{
				$jscriptScanDefSelect .= "\n\t\tdocument.$formName.scandefinition.length = $i + 1\n\n";
				$jscriptScanDefSelect .= $javascriptTmp;
				$jscriptScanDefSelect .= $break;
				
				
				$javascriptTmp = "";
			}
			
			$jscriptScanDefSelect .= "\n\tcase '$tmpID':\n";
			
			$i = 0;
		}
		
		$javascriptTmp .= "\t\tdocument.$formName.scandefinition.options[$i].text=\"$result_arr[ScanDefinition]\"\n";
		$javascriptTmp .= "\t\tdocument.$formName.scandefinition.options[$i].value=\"$result_arr[keyID]\"\n\n";		
	}  // End of While
	
	// Add last break and  length
	$jscriptScanDefSelect .= "\n\t\tdocument.$formName.scandefinition.length = $i + 1\n\n";
	$jscriptScanDefSelect .= $javascriptTmp;
	$jscriptScanDefSelect .= $break;
	
	
}  // End of If

$jscriptScanDefSelect .= 
							"

	} // end of switch
	
} // end of function
							";
?>
