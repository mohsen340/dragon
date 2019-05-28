<?php


function con($key, $default = null){
  $configs = getConfigs();
  if(!array_key_exists($key,$configs)){
    return $default;
  }else{
    $conf = $configs[$key];
    return $conf;
  }
}


function getConfigs(){
  $config = array();
  global $root_path;

  if ($file = fopen($root_path . "/conf.drg", "r")) {
    while(!feof($file)) {
      $line = fgets($file);
      $line = str_replace(array('\t', '\n', '\r', '\r\n'), '', $line);
      $e_line = explode('=', $line);
      if(count($e_line ) > 1){
        $key = $e_line[0];
        $value = $e_line[1];
        for($i=2 ; $i<count($e_line) ; $i++){
          $value .= '='. $e_line[$i];
        }
        $value = str_replace(array('"'), '', $value);
        $value = preg_replace("/[\n\r]/","", $value);
      }

      $config[$key] = $value;
    }
    fclose($file);
  }
  return $config;
}