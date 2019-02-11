<?php

/** @brief Przechwycenie wyniku o wyborze książki.
 *
 *
 */
	session_start();
	if(isset($_POST['wybor']))
	{
		///Udana walidacja
		$wporzadku=true;
		
		if(!isset($_POST['wybor']))
		{
			$wporzadku=false;
			$_SESSION['e_wybor']="Nie wybrano książki";
		}
	
	}
/**
 *
 * Nawiązanie połączenia z bazą danych.
 *
 */	
	require_once "connect.php";
	
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

	
	echo "<h1><center><font size='7' color='white'>Książka została zarezerwowana:</font></center></h1>";
		
			
	///Zapytanie o listę książek
	$wynik = "SELECT * FROM rezerwacja";
	$rezultat = $polaczenie->query($wynik);
	
	///Zamknięcie połączenia z bazą danych.
	$polaczenie->close();
	
?>


<!DOCTYPE HTML>
<html lang="pl">
<head>

	<meta charset="utf-8"/>
	<title>Podsumowanie rezerwacji</title>
</head>

<body bgcolor="black">


	
<?php

/** 
 * 
 * Przechwycenie wysłanego id z listy rozwijanej w celu wyświetlenia nazwy zarezerwowanej książki.
 *
 */	
	
$id=$_POST['id'];


echo "<tr><td><h2><center><font size='6' color='white'>Książka:</font></center></h2></td><td><h2><center><font size='6' color='white'>$id</font></center></h2></td></tr>";
echo '<table border="1" cellpadding="10" cellspacing="0">';
    
?>


</body>
</html>
