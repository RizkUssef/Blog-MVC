<?php

namespace Rizk\Blog\Controllers;

use Rizk\Blog\Classes\Request;
use Rizk\Blog\Classes\View;
use Rizk\Blog\Models\Post;
use Rizk\Blog\Models\User;
use MongoDB\BSON\ObjectID;
use Rizk\Blog\Classes\Files;
use Rizk\Blog\Classes\Header;
use Rizk\Blog\Classes\Session;
use Rizk\Blog\Classes\Validation\FileExtension;
use Rizk\Blog\Classes\Validation\FileSize;
use Rizk\Blog\Classes\Validation\Required;
use Rizk\Blog\Classes\Validation\Str;
use Rizk\Blog\Classes\Validation\Validation;

class EditController
{
    public function editPage()
    {
        if (Session::checkSession("user_id")) {
            $request = new Request;
            $id = $request->getData("id");
            $postObject = new Post;
            $postfilter = ["_id" => new ObjectID($id)];
            $post[] = $postObject->selectOne($postfilter);
            Session::csrfToken("csrf_token_edit");
            View::render("edit-post.php", $post);
        } else {
            Session::setSession("error", "you must login first");
            Header::goTo("/Blog MVC/public/login/loginPage");
        }
    }

    public function editHandle()
    {
        if (Session::checkSession("user_id")) {
            $request = new Request;
            if ($request->checkPost("submit") && $request->checkPost("csrf_token_edit")) {
                if ($request->postData("csrf_token_edit") === Session::getSession("csrf_token_edit")) {
                    $image = new Files;
                    $validation = new Validation;
                    // $session = new Session;
                    $id = $request->getData('id');
                    // 1 : select doc
                    $postObject = new Post;
                    $filter = ["_id" => new ObjectID($id)];
                    $post = $postObject->selectOne($filter);
                    // 2 : recive data
                    $title  = $request->clearInput($request->postData("title"));
                    $body  = $request->clearInput($request->postData("body"));
                    // 3 : vaildate data
                    $validation->vaildate("title", $title, [Required::class, Str::class]);
                    $validation->vaildate("body", $body, [Required::class, Str::class]);
                    $errors = $validation->getErrors();
                    // 4 : recive image
                    if ($image->checkFile()) {
                        $imageName = $image->getFileData("name");
                        $tmpName = $image->getFileData("tmp_name");
                        $size = $image->getFileData("size");
                        $ext = $image->getExt($imageName);
                        $sizeMB = $image->sizeMB($size);
                        $newName = $image->setNewFileName($ext);
                        // 5 : vaildate image 
                        $validation->vaildate("size", $sizeMB, [FileSize::class]);
                        $validation->vaildate("extension", $ext, [FileExtension::class]);
                        $errors = $validation->getErrors();
                    } else {
                        $newName = $post->image;
                    }
                    if (!empty($errors)) {
                        Session::setSession("errors", $errors);
                        Header::goTo("/Blog MVC/public/edit/editPage?id=$id");
                    } else {
                        // 4 : update 
                        if ($image->checkFile()) {
                            if ($post->image != null) {
                                echo $post->image;
                                $image->deleteImage($post->image);
                            }
                        }
                        $update = ['$set' => [
                            "title" => $title,
                            "body" => $body,
                            "image" => $newName,
                            "updated_at" => date("Y-m-d H:i:s")
                        ]];
                        $updateResult = $postObject->update($filter, $update);
                        if ($updateResult > 0) {
                            if ($image->checkFile()) {
                                $image->storeFile($tmpName, $newName);
                            }
                            Session::checkSession("csrf_token_edit");
                            Session::setSession("success", "post updated successfully");
                            Header::goTo("/Blog MVC/public/show/showOne?id=$id");
                        } else {
                            Session::setSession("error", "error while updating try again later");
                            Header::goTo("/Blog MVC/public/edit/editPage?id=$id");
                        }
                    }
                } else {
                    //! acces denied
                    Session::checkSession("csrf_token_edit");
                    Session::setSession("error", "access denied");
                    Header::goTo("/Blog MVC/public/show/showAll");
                }
            } else {
                //! acces denied
                Session::checkSession("csrf_token_edit");
                Session::setSession("error", "access denied");
                Header::goTo("/Blog MVC/public/show/showAll");
            }
        } else {
            Session::setSession("error", "you must login first");
            Header::goTo("/Blog MVC/public/login/loginPage");
        }
    }
}
