<?php
	$dir = "uploads/".$user;
	$files1 = scandir($dir);
    unset($files1[0]);
    unset($files1[1]);

    $dir_special = "uploads/".$user."/";
    print "<div>
    <form action=\"upload.php\" method=\"post\" enctype=\"multipart/form-data\">
	    Wrzuć do folderu macierzystego:
	    <input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\">
	    <input type=\"hidden\" name=\"dir\" value=\"$dir_special\" readonly>
	    <input type=\"submit\" value=\"Wrzuć\" name=\"submit\">
	</form><br></div>";

	print "<div>
    <form action=\"mkdir.php\" method=\"post\">
	    Stwórz folder w folderze macierzystym:
	    <input type=\"hidden\" name=\"dir_special\" value=\"$dir_special\" readonly>
	    <input type=\"text\" name=\"new_dir\">
	    <input type=\"submit\" value=\"Stwórz\" name=\"submit\">
	</form><br></div>";

	foreach($files1 as $result) {

	    if (is_dir($dir."/".$result)) {
	    	print "<div><div>";
	    	print($result);
	    	print "</div>";
	    	$files2 = scandir($dir."/".$result);
	    	unset($files2[0]);
    		unset($files2[1]);

    	    $dir_special = "uploads/".$user."/".$result."/";
		    print "<div>
		    <form action=\"upload.php\" method=\"post\" enctype=\"multipart/form-data\">
			    Wrzuć do folderu $result:
			    <input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\">
			    <input type=\"hidden\" name=\"dir\" value=\"$dir_special\" readonly>
			    <input type=\"submit\" value=\"Wrzuć\" name=\"submit\">
			</form><br></div>";

			foreach($files2 as $result2) {

			    if (is_dir($dir."/".$result."/".$result2)) {
			    	print "<div class=\"indent\">";
			    	print($result2);
			    	print "</div>";
			    }
			    else {
			    	print "<div class=\"indent\">";
			    	print($result2);
			    	$dir_file = $dir_special.$result2;
			    	print "
				    <form action=\"download.php\" method=\"post\" enctype=\"multipart/form-data\">
					    <input type=\"hidden\" name=\"dir_file\" value=\"$dir_file\" readonly>
					    <input type=\"submit\" value=\"Ściągnij\" name=\"submit\">
					</form>";
			    	print "</div>";
			    }
			}
		print "</div>";
	    }
	    else {
	    	print "<div>";
	    	print($result);
	    	$dir_file = $dir_special.$result;
	    	print "
		    <form action=\"download.php\" method=\"post\" enctype=\"multipart/form-data\">
			    <input type=\"hidden\" name=\"dir_file\" value=\"$dir_file\" readonly>
			    <input type=\"submit\" value=\"Ściągnij\" name=\"submit\">
			</form>";
	    	print "</div>";
	    }
	}
?>