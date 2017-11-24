<?php
require_once PATH_VUE."/*";
require_once PATH_MODELE."/*";


class ControleurAuthentification{

private $vueAuthentification;
private $vueJeu;
private $modeleBD;
private $modelePlateau;


function __construct(){
$this->vueAuthentification=new VueAuthentification();
$this->vueJeu=new VueJeu();
$this->modeleBD=new ModeleBD();
$this->modelePlateau=new ModelePlateau();
}

function accueil(){
$this->vueAuthentification->demandePseudo();
}

function verifiePseudo($pseudo, $mdp){
  if (true) {
    $_SESSION["pseudo"] = $pseudo;
    $this->modelePlateau->initialiserPlateau();
    $this->vueJeu->AffichageJeu();
  }
  else{
    $this->vue->demandePseudo();
  }
}


}
