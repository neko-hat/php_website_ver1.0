<?php
	//Connect MYSQL
	$connect = mysqli_connect('localhost', 'yoobi', 'toor', 'php_db') or die("fail");

	$id=htmlspecialchars($_GET["id"]);
	$pw=$_GET["pw"];
	$email=$_GET["email"];
	$date = date('Y-m-d H:i:s');

	//Check the id value exist or not
	$query = $connect->prepare("select * from member where id=?");
	$query->bind_param('s', $id);
	$query->execute();
	$result = $query->get_result();

	//If id value exist
	if($result->num_rows>=1)
	{
?>
		<script>
			alert("This ID is already in use.");
			history.back();	
		</script>
<?php
		exit;
	}

	//Save user entered value in DB	
	$query = $connect->prepare("insert into member (id, pw, email, date, permit) values (?, ?, ?, ?, 0)");
	$query->bind_param('ssss', $id, $pw, $email, $date);
	$result = $query->execute();

	if($result)
	{
?>
		<script>
			alert('Successfully signed up!');
			location.replace("./login.php");
		</script>

<?php
	}
	else
	{
?>
		<script>
			alert("fail");
		</script>
<?php
	}

	mysqli_close($connect);
?>


