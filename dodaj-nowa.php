<?php

	session_start();
	
	if(isset($_POST['tytul']))
	{
		//Udana walidacja              e-mail=tytul
		$dobrze=true;                  //nick=autor
		                               //imie=gatunek
		//Sprawdz poprawnosc nickname
		$autor=$_POST['autor'];
		$gatunek=$_POST['gatunek'];
		$tytul=$_POST['tytul'];
		
		//Sprawdzenie długosci imienia autora
		if((strlen($autor)<3)||(strlen($autor)>40))
		{
			$dobrze=false;
			$_SESSION['e_autor']="To pole musi posiadać od 3 do 40 znaków";
		
		}
		if((strlen($gatunek)<2)||(strlen($gatunek)>40))
		{
			$dobrze=false;
			$_SESSION['e_gatunek']="To pole musi posiadać od 2 do 20 znaków";
		
		}
		
		
		//if(ctype_alnum($autor)==false)
		//{
		//	$dobrze=false;
		//	$_SESSION['e_autor']="To pole może składać się tylko z liter i cyfr(bez polskich znaków)";
		//}
		
		

		
		
		
		//czy istnieje już taka ksiazka
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
				
				//czy tytul juz istnieje
				$rezultat = $polaczenie->query("SELECT id FROM ksiazki WHERE tytul='$tytul'");
				
				if(!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_ksiazek=$rezultat -> num_rows; 
				if($ile_takich_ksiazek>0)
				{
				
					$dobrze=false;
					$_SESSION['e_tytul']="Istnieje już ksiazka o takim tytule ";
				
				}
				
				
				
				if($dobrze==true)
					{
						//testy zaliczone ksiazka dodana
						if(($polaczenie->query("INSERT INTO ksiazki VALUES(NULL, '$tytul', '$autor', '$gatunek')")))
						{
							$_SESSION['udanarejestracja']==true;
							header('Location: lista.php');
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

<body bgcolor="black">
<center><table>
<br/><br/><br/><br/>
	<form method="post">
	<br/><br/>
	<tr><td width="350", bgcolor="#FF0000"><font size="5" color= "white"></br>Autor:</font><br/><center><input type="text" name="autor"/></center><br/>
	<?php
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