<?php

	// mkdir('uploads/'.$user, 0777, true);

	$dir    = "uploads/".$user;
	$files1 = scandir($dir);
	print($user." nie ma?<br>");

    echo '<pre>';
    print_r($files1);
    echo  '</pre>';

	foreach($files1 as $result) {
	    echo '<br>', $dir."/".$result;

	    if (is_dir($dir."/".$result)) {
	    	print("DIR");
	    	$files2 = scandir($dir);
	    }
	    else {
	    	print("FILE");
	    }
	 //    	print "<form action=\"upload.php\" method=\"post\" enctype=\"multipart/form-data\">
		//     Select image to upload:
		//     <input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\">
		//     <input type=\"hidden\" name=\"user\" value=\"$user\" readonly>
		//     <input type=\"submit\" value=\"Upload Image\" name=\"submit\">
		// </form>
	 //    <br>";
	}

?>