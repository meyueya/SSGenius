<?php
error_reporting(E_ALL);
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

 require_once('../../model/PageUserDemographicsModelPC.php');
$FacebookModel = new FacebookModel();

        $conec = Database::getInstance();
                       
                         $stm = $conec->prepare("SELECT id_ssgfacebookpostpagejob, id_adaccount,user_restart_day, user_status FROM `ssg_facebook_page_primera_carga` WHERE user_status='1'  ");
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


if (isset($keyJob)){
$job = $FacebookModel->getFacebookPostPageJob($keyJob);

    //     echo "<pre>";
    // var_dump($job);
    //     echo"</pre>";
        

if ($job == false){ $return["message"] = "Error DB"; exit();}
} else { $return["message"] = "no hay keyJob"; exit(); }
$app_id = '292708578241182';
$app_secret = '462aeec937ca833dd9798c944d5c79e2';
$access_token = $job->access_token;
$page_token = $job->page_token; 
$id_page = $job->id_facebook_page; 
/*
function sendMailer($mail_destino,$asunto,$mensaje)
    {   
        $datos_remitente = "Sistema Web";
    	$headers = "MIME-Version: 1.0\n"; 
    	$headers .= "Content-type: text/html; charset=iso-8859-1\n"; 
    	$headers .= "From: $datos_remitente\n"; 
    	$resultado =mail($mail_destino,$asunto,$mensaje,$headers);

    	return $resultado;
    }   */
    
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
        
// acá defino cuantos días quiero que corra mi loop, en otras palabras, cuantos días de data quiero jalar      
  
$totalloops = $totaldia; 


 // fin de la definición del total de días que quiero que corra mi loop, en otras palabras, cuantos días de data quiero jalar
 // defino la variable antes del loop
  $prueba = date ('Y-m-d'); 
  $dia= date ('Y-m-d'); 
  
  $dia = date( "Y-m-d", strtotime( $dia . '-'.$totaldia.'day' ) );//insertdate es la variable que vamos a usar para controlar en que dia nos quedamos insertando datos en la BD en caso haya un time out y no existan datos en muchos dias en FB
  var_dump($dia);
  
for ($i = 0; $i != $totalloops; $i++) 
{
   sleep(3);

   //aca le sumo los dias a la variable que definimos afuera
   
          $dia = date( "Y-m-d", strtotime( $dia . '+1 day' ) );
          
       echo 'dia=';
       var_dump($dia);   
       $n_dia = 1;        
   if ($n_dia >= 1) 
   {
       $since = $dia;
       $until = $dia;
       $limit = 5000;
        
        
        $params = array(
             'since'=>$since,
             'until'=>$until, 
            'period' => "day",
            'include_headers' => "false",
            'metric' => array(
         //Page User Demographics
            'page_fans',
            'page_fan_adds',
            'page_fan_adds_unique',
          // 'page_fans_locale', //Condenados hasta nuevo aviso
            'page_fans_gender_age',
            'page_fans_online_per_day',
            'page_fans_by_like_source',
            'page_fans_by_like_source_unique',
            'page_fan_removes',
            'page_fan_removes_unique',
            'page_fans_by_unlike_source_unique',
             ),
             ); 
    $data = $page_api->call('/'.$id_page.'/insights', RequestInterface::METHOD_GET,$params)->getContent();
        
    //     echo "<pre>";
    // var_dump($data);
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
                if ($data['data'][$keyFull]['name'] == "page_fans"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_fans){
                        $newDate[$key]['page_fans'] = $page_fans['end_time']; 
                        
                    } 
                } 
                 if ($data['data'][$keyFull]['name'] == "page_fan_adds_unique"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_fan_adds_unique){
                        $newData[$key]['page_fan_adds_unique'] = $page_fan_adds_unique['value'];
                    }
                 }

                 if ($data['data'][$keyFull]['name'] == "page_fans_gender_age"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_fans_gender_age){
                        $newData[$key]['page_fans_gender_age'] = $page_fans_gender_age['value'];
                    }
                 }
                                  if ($data['data'][$keyFull]['name'] == "page_fans_by_like_source"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_fans_by_like_source){
                        $newData[$key]['page_fans_by_like_source'] = $page_fans_by_like_source['value'];
                    }
                 }
                                  if ($data['data'][$keyFull]['name'] == "page_fans_by_like_source_unique"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_fans_by_like_source_unique){
                        $newData[$key]['page_fans_by_like_source_unique'] = $page_fans_by_like_source_unique['value'];
                    }
                 }
                                  if ($data['data'][$keyFull]['name'] == "page_fan_removes"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_fan_removes){
                        $newData[$key]['page_fan_removes'] = $page_fan_removes['value'];
                    }
                 }
                                  if ($data['data'][$keyFull]['name'] == "page_fan_removes_unique"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_fan_removes_unique){
                        $newData[$key]['page_fan_removes_unique'] = $page_fan_removes_unique['value'];
                    }
                 }
                                  if ($data['data'][$keyFull]['name'] == "page_fans_by_unlike_source_unique"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_fans_by_unlike_source_unique){
                        $newData[$key]['page_fans_by_unlike_source_unique'] = $page_fans_by_unlike_source_unique['value'];
                    }
                 }
      
           }    
    //     echo "<pre>";
    // var_dump($id_page,$newData["page_impressions_frequency_distribution"]);
    //     echo"</pre>";
    //     die;
        
     $FacebookModel = new FacebookModel();
                
            
            foreach($newDate as $pageDate){
                $pageDate;
            }
        // echo "<pre>";
    // var_dump($pageDate);
     //   echo"</pre>";
    //     die;
            foreach($newData as $page){
                
               $FacebookModel->savePageUserDemographics(
                 $id_page,
                 $page,
                 $pageDate
                 

                //  $mentions = $page['mentions']
         )
            ;
            }
           var_dump($page);
             
         }
       
    
     }  
        
      
            }