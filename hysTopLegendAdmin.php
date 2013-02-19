<?php


$DisplayTL = "
<!-- Top most nav bar has heading and logout/help  -->
<div id=\"banner\" class=\"banner\">
<table width=\"100%\" border=0 cellspacing=0 cellpadding=0>
	<tr>
		<td align=left><img border=0 src=\"images/healthyourselflogo.JPG\"></td>
	    <td width=150 valign=center align=center class=\"smallTextLegend\"><a href=\"gotohome.php\"><img border=0 src=\"images/home.gif\" width=20 height=20></a></td>
	    <td width=150 align=center class=\"smallTextLegend\"><a href=\"hyslogoffAdmin.php\">Logout</a></td>
	    <td width=150 align=center class=\"smallTextLegend\"><a href=\"#\" OnClick=\"printDoc()\">Print Page</a></td>
        <td width=150 align=center class=\"smallTextLegend\"><a href=\"http://hyshelp.php\">Help</a></td>
		<td width=150 valign=center align=center class=\"smallTextLegend\"><img border=0 src=\"images/custsup.gif\" width=25 height=25></td>
	    <td width=175 align=right class=\"smallTextLegend\">".currDate()."</td>
  </tr>
</table>
</div>
";

print $DisplayTL;
?>
