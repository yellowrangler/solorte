<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------

$module = 'if_UAmedprofInternal.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysStatusMsg.php');

//----------------------------------------------------------------------------------------------------------
// create the SQL statement to get our clients external medical profile.  
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT * from ClientInternalTBL 
		where ClientInternalTBL.MEDPAL = '$Medpal'";
			
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query ClientInternalTBL (195) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------	
// Now lets first see if there is anything to run through.  If more then 1 we have an error
//----------------------------------------------------------------------------------------------------------
$countRows = mysql_num_rows($sql_result);
if ($countRows > 1)
{
	$errmsg = " Error morethen 1 rows returned in select for ClientInternalTBL. count = '$countRows'  - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

//----------------------------------------------------------------------------------------------------------
// now lets fetch for our display
//----------------------------------------------------------------------------------------------------------
$result_array = mysql_fetch_assoc($sql_result);

?>
<html>

<head>
<title>HealthYourSelf Customer IntrMedical Info</title>

<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css"> 
	
.detailArea {
		position: absolute;
		left:20px;
		top:40px; 
		width:650px;
		height:390px;
		background: white;
		border:1px solid black;
		}
		
.outerBorderblackfillSiennaSmTxt {
		font: 400 13px Arial, Geneva;
		line-height: 14px; 
		border-top:0px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		background: #ccccff;
		}	

.outerBorderblackSmTxt {
		font: 400 13px Arial, Geneva;
		line-height: 14px; 
		border-top:0px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		background: #ffffff;
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
		
.SmTxt   { 
		font: 400 13px Arial, Geneva;
		}			
								
</style>

<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>
<script type="text/javascript">
function startUp() 
{	
	<?php print $JavaScriptLogMsg; ?>
		
	<?php print $JavaScriptMsg; ?>
}
</script>
</head>

<body <?php print $BodySelectColor ?> onload="startUp()">
<div class="detailArea">
<form  action="UAmedprofInternal.php" method=post>
<table width="100%" class="outerBorderMessageTitleBlue">
	<tr>
		 <td height=20 align="center">Internal Anatomy Profile</td>
	</tr>	
</table>
<table width="100%" class="SmTxt">
	<tr>
		<td align=right height=20>Systolic Pressure:</td>
		<td align=left><input size=10 maxlength=10 type="text" name="profsys" value="<?php print $result_array[SystolicPressure]; ?>"> </td>
	
		<td align=right height=20>Diastolic Pressure:</td>
		<td align=left><input size=10 maxlength=25 type="text" name="profdias" value="<?php print $result_array[DiastolicPressure]; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=20>Cholesterol LDL:</td>
		<td align=left><input size=4 maxlength=4 type="text" name="profldl" value="<?php print $result_array[LDL]; ?>"> </td>
	
		<td align=right height=20>Cholesterol HDL:</td>
		<td align=left><input size=4 maxlength=4 type="text" name="profhdl" value="<?php print $result_array[HDL]; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=20>Blood Type:</td>
		<td align=left><input size=15 maxlength=25 type="text" name="profbloodtype" value="<?php print $result_array[BloodType]; ?>"> </td>	

		<td align=right height=20>&nbsp;</td>
		<td align=left>&nbsp; </td>
	</tr>
	<tr>
		<td align=right height=20>Skeletal:</td>
		<td align=left colspan=3><input size=60 maxlength=255 type="text" name="profskel" value="<?php print  $result_array[Skeletal]; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=20>Muscular:</td>
		<td align=left colspan=3><input size=60 maxlength=255 type="text" name="profmusc" value="<?php print $result_array[Muscular]; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=20>Digestive:</td>
		<td align=left colspan=3><input size=60 maxlength=255 type="text" name="profdig" value="<?php print  $result_array[Digestive]; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=20>Respiratory:</td>
		<td align=left colspan=3><input size=60 maxlength=255 type="text" name="profresp" value="<?php print $result_array[Respiratory]; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=20>Urinary:</td>
		<td align=left colspan=3><input size=60 maxlength=255 type="text" name="profuring" value="<?php print  $result_array[Urinary]; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=20>Nervous:</td>
		<td align=left colspan=3><input size=60 maxlength=255 type="text" name="profnerv" value="<?php print $result_array[Nervous]; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=20>Circulatory:</td>
		<td align=left colspan=3><input size=60 maxlength=255 type="text" name="profcirc" value="<?php print $result_array[Circulatory]; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=20>Endocrine:</td>
		<td align=left colspan=3><input size=60 maxlength=255 type="text" name="profendo" value="<?php print  $result_array[Endocrine]; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=20>Reproductive:</td>
		<td align=left colspan=3><input size=60 maxlength=255 type="text" name="profrepro" value="<?php print $result_array[Reproductive]; ?>"> </td>
	</tr>
	<tr>
		<td align=right height=20>Immune:</td>
		<td align=left colspan=3><input size=60 maxlength=255 type="text" name="profimm" value="<?php print  $result_array[Immune]; ?>"> </td>
	</tr>
</table>	
<br>
<center>
<table>
	<tr>
		<td align=center><input type=submit size=150 NAME="SUBMIT" VALUE="Submit"></td>
		<td>&nbsp;</td>
		<td align=center><input type=reset size=150 NAME="RESET" VALUE="Reset"></td>
	</tr>
</table>	
</center>	
</form>
</div>

</body>
</html>
