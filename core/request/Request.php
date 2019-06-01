<?php



class Request {

  private static $instance;

  private $redirect_status;
  private $host;
  private $user_agent;
  private $server_name;
  private $document_root;
  private $server_protocol;
  private $server_protocol_name;
  private $request_method;
  private $request_uri;
  private $request_time;
  private $server_uri;
  private $full_uri;

  private $headers = array();
  private $params = array();




  public static function getInstance(){
    if(self::$instance == null){
      self::$instance = new Request();
    }

    return self::$instance;
  }


  public function __construct() {
//    from $_SERVER

    $this->headers = getallheaders();

    foreach ($_POST as $key => $value){
      $this->createProperty($key, $value);
      $this->params [$key] = $value;
    }

    foreach ($_GET as $key => $value){
      $this->createProperty($key, $value);
      $this->params [$key] = $value;
    }



    if(isset($_SERVER['REDIRECT_STATUS'])) {
      $this->redirect_status = $_SERVER['REDIRECT_STATUS'];
    }
    $this->host = $_SERVER['HTTP_HOST'];
    $this->user_agent = $_SERVER['HTTP_USER_AGENT'];
    $this->server_name = $_SERVER['SERVER_NAME'];
    $this->document_root = $_SERVER['DOCUMENT_ROOT'];
    $this->server_protocol = $_SERVER['SERVER_PROTOCOL'];
    $this->server_protocol_name =  explode('/', $this->server_protocol)[0];
//    $this->request_uri = $_SERVER['REQUEST_URI'];
    $this->request_uri = strtok($_SERVER['REQUEST_URI'], '?');
    if(isset($_SERVER['CONTEXT_PREFIX'])){
      $this->request_uri = str_replace($_SERVER['CONTEXT_PREFIX'], '', $this->request_uri);
    }
    if ($this->request_uri[0] !== '/'){
      $this->request_uri = '/'.$this->request_uri;
    }
    $this->request_method = $_SERVER['REQUEST_METHOD'];
    $this->request_time = $_SERVER['REQUEST_TIME'];
    $this->server_uri = mb_strtolower($this->server_protocol_name) . '://' . $this->host;
    if (isset($_SERVER['CONTEXT_PREFIX'])){
      $this->server_uri .= $_SERVER['CONTEXT_PREFIX'];
    }
    $this->full_uri = mb_strtolower($this->server_protocol_name) . '://' . $this->host . $this->request_uri;




  }

  /**
   * @return string
   */
  public function getServerUri(): string {
    return $this->server_uri;
  }


  private function createProperty($name, $value){
    $this->$name = $value;
  }




  public function get($key){
    return $this->params [$key];
  }


  public function getHeader($key){
    return $this->headers [$key];
  }

  /**
   * @return mixed
   */
  public function getRedirectStatus() {
    return $this->redirect_status;
  }

  /**
   * @return mixed
   */
  public function getBaseUrl() {
    return $this->host;
  }

  /**
   * @return mixed
   */
  public function getUserAgent() {
    return $this->user_agent;
  }

  /**
   * @return mixed
   */
  public function getServerName() {
    return $this->server_name;
  }

  /**
   * @return mixed
   */
  public function getDocumentRoot() {
    return $this->document_root;
  }

  /**
   * @return mixed
   */
  public function getServerProtocol() {
    return $this->server_protocol;
  }

  public function getServerProtocolName(){
    return $this->server_protocol_name;
  }

  /**
   * @return mixed
   */
  public function getRequestMethod() {
    return $this->request_method;
  }

  /**
   * @return mixed
   */
  public function getRequestUrl() {
    return $this->request_uri;
  }

  /**
   * @return mixed
   */
  public function getRequestTime() {
    return $this->request_time;
  }



  function getFullUrl(){
    return $this->full_uri;
  }

  public function getAllHeaders(){
    return $this->headers;
  }




}