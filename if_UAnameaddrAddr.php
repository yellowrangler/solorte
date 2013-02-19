<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_UAnameaddrAddr.php';

require ('hysInit.php');

?>
<html>

<head>
<title>HealthYourSelf Customer Address</title>

<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>

<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css"> 

.tableTitlepos {
		position: absolute;
		left:20px;
		top:45px; 
		width:652px;
		height:20px;
		}		
		
.outerBorderTitleBlue {
		color: white;
		font: 700 13px Arial,Helvetica;
		text-align: center;
		border-top:1px solid #052faf;
		border-left:1px solid #052faf;
		border-right:1px solid #052faf;
		border-bottom:1px solid #052faf;
		background: #052faf;	
		}	
				
.innerSelectframe {
		position: absolute;
		left:20px;
		top:65px; 
		width:650px;
		height:90px;
		background-color: white;
		border:1px solid black;
		}

.buttonPos {
		position: absolute;
		left:10px;
		top:165px; 
		width:660px;
		height:20px;
		border:0px solid black;
		}
			
.addrDetail {

		position: absolute;
		left:20px;
		top:200px; 
		width:680px;
		height:950px;
		background: #ccccff;
		border:0px #ccccff;
		}					
		
}						
</style>

<script type="text/javascript">
function startUp() 
{	
	<? print $JavaScriptLogMsg; ?> 
		
	<? print $JavaScriptMsg; ?>
}
</script> 
</head>

<body <? print $BodySelectColor ?> onload="startUp()">
<div class="tableTitlepos">
<table width="100%"  class="outerBorderTitleBlue">
	<tr>
		 <td width="10%" align="center" height="10">Select</td>
		 <td width="10%" align="center" height="10">Order</td>
		 <td width="35%" align="center" height="10">Address</td>
		 <td width="25%" align="center" height="10">City</td>
		 <td width="10%" align="center" height="10">State</td>
		 <td width="10%" align="center" height="10">ZIP</td>
	</tr>	
</table>
</div>
 
<IFRAME name="addrlistFrame" src="if_UAnameaddrAddrlist.php" scrolling=auto frameborder=0 class="innerSelectframe"></IFRAME>

<form class="buttonPos" action="if_UAnameaddrAddrlist.php" target="addrlistFrame" method=post> 
<center><input type=submit NAME="RefreshList" VALUE="Refresh List"></center>
</form>

<iframe name="addrdetailFrame" src="if_UAnameaddrAddrdetail.php" scrolling=auto frameborder=0 class="addrDetail"> </iframe>

</body>
</html>
