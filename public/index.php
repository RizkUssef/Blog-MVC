<?php


use Rizk\Blog\Classes\Request;
use Rizk\Blog\Classes\Route;

require_once '../vendor/autoload.php';


// $route = new Route(new Request);
// print_r($route::$routes);
$request = new Request;
// print_r($request->queryString());
$route = new Route($request);
// print_r($route->parsedUrl($request));

