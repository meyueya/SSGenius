<?php
session_start();
define("NIVEL_MIN_PERMISO",2);
require_once('controller/user.php');
include('../model/PostConsultoriaSSGModel.php');
if(isset($_GET['psid'])){
$psid=$_GET['psid'];
}
if(isset($_GET['a'])){
$id_consultoria=$_GET['a'];
}
$postConsultoria= new PostConsultoriaSSGModel;
$analisisConsultoria=$postConsultoria->getAnalisisConsultoria($id_consultoria,$psid);
$postsRecientementePublicados=$postConsultoria->getPostRecientes($psid);

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
    Reporte Informes
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
<style>
    
.card-wizard .card-title+.description, .h5, h5, .btn {
    margin: 20px;
}

.swit{
    width: 5%;
}

.td40{
    width: 40%;
}

.td30{
    width: 30%;
}
.td20{
    width: 20%;
}

.h2, .h3, h2, h3 {
    margin-left: 20px;
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
      <!-- End Navbar -->
      <!-- <div class="panel-header panel-header-sm">
  
  
</div> -->
      <div class="content">
        <div class="row" style="height: 20px;"></div>
        <h3>
        <?php echo $_GET['t'];?>
        </h3>
        <?php foreach($analisisConsultoria as $analisis):?>
        <form id="form_<?= $analisis['id']?>" method="post" name="miform" action="">
            <input name="post_id" id="post_id" type="hidden" value="">
            <input name="page_id_create" id="page_id_create" type="hidden" value="<?=$psid?>">
            <input name="analisis_padre" id="analisis_padre" type="hidden" value="<?= $analisis['id_analisis']?>">
            <input name="id_consultoria" id="id_consultoria" type="hidden" value="<?=$id_consultoria?>">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> <?=$analisis['titulo']?></h4>
              </div>
              <div class="card-body">
                <div class="table">
                  <?php 
                  $tiposAnalisis=$postConsultoria->getTiposAnalisis($analisis['id_analisis'],$id_consultoria,$psid);
                  ?>
                  <?php foreach($tiposAnalisis as $tipo):?>
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="text-left" colspan="3">
                        <?php echo $tipo['nombre'];?>
                        </th>
                        <th colspan="4"> Posts</th>
                      </tr>
                      <tr>
                        <th class="td20"> Título</th>
                        <th class="td30"> Hipótesis </th>
                        <th class="td30"> Observaciones </th>
                        <th class="swit"> P1</th>
                        <th class="swit"> P2</th>
                        <th class="swit"> P3</th>
                        <th class="swit"> P4</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $infoAnalsisiDefinidos=$postConsultoria->getInfoAnalisisConTipoAna($tipo['id_tipo_analisis'],$analisis['id_analisis'],$id_consultoria,$psid);
                       ?>
                      <?php foreach ($infoAnalsisiDefinidos as $key => $infoAnalisis): ?>
                      <tr data-id=<?=$infoAnalisis['id_consultoria']?>>
                        <td>
                          <?php echo $infoAnalisis['titulo'];?>
                        </td>
                        <td>
                        <?php echo $infoAnalisis['tipo_analisis'];?>
                        <?php echo $infoAnalisis['nombre_tipo_analisis'];?>
                        </td>
                        <td>
                          <?php echo $infoAnalisis['observaciones'];?>
                        </td>
                        <td class="swit">
                          <input required class="bootstrap-switch" type="checkbox" value="<?= $infoAnalisis['id']?>" name="analisis[valores_p1][]" data-toggle="switch" data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success" /> 
                        </td>
                        <td class="swit">
                          <input class="bootstrap-switch" type="checkbox" value="<?= $infoAnalisis['id']?>" name="analisis[valores_p2][]" data-toggle="switch" data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success" /> 
                        </td>
                        <td class="swit">
                          <input class="bootstrap-switch" type="checkbox" value="<?= $infoAnalisis['id']?>" name="analisis[valores_p3][]" data-toggle="switch" data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success" /> 
                        </td>
                        <td class="swit">
                          <input class="bootstrap-switch" type="checkbox" value="<?= $infoAnalisis['id']?>" name="analisis[valores_p4][]" data-toggle="switch" data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success" /> 
                        </td>
                      </tr> 
                      <?php endforeach?>
                    </tbody>
                  </table>
                  <?php endforeach?>
                </div>
                <div class="row text-cente">
                  <input class="boton-enviar btn btn-success" data-submit="<?= $analisis['id']?>" type="button" value="Registrar Posts">
                </div>
              </div>
            </div>
          </div>
        </form>
        <?php endforeach?>
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

$(document).ready( function(){
    
    $(".boton-enviar").click( function(){
        var idform = $(this).data('submit');
        
  $.ajax({
            type: "POST",
            url: "controller/procesarpostconsultoriassg.php",
            data: $("#form_"+idform+"").serialize(), // serializes the form's elements.
            success: function(data)
            {
              $.notify({
           title: '<strong>Guardado!</strong><br>',
           message: 'Posts Registrados con 脡xito'
           },{
           type: 'success'
           });
                $("#form_"+idform+"").fadeOut('slow','swing');
            }
          });
  });
});
    $('#consultancy').addClass("active");
    $('#consultancy_examples').addClass("show");
    $('#admin_consulting').addClass("active"); 
  </script>
</body>


</html>