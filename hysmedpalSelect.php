<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'hysmedpalSelect.php';

$NoMedpalState = 'Y';

require ('hysInit.php');

require ('hysDBinit.php');

?>

<html>
<head>
<title>New Page 1</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />
<script type="text/javascript">
function startUp() 
{	
	<? print $JavaScriptLogMsg; ?> 
		
	<? print $JavaScriptMsg; ?>
}
</script>
<style type="text/css">

.topicBorder {
		color: white;
		border-top:0px solid #8da98d;
		border-left:1px solid #8da98d;
		border-right:1px solid #8da98d;
		border-bottom:0px solid white;
		text-align: left;
		background: #8da98d;
		}	
		
.mainBar {
		position: absolute;
		left:3px;
		top:32px;
		height:5px;
		border-top:3px solid #008080;
		border-right:1px solid white;
		border-left:1px solid white;
		background:#fff;
		}
		
.dateLine {
		position:absolute;
		left:5px;
		top:39px;
		height:10px;
		border-top:1px solid white;
		border-right:1px solid white;
		border-left:1px solid white;
		background:#fff;
		}
		
.logincrumbLineBorder {
		border: 1px; 
		font: 700 italic 10px Veranda, Arial,Helvetica;
		border-top:0px solid white;
		border-right:0px solid white;
		border-left:0px solid white;
		background: solid white;
		}	
		

.middlecontent {
		position: absolute;
		left:10px;
		top:70px;
		width:1000px;
		height:600px;
		background-color: white;
		border:1px solid white;
		}
								
.outerBorderTitleBlue {
		color: white;
		font: 700 13px Arial,Helvetica;
		text-align: center;
		border-top:1px solid #052faf;
		border-left:1px solid #052faf;
		border-right:1px solid #052faf;
		border-bottom:1px solid #052faf;
		background: #052faf;
		}	

.clientSearch {
		position: absolute;
		left:50px;
		top:100px;
		width:245px;
		height:55px;
		background: white;
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		}
		
.tablePos {
		position: absolute;
		left:50px;
		top:175px; 
		width:802px;
		height:20px;
		}

.innerSelectframe {
		position: absolute;
		left:50px;
		top:195px; 
		width:800px;
		height:400px;
		background-color: white;
		border:1px solid black;
		}
		
		
.outerBorder {
		border-top:0px solid #8da98d;
		border-left:1px solid #8da98d;
		border-right:1px solid #8da98d;
		border-bottom:1px solid #8da98d;
		}	
		
.bottomline {
		position: absolute; 
		top:775px; 
		background-color: white;
		border:1px solid white;
		}	

</style>

</head>

<body onload="startUp()">

<div id="banner" class="banner">
<table width="100%" border=0 cellspacing=0 cellpadding=0>
	<tr>
      <td width="65%" align="left"><img border="0" src="images/healthyourselflogo.JPG"></td>
	  <td width=150 align=center class="smallTextLegend"><a href="hyslogoff.php">Logout</a></td>
	  <td width=150 align=center class="smallTextLegend"><a href="#" OnClick="printDoc()">Print Page</a></td>
      <td width=150 align=center class="smallTextLegend"><a href="http://hyshelp.php">Help</a></td>
  </tr>
</table>
</div>

<!-- thin bar -->
<div align="left">
<table class="mainBar" width="98%">
  <tr>
    <td></td>
  </tr>
</table>
</div>   

<!-- Third line within top set shows date and allows for user to print page -->
<div name="dateLine" class="dateLine">
<table width="100%">
  <tr>
    <td width="100%" valign="center" align="left" class="logincrumbLineBorder" height="15"><? print currDate(); ?></t
  </tr>
</table>
</div>  

<!-- This is the beginning of main display -->
<div id="middlecontent" class="middlecontent">
<center>
<h2>Please select from the list of people bellow. </h2>
</center>
<div class="clientSearch">
<form name="search" method="post" ACTION="if_useridclientlist.php" target="clientlistframe">
<!-- Second outer column of Search -->
<table height=20 width="100%" class="outerBorderTitleBlueLetterSpace">
	<tr>
		<td><b>Search</b></td>
	</tr>
</table>
<table height=20 width="100%" class="outerBorderSMtxt">
	<tr>
		<td><input type="text" name="Search" size="29" maxlength="255"></td> 
		<td><INPUT TYPE="IMAGE" SRC="images/go_global_search.gif" ALT="Submit button" border="0"></td>
	</tr>
</table>
<input type='hidden' name='selType'  value='search'>
</form>
</div>
<div class="tablePos">
<table width="100%" cellspacing=0 class="outerBorderTitleBlue">
	<tr>
		<td width="5%" height=20 align="center" height="10">&nbsp;</td>	
		<td width="30%" height=20 align="center" height="10">Name</td>
		<td width="25%" align="center" height="10">Date of Birth</td>
		<td width="10%" align="center" height="10">Sex</td>
		<td width="15%" align="center" height="10">State</td>
		<td width="15%" align="center" height="10">Zip</td>
	</tr>	
</table>
</div>
 
<IFRAME name="clientlistframe" src="if_useridclientlist.php" scrolling=yes frameborder=0 class="innerSelectframe"></IFRAME>

</div>

<br>

<? require ('hysFooter.php'); ?>

</body>

</html>
