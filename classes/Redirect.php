<?php

class Redirect{
    public static function to($location){
        if(is_numeric($location)){
            switch($location){
                case 404:
                    header("HTTP/1.1 404 Not Found");
                    include "includes/errors/404.php";
                    exit();
                case 403:
                    header('HTTP/1.0 403 Forbidden');
                    self::to('index');
            }
        }else{
            if(strpos($location, ".php") !== false){
                header("Location: {$location}");
            }else{
                $location  .=  '.php';
                header("Location: {$location}");
            }
            exit;
        }

    }
}