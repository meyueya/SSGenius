<?php
//require_once('../controller/funcionesFormat.php');
require_once('../../model/ReportekpisModel.php');
$reportekpis= new  ReportekpisModel;
$infoRecibida=$_POST;
var_dump($infoRecibida);
$otros_kpis_seleccionados=json_decode($infoRecibida['kpis_seleccionados']);
var_dump($otros_kpis_seleccionados[0]);
$cadenaBusquedaIN="";
foreach ($infoRecibida['post'] as $key => $value) {
  $cadenaBusquedaIN .="'".$value."',";
}
$cadenaBusquedaIN =rtrim($cadenaBusquedaIN, ",");
$infoPosts=$reportekpis->getInfoPosts($cadenaBusquedaIN);



include('../../model/KpiFacebookModel.php');
$kpiFace = new KpiFacebookModel;

$kpiFace->setEntityInfo($infoPosts); 


//$kpiFace->setInfoAllKpis();
//$kpiFace->setInfokpiPrincipal($kpiFace->infokpiReach);
//$kpiFace->setInfoCostokpiPrincipalByAction();

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
echo "</pre>";
?><?php
/* session_start();
include('controller/funcionesFormat.php');
define("NIVEL_MIN_PERMISO",2);
require_once('controller/user.php');
include('../model/ReportePostConsultoriaModel.php');
 include('../model/KpiFacebookModel.php');
$kpiFace = new KpiFacebookModel;
$kpiFace->setEntityInfo($_GET['postid']);
$kpiFace->setInfoAllKpis();
$kpiFace->setInfokpiPrincipal($kpiFace->infokpiReach);
$kpiFace->setInfoCostokpiPrincipalByAction(); 
 
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
echo "</pre>"; 
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
*/
$arrayfilasTabla=$otros_kpis_seleccionados;

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
  <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../../assets/css/paper-dashboard.min790f.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../../assets/demo/demo.css" rel="stylesheet" />
       <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
       <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
       <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
       <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
       <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.css" rel="stylesheet" />
       <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.css" rel="stylesheet" />
       <link href="../dist/css/mod.css" rel="stylesheet" />
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
        <div class="row">
            <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Simple Table</h4>
              </div>
              <div class="card-body">
                <div class="table">
                    <table class="table table-striped">
                        <tr>
                            <th scope="col"><?= $infoRecibida['kpi_principal']?></th>                            
                            <!-- <?php foreach ($infoHistPostConsultoria as $value):?>
                                <td><?= $value[$key]?></td>
                            <?php endforeach?> -->
                        </tr>
                        <?php foreach ($arrayfilasTabla as $key => $fila):?>
                        <tr>
                            <th scope="col"><?= $fila->nombre?></th>                            
                            <!-- <?php foreach ($infoHistPostConsultoria as $value):?>
                                <td><?= $value[$key]?></td>
                            <?php endforeach?> -->
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
  
</body>
</html>