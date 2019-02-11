<?php

/** @brief Dodanie nowej książki do bazy.
 *
 * Najpierw sprawdzane są parametry dodawanej książki.
 * Jest to tytuł, autor i gatunek.
 * Sprawdzane jest także czy istnieje już taka książka w bazie.
 *
 */

	session_start();
	
	///Jeżeli ustawiony został tytuł książki to sprawdzane są pozostałe pola.
	if(isset($_POST['tytul']))
	{
		///Udana walidacja              
		$dobrze=true;                  
	

		$autor=$_POST['autor'];
		$gatunek=$_POST['gatunek'];
		$tytul=$_POST['tytul'];
		
		///Sprawdzenie długosci imienia autora.
		if((strlen($autor)<3)||(strlen($autor)>40))
		{
			$dobrze=false;
			$_SESSION['e_autor']="To pole musi posiadać od 3 do 40 znaków";
		
		}
		///Sprawdzenie długosci imienia autora.
		if((strlen($gatunek)<2)||(strlen($gatunek)>40))
		{
			$dobrze=false;
			$_SESSION['e_gatunek']="To pole musi posiadać od 2 do 20 znaków";
		
		}
		
	
/** @brief Sprawdzenie czy istnieje już w bazie książka o takim samym tytule.
 *
 * W pierwszej kolejności nawiązane zostało połączenie z bazą danych.
 *
 *
 */

		require_once "connect.php";
		
		///Ustawienie sposobu raportowania błędów, stała 'MYSQLI_REPORT_STRICT' informuje, że w przypadku błędów, następuje "rzucenie" wyjątku.
		mysqli_report(MYSQLI_REPORT_STRICT);
		try
		{
			///Próba połączenia z bazą.
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				
				///Zapytanie do bazy czy tytuł już istnieje.
				$rezultat = $polaczenie->query("SELECT id FROM ksiazki WHERE tytul='$tytul'");
				///W przypadku niepowodzenia następuje "rzucenie" wyjątkiem i pokazanie komunikatu o błędzie.
				if(!$rezultat) throw new Exception($polaczenie->error);
			
				$ile_takich_ksiazek=$rezultat -> num_rows; 
				///Jeżeli poniższy warunek zostanie spełniony, to znaczy, że istnieje już taki tytuł książki w bazie.
				if($ile_takich_ksiazek>0)
				{
				
					$dobrze=false;
					$_SESSION['e_tytul']="Istnieje już ksiazka o takim tytule ";
				
				}
				
				
				
				if($dobrze==true)
					{
						///Jeżlei nie istnieje książka o podanym tytule i pozostałe parametry zostają spełnione, książka trafia do bazy.
						if(($polaczenie->query("INSERT INTO ksiazki VALUES(NULL, '$tytul', '$autor', '$gatunek')")))
						{
							$_SESSION['udanarejestracja']==true;
							///Po poprawnym wypełnieniu formularza i zatwierdzeniu, następuje przekierowanie do listy książek, hdzie na końcu znajduje się nowo dodana pozycja książki.
							header('Location: lista.php');
						}
						///W przeciwnym wypadku następuje "rzucenie" wyjątku i obsłuha błędu.
						else
						{
							throw new Exception($polaczenie->error);
						}
					}
				
				///Zamknięcie połączenia z bazą danych.
				$polaczenie->close();
			}
		}
		///Obsłuha wyjątków, w przypadku wystąpienia błędów wyświetlany jest komunikat.
		catch(Exception $e)
		{
			echo "Błąd serwera! Proszę o rejestrację w innym terminie";
			echo '<br/>Informacja: '.$e;
		}
	
	}
?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset ="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Biblioteka - zakłóż konto</title>
	
	<style>
	.error
	{
		color: red;
		margin-top: 10px;
		margin-bottom: 10px;
	}
	
	</style>
	
</head>

<body bgcolor="black">
<center><table>
<br/><br/><br/><br/>
	<form method="post">
	<br/><br/>
	<tr><td width="350", bgcolor="#FF0000"><font size="5" color= "white"></br>Autor:</font><br/><center><input type="text" name="autor"/></center><br/>
	
	
	<?php
/** 
 * 
 * Jeżeli nazwa autora nie jest zgodna z parametrami, to zostaje wysłany komunikat o błędzie.
 *
 */
		if(isset($_SESSION['e_autor']))
		{
			echo '<div class="error">'.$_SESSION['e_autor'].'</div>';
			unset($_SESSION['e_autor']);
		}	
		
	?>
	<br/><br/>
	</tr></td>
	
	<tr><td width="350", bgcolor="#FF3300"><font size="5" color= "white"></br>Gatunek:</font><br/><center><input type="text" name="gatunek"/></center><br/>
	<?php
/** 
 * 
 * Jeżeli pole 'gatunek' książki nie jest zgodny z parametrami, to zostaje wysłany komunikat o błędzie.
 *
 */
		if(isset($_SESSION['e_gatunek']))
		{
			echo '<div class="error">'.$_SESSION['e_gatunek'].'</div>';
			unset($_SESSION['e_gatunek']);
		}	
		
	?>
	<br/><br/>
	</tr></td>
	
	
	
	<tr><td width="350", bgcolor="#FF6600"><font size="5" color= "white"></br>Tytuł: </font><br/><center><input type="text" name="tytul"/></center><br/>
	
	<?php
/** 
 * 
 * Jeżeli tytuł książki nie jest zgodny z parametrami, to zostaje wysłany komunikat o błędzie.
 *
 */
		if(isset($_SESSION['e_tytul']))
		{
			echo '<div class="error">'.$_SESSION['e_tytul'].'</div>';
			unset($_SESSION['e_tytul']);
		}	
		
	?>
	<br/><br/>
	</tr></td>
	
	
	<br/>
	<tr><td>
	<input type="submit" value="Dodaj" />
	</td></tr>
	</form>
	</table></center>
</body>
</html>