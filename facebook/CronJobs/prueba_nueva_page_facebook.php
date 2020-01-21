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
    	//$headers .= "Reply-To: $responder_a\r\n"; 
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

 //function insertPageFans($app_id,$app_secret,$access_token,$page_token,$id_page) {
//         echo "<pre>";
//     var_dump($app_id);
//         echo"</pre>";
//         die;
//  try {
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
                
            //Page User Demographics  //listo
            
            
        //     'page_fan_adds',
        //     'page_fan_adds_unique',
        //   // 'page_fans_locale', //Condenados hasta nuevo aviso
        //     'page_fans_gender_age',
        //     'page_fans_online_per_day',
        //     'page_fans_by_like_source',
        //     'page_fans_by_like_source_unique',
        //     'page_fan_removes',
        //     'page_fan_removes_unique',
        //     'page_fans_by_unlike_source_unique',

            
            //Page Impressions //listo

            // 'page_impressions',
            // 'page_impressions_unique',
            // 'page_impressions_paid',
            // 'page_impressions_paid_unique',
            // 'page_impressions_organic',
            // 'page_impressions_organic_unique',
            // 'page_impressions_viral',
            // 'page_impressions_viral_unique',
            // 'page_impressions_nonviral',
            // 'page_impressions_nonviral_unique',
            // 'page_impressions_by_story_type',    		
            // 'page_impressions_by_story_type_unique',
            // 'page_impressions_by_age_gender_unique',
            // 'page_impressions_frequency_distribution',
            // 'page_impressions_viral_frequency_distribution',
            
            //'page_impressions_by_city_unique', Condenados hasta nuevo aviso
            //'page_impressions_by_country_unique',  Condenados hasta nuevo aviso
            //'page_impressions_by_locale_unique',  Condenados hasta nuevo aviso
            
            
           // Page Engagement //Listo
           
            // 'page_engaged_users',
            // 'page_consumptions',
            // 'page_consumptions_unique',
            // 'page_consumptions_by_consumption_type',
            // 'page_consumptions_by_consumption_type_unique',
            // 'page_places_checkin_total',
            // 'page_places_checkin_total_unique',
            // 'page_places_checkin_mobile',
            // 'page_places_checkin_mobile_unique',
            // 'page_fans_online',  Condenados hasta nuevo aviso
            // 'page_negative_feedback',
            // 'page_negative_feedback_unique',
            // 'page_negative_feedback_by_type',
            // 'page_negative_feedback_by_type_unique',
            // 'page_positive_feedback_by_type',
            // 'page_positive_feedback_by_type_unique',
            // 'page_fan_adds_by_paid_unique',
            // 'page_fan_adds_by_non_paid_unique',
             //'page_fan_adds_by_paid_non_paid_unique', //trae incluido las dos variables anteriores + el total

            

            
                //Page Reactions//listo
                
                // 'page_actions_post_reactions_like_total',
                // 'page_actions_post_reactions_love_total',
                // 'page_actions_post_reactions_wow_total',
                // 'page_actions_post_reactions_haha_total',
                // 'page_actions_post_reactions_sorry_total',
                // 'page_actions_post_reactions_anger_total',
                // 'page_actions_post_reactions_total' // es el total de todas las variables anteriores, pero solo muestra las que tienen reacciones

                //Page CTA Clicks
                
                // 'page_total_actions',
                // 'page_cta_clicks_logged_in_total',
                // 'page_cta_clicks_logged_in_unique',
                // 'page_cta_clicks_by_site_logged_in_unique',
                // 'page_cta_clicks_by_age_gender_logged_in_unique',
                // 'page_call_phone_clicks_by_age_gender_logged_in_unique',
                // 'page_call_phone_clicks_by_site_logged_in_unique',
                // 'page_get_directions_clicks_logged_in_unique',
                // 'page_get_directions_clicks_by_age_gender_logged_in_unique',
                // 'page_get_directions_clicks_by_site_logged_in_unique',
                // 'page_website_clicks_logged_in_unique',
                // 'page_website_clicks_by_age_gender_logged_in_unique',
                // 'page_website_clicks_by_site_logged_in_unique',
                
                //Page Content
                
                // 'page_tab_views_login_top_unique',
                // 'page_tab_views_login_top',
                // 'page_tab_views_logout_top',
                
               // Page Views
                
                // 'page_views_total',
                // 'page_views_logout',
                // 'page_views_logged_in_total',
                // 'page_views_logged_in_unique',
                // 'page_views_external_referrals',
                // 'page_views_by_profile_tab_total',
                // 'page_views_by_profile_tab_logged_in_unique',
                // 'page_views_by_internal_referer_logged_in_unique',
                // 'page_views_by_site_logged_in_unique',
                // 'page_views_by_age_gender_logged_in_unique',
                // 'page_views_by_referers_logged_in_unique',
                
                // Page Video Views

                // 'page_video_views',
                // 'page_video_views_paid',
                // 'page_video_views_organic',
                // 'page_video_views_by_paid_non_paid',
                // 'page_video_views_autoplayed',
                // 'page_video_views_click_to_play',
                // 'page_video_views_unique',
                // 'page_video_repeat_views',
                // 'page_video_complete_views_30s',
                // 'page_video_complete_views_30s_paid',
                // 'page_video_complete_views_30s_organic',
                // 'page_video_complete_views_30s_autoplayed',
                // 'page_video_complete_views_30s_click_to_play',
                // 'page_video_complete_views_30s_unique',
                // 'page_video_complete_views_30s_repeat_views',
                // 'page_video_views_10s',
                // 'page_video_views_10s_paid',
                // 'page_video_views_10s_organic',
                // 'page_video_views_10s_autoplayed',
                // 'page_video_views_10s_click_to_play',
                // 'page_video_views_10s_unique',
                // 'page_video_views_10s_repeat',
                // 'page_video_view_time',
                // 'post_video_complete_views_30s_autoplayed',
                // 'post_video_complete_views_30s_clicked_to_play',
                // 'post_video_complete_views_30s_organic',
                // 'post_video_complete_views_30s_paid',
                // 'post_video_complete_views_30s_unique',
                    
                //    Page Posts
                
                // 'page_post_engagements',
                // 'page_posts_impressions',
                // 'page_posts_impressions_unique',
                // 'page_posts_impressions_paid',
                // 'page_posts_impressions_paid_unique',
                // 'page_posts_impressions_organic',
                // 'page_posts_impressions_organic_unique',
                // 'page_posts_served_impressions_organic_unique',
                // 'page_posts_impressions_viral',
                // 'page_posts_impressions_viral_unique',
                // 'page_posts_impressions_nonviral',
                // 'page_posts_impressions_nonviral_unique',
                // 'page_posts_impressions_frequency_distribution',
                

                
                ),


           //  'metric' => array('page_fans'),esta no va
        ); 
        $data = $page_api->call('/'.$id_page.'/insights', RequestInterface::METHOD_GET,$params)->getContent();
        
        echo "<pre>";
    var_dump($data);
        echo"</pre>";
        die;
        $newData = array();
        if (isset($data['data'])){
           foreach ($data['data'] as $keyFull => $pageInsights)
           {        
               
                   // ----> Page User Demographics <----
                    
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
                
                
                
                //page Impressions
                
                
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
                if ($data['data'][$keyFull]['name'] == "page_impressions_frequency_distribution"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_impressions_frequency_distribution){
                        $newData[$key]['page_impressions_frequency_distribution'] = $page_impressions_frequency_distribution['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_impressions_viral_frequency_distribution"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_impressions_viral_frequency_distribution){
                        $newData[$key]['page_impressions_viral_frequency_distribution'] = $page_impressions_viral_frequency_distribution['value'];
                    }
                }
                        
                        
                        // Page Engagement
                        
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

                
                    //Page Reactions
                
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
                
                //Page CTA Clicks
                
                
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
                
                
                //Page Content//
                
                
                if ($data['data'][$keyFull]['name'] == "page_tab_views_login_top_unique"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_tab_views_login_top_unique){
                        $newData[$key]['page_tab_views_login_top_unique'] = $page_tab_views_login_top_unique['value'];
                    }
                }
               if ($data['data'][$keyFull]['name'] == "page_tab_views_login_top"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_tab_views_login_top){
                        $newData[$key]['page_tab_views_login_top'] = $page_tab_views_login_top['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_tab_views_logout_top"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_tab_views_logout_top){
                        $newData[$key]['page_tab_views_logout_top'] = $page_tab_views_logout_top['value'];
                    }
                }
                
                 // Page Views
                
                                
                if ($data['data'][$keyFull]['name'] == "page_views_total"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_views_total){
                        $newData[$key]['page_views_total'] = $page_views_total['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_views_logout"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_views_logout){
                        $newData[$key]['page_views_logout'] = $page_views_logout['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_views_logged_in_total"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_views_logged_in_total){
                        $newData[$key]['page_views_logged_in_total'] = $page_views_logged_in_total['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_views_logged_in_unique"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_views_logged_in_unique){
                        $newData[$key]['page_views_logged_in_unique'] = $page_views_logged_in_unique['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_views_external_referrals"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_views_external_referrals){
                        $newData[$key]['page_views_external_referrals'] = $page_views_external_referrals['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_views_by_profile_tab_total"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_views_by_profile_tab_total){
                        $newData[$key]['page_views_by_profile_tab_total'] = $page_views_by_profile_tab_total['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_views_by_profile_tab_logged_in_unique"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_views_by_profile_tab_logged_in_unique){
                        $newData[$key]['page_views_by_profile_tab_logged_in_unique'] = $page_views_by_profile_tab_logged_in_unique['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_views_by_internal_referer_logged_in_unique"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_views_by_internal_referer_logged_in_unique){
                        $newData[$key]['page_views_by_internal_referer_logged_in_unique'] = $page_views_by_internal_referer_logged_in_unique['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_views_by_site_logged_in_unique"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_views_by_site_logged_in_unique){
                        $newData[$key]['page_views_by_site_logged_in_unique'] = $page_views_by_site_logged_in_unique['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_views_by_age_gender_logged_in_unique"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_views_by_age_gender_logged_in_unique){
                        $newData[$key]['page_views_by_age_gender_logged_in_unique'] = $page_views_by_age_gender_logged_in_unique['value'];
                    }
                }
                if ($data['data'][$keyFull]['name'] == "page_tab_views_logout_top"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_tab_views_logout_top){
                        $newData[$key]['page_tab_views_logout_top'] = $page_tab_views_logout_top['value'];
                    }
                }
                
                
                            // Page Video Views
                
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
                                 //Page Posts
                
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
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                if ($data['data'][$keyFull]['name'] == "page_fans_online"){
                    foreach ($data['data'][$keyFull]['values'] as $key => $page_fans_online){
                        $newData[$key]['page_fans_online'] = $page_fans_online['value'];
                    }
                }
                
                
                

                
                if ($data['data'][$keyFull]['name'] == "page_fans_online_per_day"){
                 foreach ($data['data'][$keyFull]['values'] as $key => $page_fans_online_per_day){
                        $newData[$key]['page_fans_online_per_day'] = $page_fans_online_per_day['value'];
                    }
                }    
                
   
                //  if ($data['data'][$keyFull]['name'] == "page_posts_impressions"){ 
                //     foreach ($data['data'][$keyFull]['values'] as $key => $page_posts_impressions){
                //         $newData[$key]['page_posts_impressions'] = $page_posts_impressions['value'];
                //     }
                //  }
                //  if ($data['data'][$keyFull]['name'] == "page_posts_impressions_unique"){ 
                //     foreach ($data['data'][$keyFull]['values'] as $key => $page_posts_impressions_unique){
                //         $newData[$key]['page_posts_impressions_unique'] = $page_posts_impressions_unique['value'];
                //     }
                //  }
                //  if ($data['data'][$keyFull]['name'] == "page_posts_impressions_paid"){
                //     foreach ($data['data'][$keyFull]['values'] as $key => $page_posts_impressions_paid){
                //         $newData[$key]['page_posts_impressions_paid'] = $page_posts_impressions_paid['value'];
                //     }
                //  }
                //  if ($data['data'][$keyFull]['name'] == "page_posts_impressions_paid_unique"){
                //     foreach ($data['data'][$keyFull]['values'] as $key => $page_posts_impressions_paid_unique){
                //         $newData[$key]['page_posts_impressions_paid_unique'] = $page_posts_impressions_paid_unique['value'];
                //     }
                //  }
                //  if ($data['data'][$keyFull]['name'] == "page_posts_impressions_organic"){
                //     foreach ($data['data'][$keyFull]['values'] as $key => $page_posts_impressions_organic){
                //         $newData[$key]['page_posts_impressions_organic'] = $page_posts_impressions_organic['value'];
                //     }
                //  }
                //  if ($data['data'][$keyFull]['name'] == "page_posts_impressions_organic_unique"){
                //     foreach ($data['data'][$keyFull]['values'] as $key => $page_posts_impressions_organic_unique){
                //         $newData[$key]['page_posts_impressions_organic_unique'] = $page_posts_impressions_organic_unique['value'];
                //     }
                //  }
                //  if ($data['data'][$keyFull]['name'] == "page_posts_impressions_viral"){
                //     foreach ($data['data'][$keyFull]['values'] as $key => $page_posts_impressions_viral){
                //         $newData[$key]['page_posts_impressions_viral'] = $page_posts_impressions_viral['value'];
                //     }
                //  }
                //  if ($data['data'][$keyFull]['name'] == "page_posts_impressions_viral_unique"){
                //     foreach ($data['data'][$keyFull]['values'] as $key => $page_posts_impressions_viral_unique){
                //         $newData[$key]['page_posts_impressions_viral_unique'] = $page_posts_impressions_viral_unique['value'];
                //     }
                //  }
                //  if ($data['data'][$keyFull]['name'] == "page_posts_impressions_nonviral"){
                //     foreach ($data['data'][$keyFull]['values'] as $key => $page_posts_impressions_nonviral){
                //         $newData[$key]['page_posts_impressions_nonviral'] = $page_posts_impressions_nonviral['value'];
                //     }
                //  }
                //  if ($data['data'][$keyFull]['name'] == "page_posts_impressions_nonviral_unique"){
                //     foreach ($data['data'][$keyFull]['values'] as $key => $page_posts_impressions_nonviral_unique){
                //         $newData[$key]['page_posts_impressions_nonviral_unique'] = $page_posts_impressions_nonviral_unique['value'];
                //     }
                //  }
                //  if ($data['data'][$keyFull]['name'] == "page_consumptions"){
                //     foreach ($data['data'][$keyFull]['values'] as $key => $page_consumptions){
                //         $newData[$key]['clics'] = $page_consumptions['value'];
                //     }
                //  }
                //  if ($data['data'][$keyFull]['name'] == "page_positive_feedback_by_type"){
                //     foreach ($data['data'][$keyFull]['values'] as $key => $page_positive_feedback_by_type){
                //         $newData[$key]['shares'] = isset($page_positive_feedback_by_type['value']['link']) ? $page_positive_feedback_by_type['value']['link'] : '0';
                //     }
                //     foreach ($data['data'][$keyFull]['values'] as $key => $page_positive_feedback_by_type){
                //         $newData[$key]['likes'] = isset($page_positive_feedback_by_type['value']['like']) ? $page_positive_feedback_by_type['value']['like'] : '0';
                //     }
                //     foreach ($data['data'][$keyFull]['values'] as $key => $page_positive_feedback_by_type){
                //         $newData[$key]['comments'] = isset($page_positive_feedback_by_type['value']['comment']) ? $page_positive_feedback_by_type['value']['comment'] : '0';
                //     }
                //     foreach ($data['data'][$keyFull]['values'] as $key => $page_positive_feedback_by_type){
                //         $newData[$key]['end_time'] = isset($page_positive_feedback_by_type['end_time']) ? $page_positive_feedback_by_type['end_time'] : '0';
                //     }
                //  }
            }
        echo "<pre>";
    var_dump($newData);
        echo"</pre>";
        die;
            
            $FacebookModel = new FacebookModel();
            foreach($newData as $page){
               $page_fans = isset($page['page_fans']) ? $page['page_fans'] : '';
               $page_fan_adds_by_paid_unique = isset($page['page_fan_adds_by_paid_unique']) ? $page['page_fan_adds_by_paid_unique'] : '';
               $page_fans_online_per_day =  isset($page['page_fans_online_per_day']) ? $page['page_fans_online_per_day'] : '';
               $page_fan_adds_unique =  isset($page['page_fan_adds_unique']) ? $page['page_fan_adds_unique'] : '';
               $FacebookModel->savePageFans(
                   $id_page,
                   $page_fans,
                   $page_fan_adds_unique,
                   $page_fan_adds_by_paid_unique,
                   $page['page_fan_adds_by_non_paid_unique'],
                   $page['page_fan_removes_unique'],
                   $page['page_engaged_users'],
                   $page['page_impressions'],
                   $page['page_impressions_unique'],
                   $page['page_impressions_paid'],
                   $page['page_impressions_paid_unique'],
                   $page['page_impressions_organic'],
                   $page['page_impressions_organic_unique'],
                   $page['page_impressions_viral'],
                   $page['page_impressions_viral_unique'],
                   $page['page_impressions_nonviral'],
                   $page['page_impressions_nonviral_unique'],
                   $page['page_content_activity'],
                   $page['mentions'],
                   $page_fans_online_per_day,
                   $page['page_post_engagements'],
                   $page['page_posts_impressions'],
                   $page['page_posts_impressions_unique'],
                   $page['page_posts_impressions_paid'],
                   $page['page_posts_impressions_paid_unique'],
                   $page['page_posts_impressions_organic'],
                   $page['page_posts_impressions_organic_unique'],
                   $page['page_posts_impressions_viral'],
                   $page['page_posts_impressions_viral_unique'],
                   $page['page_posts_impressions_nonviral'],
                   $page['page_posts_impressions_nonviral_unique'],
                   $page['clics'],
                   $page['shares'],
                   $page['likes'],
                   $page['comments'],
                   $page['end_time']);
                   
    //     echo "<pre>";
    // var_dump($page);
    //     echo"</pre>";
    //     die;
            }
        }
        $updated_time = date('Y-m-d h:i:s');
        $updated_time = date( "Y-m-d", strtotime( "-1 day", strtotime( $updated_time ) ) );
    //  echo('<pre>');
    //  var_dump($updated_timeT);
    // echo('</pre>');
    // die;
    //    $FacebookModel->UpdateStateFacebookPageFansInJob($keyJob,$updated_time,'ok');
       // }catch (\Exception $e) {
            $keyJob = htmlspecialchars($_GET['t']);
            $updated_time = date('Y-m-d h:i:s');
            $FacebookModel->UpdateStateFacebookPageFansInJob($keyJob,$updated_time,'$e->getMessage()');
            //echo $e->getMessage();
           $return["message"] = $e->getMessage();
             //echo  "Error en servidor facebook: ".$e->getMessage();
             //sendMailer("mario@mimirwell.com","Hubo un error en guardado de page fans facebook",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
      //  }

//}
die;
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


