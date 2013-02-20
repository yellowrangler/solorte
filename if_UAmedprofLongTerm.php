<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------

$module = 'if_UAmedprofLongTerm.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysStatusMsg.php');

//----------------------------------------------------------------------------------------------------------
// create the SQL statement to get our clients cronic medical profile.  
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT * from ClientCronicConditionTBL 
		where (ClientCronicConditionTBL.MEDPAL = '$Medpal') 
		order by OrderID";
			
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query ClientCronicConditionTBL (195) - '$Medpal'";
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	$location = "";
	$severity = 1;
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------	
// Now lets first build our table header  
//----------------------------------------------------------------------------------------------------------
$DisplayBlock = "";
$DisplayBlock .= "\t<tr>\n";

$DisplayBlock .= "\t\t<td width=\"10%\" height=20 align=center><b>Nbr</b></td>\n";
$DisplayBlock .= "\t\t<td align=center><b>Description</b></td>\n";

$DisplayBlock .= "\t</tr>\n";

//----------------------------------------------------------------------------------------------------------	
// Now lets first see if there is anything to run through.  
//----------------------------------------------------------------------------------------------------------
$i = 1;

$countRows = mysql_num_rows($sql_result);
if ($countRows > 0)
{
	//------------------------------------------------------------------------------------------------------
	// now lets fetch and build our display
	//------------------------------------------------------------------------------------------------------
	while ($result_array = mysql_fetch_assoc($sql_result))
	{
		// lets build display block for cronic conditions
		$DisplayBlock .= "\t<tr>\n";
		
		$DisplayBlock .= "\t\t<td width=\"10%\" height=20 align=right><input size=2 maxlength=2 type=\"text\" name=\"profcronorder".$i."\" value=\"".$result_array[OrderID]."\">: </td>\n";
		$DisplayBlock .= "\t\t<td align=left><input size=70 maxlength=255 type=\"text\" name=\"profcronic".$i."\" value=\"". $result_array[Condition]."\"></td>\n";
		
		$DisplayBlock .= "\t</tr>\n";
		
		$i++;
	}
}

while ($i < 13)
{
	// lets build empty display block for cronic conditions
	$DisplayBlock .= "\t<tr>\n";
	
	$DisplayBlock .= "\t\t<td width=\"10%\" height=20 align=right><input size=2 maxlength=2 type=\"text\" name=\"profcronorder".$i."\" value=\"".$i."\">: </td>\n";
	$DisplayBlock .= "\t\t<td align=left><input size=70 maxlength=255 type=\"text\" name=\"profcronic".$i."\" value=\"None\"></td>\n";
	
	$DisplayBlock .= "\t</tr>\n";
	
	$i++;
}	

?>
<html>

<head>
<title>HealthYourSelf Customer Long Term Info</title>

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
<form  action="UAmedprofLongTerm.php" method=post>
<table width="100%" class="outerBorderMessageTitleBlue">
	<tr>
		 <td height=20 align="center">Long Term Profile</td>
	</tr>	
</table>
<table width="100%" class="SmTxt">
	<?php print $DisplayBlock; ?>
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
