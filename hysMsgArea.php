<?php

if ($MsgSZcols == "")
{
	$MsgSZcols = "104"; 
}

$DisplayMsg = " 
<table width=\"100%\" class=\"messageboxArea\" cellspacing=0 cellpadding=0>
	<tr>
		<td align=left valign=top><img id=\"moredetail\" height=20 width=20 border=\"0\" src=\"images/inform.gif\"></td>
		<td align=center>
			<input size=".$MsgSZcols." maxlength=".$MsgSZcols." type=\"text\" class=\"messageboxTextcell\" name=\"msgarea\" readonly value=\"".trim($_GET[msgTxt])."\">
		</td>
	</tr>
</table>
";

print $DisplayMsg;
?>
