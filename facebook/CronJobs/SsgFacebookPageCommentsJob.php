<?php
header('Content-Type: application/json');
//error_reporting(E_ALL & ~E_NOTICE & E_DEPRECATED);
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
$_GET['t']=1;
$keyJob = htmlspecialchars($_GET['t']);
if (isset($keyJob)){
$job = $FacebookModel->getFacebookPostPageJob($keyJob);
if ($job == false){ $return["message"] = "Error DB"; exit();}
//print_r($job);
} else { $return["message"] = "no hay keyJob"; exit(); }
$access_token = $job->access_token;
$page_token = $job->page_token; 
$id_page = $job->id_facebook_page; 
$page_api = $SsgFacebookHelper->getPageApi($access_token,$page_token);

$next = "";
$after = "";
$timeZone = "+5 hours";//zona horaria GMT -5
$dia = date('Y-m-d',strtotime($timeZone));
$since = date('Y-m-d',strtotime("- 2 years"));
$until = $dia;
$arrayFields = array('id');
$params = array('since'=>$since,'until'=>$until,'fields' => $arrayFields,'limit' => '100',);
$arrayData = array();
$arrayDataMessages = array();
$newCursor = array();
$newCursorMessages = array();
try{
    $cursor = $page_api->call('/'.$id_page.'/feed', RequestInterface::METHOD_GET,$params)->getContent();//obtener posts
    $arrayData = $cursor['data'];
    $next = isset($cursor['paging']['next']) ? $cursor['paging']['next'] : "";
    $after = isset($cursor['paging']['cursors']['after']) ? $cursor['paging']['cursors']['after'] : "";
    $params = array('after'=>$after, 'since'=>$since, 'until'=>$until,'fields' => $arrayFields,'limit' => '100',);
    while($next != "") {
        $newCursor = $page_api->call('/'.$id_page.'/feed', RequestInterface::METHOD_GET,$params)->getContent();//obtener posts
        $arrayData = array_merge($arrayData,$newCursor['data']);
        $after = $newCursor['paging']['cursors']['after'];
        $next = isset($newCursor['paging']['next']) ? $newCursor['paging']['next'] : "";
        $params = array('after'=>$after, 'since'=>$since,'until'=>$until,'fields' => $arrayFields,'limit' => '100',);
    }
}catch (FacebookAds\Http\Exception\ServerException $e) {
             //$message = "Error en servidor facebook: ".$e->getMessage();
             $return["message"] = $e->getMessage();
              $SsgHelper->sendMailer("ssgdeveloperalerts@mimirwell.com","Hubo un error en guardado de comentarios facebook page_id: ".$id_page,__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
        } catch (\Exception $e){
          $return["message"] = $e->getMessage();
              $SsgHelper->sendMailer("ssgdeveloperalerts@mimirwell.com","Hubo un error en guardado de comentarios facebook page_id: ".$id_page,__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());  
        }
        
$nextMessages = "";
$afterMessages = "";
$arrayMessagesData = array();
if (count($arrayData) > 0){
$FacebookModel->deleteMessagesPostsPage($id_page);
} else {$return["message"] = "No hubo data";}
    foreach($arrayData as $arrayPost){
    $arrayFieldsMessages = array('id','parent','from','created_time','message','comment_count','like_count','user_likes','is_hidden','attachment','can_comment','can_remove','can_hide','can_like');
    $paramsMessages = array(
   'summary' => 'false',
   'limit' => '100',
   'filter' => 'stream',
   'fields' => $arrayFieldsMessages,
);
try{
    $dataMessages = $page_api->call('/'.$arrayPost['id'].'/comments', RequestInterface::METHOD_GET,$paramsMessages)->getContent();//obtener comentarios de un post
    $arrayDataMessages = $dataMessages['data'];
    $nextMessages = isset($dataMessages['paging']['next']) ? $dataMessages['paging']['next'] : "";
    $afterMessages = isset($dataMessages['paging']['cursors']['after']) ? $dataMessages['paging']['cursors']['after'] : "";
    $paramsMessages = array('after'=>$afterMessages, 'fields' => $arrayFieldsMessages,'limit' => '100','filter' => 'stream','summary' => 'false');
        while($nextMessages != "") {
        $newCursorMessages = $page_api->call('/'.$arrayPost['id'].'/comments', RequestInterface::METHOD_GET,$paramsMessages)->getContent();//obtener posts
        $arrayDataMessages = array_merge($arrayDataMessages,$newCursorMessages['data']);
        $afterMessages = $newCursorMessages['paging']['cursors']['after'];
        $nextMessages = $newCursorMessages['paging']['next'];
        $paramsMessages = array('after'=>$afterMessages,'fields' => $arrayFieldsMessages,'limit' => '100','filter' => 'stream','summary' => 'false');
    }
}catch (FacebookAds\Http\Exception\ServerException $e) {
             //$message = "Error en servidor facebook: ".$e->getMessage();
             $return["message"] = $e->getMessage();
             $SsgHelper->sendMailer("ssgdeveloperalerts@mimirwell.com","Hubo un error en guardado de comentarios facebook page_id: ".$id_page,__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
        }catch (\Exception $e){
          $return["message"] = $e->getMessage();
              $SsgHelper->sendMailer("ssgdeveloperalerts@mimirwell.com","Hubo un error en guardado de comentarios facebook page_id: ".$id_page,__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());  
        }
        if ((count($arrayDataMessages)) > 0){
            //echo PHP_EOL."EL ID DEL POST ES: ".$arrayPost['id'].PHP_EOL;
            
            $FacebookModel->saveMessagesPostsOfFacebookPage($arrayDataMessages,$id_page,$arrayPost['id']);
        }
        //print_r($arrayDataMessages);
        //$arrayMessagesData = array_merge($arrayMessagesData, $arrayDataMessages); 
        }
        if (!isset($return["message"])){ $return["message"] = "ok"; }
        $updated_time = date("Y-m-d h:i:s");
        $FacebookModel->UpdateStateFacebookPostPageCommentsInJob($keyJob,$updated_time,$return["message"]);
        //print_r($arrayMessagesData);
   // exit(); 


