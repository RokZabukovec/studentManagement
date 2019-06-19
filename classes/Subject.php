<?php
/**
 * Created by PhpStorm.
 * User: rok
 * Date: 19/06/2019
 * Time: 15:38
 */

class Subject{


    public static function delete($id){
        if(Session::exists('user')){
            try{
                DB::getInstance()->delete(Config::get('tables/subjects/name'), array(Config::get('tables/subjects/primary_key'), '=', $id));
            }catch(PDOException $exception){
                echo $exception->getMessage();
            }finally{
                Redirect::to('subjects');
            }

        }else{
            Redirect::to('login');
        }
    }
}