<?php



class Jwt {

  private $token = '';

  public function __construct() {
    $authorizaton = Request::getInstance()->getHeader('Authorization');
    $this->token = ltrim($authorizaton, 'Bearer ');
  }

  public function check(){

  }


  public function user(){

  }
}