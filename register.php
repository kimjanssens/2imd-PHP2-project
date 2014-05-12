<?php  
	include_once("classes/User.class.php");
	$feedback = "";
	if (isset($_POST["btnRegister"])) {
		try {
			$u = new User();
			$u->Name = $_POST["nameReg"];
			$u->Street = $_POST["street"];
			$u->City = $_POST["city"];
			$u->Phone = $_POST["phone"];
			$u->Password = $_POST["passwordReg"];
			$u->Save();

			$feedback = "Thanks for signin up!";
			
			session_start();
            $_SESSION['username'] = $u->Name;
            $_SESSION['loggedinPassword'] = $u->Password;
            $_SESSION['loggedin'] = true;
            $_SESSION['type']='admin';
            header('Location: admin.php');
			
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
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
</head>
<body>
	<div class="container">
		<h2>Fill out this form to register</h2>
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
			<input type="submit" value="Register" class="btn btn-danger" name="btnRegister">
			<a href="index.php">Go back</a>
		</form>
	</div>
</body>
</html>