<?php

class VueResultat{

function affichageResultat(){
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

  <form method="post" action="index.php">

  <p>Résultat de la partie.</p>

 



  <input type="submit" name="retour" value="Retour à la connexion."/>

  </form>

</body>
</html>
<?php
}

}
?>
