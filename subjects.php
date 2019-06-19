
<?php require_once 'core/init.php';?>

<?php
if(Input::exists()){
    $validate = new Validation();
    $validation = $validate->check($_POST, array(
        'title' => array(
            'input_name' => 'Title',
            'min_length' => 2,
            'max_length' => 80,
            'required'   => true,
        ),
        'semester' => array(
            'input_name' => 'semester',
            'required'   => true
        ),
        'hours' => array(
            'input_name' => 'Hours',
            'required'   => true,
        ),
        'program_id' => array(
            'input_name' => 'Program',
            'required'   => true,
        )
    ));
    if($validation->passed()){
        DB::getInstance()->insert('subjects', array(
            'title' => Input::get('title'),
            'semester'  => Input::get('semester'),
            'hours'   => Input::get('hours'),
            'program_id' => Input::get('program_id'),
        ));
        Session::flash('Inserted', 'Record was inserted');
    }else{
        die("Validation failed");
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
    <title>Subjects</title>
</head>
<body>
    <div class="container">
        <h1>Subjects</h1>
        <?php
        if(Session::exists('user')){
            loggedInMenu();
            functionsMenu();
        }else{
            Redirect::to('index');
        }
        ?>
        <form action="" method="POST" class="col-md-6 col-sm-12">
            <div class="form-group form-field">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title">
            </div>
            <div class="form-group form-field">
                <label for="semester">Semester</label>
                <input class="form-control" type="number" name="semester">
            </div>
            <div class="form-group form-field">
                <label for="hours">Hours</label>
                <input class="form-control" type="number" name="hours">
            </div>
            <div class="form-group form-field input-group">
                <label for="program_id">Program</label>
                <select class="custom-select" name="program_id">
                    <?php
                    $programs = DB::getInstance()->query("SELECT * FROM " . Config::get('tables/programs/name') )->all();
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
    <?php
    if(Session::exists('user')){
        $subjects = DB::getInstance()->query("SELECT * FROM subjects")->all();
        if($subjects){
            echo "<div class='container'>";
            Session::flash('Inserted');
            echo "<table class='table'>";
            echo "<thead class='thead-light'>";
            echo "<tr> <th>Title</th><th>Semester</th><th>Hours</th><th>Program</th><th>Delete</th><th>Details</th></tr>";
            echo "</thead>";
            foreach ($subjects as $subject){
                $program = DB::getInstance()->get('programs', array('program_id', '=', $subject->program_id))->first()->program_name;
                echo "<tr>";
                echo "<td>" . $subject->title . "</td>" .
                    "<td>" . $subject->semester . "</td>" .  "<td>" . $subject->hours . "</td>".  "<td>" . $program . "</td>";
                echo "<td><a class='btn btn-primary' href='delete.php?subject_id=". $subject->subject_id ."'>Delete</a></td>";
                echo "<td><a href='singleSubject.php?subject_id=" . $subject->subject_id . "'>View subject</a></td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "</div>";
        }else{
            echo "<div class='container'>";
                echo "<h3>No subjects found</h3>";
            echo "</div>";
        }
    }
    ?>
</body>
</html>