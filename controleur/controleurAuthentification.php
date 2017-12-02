<?php
require_once PATH_VUE."/vueJeu.php";
require_once PATH_VUE."/vueAuthentification.php";
require_once PATH_VUE."/vueErreur.php";
require_once PATH_MODELE."/modelePlateau.php";
require_once PATH_MODELE."/modeleBD.php";


class ControleurAuthentification{

private $vueAuthentification;
private $vueJeu;
private $vueErreur;
private $modeleBD;
private $modelePlateau;


function __construct(){
$this->vueAuthentification=new VueAuthentification();
$this->vueJeu=new VueJeu();
$this->vueErreur=new VueErreur();
$this->modeleBD=new ModeleBD();
$this->modelePlateau=new ModelePlateau();
}

function accueil(){
$this->vueAuthentification->demandePseudo();
}

function verifiePseudo($pseudo, $mdp){
  if ($this->modeleBD->verifMdp($pseudo,$mdp)) {
    $_SESSION["pseudo"] = $pseudo;
    $_SESSION["debut"] = true;
    $_SESSION["depart"] = true;
    $this->modelePlateau->initialiserPlateau();
    $this->vueJeu->AffichageJeu();
  }
  else{
    $this->vueErreur->affichageErreur();
  }
}


}
