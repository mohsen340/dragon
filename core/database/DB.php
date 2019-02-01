<?php


class DB  {

  private static $connection;


  private static function init($options = null){
    if(is_null($options)){
      $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
      ];
    }

    $dsn = con('DB_CONNECTION') . ':dbname=' . con('DB_DATABASE') . ';host=' . con('DB_HOST') .';charset=utf8';

    try {
      self::$connection = new PDO($dsn, con('DB_USERNAME'), con('DB_PASSWORD'), $options);
    }catch (PDOException $e) {
      $error = new ErrorHandler();
      $error->dbConnection($e);
    }
  }



  private static function run($query, $fields = null){
    self::init();
    try {
      $stmt = self::$connection->prepare($query);
      $stmt->execute($fields);
    }catch (PDOException $e){
      $error = new ErrorHandler();
      $error->dbConnection($e);
    }
    self::close();
    return $stmt;
  }


  private static function close(){
    self::$connection = null;
  }



  public static function first($query, $fields = null){
    $results = self::select($query, $fields);
    if(count($results) < 1) return null;
    return $results[0];
  }


  public static function select($query, $fields = null){
    $stmt = self::run($query, $fields);
    $results = $stmt->fetchAll(2);
    return $results;
  }


  public static function insert($query, $fields = null){
    $stmt = self::run($query, $fields);
    return $stmt;
  }



  public static function update($query, $fields = null){
    $stmt = self::run($query, $fields);
    return $stmt;
  }



  public static function delete($query, $fields = null){
    $stmt = self::run($query, $fields = null);
    return $stmt;
  }



}