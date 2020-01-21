<?php
//header('Content-Type: application/json');
//error_reporting(E_ALL & ~E_NOTICE & E_DEPRECATED);
error_reporting(E_ALL);
ini_set('display_errors', 1);//
if (!defined('STDOUT'))
define('STDOUT', fopen('php://stdout', 'w'));
define('SDK_DIR', __DIR__ . '/'); // Path to the SDK directory
$loader = include SDK_DIR.'/vendor/autoload.php';
include ('util.php');
use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\AdsInsights;

function insert_fb_data($account_id,$since,$until,$table) {
// Configurations
// $app_id = '1930491627191257';
// $app_secret = '934f83f24436ea82749ca6b5fafc6281';
// $access_token = 'EAAbbxZAuuO9kBAAGq5NxyoTZASnFE1ZAW5a7hmONDGNKeJNVJlURDk63Mjlkxd4pVLAw5XEYO2ZA7CR4Ayur2hvGInJlqCMJIRdDF8rkjP5rZBUulOhf6CKyDGjeivbQ1U0qYUcwyqRDiAJZBhyhRj3xH2Aq7IzCRZCfFxpGD80dAZDZD';
// $app_id = '292708578241182';
// $app_secret = '462aeec937ca833dd9798c944d5c79e2';
// $access_token = 'EAAEKN4bUKp4BAMkDVU0QysRMazDcJOsZBZCvkbiwiUzjr3gVLTn1a9mmZB2hfcrZA21pbQ2ofEI0MMFa9ne1WcIbiFT6ZC5cRYFXhHbbjVZBPsBHDSmfE9uloDSB290ArTztDjl2TY7HygfdmiBvM95YpH19FCUFLGIaZCkMXRvqwZDZD';
// // Configurations - End
// if (is_null($access_token) || is_null($app_id) || is_null($app_secret)) {  throw new \Exception('You must set your access token, app id and app secret before executing');}
// if (is_null($account_id)) { throw new \Exception('You must set your account id before executing');}
//     $dia = date('Y-m-d',strtotime("-23 days"));//obtenemos el dia de ayer
//     $n_dia = 1;
//     if ($n_dia >= 1) {
//         //$since = $dia;//desde 2018-04-17
//         //$until = $dia;//hasta 2018-05-15
        
    echo('<pre>');
     print_r($account_id);die;
    echo('</pre>');
$app_id = '292708578241182';
$app_secret = '462aeec937ca833dd9798c944d5c79e2';
$access_token = 'EAAEKN4bUKp4BAMkDVU0QysRMazDcJOsZBZCvkbiwiUzjr3gVLTn1a9mmZB2hfcrZA21pbQ2ofEI0MMFa9ne1WcIbiFT6ZC5cRYFXhHbbjVZBPsBHDSmfE9uloDSB290ArTztDjl2TY7HygfdmiBvM95YpH19FCUFLGIaZCkMXRvqwZDZD';
$table = "aiw_facebook_data_ads";//tabla de guardado de insights ads 
//$table = "reportefacebook";//tabla de guardado de insights ads 

// Configurations - End
if (is_null($access_token) || is_null($app_id) || is_null($app_secret)) {  throw new \Exception('You must set your access token, app id and app secret before executing');}
if (is_null($ad_account_id)) { throw new \Exception('You must set your account id before executing');}

     $dia = date('Y-m-d',strtotime("- 23 days"));  
    //$dia = date('Y-m-d');//obtenemos el dia de ayer
    $n_dia = 1;
    if ($n_dia >= 1) {
        $since = $dia;//desde 2018-04-17
        $until = $dia;//hasta 2018-05-15
    // echo('<pre>');
    //  print_r($until);die;
    // echo('</pre>');
        $limit = 5000;//limite por cursor 5 mil es el máximo de facebook por petición al momento
        $fields = array(
            'ad_name',
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
                );
         $params = array(
            'time_range' => array('since' => $since, 'until' => $until),
            'filtering' => array(),
            'level' => 'ad',// nivel anuncio
            'time_increment' => 1,
            'limit' => $limit,
            'breakdowns' => array('age', 'gender'),//puede haber otros como country
            'sort' => 'date_start',
        );
        try {
        $tiempo_inicio = microtime(true);
        $api = Api::init($app_id, $app_secret, $access_token);
        $api->setLogger(new CurlLogger());
        $cursor = (new AdAccount('act_'.$account_id))->getInsights($fields, $params);
        $cursor->setUseImplicitFetch(true);
        $arrayData = array();
        $newCursor = array();
        while ($cursor->createAfterRequest() != null) {
        $newCursor = json_decode($cursor->getResponse()->getBody(),true);
        $arrayData = array_merge($arrayData,$newCursor['data']);
        $cursor->fetchAfter();
        }
        //echo count($arrayData);
        /*$spend = 0;
        foreach ($arrayData as $data){
            $spend = $spend + $data['spend'];
        }*/
        //echo '\n';
        //echo $spend;
        //echo '\n';
        //print_r($arrayData);
        $qtyBd = getCountFromtable($table,$since,$until,$account_id);
     echo "<pre>";
        var_dump($arrayData);
        echo "</pre>";
      die();
            if (($qtyBd != count($arrayData)) && (count($arrayData) > 0)){
               $deleteData = DeleteFromtableBetweenDates($table,$since,$until,$account_id);
               $saveData = saveInsightsForFacebookAccount($arrayData,$table);
             // echo "costo guardado: ".$saveData;
             $message = $since.' - <span class="success">'.$saveData.' registros guardados</span>';
            } else {  $message = $since.' - No hubo data o coincide la cantidad de registros'; }
        }catch (FacebookAds\Http\Exception\ServerException $e) {
             $message = "<span class='error'>".$since." - Error en servidor facebook: ".$e->getMessage().'</span>';
        }catch (FacebookAds\Exception\Exception $e) {
              $message = "<span class='error'>".$since." - Error tipo facebook exception: ".$e->getMessage().'</span>';
        }
    }
     $tiempo_fin = microtime(true);
     // echo "<br>\n\nTiempo de guardado en base de datos: " . round($tiempo_fin - $tiempo_inicio, 4)."\n\n";
    return $message. ' en '. round($tiempo_fin - $tiempo_inicio, 2).' segundos';
}

//$account_id = '216220169082098'; //PEC Le Cordon
//$account_id = '263704911080094'; //INSTITUTO LCB
//$account_id = '1071159706331825'; //PEC LCB
//$account_id = '1073271616120634'; //ilcb
$account_id = '1414429155338210'; //master_cuisine
//$account_id = '1063559070425222'; //ulcb

//$since = "2018-09-02";
//$until = "2018-09-02";
//$table = "reportefacebook2";

//$f = insert_fb_data($account_id,$since,$until,$table);
//echo $f;



