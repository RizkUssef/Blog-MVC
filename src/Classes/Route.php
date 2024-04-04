<?php

namespace Rizk\Blog\Classes;

class Route{
    private $request, $url , $controller ,$method;

    public function __construct(Request $request)
    {
        $this->request =$request;
        $this->parsedUrl();
        $this->callMethod();
    }
    public function parsedUrl(){
        $this->url = $this->request->queryString();
        $parsedUrl = explode("/",$this->url);
        $this->controller = ucfirst($parsedUrl[0])."Controller";
        $this->method = $parsedUrl[1];
    }

    public function callMethod(){
        $controllerWithNameSpace ="Rizk\Blog\Controllers\\".$this->controller ;
        if(class_exists($controllerWithNameSpace)){
            $object = new $controllerWithNameSpace;
            if(method_exists($object,$this->method)){
                call_user_func([$object,$this->method]);
            }else{
                die("method doesn't exist");
            }
        }else{
            die("controller doesn't exist");
        }
    }
}