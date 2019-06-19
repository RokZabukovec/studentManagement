<?php

class Hash{
    public static function generate($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function unique(){
        return uniqid();
    }
}