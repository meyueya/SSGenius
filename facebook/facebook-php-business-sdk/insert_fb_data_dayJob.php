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

use FacebookAds\Object\TargetingSearch;
use FacebookAds\Object\Search\TargetingSpecs;
use FacebookAds\Object\Search\TargetingSearchTypes;

use FacebookAds\Object\AdSet;
use FacebookAds\Object\Fields\AdSetFields;
function insert_fb_data_day($ad_account_id) {
// Configurations
$account_id = explode('act_',$ad_account_id);
    //   echo('<pre>');
    //      var_dump($account_id);die;
    //     echo('</pre>');
    //     die;
$account_id = $account_id[1];
// $app_id = '292708578241182';
// $app_secret = '462aeec937ca833dd9798c944d5c79e2';
// $access_token = 'EAAEKN4bUKp4BAMkDVU0QysRMazDcJOsZBZCvkbiwiUzjr3gVLTn1a9mmZB2hfcrZA21pbQ2ofEI0MMFa9ne1WcIbiFT6ZC5cRYFXhHbbjVZBPsBHDSmfE9uloDSB290ArTztDjl2TY7HygfdmiBvM95YpH19FCUFLGIaZCkMXRvqwZDZD';
$app_id = '292708578241182';
$app_secret = '462aeec937ca833dd9798c944d5c79e2';
$access_token = 'EAAEKN4bUKp4BAAbZAYCAIKCePR62tvLX9y76VK62ZCLKgWEr0XY4hV29WvD4MSdLT3wOTnfZC8zRLZCyhlMdIsp32ZBRzM6OwNCgVwp9DW9MHU7yKDw7bLLOAi5MkKSTmY0ZCkJ3rtu2LHjpPsAQ7y4d5YajIe8JR5HhY4r33d0QZDZD';
$table = "aiw_facebook_data_ads";//tabla de guardado de insights ads 
//$table = "reportefacebook";//tabla de guardado de insights ads 
// Configurations - End
if (is_null($access_token) || is_null($app_id) || is_null($app_secret)) {  throw new \Exception('You must set your access token, app id and app secret before executing');}
if (is_null($ad_account_id)) { throw new \Exception('You must set your account id before executing');}
//$dia = date('Y-m-d',strtotime("- 91 days"));
    $dia = date('Y-m-d');//obtenemos el dia de ayer
    //   echo('<pre>');
    //      var_dump($dia);die;
    //     echo('</pre>');
    $n_dia = 1;
    
    if ($n_dia >= 1) {
        $since = $dia;//desde 2018-04-17
        $until = $dia;//hasta 2018-05-15
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
            //'actions',
            //'cost_per_action_type',
            'objective',
            'date_start',
            'date_stop',
                );
         $params = array(
            'time_range' => array('since' => $since, 'until' => $until),
             //'filtering' => array(array('field' => 'delivery_info','operator' => 'IN','value' => array('inactive','active','limited','archived','permanently_deleted','completed','recently_completed','not_delivering','not_published','rejected','recently_rejected','rejected','pending_review','scheduled'))),
            //'filtering' => array(array('field' => 'action_type','operator' => 'IN','value' => array('like','link_click','post_engagement'))),
            'level' => 'ad',// nivel anuncio
            'time_increment' => 1,
            'type' => 'adinterest',
            'limit' => $limit,
            'breakdowns' => array('age', 'gender'),//puede haber otros como country
            'sort' => 'date_start',
        );
        try {
        $api = Api::init($app_id, $app_secret, $access_token);
        $api->setLogger(new CurlLogger());
        $cursor = (new AdAccount($ad_account_id))->getInsights($fields, $params);
        $cursor->setUseImplicitFetch(true);
        $arrayData = array();
        $newCursor = array();
        while ($cursor->createAfterRequest() != null) {
        $newCursor = json_decode($cursor->getResponse()->getBody(),true);
        $arrayData = array_merge($arrayData,$newCursor['data']);
        $cursor->fetchAfter();
        }
        
        foreach ($arrayData as $keysValue => $newArrayData){
                $likepage = 0;
                $link_click = 0;
                $post_engagement = 0;
                $post_reaction = 0;
                $comment = 0;
                $post = 0;
                $cost_likepage = 0;
                $cost_link_click = 0;
                $cost_post_engagement = 0;
                $cost_post_reaction = 0;
                $cost_comment = 0;
                $cost_post = 0;
                if (isset($newArrayData['actions'])) {
                foreach($newArrayData['actions'] as $actions){
                    switch ($actions['action_type']){
                        case 'like':
                             $likepage = $actions['value'];
                        break;
                        case 'link_click':
                             $link_click = $actions['value'];
                        break;
                        case 'post_engagement':
                             $post_engagement = $actions['value'];
                        break;
                        case 'post_reaction':
                             $post_reaction = $actions['value'];
                        break;
                        case 'comment':
                             $comment = $actions['value'];
                        break;
                         case 'post':
                             $post = $actions['value'];
                        break;
                    }
                }
            } 
            
                if (isset($newArrayData['cost_per_action_type'])) {
                foreach($newArrayData['cost_per_action_type'] as $cost_per_action_type){
                    switch ($cost_per_action_type['action_type']){
                        case 'like':
                             $cost_likepage = $cost_per_action_type['value'];
                        break;
                        case 'link_click':
                             $cost_link_click = $cost_per_action_type['value'];
                        break;
                        case 'post_engagement':
                             $cost_post_engagement = $cost_per_action_type['value'];
                        break;
                        case 'post_reaction':
                             $cost_post_reaction = $cost_per_action_type['value'];
                        break;
                        case 'comment':
                             $cost_comment = $cost_per_action_type['value'];
                        break;
                         case 'post':
                             $cost_post = $cost_per_action_type['value'];
                        break;
                    }
                }
            } 
            
             $arrayData[$keysValue]['likepage'] = $likepage;
             $arrayData[$keysValue]['link_click'] = $link_click;
             $arrayData[$keysValue]['post_engagement'] = $post_engagement;
             $arrayData[$keysValue]['post_reaction'] = $post_reaction;
             $arrayData[$keysValue]['comment'] = $comment;
             $arrayData[$keysValue]['post'] = $post;
             $arrayData[$keysValue]['cost_likepage'] = $cost_likepage;
             
        echo('<pre>');
         var_dump($arrayData);die;
        echo('</pre>');
        die;
        }
        //echo count($arrayData);
        
 /*       
    $account = new AdAccount('act_263704911080094');
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
));
//echo count($adsets).' conjuntos de anuncios';
foreach ($adsets as $adset) {
echo $adset->{AdSetFields::ID}.PHP_EOL;
echo $adset->{AdSetFields::ACCOUNT_ID}.PHP_EOL;
echo $adset->{AdSetFields::CAMPAIGN_ID}.PHP_EOL;
echo $adset->{AdSetFields::NAME}.PHP_EOL;
echo $adset->{AdSetFields::EFFECTIVE_STATUS}.PHP_EOL;
echo $adset->{AdSetFields::CREATED_TIME}.PHP_EOL;
echo $adset->{AdSetFields::START_TIME}.PHP_EOL;
echo $adset->{AdSetFields::END_TIME}.PHP_EOL;
//print_r($adset->{AdSetFields::TARGETING}).PHP_EOL;

$age_max = "";
$age_min = "";
$interest = "";
$education_statuses = "";
$exclusions_education_statuses = "";
$behaviors = "";
$targeting = $adset->{AdSetFields::TARGETING};
print_r($targeting);

if (!empty($targeting)) {
    $age_max = $targeting['age_max'];
    $age_min = $targeting['age_min'];
    
 if (isset($targeting['flexible_spec'][0]['interests'])) {    
        foreach ($targeting['flexible_spec'][0]['interests'] as $interes){
            $interest .= $interes['name'].", ";
        }
    }
    
 if (isset($targeting['flexible_spec'][0]['education_statuses'])) {    
        foreach ($targeting['flexible_spec'][0]['education_statuses'] as $educacion){
            switch ($educacion){
                  case "1":
                    $education_statuses .= 'Secundario en curso'.', ';
                    break;
                  case "2":
                    $education_statuses .= 'Estudios universitarios en curso'.', ';
                    break;
                  case "3":
                    $education_statuses .= 'Alumno'.', ';
                    break;    
                  case "4":
                    $education_statuses .= 'Secundario completo'.', ';
                    break;
                  case "5":
                    $education_statuses .= 'SOME_COLLEGE'.', ';
                    break;
                  case "6":
                    $education_statuses .= 'ASSOCIATE_DEGREE'.', ';
                    break;
                 case "7":
                    $education_statuses .= 'IN_GRAD_SCHOOL'.', ';
                    break;
                 case "8":
                    $education_statuses .= 'SOME_GRAD_SCHOOL'.', ';
                    break;
                 case "9":
                    $education_statuses .= 'Maestría'.', ';
                    break;
                 case "10":
                    $education_statuses .= 'Títulado'.', ';
                    break;
                 case "11":
                    $education_statuses .= 'Doctorado'.', ';
                    break;
                 case "12":
                    $education_statuses .= 'No especificado'.', ';
                    break;
                 case "13":
                    $education_statuses .= 'Secundario incompleto'.', ';
                    break;
                }    
        }
    } 
    
    if (isset($targeting['exclusions']['education_statuses'])) {    
        foreach ($targeting['exclusions']['education_statuses'] as $exclusioneducacion){
            switch ($exclusioneducacion){
                  case "1":
                    $exclusions_education_statuses .= 'Secundario en curso'.', ';
                    break;
                  case "2":
                    $exclusions_education_statuses .= 'Estudios universitarios en curso'.', ';
                    break;
                  case "3":
                    $exclusions_education_statuses .= 'Alumno'.', ';
                    break;    
                  case "4":
                    $exclusions_education_statuses .= 'Secundario completo'.', ';
                    break;
                  case "5":
                    $exclusions_education_statuses .= 'SOME_COLLEGE'.', ';
                    break;
                  case "6":
                    $exclusions_education_statuses .= 'ASSOCIATE_DEGREE'.', ';
                    break;
                 case "7":
                    $exclusions_education_statuses .= 'IN_GRAD_SCHOOL'.', ';
                    break;
                 case "8":
                    $exclusions_education_statuses .= 'SOME_GRAD_SCHOOL'.', ';
                    break;
                 case "9":
                    $exclusions_education_statuses .= 'Maestría'.', ';
                    break;
                 case "10":
                    $exclusions_education_statuses .= 'Títulado'.', ';
                    break;
                 case "11":
                    $exclusions_education_statuses .= 'Doctorado'.', ';
                    break;
                 case "12":
                    $exclusions_education_statuses .= 'No especificado'.', ';
                    break;
                 case "13":
                    $exclusions_education_statuses .= 'Secundario incompleto'.', ';
                    break;
                }    
        }
    }
    
     if (isset($targeting['flexible_spec'][0]['behaviors'])) {    
        foreach ($targeting['flexible_spec'][0]['behaviors'] as $comportamiento){
            $behaviors .= $comportamiento['name'].", ";
        }
    }
}
$interest = rtrim($interest,', ');
$education_statuses = rtrim($education_statuses,', ');
$exclusions_education_statuses = rtrim($exclusions_education_statuses,', ');
$behaviors = rtrim($behaviors,', ');
//echo $age_max;
echo $interest.PHP_EOL;
echo $education_statuses.PHP_EOL;
echo $exclusions_education_statuses.PHP_EOL;
echo $behaviors.PHP_EOL;
}*/




     /*   $result = TargetingSearch::search(
              TargetingSearchTypes::INTEREST,
              null,
              'Cocktail');
  print_r($result);*/
  //$target = (count($result)) ? $result->current() : null;
 // echo "Using target: ".$target->name."\n";


        // echo('<pre>');
        //  print_r($arrayData);die;
        // echo('</pre>');
        // //exit();
        $qtyBd = getCountFromtable($table,$since,$until,$account_id);
                
        // echo('<pre>');
        //  var_dump($qtyBd);die;
        // echo('</pre>');
        if (($qtyBd != count($arrayData)) && (count($arrayData) > 0)){
          $deleteData = DeleteFromtableBetweenDates($table,$since,$until,$account_id);
          $saveData = saveInsightsForFacebookAccount($arrayData,$table);
        }
        }catch (FacebookAds\Http\Exception\ServerException $e) {
           //echo "Mensaje de error en servidor facebook: ".$e->getMessage();
           sendMailer("jose@mimirwell.com","Job fállido en ".__FILE__,"\n\nProbablemente la petición superó en mucho el limite encima de 20 mil registros o el rango de fechas es muy amplio \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
           //sendMailer("luismiguel@mimirwell.com","Job fállido en ".__FILE__,"\n\nProbablemente la petición superó en mucho el limite encima de 20 mil registros o el rango de fechas es muy amplio \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
        }
    }   
}
//$f = insert_fb_data_day('act_216220169082098'); //PEC Le Cordon
//$f = insert_fb_data_day('act_263704911080094'); //INSTITUTO LCB
//$f = insert_fb_data_day('act_1071159706331825'); //pec
//$f = insert_fb_data_day('act_1073271616120634'); //ilcb
//$f = insert_fb_data_day('act_1414429155338210'); //master_cuisine
//$f = insert_fb_data_day('act_1063559070425222'); //ulcb 
$f = insert_fb_data_day('act_1487762988004826'); //movil tours
//$f = insert_fb_data_day('322611555079645'); //movil Air
//$f = insert_fb_data_day('655873111499297'); //movil Bus

