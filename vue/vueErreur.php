<?php

// Classe de la vue Erreur, qui va permettre d'afficher une erreur en cas de probleme (connexion ou inscription)
class VueErreur{

// Fonction affichageErreur qui va afficher la page html de la vue
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
	// Si l'erreur provient de la connexion, le message concernant le pseudo ou le mdp mauvais s'affiche, sinon, si l'erreur provient de l'inscription, le message concernant celui-ci s'affiche
	if ($_SESSION["erreur"]=="connexion") {
		echo "<p> Mauvais pseudo ou mot de passe, veuillez recommencer ou vous inscrire. </p>";
	}
	else if ($_SESSION["erreur"]=="inscription"){
		echo "<p> Le pseudo existe déjà, veuillez prendre un autre pseudo. </p>";
	}
	
	?>

	<!-- Bouton qui permet de revenir à la vue Authentification -->
  <form method="post" action="index.php" style="display:inline;">
  <input type="submit" name="retour" value="Retour à la connexion."/>
  </form>

	<!-- Bouton qui permet de revenir à la vue Inscription -->
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
