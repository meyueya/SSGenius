<?php
//session_start();
//header('Content-Type: application/json');
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
    // Configurations
define('SDK_DIR', __DIR__ . '/facebook-php-business-sdk/'); // Path to the SDK directory
$loader = include SDK_DIR.'/vendor/autoload.php';
//use Facebook\Facebook;
use FacebookAds\Api;
use FacebookAds\Session;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Http\Request;
use FacebookAds\Http\RequestInterface;
use FacebookAds\Object\Page;

// Include the required dependencies.
//require_once( 'php-sdk-5/vendor/autoload.php' );

require_once('../model/FacebookModel.php');

$FacebookModel = new FacebookModel();
$keyJob = htmlspecialchars($_GET['t']);
if (isset($keyJob)){
$job = $FacebookModel->getFacebookPostPageJob($keyJob);
//print_r($job);
} else { $return["message"] = "no hay keyJob"; exit(); }
$app_id = '292708578241182';
$app_secret = '462aeec937ca833dd9798c944d5c79e2';
$access_token = $job->access_token;
$page_token = $job->page_token; 
$id_page = $job->id_facebook_page; 

/*$fb = new Facebook\Facebook([
  'app_id' => $app_id,
  'app_secret' => $app_secret,
  'default_graph_version' => 'v3.2',
]);*/


$api = Api::init($app_id, $app_secret, $access_token);
$api->setLogger(new CurlLogger());
$api = Api::instance();
$page_session = new Session($app_id, $app_secret, $page_token);
$page_api = new Api($api->getHttpClient(), $page_session);
$page_api->setLogger($api->getLogger());

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
    $paramsPage = array(
        'fields' => array('id','name','picture','category','description','link','access_token','can_post')
    ); 

try {
    $datapage = $page_api->call('/'.$id_page.'/', RequestInterface::METHOD_GET,$paramsPage)->getContent();//
}catch (FacebookAds\Http\Exception\AuthorizationException $e) {
              $return["message"] = $e->getMessage();
            sendMailer("mario@mimirwell.com","Error de Autorizacion - ". $id_page,__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
        }
//echo "<pre>";
//print_r($datapage);
//echo "</pre>";
//exit();
if (count($datapage) > 0){
   // deletePage($id_page);
  //  insertPageFacebook($datapage['id'],$datapage['name'],$datapage['picture']['data']['url'],$datapage['category'],$datapage['description'],$datapage['link'],$datapage['access_token']);
}

$timeZone = "+5 hours";//zona horaria GTM -5
$since = date('Y-m-d',strtotime("- 2 year"));// 2 a単os de datos de page nos da facebook
$until = date('Y-m-d',strtotime($timeZone));
$limit = 100;
$arrayFields = array('id','created_time','updated_time','message','full_picture','attachments','permalink_url','admin_creator','shares','promotion_status','insights.metric(post_impressions_paid_unique).period(lifetime).as(reach_paid)','insights.metric(post_impressions_organic_unique).period(lifetime).as(reach_organic)','insights.metric(post_impressions_unique).period(lifetime).as(reach)','comments.filter(stream).limit(0).summary(total_count).as(comments)','reactions.limit(0).summary(total_count).as(reactions)','insights.metric(post_video_views_unique).period(lifetime).as(post_video_views_unique)','insights.metric(post_clicks_by_type_unique).period(lifetime).as(post_clicks_by_type_unique)','type');
$params = array('since'=>$since,'until'=>$until,'fields' => $arrayFields,'limit' => $limit, 'include_headers' =>false);
try{
    $cursor = $page_api->call('/'.$id_page.'/posts', RequestInterface::METHOD_GET,$params)->getContent();//obtener posts
    $arrayData = isset($cursor['data']) ? $cursor['data'] : array();
    $after = isset($cursor['paging']['cursors']['after']) ? $cursor['paging']['cursors']['after'] : array();
    $next = isset($cursor['paging']['next']) ? $cursor['paging']['next'] : '';
    $params = array('after'=>$after, 'since'=>$since, 'until'=>$until,'fields' => $arrayFields,'limit' => $limit, 'include_headers' =>false);
    while($next != "") {
        $newCursor = $page_api->call('/'.$id_page.'/posts', RequestInterface::METHOD_GET,$params)->getContent();//obtener posts
        $arrayData = array_merge($arrayData,$newCursor['data']);
        $after = $newCursor['paging']['cursors']['after'];
        $next = isset($newCursor['paging']['next']) ? $newCursor['paging']['next'] : '';
        $params = array('after'=>$after, 'since'=>$since,'until'=>$until,'fields' => $arrayFields,'limit' => $limit, 'include_headers' =>false);
    }
}catch (\Exception $e) {
              //$message = "Error tipo facebook exception: ".$e->getMessage();
              $return["message"] = $e->getMessage();
              sendMailer("mario@mimirwell.com","Error Facebook Exception",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
        }
        

if (count($arrayData) > 0){
   // echo "<pre>";
   //print_r($arrayData);
   //exit();
    
foreach ($arrayData as $key => $newArrayData)
    {
        $created_time = explode('T',$newArrayData['created_time']);
        $paramsFans = array(
            'since'=>$created_time['0'],
            'until'=>$created_time['0'], //rango de 90 dias maximo
            'metric' => array('page_fans'),
            'include_headers' => false
        ); 
        $dataFans = $page_api->call('/'.$id_page.'/insights', RequestInterface::METHOD_GET,$paramsFans)->getContent();//obtener las reacciones de un post
        if (isset($dataFans['data']['0']['values']['0']['value'])){
           $fansPage = $dataFans['data']['0']['values']['0']['value'];
        } else {$fansPage = 0;}
        $arrayData[$key]['page_fans'] = $fansPage;
        $reacciones = $arrayData[$key]['reactions']['summary']['total_count'];
        $shares = isset($arrayData[$key]['shares']['count']) ? $arrayData[$key]['shares']['count'] : '';
        $comments = $arrayData[$key]['comments']['summary']['total_count'];
        $post_video_views_unique = $arrayData[$key]['post_video_views_unique']['data']['0']['values']['0']['value'];
        if (isset($arrayData[$key]['post_clicks_by_type_unique']['data']['0']['values']['0']['value']['link clicks'])){ $link_clicks = $arrayData[$key]['post_clicks_by_type_unique']['data']['0']['values']['0']['value']['link clicks']; }
               else { $link_clicks = "0"; }
        $totalInteracciones = $reacciones + $shares + $comments + $post_video_views_unique + $link_clicks;
        if ($fansPage > 0){
        $indiceInteraccion = number_format((float)(($totalInteracciones/$fansPage) * 1000), 2, '.', '');
        } else {$indiceInteraccion = 0; }
        $arrayData[$key]['indice_interaccion'] = $indiceInteraccion;
        $alcance = $arrayData[$key]['reach']['data']['0']['values']['0']['value'];
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
     echo "<pre>";
    print_r($arrayData);
    echo "</pre>";
    exit();  
    
    //print_r($arrayData); 
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