<?php
require_once PATH_VUE."/vue.php";
require_once PATH_MODELE."/modele.php";


class ControleurNouveauMessage{

private $vue;
private $modele;


function __construct(){
$this->vue=new Vue();
$this->modele=new Modele();
}

function nouveauMessage($message){
    $this->modele->majSalon($_SESSSION["pseudo"], $message);
    $this->vue->salon( $this->modele->get10RecentMessage());
  }


}
