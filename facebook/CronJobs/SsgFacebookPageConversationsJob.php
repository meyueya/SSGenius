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
require_once('../../model/FacebookModel.php');
require_once('../../helper/SsgFacebookHelper.php');
require_once('../../helper/SsgHelper.php');

$FacebookModel = new FacebookModel();
$SsgFacebookHelper = new SsgFacebookHelper();
$SsgHelper = new SsgHelper();
$_GET['t'] = 1;
$keyJob = htmlspecialchars($_GET['t']);

if (isset($keyJob)){
$job = $FacebookModel->getFacebookPostPageJob($keyJob);
if ($job == false){ $return["message"] = "Error DB";  exit();}
//print_r($job);
} else { $return["message"] = "no hay keyJob"; exit();  }
$access_token = $job->access_token;
$page_token = $job->page_token; 
$id_page = $job->id_facebook_page; 
$page_api = $SsgFacebookHelper->getPageApi($access_token,$page_token);
  var_dump($access_token);
  die;
   /* $response = $api->call('/me/accounts');
    $data = $response->getContent();
    print_r($data);
    exit();*/
    /*$dia = date('Y-m-d');
    $since =date('Y-m-d',strtotime("-1 year")); */
    $dia = date('2019-03-31');
    $since =date('2019-03-01');
    $until = $dia;
    $next = "";
    $after = "";
    $counterConversations = 0;
    $arrayDataConversations = array();
    $newCursorConversations = array();
    

     $arrayFieldsConversations = array(
         'id',
         'snippet',
         'link',
         'updated_time',
         'message_count',
         'unread_count',
         'participants',
         'senders',
         'can_reply',
         'is_subscribed'
         );
     $params = array(
        
         'fields' => $arrayFieldsConversations,
         'limit' => '100',
         'time_range' => array('since' => '2019-03-01','until' => '2019-03-31'),
         );
    
    // var_dump($params);

       $conversaciones = $page_api->call('/'.$id_page.'/conversations', RequestInterface::METHOD_GET,$params)->getContent();//obtener inbox
    // var_dump($conversaciones);
    // die;
    
       $arrayDataConversations = $conversaciones['data'];
       $next = isset($conversaciones['paging']['next']) ? $conversaciones['paging']['next'] : "";
       $after = isset($conversaciones['paging']['cursors']['after']) ? $conversaciones['paging']['cursors']['after'] : "";
       $params = array('since'=>$since,'until'=>$until,'after'=>$after,'fields' => $arrayFieldsConversations,'limit' => '100');
       
          while($next != "") {
           $counterConversations++;
        //if ($counterConversations < 8){ //guardamos mil conversaciones 
            $newCursorConversations = $page_api->call('/'.$id_page.'/conversations', RequestInterface::METHOD_GET,$params)->getContent(); //obtener posts
            $arrayDataConversations = array_merge($arrayDataConversations,$newCursorConversations['data']);
            $after = $newCursorConversations['paging']['cursors']['after'];
            $next = (isset($newCursorConversations['paging']['next'])) ? $newCursorConversations['paging']['next'] : '';
            $params = array('since'=>$since,'until'=>$until,'after'=>$after,'fields' => $arrayFieldsConversations,'limit' => '100');
      //  } else { 
           //echo count($arrayDataConversations)." conversaciones".PHP_EOL;
         //  break;
       // }
      } 
 
    
      try{ 
         //echo $e->getMessage();
          $updated_time = date("Y-m-d h:i:s");
              $return["message"] = $e->getMessage();
             $SsgHelper->sendMailer("ssgdeveloperalerts@mimirwell.com","Hubo un error en guardado de conversaciones facebook ",$id_page."! en ".__FILE__." \n ".$e->getMessage());
              $FacebookModel->UpdateStateFacebookPostPageConversationsInJob($keyJob,$updated_time,$return["message"]);
        }catch (\Exception $e) {
             $updated_time = date("Y-m-d h:i:s");
        $return["message"] = $e->getMessage();
              $SsgHelper->sendMailer("ssgdeveloperalerts@mimirwell.com","Hubo un error en guardado de conversaciones facebook ",$id_page."! en ".__FILE__." \n ".$e->getMessage());
               $FacebookModel->UpdateStateFacebookPostPageConversationsInJob($keyJob,$updated_time,$return["message"]);
               exit();
        }
           if (count($arrayDataConversations) > 0){
            $FacebookModel->deleteConversationsPage($id_page);
            $FacebookModel->deleteConversationsMessagesPage($id_page);
            $FacebookModel->saveConversationsOfFacebookPage($arrayDataConversations,$id_page);
            exit();
          }
          
   
      
      
      if (count($arrayDataConversations) == 0){
          $return["message"] = "No hubo data";
      }
    foreach($arrayDataConversations as $conversationsArray){
     $arrayFieldsConversationsMessages = array('id','message','created_time','from','to','shares{id,name,description,link}','attachments','tags');
     $paramsConversationsMessages = array('fields' => $arrayFieldsConversationsMessages,'limit' => '100');
     try{
     $Mensajesconversaciones = $page_api->call('/'.$conversationsArray['id'].'/messages', RequestInterface::METHOD_GET,$paramsConversationsMessages)->getContent();//obtener los mensajes por cada inbox
        // print_r($Mensajesconversaciones);
     $FacebookModel->saveMessagesConversationsOfFacebookPage($Mensajesconversaciones,$id_page,$conversationsArray['id']);
     
     }catch (FacebookAds\Http\Exception\ServerException $e) {
             $return["message"] = $e->getMessage();
             //$SsgHelper->sendMailer("ssgdeveloperalerts@mimirwell.com","Hubo un error en guardado de messages facebook",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
        }catch (FacebookAds\Exception\Exception $e) {
              $return["message"] = $e->getMessage();
             // $SsgHelper->sendMailer("ssgdeveloperalerts@mimirwell.com","Hubo un error en guardado de messages facebook",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
        }

     }
    
     if (!isset($return["message"])){ $return["message"] = "ok"; }
     $updated_time = date("Y-m-d h:i:s");
        $FacebookModel->UpdateStateFacebookPostPageConversationsInJob($keyJob,$updated_time,$return["message"]);
        
     
   // if (count($Mensajesconversaciones > 0)){
         
         
     //    }


