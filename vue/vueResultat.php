<?php

class VueResultat{

function affichageResultat($tabJoue,$tabGagne){
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
   ?>
<br>
<br>

<?php
echo "Nombre de parties jouées : ".$tabJoue['count(*)'];
echo "<br/>"
echo "Nombre de parties gagnées : ".$tabGagne['sum(partieGagnee)'];
 ?>

</body>
</html>
<?php
}

}
?>
