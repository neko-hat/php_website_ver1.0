<!--
::: CONTENTS :::
Project		: php_website
Version		: 1.0
Filename	: write_action.php
Date		: 2020/01/08
Purpose		: Ready for studying secure coding of WEB(PHP)
Programmer	: Yoobi (ubyung1@gmail.com)
Reviewer	:
-->

<?php
	//Connect MYSQL
	$connect = mysqli_connect("localhost", "yoobi", "toor", "php_db") or die("fail");

	//Set values
	$number = $_GET["number"];
	$id = $_GET["name"];
	$pw = 0;
	$content = $_GET["content"];
	$date = date('Y-m-d H:i:s');

	//INSERT info to DB
	$query = "INSERT INTO sub_board (number, content, id, password, date, star) VALUES ('$number', '$content', '$id', '$pw', '$date', 0)"; 
	$result = $connect->query($query);	

	mysqli_close($connect);
?>
<script>
	history.back();
</script>