<?php

namespace Rizk\Blog\Classes;

class Header{
    public static function goTo($path){
        header("location:$path");
        exit;
    }
}