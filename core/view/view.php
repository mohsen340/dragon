<?php


function view($file_path, $params = null){
  if(!is_null($params)) {
    foreach ($params as $key => $value) {
      ${"$key"} = $value;
    }
  }

  global  $root_path;
  $file_path = str_replace('.', '/', $file_path);
  $path1 = $root_path . '/view/' . $file_path . '.php';
  $path2 = $root_path . '/view/' . $file_path . '.blade.php';
  $path3 = $root_path . '/view/' . $file_path . '.html';
  $path4 = $root_path . '/view/' . $file_path . '.htm';

  if(file_exists($path1)){
    require_once $path1;
  }elseif(file_exists($path2)){
    require_once $path2;
  }elseif(file_exists($path3)){
    require_once $path3;
  }elseif(file_exists($path4)){
    require_once $path4;
  }else{
    $handler = new ErrorHandler();
    $handler->notFoundFile($file_path);
  }

  exit;


}





function asset($path){
  $request = Request::getInstance();
  $uri = $request->getServerUri();
  echo ($path[0] === '/') ? $uri . '/public' . $path : $uri . '/public/' . $path;
}