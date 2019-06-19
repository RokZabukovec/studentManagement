
<?php require_once 'core/init.php';?>
<?php
    $subject = $_GET['subject_id'];
    $subject = DB::getInstance()->get('subjects', array('subject_id', '=', $subject))->first();
    $exams = DB::getInstance()->get('exams', array('subject_id', '=', $subject->subject_id))->all();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Subject</title>
</head>
<body>
<?php echo "<h1>{$subject->title}</h1>"?>

<hr>

<?php
    if($exams){
        foreach($exams as $exam){
            echo $exam->date_time;
            echo $exam->duration;
        }
    }else{
        echo "<h3>Subject has no exams.</h3>";
    }



?>


</body>
</html>