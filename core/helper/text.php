<?php


function fromCamelCase($input) {
  preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
  $ret = $matches[0];
  foreach ($ret as &$match) {
    $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
  }
  return implode('_', $ret);
}

function pluralize($str){
  if($str[strlen($str) - 1] === 'y'){
    $str[strlen($str) - 1] = 'i';
    $str .= 'es';
  }else{
    $str .= 's';
  }

  return $str;
}