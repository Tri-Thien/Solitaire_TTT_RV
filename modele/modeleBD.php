<?php

// Classe generale de definition d'exception
class MonException extends Exception{
  private $chaine;
  public function __construct($chaine){
    $this->chaine=$chaine;
  }

  public function afficher(){
    return $this->chaine;
  }

}


// Exception relative à un probleme de connexion
class ConnexionException extends MonException{
}

// Exception relative à un probleme d'accès à une table
class TableAccesException extends MonException{
}



// Classe qui gere les acces a la base de donnees
class ModeleBD{
  private $connexion;

  // Constructeur de la classe
  public function __construct(){
   try{
    $chaine="mysql:host=".HOST.";dbname=".BD;
    $this->connexion = new PDO($chaine,LOGIN,PASSWORD);
    $this->connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
      $exception=new ConnexionException("problème de connexion à la base");
      throw $exception;
    }
  }

// Fonction qui permet de se deconnecter de la base
public function deconnexion(){
   $this->connexion=null;
}

// Fonction qui permet de verifier le mot de passe a l'authentification
// Parametres : $pseudo qui represente le pseudo de l'utilisateur
//              $mdp qui represente le mot de passe de l'utilisateur
// Post-condition : retourne "vrai" si l'ensemble pseudo/motDePasse existe dans la base de donnees, retourne "faux" sinon (le compte n'existe donc pas)
public function verifMdp($pseudo,$mdp){
  try{
    //Requete preparee
	  $statement = $this->connexion->prepare("select motDePasse from joueurs where pseudo=?;");
    $statement->bindParam(1, $pseudo); //On met en parametre de la requete sql le pseudo en parametre de la Fonction
	  $statement->execute(); //Execution de la requete
    $result=$statement->fetch(PDO::FETCH_ASSOC); //Recuperation du resultat de la requete (1 ligne donc fetch)

    // Utilisation de la fonction "crypt".
    // Comme les mots de passe dans la base de donnees sont cryptes, il faut crypter le mot de passe en parametre de la fonction avec le meme "salt" que le resultat obtenu via la requete sql.
    // Si le mot de passe obtenu via la requete (contenu dans le tableau $result) est egal au mot de passe en parametre apres un cryptage avec le meme "salt" que le mdp via la requete, retourne vrai, sinon retourne faux (il y a donc un mauvais mdp lie au pseudo)
    if ($result["motDePasse"]==crypt($mdp,$result["motDePasse"])) {
      return true; // retourne vrai
    }
    else{
      return false; // retourne faux
    }
	}
  catch(PDOException $e){ //Recuperation de l'erreur du try si il y en a une
    $this->deconnexion(); //Deconnexion de la base de donnees
    throw new TableAccesException("problème avec la table joueurs");
  }
}



// Fonction qui permet d'obtenir les statistiques d'un joueur
// Parametre : $pseudo qui represente le pseudo de l'utilisateur dont on veut les statistiques
// Post-condition : retourne la ligne concernant le pseudo avec son pseudo, son nombre de parties gagnees (sum(partieGagnee)), le nombre total de parties (count(*)), et enfin le ratio (nombre gagnees / total)
public function getStats($pseudo){
  try{
    //Requete preparee
    $statement = $this->connexion->prepare("select pseudo,sum(partieGagnee),count(*),(sum(PartieGagnee) / count(*)) as ratio from parties where pseudo=?;");
    $statement->bindParam(1, $pseudo); //On met en parametre de la requete sql le pseudo en parametre de la Fonction
    $statement->execute(); //Execution de la requete
    $result=$statement->fetch(PDO::FETCH_ASSOC); //Recuperation du resultat de la requete (1 ligne donc fetch)
    return ($result); //retourne le resultat
  }
  catch(PDOException $e){ //Recuperation de l'erreur du try si il y en a une
    $this->deconnexion(); //Deconnexion de la base de donnees
    throw new TableAccesException("problème avec la table parties");
  }
}


// Fonction qui permet d'ajouter la partie que l'utilisateur a faite
// Parametres : $pseudo qui represente le pseudo de l'utilisateur
//              $resultat qui represente 0 s'il a perdu ou 1 s'il a gagne
// Post-condition : la partie effectuee est ajoutee dans la BD
public function majParties($pseudo,$resultat){
  try{
    //Requete preparee
	  $statement = $this->connexion->prepare("insert into parties (pseudo,partieGagnee) values (?,?);");
	  $statement->bindParam(1, $pseudo); //On met en parametre de la requete sql le pseudo en parametre de la fonction
	  $statement->bindParam(2, $resultat); //On met en parametre de la requete sql le resultat en parametre de la Fonction
	  $statement->execute(); //Execution de la requete
	}
  catch(PDOException $e){ //Recuperation de l'erreur du try si il y en a une
    $this->deconnexion(); //Deconnexion de la base de donnees
    throw new TableAccesException("problème avec la table parties");
  }
}


// Fonction qui permet d'obtenir les 3 meilleurs joueurs selon leurs ratios
// Post-condition : retourne un tableau avec les pseudos, les nombres de parties gagnees, les nombres totaux de parties et les ratios des 3 meilleurs joueurs
public function get3MeilleursJoueurs(){
  try {
    //Requete directe
    $requete = "select pseudo,sum(partieGagnee),count(*),(sum(PartieGagnee) / count(*)) as ratio from parties group by pseudo order by 4 DESC LIMIT 3;";
    $statement=$this->connexion->query($requete); //Execution de la requete
    $result = $statement->fetchAll(PDO::FETCH_ASSOC); //Recuperation du resultat de la requete (3 lignes donc fetchAll)
    return $result; //retourne le resultat
  }
  catch(PDOException $e){ //Recuperation de l'erreur du try si il y en a une
    $this->deconnexion(); //Deconnexion de la base de donnees
    throw new TableAccesException("problème avec la table parties");
  }
}


// Fonction qui permet d'inscrire un joueur dans la base de donnees
// Parametres : $pseudo qui represente le pseudo de l'utilisateur
//              $mdp qui represente le mot de passe qui va etre lie au pseudo
// Post-condition : le nouveau joueur est inscrit avec son pseudo et son mot de passe
public function inscriptionJoueur($pseudo,$mdp){
  try{
    $mdpCrypte = crypt($mdp); //on crypte le mot de passe avant de le mettre dans la BD
    //Requete preparee
    $statement = $this->connexion->prepare("insert into joueurs (pseudo,motDePasse) values (?,?);");
    $statement->bindParam(1, $pseudo); //On met en parametre de la requete sql le pseudo en parametre de la Fonction
    $statement->bindParam(2, $mdpCrypte); //On met en parametre de la requete sql le mdp crypte
    $statement->execute(); //Execution de la requete
  }
  catch(PDOException $e){ //Recuperation de l'erreur du try si il y en a une
    $this->deconnexion(); //Deconnexion de la base de donnees
    throw new TableAccesException("problème avec la table joueurs");
  }
}


// Fonction qui permet de savoir si un joueur défini par son pseudo existe deja
// Parametres : $pseudo qui represente le pseudo de l'utilisateur
// Post-condition : retourne "vrai" si il existe, "faux" sinon
public function existsJoueur($pseudo){
  try{
    //Requete preparee
    $statement = $this->connexion->prepare("select pseudo from joueurs where pseudo=?;");
    $statement->bindParam(1, $pseudo); //On met en parametre de la requete sql le pseudo en parametre de la Fonction
    $statement->execute(); //Execution de la requete
    $result=$statement->fetch(PDO::FETCH_ASSOC); //Recuperation du resultat de la requete (1 ligne donc fetch)
    // Si le resultat existe, c'est-a-dire que le pseudo existe, on retourne vrai, sinon faux
    if (isset($result["pseudo"])) {
      return true;
    }
    else{
      return false;
    }
  }
  catch(PDOException $e){ //Recuperation de l'erreur du try si il y en a une
    $this->deconnexion(); //Deconnexion de la base de donnees
    throw new TableAccesException("problème avec la table joueurs");
  }
}


}
?>
