<?php


function response($data, $http_code = 200){
  http_response_code($http_code);
  echo json_encode($data, JSON_UNESCAPED_UNICODE);
}
