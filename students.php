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
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php require_once 'includes/style.php' ?>
    <title>Students</title>
</head>
<body class="container">
<h1>Students</h1>
<?php
    if(Session::exists('user')){
        loggedInMenu();
        functionsMenu();
    }else{
        Redirect::to('login');
    }
?>
    <div class="row">
        <?php
        if(Session::exists('Inserted')){
            Session::flash('Inserted');
        }
        ?>
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
            echo "<tr> <th scope='col'>Firstname</th><th scope='col'>Lastname</th><th scope='col'>Birthday</th><th scope='col'>Address</th><th scope='col'>Program</th><th scope='col'>Delete</th><th scope='col'>Details</th></tr>";
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
            echo "<td><a class='btn btn-primary deleteBtn' href='delete.php?student_id=". $student->student_id ."'>Delete</a></td>";
            echo "<td><a href='singleStudent.php?student_id=" . $student->student_id . "'>View profile</a></td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }else{
        echo "<h3>No students found.</h3>";
    }



    ?>
<?php require_once 'includes/scripts.php' ?>
</body>
</html>