<?php 
//----------------------------------------------------------------------------------------------------------
// Set initial value.
//----------------------------------------------------------------------------------------------------------
$location="Location: index.html";
//echo  "post  $_POST[Action]\n";
//$tmp = $_POST[Action];

//echo "tmp = $tmp\n";

//----------------------------------------------------------------------------------------------------------
// What are we being asked to do?  Here we go to func based on action
//----------------------------------------------------------------------------------------------------------
switch ($_POST[Action])
{
	case 'Customer Login':
		$location="Location: https:beta/hysmain.php";
		break;
		
	case 'Prototype Login':
		$location="Location: https:limited/hysmain.php";
		break;
			
} // end of switch
		
//--------------------------------------------------------------------------------------------------		
// Move to next page
//--------------------------------------------------------------------------------------------------
header($location);

?>
