<?php
//----------------------------------------------------------------------------------------------------------
// function to set host variables for connection
//----------------------------------------------------------------------------------------------------------
function setHostVariables($HostID, &$host, &$user, &$password)
{
	switch ($HostID)
	{
		case 1:
			$host = "localhost";
			$user = "server";
			$password = "server";
			break;
			
		case 2:
			$host = "localhost";
			$user = "phpuser";
			$password = "pearl";
			
		case 3:
			$host = "localhost";
			$user = "tarryc";
			$password = "janetc";
			break;
	}			
}  // end of func

//----------------------------------------------------------------------------------------------------------
// LogErr funtion -- gets cur date time then writes errmsg to file.  Then displays msg to user. Then wxit.
//----------------------------------------------------------------------------------------------------------
function LogErr($errmsg, $location) {
   
	$time = time();
	$strDateTime = date("Y-m-d H:i:s", $time);
   
	$logname="images/errlog.log";
	$fp = fopen($logname, "a") or die("could not open errlog.log");
	$logmsg = "$strDateTime : $errmsg pu_UAICD9\n";
	fwrite($fp, $logmsg);
	fclose($fp);
	
	header($location);
	exit;
	
} // end of LogErre func

//----------------------------------------------------------------------------------------------------------
// first we make sure the cookie has been set
//----------------------------------------------------------------------------------------------------------
if (!isset($_COOKIE['medlok']))
{
	$errmsg = "Error - auth cookie not set (91)";
	$location = "Location: invalidcookie.php";
	LogErr($errmsg, $location);
} 

// now we parse out the vales
$ID = strtok($_COOKIE[medlok], ':');
$Medpal = strtok(':');
$AuthFlags = strtok(':');
$UserType = strtok(':');
$WhichHost = strtok(':');

// if the id is not set same problem
if ($ID == "")
{
	$errmsg = "Error - auth cookie not set corretly (92)";
	$location = "Location: invalidcookie.php";
	LogErr($errmsg, $location);
} 

//----------------------------------------------------------------------------------------------------------
// first open mysql connection to host
//----------------------------------------------------------------------------------------------------------
setHostVariables($WhichHost, $host, $user, $password);

// open connection to host
$conn = mysql_connect($host, $user, $password);
if (!$conn) 
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_connect (193) - '$Medpal'";
	$location = "Location: invalidsql.php";
	LogErr($errmsg, $location);
}

// pick the database to use
if (!mysql_select_db("ClientInfoDB", $conn)) 
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_select_db for ClientInfoDB (194) - '$Medpal'";
	$location = "Location: invalidsql.php";
	LogErr($errmsg, $location);
}	

?>
<html>

<head>
<title>HealthYourSelf Customer File Upload Calander</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />
<style type="text/css"> 

.outerBorderblackSmTxt {
		font: 400 13px Arial, Geneva;
		line-height: 14px; 
		border-top:0px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		background: #ffffff;
		}	

.outerBorderblackfillSiennaSmTxt3 {
		font: 700  13px Arial, Geneva;
		line-height: 15px; 
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		background: #ccccff;
		}	
		
.outerBorderMessageTitleBlue {
		color: white;
		font: 700 13px Arial,Helvetica;
		text-align: center;
		letter-spacing: 8px;
		border-top:1px solid #052faf;
		border-left:1px solid #052faf;
		border-right:1px solid #052faf;
		border-bottom:1px solid #052faf;
		background: #052faf;
		}		

.actionformPos {
		position: absolute;
		left:10px;
		top:180px; 
		width:660px;
		height:60px;
		background-color: white;
		border:0px solid black;
		}	

.outerBorderblackfillSiennaSmTxt {
		font: 400 13px Arial, Geneva;
		line-height: 14px; 
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		background: #ccccff;
		}
		
.SmTxt   { 
		font: 400 13px Arial, Geneva;
		}			
	
</style>		
<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>
		
</head>

<body>

<form name="form1" method="get" action="http://icd9cm.chrisendres.com//index.php" style="margin: 0px">
<table class="outerBorderblackfillSiennaSmTxt3">
	<tr>
		<td align=right>Search</td>
		<td align=left>
			<select name="srchtype">
				<option value="diseases">Diseases and Injuries - Tabular list</option>
				<option value="procs">Procedures</option>
				<option value="drugs">Drugs and Chemicals</option>
				<option value="hcpcs">HCPCS</option>
				<option value="mesh">Medical Dictionary</option>
			</select>
		</td>
	</tr>
	<tr>	
		<td align=right>for</td>
		<td align=left><input type="text" name="srchtext" size="30" maxlength="100" value=""></td>
	</tr>
	<tr>
		<td colspan=2 align=center> <input type="submit" name="Submit" value="Search"></td>
	</tr>
</table>
<input type="hidden" name="action" value="search">
</form>

</body>
</html>
