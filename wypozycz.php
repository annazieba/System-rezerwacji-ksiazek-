<?php
	
	session_start();
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset ="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>System rezerwacji książek w bibliotece</title>
	<link rel="stylesheet" href="style.css" type="text/css" />
</head>

<body width="800", height="90", bgcolor="black">
<center><table style="width: 60%; height:15em"><tr>
<td width="900", height="60", bgcolor="navy">
<h1><font color="white" size="30"><center>Witaj w systemie rezerwacji książek!</center></font></h1></td>
</tr><br/><br/><br/><br/>
</table>

<table style="width: 60%; height:20em">

<tr><td width="300", height="90", bgcolor="maroon", ><a href="lista.php"><center><font size="15">Zobacz listę książek <br/> i zarezerwuj!</font></center></a></td>



<td width="300", height="80", bgcolor="green"><a href="dodaj-nowa.php"><center><font size="15">Dodaj książkę do zbioru</font></center></a></td></tr>
<br/><br/>
<tr><td width="100", height="50", bgcolor="#660033"><center><a href="wyloguj.php"><font size="6">Wyloguj się</font></a></center></td>
<td width="100", height="50", bgcolor="black"><center><font color="white" size="5"><i>"Kto czyta książki, żyje podwójnie"</i><br/>- Umberto Eco</font></center></td></tr>
</table></center>
</body>
</html>