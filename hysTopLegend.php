<?php

if ($MedpalList == 'Y')
{
	$DisplayTBLrowItem = "<a href=\"hysmedpalSelect.php\">List</a>";
}
else
{
	$DisplayTBLrowItem = "&nbsp;";
}	

switch ($UserType)
{
	case $DisplayCustomerServiceType:
		$DisplayLogof = "hyslogoffAdmin.php";
		$DisplayIcon = "<img border=0 src=\"images/custsup.gif\" width=25 height=25>";
		break;
		
	case $DisplayClientType:
		$DisplayLogof = "hyslogoff.php";
		$DisplayIcon = "&nbsp;";
		break;
	
	case $DisplayPharmacyType:
		$DisplayLogof = "hyslogoff.php";
		$DisplayIcon = "&nbsp;";
		break;
		
	case $DisplayProviderType:
		$DisplayLogof = "hyslogoff.php";
		$DisplayIcon = "&nbsp;";
		break;
		
	case $DisplayUserProxyType:
		$DisplayLogof = "hyslogoff.php";
		$DisplayIcon = "&nbsp;";
		break;
		
} //End of switch

	
$DisplayTL = "
<!-- Top most nav bar has heading and logout/help  -->
<div id=\"banner\" class=\"banner\">
<table width=\"100%\" border=0 cellspacing=0 cellpadding=0>
	<tr>
      <td align=left><img border=0 src=\"images/healthyourselflogo.JPG\"></td>
      <td width=150 align=center class=\"smallTextLegend\"><a href=\"".$DisplayLogof."\">Logout</a></td>
	  <td width=150 align=center class=\"smallTextLegend\">".$DisplayTBLrowItem."</td>
	  <td width=150 align=center class=\"smallTextLegend\"><a href=\"#\" OnClick=\"printDoc()\">Print Page</a></td>
	  <td width=150 valign=center align=center class=\"smallTextLegend\">".$DisplayIcon."</td>
      <td width=150 align=center class=\"smallTextLegend\"><a href=\"#\"  onClick=\"(PopUpWindow('puhelp.php?selection=".$selection."', 'r', 3))\">Help</a></td>
	  <td width=175 align=right class=\"smallTextLegend\">".currDate()."</td>
  </tr>
</table>
</div>
";

print $DisplayTL;
?>
