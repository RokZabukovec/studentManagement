<?php require_once 'core/init.php'; ?>
<?php include 'includes/header.php'; ?>

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