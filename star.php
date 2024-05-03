<?php
	//Connect MYSQL
	$connect = mysqli_connect('localhost', 'yoobi', 'toor', 'php_db') or die("connect fail");
	$number = $_GET['number'];
	session_start();

	//Check SESSION
	if(!isset($_SESSION['userid']))
	{
?>
		<script>
			alert("Login First!");
			history.back();
		</script>
<?php
		exit;
	}

	//add hit=hit+1 for view count
	$hit = $connect->prepare("update board set star=star+1 where number=?");
	$hit->bind_param("i", $number);
	$hit->execute();
	$query = $connect->prepare("select title, content, id, date, hit, star, name_orig from board where number =$number");
	$query->bind_param("i", $number);
	$query->execute();
	$result = $query->get_result();
	$rows = mysqli_fetch_assoc($result);

?>
<script>
	history.back();
</script>