<?php

global $root_path;
require_once($root_path . '/Config.php');
require_once($root_path . '/core/config/cons.php');
require_once($root_path . '/core/helper/text.php');
require_once($root_path . '/core/helper/server.php');
require_once($root_path . '/core/error/ErrorHandler.php');
require_once($root_path . '/core/abstracts/Controller.php');
require_once($root_path . '/core/abstracts/Model.php');
require_once($root_path . '/core/request/Request.php');
require_once($root_path . '/core/auth/Auth.php');
require_once($root_path . '/core/auth/Jwt.php');
require_once($root_path . '/core/routing/Route.php');
require_once($root_path . '/core/routing/RouteHandler.php');
require_once($root_path . '/core/view/view.php');
require_once($root_path . '/core/database/DB.php');
//require all of models
$path = $root_path . '/model/';
$files = glob($path . '/*.php');
foreach ($files as $file) {
  require_once $file;
}

require_once($root_path . '/route/web.php');



$request = Request::getInstance();

$handler = new RouteHandler($request->getRequestMethod());
$route_result = $handler->match($request->getRequestUrl());



$path = $route_result['path'];
$params = $route_result['params'];



$method_path = explode('@', $path);
$controller_name = $method_path[0];
$method_name = $method_path[1];

$controller_path = $root_path . '/controller/' . $controller_name . '.php';
if(!file_exists($controller_path)){
  $handler = new ErrorHandler();
  $handler->notFoundFile($controller_path);
}

require_once $controller_path;

$method_info = new ReflectionMethod($controller_name, $method_name);
$method_params = $method_info->getParameters();

if(count($method_params) !== count($params)){
  if(count($method_params) - 1 === count($params)) {
    array_unshift($params, $request);
  }else{
    $handler = new ErrorHandler();
    $handler->methodWrongArguments($params);
  }
}






