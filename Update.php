<?php
require 'function.php';

UpdateSingleRow();
?>
<html>
<head>
<title>Work Break Down Home - Martijn Jager</title>
<meta name="" content="">
</head>
<body>
<form action="Update.php?p=<?php echo $_GET['p']; ?>&id=<?php  echo $_GET['id'];  ?>" method="post">
	<table>
		<tr>
			<td width="10px">
				<b>Nr.</b>
			</td>
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
			<td width="100px">
				<b>Check</b>
			</td>
			<td width="100px">
				<b>Act</b>
			</td>
		</tr>
	<?php
	//$connect;
	$msqliResult = mysqli_query($GLOBALS['conn'], 'SELECT * FROM `'.$_GET['p'].'` WHERE id='.$_GET["id"].';');
	while($data = mysqli_fetch_assoc($msqliResult)){
	?>
		<tr bgcolor="#7f7f7f">
			<td align="center" width="10px" height="60px">
				<input type="text" name="id" class="id" value="<?php echo $data['id']; ?>"/>
			</td>
			<td width="100px" height="60px">
				<input type="text" name="taak" class="taak" value="<?php echo $data['Taak']; ?>"/>
			</td>
			<td width="100px" height="60px">
				<input type="text" name="predecessor" class="predecessor" value="<?php echo $data['Predecessor']; ?>"/>
			</td>
			<td width="100px" height="60px">
				<input type="text"name="developer" class="developer" value="<?php echo $data['Developer']; ?>"/>
			</td>
			<td width="100px" height="60px">
				<select name="moscow" class="moscow"><?php
					MoSCoW();
				?></select>
			</td>
			<td width="100px" height="60px">
				<input type="text" name="plan" class="plan" id="plan" value="<?php echo $data['id']; ?>"/>
			</td>
			<td width="100px" height="60px">
				<textarea name="check" class="check"></textarea>
			</td>
			<td width="100px" height="60px">
				<textarea name="act" class="act"></textarea>
			</td>
			<td bgcolor="white">
				<input type="submit" value="UPDATE" id="update" name="update[<?php echo $data['id']; ?>]"></input><br>
				<a href="AddRow.php?p=<?php echo $_GET['p']; ?>">Voeg een taak toe</a>
			</td>
		</tr>
	<?php
	}
	?>
	</table>
	<a href="Overview.php?p=<?php echo $_GET['p']; ?>">Terug naar overview</a>
</form>
</body>
</html>