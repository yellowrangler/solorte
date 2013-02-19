<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'if_appprescvi.php';

require ('hysInit.php');

require ('hysDBinit.php');

require ('hysDateEdits.php');

require ('calendar.php');

//---------------------------------------------------------------------------------------------------------------------------------------------------------
// Tab Processing
//---------------------------------------------------------------------------------------------------------------------------------------------------------

if (isset($_GET[selecttab]))
{
	switch ($_GET[selecttab])
	{
		case 'medap':
			$detailSrcName = "if_appdetail.php?appid=";
			
			$DisplayBlockTabs = "
				<table width=\"100%\" cellspacing=0 cellpadding=0>
					<tr> 
						<td  align=left width=100 class=\"appNavCell\">
							<a class=\"appNavCell\" href=\"if_appprescvi.php?selecttab=medap\">Appointments</a>
						</td>
						<td width=15>&nbsp;</td> 
						<td align=left width=100 class=\"prescNavCell\">
							<a class=\"prescNavCell\" href=\"if_appprescvi.php?selecttab=medpresc\">Prescriptions</a>
						</td>
						<td width=15>&nbsp;</td> 
						<td align=left width=100 class=\"vaccNavCell\">
							<a class=\"vaccNavCell\" href=\"if_appprescvi.php?selecttab=medvacinoc\">Vaccinations</a>
						</td>
						<td>&nbsp;</td> 
					</tr>
				</table>
				";
			
			$DisplayBlockHdr = "
				<table width=\"100%\" cellspacing=0 class=\"outerBorderTitleBlue\"> 
					<tr>
						<td height=20 width=\"5%\" align=center height=10>&nbsp;</td>
						<td width=\"15%\" align=center height=10>
							<a href=\"if_applist.php?order=adate\" class=\"linkTitletype\" target=\"listFrame\">Date</a>
						</td>
						<td width=\"15%\" align=center height=10>
							<a href=\"if_applist.php?order=adate\" class=\"linkTitletype\" target=\"listFrame\">Time</a>
						</td>
						<td width=\"25%\"  align=center height=10>
							<a href=\"if_applist.php?order=provider\" class=\"linkTitletype\" target=\"listFrame\">Provider</a>
						</td>
						<td width=\"35%\" align=center height=10>
							<a href=\"if_applist.php?order=desc\" class=\"linkTitletype\" target=\"listFrame\">Description</a>
						</td>
					</tr>
				</table>
				";
		
			$DisplayBlockFrame = "<IFRAME name=\"listFrame\" src=\"if_applist.php\" class=\"innerSelectframe\" frameborder=0 scrolling=auto> </IFRAME>";
			break;
		
		case 'medpresc':
			$detailSrcName = "if_prescdetail.php?prescid=";
			
			$DisplayBlockTabs =" 
				<table width=\"100%\" cellspacing=0 cellpadding=0>
					<tr> 
						<td align=left width=100 class=\"appNavCell\">
							<a class=\"appNavCell\" href=\"if_appprescvi.php?selecttab=medap\">Appointments</a>
						</td>
						<td width=15>&nbsp;</td> 
						<td align=left width=100 class=\"prescNavCell\">
							<a class=\"prescNavCell\" href=\"if_appprescvi.php?selecttab=medpresc\">Prescriptions</a>
						</td>
						<td width=15>&nbsp;</td> 
						<td align=left width=100 class=\"vaccNavCell\">
							<a class=\"vaccNavCell\" href=\"if_appprescvi.php?selecttab=medvacinoc\">Vaccinations</a>
						</td>
						<td>&nbsp;</td> 
					</tr>
				</table>
				";
			
			$DisplayBlockHdr = "
				<table width=\"100%\" cellspacing=0 class=\"outerBorderTitleRed\"> 
					<tr>
						<td height=20 width=\"5%\" align=center height=10>&nbsp;</td>
						<td width=\"15%\" align=center height=10>
							<a href=\"if_presclist.php?order=rdate\" class=\"linkTitletype\" target=\"listFrame\">Renew</a>
						</td>
						<td width=\"20%\" align=center height=10>
							<a href=\"if_presclist.php?order=med\" class=\"linkTitletype\" target=\"listFrame\">Prescription</a>
						</td>
						<td width=\"20%\" align=center height=10>
							<a href=\"if_presclist.php?order=provider\" class=\"linkTitletype\" target=\"listFrame\">Provider</a>
						</td>
						<td width=\"15%\" align=center height=10>
							<a href=\"if_presclist.php?order=reorder\" class=\"linkTitletype\" target=\"listFrame\">Rx ID</a>
						</td>
						<td width=\"25%\" align=center height=10>
							<a href=\"if_presclist.php?order=pharmacy\" class=\"linkTitletype\" target=\"listFrame\">Pharmacy</a>
						</td>
					</tr>
				</table>
				";
			
			$DisplayBlockFrame = "<IFRAME name=\"listFrame\" src=\"if_presclist.php\" class=\"innerSelectframe\" scrolling=auto frameborder=0> </IFRAME>";
			break;
		
		case 'medvacinoc':
			$detailSrcName = "if_videtail.php?viid=";
			
			$DisplayBlockTabs ="
				<table width=\"100%\" cellspacing=0 cellpadding=0>
					<tr> 
						<td align=left width=100 class=\"appNavCell\">
							<a class=\"appNavCell\" href=\"if_appprescvi.php?selecttab=medap\">Appointments</a>
						</td>
						<td width=15>&nbsp;</td> 
						<td align=left width=100 class=\"prescNavCell\">
							<a class=\"prescNavCell\" href=\"if_appprescvi.php?selecttab=medpresc\">Prescriptions</a>
						</td>
						<td width=15>&nbsp;</td> 
						<td align=left width=100 class=\"vaccNavCell\">
							<a class=\"vaccNavCell\" href=\"if_appprescvi.php?selecttab=medvacinoc\">Vaccinations</a>
						</td>
						<td>&nbsp;</td> 
					</tr>
				</table>
				";	
			
			$DisplayBlockHdr = "
				<table width=\"100%\" cellspacing=0 class=\"outerBorderTitleGreen\"> 
					<tr>
						<td height=20 width=\"5%\" align=center height=10>&nbsp;</td>
						<td width=\"15%\" align=center height=10>
							<a href=\"if_vilist.php?order=rdate\" class=\"linkTitletype\" target=\"listFrame\">Renew Date</a>
						</td>
						<td width=\"25%\" align=center height=10>
							<a href=\"if_vilist.php?order=desc\" class=\"linkTitletype\" target=\"listFrame\">Vaccination</a>
						</td>
						<td width=\"30%\" align=center height=10>
							<a href=\"if_vilist.php?order=med\" class=\"linkTitletype\" target=\"listFrame\">Medication</a>
						</td>
						<td width=\"20%\" align=center height=10>
							<a href=\"if_vilist.php?order=provider\" class=\"linkTitletype\" target=\"listFrame\">Provider</a>
						</td>
					</tr>
				</table>
				";
				
			$DisplayBlockFrame = "<IFRAME name=\"listFrame\" src=\"if_vilist.php\" class=\"innerSelectframe\" scrolling=auto frameborder=0> </IFRAME>";
		break;
		
		default:
			$errmsg = " Error parm passed to selecttab is invalid  selecttab = '$_GET[selecttab]  - '$Medpal'";
			$location = "";
			$severity = 1;	
			$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
			LogErr($shortmsg, $errmsg, $location, $module, $severity);
			break;
	
	}
}
else
{
	$detailSrcName = "if_appdetail.php?appid="; 
	
	$DisplayBlockTabs = "
		<table width=\"100%\" cellspacing=0 cellpadding=0>
			<tr> 
				<td  align=left width=100 class=\"appNavCell\">
					<a class=\"appNavCell\" href=\"if_appprescvi.php?selecttab=medap\">Appointments</a>
				</td>
				<td width=15>&nbsp;</td> 
				<td align=left width=100 class=\"prescNavCell\">
					<a class=\"prescNavCell\" href=\"if_appprescvi.php?selecttab=medpresc\">Prescriptions</a>
				</td>
				<td width=15>&nbsp;</td> 
				<td align=left width=100 class=\"vaccNavCell\">
					<a class=\"vaccNavCell\" href=\"if_appprescvi.php?selecttab=medvacinoc\">Vaccinations</a>
				</td>
				<td>&nbsp;</td> 
			</tr>
		</table>
		";
	
	$DisplayBlockHdr = "
		<table width=\"100%\" cellspacing=0 class=\"outerBorderTitleBlue\"> 
			<tr>
				<td height=20 width=\"5%\" align=center height=10>&nbsp;</td>
				<td width=\"15%\"  height=20 align=center height=10>
					<a href=\"if_applist.php?order=adate\" class=\"linkTitletype\" target=\"listFrame\">Date</a>
				</td>
				<td width=\"15%\" align=center height=10>
					<a href=\"if_applist.php?order=adate\" class=\"linkTitletype\" target=\"listFrame\">Time</a>
				</td>
				<td width=\"25%\"  align=center height=10>
					<a href=\"if_applist.php?order=provider\" class=\"linkTitletype\" target=\"listFrame\">Provider</a>
				</td>
				<td width=\"45%\" align=center height=10>
					<a href=\"if_applist.php?order=desc\" class=\"linkTitletype\" target=\"listFrame\">Description</a>
				</td>
			</tr>
		</table>
		";

	$DisplayBlockFrame = "<IFRAME name=\"listFrame\" src=\"if_applist.php\" class=\"innerSelectframe\" frameborder=0 scrolling=auto> </IFRAME>";
}

//---------------------------------------------------------------------------------------------------------------------------------------------------------
// Calander Processing
//---------------------------------------------------------------------------------------------------------------------------------------------------------

//---------------------------------------------------------------------------------------------------
// lets figure the current month and build a timestamp start and timestamp end
// also lets set CurMonth which we will need later  We want 3 months of dates
//---------------------------------------------------------------------------------------------------
if (isset($_POST[Action]) && $_POST[Action] != "")
{
	$tmpDate = getNextPrevMonthYear($_POST[timestamp]);
	
	if ($_POST[Action] == 'Next')
	{	
		$DisplayCurrentTimestamp = $tmpDate[0];
	}
	else
	{
		$DisplayCurrentTimestamp = $tmpDate[1];
	}	 
}
else
{
	$DisplayCurrentTimestamp = time();
}
	
$mysqlDates = GetCalendarStartEndDates($DisplayCurrentTimestamp);

//--------------------------------------------------------------------------------------------------
// Set Start End Variables
//--------------------------------------------------------------------------------------------------
$mysqlDateStart = $mysqlDates[0];
$mysqlDateEnd = $mysqlDates[1];

//--------------------------------------------------------------------------------------------------
// Build 1st Month Array
//--------------------------------------------------------------------------------------------------
$eventArr = fillCalendarEventArrays($mysqlDateStart, $mysqlDateEnd);

//---------------------------------------------------------------------------------------------------
// Now lets build the calendar
//---------------------------------------------------------------------------------------------------

// First convert mysqlDate to Month and year
$MySQLDatesConverted = CovertMySQLDate($mysqlDateStart, 1, 9);

// Build Calendar
$DisplayCalendarBlock1 = buildCalendar($MySQLDatesConverted[1], $MySQLDatesConverted[0], $eventArr);

//--------------------------------------------------------------------------------------------------
// Build 2nd Month Array
//--------------------------------------------------------------------------------------------------
$mysqlDates = GetCalendarStartEndDates(strtotime($mysqlDateEnd));

//--------------------------------------------------------------------------------------------------
// Set Start End Variables
//--------------------------------------------------------------------------------------------------
$mysqlDateStart = $mysqlDates[0];
$mysqlDateEnd = $mysqlDates[1];

//---------------------------------------------------------------------------------------------------
// Build Array
//---------------------------------------------------------------------------------------------------
$eventArr = fillCalendarEventArrays($mysqlDateStart, $mysqlDateEnd);

//---------------------------------------------------------------------------------------------------
// Now lets build the calendar
//---------------------------------------------------------------------------------------------------

// First convert mysqlDate to Month and year
$MySQLDatesConverted = CovertMySQLDate($mysqlDateStart, 1, 9);

// Build Calendar
$DisplayCalendarBlock2 = buildCalendar($MySQLDatesConverted[1], $MySQLDatesConverted[0], $eventArr);

//--------------------------------------------------------------------------------------------------
// Build 3rd Month Array
//--------------------------------------------------------------------------------------------------
$mysqlDates = GetCalendarStartEndDates(strtotime($mysqlDateEnd));

//--------------------------------------------------------------------------------------------------
// Set Start End Variables
//--------------------------------------------------------------------------------------------------
$mysqlDateStart = $mysqlDates[0];
$mysqlDateEnd = $mysqlDates[1];

//---------------------------------------------------------------------------------------------------
// Build Array
//---------------------------------------------------------------------------------------------------
$eventArr = fillCalendarEventArrays($mysqlDateStart, $mysqlDateEnd);

//---------------------------------------------------------------------------------------------------
// Now lets build the calendar
//---------------------------------------------------------------------------------------------------

// First convert mysqlDate to Month and year
$MySQLDatesConverted = CovertMySQLDate($mysqlDateStart, 1, 9);

// Build Calendar
//$DisplayCalendarBlock3 = buildCalendar($MySQLDatesConverted[1], $MySQLDatesConverted[0], $eventArr);
$DisplayCalendarBlock3 = "";
?>
<html>

<head>
<title>HealthYourSelf Prescription list</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />
<style type="text/css"> 

.rightcontentSplitLeft {
		position: absolute;
		left:30px;
		top:235px;
		width:240px;
		height:500px;
		background-color: #ccccff;
		border:0px solid black;
		}
		
.rightcontentSplitRight {
		position: absolute;
		left:310px;
		top:235px;
		width:385px;
		height:520px;
		background-color: white;
		border:1px solid black;
		}

.tabtitlePos {
		position: absolute;
		left:10px;
		top:0px; 
		width:662px;
		height:20px;
		}
		
.appNavCell   { 
		color: white;
		font: 700 12px Arial, Geneva; 
		line-height: 20px; 
		text-align: center;
		vertical-align: middle;
		background: #052faf;
		text-decoration: none;
		}

.appNavCell:hover   { 
		color: black;
		font: 700 12px Arial, Geneva; 
		line-height: 20px; 
		text-align: center;
		vertical-align: middle;
		background: #052faf;
		text-decoration: none;
		}

.prescNavCell   { 
		color: white;
		font: 700 12px Arial, Geneva; 
		line-height: 20px; 
		text-align: center;
		vertical-align: middle;
		background: red;
		text-decoration: none;
		}

.prescNavCell:hover   { 
		color: black;
		font: 700 12px Arial, Geneva; 
		line-height: 20px; 
		text-align: center;
		vertical-align: middle;
		background: red;
		text-decoration: none;
		}
				
.vaccNavCell   { 
		color: white;
		font: 700 12px Arial, Geneva; 
		line-height: 20px; 
		text-align: center;
		vertical-align: middle;
		background: green;
		text-decoration: none;
		}

.vaccNavCell:hover   { 
		color: black;
		font: 700 12px Arial, Geneva; 
		line-height: 20px; 
		text-align: center;
		vertical-align: middle;
		background: green;
		text-decoration: none;
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

.outerBorderTitleRed {
		color: white;
		font: 700 13px Arial,Helvetica;
		text-align: center;
		border-top:0px solid red;
		border-left:1px solid red;
		border-right:1px solid red;
		border-bottom:0px solid red;
		background: red;
		}				

.outerBorderTitleGreen {
		color: white;
		font: 700 13px Arial,Helvetica;
		text-align: center;
		border-top:0px solid green;
		border-left:1px solid green;
		border-right:1px solid green;
		border-bottom:0px solid green;
		background: green;
		}

.headerBorderGold {
		color:#23708e;
		font: 700 15px Arial,Helvetica;
		border-top:0px solid #d1b60c;
		border-left:0px solid #d1b60c;
		border-right:0px solid #d1b60c;
		border-bottom:2px solid #d1b60c;
		}		

.rightcontentTabs {
		position: absolute;
		left:20px;
		top:40px; 
		width:700px;
		height:150px;
		background-color: #ccccff;
		border:0px solid black;
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
		left:10px;
		top:45px; 
		width:660px;
		height:100px;
		background-color: white;
		border:1px solid black;
		}
				
.linkTitletype {
		color: white;
		font: 700 13px Arial,Helvetica;
		text-align: center;
		text-decoration: none;
		}			

.linkTitletype:hover {
		color: yellow;
		font: 700 13px Arial,Helvetica;
		text-align: center;
		text-decoration: underline;
		}		


.calendarArea {
		position: absolute;
		left:0px;
		top:0px;
		width:238px;
		height:180px;
		background-color: #ccccff;
		border:0px solid white;
		}


.calendarButtons {
		position: absolute;
		left:10px;
		top:730px;
		width:238px;
		height:25px;
		background-color: #ccccff;
		border:0px solid white;
		}

.SmTxt   { 
		font: 400 13px Arial, Geneva;
		}		
		
/* caption determines the style of 
   the month/year banner above the calendar. */ 

.caption  
     { 
     font-family:arial,helvetica;  
     font-size:11px;  
     color: black; 
	 background-color: white; 
     font-weight: bold; 
     } 


/* .calendar determines the overall formatting style of the calendar,   
   acting as the default unless later overruled. */ 

.calendar  
     { 
     font-family:arial,helvetica;  
     font-size:11px;  
     color: white; 
     background-color: #c0c0c0; 
     border-color: #000000; 
     border-style: solid; 
     border-width: 1px; 
     } 

/* .calendarlink determines the formatting of those days linked to 
   content. */ 

.calendarlink  
     { 
     color: white; 
     } 

/* .header determines the formatting of the weekday headers at the top 
   of the calendar. */ 

.header  
     { 
     background-color: #996633; 
     border-color: #000000; 
     border-style: solid; 
     border-width: 1px; 
     } 

/* .day determines the formatting of each day displayed in the 
   calendar. */ 

.day  
     { 
     background-color: #808080; 
     border-color: #000000; 
     border-style: solid; 
     border-width: 1px; 
     text-align: center 
     } 

/* .linkedday determines the formatting of a date to which content is 
   available. */ 

.linkedday  
     { 
     background-color: #8080ff; 
     border-color: #000000; 
     border-style: solid; 
     border-width: 1px; 
     text-align: center 
     } 
		
</style>

<script language="JavaScript" type="text/javascript" src="hysfunc.js"> </script>
<script type="text/javascript">
function startUp() 
{	
	<? print $JavaScriptLogMsg; ?> 
		
	<? print $JavaScriptMsg; ?>
}
</script>
</head>

<body <? print $BodySelectColor ?> onload="startUp()">

<div name="NavTabsArea" class="rightcontentTabs">
<div class="tabtitlePos">
<? print $DisplayBlockTabs; ?>
<? print $DisplayBlockHdr; ?>
</div>
<? print $DisplayBlockFrame; ?>
</div>

<div name="CalendarsArea" class="rightcontentSplitLeft">

<div class="calendarArea">
<? print $DisplayCalendarBlock1; ?>
<br>
<? print $DisplayCalendarBlock2; ?>
<br>
<? print $DisplayCalendarBlock3; ?>
</div>

</div>

<IFRAME name="detailFrame" src="<? print $detailSrcName; ?>"  scrolling=auto frameborder=0 class="rightcontentSplitRight"> </IFRAME>

<form name="changemonth" method="post" ACTION="if_appprescvi.php" target="mainFrame">
<div name="calbuttons" class="calendarButtons">
<center>
<table class="SmTxt" border=0 cellspacing=0 cellpadding=0>
	<tr>
		<td width=15>&nbsp;</td>
		<td align=center  height=15><input type="submit" name="Action" value="Prev"></td>
		<td width=15>&nbsp;</td>
		<td align=center  height=15><input type="submit" name="Action" value="Next"></td> 
		<td>&nbsp;</td>
	</tr>
</table>
<input type='hidden' name='timestamp'  value='<? print $DisplayCurrentTimestamp; ?>'>
</center>
</div>

</form>

</body>
</html>
