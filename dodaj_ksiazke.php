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


 
/*if((isset($_POST['id']) )) {
  
$id = $_POST['id'];
$tytul = $_POST['tytul'];

      
    $connection = @mysql_connect('localhost', 'root', '','rezerwacja')
    or die('Brak połączenia z serwerem MySQL');
    $db = @mysql_select_db('biblioteka', $connection)
    or die('Nie mogę połączyć się z bazą danych');
      
    // dodajemy rekord do bazy
    $input = @mysql_query("INSERT INTO rezerwacja values(NULL, '$tytul')");
      
    if($input) echo "Rekord został dodany poprawnie";
    else echo "Błąd nie udało się dodać nowego rekordu";
      
    mysql_close($connection);
}*/


	
	echo "<h1><center><font size='7' color='white'>Książka została zarezerwowana:</font></center></h1>";
		
			
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

<body bgcolor="black">


	
<?php

	//$zamowienie= msqli_query("INSERT INTO rezerwacja ('id', 'tytul', 'autor', 'gatunek' ) VALUES ($id, $tytul, $autor, $gatunek)");
	//$wybor = $_POST['wybor'];
	
$id=$_POST['id'];


echo "<tr><td><h2><center><font size='6' color='white'>Książka:</font></center></h2></td><td><h2><center><font size='6' color='white'>$id</font></center></h2></td></tr>";

echo '<table border="1" cellpadding="10" cellspacing="0">';
    
//$sql="SELECT [id Ord] AS [id], [tytul Ord] AS [tytul], [autor Ord] AS [autor], [gatunek Ord] AS [gatunek] FROM [ksiazki]";


?>
<?php
	
?>

</body>
</html>
