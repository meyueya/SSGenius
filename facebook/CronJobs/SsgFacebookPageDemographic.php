<?php
//error_reporting(E_ALL & ~E_NOTICE & E_DEPRECATED);
error_reporting(E_ALL);
ini_set('display_errors', 1);
    // Configurations
define('SDK_DIR', '/home/ssgenius/public_html/app/facebook/facebook-php-business-sdk/'); // Path to the SDK directory
$loader = include SDK_DIR.'/vendor/autoload.php';
//use Facebook\Facebook;
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
if (isset($keyJob)){
$job = $FacebookModel->getFacebookPostPageJob($keyJob);
if ($job == false){ $return["message"] = "Error DB"; exit();}
} else { $return["message"] = "no hay keyJob"; exit(); }
$app_id = '292708578241182';
$app_secret = getenv('FACEBOOK_APP_SECRET');
$access_token = $job->access_token;
$page_token = $job->page_token; 
$id_page = $job->id_facebook_page; 

$page_api = $SsgFacebookHelper->getPageApi($access_token,$page_token);
        
function insertPageDemographic($app_id,$app_secret,$access_token,$page_token,$id_page,$since,$until) {
 try {
     $FacebookModel = new FacebookModel();
     $SsgFacebookHelper = new SsgFacebookHelper();
     $SsgHelper = new SsgHelper();
     $keyJob = htmlspecialchars($_GET['t']);
if (isset($keyJob)){
$job = $FacebookModel->getFacebookPostPageJob($keyJob);
if ($job == false){ $return["message"] = "Error DB"; exit();}
} else { $return["message"] = "no hay keyJob"; exit(); }
       $page_api = $SsgFacebookHelper->getPageApi($access_token,$page_token);
        $params = array(
            'since'=>$since,
            'until'=>$until, //rango de 90 días
            //'period' => "day",
            'include_headers' => "false",
            'metric' => array('page_fans_gender_age'),
        ); 
        $data = $page_api->call('/'.$id_page.'/insights', RequestInterface::METHOD_GET,$params)->getContent();
        $newData = array();
        if ((isset($data['data'])) && (count($data['data']) > 0)){
            $c = 0;
            foreach ($data['data']['0']['values'] as $keyFull => $pageInsights)
            {
                foreach ($pageInsights['value'] as $key => $page_fans){
                    $newData[$c]['id_page'] = $id_page;
                    $end_time = explode("T",$pageInsights['end_time']);
                    $newData[$c]['end_time'] = $end_time['0'];
                    $newData[$c]['sexo_edad'] = $key;
                    $newData[$c]['fans'] = $page_fans;
                    
                   /* if (!isset($dataResta[$key])){ 
                        $dataResta[$key] = $page_fans; 
                    } 
                    //echo "Resta: " . $pageInsights['value'][$key] . "-" . $dataResta[$key]."<br>";
                     $resta = $pageInsights['value'][$key] - $dataResta[$key];
                     $newData[$c]['resta'] = $resta;
                     $dataResta[$key] = $pageInsights['value'][$key];*/
                     
                    $c++;
                }
            }
            /*echo "<pre>";
            print_r($newData);
            echo "</pre>";
            exit();*/
            $FacebookModel = new FacebookModel();
            foreach($newData as $page){
              // $FacebookModel->savePageFansDemographic($page['id_page'],$page['end_time'],$page['sexo_edad'],$page['fans'],$page['resta']);
            }
        }
        $updated_time = date('Y-m-d h:i:s');
        $FacebookModel->UpdateStateFacebookPageDemographicInJob($keyJob,$updated_time,'ok');
        }catch (\Exception $e) {
            $FacebookModel->UpdateStateFacebookPageDemographicInJob($keyJob,$updated_time,'$e->getMessage()');
           // $return["message"] = $e->getMessage();
             echo  "Error en servidor facebook: ".$e->getMessage();
             //$SsgHelper->sendMailer("ssgdeveloperalerts@mimirwell.com","Hubo un error en guardado de page fans facebook",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
        }
        if (isset($newData)){
            $returnData = (count($newData) > 0) ? $newData : false;
         return $returnData;
        } else { return false;}
}

       /* $since = date('Y-m-d',strtotime("-3 month")); 
        $until = date('Y-m-d');
    insertPageDemographic($app_id,$app_secret,$access_token,$page_token,$id_page,$since,$until); */
   // exit();


//exit();
    $since = date('Y-m-d',strtotime("-1 month")); 
    $until = date('Y-m-d',strtotime("+1 days")); 
$params = array(
            'since'=>$since,
            'until'=>$until, //rango de 90 días
            //'period' => "day",
            'include_headers' => "false",
            'metric' => array('page_fans_gender_age'),
        ); 
        $data = $page_api->call('/'.$id_page.'/insights', RequestInterface::METHOD_GET,$params)->getContent();
 if (isset($data) && (count($data) > 0)){
    $FacebookModel->deleteRegistersPageDemographicFacebook($id_page);
    
    $since = date('Y-m-d',strtotime("-3 month")); 
    $until = date('Y-m-d',strtotime("+1 days")); 
    $data = array();
    $data = insertPageDemographic($app_id,$app_secret,$access_token,$page_token,$id_page,$since,$until);
    $since = date('Y-m-d',strtotime("-6 month")); 
    $until = date('Y-m-d',strtotime("-3 month + 1 days")); 
    $data2 = array();
    $data2 = insertPageDemographic($app_id,$app_secret,$access_token,$page_token,$id_page,$since,$until);
    $since = date('Y-m-d',strtotime("-9 month")); 
    $until = date('Y-m-d',strtotime("-6 month + 1 days")); 
    $data3 = array();
    $data3 = insertPageDemographic($app_id,$app_secret,$access_token,$page_token,$id_page,$since,$until);
    $since = date('Y-m-d',strtotime("-12 month")); 
    $until = date('Y-m-d',strtotime("-9 month + 1 days")); 
    $data4 = array();
    $data4 = insertPageDemographic($app_id,$app_secret,$access_token,$page_token,$id_page,$since,$until);
    $since = date('Y-m-d',strtotime("-15 month")); 
    $until = date('Y-m-d',strtotime("-12 month + 1 days")); 
    $data5 = array();
    $data5 = insertPageDemographic($app_id,$app_secret,$access_token,$page_token,$id_page,$since,$until);
    $since = date('Y-m-d',strtotime("-18 month")); 
    $until = date('Y-m-d',strtotime("-15 month + 1 days")); 
    $data6 = array();
    $data6 = insertPageDemographic($app_id,$app_secret,$access_token,$page_token,$id_page,$since,$until);
    $since = date('Y-m-d',strtotime("-21 month")); 
    $until = date('Y-m-d',strtotime("-18 month + 1 days")); 
    $data7 = array();
    $data7 = insertPageDemographic($app_id,$app_secret,$access_token,$page_token,$id_page,$since,$until);
    $since = date('Y-m-d',strtotime("-24 month")); 
    $until = date('Y-m-d',strtotime("-21 month + 1 days")); 
    $data8 = array();
    $data8 = insertPageDemographic($app_id,$app_secret,$access_token,$page_token,$id_page,$since,$until);
        $result = array_merge($data, $data2, $data3, $data4, $data5, $data6, $data7, $data8);

    $type_values = array();
foreach ($result as &$arr) {
    if (isset($type_values[$arr['sexo_edad']])) {
        $arr['resta'] = $arr['fans'] - $type_values[$arr['sexo_edad']];
    }
    else {
        $arr['resta'] = 0;
    }
    $type_values[$arr['sexo_edad']] = $arr['fans'];
}

         echo "</pre>";             
     if ($result){ 
        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
    }
     foreach($result as $page){
              $FacebookModel->savePageFansDemographic($page['id_page'],$page['end_time'],$page['sexo_edad'],$page['fans'],$page['resta']);
            }
   // exit();
    
} else {
     $updated_time = date('Y-m-d h:i:s');
    $FacebookModel->UpdateStateFacebookPageDemographicInJob($keyJob,$updated_time,'No hay datos');
}

