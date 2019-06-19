<?php
    require_once 'core/init.php';

if(Input::exists()) {
    if(Token::check(Input::get('CSRFtoken'))){
        $validate = new Validation();
        $validation = $validate->check($_POST, array(
            'username' => array(
                'input_name' => 'Username',
                'required'   => true,
                'min_lenght' => 2,
                'max_lenght' => 20,
                'unique'     => 'users'
            ),
            'name' => array(
                'input_name' => 'Name',
                'required'   => true,
                'min_lenght' => 2,
                'max_lenght' => 50,
            ),
            'last_name' => array(
                'input_name' => 'Last name',
                'required'   => true,
                'min_lenght' => 2,
                'max_lenght' => 50,
            ),
            'password' => array(
                'input_name' => 'Password',
                'required'   => true,
                'min_lenght' => 6,
                'max_lenght' => 64,
            ),
            'password_repeat' => array(
                'input_name' => 'Repeat password',
                'required'   => true,
                'matches'    => 'password'
            ),
        ));

        if($validation->passed()){
            $user = new User();
            try{
                $user->register(array(
                    'username'  => Input::get('username'),
                    'password'  => Hash::generate(Input::get('password')),
                    'name'      => Input::get('name'),
                    'last_name' => Input::get('last_name'),
                    'joined'    => date("Y-m-d H:i:s"),
                    'job_title' => 1
                ));
                Session::flash('success', 'Registration is a success.');
                Redirect::to('index');
            }catch(Exception $e){
                Redirect::to(404);
                die($e->getMessage());
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
        <title>Register</title>
    </head>
    <body>
    <?php include 'includes/nav.php'?>
        <form action="" method="post">
            <div class="form-field">
                <label for="name">Name</label>
                <input type="text" name="name" value="<?php echo Input::get('name')?>" autocomplete="off" autofocus>
                <small>Please enter your name.</small><br><br>
            </div>
            <div class="form-field">
                <label for="last_name">Last name</label>
                <input type="text" name="last_name" value="<?php echo Input::get('last_name')?>" autocomplete="off">
                <small>Please enter your last name.</small><br><br>
            </div>
            <div class="form-field">
                <label for="username">Username</label>
                <input type="text" name="username" value="<?php echo Input::get('username')?>" autocomplete="off">
                <small>Please enter your username.</small><br><br>
            </div>
            <div class="form-field">
                <label for="password">Password</label>
                <input type="password" name="password">
                <small>Please enter your password.</small><br><br>
            </div>
            <div class="form-field">
                <label for="password-repeat">Password repeat</label>
                <input type="password" name="password_repeat">
                <small>Please enter your password again.</small><br><br>
            </div>
            <input type="hidden" name="CSRFtoken" value="<?php echo Token::generate();?>">
            <div class="form-field">
                <input type="submit" name="submit">
            </div>

        </form>
    </body>
</html>