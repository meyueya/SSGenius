<?php
//error_reporting(E_ALL & ~E_NOTICE & E_DEPRECATED);
error_reporting(E_ALL);
ini_set('display_errors', 1);//
if (!defined('STDOUT'))
    define('STDOUT', fopen('php://stdout', 'w'));

require_once('../../model/UserModel.php');
require_once('../../model/FacebookModel.php');
$UserModel = new UserModel();
$FacebookModel = new FacebookModel();

define('SDK_DIR', '../facebook-php-business-sdk/'); // Path to the SDK directory
$loader = include SDK_DIR.'/vendor/autoload.php';

use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Campaign;
use FacebookAds\Object\AdsInsights;
use FacebookAds\Object\Ad;
use FacebookAds\Object\AdCreative;

/*$app_id = '1930491627191257';
$app_secret = '934f83f24436ea82749ca6b5fafc6281';*/
$app_id = '1390656151047512';
$app_secret = 'fc4851b7005ad93bdf2cb87475d1d077';
$access_token = 'EAATwy13jTVgBAAsIkSvnnIKTJAZCvxIZCr5A6VdFT6UqwkmVRQVlvqkB54PZCPdXwITQBtsI2Ix1pEG3YgYcMpZAkzLFMTrNTTIGcpZB7JQ6UIR2A5ZC0I23rIhZBOhsn9McL3E4LYRpMfivvrprPZAI1WmTxFq4cPMmdJy7NPj0Jcap8RPbYb4XSZAgoHD1bgceuVhjGKneOBgZDZD';//variable

//$ad_account_id = 'act_1487762988004826';//variable
//para pruebas
$ad_account_id = 'act_1073271616120634';//variable
//$ad_account_id = 'act_1384505008501796';//variable
//$ad_account_id = 'act_110115202722949';//variable
$account_id = explode('act_',$ad_account_id);
$account_id = $account_id[1];
//$table = "ad_creative_facebook";
// Configurations - End
if (is_null($access_token) || is_null($app_id) || is_null($app_secret)) {  throw new \Exception('You must set your access token, app id and app secret before executing'  );}
if (is_null($ad_account_id)) {  throw new \Exception(    'You must set your account id before executing');}


$api = Api::init($app_id, $app_secret, $access_token);
$api->setLogger(new CurlLogger());
/*
require_once('php-sdk-5/vendor/autoload.php');

$fb = new Facebook\Facebook([
  'app_id' => $app_id,
  'app_secret' => $app_secret,
  'default_graph_version' => 'v3.2',
]);
$response = $fb->get('/me/adaccounts?fields=name,account_id,account_status',$access_token);
echo "<pre>";
print_r($response->getDecodedBody());
echo "</pre>";
exit();
*/
$tiempo_inicio = microtime(true);
$account = new AdAccount($ad_account_id);
     $params = array(
        'limit' => '5000',// 5 mil es el maximo de facebook por petici0n al momento
    );
  
$ads = $account->getAds(array('creative',),$params);
        $arrayDataAds = array();
        $newCursorAds = array();
    while ($ads->createAfterRequest() != null) {
        $newCursorAds = json_decode($ads->getResponse()->getBody(),true);
        print_r($ads->getResponse()->getHeaders());
        $arrayDataAds = array_merge($arrayDataAds,$newCursorAds['data']);
        $ads->fetchAfter();
        }
       // echo "\n Hay ".count($arrayDataAds)." anuncios \n";
     // $tiempo_fin = microtime(true);
      //echo "<br>\n\nTiempo de ejecucion de iteracion sobre el cursor de anuncios: " . round($tiempo_fin - $tiempo_inicio, 4)."\n\n";
     // $tiempo_inicio = microtime(true);
    /* echo "<pre>";
     print_r($arrayDataAds);
     echo "</pre>";
     exit();*/
        $newArrayDataAdsCreatives= array();
        $ArrayDataAdAccount= array();
        $c = 0;
        $count = 0;
        foreach ($arrayDataAds as $key => $newads){
            
            $creative = new AdCreative($newads['creative']['id']);
            $creative->read(array('object_story_id'));
            if ($creative->object_story_id != ""){
                $count++;
                echo $count;
            echo "<br>";
              $ad = new Ad($newads['id']);
                $paramsAd = array(
                  'date_preset' => 'lifetime',
                );
                 $fieldsAd = array('reach','spend');
    $insightsAd = json_decode($ad->getInsights($fieldsAd, $paramsAd)->getResponse()->getBody(),true);
    $updated_time = date('Y-m-d H:i:s');
                    $ArrayDataAdAccount[$c]['id_adaccount'] = $account_id;
                    $ArrayDataAdAccount[$c]['id_ad'] = $newads['id'];
                    $ArrayDataAdAccount[$c]['creative_id'] = $newads['creative']['id'];
                    $ArrayDataAdAccount[$c]['object_story_id'] = $creative->object_story_id;
                    $ArrayDataAdAccount[$c]['ad_reach'] = isset($insightsAd['data']['0']['reach']) ? $insightsAd['data']['0']['reach'] : "0";
                    $ArrayDataAdAccount[$c]['ad_spend'] = isset($insightsAd['data']['0']['spend']) ? $insightsAd['data']['0']['spend'] : "0";
                    $ArrayDataAdAccount[$c]['updated_time'] = $updated_time;
                    $c++;
            }
        }
        
         echo "<pre>";
        print_r($ArrayDataAdAccount); 
        echo "</pre>";
        exit();
        $dataCountBeforeAdAccount = count($FacebookModel->getAdAccountData($account_id));
        $countAdAccountData = count($ArrayDataAdAccount);
        //echo $dataCountBeforeAdAccount." anuncios";
         if (($countAdAccountData >= $dataCountBeforeAdAccount) && ($countAdAccountData > 0)){
             //echo "guarda data";
            // $FacebookModel->deleteAdsForAdAccount($account_id);
            // $FacebookModel->SaveFacebookAdAccountData($ArrayDataAdAccount);
         }
       
        exit();
        
     $params = array(
        //'time_range' => array('since' => '2018-06-19', 'until' =>  '2018-07-19'),
        'limit' => '5000',// 5 mil es el maximo de facebook por petici0n al momento
        //'effective_status' => array('ACTIVE', 'PAUSED', 'PENDING_BILLING_INFO', 'PENDING_REVIEW', 'PREAPPROVED','CAMPAIGN_PAUSED', 'ADSET_PAUSED'),
        //'date_preset' => 'today',
        //'updated_since' => '<integer>',
        //'summary' => 'total_count',
    );
    
$adcreatives = (new AdAccount($ad_account_id))->getAdCreatives(array(
    'account_id',
    'actor_id',
    'adlabels',
    'applink_treatment',
    'asset_feed_spec',
    'body',
    'branded_content_sponsor_page_id',
    'call_to_action_type',
    'effective_instagram_story_id',
    'effective_object_story_id',
    'id',
    'image_crops',
    'image_hash',
    'image_url',
    'instagram_actor_id',
    'instagram_permalink_url',
    'instagram_story_id',
    'link_og_id',
    'link_url',
    'messenger_sponsored_message',
    'name',
    'object_id',
    'object_story_id',
    'object_story_spec',
    'object_type',
    'object_url',
    'platform_customizations',
    'product_set_id',
    'recommender_settings',
    'status',
    'template_url',
    'template_url_spec',
    'thumbnail_url',
    'title',
    'url_tags',
    'use_page_actor_override',
    'video_id',
    'authorization_category',
    'dynamic_ad_voice',
    //'image_file',
    //'creative_id',
),$params);

        $arrayDataCreatives = array();
        $newCursorCreatives = array();
    while ($adcreatives->createAfterRequest() != null) {
        $newCursorCreatives = json_decode($adcreatives->getResponse()->getBody(),true);
        $arrayDataCreatives = array_merge($arrayDataCreatives,$newCursorCreatives['data']);
        $adcreatives->fetchAfter();
        }
       
     echo "<pre>";
        var_dump($arrayDataCreatives);
        echo "</pre>";
      die();
      exit();
echo "Tenemos ".$adcreatives->count()." anuncios creativos";

//exit();
$ad = new Ad('23843106075210497');
$params = array(
  'date_preset' => 'lifetime',
);
 $fields = array(
     'reach',
     'spend'
            /*'ad_name',
            'adset_name',
            'campaign_name',
            'account_name',
            'account_id',
            'campaign_id',
            'adset_id',
            'ad_id',
            'reach',
            'impressions',
            'clicks',
            'spend',
            'objective',
            'date_start',
            'date_stop',
            'inline_post_engagement'*/
                );
$insights = $ad->getInsights($fields, $params);
// echo "<pre>";
// print_r(json_decode($insights->getResponse()->getBody(),true));
// echo "</pre>";
// exit();


        // $tiempo_fin = microtime(true);
     // echo "<br>\n\nTiempo de ejecucion de asignar datos de anuncios creativos a los anuncios: " . round($tiempo_fin - $tiempo_inicio, 4)."\n\n<br>";
         //DeleteTotalDataOfTableForAccount($table,$account_id);
         //$adsInsert = insertAdsCreativesFacebook($newArrayDataAdsCreatives,$table,$account_id);
    // print_r($newArrayDataAdsCreatives);    
      //print_r($arrayDataAds);
      






