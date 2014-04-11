<?php  
	include_once("classes/User.class.php");
	$salt = "#WeAreIMD!";
	if (isset($_POST["btnRegister"])) {
		try {
			$user = new User();
			$user->Name = $_POST["nameReg"];
			$user->Street = $_POST["street"];
			$user->City = $_POST["city"];
			$user->Phone = $_POST["phone"];
			$user->Password = md5($_POST["passwordReg"].$salt);
			$user->Save();
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
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
	<script>
	$(document).ready(function(){
		$("#registerForm").hide();
		$("#register").click(function() {
  			$( "#registerForm" ).slideToggle( "slow" );
		});
	});
	</script>
</head>
<body>
	<div class="container">
		<h1>Restaurant app</h1>
		<h2>Login to continue...</h2>
		<form action="" method="post">
			<input type="text" name="name" placeholder="Name">
			<input type="password" name="password" placeholder="Password">
			<input type="submit" value="Login" name="btnLogin">
			
			<a href="#" id="register">Register</a>
	</form>
	<form action="" method="post" id="registerForm">
		<?php  
			if (isset($error)) {
				echo "<p class='bg-danger'>$error</p>";
			}
		?>
		<input type="text" name="nameReg" placeholder="Name">
		<input type="text" name="street" placeholder="Street">
		<input type="text" name="city" placeholder="City">
		<input type="tel" name="phone" placeholder="Phonenumber">
		<input type="password" name="passwordReg" placeholder="Password">
		<input type="submit" value="Register" name="btnRegister">
	</form>
	</div>
</body>
</html>