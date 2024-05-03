<?php
	//Connect MYSQL
	$connect = mysqli_connect('localhost', 'yoobi', 'toor', 'php_db') or die("connect fail");
	$number = $_GET['number'];
	$date = $_GET['date'];

	//add hit=hit+1 for view count
	$hit = $connect->prepare("delete from sub_board where number=? and date=?");
	$hit->bind_param("is", $number, $date);
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