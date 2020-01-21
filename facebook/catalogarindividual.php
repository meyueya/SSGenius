<?php
session_start();
define("NIVEL_MIN_PERMISO",1);
require_once('controller/user.php'); 
include('../model/CatalogarModel.php'); 
$catalogar= new CatalogarModel;
$posts_no_catalogados= $catalogar->getPostById($_GET['postid']);
$catalogacion= $catalogar->getCatalagocacion("page_id='".$_GET['psid']."'");
if(isset($pages)){
    foreach($pages as $page){
        if($page["id_facebook_page"]==$_SESSION['psid']){
            $nombre_pagina=$page['name'];
        }
    }
}
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
    Catalogación Individual
  </title>
 
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


</head>

<body >
  <div class="wrapper ">
    <?php include('views/menuaside.1.php');?> 
    <?php //var_dump($page);?>
    <div class="main-panel">
      <!-- Navbar -->
    <?php include('views/menunav.php');?>
      <!-- End Navbar -->
       <div class="content">
        <?php foreach($posts_no_catalogados as $array_no_catalogados):?>
            <div class="col-md-12">
                <div class="card " id="card_<?= $array_no_catalogados['id']?>">
                    <div class="card-header">
                        <h4 class="card-title"><?php echo $nombre_pagina; ?></h4>
                    </div>
                    <div class="card-body ">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row ">
                                    <img height="400px" src="<?= $array_no_catalogados["picture"];?>">                        
                                    </div>
                                    <div class="row">
                                    <?= $array_no_catalogados["message"];?> 
                                    </div>
                                </div>
                                <?php if(!empty($catalogacion)):?>
                                <div class="col-md-8">
                                    <form method="post" id="<?= $array_no_catalogados['id']?>" class="form-horizontal">
                                            <input type="hidden" value="<?= $array_no_catalogados['id']?>" name="id_post">
                                            <input type="hidden" value="<?= $array_no_catalogados['page_id']?>" name="page_id">
                                            <div class="container-fluid">
                                            <div class="row">
                                                <p>Tipo</p>
                                            </div>
                                            <div class="row">
                                                <?php foreach ($catalogacion as $arrayCatalogacion):?>
                                                <?php if($arrayCatalogacion["grupo"] == "tipo"): ?>
                                                    <div style="margin-bottom: 10px;" class="col-md-2">
                                                    <p style="margin-bottom: 0px;" class="category"><?= $arrayCatalogacion['nombre']?></p>
                                                    <input class="bootstrap-switch" type="checkbox" value="<?= $arrayCatalogacion['id']?>" name="valores_catalogacion[]" data-toggle="switch" data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success" />
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
                                                    <input class="bootstrap-switch" type="checkbox" value="<?= $arrayCatalogacion['id']?>" name="valores_catalogacion[]" data-toggle="switch" data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success" />
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
                                                    <input class="bootstrap-switch" type="checkbox" value="<?= $arrayCatalogacion['id']?>" name="valores_catalogacion[]" data-toggle="switch" data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success" />
                                                    </div>
                                                <?php endif ?>
                                                <?php endforeach ?>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <input class="boton-enviar btn btn-success" data-submit="<?= $array_no_catalogados['id']?>" type="button" value="Enviar" >
                                                </div>
                                                <div class="col">
                                                    <a href='./configuracion_page_facebook_ssg_all_rol.php?psid=<?= $_GET['psid']?>' class="btn btn-primary btn-success" style="margin-top:8px;">Editar Criterios de Catalogación</a>
                                                </div>
                                            </div>                          
                                            </div>                  
                                        </form>
                                    </div>
                                <?php else:?>
                                    <div class="row">
                                        <div style="padding-top: 80px;" class="col text-center">
                                            <h5>Sin Criterios de Catalogación para esta página</h5>
                                        <button type="button" class="btn btn-warning btn-round"><a style="color: #000000;" href="tipos-objetivos.php?psid=<?= $_GET['psid']?>">Administrar Tipos y Objetivos</a></button>
                                        </div>
                                    </div>
                                <?php endif?>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach?>
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
$('#catalogar').addClass("active");



$(document).ready( function(){
    $(".boton-enviar").click( function(){
        var idform = $(this).data('submit');
        
  $.ajax({
            type: "POST",
            url: "controller/procesarCatalogacion.php",
            data: $("#"+idform+"").serialize(), // serializes the form's elements.
            success: function(data)
            {
              $.notify({
                title: '<strong>Guardado!</strong><br>',
                message: 'Post Catalogado con Éxito'
                },{
                type: 'success'
                });
                $("#card_"+idform+"").fadeOut('slow','swing');
                setTimeout(function(){ window.close(); }, 2000);
            }
          });
  });
});
</script>
</body>
</html>