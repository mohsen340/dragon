<?php



class Route {

  private static $gets = array();
  private static $posts = array();



  public static function get($route, $path, $name = null){
    self::$gets [] = ['route' => $route, 'path' => $path, 'name' => $name];
  }

  public static function post($route, $path, $name = null){
    self::$posts [] = ['route' => $route, 'path' => $path, 'name' => $name];
  }


  public static function routeGets(){
    return self::$gets;
  }

  public static function routePosts(){
    return self::$posts;
  }




}