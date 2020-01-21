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
define("DBHOST","localhost");
define("DBNAME","aiwroi_moviltours");//cambia la base de datos
define("DBUSERNAME","aiwroi_aiwlcb");
define("DBPASSWORD","]a_nc#S}LthH");
define('DNS','mysql:dbname='.DBNAME.';host='.DBHOST);
function pdoConect(){
 $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME.";charset=utf8", DBUSERNAME, DBPASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
}
    function getMaxDateFromFacebookSavedData($type)
        {
            $conn = pdoConect();
            try {         	 
			 $sql = "select max(date) as date from report_save_data WHERE type = '".$type."'";
			 $sth = $conn->prepare($sql);
			 $sth->execute();
			 $maxdate = $sth->fetchObject();			
			 $date = $maxdate->date; 
			 }catch (PDOException $e) {
			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );
			 } 
			 return $date;
    }	
    
function registerInsertData($date,$qty=null,$status=null,$type)
    {
        $conn = pdoConect();
        try
        {
            $conn->beginTransaction();
            $statement = $conn->prepare("INSERT INTO report_save_data(date,qty,status,type)
                VALUES(:date,:qty,:status,:type)");
            $stmt = $statement->execute(array(
                "date" => $date,
                "qty" => $qty,
                "status" => $status,
                "type" => $type
            ));
                    $save = true;
                    $conn->commit();  
        } catch (PDOException $e) {
            //error_log("Hubo un error en ".__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage(), 0);
            //sendMailer("mario@mimirwell.com","Hubo un error en guardado de ads insights",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
             $save = false;
             $conn->rollback();
        }
    return $save;
}

function insertPageFansInTableFacebook($id_page,$page_fans,$page_fan_adds_unique,$page_fan_adds_by_paid_unique,$page_fan_adds_by_non_paid_unique,$page_fan_removes_unique,$end_time){
        $conn = pdoConect();
        try
        {
            $conn->beginTransaction();
            $statement = $conn->prepare("INSERT INTO page_fans_facebook (id_page,page_fans,page_fan_adds_unique,page_fan_adds_by_paid_unique,page_fan_adds_by_non_paid_unique,page_fan_removes_unique,end_time)
                VALUES(:id_page,:page_fans,:page_fan_adds_unique,:page_fan_adds_by_paid_unique,:page_fan_adds_by_non_paid_unique,:page_fan_removes_unique,:end_time)");
           $statement->execute(array(
                "id_page" => $id_page,
                "page_fans" => $page_fans,
                "page_fan_adds_unique" => $page_fan_adds_unique,
                "page_fan_adds_by_paid_unique" => $page_fan_adds_by_paid_unique,
                "page_fan_adds_by_non_paid_unique" => $page_fan_adds_by_non_paid_unique,
                "page_fan_removes_unique" => $page_fan_removes_unique,
                "end_time" => $end_time
            ));
                 $conn->commit();
                 $save = true;
        } catch (PDOException $e) {
             $conn->rollback();
            //error_log("Hubo un error en ".__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage(), 0);
           // sendMailer("mario@mimirwell.com","Hubo un error en guardado de keywords",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
              $save = false;
        }
    return $save;
}

function insert_fb_data($since) {
$access_token = 'EAAEKN4bUKp4BAMkDVU0QysRMazDcJOsZBZCvkbiwiUzjr3gVLTn1a9mmZB2hfcrZA21pbQ2ofEI0MMFa9ne1WcIbiFT6ZC5cRYFXhHbbjVZBPsBHDSmfE9uloDSB290ArTztDjl2TY7HygfdmiBvM95YpH19FCUFLGIaZCkMXRvqwZDZD';
$app_id = '292708578241182';
$app_secret = '462aeec937ca833dd9798c944d5c79e2';
 try {
$api = Api::init($app_id, $app_secret, $access_token);
$api->setLogger(new CurlLogger());
// The instace is now retrivable
$api = Api::instance();
$page_token = "EAAEKN4bUKp4BAKZCWZBZC0TBDwbzABJISLriQ8RpRnjyUBRrqcGzmSYkNTNoujEJe0rPfTASUabo1soW3ZAQzOyC41K68njdAedH4WYXZCG40kA7G8nFUc7OI2QM7Dyd7ULwkQGDWlPKDJUw7Jt5zFnGiUSa3mtFRWsZAWyuLFegZDZD"; //Movil Tours
               
$page_session = new Session($app_id, $app_secret, $page_token);
$page_api = new Api($api->getHttpClient(), $page_session);
$page_api->setLogger($api->getLogger());
$id_page = '192597304105183'; //Movil Tours
$params = array(
    'since'=>$since,
    'until'=>$since, //rango de 90 días
    'metric' => array('page_fans','page_fan_adds_unique','page_fans_by_like_source_unique','page_fan_adds_by_paid_non_paid_unique','page_fan_removes_unique','page_fans_by_unlike_source_unique'),
); 
$data = $page_api->call('/192597304105183/insights', RequestInterface::METHOD_GET,$params)->getContent();//obtener las reacciones de un post
$page_fans = $data['data']['0']['values']['0']['value'];
$page_fan_adds_unique = $data['data']['1']['values']['0']['value'];
$page_fan_adds_by_non_paid_unique = $data['data']['5']['values']['0']['value']['unpaid'];
$page_fan_adds_by_paid_unique = $data['data']['5']['values']['0']['value']['paid'];
$page_fan_removes_unique = $data['data']['7']['values']['0']['value'];
$message = $since.' - '.$page_fans.' fans';
 }catch (FacebookAds\Http\Exception\ServerException $e) {
             $message = "Error en servidor facebook: ".$e->getMessage();
        }catch (FacebookAds\Exception\Exception $e) {
              $message = "Error tipo facebook exception: ".$e->getMessage();
        }
insertPageFansInTableFacebook($id_page,$page_fans,$page_fan_adds_unique,$page_fan_adds_by_paid_unique,$page_fan_adds_by_non_paid_unique,$page_fan_removes_unique,$since);
return $message;
}

  $lastDateSave = getMaxDateFromFacebookSavedData($_POST['token']);
    if ($lastDateSave == ''){
        $date = $_POST['date'];
         //$date = '2018-08-01'; //fecha de inicio
    }else {
        $date = date('Y-m-d',strtotime($lastDateSave ."+1 days"));
    }
    $qty = '';
    $since = $date;
    $until = $date;
    $ayer = date('Y-m-d',strtotime("-1 days"));//obtenemos el dia de ayer
    $qty = ''; 
    //echo $ayer;
    //echo $lastDateSave;
    if ($ayer > $lastDateSave ){
        $type = $_POST['token'];
        //$since = '2016-09-17';
        $f = 'ok';
         registerInsertData($date,$qty,$f,$_POST['token']);
        $mensaje = insert_fb_data($since);
         $result = array("flag"=>'1',"status"=>"Ok","mensaje"=>$mensaje);
    }else {
        //echo "ya no guarda";
        $result = array("flag"=>'0',"status"=>"Completed","mensaje"=>"<span class='green'>Tarea finalizada</span>");
    }
echo json_encode($result);
