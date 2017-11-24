<?php
require_once PATH_METIER."/Message.php";

class Vue{

function demandePseudo(){
  session_destroy();
header("Content-type: text/html; charset=utf-8");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Connexion au salon</title>
</head>
<body>



<br/>
<br/>
<form method="post" action="index.php">
Entrer votre pseudo  <input type="text" name="pseudo"/>
</br>
</br>
<input type="submit" name="soumettre" value="envoyer"/>
</form>
<br/>
<br/>
<?php
}

function salon($messages){
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Salon</title>
</head>
<body>
<br/>
<h1>Bienvenue dans le salon <?php echo $_SESSION["pseudo"]?></h1>
<br/>
<form method="post" action="index.php">
Entrez votre message <input type="text" name="message"/>
<input type="submit" name="soumettre" value="envoyer"/>
</form>
<br/>
<?php
foreach ($messages as $tab){
echo $tab->pseudo." -> ".$tab->message."<br/>";
}
?>
<br/>
<a href="index.php">Se déconnecter</a>
<?php
}

}
?>
