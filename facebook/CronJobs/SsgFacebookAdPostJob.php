<?php
//error_reporting(E_ALL & ~E_NOTICE & E_DEPRECATED);
error_reporting(E_ALL);
ini_set('display_errors', 1);//
/*if (!defined('STDOUT'))
    define('STDOUT', fopen('php://stdout', 'w'));
*/
require_once('/home/ssgenius/public_html/app/model/UserModel.php');
require_once('/home/ssgenius/public_html/app/model/FacebookModel.php');
require_once('/home/ssgenius/public_html/app/helper/SsgHelper.php');

$UserModel = new UserModel();
$FacebookModel = new FacebookModel();
$SsgHelper = new SsgHelper();

define('SDK_DIR', '../facebook-php-business-sdk/'); // Path to the SDK directory
$loader = include SDK_DIR.'/vendor/autoload.php';
//$_SESSION = array();
use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Campaign;
use FacebookAds\Object\AdsInsights;
use FacebookAds\Object\Ad;
use FacebookAds\Object\AdCreative;

    $app_id = '292708578241182';
    $app_secret = getenv('FACEBOOK_APP_SECRET');

    if (isset($_GET['adaccount'])){
       $account_id =  $_GET['adaccount'];
       $ad_account_id = 'act_'.$account_id;
       $access_token = $FacebookModel->getTokenForFacebookAdAccount($account_id);
       
    }
    else {
        exit();
    }
    /*$account_id = "1487762988004826";*/
    //$account_id = "1060525460728583";//mamitips
    //$ad_account_id = 'act_'.$account_id;
    //$access_token = getenv('FACEBOOK_ACCESS_TOKEN');
    //$access_token = getenv('FACEBOOK_ACCESS_TOKEN');
    
    // Configurations - End
    if (is_null($access_token) || is_null($app_id) || is_null($app_secret)) {  throw new \Exception('You must set your access token, app id and app secret before executing'  );}
    if (is_null($ad_account_id)) {  throw new \Exception(    'You must set your account id before executing');}
    //var_dump($_GET);die;


    $api = Api::init($app_id, $app_secret, $access_token);
   // $api->setDefaultGraphVersion("3.2");
    $api->setLogger(new CurlLogger());
    //$tiempo_inicio = microtime(true);
    $account = new AdAccount($ad_account_id);
    $params = array(
        'date_preset' => 'lifetime',
        'include_headers' => 'false',
        'limit' => '5000',// 5 mil es el maximo de facebook por petici0n al momento
    );
   try{
        //$ads = $account->getAds(array('creative{object_story_id},insights{spend,reach}',),$params);
        $ads = $account->getAds(array('creative{object_story_id}'),$params);
        $arrayDataAds = array();
        $newCursorAds = array();
    while ($ads->createAfterRequest() != null) {
        $newCursorAds = json_decode($ads->getResponse()->getBody(),true);
        $arrayDataAds = array_merge($arrayDataAds,$newCursorAds['data']);
        $ads->fetchAfter();
        }
        if (count($arrayDataAds) == 0){ 
            $FacebookModel->UpdateMessageFacebookAdAccount($account_id,"No hay Anuncios");
            exit();
        }
        $c = 0;
        foreach ($arrayDataAds as $data)
        {
        if (isset($data['creative']['object_story_id'])){  
            /*if ($c > 11){
                $momento = date('Y-m-d h:i:s');
                 if ($c == 12){
                $FacebookModel->UpdateMessageFacebookAdAccount($account_id,"ok- ".$c." - ".$momento);
                 }
                exit();
             ////////////cancelado en este nivel porque a partir de aqui el acceso development da el siguiente error: (#17) User request limit reached, hasta que aprueben el acceso Standard // APROBADO =)
            }*/
            $ad = new Ad($data['id']);
                $paramsAd = array(
                  'date_preset' => 'lifetime',
                  'include_headers' => 'false',
                  'limit' => '5000',
                );
                $fieldsAd = array('reach','spend','campaign_id');
                $insightsAd = json_decode($ad->getInsights($fieldsAd, $paramsAd)->getResponse()->getBody(),true);

                    if ((isset($insightsAd['data']['0']['reach'])) && (isset($insightsAd['data']['0']['spend']))){
                    $updated_time = date('Y-m-d H:i:s');
                    $ArrayDataAdAccount[$c]['id_adaccount'] = $account_id;
                    $ArrayDataAdAccount[$c]['campaign_id'] = $insightsAd['data']['0']['campaign_id'];
                    $ArrayDataAdAccount[$c]['id_ad'] = $data['id'];
                    $ArrayDataAdAccount[$c]['creative_id'] = $data['creative']['id'];
                    $ArrayDataAdAccount[$c]['object_story_id'] = $data['creative']['object_story_id'];
                    $ArrayDataAdAccount[$c]['ad_reach'] = $insightsAd['data']['0']['reach'];
                    $ArrayDataAdAccount[$c]['ad_spend'] = $insightsAd['data']['0']['spend'];
                    $ArrayDataAdAccount[$c]['updated_time'] = $updated_time;
                    $c++;
                    }
                }
            }
   } catch(\Exception $e){
       //echo $e->getMessage();
      $SsgHelper->sendMailer("ssgdeveloperalerts@mimirwell.com","Error Facebook Exception Account",__FUNCTION__." account_id: ".$account_id." en ".__FILE__." \n ".$e->getMessage());
       $FacebookModel->UpdateMessageFacebookAdAccount($account_id,$e->getMessage());
   }  
        $dataCountBeforeAdAccount = count($FacebookModel->getAdAccountData($account_id));
        $countAdAccountData = count($ArrayDataAdAccount);
        
         if  ($countAdAccountData > 0){
             $FacebookModel->deleteAdsForAdAccount($account_id);
             $FacebookModel->SaveFacebookAdAccountData($ArrayDataAdAccount);
             $FacebookModel->UpdateMessageFacebookAdAccount($account_id,"ok");
         }
         else {
           // $FacebookModel->UpdateMessageFacebookAdAccount($account_id,"No hay Posts de pagina promocionados"); 
         }