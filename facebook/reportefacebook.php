<?php
include('../auth.php');

 
  $f = date("m");
$inicio="2018-".$f."-01";
$fin="2018-".$f."-31";
$nanuncio=$_GET['nanuncio'];
$camp=$_GET['camp'];
 
    
    
    
  if(isset($_POST['check'])==1){

    if(isset($_POST['daterange-btn']) && isset($_POST['anuncio']) && isset($_POST['camp'])){

    if($_POST['daterange-btn']!=''){
    $desdehasta = explode(" - ", $_POST['daterange-btn']);
    $desde=date("Y-m-d",strtotime($desdehasta[0]));
    $hasta=date("Y-m-d",strtotime($desdehasta[1]));
    $d=date("Y/m/d",strtotime($desdehasta[0]));
    $h=date("Y/m/d",strtotime($desdehasta[1]));
    $f=date("m",strtotime($desdehasta[0]));
    $inicio="2018-".$f."-01";
    $fin="2018-".$f."-31";
    $fecha="date_start BETWEEN '$desde' and '$hasta'";
    
    }
    else{
    $fecha="";
    }

    if($_POST['anuncio']!='0'){
      $anuncio="AND ad_name='".$_POST['anuncio']."'";
    }
    else{
    $anuncio="";
    }

    if($_POST['camp']!='0'){
      $campp="AND campaign_name='".$_POST['camp']."'";

    }
    else{
    $campp="";
    }




    

    $result = mysql_query("select a.`date_start`,a.`ad_id`, b.`ad_id`,a.`campaign_name`,a.`ad_name`,a.`age`,a.`gender`,a.`impressions`,a.`clicks`,a.`spend`,a.`ad_name`,a.`age`,a.`gender`, b.`thumbnail_url`, b.`effective_object_story_id` from aiw_facebook_data_ads as a, ad_creative_facebook as b WHERE ".$fecha."".$anuncio."".$campp." AND b.`ad_id`=a.`ad_id` order by a.id DESC");
    //echo "select a.`date_start`,a.`ad_id`, b.`ad_id`,a.`campaign_name`,a.`ad_name`,a.`age`,a.`gender`,sum(a.`impressions`) as impressions,sum(a.`clicks`) as clicks,sum(a.`spend`) as spend, COUNT(a.`ad_name`) as totalcampos,a.`age`,a.`gender`, b.`thumbnail_url`, b.`effective_object_story_id` from aiw_facebook_data_ads as a, ad_creative_facebook as b WHERE ".$fecha."".$anuncio."".$campp." AND  b.`ad_id`=a.`ad_id` order by a.id asc";
    $result4 = mysql_query("SELECT COUNT(*) as totala FROM `aiw_facebook_data_ads` where date_start BETWEEN '".$inicio."' and '".$fin."'");
    $row4 = mysql_fetch_array($result4);
    $costom=850/$row4['totala'];

  
    
    }
}

   elseif(isset($_POST['check'])==''){

    if(isset($_POST['daterange-btn']) && isset($_POST['anuncio']) && isset($_POST['camp'])){

    if($_POST['daterange-btn']!=''){
    $desdehasta = explode(" - ", $_POST['daterange-btn']);
    $desde=date("Y-m-d",strtotime($desdehasta[0]));
    $hasta=date("Y-m-d",strtotime($desdehasta[1]));
    $d=date("Y/m/d",strtotime($desdehasta[0]));
    $h=date("Y/m/d",strtotime($desdehasta[1]));
    $f=date("m",strtotime($desdehasta[0]));
    $inicio="2018-".$f."-01";
    $fin="2018-".$f."-31";
    $fecha="date_start BETWEEN '$desde' and '$hasta'";
    
    }
    else{
    $fecha="";
    }

    if($_POST['anuncio']!='0'){
      $anuncio="AND ad_name='".$_POST['anuncio']."'";
    }
    else{
    $anuncio="";
    }

    if($_POST['camp']!='0'){
      $campp="AND campaign_name='".$_POST['camp']."'";

    }
    else{
    $campp="";
    } 

   // $result = mysql_query("select * from reportefacebook2 where ".$fecha."".$anuncio."".$campp." order by id asc");
    $result = mysql_query("select a.`date_start`,a.`ad_id`, b.`ad_id`,a.`campaign_name`,a.`ad_name`,a.`age`,a.`gender`,sum(a.`impressions`) as impressions,sum(a.`clicks`) as clicks,sum(a.`spend`) as spend, COUNT(a.`ad_name`) as totalcampos,a.`age`,a.`gender`, b.`thumbnail_url`, b.`effective_object_story_id` from aiw_facebook_data_ads as a, ad_creative_facebook as b WHERE ".$fecha."".$anuncio."".$campp." AND  b.`ad_id`=a.`ad_id`  group by a.`ad_name`,a.`age`,a.`gender` having count(*) > 0
   ");
    //$result = mysql_query("select `date_start`,`campaign_name`,`ad_name`,`age`,`gender`,sum(`impressions`) as impressions,sum(`clicks`) as clicks,sum(`spend`) as spend, COUNT(`ad_name`) as totalcampos from reportefacebook2 WHERE ".$fecha."".$anuncio."".$campp." group by `ad_name`,`gender`,`age` having count(*) > 0");
  
    $result4 = mysql_query("SELECT COUNT(*) as totala FROM `aiw_facebook_data_ads` where date_start BETWEEN '".$inicio."' and '".$fin."'");
    $row4 = mysql_fetch_array($result4);
    $costom=850/$row4['totala'];
 
    }

}


    else{

         // $result = mysql_query("select * from reportefacebook2 where date_start BETWEEN '".$inicio."' and '".$fin."' order by id asc");
          
      }
 
    $result2 = mysql_query("SELECT DISTINCT campaign_name FROM aiw_facebook_data_ads where date_start BETWEEN '".$inicio."' and '".$fin."'");
    $result3 = mysql_query("SELECT DISTINCT ad_name FROM aiw_facebook_data_ads where date_start BETWEEN '".$inicio."' and '".$fin."'");
    $result4 = mysql_query("SELECT COUNT(*) as totala FROM `aiw_facebook_data_ads` where date_start BETWEEN '".$inicio."' and '".$fin."'");
    $row4 = mysql_fetch_array($result4);
    $costom=850/$row4['totala'];

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
    Reporte Facebook
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


</head>

<body>
<div id="dvLoading"></div>
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
     

        <form id="miform" method="post" name="miform" action="reportefacebook.php">
        <div class="row">
         

            <div class="col-md-1">
          </div>
          <div class="col-md-2">
             
              <div class="form-group">
                <p> Campañas:</p>

                <div class="input-group">
                <select name="camp" id="camp" class="form-control pull-left" >
                <option value="0" selected>Selecione Campaña:</option>
                <?php
                if(isset($_POST['camp']) &&  $_POST['camp']!='0'){
                    $cam=$_POST['camp'];
                    echo '<option value="'.$cam.'" selected> '.$cam.'</option>';
                  }
                if($row2 = mysql_fetch_array($result2)){
                  do{
                      $b++; 
                      $a=$b;
                      echo '<option value="'.$row2['campaign_name'].'">'.$a." ".$row2['campaign_name'].'</option>';
                        }while($row2 = mysql_fetch_array($result2));
                      }else{
                      }
                    ?>
                  </select>
                </div>
              </div>
           
          </div>
          <div class="col-md-2">
              <div class="form-group">
                <p> Anuncios:</p>

                <div class="input-group">
                  <select name="anuncio" id="anuncio" class="form-control pull-left" >
                  <option value="0" selected>Selecione Anuncio:</option>
                   <?php
                   if($row3 = mysql_fetch_array($result3)){
                   do{
                      $b++; 
                      $a=$b;
                      echo '<option value="'.$row3['ad_name'].'">'.$a." ".$row3['ad_name'].'</option>';
                        }while($row3 = mysql_fetch_array($result3));
                      }else{
                      }
                    ?>
                  </select>
                </div>
              </div>
            
          </div>
             <!-- Date and time range -->
              
             <div class="col-md-2">
              <div class="form-group">
                 Reporte por Fecha:

                <div class="input-group">
                  <input  class="btn btn-default pull-right" name="daterange-btn" id="daterange-btn" autocomplete="off">
                  </input>
                  <input  name="dpag" id="dpag" type="hidden" value="<?php echo $_POST['daterange-btn']; ?>"></input>
                  </div>
                </div>
                </div>
                <div class="col-md-3">    
                 <div class="form-group">
                  Reporte Detallado:
                  <div class="input-group">
                  <input name="check" type="checkbox" value="1">
                  </div>
                  </div>
                </div>
                
             <div class="col-md-2">          
             <button type="submit" name="greport" id="greport" value="GREPORT"  class="btn btn-success" style="float: right; margin-top: 36px;"><i class="fa fa-print"></i> Generar Reporte</button>
             </div>
            
          </div>

           <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
            <table id="example1" class="cell-border compact stripe">
                <thead>
                <tr>
                  <th style="width: 15px;" >#</th>
                  <th>Fecha</th>
                  <th>Campaña</th>
                  <th>Nombre Anuncio</th>
                  <th>Edad</th>
                  <th>Sexo</th>
                  <th>Impresiones</th>
                  <th>Clic</th>
                  <th>Inversión</th>
                
                </tr>
                </thead>
                 <tbody style="font-size: 12px;">
                
                  <?php
                  $x=1;
                  if($row = mysql_fetch_array($result)){
                  do{
                     if($_POST['check']==1){ $totalcosto=$costom;}
                     elseif($_POST['check']!=1){  $totalcosto=$costom*$row['totalcampos'];}
                    $fecha = date("d-m-Y",strtotime($row['date_start']));
                    $gastos = $row['spend']/0.55;

                    if($row['gender']=='female'){ $genero="Mujer";}
                    elseif($row['gender']=='male'){ $genero="Hombre";}
                    elseif($row['gender']=='unknown'){ $genero="Sin Clasificar";}
                    $url="https://www.facebook.com/".$row['effective_object_story_id'];
                  ?>
                  <!--<a href="reportefacebook.php?camp=<?php echo $row['campaign_name'];?>">   <a href="reportefacebook.php?nanuncio=<?php echo $row['ad_name'];?>">-->
                  <tr>
                  <td><?php echo $x; ?></a></td>
                  <td><?php echo $fecha; ?></td>
                  <td><?php echo $row['campaign_name'];?></td>
                  <td><a href="<?php echo $url;?>" target="_blank"><img src="<?php echo $row['thumbnail_url'];?>"></a><?php echo $row['ad_name']; ?></td>
                  <td><?php echo $row['age']; ?></td>
                  <td><?php echo $genero; ?></td>
                  <td><?php echo $row['impressions']; ?></td>
                  <td><?php echo $row['clicks']; ?></span></td>
                  <td><?php echo "$ ".number_format($gastos, 2,',','.');?></span></td>
                  </tr>

                        <?php
                        $x++;
                        $costo+=$gastos;
                        $impressions+=$row['impressions'];
                        $clicks+=$row['clicks'];
                        
               }while($row = mysql_fetch_array($result));
                    }else{
                    }

                     $costo=round($costo,2);
                        ?>


                </tbody> 

                 <tfoot>
                 <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td><strong> TOTAL</strong></td>
                  <td><strong><?php echo number_format($impressions, 0,',','.'); ?></strong></td>
                  <td><strong><?php echo number_format($clicks, 0,',','.'); ?></strong></td>
                  <td><strong><?php echo "$ ".number_format($costo, 2,',','.'); ?></strong></td>
                
                  
                </tr>
                </tfoot>
              
                
                
              </table>
              
</div>
              </div>
            </div>
          </div>
          



</form>






        </div>
 
      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">


          <div class="row">
          
            <div class="credits ml-auto">
              <span class="copyright">
                ©
                <script>
                  document.write(new Date().getFullYear())
                </script>, made with <i class="fa fa-heart heart"></i> by AIW
              </span>
            </div>
          </div>
        </div>
      </footer>
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
  $(function () {
     var d = "<?php echo $d;?>";
    if(d!==''){ var des='moment("<?php echo $d;?>")'; var has='moment("<?php echo $h;?>")'; }
    else if(d === ''){ var des=moment().subtract(29, 'days'); var has=moment();  }
 
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Hoy'       : [moment(), moment()],
          'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Ultimos 7 Dias' : [moment().subtract(6, 'days'), moment()],
          'Ultimos 30 Dias': [moment().subtract(29, 'days'), moment()],
          'Mes Actual'  : [moment().startOf('month'), moment().endOf('month')],
          'Mes Pasado'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: des,
        endDate  : has,

        "autoApply": true,
        locale : {
        "format": 'YYYY/MM/DD',
        "separator": " - ",
        "applyLabel": "Aplicar",
        "cancelLabel": "Cancelar",
        "fromLabel": "Desde",
        "toLabel": "Hasta",
        "customRangeLabel": "Rango",
              
        "daysOfWeek": [
            "DOM",
            "LUN",
            "MAR",
            "MIR",
            "JUE",
            "VIR",
            "SAB"
        ],
        "monthNames": [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ]
        
    }

      },
      function (start, end, label) {
      
        $('#daterange-btn span').html(start.format('dd/mm/yyyy') + ' - ' + end.format('dd/mm/yyyy'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
  
  
  /* $(function () {
    
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'dom': 'Bfrtip',
       buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    })
  })*/


$(document).ready(function() {
    //$('#dvLoading').hide();
  if (dTable instanceof $.fn.dataTable.Api) {
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
    buttons: [{
      extend: 'excel',
      title: 'Reporte Facabook ILCB',
      filename: 'reportefacebook_ilcb'
    }],
    language: {
            search: "Buscar",
            emptyTable: "Sin Criterios para el Reporte!!",
            infoEmpty: "Mostrando 0 to 0 of 0 Entradas",
            lengthMenu: "Mostrar _MENU_ Entradas",
            loadingRecords: "Cargando...",
            processing: "Procesando...",
            infoFiltered: "(Filtrado de _MAX_ total entradas)",
            info: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            zeroRecords: "Sin resultados encontrados",
            paginate: {
                first:      "Inicio",
                previous:   "Anteiror",
                next:       "Siguiente",
                last:       "Anterior"
            }
            
            }
  });
});

$('#reporte').addClass("show");
$('#r').addClass("active");
$('#fd').addClass("active");
</script>
</body>


<!-- Mirrored from demos.creative-tim.com/paper-dashboard-2-pro/examples/components/panels.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Aug 2018 16:06:47 GMT -->
</html>