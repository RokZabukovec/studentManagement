
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
    ),
        'professor_id' => array(
            'input_name' => 'Professor',
            'required'   => true,
        )
    ));
    if($validation->passed()){
        DB::getInstance()->insert('subjects', array(
            'title' => Input::get('title'),
            'semester'  => Input::get('semester'),
            'hours'   => Input::get('hours'),
            'program_id' => Input::get('program_id'),
            'professor_id' => Input::get('professor_id'),
        ));
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


            <div class="dark-screen"></div>
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
                                <div class="form-group form-field input-group">
                                    <label for="professor_id">Professor</label>
                                    <select class="custom-select" id="professor_id" name="professor_id" style="display:block">
                                        <?php
                                        $professors = DB::getInstance()->query("SELECT * FROM " . Config::get('tables/professors/name') )->all();
                                        foreach($professors as $professor){
                                            echo "<option value='{$professor->professor_id}'>{$professor->first_name} {$professor->last_name}</option>";
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
            echo '<div class="container">';
            echo '<div class="page-title flex">';
            echo '<h1>Subjects</h1>';
            echo '<a href="#" class="add-new">New</a>';
            echo '</div>';

            foreach ($subjects as $subject){
                $program = DB::getInstance()->get('programs', array('program_id', '=', $subject->program_id))->first()->program_name;

                echo "<div class='student-card flex justify-content-between align-center'>";
                echo "<div class='basic-info'>";
                echo "<h3>{$subject->title}</h3>";
                echo "<p class='color-lighter'>{$program}</p>";
                echo "</div>";

                echo "<ul>";
                echo "<li>Semester: {$subject->semester}</li>";
                echo "<li>Hours: {$subject->hours}</li>";
                echo "</ul>";

                echo "<div class='dropdown'>";
                echo "<button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> Action</button>";
                echo "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>";
                echo "<a class='warning dropdown-item deleteBtn' href='delete.php?subject_id=". $subject->subject_id  ."'>Delete</a>";
                echo "<a class='dropdown-item' href='singleSubject.php?subject_id=" . $subject->subject_id . "'>View</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        }else{
            echo "<h3>No subjects found</h3>";
        }
    }
    echo "</div>";
    ?>

    <?php require_once 'includes/footer.php' ?>
