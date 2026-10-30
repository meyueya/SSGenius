<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
    // Configurations
define('SDK_DIR_', '/home/ssgenius/public_html/app/facebook/facebook-php-business-sdk/'); // Path to the SDK directory
$loader = include SDK_DIR_.'/vendor/autoload.php';
//use Facebook\Facebook;
use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Session;
use FacebookAds\Http\Request;
use FacebookAds\Http\Response;
use FacebookAds\Http\RequestInterface;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Campaign;
use FacebookAds\Object\AdsInsights;
use FacebookAds\Object\Ad;
use FacebookAds\Object\AdCreative;
use FacebookAds\Object\Page;
//require_once('/home/ssgenius/public_html/app/model/FacebookModel.php');
require_once( '/home/ssgenius/public_html/app/facebook/php-sdk-5/vendor/autoload.php' );
class SsgFacebookHelper
{
    private $appID;
	private $appSecret;
	private $appToken;//token de aplicacion SSG
	                    
	public function __construct($appID = null, $appSecret = null){
	    if ($appID == null){
	        $this->appID = getenv('FACEBOOK_APP_ID');
	    }
	    if ($appSecret == null){
	        $this->appSecret = getenv('FACEBOOK_APP_SECRET');
	        $this->appToken = getenv('FACEBOOK_APP_TOKEN');
	    }
	    }	
	public function getApi($access_token){
	    $api = Api::init($this->appID, $this->appSecret, $access_token);
        //$api->setDefaultGraphVersion("3.2");
        $api->setLogger(new CurlLogger());
        return $api;
	}
	
	public function getPageApi($access_token,$page_token)
	{
	    $page_session = new Session($this->appID, $this->appSecret, $page_token);
	    $api = $this->getApi($access_token);
        $page_api = new Api($api->getHttpClient(), $page_session);
        $page_api->setLogger($api->getLogger());
        return $page_api;
	}
	
	public function getFb(){
	    $fb = new Facebook\Facebook([
        'app_id' => $this->appID,
        'app_secret' => $this->appSecret,
        'default_graph_version' => 'v3.2',
        ]);
        return $fb;
	}
	
	public function debug_token($token)
	{
        try {
          // Returns a `Facebook\FacebookResponse` object
          $fb = $this->getFb();
          $response = $fb->get('/debug_token?input_token='.$token, $this->appToken)->getDecodedBody();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
          echo 'Facebook Graph returno un error: ' . $e->getMessage();
         // exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
          echo 'Facebook SDK returned an error: ' . $e->getMessage();
          //exit;
        }
        //$graphNode = $response->getGraphNode();
        return $response['data'];
	}
	
	public function TokenValid($token,$type){
	   $responseToken = $this->debug_token($token);
	   echo "<pre>";
	   print_r($responseToken);
	   echo "</pre>";
	   if (!isset($responseToken['error'])){
	       $currentTime = time();
	       $ExpiresTime = $responseToken['data_access_expires_at'] - 600; // le damos 10 minutos (60 * 10)
	       if ($ExpiresTime < $currentTime){
	          $return["message"] = "La token caduco";
	         
	       }  
	       
	        if ($responseToken['is_valid'] != "1"){
	            $return["message"] = "token invalida";
	             
	           } 
	       if ($type != $responseToken['type']){
	           $return["message"] = "esta token no es del tipo esperado ".$responseToken['type'];
	          
	       }    
	           
	        $scopesToken =  $responseToken['scopes'];
	        $scopesApp = array('email','read_insights','manage_pages','pages_show_list','ads_read','public_profile');
	      $qtyPerms = count(array_intersect($scopesApp, $scopesToken));
	      if ($qtyPerms != "6"){
	          $return["message"] = "Esta token no tiene los permisos suficientes";
	          
	      }
	   //echo date('d/m/Y H:i:sa', $responseToken['data_access_expires_at']);
	   } else { 
	       
	       $return["message"] = $responseToken['error']['code']." - ".$responseToken['error']['message'];
	   }
	    if (!isset($return["message"])){ $return["message"] = "true"; }
	}
}
//$access_token = "REDACTED_FACEBOOK_APP_TOKEN"; //app token
/*$SsgFacebookHelper = new SsgFacebookHelper();
$api = $SsgFacebookHelper->getApi($access_token);

$input_token = "REDACTED_FACEBOOK_ACCESS_TOKEN";
$responseToken = $SsgFacebookHelper->debug_token($input_token,$access_token);
echo "<pre>";
print_r($responseToken);
echo "</pre>";
$fb = $SsgFacebookHelper->getFb();
$response = $fb->get('/10213719231759939',  array ('fields' => 'name','email'),
    $access_token
  );
  print_r($response);*/
  