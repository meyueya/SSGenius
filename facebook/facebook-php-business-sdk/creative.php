<?php
//$f = insert_fb_data_day('act_1071159706331825'); //pec
//$f = insert_fb_data_day('act_1073271616120634'); //ilcb
//$f = insert_fb_data_day('act_1414429155338210'); //master_cuisine
//$f = insert_fb_data_day('act_1063559070425222'); //ulcb
header('Content-Type: application/json'); 
//error_reporting(E_ALL & ~E_NOTICE & E_DEPRECATED);
error_reporting(E_ALL);
ini_set('display_errors', 1);//
if (!defined('STDOUT'))
    define('STDOUT', fopen('php://stdout', 'w'));
define('SDK_DIR', __DIR__ . '/'); // Path to the SDK directory
   
define("DBHOST","localhost");
define("DBNAME","aiwroi_ilcb");
define("DBUSERNAME","aiwroi_aiwlcb");
define("DBPASSWORD","]a_nc#S}LthH");

$loader = include SDK_DIR.'/vendor/autoload.php';
$access_token = 'EAAbbxZAuuO9kBAPk6lL33uodC1Nl6iLyEfIqThnZAW02rFTQIlnhOLxxnvHZC1Vwq0HZCCZBoXzAIn5YkZAR9shj2QWSYXDZArLJQ5UAJkhyXwDP0XpsoCTAaEM2UQT0773PXZBOg3a5mfrWQ0ii0QZCo1dZC2ZA4zH3ivw88T4KgmGUwZDZD';
$app_id = '1930491627191257';
$app_secret = '934f83f24436ea82749ca6b5fafc6281';
$ad_account_id = 'act_1073271616120634';
// Configurations - End
if (is_null($access_token) || is_null($app_id) || is_null($app_secret)) {
  throw new \Exception(
    'You must set your access token, app id and app secret before executing'
  );
}
if (is_null($ad_account_id)) {
  throw new \Exception(
    'You must set your account id before executing');
}

use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Campaign;
use FacebookAds\Object\Fields\CampaignFields;
use FacebookAds\Object\Fields\AdAccountFields;
use FacebookAds\Object\AdsInsights;

use FacebookAds\Object\Ad;
use FacebookAds\Object\Fields\AdFields;

use FacebookAds\Object\AdCreative;
use FacebookAds\Object\Fields\AdCreativeFields;

$table = "ad_creative_facebook";
function insertAdsCreativesFacebook($cursor,$table){
         foreach ($cursor as $data) {
        $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSERNAME, DBPASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try
        {
            $conn->beginTransaction();
            $statement = $conn->prepare("INSERT INTO ".$table."(ad_id,creative_id,effective_object_story_id,thumbnail_url)
                VALUES(:ad_id,:creative_id,:effective_object_story_id,:thumbnail_url)");
            $stmt = $statement->execute(array(
                "ad_id" => $data['id'],
                "creative_id" => $data['creative']['id'],
                "effective_object_story_id" => $data['effective_object_story_id'],
                "thumbnail_url" => $data['thumbnail_url']
            ));
            if ( $stmt->error){
                $save = false;
                  $conn->rollback();
                    }
                    else{
                        $save = true;
                      $conn->commit();  
                    }
        } catch (PDOException $e) {
            error_log("Hubo un error en ".__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage(), 0);
             $save = false;
             $conn->rollback();
        }
    }
    return $save;
}


$api = Api::init($app_id, $app_secret, $access_token);
$api->setLogger(new CurlLogger());
//obtenemos los creativos de una cuenta
$params = array();
$fields = array('object_story_id'); 
//$creativesForAcount = (new AdAccount($ad_account_id))->getAdCreatives($fields, $params);
//print_r($creativesForAcount);
//exit();
echo "\n\n".PHP_EOL;
echo "---------------------------------------------------------------------------------ADCREATIVE------------------------------------------------------------------------";
echo "\n\n".PHP_EOL;
//obtenemos datos de un anuncio
//$ad = new Ad('23842896534470510');
//$ad->read(array('creative','configured_status','ad_review_feedback','conversion_specs','name','recommendations','source_ad','source_ad_id','status','tracking_specs','updated_time','display_sequence','adlabels','bid_amount','bid_info','bid_type','campaign','campaign_id'));
//print_r($ad);

//$creative = new AdCreative($ad->creative['id']);
//$creative->read(array(
//    AdCreativeFields::EFFECTIVE_OBJECT_STORY_ID,
//));
//echo $creative->effective_object_story_id;
// obtenemos los campos de un creativo
/*$creative = new AdCreative('23842812066730510'); //
$creative->read(array(
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
));
//echo $creative->effective_object_story_id;

echo "\n\n";
print_r($creative);
exit();
*/
echo "\n\n".PHP_EOL;
echo "---------------------------------------------------------------------------------ADCREATIVES------------------------------------------------------------------------";
echo "\n\n".PHP_EOL;
        



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
       
      print_r($arrayDataCreatives);  
echo "Tenemos ".$adcreatives->count()." anuncios creativos";
exit();
echo "\n\n".PHP_EOL;
echo $creative->thumbnail_url;
echo "\n\n".PHP_EOL;
echo $creative->effective_object_story_id;
echo "\n\n".PHP_EOL;
echo $creative->id;
//print_r($adcreatives);
echo "\n\n".PHP_EOL;
echo "---------------------------------------------------------------------------------ADS------------------------------------------------------------------------";
echo "\n\n".PHP_EOL;
$tiempo_inicio = microtime(true);
$account = new AdAccount($ad_account_id);
$ads = $account->getAds(array(
 'creative',
 'conversion_specs',
 'created_time',
 'effective_status',
 'name',
 'recommendations',
 'source_ad',
 'source_ad_id',
 'status',
 'updated_time',
 'tracking_specs',
 'adset_spec',
 'date_format',
 'display_sequence',
 'execution_options',
 'filename',
 'thumbnail_url',
 'last_updated_by_app_id',
 'effective_status',
 'configured_status',
 'bid_type',
 'bid_info',
 'bid_amount',
 'adlabels',
 'ad_review_feedback',
),$params);
print_r($ads);
$anuncios = $ads->getResponse()->getContent();
//echo json_encode($anuncios['data']);
echo "\n Hay ".count($ads)." anuncios \n";
exit();
//print_r($ads);
        $arrayDataAds = array();
        $newCursorAds = array();
    while ($ads->createAfterRequest() != null) {
        $newCursorAds = json_decode($ads->getResponse()->getBody(),true);
        $arrayDataAds = array_merge($arrayDataAds,$newCursorAds['data']);
        $ads->fetchAfter();
        }
      $tiempo_fin = microtime(true);
      echo "<br>\n\nTiempo de ejecucion de iteracion sobre el cursor de anuncios: " . round($tiempo_fin - $tiempo_inicio, 4)."\n\n";
      $tiempo_inicio = microtime(true);
        $newArrayDataAdsCreatives= array();
        foreach ($arrayDataAds as $newads){
            $creative = new AdCreative($newads['creative']['id']);
            $creative->read(array('effective_object_story_id','thumbnail_url'));
         $newads['effective_object_story_id']=$creative->effective_object_story_id; 
         $newads['thumbnail_url']=$creative->thumbnail_url;
         $newArrayDataAdsCreatives[] = $newads;
        }
         $tiempo_fin = microtime(true);
      echo "<br>\n\nTiempo de ejecucion de asignar datos de anuncios creativos a los anuncios: " . round($tiempo_fin - $tiempo_inicio, 4)."\n\n";
         //$adsInsert = insertAdsCreativesFacebook($newArrayDataAdsCreatives,$table);
     //print_r($newArrayDataAdsCreatives);    
      //print_r($arrayDataAds);
      
//$ads = $ads->getResponse()->getBody();
     // echo $ads; 
//print_r($ads);

$ads = $account->getAds($fields = array('id','creative','name'));
foreach($ads as $ad) {
//  echo $ad->name."\n";
//  echo $ad->id."\n";
//  print_r($ad->creative)."\n";
}
   echo "<br>Imprimiendo id creative de un ad<br>";  
$params = array();
$fields = array();  
$adCreativeForAd = (new Ad('23842845543560510'))->getAdCreatives($fields, $params);
foreach($adCreativeForAd as $adc) {
 $idCreative = $adc->id;
}
//echo $idCreative;
//print_r($adCreativeForAd);




