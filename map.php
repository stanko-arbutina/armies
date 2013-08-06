<?php

class Map {
  public $rows;
  public $columns;

  function __construct($rows, $columns){
    $this->rows = $rows;
    $this->columns = $columns;
    $this->locations = new SortedHash();
    for ($i=0; $i<$rows;$i++){
      for ($j=0; $j<$columns;$j++){
	$id = MapLocation::idFor($i,$j);
	$this->locations->add($id, new MapLocation($this, $i, $j));
      }

    }
    $this->_randomized = false;
  }//end __construct

  public function get($row, $column){
    $id = MapLocation::idFor($row,$column);
    return $this->locations->get($id);
  }

  public function getNextRandom(){
    if (!$this->_randomized){
      $this->locations->shuffle();
      $this->_randomized = true;
    }
    return $this->locations->getNext();
  }

  public function tabular(){
    $rows = new Arr();
    $head = new Arr();
    $head->push('');
    for ($i=0; $i<$this->columns; $i++) $head->push($i);
    $rows->push($head);
    for ($i=0; $i<$this->rows; $i++){
      $row = new Arr();
      $row->push($i);
      for ($j=0; $j<$this->columns; $j++) $row->push($this->get($i, $j)->__toString());      
      $rows->push($row);
    }
    return $rows;
  }



}

?>