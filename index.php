<!DOCTYPE html>
<html lang="pl-PL">
<head>
	<meta charset="UTF-8">
	<title>Bączkowski</title>
	<script src="https://cdn.ckeditor.com/4.10.1/standard-all/ckeditor.js"></script>
 	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<?php

	$user=$_COOKIE['user'];
	$pass=$_COOKIE['pass'];

	$link = mysqli_connect("X", "X","X", "X"); // połączenie z BD – wpisać swoje parametry !!!

	if(!$link) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); } // obsługa błędu połączenia z BD

	mysqli_query($link, "SET NAMES 'utf8'"); // ustawienie polskich znaków

	$users = mysqli_query($link, "SELECT user, pass FROM users WHERE user='$user'"); // pobranie z BD wiersza, w którym login=login z formularza
	
	$users_rekord = mysqli_fetch_array($users); // wiersza z BD, struktura zmiennej jak w BD

	if($user && $user == $users_rekord["user"]) { //Jest user!
		$warn = mysqli_query($link, "SELECT `id`, `attempt` FROM `logi` WHERE `user`='$user' ORDER BY id DESC LIMIT 3");
		$curdate = date('Y-m-d H:i:s');
		$ink = 0;
		while ($warn_rekord = mysqli_fetch_array ($warn)) {

			$odp[$ink] = $warn_rekord[1];
			$ink++;
		}

		if ($odp[0] == "X" && $odp[1] == "X" && $odp[2] == "X") { // Za dużo prób z hasłem!
			$timeout = mysqli_query($link, "SELECT `id`, `time` + INTERVAL 1 MINUTE, `attempt` FROM `logi` WHERE `user`='$user'  ORDER BY id DESC LIMIT 1");
			while ($timeout_wiersz = mysqli_fetch_array ($timeout)) {
				$timeout_date = $timeout_wiersz[1];
			}
			if ($curdate > $timeout_date) {
				mysqli_query($link, "INSERT INTO `logi`(`user`, `time`, `attempt`) VALUES ('$user', '$curdate', 'OK')") or die ("Błąd zapytania do bazy tutaj");
				mysqli_close($link); // zamknięcie połączenia z BD
				print "<div><div>Możesz się już zalogować!<br><br>";
				include 'zaloguj.php';
				print "</div><div>Stwórz konto<br><br>";
				include 'rejestruj.html';
				print "</div></div>";
			}
			else {
				print "<div><div>Spróbuj za minutę! <br></div><div>";  
				print "</div><div>Przeglądaj chmurę<br><br>";
				print "</div></div>";
		}
		}
		else {
			if ($pass && $pass == $users_rekord["pass"]) { //Jest hasło!
				mysqli_query($link, "INSERT INTO `logi`(`user`, `time`, `attempt`) VALUES ('$user', '$curdate', 'OK')");

				$logtable = mysqli_query($link, "SELECT `time`, `attempt` FROM `logi` WHERE `user`='$user'  ORDER BY id DESC LIMIT 2");
				$ink = 0;
				while ($logrekord = mysqli_fetch_array ($logtable)) {
					$time[$ink]=($logrekord[0]);
					$attempt[$ink]=($logrekord[1]);
					$ink++;
				}

				if ($attempt[0] == "OK" && $attempt[1] == "X") { // Było błedne logowanie, ale teraz jest ok
					print "<div><div><p>Było błędne logowanie: $time[1]</p><br>Wyloguj z chmury<br><a href=\"wyloguj.php\">wyloguj</a></div><div>";  
					print "</div><div>Przeglądaj chmurę<br><br>";
					include 'mk.php';
					print "</div></div>";
				}
				else { // Było cały czas dobre logowanie
					print "<div><div>Wyloguj z chmury<br><a href=\"wyloguj.php\">wyloguj</a></div>";  
					print "<div>Przeglądaj chmurę<br><br>";
					include 'mk.php';
					print "</div></div>";
				}
			}
			else { // Nie ma hasła!
				include 'clear.php';
				mysqli_query($link, "INSERT INTO `logi`(`user`, `time`, `attempt`) VALUES ('$user', '$curdate', 'X')");
				mysqli_close($link); // zamknięcie połączenia z BD
				print "<div><div>Spróbuj ponownie!<br><br>";
				include 'zaloguj.php';
				print "</div><div>Stwórz konto<br><br>";
				include 'rejestruj.html';
				print "</div></div>";
			}
		}
	}
	else { // Nie ma usera!
		include 'clear.php';
		mysqli_close($link); // zamknięcie połączenia z BD
		print "<div><div>Zaloguj do chmury<br><br>";
		include 'zaloguj.php';
		print "</div><div>Stwórz konto<br><br>";
		include 'rejestruj.html';
		print "</div></div>";
	}

	?>
</body>
</html>