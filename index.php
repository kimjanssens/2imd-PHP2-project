<?php
    include_once "Facebook/fbmain.php";
    include_once("classes/User.class.php");
    $feedbackLogin = "";
    if (!empty($_POST['login'])) {
    	session_start();
    	$_SESSION['name'] = $_POST['name'];
    	$_SESSION['email'] = $_POST['email'];
    	header("Location: startpagina.php");
    }
    if(!empty($_POST['btnLogin']))
	{
		try {
			$u = new User();
			$u->Name = $_POST['username'];
			$u->Password = $_POST['loginPassword'];
			$u->Login();
			
            $feedbackLogin = "Inloggen gelukt!";
			
		} catch (Exception $e) {
			$errorLogin= $e->getMessage();
		}
	}
?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/screen.css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script>
		$(document).ready(function(){
			$("#login").hide();
			$("#fb-login").click(function(){
				$("#login").slideToggle();
			});
		});
	</script>
</head>
<body>
<div class="container">
	<div id="loginWindow">
		<a href="#" id="fb-login"><img src="images/fb-logo.png" alt="fb-logo">Login with Facebook</a>
		<form action="" method="post" id="login">
			<input type="text" placeholder="name" name="name">
			<input type="text" placeholder="email" name="email">
			<input type="submit" value="login" name="login" class="btn btn-danger">
		</form>
		<p>Or login as restaurant owner</p>
		<form action="" method="post">
			<?php  
				if (isset($errorLogin)) {
					echo "<p class='bg-danger'>$errorLogin</p>";
				}
				if (!empty($feedbackLogin)) {
					echo "<p class='bg-success'>$feedbackLogin</p>";
				}
			?>
			<input type="text" name="username" class="form-control" placeholder="Username">
			<input type="password" name="loginPassword" class="form-control" placeholder="Password">
			<input type="submit" value="Login" class="btn btn-danger" name="btnLogin">
			<a href="register.php">Click here to register</a>
		</form>
	</div>
</div>
    
</body>
</html>