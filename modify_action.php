<?php
	//Connect MYSQL
	$connect = mysqli_connect("localhost", "yoobi", "toor", "php_db") or die ("connect fail");
	$number = htmlspecialchars($_POST["number"]);
	$title = htmlspecialchars($_POST["title"]);
	$content = htmlspecialchars($_POST["content"]);
	$date = date('Y-m-d H:i:s');

	//if the file exist
	if(isset($_FILES['upfile']) && $_FILES['upfile']['name'] !== "")
	{
		$file = $_FILES['upfile'];
		$upload_directory='./up_file/';
		$file_name = $file['name'];
		$name_save = md5_file($_FILES['upfile']['tmp_name']);

		$max_file_size = 5242880;
		
		//Check upload file size
		if($file['size'] >= $max_file_size)
		{
?>	
			<script>
				alert("Sorry, only smaller than 5MB file can be uploaded.");
				history.back();
			</script>
<?php
		}
	
		//file uploading part
		if(move_uploaded_file($file['tmp_name'], $upload_directory.$name_save))
		{
			$query = $connect->prepare("update board set title=?, content=?, date=?, name_orig=?, name_save=?");
			$query->bind_param("sssss", $title, $content, $date, $file_name, $name_save);
			$result = $query->execute();

			if($result)
			{
?>
				<script>
					alert("Post has been modified sucessfully.");
					location.replace("./view.php?number=<?=$number?>");
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
	//if the file do not exist
	else
	{
		$query = $connect->prepare("update board set title=?, content=?, date=? where number=?");
		$query->bind_param("sssi", $title, $content, $date, $number);
		$result = $query->execute();
	
		if($result)
		{
?>
			<script>
				alert("Post has been modified sucessfully.");
				location.replace("./view.php?number=<?=$number?>");
			</script>
<?php  
		}
		else
		{
			echo "fail";
		}
	}
?>
