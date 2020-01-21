<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Include the required dependencies.
define('SDK_DIR', __DIR__ . '/facebook-php-business-sdk/'); // Path to the SDK directory
$loader = include SDK_DIR.'/vendor/autoload.php';
//use Facebook\Facebook;
use FacebookAds\Api; 
use FacebookAds\Session;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Http\Request;
use FacebookAds\Http\RequestInterface;
use FacebookAds\Object\Page;

require_once( 'php-sdk-5/vendor/autoload.php' );
require_once('../model/UserModel.php');
require_once('../model/FacebookModel.php');
$UserModel = new UserModel();
$FacebookModel = new FacebookModel();
//$_SESSION = Array();
if (isset($_SESSION['fb_access_token'])){
$access_token = $_SESSION['fb_access_token'];
}
$access_token ="EAAEKN4bUKp4BAFupKU9vbCNLyReUrdMbRNberJP59fBhvcVvc9xOfp42rijHk2QLus4gm6YP4F5Yt1M3xUQfvwQI7xUHWqZB7Kh7aZAfsv4QQPZCnIg0ZBqd6ot8c62rbg8AfVIcIMIsa86osdiN6UKr7ZBLWC1SZBZB9o1FDULkgW8ZCKVQfX9J";
//echo $access_token;

//esta pagina necesita $access_token

/*if (isset($_GET['user'])){
    $checkUser = $UserModel->usernameCheck($_SESSION['user']->id_facebook);
    if ($checkUser == true){
      $access_token = $UserModel->getfacebook_access_tokenUser($_SESSION['user']->id_user);
        } else { 
            header('Location: https://ssgenius.com/app/facebook/login');
        }
    } else { 
        header('Location: https://ssgenius.com/app/facebook/login');
    }*/
    //exit();
    if (!isset($access_token)){ header('Location: https://ssgenius.com/app/facebook/login'); }
    // Instantiates a new Facebook super-class object from SDK Facebook\Facebook
    $appId         = '292708578241182'; //Facebook App ID
    $appSecret     = '462aeec937ca833dd9798c944d5c79e2'; //Facebook App Secret
    try{
    $api = Api::init($appId, $appSecret, $access_token);
    $api->setLogger(new CurlLogger());
    $api = Api::instance();
    }catch(\Exception $e){
        $return["message"] = $e->getMessage();
         echo $return["message"]; 
    }catch(Facebook\Exceptions\FacebookAuthorizationException $e){
         $return["message"] = $e->getMessage();
         echo $return["message"];
    }catch (FacebookAds\Http\Exception\ServerException $e) {
              $return["message"] = $e->getMessage();
        }catch (FacebookAds\Exception\Exception $e) {
              //$message = "Error tipo facebook exception: ".$e->getMessage();
              $return["message"] = $e->getMessage();
        }
 
 
function getFansPageFacebook($appId,$appSecret,$api,$id_page,$page_token){
    $page_session = new Session($appId, $appSecret, $page_token);
    $page_api = new Api($api->getHttpClient(), $page_session);
    $page_api->setLogger($api->getLogger());
    $paramsPage = array('metric' => array('page_fans'));
    $data = $page_api->call('/'.$id_page.'/insights', RequestInterface::METHOD_GET,$paramsPage)->getContent();
    return $data['data']['0']['values']['1']['value'];
}

$fb = new Facebook\Facebook([
  'app_id' => $appId,
  'app_secret' => $appSecret,
  'default_graph_version' => 'v3.2',
]);
     
    /*$borrarPermisosDeUsuario = $fb->delete('/1623677744399050/permissions/',[],$access_token);
    echo "<pre>";
    print_r($borrarPermisosDeUsuario);
    echo "</pre>";
    exit();*/
    //,adaccounts,businesses
    
     try{
    $response = $fb->get('/me?fields=id,first_name,last_name,name,short_name,email,picture,accounts',$access_token);
        $return['error-message'] = '<div class="alert alert-danger">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
													<strong> Mensaje</strong>
													<hr class="message-inner-separator">
													<p>Ocurrio un error al intentar acceder a sus datos.</p>
												</div>';
											//	echo $return['error-message'];
    /*echo "<pre>";
    print_r($response);
    echo "</pre>";*/
    //exit();
   
     }catch(Facebook\Exceptions\FacebookThrottleException $e){
        $return["message"] = $e->getMessage();
         echo $return["message"]; 
    }catch(Facebook\Exceptions\FacebookAuthorizationException $e){
         $return["message"] = $e->getMessage();
         echo $return["message"];
    }

    $graphObject = $response->getDecodedBody();
   /* echo "<pre>";
     print_r($graphObject);
     echo "</pre>";
   exit();*/
    $checkUser = $UserModel->usernameCheck($graphObject['id']); //chequeamos si el usuario esta registrado
//abrimos sesion para el usuario actual
     
    $_SESSION['id_user'] =  $UserModel->getIdUser($graphObject['id']);
    $_SESSION['name'] =  $UserModel->getUser($_SESSION['id_user'])->name;

    if ($checkUser == false){// guardamos al usuario en la db
        $id_user = uniqid(mt_rand(), true);       
        $created_time = date('Y-m-d H:i:s');
        if(isset($graphObject)){
        $UserModel->saveFacebookUser($id_user, $graphObject['id'], $graphObject['short_name'],  $graphObject['name'],  $graphObject['email'], $graphObject['picture']['data']['url'], $access_token, $created_time, $created_time); //guardamos al usuario
        }
       
    }else {
        //actualizamos datos como su token, su nombre, su email, su imagen
        $latest_visit = date('Y-m-d H:i:s');
        if(isset($graphObject)){
        $UserModel->UpdateFacebookUser($graphObject['id'], $graphObject['short_name'],  $graphObject['name'], $graphObject['email'], $graphObject['picture']['data']['url'], $access_token, $latest_visit);
        }
        if (isset($_GET['act'])){$act = $_GET['act'];} else{$act="";}
        
        if ($act != "list"){

        $user = $UserModel->getUser($_SESSION['id_user']);
        $pages = $FacebookModel->listPages($user->id_facebook);
        if (isset($pages['0']['id_facebook_page'])){
            $_SESSION['firstPageSsg'] = $pages['0']['id_facebook_page'];
            header('Location: https://ssgenius.com/app/facebook/?psid='.$_SESSION['firstPageSsg']);
        } else {$_SESSION['firstPageSsg'] = "";}
            //header('Location: https://ssgenius.com/app/facebook/?psid='.$_SESSION['firstPageSsg']);
            }
        }
      
         //echo $_SESSION['id_user'];
         
            if (count($graphObject['accounts']['data']) > 0 ){
                //$fbPerfil = $fb->get('/me/accounts', $access_token);
        $next = "";
        $after = "";     
        $arrayData = array();
        $newResponse = array();
        $context = stream_context_create(array(
            "ssl"=>array(
                "verify_peer"=>true,
                "verify_peer_name"=>true,
            )
        ));

         $paginas = $fb->get('/me/accounts', $access_token)->getDecodedBody();
         $arrayData = $paginas['data'];
    if (isset($paginas['paging']['next'])){
    $next = $paginas['paging']['next'];
    //exit();
    function file_get_contents_curl( $url ) {
      $ch = curl_init();
      curl_setopt( $ch, CURLOPT_AUTOREFERER, TRUE );
      curl_setopt( $ch, CURLOPT_HEADER, 0 );
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
      curl_setopt( $ch, CURLOPT_URL, $url );
      curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, TRUE );
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
      $data = curl_exec( $ch );
      curl_close( $ch );
      return $data;
    }
    $c = 0;
          while($next != "") {
              $c++;
              echo $c."<br>";
                $response = json_decode(file_get_contents_curl($next),true);
                $arrayData = array_merge($arrayData,$response['data']);
                if (isset($response['paging']['next'])){
                $next = $response['paging']['next'];
                } else { $next = ""; }
             }
    } 
    
            }
       
    ?>
<!doctype html>
<html lang="en" dir="ltr">
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
		<meta name="msapplication-TileColor" content="#0061da">
		<meta name="theme-color" content="#1643a3">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<link rel="icon" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" sizes="32x32" />
        <link rel="icon" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" sizes="192x192" />
        <link rel="apple-touch-icon-precomposed" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" />
        <meta name="msapplication-TileImage" content="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" />
		
		<!-- Title -->
		<title>SSG – Enlista páginas</title>
		<link rel="stylesheet" href="../assets/fonts/fonts/font-awesome.min.css">
		
		<!-- Font Family -->
		<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
		
		<!-- Dashboard Css -->
		<link href="../assets/css/dashboard.css" rel="stylesheet" />
		<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
		
		<!-- c3.js Charts Plugin -->
		<link href="../assets/plugins/charts-c3/c3-chart.css" rel="stylesheet" />
		
		<!-- Custom scroll bar css-->
		<link href="../assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet" />
		
		<!---Font icons-->
		<link href="../assets/plugins/iconfonts/plugin.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
	<style>
	    .btn-primary-facebook {
    color: #fff;
    background-color: #3B5998;
    border-color: #3B5998;
}
.btn-primary-facebook:hover {
	color: #fff;
	background-color: #3B5998;
	border-color: #3B5998;
}
.btn-primary-facebook:focus, .btn-primary-facebook.focus {
	box-shadow: 0 0 0 2px rgb(59,89,152,0.5);
}
.login-img2{ background-color:#EEEEEE; }
.h-6b {
     height: auto !important; 
}
	</style>
  </head>
	<body class="login-img2">
		<div id="global-loader"></div>
		<div class="page">
			<div class="page-single">
				<div class="container">
					<div class="row">
						<div class="col col-login mx-auto">
							<div class="text-center mb-6">
								<img src="https://ssgenius.com/wp-content/uploads/2018/10/cropped-logo-1.png" class="h-6 h-6b" alt="">
							</div>
							<div class="card">
								<div class="card-body p-6">
									<div class="card-title text-center" style="color:#3B5998;"><i class="fa fa-facebook-square" style='font-size:40px; position:relative; left:-14px;'></i> Agrega una página de Facebook</div>
									<hr />
									
									<!--<div class="visitor-list">
											
									</div>-->
										
									<!--<div class="text-center"><small>Logra tus metas conectando con tu comunidad</small></div>-->
									<div class="form-footer">
   <?php
	//sanitize vars
    $perms = false;
    if (count($graphObject['accounts']['data']) > 0 ){
        foreach ($arrayData as $accounts){
            foreach ($accounts['tasks'] as $rol){
                //administrador, editor o moderador
                if (($rol == "MANAGE") || ($rol == "CREATE_CONTENT") || ($rol == "MODERATE")){
                    $perms = true;
                }
            }
            if ($perms == true){// validamos permisos de admin de fan page facebook
            
                 $qtyFansPage = getFansPageFacebook($appId,$appSecret,$api,$accounts['id'],$accounts['access_token']);
                 //$UserModel->deleteRelationUserPageFacebook($graphObject['id']);//eliminamos las relaciones para guardar las nuevas de este cliente
                 //echo $accounts['id'].PHP_EOL;

            if ($qtyFansPage > 99){//más de 99 fans porque facebook da datos de page con esta restricción
              $checkPage = $FacebookModel->checkPage($accounts['id'],$graphObject['id']);
            if ($checkPage == false){ // paginas sin data almacenada las mostramos
            
              $checkRelationPages = $UserModel->checkRelationPages($accounts['id'],$graphObject['id']);
              $created_time = date('Y-m-d H:i:s');
            if ($checkRelationPages == false){// segunda comparacion
                $UserModel->saveRelationUserPageFacebook($graphObject['id'], $accounts['id'], $accounts['access_token'], "inactive" ,$created_time);//sino hay relacion guardamos las relaciones del usuario y sus paginas
                                            }
            $checkDataPage = $FacebookModel->checkIfPageSaved($accounts['id']);
            if ($checkDataPage == false){
                 $FacebookModel->saveFacebookPage($accounts['id'], $accounts['name'], $accounts['access_token'], $accounts['category'], "", "", "", $created_time, "false"); //guardamos los datos de pagina 
                }
                
                 $checkIfDataInPage = $FacebookModel->checkIfDataInPage($accounts['id']);
                 //if ($checkIfDataInPage == false){
                    ?>
                        <div class="media mt-2">
    						<div class="avatar brround avatar-md mr-3" style="background-image: url(<?php echo 'https://graph.facebook.com/'.$accounts['id'].'/picture'; ?>)"></div>
    						<div class="media-body">
    							<a href="#" class="text-default font-weight-bold"><img src='https://ssgenius.com/app/assets/images/FacebookUser_x1.png' style='display:inline-block; width:14px; height:14px;'> <?php echo $accounts['name']; ?></a>
    							<p class="text-default"><small><?php echo $qtyFansPage.' fans';?></small></p>
    						</div>
    						<!-- media-body -->
    						<a href="#" id="<?php echo $accounts['id'];?>" data-page-token="<?php echo $accounts['access_token']; ?>" data-id-facebook="<?php echo $graphObject['id']; ?>" data-page="<?php echo $accounts['name']; ?>" class="btn btn-outline-primary btn-sm add-page">Añadir</a>
    					
    					</div>
                    <?php
                    $textoPaginas = "<br><br><center><a class='text-center' href='https://ssgenius.com/app/facebook?psid=".$_SESSION['firstPageSsg']."'>Inicio</a></center>";
                 //} else { 
                     
                     $textoPaginas = "<br><br><center><a class='text-center' href='https://ssgenius.com/app/facebook?psid=".$_SESSION['firstPageSsg']."'>Inicio</a></center>";
                 //   }
                } else {
                        ?>
                        <div class="media mt-2">
    						<div class="avatar brround avatar-md mr-3" style="background-image: url(<?php echo 'https://graph.facebook.com/'.$accounts['id'].'/picture'; ?>)"></div>
    						<div class="media-body">
    							<a href="index.php?psid=<?php echo $accounts['id']; ?>" class="text-default font-weight-bold"><img src='https://ssgenius.com/app/assets/images/FacebookUser_x1.png' style='display:inline-block; width:14px; height:14px;'> <?php echo $accounts['name']; ?></a>
    							<p class="text-default"><small><?php echo $qtyFansPage.' fans';?></small></p>
    						</div>
    						<!-- media-body -->
    						<a href="#" class="text-warning quit-page" data-id-page="<?php echo $accounts['id']; ?>" data-page-token="<?php echo $accounts['access_token']; ?>" data-id-facebook="<?php echo $graphObject['id']; ?>" data-page="<?php echo $accounts['name']; ?>">Quitar</a>
    					</div>
                    <?php
                    $textoPaginas = "<br><br><center><a class='text-center' href='https://ssgenius.com/app/facebook?psid=".$_SESSION['firstPageSsg']."'>Inicio</a></center>"; 
                }
            } else {
                    $textoPaginas = "Páginas con más de 100 fans.<br><br><center><a class='text-center' href='https://ssgenius.com/app/facebook?psid=".$_SESSION['firstPageSsg']."'>Inicio</a></center>";   
                   }
                   
            } else {     
                $textoPaginas = "No tiene los permisos suficientes, debe ser administrador, editor o moderador.";
                
            }
        }
    }
    else {
        $textoPaginas = "<span class='ssg-error'>No hay páginas que añadir.<br>Por favor revisa que gestionas al menos una página de Facebook (el rol de Administrador es requerido) o puedes crear una nueva:<br></span><br>
        <a href='http://www.facebook.com/bookmarks/pages' target='_blank'>http://www.facebook.com/bookmarks/pages</a>";
    }
    echo $textoPaginas;
	 ?>
									</div>
								</div>
                        </div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		   /* echo "<pre>";
            print_r($graphObject);
            echo "</pre>";*/
		?>
		
		<!-- Dashboard js -->
		<script src="../assets/js/vendors/jquery-3.2.1.min.js"></script>
		<script src="../assets/js/vendors/bootstrap.bundle.min.js"></script>
		<script src="../assets/js/vendors/jquery.sparkline.min.js"></script>
		<script src="../assets/js/vendors/selectize.min.js"></script>
		<script src="../assets/js/vendors/jquery.tablesorter.min.js"></script>
		<script src="../assets/js/vendors/circle-progress.min.js"></script>
		<script src="../assets/plugins/rating/jquery.rating-stars.js"></script>
		<!-- Custom scroll bar Js-->
		<script src="../assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
        
        <!-- Data tables -->
		<script src="../assets/plugins/datatable/jquery.dataTables.min.js"></script>
		<script src="../assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>
		
		<!-- Custom Js-->
		<script src="../assets/js/custom.js"></script>
	</body>
</html>