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

<body bgcolor="black">

<font size="5" color="#33FF99"><center>Dziękujemy za rejestrację, możesz zalogować się na swoje konto</center></font><br/><br/>
	
	<h1><font size="7" color="white"><center>Czytaj^n</h1></center></font><br/><br/>

	<a href="index.php"><font size="4" color="white"><center>Zaloguj się na swoje konto</center></font></a>
	<br></br>
	
	<center><table><form action="zaloguj.php" method="post">
	
	<tr><td width="200", height="200", bgcolor="#009900"><font size="5" color="white"><center>Login: </center></font><br/><center><input type="text" name="login" /></center><br/>
	<font size="5" color="white"><center>Hasło: </center></font><br/><center><input type="password" name="haslo" /></center><br/></td></tr>
	<tr><td><center><input type="submit" value="Zaloguj się"/></center></tr></td>
	
	
	</form></table></center>
	
<?php

	if(isset($_SESSION['blad'])) echo $_SESSION['blad'];

?>
	
	
</body>
</html>