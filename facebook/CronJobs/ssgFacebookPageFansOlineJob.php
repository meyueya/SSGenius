<?php

//session_start();
//header('Content-Type: application/json');
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
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

require_once('/home/ssgenius/public_html/app/model/FacebookModel.php');
require_once('/home/ssgenius/public_html/app/helper/SsgFacebookHelper.php');
require_once('/home/ssgenius/public_html/app/helper/SsgHelper.php');
$FacebookModel = new FacebookModel();
$SsgFacebookHelper = new SsgFacebookHelper();
$SsgHelper = new SsgHelper();
$keyJob = htmlspecialchars($_GET['t']);
if (isset($keyJob)) {
    $job = $FacebookModel->getFacebookPostPageJob($keyJob);
    if ($job == false) {
        $return["message"] = "Error DB";
        exit();
    }
//print_r($job);
} else {
    $return["message"] = "no hay keyJob";
    exit();
}
$access_token = $job->access_token;
$page_token = $job->page_token;
$id_page = $job->id_facebook_page;
//$checkUserToken = $SsgFacebookHelper->TokenValid($access_token,"USER");
//$checkPageToken = $SsgFacebookHelper->TokenValid($page_token,"PAGE");
//if ($checkUserToken !== true){
//aqui desactivamos el job con esta token
//echo $checkUserToken;
//exit();
//}
//if ($checkPageToken !== true){
//   echo $checkPageToken;
//aqui desactivamos el job con esta token
//exit();
//}
//exit();

$page_api = $SsgFacebookHelper->getPageApi($access_token, $page_token);

function getFansOnline($since, $until) {
    try {
        $params = array(
            'since' => date('Y-m-d', strtotime("-3 month")),
            'until' => date('Y-m-d'), //rango de 90 dias maximo
            'metric' => array('page_fans_online'),
        );
        $datafa = $page_api->call('/' . $id_page . '/insights', RequestInterface::METHOD_GET, $params)->getContent();
        if ((count($datafa['data']) > 0)) {
            foreach ($datafa['data'][0]['values'] as $faonline) {
                $end_time = explode("T", $faonline['end_time']);
                $end_time = $end_time[0];
                $FacebookModel->insertInsightsFansOnlineForHourFacebook($faonline['value'], $id_page, $end_time);
            }
        } else {
            $FacebookModel->UpdateStateFacebookPostPageInJob($keyJob, $updated_time, $return["message"]);
        }
        return true;
    } catch (\Exception $e) {
        $error["message"] = $e->getMessage();
        $SsgHelper->sendMailer("ssgdeveloperalerts@mimirwell.com", "Error de Autorizacion - " . $id_page, __FUNCTION__ . "! en " . __FILE__ . " \n " . $e->getMessage());
        $FacebookModel->UpdateStateFacebookPostPageInJob($keyJob, $updated_time, $error["message"]);
        return false;
    }
}

//de 3 en 3 porque facebook no da mas de ese rango de fecha
getFansOnline(date('Y-m-d', strtotime("-3 month")), date('Y-m-d'));
getFansOnline(date('Y-m-d', strtotime("-6 month")), date('Y-m-d', strtotime("-3 month + 1 days")));
getFansOnline(date('Y-m-d', strtotime("-9 month")), date('Y-m-d', strtotime("-6 month + 1 days")));
getFansOnline(date('Y-m-d', strtotime("-12 month")), date('Y-m-d', strtotime("-9 month + 1 days")));
getFansOnline(date('Y-m-d', strtotime("-15 month")), date('Y-m-d', strtotime("-12 month + 1 days")));
getFansOnline(date('Y-m-d', strtotime("-18 month")), date('Y-m-d', strtotime("-15 month + 1 days")));
getFansOnline(date('Y-m-d', strtotime("-21 month")), date('Y-m-d', strtotime("-18 month + 1 days")));
getFansOnline(date('Y-m-d', strtotime("-24 month")), date('Y-m-d', strtotime("-21 month + 1 days")));
