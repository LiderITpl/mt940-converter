<?php
  namespace MT940Converter\Bootstrap\Utils;
  
  function dump($whatever) {
    header("Content-Type: text/html; charset=UTF-8");
    http_response_code(500);
    print("<pre>".print_r($whatever,true)."</pre>");
  }