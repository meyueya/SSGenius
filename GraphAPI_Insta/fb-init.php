<?php

//start the session
session_start();

//include autoload file from vendor folder
require_once __DIR__ . '/vendor/autoload.php'; // sdk Graph


$fb = new Facebook\Facebook([
    'app_id' => getenv('FACEBOOK_APP_ID'),
    'app_secret' => getenv('FACEBOOK_APP_SECRET'),
    'default_graph_version' => 'v3.2',
]);


$helper = $fb->getRedirectLoginHelper();
$login_url = $helper->getLoginUrl("http://localhost/GraphAPI_Insta/");

try {

    $accessToken = $helper->getAccessToken();
    if (isset($accessToken)) {
        $_SESSION['access_token'] = (string) $accessToken;  //conver to string
        //if session is set we can redirect to the user to any page 
        header("Location:index.php");
    }
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}


//now we will get users first name , email , last name
if (isset($_SESSION['access_token'])) {

    try {

        $fb->setDefaultAccessToken($_SESSION['access_token']);
        $res = $fb->get('/me?locale=en_US&fields=name,email');
        $user = $res->getGraphUser();
        echo 'Hello, ', $user->getField('name');
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}
