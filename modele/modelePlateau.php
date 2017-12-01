<?php


// Classe qui gère les accès à la base de données

class ModelePlateau{

  public function __construct(){
  }

  public function initialiserPlateau(){

    for ($i=0; $i < 7; $i++) {
      for ($j=0; $j < 7; $j++) {
        if (($i == 0 || $i == 1 || $i == 5 || $i == 6)&&($j == 0 || $j == 1 || $j == 5 || $j == 6)) {
          $_SESSION["plateau"][$i][$j] = -1;
        }
        else{
          $_SESSION["plateau"][$i][$j] = 1;
        }
      }
    }
    $_SESSION["debut"] = true;
  }

  public function enlever1erPion($x, $y){
    $_SESSION["plateau"][$x][$y] = 0;
    $_SESSION["debut"] = false;
  }

  public function deplacerPion($xi, $yi, $xf, $yf){
    if ($this->verifierDeplacement($xi, $yi, $xf, $yf)) {
        if ($xi == $xf) {
          if ($yi - $yf == 2 ) {
            $_SESSION["plateau"][$xi][$yi] == 0;
            $_SESSION["plateau"][$xf][$yf] == 1;
            $_SESSION["plateau"][$xi][$yf-1] == 0;
          }
          elseif ($yi - $yf == -2 ) {
            $_SESSION["plateau"][$xi][$yi] == 0;
            $_SESSION["plateau"][$xf][$yf] == 1;
            $_SESSION["plateau"][$xi][$yi-1] == 0;
          }
        }
        elseif ($yi == $yf) {
          if ($xi - $xf == 2 ) {
            $_SESSION["plateau"][$xi][$yi] == 0;
            $_SESSION["plateau"][$xf][$yf] == 1;
            $_SESSION["plateau"][$xf-1][$yf] == 0;
          }
          elseif ($yi - $yf == -2 ) {
            $_SESSION["plateau"][$xi][$yi] == 0;
            $_SESSION["plateau"][$xf][$yf] == 1;
            $_SESSION["plateau"][$xi-1][$yi] == 0;
          }
        }
        return true;
    }
    else{
      return false;
    }
    // verifier win ou pas
  }

  public function verifierDeplacement($xi, $yi, $xf, $yf){
    if (($_SESSION["plateau"][$xi][$yi] == 1) && ($_SESSION["plateau"][$xf][$yf] == 0)) {
      if ($xi != $xf && $yi != $yf) {
        return false;
      }
      elseif ($xi == $xf) {
        if ($yi - $yf == 2 ) {
          if (($_SESSION["plateau"][$xi][$yf-1] == 1)) {
            return true;
          }
          else{
            return false;
          }
        }
        elseif ($yi - $yf == -2 ) {
          if (($_SESSION["plateau"][$xi][$yi-1] == 1)) {
            return true;
          }
          else{
            return false;
          }
        }
        else{
          return false;
        }
      }
      elseif ($yi == $yf) {
        if ($xi - $xf == 2 ) {
          if (($_SESSION["plateau"][$xf-1][$yf] == 1)) {
            return true;
          }
          else{
            return false;
          }
        }
        elseif ($xi - $xf == -2 ) {
          if (($_SESSION["plateau"][$xi-1][$yi] == 1)) {
            return true;
          }
          else{
            return false;
          }
        }
        else{
          return false;
        }
      }

    }
    else {
      return false;
    }
  }

}

?>
