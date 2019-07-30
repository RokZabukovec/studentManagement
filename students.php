<?php
require_once 'core/init.php';
if(isset($_GET['exam_id'])){
    Student::studentExam($_SESSION['student_id'], $_REQUEST['exam_id']);
}
if(isset($_REQUEST['unregister_exam_id'])){
    DB::getInstance()->query("DELETE FROM student_exam_registration WHERE exam_id = {$_REQUEST['unregister_exam_id']} AND student_id = {$_SESSION['student_id']}");
    Redirect::to("singleStudent.php?student_id={$_SESSION['student_id']}");
}
if(Input::exists()){
    $validate = new Validation();
    $validation = $validate->check($_POST, array(
        'first_name' => array(
            'input_name' => 'First name',
            'min_length' => 2,
            'max_length' => 50,
            'required'   => true,
        ),
        'last_name' => array(
            'input_name' => 'Last name',
            'min'        => 2,
            'max'        => 50,
            'required'   => true,
        ),
        'birthday' => array(
            'input_name' => 'Birthday',
            'required'   => true,
        ),
        'address' => array(
            'input_name' => 'Address',
            'required'   => true,
        ),
        'program_id' => array(
            'input_name' => 'Program',
            'required'   => true,
        )
    ));
    if($validation->passed()){
        DB::getInstance()->insert('students', array(
            'first_name' => Input::get('first_name'),
            'last_name'  => Input::get('last_name'),
            'birthday'   => Input::get('birthday'),
            'address'    => Input::get('address'),
            'program_id' => Input::get('program_id'),
        ));
    }
}

?>
<?php include 'includes/header.php'?>
<?php
    if(Session::exists('user')){
        functionsMenu();
    }else{
        Redirect::to('login');
    }
?>
<div class="dark-screen"></div>
    <div class="row">
        <div class="modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add new student</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form action="" method="POST" class="">
                        <div class="form-group form-field">
                            <label for="first_name">First name</label>
                            <input class="form-control" type="text" name="first_name">
                        </div>
                        <div class="form-group form-field">
                            <label for="last_name">Last name</label>
                            <input class="form-control" type="text" name="last_name">
                        </div>
                        <div class="form-group form-field">
                            <label for="birthday">Birthday</label>
                            <input class="form-control" type="date" name="birthday">
                        </div>
                        <div class="form-group form-field">
                            <label for="address">Address</label>
                            <input class="form-control" type="text" name="address">
                        </div>
                        <div class="form-group form-field input-group">
                            <label class="mr-sm-2" for="program">Program</label>
                            <select class="custom-select" name="program_id">
                                <?php
                                $programs = DB::getInstance()->query("SELECT * FROM programs")->all();
                                foreach($programs as $program){
                                    echo "<option value='{$program->program_id}'>{$program->program_name}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group form-field modal-footer">
                            <input class="btn btn-primary" type="submit" name="submit" value="Save">
                        </div>
                    </form>
                    </div>
                </div>
        </div>
    </div>
    <br>
    <hr>
    <br>
    <?php
    $students = DB::getInstance()->query("SELECT * FROM students")->all();
    if ($students){

        echo "<div class='container'>";
        echo '<div class="page-title flex">';
            echo '<h1>Students</h1>';
            echo '<a href="#" class="add-new">New</a>';
        echo '</div>';
        foreach ($students as $student) {
            $program = DB::getInstance()->get('programs', array('program_id', '=', $student->program_id))->first()->program_name;
            echo "<div class='student-card flex justify-content-between align-center'>";

                echo "<div class='basic-info'>";
                    echo "<h3>{$student->first_name} {$student->last_name}</h3>";
                    echo "<p class='color-lighter'>{$program}</p>";
                echo "</div>";

                echo "<ul>";
                    echo "<li>{$student->address}</li>";
                    echo "<li>{$student->birthday}</li>";
                echo "</ul>";

                echo "<div class='dropdown'>";
                    echo "<button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> Action</button>";
                    echo "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>";
                        echo "<a class='dropdown-item warning' href='delete.php?student_id=". $student->student_id ."'>Delete</a>";
                        echo "<a class='dropdown-item' href='singleStudent.php?student_id=" . $student->student_id . "'>View</a>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
        }
    }else{
        echo "<h3>No students found.</h3>";
    }



    ?>
<?php require_once 'includes/footer.php' ?>
