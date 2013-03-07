<?php
//----------------------------------------------------------------------------------------------------------
// Set special globals.
//----------------------------------------------------------------------------------------------------------
$module = 'puhelp.php';

require ('hysInit.php');

require ('hysDBinit.php');

$DisplaySelection = $_GET[selection];

if ($DisplaySelection == "")
{
	$DisplayBlock = "<br><br><h2><i>No Help Information for this Selection</i></h2>";
}
else
{
	switch ($DisplaySelection)
	{
		case 'home':
			$DisplayBlock = "
				<h2><i>Information</i></h2>
				<p>This tab slection displays customer medical information both detailed and summerized. This area has no update capability and is accessed by selecting the <i><b>Information</b></i>
				 tab</p>
				<br><br>
				
				<h3>Personal Calendar</h3>
				<p>On coming to this page current calendar information is displayed
				for <i>Medical Appointments</i>, <i>Precriptions renew dates</i> and <i>Vaccination experations</i>.</p>
				<p>The three calendars will display light blue for those dates which contain information. You can see the detail by clicking on the 
				blue calendar entry. Detail is displayed on the calendars right. Clicking on <i>Prev</i> and <i>Next</i> buttons will
				change the calendars by one month backwards or forward/p> 
				<p>The three colored tabs can be selected to see a list of dates in ascending order for each of the three calendar information types. 
				If you click on the <i>Provider</i> heading; the list will be sorted by Provider.</p>
				<br><br>
							
				<h3>Medical History</h3>
				<p>This selection provides you with access to your medical history. You can search for a history item or scroll the items in the list 
				box until you find what you are looking for.  The items in the list can be sorted by clicking on the list titles</p>
				<p>To see both the summary and detail history items you select either the binocular icon or the camera icon. Each will then cause 
				supporting detail to be displayed beneath the list box.</p>
				<p>The camera icon signifies that scanned documents are available for this detail.  Scanned documents appear as small images (thumbnails)
				in the <Scanned Documents</i> window. Clicking on any of these documenst will pop up a second window with the document detail enlarged
				for viewing.</p>
				<p><i>Provider</i> or <i>Location</i> names that have links will provide detail on each if selected.</p>
				<br><br>
				
				<h3>Insurance Information</h3>
				<p>This selection provides you with details regarding your medical insurance (Meical and Dental). Any linked items will provide more 
				detail about that item when selected.</p>
				<br><br>
				
				<h3>Medical Profile</h3>
				<p>This selection provides you with details about you current medical state of being. This information is intended to give a compelling
				snapshot of your overall medical and physical composition.  Any linked items will provide more 
				detail about that item when selected.</p>
				
				<br><br>
				<h3>Emergency Contacts</h3>
				<p>This selection defines who you would like notified in the event an emergency situation.</p>
				
				<br><br>
				<h3>Access Log</h3>
				<p>This selection shows you who has been looking at your medical information. Remember you have the ability to open or close access to 
				<i>Your</i> medical information!</p>
				
			";	
			break;
			
		case 'request':	
			$DisplayBlock = "
				<h2><i>Requests</i></h2>
				<p>This tab selection supports the customer medical information request process. Here, you can view or initiate a request for medical information.
				This area is accessed by selecting the <i><b>Requests</b></i> tab</p>
				<br><br>
				
				<h3>Track Requests</h3>
				<p>This selection will display a list box of outstanding requests initiated by the customer.  The request list can be sorted by clicking on list headings. 
				List details will be displayed when the binocular image is selected from the list box.  Detail information will be displayed about the selected request. Note 
				that customer service comments may be displayed in the <i>Service Comments</i> detail area regarding the request.</p>
				<br><br>
				
				<h3>Initiate a Request</h3>
				<p>This selection provides our customers with the means to initiate a request for medical information from a provider.  This requires that the Provider
				and their location be on file with <b><i>Health Your Self</i></b>. If you are unable to find the <i>Provider</i> or  or <i>Location</i> from the drop down lists provided,
				it is because they are not on file with us.  In that case please call our Customer Service at <b>978-474-4074</b> between the hours of 8:00AM and 5:00PM EST any
				day of the week with the provider and location information so that we may add them to	your file.</p>
				<br><br>
				
				<h3>View Request History</h3>
				<p>This selection provides you with a more fluid view of the request process. As with <i>Track Reqiuests</i>, a list box of outstanding requests will be displayed with 
				identical sorting capabilities. Selecting the binocular icon will provide two boxes of request history information.</p>
				<p>The first box titled <b><i>Request Steps</i></b>, will show where the request is with regard to full request process. Green check marks are completed steps, red crosses 
				are steps that were finished but subsequest review caused a reversal. This typically happens when information provided us by the provider is incomplete. Request steps without
				a mark have not been entered</p><p>The second box displays a running log (or conversation if you will) of what has been taking place between our customer service staff 
				and your medical providers.</p>
				<br><br>
			";	
			break;
		
		default:
				$DisplayBlock = "<br><br><h2><i>No Help Information for this Selection</i></h2>";
			break;
			
	} // End of switch	
}

?>

<html>
<head>
<title>Pop-Up Information</title>
<link rel="stylesheet" type="text/css" href="css/hysstyle.css" />

<script language="JavaScript" type="text/javascript" src="hyspufunc.js"> </script>

</head>

<body>

<div id="banner" class="banner">
<table width="100%" border=0 cellspacing=0 cellpadding=0>
		<tr>
      <td align="left"><img border="0" src="images/healthyourselflogo.JPG"></td>
  </tr>
</table>

<hr align="left" size="1" width=380 class="popupLine">

</div>


<div id="popup" class="popup">
<br><br>
<table width="80%">
	<tr>
		<td align="left" width="75%" class="smallText"><i><a href="#" onClick="window.close()">Close Window</a></i></td>
		<td align="right" width="25%" class="smallText"><i><a href="#" onClick="printDoc()">Print Window</a></i></td>
	</tr>
</table>		

<br><br>

<?php print $DisplayBlock; ?>

</div>

</body>
</html>