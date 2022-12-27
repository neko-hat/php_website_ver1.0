<!--
::: CONTENTS :::
Project		: php_website
Version		: 1.0
Filename	: login.php
Date		: 2020/01/05
Purpose		: Ready for studying secure coding of WEB(PHP)
Programmer	: Yoobi (ubyung1@gmail.com)
Reviewer	:
-->

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
	if(isset($_SESSION["userid"]))	
	{
?>
		<center>
			<form method='get' action='./change_pw_action.php'>
				<input name="id" type="hidden" value="<?=$_SESSION['userid']?>">
				<input name="pw" type="password" placeholder="NEW PASSWORD" required autofocus><br><br>
				<input type="submit" value="CHANGE PASSWD"><br>
			</form>
		</center>
		<?php
}
	else
	{
?>
		<center>
			Welcome! <?=$_SESSION["userid"]?><br><br>
			<button onclick="location.href='./change_pw_action.php?id=<?=$_SESSION['userid']?>'">비밀번호 변경</button>
			<button onclick="location.href='./logout.php'">SIGN OUT</button>
		</center>
<?php
	}
?>
	</body>
</html>



