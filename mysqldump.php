<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'mysqldump.php';

require ('hysInit.php');

require ('hysDBinit.php');

// first check parms passed and date is valid
switch ($_POST[Action])
{
	case 'Dump':
		$FileName = $_POST[filename]; 
		
		if (file_exists($FileName)) 
		{
			$result = unlink($FileName);
			if (!$result)
			{
				echo " Error in unlinking file named $FileName";
				die();
			}
		}	
			
		// Execute mysqldump command.
		// It will produce a file under html docs dir
		
		$mysqlstring = sprintf("mysqldump -u %s -p%s -c --add-drop-tab %s >%s",  $user, $password, $DataBase, $FileName);
		system($mysqlstring);
		//echo "mysqlstring = '$mysqlstring'";
		chmod($FileName, 0777);
		break;
}	

//--------------------------------------------------------------------------------------------------
// Move to next page
//--------------------------------------------------------------------------------------------------
header("Location: if_mysqldump.php");

?>
