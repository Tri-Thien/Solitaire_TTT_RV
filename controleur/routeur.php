<?php

require_once 'controleurAuthentification.php';
require_once 'controleurPlateau.php';
require_once 'controleurInscription.php';

// Classe qui permet de renvoyer les requettes vers les bons controlleurs
class Routeur {

  private $ctrlAuthentification;
  private $ctrlPlateau;
  private $ctrlInscription;

//Constructeur de la classe routeur
  public function __construct() {
    $this->ctrlAuthentification= new ControleurAuthentification();
    $this->ctrlPlateau= new ControleurPlateau();
    $this->ctrlInscription=new ControleurInscription();
  }

// Fonction qui redirige les requettes reçue vers les bon controleurs
// precondition: -
// post-condition: -
  public function routerRequete() {

    if (isset($_POST["pseudo"]) && isset($_POST["mdp"])) { //Requette pour la connexion
      $this->ctrlAuthentification->verifiePseudo($_POST["pseudo"], $_POST["mdp"]);
     }
    else if (isset($_POST["pos_X_Depart"]) && isset($_POST["pos_X_Depart"])) { //Requette pour la suppression du premier pion
     $this->ctrlPlateau->enleverPion($_POST["pos_X_Depart"], $_POST["pos_Y_Depart"]);
    }
    else if (isset($_POST["pos_X_avant_Deplacer"]) && isset($_POST["pos_Y_avant_Deplacer"])) { // Requette pour la selection d'un pion
     $this->ctrlPlateau->preparerPion($_POST["pos_X_avant_Deplacer"], $_POST["pos_Y_avant_Deplacer"]);
    }
    else if (isset($_POST["pos_X_apres_Deplacer"]) && isset($_POST["pos_Y_apres_Deplacer"])) { // Requette pour le déplacement d'un pion 
     $this->ctrlPlateau->deplacerPion($_POST["pos_X_apres_Deplacer"], $_POST["pos_Y_apres_Deplacer"]);
    }
    else if (isset($_POST["Retour_Arriere"])) { //Requette pour le bouton "Annuler le coup"
     $this->ctrlPlateau->retourArriere();
    }
    else if (isset($_POST["Deconnecter"])){ //Requette pour la déconnexion
      $this->ctrlAuthentification->accueil();
    }
    else if (isset($_POST["Reinitialiser_Plateau"])){ //Requette pour la reinitialisation du plateau
      $this->ctrlPlateau->reinitialiserPlateau();
    }
    else if (isset($_POST["Inscription"])){ //Requette pour acceder à l'inscription
      $this->ctrlInscription->accueil();
    }
    else if (isset($_POST["iPseudo"]) && isset($_POST["iMdp"])){ //requette pour l'inscription
      $this->ctrlInscription->inscrireCompte($_POST["iPseudo"],$_POST["iMdp"]);
    }
    else {$this->ctrlAuthentification->accueil();} // Retour de base à l'authentification
 }


 }




?>
