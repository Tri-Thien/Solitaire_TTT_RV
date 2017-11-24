<?php
require_once PATH_METIER."/Message.php";

class VueJeu{

function AffichageJeu(){
header("Content-type: text/html; charset=utf-8");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Jeu</title>
</head>
<body>

  <form method="post" action="index.php">

  <h1> Jeu de solitaire </h1>

  <?php

  for ($i=0; $i < 7; $i++) {
    for ($j=0; $j < 7 ; $j++) {
      if ( ($_SESSION['plateau'])[$i][$j] == 1 ) {
        ?>  <img src="./img/tofu.jpg" alt="tofu" height="50" width="50">  <?php
      }
      else if ( ($_SESSION['plateau'])[$i][$j] == 0 ) {
        ?>  <img src="./img/graine.jpg" alt="tofu" height="50" width="50">  <?php
      }
      else {
        ?>  <img src="./img/blanc.jpg" alt="blanc" height="50" width="50">  <?php
      }
    }
    echo "<br/>";
  }

   ?>

  </form>

</body>
</html>
<?php
}

}
?>
