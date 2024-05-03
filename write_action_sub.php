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
	$query = $connect->prepare("INSERT INTO sub_board (number, content, id, password, date, star) VALUES (?, ?, ?, ?, ?, 0)");
	$query->bind_param("sssss", $number, $content, $id, $pw, $date);
	$result = $query->execute();	

	mysqli_close($connect);
?>
<script>
	history.back();
</script>