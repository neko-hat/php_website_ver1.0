<?php

	//Connect MYSQL & download logic
	$connect = mysqli_connect("localhost", "yoobi", "toor", "php_db") or die("fail");
	$target = basename($_REQUEST['file_name']);
	$query = $connect->prepare("SELECT name_save from board where name_orig = ?");
	$query->bind_param('s', $target);
	$query->execute();
	$result = $query->get_result();
	$rows = mysqli_fetch_assoc($result);

	$real_filename = $rows['name_save'];
	$filepath = './up_file/'.$real_filename;
	$filesize = filesize($filepath);
	$path_parts = pathinfo($filepath);
	$filename = $path_parts['basename'];
	$extension = $path_parts['extension'];

	header("Pragma: public");
	header("Expries: 0");
	header("Content-Type: application/octet-stream");
	header("Content-Disposition: attachment; filename=$filename");
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: $filesize");

	readfile($filepath);
?>
