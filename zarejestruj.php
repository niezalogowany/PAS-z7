<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>
<BODY>
	<?php
		// login i hasło z formularza
		$user=$_POST['user']; 
		$pass=$_POST['pass'];  

		if (!$user || !$pass) {
			echo "Nie wolno tak!";
		}
		else {
			// połączenie z BD
			$link = mysqli_connect("X", "X","X", "X"); 

			// obsługa błędu połączenia z BD
			if(!$link) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); }

			// ustawienie polskich znaków
			mysqli_query($link, "SET NAMES 'utf8'"); 

			mysqli_query($link, "INSERT INTO `users`(`user`, `pass`) VALUES ('$user', '$pass')");

			// pobranie z BD wiersza, w którym login=login z formularza
			$result = mysqli_query($link, "SELECT * FROM users WHERE user='$user'");
			// wiersz z BD, struktura zmiennej jak w BD
			$rekord = mysqli_fetch_array($result); 

			//Jeśli brak, to nie ma użytkownika o podanym loginie
			if($pass == $rekord['pass']) { 
					echo "Rejestracja powiodła się. Ok, to teraz się zaloguj! User: {$rekord['user']}. Hasło: {$rekord['pass']}";
					if (!file_exists('uploads/'.$user)) {
					    mkdir('uploads/'.$user, 0777, true);
					}
			}
			else {
				mysqli_close($link);
				echo "Podałeś błędne dane!";
			}
		}
	?>
</BODY>
</HTML>