<?php

// get current date for display

function currDate() 
{
   $time = time();
   return(date("F j, Y", $time));
} // end of currDate func

?>

<html>
<head>
<title>New Page 1</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css">

.topicBorder {
		color: white;
		font: 700 15px Arial,Helvetica;
		border-top:0px solid #8da98d;
		border-left:1px solid #8da98d;
		border-right:1px solid #8da98d;
		border-bottom:0px solid white;
		text-align: left;
		background: #8da98d;
		}	
		
.outerBorder {
		border-top:0px solid #8da98d;
		border-left:1px solid #8da98d;
		border-right:1px solid #8da98d;
		border-bottom:1px solid #8da98d;
}	

</style>
<script type="text/javascript">
function startUp() 
{	
	<?php print $JavaScriptLogMsg; ?>
		
	<?php print $JavaScriptMsg; ?>
}
</script>
</head>

<body onload="startUp()">

<div id="banner" class="banner">
<table width="100%" border=0 cellspacing=0 cellpadding=0>
		<tr>
      <td width="65%" align="left"><img border="0" src="images/healthyourselflogo.JPG"></td>
      <td align="left"><b><font face="Arial Rounded MT Bold" size="2"><a href="http://hyshelp.php">Help</a></font></b></td>  
  </tr>
</table>
</div>

<!-- thin bar -->
<div align="left">
<table class="mainBar" width="90%">
  <tr>
    <td></td>
  </tr>
</table>
</div>   

<!-- Third line within top set shows date and allows for user to print page -->
<div name="dateLine" class="dateLine">
<table width="100%">
  <tr>
    <td width="100%" valign="center" align="left" class="logincrumbLineBorder" height="15"><?php print currDate(); ?></t
  </tr>
</table>
</div>  

<!-- This is the beginning of main display -->
<div id="middlecontent" class="middlecontent">

<form method="POST" name="login"  ACTION="login.php">

<br><br>
			
<table>
	<tr>
		<td>
			<table border="0" width="300">
				<tr>
					<td valign="top" align="right"><b>MedPal and Personal Identification Number (PIN) Help</b></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td valign="top" align="right"><img border="0" src="images/goldbulsquare.gif" width="12" height="12"><a tabIndex="80" href="http://">Establish a PIN</a></td>
				</tr>
				<tr>
					<td valign="top" align="right"><img border="0" src="images/goldbulsquare.gif" width="12" height="12"><a tabIndex="90" href="http://">Change your PIN or Password</a></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
			</table>		
		</td>
		<td>
			<table width="15" border="0">
				<tr>
					<td>&nbsp;</td>
				</tr>
			</table>
		</td>
		<td>
			<table width="350" border="0" class="topicBorder">
				<tr>
					<td>Login</td>
				</tr>
			</table>
			<table width="350" border="0" class="outerBorder">
				<tr>
					<td colspan=3>&nbsp;</td>
				</tr>
				<tr>
					<td width="45%" height="21" valign="middle" align="right">MedPal Number</td>
					<td width="5%">&nbsp;</td>
					<td width="50%" height="21" valign="middle" align="left"><input type="text" name="MP" size="20"></td>
				</tr>
				<tr>
					<td width="45%" height="21" valign="middle" align="right">Password</td>
					<td width="5%">&nbsp;</td>
					<td width="50%" height="21" valign="middle" align="left"><input type="password" name="password" size="20"></td>
				</tr>
				<tr>
					<td colspan=3>&nbsp;</td>
				</tr>
				<tr>
					<td width="45%" height="21" valign="middle" align="center"><input type=submit value="Login" name="SUBMIT"></td>
					<td width="5%">&nbsp;</td>
					<td width="50%" height="21" valign="middle" align="center"><input type=reset value="Reset" name="RESET"></td>
				</tr>
				<tr>
					<td colspan=3>&nbsp;</td>
				</tr>
			</table>
		</td>
		<td>
			<table cellpadding=20 width="100%">
				<tr>
					<td align="center" width="70%"></td>
					<td align="center"><img border="0" src="images/medphoto1.gif"></td>
				</tr>
			</table>
		</td>
	</tr>	
</table>

<br>

</form>

<br>


<br>
<hr>

<table border="0" width="97%">
  <tr>
    <td width="50%" valign="top" align="left"><a href="http://hyscorp.php"><img border="0" src="images/hyslogo3small.JPG" width="72" height="45"></a></td>
    <td width="50%" align="right"><p><font face="Arial" size="1">Copyright 2003 MedAux Corp.
    																						<br> All rights reserved.
    																						<br><a href="http://hfstermsofuse.php">Terms of Use</a>.</font>
    																						</p></td>
	</tr>
</table>
</div>

</body>

</html>
