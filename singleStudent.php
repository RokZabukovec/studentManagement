
<?php
    require_once 'core/init.php';
    $studentID = $_GET['student_id'];
    $students = DB::getInstance()->get('students', array('student_id', '=', $studentID))->first();
    $program = DB::getInstance()->get('programs', array('program_id', '=', $students->program_id))->first();
    $subjects = DB::getInstance()->get('subjects', array('program_id', '=', $program->program_id))->all();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php require_once 'includes/style.php' ?>
    <title><?php echo $students->first_name . ' ' . $students->last_name ?></title>
</head>
<body>
    <?php
    if(Session::exists('user')){
        loggedInMenu();
        functionsMenu();

        echo "<h1>{$students->first_name} {$students->last_name}</h1>";
        echo "<p>{$program->program_name}</p>";

        echo "<ul>";
        foreach($subjects as $subject){
            echo "<li>{$subject->title}</li>";
        }
        echo "</ul>";
    }else{
        Redirect::to('login');
    }
    ?>

    <?php require_once 'includes/scripts.php' ?>
</body>
</html>