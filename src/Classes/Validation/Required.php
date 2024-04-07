<?php

namespace Rizk\Blog\Classes\Validation;

use Rizk\Blog\Classes\Validation\Validator;

class Required implements Validator{
    public function check($key,$value){
        if(empty($value)){
            return "$key is required";
        }else{
            return false;
        }
    }
}