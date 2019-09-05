<?php
require_once "core/init.php";
include 'includes/header.php';
if(Session::exists('success')){
    echo Session::flash('success');
}
if(Session::exists('user')){
    functionsMenu();
    $user = new User();
    echo "<div class='flex-column centered'><h3>Hello <span class='warning'>{$user->data()->username}.</span></h3><h4>Welcome to index page.</h4></div>";
    echo "";
    echo "";
}else{
    loggedOutMenu();
    Redirect::to('login');
}
?>

<?php include 'includes/footer.php';?>
