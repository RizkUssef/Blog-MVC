<?php

namespace Rizk\Blog\Classes;

class Session{
    public function __construct(){
        session_start();
    }
    public function setSession($key,$value){
        $_SESSION[$key]=$value;
    }
    public static function getSession($key){
        return $_SESSION[$key];
    }
    public static function checkSession($key){
        if(isset($_SESSION[$key])){
            if(!empty($_SESSION[$key])){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public static function removeSession($key){
        if(isset($_SESSION[$key])){
            unset($_SESSION[$key]);
            return true;
        }else{
            return false;
        }
    }
}