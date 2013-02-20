<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>Welcome to Solorte</title>

<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css">

.banner {
		position: absolute;
		left:1px;
		top:1px;
		height:50px;
		width:600px;
		border-top:1px solid white;
		border-right:1px solid white;
		border-left:1px solid white;
		background:#fff;
		}
		
.longLineHdr {
		left:1px;
		width:700px;
		height:1px;
		color:#23708e;
		border-top:0px solid #23708e;
		border-left:0px solid #23708e;
		border-right:0px solid #23708e;
		border-bottom:1px solid #23708e;
		background-color: white;
		}

.bodyMain {
		position: absolute;
		left:1px;
		top:52px;
		width:1000px;
		height:500px;
		color:#23708e;
		border-top:0px solid #23708e;
		border-left:0px solid #23708e;
		border-right:0px solid #23708e;
		border-bottom:0px solid #23708e;
		background-color: white;
		}
		
.headerBorder {
		color:#23708e;
		font: 700 15px Arial,Helvetica;
		border-top:0px solid #d1b60c;
		border-left:0px solid #d1b60ce;
		border-right:0px solid #d1b60c;
		border-bottom:1px solid #d1b60c;
		}
		
</style>

</head>
<body>	
<div  class="banner">
<table border=0 cellspacing=0 cellpadding=0>
	<tr>
      <td align="left"><img border="0" src="images/solorte3jp.jpg"></td>
  </tr>
</table>
</div>

<div class="bodyMain">
<table border=0 width="100%">
	<tr>
		<td width=40>&nbsp;</td> 
		<td valign="bottom" align="right" class="headerBorder"><i>Welcome</i></td>
	</tr>
</table>

<br><br>
<h2 align="center"> Congratulations! You just completed your Router Test!</h2>
<br><br>
<center>
<table width="100%" class="SmTxt">
	<tr valign=top>
		<td align=right width="50%" height=35>IP Address:</td>
		<td align=leftwidth="50%"><b><?php print $_GET[ip]; ?></b>b> </td>
	</tr>
	<tr>
		<td align=center colspan=2 height=35><b>External</b>b></td>
	</tr>
</table>
</center>
</div>

</body>
</html>
