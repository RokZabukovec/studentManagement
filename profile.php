<?php require_once 'core/init.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php require_once 'includes/style.php' ?>
    <title>Profile</title>
</head>
<body>
<?php include 'includes/nav.php'?>



<?php

if(Session::get('Logged in')){
    echo Session::flash('Logged in');
}

if(Session::exists('user')){
    loggedInMenu();
    functionsMenu();
}else{
    Redirect::to('index');
}
?>


</body>
</html>