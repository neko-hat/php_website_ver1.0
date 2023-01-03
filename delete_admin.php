<!--
::: CONTENTS :::
Project		: php_website
Version		: 1.0
Filename	: delete.php
Date		: 2020/01/05
Purpose		: Ready for studying secure coding of WEB(PHP)
Programmer	: Yoobi (ubyung1@gmail.com)
Reviewer	:
-->

<?php
	//Connect MYSQL & get INFO using $number
	$connect = mysqli_connect("localhost", "yoobi", "toor", "php_db") or die("connect fail");
	$id = $_GET["id"];
	$number = $_GET["number"];
	$query = "select title, content, date, id, name_orig, name_save from board where number=$number";
	$result = $connect->query($query);
	$rows = mysqli_fetch_assoc($result);

	$title = $rows['title'];
	$content = $rows['content'];
	$usrid = $rows['id'];
	
	$filename = './up_file/'.$rows['name_save'];
	$file_check = 0;
	session_start();


	$URL = "./board_list_admin.php";

	//Check SESSION userid with number's userid
	if($id=='admin')
	{
		//Delete Post
		$query = "delete from board WHERE number=$number";
		$result = $connect->query($query);

		if($result)
		{
			//Check file's existence
			$file_check = strcmp($rows['name_orig'], '0');
			if($file_check)
			{
				//Delete file
				unlink($filename);
			}
?>		
		        <script>
				alert("<?php echo "The post successfully deleted."?>");
				location.replace("<?php echo $URL?>");
			</script>
<?php
		}
	}
	else
	{
?>
		<script>
			alert("Permission Denied.");
			history.back();
		</script>
<?php
	}
?>