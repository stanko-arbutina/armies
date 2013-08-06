<?php
class Outputter{
  private $out = '';
  private $line_delimiter = '|';
  private $row_delimiter = '-';
  private $break;

  function __construct(){
    $str = new Str('*');
    $t = $str->repeat(100);
    $this->break = $t->raw;
  }

  public function addSubLine($text){
    $this->addLine(' -> '.$text);
  }
  
  public function lineBreak(){
    $this->addLine($this->break);
  }

  public function addLine($text=''){
    $this->out.=$text.PHP_EOL;
  }

  public function arrayRow($arr, $size){
    $cell_size = (int)($size/$arr->length());
    $size = $cell_size*$arr->length();
    $del = $this->line_delimiter;
    $tstr = new Str($this->row_delimiter);
    $tstr = $tstr->repeat($size);
    $line = $tstr->raw;

    
    $a = $arr->map(function($i, $el) use (&$cell_size, &$del){
	$s = new Str($el);
	return (($s->normalize($cell_size-1)->raw).$del);
      });
    
    $this->addLine($a->join());
    $this->addLine($line);
  }

  public function table($rows){
    $obj = $this;
    $rows->each(function($index, $row) use (&$obj){
	$obj->arrayRow($row, 200);
    });
  }

  public function flush(){
    echo $this->out;
    $this->out = '';
  }
  
}
?>