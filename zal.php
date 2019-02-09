<?php
	session_start();
	require_once "connect.php";
	
	
	

	

$wynik = pg_query("SELECT * FROM  ksiazki");

$ilosc_wierszy=pg_num_rows($wynik);    

$ile=pg_numfields($wynik);

for($b=0;$b<$ile;$b++)
{
 $id[$b]=pg_fieldname($wynik,$b);
} 
print "<tr>";  
{
 print "<td><b><small>id</small></b></td>";
 } 
{ print "<td><b><small>tytul</small></b></td>"; 
} 
{
 print "<td><b><small>autor</small></b></td>"; 
}
{
 print "<td><b><small>gatunek</small></b></td>"; 
}
 print "</tr>"; 
while ($wiersz = pg_fetch_array($wynik,null,PGSQL_NUM)) 
{ 
 print "<tr>"; 
 foreach ($wiersz as $w)  
{ 
 print "<td><small>$w</small></td>";  
}
{
echo "<form method='POST' action='wyslij_wytypuj.php'>";  

print "<td><INPUT type='checkbox' name='nazwa' value='$w' ></td>"; 
 }
print "</tr>"; 
}
print "<tr><td>";
print "<p> </p>";
print "<p align='center'><input type='submit' value='Wyślij dane' >";
print "</font>";
print "<INPUT TYPE='reset' VALUE='Wyczyść dane' >";
print "</td></tr>";
echo "</form>";
 print "</table>";
?>
	

	
?>