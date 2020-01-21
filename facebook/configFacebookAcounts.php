<?php
session_start();
define("NIVEL_MIN_PERMISO",4);
require_once('controller/user.php');
include('../model/ConfigurarPageFacebookSSGModel.php');

$config_face_ssg= new ConfigurarPageFacebookSSGModel;
$paginas_ssg= new ConfigurarPageFacebookSSGModel;
$paginas_configuradas= $config_face_ssg->getPaginasConfiguradas();
$paginas_ssg= $config_face_ssg->getValuesPaginasConfiguradas();
//$aiw_ssg= $config_face_ssg->updateFacebookAiw();
 //var_dump("$paginas_ssg");die;
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

</style>

</head>

<body id="body">

  <!-- End Google Tag Manager (noscript) -->
  <div class="wrapper ">
    
 <?php include('views/menuaside.1.php');?>


  <div class="main-panel">
       <!-- Navbar -->
    <?php include('views/menunav.php');?>
 
      <div class="content">
            <div class="row" style="height: 20px;"></div>
        <div class="col-md-12">
            <div class="card">
            <div class="container-fluid" >
                <div class="row">
                    <div style="margin-top: 15px;" class="col-6 text-center">
                    </div>
                    <div class="col-6 text-right">
                        <a href="#">
                            <button style="margin-top: 15px; margin-right: 30px;" class="btn btn-info btn-round btn-icon btn-sm" onclick="ir()">
                                <i class="fa fa-refresh"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
        <form id="miform" method="post" name="miform" action="controller/UpdateFacebookAiwController.php">
                <div class="table-responsive">
            <table id="example1" class="cell-border compact stripe">
                <thead style="text-align: center;">
                <tr>
                  <th> ID General </th>
                  <th> ID Cuenta </th> 
                  <th> Nombre de la Cuenta </th> 
                  <th> Aprobar AIW</th>
                  <th> Estatus</th>
                </tr>
                </thead>
                 <tbody>
                 
                        <?php foreach ($paginas_ssg as $key => $pagina):
                    //   echo('<pre>');
                    //     var_dump($pagina['aiw_status']);
                    //     var_dump($value['nombre']);
                    //     echo('</pre>');
                ?>
                <tr data-id=<?= $pagina['id_adaccount']?>>
                    <td class="adaccount_id"> <?= $pagina['id_adaccount'];?></td>   
                    <td class="facebook_id"> <?= $pagina['id_facebook'];?></td>
                    <td class="nombre">  <?= $pagina['adaccount_name'];?> </td> 
                    <td class="aiw text-center">
                        
                    <?php
                      if  ($pagina['aiw_status'] == '0'):?>
                            
                            <button type="button" rel="tooltip" class="btn btn-outline-danger btn-sm center" onclick=updateRecordaiw(<?= $pagina['id_adaccount']?>)>
                            <i class="material-icons"> Desactivado</i>
                            </button>
                    <?php
                        elseif  ($pagina['aiw_status'] != '0'):?>
                            
                            <button type="button" rel="tooltip" class="btn btn-outline-success btn-sm center" onclick=updateRecordaiw(<?= $pagina['id_adaccount']?>)>
                            <i class="material-icons">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Activo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>
                            </button> 
                       <?php endif?> 
                     <!--<div class="col-md-8">-->
                       <!--<p style="margin-bottom: 0px;" class="category">Activar AIW</p>-->
                     <!--  <input class="bootstrap-switch" type="checkbox" value="<?= $pagina['id_adaccount'];?>" name="<?= $pagina['id_adaccount'];?>" -->
                     <!--  data-toggle="switch" data-on-label="<i class='nc-icon nc-check-2'></i>" -->
                     <!--  data-off-label="<i class='nc-icon nc-simple-remove'></i>" -->
                     <!--  data-on-color="success" data-off-color="success" />-->
                     <!--</div>-->
                          
                    </td>
                    <td class="estado de la cuenta text-center">
                        
                      <?php
                      if  ($pagina['adaccount_status'] == 'Activa'):?>
                        
                            <button type="button" rel="tooltip" class="btn btn-primary" onclick=updateRecord(<?= $pagina['id_adaccount']?>)>
                            <i class="material-icons"> <?= $pagina['adaccount_status']?></i>
                            </button> 
                            
                    <?php 
                    elseif  ($pagina['adaccount_status'] == 'Deshabilitada'):?>
                    
                         <button type="button" rel="tooltip" class="btn btn-info" onclick=updateRecord(<?= $pagina['id_adaccount']?>)>
                        <i class="material-icons"> <?= $pagina['adaccount_status']?></i>
                        </button> 
                       
                     <?php   
                       elseif  ($pagina['adaccount_status'] == 'Cerrada'):?>
                        
                             <button type="button" rel="tooltip" class="btn btn-danger" onclick=updateRecord(<?= $pagina['id_adaccount']?>)>
                            <i class="material-icons"> <?= $pagina['adaccount_status']?></i>
                            </button> 
                      
                       <?php   
                       elseif  ($pagina['adaccount_status'] == 'Inestable'):?>
                        
                             <button type="button" rel="tooltip" class="btn btn-warning" onclick=updateRecord(<?= $pagina['id_adaccount']?>)>
                            <i class="material-icons"> <?= $pagina['adaccount_status']?></i>
                            </button> 
                       
                      <?php endif?>
                    </td>
                </tr>
                
                    <?php endforeach?>
                </tbody> 
              </table>
              <?php // var_dump( $informes) ?>
        </div>
              </div>
            </div>
          </div>
</form>

<!-- update Modal Estatus de la AIW-->

        <div class="modal fade" id="updateRecordaiw" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-signup" role="document">
              <div class="modal-content">
                <div class="card card-signup card-plain">
                  <div class="modal-header">
                    <div class="row">
                       <div class="col">
                            <h5 class="modal-title card-title">Actualizar registro</h5>
                        </div>
                        <div class="col text-right">
                            <i class="nc-icon nc-simple-remove">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                            </i>
                        </div>
                    </div>
                  </div>
                                             
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-12 ml-auto">
                          <form method="POST" action="controller/ActivateSsgOnAiwController.php">
                              <input type="hidden" name="id_adaccount" id='aiw_update'>
                              <input type="hidden" name="config_page_super_admin" value="true">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect">El Estado Actual de la Cuenta Es   <?= $pagina['aiw_status'];?></label>
                                    <select class="form-control selectpicker" data-style="btn btn-link" name="aiw_status" required>
                                        <option value="2">Activa</option>
                                        <option value="0">Desactivada</option>
                                    </select>
                                </div>
                              <button name ="" type="submit" class="btn btn-fill btn-primary">Actualizar<div class="ripple-container"></div></button>
                            </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
         </div>
        

<!-- update Modal Estatus de la cuenta-->

        <div class="modal fade" id="updateRecord" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-signup" role="document">
              <div class="modal-content">
                <div class="card card-signup card-plain">
                  <div class="modal-header">
                    <div class="row">
                        <div class="col">
                            <h5 class="modal-title card-title">Actualizar registro</h5>
                        </div>
                        <div class="col text-right">
                            <i class="nc-icon nc-simple-remove">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                            </i>
                        </div>
                    </div>
                  </div>
                                             
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-12 ml-auto">
                          <form method="POST" action="controller/UpdateFacebookAiwController.php">
                              <input type="hidden" name="id_adaccount" id='update'>
                              <input type="hidden" name="config_page_super_admin" value="true">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">El Estado Actual de la Cuenta Es  <?= $pagina['aiw_status'];?></label>
                                    <select class="form-control selectpicker" data-style="btn btn-link" name="status" required>
                                        <option value="Activa">Activa</option>
                                        <option value="Deshabilitada">Deshabilitada</option>
                                        <option value="Inestable">Inestable</option>
                                        <option value="Cerrada">Cerrada</option>
                                    </select>
                                </div>
                              <button name ="" type="submit" class="btn btn-fill btn-primary">Actualizar<div class="ripple-container"></div></button>
                              
                            </form>
                      </div>
                    </div>
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
    function ir(){
   window.location="CronJobs/aiwfacebookinicial200dias.php";
   window.location="./configFacebookAcounts.php";//pagina donde tienes tus consultas para borrar 
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

function newRecord(){
        $('#addRecordaiw').modal();
    }
function updateRecordaiw(id){
    $('#aiw_update').val(id);
    $('#update_aiw_status').val($("[data-id='"+id+"'] >.aiw_status").html() ).change();
    $('#updateRecordaiw').modal();
}

</script>
</body>


<!-- Mirrored from demos.creative-tim.com/paper-dashboard-2-pro/examples/components/panels.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Aug 2018 16:06:47 GMT -->
</html>
