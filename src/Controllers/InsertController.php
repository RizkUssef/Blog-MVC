<?php

namespace Rizk\Blog\Controllers;

use MongoDB\Codec\Encoder;
use Rizk\Blog\Classes\Files;
use Rizk\Blog\Classes\Header;
use Rizk\Blog\Classes\Http\Route;
use Rizk\Blog\Classes\Redirect;
use Rizk\Blog\Classes\Request;
use Rizk\Blog\Classes\Session;
use Rizk\Blog\Classes\Validation\FileExtension;
use Rizk\Blog\Classes\Validation\FileSize;
use Rizk\Blog\Classes\Validation\Required;
use Rizk\Blog\Classes\Validation\Str;
use Rizk\Blog\Classes\Validation\Validation;
use Rizk\Blog\Classes\View;
use Rizk\Blog\Models\Post;
use Rizk\Blog\Models\User;

class InsertController
{
    public function insertUser()
    {
        $doc = [
            "name" => "pop",
            "email" => "pop@gmail",
            "password" => password_hash(12345678910, PASSWORD_DEFAULT)
        ];
        $user = new User;
        $count = $user->insert($doc);
        print_r($count);
    }

    public function insertPage()
    {
        if (Session::checkSession("user_id")) {
            Session::csrfToken("csrf_token_insert");
            View::render('create-post.php');
        } else {
            Session::setSession("error", "you must login first");
            Header::goTo("/Blog MVC/public/login/loginPage");
        }
    }

    public function insertPost()
    {
        if (Session::checkSession("user_id")) {
            $request = new Request;
            if ($request->checkPost("submit") && $request->checkPost("csrf_token_insert")) {
                if($request->postData("csrf_token_insert") === Session::getSession("csrf_token_insert")){
                    $image = new Files;
                    $validation = new Validation;
                    // recive data
                    $title = $request->clearInput($request->postData("title"));
                    $body = $request->clearInput($request->postData("body"));
                    // data validation
                    $validation->vaildate("title", $title, [Required::class, Str::class]);
                    $validation->vaildate("body", $body, [Required::class, Str::class]);
                    $errors = $validation->getErrors();
                    // check if user upload file or not
                    if ($image->checkFile()) {
                        $imageName = $image->getFileData("name");
                        $tmpName = $image->getFileData("tmp_name");
                        $size = $image->getFileData("size");
                        $ext = $image->getExt($imageName);
                        $sizeMB = $image->sizeMB($size);
                        $newName = $image->setNewFileName($ext);
                        // valadate image
                        $validation->vaildate("size", $sizeMB, [FileSize::class]);
                        $validation->vaildate("extension", $ext, [FileExtension::class]);
                        $errors = $validation->getErrors();
                    } else {
                        $newName = "";
                    }
                    // store
                    if (!empty($errors)) {
                        // validation error handle
                        Session::setSession("errors", $errors);
                        Header::goTo('/Blog MVC/public/insert/insertPage');
                    } else {
                        // select the user id
                        $filter = ["name" => "pop"];
                        $user = new User;
                        $userData = $user->selectOne($filter);
                        // insert
                        $document = [
                            "title" => $title,
                            "body" => $body,
                            "image" => $newName,
                            "user_id" => $userData->_id,
                            "created_at" => date("Y-m-d H:i:s")
                        ];
                        $post = new Post;
                        $inserted = $post->insert($document);
                        // check if inserted or not
                        if ($inserted > 0) {
                            if ($image->checkFile()) {
                                $image->storeFile($tmpName, $newName);
                            }
                            //(store the file) move file
                            Session::csrfToken("csrf_token_insert");
                            Session::setSession("success", "post added successfully");
                            Header::goTo('/Blog MVC/public/show/showAll');
                        } else {
                            // error while uploading
                            Session::csrfToken("csrf_token_insert");
                            Session::setSession("error", "error while uploading try agian later");
                            Header::goTo('/Blog MVC/public/show/showAll');
                        }
                    }
                }else{
                    //! not allowed
                    Session::csrfToken("csrf_token_insert");
                    Session::setSession("error", "access denied");
                    Header::goTo('/Blog MVC/public/show/showAll');
                }
            } else {
                //! not allowed
                Session::csrfToken("csrf_token_insert");
                Session::setSession("error", "access denied");
                Header::goTo('/Blog MVC/public/show/showAll');
            }
        } else {
            Session::csrfToken("csrf_token_insert");
            Session::setSession("error", "you must login first");
            Header::goTo("/Blog MVC/public/login/loginPage");
        }
    }
}
