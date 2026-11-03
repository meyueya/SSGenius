<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Include the required dependencies.
define('SDK_DIR', __DIR__ . '/facebook-php-business-sdk/'); // Path to the SDK directory
$loader = include SDK_DIR.'/vendor/autoload.php';
//use Facebook\Facebook;
use FacebookAds\Api; 
use FacebookAds\Session;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Http\Request;
use FacebookAds\Http\RequestInterface;
use FacebookAds\Object\Page;

require_once( 'php-sdk-5/vendor/autoload.php' );
require_once('../model/UserModel.php');
require_once('../model/FacebookModel.php');
$UserModel = new UserModel();
$FacebookModel = new FacebookModel();
//$_SESSION = Array();
if (isset($_SESSION['fb_access_token'])){
$access_token = $_SESSION['fb_access_token'];
}
$access_token =getenv('FACEBOOK_ACCESS_TOKEN');

    if (!isset($access_token)){ header('Location: https://ssgenius.com/app/facebook/login'); }
    $appId         = '292708578241182'; //Facebook App ID
    $appSecret     = getenv('FACEBOOK_APP_SECRET'); //Facebook App Secret
    try{
    $api = Api::init($appId, $appSecret, $access_token);
    $api->setLogger(new CurlLogger());
    $api = Api::instance();
    }catch(\Exception $e){
        $return["message"] = $e->getMessage();
         echo $return["message"]; 
    }catch(Facebook\Exceptions\FacebookAuthorizationException $e){
         $return["message"] = $e->getMessage();
         echo $return["message"];
    }catch (FacebookAds\Http\Exception\ServerException $e) {
              $return["message"] = $e->getMessage();
        }catch (FacebookAds\Exception\Exception $e) {
              //$message = "Error tipo facebook exception: ".$e->getMessage();
              $return["message"] = $e->getMessage();
        }
 


$fb = new Facebook\Facebook([
  'app_id' => $appId,
  'app_secret' => $appSecret,
  'default_graph_version' => 'v3.2',
]);


/* PHP SDK v5.0.0 */
/* make the API call */
try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->post(
    '/t_10150076811537904/messages',
    array (
      'message' => 'Hola! Gracias por tu respuesta, enseguida un Community te repondera a la brevedad.',
    ),
    $access_token
  );
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
$graphNode = $response->getGraphNode();
/* handle the result */