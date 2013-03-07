<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'hysEmpty.php';
$selection = 'request';

require ('hysInit.php');

require ('hysDBinit.php');

if ($AuthorizationLevel == 1)
{
	$DisplayAuthorizedLinks = "
		<tr>
			<td valign=center class=\"leftLink\" align=center height=25>&nbsp;</td>
		</tr>
		<tr>
			<td valign=center id=\"tdstatus\" class=\"leftLink\" align=center height=25>
				<a id=\"astatus\" href=\"if_RQstatus.php\" onclick=\"changeCellClass(1)\" target=\"mainFrame\" class=\"leftLink\">Track Requests</a></td>
		</tr>
		<tr> 
			<td valign=center id=\"tdrequest\" class=\"leftLink\" align=center height=25>
				<a id=\"arequest\" href=\"if_RQrequest.php\" onclick=\"changeCellClass(2)\" target=\"mainFrame\" class=\"leftLink\">Initiate a Request</a></td>
		</tr>
	   	<tr>
			<td valign=center id=\"tdhistory\" class=\"leftLink\" align=center height=25>
				<a id=\"ahistory\" href=\"if_RQhistory.php\" onclick=\"changeCellClass(3)\" target=\"mainFrame\" class=\"leftLink\">View Request History</a></td>
		</tr>
	   	<tr>
			<td valign=center class=\"leftLink\" align=center height=25>&nbsp;</td>
		</tr>
   ";
   
   $JavaScriptChangeCell = "
		function changeCellClass(id) 
		{
			var selArray = new Array('status', 'request', 'history');
		
			
			for (i = 0; i < selArray.length; i++)
			{
				var test = 'a'+ selArray[i];
				
				identity=document.getElementById('a' + selArray[i]);
				identity.className='leftLink';
				
				identity=document.getElementById('td' + selArray[i]);
				identity.className='leftLink';
			}	
		
			
			if (id > 0)
			{		
				identity=document.getElementById('a' + selArray[id - 1]);
				identity.className='leftLinkSelect';
				
				identity=document.getElementById('td' + selArray[id - 1]);
				identity.className='leftLinkSelect';		
			}	
			
		}
	";
}
else
{
	$DisplayAuthorizedLinks = "
		<tr>
			<td valign=center class=\"leftLink\" align=center height=25>&nbsp;</td>
		</tr>
		<tr>
			<td valign=center id=\"tdstatus\" class=\"leftLink\" align=center height=25>
				<a id=\"astatus\" href=\"if_RQstatus.php\" onclick=\"changeCellClass(1)\" target=\"mainFrame\" class=\"leftLink\">Track Requests</a></td>
		</tr>

	   	<tr>
			<td valign=center id=\"tdhistory\" class=\"leftLink\" align=center height=25>
				<a id=\"ahistory\" href=\"if_RQhistory.php\" onclick=\"changeCellClass(2)\" target=\"mainFrame\" class=\"leftLink\">View Request History</a></td>
		</tr>
	   	<tr>
			<td valign=center class=\"leftLink\" align=center height=25>&nbsp;</td>
		</tr>
   ";
   
    $JavaScriptChangeCell = "
		function changeCellClass(id) 
		{
			var selArray = new Array('status', 'history');
		
			
			for (i = 0; i < selArray.length; i++)
			{
				var test = 'a'+ selArray[i];
				
				identity=document.getElementById('a' + selArray[i]);
				identity.className='leftLink';
				
				identity=document.getElementById('td' + selArray[i]);
				identity.className='leftLink';
			}	
		
			
			if (id > 0)
			{		
				identity=document.getElementById('a' + selArray[id - 1]);
				identity.className='leftLinkSelect';
				
				identity=document.getElementById('td' + selArray[id - 1]);
				identity.className='leftLinkSelect';		
			}	
			
		}
	";
}	

?>

<html>

<head>
<title>HealthYourSelf Customer Information</title>

<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<style type="text/css">

.leftLink   { 
		font: 700 13px Helvetica, Arial,Geneva;
		color: black; 
		line-height: 15px; 
		text-decoration: none;
		}
				
.leftLink:hover   { 
		color: blue;
		font: 700 13px Helvetica, Arial,Geneva;
		line-height: 15px; 
		text-decoration: underline;
		}

.leftLinkSelect   { 
		font: 700 13px Helvetica, Arial,Geneva;
		color: black; 
		line-height: 15px; 
		text-decoration: none;
		background-color:#99CC99;
		}
				
.leftLinkSelect:hover   { 
		color: black;
		font: 700 13px Helvetica, Arial,Geneva;
		line-height: 15px; 
		text-decoration: underline;
		background-color:#99CC99;
		}

</style>

<script type="text/javascript">

function startUp() 
{
	changeCellClass(1);
	
	<?php print $JavaScriptLogMsg; ?>
}

<?php print $JavaScriptChangeCell; ?>
 
</script>
 
</head>

<body onload="startUp()">

<?php require ('hysTopLegend.php'); ?>

<?php require ('hysMainNav.php'); ?>

<div class="selectedContent">
<div id="leftcontent" class="leftcontent">
<br><br>
<center>
<table width=230 class="outerBorderblackSelect" cellspacing=0 cellpadding=0>

<?php print $DisplayAuthorizedLinks; ?>
    
</table>
</center>

<br><br>
 <?php require ('hysNamePhoto.php'); ?>
</div>

<div align="center" >
<IFRAME name="mainFrame" src="if_RQstatus.php"  class="rightcontent" scrolling="no" frameborder="0"></IFRAME>
</div>
</div>
<?php require ('hysFooter.php'); ?>

</body>

</html>
