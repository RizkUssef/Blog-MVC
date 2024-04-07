<?php

namespace Rizk\Blog\Classes\Validation;

use Rizk\Blog\Classes\Validation\Validator;

class Email implements Validator{
    public function check($key, $value)
    {
        if(!filter_var($value,FILTER_VALIDATE_EMAIL)){
            return "enter valid email address";
        }else{
            return false;
        }
    }
}