<?php

class VueResultat{

function affichageResultat($tabJoue,$tabGagne){
session_destroy();
header("Content-type: text/html; charset=utf-8");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Résultat</title>
</head>
<body>


  <h2>Résultat de la partie.</h2>
<br>
<br>

<?php
echo "Nombre de parties jouées : ".$tabJoue['count(*)'];
echo "Nombre de parties gagnées : ".$tabGagne['sum(partieGagnee)'];
 ?>

</body>
</html>
<?php
}

}
?>
