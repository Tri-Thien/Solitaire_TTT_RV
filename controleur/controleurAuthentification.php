<?php
require_once PATH_VUE."/vueJeu.php";
require_once PATH_VUE."/vueAuthentification.php";
require_once PATH_VUE."/vueErreur.php";
require_once PATH_MODELE."/modelePlateau.php";
require_once PATH_MODELE."/modeleBD.php";

// Classe du controleur Authentification, qui va relier les vues liees a l'authentification aux modeles concernes
class ControleurAuthentification{

// Creation des variables
private $vueAuthentification;
private $vueJeu;
private $vueErreur;
private $modeleBD;
private $modelePlateau;

// Constructeur de la classe ControleurAuthentification
function __construct(){
$this->vueAuthentification=new VueAuthentification();
$this->vueJeu=new VueJeu();
$this->vueErreur=new VueErreur();
$this->modeleBD=new ModeleBD();
$this->modelePlateau=new ModelePlateau();
}

// Fonction accueil qui va permettre d'afficher la vue de l'Authentification (donc la page html)
function accueil(){
$this->vueAuthentification->demandePseudo();
}

// Fonction verifiePseudo qui va verifier si le couple pseudo/mot de passe insere dans la vue Authentification est correct
// Pre-Condition : le compte existe (donc le couple pseudo/mdp est dans la BD)
// Post-Condition : acces au jeu avec le pseudo de l'utilisateur
function verifiePseudo($pseudo, $mdp){
	//Si la fonction qui verifie le couple (pseudo/mdp) est vrai (donc il existe), on cree une variable de session "pseudo" et on lance le jeu
  if ($this->modeleBD->verifMdp($pseudo,$mdp)) {
    $_SESSION["pseudo"] = $pseudo;
    $this->modelePlateau->initialiserPlateau();
    $this->vueJeu->AffichageJeu();
  }
  else{ //Sinon, on cree une variable de session "erreur" qui va servir dans la vue Erreur, et on affiche la vue Erreur
  	$_SESSION["erreur"] = "connexion";
    $this->vueErreur->affichageErreur();
  }
}




}
