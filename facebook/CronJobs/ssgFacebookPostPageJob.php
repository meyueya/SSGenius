<?php
//session_start();
//header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);
    // Configurations
define('SDK_DIR', '/home/ssgenius/public_html/app/facebook/facebook-php-business-sdk/'); // Path to the SDK directory
$loader = include SDK_DIR.'/vendor/autoload.php';
use Facebook\Facebook;
use FacebookAds\Api;
use FacebookAds\Session;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Http\Request;
use FacebookAds\Http\RequestInterface;
use FacebookAds\Object\Page;

require_once('/home/ssgenius/public_html/app/model/FacebookModel.php');
require_once('/home/ssgenius/public_html/app/helper/SsgFacebookHelper.php');
require_once('/home/ssgenius/public_html/app/helper/SsgHelper.php');
$FacebookModel = new FacebookModel();
$SsgFacebookHelper = new SsgFacebookHelper();
$SsgHelper = new SsgHelper();
// $_GET['t'] = 41;
$keyJob = htmlspecialchars($_GET['t']);
if (isset($keyJob)){
$job = $FacebookModel->getFacebookPostPageJob($keyJob);
if ($job == false){ $return["message"] = "Error DB"; exit();}
//print_r($job);
} else { $return["message"] = "no hay keyJob"; exit(); }

$app_id = '292708578241182';
$app_secret = getenv('FACEBOOK_APP_SECRET');
$access_token = getenv('FACEBOOK_ACCESS_TOKEN');

$access_token = $job->access_token;
$page_token = $job->page_token; 
$id_page = $job->id_facebook_page; 

$checkUserToken = $SsgFacebookHelper->TokenValid($access_token,"USER");
$checkPageToken = $SsgFacebookHelper->TokenValid($page_token,"PAGE");


$page_api = $SsgFacebookHelper->getPageApi($access_token,$page_token);
    $paramsPage = array(
        'fields' => array('id','name','picture','category','description','link','access_token','can_post')
    ); 

try {
    $datapage = $page_api->call('/'.$id_page.'/', RequestInterface::METHOD_GET,$paramsPage)->getContent();//
}catch (FacebookAds\Http\Exception\AuthorizationException $e) {
              $return["message"] = $e->getMessage();
            $SsgHelper->sendMailer("ssgdeveloperalerts@mimirwell.com","Error de Autorizacion - ". $id_page,__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
        }



$next = "";
$after = "";
//$dia = date('Y-m-d',strtotime("-1 days"));
$timeZone = "+5 hours";//zona horaria GTM -5
$dia = date('Y-m-d',strtotime($timeZone));
$since = date('Y-m-d',strtotime("- 10 year"));

$until = $dia;
$arrayFields = array('id','created_time','updated_time','message','image_hash','full_picture','attachments{media_type}','permalink_url','admin_creator','shares','promotion_status','insights.metric(post_impressions_paid_unique).period(lifetime).as(reach_paid)','insights.metric(post_impressions_organic_unique).period(lifetime).as(reach_organic)','insights.metric(post_impressions_unique).period(lifetime).as(reach)','comments.filter(stream).limit(0).summary(total_count).as(comments)','reactions.limit(0).summary(total_count).as(reactions)','insights.metric(post_video_views_unique).period(lifetime).as(post_video_views_unique)','insights.metric(post_clicks_by_type_unique).period(lifetime).as(post_clicks_by_type_unique)');
$params = array('since'=>$since,'until'=>$until,'fields' => $arrayFields,'limit' => '100', 'include_headers' => "false");
$arrayData = array();
$newCursor = array();

try{
    $cursor = $page_api->call('/'.$id_page.'/posts', RequestInterface::METHOD_GET,$params)->getContent();//obtener posts
    //print_r($cursor);
    $arrayData = $cursor['data'];
    $next = isset($cursor['paging']['next']) ? $cursor['paging']['next'] : "" ;
    $after = isset($cursor['paging']['cursors']['after']) ? $cursor['paging']['cursors']['after'] : "";
    $params = array('after'=>$after, 'since'=>$since, 'until'=>$until,'fields' => $arrayFields,'limit' => '100', 'include_headers' =>false);
    $CountData = 1;
    while($next != "") {
        $CountData++;
        $newCursor = $page_api->call('/'.$id_page.'/posts', RequestInterface::METHOD_GET,$params)->getContent();//obtener posts
        $arrayData = array_merge($arrayData,$newCursor['data']);
        $after = $newCursor['paging']['cursors']['after'];
        if (isset($newCursor['paging']['next'])){
        $next = $newCursor['paging']['next'];
        } else { $next = ""; }
        $params = array('after'=>$after, 'since'=>$since,'until'=>$until,'fields' => $arrayFields,'limit' => '100', 'include_headers' =>false);
        if ($CountData > 10){ $next = "";} // lo detenemos en mil posts pero el rango es de 10 a���os
         
    }
}catch (FacebookAds\Http\Exception\ServerException $e) {
             //$message = "Error en servidor facebook: ".$e->getMessage();
              $return["message"] = $e->getMessage();
             $SsgHelper->sendMailer("ssgdeveloperalerts@mimirwell.com","Error Facebook Server Exception",__FUNCTION__." page_id: ".$id_page." en ".__FILE__." \n ".$e->getMessage());
        }catch (FacebookAds\Exception\Exception $e) {
              //$message = "Error tipo facebook exception: ".$e->getMessage();
              $return["message"] = $e->getMessage();
              $SsgHelper->sendMailer("ssgdeveloperalerts@mimirwell.com","Error Facebook Exception",__FUNCTION__." page_id: ".$id_page." en ".__FILE__." \n ".$e->getMessage());
        }
 //echo "<pre>";
 //echo count($arrayData);
  // print_r($arrayData);
if (count($arrayData) > 0){
//     echo "<pre>";
//   print_r($arrayData);
   //exit();
    
foreach ($arrayData as $key => $newArrayData)
    {
        $created_time = explode('T',$newArrayData['created_time']);
        $paramsFans = array(
            'since'=>$created_time['0'],
            'until'=>$created_time['0'], //rango de 90 dias maximo
            'period' => "day",
            'metric' => array('page_fans'),
            'include_headers' => "false"
        ); 
        $dataFans = $page_api->call('/'.$id_page.'/insights', RequestInterface::METHOD_GET,$paramsFans)->getContent();
        if (isset($dataFans['data']['0']['values']['0']['value'])){
           $fansPage = $dataFans['data']['0']['values']['0']['value'];
        } else {
             $paramsFans = array(
            'since'=>date("Y-m-d"),
            'until'=>date("Y-m-d"), //rango de 90 dias maximo
            'period' => "day",
            'metric' => array('page_fans'),
            'include_headers' => "false"
        ); 
        $dataFans = $page_api->call('/'.$id_page.'/insights', RequestInterface::METHOD_GET,$paramsFans)->getContent();
            $fansPage = $dataFans['data']['0']['values']['0']['value'];
        }
        $arrayData[$key]['page_fans'] = $fansPage;
        $reacciones = $arrayData[$key]['reactions']['summary']['total_count'];
        $shares = isset($arrayData[$key]['shares']['count']) ? $arrayData[$key]['shares']['count'] : "0";
        $comments = $arrayData[$key]['comments']['summary']['total_count'];
        $post_video_views_unique = $arrayData[$key]['post_video_views_unique']['data']['0']['values']['0']['value'];
        if (isset($arrayData[$key]['post_clicks_by_type_unique']['data']['0']['values']['0']['value']['link clicks'])){ $link_clicks = $arrayData[$key]['post_clicks_by_type_unique']['data']['0']['values']['0']['value']['link clicks']; }
               else { $link_clicks = "0"; }
        $totalInteracciones = $reacciones + $shares + $comments + $post_video_views_unique + $link_clicks;
        if ($fansPage > 0){
        $indiceInteraccion = number_format((float)(($totalInteracciones/$fansPage) * 1000), 2, '.', '');
        } else {$indiceInteraccion = 0; }
        $arrayData[$key]['indice_interaccion'] = $indiceInteraccion;
        $alcance = isset($arrayData[$key]['reach']['data']['0']['values']['0']['value']) ? $arrayData[$key]['reach']['data']['0']['values']['0']['value'] : "0";
        if ($alcance > 0){
            $indiceInteralcance = number_format((float)(($indiceInteraccion/$alcance) * 10000), 2, '.', '');
        } else { $indiceInteralcance = 0;}
            $arrayData[$key]['indice_interalcance'] = $indiceInteralcance;

            $inversion = 0; 
            $indiceInteraccionInversion = 0;
            $indice_interalcance_inversion = 0;
       
        $arrayData[$key]['inversion'] = $inversion;
        $arrayData[$key]['indice_interaccion_inversion'] = $indiceInteraccionInversion;
        $arrayData[$key]['indice_interalcance_inversion'] = $indice_interalcance_inversion;
    }
    //      echo "<pre>";
    // print_r($arrayData); 
    // echo "</pre>";
if (!isset($return["message"])){ $return["message"] = "ok"; }
if ($return["message"] == "ok"){
$FacebookModel->deletePosts($id_page);//borramos los posts de esta pagina
$FacebookModel->savePostsOfFacebookPage($arrayData,$id_page); //guardamos los posts de esta pagina
$FacebookModel->UpdateTrueDataStateFacebookPage($id_page); //seteamos el estado a true de la data de la pagina
}
//echo json_encode($return);
}
$updated_time = date("Y-m-d h:i:s");
if (!isset($return["message"])){ $return["message"] = "No hubo data"; }

$FacebookModel->UpdateStateFacebookPostPageInJob($keyJob,$updated_time,$return["message"]);