<?php
$restauID = $_GET['id'];
include_once("classes/Resto.class.php");
$t = new Resto();
$t->RestoId = $restauID;

?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php $t->GetAllTables(); ?>
</body>
</html>