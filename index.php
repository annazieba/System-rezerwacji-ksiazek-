<?php
/** @brief Strona główna z panelem logowania.
 * 
 * Znajduje się tu także odnośnik do panelu rejestracji dla tych co nie mają jeszcze konta.
 *
 */
?>

<?php
/** 
 * 
 * 'session_start' umożliwia korzystanie ze zmiennych sesyjnych.
 *
 */
	session_start();

/** 
 * 
 * Jeżeli istnieje zmienna 'zalogowany' i jednocześnie ma ona wartość 'true',
 * użytkownik ma zostać przekierowany na swoje konto.
 * Aby było to automatyczne to zostaje dodana funkcja 'exit'.
 *
 */
	if((isset($_SESSION['zalogowany']))&&($_SESSION['zalogowany']==true))
	{
		header('Location: wypozycz.php');
		exit();
	}
?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset ="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>System rezerwacji książek w bibliotece</title>
	<link rel="stylesheet" href="style.css" type="text/css" />
	
</head>

<body bgcolor="black">
<div id="container">
<br/><br/><br/>
<center><table>

<tr><td width="400", height="250", bgcolor="black">
	
		<h1><font size="10" color="white"><center>Czytaj^n</center></font></h1><br/><br/>
</td>
	
    <td width="400", height="250", bgcolor="purple"><font size="10" color="white"><center>Zaloguj się</center></font></td></tr>

	<tr><td width="400", height="250", bgcolor="green">
	

    <font size="10" color="white"><center>Nie masz konta? </center></font>
	<br/>

	<a href="rejestracja.php"><font size="10" color="white"><center>Zarejestruj się</center></font></a>
	</td>
	
	
	<td width="400", height="250", bgcolor="blue">
		<center><form action="zaloguj.php" method="post">
	
		<font size="6" color="white">Login: <br/><input type="text" name="login" /></font><br/>
		<font size="6" color="white">Hasło: <br/><input type="password" name="haslo" /></font><br/>
		<center><input type="submit" value="Zaloguj się" /></center>
		
		</form></center></td>
		

	
<br/>
</tr>
</table></center>
</div>

<?php

/** 
 * 
 * Jeżeli w sesji pojawiła się zmienna "bbąd" to zostanie pokazana na ekranie.
 *
 */

	if(isset($_SESSION['blad'])) echo $_SESSION['blad'];

?>
	
	
</body>
</html>