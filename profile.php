<?php require_once 'core/init.php'; ?>
<?php include 'includes/header.php'; ?>

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