<?php
	session_start();
	if(isset($_POST['wybor']))
	{
		//Udana walidacja
		$wporzadku=true;
		
		if(!isset($_POST['wybor']))
		{
			$wporzadku=false;
			$_SESSION['e_wybor']="Nie wybrano książki";
		}
	
	}
	
	require_once "connect.php";
	
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

	
	echo "<h1>Książka została zarezerwowana: </h1>";
	
	

			
			
	//zapytanie o listę książek
	$wynik = "SELECT * FROM rezerwacja";
	$rezultat = $polaczenie->query($wynik);
	
	//wyswietlanie wyniku, sprawdzenie zwrócenia wartości >0
	
	$polaczenie->close();
	
?>




<!DOCTYPE HTML>
<html lang="pl">
<head>

	<meta charset="utf-8"/>
	<title>Podsumowanie rezerwacji</title>
</head>

<body>


	
<?php

	//$zamowienie= msqli_query("INSERT INTO rezerwacja ('id', 'tytul', 'autor', 'gatunek' ) VALUES ($id, $tytul, $autor, $gatunek)");
	//$wybor = $_POST['wybor'];
	
$id=$_POST['id'];


echo "<tr><td><h2>Książka:</h2></td><td><h2>$id</h2></td></tr>";

echo '<table border="1" cellpadding="10" cellspacing="0">';
    
//$sql="SELECT [id Ord] AS [id], [tytul Ord] AS [tytul], [autor Ord] AS [autor], [gatunek Ord] AS [gatunek] FROM [ksiazki]";


?>
<?php
	
?>

</body>
</html>
