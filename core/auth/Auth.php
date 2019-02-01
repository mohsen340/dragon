<?php


class Auth {




  public static function routes(){
    Route::get('register', 'AuthController@registerPage', 'register-page');
    Route::post('register', 'AuthController@register', 'register');
    Route::get('login', 'AuthController@loginPage', 'login-page');
    Route::post('login', 'AuthController@login', 'login');
    Route::post('logout', 'AuthController@logout', 'logout');
  }



  public function check(){
    if(!is_null(Session::get(con('SESSION_KEY', 'id')))){
      return true;
    } else{
      if(con('JWT' === 'true')){
        $jwt = new Jwt();
        return $jwt->check();
      }
    }
    return false;
  }


  public function user(){

  }


}