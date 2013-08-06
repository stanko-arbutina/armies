<?php
class Game{

  function generateMap(){
    $this->out->addLine('Generiram mapu...');
    $this->map = new Map(15,10);
    $this->out->table($this->map->tabular());
    $this->out->lineBreak();
  }

  function generateActors($size1, $size2){
    $this->out->addLine('Generiram vojske...');
    $this->actors = new Arr();
    $loc1 = $this->map->getNextRandom();
    $loc2 = $this->map->getNextRandom();
    $loc3 = $this->map->getNextRandom();
    $aff1 = 'Zeleni';
    $aff2 = 'Plavi';
    $acc1 = new Actor($aff1, $loc1, $size1, $loc3);
    $acc2 = new Actor($aff2, $loc2, $size2, $loc3);
    $this->actors->push($acc1);
    $this->actors->push($acc2);
    $out = $this->out;
    $this->actors->each(function($ind, $actor) use (&$out){
	$out->addLine(($ind+1).'. '.$actor->status());
    });
    $this->out->lineBreak();
    $this->out->addLine('Bitka je dogovorena na lokaciji '.$loc3);
    $this->out->lineBreak();
  }

  function endCondition(){
    return $this->actors->all(function($index, $actor){
	return $actor->reachedBattlePoint();
      });
  }

  function __construct($first_army_size, $second_army_size){
    $this->out = new Outputter();

    $this->generateMap();
    $this->generateActors($first_army_size, $second_army_size);
    $this->out->addLine();
    $this->out->addLine('     !!! Vojske su krenule !!!');
    $this->out->addLine();
    $this->out->lineBreak();
    $obj = $this;
    do {
      $this->actors->each(function($ind, $actor) use (&$obj){
	  $obj->out->addLine("Na potezu je ".$actor->identStr());
	  $actor->play();
	  $obj->out->addSubLine($actor->status());
	  $events = WorldEventGenerator::generate($actor->army);
	  if ($events->length()>0){
	    $events->each(function($i, $event_text) use (&$obj){
		$obj->out->addSubLine($event_text);
	      });
	    $obj->out->addSubLine('('.$actor->army.')');
	  }
      });
    } while (!$this->endCondition());
    $this->out->lineBreak();

    //bitka će biti još jedna moguća akcija, za sada fiksno
    $this->doBattle();
    $this->out->lineBreak();
    $this->out->addLine();
    $this->out->addLine('     !!! KRAJ !!!');
    $this->out->addLine();
    $this->out->lineBreak();

    $this->out->flush();
  }

  private function doBattle(){
        $this->out->addLine('Bitka počinje');
	$a1 = $this->actors->first();
	$a2 = $this->actors->last();
	$this->out->addSubLine($a1->army);
	$this->out->addSubLine($a2->army);
	$battle = new DiscreteProbability();
	$battle->push($a1->army->strength(), $a1->affiliation);
	$battle->push($a2->army->strength(), $a2->affiliation);
	$this->out->addLine('Pobijedio/la je '.$battle->get());
  }
}

?>