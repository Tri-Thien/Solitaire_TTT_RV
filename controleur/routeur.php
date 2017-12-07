<?php

require_once 'controleurAuthentification.php';
require_once 'controleurPlateau.php';

class Routeur {

  private $ctrlAuthentification;
  private $ctrlPlateau;



  public function __construct() {
    $this->ctrlAuthentification= new ControleurAuthentification();
    $this->ctrlPlateau= new ControleurPlateau();
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
    else if (isset($_POST["Recommencer"])) {
      $this->ctrlPlateau->preparerPion($_POST["pos_X_avant_Deplacer"], $_POST["pos_Y_avant_Deplacer"]);
    }
    else if (isset($_POST["Deconnecter"])){
      $this->ctrlAuthentification->accueil();
    }
    else {$this->ctrlAuthentification->accueil();}
 }


 }




?>
