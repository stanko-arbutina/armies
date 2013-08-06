<?php
header('Content-Type: text/plain; charset=UTF-8');
function getUnderScore($string){
  $arr = preg_split("/[A-Z]/",$string);
  $arr=preg_split('/(?<=\\w)(?=[A-Z])/', $string);
  $arr = array_map("strtolower", $arr);
  return implode("_", $arr);
  
}

function __autoload($class_name){
  $name = getUnderScore($class_name) . '.php';
  include_once($name);
}

$size1 = $_GET['army1'];
$size2 = $_GET['army2'];
$game = new Game($size1, $size2);

?>