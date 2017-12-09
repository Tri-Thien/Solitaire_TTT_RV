<?php

// Classe de la vue Resultat, qui va permettre d'afficher les statistiques du joueur et le classement des meilleurs joueurs
class VueResultat{

// Fonction affichageResultat qui va afficher la page html de la vue
// Parametres: $tabStats qui represente le tableau contenant les statistiques du joueur courant
//             $tabClassement qui represente le tableau avec les 3 meilleurs joueurs et leurs statistiques 
function affichageResultat($tabStats, $tabClassement){
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Résultat</title>
</head>
<body>


  <h2>Résultat de la partie.</h2>

  <?php 
  // Si l'utilisateur a perdu la partie, on l'affiche avec son pseudo, sinon on affiche qu'il a gagne
  	if ($_SESSION["partieGagne"] == false) {
  		echo "<p> Vous avez perdu, dommage ".$_SESSION["pseudo"]."! </p>";
  	}
  	else {
  		echo "<p> Vous avez gagné, bravo ".$_SESSION["pseudo"]."! </p>";
  	}
   ?>


  <h2>Statistiques du joueur.</h2>

  <?php
  //on stock les resultats du joueur dans des variables pour plus de facilite de lecture
  $joueur=$tabStats["pseudo"];
  $nbJoue=$tabStats["count(*)"];
  $nbGagne=$tabStats["sum(partieGagnee)"];
  $ratio=$tabStats["ratio"]*100; //le ratio va etre en %, donc on multiplie le resultat par 100

  //affichage des stats
  echo "<p>Pseudo: ".$joueur."</p>";
  echo "<p>Nombre de parties au total: ".$nbJoue."</p>";
  echo "<p>Nombre de parties gagnées: ".$nbGagne."</p>";
  echo "<p>Ratio du joueur : ".$ratio."% </p>";
  ?>


  <h2>Classement des 3 meilleurs joueurs.</h2>

  <?php
  //initialisation d'un compteur $classement qui va s'incrementer pour avoir les 3 meilleurs joueurs
  $classement=1;
  foreach ($tabClassement as $row) { //lecture de $tabClassement ligne par ligne
    $ratio2=$row["ratio"]*100;

    //affichage des stats de la ligne (donc du meilleur joueur au 3eme)
    echo "<p>-----".$classement++."-----";
    echo "<br/>Joueur : ".$row["pseudo"];
    echo "<br/>Total jouées : ".$row["count(*)"];
    echo "<br/>Nb gagnées :".$row["sum(partieGagnee)"];
    echo "<br/>Ratio : ".$ratio2."% </p>";
  }
  ?>

  <!-- Bouton pour recommencer une partie -->
  <form method="post" action="index.php" style="display:inline;">
    <!-- On cree un checkbox invisible pour pouvoir interagir avec dans le routeur quand l'utilisateur cliquera sur le bouton -->
    <span style="display:none;">
    <input type="checkbox" name="Reinitialiser_Plateau" checked>
    </span>
    <input type="submit" value="Recommencer"/>
  </form>

  <!-- Bouton pour se deconnecter et revenir a la vue Authentification -->
  <form method="post" action="index.php" style="display:inline;">
    <!-- On cree un checkbox invisible pour pouvoir interagir avec dans le routeur quand l'utilisateur cliquera sur le bouton -->
    <span style="display:none;">
    <input type="checkbox" name="Deconnecter" checked>
    </span>
    <input type="submit" value="Deconnecter"/>
  </form>

</body>
</html>
<?php
}

}
?>
