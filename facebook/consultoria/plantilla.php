<?php
// Pass session data over. Only needed if not already passed by another script like WordPress.

require_once('inclu.php');

    ?>
<!doctype html> 
<html lang="en" dir="ltr">
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
		<title>SSG</title>
		<link rel="stylesheet" href="../../assets/fonts/fonts/font-awesome.min.css">

		<!-- Font Family-->
		<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">

		<!-- Dashboard Css -->
		<link href="../../assets/css/dashboard.css" rel="stylesheet" />

		<!-- c3.js Charts Plugin -->
		<link href="../../assets/plugins/charts-c3/c3-chart.css" rel="stylesheet" />

		<!-- Custom scroll bar css-->
		<link href="../../assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet" />

		<!-- Sidemenu Css -->
		<link href="../../assets/plugins/toggle-sidebar/css/sidemenu.css" rel="stylesheet">

		<!---Font icons-->
		<link href="../../assets/plugins/iconfonts/plugin.css" rel="stylesheet" />
		<style>
		    .app-content .side-app {
    padding: 42px 0px 0 0px;
}
.ap-social-icon {
    min-width: 10px;
    max-width: 10px;
    min-height: 10px;
    max-height: 10px;
    position:relative;
    top:19px;
    left:-10px;
    background-size: 100%;
    background-repeat: no-repeat;
    -ms-flex-negative: 0;
    flex-shrink: 0;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-font-smoothing: antialiased;    
}
.ap-social-icon.facebook {
    background-image: url(https://ssgenius.com/app/assets/images/facebook-icon.png);
}

		</style>
	</head>
	<body class="app sidebar-mini rtl" >
		<div id="global-loader" ></div>
		<div class="page">
			<div class="page-main">
				
			<?php include('menu.php'); ?>


				<div class="app-content my-3 my-md-5">
					<div class="side-app">
					<!-- 	<div class="" style="min-height:92vh;">
						    <iframe id="pagef" src="ssg?psid=<?php echo $firstPageSsg;?>" height=""  width="100%" style="min-height: 94vh;"  scrolling="yes" frameborder="0"></iframe>
						</div> -->
					</div>
					<!--footer-->
					<footer class="footer">
						<div class="container">
							<div class="row align-items-center flex-row-reverse">
								<div class="col-lg-12 col-sm-12 mt-3 mt-lg-0 text-center">
									Copyright © 2018 <a href="#">SSG</a> All rights reserved.
								</div>
							</div>
						</div>
					</footer>
					<!-- End Footer-->
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

		<!-- Fullside-menu Js-->
		<script src="../../assets/plugins/toggle-sidebar/js/sidemenu.js"></script>

		<!-- Custom scroll bar Js-->
		<script src="../../assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>
		<!-- Custom Js-->
		<script src="../../assets/js/custom.js"></script>
	</body>
</html>