<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'hysEmpty.php';
$selection = 'xxxxxxx';

require ('hysInit.php');

require ('hysDBinit.php');

?>

<html>

<head>
<title>HealthYourSelf Cust Service</title>

<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />
<style type="text/css">



</style>
<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>

</head>

<body>

<?php require ('hysTopLegend.php'); ?>

<?php require ('hysMainNav.php'); ?>

<div class="selectedContent">
<br><br>
<center>
<table>
	<tr>
		<td><img border=0 src="images/underconstr.gif"></td>
		<td width=10>&nbsp;</td>
		<td><b>This Service is currently under Construction.</b></td>
	</tr>
</table>

</div>
<?php require ('hysFooter.php'); ?>

</body>

</html>
