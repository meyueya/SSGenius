<?php
session_start();
include('controller/functionsformat.php');
define("NIVEL_MIN_PERMISO",2);
require_once('controller/user.php');
//include('controller/getData.php');
include('../model/ConsultoriaModel.php');
$consultoriapost = new ConsultoriaModel;
$nanalais = $consultoriapost->traerConsultoriaAnalisis($_GET['a'],$_GET['psid']);
$tanalais = $consultoriapost->traerConsultoriaTAnalisis($_GET['psid']);
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

tbody {
    font-size: 10px;
}
/*img.imgface  {
    border-radius: 10px !important;
    width: 81px !important;
}
 
.cont{
  font-size: 16px;
}*/

.h4, h4 {
    padding-left: 10px;
}
.titulo{
    font-size: 20px;
    font-weight: 700;
    padding-bottom: 0;
    text-transform: uppercase;
    border: 0;
}

#btnadd{
    margin-bottom: 10px;
}

.table-bordered {
    border: 3px solid #8f969c6e;
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



 <div class="box-body">
             
<div><H4><b>Consultoria:</b> <?= $_GET['t']?></H4></div>    

 <?php foreach ($nanalais as $key => $valuena): ?>
 <div class="col-md-12">
    <div class="card" id="card_<?= $valuena['id_analisis']?>">
      <div class="card-body">
      <!-- <form method="post" id="" class="form-horizontal"> -->
      <p class="titulo"><?= $valuena['titulo']?>  </p>
      <input type="hidden"  value="3" name="op">
          <input type="hidden"   value="<?= $_GET['psid']?>" name="page_id">
          <input type="hidden"   value="<?= $_GET['a']?>" name="id_consultoria">
      <?php foreach ($tanalais as $key => $value): ?>
      
    <table id="<?=$valuena['id_consultoria']."-".$valuena['id_analisis']."-".$value['id'];?>" class="table table-hover table-bordered">
    <thead>
      <tr>
        <th># </th>
        <th><?= $value['nombre']?></th>
      </tr>
    </thead>
    <tbody>
    
      <tr>
        <td>1</td>
        <td>
          <div class="row">
          <input type="hidden"  class="form-control nanalisis_<?= $valuena['id_analisis']?>" value="<?= $valuena['id_analisis']?>" name="nanalisis[]">
          <input type="hidden"  class="form-control tipo_analisis_<?= $valuena['id_analisis']?>" value="<?= $value['id']?>" name="tanalisis[]">
          
         <div class="form-group col-lg-3">
             <span> Título Hipótesis:</span>
            <input class="form-control titulo_analisis_<?= $valuena['id_analisis']?>" name="titulo[]" placeholder="Título Hipótesis"/>
          </div>
         
          <div class="form-group col-lg-4">
            <span> Hipótesis:</span>
            <textarea  class="form-control hipotesis_<?= $valuena['id_analisis']?>" rows="3" name="hipotesis[]" placeholder="Observaciones"> </textarea>
          </div>

          <div class="form-group col-lg-4">
            <span> Observaciones:</span>
            <textarea  class="form-control obs_analisis_<?= $valuena['id_analisis']?>" rows="3" name="texto[]" placeholder="Observaciones"> </textarea>
          </div>

          <div class="form-group col-lg-1">
             
             <button id="btnadd" class="btn btn-primary" data-idh="<?=$valuena['id_consultoria']."-".$valuena['id_analisis']."-".$value['id'];?>" data-tanalisis="<?=$value['id']?>" data-nanalisis="<?= $valuena['id_analisis']?>"> + </button>
             <button id="del" class="btn btn-danger" data-ideh="<?=$valuena['id_consultoria']."-".$valuena['id_analisis']."-".$value['id'];?>"> - </button>
            
   
            </div>
         
          </div>
          
        </td>
      </tr>
      
    </tbody>
  </table>
 
  <?php endforeach?>
  
  <button type="submit" name="guardar" id="guardar" value="GUARDAR"  class="btn btn-success" data-submit="<?= $valuena['id_analisis']?>"><i class="fa fa-save"></i> Guardar</button>
<!-- </form> -->


</div></div></div>
 <?php endforeach?>
            
          


          

            <!-- /.box-body -->
          </div>
      


         <!--  <?php foreach ($tanalais as $key => $value): ?><option value="<?= $value['id']?>"><?= $value['nombre']?></option><?php endforeach?>

  -->
     

      





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


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<!-- <script>
    var id_inf = '<?= $_SESSION['id_inf'] ?>';
    var periodo = '<?= $_SESSION['periodo'] ?>';
    var fecha = '<?= $_SESSION['fecha'] ?>';
    var categorias = '<?php echo rtrim($count,','); ?>';
    var infoactual = <?php echo json_encode($infoactual);?>;
</script>
<script src="js/main.js"></script>script>
   -->
 


 

<script type="text/javascript">


    function recoger_datos(selector) {
        var array = [];

        $(selector).each(function(){
            
             array.push($(this).val());
            //client[$(this).attr("name")]=($(this).val());
        }); 
        return array;
    }


    $(function() {
      var count = 1;
      

      $(document).on("click", "#btnadd", function(event) {
        var idH = $(this).data('idh');   
        var analisis = $(this).data('tanalisis'); 
        var nanalisis = $(this).data('nanalisis');   
        console.log(analisis);
        var count=$('#'+idH+' '+'tr').length-1;                            
          
        count++;
        //$('#tblprod tr:last').after('<tr><td> '+ count +' </td><td><div class="row"> <div class="form-group col-lg-3"><span> Nombre de Análisis:</span><select name="nanalisis[]" id="nanalisis" class="form-control pull-left nanalisis"  required><option selected>Selecione Analisis:</option><?php foreach ($nanalais as $key => $value): ?><option value="<?= $value['id_analisis']?>"><?= $value['titulo']?></option><?php endforeach?></select></div><div class="form-group col-lg-3"><span> Tipo de Análisis:</span><select name="tipoa[]" id="tipoa" class="form-control pull-left tipo_analisis"  required><option selected>Selecione Vehiculo:</option><option value="graficos">Gráficos</option><option value="contenido">Contenido</option><option value="texto_community">Texto Community</option><option value="momento_publicacion">Momento Publicación</option><option value="coyontura">Coyontura</option></select></div><div class="form-group col-lg-2"><span> Título:</span><input class="form-control titulo_analisis" name="titulo[]" placeholder="Título Análisis"/></div><div class="form-group col-lg-4"><span> Observaciones:</span><textarea  class="form-control obs_analisis" rows="3" name="texto[]" placeholder="Observaciones"> </textarea></div></div></td></tr>');
        $('#'+idH+' '+'tr:last').after('<tr><td>'+count+'</td><td><div class="row"><input type="hidden"  class="form-control nanalisis_'+nanalisis+'" value="'+nanalisis+'" name="nanalisis[]"> <input type="hidden" class="form-control tipo_analisis_'+nanalisis+'" value="'+analisis+'" name="tanalisis[]"><div class="form-group col-lg-3"><span> Título Hipótesis:</span><input class="form-control titulo_analisis_'+nanalisis+'" name="titulo[]" placeholder="Título Hipótesis"/></div><div class="form-group col-lg-4"><span> Hipótesis:</span><textarea  class="form-control hipotesis_'+nanalisis+'" rows="3" name="hipotesis[]" > </textarea></div><div class="form-group col-lg-4"><span> Observaciones:</span><textarea  class="form-control obs_analisis_'+nanalisis+'" rows="3" name="texto[]" placeholder="Observaciones"> </textarea></div><div class="form-group col-lg-1"></div></div></td></tr>');
           event.preventDefault();
  

      });

      $(document).on("click", "#del", function(event) {
      
        var idEH = $(this).data('ideh');   
    
            // Obtenemos el total de columnas (tr) del id "tabla"
            var trs=$('#'+idEH+' '+'tr').length;

            console.log(idEH, trs);
           if(trs>2)
            { 
                // Eliminamos la ultima columna
                $('#'+idEH+' '+'tr:last').remove();
                count--;
             } 
        });


    });

$(document).on("click", "#guardar", function(event) {

 var nanalisis = $(this).data('submit');   
 var titulo = recoger_datos("input:text.titulo_analisis_"+nanalisis+"");
 var obs = recoger_datos("textarea.obs_analisis_"+nanalisis+"");
 var hip = recoger_datos("textarea.hipotesis_"+nanalisis+"");
 var tipoa = recoger_datos("input:hidden.tipo_analisis_"+nanalisis+"");

  




     var consultoria ={

            "op" : '3',
            "id": '1',
            "titulo": titulo,
            "obs": obs,
            "hip": hip,
            "tipoa": tipoa,
            "nanalisis": nanalisis,
            "page_id": <?= $_GET['psid']?>,
            "id_consultoria" : <?= $_GET['a']?>
        };

      //  console.log(consultoria);
      
 $.ajax({
 
            url:    'controller/procesarconsultoriassg.php', 
            type:   'post',
            data:    consultoria,                   //$("#"+idform+"").serialize(), // serializes the form's elements. 
            success: function(DatosRecuperados) {
            

               $.notify({
           title: '<strong>Guardado!</strong><br>',
           message: 'Analisis de consultoria con Éxito'
           },{
           type: 'success'
           });
                $("#card_"+nanalisis+"").fadeOut('slow','swing');
 
  },
error: function(status) {
  console.log(status);
}});
  }); 
  
  </script>
</body>



</html>