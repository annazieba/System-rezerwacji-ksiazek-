<?php
	session_start();
	require_once "connect.php";
	
	
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	
	echo "<h1>Wybierz książkę!</h1>";
	
	echo '<table style="margin: 20px; cellspacing=10">
			<tr>
			<th>Numer pozycji</th>
			<th>Tytuł książki</th>
			<th>Autor</th>
			<th>Gatunek</th></tr>';
			

			
			
	//zapytanie o listę książek
	$wynik = "SELECT * FROM ksiazki";
	$rezultat = $polaczenie->query($wynik);
	
	//wyswietlanie wyniku, sprawdzenie zwrócenia wartości >0
		
	
	$polaczenie->close();
	
	
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



  <?php 
		if($rezultat-> num_rows >0)
	{ 
		while($row = $rezultat->fetch_assoc())
		{
			
			echo "<tr cellpadding='10'><td>{$row['id']}</td>
			<td margin='20'>{$row['tytul']}</td>
			<td>{$row['autor']}</td>
			<td>{$row['gatunek']}</td></tr>";
						
		}
		
	}	
	
	?>
	<?php
	
	
		if(isset($_SESSION['e_wybor']))
		{
			echo '<div class="error">'.$_SESSION['e_wybor'].'</div>';
			unset($_SESSION['e_wybor']);
		}	
		
	?>


<br/>
<?php

 

?>
<form action= "dodaj_ksiazke.php" method="post">


<select name="id">
	<option>1 - Pan Tadeusz</option>
	<option>2 - Dziady</option>
	<option>3 - Quo vadis</option>
	<option>4 - Cłopi</option>
	<option>5 - Lalka</option>
	<option>6 - Potop</option>
	<option>7 - Zbrodnia i kara</option>
	<option>8 - Abecadło</option>
	<option>9 - Lokomotywa</option>
	<option>10 - Przypadki Robinsona Crusoe</option>
	<option>11 - Za zamkniętymi drzwiami</option>
	<option>12 - Nie mów nikomu</option>
	<option>13 - Kwiat pustyni</option>
	<option>15 - Dzieci z Bullerbyn</option>
	<option>16 - Nad Niemnem</option>
	<option>17 - Detektyw Pozytywka</option>
	<option>18 - Pinokio</option>
	<option>19 - Klamczucha</option>
	<option>20 - Sny wojenne</option>
	<option>21 - To co zostawila</option>
	<option>22 - W cieniu prawa</option>
</select>
<input type="submit" value="Zamów" />
</form>

	
</body>
</html>
