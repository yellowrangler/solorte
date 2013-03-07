<?php 

//----------------------------------------------------------------------------------------------------------
// Function to validate dates sent in in mm dd yyyy format
//----------------------------------------------------------------------------------------------------------
function ValiDate($mm, $dd, $yyyy) 
{
	$result = 0;
	
	if ( ($mm > 0) and ($mm < 13) )
	{
		if ( ($dd > 0) and ($dd < 32) )
		{
			if ($yyyy > 1800)
			{
				$result = 1;
			}
		}
	}	
	   
	return $result;
	
} // end of ValiDate

//----------------------------------------------------------------------------------------------------------
// Function to validate time sent in in hh mm ampm indicator format
//----------------------------------------------------------------------------------------------------------
function ValiTime($hh, $mm, $ampmind) 
{
	$result = 0;
	
	if ( ($hh >= 0) and ($hh < 13) )
	{
		if ( ($mm >= 0) and ($mm < 61) )
		{
			$result = 1;
			if (strcmp(strtoupper($ampmind), "AM")) 
			{
				if (strcmp(strtoupper($ampmind), "PM")) 
				{
					$result = 0;
				}	
			}
		}
	}	
	   
	return $result;
	
} // end of ValiTime

//----------------------------------------------------------------------------------------------------------
// Function to validate if PM. sent ampm indicator
//----------------------------------------------------------------------------------------------------------
function isPM($ampmind) 
{
	$result = 1;
		
	if (strcmp(strtoupper($ampmind), "PM")) 
	{
		$result = 0;
	}
	   
	return $result;
	
} // end of ValiTime

//----------------------------------------------------------------------------------------------------------
// Function to return Date as mm/dd/yyyy from mysql datetime stamp
//----------------------------------------------------------------------------------------------------------
function CovertMySQLDate($DateTime, $DateType, $DisplayFormat) 
{
	$result = "";
	
	if ($DateTime == "")
		return $result;
		
	switch ($DateType)
	{
		case '1':
			//  1 means Date type
			$tmpDate = explode("-", $DateTime);
			break;
			
		case '2':
			// 2 means DateTime type
			$tmpsplit = explode(" ", $DateTime);
			$tmpDate = explode("-", $tmpsplit[0]);
			break;
			
	}		
	
	switch ($DisplayFormat)
	{
		case '1':
			// Display hh:mm:ss
			$result = sprintf("%02s/%02s/%04s",  $tmpDate[1], $tmpDate[2], $tmpDate[0]);
			break;
			
		case '9':	
			// Pass Back Array of YYYY MM DD
			$yyyy = sprintf("%04s",  $tmpDate[0]);
			$mm = sprintf("%02s",  $tmpDate[1]);
			$dd = sprintf("%02s",  $tmpDate[2]);
			$result = array ($tmpDate[0], $tmpDate[1], $tmpDate[2]);
			break;
	}

	return $result;
	
} // end of CovertMySQLDate

//----------------------------------------------------------------------------------------------------------
// Function to return Time as hh:mm:ss AMPM from mysql datetime stamp
//----------------------------------------------------------------------------------------------------------
function CovertMySQLTime($DateTime, $TimeType, $DisplayFormat) 
{
	$result = "";
	
	if ($DateTime == "")
		return $result;
		
	switch ($TimeType)
	{
		case '1':
			//  1 means Time type
			$tmpTime = explode(":", $DateTime);
			break;
			
		case '2':
			// 2 means DateTime type
			$tmpsplit = explode(" ", $DateTime);
			$tmpTime = explode(":", $tmpsplit[1]);
			break;
	}		
	
	switch ($DisplayFormat)
	{
		case '1':
			// Display hh:mm:ss
			$result = sprintf("%s:%02s:%02s",  $tmpTime[0], $tmpTime[1], $tmpTime[2]);
			break;
			
		case '2':	
			// Display hh:mm AM/PM
			if ($tmpTime[0] > 11)
			{
				if ($tmpTime[0] > 12)
				{
					$tmpAdjTime = $tmpTime[0] - 12;
					$result = sprintf("%s:%02s PM",  $tmpAdjTime, $tmpTime[1]);
				}
				else
				{
					$result = sprintf("%s:%02s PM",  $tmpTime[0], $tmpTime[1]);
				}	
			}
			else
			{
				$result = sprintf("%s:%02s AM",  $tmpTime[0], $tmpTime[1]);
			}	
			break;
			
		case '3':	
			// Display hh:ss 
			$result = sprintf("%s:%02s",  $tmpTime[0], $tmpTime[1]);
			break;
			
		case '4':	
			// Display hh:mm:ss AM/PM
			if ($tmpTime[0] > 11)
			{
				if ($tmpTime[0] > 12)
				{
					$tmpAdjTime = $tmpTime[0] - 12;
					$result = sprintf("%02s:%02s:%02s PM",  $tmpAdjTime, $tmpTime[1], $tmpTime[2]);
				}
				else
				{
					$result = sprintf("%02s:%02s:%02s PM",  $tmpTime[0], $tmpTime[1], $tmpTime[2]);
				}	
			}
			else
			{
				$result = sprintf("%02s:%02s:%02s AM",  $tmpTime[0], $tmpTime[1], $tmpTime[2]);
			}	
			break;
			
		case '9':	
			// Pass Back Array of hh mm ss ampm
			if ($tmpTime[0] > 11)
			{
				if ($tmpTime[0] > 12)
				{
					$hh =  sprintf("%2s", $tmpTime[0] - 12);
					
				}
				else
				{
					$hh =  sprintf("%2s", $tmpTime[0]);
				}	
				
				$ampm = "PM";
			}
			else
			{
				$hh =  sprintf("%2s", $tmpTime[0]);
				$ampm = "AM";
			}
			
			// Pass Back Array of hh mm ss ampm
			$mm = sprintf("%02s",  $tmpTime[1]);
			$ss = sprintf("%02s",  $tmpTime[2]);
			
			$result = array ($hh, $mm, $ss, $ampm);
			break;	
	}

	return $result;
	
} // end of CovertMySQLTimee

?>
