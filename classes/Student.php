<?php
/**
 * Created by PhpStorm.
 * User: rok
 * Date: 15/06/2019
 * Time: 18:35
 */

class Student{


    public static function delete($id){
        if(Session::exists('user')){
            try{
                DB::getInstance()->delete(Config::get('tables/students/name'), array(Config::get('tables/students/primary_key'), '=', $id));
            }catch(PDOException $exception){
                $exception->getMessage();
            }finally{
                Redirect::to('students');
            }

        }else{
            Redirect::to('login');
        }
    }
}