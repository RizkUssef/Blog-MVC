<?php

namespace Rizk\Blog\Controllers;

use Rizk\Blog\Classes\Request;
use Rizk\Blog\Models\Post;
use MongoDB\BSON\ObjectID;
use Rizk\Blog\Classes\Files;
use Rizk\Blog\Classes\Header;
use Rizk\Blog\Classes\Session;

class DeleteController{
    public function deleteHandle(){
        if(Session::checkSession("user_id")){
            $request =new Request;
            $file = new Files;
            $id = $request->getData("id");
            $postObject = new Post;
            $filter = ["_id"=> new ObjectID($id)];
            $post = $postObject->selectOne($filter);
            $file->deleteImage($post->image);
            $deleteResult = $postObject->delete($filter);
            if($deleteResult>0){
                Session::setSession("success","post deleted successfully");
                Header::goTo("/Blog MVC/public/show/showAll");
            }else{
                Session::setSession("error","someting wrong happend try agian later");
                Header::goTo("/Blog MVC/public/show/showAll");
            }
        }else{
            Session::setSession("error","you must login first");
            Header::goTo("/Blog MVC/public/login/loginPage");
        }
    }
}