<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Include the required dependencies.
require_once('../model/UserModel.php');
require_once('../model/FacebookModel.php');
$UserModel = new UserModel();
$FacebookModel = new FacebookModel();
$loader = include '/home/aiwroi/public_html/ssgenius.com/app/facebook-php-business-sdk/vendor/autoload.php';
//use Facebook\Facebook;
use FacebookAds\Api;
use FacebookAds\Session;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Http\Request;
use FacebookAds\Http\RequestInterface;
use FacebookAds\Object\Page;

require_once( '/home/aiwroi/public_html/ssgenius.com/app/php-sdk-5/vendor/autoload.php' );
//$_SESSION = Array();
if (isset($_SESSION['fb_access_token'])){
$access_token = $_SESSION['fb_access_token'];
}
print_r($access_token);
exit();
$appId         = '292708578241182'; //Facebook App ID
$appSecret     = getenv('FACEBOOK_APP_SECRET'); //Facebook App Secret
$fb = new Facebook\Facebook([
  'app_id'                => $appId,
  'app_secret'            => $appSecret,
  'default_graph_version' => 'v3.2',
]);

    $api = Api::init($appId, $appSecret, $access_token);
    $api->setLogger(new CurlLogger());
    $api = Api::instance();
    //,adaccounts,businesses
    
     try{
        $next = "";
        $after = "";     
        $arrayData = array();
        $newResponse = array();
        $context = stream_context_create(array(
            "ssl"=>array(
                "verify_peer"=>true,
                "verify_peer_name"=>true,
            )
        ));
        
         $person = $fb->get('/me',$access_token)->getDecodedBody();
     }
     catch (\Exception $e){
        $return["message"] = $e->getMessage();
         echo $return["message"]; 
     }