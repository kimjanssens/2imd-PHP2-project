<?php
    session_start();
    if(isset($_SESSION['loggedin']))
    {
        include_once("classes/Resto.class.php");
        $r = new Resto();
        
        if($_SESSION['type']== 'admin')
        {
            $restaurantId = $_GET['id'];
            $ownerId = $_GET['userid'];
            
            if($ownerId == $_SESSION['eigenId'])
            {
                $restaurantArray = $r->GetRestaurantDetails($restaurantId);
            }
            
            else
            {
                header('Location: admin.php');
            }
        }
        
        
    }
    else
    {
        header('Location: login.php');
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
	
    <?php
        if($_SESSION['type']== 'admin')
        {
            echo "<h1>".$restaurantArray['name']."</h1>";
        }
        
    ?>
</body>
</html>