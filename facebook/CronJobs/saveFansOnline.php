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

$iniFile = '/home/ssgenius/configuration/database.ini';
$fileConfig = parse_ini_file($iniFile, true);
if (!$fileConfig) { throw new \Exception("Can't open or parse ini file.");  }
$database = $fileConfig['SsgApp'];
define('DB_SERVER_USERNAME', $database['user']);
define('DB_SERVER_PASSWORD', $database['pass']);
define('DNS',$database['dns']);
// $app_id = '292708578241182';
// $app_secret = '462aeec937ca833dd9798c944d5c79e2';
// $access_token = 'EAAbbxZAuuO9kBALT8dRMvtDQxH6rf7Y0Q34PbVP4NO3DTCZBKyMAJMTTgcmVUd5FPDxC0N8KwFWF3eXZBx7OnbUUgoFE2gsUBaZCBudMxb2ljcCZAsBpZB8wDoY0nmoWrLoZCZB3qWGA7prh4YIeEVgSTudVIN50WEyxYP6ZC8gSEbQZDZD';
// $page_token = "EAAbbxZAuuO9kBAGc81CCBVMe2FCkouv6oyyyfSpE8G0nKsTWEiWm75CXJ8IoX1pMlpId3mF8ZCwrDmpnNBK8CHflVZCKySD8LHcrpRD8K3FIzmtTP0TPVAh0HDhBb4FUhmpsJGlJSjteSPUIdqdY5CxRZCvdyNyxZCjsuzBKYLjv1sXqflRRlbhfE0uhggBGMl5iSzkWVSgZDZD"; //movil tours page token
// $id_page = '192597304105183'; //movil tours page id


require_once('../../model/FacebookModel.php');
$FacebookModel = new FacebookModel();
$_GET['t'] = 60;
$keyJob = htmlspecialchars($_GET['t']);

if (isset($keyJob)){
$job = $FacebookModel->getFacebookPostPageJob($keyJob);
if ($job == false){ $return["message"] = "Error DB"; exit();}
} else { $return["message"] = "no hay keyJob"; exit(); }
$app_id = '292708578241182';
$app_secret = '462aeec937ca833dd9798c944d5c79e2';
$access_token = $job->access_token;
$page_token = $job->page_token; 
$id_page = $job->id_facebook_page; 

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

function insertPageFacebook($id,$name,$picture,$category,$description,$linkf,$access_token){
         $link = pdoConect();
        try
        {
            $link->beginTransaction();
            $statement = $link->prepare("INSERT INTO page_facebook (id,name,picture,category,description,link,access_token) VALUES(:id,:name,:picture,:category,:description,:link,:access_token)");
            $statement->execute(array(
                "id" => $id,
                "name" => $name,
                "picture" => $picture,
                "category" => $category,
                "description" => $description,
                "link" => $linkf,
                "access_token" => $access_token
            ));
            $save = true;
            $link->commit();
        } catch (PDOException $e) {
            // echo $e->getMessage();
            sendMailer("ssgdeveloperalerts@mimirwell.com","Hubo un error en guardado en ",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
            $save = false;
            $link->rollback();
        }
    return $save;
}


     function getIdAdFacebook($postId)
    {
 	    try {
			 $dbh = pdoConect();
			 $sql = "SELECT ad_id FROM `ad_creative_facebook` WHERE `object_story_id` = '".$postId."'";
			 $sth = $dbh->prepare($sql);
			 $sth->execute();
			 $spend = $sth->fetchAll();
			 return $spend;
			 }catch (PDOException $e) {
			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}   
    }
    function getTotalSpendFacebookAd($ad_id=null)
    {
 	    try {
			 $dbh = pdoConect();
			 $sql = "SELECT SUM(spend) as inversion FROM `aiw_facebook_data_ads` WHERE `ad_id` = '".$ad_id."'";
			 $sth = $dbh->prepare($sql);
			 $sth->execute();
			 $spend = $sth->fetchObject();
			 return $spend->inversion; 
			 }catch (PDOException $e) {
			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}   
    }
    
function savePageFans($id_page,$page_fans,$page_fan_adds_unique,$page_fan_adds_by_paid_unique,$page_fan_adds_by_non_paid_unique,$page_fan_removes_unique,$page_engaged_users,$page_impressions,$page_impressions_unique,$page_impressions_paid,$page_impressions_paid_unique,$page_impressions_organic,$page_impressions_organic_unique,$page_impressions_viral,$page_impressions_viral_unique,$page_impressions_nonviral,$page_impressions_nonviral_unique,$page_content_activity,$mentions,$page_fans_online_per_day,$page_post_engagements,$page_posts_impressions,$page_posts_impressions_unique,$page_posts_impressions_paid,$page_posts_impressions_paid_unique,$page_posts_impressions_organic,$page_posts_impressions_organic_unique,$page_posts_impressions_viral,$page_posts_impressions_viral_unique,$page_posts_impressions_nonviral,$page_posts_impressions_nonviral_unique,$clics,$shares,$likes,$comments,$end_time){
        $conn = pdoConect();
        $end_time = date('Y-m-d',strtotime($end_time." -2 days"));
        try
        {
            $conn->beginTransaction();
            $statement = $conn->prepare("INSERT INTO page_fans_facebook (id_page,page_fans,page_fan_adds_unique,page_fan_adds_by_paid_unique,page_fan_adds_by_non_paid_unique,page_fan_removes_unique,page_engaged_users,page_impressions,page_impressions_unique,page_impressions_paid,page_impressions_paid_unique,page_impressions_organic,page_impressions_organic_unique,page_impressions_viral,page_impressions_viral_unique,page_impressions_nonviral,page_impressions_nonviral_unique,page_content_activity,mentions,page_fans_online_per_day,page_post_engagements,page_posts_impressions,page_posts_impressions_unique,page_posts_impressions_paid,page_posts_impressions_paid_unique,page_posts_impressions_organic,page_posts_impressions_organic_unique,page_posts_impressions_viral,page_posts_impressions_viral_unique,page_posts_impressions_nonviral,page_posts_impressions_nonviral_unique,clics,shares,likes,comments,end_time)
            VALUES(:id_page,:page_fans,:page_fan_adds_unique,:page_fan_adds_by_paid_unique,:page_fan_adds_by_non_paid_unique,:page_fan_removes_unique,:page_engaged_users,:page_impressions,:page_impressions_unique,:page_impressions_paid,:page_impressions_paid_unique,:page_impressions_organic,:page_impressions_organic_unique,:page_impressions_viral,:page_impressions_viral_unique,:page_impressions_nonviral,:page_impressions_nonviral_unique,:page_content_activity,:mentions,:page_fans_online_per_day,:page_post_engagements,:page_posts_impressions,:page_posts_impressions_unique,:page_posts_impressions_paid,:page_posts_impressions_paid_unique,:page_posts_impressions_organic,:page_posts_impressions_organic_unique,:page_posts_impressions_viral,:page_posts_impressions_viral_unique,:page_posts_impressions_nonviral,:page_posts_impressions_nonviral_unique,:clics,:shares,:likes,:comments,:end_time)");
           $statement->execute(array(
                "id_page" => $id_page,
                "page_fans" => $page_fans,
                "page_fan_adds_unique" => $page_fan_adds_unique,
                "page_fan_adds_by_paid_unique" => $page_fan_adds_by_paid_unique,
                "page_fan_adds_by_non_paid_unique" => $page_fan_adds_by_non_paid_unique,
                "page_fan_removes_unique" => $page_fan_removes_unique,
                "page_engaged_users" => $page_engaged_users,
                "page_impressions" => $page_impressions,
                "page_impressions_unique" => $page_impressions_unique,
                "page_impressions_paid" => $page_impressions_paid,
                "page_impressions_paid_unique" => $page_impressions_paid_unique,
                "page_impressions_organic" => $page_impressions_organic,
                "page_impressions_organic_unique" => $page_impressions_organic_unique,
                "page_impressions_viral" => $page_impressions_viral,
                "page_impressions_viral_unique" => $page_impressions_viral_unique,
                "page_impressions_nonviral" => $page_impressions_nonviral,
                "page_impressions_nonviral_unique" => $page_impressions_nonviral_unique,
                "page_content_activity" => $page_content_activity,
                "mentions" => $mentions,
                "page_fans_online_per_day" => $page_fans_online_per_day,
                "page_post_engagements" => $page_post_engagements,
                "page_posts_impressions" => $page_posts_impressions,
                "page_posts_impressions_unique" => $page_posts_impressions_unique,
                "page_posts_impressions_paid" => $page_posts_impressions_paid,
                "page_posts_impressions_paid_unique" => $page_posts_impressions_paid_unique,
                "page_posts_impressions_organic" => $page_posts_impressions_organic,
                "page_posts_impressions_organic_unique" => $page_posts_impressions_organic_unique,
                "page_posts_impressions_viral" => $page_posts_impressions_viral,
                "page_posts_impressions_viral_unique" => $page_posts_impressions_viral_unique,
                "page_posts_impressions_nonviral" => $page_posts_impressions_nonviral,
                "page_posts_impressions_nonviral_unique" => $page_posts_impressions_nonviral_unique,
                "clics" => $clics,
                "shares" => $shares,
                "likes" => $likes,
                "comments" => $comments,
                "end_time" => $end_time
            ));
                 $conn->commit();
                 $save = true;
        } catch (PDOException $e) {
             $conn->rollback();
            //error_log("Hubo un error en ".__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage(), 0);
            sendMailer("ssgdeveloperalerts@mimirwell.com","Hubo un error en guardado de page fans",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
              $save = false;
        }
    return $save;
}
//guardar fans por sexo y edad facebook
function insertInsightsGenderAgeFacebook($cursor,$id_page,$since){
    var_dump($cursor);
    // die;
    foreach ($cursor as $key => $value) {
         $link = pdoConect();
        try
        {
            $link->beginTransaction();
            $statement = $link->prepare("INSERT INTO ssg_page_fans_gender_age (id_page,end_time,sexo_edad,fans)
                VALUES(:id_page,:end_time,:sexo_edad,:fans)");
            $statement->execute(array(
                "id_page" => $id_page,
                "end_time" => $since,
                "sexo_edad" => $key,
                "fans" => $value
            ));
            $save = true;
            $link->commit();
        } catch (PDOException $e) {
            // echo $e->getMessage();
            error_log("Hubo un error en ".__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage(), 0);
            sendMailer("ssgdeveloperalerts@mimirwell.com","Hubo un error en guardado en ",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
            $save = false;
            $link->rollback();
        }
    }
    return $save;
}
//guardar fans online por hora
function insertInsightsFansOnlineForHourFacebook($cursor,$id_page,$since){
    foreach ($cursor as $key => $value) {
        $link = pdoConect();
        try
        {
            $link->beginTransaction();
            $statement = $link->prepare("INSERT INTO page_fans_online_facebook (id_page,end_time,hora,fans)
                VALUES(:id_page,:end_time,:hora,:fans)");
            $statement->execute(array(
                "id_page" => $id_page,
                "end_time" => $since,
                "hora" => $key,
                "fans" => $value
            ));
            $save = true;
            $link->commit();
        } catch (PDOException $e) {
            // echo $e->getMessage();
            error_log("Hubo un error en ".__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage(), 0);
            //sendMailer("ssgdeveloperalerts@mimirwell.com","Hubo un error en guardado en ",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
            $save = false;
            $link->rollback();
        }
    }
    return $save;
}

function savePostsOfFacebookPage($data,$page_id){
    $conn = pdoConect();
    $conn->beginTransaction();
    $query = "INSERT INTO post_page_facebook (`id`, `page_id`, `created_time`, `updated_time`, `message`, `picture`, `permalink_url`,`subattachments`, `admin_creator`,"
             . " `shares`, `promotion_status`, `reach_paid`, `reach_organic`, `reach`,`comments`, `reactions`, `post_video_views_unique`, `link_clicks`, `type`,`page_fans`,`indice_interaccion`,`indice_interalcance`,`inversion`,`indice_interaccion_inversion`,`indice_interalcance_inversion`) VALUES "; //Prequery
    $qPart = array_fill(0, count($data), "(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $query .=  implode(",",$qPart);
    $stmt = $conn->prepare($query); 
    $i = 1;
    foreach($data as $item) { //bind the values one by one
    //print_r($item);
    //echo $item['criteriaType'];
    //echo "<br>";
       $stmt->bindValue($i++, $item['id']);
       $stmt->bindValue($i++, $page_id);
       $stmt->bindValue($i++, $item['created_time']);
       $stmt->bindValue($i++, $item['updated_time']);
       $stmt->bindValue($i++, $item['message']);
       if (isset($item['attachments']['data']['0']['subattachments']['data']['0']['media']['image']['src'])){ $picture = $item['attachments']['data']['0']['subattachments']['data']['0']['media']['image']['src']; } else { $picture = $item['full_picture'];}
       $stmt->bindValue($i++, $picture);
       $stmt->bindValue($i++, $item['permalink_url']);
       if (isset($item['attachments']['data']['0']['subattachments']['data'])){ $subattachments = json_encode($item['attachments']['data']['0']['subattachments']['data'], true); } else { $subattachments = "";}
       $stmt->bindValue($i++, $subattachments);
       $stmt->bindValue($i++, $item['admin_creator']['name']);
       $stmt->bindValue($i++, $item['shares']['count']);
       $stmt->bindValue($i++, $item['promotion_status']);
       $stmt->bindValue($i++, $item['reach_paid']['data']['0']['values']['0']['value']);
       $stmt->bindValue($i++, $item['reach_organic']['data']['0']['values']['0']['value']);
       $stmt->bindValue($i++, $item['reach']['data']['0']['values']['0']['value']);
       $stmt->bindValue($i++, $item['comments']['summary']['total_count']);
       $stmt->bindValue($i++, $item['reactions']['summary']['total_count']);
       $stmt->bindValue($i++, $item['post_video_views_unique']['data']['0']['values']['0']['value']);
       if (isset($item['post_clicks_by_type_unique']['data']['0']['values']['0']['value']['link clicks'])){ $linkClicks = $item['post_clicks_by_type_unique']['data']['0']['values']['0']['value']['link clicks']; }
       else { $linkClicks = "0"; }
       $stmt->bindValue($i++, $linkClicks);
       $stmt->bindValue($i++, $item['type']);
       $stmt->bindValue($i++, $item['page_fans']);
       $stmt->bindValue($i++, $item['indice_interaccion']);
       $stmt->bindValue($i++, $item['indice_interalcance']);
       $stmt->bindValue($i++, $item['inversion']);
       $stmt->bindValue($i++, $item['indice_interaccion_inversion']);
       $stmt->bindValue($i++, $item['indice_interalcance_inversion']);
    }
    try {
        $stmt->execute(); //execute
     } catch (PDOException $e){
         $conn->rollback();
           //echo $e->getMessage();
          sendMailer("ssgdeveloperalerts@mimirwell.com","Job fállido guardar data  ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
        //  sendMailer("luismiguel@mimirwell.com","Job fállido en ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
        }
        $conn->commit();
}

function deletePage($id_page){
      try {
            $conn = pdoConect();
            $stmt = $conn->prepare("DELETE FROM page_facebook WHERE id = '".$id_page."'"); 
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
        
function deletePosts($id_page){
      try {
            $conn = pdoConect();
            $stmt = $conn->prepare("DELETE FROM post_page_facebook WHERE page_id = '".$id_page."'"); 
            $stmt->execute();
            $qtyBd = $stmt->Rowcount();
            return $qtyBd;
            }
            catch(PDOException $e) {
                 return null;
                echo "Error: " . $e->getMessage();
            }
            $conn = null;
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
   


//fans online for hour
$since = "2018-11-29";
$until = "2019-02-06";
$params = array(
    'since'=>$since,
    'until'=>$until, //rango de 90 dias maximo
    'metric' => array('page_fans_online'),
); 
$datafa = $page_api->call('/'.$id_page.'/insights', RequestInterface::METHOD_GET,$params)->getContent();//obtener las reacciones de un post
 print_r($datafa);
if ((count($datafa['data']) > 0)){
foreach($datafa['data'][0]['values'] as $faonline){
    $end_time = explode("T",$faonline['end_time']);
    $end_time = $end_time[0];
       insertInsightsFansOnlineForHourFacebook($faonline['value'],$id_page,$end_time); 

}

    $cursorfa = $datafa['data'][0]['values'][0]['value'];
   
    
//insertInsightsFansOnlineForHourFacebook($cursorfa,$id_page,$since);
}
//exit();



