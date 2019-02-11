<?php

/** @brief Niszczenie sesji
 * 
 * Po wylogowaniu użytkownik przekierowany jest na stronę z panelem logowania.
 *
 */

	session_start();
	
	session_unset();
	
	header('Location: index.php');
	
	
?>



