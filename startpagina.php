<?php
    session_start();
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    include_once "Facebook/fbmain.php";
    include_once "classes/Resto.class.php";
    $r = new Resto();
?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>All restaurants</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/screen.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="container">
    <div id="profile">
        <p>Welcome <?php echo $name ?>, please choose a restaurant</p>
    </div>
	<h2>Choose a restaurant</h2>
	<ul id="allRestaurants">
    <?php
    $r->GetAll();
    ?>  
    </ul>
	</div>
</body>
</html>