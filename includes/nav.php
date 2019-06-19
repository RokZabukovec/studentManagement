<?php
require_once 'core/init.php';
if(Session::get('user')){
    $user = new User();
    echo "<nav><ul></ul></nav>";
}else{
    echo "<nav><ul><li><a href='login.php'>Login</a></li><li><a href='register.php'>Register</a></li></ul></nav>";
}


?>