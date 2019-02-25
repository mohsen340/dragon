<?php


class ErrorHandler {

  private $debug_mode;

  public function __construct() {
    $this->debug_mode = con('APP_DEBUG', 'true');
  }


  private function handle($message){
    if($this->debug_mode == 'true'){
      echo $message;
      exit;
    }else{
      echo $message;
      exit;
    }

  }



  public function notFoundFile($file_name){
    $this->handle('file ' . $file_name . ' not found');
  }


  public function wrongMethod($method){
    $this->handle($method . ' is wrong method');
  }

  public function notFoundUrl($url){
    $this->handle('not found this page');
  }

  public function notFoundUrlName($name){
    $this->handle('not found url with name : ' . $name);
  }


  public function notAllowMethod($url){
    $this->handle("not allowed method for route : $url ");
  }


  public function methodWrongArguments($params){
    $this->handle('method with this arguments not exist');
  }

  public function dbConnection($message = null){
    $this->handle('database connection error =>' . $message);
  }


}