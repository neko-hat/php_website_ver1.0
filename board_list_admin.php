<?php
	session_start();
?> 
<html>
	<head>
		<meta charset = 'utf-8'>
	</head>
<!-- Simple style -->
<style>
	table
	{
		width: 90%;
		border: 1px solid #444444;
	}
	th, td
	{
		border: 1px solid #444444;
		padding: 10px;
	}	
</style>
	<body>
<?php
	//Check SESSION

	if($_SESSION['userid'] != 'admin')
	{
?>
		<script>
			alert("admin only");
			history.back();
		</script>
<?php
		exit;
	}
		// connect MYSQL
		$connect = mysqli_connect('localhost', 'yoobi', 'toor', 'php_db') or die ("connect fail");
		$query ="select * from board order by number desc";
		$result = $connect->query($query);
		$total = mysqli_num_rows($result);
?>
	
		<h2 align=center>Simple PHP board - ADMIN PAGE</h2>	

		<!-- Table start -->	
		<table align = center>
			<thead align = "center">
				<tr>
					<div id="search_box" align="center">
						<form action="./board_list_search.php" method="get">
							<input type="text" name="search" size="40" required="required" /> <button>검색</button>
						</form>
					</div>
				</tr>
				<br>
				<tr>
					<td width = "50" align="center">Number</td>
					<td width = "500" align = "center">Title</td>
					<td width = "100" align = "center">Written by</td>
					<td width = "200" align = "center">Date</td>
					<td width = "50" align = "center">Views</td>
					<td width = "50" align = "center">Del</td>
				</tr>
			</thead>
			<tbody>
<?php	
				while($rows = mysqli_fetch_assoc($result)) //Repeate number of DB rows
				{ 
?>				      	<tr>
						<td width = "50" align = "center"><?php echo $rows['number']?></td>
						<td width = "500" align = "center">
							<a href = "view.php?number=<?php echo $rows['number']?>"><?php echo $rows['title']?>
						</td>
						<td width = "100" align = "center"><?php echo $rows['id']?></td>
						<td width = "200" align = "center"><?php echo $rows['date']?></td>
						<td width = "50" align = "center"><?php echo $rows['hit']?></td>
						<td width = "50" align = "center"><button align=center onclick="location.href='delete_admin.php?id=admin&number=<?php echo $rows['number']?>'">Del</button></td>
					</tr>
<?php
					$total--;
				}
?>
			</tbody>
		</table>
		<!-- Table end -->

		<br>
		<center>
			<button align=center onclick="location.href='./write.php'">Write</button>
		</center>

		<h4 align=center>- Ver.2020.01.05 -<br>made by yoobi<br><a href = "https://velog.io/@yoobi/about" target="_blank">https://velog.io/@yoobi/about</a></h4>
	</body>
</html>