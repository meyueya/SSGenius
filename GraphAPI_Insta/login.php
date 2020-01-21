<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
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

        .btn-primary-facebook:focus,
        .btn-primary-facebook.focus {
            box-shadow: 0 0 0 2px rgb(59, 89, 152, 0.5);
        }

        .login-img2 {
            background-color: #EEEEEE;
        }

        .h-6b {
            height: 170px !important;
        }
    </style>
</head>

<body class="login-img2">
    <center>
        <h1>Login Page</h1>


        <div id="global-loader"></div>
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
        <!-- Custom Js-->
        <script src="/asset/js/custom.js"></script>
        <script>
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {
                    return;
                }
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/es_LA/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

            window.fbAsyncInit = function() {
                FB.init({
                    appId: '177087713398265',
                    autoLogAppEvents: true,
                    xfbml: true,
                    cookie: true,
                    version: 'v5.0'
                });
                FB.getLoginStatus(function(response) {
                    if (response.status === 'connected') {
                        console.log(response);
                        //console.log('Usuario conectado a facebook');
                        // console.log('Token: '+ response.authResponse.accessToken);
                    } else {
                        //console.log('Usuario no conectado a Facebook'); 
                    }
                });
            };

            function fblogin() {
                //checkLoginState();
                FB.login(function(response) {
                    if (response.authResponse) {
                        // $(':input[type="button"]').prop('disabled', true);
                        // $(':input[type="button"]').slideUp();
                        window.location.replace("fb-callback.php?accessToken=" + response.authResponse.accessToken);
                        console.log(response);
                        //FB.api('/me/adaccounts?fields=name,account_id,account_status&limit=1', function (response) {
                        // console.log(JSON.stringify(response));
                        //});
                    } else if (response.status === 'not_authorized') {
                        // The person is logged into Facebook, but not your app.
                        console.log('Usuario logeado en Facebook pero no en la aplicación');
                        //document.getElementById('status').innerHTML = 'Please log ' + 'into this app.';
                    } else {
                        console.log('El usuario cancelo el login');
                    }
                }, {
                    scope: 'email,read_insights,manage_pages,pages_show_list,ads_read,business_management,instagram_basic,instagram_manage_comments,instagram_manage_insights,public_profile,',
                    auth_type: 'rerequest'
                });
            }
        </script>
        <!--
        Below we include the Login Button social plugin. This button uses
        the JavaScript SDK to present a graphical Login button that triggers
        the FB.login() function when clicked.
        -->
        <!-- <br><br>
        <fb:login-button onlogin="fblogin();">
        </fb:login-button>
        <div id="status">
        </div>
        <script type="text/javascript"> -->
        </script>
    </center>
</body>

</html>