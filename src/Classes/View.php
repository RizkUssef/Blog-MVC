<?php

namespace Rizk\Blog\Classes;

class View{
    public static function render($fileName,$data=[]){
        $path = "C:/xampp/htdocs/Blog MVC/src/Views/".$fileName;
        if(file_exists($path)){
            extract($data);
            include($path);
        }else{
            die("file doesn't exist");
        }
    }
}