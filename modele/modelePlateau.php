<?php


// Classe qui gère les accès à la base de données

class ModelePlateau{

  public function __construct(){
  }

  public function initialiserPlateau(){

    /*for ($i=0; $i < 7; $i++) {
      for ($j=0; $j < 7; $j++) {
        if (($i == 0 || $i == 1 || $i == 5 || $i == 6)&&($j == 0 || $j == 1 || $j == 5 || $j == 6)) {
          $_SESSION["plateau"][$i][$j] = -1;
        }
        else{
          $_SESSION["plateau"][$i][$j] = 1;
        }
      }
    }*/
    $_SESSION["plateau"] = array();

    $_SESSION["plateau"][0] = array(-1,-1,0,0,0,-1,-1);
    $_SESSION["plateau"][1] = array(-1,-1,0,0,0,-1,-1);
    $_SESSION["plateau"][2] = array( 0, 0,1,1,1, 0, 0);
    $_SESSION["plateau"][3] = array( 0, 0,0,1,0, 0, 0);
    $_SESSION["plateau"][4] = array( 0, 0,0,1,0, 0, 0);
    $_SESSION["plateau"][5] = array(-1,-1,0,0,0,-1,-1);
    $_SESSION["plateau"][6] = array(-1,-1,0,0,0,-1,-1);



    $_SESSION["debut"] = true;
    $_SESSION["depart"] = true;
    $_SESSION["retour"] = true;
    $_SESSION["debut"] = true;
  }

  public function enlever1erPion($x, $y){
    if (($x == 0 || $x == 1 || $x == 5 || $x == 6)&&($y == 0 || $y == 1 || $y == 5 || $y == 6)) {
      return false;
    }
    $_SESSION["plateau"][$x][$y] = 0;
    $_SESSION["debut"] = false;
    return true;
  }

  public function deplacerPion($xi, $yi, $xf, $yf){
    if ($this->verifierDeplacement($xi, $yi, $xf, $yf)) {
        if ($xi == $xf) {
          if ($yi - $yf == 2 ) {
            $_SESSION["plateau"][$xi][$yi] = 0;
            $_SESSION["plateau"][$xf][$yf] = 1;
            $_SESSION["plateau"][$xi][$yi-1] = 0;
          }
          elseif ($yi - $yf == -2 ) {
            $_SESSION["plateau"][$xi][$yi] = 0;
            $_SESSION["plateau"][$xf][$yf] = 1;
            $_SESSION["plateau"][$xi][$yf-1] = 0;
          }
        }
        elseif ($yi == $yf) {
          if ($xi - $xf == 2 ) {
            $_SESSION["plateau"][$xi][$yi] = 0;
            $_SESSION["plateau"][$xf][$yf] = 1;
            $_SESSION["plateau"][$xi-1][$yf] = 0;
          }
          elseif ($xi - $xf == -2 ) {
            $_SESSION["plateau"][$xi][$yi] = 0;
            $_SESSION["plateau"][$xf][$yf] = 1;
            $_SESSION["plateau"][$xf-1][$yi] = 0;
          }
        }
        $this->finirDeplacement();
        return true;
    }
    else{
      return false;
    }
    // verifier win ou pas
  }

  public function verifierDeplacement($xi, $yi, $xf, $yf){
    if (!($xi < 0 || $xi > 6 || $xf < 0 || $xf > 6 || $yi < 0 || $yi > 6 || $yf < 0 || $yf > 6 )) {
      if (($_SESSION["plateau"][$xi][$yi] == 1) && ($_SESSION["plateau"][$xf][$yf] == 0)) {
        if ($xi != $xf && $yi != $yf) {
          return false;
        }
        elseif ($xi == $xf) {
          if ($yi - $yf == 2 ) {
            if (($_SESSION["plateau"][$xi][$yi-1] == 1)) {
              return true;
            }
            else{
              return false;
            }
          }
          elseif ($yi - $yf == -2 ) {
            if (($_SESSION["plateau"][$xi][$yf-1] == 1)) {
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
            if (($_SESSION["plateau"][$xi-1][$yf] == 1)) {
              return true;
            }
            else{
              return false;
            }
          }
          elseif ($xi - $xf == -2 ) {
            if (($_SESSION["plateau"][$xf-1][$yi] == 1)) {
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
    else {
      return false;
    }
  }

  public function finirDeplacement(){
    if ($this->verifierGagner()) {
      $_SESSION["gagner"] = true;
    }
    elseif ($this->verifierPerdre()) {
      $_SESSION["perdu"] = true;
    }
    else {
      $_SESSION["gagner"] = false;
      $_SESSION["perdu"] = false;
    }
  }

  public function verifierGagner(){
    $res = 0;
    for ($i=0; $i < 7; $i++) {
      for ($j=0; $j < 7; $j++) {
        if ($_SESSION["plateau"][$i][$j] == 1) {
          $res = $res + 1;
        }
      }
    }
    if ($res == 1) {
      return true;
    }
    else {
      return false;
    }
  }

  public function verifierPerdre(){
    for ($i=0; $i < 7; $i++) {
      for ($j=0; $j < 7; $j++) {
        if ($this->verifierDeplacement($i, $j, $i+2, $j) || $this->verifierDeplacement($i, $j, $i-2, $j) || $this->verifierDeplacement($i, $j, $i, $j+2) || $this->verifierDeplacement($i, $j, $i, $j-2)) {
          return false;
        }
      }
    }
    return true;
  }


}

?>
