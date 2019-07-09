<?php
require_once 'core/init.php';
if(isset($_REQUEST['subject_id'])){
   $results =  Student::showExams($_GET['subject_id']);
   if($results){
       echo "<table class='table'>";
       echo "<thead>";
       echo "<tr>";
       echo "<th>Date time</th>";
       echo "<th>Duration</th>";
       echo "</tr>";
       echo "</thead>";
       foreach ((array)$results as $result){
           echo "<tr>";
           echo "<td>" . $result->date_time . "</td>";
           echo "<td>" . $result->duration . "</td>";
           echo "</tr>";
       }
       echo "</table>";
   }else{
       echo "No exams found";
   }
}