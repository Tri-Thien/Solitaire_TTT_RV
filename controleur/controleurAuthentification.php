<?php
require_once PATH_VUE."/vue.php";
require_once PATH_MODELE."/modele.php";


class ControleurAuthentification{

private $vue;
private $modele;


function __construct(){
$this->vue=new Vue();
$this->modele=new Modele();


}

function accueil(){
$this->vue->demandePseudo();
}

function verifiePseudo($pseudo){
  if ($this->modele->exists($pseudo)) {
    $_SESSION["pseudo"] = $pseudo;
    $this->vue->salon( $this->modele->get10RecentMessage());
  }
  else{
    $this->vue->demandePseudo();
  }
}


}
