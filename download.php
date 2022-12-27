<?php
/*
::: CONTENTS :::
Project		: php_website
Version		: 1.0
Filename	: download.php
Date		: 2020/01/05
Purpose		: Ready for studying secure coding of WEB(PHP)
Programmer	: Yoobi (ubyung1@gmail.com)
Reviewer	:
*/

	//Connect MYSQL & download logic
	$target = $_REQUEST['file_name'];
	
	$filepath = './up_file/'.$target;
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
