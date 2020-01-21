<?php
session_start();
define("NIVEL_MIN_PERMISO",2);
require_once('controller/user.php');
include('../model/CatalogarModel.php');
$catalogar= new CatalogarModel;
$posts_catalogados= $catalogar->getPostsCatalogados($_GET['psid']);
$valores_Post_catalogados = $catalogar->getInfoCatalagocacion("page_id='".$_GET['psid']."'");
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
        <?php if(!empty($posts_catalogados)):?>
            <div class="row">
                <?php foreach($posts_catalogados as $array_post_catalogados):?>
                    <div class="col-lg-4 col-md-6 col-sm-12" id="card_<?= $array_post_catalogados["id"]?>">
                        <div class="card card-stats" >
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <img src="<?= $array_post_catalogados["picture"];?>">                                              
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                    <p class="card-category text-left"> <strong> Tipo:</strong></p>
                                    <p class="card-category">
                                        <?php foreach ($valores_Post_catalogados as $value_Post_catalogado):?>
                                            <?php if ($array_post_catalogados["id"] == $value_Post_catalogado["id_post"]):?>
                                                <?php  foreach ($catalogacion as $value_catalogacion):?>
                                                    <?php  if ($value_Post_catalogado["valores_catalogacion"] == $value_catalogacion["id"]):?>
                                                        <?php  if ($value_catalogacion["grupo"]=='tipo'):?>
                                                            <span class="<?= $array_post_catalogados["id"]?>" data-value="<?= $value_catalogacion["id"]?>">-<?= $value_catalogacion["nombre"];?> </span>
                                                        <?php endif?>
                                                    <?php endif?>
                                                <?php endforeach?>
                                            <?php endif?>
                                        <?php endforeach?>
                                    </p>
                                    <p class="card-category text-left"><strong> Objetivo:</strong></p>
                                    <p class="card-category">
                                        <?php foreach ($valores_Post_catalogados as $value_Post_catalogado):?>
                                            <?php if ($array_post_catalogados["id"] == $value_Post_catalogado["id_post"]):?>
                                                <?php  foreach ($catalogacion as $value_catalogacion):?>
                                                    <?php  if ($value_Post_catalogado["valores_catalogacion"] == $value_catalogacion["id"]):?>
                                                        <?php  if ($value_catalogacion["grupo"]=='objetivo'):?>
                                                            <span class="<?= $array_post_catalogados["id"]?>" data-value="<?= $value_catalogacion["id"]?>">-<?= $value_catalogacion["nombre"];?> </span>
                                                        <?php endif?>
                                                    <?php endif?>
                                                <?php endforeach?>
                                            <?php endif?>
                                        <?php endforeach?>
                                    </p>
                                    <p class="card-category text-left"><strong> Nivel de libertad:</strong></p>
                                    <p class="card-category">
                                        <?php foreach ($valores_Post_catalogados as $value_Post_catalogado):?>
                                            <?php if ($array_post_catalogados["id"] == $value_Post_catalogado["id_post"]):?>
                                                <?php  foreach ($catalogacion as $value_catalogacion):?>
                                                    <?php  if ($value_Post_catalogado["valores_catalogacion"] == $value_catalogacion["id"]):?>
                                                        <?php  if ($value_catalogacion["grupo"]=='nivelLibertad'):?>
                                                            <span class="<?= $array_post_catalogados["id"]?>" data-value="<?= $value_catalogacion["id"]?>"><?= $value_catalogacion["nombre"];?> </span>
                                                        <?php endif?>
                                                    <?php endif?>
                                                <?php endforeach?>
                                            <?php endif?>
                                        <?php endforeach?>
                                    </p>
                                    <!-- <p class="card-title">150GB</p> -->
                                    <!-- <p></p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer "> 
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="text-center">
                                        <button class="btn btn-warning btn-round btn-icon btn-sm boton-update-catalogacion" data-toggle="modal" data-target="#noticeModal" data-idpost="<?= $array_post_catalogados["id"]?>" data-idpagepost="<?= $array_post_catalogados["page_id"]?>" data-message="<?= $array_post_catalogados["message"]?>" data-picture="<?= $array_post_catalogados["picture"]?>">
                                            <i class="nc-icon nc-ruler-pencil"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-center">
                                        <button class="btn btn-danger btn-round btn-icon btn-sm boton-eliminar-catalogacion" data-idpost="<?= $array_post_catalogados["id"]?>">
                                            <i class="nc-icon nc-simple-remove"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                <?php endforeach?>       
                        <div class="modal fade bd-example-modal-lg" id="noticeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" id="mdialTamanio">
                            <form method="post" id="form_update_catalogacion" class="form-horizontal">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    <i class="nc-icon nc-simple-remove" ></i>
                                    </button>
                                    <h5 class="modal-title" id="myModalLabel"><?php echo $page['name']; ?></h5>
                                </div>
                                <div class="modal-body">
                                        <div class="container-fluid">
                                            <div class="row">
                                            <div class="col-md-4">
                                                <div class="row ">
                                                <img height="400px"  id="imagen_catalogacion">                        
                                                </div>
                                                <div class="row">
                                                <p id="message_catalogacion"></p>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="hidden" id="id_post_update" name="id_post_update">
                                                <input type="hidden" id="page_id_update" name="page_id_update">
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
                                    <button type="button" class="boton-enviar btn btn-info btn-round" data-dismiss="modal">Actualizar</button>
                                </div>
                                </div>
                            </form>
                        </div>
                        </div>
                        <!-- end notice modal --> 
            </div>
        <?php else:?>
            <div class="row">
                <div style="padding-top: 80px;" class="col text-center">
                    <h1>Sin post Catalogados para esta página</h1>
                <!-- <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <?php //for ($i=1; $i <=$cant_paginas ; $i++):?>
                            <li class="page-item"><a class="page-link" href="#"><?php //echo $i?></a></li>
                        <?php //endfor?>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav> -->
                </div>
            </div>
        <?php endif?>
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
            }
          });
  });

  $(".boton-eliminar-catalogacion").click( function(){
    var idPost = $(this).data('idpost');     
    swal({
            title: '',
            text: '¿Estas seguro de remover esta catalogación?',
            type: 'warning',
            showCancelButton: true, 
            confirmButtonText: 'Si, estoy seguro',
            cancelButtonText: 'No',
            confirmButtonClass: "btn btn-success",
            cancelButtonClass: "btn btn-danger",
            buttonsStyling: false
        }).then(function() {
        $.ajax({
                    type: "POST",
                    url: "controller/procesarCatalogacion.php",
                    data: {'idPost_delete':idPost},
                    success: function()
                    {
                    swal({
                        title: '¡Éxito!',
                        text: 'Catalogacion Removida del Post',
                        type: 'success',
                        confirmButtonClass: "btn btn-success",
                        buttonsStyling: false
                    }).catch(swal.noop)

                        $("#card_"+idPost+"").fadeOut('slow','swing');
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

    });

    $(".boton-update-catalogacion").click( function(){
      var idpost = $(this).data('idpost');       
      var idpagepost = $(this).data('idpagepost');       
      var message = $(this).data('message');       
      var picture = $(this).data('picture');  
      $('#imagen_catalogacion').attr('src',picture);    
      $('#message_catalogacion').html(message);    
      $('#id_post_update').val(idpost);    
      $('#page_id_update').val(idpagepost); 
      var values_catalogacion_post=[];
      $('.'+idpost).each( function(){
        values_catalogacion_post.push($(this).data('value'));
      });
      actualizarEstadosCheckbox(values_catalogacion_post);
      });

      $('#noticeModal').on('hidden.bs.modal', function (e) {
        $('.checkbox-form').each( function() {
            $(this).bootstrapSwitch('setState', false);
        });
        });
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
</body>
</html>