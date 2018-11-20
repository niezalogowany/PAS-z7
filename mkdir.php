<?php 
	$target_dir = $_POST['dir_special'];
	$new_dir = $_POST['new_dir'];

	if (!file_exists($target_dir.$new_dir)) {
	    mkdir($target_dir.$new_dir, 0777, true);
	}
 ?>