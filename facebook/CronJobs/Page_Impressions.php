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

require_once('../../model/Page_ImpressionsModel.php');
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
            // 'since'=>$since,
            // 'until'=>$until, 
            'period' => "day",
            'include_headers' => "false",
            'metric' => array(
                
            //Page Impressions
            'page_fans',
            'page_impressions',
            'page_impressions_unique',
            'page_impressions_paid',
            'page_impressions_paid_unique',
            'page_impressions_organic',
            'page_impressions_organic_unique',
            'page_impressions_viral',
            'page_impressions_viral_unique',
            'page_impressions_nonviral',
            'page_impressions_nonviral_unique',
            'page_impressions_by_story_type',    		
            'page_impressions_by_story_type_unique',
            'page_impressions_by_age_gender_unique',
            
            // 'page_impressions_by_city_unique', //Condenados hasta nuevo aviso
            // 'page_impressions_by_country_unique',  //Condenados hasta nuevo aviso
            // 'page_impressions_by_locale_unique',  //Condenados hasta nuevo aviso
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
                if ($data['data'][$keyFull]['name'] == "page_impressions"){  
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_impressions){
                        $newData[$key]['page_impressions'] = $page_impressions['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_impressions_unique"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_impressions_unique){
                        $newData[$key]['page_impressions_unique'] = $page_impressions_unique['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_impressions_paid"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_impressions_paid){
                        $newData[$key]['page_impressions_paid'] = $page_impressions_paid['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_impressions_paid_unique"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_impressions_paid_unique){
                        $newData[$key]['page_impressions_paid_unique'] = $page_impressions_paid_unique['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_impressions_organic"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_impressions_organic){
                        $newData[$key]['page_impressions_organic'] = $page_impressions_organic['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_impressions_organic_unique"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_impressions_organic_unique){
                        $newData[$key]['page_impressions_organic_unique'] = $page_impressions_organic_unique['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_impressions_viral"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_impressions_viral){
                        $newData[$key]['page_impressions_viral'] = $page_impressions_viral['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_impressions_viral_unique"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_impressions_viral_unique){
                        $newData[$key]['page_impressions_viral_unique'] = $page_impressions_viral_unique['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_impressions_nonviral"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_impressions_nonviral){
                        $newData[$key]['page_impressions_nonviral'] = $page_impressions_nonviral['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_impressions_nonviral_unique"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_impressions_nonviral_unique){
                        $newData[$key]['page_impressions_nonviral_unique'] = $page_impressions_nonviral_unique['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_impressions_by_story_type"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_impressions_by_story_type){
                        $newData[$key]['page_impressions_by_story_type'] = $page_impressions_by_story_type['value']['page post'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_impressions_by_story_type_unique"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_impressions_by_story_type_unique){
                        $newData[$key]['page_impressions_by_story_type_unique'] = $page_impressions_by_story_type_unique['value']['page post'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_impressions_by_age_gender_unique"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_impressions_by_age_gender_unique){
                        $newData[$key]['page_impressions_by_age_gender_unique'] = $page_impressions_by_age_gender_unique['value'];
                    }
                }
      
           }    
    //     echo "<pre>";
    // var_dump($id_page,$newData["page_impressions_frequency_distribution"]);
    //     echo"</pre>";
    //     die;
        
    $FacebookModel = new FacebookModel();
            foreach($newData as $page){
               $FacebookModel->savePageImpressions(
                 $id_page,
                 $page
                //  $page_impressions = $page['page_impressions'],
                //  $page_impressions_unique = $page['page_impressions_unique'],
                //  $page_impressions_paid = $page['page_impressions_paid'],
                //  $page_impressions_paid_unique = $page['page_impressions_paid_unique'],
                //  $page_impressions_organic = $page['page_impressions_organic'],
                //  $page_impressions_organic_unique = $page['page_impressions_organic_unique'],
                //  $page_impressions_viral = $page['page_impressions_viral'],
                //  $page_impressions_viral_unique = $page['page_impressions_viral_unique'],
                //  $page_impressions_nonviral = $page['page_impressions_nonviral'],
                //  $page_impressions_nonviral_unique = $page['page_impressions_nonviral_unique'],
                //  $page_impressions_by_story_type = $page['page_impressions_by_story_type'],
                //  $page_impressions_by_story_type_unique = $page['page_impressions_by_story_type_unique'],
                //  $page_impressions_by_age_gender_unique = $page['page_impressions_by_age_gender_unique']["F.65+"],
                //  $page_impressions_by_age_gender_unique = $page['page_impressions_by_age_gender_unique']["F.55-64"],
                //  $page_impressions_by_age_gender_unique = $page['page_impressions_by_age_gender_unique']["F.45-54"],
                //  $page_impressions_by_age_gender_unique = $page['page_impressions_by_age_gender_unique']["F.35-44"],
                //  $page_impressions_by_age_gender_unique = $page['page_impressions_by_age_gender_unique']["F.25-34"],
                //  $page_impressions_by_age_gender_unique = $page['page_impressions_by_age_gender_unique']["F.18-24"],
                //  $page_impressions_by_age_gender_unique = $page['page_impressions_by_age_gender_unique']["F.13-17"],
                //  $page_impressions_by_age_gender_unique = $page['page_impressions_by_age_gender_unique']["M.65+"],
                //  $page_impressions_by_age_gender_unique = $page['page_impressions_by_age_gender_unique']["M.55-64"],
                //  $page_impressions_by_age_gender_unique = $page['page_impressions_by_age_gender_unique']["M.45-54"],
                //  $page_impressions_by_age_gender_unique = $page['page_impressions_by_age_gender_unique']["M.35-44"],
                //  $page_impressions_by_age_gender_unique = $page['page_impressions_by_age_gender_unique']["M.25-34"],
                //  $page_impressions_by_age_gender_unique = $page['page_impressions_by_age_gender_unique']["M.18-24"],
                //  $page_impressions_by_age_gender_unique = $page['page_impressions_by_age_gender_unique']["M.13-17"],
                //  $page_impressions_by_age_gender_unique = $page['page_impressions_by_age_gender_unique']["U.65+"],
                //  $page_impressions_by_age_gender_unique = $page['page_impressions_by_age_gender_unique']["U.55-64"],
                // //  $page_impressions_by_age_gender_unique = $page['page_impressions_by_age_gender_unique']["U.45-54"];
                //  $page_impressions_by_age_gender_unique = $page['page_impressions_by_age_gender_unique']["U.35-44"],
                //  $page_impressions_by_age_gender_unique = $page['page_impressions_by_age_gender_unique']["U.25-34"],
                //  $page_impressions_by_age_gender_unique = $page['page_impressions_by_age_gender_unique']["U.18-24"]
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
     //   die;