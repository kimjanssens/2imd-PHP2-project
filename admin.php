<?php  
	include_once("classes/User.class.php");
	$feedback = "";
	$feedbackLogin = "";
	if (isset($_POST["btnRegister"])) {
		try {
			$user = new User();
			$user->Name = $_POST["nameReg"];
			$user->Street = $_POST["street"];
			$user->City = $_POST["city"];
			$user->Phone = $_POST["phone"];
			$user->Password = $_POST["passwordReg"];
			$user->Save();

			$feedback = "Thanks for signin up!";
			
			session_start();
            $_SESSION['username'] = $u->Name;
            $_SESSION['loggedinPassword'] = $u->Password;
            $_SESSION['loggedin'] = true;
            //header('Location: nextpage.php');
			
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
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
	<title>Restaurant web app</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/screen.css">
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
</head>
<body>
	<div class="container">
		<h1>Restaurant app</h1>
		<h2>Login to continue...</h2>
		<form action="" method="post">
			<?php  
				if (isset($errorLogin)) {
					echo "<p class='bg-danger'>$errorLogin</p>";
				}
				if (!empty($feedbackLogin)) {
					echo "<p class='bg-success'>$feedbackLogin</p>";
				}
			?>
			<input type="text" name="username" class="form-control" placeholder="Name">
			<input type="password" name="loginPassword" class="form-control" placeholder="Password">
			<input type="submit" value="Login" class="btn btn-primary" name="btnLogin">
		</form>
		<form action="" method="post" id="registerForm">
			<?php  
				if (isset($error)) {
					echo "<p class='bg-danger'>$error</p>";
				}
				if (!empty($feedback)) {
					echo "<p class='bg-success'>$feedback</p>";
				}
			?>
			<input type="text" name="nameReg" id="nameReg" class="form-control" placeholder="Name" value="<?php if(isset($_POST['nameReg'])){echo $_POST['nameReg'];} ?>">
			<input type="text" name="street" class="form-control" placeholder="Street" value="<?php if(isset($_POST['street'])){echo $_POST['street'];} ?>">
			<input type="text" name="city" class="form-control" placeholder="City" value="<?php if(isset($_POST['city'])){echo $_POST['city'];} ?>">
			<input type="tel" name="phone" class="form-control" placeholder="Phonenumber" value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];} ?>">
			<input type="password" name="passwordReg" class="form-control" placeholder="Password">
			<input type="submit" value="Register" class="btn btn-primary" name="btnRegister">
		</form>
	</div>
</body>
</html>