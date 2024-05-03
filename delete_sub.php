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
	$connect = mysqli_connect('localhost', 'yoobi', 'toor', 'php_db') or die("connect fail");
	$number = $_GET['number'];
	$date = $_GET['date'];

	//add hit=hit+1 for view count
	$id = $_SESSION['userid'];
	$hit = $connect->prepare("delete from sub_board where number=? and date=? and id=?");
	$hit->bind_param("iss", $number, $date, $id);
	$hit->execute();
	$query = $connect->prepare("select title, content, id, date, hit, star, name_orig from board where number =?");
	$query->bind_param("i", $number);
	$query->execute();
	$result = $query->get_result();
	$rows = mysqli_fetch_assoc($result);

?>
<script>
	history.back();
</script>