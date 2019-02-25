<?php


function route($name, $params = array()){
  $gets = Route::routeGets();
  $posts = Route::routePosts();

  $url = '';
  $is_found = false;
  foreach ($gets as $get_url){
    if($get_url ['name'] === $name){
      $url = $get_url ['route'];
      $is_found = true;
      break;
    }
  }

  if(!$is_found) {
    foreach ($posts as $post_url) {
      if ($post_url ['name'] === $name) {
        $url = $post_url ['route'];
        $is_found = true;
        break;
      }
    }
  }

  if($is_found) {
    foreach ($params as $key=>$value){
      $url = str_replace('{' . $key . '}', $value, $url);
    }
    return $url;
  }


  $error = new ErrorHandler();
  $error->notFoundUrlName($name);
}



function redirect($url){
//  http_redirect($url);
  header('Location: ' . $url);
}


function response($data, $http_code = 200){
  http_response_code($http_code);
  echo json_encode($data, JSON_UNESCAPED_UNICODE);
}
