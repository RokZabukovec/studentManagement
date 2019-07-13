<?php
/**
 * Created by PhpStorm.
 * User: rok
 * Date: 15/06/2019
 * Time: 18:35
 */

class Student{
    public static function showExams($subject_id){
       $exams = DB::getInstance()->get('exams', array('subject_id', '=', $subject_id))->all();
       if(!empty($exams)){
           return $exams;
       }else{
           return false;
       }
    }

    public static function studentExam($student_id, $exam_id){
        DB::getInstance()->insert('student_exam_registration', array(
            'student_id' => $student_id,
            'exam_id'  => $exam_id
        ));
        header("Location:" . $_SERVER['HTTP_REFERER']);
    }


}