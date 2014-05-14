<?php
	session_start();
	include_once("classes/Reservation.class.php");
	$table = $_GET['table'];
	$r = new Reservation();
	$r->Remove();
	$r->Table = $table;
	if (!empty($_POST)) {
		try {
			$r->Table = $table;
			$r->Hours = $_POST['hours'];
			$r->People = $_POST['people'];
			$r->User = $_SESSION['name'];
			$r->Save();
			$feedback = "Thank you for your reservation ".$_SESSION['name'];
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
	}
?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>All reservations per table</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/screen.css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="container">
	<h2>Choose your reservation time for this table</h2>
	<ul id="tables">
		<?php
		$r->Getall();
		?>
	</ul>
	<form action="#" method="post">
		<?php
	if (isset($feedback)) {
		echo "<p class='bg-succes'>".$feedback."</p>";
	}
	if(isset($error)){
		echo "<p class='bg-danger'>".$error."</p>";
	}
	?>
		<label for="hours">Book this table at </label>
		<select name="hours">
			<option value="12">12:00</option>
			<option value="14">14:00</option>
			<option value="16">16:00</option>
			<option value="18">18:00</option>
			<option value="20">20:00</option>
			<option value="22">22:00</option>
		</select>
		<label for="people">for </label>
		<select name="people">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
		</select>
		<input type="submit" value="Book" class="btn btn-danger">
	</form>
</div>
</body>
</html>