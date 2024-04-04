<?php

namespace Rizk\Blog\Classes\Validation;

// use Rizk\Blog\Classes\Vaildator;
use Rizk\Blog\Classes\Validation\Vaildator;

class Str implements Vaildator {
    public function check($key,$value){
        if(is_numeric($value)){
            return "$key must be string";
        }else{
            return false;
        }
    }
}