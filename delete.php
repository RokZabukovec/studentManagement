<?php
require_once 'core/init.php';

if(Session::exists('user')){
    if($_GET['student_id']){
        Student::delete($_GET['student_id']);
    }elseif($_GET['subject_id']){
        Subject::delete($_GET['subject_id']);
    }


}else{
    Redirect::to('login');
}
