<?php
	session_start();
	require_once "connect.php";
	
	
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	
	echo "<h1><font size='7', color='white'><center>Wybierz książkę!</center></font></h1>";
	
	echo '<table style="margin: 20px; cellspacing=10; margin-left: 380px">
			<tr>
			<th bgcolor= "#660033"><font size="4" color="white"><center>Numer pozycji</center></font></th>
			<th bgcolor= "#333333"><font size="4" color="white"><center>Tytuł książki</center></font></th>
			<th bgcolor= "#336633"><font size="4" color="white"><center>Autor</center></font></th>
			<th bgcolor= "#339933"><font size="4" color="white"><center>Gatunek</center></font></th></tr>';
			

			
			
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

<body bgcolor="black">



  <?php 
		if($rezultat-> num_rows >0)
	{ 
		while($row = $rezultat->fetch_assoc())
		{
			
			echo "<tr cellpadding='10'><td width='200', height='30'><font  size='4'color='white'><center>{$row['id']}</center></font></td>
			<td width='200', height='30'><font size='4' color='white'><center>{$row['tytul']}</center></font></td>
			<td width='200', height='30'><font size='4' color='white'><center>{$row['autor']}</center></font></td>
			<td width='200', height='30'><font size='4' color='white'><center>{$row['gatunek']}</center></font></td></tr>";
						
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
   

<center><form action= "dodaj_ksiazke.php" method="post">


<select name="id">
	<option>1 - Pan Tadeusz</option>
	<option>2 - Dziady</option>
	<option>3 - Quo vadis</option>
	<option>4 - Chłopi</option>
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
</select></center>
<center><input type="submit" value="Zamów" /></center>
</form>
<br/>




	
</body>
</html>
