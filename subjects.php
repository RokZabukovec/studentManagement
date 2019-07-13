
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
<?php include 'includes/header.php'?>
        <?php
        if(Session::exists('user')){
            functionsMenu();
        }else{
            Redirect::to('index');
        }
        ?>
        <div class="page-title flex">
            <h1>Subjects</h1>
            <a href="#" class="add-new">New</a>
        </div>
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
                        <form action="" method="POST">
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
                                <select class="custom-select" id="program_id" name="program_id" style="display:block">
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
                </div>
            </div>
        </div>

    <?php
    if(Session::exists('user')){
        $subjects = DB::getInstance()->query("SELECT * FROM subjects")->all();
        if($subjects){
            Session::flash('Inserted');
            echo "<table class='table'>";
            echo "<thead class='thead-light'>";
            echo "<tr> <th>Title</th><th>Semester</th><th>Hours</th><th>Program</th><th>Action</th></tr>";
            echo "</thead>";
            foreach ($subjects as $subject){
                $program = DB::getInstance()->get('programs', array('program_id', '=', $subject->program_id))->first()->program_name;
                echo "<tr>";
                echo "<td>" . $subject->title . "</td>" .
                    "<td>" . $subject->semester . "</td>" .  "<td>" . $subject->hours . "</td>".  "<td>" . $program . "</td>";
                echo "<td><div class='dropdown'>";
                echo "<button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> Action</button>";
                echo "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>";
                echo "<a class='dropdown-item' href='delete.php?subject_id=". $subject->subject_id ."'>Delete</a>";
                echo "<a class='dropdown-item' href='singleSubject.php?subject_id=" . $subject->subject_id . "'>View</a>";
                echo "</div>";
                echo "</div></td>";
                echo "</tr>";
            }
            echo "</table>";
        }else{
            echo "<h3>No subjects found</h3>";
        }
    }
    ?>
    <?php require_once 'includes/footer.php' ?>
