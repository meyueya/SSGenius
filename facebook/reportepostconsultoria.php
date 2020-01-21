<?php
session_start();
include('controller/funcionesFormat.php');
define("NIVEL_MIN_PERMISO",2);
require_once('controller/user.php');
include('../model/ReportePostConsultoriaModel.php');
/* include('../model/KpiFacebookModel.php');
$kpiFace = new KpiFacebookModel;
$kpiFace->setEntityInfo($_GET['postid']);
$kpiFace->setInfoAllKpis();
$kpiFace->setInfokpiPrincipal($kpiFace->infokpiReach);
$kpiFace->setInfoCostokpiPrincipalByAction(); */
/* 
echo "<pre>";
//var_dump($kpiFace->entityAllInfoKpi);
//var_dump($kpiFace->infokpiShares);
//var_dump($kpiFace->infokpiReactions);
//var_dump($kpiFace->infokpiComments);
//var_dump($kpiFace->infokpiVideosViews);
//var_dump($kpiFace->infokpiLinkClicks);
//var_dump($kpiFace->infokpiReach);
//var_dump($kpiFace->infokpiReachPaid);
//var_dump($kpiFace->infokpiReachOrganic);
//var_dump($kpiFace->infokpiInteractions);
//var_dump($kpiFace->infokpiInvestment);
//var_dump($kpiFace->infokpiInteractionIndex);
//var_dump($kpiFace->infokpiInterAlcanceIndex);
//var_dump($kpiFace->infokpiInteractionInvestmentIndex);
//var_dump($kpiFace->infokpiInterAlcanceInvestmentIndex);
//var_dump($kpiFace->infokpiPrincipal);
//var_dump($kpiFace->infoCostokpiPrincipalByAction);
echo "</pre>"; */
$psid = (isset($_GET['psid'])) ? $_GET['psid'] : null ;
$id_post = (isset($_GET['postid'])) ? $_GET['postid'] : null ;
$id_consultoria = (isset($_GET['consultoria'])) ? $_GET['consultoria'] : null ;
$id_analisis = (isset($_GET['analisis'])) ? $_GET['analisis'] : null ;
$post_actual = (isset($_GET['post'])) ? $_GET['post'] : null ;
$id_post=$_GET['postid'];
$reportePostConsultoria = new ReportePostConsultoriaModel;
$reportePostConsultoria->setPageName($psid);
$infoConsultoria = $reportePostConsultoria->getInfoConsultoriaYAnalisisPadre($id_analisis,$psid,$id_consultoria);
$infoKpisAnalisisPadre = $reportePostConsultoria->getInfoKpisAnalisisPadre($id_analisis,$psid,$id_consultoria);
$infoPostConsultoria = $reportePostConsultoria->getInfoPost($id_post);
$infoHistPostConsultoria = $reportePostConsultoria->getInfoHistoricoPost($id_post);
$arrayColumnasTabla=array(
    'fecha_historico'=>'fecha',
    'promotion_status'=>'Status de Promoción',
    'reach'=>'Alcance',
    'reach_organic'=>'Alcance Orgánico',
    'reach_paid'=>'Alccance Pagado',
    'comments'=>'Comentarios',
    'reactions'=>'Reacciones',
    'shares'=>'Compartir',
    'post_video_views_unique'=>'Vista de Video',
    'link_clicks'=>'Clic a Link',
    'type'=>'tipo',
    'page_fans'=>'Fans',
    'indice_interaccion'=>'Índice de Interacción',
    'indice_interalcance'=>'Índice de Interalcance',
    'ad_spend'=>'Inversión',
    'indice_interaccion_inversion'=>'Índice de Interacción vs Inversión',
    'indice_interalcance_inversion'=>'Índice de Interalcance vs Inversión',
    'id_adaccount'=>'id_adaccount',
    'creative_id'=>'creative_id',
);

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
    Reporte Informes
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

        <div class="card card-stats">
          <div class="card-body ">
              <div class="row text-center">
                <div class="col-6">Consultoría:     <?= $infoConsultoria[0]['titulo_consultoria']?></div>
                <div class="col-6">Análisis:    <?= $infoConsultoria[0]['titulo_analisis_padre']?></div>
              </div>
              <div class="row text-center">
                  <div class="col-4">Categoría: <?= $reportePostConsultoria->getNombreDeTablaCatalogacion($infoConsultoria[0]['tipo'])?></div>
                  <div class="col-4">Objetivo: <?= $reportePostConsultoria->getNombreDeTablaCatalogacion($infoConsultoria[0]['objetivo'])?></div>
                  <div class="col-4">KPI Principal: <?= $reportePostConsultoria->getNombreDeTablaKPI($infoConsultoria[0]['kpi_principal'])?></div>
              </div>
              <?php if(count($infoKpisAnalisisPadre)):?>
              <div class="row text-center">Otros Kpis Considerados</div>
              <div class="row text-center">
                  <?php foreach($infoKpisAnalisisPadre as $kpi):?>
                  <div class="col-3">Kpi: <?= $reportePostConsultoria->getNombreDeTablaKPI($kpi['kpi'])?></div>
                  <?php endforeach?>
              </div>
              <?php endif?>
          </div>
          <div class="card-footer ">
            <hr>
            <div class="stats">
              <i class="fa fa-calendar-o"></i> Creacion de la consultoría: <?= $infoConsultoria[0]['fecha']?>
            </div>
          </div>
        </div> 
        <div id="grafica_info_post" class="card" ></div>
        <div class="row">
            <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Simple Table</h4>
              </div>
              <div class="card-body">
                <div class="table">
                    <table class="table table-striped">
                        <?php foreach ($arrayColumnasTabla as $key => $columna):?>
                        <tr>
                            <th scope="col"><?= $columna?></th>                            
                            <?php foreach ($infoHistPostConsultoria as $value):?>
                                <td><?= $value[$key]?></td>
                            <?php endforeach?>
                        </tr>
                        <?php endforeach?>
                    </table>
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
    var info_post = <?= json_encode($infoHistPostConsultoria)?>;
</script>
<script src="js/reportepostconsultoria.js"></script>
</body>
</html>