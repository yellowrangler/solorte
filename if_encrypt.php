<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_encrypt.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

//----------------------------------------------------------------------------------------------------------
// we are either being called by default (user selects app udate OR someone has clicked a appointment to 
// update or delete in which case we need the appid OR we have sent a request to add, update or delete
// an appointment and we are now getting back results.  So we need to see first of all is our GET
// set and act accordingly
//----------------------------------------------------------------------------------------------------------

if (isset($_POST[stringto]) && ($_POST[stringto] != "") )
{
	$DisplayStringTo = $_POST[stringto];
	
	$DisplayEncryptedString = spookEStr($DisplayStringTo);
		
	$DisplayDecryptedString = spookDStr($DisplayEncryptedString);
}

if (isset($_POST[Action]) && ($_POST[Action] != "") )
{
	// first check parms passed and date is valid
	switch ($_POST[Action])
	{
		case 'Test':
			echo "test";
			break;
		
		case 'Change':
			$DisplayEDChoice = $_POST[edselect];
			
			if ($_POST[edselect] == "encrypt")
			{
				echo "encrypt";
			}
			else if ($_POST[edselect] == "decrypt")
			{
				echo "decrypt";	
			}
			break;
	}
}
	
?>
<html>

<head>
<title>HealthYourSelf Manage Account Information</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />
<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>
<script type="text/javascript">
function startUp() 
{	
	<? print $JavaScriptLogMsg; ?> 
		
	<? print $JavaScriptMsg; ?>
}
</script>
<style type="text/css">
.selectedContent {
		position: absolute;
		left:0px;
		top:0px;
		width:1001px;
		height:801px;
		border-top:0px #ccccff;
		border-right:0px solid black;
		border-left:0px solid black;
		border-bottom:0px solid black;
		background: #ccccff;
		}

.tableTitleEDTest {
		position: absolute;
		left:20px;
		top:50px;
		width:450px;
		height:200px;
		background:white;
		border-top:0px solid #006633;
		border-left:1px solid #006633;
		border-right:1px solid #006633;
		border-bottom:1px solid #006633;
		}	

.tableTitleEDswitch {
		position: absolute;
		left:500px;
		top:50px; 
		width:275px;
		height:200px;
		background:white;
		border-top:0px solid #006633;
		border-left:1px solid #006633;
		border-right:1px solid #006633;
		border-bottom:1px solid #006633;
		}	
			
.tableTitleEDInfo {
		position: absolute;
		left:20px;
		top:300px;
		width:755px;
		height:450px;
		background:white;
		border-top:0px solid #006633;
		border-left:1px solid #006633;
		border-right:1px solid #006633;
		border-bottom:1px solid #006633;
		}	
.detailPara {
		padding-left: 10px;
		padding-right: 10px;
		}			
			
.outerBorderTitleGreenLetterSpace {
		color: white;
		font: 700 11px Arial,Helvetica;
		text-align: center;
		border-top:1px solid #006633;
		border-left:1px solid #006633;
		border-right:1px solid #006633;
		border-bottom:1px solid #006633;
		background: #006633;
		}			
</style>
</head>

<body onload="startUp()">

<div class="selectedContent">
<form  action="if_encrypt.php" method=post>
<div class="tableTitleEDTest">
<table width="100%" cellspacing=0 class="outerBorderTitleGreenLetterSpace">
	<tr>
		<td align="center"><b>Test for Encryption Operational</b></td>
	</tr>	
</table>
<table width="100%">
	<tr>
		 <td height=10 colspan=2 align="center">&nbsp;</td>
	</tr>	
	<tr>
		<td align=right height=35>String to Encrypt:</td>
		<td align=left><input size=45 maxlength=45 type="text" name="stringto" value="<? print $DisplayStringTo; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=35>Encrypted String:</td>
		<td align=left><input readonly class="readonlyText" size=45 maxlength=45 type="text" name="encrypt" value="<? print $DisplayEncryptedString; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=35>Decrypted String:</td>
		<td align=left><input readonly class="readonlyText" size=45 maxlength=45 type="text" name="decrypt" value="<? print $DisplayDecryptedString; ?>"> </td>
	</tr>
</table>
<input type="hidden" name="dummy" value="">		
<br><center>
<table  border=0 width="100%">
	<tr>
		<td align=center><input type=submit size=150 NAME="SUBMIT" VALUE="Submit"></td>
	</tr>
</table>
</center>		
</form>
</div>

<form  action="if_encrypt.php" method=post>
<div class="tableTitleEDswitch">
<table width="100%" cellspacing=0 class="outerBorderTitleGreenLetterSpace">
	<tr>
		<td align="center"><b>Check/Change Database Encryption/Decryption</b></td>
	</tr>	
</table>
<table width="100%">
	<tr>
		 <td height=10 colspan=2 align="center">&nbsp;</td>
	</tr>	
	<tr>
		<td align=right height=35>Your Password:</td>
		<td align=left><input class="readonlyText" readonly size=15 maxlength=15 type="text" name="yourpassword" value="<? print $DisplayYourPassword; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=35>Choose:</td>
		<td align=left>
			<select name="edselect"> 
				<option value=""><? print $DisplayEDChoice; ?> 
				<option value="encrypt">Encrypt All
				<option value="decrypt">Dencrypt All
			</select>
		 </td>
	 </tr>
	 <tr>
		 <td height=35 colspan=2 align="center">&nbsp;</td>
	</tr>
</table>
<input type="hidden" name="dummy" value="">		
<br><center>
<table  border=0 width="100%">
	<tr>
		<td width=15>&nbsp;</td>
		<td align=center><input type="submit" NAME="Action" VALUE="Test"></td>
		<td width=15 align=center>&nbsp;</td>
		<td align=center><input type="submit" NAME="Action" VALUE="Change"></td>
		<td width=15>&nbsp;</td>
		<td align=center  height=15><input type=reset size=150 NAME="RESET" VALUE="Reset"></td>
		<td>&nbsp;</td>
	</tr>
</table>
</center>		
</form>
</div>

<div class="tableTitleEDInfo">
<table width="100%" cellspacing=0 class="outerBorderTitleGreenLetterSpace">
	<tr>
		<td align="center"><b>What this is for</b></td>
	</tr>	
</table>
<br>	
<p class="detailPara">Encryption is a funny thing.  If you screw it up your will probably never be able to recover the original data. So Be Carefull.</p>
<p class="detailPara">There are two parts to this Utility.  First you need to test that the encryption system is activated.  You can do this by using the 
<b>Encryption Opperational test Utility</b>.  Put a word in the <i>String to Encrypt</i> input box and then select the <b>Submit</b> button.  If the encryption system is operational 
you will see an encrpted string in the <i>Encrypted String</i> output box AND the string decrypted back in the <i>Decrypted String</i> output 
box.  If these things happen the system is active. If all you get is the string repeated in each box the system is not active</p>
<p class="detailPara">Second.  Once you have proved that the system is ACTIVE - You now test to see if the data on the Data base is encrypted.  You can test this by utilizing the 
<b>Check/Change Database Utility</b>.  Select the <b>Test</b> button and your password should appear in the <i>Your Password</i> output box.  If the password 
appears clear (not encrpted) then assume the database is also clear.  If you get a garbled password; then assume the database is encrypted.  Now, you can 
choose to encrypt or decrypt all protected data base fields by selecting either <i>Encrypt All</i> or <i>Decrypt All</i> from the <i>Choose</i> 
select list and then selecting the <b>Change</b> button.</p>
<p class="detailPara">You can confirm that the utility was performed correctly by retesting the password on the database.</p>
</div>
</div>
</body>

</html>
