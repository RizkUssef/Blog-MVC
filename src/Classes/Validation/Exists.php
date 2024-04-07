<?php

namespace Rizk\Blog\Classes\Validation;

use Rizk\Blog\Classes\Validation\Validator;
use Rizk\Blog\Models\User;

class Exists implements Validator{
    public function check($key, $value)
    {
        $userObject = new User;
        $filter = ["email"=>$value];
        $user=$userObject->selectOne($filter);
        if($user == null){
            return "wrong creditionals  mail";
        }else{
            return false;
        }
    }
}