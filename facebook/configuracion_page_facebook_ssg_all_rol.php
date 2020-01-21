<?php 
session_start();
define("NIVEL_MIN_PERMISO",1);
require_once('controller/user.php');
include('../model/ConfigurarPageFacebookSSGModel.php');
$config_face_ssg= new ConfigurarPageFacebookSSGModel;
$grupos_valores_config= $config_face_ssg->getGruposValoresConfig();
$valores_config= $config_face_ssg->getValoresConfig();
$valores_catalogacion_page= $config_face_ssg->getValuesPaginasConfiguradas($_GET['psid']);
$nombres_valoresconfig=[];
foreach ($valores_config as $value) {
    array_push($nombres_valoresconfig,$value['nombre']);
}
//  echo "<pre>";
// var_dump($grupos_valores_config);
// echo "</pre>";
// die; 
?>

<!DOCTYPE html>
<html  lang="en" dir="ltr">

<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
  
  <link rel="icon" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" sizes="32x32" />
  <link rel="icon" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" sizes="192x192" />
  <!-- <link rel="apple-touch-icon-precomposed" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" /> -->
  <meta name="msapplication-TileImage" content="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" />
  <title>
    SSG
  </title>
  
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
  <!-- <script src="../assets/js/plugins/bootstrap-selectpicker.js"></script> -->


</head>

<body >

  <!-- End Google Tag Manager (noscript) -->
  <div class="wrapper ">
    <?php include('views/menuaside.1.php');?> 
    <?php //var_dump($page);?>
    <div class="main-panel">
      <!-- Navbar -->
    <?php include('views/menunav.php');?>
      <!-- End Navbar -->
       <div class="content">
            <div class="col-md-12">
                    <form method="post" action="controller/procesarconfigpagefacebook.php" id="form_config_page_face" class="form-horizontal">
                <div class="card ">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-4">
                            <!--<input type="text" readonly class="form-control-plaintext" id="page_id" name="page_id_create">-->
                            <input type="hidden"  id="values_catalogacion_page_active" name="values_catalogacion_page_active">
                            <input type="hidden"  id="values_catalogacion_page_inactive" name="values_catalogacion_page_inactive">
                            <input type="hidden"  id="valores_config" name="valores_config">
                            </div>
                            <div class="col-4" id="img_page">
                                
                            </div>
                            <div class="col-4 text-right">
                               <!--  <a style="margin-top: 15px; margin-right: 30px;"  href="allConfigPageFacebook.php" class="btn btn-info btn-sm">
                                        ver configuradas
                                </a> -->
                                <button type="button" class="btn btn-success btn-round btn-icon btn-sm" data-toggle="modal" data-target="#addRecord">
                                    <i class="nc-icon nc-simple-add"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col">
                                            <div class="container-fluid">
                                            <?php foreach ($grupos_valores_config as $array_grupos):?>
                                                <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title"><?= $array_grupos["grupo"]?></h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table">
                                                    <table class="table">
                                                        <thead class="text-primary">
                                                        <tr>
                                                        <th>
                                                            Nombre
                                                        </th>
                                                        <th class="text-center">
                                                            Etiqueta Maestra
                                                        </th>
                                                        <th class="text-center">
                                                            Descripción
                                                        </th>
                                                        <th class="text-center">
                                                            Seleccionados
                                                        </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                    <?php foreach ($valores_config as $array_valores_config):?>
                                                        <?php if($array_valores_config["grupo"] == $array_grupos["grupo"]): ?>
                                                            <tr>
                                                                <td>
                                                                    <?= $array_valores_config['nombre']?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?= $array_valores_config['subgrupo']?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?= $array_valores_config['descripcion']?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <input class="bootstrap-switch  checkbox-form" type="checkbox" value="<?= $array_valores_config['nombre']?>" name="config[<?= $array_valores_config['grupo']?>][<?= $array_valores_config['subgrupo']?>][]" data-toggle="switch" data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success" />
                                                                </td>
                                                            </tr>    
                                                        <?php endif ?>
                                                    <?php endforeach ?>
                                                    <?php foreach ($valores_catalogacion_page as $valor_catalogacion_page):?>
                                                        <!--<?php if( (($array_grupos["grupo"]=='categoria'&& $valor_catalogacion_page["grupo"]=='tipo') || $valor_catalogacion_page["grupo"] == $array_grupos["grupo"]) && !in_array($valor_catalogacion_page['nombre'],$nombres_valoresconfig )): ?>-->
                                                            <tr>
                                                                <td>
                                                                    <?= $valor_catalogacion_page['nombre']?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?= $valor_catalogacion_page['subgrupo']?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?= $valor_catalogacion_page['descripcion']?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <input class="bootstrap-switch  checkbox-form" type="checkbox" value="<?= $valor_catalogacion_page['nombre']?>" name="config[<?= ($valor_catalogacion_page['grupo']!='tipo')?$valor_catalogacion_page['grupo']:'categoria';?>][propios][]" data-toggle="switch" data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success" />
                                                                </td>
                                                            </tr>    
                                                        <!--<?php endif ?>-->
                                                    <?php endforeach ?>
                                                        </tbody>
                                                    </table>
                                                    </div>
                                                </div>
                                                </div>
                                            <?php endforeach ?>
                                            <div class="row">
                                                <input class="boton-enviar btn btn-success" data-submit="<?= $array_no_catalogados['id']?>" type="submit" value="Guardar" >
                                            </div>                          
                                            </div>                  
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                    </div>
                </div>
            </form>
            </div>
       </div>
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
                        <form method="POST" action="controller/procesarvalorescatalogacion.php">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="page_id_create" value="<?= $_GET['psid']?>" > 
                                <label for="exampleFormControlInput1">Nombre</label>
                                <input type="text" class="form-control" name="nombre" placeholder="" required> 
                                </div>
            
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Grupo</label>
                                    <select class="form-control selectpicker" data-style="btn btn-link" name="grupo" required>
                                        <option value=""></option>
                                        <?php foreach ($grupos_valores_config as $key => $value): ?>
                                        <option value="<?= $value['grupo'];?>"><?= $value['grupo'];?></option>
                                        <?php endforeach?>               
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Estado</label>
                                    <select class="form-control selectpicker" data-style="btn btn-link" name="status" required>
                                        <option value=""></option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            <button type="submit" class="btn btn-fill btn-rose">Crear<div class="ripple-container"></div></button> 
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
    </div>
    <?php include('views/pie-pagina.php'); ?>
    </div>
  </div>
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


<script>


$(document).ready( function(){
    
    $("#page_id").change( function(){
        var page_id=$("#page_id").val();
    $("#img_page>*").remove();
    agregarImagenPage("#img_page", page_id)
    });
    

     
    var valoresCatalogacion = <?= json_encode($valores_catalogacion_page) ?>;
    var valores_co = <?= json_encode($valores_config) ?>;
    var values_catalogacion_page_active=[];
    var values_catalogacion_page_inactive=[];
    var valores_config=[];
      $.each(valoresCatalogacion, function(index,value){
           if(value.status == 'active' && (value.grupo != 'kpi' && value.grupo != 'nivelLibertad')){
            values_catalogacion_page_active.push(value.nombre);
          }else if(value.status == 'inactive'){
            values_catalogacion_page_inactive.push(value.nombre);
          }
      });
      $.each(valores_co, function(index,value){
        valores_config.push(value.nombre);
      });
      $('#values_catalogacion_page_active').val(values_catalogacion_page_active);
      $('#values_catalogacion_page_inactive').val(values_catalogacion_page_inactive);
      $('#valores_config').val(valores_config);
      actualizarEstadosCheckbox(values_catalogacion_page_active); 

});
function agregarImagenPage(selector, page_id) {
    $(selector).append("<img src='https://graph.facebook.com/"+page_id+"/picture'>");    
}

function actualizarEstadosCheckbox(infoactual) {
  $('.checkbox-form').bootstrapSwitch('state',false);
  $.each(infoactual,function(key,value){
    $('.checkbox-form').each( function() {
      if (value == $(this).val()) {
          $(this).bootstrapSwitch('state',true);
      }
    });
  });
}
</script>
<?php if(isset($_GET['psid']) && $_GET['psid']!=''):?>
    <script>
    $(document).ready(function(){
            var page_id ="<?= $_GET['psid'];?>"
            $('#page_id').val(page_id);
            agregarImagenPage("#img_page", page_id)
    });
    </script>
<?php endif?>
</body>
</html>