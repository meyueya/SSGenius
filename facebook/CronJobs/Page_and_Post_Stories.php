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

require_once('../../model/Page_and_Post_StoriesModel.php');
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
            // 'since'=>$since,
            // 'until'=>$until, 
            'period' => "day",
            'include_headers' => "false",
            'metric' => array(
            'page_fans',
            'page_content_activity',
            'page_content_activity_by_action_type', //mentions
            'page_content_activity_by_action_type_unique',
            'page_content_activity_by_age_gender_unique',
            //'page_content_activity_by_locale_unique', //deshabilitada hasta nuevo aviso
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
                if ($data['data'][$keyFull]['name'] == "page_content_activity"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_content_activity){
                        $newData[$key]['page_content_activity'] = $page_content_activity['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_content_activity_by_action_type"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_content_activity_by_action_type){
                        $newData[$key]['mentions'] = isset($page_content_activity_by_action_type['value']['mention']) ? $page_content_activity_by_action_type['value']['mention'] : '0';
                    }
                }
                                if ($data['data'][$keyFull]['name'] == "page_content_activity_by_action_type_unique"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_content_activity_by_action_type_unique){
                        $newData[$key]['page_content_activity_by_action_type_unique'] = $page_content_activity_by_action_type_unique['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_content_activity_by_age_gender_unique"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_content_activity_by_age_gender_unique){
                        $newData[$key]['page_content_activity_by_age_gender_unique'] = $page_content_activity_by_age_gender_unique['value'];
                    }
                }
           }    
    //     echo "<pre>";
    // var_dump($newData['0']["page_fans"]);
    //     echo"</pre>";
    //     die;
        
    $FacebookModel = new FacebookModel();
            foreach($newData as $page){
                $FacebookModel->savePagePostStories(
                  $id_page,
                  $page,
                  $page_content_activity = $page['page_content_activity'],
                  $page_content_activity_by_action_type_unique_page_post = $page['page_content_activity_by_action_type_unique']["page post"],
                  $page_content_activity_by_action_type_unique_fan = $page['page_content_activity_by_action_type_unique']["fan"],
                  $page_content_activity_by_action_type_unique_other = $page['page_content_activity_by_action_type_unique']["other"],
                  $page_content_activity_by_age_gender_unique_M_65 = $page['page_content_activity_by_age_gender_unique']["M.65+"],
                  $page_content_activity_by_age_gender_unique_M_55_64 = $page['page_content_activity_by_age_gender_unique']["M.55-64"],
                  $page_content_activity_by_age_gender_unique_M_45_54 = $page['page_content_activity_by_age_gender_unique']["M.45-54"],
                  $page_content_activity_by_age_gender_unique_M_25_34 = $page['page_content_activity_by_age_gender_unique']["M.25-34"],
                  $page_content_activity_by_age_gender_unique_M_35_44 = $page['page_content_activity_by_age_gender_unique']["M.35-44"],
                  $page_content_activity_by_age_gender_unique_M_18_24 = $page['page_content_activity_by_age_gender_unique']["M.18-24"],
                  $page_content_activity_by_age_gender_unique_F_55_64 = $page['page_content_activity_by_age_gender_unique']["F.55-64"],
                  $page_content_activity_by_age_gender_unique_F_45_54 = $page['page_content_activity_by_age_gender_unique']["F.45-54"],
                  $page_content_activity_by_age_gender_unique_F_35_44 = $page['page_content_activity_by_age_gender_unique']["F.35-44"],
                  $page_content_activity_by_age_gender_unique_F_25_34 = $page['page_content_activity_by_age_gender_unique']["F.25-34"],
                  $page_content_activity_by_age_gender_unique_F_18_24 = $page['page_content_activity_by_age_gender_unique']["F.18-24"],
                  $page_content_activity_by_age_gender_unique_U_25_34 = $page['page_content_activity_by_age_gender_unique']["U.25-34"],
                  $mentions = $page['mentions']
            );
        
            }
            
            
        }
    
//         $updated_time = date('Y-m-d h:i:s');
//         $updated_time = date( "Y-m-d", strtotime( "-1 day", strtotime( $updated_time ) ) );
//     //   echo('<pre>');
//     //  var_dump($updated_timeT);
//     // echo('</pre>');
//     // die;
//         $FacebookModel->UpdateStateFacebookPageFansInJob($keyJob,$updated_time,'ok');
//         }catch (\Exception $e) {
//             $keyJob = htmlspecialchars($_GET['t']);
//             $updated_time = date('Y-m-d h:i:s');
//             $FacebookModel->UpdateStateFacebookPageFansInJob($keyJob,$updated_time,'$e->getMessage()');
//             //echo $e->getMessage();
//           $return["message"] = $e->getMessage();
//              //echo  "Error en servidor facebook: ".$e->getMessage();
//              //sendMailer("mario@mimirwell.com","Hubo un error en guardado de page fans facebook",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
//         }

// }
// $qtyRegistersPageFans = $FacebookModel->countDataPageFansFacebook($id_page);
// if ($qtyRegistersPageFans < 731){
//     $FacebookModel->deleteRegistersPageFansFacebook($id_page);
//     $since = date('Y-m-d',strtotime("- 3 month")); 
//     $until = date('Y-m-d',strtotime("+ 1 days")); 
//     insertPageFans($app_id,$app_secret,$access_token,$page_token,$id_page,$since,$until);
//     $since = date('Y-m-d',strtotime("- 6 month")); 
//     $until = date('Y-m-d',strtotime("- 3 month + 1 days")); 
//     insertPageFans($app_id,$app_secret,$access_token,$page_token,$id_page,$since,$until);
//     $since = date('Y-m-d',strtotime("- 9 month")); 
//     $until = date('Y-m-d',strtotime("- 6 month + 1 days")); 
//     insertPageFans($app_id,$app_secret,$access_token,$page_token,$id_page,$since,$until);
//     $since = date('Y-m-d',strtotime("- 12 month")); 
//     $until = date('Y-m-d',strtotime("- 9 month + 1 days")); 
//     insertPageFans($app_id,$app_secret,$access_token,$page_token,$id_page,$since,$until);
//     $since = date('Y-m-d',strtotime("- 15 month")); 
//     $until = date('Y-m-d',strtotime("- 12 month + 1 days")); 
//     insertPageFans($app_id,$app_secret,$access_token,$page_token,$id_page,$since,$until);
//     $since = date('Y-m-d',strtotime("- 18 month")); 
//     $until = date('Y-m-d',strtotime("- 15 month + 1 days")); 
//     insertPageFans($app_id,$app_secret,$access_token,$page_token,$id_page,$since,$until);
//     $since = date('Y-m-d',strtotime("- 21 month")); 
//     $until = date('Y-m-d',strtotime("- 18 month + 1 days")); 
//     insertPageFans($app_id,$app_secret,$access_token,$page_token,$id_page,$since,$until);
//     $since = date('Y-m-d',strtotime("- 24 month")); 
//     $until = date('Y-m-d',strtotime("- 21 month + 1 days")); 
//     insertPageFans($app_id,$app_secret,$access_token,$page_token,$id_page,$since,$until);
// }
// else {
//     $hoy = date('Y-m-d');
//     $checkIfFacebookPageFansRegisterdayExists = $FacebookModel->checkIfFacebookPageFansRegisterdayExists($id_page,$hoy);
//     if (!$checkIfFacebookPageFansRegisterdayExists){ 
//         $since = date('Y-m-d',strtotime("+1 days")); 
//         $until = date('Y-m-d',strtotime("+1 days"));
//     insertPageFans($app_id,$app_secret,$access_token,$page_token,$id_page,$since,$until); 
//     }
    
//     $checkIfFacebookPageFansRegisterdayExists = $FacebookModel->checkIfFacebookPageFansRegisterdayExists($id_page,$hoy);
//     if ($checkIfFacebookPageFansRegisterdayExists){ 
//         $sincefod = date('Y-m-d',strtotime("-1 days"));
//         $countFansOnline = $FacebookModel->getFacebookPageFansOnlineRegisterDay($id_page,$sincefod);
//         if ($countFansOnline == ""){
//             $sincefod = date('Y-m-d');
//             $paramsfod = array(
//             'since'=>$sincefod,
//             'until'=>$sincefod, 
//             'include_headers'=>'false',
//             'metric' => array('page_fans_online_per_day'),
//         ); 
//         $datafod = $page_api->call('/'.$id_page.'/insights', RequestInterface::METHOD_GET,$paramsfod)->getContent();
//         $page_fans_online_per_day = isset($datafod['data']['0']['values']['0']['value']) ? $datafod['data']['0']['values']['0']['value'] : '';
//             $end_time = date('Y-m-d',strtotime("-1 days"));
//           $FacebookModel->UpdateFacebookPageFansOnline($id_page,$page_fans_online_per_day,$end_time);
          
//         } else { 
          
//         }



   