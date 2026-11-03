<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
define('SDK_DIR', '/home/ssgenius/public_html/app/facebook/facebook-php-business-sdk/'); // Path to the SDK directory
$loader = include SDK_DIR.'/vendor/autoload.php';
//use Facebook\Facebook;
use FacebookAds\Api; 
use FacebookAds\Session;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Http\Request;
use FacebookAds\Http\RequestInterface;
use FacebookAds\Object\Page;

require_once( '/home/ssgenius/public_html/app/facebook/php-sdk-5/vendor/autoload.php' );
require_once('/home/ssgenius/public_html/app/model/UserModel.php');
require_once('/home/ssgenius/public_html/app/model/FacebookModel.php');
require_once('/home/ssgenius/public_html/app/helper/SsgHelper.php');
$UserModel = new UserModel();
$FacebookModel = new FacebookModel();
$SsgHelper = new SsgHelper();
$ip = $SsgHelper->get_client_ip();
//$_SESSION = Array();
$access_token = getenv('FACEBOOK_ACCESS_TOKEN');

//echo $access_token;
    if ((!isset($access_token)) || (!$access_token)){ 
        $_SESSION = Array();
        $SsgHelper->sendMailer("ssgdeveloperalerts@mimirwell.com","Hubo un error de logeo token nula o vacia "," en ".__FILE__." \n ip". $ip);
        header('Location: https://ssgenius.com/app/facebook/index.php?psid=220224931456764'); 
        exit(); 
    }
    // Instantiates a new Facebook super-class object from SDK Facebook\Facebook
    $appId = '292708578241182'; //Facebook App ID
    $appSecret = getenv('FACEBOOK_APP_SECRET'); //Facebook App Secret
         $fb = new Facebook\Facebook([
          'app_id' => $appId,
          'app_secret' => $appSecret,
          'default_graph_version' => 'v3.2',
          'persistent_data_handler' => 'memory'
        ]);

/* try{
       $graphObject = $fb->get('/me?fields=id,first_name,last_name,name,short_name,email,picture,accounts', $access_token)->getDecodedBody(); 
 }catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  $SsgHelper->sendMailer("ssgdeveloperalerts@mimirwell.com","Hubo un error de logeo FacebookResponseException id:".$graphObject['id'],"token: ".$access_token." en ".__FILE__." \n ip". $ip." | ".$e->getMessage());
      echo 'Graph returned an error: ' . $e->getMessage();
      $return["message"] = $e->getMessage();
      exit;
    }
    catch(Facebook\Exceptions\FacebookAuthorizationException $e){
        $SsgHelper->sendMailer("ssgdeveloperalerts@mimirwell.com","Hubo un error de logeo AuthorizationException id:".$graphObject['id'],"token: ".$access_token."en ".__FILE__." \n ip". $ip." | ".$e->getMessage());
         $return["message"] = $e->getMessage();
         echo "Ocurrio un error: ".$return["message"];
         exit;
    }catch(Facebook\Exceptions\FacebookSDKException $e){
        $SsgHelper->sendMailer("ssgdeveloperalerts@mimirwell.com","Hubo un error de logeo FacebookSDKException id:".$graphObject['id'],"token: ".$access_token."en ".__FILE__." \n ip". $ip." | ".$e->getMessage());
         $return["message"] = $e->getMessage();
         echo "Ocurrio un error: ".$return["message"];
         exit;
    }catch(\Exception $e){
        $SsgHelper->sendMailer("ssgdeveloperalerts@mimirwell.com","Hubo un error de logeo facebook id:".$graphObject['id'],"token: ".$access_token."en ".__FILE__." \n ip". $ip." | ".$e->getMessage());
         $return["message"] = $e->getMessage();
         echo "Ocurrio un error: ".$return["message"];
         exit;
    }*/

    function getFansPageFacebook($appId,$appSecret,$access_token,$id_page,$page_token){
        $api = Api::init($appId, $appSecret, $access_token);
        $api->setLogger(new CurlLogger());
        $api = Api::instance();
        $page_session = new Session($appId, $appSecret, $page_token);
        $page_api = new Api($api->getHttpClient(), $page_session);
        $page_api->setLogger($api->getLogger());
        $paramsPage = array('metric' => array('page_fans'));
        $data = $page_api->call('/'.$id_page.'/insights', RequestInterface::METHOD_GET,$paramsPage)->getContent();
        return $data['data']['0']['values']['1']['value'];
    }
    /*$borrarPermisosDeUsuario = $fb->delete('/id_user/permissions/',[],$access_token);
    echo "<pre>";
    print_r($borrarPermisosDeUsuario);
    echo "</pre>";
    exit();*/
    //,adaccounts,businesses
   /* if (!isset($graphObject['id'])){
        $SsgHelper->sendMailer("ssgdeveloperalerts@mimirwell.com","No hay objeto graph, con la token : ".$access_token," en ".__FILE__." \n ip". $ip." | ".$e->getMessage());
        echo "Ocurrio un error, por favor intente mas tarde, no se pudo formar el objeto graph";
        exit();
    }*/
         $checkUser = $UserModel->usernameCheck($graphObject['id']); //chequeamos si el usuario esta registrado
    
   // if ($_SESSION['id_user'] == false){ echo "Error al acceder al id del objeto graph";     exit();}

    //$_SESSION['name'] =  $UserModel->getUser($_SESSION['id_user'])->name;

    if ($checkUser == false){// guardamos al usuario en la db
        $id_user = uniqid(mt_rand(), true);       
        $created_time = date('Y-m-d H:i:s');
        if(isset($graphObject)){
        $UserModel->saveFacebookUser($id_user, $graphObject['id'], $graphObject['short_name'],  $graphObject['name'],  $graphObject['email'], $graphObject['picture']['data']['url'], $access_token, $created_time, $created_time); //guardamos al usuario
        }
        $_SESSION['firstPageSsg'] = "";
    }else {
        $_SESSION['id_user'] =  $UserModel->getIdUser($graphObject['id']);
          //$_SESSION['name'] =  $UserModel->getUser($_SESSION['id_user'])->name;
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
                exit();
                } else {
                    $_SESSION['firstPageSsg'] = "";
                }
            }
        }
         if ((isset($graphObject['accounts']['data'])) && (count($graphObject['accounts']['data']) > 0 )){
         $next = "";
         $after = "";     
         $arrayData = array();
         $paginas = $fb->get('/me/accounts', $access_token)->getDecodedBody();
         $arrayData = $paginas['data'];
         $next = isset($paginas['paging']['next']) ? $paginas['paging']['next'] : "" ;
          while($next != "") {
                $response = json_decode($SsgHelper->file_get_contents_curl($next),true);
                $arrayData = array_merge($arrayData,$response['data']);
                 $next = isset($response['paging']['next']) ? $response['paging']['next'] : "";
             }
         }
    ?>
<!doctype html>
<html lang="es" dir="ltr">
<head>
		<meta charset="UTF-8">
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
		<div id="global-loader" ></div>
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
    if ((isset($graphObject['accounts']['data'])) && (count($graphObject['accounts']['data']) > 0 )){
        foreach ($arrayData as $accounts){
            foreach ($accounts['tasks'] as $rol){
                //administrador, editor o moderador
                if (($rol == "MANAGE") || ($rol == "CREATE_CONTENT") || ($rol == "MODERATE")){
                    $perms = true;
                }
            }
            if ($perms == true){// validamos permisos de admin de fan page facebook
                 $qtyFansPage = getFansPageFacebook($appId,$appSecret,$access_token,$accounts['id'],$accounts['access_token']);
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
        $textoPaginas = "<span class='ssg-error'>No hay páginas que añadir.<br>Por favor revisa que gestionas al menos una página de Facebook con más de 100 fans (el rol de Administrador, moderador o editor es requerido) o puedes crear una nueva:</span><br>
        <a href='http://www.facebook.com/bookmarks/pages' target='_blank'>http://www.facebook.com/bookmarks/pages</a><br><br><center><a href='logout.php'>Salir</a></center>";
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
