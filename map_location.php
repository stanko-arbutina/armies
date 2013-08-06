<?php

class MapLocation {
  public $map;
  public $row;
  public $column;

  function __construct($map, $row,$column){
    $this->row = $row;
    $this->column = $column;
    $this->map = $map;
  }

  function __toString(){
    return ((string) '('.$this->row.', '. $this->column.')');
  }



  public static function idFor($row,$column){
    return ($row.'_'.$column);
  }

  public function distanceTo($map_location){
    return (abs($this->column - $map_location->column) + abs($this->row- $map_location->row));
  }

  //recfactor, bilo bi bolje da prima funkciju rowa i clumna
  public function neighbour($direction){
    switch ($direction){
      case 'Up':
	if ($this->row <= 0) return null;
	return $this->map->get($this->row-1, $this->column);
	break;
      case 'Down':
	if ($this->row >= ($this->map->rows-1)) return null;
	return $this->map->get($this->row+1, $this->column);
	break;
      case 'Left':
	if ($this->column <= 0) return null;
	return $this->map->get($this->row, $this->column-1);
	break;
      case 'Right':
	if ($this->column >= ($this->map->columns-1)) return null;
	return $this->map->get($this->row, $this->column+1);
	break;
      case 'None':
	return $this;
	break;

    }
  }
}
?>