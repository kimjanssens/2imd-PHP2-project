<?php
    //facebook application
    $fbconfig['appid' ]     = "1401294226818835";
    $fbconfig['secret']     = "ef12998a4f3a5af7b65cc06d76657621";
    $fbconfig['baseurl']    = "http://localhost/PHP/project";
    
    $user            =   null; //facebook user uid
    try{
        include_once "facebook.php";
    }
    catch(Exception $o){
        error_log($o);
    }
    // Create our Application instance.
    $facebook = new Facebook(array(
      'appId'  => $fbconfig['appid'],
      'secret' => $fbconfig['secret'],
      'cookie' => true,
    ));

    $user       = $facebook->getUser();
    
    $loginUrl   = $facebook->getLoginUrl(
            array(
                'scope'         => 'email,offline_access,publish_stream,user_birthday,user_location,user_work_history,user_about_me,user_hometown',
                'redirect_uri'  => $fbconfig['baseurl']
            )
    );
    
    $logoutUrl  = $facebook->getLogoutUrl();

    if ($user) {
      try {
        $user_profile = $facebook->api('/me');
      } catch (FacebookApiException $e) {
        d($e);
        $user = null;
      }
    }
   
    if ($user){
        $userInfo = $facebook->api("/$user");
        
        //update user's status using graph api
        //http://developers.facebook.com/docs/reference/dialogs/feed/
        if (isset($_GET['publish'])){
            try {
                $publishStream = $facebook->api("/$user/feed", 'post', array(
                    'message' => "", 
                    'link'    => '',
                    'picture' => '',
                    'name'    => '',
                    'description'=> ''
                    )
                );
                //as $_GET['publish'] is set so remove it by redirecting user to the base url 
            } catch (FacebookApiException $e) {
                d($e);
            }
            $redirectUrl     = $fbconfig['baseurl'] . '/index.php?success=1';
            header("Location: $redirectUrl");
        }

        //update user's status using graph api
        //http://developers.facebook.com/docs/reference/dialogs/feed/
        if (isset($_POST['tt'])){
            try {
                $statusUpdate = $facebook->api("/$user/feed", 'post', array('message'=> $_POST['tt']));
            } catch (FacebookApiException $e) {
                d($e);
            }
        }

        //fql query example using legacy method call and passing parameter
        try{
            $fql    =   "select name, hometown_location, sex, pic_square from user where uid=" . $user;
            $param  =   array(
                'method'    => 'fql.query',
                'query'     => $fql,
                'callback'  => ''
            );
            $fqlResult   =   $facebook->api($param);
        }
        catch(Exception $o){
            d($o);
        }
    }
    
    function d($d){
        echo '<pre>';
        print_r($d);
        echo '</pre>';
    }
?>
