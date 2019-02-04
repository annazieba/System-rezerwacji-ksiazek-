<?php
	
	session_start();
	
	if((!isset($_POST['login']))||(!isset($_POST['haslo'])))
	{
		header('Location: index.php');
		exit();
	}
	
	require_once "connect.php";
	
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

	if($polaczenie->connect_errno!=0)
	{
		echo "Error:".$polaczenie->connect_errno;
	}
	else
	{
		$login = $_POST['login'];
		$haslo = $_POST['haslo'];
		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		
		
		if($rezultat=@$polaczenie->query(sprintf("SELECT * FROM czytelnicy WHERE user='%s' ",
		mysqli_real_escape_string($polaczenie,$login))))
		{
			$ilu_userow=$rezultat->num_rows;
			if($ilu_userow>0)
			{
				$wiersz= $rezultat->fetch_assoc();
				
					if(password_verify($haslo, $wiersz['pass']))
				{
					$_SESSION['zalogowany']=true;					
					$_SESSION['id']=$wiersz['id'];
					$_SESSION['user']=$wiersz['user'];
					$_SESSION['imie']=$wiersz['imie'];
					$_SESSION['nazwisko']=$wiersz['nazwisko'];
					$_SESSION['rezerwacje']=$wiersz['rezerwacje'];
					
					unset($_SESSION['blad']);
					$rezultat->free_result();
					header('Location: wypozycz.php');
				}
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
		
		$polaczenie->close();
	}

	
?>