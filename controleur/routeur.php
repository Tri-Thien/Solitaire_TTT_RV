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
    else {$this->ctrlAuthentification->accueil();}
 }


 }




?>
