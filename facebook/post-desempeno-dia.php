<?php
session_start();
include('controller/funcionesFormat.php');
define("NIVEL_MIN_PERMISO",1);
require_once('controller/user.php');    
include('../model/ReportePostConsultoriaModel.php');
include('../model/KpiFacebookModel.php');
$psid = (isset($_GET['psid'])) ? $_GET['psid'] : null ;
$id_post = (isset($_GET['postid'])) ? $_GET['postid'] : null ;
$id_consultoria = (isset($_GET['consultoria'])) ? $_GET['consultoria'] : null ;
$id_analisis = (isset($_GET['analisis'])) ? $_GET['analisis'] : null ;
$post_actual = (isset($_GET['post'])) ? $_GET['post'] : null ;
$id_post=$_GET['postid'];
$reportePostConsultoria = new ReportePostConsultoriaModel;
$reportePostConsultoria->setPageName($psid);
$infoPostConsultoria = $reportePostConsultoria->getInfoPost($id_post);
$infoHistPostConsultoria = $reportePostConsultoria->getInfoHistoricoPost($id_post);
$kpisFacebook = $reportePostConsultoria->getKPIs('ssg_facebook');
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
<meta charset="utf-8" />
  <link rel="icon" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" sizes="32x32" />
  <link rel="icon" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" sizes="192x192" />
  <meta name="msapplication-TileImage" content="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" />
  <title>
    Desempeño Diario
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
<style type="text/css">

</style>

</head>
  
<body id="body">
  <div class="wrapper ">
    <?php include('views/menuaside.1.php');?>
    <div class="main-panel">
      <!-- Navbar -->
    <?php include('views/menunav.php');?>
      <!-- End Navbar -->

      <div class="content">
        <div class="row" style="height: 20px;"></div>

        <div class="card card-stats">
          <div class="card-body ">
            <div class="row">
              <div class="col-5 col-md-4">
                <div class="icon-big text-center icon-warning">
                    <img src="<?= $infoPostConsultoria[0]['picture']?>" >
                </div>
              </div>
              <div class="col-7 col-md-8">
                <div class="text-right">
                  <p class="">Página:  <?= $reportePostConsultoria->page_name?></p>
                  <p class="">Creador:  <?= $infoPostConsultoria[0]['admin_creator']?></p>
                  <p class="">Status de Promoción:  <?= $infoPostConsultoria[0]['promotion_status']?></p>
                  <p class="">Tipo:  <?= tipoPostSpanish($infoPostConsultoria[0]['type'])?></p>
                  <p class="">Fecha de creación:  <?= date("Y-m-d", formatZonaHoraria($infoPostConsultoria[0]['created_time']))?></p>
                  <p class="">Hora:  <?= date("H:i", formatZonaHoraria($infoPostConsultoria[0]['created_time']))?></p>
                  <p class="">Día:  <?= diaSpanish(date("w",formatZonaHoraria($infoPostConsultoria[0]['created_time'])))?></p>
                  <p class="card-category">Mensaje:  <?= $infoPostConsultoria[0]['message']?></p>
                  <p class="card-category"><a href="<?= $infoPostConsultoria[0]['permalink_url']?>" target="_blank">Ver Post</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>   

        <div class="">
            <div class="card card-stats">
              <div class="card-header ">
                <h6>Indicadores e Índices</h6>
              </div>
              <div class="card-body ">
                  <div class="row  rowform">
                    <div class="col">
                        <div class="row">
                            <label class="col-md-3">Indicadores</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select class="form-control selectpicker" data-style="btn btn-success btn-round" id="showgraphby" name="showgraphby">
                                    <option value="">Todos</option>
                                    <?php foreach($kpisFacebook as $kpi): ?>
                                        <?php if(!in_array($kpi['id'],[45,46,47,48,49,50,52,53])): ?>
                                        <option value="<?= $kpi['id']?>"><?= $kpi['nombre']?></option>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <label class="col-md-3">Rangos</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select class="form-control selectpicker" data-style="btn btn-success btn-round" id="rango" name="rango">
                                    <option value="<?= count($infoHistPostConsultoria)+1;?>">Histórico</option>
                                    <option value="7">7 Días</option>
                                    <option value="15">15 Días</option>
                                    <option value="30">30 Días</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col"></div>
                  </div> 
              </div>
              <div class="card-footer ">
              </div>
            </div>
          </div>
        <div id="grafica_info_post" class="card" ></div>
        <div class="row">
            <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Desempeño</h4>
              </div>
              <div class="card-body">
                <div class="table" id="desempenioTable">
                </div>
              </div>
            </div>
            </div>
        </div>
        <div class="row">
            <?php include('views/pie-pagina.php'); ?>
        </div>
      </div>
    </div>
  </div>

    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery.min.js"></script>
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
    var AllInfo = <?= json_encode($infoHistPostConsultoria)?>;
</script>
<script src="js/post-desempeno-dia.js"></script>
</body>
</html>