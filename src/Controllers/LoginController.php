<?php

namespace Rizk\Blog\Controllers;

use Rizk\Blog\Classes\Header;
use Rizk\Blog\Classes\Request;
use Rizk\Blog\Classes\Session;
use Rizk\Blog\Classes\Validation\Email;
use Rizk\Blog\Classes\Validation\Exists;
use Rizk\Blog\Classes\Validation\Required;
use Rizk\Blog\Classes\Validation\Validation;
use Rizk\Blog\Classes\View;
use Rizk\Blog\Models\User;

class LoginController
{
    public function loginPage()
    {
        Session::csrfToken('csrf_token_login');
        View::render('login.php');
    }

    public function loginHandle()
    {
        // 1 : recive data
        $request = new Request;
        if ($request->checkPost('submit') && $request->checkPost('csrf_token_login')) {
            if ($request->postData("csrf_token_login") === Session::getSession('csrf_token_login')) {
                $validation = new Validation;
                $email = $request->clearInput($request->postData("email"));
                $password = $request->clearInput($request->postData("password"));
                // 2 : validate it
                $validation->vaildate("email", $email, [Required::class, Email::class, Exists::class]); //!create email validation & exisit
                $validation->vaildate("password", $password, [Required::class]);
                $errors = $validation->getErrors();
                // 3 : check to login
                if (!empty($errors)) {
                    // redirect back with creditional error
                    Session::setSession("errors", $errors);
                    Header::goTo("/Blog MVC/public/login/loginPage");
                } else {
                    $filter = ["email" => $email];
                    $userObject = new User;
                    $user = $userObject->selectOne($filter);
                    if ($user != null) {
                        $passResult = password_verify($password, $user->password);
                        if ($passResult) {
                            $hashedUserID = $user->_id;
                            // 4 : store to session
                            Session::csrfToken('csrf_token_login');
                            Session::setSession("user_id", $hashedUserID);
                            Session::setSession("success", "you are logged in successfully");
                            Header::goTo("/Blog MVC/public/show/showAll");
                        } else {
                            // wrong creditional
                            Session::setSession("error", "Wrong creditionals");
                            Header::goTo("/Blog MVC/public/login/loginPage");
                        }
                    } else {
                        // wrong creditional
                        Session::setSession("error", "Wrong creditionals both");
                        Header::goTo("/Blog MVC/public/login/loginPage");
                    }
                }
            } else {
                // !access denied
                Session::setSession("error", "access denied");
                Header::goTo("/Blog MVC/public/login/loginPage");
            }
        } else {
            // !access denied
            Session::setSession("error", "access denied");
            Header::goTo("/Blog MVC/public/login/loginPage");
        }
    }
}
