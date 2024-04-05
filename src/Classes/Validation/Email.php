<?php

namespace Rizk\Blog\Classes\Validation;

use Rizk\Blog\Classes\Validation\Vaildator;

class Email implements Vaildator{
    public function check($key, $value)
    {
        if(!filter_var($value,FILTER_VALIDATE_EMAIL)){
            return "enter valid email address";
        }else{
            return false;
        }
    }
}