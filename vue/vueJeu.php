<?php

class VueJeu{




function AffichageJeu(){

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Jeu</title>
</head>
<body>


  <h1> Jeu de solitaire </h1>

  <?php

  for ($j=0; $j < 7; $j++) {
    for ($i=0; $i < 7 ; $i++) {
			if ($_SESSION["debut"]) {
				?>
				<form method="post" action="index.php">

						<input type="checkbox" name="pos_X_Depart" value="<?php echo $i ?>" checked>
						<input type="checkbox" name="pos_Y_Depart" value="<?php echo $j ?>" checked>

				<?php
			}
			elseif ($_SESSION["depart"]) {
				?>
				<form method="post" action="index.php">
					<span style="display:none;">
						<input type="checkbox" name="pos_X_avant_Deplacer" value="<?php echo $i ?>" checked>
						<input type="checkbox" name="pos_Y_avant_Deplacer" value="<?php echo $j ?>" checked>
					</span>
				<?php
			}
			else {
				?>
				<form method="post" action="index.php">
					<span style="display:none;">
						<input type="checkbox" name="pos_X_apres_Deplacer" value="<?php echo $i ?>" checked>
						<input type="checkbox" name="pos_Y_apres_Deplacer" value="<?php echo $j ?>" checked>
					</span>
				<?php
			}
    	if ( $_SESSION['plateau'][$i][$j] == 1 ) {
        ?>  <input type="image" name="submit" src="https://i.skyrock.net/4061/68024061/pics/2757148448_small_1.jpg" height="50" width="50" border="0" alt="Submit" /> <?php
      }
      else if ( $_SESSION['plateau'][$i][$j] == 0 ) {
        ?> <input type="image" name="submit" src="https://previews.123rf.com/images/mironovak/mironovak1306/mironovak130600018/20240720-seule-graine-de-citrouille-isol-sur-fond-blanc-Banque-d%27images.jpg" height="50" width="50" border="0" alt="Submit" /> <?php
      }
      else {
        ?> <input type="image" name="submit" src="http://www.annliz-bonin.com/wp-content/uploads/2017/05/carre%CC%81-blanc-300x300.png" height="50" width="50" border="0" alt="Submit" /><?php
      }
			?></form><?php
    }
    echo "<br/>";
  }
   ?>

   <!--Si début du jeu, il faut demander à retirer 1 tofu (pion)  -->

	 <?php if ($_SESSION["debut"]) { ?>
   <form method="post" action="index.php">

   <br/>
   Insérer le 1er poussin jaune à retirer : <br/>
   <p> pos X <input type="number" name="pos_X_Depart" min="0" max="6" required> </p>
   <p> pos Y <input type="number" name="pos_Y_Depart" min="0" max="6" required> </p>
   <input type="submit">

   </form>
	 <?php }
	 else {?>

		     <form method="post" action="index.php">

     <br/>
     Quel poussin jaune voulez-vous déplacer? : <br/>
     <p> pos X <input type="number" name="pos_X_avant_Deplacer" min="0" max="6" required> </p>
     <p> pos Y <input type="number" name="pos_Y_avant_Deplacer" min="0" max="6" required> </p>
     <br/>
     Vers où voulez-vous le déplacer? : <br/>
     <p> pos X <input type="number" name="pos_X_apres_Deplacer" min="0" max="6" required> </p>
     <p> pos Y <input type="number" name="pos_Y_apres_Deplacer" min="0" max="6" required> </p>
     <input type="submit">

<?php  }?>

     </form>









</body>
</html>
<?php
}

}
?>
