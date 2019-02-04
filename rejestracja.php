<?php

	session_start();
	
	if(isset($_POST['email']))
	{
		//Udana walidacja
		$dobrze=true;
		
		//Sprawdz poprawnosc nickname
		$nick=$_POST['nick'];
		$imie=$_POST['imie'];
		$nazwisko=$_POST['nazwisko'];
		
		//Sprawdzenie długosci nicka
		if((strlen($nick)<3)||(strlen($nick)>20))
		{
			$dobrze=false;
			$_SESSION['e_nick']="Nick musi posiadać od 3 do 20 znaków";
		
		}
		if((strlen($imie)<2)||(strlen($imie)>20))
		{
			$dobrze=false;
			$_SESSION['e_imie']="Imię musi posiadać od 2 do 20 znaków";
		
		}
		if((strlen($nazwisko)<2)||(strlen($nazwisko)>30))
		{
			$dobrze=false;
			$_SESSION['e_nazwisko']="Nazwisko musi posiadać od 2 do 30 znaków";
		
		}
		
		if(ctype_alnum($nick)==false)
		{
			$dobrze=false;
			$_SESSION['e_nick']="Nick może składać się tylko z liter i cyfr(bez polskich znaków)";
		}
		
		//poprawnosc adresu email
		$email=$_POST['email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if((filter_var($emailB, FILTER_SANITIZE_EMAIL)==false)||($emailB!=$email))
		{
			$dobrze=false;
			$_SESSION['e_mail']="Podaj poprawny e-mail";
		}
		
		//Sprawd poprawoność hasla
		$haslo1= $_POST['haslo1'];
		$haslo2= $_POST['haslo2'];
		
		if($haslo1!=$haslo2)
		{
			$dobrze=false;
			$_SESSION['e_haslo']="Podane hasła nie są identyczne";
		}
		
		$haslo_hash = password_hash($haslo1,PASSWORD_DEFAULT);
		
		//czy regulamin zaakceptowany
		if(!isset($_POST['regulamin']))
		{
			$dobrze=false;
			$_SESSION['e_regulamin']="Nie potwierdzono akceptacji regulaminu!";
		}
		
		//czy istnieje już takie konto
		require_once "connect.php";
		
		
		mysqli_report(MYSQLI_REPORT_STRICT);
		try
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				
				//czy email juz istnieje
				$rezultat = $polaczenie->query("SELECT id FROM czytelnicy WHERE email='$email'");
				
				if(!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_maili=$rezultat -> num_rows; 
				if($ile_takich_maili>0)
				{
				
					$dobrze=false;
					$_SESSION['e_email']="Istnieje już konto o takim adresie email ";
				
				}
				
				//czy nick juz zarezerwowany
				$rezultat = $polaczenie->query("SELECT id FROM czytelnicy WHERE user='$nick'");
				
				if(!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_nickow=$rezultat -> num_rows; 
				if($ile_takich_nickow>0)
				{
				
					$dobrze=false;
					$_SESSION['e_nick']="Taki nick już jest zarezerwowany ";
				
				}
				
				if($dobrze==true)
					{
						//testy zaliczone gracz dodany
						if(($polaczenie->query("INSERT INTO czytelnicy VALUES(NULL, '$imie', '$nazwisko', '$email', '','$nick', '$haslo_hash')")))
						{
							$_SESSION['udanarejestracja']==true;
							header('Location: witamy.php');
						}
						else
						{
							throw new Exception($polaczenie->error);
						}
					}
				
				
				$polaczenie->close();
			}
		}
		
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

<body>

	<form method="post">
	
	Nickname: <br/><input type="text" name="nick"/><br/>
	<?php
		if(isset($_SESSION['e_nick']))
		{
			echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
			unset($_SESSION['e_nick']);
		}	
		
	?>
	<br/>
	Imię: <br/><input type="text" name="imie"/><br/>
	<?php
		if(isset($_SESSION['e_imie']))
		{
			echo '<div class="error">'.$_SESSION['e_imie'].'</div>';
			unset($_SESSION['e_imie']);
		}	
		
	?>
	<br/>
	Nazwisko: <br/><input type="text" name="nazwisko"/><br/>
	<?php
		if(isset($_SESSION['e_nazwisko']))
		{
			echo '<div class="error">'.$_SESSION['e_nazwisko'].'</div>';
			unset($_SESSION['e_nazwisko']);
		}	
		
	?>
	<br/>
	E-mail: <br/><input type="text" name="email"/><br/>
	
	<?php
		if(isset($_SESSION['e_email']))
		{
			echo '<div class="error">'.$_SESSION['e_email'].'</div>';
			unset($_SESSION['e_email']);
		}	
		
	?>
	
	Hasło: <br/><input type="password" name="haslo1"/><br/>
	Powtórz hasło: <br/><input type="password" name="haslo2"/><br/>
	
	<?php
		if(isset($_SESSION['e_haslo']))
		{
			echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
			unset($_SESSION['e_haslo']);
		}	
		
	?>
	
	<label><br/>
	<input type="checkbox" name="regulamin"/>Akceptuję regulamin
	</label>
	
	<?php
		if(isset($_SESSION['e_regulamin']))
		{
			echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
			unset($_SESSION['e_regulamin']);
		}	
		
	?>
	
	<br/>
	<input type="submit" value="Zarejestruj się" />
	
	</form>
	
</body>
</html>