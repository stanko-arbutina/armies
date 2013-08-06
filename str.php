<?php
class Str{
  function __construct($s){
    $this->raw = $s;
  }

  public function length(){
    return strlen($this->string);
  }

  public function normalize($size){
    $raw = $this->raw;
    if (strlen($raw)>$size){
      $raw = substr($raw,0,$size);
    } else {
      $diff = $size-strlen($raw);
      for ($i=0;$i<$diff;$i++) $raw.=' ';
    }
    return (new Str($raw));
  }

  public function repeat($num){
    $rez = '';
    for ($i = 0; $i<$num;$i++) $rez.= $this->raw;
    return (new Str($rez));
  }

}

?>