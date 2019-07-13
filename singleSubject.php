
<?php require_once 'core/init.php';?>
<?php include 'includes/header.php'?>
<?php

$subject = $_GET['subject_id'];
$subject = DB::getInstance()->get('subjects', array('subject_id', '=', $subject))->first();
if(Input::exists()){
    $validate = new Validation();
    $validation = $validate->check($_POST, array(
        'date_time' => array(
            'input_name' => 'Date time',
            'required'   => true,
        ),
        'duration' => array(
            'input_name' => 'Duration',
            'required'   => true
        )
    ));
    if($validation->passed()){
        DB::getInstance()->insert('exams', array(
            'date_time' => Input::get('date_time'),
            'duration'  => Input::get('duration'),
            'subject_id'   => $subject->subject_id
        ));
        Session::flash('Inserted', 'Record was inserted');
    }else{
        die(Input::get('duration'));
    }
}
$exams = DB::getInstance()->get('exams', array('subject_id', '=', $subject->subject_id))->all();
?>
        <?php functionsMenu(); ?>
        <div class="page-title flex">
            <?php echo "<h1>{$subject->title}</h1>"?>
            <a href="#" class="add-new">New</a>
        </div>
        <?php
        if($exams){
            echo "<h3>Exams</h3>";
            echo "<table class='table'>";
                echo "<thead>";
                    echo "<tr>";
                        echo "<th>Date and time</th>";
                        echo "<th>Duration</th>";
                        echo "<th>Action</th>";
                    echo "</tr>";
                echo "</thead>";
            foreach($exams as $exam){
                echo "<tr>";
                echo "<td>" . $exam->date_time . "</td>";
                echo "<td>" .$exam->duration . " min</td>";
                echo "<td><a href='delete.php?exam_id={$exam->exam_id}'>Delete</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        }else{
            echo "<h3>Subject has no exams.</h3>";
        }
        ?>

    <div class="modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add new exam</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="date_time">Date and time</label>
                            <input class="form-control" type="datetime-local" name="date_time">
                        </div>
                        <div class="form-group">
                            <label for="duration">Duration</label>
                            <input class="form-control" type="number" name="duration" min="1" max="60">
                        </div>
                        <div class="form-group form-field modal-footer">
                            <input class="btn btn-primary" type="submit" name="submit" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php require_once 'includes/footer.php' ?>
