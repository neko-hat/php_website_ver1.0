<?php
	//Connect MYSQL
	$connect = mysqli_connect('localhost', 'yoobi', 'toor', 'php_db') or die("connect fail");
	$number = $_GET['number'];
	$date = $_GET['date'];

	//add hit=hit+1 for view count
	$hit = "update sub_board set star=star+1 where number=$number and date='$date'";
	$connect->query($hit);
	$query = "select title, content, id, date, hit, star, name_orig from board where number =$number";
	$result = $connect->query($query);
	$rows = mysqli_fetch_assoc($result);

?>
<script>
	history.back();
</script>