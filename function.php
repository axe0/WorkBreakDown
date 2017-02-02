<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "workbreakdown");

if(!isset($_SESSION['q']))
	$_SESSION['q'] = null;

$GLOBALS['conn'] = $conn;

function MoSCoW(){
	$MoSCoW = array("Must", "Should", "Could", "Won't");

	foreach($MoSCoW as $cat => $value){
		echo '<option value="'.$value.'">'.$value.'</option>'; 
	}
}

function DumpVar($bool){
	if($bool == true){
		echo" <pre>";
		var_dump($_SESSION['q']);
		echo" </pre>";
	}
}

function Delete(){
	if(isset($_GET['id'])){	
		$queryDelete = 'DELETE FROM `workbreakdown`.`'.$_GET['p'].'` WHERE id = '.$_GET['id'].';';
		$_SESSION['q'][] = 'DELETE FROM `workbreakdown`.`'.$_GET['p'].'` WHERE id = '.$_GET['id'].';';
		
		if(mysqli_query($GLOBALS['conn'], $queryDelete)){
			echo '<div align=center style=color:red;>Taak met succes verwijdert: '.$queryDelete.'</div>';
		}
		else{
			die('<div align=center>error: '.mysqli_error($GLOBALS['conn']).'</div>');
		}
	}
}

function UpdateSingleRow(){
	if(isset($_POST['update'])){
		/*$numTasks = count($_POST['id']);
		for($n = 1; $n <= $numTasks; $n++ )
		{*/
			$updateQuery = "UPDATE `".$_GET['p']."` SET `Taak` = '".$_POST['taak']."', `Predecessor` = '".$_POST['predecessor']."', `Developer` = ' ".$_POST['developer']."', `Plan` = '".$_POST['plan']."', `Check` = '".$_POST['check']."', `Act` = '".$_POST['act']."' WHERE `id` = '".$_POST['id']."';";
			//$updateQuery = "UPDATE `".$_GET['p']."` SET `Taak` = '".$_POST['taak'][$n]."', `Predecessor` = '".$_POST['predecessor'][$n]."', `Developer` = ' ".$_POST['developer'][$n]."', `Plan` = '".$_POST['plan'][$n]."', `Check` = '".$_POST['check'][$n]."', `Act` = '".$_POST['act'][$n]."' WHERE `id` = '".$_POST['id'][$n]."' WHERE id='".$_GET['id']."';";
			DumpVar($updateQuery, 0);
			mysqli_query($GLOBALS['conn'], $updateQuery);
		//}
		$_SESSION['q'][] = $updateQuery;
	}
}

function AddRow(){
	if(isset($_POST['send'])){
		//$numTasks = count($_POST['id']);
		
		//for($n = 1; $n <= $numTasks; $n++ )
		//{
			$queryInsert = 'INSERT INTO `workbreakdown`.`'.$_GET['p'].'`(`Taak`, `Predecessor`, `Developer`, `MoSCoW`, Plan) VALUES ("'.$_POST['taak'].'", "'.$_POST['predecessor'].'", "'.$_POST['developer'].'", "'.$_POST['moscow'].'", "'.$_POST['plan'].'");';		
		//}
		
		if(mysqli_query($GLOBALS['conn'], $queryInsert)){
			echo '<div align=center>Taak met succes toegevoegd</div>';
		}
		else{
			die('<div align=center>error: '.mysqli_error($GLOBALS['conn']).'</div>');
		}
		$_SESSION['q'][] = $queryInsert;
	}
}

function CreateTable(){
	if(isset($_POST['send'])){
		for($i = 0; $i < count($_SESSION['inputs'][0]); $i++){	
			
			if(empty($_SESSION['inputs'][1][$i]) || empty($_SESSION['inputs'][2][$i]) || empty($_SESSION['inputs'][3][$i]) || empty($_SESSION['inputs'][4][$i]) || empty($_SESSION['inputs'][5][$i])){
				if($i >= count($_SESSION['inputs'][0])){				
					echo "One or multiple textboxes are empty, please ensure everything is filled in properly<br>";
				}
			}
			else{
				$CreateNewTable = "CREATE TABLE IF NOT EXISTS `".$_POST['projectname']."` (
				`id` int(255) PRIMARY KEY NOT NULL AUTO_INCREMENT,
				`Taak` varchar(255) NOT NULL,
				`Predecessor` varchar(255) NOT NULL,
				`Developer` varchar(255) NOT NULL,
				`MoSCoW` varchar(1) NOT NULL,
				`Plan` datetime NOT NULL,
				`Do` datetime NULL,
				`StartTime` datetime NULL,
				`FinishTime` datetime NULL,
				`DifferenceTime` time NULL,
				`CheckDifferenceTime` time NULL,
				`Check` varchar(255) NULL,
				`Act` varchar(255) NULL
				) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;";
				
				$queryInsert = "INSERT INTO `workbreakdown`.`$_POST[projectname]` (`Taak`, `Predecessor`, `Developer`, `MoSCoW`, `Plan`) VALUES ('{$_SESSION['inputs'][1][$i]}', '{$_SESSION['inputs'][2][$i]}', '{$_SESSION['inputs'][3][$i]}', '{$_SESSION['inputs'][4][$i]}', '{$_SESSION['inputs'][5][$i]}');";
				CreateTableInput($CreateNewTable, $queryInsert);
			}
		}
		$queryDelete = 'DELETE FROM `workbreakdown`.`'.$_POST['projectname'].'` WHERE `Taak` = "" OR `Predecessor` = "" OR `Developer` = "";<br>';
		DeleteEmptyEntries($queryDelete);
		
		$_SESSION['q'][] = $CreateNewTable;
		$_SESSION['q'][] = $queryInsert;
		$_SESSION['q'][] = $queryDelete;
	}
}

function DeleteEmptyEntries($DeleteQuery){
	mysqli_query($GLOBALS['conn'], $DeleteQuery);
}

function CreateTableInput($Table, $Query){
	if(mysqli_query($GLOBALS['conn'], $Table)){
		//echo "Database created<br>";
		if(!mysqli_query($GLOBALS['conn'], $Query)){
			//echo('<br><br>error: '.mysqli_error($GLOBALS['conn']));
			//echo('error: '.mysqli_error($GLOBALS['conn']));
		}
		//echo 'Data inserted<br>';
		//echo $Query;
		//echo('<script>setTimeout(function (){window.location.href = "/WorkBreakDown/Index.php";}, 3000);</script>');
	}else{
		die(mysqli_error($GLOBALS['conn']));
	}
}

function UpdateTime(){
	if(isset($_GET['time'])){
		$queryUpdateTime = "UPDATE `workbreakdown`.`".$_GET['p']."` SET `StartTime` = NOW() WHERE `".$_GET['p']."`.`id` = ".$_GET['id'].";";
		$_SESSION['q'][] = $queryUpdateTime;
		if(mysqli_query($GLOBALS['conn'], $queryUpdateTime)){
			//header('Location:http://localhost/WorkBreakDown/Overview.php?p='.$_GET['p']);
			//echo '<div align=center>Tijd met succes geupdated: '.$queryUpdateTime.'</div>';
		}
		else{
			die('<div align=center>error: '.mysqli_error($GLOBALS['conn']));
		}
	}
	if(isset($_GET['timer'])){
		$queryUpdateTimer = "UPDATE `workbreakdown`.`".$_GET['p']."` SET `FinishTime` = NOW() WHERE `id` = ".$_GET['id'].";";
		$_SESSION['q'][] = $queryUpdateTimer;
		if(mysqli_query($GLOBALS['conn'], $queryUpdateTimer)){
			//echo '<div align=center>Tijd stop met succes geupdated: '.$queryUpdateTimer.'</div>';
			//header('Location:http://localhost/WorkBreakDown/Overview.php?p='.$_GET['p']);
		}
	}
}

function CalculateTime($id){
	$query = "SELECT * FROM `".$_GET['p']."` WHERE `id`=".$id;	
	
	$queryTotalTime = "UPDATE `workbreakdown`.`".$_GET['p']."` set `Do` = (SELECT TIMEDIFF(`FinishTime`, `StartTime`)), `DifferenceTime` = (SELECT TIMEDIFF(`FinishTime`, `StartTime`)) WHERE `id` = $id";
	$_SESSION['q'][] = $queryTotalTime;
	mysqli_query($GLOBALS['conn'], $queryTotalTime);
	
	$queryCheckDifferenceTime = "SELECT * FROM `workbreakdown`.`".$_GET['p']."` WHERE `DifferenceTime` = `CheckDifferenceTime` AND `id` = ".$id;
	$_SESSION['q'][] = $queryCheckDifferenceTime;
	
	if(mysqli_num_rows(mysqli_query($GLOBALS['conn'], $queryCheckDifferenceTime)) == 0){
	$queryUpdateCheckDifferenceTime = "UPDATE `workbreakdown`.`".$_GET['p']."` set `CheckDifferenceTime` = (SELECT TIMEDIFF(`FinishTime`, `StartTime`)) WHERE `id` = ".$id;
	$_SESSION['q'][] = $queryUpdateCheckDifferenceTime;
		if(mysqli_query($GLOBALS['conn'], $queryUpdateCheckDifferenceTime)){
			$queryAddTime = "UPDATE `workbreakdown`.`".$_GET['p']."` set `Do` = `Do` + `DifferenceTime` WHERE `id` = ".$id;
			$_SESSION['q'][] = $queryAddTime;
			$result = mysqli_query($GLOBALS['conn'], $query);
			
			if(mysqli_query($GLOBALS['conn'], $queryAddTime)){
				while($data = mysqli_fetch_assoc($result)){
					echo $data['Do'];
				}
				header('Location:http://localhost/WorkBreakDown/Overview.php?p='.$_GET['p']);
			}
		}
	}
	else{
		$result = mysqli_query($GLOBALS['conn'], $query);
		
		while($data = mysqli_fetch_assoc($result)){
			echo $data['Do']; 	
		}
	}
}

function ColorTime($id){
	//$qCheck = "SELECT * FROM `".$_GET['p']."` WHERE `Do` > `Plan` AND `id` = ".$id;
	$qCheck = "SELECT IF(`Do` > `Plan`, 'Do', 'Plan') as tijd from `".$_GET['p']."` WHERE `id` = ".$id;
	$qCheckResult = mysqli_query($GLOBALS['conn'], $qCheck);
	while($data = mysqli_fetch_assoc($qCheckResult)){
		
		echo $data['tijd'];
		?>
		<script>
			var timeDo = document.getElementByID('do');
			if($("#do:contains(Do)").text()){
				//$("#do").html($("#do").html().split("Do").join(""));
				$("#do").css('background-color: red');
			}
			/*if(!$("#do:contains(Plan)").text()){
				$("#do").css('background-color', 'red');
			}
			if($("#do:contains(Plan)").text()){
				$("#do").html($("#do").html().split("Plan").join(""));
			}*/
			
			//$("#do").css('background-color', 'red');
			//alert('For 1 or more jobs you have invested more time than planned!');
			//$('label[for=do]').css('background-color', 'red');
		</script>
		<?php
	}
}
?>