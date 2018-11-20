<?php
	// login i hasło z formularza
	$user=$_POST['user']; 
	$pass=$_POST['pass']; 

	// zmienna z nazwą ciasteczka
	$cookie_name = "user";
	// zmienna z zawartością ciasteczka nazwanego powyżej
	$cookie_value = $user;
	// utworzenie ciasteczka o wspomnianej nazwie z wspomnianą zawartoscią (86400 to 1 dzień)
	setcookie($cookie_name, $cookie_value, time() + (2000 * 30), "/");
	// zmienna z nazwą ciasteczka
	$cookie_name = "pass";
	// zmienna z zawartością ciasteczka nazwanego powyżej
	$cookie_value = $pass;
	// utworzenie ciasteczka o wspomnianej nazwie z wspomnianą zawartoscią (86400 to 1 dzień)
	setcookie($cookie_name, $cookie_value, time() + (2000 * 30), "/");

	header("Refresh:0; url=index.php");
?>
