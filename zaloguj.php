<?php
	//Zmienne z danymi niezbędnymi do komunikacji z BD
	$dbhost="X"; 
	$dbuser="X"; 
	$dbpassword="X"; 
	$dbname="X";

	// Połączenie z BD
	$polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

	// wybranie danych z bazy danych
	$rezultat = mysqli_query($polaczenie, "SELECT content FROM cms WHERE menu = 'zaloguj'") or die ("Błąd zapytania do bazy: $dbname");

	// wypisanie w pętli danych wybranych poprzednio
	while ($wiersz = mysqli_fetch_array ($rezultat)) {
		//zmienne wypłeniane danymi z bazy danych za każdym wierszem
		$content = $wiersz[0];

		//wypisanie zmienych w tabelkach
		print($content);
	}
?>