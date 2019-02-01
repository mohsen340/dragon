<?php



class Test extends Model {

  protected  $fields = ['id', 'name', 'family'];
  protected $primary_key = 'id';
  protected $hiddens = ['family'];

  public function __construct() {
    parent::__construct();
  }


}