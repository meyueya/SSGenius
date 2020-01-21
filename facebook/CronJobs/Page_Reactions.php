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

require_once('../../model/Page_ReactionsModel.php');
$FacebookModel = new FacebookModel();
$_GET['t'] = 41;
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
                
                //Page Reactions
                
                'page_fans',
                'page_actions_post_reactions_like_total',
                'page_actions_post_reactions_love_total',
                'page_actions_post_reactions_wow_total',
                'page_actions_post_reactions_haha_total',
                'page_actions_post_reactions_sorry_total',
                'page_actions_post_reactions_anger_total',
                'page_actions_post_reactions_total', // es el total de todas las variables anteriores, pero solo muestra las que tienen reacciones
             ),
             ); 
    $data = $page_api->call('/'.$id_page.'/insights', RequestInterface::METHOD_GET,$params)->getContent();
        
                        // echo "<pre>";
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
                 if ($data['data'][$keyFull]['name'] == "page_actions_post_reactions_like_total"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_actions_post_reactions_like_total){
                        $newData[$key]['page_actions_post_reactions_like_total'] = $page_actions_post_reactions_like_total['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_actions_post_reactions_love_total"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_actions_post_reactions_love_total){
                        $newData[$key]['page_actions_post_reactions_love_total'] = $page_actions_post_reactions_love_total['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_actions_post_reactions_wow_total"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_actions_post_reactions_wow_total){
                        $newData[$key]['page_actions_post_reactions_wow_total'] = $page_actions_post_reactions_wow_total['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_actions_post_reactions_haha_total"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_actions_post_reactions_haha_total){
                        $newData[$key]['page_actions_post_reactions_haha_total'] = $page_actions_post_reactions_haha_total['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_actions_post_reactions_sorry_total"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_actions_post_reactions_sorry_total){
                        $newData[$key]['page_actions_post_reactions_sorry_total'] = $page_actions_post_reactions_sorry_total['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_actions_post_reactions_anger_total"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_actions_post_reactions_anger_total){
                        $newData[$key]['page_actions_post_reactions_anger_total'] = $page_actions_post_reactions_anger_total['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_actions_post_reactions_total"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_actions_post_reactions_total){
                        $newData[$key]['page_actions_post_reactions_total'] = $page_actions_post_reactions_total['value'];
                    }
                }
      
           }    
    //     echo "<pre>";
    // var_dump($id_page,$newData["page_impressions_frequency_distribution"]);
    //     echo"</pre>";
    //     die;
        
    $FacebookModel = new FacebookModel();
            foreach($newData as $page){
               $FacebookModel->savePageReactions(
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
         sendMailer("jose@mimirwell.com","Hubo un error en guardado de page fans facebook",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
    // echo "<pre>";
    // var_dump($id_page, $page);
    //     echo"</pre>";
        die;