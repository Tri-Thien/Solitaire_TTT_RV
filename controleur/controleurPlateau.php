<?php
require_once PATH_VUE."/vueJeu.php";
require_once PATH_VUE."/vueResultat.php";
require_once PATH_MODELE."/modelePlateau.php";
require_once PATH_MODELE."/modeleBD.php";


class ControleurPlateau{

private $vueJeu;
private $vueResultat;
private $modelePlateau;
private $modeleBD;


function __construct(){
$this->vueJeu=new VueJeu();
$this->modelePlateau=new ModelePlateau();
$this->vueResultat = new VueResultat();
$this->modeleBD = new ModeleBD();
}

function enleverPion($x, $y){
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
      $_SESSION["partieGagne"] = true;
      $this->modeleBD->majParties($_SESSION["pseudo"],$_SESSION["partieGagne"]);
      $this->vueResultat->affichageResultat($this->modeleBD->getPartiesJoue($_SESSION["pseudo"]),$this->modeleBD->getPartiesGagne($_SESSION["pseudo"]));
    }
    elseif ($_SESSION["perdu"]) {
      echo "perdu";
      $_SESSION["partieGagne"] = false;
      $this->modeleBD->majParties($_SESSION["pseudo"],$_SESSION["partieGagne"]);
      $this->vueResultat->affichageResultat($this->modeleBD->getPartiesJoue($_SESSION["pseudo"]),$this->modeleBD->getPartiesGagne($_SESSION["pseudo"]));
    }
    else {
      $_SESSION["depart"] = true;
      $this->vueJeu->AffichageJeu();
    }

  }
  else{
    $_SESSION["depart"] = true;
    $this->vueJeu->AffichageJeu();
  }
}


}
