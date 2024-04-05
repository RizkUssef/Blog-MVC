<?php

namespace Rizk\Blog\Controllers;

use Rizk\Blog\Classes\Header;
use Rizk\Blog\Classes\Session;

class LogoutController{
    public function logoutHandle(){
        if(Session::checkSession("user_id")){
            Session::removeSession("user_id");
            Session::setSession("success","you are logged out successfully");
            Header::goTo("/Blog MVC/public/login/loginPage");
        }else{
            Session::setSession("error","you are already logged out");
            Header::goTo("/Blog MVC/public/login/loginPage");
        }
    }
}