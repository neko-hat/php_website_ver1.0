<?php
	//Connect MYSQL
	$connect = mysqli_connect("localhost", "yoobi", "toor", "php_db");
	$number = $_GET["number"];

	$query = $connect->prepare("select name_save from board where number=?");
	$query->bind_param("i", $number);
	$query->execute();
	$result = $query->get_result();
	$rows = mysqli_fetch_assoc($result);
	
	//Set filename
	$filename = './up_file/'.$rows['name_save'];
	//delete file
	unlink($filename);

	//Set filename='0' on DB info
	$query = $connect->prepare("update board set name_orig='0', name_save='0' where number=?");
	$query->bind_param("i", $number);
	$query->execute();
	$result = $query->get_result();
	$rows = mysqli_fetch_assoc($result);
	

?>
<script>
	history.back();
</script>
