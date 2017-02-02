<?php
require 'function.php';

$_SESSION['inputs'] = NULL;

if(isset($_POST['send'])){
	$_SESSION['inputs'] = [
		0 => isset($_POST['id']) ? $_POST['id'] : '',
		1 => isset($_POST['taak']) ? $_POST['taak'] : '',
		2 => isset($_POST['predecessor']) ? $_POST['predecessor'] : '',
		3 => isset($_POST['developer']) ? $_POST['developer'] : '',
		4 => isset($_POST['moscow']) ? $_POST['moscow'] : '',
		5 => isset($_POST['plan']) ? $_POST['plan'] : ''
	];
}

CreateTable();
?>
<html>
<head>
<title>Work Break Down Home - Martijn Jager</title>
<meta name="" content="">
</head>
<body>
<form action="" method="post">
	<table>
	<tr>
		<td>
			<b>Project Name:</b><br>
			<input type="text" name="projectname" class="projectname" id="projectname"/>
		</td>
	</tr>
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
		</tr>
		<?php
		for($i = 0; $i < 10; $i++){
			echo "<tr bgcolor=#7f7f7f>";
				echo "<td width=10px height=60px>";
					echo "<input type=text  value=''".$_SESSION['inputs'][0][$i]."'' name=id[] class=id/>";
				echo "</td>";
				echo "<td width=100px height=60px>";
					echo "<input type=text  value='".$_SESSION['inputs'][1][$i]."' name=taak[] class=taak />";
				echo "</td>";
				echo "<td width=100px height=60px>";
					echo "<input type=text  value='".$_SESSION['inputs'][2][$i]."' name=predecessor[] class=predecessor />";
				echo "</td>";
				echo "<td width=100px height=60px>";
					echo "<input type=text  value='".$_SESSION['inputs'][3][$i]."' name=developer[] class=developer />";
				echo "</td>";
				echo "<td width=100px height=60px>";
					echo "<select value='".$_SESSION['inputs'][4][$i]."' name=moscow[] class=moscow>";
						MoSCoW();
					echo "</select>";
				echo "</td>";
				echo "<td width=100px height=60px>";
					echo "<input type=datetime-local  value='".$_SESSION['inputs'][5][$i]."' name=plan[] class=plan/>";
				echo "</td>";
			echo "</tr>";
		}
		?>
		<tr>
			<td>
				<input type="submit" value="Opslaan" name="send" id="send"/>
			</td>
		</tr>
	</table>
</form>
</body>
</html>