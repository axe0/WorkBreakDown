<?php
require 'function.php';
?>
<html>
<head>
<title>Work Break Down Home - Martijn Jager</title>
<meta name="" content="">
</head>
<body>
<form action="AddRow.php?p=<?php echo $_GET['p']; ?>" method="post">
	<table>
		<tr>
			<td width="100px">
				<b>Taak</b>
			</td>
			<td width="100px">
				<b>Predecessor</b>
			</td>
			<td width="100px">
				<b>Developer</b>
			</td>
			<td width="100px">
				<b>MoSCoW</b>
			</td>
			<td width="100px">
				<b>Plan (In minuten)</b>
			</td>
		</tr>
		<tr bgcolor="#7f7f7f">
			<td width="100px" height="60px">
				<input type="text" name="taak" class="taak"/>
			</td>
			<td width="100px" height="60px">
				<input type="text" name="predecessor" class="predecessor"/>
			</td>
			<td width="100px" height="60px">
				<input type="text"name="developer" class="developer"/>
			</td>
			<td width="100px" height="60px">
				<select name="moscow" class="moscow"><?php
					MoSCoW();
				?></select>
			</td>
			<td width="100px" height="60px">
				<input type="text" name="plan" class="plan" id="plan"/>
			</td>
		</tr>
		<tr>
			<td>
				<input type="submit" value="Opslaan" name="send" id="send"/>
			</td>
		</tr>
	</table>
	<?php
		AddRow();
	?>
	<br>
	<a href="Overview.php?p=<?php echo $_GET['p']; ?>">Terug naar overview</a>
</form>
</body>
</html>