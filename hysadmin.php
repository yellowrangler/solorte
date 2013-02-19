<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'hysadmin.php';
$selection = 'service';

require ('hysInitAdminClient.php');

require ('hysDBinit.php');

?>
<html>

<head>
<title>HealthYourSelf Manage Account Information</title>
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

.tableTitleClient {
		position: absolute;
		left:10px;
		top:20px; 
		width:202px;
		height:20px;
		}	

.innerleftListClient {
		position: absolute;
		left:10px;
		top:36px;
		width:200px;
		height:100px;
		background: white;
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		}
		
.tableTitleMedUpdate {
		position: absolute;
		left:10px;
		top:138px; 
		width:202px;
		height:20px;
		}	
		
.innerleftListMedUpdate {
		position: absolute;
		left:10px;
		top:154px;
		width:200px;
		height:100px;
		background: white;
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		}

.tableTitleReqestHist {
		position: absolute;
		left:10px;
		top:256px; 
		width:202px;
		height:20px;
		}	
		
.innerleftListReqestHist {
		position: absolute;
		left:10px;
		top:272px;
		width:200px;
		height:100px;
		background: white;
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		}

.tableTitlePersonal {
		position: absolute;
		left:10px;
		top:374px; 
		width:202px;
		height:20px;
		}	
		
.innerleftListPersonal {
		position: absolute;
		left:10px;
		top:390px;
		width:200px;
		height:100px;
		background: white;
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		}

.tableTitleRelationships {
		position: absolute;
		left:10px;
		top:492px; 
		width:202px;
		height:20px;
		}	
		
.innerleftListRelationships {
		position: absolute;
		left:10px;
		top:508px;
		width:200px;
		height:100px;
		background: white;
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		}

.clientname {
		position: absolute;
		left:45px;
		top:750px;
		width:150px;
		height:25px;
		background: red;
		color: yellow;
		border-top:1px solid black;
		border-left:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		}	
			
.outerBorderTitleGreen {
		color: white;
		font: 700 11px Arial,Helvetica;
		text-align: center;
		border-top:1px solid #006633;
		border-left:1px solid #006633;
		border-right:1px solid #006633;
		border-bottom:1px solid #006633;
		background: #006633;
		}	
			
</style>

</head>

<body onload="startUp()">
<? require ('hysTopLegend.php'); ?>

<? require ('hysMainNavAdmin.php'); ?>

<div class="selectedContent">
 
<div class="tableTitleClient">
<table width="100%" cellspacing=0 class="outerBorderTitleGreen">
	<tr>
		<td align="center"><b>Clients View</b></td>
	</tr>	
</table>
</div>

<IFRAME name="listFrameClient" src="if_adminListClient.php"  class="innerleftListClient" scrolling="yes"></IFRAME>

<div class="tableTitleMedUpdate">
<table width="100%" cellspacing=0 class="outerBorderTitleGreen">
	<tr>
		<td align="center"><b>Medical Update</b></td>
	</tr>	
</table>
</div>

<IFRAME name="listFrameMedUpdate" src="if_adminListMedUpdate.php"  class="innerleftListMedUpdate" scrolling="yes"></IFRAME>

<div class="tableTitleReqestHist">
<table width="100%" cellspacing=0 class="outerBorderTitleGreen">
	<tr>
		<td align="center"><b>History</b></td>
	</tr>	
</table>
</div>

<IFRAME name="listFrameRequestHist" src="if_adminListRequestHist.php"  class="innerleftListReqestHist" scrolling="yes"></IFRAME>

<div class="tableTitlePersonal">
<table width="100%" cellspacing=0 class="outerBorderTitleGreen">
	<tr>
		<td align="center"><b>Pesonal Info</b></td>
	</tr>	
</table>
</div>

<IFRAME name="listFramePersonal" src="if_adminListPersonal.php"  class="innerleftListPersonal" scrolling="yes"></IFRAME>

<div class="tableTitleRelationships">
<table width="100%" cellspacing=0 class="outerBorderTitleGreen">
	<tr>
		<td align="center"><b>Relationships</b></td>
	</tr>	
</table>
</div>

<IFRAME name="listFrameRelationships" src="if_adminListRelationships.php"  class="innerleftListRelationships" scrolling="yes"></IFRAME>

<div class="clientname">
<? require ('hysName.php'); ?>
</div>

<div align="center" >
<IFRAME name="mainFrame" src="if_adminintro.php"  class="rightcontent" scrolling="no" frameborder="0"></IFRAME>
</div>
</div>

<? require ('hysFooter.php'); ?>

</body>

</html>
