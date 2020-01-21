<?php
session_start();
include('controller/funcionesFormat.php');
define("NIVEL_MIN_PERMISO",1);
require_once('controller/user.php');    
include('../model/SistemaSentimentValoradorModel.php');
$psid = (isset($_GET['psid'])) ? $_GET['psid'] : null ;
$sistemaSentiment = new SistemaSentimentValoradorModel;
$info_page = $sistemaSentiment->getInfoPage($psid);
$info_sentiment_page = $sistemaSentiment->getInfoCommentSentimentPage($psid);
$dias_comentarios_total = get_diff_dias($info_page[0]['first_comment'],$info_page[0]['last_comment']);
$dias_comentarios_sentiment = get_diff_dias($info_sentiment_page[0]['first_comment_with_sentiement'],$info_sentiment_page[0]['last_comment_with_sentiement']);
//para activar el sentiment
$fecha_actual = $info_sentiment_page[0]['first_comment_with_sentiement'];
//resto 11 día
$desde = date("Y-m-d",strtotime($fecha_actual."- 10 days"));
//resto 1 día
$hasta = date("Y-m-d",strtotime($fecha_actual."- 1 days")); 
//var_dump($desde,$hasta);die;
function get_diff_dias($fecha1,$fecha2){
  if( !$fecha1|| !$fecha2){
    return null;
  }
  $date1 = new DateTime($fecha1);
  $date2 = new DateTime($fecha2);
  $diff = $date1->diff($date2);
  $diferencia = $diff->days+1;
  return $diferencia;
}
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
    Sistemas Sentiment
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
                  <img src="https://graph.facebook.com/<?= $info_page[0]['id_facebook_page']; ?>/picture">
                </div>
              </div>
              <div class="col-7 col-md-8">
                <div class="text-right">
                  <p class="">Página:  <?= $info_page[0]['name']?></p>
                  <p class="">Días de comentarios no analizados:  <?= $dias_comentarios_total-$dias_comentarios_sentiment?></p>
                  <p class="">Días de comentarios analizados:  <?= $dias_comentarios_sentiment?></p>
                  <!-- <p class="">Tipo:  <?= tipoPostSpanish($infoPostConsultoria[0]['type'])?></p>
                  <p class="">Fecha de creación:  <?= date("Y-m-d", formatZonaHoraria($infoPostConsultoria[0]['created_time']))?></p>
                  <p class="">Hora:  <?= date("H:i", formatZonaHoraria($infoPostConsultoria[0]['created_time']))?></p>
                  <p class="">Día:  <?= diaSpanish(date("w",formatZonaHoraria($infoPostConsultoria[0]['created_time'])))?></p>
                  <p class="card-category">Mensaje:  <?= $infoPostConsultoria[0]['message']?></p>
                  <p class="card-category"><a href="<?= $infoPostConsultoria[0]['permalink_url']?>" target="_blank">Ver Post</a></p> -->
                </div>
              </div>
            </div>
          </div>
        </div>   
        <div class="row container text-center">
          <?php if(!$dias_comentarios_total):?>
            <div class="col">
              <p>Aun no tienes acceso a este servicio</p>
            </div>
          <?php else:?>
            <div class="col">
              <form  method="post" action="controller/sistemaSentimentValoradorController.php">
                <input type="hidden" name="insert_sentiment_id" value="<?= $psid?>">
                <input type="hidden" name="desde" value="<?= $desde?>">
                <input type="hidden" name="hasta" value="<?= $hasta?>">
                <input type="submit" value="Analizar 10 dias más"> 
              </form>  
            </div>
            <div class="col">
              <form method="post" action="controller/sistemaSentimentValoradorController.php">
                <input type="hidden" name="update_sentiment_id" value="<?= $psid?>">
                <input type="submit" value="Actualizar análisis por cambios en el diccionario"> 
              </form>  
            </div>
          <?php endif?>
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

</script>

</body>
</html>