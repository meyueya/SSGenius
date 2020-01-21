<?php
session_start();
$_SESSION = Array();
session_destroy();
/*require_once( '/home/ssgenius/public_html/app/facebook/php-sdk-5/vendor/autoload.php' );
$appId         = '292708578241182'; //Facebook App ID
$appSecret     = '462aeec937ca833dd9798c944d5c79e2'; //Facebook App Secret
$redirectURL   = 'https://ssgenius.com/app/facebook/login/fb-callback.php'; //Callback URL
//permisos en cola 'user_link','ads_management','ads_read','publish_pages','business_management','read_page_mailboxes'
$permissions = array('public_profile','email','pages_show_list','manage_pages','read_insights','ads_read'); // permissions

$fb = new Facebook\Facebook([
  'app_id'                => $appId,
  'app_secret'            => $appSecret,
  'default_graph_version' => 'v3.2'
]);
$helper = $fb->getRedirectLoginHelper();
//ads_management y ads_read son para cuenta publicitaria trabajan en conjunto con read_insights
//read_page_mailboxes es para pedir datos del inbox, a nivel desarrollo requiere debuggear el token tools and debugger
// Requested permissions - optional
$loginUrl = $helper->getLoginUrl($redirectURL, $permissions);*/
?>
<!doctype html>
<html lang="en" dir="ltr">
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
		<meta name="msapplication-TileColor" content="#F4F3EF">
		<meta name="theme-color" content="#F4F3EF">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/> 
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<!--<link rel="manifest" href="https://ssgenius.com/app/facebook/manifest.json">-->
		<link rel="icon" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" sizes="32x32" />
        <link rel="icon" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" sizes="192x192" />
        <link rel="apple-touch-icon-precomposed" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" />
        <meta name="msapplication-TileImage" content="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" />
		
		<!-- Title -->
		<title>SSG – Login</title>
		<link rel="stylesheet" href="../../assets/fonts/fonts/font-awesome.min.css">
		
		<!-- Font Family -->
		<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
		
		<!-- Dashboard Css -->
		<link href="../../assets/css/dashboard.css" rel="stylesheet" />
		
		<!-- c3.js Charts Plugin -->
		<link href="../../assets/plugins/charts-c3/c3-chart.css" rel="stylesheet" />
		
		<!-- Custom scroll bar css-->
		<link href="../../assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet" />
		
		<!---Font icons-->
		<link href="../../assets/plugins/iconfonts/plugin.css" rel="stylesheet" />
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
							<form class="card" action="#">
								<div class="card-body p-6">
									<div class="card-title text-center">Social Stats Genius</div>
									<div class="text-center"><small>Logra tus metas conectando con tu comunidad</small></div>
									<!--<div class="form-group">
										<label class="form-label">Email address</label>
										<input type="email" class="form-control" id="exampleInputEmail1"  placeholder="Enter email">
									</div>
									<div class="form-group">
										<label class="form-label">Password
											<a href="forgot-password.html" class="float-right small">I forgot password</a>
										</label>
										<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
									</div>
									<div class="form-group">
										<label class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" />
											<span class="custom-control-label">Remember me</span>
										</label>
									</div>-->
									<div class="form-footer">
										<a onclick="fblogin();" href="#"><button type="button" class="btn btn-primary btn-primary-facebook btn-block"><i class="fa fa-facebook-square"></i> Inicia sesión con Facebook...</button></a>
                                                                                <br>
                                                                                <div class="text-center"> Si es primera vez que inicias sesion, una vez logeado espera 10 minutos para entrar al sistema</div>
                                                                                
									</div>
								    
									<!--<div class="text-center text-muted mt-3">
										Don't have account yet? <a href="register.html">Sign up</a>
									</div>-->
								</div>
								
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		<!-- Dashboard js -->
		<script src="../../assets/js/vendors/jquery-3.2.1.min.js"></script>
		<script src="../../assets/js/vendors/bootstrap.bundle.min.js"></script>
		<script src="../../assets/js/vendors/jquery.sparkline.min.js"></script>
		<script src="../../assets/js/vendors/selectize.min.js"></script>
		<script src="../../assets/js/vendors/jquery.tablesorter.min.js"></script>
		<script src="../../assets/js/vendors/circle-progress.min.js"></script>
		<script src="../../assets/plugins/rating/jquery.rating-stars.js"></script>
		<!-- Custom scroll bar Js-->
		<script src="../../assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>
		
		<!-- Custom Js-->
		<script src="../../assets/js/custom.js"></script>
		<script>
  (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) { return; }
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/es_LA/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));          
    
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '292708578241182',
      autoLogAppEvents : true,
      xfbml            : true,
      cookie           : true,
      version          : 'v3.2'
    });
    FB.getLoginStatus(function (response) {
    if (response.status === 'connected') {
        console.log(response);
        //console.log('Usuario conectado a facebook');
       // console.log('Token: '+ response.authResponse.accessToken);
    } else { 
        //console.log('Usuario no conectado a Facebook'); 
    }
});
  };

    function fblogin()
    {
        //checkLoginState();
        FB.login(function (response) {
            if (response.authResponse) {
                $(':input[type="button"]').prop('disabled', true);
                $(':input[type="button"]').slideUp();
                window.location.replace("fb-callback.php");
                //console.log('Usuario logeado en la aplicación');
                //FB.api('/me/adaccounts?fields=name,account_id,account_status&limit=1', function (response) {
                   // console.log(JSON.stringify(response));
                //});
            } else if (response.status === 'not_authorized') {
            // The person is logged into Facebook, but not your app.
            console.log('Usuario logeado en Facebook pero no en la aplicación');
            //document.getElementById('status').innerHTML = 'Please log ' + 'into this app.';
        }
        else {
                console.log('El usuario cancelo el login');
            }
        }, { scope: 'public_profile,email,pages_show_list,manage_pages,read_insights,ads_read', auth_type : 'rerequest' });
    }
    </script>
	</body>
</html>
 