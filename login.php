<?php
require_once "core/init.php";

$user = new User();
if($user->isLoggedIn()){
    Redirect::to('profile');
}
if(Input::exists()){
    if(Token::check(Input::get("CSRFtoken"))){
        $validate = new Validation();
        $validation = $validate->check($_POST, array(
            'username' => array(
                'input_name' => 'Username',
                'required'   => true,
            ),
            'password' => array(
                'input_name' => 'Password',
                'required'   => true,
            )
        ));

        if($validation->passed()){
           $user = new User();
           $remember = (Input::get('remember') == 'on') ? true : false;
           $login = $user->login(Input::get('username'), Input::get('password'), $remember);
           if($login){
               Redirect::to('profile');
           }else{
               Redirect::to('login');
           }
        }else{
            foreach($validation->errors() as $error){
                echo $error . '<br>';
            }
        }
    }

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php require_once 'includes/style.php' ?>
    <title>Login</title>
</head>
<body>
<?php include 'includes/nav.php'?>
    <form action="" method="POST">
        <div class="form-field">
            <label for="username">Username</label>
            <input type="text" name="username" value="<?php echo Input::get('username')?>" autofocus>
            <small>Please enter your username.</small><br><br>
        </div>
        <div class="form-field">
            <label for="password">Password</label>
            <input type="password" name="password" autocomplete="off">
            <small>Please enter your password.</small><br><br>
        </div>
        <div class="form-field">
            <label for="remember">Remember me</label>
            <input type="checkbox"name="remember"autocomplete="off">
        </div>
        <input type="hidden" name="CSRFtoken" value="<?php echo Token::generate();?>">
        <div class="form-field">
            <input type="submit" name="submit">
        </div>
    </form>
</body>
</html>