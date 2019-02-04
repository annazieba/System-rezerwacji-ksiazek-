<?php

	session_start();
	
	if((isset($_SESSION['udanarejestracja'])))
	{
		header('Location: index.php');
		exit();
	}
	else
	{
		unset($_SESSION['udanarejestracja']);
	}
?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset ="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>System rezerwacji książek w bibliotece</title>
	<link rel="stylesheet" type="text/css" href="style.css"/>
	
</head>

<body>

Dziękujemy za rejestrację, możesz zalogować się na swoje konto<br/><br/>
	
	<h1>Czytaj^n</h1><br/><br/>

	<a href="index.php">Zaloguj się na swoje konto</a>
	<br></br>
	
	<form action="zaloguj.php" method="post">
	
	Login: <br/><input type="text" name="login" /><br/>
	Hasło: <br/><input type="password" name="haslo" /><br/><br/>
	<input type="submit" value="Zaloguj się"/>
	
	
	</form>
	
<?php

	if(isset($_SESSION['blad'])) echo $_SESSION['blad'];

?>
	
	
</body>
</html>