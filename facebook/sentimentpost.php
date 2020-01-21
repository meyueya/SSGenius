<?php
session_start();
include('controller/funcionesFormat.php');
define("NIVEL_MIN_PERMISO",1);
require_once('controller/user.php');
include('../model/SistemaSentimentValoradorModel.php');
include('../model/ReportePostConsultoriaModel.php');
$sistemaSentiment = new SistemaSentimentValoradorModel;
$reportePostConsultoria = new ReportePostConsultoriaModel;
$post_id=$_GET['postid'];
$psid = (isset($_GET['psid'])) ? $_GET['psid'] : null ;
$reportePostConsultoria->setPageName($psid);
$infoPostConsultoria = $reportePostConsultoria->getInfoPost($post_id);
$infoCommentsPost = $sistemaSentiment->getInfoCommentSentimentPost($post_id);
$cantComentariosTotales = $sistemaSentiment->getCantAllCommentPost($post_id);
$cantComentariosSentiment = $sistemaSentiment->getCantCommentSentimentPost($post_id);
$infoComentariosPositivos = $sistemaSentiment->getCantCommentSentimentPositivePost($post_id);
$cantComentariosPositivos = count($infoComentariosPositivos);
$infoComentariosNegativos = $sistemaSentiment->getCantCommentSentimentNegativePost($post_id);
$cantComentariosNegativos = count($infoComentariosNegativos);

//var_dump($infoCommentsPost);die;
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
                    <img src="<?= $infoPostConsultoria[0]['picture']?>" >
                </div>
              </div>
              <div class="col-7 col-md-8">
                <div class="text-right">
                  <p class="">Página:  <?= $reportePostConsultoria->page_name?></p>
                  <p class="">Comentarios totales:  <?= $cantComentariosTotales?></p>
                  <p class="">Comentarios analizados:  <?= $cantComentariosSentiment?></p>
                  <p class="">comentarios sentiment positivo:  <?= $cantComentariosPositivos?></p>
                  <p class="">comentarios sentiment negativo:  <?= $cantComentariosNegativos?></p>
                  <p class="">sentiment total promedio:  <?= number_format(getAverage($infoCommentsPost),1)?></p>
                  <p class="">sentiment positivo promedio:  <?= number_format(getAverage($infoComentariosPositivos),1)?></p>
                  <p class="">sentiment negativo promedio:  <?= number_format(getAverage($infoComentariosNegativos),1)?></p>
                  <p class="card-category">Mensaje:  <?= $infoPostConsultoria[0]['message']?></p>
                  <p class="card-category"><a href="<?= $infoPostConsultoria[0]['permalink_url']?>" target="_blank">Ver Post</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card card-stats">
          <div class="card-body ">
          <div class="row">
            <div class="col"><h5 class="card-title">Comentarios</h5></div>
            <div class="col text-left">
              <?php if($cantComentariosTotales>$cantComentariosSentiment):?>  
              <form id="post_sin_analizar" method="post" action="controller/sistemaSentimentValoradorController.php">
                            <input type="hidden" name="insert_sentiment_post_id" value="<?= $post_id?>">
                            <input type="submit" value="Analizar Comentarios Faltantes (<?= $cantComentariosTotales-$cantComentariosSentiment?>)"> 
                          </form>  
              <?php endif?>  
            </div>
          </div>
          <div class="row">
              <table id="example1" class="cell-border compact stripe">
                <thead style="text-align: center;">
                <tr>
                  <th> Comentario </th> 
                  <th> Valor</th>
                  <th> Coincidencias</th>
                </tr>
                </thead>
                 <tbody>
                  <?php foreach ($infoCommentsPost as $key => $value): ?>
                    <tr data-id=<?= $value['id']?>>   
                      <td class="nombre"><?= $value['message'];?></td>
                      <?php if ($value['valor']==null && $value['coincidencias']==null): ?>
                        <td class="grupo">Sin sentiment</td> 
                        <td class="status">
                          <form id="post_<?= $value['id']?>" method="post" action="controller/sistemaSentimentValoradorController.php">
                            <input type="hidden" name="insert_sentiment_coment_id" value="<?= $value['id']?>">
                            <input type="submit" value="Analizar"> 
                          </form>  
                        </td> 
                      <?php elseif($value['valor']==null && $value['coincidencias']=='[]'): ?>
                      <form method="POST" action="controller/sistemaSentimentValoradorController.php">
                        <td class="grupo">
                          <input type="hidden" name="insert_sentiment_manually_coment_id" value="<?= $value['id']?>">
                          <input type="number" class="form-control" name="valor" min="-5" max="5" step="1" placeholder="" required> 
                        </td> 
                        <td class="status">
                          <button type="submit" class="btn btn-fill btn-rose">Valorar<div class="ripple-container"></div></button> 
                        </td> 
                        </form>
                      <?php else: ?>
                        <td class="grupo"><?= $value['valor'];?></td> 
                        <td class="status"><?= count(json_decode($value['coincidencias']));?></td> 
                      <?php endif ?>
                      <!-- <td class="text-center">
                      <button type="button" rel="tooltip" class="btn btn-primary" >
                              <i class="material-icons">edit</i>
                      </button>    
                      <button type="button" rel="tooltip" class="btn btn-danger">
                              <i class="material-icons">delete</i>
                      </button>    
                      </td> -->
                    </tr>
                  <?php endforeach?>               
                </tbody> 
              </table>
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
$(document).ready(function() {/* if (dTable instanceof $.fn.dataTable.Api) {
     $('#dvLoading').fadeIn(800); 
} else {
    $('#dvLoading').fadeOut(800); 
} */
  var dTable = $('#example1').DataTable({
    dom: 'Bfrtip',
    processing: true,
    "fnInitComplete": function(oSettings, json) {
      $('#dvLoading').fadeOut(800); 
    },
     columnDefs: [
    {
        targets: [ -1, -2,-3],
        className: 'dt-body-left'
    }
  ],
    pageLength: 15,
    buttons: [/* {
      extend: 'pdf',
      title: 'Reporte Informes',
      filename: 'reporteinformes'
    } */],
    language: {
            search: "Buscar",
            emptyTable: "Sin Criterios de Catalogación!!",
            infoEmpty: "Mostrando 0 to 0 of 0 Entradas",
            lengthMenu: "Mostrar _MENU_ Entradas",
            loadingRecords: "Cargando...",
            processing: "Procesando...",
            infoFiltered: "(Filtrado de _MAX_ total entradas)",
            info: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            zeroRecords: "Sin resultados encontrados",
            paginate: {
                first:      "Inicio",
                previous:   "Anterior",
                next:       "Siguiente",
                last:       "Anterior"
            }
            
            }
  });
});
</script>

</body>
</html>