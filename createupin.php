<?php 
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'createupin.php';

require ('hysInit.php');

require ('hysDBinit.php');

if (isset($_POST[upinfile]) && ($_POST[upinfile] != "") )
{
	if (!$Inhandle = fopen($_POST[upinfile], "r"))
	{
		echo "Error doing open for File '$_POST[upinfile]'";
		return;		
	}
	
	if (isset($_POST[filenbr]) && ($_POST[filenbr] != "") )
	{
		$recPERfile = $_POST[filenbr];
	}
	else
	{
		$recPERfile = 10000;
	}	
	
	$FileNbr = 0;
	$isOpen = 0;
	while ( ($data = fgetcsv($Inhandle, 1024)) !== FALSE)
	{
		$FileNbr +=1;
	
		$tmpOutFile = "upin_out".$FileNbr.".sql";
		
		if (!$Outhandle = fopen($tmpOutFile, "w"))
		{
			echo "Error doing open for File $tmpOutFile";
			return;
		}
		
		$isOpen = 1;
		
		$row = 1;
		
		if (!fwrite($Outhandle, $sql." \n"))
		{
			$errmsg = "Unable to write to file '$tmpOutFile' row = '$row' sql = '$sql'";
			$location = "if_createupin.php";
			$shortmsg = $errmsg;
			$severity = 1;
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
		}	
			
		while ( ( ($data = fgetcsv($Inhandle, 1024)) !== FALSE) && ($row < $recPERfile) ) 
		{
			$row += 1;
			
			$sql = "INSERT INTO UpinTBL 
						(LastName, FirstName, MI, Suffix, CredentialCodes, UPIN, 
						LiscenceState, ZIP, PrimarySpecialtyCode)  
						VALUES ('$data[0]', '$data[1]', '$data[2]', '$data[3]', 
						'$data[4]', '$data[5]', '$data[6]', '$data[7]', '$data[8]')";
					
			if (!fwrite($Outhandle, $sql." \n"))
			{
				$errmsg = "Unable to write to file '$tmpOutFile' row = '$row' sql = '$sql'";
				$location = "if_createupin.php";
				$shortmsg = $errmsg;
				$severity = 1;
				LogErr($shortmsg, $errmsg, $location, $module, $severity);
			}	
		}
		
		fclose($Outhandle);
		
		$isOpen = 0;
	}
	
	fclose($Inhandle);
	
	if ($isOpen == 1)
	{
		fclose($Outhandle);
	}	
	
	$sTatus="Finished Building SQL Files";
}	

$location = "if_createupin.php?msgTxt=$sTatus";

?>
