
<?php require_once 'core/init.php';?>
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
        die("Validation failed");
    }
}
$exams = DB::getInstance()->get('exams', array('subject_id', '=', $subject->subject_id))->all();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php require_once 'includes/style.php' ?>
    <title>Subject</title>
</head>
<body>
    <div class="container">
        <?php echo "<h1>{$subject->title}</h1>"?>

        <hr>
        <h3>Exams</h3>
        <?php
        if($exams){
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
                echo "<td>" .$exam->duration . "</td>";
                echo "<td><a href='delete.php?exam_id={$exam->exam_id}'>Delete</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        }else{
            echo "<h3>Subject has no exams.</h3>";
        }
        ?>

        <form action="" method="POST">
            <div class="form-group">
                <label for="date_time">Date and time</label>
                <input class="form-control" type="datetime-local" name="date_time">
            </div>
            <div class="form-group">
                <label for="duration">Duration</label>
                <input class="form-control" type="number" name="duration">
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="submit" value="Submit">
            </div>
        </form>
    </div>
    <?php require_once 'includes/scripts.php' ?>
</body>
</html>