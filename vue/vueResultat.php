<?php

class VueResultat{

function affichageResultat($tabStats){
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
  	if ($_SESSION["partieGagne"] == false) {
  		echo "<p> Vous avez perdu, dommage ".$_SESSION["pseudo"]."! </p>";
  	}
  	else {
  		echo "<p> Vous avez gagné, bravo ".$_SESSION["pseudo"]."! </p>";
  	}
   ?>

   <h2>Statistiques du joueur.</h2>

<?php
$joueur=$tabStats["pseudo"];
$nbJoue=$tabStats["count(*)"];
$nbGagne=$tabStats["sum(partieGagnee)"];

echo "<p>Pseudo: ".$joueur."</p>";
echo "<p>Nombre de parties au total: ".$nbJoue."</p>";
echo "<p>Nombre de parties gagnées: ".$nbGagne."</p>";

 ?>

   <h2>Classement des 3 meilleurs joueurs.</h2>



</body>
</html>
<?php
}

}
?>
