<?php
require_once "core/init.php";
include 'includes/header.php';
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