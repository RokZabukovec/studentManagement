<?php
class Input{
    public static function exists($type = 'POST'){
        switch($type){
            case 'POST':
                return (!empty($_POST)) ? true : false;
                break;
            case 'GET':
                return (!empty($_GET)) ? true : false;
                break;
            default:
                return false;
                break;
        }
    }

    public static function get($input){
        if(isset($_POST[$input])){
            return trim($_POST[$input], ' ');
        }elseif (isset($_GET[$input])){
            return trim($_GET[$input], ' ');
        }else{
            return '';
        }
    }
}