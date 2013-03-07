<?php

$DisplayMN = " 
<div align=\"left\" id=\"mainNav\" class=\"mainNav\">
<!-- Main navigation menu set -->

<table width=\"100%\" cellspacing=0>
  <tr>";
  
switch ($selection)
{		
	case 'select':
		$DisplayMN .= "
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCellSelect\"> <a href=\"hysclient.php\" class=\"mainNavCellSelectAnch\">Client Start</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysadmin.php\" class=\"mainNavCellAnch\">Client Admin</a></td>
			<td class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysprovider.php\" class=\"mainNavCellAnch\">Provider</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysuser.php\" class=\"mainNavCellAnch\">Users</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hyshost.php\" class=\"mainNavCellAnch\">Host</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hyspayor.php\" class=\"mainNavCellAnch\">Payor</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hyspharmacy.php\" class=\"mainNavCellAnch\">Pharmacy</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysutility.php\" class=\"mainNavCellAnch\">Utilities</a></td>
			<td class=\"mainNavSpacer\">&nbsp;</td>
			";
		break;
	case 'service':
		$DisplayMN .= "
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysclient.php\" class=\"mainNavCellAnch\">Client Start</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCellSelect\"> <a href=\"hysadmin.php\" class=\"mainNavCellSelectAnch\">Client Admin</a></td>
			<td class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysprovider.php\" class=\"mainNavCellAnch\">Provider</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysuser.php\" class=\"mainNavCellAnch\">Users</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hyshost.php\" class=\"mainNavCellAnch\">Host</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hyspayor.php\" class=\"mainNavCellAnch\">Payor</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hyspharmacy.php\" class=\"mainNavCellAnch\">Pharmacy</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysutility.php\" class=\"mainNavCellAnch\">Utilities</a></td>
			<td class=\"mainNavSpacer\">&nbsp;</td>
			";
		break;
		
	case 'provider':
		$DisplayMN .= "
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysclient.php\" class=\"mainNavCellAnch\">Client Start</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysadmin.php\" class=\"mainNavCellAnch\">Client Admin</a></td>
			<td class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCellSelect\"> <a href=\"hysprovider.php\" class=\"mainNavCellSelectAnch\">Provider</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysuser.php\" class=\"mainNavCellAnch\">Users</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hyshost.php\" class=\"mainNavCellAnch\">Host</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hyspayor.php\" class=\"mainNavCellAnch\">Payor</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hyspharmacy.php\" class=\"mainNavCellAnch\">Pharmacy</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysutility.php\" class=\"mainNavCellAnch\">Utilities</a></td>
			<td class=\"mainNavSpacer\">&nbsp;</td>
			";
		break;
		
	case 'user':
		$DisplayMN .= "
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysclient.php\" class=\"mainNavCellAnch\">Client Start</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysadmin.php\" class=\"mainNavCellAnch\">Client Admin</a></td>
			<td class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysprovider.php\" class=\"mainNavCellAnch\">Provider</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCellSelect\"> <a href=\"hysuser.php\" class=\"mainNavCellSelectAnch\">Users</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hyshost.php\" class=\"mainNavCellAnch\">Host</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hyspayor.php\" class=\"mainNavCellAnch\">Payor</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hyspharmacy.php\" class=\"mainNavCellAnch\">Pharmacy</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysutility.php\" class=\"mainNavCellAnch\">Utilities</a></td>
			<td class=\"mainNavSpacer\">&nbsp;</td>
			";
		break;	
		
	case 'host':
		$DisplayMN .= "
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysclient.php\" class=\"mainNavCellAnch\">Client Start</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysadmin.php\" class=\"mainNavCellAnch\">Client Admin</a></td>
			<td class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysprovider.php\" class=\"mainNavCellAnch\">Provider</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysuser.php\" class=\"mainNavCellAnch\">Users</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCellSelect\"> <a href=\"hyshost.php\" class=\"mainNavCellSelectAnch\">Host</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hyspayor.php\" class=\"mainNavCellAnch\">Payor</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hyspharmacy.php\" class=\"mainNavCellAnch\">Pharmacy</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysutility.php\" class=\"mainNavCellAnch\">Utilities</a></td>
			<td class=\"mainNavSpacer\">&nbsp;</td>
			";
		break;
		
	case 'payor':
		$DisplayMN .= "
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysclient.php\" class=\"mainNavCellAnch\">Client Start</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysadmin.php\" class=\"mainNavCellAnch\">Client Admin</a></td>
			<td class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysprovider.php\" class=\"mainNavCellAnch\">Provider</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysuser.php\" class=\"mainNavCellAnch\">Users</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hyshost.php\" class=\"mainNavCellAnch\">Host</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCellSelect\"> <a href=\"hyspayor.php\" class=\"mainNavCellSelectAnch\">Payor</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hyspharmacy.php\" class=\"mainNavCellAnch\">Pharmacy</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysutility.php\" class=\"mainNavCellAnch\">Utilities</a></td>
			<td class=\"mainNavSpacer\">&nbsp;</td>
			";
		break;
		
	case 'pharmacy':
		$DisplayMN .= "
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysclient.php\" class=\"mainNavCellAnch\">Client Start</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysadmin.php\" class=\"mainNavCellAnch\">Client Admin</a></td>
			<td class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysprovider.php\" class=\"mainNavCellAnch\">Provider</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysuser.php\" class=\"mainNavCellAnch\">Users</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hyshost.php\" class=\"mainNavCellAnch\">Host</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hyspayor.php\" class=\"mainNavCellAnch\">Payor</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCellSelect\"> <a href=\"hyspharmacy.php\" class=\"mainNavCellSelectAnch\">Pharmacy</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysutility.php\" class=\"mainNavCellAnch\">Utilities</a></td>
			<td class=\"mainNavSpacer\">&nbsp;</td>
			";
		break;	

	case 'utility':
		$DisplayMN .= "
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysclient.php\" class=\"mainNavCellAnch\">Client Start</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysadmin.php\" class=\"mainNavCellAnch\">Client Admin</a></td>
			<td class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysprovider.php\" class=\"mainNavCellAnch\">Provider</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hysuser.php\" class=\"mainNavCellAnch\">Users</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hyshost.php\" class=\"mainNavCellAnch\">Host</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hyspayor.php\" class=\"mainNavCellAnch\">Payor</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCell\"> <a href=\"hyspharmacy.php\" class=\"mainNavCellAnch\">Pharmacy</a></td>
			<td width=7 class=\"mainNavSpacer\">&nbsp;</td>
			<td width=200 class=\"mainNavCellSelect\"> <a href=\"hysutility.php\" class=\"mainNavCellSelectAnch\">Utilities</a></td>
			<td class=\"mainNavSpacer\">&nbsp;</td>
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
