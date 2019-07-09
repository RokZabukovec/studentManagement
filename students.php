<?php
require_once 'core/init.php';

if(!Session::get('user')){
    Redirect::to(403);
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
        Session::put('Inserted', 'Record was inserted');
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
    <h1>Students</h1>
    <div class="row">
        <form action="" method="POST" class="col-md-6 col-sm-12">
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
                <label for="program">Program</label>
                <select class="custom-select" name="program_id">
                    <?php
                    $programs = DB::getInstance()->query("SELECT * FROM programs")->all();
                    foreach($programs as $program){
                        echo "<option value='{$program->program_id}'>{$program->program_name}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group form-field">
                <input class="btn btn-primary" type="submit" name="submit" value="Save">
            </div>
        </form>
    </div>
    <br>
    <hr>
    <br>
    <?php
    $students = DB::getInstance()->query("SELECT * FROM students")->all();
    if ($students){
        echo "<table class='table'>";
        echo "<thead class='thead-light'>";
            echo "<tr> <th scope='col'>Firstname</th><th scope='col'>Lastname</th><th scope='col'>Birthday</th><th scope='col'>Address</th><th scope='col'>Program</th><th scope='col'>Action</th></tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($students as $student){
            $program = DB::getInstance()->get('programs', array('program_id', '=', $student->program_id))->first()->program_name;
            echo "<tr>";
            echo "<td>" . $student->first_name  . "</td>" .
                "<td>"  . $student->last_name   . "</td>" .
                "<td>"  . $student->birthday    . "</td>".
                "<td>"  . $student->address     . "</td>" .
                "<td>"  . $program              . "</td>";
            echo "<td><div class='dropdown'>";
            echo "<button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> Action</button>";
               echo "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>";
                 echo "<a class='dropdown-item' href='delete.php?student_id=". $student->student_id ."'>Delete</a>";
                echo "<a class='dropdown-item' href='singleStudent.php?student_id=" . $student->student_id . "'>View</a>";
               echo "</div>";
             echo "</div></td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }else{
        echo "<h3>No students found.</h3>";
    }



    ?>
<?php require_once 'includes/footer.php' ?>
