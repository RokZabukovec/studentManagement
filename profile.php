<?php require_once 'core/init.php'; ?>
<?php include 'includes/header.php'; ?>

<?php

if(Session::get('Logged in')){
    echo Session::flash('Logged in');
}

if(Session::exists('user')){
    functionsMenu();
}else{
    Redirect::to('index');
}
?>

<?php include 'includes/footer.php';?>