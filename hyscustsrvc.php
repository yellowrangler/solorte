<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'hyscustsrvc.php';
$selection = 'service';

require ('hysInit.php');

require ('hysDBinit.php');

?>

<html>

<head>
<title>HealthYourSelf Cust Service</title>

<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />
<style type="text/css">

.leftcontent {
		position: absolute;
		padding-left:10px;
		left:20px;
		top:50px;
		width:435;
		height:400px;
		background: #ffffff;
		border:1px solid black;
		}

.rightcontent {
		position: absolute;
		padding-left:10px;
		left:520;
		top:50px;
		width:455;
		height:400px;
		background: #ffffff;
		border:1px solid black;
		}		
		
.smallText2Bolditallic {
		font: 700  13px Arial, Geneva;
		font-style: italic;
		line-height: 15px; 
		}		
		
</style>
<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>
<script type="text/javascript">
function startUp() 
{	
	<? print $JavaScriptLogMsg; ?> 
		
	<? print $JavaScriptMsg; ?>
}
</script>
</head>

<body onload="startUp()">

<? require ('hysTopLegend.php'); ?>

<? require ('hysMainNav.php'); ?>

<div class="selectedContent">
<div id="leftcontent" class="leftcontent">
<br><br>
<center>
<table class="smallText2" width="90%">
	<tr>
		<td class="headerBorderGold"><i>By Phone</i></td>
	</tr>
</table>
<br>
<table width="90%">	
	<tr> 
  		<td width="40%" height=25 align=left class="smallText2">General Information</td>
		<td width="60%" align=left class="smallText2">617-733-9599</td>
 	</tr>
 	<tr> 
		<td width="40%" height=25 align=left class="smallText2">Emergency Service</td>
		<td width="60%" align=left class="smallText2">617-733-9599</td>
 	</tr>
 	<tr> 
		<td width="40%" height=25 align=left class="smallText2">Update Account</td>
		<td width="60%" align=left class="smallText2">617-733-9599</td>
 	</tr>
</table>
<br><br>
<table class="smallText2" width="90%">
	<tr>
		<td class="headerBorderGold"><i>On Line</i></td>
	</tr>
</table>
<br>
<table width="90%">	
	<tr> 
		<td width="5%"align=left height=25><img border=0 src="images/envelope.gif" width=12 height=12></td>
		<td width="70%"align=left><a class="smallText2"  href="mailto:customersupport@solorte.com?Subject=Client Inquiry">Send us an Email</a></a></td>
 	</tr>	
	<tr> 
		<td width="5%"align=left height=25><img border=0 src="images/mailbox.gif" width=12 height=12></td>
		<td width="70%"align=left>
			<a href="#" onClick="(PopUpWindow('pucheckmsgsCS.php', 'r', 4))" class="smallText2">Check your Messages</a>
		</td>
	</tr>
	<tr> 
		<td width="5%"align=left height=25><img border=0 src="images/mailbox.gif" width=12 height=12></td>
		<td width="70%"align=left>
			<a href="#" onClick="(PopUpWindow('puproblemtracking.php', 'r', 6))" class="smallText2">Problem Reporting</a>
		</td>
	</tr>
</table>
</div>

<div id="rightcontent" class="rightcontent">
<br><br>
<table class="smallText2" width="90%">
	<tr>
		<td class="headerBorderGold"><i>Write Us</i></td>
	</tr>
</table>
<br>
<table width="90%">	
	<tr>
		<td width=5 align=left height=25><img border=0 src="images/goldbulsquare.gif" width=12 height=12></td>
		<td align=left class="smallText2Bolditallic">Health Your Self</td>
	</tr>
	<tr>	
		<td width=5 align=left height=25>&nbsp;</td>
		<td align=left class="smallText2Bolditallic">3 Amherst Rd</td>
	</tr>
	<tr>	
		<td width=5 align=left height=25>&nbsp;</td>
		<td align=left class="smallText2Bolditallic">Andover, MA 01810</td>
 	</tr>	
</table>

<br><br><br><br>
<table class="smallText2" width="90%">
	<tr>
		<td class="headerBorderGold"><i>Other</i></td>
	</tr>
</table>
<br>
<table width="90%">	
	<tr>
		<td width=5 align=left height=25><img border=0 src="images/goldbulsquare.gif" width=12 height=12></td>
		<td align=left>
			<a href="#" onClick="(PopUpWindow('puFAQCS.php', 'r', 4))" class="smallText2">Frequently Asked Questions (FAQ)</a>
		</td>
 	</tr>	
</table>
</center>
</div>
</div>
<? require ('hysFooter.php'); ?>

</body>

</html>
