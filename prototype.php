<?php 
//----------------------------------------------------------------------------------------------------------
// Set initial value.
//----------------------------------------------------------------------------------------------------------
$location="Location: startdemo.html";
//echo  "post  $_POST[Action]\n";
//$tmp = $_POST[Action];

//echo "tmp = $tmp\n";

//----------------------------------------------------------------------------------------------------------
// What are we being asked to do?  Here we go to func based on action
//----------------------------------------------------------------------------------------------------------
switch ($_POST[Action])
{
	case 'Logon':
		$location="Location: hysmain.php";
		break;
		
	case 'Make CS ID':
		$location="Location: makecustservid.php";
		break;
			
} // end of switch
		
//--------------------------------------------------------------------------------------------------		
// Move to next page
//--------------------------------------------------------------------------------------------------
header($location);

?>
