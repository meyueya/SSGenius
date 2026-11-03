<?php

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
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once('../../model/Page_EngagementModelPC.php');
$FacebookModel = new FacebookModel();

   
        
           
      
              
                
             
$conec = Database::getInstance();
                         $stm = $conec->prepare("SELECT id_ssgfacebookpostpagejob, id_adaccount,engagement_restart_day, engagement_status FROM `ssg_facebook_page_primera_carga` WHERE engagement_status='1'  ");
                         $stm->execute();
                         $job = $stm->fetchAll();
                         $lastdate = $job['0']['1'];//id_account
                         $lastdate1 =$job['0']['0'];//id_ssg
                         $lastdate2 =$job['0']['2'];//fecha
                         $lastdate3 =$job['0']['3'];//status
             
                         $diaconsulta = date(strtotime("$lastdate2")); // la primera vez que comience a jalar datos
                         $now = date ('Y-m-d');
                         $today = date(strtotime("$now"));
                         $diaconsultabreak = date(strtotime("$lastdate2"));
                         $totaldia = (($today - $diaconsultabreak  -86400 )/86400);
                         // echo'Dias: ';
                         //var_dump($totaldia);
                       
                         
                       
                        $id_ssgfacebookpostpagejob = $lastdate1;
$_GET['t'] = $id_ssgfacebookpostpagejob;


$keyJob = htmlspecialchars($_GET['t']);

//var_dump($keyJob);

   
if (isset($keyJob)){
$job = $FacebookModel->getFacebookPostPageJob($keyJob);

       //  echo "<pre>";
    // var_dump($job);
       //  echo"</pre>";
        

  if ($job == false){ $return["message"] = "Error DB"; exit();
  }
} else { $return["message"] = "no hay keyJob"; exit(); }

$app_id = '292708578241182';
$app_secret = getenv('FACEBOOK_APP_SECRET');
$access_token = $job->access_token;
$page_token = $job->page_token; 
$id_page = $job->id_facebook_page; 

//echo "<pre>";
 //var_dump($id_page);
//echo"</pre>";
//$page_token = getenv('FACEBOOK_ACCESS_TOKEN'); 
//$id_page = '192597304105183'; 

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


//acá empieza el IF del keyjob el IF, escribo esto para no perdernos
if (isset($keyJob)){
$job = $FacebookModel->getFacebookPostPageJob($keyJob);
  
  if ($job == false){ $return["message"] = "Error DB"; exit();
  }
  
} else { $return["message"] = "no hay keyJob"; exit(); 
  }
//acá se acabó el IF del keyjob, escribo esto para no perdernos
  
$api = Api::init($app_id, $app_secret, $access_token);
   // echo "<pre>";
   //var_dump($api);
   // echo"</pre>";
   //     die;
$api->setLogger(new CurlLogger());
   // The instace is now retrivable
$api = Api::instance();
$page_session = new Session($app_id, $app_secret, $page_token);
$page_api = new Api($api->getHttpClient(), $page_session);
$page_api->setLogger($api->getLogger());
        

// acá defino cuantos días quiero que corra mi loop, en otras palabras, cuantos días de data quiero jalar      
  
$totalloops = $totaldia; 


 // fin de la definición del total de días que quiero que corra mi loop, en otras palabras, cuantos días de data quiero jalar
 // defino la variable antes del loop
  $prueba = date ('Y-m-d'); 
  $dia= date ('Y-m-d'); 
  
  $dia = date( "Y-m-d", strtotime( $dia . '-'.$totaldia.'day' ) );//insertdate es la variable que vamos a usar para controlar en que dia nos quedamos insertando datos en la BD en caso haya un time out y no existan datos en muchos dias en FB
  //var_dump($dia);
  
for ($i = 0; $i != $totalloops; $i++) 
{
   sleep(3);

   //aca le sumo los dias a la variable que definimos afuera
   
          $dia = date( "Y-m-d", strtotime( $dia . '+1 day' ) );
          
       //echo 'dia=';
      // var_dump($dia);   
       $n_dia = 1;        
   if ($n_dia >= 1) 
   {
       $since = $dia;
       $until = $dia;
       $limit = 5000;
       

  
        $params = array(
            'date_start', // La fecha de inicio de sus datos. Esto estÃ¡ controlado por el intervalo de fechas que ha seleccionado para su vista de informes.
            'date_stop', // La fecha de finalizaciÃ³n de sus datos. Esto estÃ¡ controlado por el intervalo de fechas que ha seleccionado para su vista de informes.

            'breakdowns' => array('age', 'gender'),//puede haber otros como country
            'since'=>$since,
            'until'=>$until, 
            'period' =>"day",
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
         echo "<pre>";
      var_dump($params );
      echo"</pre>";
       die;
       
     $data = $page_api->call('/'.$id_page.'/insights', RequestInterface::METHOD_GET,$params)->getContent();
          
    
  
     $newData = array();
     
       if (isset($data['data']))
       {
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
           //echo "<pre>";
          // var_dump($data);
          // echo "</pre>";
         //  die;

            $FacebookModel = new FacebookModel();
            foreach($newData as $page)
            {
            
                 $FacebookModel->savePageEngagement($id_page, $page);
         
              }
             
         }
       
    
     }  
        
      
            }