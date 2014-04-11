<?php  

?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Restuarant web app</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/screen.css">
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script>
		function show(){
			document.getElementById("registerForm").style.display="block";
		}
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
			<a href="#" onclick="show()">Register</a>
	</form>
	<form action="" method="post" id="registerForm">
		<input type="text" name="nameReg" placeholder="Name">
		<input type="text" name="street" placeholder="Street">
		<input type="text" name="city" placeholder="City">
		<input type="submit" value="Register" name="btnRegister">
	</form>
	</div>
</body>
</html>