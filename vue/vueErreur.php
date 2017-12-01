<?php

class VueErreur{

function affichageErreur(){
session_destroy();
header("Content-type: text/html; charset=utf-8");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Erreur</title>
</head>
<body>

  <form method="post" action="index.php">

  <p>Il y a une erreur d'authentification.</p>

  <input type="submit" name="retour" value="Retour à la connexion."/>

  </form>

</body>
</html>
<?php
}

}
?>
