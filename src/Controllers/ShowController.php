<?php

namespace Rizk\Blog\Controllers;

use Rizk\Blog\Classes\View;
use Rizk\Blog\Classes\MongoDB;
use Rizk\Blog\Classes\Request;
use Rizk\Blog\Models\Post;
use Rizk\Blog\Models\User;
use MongoDB\BSON\ObjectID;
use Rizk\Blog\Classes\Header;
use Rizk\Blog\Classes\Session;

class ShowController{
    public function showAll(){
        if(Session::checkSession("user_id")){
            $user_id= Session::getSession("user_id");
            // $filter = ["_id"=> new ObjectID($user_id)];
            // $user = new User;
            $post = new Post;
            // $userData = $user->selectOne($filter);
    
            $filter = ["user_id" => $user_id];
            $posts = $post->selectMany($filter);
            View::render('index.php',$posts);
        }else{
            Session::setSession("error","you must login first");
            Header::goTo("/Blog MVC/public/login/loginPage");
        }
    }

    public function showOne(){
        if(Session::checkSession("user_id")){
            $request = new Request;
            $id =$request->getData("id");
            $post = new Post;
            $filter =["_id"=>new ObjectID($id)];
            $options=["projection"=>[
                "_id"=>0
            ]];
            $postData[] = $post->selectOne($filter,$options);
            View::render('show-post.php',$postData);
        }else{
            Session::setSession("error","you must login first");
            Header::goTo("/Blog MVC/public/login/loginPage");
        }
    }


    
}