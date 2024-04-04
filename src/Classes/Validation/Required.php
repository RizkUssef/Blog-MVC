<?php

namespace Rizk\Blog\Classes\Validation;

// use Rizk\Blog\Classes\Vaildator;
use Rizk\Blog\Classes\Validation\Vaildator;

// use Rizk\Blog\Classes\Validation\Vaildator;

class Required implements Vaildator{
    public function check($key,$value){
        if(empty($value)){
            return "$key is required";
        }else{
            return false;
        }
    }
}