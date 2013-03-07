<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'pudoctor.php';

require ('hysInit.php');

require ('hysDBinit.php');

// create the SQL statement to get provider information. We will use the id passed to us			
if (isset($_GET[HostID]) && ($_GET[HostID] != "") )
{
	$sql = "SELECT Description, Name, Map, URL, EmergNbr, HostTBL.ID as HostID,
		FirstName, MI, LastName, Suffix
			from ProviderTBL, HostTBL 
				inner join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID 
				inner join SpecTypeTBL on ProviderTBL.SpecialtyID = SpecTypeTBL.ID
					where (ProviderTBL.ID = '$_GET[ProviderID]' and HostTBL.ID = '$_GET[HostID]')";
}
else
{
	$sql = "SELECT Description, Name, Map, URL, EmergNbr, HostID,
		FirstName, MI, LastName, Suffix
			from ProviderTBL 
				inner join FullNameTBL on ProviderTBL.FullNameID = FullNameTBL.ID 
				inner join SpecTypeTBL on ProviderTBL.SpecialtyID = SpecTypeTBL.ID
				inner join ProviderHostTBL on ProviderHostTBL.ProviderID = ProviderTBL.ID
				inner join HostTBL on ProviderHostTBL.HostID = HostTBL.ID 
					where (ProviderTBL.ID = '$_GET[ProviderID]' and ProviderHostTBL.OrderID = '1')";
}			
			
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query join for provider, full name, spectype, ProviderHostTBL and host (195) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}
	
// Now lets first see if there is anything to run through.  If more then 1 we have an error
$countRows = mysql_num_rows($sql_result);
if ($countRows != 1)
{
	$errmsg = " Error more or less then 1 rows returned in select on join for provider, full name, spectype and host. count = '$countRows'  - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

// now lets fetch and build our display
$result_array = mysql_fetch_assoc($sql_result);

// lets initialize our display variables
$ProviderName = "Not Supplied";
$ProviderSpecialty = "Not Supplied";
$HostName = "Non Supplied";
$HostMap = "";
$HostURL = "";

// lets start assigning values to our display fields
$ProviderSpecialty = $result_array[Description];
$HostName = $result_array[Name];
$HostMap = $result_array[Map];
$HostURL = $result_array[URL];
$HostEmergNbr = $result_array[EmergNbr];

// set up temp variables
$tmpHostID = $result_array[HostID];

// $tmpPrefix = trim($result_array[Prefix]);
$tmpFirstName = trim($result_array[FirstName]);
$tmpMI = trim($result_array[MI]);
$tmpLastName = trim($result_array[LastName]);
$tmpSuffix = trim($result_array[Suffix]);
$tmpString = sprintf("%s %s %s %s", $tmpFirstName, $tmpMI, $tmpLastName, $tmpSuffix);
$Provider = $tmpString; 

// create the SQL statement to get host addr information
$sql = "SELECT * from HostTBL inner join AddrTBL on HostTBL.AddrID = AddrTBL.ID where (HostTBL.ID = '$tmpHostID')";
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query join for host and addr (195) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}
	
// Now lets first see if there is anything to run through.  If more then 1 we have an error
$countRows = mysql_num_rows($sql_result);
if ($countRows != 1)
{
	$errmsg = " Error more or less then 1 rows returned in select on join for host and addr. count = '$countRows'  - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

// now lets fetch and build our display
$result_array = mysql_fetch_assoc($sql_result);

$DisplayBlock .= "<table>\n\t<tr>\n\t\t<td class=\"ArticleHeader\"><b>".$Provider."</b></td>\n\t</tr>\n";
$DisplayBlock .= "\t<tr>\n\t\t<td class=\"smallText2\"><i>".$ProviderSpecialty."</i></td>\n\t</tr>\n</table>\n<br><br>\n";
$DisplayBlock .= "<table>\n\t<tr>\n\t\t<td class=\"smallText2\"><b>".$HostName."</b></td>\n\t</tr>\n";
$DisplayBlock .= "\t<tr>\n\t\t<td class=\"smallText2\">".$result_array[AddrLine1]."</td>\n\t</tr>\n";
$DisplayBlock .= "\t<tr>\n\t\t<td class=\"smallText2\">".$result_array[City].", ".$result_array[State]." ".$result_array[Zip]."</td>\n\t</tr>\n";
$DisplayBlock .= "\t<tr>\n\t\t<td class=\"smallText2\">Phone: ".$result_array[PhoneNbr]."</td>\n\t</tr>\n";
$DisplayBlock .= "\t<tr><td>&nbsp;</td></tr>\n";
$DisplayBlock .= "\t<tr>\n\t\t<td>\n";
$DisplayBlock .= "<a href=\"#\" onClick=\"(PopUpWindow('http://www.mapquest.com/maps/map.adp?country=US&addtohistory=&address=".$result_array[AddrLine1]."&city=".$result_array[City]."&state=".$result_array[State]."&zipcode=".$result_array[Zip]."&homesubmit=Get+Map', 'f', '2'))\">Map</a></td>\n\t</tr>\n";
$DisplayBlock .= "\t<tr><td>&nbsp;</td></tr>\n</table>\n";

// this could be alternative mapping resource http://maps.yahoo.com/maps_result?&csz=Reading+MA+01867&country=us


?>
<html>
<head>
<title>Pop-Up Information</title>
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

<script language="JavaScript" type="text/javascript" src="hyspufunc.js"> </script>

</head>

<body>

<div id="PUbanner" class="PUbanner">
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

<?php print $DisplayBlock; ?>
 	
</div>

</body>
</html>		