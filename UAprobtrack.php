<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'UAprobtrack.php';

require ('hysInit.php');

require ('hysDBinit.php');

$NextPage = "Location:  $_POST[ptreturn]?probtrackid=$_POST[ptid]";

//----------------------------------------------------------------------------------------------------------
// if we are post action add information to prob tracking system first
//----------------------------------------------------------------------------------------------------------
if (isset($_POST[ptid]) && ($_POST[ptid] != "") )
{
	if (isset($_POST[Action]) && ($_POST[Action] != "") )
	{
		switch ($_POST[Action])
		{
			case 'Update':
				$sql = "UPDATE ProblemTrackingTBL 
							set ProblemTypeID = '$_POST[pttype]', ProblemAreaID = '$_POST[ptarea]', 
							BrowserTypeID = '$_POST[ptbrowser]', BrowserOther = '$_POST[ptbrowserother]', 
							OperatingSystemID = '$_POST[ptos]', OperatingSystemOther = '$_POST[ptosother]', 
							Problem = '$_POST[ptproblem]', ProblemStatusID = '$_POST[ptstatus]',
							ProblemSeverityID = '$_POST[ptseverity]',
							Developer = '$_POST[ptdev]', Tester = '$_POST[pttest]', Fix = '$_POST[ptfix]'
								where ProblemTrackingTBL.ID ='$_POST[ptid]'";
					
				if (!$sql_result = mysql_query($sql, $conn))
				{
					$sqlerr = mysql_error();
					$errmsg = "$sqlerr - Error doing mysql_query update ProblemTrackingTBL (695) - '$sql'";
					$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
					$location = "";
					$severity = 1;
					LogErr($shortmsg, $errmsg, $location, $module, $severity);
				}
				
				$DisplayMSG = "Problem Tracking successfully Updated.";
				
				$NextPage = "Location:  $_POST[ptreturn]?probtrackid=$_POST[ptid]&msgTxt=$DisplayMSG";
				break;
			
			case 'Delete':
				$sql = "DELETE from ProblemTrackingTBL where ProblemTrackingTBL.ID = '$_POST[ptid]'";
				
				if (!$sql_result = mysql_query($sql, $conn))
				{
					$sqlerr = mysql_error();
					$errmsg = "$sqlerr - Error doing mysql_query delete ProblemTrackingTBL (695) - '$sql'";
					$shortmsg = "System DB error.  If this persists, Please call Customer Support.";
					$location = "";
					$severity = 1;
					LogErr($shortmsg, $errmsg, $location, $module, $severity);
				}
				
				$DisplayMSG = "Problem Tracking successfully Deleted.";
				
				$NextPage = "Location:  $_POST[ptreturn]?msgTxt=$DisplayMSG";
				break;
			
			default:
				$NextPage = "Location:  $_POST[ptreturn]?probtrackid=$_POST[ptid]";
				break;
				
		} // end of switch		
				
	} // End of if isset
} // end of if id set

header($NextPage);

?>
