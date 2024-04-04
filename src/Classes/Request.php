<?php

namespace Rizk\Blog\Classes;

class Request{
    public function getData($key){
        if(isset($_GET[$key])){
            if(!empty($_GET[$key])){
                return $_GET[$key];
            }else{
                return null;
            }
        }else{
            return null;
        }
    }
    public function postData($key){
        if(isset($_POST[$key])){
            if(!empty($_POST[$key])){
                return $_POST[$key];
            }else{
                return null;
            }
        }else{
            return null;
        }
    }
    public function checkGet($key){
        return isset($_GET[$key]);
    }
    public function checkPost($key){
        return isset($_POST[$key]);
    }
    public function clearInput($input){
        return trim(htmlspecialchars($input));
    }
    public function queryString(){
        return $_SERVER["QUERY_STRING"];
    }
    public function url(){
        return $_SERVER['REQUEST_URI'];
    }

}