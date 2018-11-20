<?php
	// zmienna z nazwą ciasteczka
	$cookie_name = "user";
	// zmienna z zawartością ciasteczka nazwanego powyżej
	$cookie_value = null;
	// utworzenie ciasteczka o wspomnianej nazwie z wspomnianą zawartoscią (86400 to 1 dzień)
	setcookie($cookie_name, $cookie_value, time() - 86400, "/");
	// zmienna z nazwą ciasteczka
	$cookie_name = "pass";
	// zmienna z zawartością ciasteczka nazwanego powyżej
	$cookie_value = null;
	// utworzenie ciasteczka o wspomnianej nazwie z wspomnianą zawartoscią (86400 to 1 dzień)
	setcookie($cookie_name, $cookie_value, time() - 86400, "/");
?>
