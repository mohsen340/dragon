<?php



class TestController extends Controller {

  public function __construct() {
//    parent::__construct();
  }


  public function index($id, $id2){
    echo 'id1 = ' . $id . '<br>';
    echo 'id2 = ' . $id2 . '<br>';
  }

  public function index2(Request $request, $id){
    return view('auth.login');

    echo static::class .'<br>';
    echo 'iddddd = ' . $id . '<br>';
    $test = new Test();
  }



}