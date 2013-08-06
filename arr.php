<?php

class Arr{
  private $arr = array();

  function __construct(){
    $this->_circular = 0;
  }

  public function getNext(){
    $rez = $this->arr[$this->_circular];
    $this->_circular = (($this->_circular+1) % ($this->length()));
    return $rez;
  }
 
  public function push($value){
    array_push($this->arr, $value);
  }

  public function join($delimiter=''){
    return implode($delimiter, $this->arr);
  }
  
  public function __toString(){
    return '['.implode(' ', $this->arr).']';
  }
  
  public function length(){
    return count($this->arr);
  }

  public function first(){
    return $this->arr[0];
  }

  public function last(){
    return $this->arr[$this->length()-1];
  }

  public function shuffle(){
    shuffle($this->arr);
  }

  public function all($f){
    $rez = true;
    $this->each(function($i, $el) use (&$rez,&$f){
	$rez = $rez && $f($i, $el);
    });
    return $rez;
  }

  public function map($f){
    $arr = new Arr();
    $this->each(function($i, $el) use (&$arr,&$f){
	$arr->push($f($i, $el));
    });
    return $arr;
  }

  public function select($f){
    $arr = new Arr();
    $this->each(function($i, $el) use (&$arr,&$f){
	if ($f($i, $el)) $arr->push($el);
    });
    return $arr;
  }


  public function max($f){
    $max_el = null;
    $this->each(function($i, $el) use (&$max_el, &$f){
	if (($max_el == null) || ($f($el)>$f($max_el))) $max_el = $el;
    });

    return $max_el;
  }


  

  public function each($f){
    for ($i=0; $i< count($this->arr);$i++){
      $f($i,$this->arr[$i]);
    }
  }
  
}

?>