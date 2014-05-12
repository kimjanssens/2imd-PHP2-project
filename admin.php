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
<body onload="load()">
	<div class="container">
		<h2>Add a restaurant</h2>
		<?php
		    $r->GetRestaurants();
		?>
		
        <div class="container" id="restaurantdata">
            
        </div>
        <form action="" method="post">
			<?php  
				if (isset($error)) {
					echo "<p class='bg-danger'>$error</p>";
				}
				if (!empty($feedback)) {
					echo "<p class='bg-success'>$feedback</p>";
				}
			?>
			<input type="text" name="restaurantname" class="form-control" placeholder="Restaurant naam">
			<input type="text" name="street" class="form-control" placeholder="Street">
			<input type="text" name="number" class="form-control" placeholder="Number">
			<input type="text" name="city" class="form-control" placeholder="Stad">
			<input type="submit" value="Add" class="btn btn-primary" name="btnAddRestaurant">
		</form>
	</div>
	<script>
	       function load(){
	            $.ajax({
                    type: "POST",
                    url: "ajax/get_restaurant.php",
                    data: {restaurant: $('#restaurants').val()},
                    dataType: "json"
                })
                .done(function( msg ){
                    for(var i=0; i<msg.restaurant_name.length; i++)
                    {
                        $("#restaurantdata").html("<h1>"+msg.restaurant_name+"</h1>");
                    }
                });
	        };
	        $('#restaurants').on('change', function(e){
	            load();
                e.preventDefault();
	        });
	</script>
</body>
</html>