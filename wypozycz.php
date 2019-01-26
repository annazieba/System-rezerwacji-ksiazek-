<?php
	
	session_start();
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset ="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>System rezerwacji książek w bibliotece</title>
</head>

<body>

<?php

	echo "<p>Witaj ".$_SESSION['user'].'![<a href="wyloguj.php">Wyloguj się</a>]</p>';
	echo "<p><b>Imię</b>: ".$_SESSION['imie'];
	echo "<p><b>Nazwisko</b>: ".$_SESSION['nazwisko'];
	echo "<p><b>Twoje rezerwacje</b>: ".$_SESSION['rezerwacje']."</p>";

?>

</body>
</html>