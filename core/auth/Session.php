<?php



class Session {

  private static $init = false;

  private static function init(){
    if(!self::$init) {
      session_start();
      self::$init = true;
    }
  }


  public static function set($key, $value){
    self::init();
    $_SESSION [$key] = $value;
  }


  public static function get($key){
    return isset($_SESSION [$key]) ? $_SESSION [$key] :  null;
  }


  public static function destroy(){
    session_destroy();
  }
}