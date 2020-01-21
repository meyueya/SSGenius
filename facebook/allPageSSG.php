<?php
session_start();
define("NIVEL_MIN_PERMISO",4);
require_once('controller/user.php');
include('../model/ConfigurarPageFacebookSSGModel.php');
include('../model/SistemaSentimentValoradorModel.php');
$config_face_ssg= new ConfigurarPageFacebookSSGModel;
$sistemaSentiment= new SistemaSentimentValoradorModel;
$paginas_ssg= $config_face_ssg->getAllPageSSG();
$paginas_con_sentiment= $sistemaSentiment->getPageWithSentiment();
//para activar el sentiment
$fecha_actual = date("Y-m-d");
//resto 1 día
$ayer = date("Y-m-d",strtotime($fecha_actual."- 1 days")); 
//resto 2 día
$antesDeAyer = date("Y-m-d",strtotime($fecha_actual."- 2 days"));
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
    Paginas configuradas ssg
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
       <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
       <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
       <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.css" rel="stylesheet" />
       <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.css" rel="stylesheet" />
       <link href="./dist/css/mod.css" rel="stylesheet" />
<style type="text/css">




  ._mB {
    background-color: #efc439;
    border-radius: 2px;
    color: #fff;
    display: inline-block;
    font-size: 12px;
    padding: 0 2px;
    line-height: 14px;
    vertical-align: baseline;
  }

  ._mB_green {
    background-color: #59946B;
    border-radius: 2px;
    color: #fff;
    display: inline-block;
    font-size: 12px;
    padding: 0 2px;
    line-height: 14px;
    vertical-align: baseline;
  }


  a.headline {
    color:#1a0dab;
  }

  a.headline {
    font-size:18px;
    font-weight: normal;
  }

  a.headline:hover {
    color:#1a0dab;
  }


  div.urlline {
    margin-top:-4px;
    margin-bottom:0px;
  }

  span.displayurl {
    color:#006621;
    font-size:14px;
    margin-left:2px;
  }

  span.callextension {
    color: #545454;
    font-size: small;
    margin-left: 8px;
  }

  span.description {
    font-size:small;
    color:#545454;

  }
  .preview{
        margin-bottom: 12px;
  }
  .preview:before{
        content: attr(data-id)" - ";
        position: absolute;
        font-size: 19px;
        left: 17px;
        color: #868383;
        }

  /*img.imgface  {
      border-radius: 10px !important;
      width: 81px !important;
  }

  .cont{
    font-size: 16px;
  }*/
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
            <div class="row" style="height: 20px;"></div>
        <div class="col-md-12">
            <div class="card">
            <div class="container-fluid" >
                <div class="row">
                    <div style="margin-top: 15px;" class="col-6 text-center">
                    </div>
                    <div class="col-6 text-right">
                        <!-- <a href="configuracion_page_facebook_ssg.php">
                            <button style="margin-top: 15px; margin-right: 30px;" class="btn btn-success btn-round btn-icon btn-sm">
                                <i class="nc-icon nc-simple-add"></i>
                            </button>
                        </a> -->
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
            <table id="example1" class="cell-border compact stripe">
                <thead style="text-align: center;">
                    <tr>
                    <th> Imagen</th>
                    <th> Nombre </th> 
                    <th> ID </th> 
                    <th> Categoría</th>
                    <th> Creación</th>
                    <th> tiene Post?</th>
                    <th> Cant de Post</th>
                    <th> Primer Post</th>
                    <th> Último Post</th>
                    <th> Accion</th>
                    </tr>
                </thead>
                 <tbody>
                 
                <?php foreach ($paginas_ssg as $key => $pagina): ?>
                <tr data-id=<?= $pagina['id_facebook_page']?>>
                    <td class="text-center" ><img src="https://graph.facebook.com/<?php echo $pagina['id_facebook_page']; ?>/picture"></td> 
                    <td ><a href="index.php?psid=<?= $pagina['id_facebook_page'];?>"><?= $pagina['name'];?></a></td>
                    <td ><?= $pagina['id_facebook_page'];?></td>
                    <td ><?= $pagina['category'];?></td>
                    <td ><?= $pagina['created_time'];?></td>
                    <td ><?= $pagina['data_state'];?></td>
                    <td ><?= $pagina['cant_post'];?></td>
                    <td ><?= substr($pagina['fecha_primer_post'], 0, 10);?></td>
                    <td ><?= substr($pagina['fecha_ultimo_post'], 0, 10);?></td>
                    <td>
                 </div
                        <?php $tienesentiment=false;
                        foreach ($paginas_con_sentiment as $key => $value): ?>
                            <?php if ($pagina['id_facebook_page']==$value['page_id']): ?>
                                <a href="sistema-sentiment-valorador.php?psid=<?= $pagina['id_facebook_page']?>" class="btn btn-info">ver sentiment</a>
                            <?php  $tienesentiment=true; break;
                            endif ?>
                        <?php endforeach ?>
                        <?php if (!$tienesentiment): ?>
                            <form id="page_<?= $pagina['id_facebook_page']?>" method="post" action="controller/sistemaSentimentValoradorController.php">
                                <input type="hidden" name="insert_sentiment_id" value="<?= $pagina['id_facebook_page']?>">
                                <input type="hidden" name="desde" value="<?= $antesDeAyer?>">
                                <input type="hidden" name="hasta" value="<?= $ayer?>">
                                <input type="submit" value="Activar Sentiment"> 
                            </form>  
                        <?php endif ?>
                    </td>
                </tr>
                <?php endforeach?>               
                </tbody> 
              </table>
</div>
              </div>
            </div>
          </div>
        </div>
        <?php include('views/pie-pagina.php'); ?>
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

  
 
<script>
$('#config_page').addClass("active");
$('#config_page_examples').addClass("show");
$('#all_page_ssg').addClass("active");

$(document).ready(function() {if (dTable instanceof $.fn.dataTable.Api) {
     $('#dvLoading').fadeIn(800); 
} else {
    $('#dvLoading').fadeOut(800); 
}
  var dTable = $('#example1').DataTable({
    dom: 'Bfrtip',
    processing: true,
    "fnInitComplete": function(oSettings, json) {
      $('#dvLoading').fadeOut(800); 
    },
     columnDefs: [
    {
        targets: [ -1, -2,-3],
        className: 'dt-body-right'
    }
  ],
    pageLength: 15,
    buttons: [{
      extend: 'pdf',
      title: 'Reporte Informes',
      filename: 'reporteinformes'
    }],
    language: {
            search: "Buscar",
            emptyTable: "ninguna página con valores de configuración!!",
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


    function deleteRecord(id) {
        swal({
            title: '¿Estas seguro de eliminar este elemento?',
            text: '¡Estas a punto de eliminar toda la configuración para esta página!',
            type: 'warning',
            showCancelButton: true, 
            confirmButtonText: 'Si, estoy seguro',
            cancelButtonText: 'No',
            confirmButtonClass: "btn btn-success",
            cancelButtonClass: "btn btn-danger",
            buttonsStyling: false
        }).then(function() {
            $.ajax({
                type: "post",
                url: 'controller/procesarconfigpagefacebook.php',
                data: {'page_id_delete':id},
                success: function(result){
                $('tr[data-id="'+id+'"]').fadeOut('slow','swing');
                swal({
                    title: '¡Éxito!',
                    text: result,
                    type: 'success',
                    confirmButtonClass: "btn btn-success",
                    buttonsStyling: false
                }).catch(swal.noop)
        }
            });
            
        }, function(dismiss) {
            // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
            if (dismiss === 'cancel') {
                swal({
                    title: 'Cancelado',
                    text: '',
                    type: 'info',
                    confirmButtonClass: "btn btn-info",
                    buttonsStyling: false
                }).catch(swal.noop)
            }
        })
    }

function newRecord(){
        $('#addRecord').modal();
    }
function updateRecord(id){
    $('#update').val(id);
    $('#update_nombre').val($("[data-id='"+id+"'] >.nombre").html() );
    $('#update_grupo').val($("[data-id='"+id+"'] >.grupo").html() ).change();
    $('#update_status').val($("[data-id='"+id+"'] >.status").html() ).change();
    $('#updateRecord').modal();
}

</script>
</body>


<!-- Mirrored from demos.creative-tim.com/paper-dashboard-2-pro/examples/components/panels.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Aug 2018 16:06:47 GMT -->
</html>
