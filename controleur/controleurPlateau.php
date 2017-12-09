<?php
require_once PATH_VUE."/vueJeu.php";
require_once PATH_VUE."/vueResultat.php";
require_once PATH_MODELE."/modelePlateau.php";
require_once PATH_MODELE."/modeleBD.php";

// Classe qui relie les vues aux modèles
class ControleurPlateau{

private $vueJeu;
private $vueResultat;
private $modelePlateau;
private $modeleBD;

//Constructeur de la classe ControleurPlateau
function __construct(){
$this->vueJeu=new VueJeu();
$this->modelePlateau=new ModelePlateau();
$this->vueResultat = new VueResultat();
$this->modeleBD = new ModeleBD();
}

// Fonction qui appelle la fonction enlever1erPion de ModelePlateau
// cela enleve le premier pion du plateau via les coodonnees x et y en parametre
// precondition: -
// post-condition: La vue Jeu est affiché et si il y a un problème un message s'affiche
function enleverPion($x, $y){
  if ($this->modelePlateau->enlever1erPion($x,$y)) { //enleve le premier pion qui a les coordonées x et y 
    $this->vueJeu->AffichageJeu(); //Réaffiche la vueJeu
  }
  else{
    echo "Cette position est impossible";
    $this->vueJeu->AffichageJeu();
  }
}

// Fonction qui prépare un déplacement en mettant dans des variables de sessions les coordonées du pion selectionné.
// precondition: -
// post-condition: Des variables de session sont initialisée ou changée et la vue Jeu est réaffichée.
function preparerPion($xi, $yi){
  $_SESSION["xi"] = $xi; //Met la coordonnée X du pion selectioné dans une variablede session
  $_SESSION["yi"] = $yi; //Met la coordonnée Y du pion selectioné dans une variablede session
  $_SESSION["depart"] = false; //Indique qu'un pion est selectioné et que l'utilisateur doit maintenant choisir une case d'arrivée
  $_SESSION["plateau"][$xi][$yi] = 2; //Change la valeur de la case contenant le pion selectioné de 1 à 2. Cela permet d'afficher le pion de manière différente et permet de re-cliquer sur cette case pour annuler le déplacement
  $this->vueJeu->AffichageJeu(); //Réaffiche la vueJeu
}

// Fonction qui déplace un pion préparé auparavant (via la méthode preparerPion ci au-dessus) dans une case ayant ses coordonnées en paramètre.
// precondition: -
// post-condition: Ré-affiche la vueJeu si le déplacement est possible ou non et affiche la vueRésultat si la partie est gagnée ou perdu.
function deplacerPion($xf,$yf){
   $_SESSION["plateau"][$_SESSION["xi"]][$_SESSION["yi"]] = 1; //remet la valeur du pion selectioné de 2 à 1 pour les vérification
   if ($this->modelePlateau->verifierDeplacement($_SESSION["xi"],$_SESSION["yi"],$xf,$yf)) { //Si le déplacement est possible
     $_SESSION["plateauAncien"] = $_SESSION["plateau"]; //Met la valeur du plateau dans une variable de session (utilisé pour le bouton "annuler le déplacement")
   }
  if ($this->modelePlateau->deplacerPion($_SESSION["xi"],$_SESSION["yi"],$xf,$yf)) { //Utilise une méthode de modelePlateau pour faire le déplacement
    if ($_SESSION["gagner"]) { //Vérifie si la partie est gagnée
      $_SESSION["partieGagne"] = true;
      $this->modeleBD->majParties($_SESSION["pseudo"],$_SESSION["partieGagne"]); //Utilise une méthode du ModeleBD pour ajouter la partie gagnée à la base de donnée
      $this->vueResultat->affichageResultat($this->modeleBD->getStats($_SESSION["pseudo"]),$this->modeleBD->get3MeilleursJoueurs()); // Affiche la vueResultat avec en paramètre les statistique du joueur et des trois meilleur joueurs. Ces statistiques sont récupérés via des méthode de modèleBD
    }
    elseif ($_SESSION["perdu"]) { //Vérifie si la partie est perdu
      $_SESSION["partieGagne"] = false;
      $this->modeleBD->majParties($_SESSION["pseudo"],$_SESSION["partieGagne"]); //Utilise une méthode du ModeleBD pour ajouter la partie perdue à la base de donnée
      $this->vueResultat->affichageResultat($this->modeleBD->getStats($_SESSION["pseudo"]),$this->modeleBD->get3MeilleursJoueurs()); // Affiche la vueResultat avec en paramètre les statistique du joueur et des trois meilleur joueurs. Ces statistiques sont récupérés via des méthode de modèleBD
    }
    else { //Si la partie n'est ni gagnée ni perdue, la partie doit continuer
      $_SESSION["retour"] = false; //Variable qui permet de ré-activer le bouton "annuler le coup"
      $_SESSION["depart"] = true; //Variable qui permet de dire que le déplacement est finit et qu'il faut que le joueur selectionne un pion
      $this->vueJeu->AffichageJeu(); //Affiche la vue jeu
    }

  }
  else{// Si le déplacement n'est pas valable
    $_SESSION["retour"] = false; //Variable qui permet de ré-activer le bouton "annuler le coup"
    $_SESSION["faute"] = true; // Permet d'afficher un message d'erreur et de dire que le déplacement ne s'est pas bien passé
    $_SESSION["depart"] = true; //Variable qui permet de dire que le déplacement est finit et qu'il faut que le joueur selectionne un pion
    $this->vueJeu->AffichageJeu(); //Affiche la vue jeu
  }
}

// Fonction qui permet d'annuler le cou précédent
// precondition: Au moins un déplacement à été fait
// post-condition: Affiche la vue jeu en ayant annulé le coup précedent
function retourArriere(){
  $_SESSION["plateau"] = $_SESSION["plateauAncien"]; //Recharge le plateau avant le déplacement, la variable de session "plateauAncien" est changé à chaque déplacement (dans la méthode deplacerPion ci-dessus)
  $_SESSION["retour"] = true; //Variable qui indique que le bouton de retour à été utilisé et donc qu'il ne peut être réutiliser
  $_SESSION["depart"] = true; //Variable qui permet de dire que le déplacement est finit et qu'il faut que le joueur selectionne un pion
  $this->vueJeu->AffichageJeu(); //Affiche la vue jeu
}

// Fonction qui permet de réinitialiser le plateau
// precondition: -
// post-condition: Le plateau est réinitialiser
function reinitialiserPlateau(){
  $this->modelePlateau->initialiserPlateau(); //Utilise une méthode de modelePlateau pour réinitilaiser la partie
  $this->vueJeu->AffichageJeu();  //Affiche la vue jeu
}


}
