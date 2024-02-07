<html>
<head>
<style>
	body {
		background-color: white;
		color: black;
		font-family: Geneva, Verdana, Tahoma;
		font-size: 9pt;
	}

	table {
		width: 150pt;
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
		background-image: url('pasek.gif');
		color: black;
		font-family: Geneva, Verdana, Tahoma;
		font-size: 9pt;
		border-color: rgb(25, 25, 25);
		border-style: solid;
		border-width: 1pt;
		padding-left: 5pt;
	}

	input {
		background-color: #FFFFFF;
		color: black;
		font-family: Geneva, Verdana, Tahoma;
		font-size: 9pt;
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
<table>
	<tr>
		<td class="title">
			<b>Subskrypcja Gadu Gadu</b>
		</td>
	</tr>
	<tr>
		<td>
			<form action="subscript.php" method="post">
			<input type="text" name="uid" maxlength="11"><br/>
			<input type="checkbox" name="mode" value="del"> Usun moj numer<br/>
			<input type="submit" name="submit" value="Action" style="background-color: rgb(240, 240, 240);">
		</td>
	</tr>
</table>
</form>
</body>
</html>