<?php

namespace Rizk\Blog\Classes;

class Files{
    public function checkFile(){
        if($_FILES["image"]["name"]){
            return true;
        }else{
            return false;
        }
    }
    public function getFileData($key){
        return $_FILES["image"][$key];
    }
    public function sizeMB($size){
        return $size/(1024*1024);
    }

    public function getExt($imageName){
        return pathinfo($imageName,PATHINFO_EXTENSION);
    }

    public function setNewFileName($extension){
        return uniqid().".".$extension;
    }

    public function storeFile($tmp_name,$new_name){
        move_uploaded_file($tmp_name,"../../public/uploads/$new_name");
        return true;
    }
}