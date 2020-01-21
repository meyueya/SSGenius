<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Include the required dependencies.
define('SDK_DIR', '/home/ssgenius/public_html/app/facebook/'.'/facebook-php-business-sdk/'); // Path to the SDK directory
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

    if (!isset($access_token)){ header('Location: https://ssgenius.com/app/facebook/login'); }
    // Instantiates a new Facebook super-class object from SDK Facebook\Facebook
    $appId         = '292708578241182'; //Facebook App ID
    $appSecret     = '462aeec937ca833dd9798c944d5c79e2'; //Facebook App Secret
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
 
 
function getFansPageFacebook($appId,$appSecret,$api,$id_page,$page_token){
    $page_session = new Session($appId, $appSecret, $page_token);
    $page_api = new Api($api->getHttpClient(), $page_session);
    $page_api->setLogger($api->getLogger());
    $paramsPage = array('metric' => array('page_fans'));
    $data = $page_api->call('/'.$id_page.'/insights', RequestInterface::METHOD_GET,$paramsPage)->getContent();
    return $data['data']['0']['values']['1']['value'];
}

$fb = new Facebook\Facebook([
  'app_id' => $appId,
  'app_secret' => $appSecret,
  'default_graph_version' => 'v3.2',
]);
    
     try{
    $response = $fb->get('/me?fields=id,first_name,picture,last_name,name,short_name,accounts',$access_token);
     }catch(Facebook\Exceptions\FacebookThrottleException $e){
        $return["message"] = $e->getMessage();
         echo $return["message"]; 
    }catch(Facebook\Exceptions\FacebookAuthorizationException $e){
         $return["message"] = $e->getMessage();
         echo $return["message"];
    }

    $graphObject = $response->getDecodedBody();
    $checkUser = $UserModel->usernameCheck($graphObject['id']); //chequeamos si el usuario esta registrado
//abrimos sesion para el usuario actual
     
    $_SESSION['id_user'] =  $UserModel->getIdUser($graphObject['id']);
    $_SESSION['name'] =  $UserModel->getUser($_SESSION['id_user'])->name;

    if ($checkUser == false){// guardamos al usuario en la db
        $id_user = uniqid(mt_rand(), true);       
        $created_time = date('Y-m-d H:i:s');
        if(isset($graphObject)){
        $UserModel->saveUser($id_user, $graphObject['id'], $graphObject['short_name'],  $graphObject['name'], $graphObject['picture']['data']['url'], $access_token, $created_time); //guardamos al usuario
        }
       
    }else {
        if (isset($_GET['act'])){$act = $_GET['act'];} else{$act="";}
        
        if ($act != "list"){

        $user = $UserModel->getUser($_SESSION['id_user']);
        $pages = $FacebookModel->listPages($user->id_facebook);
        if (isset($pages['0']['id_facebook_page'])){
        $_SESSION['firstPageSsg'] = $pages['0']['id_facebook_page'];
        } else {$_SESSION['firstPageSsg'] = "";}
            //header('Location: https://ssgenius.com/app/facebook/?psid='.$_SESSION['firstPageSsg']);
            }
        }
    
      
         //echo $_SESSION['id_user'];
         
            if (count($graphObject['accounts']['data']) > 0 ){
                //$fbPerfil = $fb->get('/me/accounts', $access_token);
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

         $paginas = $fb->get('/me/accounts', $access_token)->getDecodedBody();
         $arrayData = $paginas['data'];
    if (isset($paginas['paging']['next'])){
    $next = $paginas['paging']['next'];
    //exit();
          while($next != "") {
                $response = json_decode(file_get_contents($next, null, $context),true);
                $arrayData = array_merge($arrayData,$response['data']);
                if (isset($response['paging']['next'])){
                $next = $response['paging']['next'];
                } else { $next = ""; }
             }
    } 
    
            }
       
    ?>