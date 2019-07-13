
<?php
require_once 'core/init.php';
    if(isset($_GET['student_id'])){
        $studentID = $_GET['student_id'];
        $_SESSION['student_id'] = $_GET['student_id'];
        $students = DB::getInstance()->get('students', array('student_id', '=', $studentID))->first();
        $program = DB::getInstance()->get('programs', array('program_id', '=', $students->program_id))->first();
        $subjects = DB::getInstance()->get('subjects', array('program_id', '=', $program->program_id))->all();
    }else{
        Redirect::to("login");
    }

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/style.css">
    <script>
        function loadExams(subject){
                let ajaxReq = new XMLHttpRequest();
                ajaxReq.onreadystatechange = function(){
                    if(this.readyState === 4 && this.status === 200){
                        document.getElementById('output').innerHTML = this.responseText;
                    }
                };
            ajaxReq.open("GET", "exams.php?subject_id=" + subject);
            ajaxReq.send();
        }
    </script>
    <title><?php echo $students->first_name . ' ' . $students->last_name ?></title>
</head>
<body>
<div class="container-fluid">

    <?php
    if(Session::exists('user')){
        functionsMenu();
        echo "<div class='container'>";
        echo "<div>";
            echo "<h1>{$students->first_name} {$students->last_name}</h1>";
            echo "<p>{$program->program_name}</p>";
        echo "</div>";
        echo "<div>";
        echo "<select onchange='loadExams(this.value)'>";
        echo "<option>-</option>";
        foreach($subjects as $subject){
              echo "<option value='{$subject->subject_id}'>{$subject->title}</option>";
        }
        echo "</select>";
        echo "</div>";
    }else{
        Redirect::to('login');
    }
    ?>
        <div id="output">
            <!--Div for displaying exams for the selected subject using AJAX.-->
        </div>
</div>
    <?php include 'includes/footer.php';?>