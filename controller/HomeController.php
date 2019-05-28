<?php



class HomeController extends Controller {

  public function __construct() {

  }


  public function index(Request $request){
    return view('test');
    return asset('css/bulma.min.css');
    return redirect('/a');
  }







}