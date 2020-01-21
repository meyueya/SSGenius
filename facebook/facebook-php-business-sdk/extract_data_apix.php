<?php
header('Content-Type: application/json');
//error_reporting(E_ALL & ~E_NOTICE & E_DEPRECATED);
error_reporting(E_ALL);
ini_set('display_errors', 1);//
include ('functions.php');

if (!defined('STDOUT'))
    define('STDOUT', fopen('php://stdout', 'w'));

use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Campaign;
use FacebookAds\Object\Fields\CampaignFields;
use FacebookAds\Object\Fields\AdAccountFields;
use FacebookAds\Object\AdsInsights;
use FacebookAds\Object\Ad;
use FacebookAds\Object\AdCreative;
use FacebookAds\Object\Fields\AdCreativeFields;

use FacebookAds\Object\AdsPixel;

define("DBHOST","localhost");
define("DBNAME","aiwroi_pec");
define("DBUSERNAME","aiwroi_aiwlcb");
define("DBPASSWORD","]a_nc#S}LthH");
/*
* @return int
* @desc funcion que envia correos electronicos en formato html
*/
/*******************************************************************/
function inc_envio_mail($mail_destino,$asunto,$mensaje)
{
	//para el envío en formato HTML 
	$headers = "MIME-Version: 1.0\n"; 
	$headers .= "Content-type: text/html; charset=iso-8859-1\n"; 
	$headers .= "From: $datos_remitente\n"; 
	//$headers .= "Reply-To: $responder_a\r\n"; 
	
	$resultado=mail($mail_destino,$asunto,$mensaje,$headers);
	return $resultado;
}
  
function insertInsightsInTableReportFacebook($cursor,$table){
         foreach ($cursor as $data) {
        $link = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSERNAME, DBPASSWORD);
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try
        {
            $link->beginTransaction();
            $statement = $link->prepare("INSERT INTO ".$table."(date_start,date_stop,ad_name,ad_id,adset_name,adset_id,campaign_name,campaign_id,impressions,clicks,spend,objective,gender,age)
                VALUES(:date_start,:date_stop,:ad_name,:ad_id,:adset_name,:adset_id,:campaign_name,:campaign_id,:impressions,:clicks,:spend,:objective,:gender,:age)");
            $statement->execute(array(
                "date_start" => $data['date_start'],
                "date_stop" => $data['date_stop'],
                "ad_name" => addslashes($data['ad_name']),
                "ad_id" => $data['ad_id'],
                "adset_name" => addslashes($data['adset_name']),
                "adset_id" => $data['adset_id'],
                "campaign_name" => addslashes($data['campaign_name']),
                "campaign_id" => $data['campaign_id'],
                "impressions" => $data['impressions'],
                "clicks" => $data['clicks'],
                "spend" => $data['spend'],
                "objective" => $data['objective'],
                "gender" => $data['gender'],
                "age" => $data['age']
            ));
            if ($statement->error){
                $save = false;
                  $link->rollback();
                    }
                    else{
                        $save = true;
                      $link->commit();  
                    }
        } catch (PDOException $e) {
            error_log("Hubo un error en ".__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage(), 0);
             $save = false;
             $link->rollback();
        }
    }
    return $save;
}

function insert_fb_data_day($ad_account_id) {
    // Configurations
$app_id = '292708578241182';
$app_secret = '462aeec937ca833dd9798c944d5c79e2';
$access_token = 'EAAEKN4bUKp4BAMkDVU0QysRMazDcJOsZBZCvkbiwiUzjr3gVLTn1a9mmZB2hfcrZA21pbQ2ofEI0MMFa9ne1WcIbiFT6ZC5cRYFXhHbbjVZBPsBHDSmfE9uloDSB290ArTztDjl2TY7HygfdmiBvM95YpH19FCUFLGIaZCkMXRvqwZDZD';
define('SDK_DIR', __DIR__ . '/'); // Path to the SDK directory
$loader = include SDK_DIR.'/vendor/autoload.php';
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
    $dia = "";
    //$dia = '2018-07-03';
    $dia = date('Y-m-d',strtotime("-1 days"));//obtenemos el dia de ayer
    $n_dia = 1;
    if ($n_dia >= 1) {
        $limit = 2000;
        $fields = array(
            'ad_name',
            'adset_name',
            'campaign_name',
            'campaign_id',
            'adset_id',
            'ad_id',
            'impressions',
            'clicks',
            'spend',
            'objective',
            'date_start',
            'date_stop',
            //'reach',
            //'action_values',
            //'actions',
           //'results',
            //'frequency',
           //'cpp',
           //'cost_per_result',
            //'cpm',
           // 'place_page_name',
           // 'inline_post_engagement',
            //'cost_per_total_action',
            //'total_unique_actions',
            //'actions:page_engagement',
            //'actions:like',
            //'actions:mention',
            //'actions:tab_view',
            //'actions:comment',
            //'actions:post_engagement',
            //'actions:post_reaction',
            //'actions:post',
            //'actions:photo_view',
           // 'actions:rsvp',
            //'actions:receive_offer',
            //'actions:checkin',
            //'cost_per_action_type:page_engagement',
            //'cost_per_action_type:like',
            //'cost_per_action_type:mention',
            //'cost_per_action_type:tab_view',
            //'cost_per_action_type:comment',
            //'cost_per_action_type:post_engagement',
            //'cost_per_action_type:post_reaction',
            //'cost_per_action_type:post',
            //'cost_per_action_type:photo_view',
            //'cost_per_action_type:rsvp',
            //'cost_per_action_type:receive_offer',
            //'cost_per_action_type:checkin',
             //'unique_video_continuous_2_sec_watched_actions:video_view',
             // 'video_continuous_2_sec_watched_actions:video_view',
             // 'actions:video_view',
              //'video_10_sec_watched_actions:video_view',
              //'video_30_sec_watched_actions:video_view',
              //'video_p25_watched_actions:video_view',
              //'video_p50_watched_actions:video_view',
              //'video_p75_watched_actions:video_view',
              //'video_p95_watched_actions:video_view',
              //'video_p100_watched_actions:video_view',
              //'video_avg_time_watched_actions:video_view',
             // 'video_avg_percent_watched_actions:video_view',
            /*  'canvas_avg_view_time',
              'canvas_avg_view_percent',
              'cost_per_10_sec_video_view',
              'cost_per_action_type',
              'video_10_sec_watched_actions',
              'video_30_sec_watched_actions',
              'video_avg_percent_watched_actions',
              'video_avg_time_watched_actions',
              'video_p100_watched_actions',
              'video_p25_watched_actions',
              'video_p50_watched_actions',
              'video_p75_watched_actions',
              'video_p95_watched_actions',*/
              //'canvas_component_avg_pct_view:canvas_view',
              //'cost_per_2_sec_continuous_video_view:video_view',
             // 'cost_per_action_type:video_view',
             // 'cost_per_10_sec_video_view:video_view',
              //'actions:link_click',
              //'unique_actions:link_click',
             // 'outbound_clicks:outbound_click',
             // 'unique_outbound_clicks:outbound_click',
            //  'website_ctr:link_click',
             // 'unique_link_clicks_ctr',
             // 'outbound_clicks_ctr:outbound_click',
             // 'unique_outbound_clicks_ctr:outbound_click',
              //'call_to_action_clicks',
              'clicks',
              //'unique_clicks',
              //'ctr',
              //'unique_ctr',
              //'social_clicks',
              //'unique_social_clicks',
            //  'account_currency',
              //'cost_per_action_type:link_click',
             // 'cost_per_unique_action_type:link_click',
              //'cost_per_outbound_click:outbound_click',
              //'cost_per_unique_outbound_click:outbound_click',
             /* 'cost_per_outbound_click',
              'cost_per_inline_post_engagement',
              'cost_per_inline_link_click',
              'website_purchase_roas',
              'cpc',
              'cost_per_unique_click',
              'estimated_ad_recallers',
              'estimated_ad_recall_rate',
              'cost_per_estimated_ad_recallers',
              'account_id',
              'account_name',
              'buying_type',
              'cpc',
              'ctr',
              'relevance_score',*/
              //'social_impressions',
              //'total_actions',
                );
         $params = array(
            'time_range' => array('since' => '2018-07-26', 'until' =>  '2018-07-26'),
            'filtering' => array(),
            'level' => 'ad',
            'time_increment' => 1,
            'limit' => $limit,// 5 mil es el máximo de facebook por petición al momento
            'breakdowns' => array('age', 'gender'),
            'sort' => 'date_start',
        );
        $table = "aiw_facebook_data_ads";
        function getCountFromtable($table,$since,$until){
          try {
                $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSERNAME, DBPASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT * FROM ".$table." WHERE date_start BETWEEN '".$since."' AND '".$until."'"); 
                $stmt->execute();
                $qtyBd = $stmt->Rowcount();
                return $qtyBd;
                }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
            }
        function DeleteFromtableBetweenDates($table,$since,$until){
          try {
                $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSERNAME, DBPASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("DELETE FROM ".$table." WHERE date_start BETWEEN '".$since."' AND '".$until."'"); 
                $stmt->execute();
                $qtyBd = $stmt->Rowcount();
                return "DELETE FROM ".$table." WHERE date_start BETWEEN '".$since."' AND '".$until."'";
                }
                catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
                $conn = null;
            }            
            
        try {
        $api = Api::init($app_id, $app_secret, $access_token);
        $api->setLogger(new CurlLogger());
        $tiempo_inicio = microtime(true);
        $params = array(
            'time_range' => array('since' => '2016-06-01', 'until' =>  '2018-09-06'),
            'filtering' => array(),
            'level' => 'ad',
            'time_increment' => 1,
            'limit' => $limit,// 5 mil es el máximo de facebook por petición al momento
            'breakdowns' => array('age', 'gender'),
            'sort' => 'date_start',
        );
         $fields = array(
            'account_id',
            //'account_name',
            //'ad_name',
            //'adset_name',
            //'campaign_name',
            //'campaign_id',
            //'adset_id',
            'ad_id',
           // 'impressions',
            //'clicks',
            'spend',
            //'objective',
            'date_start',
            'date_stop',
            'reach',
            'clicks',);
            /*$params = array(
                  'level' => 'account',
                  'breakdowns' => array('age', 'gender'),
                  'time_increment' => 1,
                  'date_preset' => 'yesterday',
                  'fields' => 'spend',
                 );*/
        $ad = (new Ad('23842897294210510'))->getInsights($fields, $params);
       print_r($ad);
        exit();
        
        $cursor = (new AdAccount($ad_account_id))->getInsights($fields, $params);
        $cursor->setUseImplicitFetch(true);
        //print_r($cursor);
        //exit();
        $arrayData = array();
        $newCursor = array();
        while ($cursor->createAfterRequest() != null) {
        $newCursor = json_decode($cursor->getResponse()->getBody(),true);
        $arrayData = array_merge($arrayData,$newCursor['data']);
        $cursor->fetchAfter();
        }
        echo 'registros: '.count($arrayData).'\n\n';
        $spend = 0;
        foreach ($arrayData as $data){
            $spend = $spend + $data['spend'];
        }
        echo $spend;
        echo '<br>';
        print_r($arrayData);
        exit();
         $tiempo_fin = microtime(true);
      echo "<br>\n\nTiempo de ejecución de while sobre el cursor: " . round($tiempo_fin - $tiempo_inicio, 4)."\n\n";
          $tiempo_inicio = microtime(true);
         $querys  = array(
    array('method' => 'GET','relative_url' => '/act_1487762988004826/insights?limit=2822&level=ad&time_increment=1&breakdowns=age,gender&time_range={"since":"2018-07-10","until":"2018-07-20"}&sort=date_start&fields=ad_name,adset_name,campaign_name,campaign_id,adset_id,ad_id,impressions,clicks,spend,objective,date_start,date_stop'),
    array('method' => 'GET','relative_url' => '/act_1487762988004826/insights?limit=2822&after=MAZDZD&level=ad&time_increment=1&breakdowns=age,gender&time_range={"since":"2018-07-20","until":"2018-07-20"}&sort=date_start&fields=ad_name,adset_name,campaign_name,campaign_id,adset_id,ad_id,impressions,clicks,spend,objective,date_start,date_stop'),
    //array('method' => 'GET','relative_url' => '/act_1073271616120634/ads?limit=100&level=ad&time_increment=1')
   // array('method' => 'GET','relative_url' => '/act_1073271616120634/adspixels')
);
$params = array('batch' => json_encode($querys));
try {
//$responsex = $api->call('/', 'POST', $params); 
} catch(FacebookApiException $e) {
    error_log($e);
    $responsex = null;
    echo "esta Vacio";
}
if(!empty($responsex)){
 /* if($responsex[0]['code'] == '200'){
        $user_profile = json_decode($responsex[0]['body']);
    }
    if($responsex[1]['code'] == '200'){
        $user_albums  = json_decode($responsex[1]['body']);
    }*/
    echo "No esta vacio";
    //print_r($responsex);
   // echo json_decode($responsex[0]['body'],true);
    echo "\n\n".PHP_EOL;
echo "---------------------------------------------------------------------------------ADCREATIVES------------------------------------------------------------------------";
echo "\n\n".PHP_EOL;
    //print_r($responsex);
    

} else { echo "Esta vacio";}

      $tiempo_fin = microtime(true);
      echo "<br>\n\nTiempo de ejecución de llamadas Batch: " . round($tiempo_fin - $tiempo_inicio, 4)."\n\n";
      
     // exit();
         if ($cursor->count() > 0) {
          echo "Hay ".$cursor->count()." registros en el cursor ".PHP_EOL;
          echo " desde: <b>".$params['time_range']['since']."</b> - Hasta: <b>".$params['time_range']['until']."</b><br>";
        }
         //print_r($arrayData);
        $qtyBd = getCountFromtable($table,$params['time_range']['since'],$params['time_range']['until']);
        if (($qtyBd != count($arrayData)) && (count($arrayData) > 0)){
             $tiempo_inicio = microtime(true);
           // $deleteData = DeleteFromtableBetweenDates($table,$params['time_range']['since'],$params['time_range']['until']);
           //$saveData = insertInsightsInTableReportFacebook($arrayData,$table);
           $tiempo_fin = microtime(true);
      echo "<br>\n\nTiempo de guardado en base de datos: " . round($tiempo_fin - $tiempo_inicio, 4)."\n\n";
        if ($deleteData){ echo "<br>se eliminó registros en la tabla: <b>".$table."</b> desde ".$params['time_range']['since']." hasta ".$params['time_range']['until'];} else {echo "<br>No se eliminó registros en la tabla: <b>".$table."</b>";}
        if ($saveData){ echo "<br>Guardó en la tabla: <b>".$table."</b>";} else {echo "<br>No guardó en la tabla: <b>".$table."</b>";}
        } else { echo "<br>No hubo inserción de data, porque o no hay registros en facebook o ya fueron insertados anteriormente.<br>";}
        }catch (FacebookAds\Http\Exception\ServerException $e) {
              echo "Mensaje de error en servidor facebook: ".$e->getMessage();
            //inc_envio_mail("mario@mimirwell.com","Job fállido en ".__FILE__,"Probablemente la petición superó en mucho el limite de 5000 registros que facebook tiene a hoy 18 de julio de 2018 \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
        }
    }   
}

//$f = insert_fb_data_day('act_1071159706331825'); //pec
//$f = insert_fb_data_day('act_1073271616120634'); //ilcb
//$f = insert_fb_data_day('act_263704911080094'); //INSTITUTO LCB
//$f = insert_fb_data_day('act_1414429155338210'); //master_cuisine
//$f = insert_fb_data_day('act_1063559070425222'); //ulcb
$f = insert_fb_data_day('act_1487762988004826'); //moviltours
 
