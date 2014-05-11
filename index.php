<?php
    include_once "Facebook/fbmain.php";
?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
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
    <?php if (!$user) { ?>
        <a href="<?=$loginUrl?>">Facebook Login</a>
    <?php } else { ?>
        <a href="<?=$logoutUrl?>">Facebook Logout</a>
    <?php } ?>

    <?php 
    if($user){
    	header("Location: startpagina.php");
    }
    ?>
</body>
</html>