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
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/screen.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

</head>
<body>
<div class="container">
	<h2>All the listed tables</h2>
	<ul id="tables">
	<?php $t->GetAllTables(); ?>
	</ul>
</div>
</body>
</html>