<?php
require_once "core/init.php";
include 'includes/header.php';
if(Session::exists('success')){
    echo Session::flash('success');
}
if(Session::exists('user')){
    functionsMenu();
    $user = new User();
    echo "<h3>Hello {$user->data()->username}</h3>";
    echo "<h4>Welcome to index page.</h4>";
}else{
    loggedOutMenu();
    Redirect::to('login');
}
?>

<?php include 'includes/footer.php';?>
