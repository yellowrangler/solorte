<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_clienthost.php';

require ('hysInitAdminClient.php');

require ('hysDBinit.php');

?>

<html>

<head>
<title>HealthYourSelf Manage Host Information</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />
<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>
<script type="text/javascript">
function startUp() 
{	
	<? print $JavaScriptLogMsg; ?> 
		
	<? print $JavaScriptMsg; ?>
}
</script>

<style type="text/css">	

.leftHostSearch {
		position: absolute;
		left:10px;
		top:38px;
		width:235px;
		height:55px;
		background: white;
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		}
		
.titleHostList {
		position: absolute;
		left:10px;
		top:130px;
		width:232px;
		height:522px;
		background: white;
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		}
		
.innerleftHostList {
		position: absolute;
		left:0px;
		top:20px;
		width:230px;
		height:500px;
		background: white;
		border-top:0px solid black;
		border-left:0px solid black;
		border-right:0px solid black;
		border-bottom:0px solid black;
		}

.leftcontentRest {
		position: absolute;
		left:5px;
		top:580px;
		width:232px;
		height:50px;
		background: #ccccff;;
		border-top:0px solid black;
		border-left:0px solid black;
		border-right:0px solid black;
		border-bottom:1px solid black;
		border:0px  black;
		}		

.clienthostrightcontent {
		position: absolute;
		left:250px;
		top:0px;
		width:500px;
		height:790px;
		background: #ccccff;
		border-top:0px #ccccff;
		border-right:0px #ccccff;
		border-left:0px #ccccff;
		border-bottom:0px #ccccff;
		}
		
.outerBorderTitleGreenLetterSpace {
		color: white;
		font: 700 13px Arial,Helvetica;
		text-align: center;
		letter-spacing: 8px;
		border-top:0px solid #006633;
		border-left:1px solid #006633;
		border-right:1px solid #006633;
		border-bottom:0px solid #006633;
		background: #006633;
		}				
</style>

</head>

<body <? print $BodySelectColor ?> onload="startUp()">

<div class="leftHostSearch">
<form name="search" method="post" ACTION="if_clienthostlist.php" target="ClientHostListFrame">
<!-- Second outer column of Search -->
<table height=20 width="100%" class="outerBorderTitleBlueLetterSpace">
	<tr>
		<td><b>Search</b></td>
	</tr>
</table>
<table height=20 width="100%" class="outerBorderSMtxt">
	<tr>
		<td><input type="text" name="Search" size="25" maxlength="255"></td> 
		<td><INPUT TYPE="IMAGE" SRC="images/go_global_search.gif" ALT="Submit button" border="0"></td>
	</tr>
</table>
<input type='hidden' name='selType'  value='search'>
</form>
</div>

<div class="titleHostList">
<table width="100%" height=20 class="outerBorderTitleGreenLetterSpace">
	<tr>
		<td align="center"><b>Host List</b></td>
	</tr>	
</table>

<IFRAME name="ClientHostListFrame" src="if_clienthostlist.php"  class="innerleftHostList" scrolling="yes"></IFRAME>
</div>

<div align="center" >
<IFRAME name="clienthostmainFrame" src="if_clienthostinfo.php"  class="clienthostrightcontent" scrolling="no" frameborder="0"></IFRAME>
</div>

</body>

</html>
