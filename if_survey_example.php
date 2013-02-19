<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>HealthYourSelf Survey</title>
<link rel="stylesheet" type="text/css" href="css/solorteglobal.css" />

<style type="text/css">
td { font: 400 13px Arial, Geneva; line-height: 20px;} 

</style>

<script language="JavaScript" type="text/javascript" src="solortefunc.js"> </script>
</head>
<body>
<!-- Haeder table -->
<table border=0 width="100%">
	<tr>
		<td valign="bottom" align="right" class="headerBorder"><i> The Survey</i></td>
	</tr>
</table>
<br>
<table>
	<tr>
		<td><p>We would like to ask you some questions to comprehend the issues you face when receiving medical care. Your responses to this questionnaire will help us understand your medical 
		information needs. This questionnaire contains twelve questions, and should only take a few minutes to complete. Your responses will be kept confidential and will not be given to any other entity.</p>
		</td>
	</tr>
</table>
<br><br>	

<form method="post" ACTION="update.php">

<!-- First Enter Name, Gender, Occupation, Age and Zip -->
<div class="smallText2">
<table>
	<tr>
		<td halign=right>Full Name:</td>
		<td halign=left colspan=10><input type="text" name="fullname" size=50 maxLength=30></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>	
	<tr>
		<td align=right>Occupation: </td>
		<td><input type="text" name="occupation" size=25 maxLength=50></td>
		<td></td>
		<td align=right> Age: </td>
		<td><input type="text" name="age" size=2 maxLength=3></td>
		<td></td>
		<td align=right>Gender: </td>
		<td>
		<select name="gender" size="1">
			<OPTION label="No Selection" value=" "> </OPTION>
			<OPTION label="Male" value="M">M</OPTION>
			<OPTION label="Female" value="F">F</OPTION>
		</select>    
		</td>
		<td></td>
		<td align=right>ZIP Code: </td>
		<td><input type="text" name="zipcode" size=5 maxLength=5></td>
	</tr>
</table>

<br><br>


<!--     user input fields for Question 1    -->
<dl>
<table>
	<tr>
		<td width="3" valign=top><b>1.</b></td>
		<td><b>What are the most important issues to you in the management of your health care?</b></td>
	</tr>
	<tr>
		<td></td>
		<td class="smallText">(Please check all that are important to you.)</td>
	</tr>
</table>

<dd>
<table>
	<tr>
		<td><input type="checkbox" name="Q1N1" value="Y"></td>
		<td>The cost of health insurance.</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="Q1N2" value="Y"></td>
		<td>Scheduling and/or remembering doctors appointments.</td>
	</tr>
	<tr>	
		<td><input type="checkbox" name="Q1N3" value="Y"></td>
		<td>Finding an advocate to help in medical insurance grievances/payment and coverage disputes.</td>
	</tr>
	<tr>	
		<td><input type="checkbox" name="Q1N4" value="Y"></td>
		<td>Access to your present and historical medical information.</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="Q1N5" value="Y"></td>
		<td>Finding suitable doctors and/or specialists.</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="Q1N6" value="Y"></td>		
		<td>Prescription costs.</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="Q1NO" value="Y"></td>
		<td>Other <input type="text" name="Q1O" size=40 maxLength=125> </td>
	</tr>
</table>
</dd></dl>
<br>       	
                
<!--     user input fields for Question 2    -->
<dl>
<table>
	<tr>
		<td width="3" valign=top><b>2.</b></td>
		<td><b>What are the most important issues to you regarding your health care information?</b></td>
	</tr>
	<tr>
		<td></td>
		<td class="smallText">(Please score each option below between 1 and 7 with 1 being Most-important and 7 being Least-important)</td>
	</tr>
</table>

<dd>
<table>
	<tr>
		<td valign=top>
			<SELECT name="Q2N1"> 
				<OPTION label="S0" value="0"> </OPTION>
				<OPTION label="S1" value="1">1</OPTION>
				<OPTION label="S2" value="2">2</OPTION>
				<OPTION label="S3" value="3">3</OPTION>
				<OPTION label="S4" value="4">4</OPTION>
				<OPTION label="S5" value="5">5</OPTION>
				<OPTION label="S6" value="6">6</OPTION>
				<OPTION label="S7" value="7">7</OPTION>
			</SELECT>
		</td>
		<td>My medical information is not being shared between my doctors, hospitals, and ancillary medical facilities.</td>
	</tr>
	<tr>
		<td valign=top>
			<SELECT name="Q2N2">
				<OPTION label="S0" value="0"> </OPTION> 
				<OPTION label="S1" value="1">1</OPTION>
				<OPTION label="S2" value="2">2</OPTION>
				<OPTION label="S3" value="3">3</OPTION>
				<OPTION label="S4" value="4">4</OPTION>
				<OPTION label="S5" value="5">5</OPTION>
				<OPTION label="S6" value="6">6</OPTION>
				<OPTION label="S7" value="7">7</OPTION>
			</SELECT>
		</td>
		<td>My medical information is not available to doctors and EMT's during an emergency.</td>
	</tr>
	<tr>
		<td valign=top>  
			<SELECT name="Q2N3"> 
				<OPTION label="S0" value="0"> </OPTION>
				<OPTION label="S1" value="1">1</OPTION>
				<OPTION label="S2" value="2">2</OPTION>
				<OPTION label="S3" value="3">3</OPTION>
				<OPTION label="S4" value="4">4</OPTION>
				<OPTION label="S5" value="5">5</OPTION>
				<OPTION label="S6" value="6">6</OPTION>
				<OPTION label="S7" value="7">7</OPTION>
			</SELECT>
		</td>
		<td>My doctor does not meet with me as scheduled.</td>
	</tr>
	<tr>
		<td valign=top>  
			<SELECT name="Q2N4"> 
				<OPTION label="S0" value="0"> </OPTION>
				<OPTION label="S1" value="1">1</OPTION>
				<OPTION label="S2" value="2">2</OPTION>
				<OPTION label="S3" value="3">3</OPTION>
				<OPTION label="S4" value="4">4</OPTION>
				<OPTION label="S5" value="5">5</OPTION>
				<OPTION label="S6" value="6">6</OPTION>
				<OPTION label="S7" value="7">7</OPTION>
			</SELECT>
		</td>
		<td>I do not have personal access to my medical information.</td>
	</tr>
	<tr>
		<td valign=top>
			<SELECT name="Q2N5"> 
				<OPTION label="S0" value="0"> </OPTION>
				<OPTION label="S1" value="1">1</OPTION>
				<OPTION label="S2" value="2">2</OPTION>
				<OPTION label="S3" value="3">3</OPTION>
				<OPTION label="S4" value="4">4</OPTION>
				<OPTION label="S5" value="5">5</OPTION>
				<OPTION label="S6" value="6">6</OPTION>
				<OPTION label="S7" value="7">7</OPTION>
			</SELECT>
		</td>
		<td>I do not understand my medical records and/or diagnoses reports.</td>
	</tr>
	<tr>
		<td valign=top>
			<SELECT name="Q2N6"> 	
				<OPTION label="S0" value="0"> </OPTION>
				<OPTION label="S1" value="1">1</OPTION>
				<OPTION label="S2" value="2">2</OPTION>
				<OPTION label="S3" value="3">3</OPTION>
				<OPTION label="S4" value="4">4</OPTION>
				<OPTION label="S5" value="5">5</OPTION>
				<OPTION label="S6" value="6">6</OPTION>
				<OPTION label="S7" value="7">7</OPTION>
			</SELECT>
		</td>
		<td>I am concerned about the privacy of my personal and/or family's medical information.</td>
	</tr>
	
	<tr>
		<td valign=top>
			<SELECT name="Q2NO">
				<OPTION label="S0" value="0"> </OPTION> 
				<OPTION label="S1" value="1">1</OPTION>
				<OPTION label="S2" value="2">2</OPTION>
				<OPTION label="S3" value="3">3</OPTION>
				<OPTION label="S4" value="4">4</OPTION>
				<OPTION label="S5" value="5">5</OPTION>
				<OPTION label="S6" value="6">6</OPTION>
				<OPTION label="S7" value="7">7</OPTION>
			</SELECT>
		</td>
		<td>Other <input type="text" name="Q2O" size=40 maxLength=125></td>
	</tr>
</table>
</dd></dl>
<br>

<!--     user input fields for Question 3    -->
<dl>
<table>
	<tr>
		<td width="3" valign=top><b>3.</b></td>
		<td><b>Do you have children under the age of 18?</b></td>	
		<td>&nbsp;</td>
		<td class="smallText"> (Please answer Yes or No)</td>
	</tr>
	<tr>	
		<td width=3>&nbsp;</td>
		<td colspan=3 class="SmallText" align="left"><input type="radio" name="Q3NA" value="Y">Yes  <input type="radio" name="Q3NA" value="N">No</td>
	</tr>
</table>
<dd>

</dd>

</dl>
<dl>
<table>
	<tr>
		<td width="3" valign=top>&nbsp;</td>
		<td><b><i>If you answered "Yes", what elements of your children's medical care are most important to you?<i></b></td>
	</tr>
	<tr>
		<td></td>
		<td class="smallText">(Please score each option below between 1 and 7 with 1 being Most-important and 7 being Least-important)</td>
	</tr>
</table>
<dd>
<table>
	<tr>
		<td valign=top>
			<SELECT name="Q3N1"> 
				<OPTION label="S0" value="0"> </OPTION>
				<OPTION label="S1" value="1">1</OPTION>
				<OPTION label="S2" value="2">2</OPTION>
				<OPTION label="S3" value="3">3</OPTION>
				<OPTION label="S4" value="4">4</OPTION>
				<OPTION label="S5" value="5">5</OPTION>
				<OPTION label="S6" value="6">6</OPTION>
				<OPTION label="S7" value="7">7</OPTION>
			</SELECT>    
		</td>
		<td>A list of every child's vaccinations.</td>
	</tr>
	<tr>
		<td valign=top>
			<SELECT name="Q3N2">
				<OPTION label="S0" value="0"> </OPTION> 
				<OPTION label="S1" value="1">1</OPTION>
				<OPTION label="S2" value="2">2</OPTION>
				<OPTION label="S3" value="3">3</OPTION>
				<OPTION label="S4" value="4">4</OPTION>
				<OPTION label="S5" value="5">5</OPTION>
				<OPTION label="S6" value="6">6</OPTION>
				<OPTION label="S7" value="7">7</OPTION>
			</SELECT>
		</td>
		<td>A standard medical record that you could print and forward to schools, camps, etc.</td>
	</tr>
	<tr>
		<td valign=top>
			<SELECT name="Q3N3">
				<OPTION label="S0" value="0"> </OPTION> 
				<OPTION label="S1" value="1">1</OPTION>
				<OPTION label="S2" value="2">2</OPTION>
				<OPTION label="S3" value="3">3</OPTION>
				<OPTION label="S4" value="4">4</OPTION>
				<OPTION label="S5" value="5">5</OPTION>
				<OPTION label="S6" value="6">6</OPTION>
				<OPTION label="S7" value="7">7</OPTION>
			</SELECT>
		</td>
		<td>A clear and concise report of the diagnoses and treatments prescribed from each doctor&rsquo;s visit.</td>
	</tr>
	<tr>
		<td valign=top>
			<SELECT name="Q3N4"> 
				<OPTION label="S0" value="0"> </OPTION>
				<OPTION label="S1" value="1">1</OPTION>
				<OPTION label="S2" value="2">2</OPTION>
				<OPTION label="S3" value="3">3</OPTION>
				<OPTION label="S4" value="4">4</OPTION>
				<OPTION label="S5" value="5">5</OPTION>
				<OPTION label="S6" value="6">6</OPTION>
				<OPTION label="S7" value="7">7</OPTION>
			</SELECT>
		</td>
		<td>A checklist of upcoming medical needs like doctor visits, vaccinations, inoculations, etc.</td>
	</tr>
	<tr>
		<td valign=top>
			<SELECT name="Q3N5"> 
				<OPTION label="S0" value="0"> </OPTION>
				<OPTION label="S1" value="1">1</OPTION>
				<OPTION label="S2" value="2">2</OPTION>
				<OPTION label="S3" value="3">3</OPTION>
				<OPTION label="S4" value="4">4</OPTION>
				<OPTION label="S5" value="5">5</OPTION>
				<OPTION label="S6" value="6">6</OPTION>
				<OPTION label="S7" value="7">7</OPTION>
			</SELECT>
		</td>
		<td>A medical history card with your child's blood type, allergies, vaccinations and emergency names and telephone numbers for school or camp emergencies.</td>
	</tr>
	<tr>
		<td valign=top>
			<SELECT name="Q3NO">
				<OPTION label="S0" value="0"> </OPTION> 
				<OPTION label="S1" value="1">1</OPTION>
				<OPTION label="S2" value="2">2</OPTION>
				<OPTION label="S3" value="3">3</OPTION>
				<OPTION label="S4" value="4">4</OPTION>
				<OPTION label="S5" value="5">5</OPTION>
				<OPTION label="S6" value="6">6</OPTION>
				<OPTION label="S7" value="7">7</OPTION>
			</SELECT>
		</td>
		<td>Other <input type="text" name="Q3O" size=40 maxLength=125></td>
	</tr>
</table>
</dd></dl>
<br>      
        
<!--     user input fields for Question 4    -->
<dl>
<table>
	<tr>
		<td width="3" valign=top><b>4.</b></td>
		<td><b>Thinking of managing your health care, which of the following could be of concern to you?</b></td>
	</tr>
	<tr>
		<td></td>
		<td class="smallText">(Please check all that apply)</td>
	</tr>
</table>

<dd>
<table>
	<tr>
		<td><input type="checkbox" name="Q4N1" value="Y"></td>
		<td>I cannot easily get copies of my medical records.</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="Q4N2" value="Y"></td>
		<td>My medical information is inaccessible to other doctors involved in my care.</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="Q4N3" value="Y"></td>
		<td>Non-authorized people can access my medical information.</td>
	</tr>	
	<tr>
		<td><input type="checkbox" name="Q4N4" value="Y"></td>
		<td>Medical providers may be giving my medical information to marketing organizations.</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="Q4N5" value="Y"></td>
		<td>My medical information is only available for the past 7 years, so no health trends are available.</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="Q4NO" value="Y"></td>
		<td>Other <input type="text" name="Q4O" size=40 maxLength=125></td>
	</tr>
</table>
</dd></dl>
<br>                        
   	
<!--     user input fields for Question 5    -->
<dl>
<table>
	<tr>
		<td width="3" valign=top><b>5.</b></td>
		<td><b>Have you ever had to get medical information from one doctor and manually transport that information to	another doctor?</b></td>
	</tr>
	<tr>	
		<td>&nbsp;</td>
		<td class="smallText"> (Please answer Yes or No)</td>
	</tr>
	<tr>	
		<td width=3>&nbsp;</td>
		<td class="SmallText" align="left"><input type="radio" name="Q5NA" value="Y">Yes  <input type="radio" name="Q5NA" value="N">No</td>
	</tr>
</table>
<dd>
</dd>
</dl>

<dl>
<table>
	<tr>
		<td width="3" valign=top>&nbsp;</td>
		<td><b><i>If you answered "Yes", which of these scenarios was the cause?</i></b></td>
	</tr>
	<tr>
		<td></td>
		<td class="smallText">(Please check all that apply.)</td>
	</tr>
</table>
<dd>
<table>
	<tr>
		<td><input type="checkbox" name="Q5N1" value="Y"></td>
		<td>I was diagnosed with a condition that required me to visit one or more specialists.</td>
	</tr> 
	<tr>
		<td><input type="checkbox" name="Q5N2" value="Y"></td>
		<td>I changed insurers.</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="Q5N3" value="Y"></td>
		<td>My insurance company no longer insures in my area or had gone out of business.</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="Q5N4" value="Y"></td>
		<td>I changed doctors.</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="Q5N5" value="Y"></td>
		<td>My doctor moved or retired.</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="Q5N6" value="Y"></td>
		<td>I have multiple residences resulting in more than one doctor.</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="Q5N7" value="Y"></td>
		<td>I moved from one residence to another.</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="Q5NO" value="Y"></td>
		<td>Other <input type="text" name="Q5O" size=40 maxLength=125></td>
	</tr>
</table>
</dd></dl>
<br>             
                 	
<!--     user input fields for Question 6    -->
<dl>
<table>
	<tr>
		<td width="3" valign=top><b>6.</b></td>
		<td><b>Do you trust the safety and security of your medical information with each of the following  medical entities?</b></td>
	</tr>
	<tr> 
		<td></td>
		<td class="smallText"> (Please answer each option below "Yes" or "No")</td>
	</tr>
</table>

<dd>
<table>
	<tr valign=top>
		<td class="SmallText"><input type="radio" name="Q6N1" value="Y"></td>
		<td class="SmallText">Yes</td>
		<td class="SmallText"><input type="radio" name="Q6N1" value="N"></td>
		<td class="SmallText">No</td>
		<td width=25 valign=middle align=right><img border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td> Medical services that target you as their customer.</td>
	</tr>
	<tr valign=top>
		<td class="SmallText"><input type="radio" name="Q6N2" value="Y"></td>
		<td class="SmallText">Yes</td>
		<td class="SmallText"><input type="radio" name="Q6N2" value="N"></td>
		<td class="SmallText">No</td>
		<td width=25 valign=middle align=right><img border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td>Your primary care doctor.</td>
	</tr>
	<tr valign=top>
		<td class="SmallText"><input type="radio" name="Q6N3" value="Y"></td>
		<td class="SmallText">Yes</td>
		<td class="SmallText"><input type="radio" name="Q6N3" value="N"></td>
		<td class="SmallText">No</td>
		<td width=25 valign=middle align=right><img border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td>Hospitals.</td> 		
	</tr>
	<tr valign=top>
		<td class="SmallText"><input type="radio" name="Q6N4" value="Y"></td>
		<td class="SmallText">Yes</td>
		<td class="SmallText"><input type="radio" name="Q6N4" value="N"></td>
		<td class="SmallText">No</td>
		<td width=25  align=right><img border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td>Specialists that assist with your care and treatments (e.g., other doctors, therapists, etc.)</td> 		
	</tr>	
	<tr valign=top>
		<td class="SmallText"><input type="radio" name="Q6N5" value="Y"></td>
		<td class="SmallText">Yes</td>
		<td class="SmallText"><input type="radio" name="Q6N5" value="N"></td>
		<td class="SmallText">No</td>
		<td width=25 valign=middle align=right><img border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td>Medical ancillary centers (e.g. X-Ray center, laboratories, walk-in clinic).</td> 		
	</tr>		
	<tr valign=top>
		<td class="SmallText"><input type="radio" name="Q6N6" value="Y"></td>
		<td class="SmallText">Yes</td>
		<td class="SmallText"><input type="radio" name="Q6N6" value="N"></td>
		<td class="SmallText">No</td>
		<td width=25 valign=middle align=right><img border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td>Pharmaceutical companies.</td> 		
	</tr>
	<tr valign=top>
		<td class="SmallText"><input type="radio" name="Q6N7" value="Y"></td>
		<td class="SmallText">Yes</td>
		<td class="SmallText"><input type="radio" name="Q6N7" value="N"></td>
		<td class="SmallText">No</td>
		<td width=25 valign=middle align=right><img border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td>Pharmacies, prescription centers.</td> 		
	</tr>			
	<tr valign=top>
		<td class="SmallText"><input type="radio" name="Q6NO" value="Y"></td>
		<td class="SmallText">Yes</td>
		<td class="SmallText"><input type="radio" name="Q6NO" value="N"></td>
		<td class="SmallText">No</td>
		<td width=25 valign=middle align=right><img border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td>Other <input type="text" name="Q6O" size=40 maxLength=125</td>		
	</tr>				
</table>
</dd></dl>
<br>                     

<!--     user input fields for Question 7   -->
<dl>
<table>
	<tr>
		<td width="3" valign=top><b>7.</b></td>
		<td><b>Solorte is a new membership service company that is going to greatly improve your health care by empowering you with an easy way to collect your medical history and maintain that information for a lifetime.</b></td>
	</tr>
	<tr>
		<td width="3" height=1 colspan=2></td>
	</tr>
	<tr>
		<td width="3"></td>
		<td><b>Your financial history is maintained with more care and diligence. Anytime you apply for a loan, or cash a check, your financial status is reviewed in detail. The medical industry does not	manage your health care information with the same precision. Solorte intends to remedy this imbalance by providing a service that will aggregate and manage your medical records.</b></td>
	</tr>
	<tr>
		<td width="3" height=1 colspan=2></td>
	</tr>
	<tr>
		<td width="3"></td>
		<td><b>What is your level of interest in such a service?</b> </td>
	</tr>
	<tr>	
		<td></td>
		<td class="smallText"> (Please check only one)</td>
	</tr>
</table>

<dd>
<table>
	<tr>
		<td valign=top><input type="radio" name="Q7" value="1"></td> 
		<td>Very interested.</td>
	</tr>
	<tr>
		<td valign=top><input type="radio" name="Q7" value="2"></td>
		<td>Somewhat interested.</td>
	</tr>
		<tr>
		<td valign=top><input type="radio" name="Q7" value="3"></td>
		<td>Neither interested nor disinterested.</td>
	</tr>
	<tr>
		<td valign=top><input type="radio" name="Q7" value="4"></td>
		<td>Somewhat disinterested</td>
	</tr>
	<tr>
		<td valign=top><input type="radio" name="Q7" value="4"></td>
		<td>Very disinterested</td>
	</tr>
</table>
</dd></dl>
<dl>
<table>
	<tr>
		<td width="3" valign=top>&nbsp;</td>
		<td><b>Why did you choose that answer?</b></td>
	</tr>
</table>

<dd>
<table>
	<tr>
		<td valign=top><textarea rows="4" cols="60" name="Q7B"> </textarea></td>
	</tr>
</table>
</dd></dl>
<br>             

<!--     user input fields for Question 8    -->
<dl>
<table>
	<tr>
		<td width="3" valign=top><b>8.</b></td>
		<td><b>If you were willing to purchase a service to manage your medical information,who would you be most likely to purchase it for?</td>
	</tr>
	<tr>
		<td></td>
		<td class="smallText">(Please answer each option below "Yes" or "No")</td>
	</tr>
</table>

<dd>
<table>
	<tr>
		<td  class="SmallText"><input type="radio" name="Q8N1" value="Y"></td>
		<td class="SmallText">Yes</td>
		<td class="SmallText"><input type="radio" name="Q8N1" value="N"></td>
		<td class="SmallText">No</td>
		<td width=25 align=right><img border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td>Self.</td>		
	</tr>
	<tr>
		<td class="SmallText"><input type="radio" name="Q8N2" value="Y"></td>
		<td class="SmallText">Yes</td>
		<td class="SmallText"><input type="radio" name="Q8N2" value="N"></td>
		<td class="SmallText">No</td>
		<td width=25 align=right><img border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td>Spouse.</td>		
	</tr>
	<tr>
		<td class="SmallText"><input type="radio" name="Q8N3" value="Y"></td>
		<td class="SmallText">Yes</td>
		<td class="SmallText"><input type="radio" name="Q8N3" value="N"></td>
		<td class="SmallText">No</td>
		<td width=25 align=right><img border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td>Parents.</td>		
	</tr>
	<tr>
		<td class="SmallText"><input type="radio" name="Q8N4" value="Y"></td>
		<td class="SmallText">Yes</td>
		<td class="SmallText"><input type="radio" name="Q8N4" value="N"></td>
		<td class="SmallText">No</td>
		<td width=25 align=right><img border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td>Children.</td>
	</tr>
	<tr>
		<td class="SmallText"><input type="radio" name="Q8NO" value="Y"></td>
		<td class="SmallText">Yes</td>
		<td class="SmallText"><input type="radio" name="Q8NO" value="N"></td>
		<td class="SmallText">No</td>
		<td width=25 align=right><img border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td>Other. <input type="text" name="Q8O" size=40 maxLength=125></td>		
	</tr>
</table>
</dd></dl>
<br>                        

<!--     user input fields for Question 9    -->
<dl>
<table>
	<tr>
		<td width="3" valign=top><b>9.</b></td>
		<td><b>If you subscribed to a service to manage your medical information, in what format would you prefer to view your information?</b></td>
	</tr>
	<tr> 
		<td></td>
		<td class="smallText"> (Please check only one)</td>
	</tr>
</table>

<dd>
<table>
	<tr>
		<td valign=top><input type="radio" name="Q9" value="1"></td> 
		<td>Mobile electronic device or media you own that can be read by any computer and which you authorize access to.</td>
	</tr>
	<tr>
		<td valign=top><input type="radio" name="Q9" value="2"></td>
		<td>Compact Disc (CD) you own that can be read by any computer and which you authorize access to.</td>
	</tr>
	<tr>
		<td valign=top><input type="radio" name="Q9" value="3"></td>
		<td>Highly secure Internet connection which you authorize access to.</td>
	</tr>
	<tr>
		<td valign=top><input type="radio" name="Q9" value="4"></td>
		<td>Faxed paper copy that you hand directly to a medical entity.</td>
	</tr>
	<tr>
		<td valign=top><input type="radio" name="Q9" value="4"></td>
		<td>Mailed paper copy that you hand directly to a medical entity</td>
	</tr>
	<tr>
		<td valign=top><input type="radio" name="Q9" value="O"></td>
		<td>Other <input type="text" name="Q9O" size=40 maxLength=125></td>
	</tr>
</table>
</dd></dl>
<br>                     

<!--     user input fields for Question 10    -->
<dl>
<table>
	<tr>
		<td width = "3" valign=top><b>10.</b></td>
		<td><b>What is the most you would pay annually to have your  medical information securely managed for you? </b></td>
	</tr>
	<tr> 
		<td></td>
		<td class="smallText"> (Please check only one)</td>
	</tr>
</table>
<dd>
<table>
	<td>
		<table>
			<tr>
				<td valign=top><input type="radio" name="Q10" value="1"></td> 
				<td>$50 - $99.</td>
			</tr>
			<tr>
				<td valign=top><input type="radio" name="Q10" value="2"></td>
				<td>$100 - $149.</td>
			</tr>
			<tr>
				<td valign=top><input type="radio" name="Q10" value="3"></td>
				<td>$150 - $199.</td>
			</tr>
			<tr>
				<td valign=top><input type="radio" name="Q10" value="4"></td>
				<td>$200 - $249.</td>
			</tr>
			<tr>
				<td valign=top><input type="radio" name="Q10" value="5"></td> 
				<td>$250 - $299.</td>
			</tr>
			<tr>
				<td valign=top><input type="radio" name="Q10" value="6"></td>
				<td>$300 - $349.</td>
			</tr>
			<tr>
				<td valign=top><input type="radio" name="Q10" value="7"></td>
				<td>$350 - $399.</td>
			</tr>
			<tr>
				<td valign=top><input type="radio" name="Q10" value="8"></td>
				<td>$400 - $449.</td>
			</tr>
			<tr>
				<td valign=top><input type="radio" name="Q10" value="9"></td>
				<td>$450 - $499.</td>
			</tr>
			<tr>
				<td valign=top><input type="radio" name="Q10" value="10"></td>
				<td>$500 - $549.</td>
			</tr>
		</table>
	</td>
	<td width=15>&nbsp;</td>
	<td>
		<table>
			<tr>
				<td valign=top><input type="radio" name="Q10" value="11"></td> 
				<td>$550 - $599.</td>
			</tr>
			<tr>
				<td valign=top><input type="radio" name="Q10" value="12"></td>
				<td>$600 - $649.</td>
			</tr>
			<tr>
				<td valign=top><input type="radio" name="Q10" value="13"></td>
				<td>$650 - $699.</td>
			</tr>
			<tr>
				<td valign=top><input type="radio" name="Q10" value="14"></td>
				<td>$700 - $749.</td>
			</tr>
			<tr>
				<td valign=top><input type="radio" name="Q10" value="15"></td> 
				<td>$750 - $799.</td>
			</tr>
			<tr>
				<td valign=top><input type="radio" name="Q10" value="16"></td>
				<td>$800 - $849.</td>
			</tr>
			<tr>
				<td valign=top><input type="radio" name="Q10" value="17"></td>
				<td>$850 - $899.</td>
			</tr>
			<tr>
				<td valign=top><input type="radio" name="Q10" value="18"></td>
				<td>$900 - $949.</td>
			</tr>	
			<tr>
				<td valign=top><input type="radio" name="Q10" value="19"></td>
				<td>$950 - $999.</td>
			</tr>
			<tr>
				<td valign=top><input type="radio" name="Q10" value="20"></td>
				<td>$1,000 +.</td>
			</tr>
		</table>
	</td>	
</table>	
</dd></dl>
<br> 

<!--     user input fields for Question 11   -->
<dl>
<table>
	<tr>
		<td width="3" valign=top><b>11.</b></td>
		<td><b>In addition to the service we&rsquo;ve described, would you be interested in purchasing each of the following services</b></td>
	</tr>
	<tr>
		<td></td>
		<td class="smallText">(Please check all that apply.)</td>
	</tr>
</table>

<dd>
<table>
	<tr valign=top>
		<td class="SmallText"><input type="radio" name="Q11N1" value="Y"></td>
		<td class="SmallText">Yes</td>
		<td class="SmallText"><input type="radio" name="Q11N1" value="N"></td>
		<td class="SmallText">No</td>
		<td width=25 align=right><img border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td>A phone call and/or email service to remind you of annual/monthly/daily/hourly medical appointments, and prescription treatments.</td>
	</tr>
	<tr valign=top>
		<td class="SmallText"><input type="radio" name="Q11N2" value="Y"></td>
		<td class="SmallText">Yes</td>
		<td class="SmallText"><input type="radio" name="Q11N2" value="N"></td>
		<td class="SmallText">No</td>
		<td width=25 align=right><img border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td>Management of the consolidation and accessibility of all of your available medical information, and family medical history.</td>
	</tr>
	<tr valign=top>
		<td class="SmallText"><input type="radio" name="Q11N3" value="Y"></td>
		<td class="SmallText">Yes</td>
		<td class="SmallText"><input type="radio" name="Q11N3" value="N"></td>
		<td class="SmallText">No</td>
		<td width=25 align=right><img border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td>Access to information over and above your medical record required for submitting a medical insurance claim.</td>
	</tr>
	<tr valign=top>
		<td class="SmallText"><input type="radio" name="Q11N4" value="Y"></td>
		<td class="SmallText">Yes</td>
		<td class="SmallText"><input type="radio" name="Q11N4" value="N"></td>
		<td class="SmallText">No</td>
		<td width=25 align=right><img border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td>Insurance information to assist you and your doctors when submitting a claim.</td>
	</tr>
	<tr valign=top>
		<td class="SmallText"><input type="radio" name="Q11N5" value="Y"></td>
		<td class="SmallText">Yes</td>
		<td class="SmallText"><input type="radio" name="Q11N5" value="N"></td>
		<td class="SmallText">No</td>
		<td width=25 align=right><img border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td>Articles, clinical trials information, research studies and government reports pertaining to an illness of interest or importance to you or your family.</td>
	</tr>
	<tr valign=top>
		<td class="SmallText"><input type="radio" name="Q11NO" value="Y"></td>
		<td class="SmallText">Yes</td>
		<td class="SmallText"><input type="radio" name="Q11NO" value="N"></td>
		<td class="SmallText">No</td>
		<td width=25 align=right><img border="0" src="images/goldbulsquare.gif" width="12" height="12"></td>
		<td>Other <input type="text" name="Q11O" size=40 maxLength=125></td>
	</tr>
</table>
</dd></dl>
<br>

<!--     user input fields for Question 12   -->                        
<dl>
<table>
	<tr>
		<td width="3" valign=top><b>12.</b></td>
		<td><b>If we have not addressed a medical issue that is important to you, please specify below:</b></td>
	</tr>
</table>

<dd>
<table>
	<tr>
		<td valign=top><textarea rows="4" cols="60" name="Q12O"> </textarea></td>
	</tr>
</table>
</dd></dl>
<br> 
             	
<!-- Email optin -->

<table>
	<tr>
		<td align=left><b>If you would like us to keep you informed about our services and our company, please enter your email address below.</b></td>
	</tr>
</table>
<br>
<center>
<table>
	<tr>
		<td halign=right><b>Email Address:</b></td>
		<td halign=left><input type="text" name="email" size=50 maxLength=50></td>
	</tr>
</table>
</center>
    
<!--     Submit and Reset buttons     -->
<br>
<p>
<center>
<input TYPE=submit  NAME="SUBMIT" VALUE="Submit Survey">
&nbsp;&nbsp;&nbsp;&nbsp;
<input TYPE=reset NAME="RESET" VALUE="Reset">
</center>
</p>

</form>
</body>
</html>