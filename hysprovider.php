<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'hysprovider.php';
$selection = 'provider';

require ('hysInitAdmin.php');

require ('hysDBinit.php');

?>

<html>

<head>
<title>HealthYourSelf Manage Provider Information</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />
<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>
<script type="text/javascript">
function startUp() 
{
	<?php print $JavaScriptLogMsg; ?>
	
	<?php print $JavaScriptMsg; ?>
}
</script>

<style type="text/css">	

.leftProviderSearch {
		position: absolute;
		left:10px;
		top:38px;
		width:230px;
		height:55px;
		background: white;
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		}
		
.titleProviderList {
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

.daButtons {
		position: absolute;
		left:10px;
		top:670px;
		width:232px;
		height:30px;
		}
		
.innerleftProviderList {
		position: absolute;
		left:0px;
		top:30px;
		width:230px;
		height:490px;
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
		width:240px;
		height:50px;
		background: #ccccff;;
		border-top:0px solid black;
		border-left:0px solid black;
		border-right:0px solid black;
		border-bottom:1px solid black;
		border:0px  black;
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

<body onload="startUp()">
<?php require ('hysTopLegend.php'); ?>

<?php require ('hysMainNavAdmin.php'); ?>

<div class="selectedContent">

<div class="leftProviderSearch">
<form name="search" method="post" ACTION="if_providerlist.php" target="ProviderListFrame">
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

<div class="titleProviderList">
<table width="100%" height=20 class="outerBorderTitleGreenLetterSpace">
	<tr>
		<td align="center"><b>Provider List</b></td>
	</tr>	
</table>

<IFRAME name="ProviderListFrame" src="if_providerlist.php"  class="innerleftProviderList" scrolling="yes"></IFRAME>
</div>

<div class="daButtons">
<center>
<form name="refresh" method="post" ACTION="if_providerlist.php" target="ProviderListFrame">
<table>
	<tr>
		<td align=center><input type=submit size=150 NAME="SUBMIT" VALUE="Refresh List"></td> 
	</tr>
</table>
<input type='hidden' name='dummy'  value=''>
</form>

<form name="select" method="post" ACTION="if_providerinfo.php" target="mainFrame">
<table>
	<tr>
		<td align=center><input type=submit size=150 NAME="SUBMIT" VALUE="Add Provider"></td> 
	</tr>
</table>
<input type='hidden' name='dummy'  value=''>
</form>

</center>
</div>

<div align="center" >
<IFRAME name="mainFrame" src="if_providerinfo.php"  class="rightcontent" scrolling="no" frameborder="0"></IFRAME>
</div>
</div>

<?php require ('hysFooter.php'); ?>

</body>

</html>
