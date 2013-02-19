<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'pucheckmsgsCS.php';
$selection = 'xxxxxxx';

require ('hysInit.php');

?>

<html>

<head>
<title>HealthYourSelf Cust Service</title>

<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />
<style type="text/css">


.ArticleHeader {
		font: 700 15px Arial,Helvetica; 
		font-style: italic;
		text-align: left;
		color:#666666;
		}
		
.PUbanner {
		position: absolute;
		left:1px;
		top:1px;
		height:30px;
		width:400px;
		border-top:1px solid white;
		border-right:1px solid white;
		border-left:1px solid white;
		background:#fff;
		}
		
.popupLine   { 
		color: #008080;
		}

.popup {
		color: black; 
		line-height: 20px; 
		font: 400 15px Arial, Geneva; 
		text-decoration: none;
		text-align: left;
		}				
</style>


</style>
<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>

</head>

<body>


<div id="banner" class="banner">
<table width="100%" border=0 cellspacing=0 cellpadding=0>
		<tr>
      <td align="left" width="75%"><img border="0" src="images/healthyourselflogo.JPG"></td> 
  </tr>
</table>

<hr align="left" size="1" width="90%" class="popupLine">

</div>

<div id="popup" class="popup">
<br><br>
<table width="80%">
	<tr>
		<td align="left" width="75%" class="smallText"><i><a href="#" onClick="window.close()">Close Window</a></i></td>
		<td align="right" width="25%" class="smallText"><i><a href="#" onClick="printDoc()">Print Window</a></i></td>
	</tr>
</table>	

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
<? require ('hysFooter.php'); ?>

</body>

</html>
