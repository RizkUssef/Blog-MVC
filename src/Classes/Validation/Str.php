<?php

namespace Rizk\Blog\Classes\Validation;

// use Rizk\Blog\Classes\Vaildator;
use Rizk\Blog\Classes\Validation\Validator;

class Str implements Validator {
    public function check($key,$value){
        if(is_numeric($value)){
            return "$key must be string";
        }else{
            return false;
        }
    }
}