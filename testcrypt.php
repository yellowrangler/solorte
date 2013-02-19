<?php

require ('hysSpook.php');

if (isset($_POST[stringto]) && ($_POST[stringto] != "") )
{
	$DisplayStringTo = $_POST[stringto];
	
	$DisplayEncryptedString = spookEStr($DisplayStringTo);
		
	$DisplayDecryptedString = spookDStr($DisplayEncryptedString);
	
}

?>
<html>

<head>
<title>HealthYourSelf Manage Account Information</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />
<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>

<style type="text/css">
		
</style>

</head>

<body>
<br><br><br>
<center>
<form  action="testcrypt.php" method=post>
<table border=1 width="60%">
	<tr>
		 <td height=20 colspan=2 align="center">Test Encryption</td>
	</tr>	
	<tr>
		<td align=right height=35>String to Encrypt:</td>
		<td align=left><input size=15 maxlength=15 type="text" name="stringto" value="<? print $DisplayStringTo; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=35>Encrypted String:</td>
		<td align=left><input size=15 maxlength=15 type="text" name="encrypt" value="<? print $DisplayEncryptedString; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=35>Decrypted String:</td>
		<td align=left><input size=15 maxlength=15 type="text" name="decrypt" value="<? print $DisplayDecryptedString; ?>"> </td>
	</tr>
</table>
<input type="hidden" name="dummy" value="">		
<br><center>
<table  border=0 width="80%">
	<tr>
		<td align=center><input type=submit size=150 NAME="SUBMIT" VALUE="Submit"></td>
	</tr>
</table>	
</center>	
</form>
</body>

</html>
