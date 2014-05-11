<?php  
	$feedback = "";
	$feedbackLogin = "";
	session_start();
	if ($_SESSION['type']=='admin') {
        include_once("classes/Resto.class.php");
        $r = new Resto();
        
        if(isset($_POST['btnAddRestaurant']))
        {
            $r->Name = $_POST["restaurantname"];
			$r->Street = $_POST["street"];
			$r->Number = $_POST["number"];
			$r->City = $_POST["city"];
            $r->Save();
            $feedback = "Restaurant "+$_POST["restaurantname"]+" geregistreerd.";
        }
	}
	else
    {
        header('Location: index.php');
    }
?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Restaurant web app</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/screen.css">
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
</head>
<body>
	<div class="container">
		<h1>Restaurant app</h1>
		<?php
		    $r->GetRestaurants();
		?>
		<form action="" method="post">
			<?php  
				if (isset($error)) {
					echo "<p class='bg-danger'>$error</p>";
				}
				if (!empty($feedback)) {
					echo "<p class='bg-success'>$feedback</p>";
				}
			?>
			<h2>Voeg een restaurant toe</h2>
			<input type="text" name="restaurantname" class="form-control" placeholder="Restaurant naam">
			<input type="text" name="street" class="form-control" placeholder="Street">
			<input type="text" name="number" class="form-control" placeholder="Number">
			<input type="text" name="city" class="form-control" placeholder="Stad">
			<input type="submit" value="Maak restaurant" class="btn btn-primary" name="btnAddRestaurant">
		</form>
	</div>
</body>
</html>