<?php

$DisplayMN = " 
<div align=\"left\" id=\"mainNav\" class=\"mainNav\">
<!-- Main navigation menu set -->

<table width=\"100%\" cellspacing=0>
  <tr>";
  
switch ($selection)
	{
		case 'home':
			$DisplayMN .= "
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCellSelect\"> <a href=\"hyscusthome.php\" class=\"mainNavCellSelectAnch\">Information</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCell\"> <a href=\"hysrequest.php\"  class=\"mainNavCellAnch\">Requests</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCell\"> <a href=\"hysupdate.php\"  class=\"mainNavCellAnch\">Add/Update</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCell\"> <a href=\"hysdevices.php\" class=\"mainNavCellAnch\">Devices</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCell\"> <a href=\"hyslibrary.php\" class=\"mainNavCellAnch\">Library</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCell\"> <a href=\"hyscustsrvc.php\" class=\"mainNavCellAnch\">Customer Service</a></td>
				<td class=\"mainNavSpacer\">&nbsp;</td>
				";
			break;
			
		case 'request':
			$DisplayMN .= "
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCell\"> <a href=\"hyscusthome.php\" class=\"mainNavCellAnch\">Information</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCellSelect\"> <a href=\"hysrequest.php\"  class=\"mainNavCellSelectAnch\">Requests</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCell\"> <a href=\"hysupdate.php\"  class=\"mainNavCellAnch\">Add/Update</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCell\"> <a href=\"hysdevices.php\" class=\"mainNavCellAnch\">Devices</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCell\"> <a href=\"hyslibrary.php\" class=\"mainNavCellAnch\">Library</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCell\"> <a href=\"hyscustsrvc.php\" class=\"mainNavCellAnch\">Customer Service</a></td>
				<td class=\"mainNavSpacer\">&nbsp;</td>
				";
			break;
			
		case 'maintain':
				$DisplayMN .= "
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCell\"> <a href=\"hyscusthome.php\" class=\"mainNavCellAnch\">Information</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCell\"> <a href=\"hysrequest.php\"  class=\"mainNavCellAnch\">Requests</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCellSelect\"> <a href=\"hysupdate.php\"  class=\"mainNavCellSelectAnch\">Add/Update</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCell\"> <a href=\"hysdevices.php\" class=\"mainNavCellAnch\">Devices</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCell\"> <a href=\"hyslibrary.php\" class=\"mainNavCellAnch\">Library</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCell\"> <a href=\"hyscustsrvc.php\" class=\"mainNavCellAnch\">Customer Service</a></td>
				<td class=\"mainNavSpacer\">&nbsp;</td>
				";
			break;
			
		case 'service':
			$DisplayMN .= "
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCell\"> <a href=\"hyscusthome.php\" class=\"mainNavCellAnch\">Information</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCell\"> <a href=\"hysrequest.php\"  class=\"mainNavCellAnch\">Requests</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCell\"> <a href=\"hysupdate.php\"  class=\"mainNavCellAnch\">Add/Update</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCell\"> <a href=\"hysdevices.php\" class=\"mainNavCellAnch\">Devices</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCell\"> <a href=\"hyslibrary.php\" class=\"mainNavCellAnch\">Library</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCellSelect\"> <a href=\"hyscustsrvc.php\" class=\"mainNavCellSelectAnch\">Customer Service</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				";
			break;		
			
		case 'devices':
			$DisplayMN .= "
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCell\"> <a href=\"hyscusthome.php\" class=\"mainNavCellAnch\">Information</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCell\"> <a href=\"hysrequest.php\"  class=\"mainNavCellAnch\">Requests</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCell\"> <a href=\"hysupdate.php\"  class=\"mainNavCellAnch\">Add/Update</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCellSelect\"> <a href=\"hysdevices.php\" class=\"mainNavCellSelectAnch\">Devices</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCell\"> <a href=\"hyslibrary.php\" class=\"mainNavCellAnch\">Library</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCell\"> <a href=\"hyscustsrvc.php\" class=\"mainNavCellAnch\">Customer Service</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				";
			break;		
			
		case 'library':
			$DisplayMN .= "
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCell\"> <a href=\"hyscusthome.php\" class=\"mainNavCellAnch\">Information</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCell\"> <a href=\"hysrequest.php\"  class=\"mainNavCellAnch\">Requests</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCell\"> <a href=\"hysupdate.php\"  class=\"mainNavCellAnch\">Add/Update</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCell\"> <a href=\"hysdevices.php\" class=\"mainNavCellAnch\">Devices</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCellSelect\"> <a href=\"hyslibrary.php\" class=\"mainNavCellSelectAnch\">Library</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				<td width=200 class=\"mainNavCell\"> <a href=\"hyscustsrvc.php\" class=\"mainNavCellAnch\">Customer Service</a></td>
				<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
				";
			break;			
	}			
    
$DisplayMN .= "
	</tr>
</table>

</div>
";

print $DisplayMN;
?>
