<?php  
	$feedback = "";
	$feedbackLogin = "";
	session_start();
	if ($_SESSION['type']=='admin') {
        include_once("classes/Resto.class.php");
        $r = new Resto();
        
        $restaurantId = $_SESSION['currentRestaurantId'];
        $restaurantArray = $r->GetRestaurantDetails($restaurantId);
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
	<script src="js/admin.js" type="text/javascript"></script>
</head>
<body onload="load()">
	
	<?php include_once("includes/nav_include.php"); ?>
	<div class="container">
		<?php
		    $r->GetRestaurants();
		    echo "<h2>".$restaurantArray[0]['name']." details</h2>"; 
		?>
		
        <div class="container" id="restaurantdata">
            
        </div>
	</div>
</body>
</html>