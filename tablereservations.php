<?php
	include_once "classes/Db.class.php";
	$table = $_GET['table'];
	$db = new Db();
    $sql = "SELECT * FROM tbl_reservations WHERE table_nr = '".$table."';";
	$results = $db->conn->query($sql);
	foreach ($results as $result) {
		echo "<li>";
		echo $result['hour'];
		echo "</li>";
	}

?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>All reservations per table</title>
</head>
<body>
<div class="container">
	<ul>
	<?php

	?>
	</ul>
</div>
</body>
</html>