<?php
require_once PATH_METIER."/Message.php";

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

  <form method="post" action="index.php">

  Entrer votre pseudo  <input type="text" name="pseudo"/>
  </br>
  </br>
  Entrer votre mdp <input type="password" name ="mdp"/>
  </br>
  <input type="submit" name="soumettre" value="envoyer"/>

  </form>

</body>
</html>
<?php
}

}
?>
