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
//$_SESSION = array();
use FacebookAds\Api;
use FacebookAds\Session;
use FacebookAds\Http\RequestInterface;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Campaign;
use FacebookAds\Object\AdsInsights;
use FacebookAds\Object\Ad;
use FacebookAds\Object\AdCreative;
use FacebookAds\Http\Response;

require_once( '/home/aiwroi/public_html/ssgenius.com/app/facebook/php-sdk-5/vendor/autoload.php' );

    $app_id = '1930491627191257';
    $app_secret = '934f83f24436ea82749ca6b5fafc6281';
    

    /*if (isset($_GET['adaccount'])){
       $account_id =  $_GET['adaccount'];
       $ad_account_id = 'act_'.$account_id;
       $access_token = $FacebookModel->getTokenForFacebookAdAccount($account_id);
       
    }
    else { 
        exit();
    }*/
    $account_id = "1487762988004826";
    $ad_account_id = 'act_'.$account_id;
    $access_token = "EAAbbxZAuuO9kBALPUzkWcOZALFnchQYfSZAoZBF7mETsXi65Tv00N4HkgTCJIObxYf4G1mZAi8apUZAcydzzMe4re4kPowbnupS17PDn2IwBX54j1jZCD3mDCor30Y5xfD7d9PPIixUq0ZBQm2m8tZB70Gfr7VTQTfqnqNhZCZB0H7pdAZDZD";
    $page_token ="EAAbbxZAuuO9kBAFNa3yuU0s1fSuvzkA8j0uR4ebt7Jwy3mhInq3jn4P8XiWNrECMiyyoIfyyDZBXsMJB7PHACr3ICZBQgPrujbZAJM2DZAGWv0rqW9V0XZC84QJHx9SphNherefZBHLO0cxeZBHWzbURvCnTeW0fZAzJ8xykOYPp7EwZDZD";
    $id_page = '192597304105183'; 
  $fb = new Facebook\Facebook([
  'app_id'                => $app_id,
  'app_secret'            => $app_secret,
  'default_graph_version' => 'v3.2',
]);
//debug token
try {
  // Returns a `Facebook\FacebookResponse` object
  //$response = $fb->get('/debug_token?input_token=EAAEKN4bUKp4BAIK8JsyKiqpHsSjki8BCBRa2qLYvFTSUMM9ntdbWcjMtDWiF7usNeOFVEOkv6KaJk0m3LC8vHDNU4rYMmUUM7VJFNMAEdB7twsmg9StoyTSzWZCDosZBiyj09cKgMkZC3fwn2N9o22AsahBBp0STZCjg0ecAVQZDZD',$access_token);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
//$graphNode = $response->getGraphNode();
echo "<pre>";
//print_r($graphNode);
echo "</pre>";
   // $cuentas = $fb->get('/me/adaccounts?fields=id,account_id,name,account_status,business&limit=25', $access_token)->getDecodedBody();
//exit();

    // Configurations - End
    if (is_null($access_token) || is_null($app_id) || is_null($app_secret)) {  throw new \Exception('You must set your access token, app id and app secret before executing'  );}
    if (is_null($ad_account_id)) {  throw new \Exception(    'You must set your account id before executing');}


    $api = Api::init($app_id, $app_secret, $access_token);
    //$api->setDefaultGraphVersion("3.2");
    $api->setLogger(new CurlLogger());
    $tiempo_inicio = microtime(true);
    $account = new AdAccount($ad_account_id);
    
    $page_session = new Session($app_id, $app_secret, $page_token);
    $page_api = new Api($api->getHttpClient(), $page_session);
    $page_api->setLogger($api->getLogger());
    
    $since = date('Y-m-d',strtotime("-3 month"));   
    $until = date("Y-m-d");
    $params = array(
    'since'=>$since,
    'until'=>$until, //rango de 90 dias
    //'date_preset'=>'last_year',
  // 'fields' => $arrayFields,
 'metric' => array('page_fans_gender_age'),
); 
$data = $page_api->call('/'.$id_page.'/insights', RequestInterface::METHOD_GET,$params)->getContent();//obtener las reacciones de un post
echo "<pre>";
print_r($data);
echo "</pre>";
exit();
    $params = array(
        'date_preset' => 'lifetime',
        'include_headers' => 'false',
        'limit' => '5000',// 5 mil es el maximo de facebook por petici0n al momento
    );
    
        $paramsAccountCreatives = array('date_preset' => 'lifetime','include_headers' => 'false','limit' => '5000', 'level'=> 'ad');
    $fieldsAccountCreatives = array('object_story_id','ad_id','id');
   //$insightsAccountCreatives = json_decode($account->getAdCreatives($fieldsAccountCreatives, $paramsAccountCreatives)->getResponse()->getBody(),true);
        echo "<pre>";
   // print_r($insightsAccountCreatives);
    echo "</pre>";
    //exit();
   
    
    
    $paramsAccount = array(
        'time_range' => array('since' => '2016-12-19', 'until' =>  '2018-12-19'),
        //'date_preset' => 'lifetime',
        'include_headers' => 'false',
        'limit' => '5000', 
        'level'=> 'ad'
        );
    //$fieldsAccount = array('account_id','account_name','campaign_id','campaign_name','ad_id','ad_name','adset_id','adset_name','clicks','reach','spend','impressions','objective','cpc','cpm','relevance_score','actions');
    $fieldsAccount = array('ad_id','reach','spend');
    $insightsAccount = json_decode($account->getInsights($fieldsAccount, $paramsAccount)->getResponse()->getBody(),true);

        echo "<pre>";
    print_r($insightsAccount);
    echo "</pre>";
    exit();
    
    
    $campaigns = $account->getCampaigns(array('name,objective'),$params = array());
    echo "<pre>";
   // print_r($campaigns);
    echo "</pre>";
    
    $campaign = new Campaign('23843191408300497');
    $paramsCampaign = array('date_preset' => 'lifetime','include_headers' => 'false','limit' => '5000', 'level'=> 'ad');
    $fieldsCampaign = array('reach','spend','ad_id','impressions');
    //$insightsCampaign = json_decode($campaign->getInsights($fieldsCampaign, $paramsCampaign)->getResponse()->getBody(),true);
        echo "<pre>";
    //print_r($insightsCampaign);
    echo "</pre>";
    //exit();
   try{
        //$ads = $account->getAds(array('creative{object_story_id},insights{spend,reach}',),$params);
        //$ads = $account->getAds(array('creative{account_id,id,body,object_story_id,effective_object_story_id,image_url,link_url,name,object_story_spec,object_type,object_url,video_id}'),$params);
        $ads = $account->getAds(array('creative{object_story_id}'),$params);
        $arrayDataAds = array();
        $newCursorAds = array();
    while ($ads->createAfterRequest() != null) {
        $newCursorAds = json_decode($ads->getResponse()->getBody(),true);
        $arrayDataAds = array_merge($arrayDataAds,$newCursorAds['data']);
        $ads->fetchAfter();
        }
        if (count($arrayDataAds) == 0){ 
            $FacebookModel->UpdateMessageFacebookAdAccount($account_id,"no hay data");
            exit();
        }
        $c = 0;
        echo "creativos con anuncio";
        $arrayCreativo = array();
        foreach($arrayDataAds as $KeyCreative => $ValueCreative){
            if (isset($ValueCreative['creative']['object_story_id'])){
                $arrayCreativo[$c]['ad_id'] = $ValueCreative['id'];
                $arrayCreativo[$c]['creative_id'] = $ValueCreative['creative']['id'];
                $arrayCreativo[$c]['object_story_id'] = $ValueCreative['creative']['object_story_id'];
                $c++;
            }
        }
        echo "<pre>";
        //print_r($arrayCreativo);
        //print_r($arrayDataAds);
        echo "</pre>";
         $ArrayDataAdAccount = array();
         $c = 0;
         foreach ($insightsAccount['data'] as $inAccount){
            foreach ($arrayCreativo as $creativo){
              if ($inAccount['ad_id'] == $creativo['ad_id'])
              {
                $updated_time = date('Y-m-d H:i:s');
                $ArrayDataAdAccount[$c]['id_adaccount'] = $account_id;
                $ArrayDataAdAccount[$c]['id_ad'] = $inAccount['ad_id'];
                $ArrayDataAdAccount[$c]['creative_id'] = $creativo['creative_id'];
                $ArrayDataAdAccount[$c]['ad_reach'] = $inAccount['reach'];
                $ArrayDataAdAccount[$c]['ad_spend'] = $inAccount['spend'];
                $ArrayDataAdAccount[$c]['object_story_id'] = $creativo['object_story_id'];
                $ArrayDataAdAccount[$c]['updated_time'] = $updated_time;
                $c++;
              }
            }     
         }
         echo "<pre>";
print_r($ArrayDataAdAccount);
echo "</pre>";



      //  exit();
        
        
        /*foreach ($arrayDataAds as $data)
        {
        if (isset($data['creative']['object_story_id'])){  
            $ad = new Ad($data['id']);
                $paramsAd = array('date_preset' => 'lifetime','include_headers' => 'false','limit' => '5000');
                $fieldsAd = array('reach','spend');
                $insightsAd = json_decode($ad->getInsights($fieldsAd, $paramsAd)->getResponse()->getBody(),true);
                echo "<pre>";
               print_r($ad->getInsights($fieldsAd, $paramsAd)->getResponse()->getHeaders());
                echo "</pre>";
                    if ((isset($insightsAd['data']['0']['reach'])) && (isset($insightsAd['data']['0']['spend']))){
                    $updated_time = date('Y-m-d H:i:s');
                    $ArrayDataAdAccount[$c]['id_adaccount'] = $account_id;
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
        */
   } catch(\Exception $e){
       echo $e->getMessage();
       $FacebookModel->UpdateMessageFacebookAdAccount($account_id,$e->getMessage());
   }  
        
        $dataCountBeforeAdAccount = count($FacebookModel->getAdAccountData($account_id));
        $countAdAccountData = count($ArrayDataAdAccount);
       // echo "<pre>";
        //print_r($ArrayDataAdAccount);
      //  echo "</pre>";
      //  exit();
         if  ($countAdAccountData > 0){
             $FacebookModel->deleteAdsForAdAccount($account_id);
             $FacebookModel->SaveFacebookAdAccountData($ArrayDataAdAccount);
             $FacebookModel->UpdateMessageFacebookAdAccount($account_id,"ok");
         }