<?php

header('Content-Type: application/json');
//error_reporting(E_ALL & ~E_NOTICE & E_DEPRECATED);
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Configurations
define('SDK_DIR', '/home/ssgenius/public_html/app/facebook/facebook-php-business-sdk/'); // Path to the SDK directory
$loader = include SDK_DIR . '/vendor/autoload.php';

use Facebook\Facebook;
use FacebookAds\Api;
use FacebookAds\Session;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Http\Request;
use FacebookAds\Http\RequestInterface;
use FacebookAds\Object\Page;

require_once('../../model/Page_MessagesFacebook.php');
require_once('../../helper/SsgFacebookHelper.php');
require_once('../../helper/SsgHelper.php');

//aca comienza a pedir el id de la cuenta para halar los tokens, id page, page_api
$FacebookModel = new FacebookModelprueba();



$conec = Database::getInstance();

$stm = $conec->prepare("SELECT id_ssgfacebookpostpagejob, id_adaccount, messages_restar_day, messages_status FROM `ssg_facebook_page_primera_carga` WHERE messages_status='1'  ");
$stm->execute();
$job = $stm->fetchAll();
$lastdate = $job['0']['1']; //id_account
$lastdate1 = $job['0']['0']; //id_ssg
$lastdate2 = $job['0']['2']; //fecha
$lastdate3 = $job['0']['3']; //status

$diaconsulta = date(strtotime("$lastdate2")); // la primera vez que comience a jalar datos
$now = date('Y-m-d');
$today = date(strtotime("$now"));
$diaconsultabreak = date(strtotime("$lastdate2"));
$totaldia = (($today - $diaconsultabreak - 86400 ) / 86400);
// echo'Dias: ';
// var_dump($totaldia);
// die;



$id_ssgfacebookpostpagejob = $lastdate1;
$_GET['t'] = $id_ssgfacebookpostpagejob;
$keyJob = htmlspecialchars($_GET['t']);

if (isset($keyJob)) {
    $job = $FacebookModel->getFacebookPostPageJobp($keyJob);

    //echo "<pre>";
    //var_dump($job);
    //echo"</pre>";
    //die;

    /* En este lugar se definen los token 
     * automaticos para que el sistema
     * pueda reconocer que datos jalar
     * entre ellos access_token, page_token, id_facebook_page 
     */

    if ($job == false) {
        $return["message"] = "Error DB";
        exit();
    }
} else {
    $return["message"] = "no hay keyJob";
    exit();
}
$app_id = '292708578241182';
$app_secret = '462aeec937ca833dd9798c944d5c79e2';
$access_token = $job->access_token;
$page_token = $job->page_token;
$id_page = $job->id_facebook_page;

/* Funcion que enviar un correo 
 * si hay una anomalia
 */

function sendMailer($mail_destino, $asunto, $mensaje) {
    $datos_remitente = "Sistema Web";
    $headers = "MIME-Version: 1.0\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\n";
    $headers .= "From: $datos_remitente\n";
    $resultado = mail($mail_destino, $asunto, $mensaje, $headers);

    return $resultado;
}

/* En esta parte se llama la 
 * api para trabajar con los 
 * ID de la pagina 
 */

$api = Api::init($app_id, $app_secret, $access_token);
$api->setLogger(new CurlLogger());
// The instace is now retrivable
$api = Api::instance();
$page_session = new Session($app_id, $app_secret, $page_token);
$page_api = new Api($api->getHttpClient(), $page_session);
$page_api->setLogger($api->getLogger());

$FacebookModel = new FacebookModelprueba();
$keyJob = htmlspecialchars($_GET['t']);


if (isset($keyJob)) {
    $job = $FacebookModel->getFacebookPostPageJobP($keyJob);
    if ($job == false) {
        $return["message"] = "Error DB";
        exit();
    }
} else {
    $return["message"] = "no hay keyJob";
    exit();
}

$api = Api::init($app_id, $app_secret, $access_token);
//   echo "<pre>";
// var_dump($api);
//   echo"</pre>";
//   die;
$api->setLogger(new CurlLogger());
// The instace is now retrivable
$api = Api::instance();
$page_session = new Session($app_id, $app_secret, $page_token);
$page_api = new Api($api->getHttpClient(), $page_session);
$page_api->setLogger($api->getLogger());

// acá defino cuantos días quiero que corra mi loop, en otras palabras, cuantos días de data quiero jalar  
$totalloops = $totaldia;
// fin de la definición del total de días que quiero que corra mi loop, en otras palabras, cuantos días de data quiero jalar
// defino la variable antes del loop
$prueba = date('Y-m-d');
$dia = date('Y-m-d');

$dia = date("Y-m-d", strtotime($dia . '-' . $totaldia . 'day'));
//var_dump($dia);
//die;
for ($i = 0; $i != $totalloops; $i++) {
    //sleep(3);
//aca le sumo los dias a la variable que definimos afuera

    $dia = date("Y-m-d", strtotime($dia . '+1 day'));

    echo 'meyueya=';
    var_dump($dia);
//die;
    $n_dia = 1;
    if ($n_dia >= 1) {
        $since = $dia;
        $until = $dia;
        // var_dump($until);echo '------';
        // var_dump($since);
        //die;


        $limit = 5000;
        $next = "";
        $after = "";
        $counterConversations = 0;
        $arrayDataConversations = array();
        $newCursorConversations = array();

        $arrayFieldsConversations = array('id', 'snippet', 'link', 'updated_time', 'message_count', 'unread_count', 'participants', 'senders', 'can_reply', 'is_subscribed');
        $params = array('date_start', // La fecha de inicio de sus datos. Esto estÃ¡ controlado por el intervalo de fechas que ha seleccionado para su vista de informes.
            'date_stop', 'since' => $since, 'until' => $until, 'fields' => $arrayFieldsConversations, 'limit' => '100');
        try {
            $conversaciones = $page_api->call('/' . $id_page . '/conversations', RequestInterface::METHOD_GET, $params)->getContent(); //obtener inbox

            var_dump($conversaciones);
            //die;
            //exit();
            $arrayDataConversations = $conversaciones['data'];
            $next = isset($conversaciones['paging']['next']) ? $conversaciones['paging']['next'] : "";
            $after = isset($conversaciones['paging']['cursors']['after']) ? $conversaciones['paging']['cursors']['after'] : "";
            $params = array('since' => $since, 'until' => $until, 'after' => $after, 'fields' => $arrayFieldsConversations, 'limit' => '100');
            while ($next != "") {
                $counterConversations++;
                //if ($counterConversations < 8){ //guardamos mil conversaciones 
                $newCursorConversations = $page_api->call('/' . $id_page . '/conversations', RequestInterface::METHOD_GET, $params)->getContent(); //obtener posts
                $arrayDataConversations = array_merge($arrayDataConversations, $newCursorConversations['data']);
                $after = $newCursorConversations['paging']['cursors']['after'];
                $next = (isset($newCursorConversations['paging']['next'])) ? $newCursorConversations['paging']['next'] : '';
                $params = array('since' => $since, 'until' => $until, 'after' => $after, 'fields' => $arrayFieldsConversations, 'limit' => '100');
                //  } else { 
                //echo count($arrayDataConversations)." conversaciones".PHP_EOL;
                //  break;
                // }
            }
            // print_r($arrayDataConversations);
            //exit();
        } catch (FacebookAds\Http\Exception\ServerException $e) {

            $updated_time = date("Y-m-d h:i:s");
            $return["message"] = $e->getMessage();
            $SsgHelper->sendMailer("pedro@mimirwell.com", "Hubo un error en guardado de conversaciones facebook ", $id_page . "! en " . __FILE__ . " \n " . $e->getMessage());
            $FacebookModel->UpdateStateFacebookPostPageConversationsInJobp($keyJob, $updated_time, $return["message"]);
        } catch (\Exception $e) {
            //echo $e->getMessage();
            $updated_time = date("Y-m-d h:i:s");
            $return["message"] = $e->getMessage();
            $SsgHelper->sendMailer("pedro@mimirwell.com", "Hubo un error en guardado de conversaciones facebook ", $id_page . "! en " . __FILE__ . " \n " . $e->getMessage());
            $FacebookModel->UpdateStateFacebookPostPageConversationsInJobp($keyJob, $updated_time, $return["message"]);
            exit();
        }


        if (count($arrayDataConversations) == 0) {
            $return["message"] = "No hubo data";
        }
        foreach ($arrayDataConversations as $conversationsArray) {
            $arrayFieldsConversationsMessages = array('id', 'message', 'created_time', 'from', 'to', 'shares{id,name,description,link}', 'attachments', 'tags');
            $paramsConversationsMessages = array('fields' => $arrayFieldsConversationsMessages, 'limit' => '100');
            try {
                $Mensajesconversaciones = $page_api->call('/' . $conversationsArray['id'] . '/messages', RequestInterface::METHOD_GET, $paramsConversationsMessages)->getContent(); //obtener los mensajes por cada inbox
                //print_r($Mensajesconversaciones);
                // die;
                $FacebookModel->saveMessagesConversationsOfFacebookPage($Mensajesconversaciones, $id_page, $conversationsArray['id']);
                $FacebookModel->primeracarga($id_page);
            } catch (FacebookAds\Http\Exception\ServerException $e) {
                $return["message"] = $e->getMessage();
                echo $return["message"];
            } catch (FacebookAds\Exception\Exception $e) {
                $return["message"] = $e->getMessage();
                echo $return["message"];
            }
        }

        if (!isset($return["message"])) {
            $return["message"] = "ok";
        }
        $updated_time = date("Y-m-d h:i:s");
        $FacebookModel->UpdateStateFacebookPostPageConversationsInJobp($keyJob, $updated_time, $return["message"]);


        // if (count($Mensajesconversaciones > 0)){
        //    
    }
}
?>
        