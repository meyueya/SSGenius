<?php
//para guardar los posts de una pagina, ver el token de la pagina, el id de la pagina, la conexion y la tabla
//header('Content-Type: text/html; charset=utf-8');
header('Content-Type: application/json');
//error_reporting(E_ALL & ~E_NOTICE & E_DEPRECATED);
error_reporting(E_ALL);
ini_set('display_errors', 1);
    // Configurations

// $access_token = 'EAAbbxZAuuO9kBAF2Kh87jm5qFZBcAmyKrAQLqqwJC7tAwwZBpASIvUZCpBLvPJRpxntAlMaL2rTbKjUYjUSL5SIbED3qwZBcheRVIW4Ml4LruvNQFZBOQZCDwGPsedG0h82OxAzJ4AlbYig3o74W8BTFV6TUgKUreXRncOyaqsy9AZDZD'; //token con permisos extendidos de señora Franc
// $app_id = '1930491627191257';
// $app_secret = '934f83f24436ea82749ca6b5fafc6281';
$access_token = 'EAAEKN4bUKp4BAMkDVU0QysRMazDcJOsZBZCvkbiwiUzjr3gVLTn1a9mmZB2hfcrZA21pbQ2ofEI0MMFa9ne1WcIbiFT6ZC5cRYFXhHbbjVZBPsBHDSmfE9uloDSB290ArTztDjl2TY7HygfdmiBvM95YpH19FCUFLGIaZCkMXRvqwZDZD'; //token con permisos extendidos de señora Franc
$app_id = '292708578241182';
$app_secret = '462aeec937ca833dd9798c944d5c79e2';
define('SDK_DIR', __DIR__ . '/'); // Path to the SDK directory
$loader = include SDK_DIR.'/vendor/autoload.php';
if (is_null($access_token) || is_null($app_id) || is_null($app_secret)) {
  throw new \Exception('You must set your access token, app id and app secret before executing');
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
print_r($data);
//exit();
//$page_token ="EAAbbxZAuuO9kBACbppU0DdJuVWHZAsbWDzZBCAan5yzuuZAGm20mvKN5HBeNke5EfJFEN7DMb7K1e0LFnAx748JLv8VFfN8iBBKFTSthqNQhuWMaRiW7KETtsHgX7fB2BZC9dj2CgQgSHCygQdobQuHoDI4yVu4qHce5OtjYlLQZDZD"; //moviltours
//$page_token ="EAAbbxZAuuO9kBAKBx1suNqnf2kwfKP72tfob1lW9v9QJ4QiZBZAjIBzhBzmdRSwPbtjb5qCaZBXFyjTP9kSMXAUXzz7HwhRfW5WR6OghRoLJdvIqahemC9tRNN1drCQZCupdaYULlatqu37wczqcvKC7b7ai3QBZB9ppfMVJGqqwZDZD"; //ulcb
$page_token = "EAAbbxZAuuO9kBALcn5YJAV5A9OwaGbS95kPVR0ZCFnwvvLZAYD1FPkZAZC2ZBBAGBvxiu3peke7Rp6ZAqVj3ptiqPOGC0yZAylzchecS59gvNgy2OoM1mY1bdX4nT3Ey3rDSQCag8jbUoOOZCviCZCcQCcSh1u5LxEOHJyDkQ8CX10NQZDZD"; //ilcb
$page_session = new Session($app_id, $app_secret, $page_token);
$page_api = new Api($api->getHttpClient(), $page_session);
$page_api->setLogger($api->getLogger());
$next = "";
$after = "";
$dia = date('Y-m-d',strtotime("-1 days"));
//$dia = date('Y-m-d');
$since = "2016-09-19";
$until = $dia;
//$pageId = "192597304105183";//movil_tours
//$pageId = "116430608473023";//ulcb
//$pageId = "177324815630572";//ilcb
$arrayFields = array('id','created_time','updated_time','picture','permalink_url','admin_creator','shares','promotion_status','insights.metric(post_impressions_paid_unique).period(lifetime).as(reach_paid)','insights.metric(post_impressions_organic_unique).period(lifetime).as(reach_organic)','insights.metric(post_impressions_unique).period(lifetime).as(reach)','comments.filter(stream).limit(0).summary(total_count).as(comments)','reactions.limit(0).summary(total_count).as(reactions)','insights.metric(post_video_views_unique).period(lifetime).as(post_video_views_unique)','insights.metric(post_clicks_by_type_unique).period(lifetime).as(post_clicks_by_type_unique)','type');
$params = array('since'=>$since,'until'=>$until,'fields' => $arrayFields,'limit' => '100',);
$arrayData = array();
$newCursor = array();
$cursor = $page_api->call('/'.$pageId.'/feed', RequestInterface::METHOD_GET,$params)->getContent();//obtener posts
print_r($cursor);
exit();
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
         // sendMailer("mario@mimirwell.com","Job fállido en ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
        //  sendMailer("luismiguel@mimirwell.com","Job fállido en ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
        }
        $conn->commit();
}
//savePostsOfFacebookPage($table,$arrayData,$pageId);