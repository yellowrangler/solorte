<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_medemrgcont.php';

require ('hysInit.php');

require ('hysDBinit.php');

//----------------------------------------------------------------------------------------------------------
// create the SQL statement
//----------------------------------------------------------------------------------------------------------
$sql = "SELECT AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr, 
	Prefix, FirstName, MI, LastName, Suffix, RelationsID, RelationshipType,
	MobilePhone, ClientEmergContactsTBL.OrderID as CECOrderID, ClientEmergContactsTBL.ID as CECID
	from ClientEmergContactsTBL 
	left join FullNameTBL  on ClientEmergContactsTBL.FullNameID = FullNameTBL.ID
	left join AddrTBL  on ClientEmergContactsTBL.AddrID = AddrTBL.ID
	left join RelationshipTypeTBL on ClientEmergContactsTBL.RelationsID = RelationshipTypeTBL.ID
		where (ClientEmergContactsTBL.MEDPAL = '$Medpal') 
		ORDER BY ClientEmergContactsTBL.OrderID";
	
if (!$sql_result = mysql_query($sql, $conn))
{
	$sqlerr = mysql_error();
	$errmsg = "$sqlerr - Error doing mysql_query join for ClientEmergContactsTBL, AddrTBL and FullNameTBL (195) - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}

//----------------------------------------------------------------------------------------------------------
// Now lets first see if there is anything to run through.  If more then 2 we have an error
//----------------------------------------------------------------------------------------------------------
$countRows = mysql_num_rows($sql_result);
if ($countRows > 2)
{
	$errmsg = " Error more then 2 rows returned in select on ClientEmergContactsTBL. count = '$countRows'  - '$Medpal'";
	$location = "";
	$severity = 1;	
	$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
	LogErr($shortmsg, $errmsg, $location, $module, $severity);
}	

//----------------------------------------------------------------------------------------------------------
// lets initialize our variables
//----------------------------------------------------------------------------------------------------------

while ($result_array = mysql_fetch_assoc($sql_result))
{
	
	//------------------------------------------------------------------------------------------------------
	// lets start assigning values to our display fields
	//------------------------------------------------------------------------------------------------------
	$KeyIndex = $result_array[CECOrderID];
	
	$Prefix[$KeyIndex] = $result_array[Prefix];
	$FirstName[$KeyIndex] = $result_array[FirstName];
	$MI[$KeyIndex] = $result_array[MI];
	$LastName[$KeyIndex] = $result_array[LastName];
	$Suffix[$KeyIndex] = $result_array[Suffix];
	$AddrL1[$KeyIndex] = $result_array[AddrLine1];
	$AddrL2[$KeyIndex] = $result_array[AddrLine2];
	$City[$KeyIndex] = $result_array[City];
	$State[$KeyIndex] = $result_array[State];
	$ZIP[$KeyIndex] = $result_array[ZIP];
	$Relationship[$KeyIndex] = $result_array[RelationshipType];
	$RelationshipID[$KeyIndex] = $result_array[RelationsID];
	$PhoneNbr[$KeyIndex] = $result_array[PhoneNbr];
	$MobileNbr[$KeyIndex] = $result_array[MobilePhone];
			
}  // End of While	

// set our readonly variable
$readonly = "class =\"readonlyText\" readonly";
?>
<html>

<head>
<title>HealthYourSelf Customer Intro</title>

<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />
<style type="text/css"> 

.primaryContactArea {
		position: absolute;
		left:20px;
		top:35px;
		width:650px;
		height:315px;
		border-top:1px solid black;
		border-right:1px solid black;
		border-left:1px solid black;
		border-bottom:1px solid black;
		border:1px solid black;
		background: white;
		}

.secondaryContactArea {
		position: absolute;
		left:20px;
		top:385px;
		width:650px;
		height:315px;
		border-top:1px solid black;
		border-right:1px solid black;
		border-left:1px solid black;
		border-bottom:1px solid black;
		border:1px solid black;
		background: white;
		}
		
		
.tableTextName {
		font: 400 13px Arial, Geneva;
		line-height: 15px; 
		border-top:1px solid black;
		border-right:1px solid black;
		border-left:1px solid black;
		border-bottom:1px solid black;
		background: white;
		}
		
.tableHdrRow {
		font: 400 13px Arial, Geneva;
		line-height: 15px; 
		border-top:1px solid black;
		border-right:1px solid black;
		border-left:1px solid black;
		border-bottom:1px solid black;
		color:black;
		background: #99FFCC;
		}		
		
.tableText {
		font: 400 13px Arial, Geneva;
		line-height: 15px; 
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
<div class="primaryContactArea">
<form  method=post>
<table width="100%" class="outerBorderMessageTitleBlue">
	<tr>
		 <td height=20 align="center">Primary Emergency Medical Contact</td>
	</tr>	
</table>
<br>
<center>
<table class="tableTextName" border=0>
	<tr class="tableHdrRow">
		<td align=center><b>Prefix</b></td>
		<td align=center><b>First Name</b></td>
		<td align=center><b>MI</b></td>
		<td align=center><b>LastName</b></td>
		<td align=center><b>Suffix</b></td>
	</tr>	
	<tr>
		<td align=center><input <?php print $readonly; ?> size=3 maxlength=5 type="text" name="prefix" value="<?php print $Prefix[1]; ?>"></td>
		<td align=center><input <?php print $readonly; ?> size=15 maxlength=45 type="text" name="firstname" value="<?php print $FirstName[1]; ?>"></td>
		<td align=center><input <?php print $readonly; ?> size=1 maxlength=1 type="text" name="mi" value="<?php print $MI[1]; ?>"></td>
		<td align=center><input <?php print $readonly; ?> size=15 maxlength=45 type="text" name="lastname" value="<?php print $LastName[1]; ?>"></td>
		<td align=center><input <?php print $readonly; ?> size=3 maxlength=5 type="text" name="suffix" value="<?php print $Suffix[1]; ?>"></td>
	</tr>	 
</table>

<br>
</center>
<table width="100%" class="tblDetailsmTextOff">
	<tr>
		<td  height=30 align=right>Address:</td>
		<td  height=30 align=left colspan=2><input <?php print $readonly; ?> size=20 maxlength=255 type="text" name="addr1" value="<?php print $AddrL1[1]; ?>"></td>
	</tr> 
	
		<tr>
		<td  height=30 align=right>&nbsp;</td>
		<td  height=30 align=left colspan=2><input <?php print $readonly; ?> size=20 maxlength=255 type="text" name="addr2" value="<?php print $AddrL2[1]; ?>"></td>
	</tr> 
	
	<tr>
		<td align=right>City:</td>
		<td  height=30 align=left><input <?php print $readonly; ?> size=15 maxlength=45 type="text" name="city" value="<?php print $City[1]; ?>"></td>
		
		<td align=right>State:</td>
		<td  height=30 align=left><input <?php print $readonly; ?> size=2 maxlength=2 type="text" name="state" value="<?php print $State[1]; ?>"></td>
		
		<td align=right>ZIP:</td>
		<td  height=30 align=left><input <?php print $readonly; ?> size=5 maxlength=10 type="text" name="zip" value="<?php print $ZIP[1]; ?>"></td>
	</tr>
	
	<tr>
		<td height=30 align=right>Relationship:</td>
		<td align=left colspan=2><input <?php print $readonly; ?> size=20 maxlength=45 type="text" name="relations" value="<?php print $Relationship[1]; ?>"></td>
	</tr>
	
	<tr>
		<td align=right>Phone Nbr:</td>
		<td  height=30 align=left colspan=2><input <?php print $readonly; ?> size=15 maxlength=15 type="text" name="phonenbr" value="<?php print $PhoneNbr[1]; ?>"></td>
		
		<td align=right>Mobile Nbr:</td>
		<td  height=30 align=lef colspan=2><input <?php print $readonly; ?> size=15 maxlength=15 type="text" name="mobilenbr" value="<?php print $MobileNbr[1]; ?>"></td>
	</tr>

</table>
</form>
</div>

<div class="secondaryContactArea">
<form  action="UAmedemrgcont.php" method=post>
<table width="100%" class="outerBorderMessageTitleBlue">
	<tr>
		 <td height=20 align="center">Secondary Emergency Medical Contact</td>
	</tr>	
</table>
<br>
<center>
<table class="tableTextName" border=0>
	<tr class="tableHdrRow">
		<td align=center><b>Prefix</b></td>
		<td align=center><b>First Name</b></td>
		<td align=center><b>MI</b></td>
		<td align=center><b>LastName</b></td>
		<td align=center><b>Suffix</b></td>
	</tr>	
	<tr>
		<td align=center><input <?php print $readonly; ?>  size=3 maxlength=5 type="text" name="prefix" value="<?php print $Prefix[2]; ?>"></td>
		<td align=center><input <?php print $readonly; ?>  size=15 maxlength=45 type="text" name="firstname" value="<?php print $FirstName[2]; ?>"></td>
		<td align=center><input <?php print $readonly; ?>  size=1 maxlength=1 type="text" name="mi" value="<?php print $MI[2]; ?>"></td>
		<td align=center><input <?php print $readonly; ?>  size=15 maxlength=45 type="text" name="lastname" value="<?php print $LastName[2]; ?>"></td>
		<td align=center><input <?php print $readonly; ?>  size=3 maxlength=5 type="text" name="suffix" value="<?php print $Suffix[2]; ?>"></td>
	</tr>	 
</table>

<br>
</center>
<table width="100%" class="tblDetailsmTextOff">
	<tr>
		<td  height=30 align=right>Address:</td>
		<td  height=30 align=left colspan=2><input <?php print $readonly; ?>  size=20 maxlength=255 type="text" name="addr1" value="<?php print $AddrL1[2]; ?>"></td>
	</tr> 
	
	<tr>
		<td  height=30 align=right>&nbsp;</td>
		<td  height=30 align=left colspan=2><input <?php print $readonly; ?>  size=20 maxlength=255 type="text" name="addr2" value="<?php print $AddrL2[2]; ?>"></td>
	</tr> 
	
	<tr>
		<td align=right>City:</td>
		<td  height=30 align=left><input <?php print $readonly; ?>  size=15 maxlength=45 type="text" name="city" value="<?php print $City[2]; ?>"></td>
		
		<td align=right>State:</td>
		<td  height=30 align=left><input <?php print $readonly; ?>  size=2 maxlength=2 type="text" name="state" value="<?php print $State[2]; ?>"></td>
		
		<td align=right>ZIP:</td>
		<td  height=30 align=left><input <?php print $readonly; ?>  size=5 maxlength=10 type="text" name="zip" value="<?php print $ZIP[2]; ?>"></td>
	</tr>
	
	<tr>
		<td height=30 align=right>Relationship:</td>
		<td align=left colspan=2><input <?php print $readonly; ?> size=20 maxlength=45 type="text" name="relations" value="<?php print $Relationship[2]; ?>"></td>
	</tr>
	
	<tr>
		<td align=right>Phone Nbr:</td>
		<td  height=30 align=left colspan=2><input <?php print $readonly; ?>  size=15 maxlength=15 type="text" name="phonenbr" value="<?php print $PhoneNbr[2]; ?>"></td>
		
		<td align=right>Mobile Nbr:</td>
		<td  height=30 align=lef colspan=2><input <?php print $readonly; ?>  size=15 maxlength=15 type="text" name="mobilenbr" value="<?php print $MobileNbr[2]; ?>"></td>
	</tr>

</table>
</form>
</div>

</body>
</html>
