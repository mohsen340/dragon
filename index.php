<?php


global $host;
$host = $_SERVER['HTTP_HOST'];

global $root_path;
//$root_path = $_SERVER['DOCUMENT_ROOT'];
$root_path = __DIR__;
//$root_path = rtrim($_SERVER['DOCUMENT_ROOT'], 'public');

require_once($root_path . '/loader.php');


$instance = new $controller_name();
call_user_func_array(array($instance, $method_name), $params);

