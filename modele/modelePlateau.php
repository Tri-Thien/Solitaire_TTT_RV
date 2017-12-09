<?php


// Classe qui gere toutes les modifications lie au plateau

class ModelePlateau{

//Constructeur de la classe ModelePlateau
  public function __construct(){
  }


// Fonction qui initialise un plateau de solitaire dans une matrice de 7 sur 7 case.
// Cette matrice est remplie d'entier : -1 = case blanche (case inacessibles), 0 = Case vide, 1 = Case avec un pion, 2 = case avec un pion selectionne
// Cette matrice est stocke dans une variable de session nomee "plateau" pour etre accessible facilement de n'importe où.
// La Fonction initialise de plus d'autres variable utilisees plus tard
// precondition: -
// post-condition: le plateau est initialise et stocke dans une variable de session
  public function initialiserPlateau(){
//Double boucle for pour remplir le plateau
    for ($i=0; $i < 7; $i++) {
      for ($j=0; $j < 7; $j++) {
        if (($i == 0 || $i == 1 || $i == 5 || $i == 6)&&($j == 0 || $j == 1 || $j == 5 || $j == 6)) {
          $_SESSION["plateau"][$i][$j] = -1;
        }
        else{
          $_SESSION["plateau"][$i][$j] = 1;
        }
      }
    }

    //Initialisation manuelle qui nous servait pour les tests.
    /*$_SESSION["plateau"] = array();
    $_SESSION["plateau"][0] = array(-1,-1,0,0,0,-1,-1);
    $_SESSION["plateau"][1] = array(-1,-1,0,0,0,-1,-1);
    $_SESSION["plateau"][2] = array( 0, 0,1,1,1, 0, 0);
    $_SESSION["plateau"][3] = array( 0, 0,0,1,0, 0, 0);
    $_SESSION["plateau"][4] = array( 0, 0,0,1,0, 0, 0);
    $_SESSION["plateau"][5] = array(-1,-1,0,0,0,-1,-1);
    $_SESSION["plateau"][6] = array(-1,-1,0,0,0,-1,-1);*/


    //Variables utilisee plus tard
    $_SESSION["debut"] = true; //True = debut de la partie, false = le premier pion a ete supprime
    $_SESSION["depart"] = true; //True = Depart du tour de jeu, false = un pion a ete selectione
    $_SESSION["retour"] = true; //False = bouton de retour non utilise et donc disponilbe, True = bouton de retour utilise et donc non disponible
    $_SESSION["faute"] = false; //False = Il n'y a pas d'erreur de deplacement, True = le deplacement precedent n'est pas bon
  }

// Fonction qui enleve le premier pion du plateau via les coodonnees x et y en parametre
// precondition: Les coordonnees du pion doivent etre bonnes (pas de case blanche ni hors plateau)
// post-condition: la case avec le pion choisie devient une case blanche, retourne true si tout c'est bien passe sinon retourne false
  public function enlever1erPion($x, $y){
    //Verifie que la case n'est pas une case blanche
    if (($x == 0 || $x == 1 || $x == 5 || $x == 6)&&($y == 0 || $y == 1 || $y == 5 || $y == 6)) {
      return false;
    }
    $_SESSION["plateau"][$x][$y] = 0; //Transforme la case avec un pion en case vide
    $_SESSION["debut"] = false; //Indique que le 1er pion a ete enleve
    return true;
  }

// Fonction qui gere les deplacement d'un pion aux coordonnees xi, yi, dans la case xf, yf, si possible
// precondition: Le deplacement doit etre possible
// post-condition: Le deplacement est effectue, retourne true si tout c'est bien passe sinon retourne false
  public function deplacerPion($xi, $yi, $xf, $yf){
    if ($this->verifierDeplacement($xi, $yi, $xf, $yf)) { //Fonction decrite plus tard
        if ($xi == $xf) { // Si le deplacement est vertical
          if ($yi - $yf == 2 ) {  //Si le deplacement se fait de haut en bas
            $_SESSION["plateau"][$xi][$yi] = 0; // La case de depart devient vide
            $_SESSION["plateau"][$xf][$yf] = 1; // La case d'arrivee devient pleine
            $_SESSION["plateau"][$xi][$yi-1] = 0; // La case entre les deux devient vide
          }
          elseif ($yi - $yf == -2 ) { //Si le deplacement se fait de haut en bas
            $_SESSION["plateau"][$xi][$yi] = 0; // La case de depart devient vide
            $_SESSION["plateau"][$xf][$yf] = 1; // La case d'arrivee devient pleine
            $_SESSION["plateau"][$xi][$yf-1] = 0; // La case entre les deux devient vide
          }
        }
        elseif ($yi == $yf) { // Si le deplacement est horizontal
          if ($xi - $xf == 2 ) { //Si le deplacement se fait de droite a gauche
            $_SESSION["plateau"][$xi][$yi] = 0; // La case de depart devient vide
            $_SESSION["plateau"][$xf][$yf] = 1; // La case d'arrivee devient pleine
            $_SESSION["plateau"][$xi-1][$yf] = 0; // La case entre les deux devient vide
          }
          elseif ($xi - $xf == -2 ) { //Si le deplacement se fait de gauche a droite
            $_SESSION["plateau"][$xi][$yi] = 0; // La case de depart devient vide
            $_SESSION["plateau"][$xf][$yf] = 1; // La case d'arrivee devient pleine
            $_SESSION["plateau"][$xf-1][$yi] = 0; // La case entre les deux devient vide
          }
        }
        $this->finirDeplacement(); //Fonction decrite plus tard
        return true;
    }
    else{
      return false;
    }
  }

// Fonction qui verifie que le deplacement de la case xi yi vers la case xf yf est possible
// precondition: La case de depart doit etre un pion, la case d'arrivee doit etre vide, les deux cases doivent etre alignees et etre espace d'une case seulement contenant un pion
// post-condition: retourne true si le deplacement est possible, false sinon
  public function verifierDeplacement($xi, $yi, $xf, $yf){
    if (!($xi < 0 || $xi > 6 || $xf < 0 || $xf > 6 || $yi < 0 || $yi > 6 || $yf < 0 || $yf > 6 )) { //Si la case de depart ou d'arrivee n'est pas dans la matrice
      if (($_SESSION["plateau"][$xi][$yi] == 1) && ($_SESSION["plateau"][$xf][$yf] == 0)) { //Si la case de depart a un pion et si la case d'arrivee est vide
        if ($xi != $xf && $yi != $yf) { //Si les case ne sont pas alignees verticalement ni horizontalement
          return false;
        }
        elseif ($xi == $xf) { // Si le deplacement est vertical
          if ($yi - $yf == 2 ) { //Si le deplacement se fait de haut en bas
            if (($_SESSION["plateau"][$xi][$yi-1] == 1)) { //Si la case entre le depart et l'arrivee a bien un pion
              return true;
            }
            else{
              return false;
            }
          }
          elseif ($yi - $yf == -2 ) { //Si le deplacement se fait de bas en haut
            if (($_SESSION["plateau"][$xi][$yf-1] == 1)) { //Si la case entre le depart et l'arrivee a bien un pion
              return true;
            }
            else{
              return false;
            }
          }
          else{
            return false;
          }
        }
        elseif ($yi == $yf) { // Si le deplacement est horizontal
          if ($xi - $xf == 2 ) { //Si le deplacement se fait de droite a gauche
            if (($_SESSION["plateau"][$xi-1][$yf] == 1)) { //Si la case entre le depart et l'arrivee a bien un pion
              return true;
            }
            else{
              return false;
            }
          }
          elseif ($xi - $xf == -2 ) { //Si le deplacement se fait de gauche a droite
            if (($_SESSION["plateau"][$xf-1][$yi] == 1)) { //Si la case entre le depart et l'arrivee a bien un pion
              return true;
            }
            else{
              return false;
            }
          }
          else{
            return false;
          }
        }

      }
      else {
        return false;
      }
    }
    else {
      return false;
    }
  }

// Fonction qui verifie si le deplacement precedent mene a la victoire, a la defait ou a aucune des deux
// precondition: -
// post-condition: La variable de session gagner devient true si le deplacement mene a la victoire, la variable de session perdu devient true si le deplacement mene a la defaite, ces deux variables de session deviennent false si le deplacement ne fait rien de special.
  public function finirDeplacement(){
    if ($this->verifierGagner()) {
      $_SESSION["gagner"] = true;
    }
    elseif ($this->verifierPerdre()) {
      $_SESSION["perdu"] = true;
    }
    else {
      $_SESSION["gagner"] = false;
      $_SESSION["perdu"] = false;
    }
  }

// Fonction qui verifie si la partie est gagnee, donc si il ne reste qu'un seul pion sur le plateau
// precondition: -
// post-condition: Si il ne reste qu'un pion sur le plateau retourne true, false sinon
  public function verifierGagner(){
    $res = 0;
    //Double boucle qui verifie toutes les cases du plateau
    for ($i=0; $i < 7; $i++) {
      for ($j=0; $j < 7; $j++) {
        //Si la case a un pion, ajoute 1 a res
        if ($_SESSION["plateau"][$i][$j] == 1) {
          $res = $res + 1;
        }
      }
    }
    //Si res = 1, retourne true car le plateau n'a qu'un pion donc la partie est gagnee
    if ($res == 1) {
      return true;
    }
    else {
      return false;
    }
  }

// Fonction qui verifie si la partie est perdu, donc si aucun deplacement est possible
// precondition: -
// post-condition: Si aucun deplacement n'est possible retourne true, sinon false
  public function verifierPerdre(){
    //Double boucle qui verifie toutes les cases du plateau
    for ($i=0; $i < 7; $i++) {
      for ($j=0; $j < 7; $j++) {
        //Si un deplacement est possible, que ce soit a gauche, a droit, en haut ou en bas retourne false (car la partie n'est pas encore perdue)
        if ($this->verifierDeplacement($i, $j, $i+2, $j) || $this->verifierDeplacement($i, $j, $i-2, $j) || $this->verifierDeplacement($i, $j, $i, $j+2) || $this->verifierDeplacement($i, $j, $i, $j-2)) {
          return false;
        }
      }
    }
    return true;
  }


}

?>
