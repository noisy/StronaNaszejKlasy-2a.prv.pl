<?php
session_start();
if(empty($_SESSION['logged'])){
	header("Location: login.php");
}
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
		width: 100%;
		border-color: black;
		border-width: 1pt;
		border-style: solid;
	}

	td {
		background-color: rgb(250, 250, 250);
		color: black;
		font-family: Geneva, Verdana, Tahoma;
		font-size: 9pt;
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
		height: 26px;
	}

	textarea {
		background-color: white;
		color: black;
		font-family: Geneva, Verdana, Tahoma;
		font-size: 9pt;
		width: 100%;
		height: 100pt;
		border-color: black;
		border-width: 1pt;
		border-style: solid;
	}

	input {
		background-color: rgb(240, 240, 240);
		color: black;
		font-family: Geneva, Verdana, Tahoma;
		font-size: 9pt;
		width: 100%;
		height: 20pt;
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
	<form action="send.php" method="post">
	<table>
		<tr>
			<td class="title">
			Wpisz tresc wiadomosci:
			</td>
		</tr>
		<tr>
			<td style="height: 60pt; vertical-align: top; background-color: rgb(240, 240, 240); border-color: rgb(25, 25, 25); border-style: solid; border-width: 1pt;">
			<img src="attention.gif" align="left"> Uwaga! Zgodnie z ograniczeniami wprowadzonymi przez zespol nadzorujacy rozwoj komunikatora Gadu-Gadu, wiadomosci zawierajace linki, adresy e-mail nie beda dostarczone do osob, ktore nie maja nas w swoich kontaktach. Kazdy uzytkownik, po zapisaniu sie na liste zostal o tym powiadomiony i poproszony o dodanie naszego numeru do swoich kontaktow. Powinnienes liczyc sie z tym, ze wiadomosci zawierajace ww. elementy nie zostana dostarczone do wszystkich. Warto wiec nie podawac pelnych linkow zastepujac np. kropki wyrazeniem (dot), @ wyrazeniem [at] etc.
			</td>
		</tr>
		<tr>
			<td>
			<textarea name="message"></textarea>
			</td>
		</tr>
		<tr>
			<td style="text-align: right">
			<input type="submit" name="send" value="Rozeslij wiadomosc">
			</td>
		</tr>
		<tr>
			<td class="title">
			Raporty:
			</td>
		</tr>
		<tr>
			<td style="height: 60pt; vertical-align: top; background-color: rgb(240, 240, 240); border-color: rgb(25, 25, 25); border-style: solid; border-width: 1pt;">
			<?php include('send_core.php'); ?>
			</td>
		</tr>
		<tr>
			<td class="title" style="text-align: right">
			<a href="login.php?mode=logout">Wyloguj</a>&nbsp;
			</td>
		</tr>
	</table>
	</form>
</body>
</html>

