<?php 

function build_calendar($month,$year,$dateArray) { 

     // Create array containing abbreviations of days of week. 
     $daysOfWeek = array('Su','Mo','Tu','We','Th','Fr','Sa'); 

     // What is the first day of the month in question? 
     $firstDayOfMonth = mktime(0,0,0,$month,1,$year); 

     // How many days does this month contain? 
     $numberDays = date('t',$firstDayOfMonth); 

     // Retrieve some information about the first day of the 
     // month in question. 
     $dateComponents = getdate($firstDayOfMonth); 

     // What is the name of the month in question? 
     $monthName = $dateComponents['month']; 

     // What is the index value (0-6) of the first day of the 
     // month in question. 
     $dayOfWeek = $dateComponents['wday']; 

     // Create the table tag opener and day headers 

     $calendar = "<table class='calendar'>"; 
     $calendar .= "<caption>$monthName, $year</caption>"; 
     $calendar .= "<tr>"; 

     // Create the calendar headers 

     foreach($daysOfWeek as $day) { 
          $calendar .= "<th class='header'>$day</th>"; 
     }  

     // Create the rest of the calendar 

     // Initiate the day counter, starting with the 1st. 

     $currentDay = 1; 

     $calendar .= "</tr><tr>"; 

     // The variable $dayOfWeek is used to 
     // ensure that the calendar 
     // display consists of exactly 7 columns. 

     if ($dayOfWeek > 0) {  
          $calendar .= "<td colspan='$dayOfWeek'>&nbsp;</td>";  
     } 

     while ($currentDay <= $numberDays) { 

          // Seventh column (Saturday) reached. Start a new row. 

          if ($dayOfWeek == 7) { 

               $dayOfWeek = 0; 
               $calendar .= "</tr><tr>"; 

          } 

         // Is the $currentDay a member of $dateArray? If so, 
         // the day should be linked. 

         if (in_array($currentDay,$dateArray)) { 

            $date = "$year-$month-$currentDay"; 

            $calendar .= "<td class='linkedday'> 
                       <a href='blogs.php?date=$date' 
                       class='calendarlink'>$currentDay</a></td>"; 

          // $currentDay is not a member of $dateArray. 

          } else { 

               $calendar .= "<td class='day'>$currentDay</td>"; 

          } 

          // Increment counters 
  
          $currentDay++; 
          $dayOfWeek++; 

     } 

     // Complete the row of the last week in month, if necessary 

     if ($dayOfWeek != 7) {  
      
          $remainingDays = 7 - $dayOfWeek; 
          $calendar .= "<td colspan='$remainingDays'>&nbsp;</td>";  

     } 

     $calendar .= "</table>"; 

     return $calendar; 

} 

?> 
<html>
<head>
<title>Test</title>

<style type="text/css">


/* caption determines the style of 
   the month/year banner above the calendar. */ 

caption  
     { 
     font-family:arial,helvetica;  
     font-size:11px;  
     color: black; 
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

</head>

<body>

</body>
</html>
