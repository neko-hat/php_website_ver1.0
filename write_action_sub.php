<?php
	session_start();
	//Connect MYSQL
	$URL = "./board_list.php";

	// If user do not have SESSION back to $URL
	if(!isset($_SESSION['userid']))
	{
?>
		<script>
			alert("Login First!");
			location.replace("<?php echo $URL?>");
		</script>
<?php
	die;
	}
?>
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