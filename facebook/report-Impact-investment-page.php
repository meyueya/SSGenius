<?php 
session_start();
define("NIVEL_MIN_PERMISO",1);
require_once('controller/user.php');
include('../model/CuentasPorPaginasModel.php');
$cuentasPaginasModel= new CuentasPorPaginasModel;
$psid =$_GET['psid'];
$filtro=[
    'page_id'=>$psid,
    'id_user'=>$id_user,
];
$cuentas = $cuentasPaginasModel->getCuentasPorPaginaUser($filtro);
?>
<!DOCTYPE html>
<html lang="en"> 
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <head>
    <meta charset="utf-8" />
    <link rel="icon" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" sizes="32x32" />
    <link rel="icon" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" sizes="192x192" />
    <!-- <link rel="apple-touch-icon-precomposed" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" /> -->
    <meta name="msapplication-TileImage" content="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" />
    <title>
      Impacto Inversión Página
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/paper-dashboard.min790f.css?v=2.0.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/demo/demo.css" rel="stylesheet" />
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.css" rel="stylesheet" />
    <link href="./dist/css/mod.css" rel="stylesheet" />
    <style>
        .nav-pills-primary .nav-item .nav-link {
          border: 1px solid #6bd098;
          color: #6bd098;
          padding: 0px 10px;
          font-size: 12px;
          border-radius: 3px;
      }

      .nav-pills-primary .nav-item .nav-link.active {
          border: 1px solid #6bd098;
          background: #6bd098;
          color: #fff;
          font-size: 15px
      }

      .nav-pills-primary .nav-link.active {
          background-color: #6bd098!important;
      }

      .dropdown-toggle.btn.btn-default.btn-round{
        border-radius: 3px;

      }

      .nav-item{
          padding: 3px 2px;
          
      }

      tbody {
          font-size: 12px;
          text-align: center;
      }
    </style>
  </head>
  <body id="body">
    <!-- End Google Tag Manager (noscript) -->
    <div class="wrapper ">
      <?php include('views/menuaside.1.php');?>
      <div class="main-panel">
        <!-- Navbar -->
        <?php include('views/menunav.php');?>
        <!-- End Navbar -->
        <div class="content">
          <div class="row" style="height: 40px;"></div>
          <form action="" id="form_parametros">
            <div class="row">
              <div class="col">
                  <div class="container">
                      <h5 class="card-title">Cuenta</h5>
                      <div class="row">
                        <div class="col-lg-5 col-md-6 col-sm-3">
                          <select class="selectpicker" data-style="btn btn-default btn-round" title="Single Select" id="account_id" name="account_id" onchange="getInfoPage()">
                          <?php foreach($cuentas as $hey => $cuenta):?>
                            <option <?php if($hey==0){echo "selected";} ?> value="<?= $cuenta['id_adaccount']?>"><?= $cuenta['adaccount_name']?></option>
                          <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="col">
                  <div class="container">
                      <h5 class="card-title">Pauta</h5>
                      <div class="row">
                        <div class="col-lg-5 col-md-6 col-sm-3">
                          <select class="selectpicker" multiple data-style="btn btn-default btn-round" title="Single Select" id="objective" name="objective[]" onchange="getInfoPage()">
                            <option value="PAGE_LIKES" selected>PAGE_LIKES</option>
                            <option value="POST_ENGAGEMENT">POST_ENGAGEMENT</option>
                            <option value="LINK_CLICKS">LINK_CLICKS</option>
                            <option value="REACH">REACH</option>
                            <option value="LEAD_GENERATION">LEAD_GENERATION</option>
                            <option value="CONVERSIONS">CONVERSIONS</option>
                            <option value="VIDEO_VIEWS">VIDEO_VIEWS</option>
                            <option value="EVENT_RESPONSES">EVENT_RESPONSES</option>
                          </select>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="col">
                  <div class="container">
                      <h5 class="card-title">Indicador:</h5>
                      <div class="row">
                        <div class="col-lg-5 col-md-6 col-sm-3">
                          <select class="selectpicker" data-style="btn btn-default btn-round" title="Single Select" id="indicador" name="indicador" onchange="getInfoPage()">
                            <option value="interactions" selected>Seleccione</option>
                            <option value="page_impressions_unique">Alcance</option>
                            <option value="clics">Clic</option>
                            <option value="link_clicks">Clic a link</option>
                            <option value="comments">Comentarios</option>
                            <option value="page_impressions">Impresiones</option>
                            <option value="interactions">Interacciones</option>
                            <option value="page_fans">Likes</option>
                            <option value="reactions">Reacciones</option>
                            <option value="post_video_views_unique">Reproducción de videos</option>
                          </select>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="col">
                  <div class="container">
                      <h5 class="card-title">Periodo:</h5>
                      <div class="row">
                        <div class="col-lg-5 col-md-6 col-sm-3">
                          <select class="selectpicker" data-style="btn btn-default btn-round" title="Single Select" id="agrupar_por" name="agrupar_por" onchange="getInfoPage()">
                            <option disabled selected>Seleccione</option>
                            <option value="dias">Dias</option>
                            <option value="semanas">Semanas</option>
                            <option value="meses" selected >Mes</option>
                          </select>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <h5 class="card-title">Fecha:</h5>
                  <div class="input-group">
                    <input  class="btn btn-default pull-right" name="daterange_fecha" id="daterange-btn" autocomplete="off" onchange="getInfoPage()">
                  </div>
                  <input name="page_id" id="page_id" type="hidden" value="<?= $psid?>">
                </div>
              </div>
            </div>
          </form>              
          <div class="col-md-12">
            <div class="card">
              <div class="card-body"> 
                <div id="container" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
                          <!-- GRAFICAS -->
              </div>
            </div>
          </div>
          <div class="card-body" style="width: 90%; margin: 0 auto;">     
            <div class="tab-content tab-space tab-subcategories">
              <div class="tab-pane active" id="list_info"></div>
            </div>
          </div>
          <?php include('views/pie-pagina.php'); ?>
        </div>
      </div>
    </div>
    <!--   Core JS Files   
    <script src="../assets/js/core/jquery.min.js"></script>-->
    <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <script src="../assets/js/plugins/moment.min.js"></script>
    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="../assets/js/plugins/bootstrap-switch.js"></script>
    <!--  Plugin for Sweet Alert -->
    <script src="../assets/js/plugins/sweetalert2.min.js"></script>
    <!-- Forms Validations Plugin -->
    <script src="../assets/js/plugins/jquery.validate.min.js"></script>
    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="../assets/js/plugins/jquery.bootstrap-wizard.js"></script>
    <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="../assets/js/plugins/bootstrap-selectpicker.js"></script>
    <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
    <script src="../assets/js/plugins/bootstrap-datetimepicker.js"></script>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    <script src="../assets/js/plugins/jquery.dataTables.min.js"></script>
    <!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
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
    <script async defer src="https://buttons.github.io/buttons.js"></script>
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

    <script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script>
      var psid = "<?= $psid?>"
    </script>
    <script src="js/report-Impact-investment-page.js"></script>
  </body>
</html>