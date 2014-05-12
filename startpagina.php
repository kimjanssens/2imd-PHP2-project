<?php
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
    <div id="profile">
      <?php 
    if($user){
      echo "<a href='index.php".$logoutUrl."' id='logout'>Logout</a>";
      echo "<img src='".$fqlResult[0]['pic_square']."'>";
      echo "<a href='".$userInfo['link']."'>".$userInfo['name']."</a>";
    }
    ?>
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