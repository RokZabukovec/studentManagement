<?php
    require_once "core/init.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php require_once 'includes/style.php' ?>
    <title>Student management</title>
</head>
    <body>
        <?php
        if(Session::exists('success')){
            echo Session::flash('success');
        }
        if(Session::exists('user')){
            loggedInMenu();
            functionsMenu();

            $user = new User();
            echo "<h3>Hello {$user->data()->username}</h3>";
            echo "<h4>Welcome to index page.</h4>";
        }else{
            loggedOutMenu();
        }

        ?>
    </body>
</html>