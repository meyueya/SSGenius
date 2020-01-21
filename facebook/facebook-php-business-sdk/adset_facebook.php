<?php
//header('Content-Type: application/json');
//error_reporting(E_ALL & ~E_NOTICE & E_DEPRECATED);
//error_reporting(E_ALL);
ini_set('display_errors', 1);
if (!defined('STDOUT'))
define('STDOUT', fopen('php://stdout', 'w'));
define('SDK_DIR', __DIR__ . '/');
 // Path to the SDK directory
$loader = include SDK_DIR.'/vendor/autoload.php';
include ('util.php');
use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\AdsInsights;
use FacebookAds\Object\AdSet;
use FacebookAds\Object\Fields\AdSetFields;
//$account_id = explode('act_',$ad_account_id);
//$account_id = $account_id[1];
function saveAdsetsForFacebookAccount($ad_account_id){
$app_id = '1930491627191257';
$app_secret = '934f83f24436ea82749ca6b5fafc6281';
$access_token = 'EAAbbxZAuuO9kBAAGq5NxyoTZASnFE1ZAW5a7hmONDGNKeJNVJlURDk63Mjlkxd4pVLAw5XEYO2ZA7CR4Ayur2hvGInJlqCMJIRdDF8rkjP5rZBUulOhf6CKyDGjeivbQ1U0qYUcwyqRDiAJZBhyhRj3xH2Aq7IzCRZCfFxpGD80dAZDZD';
$api = Api::init($app_id, $app_secret, $access_token);
        $api->setLogger(new CurlLogger());
$params = array(
           'limit' => '5000'
        );
             
    $account = new AdAccount($ad_account_id);
     $params = array(
        'limit' => '5000',// 5 mil es el maximo de facebook por petici0n al momento
    );
    $adsets = $account->getAdSets(array(
          AdSetFields::ID,
          AdSetFields::ACCOUNT_ID,
          AdSetFields::CAMPAIGN_ID,
          AdSetFields::NAME,
          AdSetFields::EFFECTIVE_STATUS,
          AdSetFields::CREATED_TIME,
          AdSetFields::START_TIME,
          AdSetFields::END_TIME,
          AdSetFields::TARGETING
),$params);
//echo count($adsets).' conjuntos de anuncios';
//print_r($adsets);
$account_id = explode('act_',$ad_account_id);
$account_id = $account_id[1];
DeleteTotalDataOfTableForAccount('adset_facebook',$account_id);
foreach ($adsets as $adset) {
$age_max = "";
$age_min = "";
$interest = "";
$industries = "";
$education_statuses = "";
$exclusions_education_statuses = "";
$behaviors = "";
$end_time = "";
$targeting = $adset->{AdSetFields::TARGETING};
//print_r($targeting);
if (!empty($targeting)) {
    $age_max = $targeting['age_max'];
    $age_min = $targeting['age_min'];
    
 if (isset($targeting['flexible_spec'][0]['interests'])) {    
        foreach ($targeting['flexible_spec'][0]['interests'] as $interes){
            $interest .= $interes['name'].", ";
        }
    }
    
      if (isset($targeting['exclusions']['education_statuses'])) {    
 $exclusions_education_statuses = json_encode($targeting['exclusions']['education_statuses']);
    } else { $exclusions_education_statuses = "";}
    
 if (isset($targeting['flexible_spec'][0]['education_statuses'])) {  
       $education_statuses = json_encode($targeting['flexible_spec'][0]['education_statuses']);
    } else { $education_statuses = "";} 
    
    
  if (isset($targeting['flexible_spec'][0]['industries'])) {    
        foreach ($targeting['flexible_spec'][0]['industries'] as $industrias){
            $industries .= $industrias['name'].", ";
        }
    }   
    
     if (isset($targeting['flexible_spec'][0]['behaviors'])) {    
        foreach ($targeting['flexible_spec'][0]['behaviors'] as $comportamiento){
            $behaviors .= $comportamiento['name'].", ";
        }
    }
}
$adset_id = $adset->{AdSetFields::ID};
$acount_id = $adset->{AdSetFields::ACCOUNT_ID};
$campaign_id = $adset->{AdSetFields::CAMPAIGN_ID};
$name = $adset->{AdSetFields::NAME};
$effective_status = $adset->{AdSetFields::EFFECTIVE_STATUS};
$created_time = $adset->{AdSetFields::CREATED_TIME};
$start_time = $adset->{AdSetFields::START_TIME};
$end_time = $adset->{AdSetFields::END_TIME};
if (!isset($end_time)){ $end_time = "";}
$interest = rtrim($interest,', ');
$industries = rtrim($industries,', ');
$geo_locations =  json_encode($targeting['geo_locations']);
$behaviors = rtrim($behaviors,', ');
$saveAdsets = insertAdSetsFacebook($adset_id,$acount_id,$campaign_id,$name,$effective_status,$created_time,$start_time,$end_time,$age_max,$age_min,$interest,$education_statuses,$exclusions_education_statuses,$behaviors,$geo_locations,$industries);
//echo $saveAdsets;
}

}
saveAdsetsForFacebookAccount('act_1487762988004826'); // Instituto LCB