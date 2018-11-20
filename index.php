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

	$link = mysqli_connect("X", "X", "X", "X");
	if(!$link) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); } // obsługa błędu połączenia z BD

	mysqli_query($link, "SET NAMES 'utf8'"); // ustawienie polskich znaków

	$result = mysqli_query($link, "SELECT * FROM users WHERE user='$user'"); // pobranie z BD wiersza, w którym login=login z formularza
	
	$rekord = mysqli_fetch_array($result); // wiersza z BD, struktura zmiennej jak w BD

	if(!$rekord) { //Jeśli brak, to nie ma użytkownika o podanym loginie
		include 'clear.php';
		mysqli_close($link); // zamknięcie połączenia z BD
		print "<div><div>Zaloguj do chmury<br><br>";
		include 'zaloguj.php';
		print "</div><div>Stwórz konto<br><br>";
		include 'rejestruj.html';
		print "</div></div>";
	}
	else { 
		$curdate = date('Y-m-d H:i:s');
		if ($pass == $rekord['pass']) {
			mysqli_query($link, "INSERT INTO `logi`(`user`, `time`, `attempt`) VALUES ('$user', '$curdate', 'OK')") or die ("Błąd zapytania do bazy: $dbname");
			mysqli_close($link); // zamknięcie połączenia z BD
			print "<div><div><a href=\"wyloguj.php\">wyloguj</a></div><div>";   
			include 'scan.php';
			print "</div></div>";
		}
		else {
			include 'logi.php';
			include 'clear.php';
			mysqli_close($link); // zamknięcie połączenia z BD

			if ($warn == "3X") {
				if ($curdate > $mydate) {
					print "<div><div>Przekroczyłeś liczbę nieudanych prób!<br><br>";
					include 'zaloguj.php';
					print "</div><div>Stwórz konto<br><br>";
					include 'rejestruj.html';
					print "</div></div>";
				}
				else {
					print "<div><div>Już okay<br><br>";
					include 'zaloguj.php';
					print "</div><div>Stwórz konto<br><br>";
					include 'rejestruj.html';
					print "</div></div>";
				}
			}
			else {
				print "<div><div>Zaloguj do chmury<br><br>";
				include 'zaloguj.php';
				print "</div><div>Stwórz konto<br><br>";
				include 'rejestruj.html';
				print "</div></div>";
			}
		}
	}

	?>
</body>
</html>