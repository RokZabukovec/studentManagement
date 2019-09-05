
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

if(isset($_GET['exam_id'])){
    $examID = $_GET['exam_id'];
    $students = DB::getInstance()->insert('student_exam_registration', array(
            'student_id' => $_GET['student_id'],
            'exam_id'    => $examID
    ));
    Redirect::to('singleStudent.php?student_id=' . $_/['student_id']);
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" integrity="sha256-PHcOkPmOshsMBC+vtJdVr5Mwb7r0LkSVJPlPrp/IMpU=" crossorigin="anonymous" />
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
    if(Session::exists('Inserted')){
        if(Session::get('Inserted') == 'Success'){
            echo "<div class='animated fadeInRightBig message message-success position-fixed'>" .  Session::flash('Inserted') .  "</div>";
        }elseif (Session::get('Inserted') == 'Failed'){
            echo "<div class='animated fadeInRightBig message message-failed position-fixed'>" .  Session::flash('Inserted') .  "</div>";
        }
    }
?>

    <div class="dark-screen"></div>
    <div class="modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Index</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    $program_id = DB::getInstance()->query("SELECT program_id FROM students WHERE student_id={$studentID}")->first()->program_id;
                    $program_subjects = DB::getInstance()->query("SELECT * FROM subjects WHERE program_id={$program_id} ORDER BY semester ASC")->all();
                    foreach ($program_subjects as $program_subject){
                        $grade = DB::getInstance()->query("SELECT * FROM student_subject WHERE student_id={$_SESSION['student_id']} AND subject_id={$program_subject->subject_id}")->all();
                        if($grade){
                            echo "<p class='success'>SEMESTER:{$program_subject->semester}  {$program_subject->title} - {$grade[0]->Grade} &#10004</p>";
                        }else{
                            echo "<p>SEMESTER:{$program_subject->semester}  {$program_subject->title} - Not graded</p>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    if(Session::exists('user')){
        functionsMenu();
        echo "<div class='container'>";
        echo "<div>";
            echo "<h1>{$students->first_name} {$students->last_name}</h1>";
                echo '<a href="#" class="add-new">Index</a>';
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