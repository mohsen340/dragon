<?php


class AuthController extends Controller {


  private $session_key = 'email';

  public function registerPage(){
    return view('auth.register');
  }

  public function register(Request $request){

  }

  public function loginPage(){
    return view('auth.login');
  }

  public function login(Request $request){

  }

  public function logout(Request $request){

  }
}