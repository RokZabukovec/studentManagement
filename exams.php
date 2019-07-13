<?php
require_once 'core/init.php';

if(isset($_REQUEST['subject_id'])){
   $results =  Student::showExams($_GET['subject_id']);
   if($results){

       foreach ((array)$results as $result){
           echo "<div class='student-card flex justify-content-between align-center'>";
               echo "<div class='basic-info'>";
                   echo "<h3><b>Date:</b> {$result->date_time}</h3>";
                   echo "<h4 class='color-lighter'><b>Duration</b> {$result->duration} min</h4>";
               echo "</div>";

               echo "<div class='dropdown'>";
                   echo "<button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> Action</button>";
                   echo "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>";
                        echo "<a class='dropdown-item' href='students.php?exam_id={$result->exam_id}'>Register</a>";
                   echo "</div>";
                echo "</div>";
            echo "</div>";
       }

   }else{
       echo "No exams found";
   }
}
