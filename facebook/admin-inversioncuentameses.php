<?php
session_start();
define("NIVEL_MIN_PERMISO",4);
require_once('controller/user.php');
require_once('controller/funcionesFormat.php');
include('../model/InversioncuentamesesModel.php');
$catalogar= new InversioncuentamesesModel;
$filtros=[
    'id_page'=>$_GET['psid'],
    'id_adaccount'=>$_GET['id_adaccount'],
];
$info_inversion_meses= $catalogar->getInfoInversionMesesCuenta($filtros);
if(isset($pages)){
    foreach($pages as $page){
        if($page["id_facebook_page"]==$_SESSION['psid']){
            $nombre_pagina=$page['name'];
        }
    }
}
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
    Inversión Meses
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
      <!-- <div class="panel-header panel-header-sm">
  
        
      <div class="content">
        <form id="miform" method="post" name="miform" action="reportegoogle.php">
           <div class="col-md-12">
            <div class="card">

</div> -->
      <div class="content">
            <div class="row" style="height: 20px;"></div>
        <div class="col-md-12">
            <div class="card">
            <div class="container-fluid" >
                <div class="row">
                    <div style="margin-top: 15px;" class="col-6 text-center">
                        <?= $nombre_pagina ?>
                    </div>
                    <div class="col-6 text-right">
                        <button style="margin-top: 15px; margin-right: 30px;" class="btn btn-success btn-round btn-icon btn-sm" onclick="newRecord()">
                            <i class="nc-icon nc-simple-add"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
        <form id="miform" method="post" name="miform" action="reportegoogle.php">
                <div class="table-responsive">
            <table id="example1" class="cell-border compact stripe">
                <thead style="text-align: center;">
                <tr>
                  <th> mes </th> 
                  <th> año</th>
                  <th> Cantidad</th>
                  <th> Accion</th>
                </tr>
                </thead>
                 <tbody>
                <?php foreach ($info_inversion_meses as $key => $value): ?>
                <tr data-id=<?= $value['id']?>>   
                    <td class="mes"><?= mesSpanish(substr($value['fecha'],5,2));?></td>
                    <td class="anio"><?= substr($value['fecha'],0,4);?></td> 
                    <td class="cantidad"><?= $value['cantidad'];?></td> 
                    <td class="text-center">
                    <button type="button" rel="tooltip" class="btn btn-primary" onclick=updateRecord(<?= $value['id']?>)>
                            <i class="material-icons">edit</i>
                    </button>    
                    <button type="button" rel="tooltip" class="btn btn-danger" onclick=deleteRecord(<?= $value['id']?>)>
                            <i class="material-icons">delete</i>
                    </button>    
                    </td>
                </tr>
                <?php endforeach?>               
                </tbody> 
              </table>
                </div>
              </div>
            </div>
        </div>
</form>

<!-- add Modal -->

<div class="modal fade" id="addRecord" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-signup" role="document">
      <div class="modal-content">
        <div class="card card-signup card-plain">
          <div class="modal-header">
            <div class="row">
                <div class="col">
                    <h5 class="modal-title card-title">Crear Registro</h5>
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
                  <form method="POST" action="controller/inversioncuentamesesController.php">
                        <div class="form-group">
                          <input type="hidden" class="form-control" name="page_id_create" value="<?= $_GET['psid']?>" > 
                          <input type="hidden" class="form-control" name="id_adaccount" value="<?= $_GET['id_adaccount']?>" > 
                        </div>
                        <div class="row">
                            <div class="col-md-6 ml-auto">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">MES</label>
                                    <select class="form-control selectpicker" data-style="btn btn-link" name="mes" required>
                                        <option value=""></option>
                                        <option value="01">Enero</option>
                                        <option value="02">Febrero</option>               
                                        <option value="03">Marzo</option>               
                                        <option value="04">Abril</option>               
                                        <option value="05">Mayo</option>               
                                        <option value="06">Junio</option>               
                                        <option value="07">Julio</option>               
                                        <option value="08">Agosto</option>               
                                        <option value="09">Septiembre</option>               
                                        <option value="10">Octubre</option>               
                                        <option value="11">Noviembre</option>               
                                        <option value="12">Diciembre</option>               
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 ml-auto">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Año</label>
                                    <input type="number" step="1" name="anio" value="<?= date('Y');?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Cantidad</label>
                                <input type="number" step="any" name="cantidad">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-fill btn-rose">Registrar<div class="ripple-container"></div></button> 
                    </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!--  Modal --> 
<!-- update Modal -->

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
                  <form method="POST" action="controller/inversioncuentamesesController.php">
                      <input type="hidden" name="id_update" id='update'>
                      <input type="hidden" class="form-control" name="page_id" value="<?= $_GET['psid']?>" > 
                          <input type="hidden" class="form-control" name="id_adaccount" value="<?= $_GET['id_adaccount']?>" >      
                          <div class="row">
                            <div class="col-md-6 ml-auto">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">MES</label>
                                    <select class="form-control selectpicker" data-style="btn btn-link" name="mes" id="update_mes" required>
                                        <option value=""></option>
                                        <option value="01">Enero</option>
                                        <option value="02">Febrero</option>               
                                        <option value="03">Marzo</option>               
                                        <option value="04">Abril</option>               
                                        <option value="05">Mayo</option>               
                                        <option value="06">Junio</option>               
                                        <option value="07">Julio</option>               
                                        <option value="08">Agosto</option>               
                                        <option value="09">Septiembre</option>               
                                        <option value="10">Octubre</option>               
                                        <option value="11">Noviembre</option>               
                                        <option value="12">Diciembre</option>               
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 ml-auto">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Año</label>
                                    <input type="number" step="1" name="anio" id="update_anio" value="<?= date('Y');?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Cantidad</label>
                                <input type="number" step="any" name="cantidad" id="update_cantidad">
                            </div>
                        </div>              
                      <button type="submit" class="btn btn-fill btn-primary">Actualizar<div class="ripple-container"></div></button>
                    </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!--  Modal -->



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
        targets: [ -1, -2,-3,-4],
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
            emptyTable: "sin registros",
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
            text: 'esta accion no s epodrá deshacer',
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
                url: 'controller/inversioncuentamesesController.php',
                data: {'id_value_inversion_delete':id},
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
    $('#update_mes').val($("[data-id='"+id+"'] >.mes").html() ).change();
    $('#update_anio').val($("[data-id='"+id+"'] >.anio").html() );
    $('#update_cantidad').val($("[data-id='"+id+"'] >.cantidad").html() );
    $('#updateRecord').modal();
}
$('#cataloging').addClass("active");
$('#cataloging_examples').addClass("show");
$('#admin_cataloging').addClass("active");

</script>
</body>


<!-- Mirrored from demos.creative-tim.com/paper-dashboard-2-pro/examples/components/panels.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Aug 2018 16:06:47 GMT -->
</html>