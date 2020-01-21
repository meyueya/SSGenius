<?php
// Pass session data over. Only needed if not already passed by another script like WordPress.
session_start();
error_reporting(E_ALL); 
ini_set('display_errors', 1); 
define("NIVEL_MIN_PERMISO",4);
require_once('controller/user.php');
//include('controller/pageController.php');
include('../model/CuentasPorPaginasModel.php');
include('../model/ConfigurarPageFacebookSSGModel.php');
$cuentasPaginasModel= new CuentasPorPaginasModel;
$config_face_ssg= new ConfigurarPageFacebookSSGModel;
$paginas_ssg= $config_face_ssg->getAllPageSSG();
//var_dump($paginas_ssg);
    ?>
<!DOCTYPE html>
<html  lang="en" dir="ltr">
<!-- Mirrored from demos.creative-tim.com/paper-dashboard-2-pro/examples/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Aug 2018 16:06:28 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" sizes="32x32" />
  <link rel="icon" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" sizes="192x192" />
  <!-- <link rel="apple-touch-icon-precomposed" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" /> -->
  <meta name="msapplication-TileImage" content="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" />
  <title>
    SSG
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!-- Extra details for Live View on GitHub Pages -->
  <!-- Canonical SEO -->
  <link rel="canonical" href="https://www.creative-tim.com/product/paper-dashboard-2-pro" />
  <!--  Social tags      -->
  <meta name="keywords" content="creative tim, html dashboard, html css dashboard, web dashboard, bootstrap 4 dashboard, bootstrap 4, css3 dashboard, bootstrap 4 admin, paper dashboard bootstrap 4 dashboard, frontend, responsive bootstrap 4 dashboard, paper design, paper dashboard bootstrap 4 dashboard">
  <meta name="description" content="Paper Dashboard PRO is a beautiful Bootstrap 4 admin dashboard with a large number of components, designed to look beautiful, clean and organized. If you are looking for a tool to manage dates about your business, this dashboard is the thing for you.">
  <!-- Schema.org markup for Google+ -->
  <meta itemprop="name" content="Paper Dashboard PRO by Creative Tim">
  <meta itemprop="description" content="Paper Dashboard PRO is a beautiful Bootstrap 4 admin dashboard with a large number of components, designed to look beautiful, clean and organized. If you are looking for a tool to manage dates about your business, this dashboard is the thing for you.">
  <meta itemprop="image" content="../../../s3.amazonaws.com/creativetim_bucket/products/84/opt_pd2p_thumbnail.jpg">
  <!-- Twitter Card data -->
  <meta name="twitter:card" content="product">
  <meta name="twitter:site" content="@creativetim">
  <meta name="twitter:title" content="Paper Dashboard PRO by Creative Tim">
  <meta name="twitter:description" content="Paper Dashboard PRO is a beautiful Bootstrap 4 admin dashboard with a large number of components, designed to look beautiful, clean and organized. If you are looking for a tool to manage dates about your business, this dashboard is the thing for you.">
  <meta name="twitter:creator" content="@creativetim">
  <meta name="twitter:image" content="../../../s3.amazonaws.com/creativetim_bucket/products/84/opt_pd2p_thumbnail.jpg">
  <!-- Open Graph data -->
  <meta property="fb:app_id" content="655968634437471">
  <meta property="og:title" content="Paper Dashboard PRO by Creative Tim" />
  <meta property="og:type" content="article" />
  <meta property="og:url" content="https://creativetimofficial.github.io/paper-dashboard-2-pro/examples/dashboard.html" />
  <meta property="og:image" content="../../../s3.amazonaws.com/creativetim_bucket/products/84/opt_pd2p_thumbnail.jpg" />
  <meta property="og:description" content="Paper Dashboard PRO is a beautiful Bootstrap 4 admin dashboard with a large number of components, designed to look beautiful, clean and organized. If you are looking for a tool to manage dates about your business, this dashboard is the thing for you." />
  <meta property="og:site_name" content="Creative Tim" />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <!-- <link href="../../../maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet"> -->
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/paper-dashboard.min790f.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <link href="./assets/demo/issg.css" rel="stylesheet" />
  
  <!-- Extra details for Live View on GitHub Pages -->
  <link rel="stylesheet" href="assets/css/daterangepicker.css">
  <link rel="stylesheet" href="assets/css/bootstrap-multiselect.css" type="text/css"/>




  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="../assets/js/plugins/moment.min.js"></script>
  <script src="js/leermas.js"></script>
  <script src="assets/js/daterangepicker.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap-multiselect.js"></script>

  
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>


</head>

<body >
  <!-- Extra details for Live View on GitHub Pages -->
  <!-- Google Tag Manager (noscript) -->
  <noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe>
  </noscript>
  <?php include('views/ssgmodal.php');?>
  <!-- End Google Tag Manager (noscript) -->
  <div class="wrapper ">
    <?php include('views/menuaside.1.php');?>
    <?php //var_dump($page);?>
    <div class="main-panel">
      <!-- Navbar -->
    <?php include('views/menunav.php');?>
      <!-- End Navbar -->
      <div class="content">
      <form action="controller/cuentasPorPaginascontroller.php" method="post">
      <div class="container">
      <?php foreach ($paginas_ssg as $key => $pagina): ?>
      <?php                 $infoCuenta=[
                    'page_id'=>$pagina['id_facebook_page'],
                    //'id_user'=>$id_user,
                ];
                $cuentas=$cuentasPaginasModel->getCuentasAprobadasPorPagina($infoCuenta);
                ?>
          <?php if (count($cuentas)>0):?>
          <div class="row">
            <div class="col">
              <div class="card card-stats">
                <div class="card-body ">
                <h5 class="card-title"><?= $pagina['name']; ?></h5>
                  <div class="row">
                    <div class="col-2">
                      <div class="icon-big text-center icon-warning">
                      <a href="#">
                        <img src="https://graph.facebook.com/<?= $pagina['id_facebook_page']; ?>/picture">
                      </a>
                      </div>
                    </div>
                    <div class="col-10">
                      <div class="">
                        <p class="card-category">   
                        <div class="row">
                          <ul class="list-group">
                          <?php foreach ($cuentas as $infoCuenta):?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              <?= $infoCuenta['adaccount_name']?>
                                <a class="btn btn-success btn-sm" href="./admin-inversioncuentameses.php?psid=<?= $pagina['id_facebook_page']; ?>&id_adaccount=<?= $infoCuenta['id_adaccount']; ?>">
                                  ver
                                </a>
                            </li>
                          <?php endforeach ?>   
                          </ul>
                        </div> 
                        </p>
                      </p></div>
                    </div>
                  </div>
                </div>
                <div class="card-footer ">
                  <hr>
                  <div class="stats">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endif ?>   
  <?php endforeach?>
           </div> 
           </form>
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
      </div>
      <?php include('views/pie-pagina.php'); ?>
    </div>
  </div>


  <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
  <script src="../assets/js/plugins/bootstrap-switch.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="../assets/js/plugins/sweetalert2.min.js"></script>
  <!-- Forms Validations Plugin -->
  <script src="../assets/js/plugins/jquery.validate.min.js"></script>
  <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="../assets/js/plugins/jquery.bootstrap-wizard.js"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="../assets/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="../assets/js/plugins/bootstrap-datetimepicker.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
  <script src="../assets/js/plugins/jquery.dataTables.min.js"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="../assets/js/plugins/bootstrap-tagsinput.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="../assets/js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="../assets/js/plugins/fullcalendar.min.js"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="../assets/js/plugins/jquery-jvectormap.js"></script>
  <!--  Plugin for the Bootstrap Table -->
  <script src="../assets/js/plugins/nouislider.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script>
  <!-- Place this tag in your head or just before your close body tag. -->
  <!-- <script async defer src="../../../buttons.github.io/buttons.js"></script> -->
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/paper-dashboard.min790f.js?v=2.0.1" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <!-- Sharrre libray -->
  <script src="../assets/demo/jquery.sharrre.js"></script>
  <!-- <script src="js/creative_tim.js"></script> -->
<script src="../assets/js/plugins/bootstrap-selectpicker.js"></script>
<script>
//$('#my_pages').addClass("active");
//$('#my_pages_examples').addClass("show");
//$('#cuentas_por_pag').addClass("active");
</script>
</body>
</html>