<?php

namespace Rizk\Blog\Classes\Validation;

use Rizk\Blog\Classes\Validation\Validator;

class FileSize implements Validator {
    public function check($key,$value){
        if($value > 5){
            return "$key must be less than 5 MB";
        }else{
            return false;
        } 
    }
}