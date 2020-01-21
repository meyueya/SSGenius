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
$appId         = '292708578241182'; //Facebook App ID
$appSecret     = '462aeec937ca833dd9798c944d5c79e2'; //Facebook App Secret
$redirectURL   = 'https://ssgenius.com/app/facebook/login/fb-callback.php'; //Callback URL
//permisos en cola 'user_link','ads_management','ads_read','publish_pages','business_management','read_page_mailboxes'
$permissions = array('ads_read'); // permissions

$fb = new Facebook\Facebook([
  'app_id'                => $appId,
  'app_secret'            => $appSecret,
  'default_graph_version' => 'v3.2',
]);
$helper = $fb->getRedirectLoginHelper();
//ads_management y ads_read son para cuenta publicitaria trabajan en conjunto con read_insights
//read_page_mailboxes es para pedir datos del inbox, a nivel desarrollo requiere debuggear el token tools and debugger
// Requested permissions - optional
$loginUrl = $helper->getLoginUrl($redirectURL, $permissions);
echo '<a href="'.$loginUrl.'"><button type="button" class="btn btn-primary btn-primary-facebook btn-block"><i class="fa fa-facebook-square"></i> Obtener token de anuncios</button></a>';

    $api = Api::init($appId, $appSecret, $access_token);
    $api->setLogger(new CurlLogger());
    $api = Api::instance();
   
    $fb = new Facebook\Facebook([
      'app_id' => $appId,
      'app_secret' => $appSecret,
      'default_graph_version' => 'v3.2',
    ]);

    $helper = $fb->getRedirectLoginHelper();
    $loginUrl = $helper->getLoginUrl($redirectURL, $permissions);

    function getFansPageFacebook($appId,$appSecret,$api,$id_page,$page_token){
        $page_session = new Session($appId, $appSecret, $page_token);
        $page_api = new Api($api->getHttpClient(), $page_session);
        $page_api->setLogger($api->getLogger());
        $paramsPage = array('metric' => array('page_fans'));
        $data = $page_api->call('/'.$id_page.'/insights', RequestInterface::METHOD_GET,$paramsPage)->getContent();
        return $data['data']['0']['values']['1']['value'];
    }
   
    /*$borrarPermisosDeUsuario = $fb->delete('/1623677744399050/permissions/',[],$access_token);
    echo "<pre>";
    print_r($borrarPermisosDeUsuario);
    echo "</pre>";
    exit();*/
    //,adaccounts,businesses
    
    /* try{
    $response = $fb->get('/me?fields=id,first_name,picture,last_name,name,short_name,accounts,adaccounts',$access_token);
     }
     catch (\Exception $e){
        $return["message"] = $e->getMessage();
         echo $return["message"]; 
     }
     catch(Facebook\Exceptions\FacebookThrottleException $e){
        $return["message"] = $e->getMessage();
         echo $return["message"]; 
    }catch(Facebook\Exceptions\FacebookAuthorizationException $e){
         $return["message"] = $e->getMessage();
         echo $return["message"];
    }*/
    
