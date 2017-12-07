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


	<?php
	if ($_SESSION["erreur"]=="connexion") {
		echo "<p> Mauvais pseudo ou mot de passe, veuillez recommencer ou vous inscrire. </p>";
	}
	else if ($_SESSION["erreur"]=="inscription"){
		echo "<p> Le pseudo existe déjà, veuillez prendre un autre pseudo. </p>";
	}
	
	?>


  <form method="post" action="index.php" style="display:inline;">
  <input type="submit" name="retour" value="Retour à la connexion."/>
  </form>

  <form method="post" action="index.php" style="display:inline;">
  <span style="display:none;">
  <input type="checkbox" name="Inscription" checked>
  </span>
  <input type="submit" value="Inscription."/>
</form>

</body>
</html>
<?php
}

}
?>
