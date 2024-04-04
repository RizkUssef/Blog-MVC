<?php

namespace Rizk\Blog\Models;

use Rizk\Blog\Classes\MongoDB;

class User extends MongoDB{
    public function setCollectionName():string{
        return "users";
    }
}