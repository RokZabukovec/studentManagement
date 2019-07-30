<?php
require_once 'core/init.php';

if(isset($_POST['grade']) && !empty($_POST['grade'])){
   try{
       DB::getInstance()->insert('student_subject', array(
           'student_id' => $_SESSION['student_id'],
           'subject_id' => $_SESSION['subject_id'],
           'Grade'      => $_POST['grade']
       ));
       Session::put('Inserted', 'Success');
  }catch (PDOException $e){
        Session::put('Inserted', 'Failed');
   }finally{
       Redirect::to("singleStudent.php?student_id={$_SESSION['student_id']}");
   }
}

if(isset($_REQUEST['subject_id'])){
    Session::put('subject_id', $_REQUEST['subject_id']);
   $results =  Student::showExams($_GET['subject_id']);
//   $subjectPassed = DB::getInstance()->query("SELECT * FROM student_subject WHERE subject_id={$_REQUEST['subject_id']} AND student_id={$_SESSION['student_id']}")->first();
//   echo $subjectPassed->subject_id;
   if($results){
       foreach ((array)$results as $result){
           $student_registered = DB::getInstance()->query("SELECT * FROM student_exam_registration WHERE student_id = {$_SESSION['student_id']} AND exam_id={$result->exam_id}")->all();
           $graded = DB::getInstance()->query("SELECT Grade FROM student_subject WHERE student_id={$_SESSION['student_id']} AND subject_id={$_GET['subject_id']}")->all();
            if($graded){
                echo "<h1>Graded: {$graded[0]->Grade}</h1>";
                die();
            }
           $classes = $student_registered ? "exam-registered-bg" : "";
           echo "<div class='{$classes} student-card flex justify-content-between align-center'>";
               echo "<div class='basic-info'>";
                   echo "<h3><b>Date:</b> {$result->date_time}</h3>";
                   echo "<h4 class='color-lighter'><b>Duration</b> {$result->duration} min</h4>";
                   if($student_registered && $graded){
                       echo "Grade: {$graded[0]->Grade}";
                   }else if($student_registered && !$graded){
                       echo "<form class='form-inline' action='exams.php' method='POST'>";
                       echo "<select id='gradeExam' name='grade'>";
                           echo '<option value=6>6</option>';
                           echo '<option value=7>7</option>';
                           echo '<option value=8>8</option>';
                           echo '<option value=9>9</option>';
                           echo '<option value=10>10</option>';
                       echo '</select>';
                       echo "<button class='btn btn-primary ml-3' type='submit'>Grade student</button>";
                       echo "</form>";
                   }else{
                       echo "";
                   }
               echo "</div>";
           if(!$student_registered){
               echo "<div class='dropdown'>";
                   echo "<button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> Action</button>";
                   echo "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>";
                        echo "<a class='dropdown-item' href='students.php?exam_id={$result->exam_id}'>Register</a>";
                   echo "</div>";
               echo "</div>";
               echo "</div>";
           }else{
               echo "<div>";
               if(!$graded){
                   echo "<a class='btn btn-warning' href='students.php?unregister_exam_id={$result->exam_id}'>Unregister</a>";
               }else{
                   echo "Exam completed.";
               }
               echo "</div>";
               echo "</div>";
           }
       }
   }else{
       echo "No exams found";
   }
}



