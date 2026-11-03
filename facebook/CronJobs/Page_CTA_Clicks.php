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

require_once('../../model/Page_CTAClicksModel.php');
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
                
                //Page Reactions
                
                'page_fans',
                'page_total_actions',
                'page_cta_clicks_logged_in_total',
                'page_cta_clicks_logged_in_unique',
                'page_cta_clicks_by_site_logged_in_unique',
                'page_cta_clicks_by_age_gender_logged_in_unique',
                'page_call_phone_clicks_by_age_gender_logged_in_unique',
                'page_call_phone_clicks_by_site_logged_in_unique',
                'page_get_directions_clicks_logged_in_unique',
                'page_get_directions_clicks_by_age_gender_logged_in_unique',
                'page_get_directions_clicks_by_site_logged_in_unique',
                'page_website_clicks_logged_in_unique',
                'page_website_clicks_by_age_gender_logged_in_unique',
                'page_website_clicks_by_site_logged_in_unique',
             ),
             ); 
    $data = $page_api->call('/'.$id_page.'/insights', RequestInterface::METHOD_GET,$params)->getContent();

         echo "<pre>";
         var_dump($data);
             echo"</pre>";
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
                 if ($data['data'][$keyFull]['name'] == "page_total_actions"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_total_actions){
                        $newData[$key]['page_total_actions'] = $page_total_actions['value'];
                    }
                }
                 if ($data['data'][$keyFull]['name'] == "page_cta_clicks_logged_in_total"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_cta_clicks_logged_in_total){
                        $newData[$key]['page_cta_clicks_logged_in_total'] = $page_cta_clicks_logged_in_total['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_cta_clicks_logged_in_unique"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_cta_clicks_logged_in_unique){
                        $newData[$key]['page_cta_clicks_logged_in_unique'] = $page_cta_clicks_logged_in_unique['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_cta_clicks_by_site_logged_in_unique"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_cta_clicks_by_site_logged_in_unique){
                        $newData[$key]['page_cta_clicks_by_site_logged_in_unique'] = $page_cta_clicks_by_site_logged_in_unique['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_cta_clicks_by_age_gender_logged_in_unique"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_cta_clicks_by_age_gender_logged_in_unique){
                        $newData[$key]['page_cta_clicks_by_age_gender_logged_in_unique'] = $page_cta_clicks_by_age_gender_logged_in_unique['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_call_phone_clicks_by_age_gender_logged_in_unique"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_call_phone_clicks_by_age_gender_logged_in_unique){
                        $newData[$key]['page_call_phone_clicks_by_age_gender_logged_in_unique'] = $page_call_phone_clicks_by_age_gender_logged_in_unique['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_call_phone_clicks_logged_in_unique"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_call_phone_clicks_logged_in_unique){
                        $newData[$key]['page_call_phone_clicks_logged_in_unique'] = $page_call_phone_clicks_logged_in_unique['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_call_phone_clicks_by_site_logged_in_unique"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_call_phone_clicks_by_site_logged_in_unique){
                        $newData[$key]['page_call_phone_clicks_by_site_logged_in_unique'] = $page_call_phone_clicks_by_site_logged_in_unique['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_get_directions_clicks_logged_in_unique"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_get_directions_clicks_logged_in_unique){
                        $newData[$key]['page_get_directions_clicks_logged_in_unique'] = $page_get_directions_clicks_logged_in_unique['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_get_directions_clicks_by_age_gender_logged_in_unique"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_get_directions_clicks_by_age_gender_logged_in_unique){
                        $newData[$key]['page_get_directions_clicks_by_age_gender_logged_in_unique'] = $page_get_directions_clicks_by_age_gender_logged_in_unique['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_get_directions_clicks_by_site_logged_in_unique"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_get_directions_clicks_by_site_logged_in_unique){
                        $newData[$key]['page_get_directions_clicks_by_site_logged_in_unique'] = $page_get_directions_clicks_by_site_logged_in_unique['value'];
                    }
                }
               if ($data['data'][$keyFull]['name'] == "page_website_clicks_by_age_gender_logged_in_unique"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_website_clicks_by_age_gender_logged_in_unique){
                        $newData[$key]['page_website_clicks_by_age_gender_logged_in_unique'] = $page_website_clicks_by_age_gender_logged_in_unique['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_website_clicks_by_site_logged_in_unique"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_website_clicks_by_site_logged_in_unique){
                        $newData[$key]['page_website_clicks_by_site_logged_in_unique'] = $page_website_clicks_by_site_logged_in_unique['value'];
                    }
                }
      
           }    
    //     echo "<pre>";
    // var_dump($id_page,$newData["page_impressions_frequency_distribution"]);
    //     echo"</pre>";
    //     die;
        
    $FacebookModel = new FacebookModel();
            foreach($newData as $page){
               $FacebookModel->savePageCTAClicks(
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