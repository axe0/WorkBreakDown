<?php
require_once 'function.php';

if($_GET['p'] == NULL){
	echo('<script>setTimeout(function (){window.location.href = "/WorkBreakDown/Index.php";}, 0);</script>');
}

echo '<pre>';
//var_dump($_SESSION['q']);
echo '</pre>';
//unset($_SESSION['q']);
?>
<html>
<head>
<title>Work Break Down Home - Martijn Jager</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<meta name="" content="">
</head>
<body>
<div align="center"><a href="Index.php">Kies ander project</a></div>
<form action="Update.php?p=<?php echo $_GET['p']; ?>" method="post">
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
	$msqliResult = mysqli_query($GLOBALS['conn'], 'SELECT * FROM `'.$_GET['p'].'`;');
	while($data = mysqli_fetch_assoc($msqliResult)){
	?>
		<tr bgcolor="#7f7f7f">
			<td align="center" width="10px">
				<label><?php echo $data['id']; ?></label>
			</td>
			<td align="center" width="100px" >
				<label><?php echo $data['Taak']; ?></label>
			</td>
			<td align="center" width="100px" >
				<label><?php echo $data['Predecessor']; ?></label>
			</td>
			<td align="center" width="100px" >
				<label><?php echo $data['Developer']; ?></label>
			</td>
			<td align="center" width="100px" >
				<label><?php echo $data['MoSCoW']; ?></label>
			</td>
			<td align="center" width="100px" >
				<label id="plan" for="plan"><?php echo $data['Plan']; ?></label>
			</td>
			<?php
			if(($data['Do'] > $data['Plan']) === TRUE){
				echo "<td style='background-color: red;' align='center' width='100px' >
					<label id=do for=do[$data[id]]>";
				UpdateTime();
				CalculateTime($data['id']);
				echo "</label>
					</td>";
			}
			if(($data['Do'] <= $data['Plan']) === true){
				echo "<td align='center' width='100px' >
					<label id=do for=do[$data[id]]>";
				UpdateTime();
				CalculateTime($data['id']);
				echo "</label>
					</td>";
			}
			?>
			<td align="center" width="100px" >
				<label id="timeCurrent<?php echo $data['id']; ?>"><?php echo $data['StartTime']; ?></label>
			</td>
			<td align="center" width="100px" >
				<label id="timeCurrent<?php echo $data['id']; ?>"><?php echo $data['FinishTime']; ?></label>
			</td>
			<td align="center" width="100px" >
				<label><?php echo $data['Check']; ?></label>
			</td>
			<td align="center" width="100px" >
				<label><?php echo $data['Act']; ?></label>
			</td>
			<td bgcolor="white">
				<?php
				if($data['StartTimeOn'] == '1'){
					?>
					<a href="Overview.php?p=<?php echo($_GET['p']); ?>&time=1&id=<?php  echo $data['id']; ?>" class="starttijd">Start tijd</a><br>
					<?php
				}
				if($data['EndTimeOn'] == '1'){
					?>
					<a href="Overview.php?p=<?php echo($_GET['p']); ?>&timer=1&id=<?php  echo $data['id']; ?>" class="stoptijd">Stop tijd</a><br>
					<?php
				}
				?>
				<a href="Update.php?p=<?php echo $_GET['p']; ?>&id=<?php  echo $data['id']; ?>">Update</a><br>
				<a href="Delete.php?p=<?php echo $_GET['p']; ?>">Verwijder taak</a>
			</td>
		</tr>
	<?php
	}
	?>
	</table>
	<div align="center">
	<a href="AddRow.php?p=<?php echo $_GET['p']; ?>">Voeg een taak toe</a><br><br>
	<a href="Overview.php?p=<?php echo $_GET['p']; ?>" class="reloadPage">Herlaad pagina</a>
	<br>
	<br>
	Is er een wijziging niet zichtbaar? Herlaad de pagina een paar keer.</div>
</form>
</body>
</html>