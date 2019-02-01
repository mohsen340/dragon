<?php


class RouteHandler {

  private $method;
  private $gets;
  private $posts;


  public function __construct($method) {
    $this->method = $method;
    $this->gets = Route::routeGets();
    $this->posts = Route::routePosts();
  }


  public function match($url){

    if($this->method == 'GET'){
      foreach ($this->gets as $get){
        $result = $this->matcher($get['route'], $url);
        if($result !== false){
          return ['path' => $get['path'], 'params' => $result];
        }
      }


      foreach ($this->posts as $post){
        $result = $this->matcher($post['route'], $url);
        if($result !== false){
          $handler = new ErrorHandler();
          $handler->notAllowMethod($url);
        }
      }

    }

    elseif ($this->method == 'POST'){
      foreach ($this->posts as $post){
        $result = $this->matcher($post['route'], $url);
        if($result !== false){
          return ['path' => $post['path'], 'params' => $result];
        }
      }

      foreach ($this->gets as $get){
        $result = $this->matcher($get['route'], $url);
        if($result !== false){
          $handler = new ErrorHandler();
          $handler->notAllowMethod($url);
        }
      }

    }


    $handler = new ErrorHandler();
    $handler->notFoundUrl($url);
  }


  private function matcher($route, $url){
    //remove slash from first and end of routes and urls to compare
    if($route !== '/'){
      if($route[0] === '/') $route = ltrim($route, '/' );
      if($route[strlen($route) - 1] === '/') $route = rtrim($route, '/');
    }else{
      $route = '';
    }

    if(Request::getInstance()->getRequestUrl() !== '/') {
      if ($url[0] === '/') $url = ltrim($url, '/');
      if ($url[strlen($url) - 1] === '/') $url = rtrim($url, '/');
    }else{
      $url = '';
    }

    if($route === '' && $url === ''){
      $params = array();
      return $params;
    }


    $e_route = explode('/', $route); // [test , {id1} , {id2} , t]
    $e_url = explode('/', $url);     // [test ,   6   ,   7   , t]

    if(count($e_route) != count($e_url)) return false;

    $params = array();
    for($i=0 ; $i<count($e_route) ; $i++){



      if(isset($e_route[$i][0])) {
        if (strcmp($e_route[$i][0], '{') === 0) {
          $params [] = $e_url[$i];
          continue;
        }
      }

      if (strcmp($e_route[$i], $e_url[$i]) !== 0 ){
        return false;
      }

    }

    return $params;
  }
}