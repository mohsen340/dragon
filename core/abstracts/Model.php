<?php



abstract class Model {

  protected $table = null;
  protected $primary_key = 'id';
  protected $fields = array();
  protected $hiddens = [];


  public function __construct() {
    if(is_null($this->table)) {
      $this->table = pluralize(fromCamelCase(static::class));
    }

    foreach ($this->fields  as $field){
      $this->createProperty($field, null);
    }


  }


  protected function createProperty($name, $value){
    $this->$name = $value;
  }







  /*
   * static functions
   * */

  public static function find($id){
    $class = static::class;
    $model = new $class();
    $table = $model->table;
    $primary_key = $model->primary_key;
    $results = DB::first("SELECT * FROM $table WHERE $primary_key = ? LIMIT 1", [$id]);
    if($results === null) return null;
    foreach ($results as $key=>$value){
      $model->$key = $value;
    }
    return $model;
  }


  public static function create($fields = array()){
    $class = static::class;
    $model = new $class();
    foreach ($fields as $key=>$value){
      $model->$key = $value;
    }

    return $model->save();
  }


  public static function remove($id){
    $model = self::find($id);
    if($model == null) return null;
    $model = $model->delete();
    return $model;
  }





  /*
   * non-static functions
   * */

  public function save(){
    $str_names = '';
    $fields = array();
    $str_values = '';

    foreach ($this->fields as $field){
      $str_names .= $field . ',';
      $fields [] = $this->$field;
      $str_values .= '?,';
    }

    $str_names = rtrim($str_names, ',');
    $str_values = rtrim($str_values, ',');


    $key = $this->primary_key;
    if(isset($this->$key)){
      $array_names = $this->fields;
      $array_values = $fields;
      $update_query = '';
      for($i = 0 ; $i < count($array_names) ; $i++){
        $update_query .= $array_names [$i] . '= ? ,';
      }
      $update_query = rtrim($update_query, ',');
      $id = $this->$key;
      $query = "UPDATE $this->table SET $update_query WHERE $key = $id";
      DB::update($query, $array_values);
    }else {
      DB::insert("INSERT INTO $this->table ($str_names) VALUES ($str_values)", $fields);
    }
    return $this;
  }


  public function delete(){
    $model = $this;
    $key = $this->primary_key;
    if(!isset($model->$key)) return null;
    $id = $this->$key;
    DB::delete("DELETE FROM $this->table WHERE $key = ?", [$id]);
    return $model;
  }

}