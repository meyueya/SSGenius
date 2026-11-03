<?php
//error_reporting(E_ALL & ~E_NOTICE & E_DEPRECATED);
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

require_once('../../model/FacebookModel.php');
    //   echo "<pre>";
    //     print_r( $FacebookModel->getFacebookPostPageJob());
    //     echo "</pre>";
    //   die();
    //   exit();
$_GET = ['1'];

    //  echo('<pre>');
    //  var_dump($_GET);
    // echo('</pre>');
    // die;
$FacebookModel = new FacebookModel();
$keyJob = htmlspecialchars($_GET['0']);
    //  echo('<pre>');
    //  var_dump($keyJob);
    // echo('</pre>');
    // die;
if (isset($keyJob)){
$job = $FacebookModel->getFacebookPostPageJob($keyJob);
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
    	//$headers .= "Reply-To: $responder_a\r\n"; 
    	$resultado=mail($mail_destino,$asunto,$mensaje,$headers);
    	return $resultado;
    }   
    
        $api = Api::init($app_id, $app_secret, $access_token);
        $api->setLogger(new CurlLogger());
        // The instace is now retrivable
        $api = Api::instance();
        $page_session = new Session($app_id, $app_secret, $page_token);
        $page_api = new Api($api->getHttpClient(), $page_session);
        $page_api->setLogger($api->getLogger());
function insertPageFans($app_id,$app_secret,$access_token,$page_token,$id_page,$since,$until) {
 try {
     $FacebookModel = new FacebookModel();
     $keyJob = htmlspecialchars($_GET['0']);

if (isset($keyJob)){
$job = $FacebookModel->getFacebookPostPageJob($keyJob);
if ($job == false){ $return["message"] = "Error DB"; exit();}
} else { $return["message"] = "no hay keyJob"; exit(); }
        $api = Api::init($app_id, $app_secret, $access_token);
        $api->setLogger(new CurlLogger());
        // The instace is now retrivable
        $api = Api::instance();
        $page_session = new Session($app_id, $app_secret, $page_token);
        $page_api = new Api($api->getHttpClient(), $page_session);
        $page_api->setLogger($api->getLogger());
        $params = array(
            'since'=>$since,
            'until'=>$until, 
            'period' => "day",
            'include_headers' => "false",
            'metric' => array('page_fans','page_fan_adds_unique','page_fan_adds_by_paid_non_paid_unique','page_fan_removes_unique','page_engaged_users','page_impressions','page_impressions_unique','page_impressions_paid','page_impressions_paid_unique','page_impressions_organic','page_impressions_organic_unique','page_impressions_viral','page_impressions_viral_unique','page_impressions_nonviral','page_impressions_nonviral_unique','page_content_activity','page_content_activity_by_action_type','page_fans_online_per_day','page_post_engagements','page_posts_impressions','page_posts_impressions_unique','page_posts_impressions_paid','page_posts_impressions_paid_unique','page_posts_impressions_organic','page_posts_impressions_organic_unique','page_posts_impressions_viral','page_posts_impressions_viral_unique','page_posts_impressions_nonviral','page_posts_impressions_nonviral_unique','page_consumptions','page_positive_feedback_by_type'),
           //  'metric' => array('page_fans'),
        ); 
        $data = $page_api->call('/'.$id_page.'/insights', RequestInterface::METHOD_GET,$params)->getContent();
//      echo('<pre>');
//      var_dump($data);
//     echo('</pre>');
//    die;
       
       /* echo "<pre>";
        print_r($data);
        echo "</pre>";*/
       //exit();
        $newData = array();
        if (isset($data['data'])){
           foreach ($data['data'] as $keyFull => $pageInsights)
           {
                if ($data['data'][$keyFull]['name'] == "page_fans"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_fans){
                        $newData[$key]['page_fans'] = $page_fans['value'];              
                    } 
                }
                 if ($data['data'][$keyFull]['name'] == "page_fan_adds_unique"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_fan_adds_unique){
                        $newData[$key]['page_fan_adds_unique'] = $page_fan_adds_unique['value'];
                    }
                 }
                if ($data['data'][$keyFull]['name'] == "page_fan_adds_by_paid_non_paid_unique"){  
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_fan_adds_by_paid_unique){
                        $newData[$key]['page_fan_adds_by_paid_unique'] = $page_fan_adds_by_paid_unique['value']['paid'];
                    }
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_fan_adds_by_non_paid_unique){
                        $newData[$key]['page_fan_adds_by_non_paid_unique'] = $page_fan_adds_by_non_paid_unique['value']['unpaid'];
                    }
                }
                 if ($data['data'][$keyFull]['name'] == "page_fan_removes_unique"){ 
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_fan_removes_unique){
                        $newData[$key]['page_fan_removes_unique'] = $page_fan_removes_unique['value'];
                    }
                 }
                if ($data['data'][$keyFull]['name'] == "page_engaged_users"){  
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_engaged_users){
                        $newData[$key]['page_engaged_users'] = $page_engaged_users['value'];
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
                
                if ($data['data'][$keyFull]['name'] == "page_fans_online_per_day"){
                 foreach ($data['data'][$keyFull]['values'] as $key => $page_fans_online_per_day){
                        $newData[$key]['page_fans_online_per_day'] = $page_fans_online_per_day['value'];
                    }
                }    
                
                if ($data['data'][$keyFull]['name'] == "page_post_engagements"){
                foreach ($data['data'][$keyFull]['values'] as $key => $page_post_engagements){
                        $newData[$key]['page_post_engagements'] = $page_post_engagements['value'];
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
                 if ($data['data'][$keyFull]['name'] == "page_consumptions"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_consumptions){
                        $newData[$key]['clics'] = $page_consumptions['value'];
                        echo('<pre>');
                         var_dump( $newData);
                        echo('</pre>');
                        die;
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
            
            $FacebookModel = new FacebookModel();
            foreach($newData as $page){
               $page_fans = isset($page['page_fans']) ? $page['page_fans'] : '';
               $page_fan_adds_by_paid_unique = isset($page['page_fan_adds_by_paid_unique']) ? $page['page_fan_adds_by_paid_unique'] : '';
               $page_fans_online_per_day =  isset($page['page_fans_online_per_day']) ? $page['page_fans_online_per_day'] : '';
               $page_fan_adds_unique =  isset($page['page_fan_adds_unique']) ? $page['page_fan_adds_unique'] : '';
               $FacebookModel->savePageFans($id_page,$page_fans,$page_fan_adds_unique,$page_fan_adds_by_paid_unique,$page['page_fan_adds_by_non_paid_unique'],$page['page_fan_removes_unique'],$page['page_engaged_users'],$page['page_impressions'],$page['page_impressions_unique'],$page['page_impressions_paid'],$page['page_impressions_paid_unique'],$page['page_impressions_organic'],$page['page_impressions_organic_unique'],$page['page_impressions_viral'],$page['page_impressions_viral_unique'],$page['page_impressions_nonviral'],$page['page_impressions_nonviral_unique'],$page['page_content_activity'],$page['mentions'],$page_fans_online_per_day,$page['page_post_engagements'],$page['page_posts_impressions'],$page['page_posts_impressions_unique'],$page['page_posts_impressions_paid'],$page['page_posts_impressions_paid_unique'],$page['page_posts_impressions_organic'],$page['page_posts_impressions_organic_unique'],$page['page_posts_impressions_viral'],$page['page_posts_impressions_viral_unique'],$page['page_posts_impressions_nonviral'],$page['page_posts_impressions_nonviral_unique'],$page['clics'],$page['shares'],$page['likes'],$page['comments'],$page['end_time']);
    echo('<pre>');
     var_dump($page);
    echo('</pre>');
    die;
            }
        }
        $updated_time = date('Y-m-d h:i:s');
$updated_time = date( "Y-m-d", strtotime( "-1 day", strtotime( $updated_time ) ) );
    //   echo('<pre>');
    //  var_dump($updated_timeT);
    // echo('</pre>');
    // die;
        $FacebookModel->UpdateStateFacebookPageFansInJob($keyJob,$updated_time,'ok');
        }catch (\Exception $e) {
            $keyJob = htmlspecialchars($_GET['0']);
            $updated_time = date('Y-m-d h:i:s');
            $FacebookModel->UpdateStateFacebookPageFansInJob($keyJob,$updated_time,'$e->getMessage()');
            //echo $e->getMessage();
           $return["message"] = $e->getMessage();
             //echo  "Error en servidor facebook: ".$e->getMessage();
             //sendMailer("mario@mimirwell.com","Hubo un error en guardado de page fans facebook",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
        }

}
$qtyRegistersPageFans = $FacebookModel->countDataPageFansFacebook($id_page);
if ($qtyRegistersPageFans < 731){
    $FacebookModel->deleteRegistersPageFansFacebook($id_page);
    $since = date('Y-m-d',strtotime("- 3 month")); 
    $until = date('Y-m-d',strtotime("+ 1 days")); 
    insertPageFans($app_id,$app_secret,$access_token,$page_token,$id_page,$since,$until);
    $since = date('Y-m-d',strtotime("- 6 month")); 
    $until = date('Y-m-d',strtotime("- 3 month + 1 days")); 
    insertPageFans($app_id,$app_secret,$access_token,$page_token,$id_page,$since,$until);
    $since = date('Y-m-d',strtotime("- 9 month")); 
    $until = date('Y-m-d',strtotime("- 6 month + 1 days")); 
    insertPageFans($app_id,$app_secret,$access_token,$page_token,$id_page,$since,$until);
    $since = date('Y-m-d',strtotime("- 12 month")); 
    $until = date('Y-m-d',strtotime("- 9 month + 1 days")); 
    insertPageFans($app_id,$app_secret,$access_token,$page_token,$id_page,$since,$until);
    $since = date('Y-m-d',strtotime("- 15 month")); 
    $until = date('Y-m-d',strtotime("- 12 month + 1 days")); 
    insertPageFans($app_id,$app_secret,$access_token,$page_token,$id_page,$since,$until);
    $since = date('Y-m-d',strtotime("- 18 month")); 
    $until = date('Y-m-d',strtotime("- 15 month + 1 days")); 
    insertPageFans($app_id,$app_secret,$access_token,$page_token,$id_page,$since,$until);
    $since = date('Y-m-d',strtotime("- 21 month")); 
    $until = date('Y-m-d',strtotime("- 18 month + 1 days")); 
    insertPageFans($app_id,$app_secret,$access_token,$page_token,$id_page,$since,$until);
    $since = date('Y-m-d',strtotime("- 24 month")); 
    $until = date('Y-m-d',strtotime("- 21 month + 1 days")); 
    insertPageFans($app_id,$app_secret,$access_token,$page_token,$id_page,$since,$until);
}
else {
    $hoy = date('Y-m-d');
    $checkIfFacebookPageFansRegisterdayExists = $FacebookModel->checkIfFacebookPageFansRegisterdayExists($id_page,$hoy);
    if (!$checkIfFacebookPageFansRegisterdayExists){ 
        $since = date('Y-m-d',strtotime("+1 days")); 
        $until = date('Y-m-d',strtotime("+1 days"));
    insertPageFans($app_id,$app_secret,$access_token,$page_token,$id_page,$since,$until); 
    }
    
    $checkIfFacebookPageFansRegisterdayExists = $FacebookModel->checkIfFacebookPageFansRegisterdayExists($id_page,$hoy);
    if ($checkIfFacebookPageFansRegisterdayExists){ 
        $sincefod = date('Y-m-d',strtotime("-1 days"));
        $countFansOnline = $FacebookModel->getFacebookPageFansOnlineRegisterDay($id_page,$sincefod);
        if ($countFansOnline == ""){
            $sincefod = date('Y-m-d');
            $paramsfod = array(
            'since'=>$sincefod,
            'until'=>$sincefod, 
            'include_headers'=>'false',
            'metric' => array('page_fans_online_per_day'),
        ); 
        $datafod = $page_api->call('/'.$id_page.'/insights', RequestInterface::METHOD_GET,$paramsfod)->getContent();
        $page_fans_online_per_day = isset($datafod['data']['0']['values']['0']['value']) ? $datafod['data']['0']['values']['0']['value'] : '';
            $end_time = date('Y-m-d',strtotime("-1 days"));
           $FacebookModel->UpdateFacebookPageFansOnline($id_page,$page_fans_online_per_day,$end_time);
          
        } else { 
          
        }
    }
}

