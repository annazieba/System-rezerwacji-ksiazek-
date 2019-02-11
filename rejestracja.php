<?php
/** @brief Sprawdzenie poprawności wypełnienia pól formularza
 * 
 *
 */

	session_start();
/** 
 * 
 * Jeżeli zmienna email jest ustawiona, to następuje sprawdzenie czy pozostałe pola także wypełniono.
 *
 */	
	if(isset($_POST['email']))
	{
		///Zmienna odpowiadająca za poprawną walidację.
		$dobrze=true;
		
		///Sprawdzenie poprawności nickname, imienia, nazwiska.
		$nick=$_POST['nick'];
		$imie=$_POST['imie'];
		$nazwisko=$_POST['nazwisko'];
		
		///Sprawdzenie długosci nicka, jeżeli nie mieści się w parametrach to wyświetlany jest komunikat o błędzie.
		if((strlen($nick)<3)||(strlen($nick)>20))
		{
			$dobrze=false;
			$_SESSION['e_nick']="Nick musi posiadać od 3 do 20 znaków";
		
		}
		///Sprawdzenie długości imienia.
		if((strlen($imie)<2)||(strlen($imie)>20))
		{
			$dobrze=false;
			$_SESSION['e_imie']="Imię musi posiadać od 2 do 20 znaków";
		
		}
		///Sprawdzenie długości nazwiska.
		if((strlen($nazwisko)<2)||(strlen($nazwisko)>30))
		{
			$dobrze=false;
			$_SESSION['e_nazwisko']="Nazwisko musi posiadać od 2 do 30 znaków";
		
		}
		///Sprawdzenie czy nick składa się tylko z liter i cyfr.
		if(ctype_alnum($nick)==false)
		{
			$dobrze=false;
			$_SESSION['e_nick']="Nick może składać się tylko z liter i cyfr(bez polskich znaków)";
		}
		
/** @brief Sanityzacja adresu email
 * 
 * Tylko jeżeli email jest poprawny można go dołączyć do bazy danych.
 * Zmienna 'FILTER_SANITIZE_EMAIL' jest specjalny filtr stosowany do adresów email, pozwalający wychwycić niedozwolone zanki.
 * Zmienna jest stała.
 *
 */
		$email=$_POST['email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
/**
 *
 * Jeżeli email nie zostanie zwalidowany poprawnie i jeżeli podane znaki niealfanumeryczne zostały wycięte,
 * to następuje przekierowanie do pokazania komunikatu o błędzie.
 * 
 */ 
		if((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false)||($emailB!=$email))
		{
			$dobrze=false;
			$_SESSION['e_mail']="Podaj poprawny e-mail";
		}
		
/**
 *
 * Sprawdzenie poprawności hasła.
 *
 */ 
		$haslo1= $_POST['haslo1'];
		$haslo2= $_POST['haslo2'];
		///Sprawdzenie czy powtórzenie hasła zgadza się z pierwszym hasłem.
		if($haslo1!=$haslo2)
		{
			$dobrze=false;
			$_SESSION['e_haslo']="Podane hasła nie są identyczne";
		}
/** @brief Hashowanie hasła.
 *
 * Stała 'PASSWORD_DEFAULT' oznacza użycie algorytmu hashującego (jest to algorytm bcrypt).
 *
 */	
		$haslo_hash = password_hash($haslo1,PASSWORD_DEFAULT);
		
		//Sprawdzenie czy regulamin został zaakceptowany.
		if(!isset($_POST['regulamin']))
		{
			$dobrze=false;
			$_SESSION['e_regulamin']="Nie potwierdzono akceptacji regulaminu!";
		}
/** @brief Sprawdzenie czy konto już istnieje.
 *
 * W pierwszej kolejności następuje nawiązanie połączenia z bazą danych.
 * 
 *
 */		

		require_once "connect.php";
		
		///Ustawienie sposobu raportowania błędów, stała 'MYSQLI_REPORT_STRICT' informuje, że w przypadku błędów, następuje "rzucenie" wyjątku. 
		mysqli_report(MYSQLI_REPORT_STRICT);
		///Próba połączenia z bazą.
		try
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if($polaczenie->connect_errno!=0)
			{
				///"Rzucenie" nowym wyjątkiem, by sekcja catch "złapała" go i wyświetliła komunikat.
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				
				///Czy email juz istnieje, zapytanie o email.
				$rezultat = $polaczenie->query("SELECT id FROM czytelnicy WHERE email='$email'");
				///W przypadku niepowodzenia następuje "rzucenie" wyjątkiem i pokazanie komunikatu o błędzie.
				if(!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_maili=$rezultat -> num_rows; 
				
				///Jeżeli poniższy warunek zostanie spełniony, to znaczy, że istnieje już taki email w bazie.
				if($ile_takich_maili>0)
				{
				
					$dobrze=false;
					$_SESSION['e_email']="Istnieje już konto o takim adresie email ";
				
				}
				
				///Sprawdzenie czy podany nick istnieje już w bazie.
				$rezultat = $polaczenie->query("SELECT id FROM czytelnicy WHERE user='$nick'");
				///W przypadku niepowodzenia następuje "rzucenie" wyjątkiem i pokazanie komunikatu o błędzie.
				if(!$rezultat) throw new Exception($polaczenie->error);
				
				///Jeżeli poniższy warunek zostanie spełniony, to znaczy, że istnieje już taki nick w bazie.
				$ile_takich_nickow=$rezultat -> num_rows; 
				if($ile_takich_nickow>0)
				{
				
					$dobrze=false;
					$_SESSION['e_nick']="Taki nick już jest zarezerwowany ";
				
				}
/** 
 * 
 * Jeżeli wszystkie dane zostały wprowadzone poprawnie to użytkownik zostaje dodany do bazy.
 *
 */			
				if($dobrze==true)
					{
						///Użytkownik poprawnie zarejestrowany i dodany do bazy.
						if(($polaczenie->query("INSERT INTO czytelnicy VALUES(NULL, '$imie', '$nazwisko', '$email', '','$nick', '$haslo_hash')")))
						{
							$_SESSION['udanarejestracja']==true;
							header('Location: witamy.php');
						}
						///W przeciwnym wypadku następuje "rzucenie" wyjątku.
						else
						{
							throw new Exception($polaczenie->error);
						}
					}
				
				
				$polaczenie->close();
			}
		}
		///Przechwycenie ewentualnych błedów i wyświetlenie komunikatu.
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
<center><font color="white" size="6"><h1>Wypełnij formularz</h1></font></center>
<center><table>
<br/>
	<form method="post">
	
	
	<tr><td width="350", bgcolor="#3300CC"><font size="5" color= "white"><center>Nickname: </center></font><br/><center><input type="text" name="nick"/></center><br/>
	<?php
/** 
 * 
 * Jeżeli nick nie jest poprawny, to zostaje wysłany komunikat o błędzie.
 *
 */
		if(isset($_SESSION['e_nick']))
		{
			echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
			///Usunięcie zmiennej błąd, aby w przypadku ponownej próby komunikat już się nie pojawił.
			unset($_SESSION['e_nick']);
		}	
		
	?>
	<br/><br/>
	</tr></td>
	<tr><td width="350", bgcolor="#3333CC"><font size="5" color= "white"><center>Imię:</center></font><br/><center><input type="text" name="imie"/></center><br/>
	<?php
/** 
 * 
 * Jeżeli format imieia jest błędny (za któtkie lub zbyt długie)to pojawai się komunikat o błędzie.
 *
 */
		if(isset($_SESSION['e_imie']))
		{
			echo '<div class="error">'.$_SESSION['e_imie'].'</div>';
			///Usunięcie zmiennej błąd, aby w przypadku ponownej próby komunikat już się nie pojawił.
			unset($_SESSION['e_imie']);
		}	
		
	?>
	<br/><br/>
	</tr></td>
	<br/>
	<tr><td width="350", bgcolor="#3366CC"><font size="5" color= "white"><center>Nazwisko:</center></font><br/><center><input type="text" name="nazwisko"/></center><br/>
	<?php
/** 
 * 
 * Jeżeli format nazwiska jest błędny (za któtkie lub zbyt długie)to pojawai się komunikat o błędzie.
 *
 */
		if(isset($_SESSION['e_nazwisko']))
		{
			echo '<div class="error">'.$_SESSION['e_nazwisko'].'</div>';
			///Usunięcie zmiennej błąd, aby w przypadku ponownej próby komunikat już się nie pojawił.
			unset($_SESSION['e_nazwisko']);
		}	
		
	?>
	<br/><br/>
	</tr></td>
	<br/>
	<tr><td width="350", bgcolor="#3399CC"><font size="5" color= "black"><center>E-mail:</center></font> <br/><center><input type="text" name="email"/></center><br/>
	
	<?php
/** 
 * 
 * Jeżeli format  adresu email jest błędny (za któtkie lub zbyt długie)to pojawai się komunikat o błędzie.
 *
 */
		if(isset($_SESSION['e_email']))
		{
			echo '<div class="error">'.$_SESSION['e_email'].'</div>';
			///Usunięcie zmiennej błąd, aby w przypadku ponownej próby komunikat już się nie pojawił.
			unset($_SESSION['e_email']);
		}	
		
	?>
	<br/>
	</tr></td>
	
	<tr><td width="350", bgcolor="#33CCCC"><font size="5" color= "black"><center>Hasło:</center></font> <br/><center><input type="password" name="haslo1"/></center><br/>
	<font size="5" color= "black"><center>Powtórz hasło: </center></font><br/><center><input type="password" name="haslo2"/></center><br/>
	
	<?php
/** 
 * 
 * Jeżeli hasło pierwsze nie jest takie jak powtórzone to pojawai się komunikat o błędzie.
 *
 */
		if(isset($_SESSION['e_haslo']))
		{
			echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
			///Usunięcie zmiennej błąd, aby w przypadku ponownej próby komunikat już się nie pojawił.
			unset($_SESSION['e_haslo']);
		}	
		
	?>
	<br/>
	</tr></td>
	
	<tr><td><center><label><br/>
	<input type="checkbox" name="regulamin"/><font size="4" color="white"/>Akceptuję regulamin</font>
	</label></center></tr></td>
	
	<?php
/** 
 * 
 * Jeżeli regulamin nie jest zaakceptowany to pojawai się komunikat o błędzie.
 *
 */
		if(isset($_SESSION['e_regulamin']))
		{
			echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
			///Usunięcie zmiennej błąd, aby w przypadku ponownej próby komunikat już się nie pojawił.
			unset($_SESSION['e_regulamin']);
		}	
		
	?>
	<br/>
	</tr></td>
	
	
	<tr><td><center><input type="submit" value="Zarejestruj się" /></center></tr></td>
	
	</form>
	</table></center>
	
</body>
</html>