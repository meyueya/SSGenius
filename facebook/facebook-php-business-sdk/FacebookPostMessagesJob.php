<?php
header('Content-Type: application/json');
//error_reporting(E_ALL & ~E_NOTICE & E_DEPRECATED);
error_reporting(E_ALL);
ini_set('display_errors', 1);
    // Configurations
define('SDK_DIR', __DIR__ . '/'); // Path to the SDK directory
$loader = include SDK_DIR.'/vendor/autoload.php';
use Facebook\Facebook;
use FacebookAds\Api;
use FacebookAds\Session;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Http\Request;
use FacebookAds\Http\RequestInterface;
use FacebookAds\Object\Page;

$iniFile = '/home/aiwroi/configuration/database.ini';
$fileConfig = parse_ini_file($iniFile, true);
if (!$fileConfig) { throw new \Exception("Can't open or parse ini file.");  }
$database = $fileConfig['Moviltours'];
define('DB_SERVER_USERNAME', $database['user']);
define('DB_SERVER_PASSWORD', $database['pass']);
define('DNS',$database['dns']);
$app_id = '1930491627191257';
$app_secret = '934f83f24436ea82749ca6b5fafc6281';
$access_token = 'EAAbbxZAuuO9kBALT8dRMvtDQxH6rf7Y0Q34PbVP4NO3DTCZBKyMAJMTTgcmVUd5FPDxC0N8KwFWF3eXZBx7OnbUUgoFE2gsUBaZCBudMxb2ljcCZAsBpZB8wDoY0nmoWrLoZCZB3qWGA7prh4YIeEVgSTudVIN50WEyxYP6ZC8gSEbQZDZD';
$page_token = "EAAbbxZAuuO9kBACbppU0DdJuVWHZAsbWDzZBCAan5yzuuZAGm20mvKN5HBeNke5EfJFEN7DMb7K1e0LFnAx748JLv8VFfN8iBBKFTSthqNQhuWMaRiW7KETtsHgX7fB2BZC9dj2CgQgSHCygQdobQuHoDI4yVu4qHce5OtjYlLQZDZD"; //movil tours page token
$id_page = '192597304105183'; //movil tours page id
$api = Api::init($app_id, $app_secret, $access_token);
$api->setLogger(new CurlLogger());
$api = Api::instance();
$page_session = new Session($app_id, $app_secret, $page_token);
$page_api = new Api($api->getHttpClient(), $page_session);
$page_api->setLogger($api->getLogger());

function pdoConect(){
        $conn = new PDO(DNS, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
}
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
function saveMessagesPostsOfFacebookPage($data,$page_id,$post_id){
    $conn = pdoConect();
    $conn->beginTransaction();
$query = "INSERT INTO facebook_comments (`id`, `page_id`, `post_id`, `parent_id`, `from_id`, `from_name`, `created_time`, `message`, `comment_count`, `like_count`, `user_likes`, `is_hidden`, `attachment_title`,`attachment_type`, `attachment_url`, `attachment_media_image_src`, `can_comment`, `can_remove`,`can_hide`,`can_like`) VALUES "; //Prequery
    $qPart = array_fill(0, count($data), "(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $query .=  implode(",",$qPart);
    $stmt = $conn->prepare($query); 
    $i = 1;
    foreach($data as $item) { //bind the values one by one
       $id = isset($item['id']) ? $item['id'] : "";
       $stmt->bindValue($i++, $id);
       $stmt->bindValue($i++, $page_id);
       $stmt->bindValue($i++, $post_id);
       $parent_id = isset($item['parent']['id']) ? $item['parent']['id'] : "";
       $stmt->bindValue($i++, $parent_id);
       $stmt->bindValue($i++, $item['from']['id']);
       $stmt->bindValue($i++, $item['from']['name']);
       $stmt->bindValue($i++, $item['created_time']);
       $message = isset($item['message']) ? $item['message'] : "";
       $stmt->bindValue($i++, $message);
       $stmt->bindValue($i++, $item['comment_count']);
       $stmt->bindValue($i++, $item['like_count']);
       $stmt->bindValue($i++, $item['user_likes']);
       $stmt->bindValue($i++, $item['is_hidden']);
       $attachment_title = isset($item['attachment']['title']) ? $item['attachment']['title'] : "";
       $stmt->bindValue($i++, $attachment_title);
       $attachment_type = isset($item['attachment']['type']) ? $item['attachment']['type'] : "";
       $stmt->bindValue($i++, $attachment_type);
       $attachment_url = isset($item['attachment']['url']) ? $item['attachment']['url'] : "";
       $stmt->bindValue($i++, $attachment_url);
       $attachment_media_image_src = isset($item['attachment']['media']['image']['src']) ? $item['attachment']['media']['image']['src'] : "";
       $stmt->bindValue($i++, $attachment_media_image_src);
       $stmt->bindValue($i++, $item['can_comment']);
       $stmt->bindValue($i++, $item['can_remove']);
       $stmt->bindValue($i++, $item['can_hide']);
       $stmt->bindValue($i++, $item['can_like']);
    }
    try {
        $stmt->execute(); //execute
     } catch (PDOException $e){
        $conn->rollback();
           echo $e->getMessage();
          //sendMailer("mario@mimirwell.com","Job fállido guardar data  ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
        //  sendMailer("luismiguel@mimirwell.com","Job fállido en ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
        }
        $conn->commit();
}

function saveConversationsOfFacebookPage($data,$page_id){
    $conn = pdoConect();
    $conn->beginTransaction();
$query = "INSERT INTO facebook_conversations (`id`, `page_id`, `snippet`, `link`, `updated_time`, `from_id`, `from_name`, `from_email`, `message_count`, `unread_count`, `can_reply`, `is_subscribed`) VALUES "; //Prequery
    $qPart = array_fill(0, count($data), "(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $query .=  implode(",",$qPart);
    $stmt = $conn->prepare($query); 
    $i = 1;
    foreach($data as $item) { //bind the values one by one
       $id = isset($item['id']) ? $item['id'] : "";
       $stmt->bindValue($i++, $id);
       $stmt->bindValue($i++, $page_id);
       $snippet = isset($item['snippet']) ? $item['snippet'] : "";
       $stmt->bindValue($i++, $snippet);
       $stmt->bindValue($i++, $item['link']);
       $stmt->bindValue($i++, $item['updated_time']);
       $stmt->bindValue($i++, $item['participants']['data']['0']['id']);
       $stmt->bindValue($i++, $item['participants']['data']['0']['name']);
       $stmt->bindValue($i++, $item['participants']['data']['0']['email']);
       $message_count = isset($item['message_count']) ? $item['message_count'] : "";
       $stmt->bindValue($i++, $message_count);
       $stmt->bindValue($i++, $item['unread_count']);
       $stmt->bindValue($i++, $item['can_reply']);
       $stmt->bindValue($i++, $item['is_subscribed']);
    }
    try {
        $stmt->execute(); //execute
     } catch (PDOException $e){
        $conn->rollback();
           echo $e->getMessage();
          //sendMailer("mario@mimirwell.com","Job fállido guardar data  ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
        //  sendMailer("luismiguel@mimirwell.com","Job fállido en ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
        }
        $conn->commit();
}


function saveMessagesConversationsOfFacebookPage($data,$page_id,$conversation_id){
    $conn = pdoConect();
    //$conn->beginTransaction();
$query = "INSERT INTO facebook_conversations_messages (`id`, `page_id`, `conversation_id`, `message`, `created_time`, `from_id`, `from_name`, `from_email`, `to_id`, `to_email`, `to_name`, `tags`,`share`) VALUES "; //Prequery
    $qPart = array_fill(0, count($data['data']), "(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $query .=  implode(",",$qPart);
    $stmt = $conn->prepare($query); 
    $i = 1;
    foreach($data['data'] as $item) { //bind the values one by one
       $id = isset($item['id']) ? $item['id'] : "";
       $message = isset($item['message']) ? $item['message'] : "";
       $created_time = isset($item['created_time']) ? $item['created_time'] : "";
       $from_id = isset($item['from']['id']) ? $item['from']['id'] : "";
       $from_name = isset($item['from']['name']) ? $item['from']['name'] : "";
       $from_email = isset($item['from']['email']) ? $item['from']['email'] : "";
       $to_id = isset($item['to']['data']['0']['id']) ? $item['to']['data']['0']['id'] : "";
       $to_email = isset($item['to']['data']['0']['email']) ? $item['to']['data']['0']['email'] : "";
       $to_name = isset($item['to']['data']['0']['name']) ? $item['to']['data']['0']['name'] : "";
       $tags = isset($item['tags']['data']) ? json_encode($item['tags']['data'],true) : "";
       $share = isset($item['shares']['data']) ? json_encode($item['shares']['data'],true) : "NULL";
       $stmt->bindValue($i++, $id);
       $stmt->bindValue($i++, $page_id);
       $stmt->bindValue($i++, $conversation_id);
       $stmt->bindValue($i++, $message);
       $stmt->bindValue($i++, $created_time);
       $stmt->bindValue($i++, $from_id);
       $stmt->bindValue($i++, $from_name);
       $stmt->bindValue($i++, $from_email);
       $stmt->bindValue($i++, $to_id);
       $stmt->bindValue($i++, $to_email);
       $stmt->bindValue($i++, $to_name);
       $stmt->bindValue($i++, $tags);
       $stmt->bindValue($i++, $share);
    }
    try {
        $stmt->execute(); //execute
     } catch (PDOException $e){
        //$conn->rollback();
           //echo $e->getMessage();
          sendMailer("mario@mimirwell.com","Job fállido guardar data  ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
        //  sendMailer("luismiguel@mimirwell.com","Job fállido en ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
        }
       //$conn->commit();
}

function deleteMessagesPostsPage($id_page){
      try {
            $conn = pdoConect();
            $stmt = $conn->prepare("DELETE FROM facebook_comments WHERE id = '".$id_page."'"); 
            $stmt->execute();
            $qtyBd = $stmt->Rowcount();
            return $qtyBd;
            }
            catch(PDOException $e) {
                 return null;
                //echo "Error: " . $e->getMessage();
            }
            $conn = null;
        }

function deleteConversationsPage($id_page){
      try {
            $conn = pdoConect();
            $stmt = $conn->prepare("DELETE FROM facebook_conversations WHERE page_id = '".$id_page."'"); 
            $stmt->execute();
            $qtyBd = $stmt->Rowcount();
            return $qtyBd;
            }
            catch(PDOException $e) {
                 return null;
                //echo "Error: " . $e->getMessage();
            }
            $conn = null;
        }
        
function deleteConversationsMessagesPage($id_page){
      try {
            $conn = pdoConect();
            $stmt = $conn->prepare("DELETE FROM facebook_conversations_messages WHERE page_id = '".$id_page."'"); 
            $stmt->execute();
            $qtyBd = $stmt->Rowcount();
            return $qtyBd;
            }
            catch(PDOException $e) {
                 return null;
                //echo "Error: " . $e->getMessage();
            }
            $conn = null;
        }        
        
    /*$response = $api->call('/me/accounts');
    $data = $response->getContent();
    print_r($data);*/
   // exit();
    $dia = date('Y-m-d');
    $since =date('Y-m-d',strtotime("-1 years")); 
    $until = $dia;
    $next = "";
    $after = "";
    $counterConversations = 0;
    $arrayDataConversations = array();
    $newCursorConversations = array();

     $arrayFieldsConversations = array('id','snippet','link','updated_time','message_count','unread_count','participants','senders','can_reply','is_subscribed');
     $params = array('since'=>$since,'until'=>$until,'fields' => $arrayFieldsConversations,'limit' => '100');
     try{
     $conversaciones = $page_api->call('/'.$id_page.'/conversations', RequestInterface::METHOD_GET,$params)->getContent();//obtener inbox
     $arrayDataConversations = $conversaciones['data'];
     $next = $conversaciones['paging']['next'];
     $after = $conversaciones['paging']['cursors']['after'];
     $params = array('since'=>$since,'until'=>$until,'after'=>$after,'fields' => $arrayFieldsConversations,'limit' => '100');
     while($next != "") {
        $counterConversations++;
        if ($counterConversations < 8){ //guardamos mil conversaciones 
           $newCursorConversations = $page_api->call('/'.$id_page.'/conversations', RequestInterface::METHOD_GET,$params)->getContent(); //obtener posts
            $arrayDataConversations = array_merge($arrayDataConversations,$newCursorConversations['data']);
            $after = $newCursorConversations['paging']['cursors']['after'];
            $next = $newCursorConversations['paging']['next'];
            $params = array('since'=>$since,'until'=>$until,'after'=>$after,'fields' => $arrayFieldsConversations,'limit' => '100');
        } else { 
           //echo count($arrayDataConversations)." conversaciones".PHP_EOL;
           break;
        }
        
    }
     }catch (FacebookAds\Http\Exception\ServerException $e) {
         //echo $e->getMessage();
             //$message = "Error en servidor facebook: ".$e->getMessage();
             sendMailer("mario@mimirwell.com","Hubo un error en guardado de conversaciones facebook",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
        }catch (FacebookAds\Exception\Exception $e) {
            //echo $e->getMessage();
              //$message = "Error tipo facebook exception: ".$e->getMessage();
              sendMailer("mario@mimirwell.com","Hubo un error en guardado de conversaciones facebook",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
        }
           if (count($arrayDataConversations) > 0){
            deleteConversationsPage($id_page);
            deleteConversationsMessagesPage($id_page);
            saveConversationsOfFacebookPage($arrayDataConversations,$id_page);
          }
     // print_r($arrayDataConversations);
      //exit();
     foreach($arrayDataConversations as $conversationsArray){
     $arrayFieldsConversationsMessages = array('id','message','created_time','from','to','shares{id,name,description,link}','attachments','tags');
     $paramsConversationsMessages = array('fields' => $arrayFieldsConversationsMessages,'limit' => '100');
     try{
     $Mensajesconversaciones = $page_api->call('/'.$conversationsArray['id'].'/messages', RequestInterface::METHOD_GET,$paramsConversationsMessages)->getContent();//obtener los mensajes por cada inbox
     saveMessagesConversationsOfFacebookPage($Mensajesconversaciones,$id_page,$conversationsArray['id']);
     }catch (FacebookAds\Http\Exception\ServerException $e) {
             echo "Error en servidor facebook: ".$e->getMessage();
             sendMailer("mario@mimirwell.com","Hubo un error en guardado de messages facebook",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
        }catch (FacebookAds\Exception\Exception $e) {
              echo  "Error tipo facebook exception: ".$e->getMessage();
              sendMailer("mario@mimirwell.com","Hubo un error en guardado de messages facebook",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
        }

     }
    
    
    //messages
    //obtenemos los posts en un recorrido
$next = "";
$after = "";
$timeZone = "+5 hours";//zona horaria GMT -5
$dia = date('Y-m-d',strtotime($timeZone));
$since = "2019-03-01";
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
    $next = $cursor['paging']['next'];
    $after = $cursor['paging']['cursors']['after'];
    $params = array('after'=>$after, 'since'=>$since, 'until'=>$until,'fields' => $arrayFields,'limit' => '100',);
    while($next != "") {
        $newCursor = $page_api->call('/'.$id_page.'/feed', RequestInterface::METHOD_GET,$params)->getContent();//obtener posts
        $arrayData = array_merge($arrayData,$newCursor['data']);
        $after = $newCursor['paging']['cursors']['after'];
        $next = $newCursor['paging']['next'];
        $params = array('after'=>$after, 'since'=>$since,'until'=>$until,'fields' => $arrayFields,'limit' => '100',);
    }
}catch (FacebookAds\Http\Exception\ServerException $e) {
             //$message = "Error en servidor facebook: ".$e->getMessage();
             sendMailer("mario@mimirwell.com","Hubo un error en guardado de messages facebook",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
        }catch (FacebookAds\Exception\Exception $e) {
              //$message = "Error tipo facebook exception: ".$e->getMessage();
              sendMailer("mario@mimirwell.com","Hubo un error en guardado de messages facebook",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
        }
        
$nextMessages = "";
$afterMessages = "";
$arrayMessagesData = array();
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
    $nextMessages = $dataMessages['paging']['next'];
    $afterMessages = $dataMessages['paging']['cursors']['after'];
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
             sendMailer("mario@mimirwell.com","Hubo un error en guardado de messages facebook",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
        }catch (FacebookAds\Exception\Exception $e) {
              //$message = "Error tipo facebook exception: ".$e->getMessage();
              sendMailer("mario@mimirwell.com","Hubo un error en guardado de messages facebook",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
        }
        if ((count($arrayDataMessages)) > 0){
            //echo PHP_EOL."EL ID DEL POST ES: ".$arrayPost['id'].PHP_EOL;
            deleteMessagesPostsPage($id_page);
            saveMessagesPostsOfFacebookPage($arrayDataMessages,$id_page,$arrayPost['id']);
        }
        //print_r($arrayDataMessages);
        //$arrayMessagesData = array_merge($arrayMessagesData, $arrayDataMessages); 
        }
        //print_r($arrayMessagesData);
   // exit(); 


