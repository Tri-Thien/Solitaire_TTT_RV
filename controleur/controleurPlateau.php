<?php
require_once PATH_VUE."/vueJeu.php";
require_once PATH_MODELE."/modelePlateau.php";


class ControleurPlateau{

private $vueJeu;
private $modelePlateau;


function __construct(){
$this->vueJeu=new VueJeu();
$this->modelePlateau=new ModelePlateau();
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


}
