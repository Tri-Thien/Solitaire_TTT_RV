<?php

class VueInscription{

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

  <form method="post" action="index.php" style="display:inline;">

  Pseudo : <input type="text" name="iPseudo"/>
  </br>
  </br>
  Mot de passe : <input type="password" name ="iMdp"/>
  </br>
  </br>
  <input type="submit" name="sinscrire" value="S'inscrire !"/>

  </form>


<form method="post" action="index.php" style="display:inline;">
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
