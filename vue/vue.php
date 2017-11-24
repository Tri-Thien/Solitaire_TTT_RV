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

</body>
</html>
<?php
}

}
?>
