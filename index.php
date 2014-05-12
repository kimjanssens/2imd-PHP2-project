<?php
    include_once "Facebook/fbmain.php";
    include_once("classes/User.class.php");
    $feedbackLogin = "";
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
	<script type="text/javascript" src="http://connect.facebook.net/en_US/all.js"></script>
    <script type="text/javascript">
    FB.init({
        appId  : '<?=$fbconfig['appid']?>',
        status : true,
        cookie : true,
        xfbml  : true
    });   
    </script>
</head>
<body>
<div class="container">
	<div id="loginWindow">
		<a href="<?php $loginUrl ?>" id="fb-login"><img src="images/fb-logo.png" alt="fb-logo">Login with Facebook</a>
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