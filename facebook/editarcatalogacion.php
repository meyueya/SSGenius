<?php
session_start();
define("NIVEL_MIN_PERMISO",2);
require_once('controller/user.php');
include('../model/CatalogarModel.php');   
$catalogar= new CatalogarModel;

$post_catalogado= $catalogar->getPostCatalogadoById($_GET['postid']);

$valores_Post_catalogacion = $catalogar->getInfoCatalagocacion("id_post='".$_GET['postid']."'");
$valores_Post_catalogacion = json_encode($valores_Post_catalogacion);

$catalogacion= $catalogar->getCatalagocacion("page_id='".$_GET['psid']."'");


?>
<!DOCTYPE html>
<html  lang="en" dir="ltr">
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" sizes="32x32" />
  <link rel="icon" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" sizes="192x192" />
  <!-- <link rel="apple-touch-icon-precomposed" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" /> -->
  <meta name="msapplication-TileImage" content="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" />
  <title>
    SSG
  </title>

  
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.css" rel="stylesheet" />
  
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

  <style>
  
  .dataTable .img-container img {
    width: 60%;
}

.botones{
    padding-bottom: 5px;
}
  </style>

</head>

<body >
  <!-- Extra details for Live View on GitHub Pages -->
  <!-- Google Tag Manager (noscript) -->
  <noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe>
  </noscript>
  <?php include('views/ssgmodal.php');?>
  <!-- End Google Tag Manager (noscript) -->
  <div class="wrapper ">
    <?php include('views/menuaside.1.php');?>
    <?php //var_dump($page);?>
    <div class="main-panel">
      <!-- Navbar -->
    <?php include('views/menunav.php');?>
      <!-- End Navbar -->
       <div class="content">
 <div class="row">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header">
        <h4 class="card-title"> Actualizar Catalogación  </h4>
        </div>
        <div class="card-body">
        <form method="post" id="form_update_catalogacion" class="form-horizontal">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel"></h5>
                                    </div>
                                    <div class="modal-body">
                                            <div class="container-fluid">
                                                <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row ">
                                                    <img height="400px"  id="imagen_catalogacion" src="<?= $post_catalogado[0]["picture"]?>">                        
                                                    </div>
                                                    <div class="row">
                                                    <p id="message_catalogacion"><?= $post_catalogado[0]["message"]?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="hidden" id="id_post_update" name="id_post_update" value="<?= $_GET['postid']?>">
                                                    <input type="hidden" id="page_id_update" name="page_id_update" value="<?= $_GET['psid']?>">
                                                    <div class="container-fluid">
                                                    <div class="row">
                                                        <p>Tipo</p>
                                                    </div>
                                                    <div class="row">
                                                        <?php foreach ($catalogacion as $arrayCatalogacion):?>
                                                        <?php if($arrayCatalogacion["grupo"] == "tipo"): ?>
                                                            <div style="margin-bottom: 10px;" class="col-md-2">
                                                            <p style="margin-bottom: 0px;" class="category"><?= $arrayCatalogacion['nombre']?></p>
                                                            <input class="bootstrap-switch checkbox-form" type="checkbox" value="<?= $arrayCatalogacion['id']?>" name="valores_catalogacion[]" data-toggle="switch" data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success" />
                                                            </div>
                                                        <?php endif ?>
                                                        <?php endforeach ?>
                                                    </div>                            
                                                    <div class="row">
                                                        <p>Objetivo</p>
                                                    </div>
                                                    <div class="row">
                                                        <?php foreach ($catalogacion as $arrayCatalogacion):?>
                                                        <?php if($arrayCatalogacion["grupo"] == "objetivo"): ?>
                                                            <div style="margin-bottom: 10px;" class="col-md-2">
                                                            <p style="margin-bottom: 0px;" class="category"><?= $arrayCatalogacion['nombre']?></p>
                                                            <input class="bootstrap-switch checkbox-form" type="checkbox" value="<?= $arrayCatalogacion['id']?>" name="valores_catalogacion[]" data-toggle="switch" data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success" />
                                                            </div>
                                                        <?php endif ?>
                                                        <?php endforeach ?>
                                                    </div>                            
                                                    <div class="row">
                                                        <p>Nivel de Libertad</p>
                                                    </div>
                                                    <div class="row">
                                                        <?php foreach ($catalogacion as $arrayCatalogacion):?>
                                                        <?php if($arrayCatalogacion["grupo"] == "nivelLibertad"): ?>
                                                            <div style="margin-bottom: 10px;" class="col-md-2">
                                                            <p style="margin-bottom: 0px;" class="category"><?= $arrayCatalogacion['nombre']?></p>
                                                            <input class="bootstrap-switch checkbox-form" type="checkbox" value="<?= $arrayCatalogacion['id']?>" name="valores_catalogacion[]" data-toggle="switch" data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success" />
                                                            </div>
                                                        <?php endif ?>
                                                        <?php endforeach ?>
                                                    </div>                         
                                                    </div>                  
                                                </div>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <div class="col">
                                        </div>
                                        <div class="col">
                                        <button type="button" class="boton-enviar btn btn-info btn-round" data-dismiss="modal">Actualizar</button>
                                                </div>
                                                <div class="col">
                                                    <a href='./configuracion_page_facebook_ssg_all_rol.php?psid=<?= $_GET['psid']?>' class="btn btn-primary btn-success" style="margin-top:8px;">Editar Criterios de Catalogación</a>
                                                </div>
                                    </div>
                                    </div>
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
<script src="../assets/js/plugins/bootstrap-selectpicker.js"></script>
<script>
$('#cataloging').addClass("active");
$('#cataloging_examples').addClass("show");
$('#admin_catalogados').addClass("active");


$(document).ready( function(){

    var valoresCatalogacion = <?= $valores_Post_catalogacion ?>;
  $(".boton-enviar").click( function(){
  $.ajax({
            type: "POST",
            url: "controller/procesarCatalogacion.php",
            data: $("#form_update_catalogacion").serialize(), // serializes the form's elements.
            success: function(data)
            {
                $.notify({
                    title: '<strong>Actualizado!</strong><br>',
                    message: 'Post Catalogado con Éxito'
                },{
                    type: 'success'
                });
                setTimeout(function(){ window.close(); }, 2000);
            }
          });
  });


      var values_catalogacion_post=[];
      $.each(valoresCatalogacion, function(index,value){
        values_catalogacion_post.push(value.valores_catalogacion);
      });
      actualizarEstadosCheckbox(values_catalogacion_post);


});

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


</html>