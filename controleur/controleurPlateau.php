<?php
require_once PATH_VUE."/vueJeu.php";
require_once PATH_VUE."/vueResultat.php";
require_once PATH_MODELE."/modelePlateau.php";


class ControleurPlateau{

private $vueJeu;
private $vueResultat;
private $modelePlateau;


function __construct(){
$this->vueJeu=new VueJeu();
$this->modelePlateau=new ModelePlateau();
$this->vueResultat = new VueResultat();
}

function enleverPion($x, $y){
  echo "x: ".$x;
  echo "y: ".$y;
  if ($this->modelePlateau->enlever1erPion($x,$y)) {
    $this->vueJeu->AffichageJeu();
  }
  else{
    echo "Cette position est impossible";
    $this->vueJeu->AffichageJeu();
  }
}

function preparerPion($xi, $yi){
  $_SESSION["xi"] = $xi;
  $_SESSION["yi"] = $yi;
  $_SESSION["depart"] = false;
  $this->vueJeu->AffichageJeu();
}

function deplacerPion($xf,$yf){
  if ($this->modelePlateau->deplacerPion($_SESSION["xi"],$_SESSION["yi"],$xf,$yf)) {
    if ($_SESSION["gagner"]) {
      echo "gg";
      //$this->vueResultat->
    }
    elseif ($_SESSION["perdu"]) {
      echo "perdu";
      //$this->vueResultat->
    }
    else {
      $_SESSION["depart"] = true;
      $this->vueJeu->AffichageJeu();
    }

  }
  else{
    $this->vueJeu->AffichageJeu();
  }
}


}
