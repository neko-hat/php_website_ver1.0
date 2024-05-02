<?php
	session_start();
?> 
<html>
	<head>
		<meta charset='utf-8'>
	</head>

	<body>
<?php
	//If SESSION is not exist
	if(!isset($_SESSION["userid"]))	
	{
?>
		<center>
			<form method='get' action='./login_action.php'>
				<input name="id" type="text" placeholder="ID" required autofocus><br>
				<input name="pw" type="password" placeholder="PASSWORD"><br><br>
				<input type="submit" value="SIGN IN"><br>
			</form>
			<button id="join" onclick="location.href='./join.html'">SIGN UP</button>
		</center>
<?php
	} else if ($_SESSION['userid'] === "admin") {
?>
		<script>
			window.open('./board_list_admin.php', target="_blank");
		</script>
<?php
	} else {
		
?>
		<center>
			Welcome! <?=$_SESSION["userid"]?><br><br>
			<button onclick="location.href='./change_pw.php'">비밀번호 변경</button>
			<button onclick="location.href='./logout.php'">SIGN OUT</button>
		</center>
<?php
	}
?>
	</body>
</html>



