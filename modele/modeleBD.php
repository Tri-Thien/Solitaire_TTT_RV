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


// Classe qui gère les accès à la base de données

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




// A développer
// méthode qui permet de se deconnecter de la base
public function deconnexion(){
   $this->connexion=null;
}



public function verifMdp($pseudo,$mdp){
      try{
	$statement = $this->connexion->prepare("select motDePasse from joueurs where pseudo=?;");
	$statement->bindParam(1, $pseudo);
	$statement->execute();
  $result=$statement->fetch(PDO::FETCH_ASSOC);

  if ($result["motDePasse"]==crypt($mdp,$result["motDePasse"])) {
    return true;
  }
  else{
    return false;
  }
	}
    catch(PDOException $e){
    $this->deconnexion();
    throw new TableAccesException("problème avec la table joueurs");
    }
}




public function getStats($pseudo){
  try{
$statement = $this->connexion->prepare("select pseudo,sum(partieGagnee),count(*),(sum(PartieGagnee) / count(*)) as ratio from parties where pseudo=?;");
$statement->bindParam(1, $pseudo);
$statement->execute();
$result=$statement->fetch(PDO::FETCH_ASSOC);
return ($result);

}
catch(PDOException $e){
$this->deconnexion();
throw new TableAccesException("problème avec la table parties");
}
}





public function majParties($pseudo,$resultat){

      try{
	$statement = $this->connexion->prepare("insert into parties (pseudo,partieGagnee) values (?,?);");
	$statement->bindParam(1, $pseudo);
	$statement->bindParam(2, $resultat);
	$statement->execute();

	}
    catch(PDOException $e){
    $this->deconnexion();
    throw new TableAccesException("problème avec la table parties");
    }
}



public function get3MeilleursJoueurs(){
  $requete = "select pseudo,sum(partieGagnee),count(*),(sum(PartieGagnee) / count(*)) as ratio from parties group by pseudo order by 4 DESC LIMIT 3;";
  $statement=$this->connexion->query( $requete);
  try {
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;

  }
    catch(PDOException $e){
    $this->deconnexion();
    throw new TableAccesException("problème avec la table parties");
    }
  }



public function inscriptionJoueur($pseudo,$mdp){
  try{
  $mdpCrypte = crypt($mdp);
  $statement = $this->connexion->prepare("insert into joueurs (pseudo,motDePasse) values (?,?);");
  $statement->bindParam(1, $pseudo);
  $statement->bindParam(2, $mdpCrypte);
  $statement->execute();
  }
    catch(PDOException $e){
    $this->deconnexion();
    throw new TableAccesException("problème avec la table joueurs");
    }
}


public function existsJoueur($pseudo){
      try{
  $statement = $this->connexion->prepare("select pseudo from joueurs where pseudo=?;");
  $statement->bindParam(1, $pseudo);
  $statement->execute();
  $result=$statement->fetch(PDO::FETCH_ASSOC);


  if (isset($result["pseudo"])) {
    return true;
  }
  else{
    return false;
  }
  }
    catch(PDOException $e){
    $this->deconnexion();
    throw new TableAccesException("problème avec la table joueurs");
    }
}

}

?>
