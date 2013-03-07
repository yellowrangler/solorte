<html>

<head>
<title>HealthYourSelf Customer History</title>

<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>
<script type="text/javascript">
function startUp() 
{	
	<?php print $JavaScriptLogMsg; ?>
		
	<?php print $JavaScriptMsg; ?>
}
</script>
</head>

<body onload="startUp()">
<div class="centerSelectServicePos">
<table border=0 width="100%">
	<tr>
		<td valign="bottom" align="left" class="selectServiceHdr">Medical History</td>
	</tr>
</table>
</div>
<div>

<form method="POST" enctype="multipart/form-data">
<div class="headerBorderPos">
<table border=0 width="100%">
	<tr>
		<td valign="bottom" align="right" class="headerBorder"><i>Select Sort and Range Optons</i></td>
	</tr>
</table>
<br>

<table>
	<tr>
		<td  valign="top">
			<table>
				<tr>
					<td  valign="top">Sort By:</td>
					<td>
						<optgroup>
						<SELECT multiple size="4" name="sortby">
							  <OPTION selected value="date">Date</OPTION>
							  <OPTION>Doctor</OPTION>
							  <OPTION>Subject</OPTION>
							  <OPTION>Thread</OPTION>
						   </SELECT>
						</optgroup>
					</td>
				</tr>
			</table>
		</td>
		<td width=5>&nbsp;</td>
		<td>
			<table>
				<tr>
					<td valign="top">Range of Data to Retrieve</td>
					<td>
						<optgroup>
						<SELECT multiple size="7" name="range">
							  <OPTION selected value="1 week">1 Week</OPTION>
							  <OPTION>1 month</OPTION>
							  <OPTION>6 monthsSubject</OPTION>
							  <OPTION>1 year</OPTION>
							  <OPTION>5 years</OPTION>
							  <OPTION>10 years</OPTION>
							  <OPTION>All</OPTION>
						   </SELECT>
						</optgroup>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>	
		<td height=15>&nbsp;</td>
	</tr>
	<tr>	
		<td  align="center"><INPUT type="submit"  onClick="window.centerframef='if_medhist_date_sort.htm'"><INPUT type="reset"></td>
	</tr>
</table>	
<br><br>
</form>

</div>


<IFRAME name="centerframe" src="if_medhist_date_sort.php" width="300" height="800" scrolling="auto" frameborder="0" class="centercontentNext2"> </IFRAME>

</body>
</html>
