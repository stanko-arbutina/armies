
<?php
//ovo je ukrasno zapravo, biti će ozbiljniji eventovi
class WorldEventGenerator{

  public static function generate($army){
    $rez = new Arr();
    $limit = 6;
	$blacklisted = array();
    do {
      $event = (rand(0,11)>$limit);
      if ($event){
	$limit++;
	$event_id = rand(0,11);
	if (!in_array($event_id, $blacklisted)){
	  array_push($blacklisted,$event_id);
	  switch ($event_id){
	    case 0:
	      $txt = 'Vojska je srela babu gataru. Za omanju količinu zlatnika predvidjela im je uspjeh i slavu u bitci. Moral je porastao.';
	      $army->morale+=1;
	      break;
	    case 1:
	      $txt = 'Skupina lokalnih dobrovoljaca se pridružila vojsci. Moral je porastao.';
	      $army->size+=20;
	      $army->morale+=2;
	      break;
   	    case 2:
	      $txt = 'Uz put su sreli skupinu putujućih bardova. Uz priče, piće i kulturno uzdizanje vojnici su se osjetili odmorenima i spremnima za nove ratne pobjede.';
	      $army->rest();
	      $army->morale+=2;
	      break;
	    case 3:
	      $txt = 'General je danas bio posebno inspiriran i podigao borbeni duh veličanstvenim govorom.';
	      $army->morale+=3;
	      break;
	    case 4:
	      $txt = 'Stiglo je pojačanje (40 vojnika).';
	      $army->size+=40;
	      break;

	    case 5:
	      $txt = 'Danas je bio veliki praznik, pa su se vojnici raštrkali po lokalnim krčmama i slavili cijelu noć. Iako su svi dobro raspoloženi, mnogi pate od mamurluka.';
	      $army->exhaust();
	      $army->morale+=1;
	      break;
	    case 6:
	      $txt = 'U vojsci se govorkalo o maloj skupini vojnika koji ostalima tiho šapuću protiv kralja, kao i o besmislu rata. Preko noći su organizirano napustili jedinicu. Zapovjednik doduše nije imao ništa protiv, bili su štetni po disciplinu ostalih.';
	      $army->size-=15;
	      $army->morale+=3;
	      break;

	    case 7:
	      $txt = 'Među vojskom se proširila nepoznata bolest. Nekoliko vojnika je umrlo, a ni ostali nisu u najboljoj formi.';
	      $army->size-=30;
	      $army->exhaust();
	      break;
	    case 8:
	      $txt = 'Po noći se skupina pljačkaša ušuljala u kamp i ukrala manji dio zaliha. Materijalna šteta nije velika, ali se vojnici osjećaju izloženo.';
	      $army->morale-=8;
	      break;
	    case 9:
	      $txt = 'Skupina vojnika je naprosto pobjegla iz kampa u sred noći. Dezertiranje je loše za moral.';
	      $army->morale-=5;
	      $army->size-=15;
	      break;
	    case 10:
	      $txt = 'Vojsku su stigle loše vijesti iz domovine. Zemlja je u ekonomskoj krizi i ne znaju kakva situacija će ih dočekati ako se vrate.';
	      $army->morale-=10;
	      break;
	    case 11:
	      $txt = 'Diglo se strašno nevrijeme, vojnici su se iscrpili boreći se sa silama prirode.';
	      $army->exhaust();
	      break;




	    
	  }//end switch
	  $rez->push($txt);
	}//end if not blacklisted
      }
    } while ($event);
    return $rez;
  }

}

?>