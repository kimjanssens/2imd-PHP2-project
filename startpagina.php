<?php
    include_once "Facebook/fbmain.php";
?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/screen.css">
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
    <?php 
    if($user){
      echo "<img src='".$fqlResult[0]['pic_square']."'>";
      echo "<a href='".$userInfo['link']."'>".$userInfo['name']."</a>";
      echo "<br>";
      echo "<a href='index.php".$logoutUrl."'>Logout</a>";
    }
    ?>
		<h1>Startpagina</h1>
		//lijst met restaurants
	</div>
</body>
</html>