<?php
require 'function.php';

Delete();
?>
<html>
<head>
<title>Work Break Down Home - Martijn Jager</title>
<meta name="" content="">
</head>
<body>
<form action="Delete.php?p=<?php echo $_GET['p']; ?>" method="post">
	<table align="center">
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
				<b>Do (In minutes)</b>
			</td>
			<td width="100px">
				<b>Start tijd</b>
			</td>
			<td width="100px">
				<b>Stop tijd</b>
			</td>
			<td width="100px">
				<b>Check</b>
			</td>
			<td width="100px">
				<b>Act</b>
			</td>
		</tr>
	<?php
	$msqliQuery = mysqli_query($GLOBALS['conn'], 'SELECT * FROM `'.$_GET['p'].'`;');
	while($data = mysqli_fetch_assoc($msqliQuery)){
	?>
		<tr bgcolor="#7f7f7f">
			<td align="center" width="10px" height="60px">
				<label><?php echo $data['id']; ?></label>
			</td>
			<td width="100px" height="60px">
				<label><?php echo $data['Taak']; ?></label>
			</td>
			<td width="100px" height="60px">
				<label><?php echo $data['Predecessor']; ?></label>
			</td>
			<td width="100px" height="60px">
				<label><?php echo $data['Developer']; ?></label>
			</td>
			<td width="100px" height="60px">
				<label><?php echo $data['MoSCoW']; ?></label>
			</td>
			<td width="100px" height="60px">
				<label><?php echo $data['Plan']; ?></label>
			</td>
			<td width="100px" height="60px">
				<label><?php echo $data['Do']; ?></label>
			</td>
			<td width="100px" height="60px">
				<label id="timeCurrent<?php echo $data['id']; ?>"><?php echo $data['StartTime']; ?></label>
			</td>
			<td width="100px" height="60px">
				<label id="timeCurrent<?php echo $data['id']; ?>"><?php echo $data['FinishTime']; ?></label>
			</td>
			<td width="100px" height="60px">
				<label><?php echo $data['Check']; ?></label>
			</td>
			<td width="100px" height="60px">
				<label><?php echo $data['Act']; ?></label>
			</td>
			<td bgcolor="white">
				<a href="Update.php?p=<?php echo $_GET['p']; ?>&id=<?php  echo $data['id'];  ?>">Update</a><br>
				<a href="AddRow.php?p=<?php echo $_GET['p']; ?>">Voeg een taak toe</a><br>
				<a href="Delete.php?p=<?php echo $_GET['p']; ?>&id=<?php echo $data['id']?>">Verwijder taak</a>
			</td>
		</tr>
	<?php
	}?>
	</table>
	<div align="center"><a href="Overview.php?p=<?php echo $_GET['p']; ?>">Terug naar overview</a></div>
</form>
</body>
</html>