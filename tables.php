<?php
    session_start();
    if(isset($_SESSION['loggedin']))
    {
        include_once("classes/Resto.class.php");
        $r = new Resto();
        
        if($_SESSION['type']== 'admin')
        {
            $restaurantId = $_SESSION['currentRestaurantId'];
            $restaurantArray = $r->GetRestaurantDetails($restaurantId);
            
            if(isset($_POST['btnAddTable']))
            {
                $r->Amount = $_POST['tableamount'];
                $r->Seats = $_POST['tableseats'];
                $r->RestoId = $restaurantId;
                $r->SaveTables();
            }
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
	<script src="js/admin.js" type="text/javascript"></script>
</head>
<body>
    <?php include_once("includes/nav_include.php"); ?>
    <div class="container">
	
    <?php
        if($_SESSION['type']== 'admin')
        {
            echo "<h2>Add tables to ".$restaurantArray[0]['name']."</h2>"; 
		    $r->GetRestaurants();
        }
    ?>
    
    <form action="" method="post">
            <select name="tableamount" id="tableamount">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
			<input type="text" name="tableseats" class="form-control" placeholder="Aantal zitplaatsen">
			<input type="submit" value="Voeg tafels toe" class="btn btn-primary" name="btnAddTable">
		</form>
    </div>
</body>
</html>