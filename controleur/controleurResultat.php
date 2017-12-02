<?php
require_once PATH_VUE."/vueResultat.php";
require_once PATH_MODELE."/modelePlateau.php";
require_once PATH_MODELE."/modeleBD.php";


class ControleurResultat{

private $vueResultat;
private $modeleBD;



function __construct(){
$this->vueResultat=new VueResultat();
$this->modeleBD=new ModeleBD();
}

function affichage($pseudo,$resultat){
	$_SESSION["pseudo"]=$pseudo;
	$_SESSION["partieGagne"]=$resultat;
    $this->modeleBD->majParties($pseudo,$resultat);
    $this->vueResultat->affichageResultat($this->modeleBD->getPartiesJoue($pseudo),$this->modeleBD->getPartiesGagne($pseudo));

}


}
