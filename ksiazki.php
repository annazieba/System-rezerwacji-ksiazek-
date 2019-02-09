<?php

session_start();
	
	
	
	require_once "connect.php";
	
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

	if($polaczenie->connect_errno!=0)
	{
		echo "Error:".$polaczenie->connect_errno;
	}


 
 
$result = mysql_query("SELECT * FROM ksiazki");
 
echo '<table><tr><th>Numer pozycji</th><th>Tytuł książki</th><th>Autor</th></tr><th>Gatunek</th></tr>';
while($row = mysql_fetch_array($result))
  {
	 echo "<tr><td>{$row['id']}</td><td>{$row['tytul']}</td><td>{$row['autor']}</td><td>{$row['gatunek']}</td></tr>";
  }
 echo '</table>';
 
mysql_close($polaczenie);
?>