<?php
require_once "core/init.php";

$user = new User();
if($user->isLoggedIn()){
    Redirect::to('index');
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
               Redirect::to('index');
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


<?php include 'includes/header.php'; ?>
    <div class="flex flex-column justify-content-center align-center fullscreen" id="login-form">
        <h3>Login</h3>
        <form action="" method="POST" class="">
            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" type="text" name="username" value="<?php echo Input::get('username')?>" autofocus>
                <small class="form-text">Please enter your username.</small><br><br>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" autocomplete="off">
                <small class="form-text">Please enter your password.</small><br><br>
            </div>
            <div class="form-check-inline mb-4">
                <input class="form-check-input" id="remember" type="checkbox" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>

            </div>
            <input type="hidden" name="CSRFtoken" value="<?php echo Token::generate();?>">
            <div class="form-field">
                <input class="btn btn-block btn-outline-secondary"type="submit" name="submit">
            </div>
        </form>
    </div>
    <?php include 'includes/footer.php'?>