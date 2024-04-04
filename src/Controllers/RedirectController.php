<?php

namespace Rizk\Blog\Controllers;

use Rizk\Blog\Classes\Header;
use Rizk\Blog\Classes\View;

class RedirectController{
    public function loginPage(){
        View::render('login.php');
    }
}