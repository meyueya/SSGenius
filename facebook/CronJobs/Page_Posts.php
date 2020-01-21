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

require_once('../../model/Page_PostsModel.php');
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
    	$resultado = mail($mail_destino,$asunto,$mensaje,$headers);

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

    $dia = date('Y-m-d',strtotime("- 199 days")); // la primera vez que comience a jalar datos
  //$dia = date('Y-m-d');//obtenemos el dia de ayer
    $n_dia = 1; 
    if ($n_dia >= 1) {
        $since = $dia;//desde 2018-04-17
        $until = $dia;//hasta 2018-05-15
    // echo('<pre>');
    //  print_r($until);die;
    // echo('</pre>');
    $limit = 5000;//limite por cursor 5 mil es el máximo de facebook por petición al momento
    $api = Api::init($app_id, $app_secret, $access_token);

        $api->setLogger(new CurlLogger());
        // The instace is now retrivable
        $api = Api::instance();
        $page_session = new Session($app_id, $app_secret, $page_token);
        $page_api = new Api($api->getHttpClient(), $page_session);
        $page_api->setLogger($api->getLogger());
        $params = array(
            'time_range' => array('since' => $since, 'until' => $until),
            'breakdowns' => array('age', 'gender'),//puede haber otros como country
            // 'since'=>$since,
            // 'until'=>$until, 
            'period' => "day",
            'include_headers' => "false",
            'metric' => array(
                
                //Page Posts
                'page_fans',
                'page_post_engagements',
                'page_posts_impressions',
                'page_posts_impressions_unique',
                'page_posts_impressions_paid',
                'page_posts_impressions_paid_unique',
                'page_posts_impressions_organic',
                'page_posts_impressions_organic_unique',
                'page_posts_served_impressions_organic_unique',
                'page_posts_impressions_viral',
                'page_posts_impressions_viral_unique',
                'page_posts_impressions_nonviral',
                'page_posts_impressions_nonviral_unique',
                'page_posts_impressions_frequency_distribution',
             ),
             ); 
    $data = $page_api->call('/'.$id_page.'/insights', RequestInterface::METHOD_GET,$params)->getContent();

          echo "<pre>";
        var_dump($params); var_dump($params);
            echo"</pre>";
         //   die;

        $newData = array();
        if (isset($data['data'])){
           foreach ($data['data'] as $keyFull => $pageInsights)
           {  
               
             
                if ($data['data'][$keyFull]['name'] == "page_fans"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_fans){
                        $newData[$key]['page_fans'] = $page_fans['value'];
                       
                        
                    } 
                }if ($data['data'][$keyFull]['name'] == "page_fans"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_fans){
                        $newDate[$key]['page_fans'] = $page_fans['end_time']; 
                        
                    } 
                } 
                if ($data['data'][$keyFull]['name'] == "page_posts_impressions"){  
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_posts_impressions){
                        $newData[$key]['page_posts_impressions'] = $page_posts_impressions['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_posts_impressions_unique"){  
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_posts_impressions_unique){
                        $newData[$key]['page_posts_impressions_unique'] = $page_posts_impressions_unique['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_posts_impressions_paid"){  
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_posts_impressions_paid){
                        $newData[$key]['page_posts_impressions_paid'] = $page_posts_impressions_paid['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_posts_impressions_paid_unique"){  
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_posts_impressions_paid_unique){
                        $newData[$key]['page_posts_impressions_paid_unique'] = $page_posts_impressions_paid_unique['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_posts_impressions_organic"){  
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_posts_impressions_organic){
                        $newData[$key]['page_posts_impressions_organic'] = $page_posts_impressions_organic['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_posts_impressions_organic_unique"){  
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_posts_impressions_organic_unique){
                        $newData[$key]['page_posts_impressions_organic_unique'] = $page_posts_impressions_organic_unique['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_posts_served_impressions_organic_unique"){  
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_posts_served_impressions_organic_unique){
                        $newData[$key]['page_posts_served_impressions_organic_unique'] = $page_posts_served_impressions_organic_unique['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_posts_impressions_viral"){  
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_posts_impressions_viral){
                        $newData[$key]['page_posts_impressions_viral'] = $page_posts_impressions_viral['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_posts_impressions_viral_unique"){  
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_posts_impressions_viral_unique){
                        $newData[$key]['page_posts_impressions_viral_unique'] = $page_posts_impressions_viral_unique['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_posts_impressions_nonviral"){  
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_posts_impressions_nonviral){
                        $newData[$key]['page_posts_impressions_nonviral'] = $page_posts_impressions_nonviral['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_posts_impressions_nonviral_unique"){  
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_posts_impressions_nonviral_unique){
                        $newData[$key]['page_posts_impressions_nonviral_unique'] = $page_posts_impressions_nonviral_unique['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_posts_impressions_frequency_distribution"){  
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_posts_impressions_frequency_distribution){
                        $newData[$key]['page_posts_impressions_frequency_distribution'] = $page_posts_impressions_frequency_distribution['value'];
                    }
                }
                
                
      
           }   
           
    //     echo "<pre>";
    // var_dump($id_page,$newData);
    //     echo"</pre>";
    //     die;
        
    $FacebookModel = new FacebookModel();
                
            
            foreach($newDate as $pageDate){
                $pageDate;
            }
         echo "<pre>";
     var_dump($pageDate);
        echo"</pre>";
    //     die;
            foreach($newData as $page){
                
               $FacebookModel->savePagePosts(
                 $id_page,
                 $page,
                 $pageDate
                 

                //  $mentions = $page['mentions']
         )
            ;
        
                
            }
        //die;
            }
        }
         echo  "Error en servidor facebook: ".$e->getMessage();
         sendMailer("jose@mimirwell.com","Hubo un error en guardado de page fans facebook",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
    // echo "<pre>";
    // var_dump($id_page, $page);
    //     echo"</pre>";
       // die;