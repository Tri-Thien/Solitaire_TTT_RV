<?php

class VueAuthentification{

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
    if (isset($_POST["iPseudo"]) && isset($_POST["iMdp"])) {
      echo "<p> Vous vous êtes bien inscrit ".$_POST["iPseudo"]." ! </p>";
    }

  ?>

  <form method="post" action="index.php" >

  Entrer votre pseudo  <input type="text" name="pseudo" required/>
  </br>
  </br>
  Entrer votre mdp <input type="password" name ="mdp" required/>
  </br>
  <input type="submit" name="soumettre" value="envoyer"/>

  </form>

<br/>
<form method="post" action="index.php" style="display:inline;">
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
