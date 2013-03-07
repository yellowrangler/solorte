<?php
// Start session 
session_start();
//if ( (!isset($_SESSION[AuthID])) || ($_SESSION[AuthID] < 1) )
//{
//	die("Not today");
//}

require ('hysStatusMsg.php');

// get current date for display

function currDate() 
{
   $time = time();
   return(date("F j, Y", $time));
} // end of currDate func

?>

<html>
<head>

<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>

<script type="text/javascript">
function startUp() 
{	
	<?php print $JavaScriptLogMsg; ?> 
		
	<?php print $JavaScriptMsg; ?>
	
	self.focus();
	document.login.userid.focus();
}
<!--
// Copyright information must stay intact
// FormCheck v1.10
// Copyright NavSurf.com 2002, all rights reserved
// Creative Solutions for JavaScript navigation menus, scrollers and web widgets
// Affordable Services in JavaScript consulting, customization and trouble-shooting
// Visit NavSurf.com at http://navsurf.com

function formCheck(formobj){
	// name of mandatory fields
	var fieldRequired = Array("userid", "password");
	// field description to appear in the dialog box
	var fieldDescription = Array("User ID", "Password");
	// field description to appear in the dialog box
	var fieldEdit = Array("None", "None");
							
	// dialog message
	var alertMsg = "Please complete the following fields:\n";
	
	var l_Msg = alertMsg.length;
	
	for (var i = 0; i < fieldRequired.length; i++)
	{
		var obj = formobj.elements[fieldRequired[i]];
		if (obj)
		{
			if (obj.type == null)
			{
				var blnchecked = false;
				for (var j = 0; j < obj.length; j++)
				{
					if (obj[j].checked){
						blnchecked = true;
					}
				}
				if (!blnchecked)
				{
					alertMsg += " - " + fieldDescription[i] + "\n";
				}
				continue;
			}

			switch(obj.type)
			{
				case "select-one":
					if (obj.selectedIndex == -1 || obj.options[obj.selectedIndex].text == "")
					{
						alertMsg += " - " + fieldDescription[i] + "\n";
					}
					break;
				case "select-multiple":
					if (obj.selectedIndex == -1)
					{
						alertMsg += " - " + fieldDescription[i] + "\n";
					}
					break;
				case "text":
				case "textarea":
					if (obj.value == "" || obj.value == null)
					{
						alertMsg += " - " + fieldDescription[i] + "\n";
					}
					
					if (fieldEdit[i] != "None")
					{	
						var x = fieldCheck(obj.value, fieldEdit[i]);
						if (!x)
						{
							alertMsg += " - Invalid " + fieldDescription[i] + "\n";
						}
					}	
					break;
				default:
			}
		}
	}

	if (alertMsg.length == l_Msg)
	{
		return true;
	}
	else
	{
		alert(alertMsg);
		return false;
	}
}

function fieldCheck(strValue, strEdit)
{
	var res = true;
	var i;
	
	switch(strEdit)
	{
			case "MM":
				i = parseFloat(strValue);
				if (i <= 0 || i > 12)
				{
					res = false;
				}
				break;
			case "DD":
				i = parseFloat(strValue);
				if (i <= 0 || i > 31)
				{
					res = false;
				}
				break;
			case "YYYY":
					i = parseFloat(strValue);
				if (i < 1850)
				{
					res = false;
				}
				break;
			case "HH":
				i = parseFloat(strValue);
				if (i < 0 || i > 12)
				{
					res = false;
				}
				break;
			case "MI":
				i = parseFloat(strValue);
				if (i < 0 || i > 60)
				{
					res = false;
				}
				break;
			default:
	}		
	return res;
}
// -->

</script>
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
		height:600px;
		background-color: white;
		border:1px solid white;
		}
						
		
.outerBorder {
		border-top:0px solid #8da98d;
		border-left:1px solid #8da98d;
		border-right:1px solid #8da98d;
		border-bottom:1px solid #8da98d;
	}	

</style>

</head>

<body onload="startUp()">

<div id="banner" class="banner">
<table width="100%" border=0 cellspacing=0 cellpadding=0>
		<tr>
      <td width="65%" align="left"><img border="0" src="images/healthyourselflogo.JPG"></td>
      <td align="left">&nbsp;</td>  
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

<form method="POST" name="login"  ACTION="login.php"  onsubmit="return formCheck(this);">

<br><br>
			
<table>
	<tr>
		<td>
			<table border=0 width=300>
				<tr>
					<td valign=top align=right><b>UserID and Personal Identification Number (PIN) Help</b></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td valign=top align=right>
						<a href="#" onClick="(PopUpWindow('pupinnew.php', 'f', 1))">Establish a PIN</a>
						<img border=0 src="images/goldbulsquare.gif" width=12 height=12>
					</td>
				</tr>
				<tr>
					<td valign=top align=right>
						<a href="#"  onClick="(PopUpWindow('pupinchange.php', 'f', 1))">Change your PIN or Password</a>
						<img border=0 src="images/goldbulsquare.gif" width=12 height=12>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
			</table>		
		</td>
		<td>
			<table width=15 border=0>
				<tr>
					<td>&nbsp;</td>
				</tr>
			</table>
		</td>
		<td>
			<table width=350 border=0 class="topicBorder">
				<tr>
					<td>Login</td>
				</tr>
			</table>
			<table width=350 border=0 class="outerBorder">
				<tr>
					<td colspan=3>&nbsp;</td>
				</tr>
				<tr>
					<td width="45%" height=21 valign=middle align=right>UserID</td>
					<td width="5%">&nbsp;</td>
					<td width="50%" height=21 valign=middle align=left><input tabindex=1 type="text" name="userid" size=20></td>
				</tr>
				<tr>
					<td width="45%" height=21 valign=middle align=right>Password</td>
					<td width="5%">&nbsp;</td>
					<td width="50%" height=21 valign=middle align=left><input tabindex=2 type="password" name="password" size=20></td>
				</tr>
				<tr>
					<td colspan=3>&nbsp;</td>
				</tr>
				<tr>
					<td width="45%" height=21 valign=middle align=center><input tabindex=3 type=submit value="Login" name="SUBMIT"></td>
					<td width="5%">&nbsp;</td>
					<td width="50%" height=21 valign=middle align=center><input tabindex=4 type=reset value="Reset" name="RESET"></td>
				</tr>
				<tr>
					<td colspan=3>&nbsp;</td>
				</tr>
			</table>
		</td>
		<td>
			<table cellpadding=20 width="100%">
				<tr>
					<td align=center width="70%"></td>
					<td align=center><img border=0 src="images/medphoto1.gif"></td>
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

<table border=0 width="97%">
  <tr>
    <td width="33%" valign=top align=left><img border="0" src="images/hyslogo3small.JPG" width=72 height=45></td>
	<td width="33%" valign=top align=left><b>Not intended for diagnostic use.</b></td>
    <td width="33%" align=right><p><font face="Arial" size="1">Copyright 2003 MedAux Corp.
    																						<br> All rights reserved.
    																						<br>Terms of Use on file.</font>
    																						</p></td>
	</tr>
</table>
</div>

</body>

</html>
