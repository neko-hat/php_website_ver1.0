<?php
	//Connect MYSQL
	$connect = mysqli_connect("localhost", "yoobi", "toor", "php_db") or die("fail");

	//Set values
	$id = htmlspecialchars($_POST["name"]);
	$pw = 0;
	$title = htmlspecialchars($_POST["title"]);
	$content = htmlspecialchars($_POST["content"]);
	$date = date('Y-m-d H:i:s');

	$URL = './board_list.php';

	//INSERT info to DB
	$query = $connect->prepare("INSERT INTO board (number, title, content, id, password, date, hit, name_orig, name_save) VALUES (null, ?, ?, ?, ?, ?, 0, 0, 0)"); 
	$query->bind_param("sssss", $title, $content, $id, $pw, $date);
	$result = $query->execute();

	//If the file exist
	if(isset($_FILES['upfile']) && $_FILES['upfile']['name'] !== "")
	{
		$file = $_FILES['upfile'];
		$upload_directory='./up_file/';
		$file_name = $file['name'];

		$max_file_size = 5242880;

		//Check upload file size
		if($file['size'] >= $max_file_size)
		{
?>
			<script>
				alert("<?php echo "5MB까지만 업로드 가능합니다."?>");
				history.back();
			</script>
<?php
		}
	
		$query = "select LAST_INSERT_ID() from board";
		$result = $connect->query($query);
		$rows = mysqli_fetch_assoc($result);

		$number = $rows['LAST_INSERT_ID()'];
	
		//set filename adding number and '_'
		//Duplicate Prevention
		$name_save = md5_file($_FILES['upfile']['tmp_name']);

		
		//filee_uploading part
		if(move_uploaded_file($file['tmp_name'], $upload_directory.$name_save))
		{
			$query = $connect->prepare("update board set name_orig = ?, name_save = ? where number=?");
			$query->bind_param("ssi", $file_name, $name_save, $number);
			$result = $query->execute();

			if($result)
			{
?>          			<script>
					alert("Post has been successfully written.");
					location.replace("./board_list.php");
				</script>
<?php
			}
			else
			{
				echo "FAIL";
			}

			mysqli_close($connect);
			exit;
		}
	}
	//If the file do not exist
	else
	{
		if($result)
		{
?>      	
			<script>
				alert("Post has been successfully written.");
				location.replace("./board_list.php");
			</script>
<?php
		}
		else
		{
			echo "FAIL";
		}
		mysqli_close($connect);
	} 
?>


