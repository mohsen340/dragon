<?php



class HomeController extends Controller {

  public function __construct() {

  }


  public function index(Request $request){

    echo $request->page;
    exit();

    $test = Test::find(1);
    echo 'hello';
    response(['user' => $test, 'test' => 'hello']);

    exit;



    $var1 = 'var1';
    $var2 = 'var2';
    return view('test', ['var1'=>$var1, 'var2'=>$var2]);
  }







}