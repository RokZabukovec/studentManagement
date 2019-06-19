<?php


class Config{
    public static function get($path = null){
        if($path != null){
            $config = $GLOBALS['config'];
            $path = explode('/', $path);
            
            foreach($path as $path_slice){
                if(isset($config[$path_slice])){
                    $config = $config[$path_slice];
                }
            }
            return $config;
        }
        return false;
    }
}