<?php
//$f = insert_fb_data_day('act_1071159706331825'); //pec
//$f = insert_fb_data_day('act_1073271616120634'); //ilcb
//$f = insert_fb_data_day('act_263704911080094'); //Instituto LCB
//$f = insert_fb_data_day('act_1414429155338210'); //master_cuisine
//$f = insert_fb_data_day('act_1063559070425222'); //ulcb
//$f = insert_fb_data_day('act_1487762988004826'); //moviltours
//header('Content-Type: application/json'); 
//error_reporting(E_ALL & ~E_NOTICE & E_DEPRECATED);
error_reporting(E_ALL);
ini_set('display_errors', 1);//
if (!defined('STDOUT'))
    define('STDOUT', fopen('php://stdout', 'w'));
//define('SDK_DIR', __DIR__ . '/'); // Path to the SDK directory
//include ('util.php');

define('SDK_DIR', '../facebook-php-business-sdk/'); // Path to the SDK directory
$loader = include SDK_DIR.'/vendor/autoload.php';
$app_id = '292708578241182';
$app_secret = '462aeec937ca833dd9798c944d5c79e2';
$access_token = 'EAAEKN4bUKp4BAMkDVU0QysRMazDcJOsZBZCvkbiwiUzjr3gVLTn1a9mmZB2hfcrZA21pbQ2ofEI0MMFa9ne1WcIbiFT6ZC5cRYFXhHbbjVZBPsBHDSmfE9uloDSB290ArTztDjl2TY7HygfdmiBvM95YpH19FCUFLGIaZCkMXRvqwZDZD';
$ad_account_id = 'act_1487762988004826';
$account_id = explode('act_',$ad_account_id);
$account_id = $account_id[1];
$table = "ad_creative_facebook";
// Configurations - End
if (is_null($access_token) || is_null($app_id) || is_null($app_secret)) {  throw new \Exception('You must set your access token, app id and app secret before executing'  );}
if (is_null($ad_account_id)) {  throw new \Exception(    'You must set your account id before executing');}

use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Campaign;
use FacebookAds\Object\AdsInsights;
use FacebookAds\Object\Ad;
use FacebookAds\Object\AdCreative;



$api = Api::init($app_id, $app_secret, $access_token);
$api->setLogger(new CurlLogger());
$tiempo_inicio = microtime(true);
$account = new AdAccount($ad_account_id);
    //  echo "<pre>";
    //  var_dump($account);die;
    //  echo "</pre>";
    //  exit();
     $params = array(
        'limit' => '5000',// 5 mil es el maximo de facebook por petici0n al momento
    );
  
$ads = $account->getAds(array(
 'creative',
),$params);
        $arrayDataAds = array();
        $newCursorAds = array();
    while ($ads->createAfterRequest() != null) {
        $newCursorAds = json_decode($ads->getResponse()->getBody(),true);
        $arrayDataAds = array_merge($arrayDataAds,$newCursorAds['data']);
        $ads->fetchAfter();
        }
       // echo "\n Hay ".count($arrayDataAds)." anuncios \n";
     // $tiempo_fin = microtime(true);
      //echo "<br>\n\nTiempo de ejecucion de iteracion sobre el cursor de anuncios: " . round($tiempo_fin - $tiempo_inicio, 4)."\n\n";
     // $tiempo_inicio = microtime(true);
        $newArrayDataAdsCreatives= array();
        foreach ($arrayDataAds as $newads){
            $creative = new AdCreative($newads['creative']['id']);
            $creative->read(array('effective_object_story_id','object_story_id','thumbnail_url','link_url','object_type'));
             $newads['effective_object_story_id']=$creative->effective_object_story_id; 
             $newads['object_story_id']=$creative->object_story_id;             
             $newads['thumbnail_url']=$creative->thumbnail_url;
             $newads['link_url']=$creative->link_url;             
             $newads['object_type']=$creative->object_type;
             $newArrayDataAdsCreatives[] = $newads;
        }
        // $tiempo_fin = microtime(true);
     // echo "<br>\n\nTiempo de ejecucion de asignar datos de anuncios creativos a los anuncios: " . round($tiempo_fin - $tiempo_inicio, 4)."\n\n<br>";
    //  echo "<pre>";
    //  var_dump($newArrayDataAdsCreatives);die;
    //  echo "</pre>";
    //  exit();
     if (count($arrayDataAds) > 0){
         DeleteTotalDataOfTableForAccount($table,$account_id);
         $adsInsert = insertAdsCreativesFacebook($newArrayDataAdsCreatives,$table,$account_id);
     }
    // print_r($newArrayDataAdsCreatives);    
      //print_r($arrayDataAds);
      






