<?php
/** @brief Plik odpowiedzialny za przetwarzanie poprwaności loginu i hasła.
 * 
 *
 */
	
	session_start();
/** 
 * 
 * Jeżeli zmienne 'login' i 'hasło' nie są ustawione, to nie można przejść dalej.
 * Użytkownik zostaje na stronie z panelem logowania.
 *
 */	
	if((!isset($_POST['login']))||(!isset($_POST['haslo'])))
	{
		header('Location: index.php');
		exit();
	}
/** @breif Nawiązanie połączenia z bazą danych
 * 
 * 
 *
 */	
	require_once "connect.php";
	
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
/** 
 * 
 * Sprawdzenie czy połączenie z bazą zostało nawiązane.
 * Jeżeli połączenie się uda, to poniższy "if" nie zostanie spełniony.
 *
 */
	if($polaczenie->connect_errno!=0)
	{
		echo "Error:".$polaczenie->connect_errno;
	}
/** 
 * 
 * Jeżeli połączenie zostanie nawiązane, to sprawdzone zostanie czy istnieje użytkownik o podanym loginie i haśle.
 *
 */
	else
	{
		$login = $_POST['login'];
		$haslo = $_POST['haslo'];
/** 
 * 
 * 'htmlentities' encje html, zapobiega wstawieniu znaków alfanumerycznych.
 *
 */		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		
/** 
 * 
 * Jeżeli zapytanie udało się wykonać (np. przez literówkę), to zmienna $rezultat przyjmuje wartość false.
 * Warunek wtedy się nie spełni.
 * 'myslqi_real_escape_string' - funkcja używana na ciągu znaków otrzymanego od użytkownika.
 * Funkcja zabezpiecza przed wstrzykiwaniem sql.
 */	
		if($rezultat=@$polaczenie->query(sprintf("SELECT * FROM czytelnicy WHERE user='%s' ",
		mysqli_real_escape_string($polaczenie,$login))))
		{
/** @brief Sprawdzenie czy jest użytkownik o podanym loginie i haśle.
 *  
 * Jeżeli taki użytkownik zostanie znalezioy, tzn. że udało się zalogować.
 *
 */			
			$ilu_userow=$rezultat->num_rows;
			if($ilu_userow>0)
			{
/** 
 * 
 * fetch_assoc - utworzenie tablicy asocjacyjnej z danymi z kolejnych kolumn.
 *
 */
				$wiersz= $rezultat->fetch_assoc();

/** 
 * 
 * Jeżeli udało się zalogować, to w sesji istnieje zmienna o nazwie 'zalogowany'.
 * Ma ona wartość 'true'.
 *
 */
					if(password_verify($haslo, $wiersz['pass']))
				{
					$_SESSION['zalogowany']=true;					
					$_SESSION['id']=$wiersz['id'];
					$_SESSION['user']=$wiersz['user'];
					$_SESSION['imie']=$wiersz['imie'];
					$_SESSION['nazwisko']=$wiersz['nazwisko'];
					$_SESSION['rezerwacje']=$wiersz['rezerwacje'];
/** 
 * 
 * Jeżeli logowanie się udało, to zmienna 'błąd zostaje usunięta.
 *
 */					
					unset($_SESSION['blad']);
					$rezultat->free_result();
/** 
 * 
 * Przekierowanie użytkownika na jego konto.
 *
 */					
					header('Location: wypozycz.php');
				}
				
/** 
 * 
 * W przypadku błędów w loginie i haśle użytkownik pozostaje na stronie logowania.
 *
 */
				else
				{
					$_SESSION['blad']= '<span style="color:red">Niepoprawny login lub hasło</span>';
					header('Location: index.php');
				}
			}
			else
			{				
				$_SESSION['blad']= '<span style="color:red">Niepoprawny login lub hasło</span>';
				header('Location: index.php');
			}
		}
/** 
 * 
 * Zamknięcie połączenia z bazą danych.
 *
 */		
		$polaczenie->close();
	}

	
?>