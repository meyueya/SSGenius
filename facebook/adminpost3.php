<?php
session_start();
define("NIVEL_MIN_PERMISO",2);
require_once('controller/user.php');
include('../model/ConsultoriaModel.php');
$consultoriapost= new ConsultoriaModel;
$posts= $consultoriapost->traerConsultoriasPosts("and a.page_id='".$_GET['psid']."' and a.id_consultoria='".$_GET['a']."'", $group= "GROUP BY a.post"); 
$posts_no_asignados= $consultoriapost->getPostNoAsignados(); 
$analisis_consultoria_actual=$consultoriapost->traerAnalisisDeUnaConsultoria($_GET['a'],$_GET['psid']);
//var_dump($posts_no_asignados);die;

function get_picture_post($post_id,$arreglo_posts){
    $thumbnail_url_post=null;
    foreach ($arreglo_posts as $key => $value) {
        if ($value['object_story_id']==$post_id) {
            $thumbnail_url_post=$value['picture'];
            break;
        }
    }
    return $thumbnail_url_post;
}
 
?>

  
<!DOCTYPE html>
<html  lang="en" dir="ltr">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" sizes="32x32" />
  <link rel="icon" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" sizes="192x192" />
  <meta name="msapplication-TileImage" content="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" />
  <title> 
    SSG 
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <!-- <link href="../maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet"> -->
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
.card-stats .card-body .numbers {
    text-align: center;
}

.table-shopping .td-name {
 
    font-size: 1em!important;
}

.table-shopping .td-name {
    min-width: 0px!important;
}

.table-shopping .img-container {

    margin: auto;
}

</style>
</head>

<body >

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
            <h4 class="card-title"> Post de la consultoria: <small><?= $_GET['t']?></small> </h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-shopping">
                <thead class="">
                  <tr>
                  <th class="text-center">
                      #
                    </th>
                    <th class="text-center">
                      IMAGEN
                    </th>
                    <th>
                    características
                    </th>
                    <th>
                    Accion
                    </th>
                  
                  </tr>
                </thead>
                <tbody>
                <?php if(!empty($posts)): $n=0;?> 
                <?php foreach($posts as $array_post):?>
                <?php $valores_Post = $consultoriapost->traerConsultoriasPosts("and a.page_id='".$_GET['psid']."' and a.id_consultoria='".$_GET['a']."' and a.post='".$array_post['post']."'", $group='GROUP BY a.id_analisis'); $n++;?> 
                  <tr data-idpost=<?=$array_post['post']?>>
                  <td class="text-center"><strong><?= $n;?></strong></td>
                    <td class="text-center">
                      <div class="img-container">
                        <?php if ($array_post['post_id']!=''):?>
                            <img src="<?= get_picture_post($array_post['post_id'],$posts_no_asignados)?>" alt="...">
                        <?php else:?>
                            <img src="assets/img/SSGPOST.jpg" alt="...">
                        <?php endif?>
                      </div>
                    </td>
                    <td class="td-name">
                        <div class="row">
                    <?php foreach ($valores_Post as $value_Post):?>
                        <div class="col">          
                            <a href="#notebook"><?= $value_Post["nombre"];?></a><br>
                            <span  class="post_<?= $value_Post["post"]?>" data-value="<?= $value_Post["id_analisis"]?>" ><?= $value_Post["titulo"];?>: </span><br>
                            <small><?= $value_Post["observaciones"];?></small>
                        </div>
                        <?php endforeach?>
                    </div>
                    </td>
                    <td class="text-center">
                        <?php if ($array_post['post_id']!=''):?>
                        <a type="button" rel="tooltip" class="btn btn-info btn-sm" href="reportepostconsultoria.php?psid=<?= $_GET['psid']?>&postid=<?= $array_post['post_id']?>">
                            ver reporte
                        </a> 
                        <?php endif?>
                        <button class="btn btn-info btn-round btn-icon btn-sm boton-update-post" data-toggle="modal" data-target="#noticeModal" data-post="<?= $array_post["post"]?>" data-idpostselect="<?= $array_post['post_id']?>">
                            <i class="nc-icon nc-ruler-pencil"></i>
                        </button>
                        <button type="button" rel="tooltip" class="btn btn-danger btn-sm" onclick=deleteReport(<?=$array_post['id_consultoria']?>,<?= $_GET['psid']?>,<?=$array_post['post']?>)>
                            <i class="nc-icon nc-simple-remove"></i>
                        </button> 
                    </td>
                  </tr>
                  <?php endforeach?>   
                  <?php endif ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <div class="modal fade bd-example-modal-lg" id="noticeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" id="mdialTamanio">
                            <form method="post" id="form_post_consultoria" action="controller/procesarconsultoriassg.php" class="form-horizontal">
                            <input type="hidden" id="operacion" name="operacion" value="asignar_post_actualizar_info_analisis">                                
                                <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    <i class="nc-icon nc-simple-remove" ></i>
                                    </button>
                                    <h5 class="modal-title" id="myModalLabel"><?php ?></h5>
                                </div>
                                <div class="modal-body">
                                        <div class="container-fluid">
                                            <div class="row">
                                            <div class="col-md-4">
                                                <div class="row ">
                                                    <div class="img-container">
                                                        <img style="width: 233.328px; height: 233.328px;" src="assets/img/SSGPOST.jpg" id="img_post">
                                                    </div>                      
                                                </div>

                                                <div class="row">
                                                <!-- <p id="message_catalogacion"></p> -->
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="card-text">
                                                    <h4 class="card-title"><?= $_GET['t']?></h4>
                                                    <p class="card-category">Definir el Post de acuerdo a sus Análisis</p>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <input type="hidden" id="postConsultoria" name="postConsultoria" >
                                                    <input type="hidden" id="page_id" name="page_id" value="<?= $_GET['psid']?>">
                                                    <input type="hidden" id="id_consultoria" name="id_consultoria" value="<?= $_GET['a']?>">
                                                    <div class="container-fluid">
                                                    <div class="row">
                                                        <?php foreach ($analisis_consultoria_actual as $arrayCatalogacion):?>
                                                            <div style="margin-bottom: 10px;" class="col-md-2">
                                                            <p style="margin-bottom: 0px;" class="category"><?= $arrayCatalogacion['titulo']?></p>
                                                            <input class="bootstrap-switch checkbox-form" type="checkbox" value="<?= $arrayCatalogacion['id']?>" name="analisis_post[]" data-toggle="switch" data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success" />
                                                            </div>
                                                        <?php endforeach ?>
                                                    </div> 
                                                    <div class="row">
                                                    <select id="select_post" name="post_id" title="Posts" class="selectpicker">
                                                    <?php foreach ($posts_no_asignados as $posts_no_asignados_array):?>                                                
                                                        <option style="background-image:url(<?= $posts_no_asignados_array['thumbnail_url']?>);  background-repeat: no-repeat;     margin: 5px;" value="<?= $posts_no_asignados_array['object_story_id']?>"></option>
                                                    <?php endforeach ?>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>

                                                <div class="container-fluid">
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
    </div>
    </div>
    <?php include('views/pie-pagina.php'); ?>
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
  <!-- <script async defer src="../buttons.github.io/buttons.js"></script> -->
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
 $('#consultancy').addClass("active");
    $('#consultancy_examples').addClass("show");
    $('#admin_consulting').addClass("active"); 


$(document).ready( function(){
    
  $(".boton-enviar").click( function(){

  $.ajax({
            type: "POST",
            url: "controller/procesarconsultoriassg.php",
            data: $("#form_post_consultoria").serializeArray(), // serializes the form's elements.
            success: function(data)
            {
                location.reload();
                /* $.notify({
                    title: '<strong>Actualizado!</strong><br>',
                    message: 'Post Actualizado con Éxito'
                },{
                    type: 'success'
                }); */
            }
          });
  });


  $(".boton-update-post").click( function(){
      var postConsultoria = $(this).data('post');       
      var idpostselect = $(this).data('idpostselect');       
      $('#postConsultoria').val(postConsultoria);   
      var values_post=[];
      $('.post_'+postConsultoria).each( function(){
        values_post.push($(this).data('value'));
      });
      actualizarEstadosCheckbox(values_post);
      if (idpostselect!=''){
          $('#select_post').val(idpostselect).change();
      }else{
        $('#img_post').attr('src','assets/img/SSGPOST.jpg');
      }
    });
});

function deleteReport(id, page_id, post) {
      swal({
        title: '¿Estas seguro de eliminar este elemento?',
        text: '',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, estoy seguro',
        cancelButtonText: 'No',
        confirmButtonClass: "btn btn-success",
        cancelButtonClass: "btn btn-danger",
        buttonsStyling: false
      }).then(function () {
        $.ajax({
          type: "post",
          url: 'controller/procesarconsultoriassg.php',
          data: { 'id_consultoria': id , 'post_id_delete': post, 'page_id': page_id },
          success: function (result) {
            $('tr[data-idpost="' + id + '"]').fadeOut('slow', 'swing');
            swal({
              title: '¡Éxito!',
              text: "",
              type: 'success',
              confirmButtonClass: "btn btn-success",
              buttonsStyling: false
            }).catch(swal.noop)
          }
        });

      }, function (dismiss) {
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
<script>
$(document).ready( function(){
    var array_posts=<?= json_encode($posts_no_asignados)?>;
    console.log(array_posts)
    $("#select_post").change( function(){
        var id_post_select=$("#select_post").val();
        var picture;
        $.each( array_posts, function( key, value ) {
            if (value.object_story_id==id_post_select) {
                picture=value.picture;
            }
        });
        $('#img_post').attr('src',picture);
    });
});
</script>
</body>
</html>