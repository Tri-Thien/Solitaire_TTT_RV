<?php

// Classe generale de definition d'exception
class MonException extends Exception{
  private $chaine;
  public function __construct($chaine){
    $this->chaine=$chaine;
  }

  public function afficher(){
    return $this->chaine;
  }

}


// Classe qui gère les accès à la base de données

class ModelePlateau{

  public function __construct(){
  }

  public function initialiserPlateau(){

    for ($i=0; $i < 7; $i++) {
      for ($j=0; $j < 7; $j++) {
        if (($i == 0 || $i == 1 || $i == 5 || $i == 6)&&($j == 0 || $j == 1 || $j == 5 || $j == 6)) {
          $_SESSION["plateau"][$i][$y] = -1;
        }
        else{
          $_SESSION["plateau"][$i][$j] = 1;
        }
      }
    }
  }

  public function deplacerPion($x, $y){

  }

}

?>
