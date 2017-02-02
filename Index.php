<?php
require 'function.php';

$QueryProjects = "show tables from `workbreakdown`;";
$ShowProjects = mysqli_query($GLOBALS['conn'], $QueryProjects);
?>
<html>
<head>
<title>Work Break Down Home - Martijn Jager</title>
<meta name="" content="">
</head>
<body>
<form action="" method="post">
	<?php while($data = mysqli_fetch_array($ShowProjects)){?>
	<a href="Overview.php?p=<?php echo $data[0];?>">Project overview: <?php echo $data[0]."<br>";}?></a><br />
	<a href="CreateNewProject.php">Create new project</a>
</form>
</body>
</html>