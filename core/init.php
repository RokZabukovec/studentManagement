<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);


/*
*   This file is required on every page and it 
*   containes all of the classes, functions and 
*   configuration information needed.  
*/

session_start();
date_default_timezone_set( 'Europe/Ljubljana');
/*
*   Global configuration array with the settings for 
*   mysql connection, cookies, sessions.
*/

$GLOBALS['config'] = array(
    'mysql' => array(
        'host'      => 'localhost',
        'username'  => 'root',
        'password'  => 'root',
        'dbname'    => 'student_management'

    ),
    'remember' => array(
        'cookie_name'   => 'hash',
        'cookie_expiry' => 2629743,

    ),
    'session' => array(
        'session_name' => 'user',
        'token_name'   => 'CSFRtoken'
    ),
    'tables' =>array(
        'users' => array(
            'name' => 'users',
            'primary_key' => 'id'
        ),
        'students' => array(
            'name' => 'students',
            'primary_key' => 'student_id'
        ),
        'professors' => array(
            'name' => 'professors',
            'primary_key' => 'professor_id'
        ),
        'subjects' => array(
            'name' => 'subjects',
            'primary_key' => 'subject_id'
        ),
        'programs' => array(
            'name' => 'programs',
            'primary_key' => 'program_id'
        )
    )
);


/*
*   Whenever we make a new instance of a class 
*   spl_autoload_register is called and require
*   whatever class we inicialized.
*
*   @param $class - name of the class we inicialized.
*/

spl_autoload_register(function($class){
    require_once 'classes/'. $class . '.php';
});


require_once 'functions/sanitize.php';
require_once 'functions/menus.php';

if(Cookie::exists(Config::get('remember/cookie_name') && !Session::exists(Config::get('session/session_name')))){
echo "cookie";
}