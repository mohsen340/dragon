<?php

class User extends Model {

  protected $primary_key = 'id';
  protected $table = 'users';
  protected $fields = ['id', 'name', 'email', 'password'];

  public function __construct() {
    parent::__construct();
  }



}