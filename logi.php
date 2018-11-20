<?php
	$user=$_COOKIE['user'];
	$ink = 0;

	$link = mysqli_connect("personalyhdamian.mysql.db", "personalyhdamian","X", "personalyhdamian"); 

	// obsługa błędu połączenia z BD
	if(!$link) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); }

	// ustawienie polskich znaków
	mysqli_query($link, "SET NAMES 'utf8'"); 

	// pobranie z BD wiersza, w którym login=login z formularza
	$result = mysqli_query($link, "SELECT `id`, `attempt` FROM `logi` WHERE `user`='$user' ORDER BY id DESC LIMIT 3");
	// wiersz z BD, struktura zmiennej jak w BD

	while ($wiersz = mysqli_fetch_array ($result)) {

		$odp[$ink] = $wiersz[1];
		$ink++;
	}

	if ($odp[0] == "X" && $odp[1] == "X" && $odp[2] == "X") {
		$warn = "3X";
	}
	else {
		$warn = "OK";
	}

	$result = mysqli_query($link, "SELECT `id`, `time` + INTERVAL 1 MINUTE, `attempt` FROM `logi` WHERE `user`='$user'  ORDER BY id DESC LIMIT 1");

	while ($wiersz = mysqli_fetch_array ($result)) {

		$mydate = $wiersz[1];
	}

?>