<?php

class MoveAction extends Action{

  function __construct($actor){
    parent::__construct($actor);  
    $this->_new_location = null;
  }



  public function isAvailable(){
    return ($this->new_location()!=null);
  }

  public function expectedValue(){
    return (1.0/(($this->new_location()->distanceTo($this->actor->goal))+1));
  }

  public function play(){
    $this->actor->army->exhaust();
    $this->actor->setLocation($this->new_location());
    $this->_new_location = null;
  }

  private function current_location(){
    return  $this->actor->location;
  }


  private function new_location(){
    return $this->current_location()->neighbour($this->direction());
  }


}

?>