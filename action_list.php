<?php
class ActionList{

  function __construct($actor){
    $this->actor = $actor;
    $this->possible_actions = new Arr();
    $this->possible_actions->push(new MoveUpAction($this->actor));
    $this->possible_actions->push(new MoveDownAction($this->actor));
    $this->possible_actions->push(new MoveLeftAction($this->actor));
    $this->possible_actions->push(new MoveRightAction($this->actor));
    $this->possible_actions->push(new MoveNoneAction($this->actor));
  }

  public function getAvailable(){
    $this->available_actions = $this->possible_actions->select(function($i, $action){
	return $action->isAvailable();
      });
  }

  public function playBest(){
    $action = $this->available_actions->max(function($action){ 
	return $action->expectedValue();
      });
    $action->play();
  }

  public function numAvailable(){
    return $this->available_actions->length();
  }

}

?>