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

require_once('../../model/page_VideoViewsModel.php');
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
                

                // Page Video Views

                    'page_fans',
                    'page_video_views',
                    'page_video_views_paid',
                    'page_video_views_organic',
                    'page_video_views_by_paid_non_paid',
                    'page_video_views_autoplayed',
                    'page_video_views_click_to_play',
                    'page_video_views_unique',
                    'page_video_repeat_views',
                    'page_video_complete_views_30s',
                    'page_video_complete_views_30s_paid',
                    'page_video_complete_views_30s_organic',
                    'page_video_complete_views_30s_autoplayed',
                    'page_video_complete_views_30s_click_to_play',
                    'page_video_complete_views_30s_unique',
                    'page_video_complete_views_30s_repeat_views',
                    'page_video_views_10s',
                    'page_video_views_10s_paid',
                    'page_video_views_10s_organic',
                    'page_video_views_10s_autoplayed',
                    'page_video_views_10s_click_to_play',
                    'page_video_views_10s_unique',
                    'page_video_views_10s_repeat',
                    'page_video_view_time',
                    'post_video_complete_views_30s_autoplayed',
                    'post_video_complete_views_30s_clicked_to_play',
                    'post_video_complete_views_30s_organic',
                    'post_video_complete_views_30s_paid',
                    'post_video_complete_views_30s_unique',
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
                if ($data['data'][$keyFull]['name'] == "page_video_views"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_video_views){
                        $newData[$key]['page_video_views'] = $page_video_views['value'];
                    }
                 }
                 if ($data['data'][$keyFull]['name'] == "page_video_views_paid"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_video_views_paid){
                        $newData[$key]['page_video_views_paid'] = $page_video_views_paid['value'];
                    }
                 
                }
                if ($data['data'][$keyFull]['name'] == "page_video_views_organic"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_video_views_organic){
                        $newData[$key]['page_video_views_organic'] = $page_video_views_organic['value'];
                    }
                 }
                 if ($data['data'][$keyFull]['name'] == "page_video_views_by_paid_non_paid"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_video_views_by_paid_non_paid){
                        $newData[$key]['page_video_views_by_paid_non_paid'] = $page_video_views_by_paid_non_paid['value'];
                    }
                 }
                 if ($data['data'][$keyFull]['name'] == "page_video_views_autoplayed"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_video_views_autoplayed){
                        $newData[$key]['page_video_views_autoplayed'] = $page_video_views_autoplayed['value'];
                    }
                 }
                 if ($data['data'][$keyFull]['name'] == "page_video_views_click_to_play"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_video_views_click_to_play){
                        $newData[$key]['page_video_views_click_to_play'] = $page_video_views_click_to_play['value'];
                    }
                 }
                 if ($data['data'][$keyFull]['name'] == "page_video_views_unique"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_video_views_unique){
                        $newData[$key]['page_video_views_unique'] = $page_video_views_unique['value'];
                    }
                 }
                 if ($data['data'][$keyFull]['name'] == "page_video_repeat_views"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_video_repeat_views){
                        $newData[$key]['page_video_repeat_views'] = $page_video_repeat_views['value'];
                    }
                 }
                 if ($data['data'][$keyFull]['name'] == "page_video_complete_views_30s"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_video_complete_views_30s){
                        $newData[$key]['page_video_complete_views_30s'] = $page_video_complete_views_30s['value'];
                    }
                 }
                 if ($data['data'][$keyFull]['name'] == "page_video_complete_views_30s_paid"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_video_complete_views_30s_paid){
                        $newData[$key]['page_video_complete_views_30s_paid'] = $page_video_complete_views_30s_paid['value'];
                    }
                 }
                 if ($data['data'][$keyFull]['name'] == "page_video_complete_views_30s_organic"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_video_complete_views_30s_organic){
                        $newData[$key]['page_video_complete_views_30s_organic'] = $page_video_complete_views_30s_organic['value'];
                    }
                 }
                 if ($data['data'][$keyFull]['name'] == "page_video_complete_views_30s_autoplayed"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_video_complete_views_30s_autoplayed){
                        $newData[$key]['page_video_complete_views_30s_autoplayed'] = $page_video_complete_views_30s_autoplayed['value'];
                    }
                 }
                 if ($data['data'][$keyFull]['name'] == "page_video_complete_views_30s_click_to_play"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_video_complete_views_30s_click_to_play){
                        $newData[$key]['page_video_complete_views_30s_click_to_play'] = $page_video_complete_views_30s_click_to_play['value'];
                    }
                 }
                 if ($data['data'][$keyFull]['name'] == "page_video_complete_views_30s_unique"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_video_complete_views_30s_unique){
                        $newData[$key]['page_video_complete_views_30s_unique'] = $page_video_complete_views_30s_unique['value'];
                    }
                 }
                 if ($data['data'][$keyFull]['name'] == "page_video_complete_views_30s_repeat_views"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_video_complete_views_30s_repeat_views){
                        $newData[$key]['page_video_complete_views_30s_repeat_views'] = $page_video_complete_views_30s_repeat_views['value'];
                    }
                 }
                 if ($data['data'][$keyFull]['name'] == "page_video_views_10s"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_video_views_10s){
                        $newData[$key]['page_video_views_10s'] = $page_video_views_10s['value'];
                    }
                 }
                 if ($data['data'][$keyFull]['name'] == "page_video_views_10s_paid"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_video_views_10s_paid){
                        $newData[$key]['page_video_views_10s_paid'] = $page_video_views_10s_paid['value'];
                    }
                 }
                 if ($data['data'][$keyFull]['name'] == "page_video_views_10s_organic"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_video_views_10s_organic){
                        $newData[$key]['page_video_views_10s_organic'] = $page_video_views_10s_organic['value'];
                    }
                 }
                  if ($data['data'][$keyFull]['name'] == "page_video_views_10s_autoplayed"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_video_views_10s_autoplayed){
                        $newData[$key]['page_video_views_10s_autoplayed'] = $page_video_views_10s_autoplayed['value'];
                    }
                 }
                 if ($data['data'][$keyFull]['name'] == "page_video_views_10s_click_to_play"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_video_views_10s_click_to_play){
                        $newData[$key]['page_video_views_10s_click_to_play'] = $page_video_views_10s_click_to_play['value'];
                    }
                 }
                 if ($data['data'][$keyFull]['name'] == "page_video_views_10s_unique"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_video_views_10s_unique){
                        $newData[$key]['page_video_views_10s_unique'] = $page_video_views_10s_unique['value'];
                    }
                 }                 if ($data['data'][$keyFull]['name'] == "page_video_views_10s_repeat"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_video_views_10s_repeat){
                        $newData[$key]['page_video_views_10s_repeat'] = $page_video_views_10s_repeat['value'];
                    }
                 }
                 if ($data['data'][$keyFull]['name'] == "page_video_view_time"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_video_view_time){
                        $newData[$key]['page_video_view_time'] = $page_video_view_time['value'];
                    }
                 }
                 if ($data['data'][$keyFull]['name'] == "post_video_complete_views_30s_autoplayed"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $post_video_complete_views_30s_autoplayed){
                        $newData[$key]['post_video_complete_views_30s_autoplayed'] = $post_video_complete_views_30s_autoplayed['value'];
                    }
                 }
                 if ($data['data'][$keyFull]['name'] == "post_video_complete_views_30s_clicked_to_play"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $post_video_complete_views_30s_clicked_to_play){
                        $newData[$key]['post_video_complete_views_30s_clicked_to_play'] = $post_video_complete_views_30s_clicked_to_play['value'];
                    }
                 }
                 if ($data['data'][$keyFull]['name'] == "post_video_complete_views_30s_organic"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $post_video_complete_views_30s_organic){
                        $newData[$key]['post_video_complete_views_30s_organic'] = $post_video_complete_views_30s_organic['value'];
                    }
                 }
                 if ($data['data'][$keyFull]['name'] == "post_video_complete_views_30s_paid"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $post_video_complete_views_30s_paid){
                        $newData[$key]['post_video_complete_views_30s_paid'] = $post_video_complete_views_30s_paid['value'];
                    }
                 }
                 if ($data['data'][$keyFull]['name'] == "post_video_complete_views_30s_unique"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $post_video_complete_views_30s_unique){
                        $newData[$key]['post_video_complete_views_30s_unique'] = $post_video_complete_views_30s_unique['value'];
                    }
                 }
                
      
           }   
           
    //     echo "<pre>";
    // var_dump($id_page,$newData);
    //     echo"</pre>";
    //     die;
        
    $FacebookModel = new FacebookModel();
            foreach($newData as $page){
               $FacebookModel->savepageVideoViews(
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