<?php

require_once 'controleurAuthentification.php';
require_once 'controleurPlateau.php';
require_once 'controleurInscription.php';

class Routeur {

  private $ctrlAuthentification;
  private $ctrlPlateau;
  private $ctrlInscription;


  public function __construct() {
    $this->ctrlAuthentification= new ControleurAuthentification();
    $this->ctrlPlateau= new ControleurPlateau();
    $this->ctrlInscription=new ControleurInscription();
  }

  // Traite une requête entrante
  public function routerRequete() {

    if (isset($_POST["pseudo"]) && isset($_POST["mdp"])) {
      $this->ctrlAuthentification->verifiePseudo($_POST["pseudo"], $_POST["mdp"]);
     }
    else if (isset($_POST["pos_X_Depart"]) && isset($_POST["pos_X_Depart"])) {
     $this->ctrlPlateau->enleverPion($_POST["pos_X_Depart"], $_POST["pos_Y_Depart"]);
    }
    else if (isset($_POST["pos_X_avant_Deplacer"]) && isset($_POST["pos_Y_avant_Deplacer"])) {
     $this->ctrlPlateau->preparerPion($_POST["pos_X_avant_Deplacer"], $_POST["pos_Y_avant_Deplacer"]);
    }
    else if (isset($_POST["pos_X_apres_Deplacer"]) && isset($_POST["pos_Y_apres_Deplacer"])) {
     $this->ctrlPlateau->deplacerPion($_POST["pos_X_apres_Deplacer"], $_POST["pos_Y_apres_Deplacer"]);
    }
    else if (isset($_POST["Retour_Arriere"])) {
     $this->ctrlPlateau->retourArriere();
    }
    else if (isset($_POST["Deconnecter"])){
      $this->ctrlAuthentification->accueil();
    }
    else if (isset($_POST["Reinitialiser_Plateau"])){
      $this->ctrlPlateau->reinitialiserPlateau();
    }
    else if (isset($_POST["Inscription"])){
      $this->ctrlInscription->accueil();
    }
    else if (isset($_POST["iPseudo"]) && isset($_POST["iMdp"])){
      $this->ctrlInscription->inscrireCompte($_POST["iPseudo"],$_POST["iMdp"]);
    }
    else {$this->ctrlAuthentification->accueil();}
 }


 }




?>
