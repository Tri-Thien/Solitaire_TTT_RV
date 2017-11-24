<?php

require_once 'controleurAuthentification.php';

class Routeur {

  private $ctrlAuthentification;
  //private $ctrl;



  public function __construct() {
    $this->ctrlAuthentification= new ControleurAuthentification();
    //$this->ctrl= new Controleur();
  }

  // Traite une requête entrante
  public function routerRequete() {

    if (isset($_POST["pseudo"]) && isset($_POST["mdp"])) {
      $this->ctrlAuthentification->authentifie($_POST["pseudo"], $_POST["mdp"]);
     }
    /*else if (isset($_POST[""])) {
     $this->ctrl;
   }*/
    else {$this->ctrlAuthentification->accueil();}
 }


 }




?>
