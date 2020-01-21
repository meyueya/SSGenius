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
            sendMailer("mario@mimirwell.com","Hubo un error en guardado en ",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
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
            sendMailer("mario@mimirwell.com","Hubo un error en guardado de page fans",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
              $save = false;
        }
    return $save;
}
//guardar fans por sexo y edad facebook
function insertInsightsGenderAgeFacebook($cursor,$id_page,$since){
    foreach ($cursor as $key => $value) {
         $link = pdoConect();
        try
        {
            $link->beginTransaction();
            $statement = $link->prepare("INSERT INTO page_fans_gender_age (id_page,end_time,sexo_edad,fans)
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
            sendMailer("mario@mimirwell.com","Hubo un error en guardado en ",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
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
            sendMailer("mario@mimirwell.com","Hubo un error en guardado en ",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
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
          sendMailer("mario@mimirwell.com","Job fállido guardar data  ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
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
   
//page mentions(tagged)
$paramsConv = array(
   /* 'fields' => array('id','name','picture','category','description','link','access_token','can_post')*/
   /*'fields' => array('page_positive_feedback_by_type')*///shares en link
   'since'=>'2018-02-25',
   'until'=>'2018-02-26', //rango de 90 días
   'fields' => array('id','message','full_picture','from','permalink_url','shares','comments.filter(stream).limit(0).summary(total_count).as(comments)','reactions.limit(0).summary(total_count).as(reactions)','type','tagged_time')
  /* 'metric' => array('page_positive_feedback_by_type'),*/
); 

$arrayDataT = array();
$newCursorT = array();
try{
    $cursorT = $page_api->call('/'.$id_page.'/tagged', RequestInterface::METHOD_GET,$paramsConv)->getContent();//obtener posts
    $arrayDataT = $cursorT['data'];
    $next = $cursorT['paging']['next'];
    $after = $cursorT['paging']['cursors']['after'];
    $params = array('after'=>$after, 'since'=>$since, 'until'=>$until,'fields' => $arrayFields,'limit' => '5000',);
    while($next != "") {
        $newCursorT = $page_api->call('/'.$id_page.'/tagged', RequestInterface::METHOD_GET,$params)->getContent();//obtener posts
        $arrayDataT = array_merge($arrayDataT,$newCursorT['data']);
        $after = $newCursorT['paging']['cursors']['after'];
        $next = $newCursorT['paging']['next'];
        $params = array('after'=>$after, 'since'=>$since,'until'=>$until,'fields' => $arrayFields,'limit' => '5000',);
    }
}catch (FacebookAds\Http\Exception\ServerException $e) {
             //$message = "Error en servidor facebook: ".$e->getMessage();
             sendMailer("mario@mimirwell.com","Hubo un error en tagged page facebook",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
        }catch (FacebookAds\Exception\Exception $e) {
              //$message = "Error tipo facebook exception: ".$e->getMessage();
              sendMailer("mario@mimirwell.com","Hubo un error en tagged page facebook",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
        }
//print_r($arrayDataT);
//exit();

//page 
$paramsPage = array(
    'fields' => array('id','name','picture','category','description','link','access_token','can_post')
); 
$datapage = $page_api->call('/'.$id_page.'/', RequestInterface::METHOD_GET,$paramsPage)->getContent();//
if (count($datapage) > 0){
    deletePage($id_page);
    insertPageFacebook($datapage['id'],$datapage['name'],$datapage['picture']['data']['url'],$datapage['category'],$datapage['description'],$datapage['link'],$datapage['access_token']);
}

//page insights
function insertPageFans($app_id,$app_secret,$access_token,$page_token,$id_page,$since) {
 try {
        $api = Api::init($app_id, $app_secret, $access_token);
        $api->setLogger(new CurlLogger());
        // The instace is now retrivable
        $api = Api::instance();
        $page_session = new Session($app_id, $app_secret, $page_token);
        $page_api = new Api($api->getHttpClient(), $page_session);
        $page_api->setLogger($api->getLogger());
        //$since = '2018-10-28';
        $params = array(
            'since'=>$since,
            'until'=>$since, //rango de 90 días
            'metric' => array('page_fans','page_fan_adds_unique','page_fan_adds_by_paid_non_paid_unique','page_fan_removes_unique','page_engaged_users','page_impressions','page_impressions_unique','page_impressions_paid','page_impressions_paid_unique','page_impressions_organic','page_impressions_organic_unique','page_impressions_viral','page_impressions_viral_unique','page_impressions_nonviral','page_impressions_nonviral_unique','page_content_activity','page_content_activity_by_action_type','page_post_engagements','page_posts_impressions','page_posts_impressions_unique','page_posts_impressions_paid','page_posts_impressions_paid_unique','page_posts_impressions_organic','page_posts_impressions_organic_unique','page_posts_impressions_viral','page_posts_impressions_viral_unique','page_posts_impressions_nonviral','page_posts_impressions_nonviral_unique','page_consumptions','page_positive_feedback_by_type'),
        ); 
        $data = $page_api->call('/'.$id_page.'/insights', RequestInterface::METHOD_GET,$params)->getContent();
        //print_r($data);
        //exit();
        $sincefod = date('Y-m-d',strtotime("-1 days"));
        $paramsfod = array(
            'since'=>$sincefod,
            'until'=>$sincefod, //rango de 90 días
            'metric' => array('page_fans_online_per_day'),// revisar porque da de 2 días antes
        ); 
        $datafod = $page_api->call('/'.$id_page.'/insights', RequestInterface::METHOD_GET,$paramsfod)->getContent();
        }catch (FacebookAds\Http\Exception\ServerException $e) {
             //$message = "Error en servidor facebook: ".$e->getMessage();
             sendMailer("mario@mimirwell.com","Hubo un error en guardado de page fans facebook",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
        }catch (FacebookAds\Exception\Exception $e) {
              //$message = "Error tipo facebook exception: ".$e->getMessage();
              sendMailer("mario@mimirwell.com","Hubo un error en guardado de page fans facebook",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
        }
        if (isset($data['data']['0']['values']['0']['value'])){
            $page_fans = $data['data']['0']['values']['0']['value'];
        } else {$page_fans = 0;}        
        if (isset($data['data']['1']['values']['0']['value'])){
            $page_fan_adds_unique = $data['data']['1']['values']['0']['value'];
        } else {$page_fan_adds_unique = 0;}
        if (isset($data['data']['4']['values']['0']['value']['unpaid'])){
            $page_fan_adds_by_non_paid_unique = $data['data']['4']['values']['0']['value']['unpaid'];
        } else {$page_fan_adds_by_non_paid_unique = 0;}
        if (isset($data['data']['4']['values']['0']['value']['paid'])){
            $page_fan_adds_by_paid_unique = $data['data']['4']['values']['0']['value']['paid'];
        } else {$page_fan_adds_by_paid_unique = 0;}
        if (isset($data['data']['5']['values']['0']['value'])){
            $page_fan_removes_unique = $data['data']['5']['values']['0']['value'];
        } else {$page_fan_removes_unique = 0;}
        if (isset($data['data']['8']['values']['0']['value'])){
            $page_engaged_users = $data['data']['8']['values']['0']['value'];
        } else {$page_engaged_users = 0;}
        if (isset($data['data']['11']['values']['0']['value'])){
            $page_impressions = $data['data']['11']['values']['0']['value'];
        } else {$page_impressions = 0;}
        if (isset($data['data']['14']['values']['0']['value'])){
            $page_impressions_unique = $data['data']['14']['values']['0']['value'];
        } else {$page_impressions_unique = 0;}
        if (isset($data['data']['17']['values']['0']['value'])){
            $page_impressions_paid = $data['data']['17']['values']['0']['value'];
        } else {$page_impressions_paid = 0;}
        if (isset($data['data']['20']['values']['0']['value'])){
            $page_impressions_paid_unique = $data['data']['20']['values']['0']['value'];
        } else {$page_impressions_paid_unique = 0;}
        if (isset($data['data']['23']['values']['0']['value'])){
            $page_impressions_organic = $data['data']['23']['values']['0']['value'];
        } else {$page_impressions_organic = 0;}
        if (isset($data['data']['26']['values']['0']['value'])){
            $page_impressions_organic_unique = $data['data']['26']['values']['0']['value'];
        } else {$page_impressions_organic_unique = 0;}
        if (isset($data['data']['29']['values']['0']['value'])){
            $page_impressions_viral = $data['data']['29']['values']['0']['value'];
        } else {$page_impressions_viral = 0;}
        if (isset($data['data']['32']['values']['0']['value'])){
            $page_impressions_viral_unique = $data['data']['32']['values']['0']['value'];
        } else {$page_impressions_viral_unique = 0;}
         if (isset($data['data']['35']['values']['0']['value'])){
            $page_impressions_nonviral = $data['data']['35']['values']['0']['value'];
        } else {$page_impressions_nonviral = 0;}
        if (isset($data['data']['38']['values']['0']['value'])){
            $page_impressions_nonviral_unique = $data['data']['38']['values']['0']['value'];
        } else {$page_impressions_nonviral_unique = 0;}
        if (isset($data['data']['41']['values']['0']['value'])){
            $page_content_activity = $data['data']['41']['values']['0']['value'];
        } else {$page_content_activity = 0;}
        if (isset($data['data']['44']['values']['0']['value']['mention'])){
            $mentions = $data['data']['44']['values']['0']['value']['mention'];
        } else {$mentions = 0;}
        if (isset($data['data']['47']['values']['0']['value'])){
            $page_post_engagements = $data['data']['47']['values']['0']['value'];
        } else {$page_post_engagements = 0;}
        if (isset($data['data']['50']['values']['0']['value'])){
            $page_posts_impressions = $data['data']['50']['values']['0']['value'];
        } else {$page_posts_impressions = 0;}
        if (isset($data['data']['53']['values']['0']['value'])){
            $page_posts_impressions_unique = $data['data']['53']['values']['0']['value'];
        } else {$page_posts_impressions_unique = 0;}
        if (isset($data['data']['56']['values']['0']['value'])){
            $page_posts_impressions_paid = $data['data']['56']['values']['0']['value'];
        } else {$page_posts_impressions_paid = 0;}
        if (isset($data['data']['59']['values']['0']['value'])){
            $page_posts_impressions_paid_unique = $data['data']['59']['values']['0']['value'];
        } else {$page_posts_impressions_paid_unique = 0;}
        if (isset($data['data']['62']['values']['0']['value'])){
            $page_posts_impressions_organic = $data['data']['62']['values']['0']['value'];
        } else {$page_posts_impressions_organic = 0;}
        if (isset($data['data']['65']['values']['0']['value'])){
            $page_posts_impressions_organic_unique = $data['data']['65']['values']['0']['value'];
        } else {$page_posts_impressions_organic_unique = 0;}
        if (isset($data['data']['68']['values']['0']['value'])){
            $page_posts_impressions_viral = $data['data']['68']['values']['0']['value'];
        } else {$page_posts_impressions_viral = 0;}
        if (isset($data['data']['71']['values']['0']['value'])){
            $page_posts_impressions_viral_unique = $data['data']['71']['values']['0']['value'];
        } else {$page_posts_impressions_viral_unique = 0;}
        if (isset($data['data']['74']['values']['0']['value'])){
            $page_posts_impressions_nonviral = $data['data']['74']['values']['0']['value'];
        } else {$page_posts_impressions_nonviral = 0;}
        if (isset($data['data']['77']['values']['0']['value'])){
            $page_posts_impressions_nonviral_unique = $data['data']['77']['values']['0']['value'];
        } else {$page_posts_impressions_nonviral_unique = 0;}
        if (isset($data['data']['80']['values']['0']['value'])){
            $clics = $data['data']['80']['values']['0']['value'];
        } else {$clics = 0;}
        if (isset($data['data']['83']['values']['0']['value']['link'])){
            $shares = $data['data']['83']['values']['0']['value']['link'];
        } else {$shares = 0;}
        if (isset($data['data']['83']['values']['0']['value']['like'])){
            $likes = $data['data']['83']['values']['0']['value']['like'];
        } else {$likes = 0;}
        if (isset($data['data']['83']['values']['0']['value']['comment'])){
            $comments = $data['data']['83']['values']['0']['value']['comment'];
        } else {$comments = 0;}
        
        
        if (isset($datafod['data']['0']['values']['0']['value'])){
            $page_fans_online_per_day = $datafod['data']['0']['values']['0']['value'];
        } else {$page_fans_online_per_day = 0;}
savePageFans($id_page,$page_fans,$page_fan_adds_unique,$page_fan_adds_by_paid_unique,$page_fan_adds_by_non_paid_unique,$page_fan_removes_unique,$page_engaged_users,$page_impressions,$page_impressions_unique,$page_impressions_paid,$page_impressions_paid_unique,$page_impressions_organic,$page_impressions_organic_unique,$page_impressions_viral,$page_impressions_viral_unique,$page_impressions_nonviral,$page_impressions_nonviral_unique,$page_content_activity,$mentions,$page_fans_online_per_day,$page_post_engagements,$page_posts_impressions,$page_posts_impressions_unique,$page_posts_impressions_paid,$page_posts_impressions_paid_unique,$page_posts_impressions_organic,$page_posts_impressions_organic_unique,$page_posts_impressions_viral,$page_posts_impressions_viral_unique,$page_posts_impressions_nonviral,$page_posts_impressions_nonviral_unique,$clics,$shares,$likes,$comments,$since);
//return $since.' - '.$page_fans." fans";
}

$since = date('Y-m-d',strtotime("+1 days")); //facebook le pasas mañana para que te de anteayer
insertPageFans($app_id,$app_secret,$access_token,$page_token,$id_page,$since);

$since = date('Y-m-d',strtotime("-1 days"));//regularizamos el since
//gender and age
$params = array(
    'since'=>$since,
    'until'=>$since, //rango de 90 dias maximo
    'metric' => array('page_fans_gender_age'),
); 
$dataga = $page_api->call('/'.$id_page.'/insights', RequestInterface::METHOD_GET,$params)->getContent();//obtener las reacciones de un post
if ((count($dataga['data']) > 0)){
    $cursorga = $dataga['data'][0]['values'][0]['value'];
 insertInsightsGenderAgeFacebook($cursorga,$id_page,$since);
}
//fans online for hour
$params = array(
    'since'=>$since,
    'until'=>$since, //rango de 90 dias maximo
    'metric' => array('page_fans_online'),
); 
$datafa = $page_api->call('/'.$id_page.'/insights', RequestInterface::METHOD_GET,$params)->getContent();//obtener las reacciones de un post
if ((count($datafa['data']) > 0)){
    $cursorfa = $datafa['data'][0]['values'][0]['value'];
insertInsightsFansOnlineForHourFacebook($cursorfa,$id_page,$since);
}
//exit();
//post page
$next = "";
$after = "";
//$dia = date('Y-m-d',strtotime("-1 days"));
$timeZone = "+5 hours";//zona horaria GTM -5
$dia = date('Y-m-d',strtotime($timeZone));
$since = "2016-11-05";
$until = $dia;
$arrayFields = array('id','created_time','updated_time','message','image_hash','full_picture','attachments','permalink_url','admin_creator','shares','promotion_status','insights.metric(post_impressions_paid_unique).period(lifetime).as(reach_paid)','insights.metric(post_impressions_organic_unique).period(lifetime).as(reach_organic)','insights.metric(post_impressions_unique).period(lifetime).as(reach)','comments.filter(stream).limit(0).summary(total_count).as(comments)','reactions.limit(0).summary(total_count).as(reactions)','insights.metric(post_video_views_unique).period(lifetime).as(post_video_views_unique)','insights.metric(post_clicks_by_type_unique).period(lifetime).as(post_clicks_by_type_unique)','type');
$params = array('since'=>$since,'until'=>$until,'fields' => $arrayFields,'limit' => '100',);
$arrayData = array();
$newCursor = array();
try{
    $cursor = $page_api->call('/'.$id_page.'/posts', RequestInterface::METHOD_GET,$params)->getContent();//obtener posts
    print_r($cursor);
    $arrayData = $cursor['data'];
    $next = $cursor['paging']['next'];
    $after = $cursor['paging']['cursors']['after'];
    $params = array('after'=>$after, 'since'=>$since, 'until'=>$until,'fields' => $arrayFields,'limit' => '100',);
    while($next != "") {
        $newCursor = $page_api->call('/'.$id_page.'/posts', RequestInterface::METHOD_GET,$params)->getContent();//obtener posts
        $arrayData = array_merge($arrayData,$newCursor['data']);
        $after = $newCursor['paging']['cursors']['after'];
        $next = $newCursor['paging']['next'];
        $params = array('after'=>$after, 'since'=>$since,'until'=>$until,'fields' => $arrayFields,'limit' => '100');
    }
}catch (FacebookAds\Http\Exception\ServerException $e) {
             //$message = "Error en servidor facebook: ".$e->getMessage();
             sendMailer("mario@mimirwell.com","Hubo un error en guardado de posts facebook",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
        }catch (FacebookAds\Exception\Exception $e) {
              //$message = "Error tipo facebook exception: ".$e->getMessage();
              sendMailer("mario@mimirwell.com","Hubo un error en guardado de posts facebook",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
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
        ); 
        $dataFans = $page_api->call('/'.$id_page.'/insights', RequestInterface::METHOD_GET,$paramsFans)->getContent();//obtener las reacciones de un post
        if (isset($dataFans['data']['0']['values']['0']['value'])){
           $fansPage = $dataFans['data']['0']['values']['0']['value'];
        } else {$fansPage = 0;}
        $arrayData[$key]['page_fans'] = $fansPage;
        $reacciones = $arrayData[$key]['reactions']['summary']['total_count'];
        $shares = $arrayData[$key]['shares']['count'];
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
            //si es que existe una o varias cuentas publicitarias asociadas que anuncia la pagina obtenemos la inversion
        $ad_ids = getIdAdFacebook($arrayData[$key]['id']);
        $inversion = 0;
         if (count($ad_ids) > 0){
        foreach ($ad_ids as $ad_id)
            {
                $inversion += getTotalSpendFacebookAd($ad_id['ad_id']);
            }
        }
        if ($inversion > 0){
            $inversion = round($inversion/0.55, 2);
            $indiceInteraccionInversion = number_format((float)(($indiceInteraccion / $inversion) * 100), 2, '.', '');
            $indice_interalcance_inversion = number_format((float)(($indiceInteralcance / $inversion)* 100), 2, '.', '');
        }
        else 
        { 
            $inversion = 0; 
            $indiceInteraccionInversion = 0;
            $indice_interalcance_inversion = 0;
        }
        $arrayData[$key]['inversion'] = $inversion;
        $arrayData[$key]['indice_interaccion_inversion'] = $indiceInteraccionInversion;
        $arrayData[$key]['indice_interalcance_inversion'] = $indice_interalcance_inversion;
    }
    //print_r($arrayData); 
   // echo "</pre>";
deletePosts($id_page);
savePostsOfFacebookPage($arrayData,$id_page);
}

//print_r($arrayData);

