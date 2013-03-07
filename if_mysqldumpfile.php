<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_mysqldumpfile.php';

require ('hysInit.php');

//----------------------------------------------------------------------------------------------------------
// find the file parm
//----------------------------------------------------------------------------------------------------------
if ( isset($_GET[filename]) and ($_GET[filename] != "") )
{
	//----------------------------------------------------------------------------------
	// Get a file into an array. 
	//----------------------------------------------------------------------------------
	$lines = file($_GET[filename]);
	
	//----------------------------------------------------------------------------------
	// Loop through our array.
	//----------------------------------------------------------------------------------
	foreach ($lines as $line_num => $line) {
	   echo htmlspecialchars($line)."<br />\n";
	}
	
}
 
?>
<html>

<head>
<title>HealthYourSelf Customer Appointment Calander</title>

<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css">
		
</style>

<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>
<script type="text/javascript">
function startUp() 
{	
	<?php print $JavaScriptLogMsg; ?>
		
	<?php print $JavaScriptMsg; ?>
}
</script>
</head>

<body onload="startUp()">

</body>
</html>
