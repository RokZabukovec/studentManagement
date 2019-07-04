<?php
require_once 'core/init.php';

if(Session::exists('user')){
    if($_GET['student_id']){
        DB::getInstance()->delete_by_id('students',(int)$_GET['student_id']);
        Redirect::to('students');
    }elseif($_GET['subject_id']){
        DB::getInstance()->delete_by_id('subjects', (int)$_GET['subject_id']);
        Redirect::to('subjects');
    }elseif($_GET['exam_id']){
        DB::getInstance()->delete_by_id('exams',(int)$_GET['exam_id']);
        Redirect::to('exams');
    }
}else{
    Redirect::to('login');
}
