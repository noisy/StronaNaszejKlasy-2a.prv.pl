<?php
ob_start();

session_start();
require_once('subscript_conf.php');

if(isset($_POST['submit'])){
	if(md5($_POST['password'])==md5(ADMIN_PASSWORD)){
	$_SESSION['logged']=true;
	header("Location: send.php");
	die();
	}else{
	header("Location: ".$PHP_SELF);
	die();
	}
}elseif($_GET['mode']=="logout"){
	unset($_SESSION['logged']);
	header("Location: ".$PHP_SELF);
	die();
}else{
?>
<html>
<head>
<title>Subskrypcja Gadu Gadu</title>
<style>
	body {
		background-color: white;
		color: black;
		font-family: Geneva, Verdana, Tahoma;
		font-size: 9pt;
	}

	table {
		width: 300pt;
		border-color: black;
		border-width: 1pt;
		border-style: solid;
	}

	td {
		background-color: rgb(250, 250, 250);
		color: black;
		font-family: Geneva, Verdana, Tahoma;
		font-size: 9pt;
		text-align: center;
	}

	td.title {
		background-image: url('pasek.jpg');
		color: black;
		font-family: Geneva, Verdana, Tahoma;
		font-size: 9pt;
		border-color: rgb(25, 25, 25);
		border-style: solid;
		border-width: 1pt;
		padding-left: 5pt;
		height: 25px;
	}

	input {
		background-color: #FFFFFF;
		color: black;
		font-family: Geneva, Verdana, Tahoma;
		font-size: 9pt;
		height: 18pt;
		border-color: black;
		border-width: 1pt;
		border-style: solid;
	}
	A:link { color: #000000; }
	A:hover { color: rgb(90, 90, 90); }
	A:visited { color: #000000; }
</style>
</head>
<body>
<center>
<form action="login.php" method="post">
	<table width="200">
		<tr>
			<td class="title">
			Haslo administratora:
			</td>
		</tr>
		<tr>
			<td>
				<input type="password" name="password" maxlength="50"> <input type="submit" name="submit" value="Zaloguj" style="background-color: rgb(240, 240, 240); border-color: black; border-width: 1pt; border-style: solid;">
			</td>
		</tr>
</form>
</center>
</body>
</html>
<?php

}
ob_end_flush();
?>
