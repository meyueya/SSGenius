<?php
//header('Content-Type: text/html; charset=utf-8');
header('Content-Type: application/json');
//error_reporting(E_ALL & ~E_NOTICE & E_DEPRECATED);
error_reporting(E_ALL);
ini_set('display_errors', 1);
    // Configurations
$access_token = 'EAAbbxZAuuO9kBALT8dRMvtDQxH6rf7Y0Q34PbVP4NO3DTCZBKyMAJMTTgcmVUd5FPDxC0N8KwFWF3eXZBx7OnbUUgoFE2gsUBaZCBudMxb2ljcCZAsBpZB8wDoY0nmoWrLoZCZB3qWGA7prh4YIeEVgSTudVIN50WEyxYP6ZC8gSEbQZDZD';
$app_id = '1930491627191257';
$app_secret = '934f83f24436ea82749ca6b5fafc6281';
$ad_account_id = 'act_1063559070425222';
define('SDK_DIR', __DIR__ . '/'); // Path to the SDK directory
$loader = include SDK_DIR.'/vendor/autoload.php';
if (is_null($access_token) || is_null($app_id) || is_null($app_secret)) {
  throw new \Exception('You must set your access token, app id and app secret before executing');
}   
if (is_null($ad_account_id)) {
  throw new \Exception('You must set your account id before executing');
}
use Facebook\Facebook;
use FacebookAds\Api;
use FacebookAds\Session;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Http\Request;
use FacebookAds\Http\RequestInterface;
use FacebookAds\Object\Page;
$api = Api::init($app_id, $app_secret, $access_token);
$api->setLogger(new CurlLogger());
$api = Api::instance();
$response = $api->call('/me/accounts');
$data = $response->getContent();
$page_token = '';
/*foreach ($data['data'] as $page) {
    if ($page['id'] == $page_id) {
        $page_token = $page['access_token'];
        break;
    }
}
print_r($data);
exit();*/
//$page_token ="EAAbbxZAuuO9kBAG3EpCZAL0uSmEZC7gMNj0MKhpfbHoRZAy2pg6ZCbr2Jt3toeEnbmqkkVh5X4ePzq3un6FvQ94GEKuu4cif1jR71ZAeV1m0PTsBE3HIQCkWA46VZAZBYSaKYMrHwjYS4DIB0FkHs73qNyfc2eIErLvAZCtSARZBvVTwZDZD"; //pec
//$page_token ="EAAbbxZAuuO9kBAD4jZC7Aeg8JaiXnOta2AoSodhXmWwlrZC8lQK8mrs6AA0aETUN3RkyGU29pNLzh3DCwd7zlTLGRFg4FIxwqfFg7W8X3QUsiOqiHZCbPG2lZBEHHI7rg08DPpx7Vv0PprAWEYcnzLLoJTHMfMLhimzeFgUaOvwZDZD"; //ulcb
//$page_token ="EAAbbxZAuuO9kBAPgsjTnGZBi9bZCO8RV5fpz05eEBz60yFSoSs6UIvWZCW7fo6LwvQcD1qQoELb9huGFL1hbLvF8ogEo0kciK9tsyhV6OX2oZC7eKCQbbaU6ekhsUv6o5yEPIAYQrieqsHK951zGGgBPQg1dW0YWoQRhCPyckggZDZD"; //moviltours
$page_token ="EAAbbxZAuuO9kBACbppU0DdJuVWHZAsbWDzZBCAan5yzuuZAGm20mvKN5HBeNke5EfJFEN7DMb7K1e0LFnAx748JLv8VFfN8iBBKFTSthqNQhuWMaRiW7KETtsHgX7fB2BZC9dj2CgQgSHCygQdobQuHoDI4yVu4qHce5OtjYlLQZDZD"; //moviltours
//$page_token ="EAAbbxZAuuO9kBAGZC5EReSanQNaPnCubkeaYMukFvbzBmF4cHEZB4lmZCcM1V8FWp6rcDKnTJai2tHamQRQLQJEq0Mv5Vf28vN1cgDK6aVA0tk3F3yc4thubdgJYriCzaXu3k5pfkcZAM05CRWODfWjfvvzuWYsWEmZCvrQzd8BgZDZD"; //ilcb
//$page_token = "EAAbbxZAuuO9kBAGLDZAe2VBzYsNTQMzxjaJ3QD4rFGA9PNiQeZCMJ3CzVLEfrVxkXROwg10yAq8CphFnqXVDft16zY4myYefNCfd77R2wZB6zeJsdBZAQMQcDzVpWrhoHcH2XPmjRZAZAI084oMwKD4Tjy3rZCudHJFbmfsCCZBiZAZBQZDZD"; //ilcb beto
$page_session = new Session($app_id, $app_secret, $page_token);
$page_api = new Api($api->getHttpClient(), $page_session);
$page_api->setLogger($api->getLogger());

$next = "";
$after = "";
$dia = date('Y-m-d',strtotime("-1 days"));
//$dia = date('Y-m-d');
$since = "2016-09-19";
$until = $dia;
$pageId = "192597304105183";
//$arrayFields = array('id','created_time','updated_time','picture','full_picture','message','link','name','permalink_url','call_to_action','admin_creator','caption','description','from','object_id','parent_id','is_hidden','is_published','child_attachments','shares','reactions.type(LIKE).limit(0).summary(total_count).as(like)','reactions.type(LOVE).limit(0).summary(total_count).as(love)','reactions.type(HAHA).limit(0).summary(total_count).as(haha)','reactions.type(WOW).limit(0).summary(total_count).as(wow)','reactions.type(SAD).limit(0).summary(total_count).as(sad)','reactions.type(ANGRY).limit(0).summary(total_count).as(angry)','comments.filter(stream).limit(0).summary(total_count).as(comentarios)','status_type','type','place','privacy','promotable_id','promotion_status','source','targeting','with_tags');
$arrayFields = array('id','created_time','updated_time','picture','permalink_url','admin_creator','shares','promotion_status','insights.metric(post_impressions_paid_unique).period(lifetime).as(reach_paid)','insights.metric(post_impressions_organic_unique).period(lifetime).as(reach_organic)','insights.metric(post_impressions_unique).period(lifetime).as(reach)','comments.filter(stream).limit(0).summary(total_count).as(comments)','reactions.limit(0).summary(total_count).as(reactions)','insights.metric(post_video_views_unique).period(lifetime).as(post_video_views_unique)','insights.metric(post_clicks_by_type_unique).period(lifetime).as(post_clicks_by_type_unique)','type');
$params = array('since'=>$since,'until'=>$until,'fields' => $arrayFields,'limit' => '100',);
$arrayData = array();
$newCursor = array();
$cursor = $page_api->call('/'.$pageId.'/feed', RequestInterface::METHOD_GET,$params)->getContent();//obtener posts
//print_r($cursor);
//exit();
$arrayData = $cursor['data'];
$next = $cursor['paging']['next'];
$after = $cursor['paging']['cursors']['after'];
$params = array('after'=>$after, 'since'=>$since, 'until'=>$until,'fields' => $arrayFields,'limit' => '100',);
while($next != "") {
    $newCursor = $page_api->call('/'.$pageId.'/feed', RequestInterface::METHOD_GET,$params)->getContent();//obtener posts
    $arrayData = array_merge($arrayData,$newCursor['data']);
    $after = $newCursor['paging']['cursors']['after'];
    $next = $newCursor['paging']['next'];
    $params = array('after'=>$after, 'since'=>$since,'until'=>$until,'fields' => $arrayFields,'limit' => '100',);
} 
print_r($arrayData);
//exit();
//save in database
  define('DB_SERVER', 'localhost');
  define('DB_SERVER_USERNAME', 'aiwroi_aiwlcb');
  define('DB_SERVER_PASSWORD', ']a_nc#S}LthH');
  define('DB_SERVER_DATABASE', 'aiwroi_moviltours');
  define('DNS','mysql:dbname='.DB_SERVER_DATABASE.';host='.DB_SERVER);
function pdoConect(){
 $conn = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_SERVER_DATABASE.";charset=utf8", DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
}
$table = "post_page_facebook";
function savePostsOfFacebookPage($table,$data,$page_id){
     $conn = pdoConect();
     $conn->beginTransaction();
    $query = "INSERT INTO ".$table." (`id`, `page_id`, `created_time`, `updated_time`, `picture`, `permalink_url`, `admin_creator`,"
             . " `shares`, `promotion_status`, `reach_paid`, `reach_organic`, `reach`,`comments`, `reactions`, `post_video_views_unique`, `link_clicks`, `type`) VALUES "; //Prequery
    $qPart = array_fill(0, count($data), "(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? , ?, ?, ?, ?, ?, ?)");
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
       $stmt->bindValue($i++, $item['picture']);
       $stmt->bindValue($i++, $item['permalink_url']);
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
       else { $linkClicks = ""; }
       $stmt->bindValue($i++, $linkClicks);
       $stmt->bindValue($i++, $item['type']);
    }
    try {
        $stmt->execute(); //execute
     } catch (PDOException $e){
         $conn->rollback();
           echo $e->getMessage();
         // sendMailer("mario@mimirwell.com","Job f�llido en ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
        //  sendMailer("luismiguel@mimirwell.com","Job f�llido en ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
        }
        $conn->commit();
}
savePostsOfFacebookPage($table,$arrayData,$pageId);
//end save on database
exit();
$params = array(
   'since'=>'2018-08-23',
   'until'=>'2018-09-14', //rango de 90 d�as m�ximo
   'metric' => array('page_fans'),
); 
$data = $page_api->call('/177324815630572/insights', RequestInterface::METHOD_GET,$params)->getContent();//obtener las reacciones de un post
//print_r($data);
//exit();
//echo "Fans a la fecha de la p&aacute;gina: ".$data['data']['0']['values']['0']['value'];

function insertInsightsInTableFacebook($cursor){
    $id_page = '177324815630572';
    $name_page = 'Instituto Le Cordon Bleu Per�';
         foreach ($cursor as $data) {
             $end_time = explode('T',$data['end_time']);
             $end_time = $end_time[0];
        $link = new PDO("mysql:host=localhost;dbname=aiwroi_ilcb", "aiwroi_aiwlcb", "]a_nc#S}LthH");
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try
        {
            $link->beginTransaction();
            $statement = $link->prepare("INSERT INTO page_fans_facebook (id_page,name_page,page_fans,end_time)
                VALUES(:id_page,:name_page,:page_fans,:end_time)");
            $statement->execute(array(
                "id_page" => $id_page,
                "name_page" => $name_page,
                "page_fans" => $data['value'],
                "end_time" => $end_time
            ));
                        $save = true;
                      $link->commit();  
                    
        } catch (PDOException $e) {
            error_log("Hubo un error en ".__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage(), 0);
             $save = false;
             $link->rollback();
        }
    }
    return $save;
}
$cursor = $data['data'][0]['values']; 
//insertInsightsInTableFacebook($cursor);
exit();


$arrayFields = array('id','created_time','picture','permalink_url','admin_creator','shares','insights.metric(post_impressions_paid).period(lifetime).as(post_impressions_paid)','insights.metric(post_impressions_unique).period(lifetime).as(reach)','comments.filter(stream).limit(0).summary(total_count).as(comments)','reactions.limit(0).summary(total_count).as(reactions)','insights.metric(post_video_views_unique).period(lifetime).as(post_video_views_unique)','insights.metric(post_clicks_by_type_unique).period(lifetime).as(post_clicks_by_type_unique)','type');
$params = array(
   'since'=>'2017-01-01','until'=>'2018-08-20',
   'summary' => 'true',
   'limit' => '100',
 //'metric' => array('post_reactions_by_type_total'),
   'fields' => $arrayFields,
); 
$id_page = '177324815630572';
//$data = $page_api->call('/177324815630572/insights', RequestInterface::METHOD_GET,$params)->getContent();//obtener las reacciones de un post
//$data = $page_api->call('/177324815630572_2050722194957482/likes', RequestInterface::METHOD_GET,$params)->getContent();//obtener los likes de un post
//$data = $page_api->call('/177324815630572_2050722194957482/comments', RequestInterface::METHOD_GET,$params)->getContent();//obtener comentarios de un post
//$data = $page_api->call('/177324815630572_2027618797267822/insights', RequestInterface::METHOD_GET,$params)->getContent();//obtener los
$data = $page_api->call('/177324815630572/feed', RequestInterface::METHOD_GET,$params)->getContent();//obtener los
//$data = $page_api->call('/177324815630572/promotable_posts', RequestInterface::METHOD_GET)->getContent();//obtener post promocionables
print_r($data);
exit();
$object_history_id = "177324815630572_1867932273236476";
$object_history_id_explode = explode("_",$object_history_id);
$pageId = $object_history_id_explode[0];
$postId = $object_history_id_explode[1];
$data = $page_api->call('/'.$object_history_id, RequestInterface::METHOD_GET,$params)->getContent();
//print_r($data['data'][0]['values']);
//print_r($data);
echo "id del post promocionado: ".$data['id'];
echo "<br>";
$created_time = explode("T",$data['created_time']);
echo "Fecha de creaci&oacute;n: ".$created_time[0];
echo "<br>";
$alcance = $data['reach']['data']['0']['values']['0']['value'];
echo "Alcance: ".$data['reach']['data']['0']['values']['0']['value'];
echo "<br>";
$compartidos = $data['shares']['count'];
echo "Compartidos: ".$data['shares']['count'];
echo "<br>";
//echo "Impresiones pagadas: ".$data['post_impressions_paid']['data']['0']['values']['0']['value'];
//echo "\n";
$comentarios = $data['comments']['summary']['total_count'];
echo "Comentarios: ".$data['comments']['summary']['total_count'];
echo "<br>";
$reacciones = $data['reactions']['summary']['total_count'];
echo "Reacciones: ".$data['reactions']['summary']['total_count'];
echo "<br>";
$vistasvideo = $data['post_video_views_unique']['data']['0']['values']['0']['value'];
echo "Vistas en video: ".$data['post_video_views_unique']['data']['0']['values']['0']['value'];
echo "<br>";
$clicklinks = $data['post_clicks_by_type_unique']['data']['0']['values']['0']['value']['link clicks'];
echo "Clic a links: ".$data['post_clicks_by_type_unique']['data']['0']['values']['0']['value']['link clicks'];
echo "<br>";
$inversion = "944.99";
echo "Inversi&oacute;n: $/ ".$inversion;
echo "<br>";
$params = array(
   'since'=>'2018-08-25',
   'until'=>'2018-08-25', //rango de 90 d�as m�ximo
 'metric' => array('page_fans'),
); 
$data = $page_api->call('/177324815630572/insights', RequestInterface::METHOD_GET,$params)->getContent();//obtener las reacciones de un post
echo "Fans a la fecha de la p&aacute;gina: ".$data['data']['0']['values']['0']['value'];
$fanspage = $data['data']['0']['values']['0']['value'];
echo "<br>";
$total_interacciones = $compartidos + $comentarios + $reacciones + $vistasvideo + $clicklinks;
$indice_interaccion = number_format((float)(($total_interacciones/$fanspage) * 100), 2, '.', '');
echo "Indice de Interacci&oacute;n: ".$indice_interaccion;
echo "<br>";
$indice_interalcance = number_format((float)(($indice_interaccion/$alcance) * 10000), 2, '.', '');
echo "Indice de Interalcance: ".$indice_interalcance;
echo "<br>";
$indice_interaccion_inversion = number_format((float)(($indice_interaccion / $inversion) * 100), 2, '.', ''); 
echo "Indice de Interacci&oacute;n Inversi&oacute;n: ".$indice_interaccion_inversion;
echo "<br>";
$indice_interalcance_inversion = number_format((float)(($indice_interalcance / $inversion)* 100), 2, '.', '');
echo "Indice de Interalcance Inversi&oacute;n: ".$indice_interalcance_inversion;
//print_r($data);
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v3.1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-post" data-href="https://www.facebook.com/<?php echo $pageId; ?>/posts/<?php echo $postId; ?>/" data-width="500" data-show-text="true"></div>
<?php
exit();
/*foreach ($data['data'][0]['values'] as $dataInsights)
    {
       echo $dataInsights['value'];
       echo "\n\n";
       $end_time = explode('T',$dataInsights['end_time']);
       $end_time = $end_time[0];
       echo $end_time;
       echo "\n\n";
    }
    exit();*/
    
define("DBHOST","localhost");
define("DBNAME","aiwroi_ilcb");
define("DBUSERNAME","aiwroi_aiwlcb");
define("DBPASSWORD","]a_nc#S}LthH");
function insertInsightsInTableFacebook2($cursor){
    $id_page = '177324815630572';
         foreach ($cursor as $data) {
             $end_time = explode('T',$data['end_time']);
             $end_time = $end_time[0];
        $link = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSERNAME, DBPASSWORD);
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try
        {
            $link->beginTransaction();
            $statement = $link->prepare("INSERT INTO page_fans_facebook (id_page,name_page,page_fans,end_time)
                VALUES(:id_page,:name_page,:page_fans,:end_time)");
            $statement->execute(array(
                "id_page" => $id_page,
                "name_page" => 'ilcb',
                "page_fans" => $data['value'],
                "end_time" => $end_time
            ));
            if ($statement->error){
                $save = false;
                  $link->rollback();
                    }
                    else{
                        $save = true;
                      $link->commit();  
                    }
        } catch (PDOException $e) {
            error_log("Hubo un error en ".__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage(), 0);
             $save = false;
             $link->rollback();
        }
    }
    return $save;
}
$cursor = $data['data'][0]['values']; 
//insertInsightsInTableFacebook($cursor);
//exit();

//,'insights.metric(page_posts_impressions_paid).period(lifetime).as(page_posts_impressions_paid)'
$next = "";
$after = "";
//$arrayFields = array('id','created_time','updated_time','picture','full_picture','message','link','name','permalink_url','call_to_action','admin_creator','caption','description','from','object_id','parent_id','is_hidden','is_published','child_attachments','shares','reactions.type(LIKE).limit(0).summary(total_count).as(like)','reactions.type(LOVE).limit(0).summary(total_count).as(love)','reactions.type(HAHA).limit(0).summary(total_count).as(haha)','reactions.type(WOW).limit(0).summary(total_count).as(wow)','reactions.type(SAD).limit(0).summary(total_count).as(sad)','reactions.type(ANGRY).limit(0).summary(total_count).as(angry)','comments.filter(stream).limit(0).summary(total_count).as(comentarios)','status_type','type','place','privacy','promotable_id','promotion_status','source','targeting','with_tags');
$arrayFields = array('id','created_time','picture','permalink_url','admin_creator','shares','insights.metric(post_impressions_paid).period(lifetime).as(post_impressions_paid)','insights.metric(post_impressions_unique).period(lifetime).as(reach)','comments.filter(stream).limit(0).summary(total_count).as(comentarios)','reactions.limit(0).summary(total_count).as(reactions)','insights.metric(post_video_views_unique).period(lifetime).as(post_video_views_unique)','insights.metric(post_clicks_by_type_unique).period(lifetime).as(post_clicks_by_type_unique)','type');
$params = array('summary' => 'true', 'since'=>'2017-01-01','until'=>'2018-08-20','fields' => $arrayFields);
$params = array('summary' => 'true', 'since'=>'2017-01-01','until'=>'2018-08-20','fields' => $arrayFields);
$arrayData = array();
$newCursor = array();
//$data = $page_api->call('/177324815630572/posts', RequestInterface::METHOD_GET,$params);//obtener posts
$cursor = $page_api->call('/177324815630572/feed', RequestInterface::METHOD_GET,$params)->getContent();//obtener posts

$newCursor = $cursor['data'];
$next = $cursor['paging']['next'];
$after = $cursor['paging']['cursors']['after'];
$params = array('summary' => 'true','after'=>$after, 'since'=>'2017-01-01', 'until'=>'2018-08-20','fields' => $arrayFields);
while($next != "") {
    $newCursor = $page_api->call('/177324815630572/feed', RequestInterface::METHOD_GET,$params)->getContent();//obtener posts
    $arrayData = array_merge($arrayData,$newCursor['data']);
    $after = $newCursor['paging']['cursors']['after'];
    $next = $newCursor['paging']['next'];
    $params = array('summary' => 'true','after'=>$after, 'since'=>'2017-01-01','until'=>'2018-08-20','fields' => $arrayFields);
   // echo "The after is:". $after. "<br>";
} 

print_r($arrayData);
exit();
echo "\n\n";
/*if (is_null($data) || !is_array($data['data']) || count($data['data']) === 0) {
    throw new \RuntimeException("no promotable posts available for page " . $page_id);
}*/
echo "\n\n";
// Then we get first page's insight using page access token
$api = Api::init($app_id, null, 'EAAbbxZAuuO9kBAGLDZAe2VBzYsNTQMzxjaJ3QD4rFGA9PNiQeZCMJ3CzVLEfrVxkXROwg10yAq8CphFnqXVDft16zY4myYefNCfd77R2wZB6zeJsdBZAQMQcDzVpWrhoHcH2XPmjRZAZAI084oMwKD4Tjy3rZCudHJFbmfsCCZBiZAZBQZDZD');
$fields = array(
);
$params = array(
 // 'metric' => 'page_fan_adds',
);
/*$insights = (new Page('177324815630572'))->getInsights($fields,$params)->getResponse()->getContent();
$post_promocionados = (new Page('177324815630572'))->getPromotablePosts($fields,$params)->getResponse()->getContent();
$videos_de_pagina = (new Page('177324815630572'))->getVideos($fields,$params)->getResponse()->getContent();*/
//$post_page = (new Page('177324815630572'))->getVisitorPosts($fields,$params)->getResponse()->getContent();
$feeds_page = (new Page('177324815630572'))->getPublishedPosts($fields,$params)->getResponse()->getContent();


print_r($feeds_page);
//print_r($videos_de_pagina);
//print_r($post_promocionados);
//print_r($insights);

//$post_id = $data['data'][0]['id'];
//echo $post_id;
//$json = json_encode($response->getContent());
//var_dump($response->getContent());
//echo $json;

//$f = insert_fb_data_day('act_1071159706331825'); //pec
//$f = insert_fb_data_day('act_1073271616120634'); //ilcb
//$f = insert_fb_data_day('act_1414429155338210'); //master_cuisine
//$f = insert_fb_data_day('act_1063559070425222'); //ulcb
//$f = insert_fb_data_day('act_1487762988004826'); //moviltours