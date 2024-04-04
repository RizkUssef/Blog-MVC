<?php

namespace Rizk\Blog\Classes\Validation;

use Rizk\Blog\Classes\Validation\Vaildator;

// use Rizk\Blog\Classes\Validation\Vaildator;

class FileExtension implements Vaildator {
    public function check($key,$value){
        $allowedExetension = ["png","jpg","jpeg"];
        if(!in_array($value,$allowedExetension)){
            return "$key has not allowed extension";
        }else{
            return false;
        }
    }
}