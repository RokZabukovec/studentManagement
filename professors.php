<?php require_once 'core/init.php';?>
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
<body>
<h1>Professors</h1>
    <?php
    if(Session::exists('user')){
        loggedInMenu();
        functionsMenu();
    }else{
        Redirect::to('login');
    }

    ?>
    <?php
    $professors = DB::getInstance()->query("SELECT * FROM professors")->all();

    echo "<table style='width: 50%'>";
    echo "<tr><th>Title</th> <th>Firstname</th><th>Lastname</th><th>Subject</th><th>Phone</th></tr>";
    foreach ($professors as $professor){
        echo "<tr>";
        echo "<td>". $professor->title . "</td>"."<td>" . $professor->first_name . "</td>" .
            "<td>" . $professor->last_name . "</td>" ."<td>" . $professor->subject . "</td>". "<td>" . $professor->phone . "</td>";
        echo "</tr>";
    }
    echo "</table>";

    ?>
</body>
</html>