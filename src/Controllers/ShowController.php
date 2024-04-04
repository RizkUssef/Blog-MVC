<?php

namespace Rizk\Blog\Controllers;

use Rizk\Blog\Classes\View;
use Rizk\Blog\Classes\MongoDB;
use Rizk\Blog\Classes\Request;
use Rizk\Blog\Models\Post;
use Rizk\Blog\Models\User;
use MongoDB\BSON\ObjectID;

class ShowController{
    public function showAll(){
        $filter = ["name"=>"Rizk"];
        $user = new User;
        $post = new Post;
        $userData = $user->selectOne($filter);

        $filter = ["user_id" => $userData->_id];
        $posts = $post->selectMany($filter);
        View::render('index.php',$posts);
    }

    public function showOne(){
        $request = new Request;
        $id =$request->getData("id");
        // echo $id;
        $post = new Post;
        $filter =["_id"=>new ObjectID($id)];
        $options=["projection"=>[
            "_id"=>0
        ]];
        $postData[] = $post->selectOne($filter,$options);
        View::render('show-post.php',$postData);
    }


    
}