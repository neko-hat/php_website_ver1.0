<!--
::: CONTENTS :::
Project		: php_website
Version		: 1.0
Filename	: view.php
Date		: 2020/01/08
Purpose		: Ready for studying secure coding of WEB(PHP)
Programmer	: Yoobi (ubyung1@gmail.com)
Reviewer	:
-->

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
	$hit = "update board set hit=hit+1 where number=$number";
	$connect->query($hit);
	$query = "select title, content, id, date, hit, star, name_orig from board where number =$number";
	$result = $connect->query($query);
	$rows = mysqli_fetch_assoc($result);

	$sub_query = "select * from sub_board where number =$number order by number desc";
	$sub_result = $connect->query($sub_query);
	$total = mysqli_num_rows($sub_result);
?>
<!-- Simple style -->
<style>
	table
	{
		width: 80%;
		border: 1px solid #444444;
	}
	th, td
	{
		border: 1px solid #444444;
		padding: 10px;
	}
</style>

	<!-- Table start -->
	<table align=center>
		<tr align=center>
			<td colspan="5"><?php echo $rows['title']?></td>
		</tr>
		<tr align=center>
			<td colspan="2">작성자</td>
			<td colspan="3"><?php echo $rows['id']?></td>
		</tr>
		<tr>
			<td colspan="1">조회수</td>
			<td colspan="1"><?php echo $rows['hit']?></td>
			<td colspan="1">추천수</td>
			<td colspan="2"><?php echo $rows['star']?></td>
		</tr>
		
		<tr>
			<td colspan="5" valign="top" height="500" style="word-break:break-all">
				<?php echo $rows['content']?>
			</td>
		</tr>
		<tr align=center>
<?php
			if(!strcmp($rows['name_orig'],'0'))
			{
?>
				<td colspan="5">
					No File.
				</td>
<?php
			}
			else
			{
?>
				<td colspan="5">
					Uploaded File :
					<a href="./download.php?file_name=<?=$rows['name_orig']?>"><?php echo $rows['name_orig']?></a>
<?php
			}
?>
				</td>
		</tr>
		<tr>
		<?php	
				while($sub_rows = mysqli_fetch_assoc($sub_result)) //Repeate number of DB rows
				{ 
?>				    
					<tr>
						<td width = "10" align = "center">ID:<?php echo $sub_rows['id']?></td>
						<td width = "100" align = "center"><?php echo $sub_rows['content']?></td>
						<td width = "20" align = "center"><?php echo $sub_rows['date']?></td>
						<td width = "10" align = "center">추천:<?php echo $sub_rows['star']?></td>
						<td width = "1" align = "center"><button onclick="location.href='./star_sub.php?number=<?=$number?>&date=<?=$sub_rows['date']?>'">추천</button><button onclick="location.href='./delete_sub.php?number=<?=$number?>&date=<?=$sub_rows['date']?>'">삭제</button></td>
					</tr>
<?php
					$total--;
				}
?>
		</tr>
		<tr>
			<form method = "GET" action = "write_action_sub.php" enctype = "multipart/form-data">
		<table align = "center" width = "850" border = "0">
				<td>Written by</td>
				<td>
					<input type = "hidden" name = "number" value ="<?=$number?>">
					<input type = "hidden" name = "name" value = "<?=$_SESSION['userid']?>"><?=$_SESSION['userid']?>
				</td>
			</tr>
			<tr>
				<td>Content</td>
				<td>
					<textarea name = "content" cols = "85" rows = "5"></textarea>
				</td>
			</tr>
			<tr>
				<td colspan = "2" align = "center">
					<input type = "submit" value = "댓글작성">
				</td>
			</tr>
		</table>
	</form>
		</tr>
	</table>
	<!-- Table end -->


	<!-- Modify & Delete -->
	<br>
	<center>
		<button onclick="location.href='./star.php?number=<?=$number?>'">추천</button>
		<button onclick="location.href='./board_list.php'">Back to List</button>
		<button onclick="location.href='./modify.php?number=<?=$number?>&id=<?=$_SESSION['userid']?>'">Modify</button>
		<button onclick="location.href='./delete.php?number=<?=$number?>&id=<?=$_SESSION['userid']?>'">Delete</button>
	</center>



