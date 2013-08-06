<?php

class DiscreteProbability{
  private $vals = array();
  private $keys = array();

  function __construct(){
    $this->_num = 0;

  }

  public function push($num, $value){
    $this->_num+=$num;
    array_push($this->vals, $value);
    array_push($this->keys, $this->_num);
  }

  public function get(){
    $num = rand(0, $this->_num-1);
    $i = 0;
    while ($this->keys[$i]<$num) $i++;
    return $this->vals[$i];
  }
}

?>