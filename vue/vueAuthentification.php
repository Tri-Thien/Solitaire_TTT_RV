<?php

// Classe de la vue Authentification, qui va permettre a l'utilisateur de se connecter au jeu en rentrant son pseudo et son mdp
class VueAuthentification{

// Fonction demandePseudo qui va afficher la page html de la vue
function demandePseudo(){
  session_destroy();
  header("Content-type: text/html; charset=utf-8");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Connexion au jeu</title>
</head>
<body>

  <?php
  // Si l'utilisateur s'est inscrit auparavant via la vue Inscription, un message s'affiche comme quoi il s'est bien inscrit
  // Donc si l'utilisateur a bien rentre un pseudo et un mdp de l'autre vue, le message s'affiche
  if (isset($_POST["iPseudo"]) && isset($_POST["iMdp"])) {
    echo "<p> Vous vous êtes bien inscrit ".$_POST["iPseudo"]." ! </p>";
    }
  ?>

  <!-- Formulaire de connexion -->
  <form method="post" action="index.php" >
  <p> Entrer votre pseudo  <input type="text" name="pseudo" required/> </p>
  
  <p> Entrer votre mdp <input type="password" name ="mdp" required/> </p>
  </br>
  <input type="submit" name="soumettre" value="envoyer"/>
  </form>

  <br/>

  <!-- Bouton pour aller creer un compte -->
  <form method="post" action="index.php" style="display:inline;">
    <!-- On cree un checkbox invisible pour pouvoir interagir avec dans le routeur quand l'utilisateur cliquera sur le bouton -->
    <span style="display:none;">
    <input type="checkbox" name="Inscription" checked>
    </span>
  <input type="submit" value="Pas encore de compte? Clique ici !"/>
  </form>

</body>
</html>
<?php
}

}
?>
