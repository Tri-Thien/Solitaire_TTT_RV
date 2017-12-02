
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Connexion au salon</title>
</head>
<body>

 <form method="post" action="">
   <span style="display:none;"> <input type="radio" name="1" checked></span>
<input type="image" name="submit1" src="./img/tofu.jpg" border="0" alt="Submit" />
</form>

<form method="post" action="">
  <input type="radio" name="2" checked>
  <input type="radio" name="3" checked>
<input type="image" name="submit2" src="./img/tofu.jpg" height="50" width="50" border="0" alt="Submit" />
<input type="image" name="submit3" src="./img/tofu.jpg" border="0" alt="Submit" />
<?php
if (isset($_POST["1"])) {
  echo "1";
}
elseif (isset($_POST["2"])) {
  echo "2";
}
elseif (isset($_POST["3"])) {
  echo "3";
}
 ?>
</form>



</body>
</html>
