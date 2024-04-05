<?php


use Rizk\Blog\Classes\Request;
use Rizk\Blog\Classes\Route;
use Rizk\Blog\Classes\Session;

require_once '../vendor/autoload.php';


$session = new Session;
$request = new Request;

$route = new Route($request);

// ! csrf handle