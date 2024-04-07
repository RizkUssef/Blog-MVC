<?php

namespace Rizk\Blog\Classes\Validation;

use Rizk\Blog\Classes\Validation\Validator;

class FileExtension implements Validator {
    public function check($key,$value){
        $allowedExetension = ["png","jpg","jpeg","gif"];
        if(!in_array($value,$allowedExetension)){
            return "$key is not allowed";
        }else{
            return false;
        }
    }
}