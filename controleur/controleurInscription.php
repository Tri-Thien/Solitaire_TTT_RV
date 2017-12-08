<?php
require_once PATH_VUE."/vueInscription.php";
require_once PATH_VUE."/vueAuthentification.php";
require_once PATH_MODELE."/modeleBD.php";
require_once PATH_VUE."/vueErreur.php";


class ControleurInscription{

private $vueInscription;
private $vueAuthentification;
private $modeleBD;



function __construct(){
$this->vueInscription=new VueInscription();
$this->vueAuthentification=new VueAuthentification();
$this->modeleBD=new ModeleBD();
$this->vueErreur=new VueErreur();
}

function accueil(){
$this->vueInscription->inscription();
}

function inscrireCompte($pseudo,$mdp){
	if ($this->modeleBD->existsJoueur($pseudo)) {
		$_SESSION["erreur"] = "inscription";
    	$this->vueErreur->affichageErreur();
	}
	else{
		$this->modeleBD->inscriptionJoueur($pseudo,$mdp);
		$this->vueAuthentification->demandePseudo();
	}
}





}
