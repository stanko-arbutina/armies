<?php

class Army{
  function __construct($actor, $size){
    $this->general = $actor;
    $this->size = $size;
    $this->morale = $size;
    $this->exhaustion = 0;
    $this->fortification = 0;
  }

  public function fortify(){
    $this->fortification+=1;
  }

  public function rest(){
    if ($this->exhaustion>0) $this->exhaustion-=1;
  }

  public function exhaust(){
    $this->exhaustion+=1;
  }
  

  public function affiliation(){
    return $this->general->affiliation;
  }

  function __toString(){
    return '['.$this->affiliation().'] Veličina: '.$this->size.' | Moral: '.$this->morale.'| Iscrpljenost: '.$this->exhaustion.' | Utvrđenost: '.$this->fortification.' | Ukupna snaga: '. $this->strength();
  }

  private function strengthFactor(){
    //nakon malo poštelavanja, ali tu treba ići nešto smisleno
    $num = ($this->size/5 +(($this->morale+2*($this->fortification)))/($this->size/5+(3*$this->exhaustion)));
    return $num;
  }

  public function strength(){
    return floor(1+ abs($this->size*$this->strengthFactor()) );
  }
}

?>