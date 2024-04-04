<?php

namespace Rizk\Blog\Models;

use Rizk\Blog\Classes\MongoDB;

class Post extends MongoDB{
    public function setCollectionName():string{
         return "posts";
    }
    
}