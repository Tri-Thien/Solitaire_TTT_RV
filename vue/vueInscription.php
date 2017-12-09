<?php

// Classe de la vue Inscription, qui va permettre de s'inscrire dans la BD et pouvoir jouer au jeu
class VueInscription{

// Fonction inscription qui va afficher la page html de la vue
function inscription(){
  session_destroy();
  header("Content-type: text/html; charset=utf-8");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Inscription</title>
</head>
<body>

<p>Remplissez ce formulaire pour s'inscrire à notre jeu. </p>

  <!-- Formulaire d'inscription -->
  <form method="post" action="index.php" style="display:inline;">
  <p> Pseudo : <input type="text" name="iPseudo" required/> </p>
  </br>
  </br>
  <p> Mot de passe : <input type="password" name ="iMdp" required/> </p>
  </br>
  </br>
  <input type="submit" name="sinscrire" value="S'inscrire !"/>
  </form>


  <!-- Bouton qui permet d'annuler son inscription  -->
  <form method="post" action="index.php" style="display:inline;">
    <!-- On cree un checkbox invisible pour pouvoir interagir avec dans le routeur quand l'utilisateur cliquera sur le bouton -->
    <span style="display:none;">
    <input type="checkbox" name="Deconnecter" checked>
    </span>
    <input type="submit" value="Annuler l'inscription."/>
  </form>

</body>
</html>
<?php
}

}
?>
