<?php

class VueJeu{



// Fonction qui affiche la vue Jeu, c'est à dire le plateau, des instructions, un bouton déconnexion, un bouton recommencer la partie et un bouton annuler le coup.
// precondition: -
// post-condition: -
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
//Double boucle for pour accéder à toutes les cases du plateau
  for ($j=0; $j < 7; $j++) {
    for ($i=0; $i < 7 ; $i++) {
			if ($_SESSION["debut"]) { //Si la partie vient de commencer, il faut retirer un pion
				?>
        <!--Formulaire renvoyant la position du premier pion a retirer via ses coordonnées situés dans des checkbox invisible -->
				<form method="post" action="index.php" style="display:inline;">
          <span style="display:none;">
						<input type="checkbox" name="pos_X_Depart" value="<?php echo $i ?>" checked>
						<input type="checkbox" name="pos_Y_Depart" value="<?php echo $j ?>" checked>
          </span>

				<?php
			}
			elseif ($_SESSION["depart"]) { //Si le tour vient de comencer il faut selectionner un pion
				?>
        <!--Formulaire renvoyant la position du pion selectioné via ses coordonnées situés dans des checkbox invisible -->
				<form method="post" action="index.php" style="display:inline;">
					<span style="display:none;">
						<input type="checkbox" name="pos_X_avant_Deplacer" value="<?php echo $i ?>" checked>
						<input type="checkbox" name="pos_Y_avant_Deplacer" value="<?php echo $j ?>" checked>
					</span>
				<?php
			}
			else {
				?>
        <!--Formulaire renvoyant la position de la case vide selectioné via ses coordonnées situés dans des checkbox invisible -->
				<form method="post" action="index.php" style="display:inline;">
					<span style="display:none;">
						<input type="checkbox" name="pos_X_apres_Deplacer" value="<?php echo $i ?>" checked>
						<input type="checkbox" name="pos_Y_apres_Deplacer" value="<?php echo $j ?>" checked>
					</span>
				<?php
			}
    	if ( $_SESSION['plateau'][$i][$j] == 1 ) { //Si la case est un pion (==1)
        if ($_SESSION["depart"]) { //Si il faut que le joueur selectionne un pion
          ?>  
          <!--Alors sur la page web une image s'affichera, cette image aura aussi la fonction d'un bouton submit -->
          <input type="image" name="submit" src="vue/img/tofu.jpg" height="50" width="50" border="0" alt="Submit" /> <?php
        }
        else{ //Si le pion est déja selectionné
          ?>  
          <!--Alors sur la page web une image s'affichera -->
          <img src="vue/img/tofu.jpg" height="50" width="50" alt="poussin"/> <?php
        }
        
      }
      else if ( $_SESSION['plateau'][$i][$j] == 0 ) { //Si la case est vide (==1)
        if (!($_SESSION["depart"])) { //Si le joueur a selectionné un pion
          ?> 
            <!--Alors sur la page web une image s'affichera, cette image aura aussi la fonction d'un bouton submit -->
           <input type="image" name="submit" src="vue/img/graine.png" height="50" width="50" border="0" alt="Submit" /> <?php
        }
        else{ //Si le joueur doit selectionner un pion
          ?>  
           <!--Alors sur la page web une image s'affichera-->
          <image src="vue/img/graine.png" height="50" width="50" alt="graine"></image> <?php
        }
      }
      else if ( $_SESSION['plateau'][$i][$j] == 2 ) { //Si la case a un pion selectionné
        if (!($_SESSION["depart"])) { //Si le joueur a selectionné un pion
          ?>  
          <!--Alors sur la page web une image s'affichera, cette image aura aussi la fonction d'un bouton submit (care le joueur peut recliquer sur le pion selectionné pour le déselectionner)-->
          <input type="image" name="submit" src="vue/img/tofuNoir.png" height="50" width="50" border="0" alt="Submit" /> <?php
        }
        else{ //Si le joueur doit selectionner un pion
          ?>  
          <!--Alors sur la page web une image s'affichera-->
          <image src="vue/img/tofuNoir.png" height="50" width="50" alt="Poussin Noir"></image> <?php
        }
      }
      else { //Si la case n'est rien de celle d'au dessus
        ?> 
        <!--Alors sur la page web une image s'affichera-->
        <image src="vue/img/blanc.png" height="50" width="50" alt="carre blanc"></image><?php
      }
        //On ferme ensuit le formulaire, il y a donc :
        // -Un formulaire pour chaque case
        // -Certains on des boutons submit sous forme d'image
        // -Certains n'ont pas de bouton submit mais juste des images
			?></form><?php
    }
    echo "<br/>";
  }
   ?>
<br/>

<!-- Si le joueur a fait un déplacement impossible alors un message s'affiche et la variable définissant la faute se réinitialise -->
<?php if ($_SESSION["faute"]) {
  ?>  <h3 style="color:red;"> Déplacement impossible ! </h3> <?php 
  $_SESSION["faute"] = false;
}
?>

<!--Affiche un message pour aider le joueur  -->
<?php 
if ($_SESSION["debut"]) { //Si la partie vient de commencer, le joeur doit enlever un premier pion
  ?>  <h3> Choisissez le premier pion à enlever </h3> <?php
}
else if ($_SESSION["depart"]) { //Si le tour a comemncer le joeur doit selectionner un pion
  ?>  <h3> Choisissez le pion que vous voulez déplacer </h3> <?php
}
else{ //Sinon le joeur doit selectionner une case de destination
  ?>  <h3> Choisissez où vous voulez déplacer le pion </h3> <?php 
} ?>

<br/>

<!--Formulaire qui permet d'afficher un bouton "Annuler le coup précedent" cliquable que si nous ne somme pas au premier tour ni que le joueur doit selectionner une case de destination ni si le bouton à déja été cliqué -->
<form action="index.php" method="post">
  <span style="display:none;">
     <input type="checkbox" name="Retour_Arriere" value="yes" checked>
  </span>
  <input type="submit" value="Annuler le coup précédent" 
  <?php
    if ($_SESSION["debut"] || $_SESSION["retour"] || !$_SESSION["depart"]) {
      echo "disabled";
    }
  ?>/>
</form>

<!--Formulaire qui permet d'afficher un bouton "Recommencer" qui réinitialise la partie -->
<form action="index.php" method="post">
  <span style="display:none;">
     <input type="checkbox" name="Reinitialiser_Plateau" value="yes" checked>
  </span>
  <input type="submit" value="Recommencer">
</form>

<!--Formulaire qui permet d'afficher un bouton "Deconnection" qui déconnecte le joeur et qui le renvoie a la page d'authentification -->
<form method="post" action="index.php" style="display:inline;">
  <span style="display:none;">
  <input type="checkbox" name="Deconnecter" checked>
  </span>
  <input type="submit" value="Deconnecter"/>
</form>



</body>
</html>
<?php
}

}
?>
