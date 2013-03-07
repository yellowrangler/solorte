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
			$user = "hysuser";
			$password = "pearl";
			break;
			
		case 3:
			$host = "localhost";
			$user = "root";
			$password = "tarryc";
			break;
			
		case 4:
			$host = "localhost";
			$user = "root";
			$password = "tarryc";
			break;	
	}			
	
}  // end of func

$DataBase = "clientinfodb";

setHostVariables($WhichHost, $host, $user, $password);

// open connection to host
$conn = mysql_connect($host, $user, $password);
if (!$conn) 
{
	$sqlerr = mysql_error();
	$errmsg =  "$sqlerr - Error doing mysql_connect (93) - '$Medpal'";
	$location = "Location: invalidsql.php";
	LogErrSevere($errmsg, $location);
}

// pick the database to use
if (!mysql_select_db($DataBase, $conn)) 
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_select_db for clientinfodb (94) - '$Medpal'";
	$location = "Location: invalidsql.php";
	LogErrSevere($errmsg, $location);
}	
?>
