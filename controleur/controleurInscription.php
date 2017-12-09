<?php
require_once PATH_VUE."/vueInscription.php";
require_once PATH_VUE."/vueAuthentification.php";
require_once PATH_MODELE."/modeleBD.php";
require_once PATH_VUE."/vueErreur.php";


// Classe du controleur Inscription, qui va relier les vues liees a l'inscription et le modele concerne
class ControleurInscription{

// Creation des variables
private $vueInscription;
private $vueAuthentification;
private $modeleBD;


// Constructeur de la classe ControleurInscription
function __construct(){
$this->vueInscription=new VueInscription();
$this->vueAuthentification=new VueAuthentification();
$this->modeleBD=new ModeleBD();
$this->vueErreur=new VueErreur();
}

// Fonction accueil qui va permettre d'afficher la vue de l'Inscription (donc la page html)
function accueil(){
$this->vueInscription->inscription();
}


// Fonction inscrireCompte qui va inserer dans la BD le nouveau compte
// Pre-Condition : le pseudo n'existe pas deja
// Post-Condition : le compte est cree (donc le couple (pseudo/mdp) est insere dans la BD)
function inscrireCompte($pseudo,$mdp){
	//Si le pseudo existe deja, on creer une variable de session "erreur" de l'inscription et on affiche la vue Erreur
	if ($this->modeleBD->existsJoueur($pseudo)) {
		$_SESSION["erreur"] = "inscription";
    	$this->vueErreur->affichageErreur();
	}
	else{ //Sinon, on inscrit le joueur dans la BD et on re-accede a la vue Authentification
		$this->modeleBD->inscriptionJoueur($pseudo,$mdp);
		$this->vueAuthentification->demandePseudo();
	}
}





}
