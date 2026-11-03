<?php
error_reporting(E_ALL);
// Este archivo extrae todos los datos estadísticos de PAGE de Facebook referidos solo a ENGAGEMENT (hay un archivo similar por tabla)
// Es el que debe de ejecutar diariamente el cron job y solo jala un (01) solo día (el día anterior) y hace el proceso a diario
// Trabaja en conjunto con el archivo Page_EngagementModel.php
ini_set('display_errors', 1);
    // Configurations
define('SDK_DIR', '../facebook-php-business-sdk/'); // Path to the SDK directory
$loader = include SDK_DIR.'/vendor/autoload.php';
//use Facebook\Facebook;
use FacebookAds\Api;
use FacebookAds\Session;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Http\Request;
use FacebookAds\Http\RequestInterface;
use FacebookAds\Object\Page;

require_once('../../model/Page_EngagementModel.php');
$FacebookModel = new FacebookModel();
$_GET['t'] = 1;
$keyJob = htmlspecialchars($_GET['t']);


if (isset($keyJob)){
$job = $FacebookModel->getFacebookPostPageJob($keyJob);

    //     echo "<pre>";
    // var_dump($job);
    //     echo"</pre>";
        

if ($job == false){ $return["message"] = "Error DB"; exit();}
} else { $return["message"] = "no hay keyJob"; exit(); }
$app_id = '292708578241182';
$app_secret = getenv('FACEBOOK_APP_SECRET');
$access_token = $job->access_token;
$page_token = $job->page_token; 
$id_page = $job->id_facebook_page; 

function sendMailer($mail_destino,$asunto,$mensaje)
    {   
        $datos_remitente = "Sistema Web";
    	$headers = "MIME-Version: 1.0\n"; 
    	$headers .= "Content-type: text/html; charset=iso-8859-1\n"; 
    	$headers .= "From: $datos_remitente\n"; 
    	$resultado =mail($mail_destino,$asunto,$mensaje,$headers);

    	return $resultado;
    }   
    
        $api = Api::init($app_id, $app_secret, $access_token);
        $api->setLogger(new CurlLogger());
        // The instace is now retrivable
        $api = Api::instance();
        $page_session = new Session($app_id, $app_secret, $page_token);
        $page_api = new Api($api->getHttpClient(), $page_session);
        $page_api->setLogger($api->getLogger());
        
             $FacebookModel = new FacebookModel();
     $keyJob = htmlspecialchars($_GET['t']);


if (isset($keyJob)){
$job = $FacebookModel->getFacebookPostPageJob($keyJob);
if ($job == false){ $return["message"] = "Error DB"; exit();}
} else { $return["message"] = "no hay keyJob"; exit(); }

$api = Api::init($app_id, $app_secret, $access_token);
    //     echo "<pre>";
    // var_dump($api);
    //     echo"</pre>";
    //     die;
        $api->setLogger(new CurlLogger());
        // The instace is now retrivable
        $api = Api::instance();
        $page_session = new Session($app_id, $app_secret, $page_token);
        $page_api = new Api($api->getHttpClient(), $page_session);
        $page_api->setLogger($api->getLogger());
        $params = array(
            'breakdowns' => array('age', 'gender'),//puede haber otros como country
            // 'since'=>$since,
            // 'until'=>$until, 
            'period' => "day",
            'include_headers' => "false",
            'metric' => array(
                
            // Page Engagement 
            
            'page_fans',
            'page_engaged_users',
            'page_consumptions',
            'page_consumptions_unique',
            'page_consumptions_by_consumption_type',
            'page_consumptions_by_consumption_type_unique',
            'page_places_checkin_total',
            'page_places_checkin_total_unique',
            'page_places_checkin_mobile',
            'page_places_checkin_mobile_unique',
            //'page_fans_online', //Condenados hasta nuevo aviso
             'page_negative_feedback',
             'page_negative_feedback_unique',
            'page_negative_feedback_by_type',
            'page_negative_feedback_by_type_unique',
            'page_positive_feedback_by_type',
            'page_positive_feedback_by_type_unique',

             'page_fan_adds_by_paid_non_paid_unique', //trae incluido las dos variables anteriores + el total
             ),
             ); 
    $data = $page_api->call('/'.$id_page.'/insights', RequestInterface::METHOD_GET,$params)->getContent();
        
    //     echo "<pre>";
    // var_dump($params);
    //     echo"</pre>";
    //     die;
        $newData = array();
        if (isset($data['data'])){
           foreach ($data['data'] as $keyFull => $pageInsights)
           {  
               
             
                if ($data['data'][$keyFull]['name'] == "page_fans"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_fans){
                        $newData[$key]['page_fans'] = $page_fans['value'];              
                    } 
                } 
                if ($data['data'][$keyFull]['name'] == "page_engaged_users"){  
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_engaged_users){
                        $newData[$key]['page_engaged_users'] = $page_engaged_users['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_post_engagements"){
                foreach ($data['data'][$keyFull]['values'] as $key => $page_post_engagements){
                        $newData[$key]['page_post_engagements'] = $page_post_engagements['value'];
                    }
                } 
                if ($data['data'][$keyFull]['name'] == "page_consumptions"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_consumptions){
                        $newData[$key]['page_consumptions'] = $page_consumptions['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_consumptions_unique"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_consumptions_unique){
                        $newData[$key]['page_consumptions_unique'] = $page_consumptions_unique['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_consumptions_by_consumption_type"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_consumptions_by_consumption_type){
                        $newData[$key]['page_consumptions_by_consumption_type'] = $page_consumptions_by_consumption_type['value'];
                    }
                }
                
                if ($data['data'][$keyFull]['name'] == "page_places_checkin_total"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_places_checkin_total){
                        $newData[$key]['page_places_checkin_total'] = $page_places_checkin_total['value'];
                    }
                } 
                if ($data['data'][$keyFull]['name'] == "page_places_checkin_total_unique"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_places_checkin_total_unique){
                        $newData[$key]['page_places_checkin_total_unique'] = $page_places_checkin_total_unique['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_places_checkin_mobile"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_places_checkin_mobile){
                        $newData[$key]['page_places_checkin_mobile'] = $page_places_checkin_mobile['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_places_checkin_mobile_unique"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_places_checkin_mobile_unique){
                        $newData[$key]['page_places_checkin_mobile_unique'] = $page_places_checkin_mobile_unique['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_places_checkins_by_age_gender"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_places_checkins_by_age_gender){
                        $newData[$key]['page_places_checkins_by_age_gender'] = $page_places_checkins_by_age_gender['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_negative_feedback"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_negative_feedback){
                        $newData[$key]['page_negative_feedback'] = $page_negative_feedback['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_negative_feedback_unique"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_negative_feedback_unique){
                        $newData[$key]['page_places_checkins_by_age_gender'] = $page_negative_feedback_unique['value'];
                    }
                } 
                if ($data['data'][$keyFull]['name'] == "page_negative_feedback_by_type"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_negative_feedback_by_type){
                        $newData[$key]['page_negative_feedback_by_type'] = $page_negative_feedback_by_type['value'];
                    }
                }
                
                if ($data['data'][$keyFull]['name'] == "page_negative_feedback_by_type_unique"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_negative_feedback_by_type_unique){
                        $newData[$key]['page_negative_feedback_by_type_unique'] = $page_negative_feedback_by_type_unique['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_positive_feedback_by_type"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_positive_feedback_by_type){
                        $newData[$key]['page_positive_feedback_by_type'] = $page_positive_feedback_by_type['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_positive_feedback_by_type_unique"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_positive_feedback_by_type_unique){
                        $newData[$key]['page_positive_feedback_by_type_unique'] = $page_positive_feedback_by_type_unique['value'];
                    }
                }
                                if ($data['data'][$keyFull]['name'] == "page_fan_adds"){  
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_fan_adds_by_paid_unique){
                        $newData[$key]['page_fan_adds_by_paid_unique'] = $page_fan_adds_by_paid_unique['value']['paid'];
                    }
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_fan_adds_by_non_paid_unique){
                        $newData[$key]['page_fan_adds_by_non_paid_unique'] = $page_fan_adds_by_non_paid_unique['value']['unpaid'];
                    }
                }
                

                if ($data['data'][$keyFull]['name'] == "page_positive_feedback_by_type"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_positive_feedback_by_type){
                        $newData[$key]['shares'] = isset($page_positive_feedback_by_type['value']['link']) ? $page_positive_feedback_by_type['value']['link'] : '0';
                    }
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_positive_feedback_by_type){
                        $newData[$key]['likes'] = isset($page_positive_feedback_by_type['value']['like']) ? $page_positive_feedback_by_type['value']['like'] : '0';
                    }
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_positive_feedback_by_type){
                        $newData[$key]['comments'] = isset($page_positive_feedback_by_type['value']['comment']) ? $page_positive_feedback_by_type['value']['comment'] : '0';
                    }
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_positive_feedback_by_type){
                        $newData[$key]['end_time'] = isset($page_positive_feedback_by_type['end_time']) ? $page_positive_feedback_by_type['end_time'] : '0';
                    }
                 }
      
           }    
    //     echo "<pre>";
     var_dump($id_page,$newData["page_impressions_frequency_distribution"]);
    //     echo"</pre>";
    //     die;
        
    $FacebookModel = new FacebookModel();
            foreach($newData as $page){
               $FacebookModel->savePageEngagement(
                 $id_page,
                 $page

                //  $mentions = $page['mentions']
          )
            ;
        
    //     echo "<pre>";
    // var_dump($page);
    //     echo"</pre>";
        
        die;
            }
        }
         echo  "Error en servidor facebook: ".$e->getMessage();
         sendMailer("info@mimirwell.com","Hubo un error en guardado de page fans facebook",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
    // echo "<pre>";
    // var_dump($id_page, $page);
    //     echo"</pre>";
        die;