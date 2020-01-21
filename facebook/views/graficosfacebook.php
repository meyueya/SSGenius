<?php 
session_start();
define("NIVEL_MIN_PERMISO",1);
require_once('controller/user.php');

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

<style>
  .nav-pills-primary .nav-item .nav-link {
    border: 1px solid #6bd098;
    color: #6bd098;
     padding: 0px 10px;
     font-size: 12px;
     border-radius: 3px;
}

.nav-pills-primary .nav-item .nav-link.active {
    border: 1px solid #6bd098;
    background: #6bd098;
    color: #fff;
    font-size: 15px
}

.nav-pills-primary .nav-link.active {
    background-color: #6bd098!important;
}

.dropdown-toggle.btn.btn-default.btn-round{
  border-radius: 3px;

}

.nav-item{
     padding: 3px 2px;
     
}

tbody {
    font-size: 12px;
    text-align: center;
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
     
      <div class="row" style="height: 40px;"></div>
      <div class="row">
        <div class="col-md-3">
            <div class="container">
                <h5 class="card-title">Periodo:</h5>
                <div class="row">
                  <div class="col-lg-5 col-md-6 col-sm-3">
                    <select class="selectpicker" data-size="7" data-style="btn btn-default btn-round" title="Single Select" id="periodo" onChange="actualizar_en_tiempo_real()">
                      <option disabled selected>Seleccione</option>
                      <option value="a">Dias</option>
                      <option value="b">Semanas</option>
                      <option value="c" selected>Mes</option>
                    </select>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
                <div class="form-group">
                        <h5 class="card-title">Fecha:</h5>
                        <div class="input-group">
                          <input  class="btn btn-default pull-right" onChange="actualizar_en_tiempo_real()"  name="daterange-btn" id="daterange-btn" autocomplete="off">
                          <input  name="dpag" id="dpag" type="hidden" >
                        </div>
                      </div>
        </div>
        <div class="col-md-3">
                <div class="form-group">
                        <h5 class="card-title">Nombre del informe:</h5>
                        <input  name="titulo_reporte" id="titulo_reporte" type="text" required form="miform">        
                      </div>
        </div>
        <div class="col-md-3">
                <form id="miform" method="post" name="miform" action="controller/procesarinformefb.php">
                    <input id="fecha" name="fecha" type="hidden"> 
                    <input id="fecha_comparacion" name="fecha_comparacion" type="hidden">
                    <input id="pdo" name="pdo" type="hidden">
                    <input id="id_page" name="id_page_create" type="hidden">
                    <input id="var" name="var" type="hidden" value="1">       
                   <button type="submit" name="greport" id="greport" value="GREPORT"  class="btn btn-success" style="float: left; margin-top: 35px;"><i class="fa fa-print"></i> Generar Reporte</button>
                    </form> 
        </div>      
      </div>
       
        <div class="row">
            <div class="col-md-1">
          </div>
    
          <div class="col-md-2">

          </div>
          
             <div class="col-md-6">

             </div>
             


                <div class="col-md-12">

                <ul class="nav nav-pills nav-pills-primary nav-pills-icons justify-content-center" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" data-id="0" href="#link0" role="tablist" onClick="GenerarGraficos(0)">
                      <i class="now-ui-icons objects_umbrella-13"></i> Fans VS Dislike
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" data-id="1" href="#link1" role="tablist" onClick="GenerarGraficos(1)">
                      <i class="now-ui-icons ui-2_settings-90"></i> Likes vs DisLikes
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" data-id="2" href="#link2" role="tablist" onClick="GenerarGraficos(2)">
                      <i class="now-ui-icons shopping_shop"></i> Crecimiento Likes
                    </a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" data-id="3" href="#link3" role="tablist" onClick="GenerarGraficos(3)">
                      <i class="now-ui-icons shopping_shop"></i> Likes Organicos vs Pagados
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" data-id="4" href="#link4" role="tablist" onClick="GenerarGraficos(4)">
                      <i class="now-ui-icons shopping_shop"></i> Likes Organicos vs Pagados (%)
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" data-id="5" href="#link5" role="tablist" onClick="GenerarGraficos(5)">
                      <i class="now-ui-icons shopping_shop"></i> Fans Netos
                    </a>
                  </li>
                  <!--
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" data-id="6" href="#link6" role="tablist" onClick="GenerarGraficos(6)">
                      <i class="now-ui-icons shopping_shop"></i> Likes Demográfico
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" data-id="7" href="#link7" role="tablist" onClick="GenerarGraficos(7)">
                      <i class="now-ui-icons shopping_shop"></i> Likes edad-sexo
                    </a>
                  </li>-->
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" data-id="8" href="#link8" role="tablist" onClick="GenerarGraficos(8)">
                      <i class="now-ui-icons shopping_shop"></i> Alcance
                    </a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" data-id="9" href="#link9" role="tablist" onClick="GenerarGraficos(9)">
                      <i class="now-ui-icons shopping_shop"></i> Interacciones
                    </a>
                  </li>
                  <!--
                   <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" data-id="10" href="#link10" role="tablist" onClick="GenerarGraficos(10)">
                      <i class="now-ui-icons shopping_shop"></i> Likes demograficos - dia de la semana
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" data-id="11" href="#link11" role="tablist" onClick="GenerarGraficos(11)">
                      <i class="now-ui-icons shopping_shop"></i> Fans Online
                    </a>
                  </li>-->
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" data-id="12" href="#link12" role="tablist" onClick="GenerarGraficos(12)">
                      <i class="now-ui-icons shopping_shop"></i> Engaged users vs engagement rate  
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" data-id="13" href="#link13" role="tablist" onClick="GenerarGraficos(13)">
                      <i class="now-ui-icons shopping_shop"></i>  Alcance promedio vs engagement rate  
                    </a>
                  </li>
                  <!--
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" data-id="14" href="#link14" role="tablist" onClick="GenerarGraficos(14)">
                      <i class="now-ui-icons shopping_shop"></i>  Nuevos Likes Demográfico  
                    </a>
                  </li>-->
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" data-id="20" href="#link20" role="tablist" onClick="GenerarGraficos(20)">
                      <i class="now-ui-icons shopping_shop"></i>  Impresiones 
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" data-id="21" href="#link21" role="tablist" onClick="GenerarGraficos(21)">
                      <i class="now-ui-icons shopping_shop"></i>  Clicks
                    </a>
                  </li>
                </ul>
                </div>
               <!-- <div class="col-md-5">          
 <button type="submit" name="greport" id="greport" value="GREPORT"  class="btn btn-success" style="float: right;  margin-top: 36px;"><i class="fa fa-print"></i> Generar Reporte</button>
 </div>-->
                
              
            
          </div>
                      
        <div class="col-md-12">
            <div class="card">
              <div class="card-body">
               
              <div id="container" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
                           <!-- GRAFICAS -->

                </div>
            </div>
        </div>

<div class="card-body" style="width: 90%; margin: 0 auto;">
                <!--
                                    color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
                                -->
                
                <div class="tab-content tab-space tab-subcategories">
                   <div class="tab-pane active" id="link0"></div>
                   <div class="tab-pane" id="link1"></div>
                   <div class="tab-pane" id="link2"></div>
                   <div class="tab-pane" id="link3"></div>
                   <div class="tab-pane" id="link4"></div>
                   <div class="tab-pane" id="link5"></div>
                   <div class="tab-pane" id="link6"></div>
                   <div class="tab-pane" id="link7"></div>
                   <div class="tab-pane" id="link8"></div>
                   <div class="tab-pane" id="link9"></div>
                   <div class="tab-pane" id="link10"></div>
                   <div class="tab-pane" id="link11"></div>
                   <div class="tab-pane" id="link12"></div>
                   <div class="tab-pane" id="link13"></div>
                   <div class="tab-pane" id="link14"></div>
                   <div class="tab-pane" id="link20"></div>
                   <div class="tab-pane" id="link21"></div>
                </div>
              </div>
              <?php include('views/pie-pagina.php'); ?>
    </div>
  </div>

  <!--   Core JS Files   
  <script src="../assets/js/core/jquery.min.js"></script>-->
  <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
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
  <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="../assets/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="../assets/js/plugins/bootstrap-datetimepicker.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
  <script src="../assets/js/plugins/jquery.dataTables.min.js"></script>
  <!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
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

  
 
<script>
  $(function () {
    var des=moment().startOf('year'); 
    var has=moment().endOf('month');  
 
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          
          'Mes Actual'  : [moment().startOf('month'), moment().endOf('month')],
          'Mes Pasado'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
          'Últimos 2 Meses': [moment().subtract(2, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
          'Últimos 3 Meses': [moment().subtract(3, 'month').startOf('month'), moment().subtract(0, 'month').endOf('month')],
          'Últimos 6 Meses': [moment().subtract(6,'month').startOf('month'), moment().subtract(0, 'month').endOf('month')],
          'Año Actual'  : [moment().startOf('year'), moment().endOf('month')],
          'Año pasado'  : [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
          'Hace 1 año'  : [moment().subtract(12, 'month').startOf('month'), moment().subtract(0, 'month').endOf('month')],
          'Hace 2 año'  : [moment().subtract(24, 'month').startOf('month'), moment().subtract(0, 'month').endOf('month')]
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
      function (des, has, label) {  
        $('#daterange-btn span').html(des.format('YYYY/MM/DD') + ' | ' + has.format('YYYY/MM/DD'));      
      }
    )
    $('#fecha').val(des.format('YYYY/MM/DD') + ' - ' + has.format('YYYY/MM/DD'));
    $('#fecha_comparacion').val(formar_fecha_comparacion(des.format('YYYY-MM-DD'), has.format('YYYY-MM-DD')));
  })
  
  function formar_fecha_comparacion(desde, hasta) {
    var fecha1 = moment(desde);
    var fecha2 = moment(hasta);
    var diferencia =fecha2.diff(fecha1);
    var desdeComparacion= moment(Date.parse(fecha1)-diferencia).subtract(1, 'day');
    var hastaComparacion= moment(Date.parse(fecha2)-diferencia).subtract(1, 'day');
    var fecha_comparacion= desdeComparacion.format('YYYY/MM/DD') + ' - ' + hastaComparacion.format('YYYY/MM/DD');
    return fecha_comparacion
}
 

 $('#camp').change(function()
  {
    var valor = $(this).val();
    
    // Lista de modelos
    $.post( 'keywords.php', { valor: valor} ).done( function( respuesta )
    {
      $( '#key' ).html( respuesta );
    });
  });

$('#my_reports').addClass("active");
$('#my_reports_examples').addClass("show");
$('#graphics_fb').addClass("active");

    var periodo = $('#periodo').val();
   
    $("#fecha").val(fecha);
    $("#pdo").val(periodo);          
    var x = new Array();
    var y = new Array();
    var params ={

            "ACT": '99'             
        };

 $.ajax({
            data:   params,  
            url:    'datos.php', 
            type:   'post',
            beforeSend: function () { //before make the ajax call
                var chart = $('#container').highcharts();
                //chart.showLoading();
            },
            error: function(response){ //if an error happens it will be processed here
                var chart = $('#container').highcharts();
                chart.hideLoading();
                alert("error: Chart error"); 
                popup('popUpDiv');
            },
            success: function(DatosRecuperados) {

                $.each(DatosRecuperados, function(i,o){

                    if (o.x) {x[i] = parseInt(o.x);}
                    if (o.y) {y[i] = parseFloat(o.y);}

               });
                    

                  $('#link0').html('<table id="example99" class="cell-border compact stripe"><thead style="text-align: center;"><tr><th> Año </th><th> Mes </th><th>Nuevos Likes</th><th>Dislikes</th><th>Balance</th></tr></thead><tbody id="example99"></tbody></table>');
                  $.each(DatosRecuperados, function(i, d) {
                  
                  $('#example99').append('<tr><td>'+d.ano+'</td><td>'+d.mes+'</td><td>'+d.x+'</td><td>'+d.y+'</td><td>'+(d.x-d.y)+'</td></tr>');
                  });
                //console.log(x);
                                $('#container').highcharts({
                  chart: {
                    type: 'column'
                  },
                  title: {
                    text: 'Nuevos likes vs Dislikes'
                  },
                  xAxis: {
                    categories: ['Ene', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
                  },
                  yAxis: {
                    min: 0,
                    title: {
                      text: 'Likes a la fecha'
                    },
                    stackLabels: {
                      enabled: false,
                      style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                      }
                    }
                  },
                  legend: {
                    align: 'right',
                    x: -30,
                    verticalAlign: 'top',
                    y: 25,
                    floating: true,
                    backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                    borderColor: '#CCC',
                    borderWidth: 1,
                    shadow: false
                  },
                  /*tooltip: {
                    headerFormat: '<b>{point.x}</b><br/>',
                    pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                  },*/
                   exporting: {
                                        enabled: false
                                    },
                  plotOptions: {
                    column: {
                      stacking: 'normal',
                      dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                      }
                    }
                  },
                 series: [{
                    name: 'Dislikes',
                    data: y,
                    color: '#CA1A15'
                  },
                  {
                    name: 'Nuevos Likes',
                    data: x,
                    color: '#004F82'
                  }]
                });

                $('#example99').DataTable({
              dom: 'Bfrtip',
              processing: true,
             
              pageLength: 10,
              buttons: [{
                extend: 'excel',
                title: 'Nuevos likes vs Dislikes',
                filename: 'LikesVsDislikes'
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
                          previous:   "Anterior",
                          next:       "Siguiente",
                          last:       "Anterior"
                      }
                      
                      }
            });
               
        }


        });

function actualizar_en_tiempo_real() {
    GenerarGraficos($('a.active').data('id'));
}

function GenerarGraficos(id){

    var periodo = $('#periodo').val();
    var fecha = $('#daterange-btn').val();
    var id_page = "<?= $_GET['psid']?>";
    var fechas_a_comparar = fecha.split(" - ");
    $("#fecha").val(fecha);
    $("#fecha_comparacion").val(formar_fecha_comparacion(fechas_a_comparar[0], fechas_a_comparar[1]) );
    $("#pdo").val(periodo);
    $("#id_page").val(id_page);

    var x = new Array();
    var y = new Array();
    var z = new Array()
    var w = new Array();
    var d = new Array();
    var ef = new Array();
    var em = new Array();
    var eu = new Array();
    var ed = new Array();
    var ds = new Array();
    var f;
    var m;
    var u;  
    var titulo;
    var titulo2;

    var params ={

            "ACT": id,
            "fecha": fecha,
            "periodo": periodo,             
            "id_page": id_page             
        };
//console.log(params);
 $.ajax({
            data:   params,  
            url:    'datos.php', 
            type:   'post',
            beforeSend: function () { //before make the ajax call
                var chart = $('#container').highcharts();
                //chart.showLoading();
            },
            error: function(response){ //if an error happens it will be processed here
                var chart = $('#container').highcharts();
                chart.hideLoading();
                alert("error: Chart error"); 
                popup('popUpDiv');
            },
            success: function(DatosRecuperados) {
               

                $.each(DatosRecuperados, function(i,o){

                    if (o.x!=null) {x[i] = parseInt(o.x);} else{x[i]=0; }
                    if (o.y) {y[i] = parseInt(o.y);} else{y[i]=0; }
                    if (o.w) {w[i] = parseFloat(o.w);}
                    if (o.z) {z[i] = parseFloat(o.z);}
                    if (o.ds) {ds[i] = parseFloat(o.ds);}
                    if (o.f) {f = parseFloat(o.f);}
                    if (o.m) {m = parseFloat(o.m);}
                    if (o.u) {u = parseFloat(o.u);}
                    
                    
                    if(id==7){
                      var  edad = (o.s).split('.');
    
                      if(edad[1]=='13-17'){if(edad[0]=='F'){ef[0] = parseInt(o.b);}if(edad[0]=='M'){em[0] = parseInt(o.b);}if(edad[0]=='U'){eu[0] = parseInt(o.b);}}
                      if(edad[1]=='18-24'){if(edad[0]=='F'){ef[1] = parseInt(o.b);}if(edad[0]=='M'){em[1] = parseInt(o.b);}if(edad[0]=='U'){eu[1] = parseInt(o.b);}}
                      if(edad[1]=='25-34'){if(edad[0]=='F'){ef[2] = parseInt(o.b);}if(edad[0]=='M'){em[2] = parseInt(o.b);}if(edad[0]=='U'){eu[2] = parseInt(o.b);}}
                      if(edad[1]=='35-44'){if(edad[0]=='F'){ef[3] = parseInt(o.b);}if(edad[0]=='M'){em[3] = parseInt(o.b);}if(edad[0]=='U'){eu[3] = parseInt(o.b);}}
                      if(edad[1]=='45-54'){if(edad[0]=='F'){ef[4] = parseInt(o.b);}if(edad[0]=='M'){em[4] = parseInt(o.b);}if(edad[0]=='U'){eu[4] = parseInt(o.b);}}
                      if(edad[1]=='55-64'){if(edad[0]=='F'){ef[5] = parseInt(o.b);}if(edad[0]=='M'){em[5] = parseInt(o.b);}if(edad[0]=='U'){eu[5] = parseInt(o.b);}}
                      if(edad[1]=='65+')  {if(edad[0]=='F'){ef[6] = parseInt(o.b);}if(edad[0]=='M'){em[6] = parseInt(o.b);}if(edad[0]=='U'){eu[6] = parseInt(o.b);}}
                      ed=['13-17','18-24','25-34','35-44','45-54','55-64','65+'];
                    }


                     if(periodo=='a'){
                      titulo = 'Mes'; 
                      titulo2 = 'Dia'; 
                      d[i] ='Dia '+parseInt(o.d);
                   
                    }

                    if(periodo=='b'){
                      titulo = 'Año'; 
                      titulo2 = 'Semana'; 
                      d[i] ='Semana '+parseInt(o.d);
                   
                    }

                    if(periodo=='c'){
                     
                    if (o.d==1) {d[i] = 'Ene';}
                    if (o.d==2) {d[i] = 'Feb';}
                    if (o.d==3) {d[i] = 'Mar';}
                    if (o.d==4) {d[i] = 'Abr';}
                    if (o.d==5) {d[i] = 'May';}
                    if (o.d==6) {d[i] = 'Jun';}
                    if (o.d==7) {d[i] = 'Jul';}
                    if (o.d==8) {d[i] = 'Ago';}
                    if (o.d==9) {d[i] = 'Sep';}
                    if (o.d==10) {d[i] = 'Oct';}
                    if (o.d==11) {d[i] = 'Nov';}
                    if (o.d==12) {d[i] = 'Dic';}
                    titulo = 'Año'; 
                    titulo2 = 'Mes'; 

                    }
                    
               });
              
              
                  

             if(id==0){
                  var costo = new Array();
                  $('#link0').html('<table id="example0" class="cell-border compact stripe"><thead style="text-align: center;"><tr><th> '+titulo+' </th><th> '+titulo2+' </th><th>Nuevos Likes</th><th>Dislikes</th><th>Balance</th></tr></thead><tbody id="example0"></tbody></table>');




                     $.each(DatosRecuperados['dos'], function(ii, d) {


                      if(periodo=='c'){
                 
                      if(d.dd==1){ if (d.costo!=null) { z[0] = Math.round(parseFloat(d.costo)*100)/100;} else {z[0] =0;}} 
                      else if(d.dd==2){ if (d.costo!=null) { z[1] = Math.round(parseFloat(d.costo)*100)/100;} else {z[1] =0;}} 
                      else if(d.dd==3){ if (d.costo!=null) { z[2] = Math.round(parseFloat(d.costo)*100)/100;} else {z[2] =0;}}
                      else if(d.dd==4){ if (d.costo!=null) { z[3] = Math.round(parseFloat(d.costo)*100)/100;} else {z[3] =0;}}  
                      else if(d.dd==5){ if (d.costo!=null) { z[4] = Math.round(parseFloat(d.costo)*100)/100;} else {z[4] =0;}} 
                      else if(d.dd==6){ if (d.costo!=null) { z[5] = Math.round(parseFloat(d.costo)*100)/100;} else {z[5] =0;}} 
                      else if(d.dd==7){ if (d.costo!=null) { z[6] = Math.round(parseFloat(d.costo)*100)/100;} else {z[6] =0;}} 
                      else if(d.dd==8){ if (d.costo!=null) { z[7] = Math.round(parseFloat(d.costo)*100)/100;} else {z[7] =0;}} 
                      else if(d.dd==9){ if (d.costo!=null) { z[8] = Math.round(parseFloat(d.costo)*100)/100;} else {z[8] =0;}} 
                      else if(d.dd==10){ if (d.costo!=null) { z[9] = Math.round(parseFloat(d.costo)*100)/100;} else {z[9] =0;}} 
                      else if(d.dd==11){ if (d.costo!=null) { z[10] = Math.round(parseFloat(d.costo)*100)/100;} else {z[10] =0;}} 
                      else if(d.dd==12){ if (d.costo!=null) { z[11] = Math.round(parseFloat(d.costo)*100)/100;} else {z[11] =0;}}
                      }

                      else{
                        if (d.costo!=null) { costo[ii] = Math.round(parseFloat(d.costo)*100)/100;} else {costo[ii] =0;}




                      }


                  });



                  $.each(DatosRecuperados['uno'], function(i,o){

                    if (o.x!=null) {x[i] = parseInt(o.x);} else{x[i]=0; }
                    if (o.y) {y[i] = parseInt(o.y);} else{y[i]=0; }

                     if(periodo=='a'){
                      titulo = 'Mes'; 
                      titulo2 = 'Dia'; 
                      d[i] ='Dia '+parseInt(o.d);
                   
                    }

                    if(periodo=='b'){
                      titulo = 'Año'; 
                      titulo2 = 'Semana'; 
                      d[i] ='Semana '+parseInt(o.d);
                   
                    }

                    if(periodo=='c'){

                     
                    if (o.d==1) {d[i] = 'Ene'; if(z[i-1]==null){ costo[i]=0;} else{ costo[i]=z[i-1]; }}
                    if (o.d==2) {d[i] = 'Feb'; if(z[i-1]==null){ costo[i]=0;} else{ costo[i]=z[i-1]; }}
                    if (o.d==3) {d[i] = 'Mar'; if(z[i-1]==null){ costo[i]=0;} else{ costo[i]=z[i-1]; }}
                    if (o.d==4) {d[i] = 'Abr'; if(z[i-1]==null){ costo[i]=0;} else{ costo[i]=z[i-1]; }}
                    if (o.d==5) {d[i] = 'May'; if(z[i-1]==null){ costo[i]=0;} else{ costo[i]=z[i-1]; }}
                    if (o.d==6) {d[i] = 'Jun'; if(z[i-1]==null){ costo[i]=0;} else{ costo[i]=z[i-1]; }}
                    if (o.d==7) {d[i] = 'Jul'; if(z[i-1]==null){ costo[i]=0;} else{ costo[i]=z[i-1]; }}
                    if (o.d==8) {d[i] = 'Ago'; if(z[i-1]==null){ costo[i]=0;} else{ costo[i]=z[i-1]; }}
                    if (o.d==9) {d[i] = 'Sep'; if(z[i-1]==null){ costo[i]=0;} else{ costo[i]=z[i-1]; }}
                    if (o.d==10) {d[i] = 'Oct'; if(z[i-1]==null){ costo[i]=0;} else{ costo[i]=z[i-1]; }}
                    if (o.d==11) {d[i] = 'Nov'; if(z[i-1]==null){ costo[i]=0;} else{ costo[i]=z[i-1]; }}
                    if (o.d==12) {d[i] = 'Dic'; if(z[i-1]==null){ costo[i]=0;} else{ costo[i]=z[i-1]; }}
                    titulo = 'Año'; 
                    titulo2 = 'Mes'; 

                    }
                    

                 
                  

                  $('#example0').append('<tr><td>'+o.z+'</td><td>'+o.d+'</td><td>'+o.x+'</td><td>'+o.y+'</td><td>'+(o.x-o.y)+'</td></tr>');
                  });

                     

                      // $.each(DatosRecuperados['dos'], function(ii, d) {


                      //  });
                  
                //  console.log(costo,DatosRecuperados['dos']);
                  

      
 


                  $('#container').highcharts({
                    chart: {
                      type: 'column'
                    },
                    title: {
                      text: 'Nuevos likes vs Dislikes'
                    },
                    xAxis: {
                      categories: d
                    },
                    yAxis: {
                      min: 0,
                      title: {
                        text: 'Likes a la fecha'
                      },
                      stackLabels: {
                        enabled: false,
                        style: {
                          fontWeight: 'bold',
                          color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                        }
                      }
                    },
                    legend: {
                      align: 'right',
                      x: -30,
                      verticalAlign: 'top',
                      y: 25,
                      floating: true,
                      backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                      borderColor: '#CCC',
                      borderWidth: 1,
                      shadow: true
                    },
                  /* tooltip: {
                      headerFormat: '<b>{point.x}</b><br/>',
                      pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}',
                      backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
                    },*/
                     exporting: {
                                          enabled: false
                                      },
                    plotOptions: {
                      column: {
                        stacking: 'normal',
                        dataLabels: {
                          enabled: true,
                          color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                        }
                      }
                    },
                    series: [{
                      name: 'Dislikes',
                      data: y,
                      color: '#CA1A15'
                    },
                    {
                      name: 'Nuevos Likes',
                      data: x,
                      color: '#004F82'
                    }
                    ,
                     /*{ Linea rosada que no funciona por los momentos
                                name: 'Inversión',
                                type: 'spline',
                                color:'#F15C80',
                                max: 1,
                                data: costo,
                                tooltip: {
                                valueSuffix: ' $ '
                                }
                                }*/
                                
                                ]
                  });

             }


             if(id=='1'){
                 
                  
                    $('#link1').html('<table id="example1" class="cell-border compact stripe"><thead style="text-align: center;"><tr><th> '+titulo+' </th><th> '+titulo2+' </th><th>Likes a la fecha</th><th>Dislikes</th></tr></thead><tbody id="example1"></tbody></table>');
                  $.each(DatosRecuperados, function(i, d) {
                  
                  $('#example1').append('<tr><td>'+d.z+'</td><td>'+d.d+'</td><td>'+d.x+'</td><td>'+d.y+'</td></tr>');
                  });

                           $('#container').highcharts({
                                 chart: {
                    zoomType: 'xy'
                },
                title: {
                    text: 'Histórico de Likes vs Dislikes'
                },
               /* subtitle: {
                    text: 'Source: WorldClimate.com'
                },*/
                xAxis: [{
                    categories: d,
                    crosshair: true
                }],
                yAxis: [{ // Primary yAxis
                  
                    labels: {

                        format: '{value}',
                        style: {
                            color: '#F15C80'
                        }
                    },
                    title: {
                        text: 'Dislikes',
                        style: {
                            color: '#F15C80'
                        }
                    },
                    opposite: true

                }, { // Secondary yAxis
                    gridLineWidth: 0,
                    title: {
                        text: 'Likes a la fecha',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    },
                    labels: {
                        format: '{value}',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    }

                },],
                              tooltip: {
                                shared: true
                                },
                              legend: {
                                layout: 'vertical',
                                align: 'left',
                                x: 80,
                                verticalAlign: 'top',
                                y: 55,
                                floating: true,
                                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
                                },

                                exporting: {
                                    enabled: false
                                },
                              series: [{
                                name: 'Likes a la fecha',
                                type: 'column',
                                yAxis: 1,
                                color:'#004F82',
                                data: x,
                                tooltip: {
                                valueSuffix: ''
                                }
                                
                                },  {
                                name: 'Dislikes',
                                type: 'spline',
                                color:'#F15C80',
                                max: 1,
                                data: y,
                                tooltip: {
                                valueSuffix: ''
                                }
                                }]
                            });
             }



             if(id==2){



                    $('#link2').html('<table id="example2" class="cell-border compact stripe"><thead style="text-align: center;"><tr><th> '+titulo+' </th><th> '+titulo2+' </th><th>Likes a la fecha</th><th>Nuevos Likes</th><th>% Crecimiento de Likes</th></tr></thead><tbody id="example2"></tbody></table>');
                  $.each(DatosRecuperados, function(i, d) {
                  
                  $('#example2').append('<tr><td>'+d.z+'</td><td>'+d.d+'</td><td>'+d.x+'</td><td>'+d.y+'</td><td>'+d.w+' %</td></tr>');
                  });
                  
                 // concole.log(d);



                      $('#container').highcharts({
                                       chart: {
                          zoomType: 'xy'
                      },
                      title: {
                          text: 'Crecimiento de Likes'
                      },
                     /* subtitle: {
                          text: 'Source: WorldClimate.com'
                      },*/
                      xAxis: [{
                          categories: d,
                          crosshair: true
                      }],
                      yAxis: [{ // Primary yAxis
                          labels: {
                              format: '{value}%',
                              style: {
                                  color: '#00AD82'
                              }
                          },
                          title: {
                              text: 'Likes Ganados',
                              style: {
                                  color: '#00AD82'
                              }
                          },
                          opposite: true

                      }, { // Secondary yAxis
                          gridLineWidth: 0,
                          title: {
                              text: 'Likes a la fecha',
                              style: {
                                  color: Highcharts.getOptions().colors[0]
                              }
                          },
                          labels: {
                              format: '{value}',
                              style: {
                                  color: Highcharts.getOptions().colors[0]
                              }
                          }

                      },
                      { // Tertiary yAxis
                      gridLineWidth: 0,
                      title: {
                        text: 'Nuevos Likes',
                        style: {
                          color: Highcharts.getOptions().colors[1]
                        }
                      },
                      labels: {
                        format: '{value}',
                        style: {
                          color: Highcharts.getOptions().colors[1]
                        }
                      },
                      opposite: true
                    }],
                                    tooltip: {
                                      shared: true
                                      },
                                    legend: {
                                      layout: 'vertical',
                                      align: 'left',
                                      x: 80,
                                      verticalAlign: 'top',
                                      y: 55,
                                      floating: true,
                                      backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
                                      },

                                      exporting: {
                                          enabled: false
                                      },
                                    series: [{
                                      name: 'Likes a la fecha',
                                      type: 'column',
                                      yAxis: 1,
                                      color:'#004F82',
                                      data: x,
                                      tooltip: {
                                      valueSuffix: ''
                                      }
                                      
                                      }, 
                                      {
                                    name: 'Nuevos Likes',
                                    type: 'spline',
                                    yAxis: 2,
                                    color:'#00CA79',
                                    data: y,
                                    marker: {
                                      enabled: false
                                    },
                                    dashStyle: 'shortdot',
                                    tooltip: {
                                      valueSuffix: ''
                                    }

                                     },
                                      {
                                      name: 'Crecimiento de Likes',
                                      type: 'spline',
                                      color:'#00AD82',
                                      data: w,
                                      tooltip: {
                                      valueSuffix: ''
                                      }
                                      }]
                                  });

             }





              if(id==3){


                    
                  $('#link3').html('<table id="example3" class="cell-border compact stripe"><thead style="text-align: center;"><tr><th> '+titulo+' </th><th> '+titulo2+' </th><th>Nuevos Likes</th><th>Dislikes</th><th>Balance</th></tr></thead><tbody id="example3"></tbody></table>');
                  $.each(DatosRecuperados, function(i, d) {
                  
                  $('#example3').append('<tr><td>'+d.z+'</td><td>'+d.d+'</td><td>'+d.x+'</td><td>'+d.y+'</td><td>'+d.w+'</td></tr>');
                  });

                                 $('#container').highcharts({
                                chart: {
                                  type: 'bar'
                                },
                                title: {
                                  text: 'Como se consiguieron los Likes (Total)'
                                },
                                xAxis: {
                                  categories: d
                                },
                                yAxis: {
                                  //min: 0,
                                  title: {
                                    text: 'Porcentaje'
                                  }
                                },
                                legend: {
                                  reversed: true
                                },
                                tooltip: {
                                pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
                                shared: true
                                },
                                exporting: {
                                          enabled: false
                                },
                                plotOptions: {
                                  series: {
                                    stacking: 'normal'
                                  }
                                },
                                series: [{
                                  name: 'Pagados',
                                  color:'#004F82',
                                  data: x
                                },{
                                  name: 'Organicos',
                                  color:'#00CA79',
                                  data: y
                                }]
                              });
              }



               if(id==4){


                    
                  $('#link4').html('<table id="example4" class="cell-border compact stripe"><thead style="text-align: center;"><tr><th> '+titulo+' </th><th> '+titulo2+' </th><th>Pagados (%)</th><th>Organicos (%)</th></tr></thead><tbody id="example4"></tbody></table>');
                  $.each(DatosRecuperados, function(i, d) {
                   if (d.x!=null) {x[i] = parseFloat(d.x);} else{x[i]=0; }
                    if (d.y) {y[i] = parseFloat(d.y);} else{y[i]=0; }
                  $('#example4').append('<tr><td>'+d.z+'</td><td>'+d.d+'</td><td>'+d.x+' %</td><td>'+d.y+' %</td></tr>');
                  });

                                 $('#container').highcharts({
                                chart: {
                                  type: 'bar'
                                },
                                title: {
                                  text: 'Como se consiguieron los Likes (Total)'
                                },
                                xAxis: {
                                  categories: d
                                },
                                yAxis: {
                                  min: 0,
                                  max: 100,
                                  labels: {
                                  format: '{value}%',
                                  style: {
                                      color: '#00AD82'
                                  }
                                  },
                                  title: {
                                    text: 'Porcentaje (%)'
                                  }
                                },
                                legend: {
                                  reversed: true
                                },
                                tooltip: {
                                pointFormat: '<span style="color:{series.color}">{series.name}</span>: ({point.percentage:.1f}%)<br/>',
                                shared: true
                                },
                                exporting: {
                                          enabled: false
                                },
                                plotOptions: {
                                  series: {
                                    stacking: 'normal'
                                  }
                                },

                                series: [{
                                  name: 'Pagados',
                                  color:'#004F82',
                                  data: x
                                },{
                                  name: 'Organicos',
                                  color:'#00CA79',
                                  data: y
                                }]
                              });
              }


              if(id==5){

                $('#link5').html('<table id="example5" class="cell-border compact stripe"><thead style="text-align: center;"><tr><th> '+titulo+' </th><th> '+titulo2+' </th><th>Nuevos Likes</th></tr></thead><tbody id="example5"></tbody></table>');
                  $.each(DatosRecuperados, function(i, d) {
                  
                  $('#example5').append('<tr><td>'+d.z+'</td><td>'+d.d+'</td><td>'+d.x+'</td></tr>');
                  });


                            $('#container').highcharts({
                                        chart: {
                                          type: 'column'
                                        },
                                        title: {
                                          text: 'Nuevos fans netos'
                                        },
                                        xAxis: {
                                          categories: d,
                                          labels: {
                                            rotation: -45,
                                            style: {
                                              fontSize: '13px',
                                              fontFamily: 'Verdana, sans-serif'
                                            }
                                          }
                                        },
                                        yAxis: {
                                          min: 0,
                                          title: {
                                            text: 'Cantidad de Fans'
                                          }
                                        },
                                        legend: {
                                          enabled: false
                                        },
                                        tooltip: {
                                          pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b>',
                                          shared: true
                                          },
                                         exporting: {
                                         enabled: false
                                         },
                                        series: [{
                                          name: 'Fans Netos',
                                          data: x,
                                          color: '#004F82',
                                          dataLabels: {
                                            enabled: true,
                                            rotation: -90,
                                            color: '#FFFFFF',
                                            align: 'right',
                                            //format: '{point.y:.1f}', // one decimal
                                            y: 10, // 10 pixels down from the top
                                            style: {
                                              fontSize: '13px',
                                              fontFamily: 'Verdana, sans-serif'
                                            }
                                          }
                                        }]
                                      });
              }


              if(id==6){
 
                $('#link6').html('<table id="example6" class="cell-border compact stripe"><thead style="text-align: center;"><tr><th> Rango de Fecha </th><th> Hombre (%)</th><th> Mujer (%)</th><th> Otros (%)</th></tr></thead><tbody id="example6"></tbody></table>');
                  $.each(DatosRecuperados, function(i, d) {
                  console.log("Likes: ",DatosRecuperados); 
                  $('#example6').append('<tr><td>'+fecha+'</td><td>'+d.m+' %</td><td>'+d.f+' %</td><td>'+d.u+' %</td></tr>');
                  });

                           $('#container').highcharts({
                            chart: {
                              plotBackgroundColor: null,
                              plotBorderWidth: null,
                              plotShadow: false,
                              type: 'pie'
                            },
                            title: {
                              text: 'Perfil de likes Demográfico'
                            },
                            tooltip: {
                              pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                            },
                            exporting: {
                              enabled: false 
                              },
                            plotOptions: {
                              pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                //colors: pieColors,
                                dataLabels: {
                                  enabled: true,
                                  format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                                  distance: -50,
                                  filter: {
                                    property: 'percentage',
                                    operator: '>',
                                    value: 4
                                  }
                                }
                              }
                            },
                            series: [{
                              name: 'Fans',
                              data: [
                                 { name: 'Mujer',
                                 color: '#F15C80 ',
                                  y: f
                                   },
                                { name: 'Hombre',
                                color: '#004F82 ',
                                 y: m
                                  },
                               
                                { name: 'Otros',
                                 color: '#434348 ',
                                  y: u 
                                },
                               
                              ]
                            }]
                          });
                     }  

                     if(id==7){


                       $('#link7').html('<table id="example7" class="cell-border compact stripe"><thead style="text-align: center;"><tr><th>Rango de Edad</th><th>Hombre</th><th>Mujer</th><th>Otros</th></tr></thead><tbody id="example7"></tbody></table>');
                       $.each(ed, function(i) {
                       
                       $('#example7').append('<tr><td>'+ed[i]+'</td><td>'+em[i]+'</td><td>'+ef[i]+'</td><td>'+eu[i]+'</td></tr>');
                       });
                  
                 

                                $('#container').highcharts({
                                  chart: {
                                    type: 'column'
                                  },
                                  title: {
                                    text: 'Perfil Fans Edades'
                                  },
                                 
                                  xAxis: {
                                    categories: ed,
                                    crosshair: true
                                  },
                                  yAxis: {
                                    min: 0,
                                    title: {
                                      text: 'Fans'
                                    }
                                  },
                                  tooltip: {
                                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                      '<td style="padding:0"><b>{point.y}</b></td></tr>',
                                    footerFormat: '</table>',
                                    shared: true,
                                    useHTML: true
                                  },
                                  exporting: {
                                   enabled: false
                                  },
                                  plotOptions: {
                                    column: {
                                      pointPadding: 0.2,
                                      borderWidth: 0
                                    }
                                  },
                                  series: [{
                                    name: 'Hombre',
                                    color: '#004F82 ',
                                    data: em

                                  }, {
                                    name: 'Mujer',
                                    color: '#F15C80 ',
                                    data: ef

                                  }, {
                                    name: 'Otros',
                                    color: '#434348 ',
                                    data: eu

                                  }]
                                });

                     }

                if(id==8){

                $('#link8').html('<table id="example8" class="cell-border compact stripe"><thead style="text-align: center;"><tr><th> '+titulo+' </th><th> '+titulo2+' </th><th>Alcance</th></tr></thead><tbody id="example8"></tbody></table>');
                  $.each(DatosRecuperados, function(i, d) {
                  
                  $('#example8').append('<tr><td>'+d.z+'</td><td>'+d.d+'</td><td>'+d.x+'</td></tr>');
                  });
                  
                 // concole.log(d);



                            $('#container').highcharts({
                                        chart: {
                                          type: 'column'
                                        },
                                        title: {
                                          text: 'Alcance'
                                        },
                                        xAxis: {
                                          categories: d,
                                          labels: {
                                            rotation: -45,
                                            style: {
                                              fontSize: '13px',
                                              fontFamily: 'Verdana, sans-serif'
                                            }
                                          }
                                        },
                                        yAxis: {
                                          min: 0,
                                          title: {
                                            text: 'Cantidad de Alcance'
                                          }
                                        },
                                        legend: {
                                          enabled: false
                                        },
                                        tooltip: {
                                          pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b>',
                                          shared: true
                                          },
                                         exporting: {
                                         enabled: false
                                         },
                                        series: [{
                                          name: 'Alcance',
                                          data: x,
                                          color: '#00CA79',
                                          dataLabels: {
                                            enabled: true,
                                            rotation: -90,
                                            color: '#FFFFFF',
                                            align: 'right',
                                            //format: '{point.y:.1f}', // one decimal
                                            y: 10, // 10 pixels down from the top
                                            style: {
                                              fontSize: '13px',
                                              fontFamily: 'Verdana, sans-serif'
                                            }
                                          }
                                        }]
                                      });
              }






                      if(id==9){

                $('#link9').html('<table id="example9" class="cell-border compact stripe"><thead style="text-align: center;"><tr><th> '+titulo+' </th><th> '+titulo2+' </th><th>Alcance</th></tr></thead><tbody id="example9"></tbody></table>');
                  $.each(DatosRecuperados, function(i, d) {

                  $('#example9').append('<tr><td>'+d.z+'</td><td>'+d.d+'</td><td>'+d.x+'</td></tr>');
                  });
                  
              



                            $('#container').highcharts({
                                        chart: {
                                          type: 'column'
                                        },
                                        title: {
                                          text: 'Interacciones'
                                        },
                                        xAxis: {
                                          categories: d,
                                          labels: {
                                            rotation: -45,
                                            style: {
                                              fontSize: '13px',
                                              fontFamily: 'Verdana, sans-serif'
                                            }
                                          }
                                        },
                                        yAxis: {
                                          min: 0,
                                          title: {
                                            text: 'Cantidad de Interacciones'
                                          }
                                        },
                                        legend: {
                                          enabled: false
                                        },
                                        tooltip: {
                                          pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b>',
                                          shared: true
                                          },
                                         exporting: {
                                         enabled: false
                                         },
                                        series: [{
                                          name: 'Interacciones',
                                          data: x,
                                          color: '#ED7D31',
                                          dataLabels: {
                                            enabled: true,
                                            rotation: -90,
                                            color: '#FFFFFF',
                                            align: 'right',
                                            //format: '{point.y:.1f}', // one decimal
                                            y: 10, // 10 pixels down from the top
                                            style: {
                                              fontSize: '13px',
                                              fontFamily: 'Verdana, sans-serif'
                                            }
                                          }
                                        }]
                                      });
              }



             if(id==10){



                    
                  $('#link10').html('<table id="example10" class="cell-border compact stripe"><thead style="text-align: center;"><tr><th>Rango de Edad</th><th>Hombre</th><th>Mujer</th><th>Otros</th></tr></thead><tbody id="example10"></tbody></table>');
                      $.each(DatosRecuperados, function(i, d) {
                    if (d.f) {ef[i] = parseFloat(d.f);}
                    if (d.m) {em[i] = parseFloat(d.m);}
                    if (d.u) {eu[i] = parseFloat(d.u);}
                    if (d.ds) {ds[i] = d.ds;}
                       
                       $('#example10').append('<tr><td>'+d.ds+'</td><td>'+d.m+'</td><td>'+d.f+'</td><td>'+d.u+'</td></tr>');
                       });

                    //console.log(DatosRecuperados);
                                 $('#container').highcharts({
                                chart: {
                                  type: 'bar'
                                },
                                title: {
                                  text: 'Como se consiguieron los Likes (Total)'
                                },
                                xAxis: {

                                  categories: d
                                },
                                yAxis: {
                                  min: 0,
                                  max: 100,
                                  labels: {
                              format: '{value}%',
                              style: {
                                  color: '#00AD82'
                              }
                          },
                                  title: {
                                    text: 'Porcentaje (%)'
                                  }
                                },
                                legend: {
                                  reversed: true
                                },
                                tooltip: {
                                pointFormat: '<span style="color:{series.color}">{series.name}</span>:  ({point.percentage:.1f}%)<br/>',
                                shared: true
                                },
                                exporting: {
                                          enabled: false
                                },
                                plotOptions: {
                                  series: {
                                    stacking: 'normal'
                                  }
                                },
                                series: [{
                                  name: 'Otros',
                                  color:'#434348',
                                  data: eu
                                },
                                {
                                  name: 'Mujer',
                                  color:'#F15C80',      
                                  data: ef
                                },
                                {
                                  name: 'Hombre',
                                  color:'#004F82',
                                  data: em
                                }
                                ]
                              });
              } 



               if(id==11){

                $('#link11').html('<table id="example11" class="cell-border compact stripe"><thead style="text-align: center;"><tr><th> Hora </th><th>Max Fans</th></tr></thead><tbody id="example11"></tbody></table>');
                  $.each(DatosRecuperados, function(i, d) {

                    if (d.h) {ds[i] = parseInt(d.h);}
                    if (d.f) {x[i] = parseInt(d.f);}
                   
                  
                  $('#example11').append('<tr><td>'+d.h+'</td><td>'+d.f+'</td></tr>');
                  });
                  
                 // concole.log(d);



                            $('#container').highcharts({
                                        chart: {
                                          type: 'column'
                                        },
                                        title: {
                                          text: 'Fans Online'
                                        },
                                        xAxis: {
                                          categories: ds,
                                       
                                          labels: {
                                            format: '{value}:00',
                                            rotation: -45,
                                            style: {
                                              fontSize: '13px',
                                              fontFamily: 'Verdana, sans-serif',
                                              color: '#00AD82'
                                            }
                                          }
                                        },
                                        yAxis: {
                                          min: 0,
                                          
                                          title: {
                                            text: 'Cantidad de Fans Online'
                                          }
                                        },
                                        legend: {
                                          enabled: false
                                        },
                                        tooltip: {
                                          pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b>',
                                          shared: true
                                          },
                                         exporting: {
                                         enabled: false
                                         },
                                        series: [{
                                          name: 'Alcance',
                                          data: x,
                                          color: '#004F82',
                                          dataLabels: {
                                            enabled: true,
                                            rotation: -90,
                                            color: '#FFFFFF',
                                            align: 'right',
                                            //format: '{point.y:.1f}', // one decimal
                                            y: 10, // 10 pixels down from the top
                                            style: {
                                              fontSize: '13px',
                                              fontFamily: 'Verdana, sans-serif'
                                            }
                                          }
                                        }]
                                      });
              }

               if(id=='12'){
                 
                  
                    $('#link12').html('<table id="example12" class="cell-border compact stripe"><thead style="text-align: center;"><tr><th> '+titulo+' </th><th> '+titulo2+' </th><th>Engaged users</th><th>Engagement rate</th></tr></thead><tbody id="example12"></tbody></table>');
                  $.each(DatosRecuperados, function(i, d) {
                  
                  $('#example12').append('<tr><td>'+d.z+'</td><td>'+d.d+'</td><td>'+d.x+'</td><td>'+d.w+'</td></tr>');
                  });

                           $('#container').highcharts({
                                 chart: {
                    zoomType: 'xy'
                },
                title: {
                    text: 'Engaged users vs engagement rate'
                },
               /* subtitle: {
                    text: 'Source: WorldClimate.com'
                },*/
                xAxis: [{
                    categories: d,
                    crosshair: true
                }],
                yAxis: [{ // Primary yAxis
                  
                    labels: {

                        format: '{value}',
                        style: {
                            color: '#F15C80'
                        }
                    },
                    title: {
                        text: 'Engagement rate',
                        style: {
                            color: '#ED7D31'
                        }
                    },
                    opposite: true

                }, { // Secondary yAxis
                    gridLineWidth: 0,
                    title: {
                        text: 'Engaged users',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    },
                    labels: {
                        format: '{value}',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    }

                },],
                              tooltip: {
                                shared: true
                                },
                                valueDecimals: 2,
                              legend: {
                                layout: 'vertical',
                                align: 'left',
                                x: 80,
                                verticalAlign: 'top',
                                y: 55,
                                floating: true,
                                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
                                },

                                exporting: {
                                    enabled: false
                                },
                              series: [{
                                name: 'Engaged users',
                                type: 'column',
                                yAxis: 1,
                                color:'#004F82',
                                data: x,
                                tooltip: {
                                valueSuffix: ''
                                }
                                
                                },  {
                                name: 'Engagement rate',
                                type: 'spline',
                                color:'#ED7D31',
                                max: 1,
                                data: w,
                                tooltip: {
                                valueSuffix: ''
                                }
                                }]
                            });
             }

                if(id=='13'){
                 
                  
                    $('#link13').html('<table id="example13" class="cell-border compact stripe"><thead style="text-align: center;"><tr><th> '+titulo+' </th><th> '+titulo2+' </th><th>Alcance promedio</th><th>Engagement rate</th></tr></thead><tbody id="example13"></tbody></table>');
                  $.each(DatosRecuperados, function(i, d) {
                  
                  $('#example13').append('<tr><td>'+d.z+'</td><td>'+d.d+'</td><td>'+d.x+'</td><td>'+d.w+'</td></tr>');
                  });

                           $('#container').highcharts({
                                 chart: {
                    zoomType: 'xy'
                },
                title: {
                    text: 'Alcance promedio de post vs Engagement Rate'
                },
               /* subtitle: {
                    text: 'Source: WorldClimate.com'
                },*/
                xAxis: [{
                    categories: d,
                    crosshair: true
                }],
                yAxis: [{ // Primary yAxis
                  
                    labels: {

                        format: '{value}',
                        style: {
                            color: '#F15C80'
                        }
                    },
                    title: {
                        text: 'Engagement rate',
                        style: {
                            color: '#ED7D31'
                        }
                    },
                    opposite: true

                }, { // Secondary yAxis
                    gridLineWidth: 0,
                    title: {
                        text: 'Alcance promedio',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    },
                    labels: {
                        format: '{value}',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    }

                },],
                              tooltip: {
                                shared: true
                                },
                                valueDecimals: 2,
                              legend: {
                                layout: 'vertical',
                                align: 'left',
                                x: 80,
                                verticalAlign: 'top',
                                y: 55,
                                floating: true,
                                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
                                },

                                exporting: {
                                    enabled: false
                                },
                              series: [{
                                name: 'Alcance promedio',
                                type: 'column',
                                yAxis: 1,
                                color:'#00CA79',
                                data: x,
                                tooltip: {
                                valueSuffix: ''
                                }
                                
                                },  {
                                name: 'Engagement rate',
                                type: 'spline',
                                color:'#ED7D31',
                                max: 1,
                                data: w,
                                tooltip: {
                                valueSuffix: ''
                                }
                                }]
                            });
             }

                    if(id==14){



                    
                  $('#link14').html('<table id="example14" class="cell-border compact stripe"><thead style="text-align: center;"><tr><th> '+titulo+' </th><th> '+titulo2+' </th><th>Hombre</th><th>Mujer</th><th>Otros</th></tr></thead><tbody id="example14"></tbody></table>');
                      $.each(DatosRecuperados, function(i, d) {
                    if (d.f) {ef[i] = parseFloat(d.f);}
                    if (d.m) {em[i] = parseFloat(d.m);}
                    if (d.u) {eu[i] = parseFloat(d.u);}
                    if (d.ds) {ds[i] = d.ds;}
                       
                       $('#example14').append('<tr><td>'+d.z+'</td><td>'+d.d+'</td><td>'+d.m+'</td><td>'+d.f+'</td><td>'+d.u+'</td></tr>');
                       });

                   // console.log(DatosRecuperados);
                                 $('#container').highcharts({
                                chart: {
                                  type: 'bar'
                                },
                                title: {
                                  text: 'Nuevos Likes Demográfico'
                                },
                                xAxis: {

                                  categories: d
                                },
                                yAxis: {
                                  min: 0,
                                 // max: 100,
                                  labels: {
                              format: '{value}',
                              style: {
                                  color: '#00AD82'
                              }
                          },
                                  title: {
                                    text: 'Cantidad de Likes'
                                  }
                                },
                                legend: {
                                  reversed: true
                                },
                                tooltip: {
                                pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
                                shared: true
                                },
                                exporting: {
                                          enabled: true
                                },
                                plotOptions: {
                                  series: {
                                    stacking: 'normal'
                                  }
                                },
                                series: [{
                                  name: 'Otros',
                                  color:'#434348',
                                  data: eu
                                },
                                {
                                  name: 'Mujer',
                                  color:'#F15C80',      
                                  data: ef
                                },
                                {
                                  name: 'Hombre',
                                  color:'#004F82',
                                  data: em
                                }
                                ]
                              });
              } 








                     if(id==20){
               imp = new Array();
                $('#link20').html('<table id="example20" class="display compact"><thead style="text-align: center; font-size: 10px;"><tr><th> '+titulo+' </th><th> '+titulo2+' </th><th>Impresiones</th></tr></thead><tbody id="example20"></tbody></table>');
                  $.each(DatosRecuperados, function(i, d) {
                  
                  $('#example20').append('<tr><td>'+d.z+'</td><td>'+d.d+'</td><td>'+d.page_impressions+'</td></tr>');
                   if (d.page_impressions) {imp[i] = parseInt(d.page_impressions);}

                  });

                            $('#container').highcharts({
                                        chart: {
                                          type: 'column'
                                        },
                                        title: {
                                          text: 'Impresiones'
                                        },
                                        xAxis: {
                                          categories: d,
                                          labels: {
                                            rotation: -45,
                                            style: {
                                              fontSize: '13px',
                                              fontFamily: 'Verdana, sans-serif'
                                            }
                                          }
                                        },
                                        yAxis: {
                                          min: 0,
                                          title: {
                                            text: 'Cantidad de Impresiones'
                                          }
                                        },
                                        legend: {
                                          enabled: false
                                        },
                                        tooltip: {
                                          pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b>',
                                          shared: true
                                          },
                                         exporting: {
                                         enabled: false
                                         },
                                        series: [{
                                          name: 'Impresiones',
                                          data: imp,
                                          color: '#02C4BE',
                                          dataLabels: {
                                            enabled: true,
                                            rotation: -90,
                                            color: '#FFFFFF',
                                            align: 'right',
                                            //format: '{point.y:.1f}', // one decimal
                                            y: 10, // 10 pixels down from the top
                                            style: {
                                              fontSize: '13px',
                                              fontFamily: 'Verdana, sans-serif'
                                            }
                                          }
                                        }]
                                      });
              }



                     if(id==21){
               clic = new Array();
                $('#link21').html('<table id="example21" class="display compact"><thead style="text-align: center; font-size: 10px;"><tr><th> '+titulo+' </th><th> '+titulo2+' </th><th>Clics</th></tr></thead><tbody id="example21"></tbody></table>');
                  $.each(DatosRecuperados, function(i, d) {
                  
                  $('#example21').append('<tr><td>'+d.z+'</td><td>'+d.d+'</td><td>'+d.clics+'</td></tr>');
                    if (d.clics) {clic[i] = parseInt(d.clics);}

                  });

                            $('#container').highcharts({
                                        chart: {
                                          type: 'column'
                                        },
                                        title: {
                                          text: 'Clicks'
                                        },
                                        xAxis: {
                                          categories: d,
                                          labels: {
                                            rotation: -45,
                                            style: {
                                              fontSize: '13px',
                                              fontFamily: 'Verdana, sans-serif'
                                            }
                                          }
                                        },
                                        yAxis: {
                                          min: 0,
                                          title: {
                                            text: 'Cantidad de Clicks'
                                          }
                                        },
                                        legend: {
                                          enabled: false
                                        },
                                        tooltip: {
                                          pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b>',
                                          shared: true
                                          },
                                         exporting: {
                                         enabled: false
                                         },
                                        series: [{
                                          name: 'Clics',
                                          data: clic,
                                          color: '#E1E100',
                                          dataLabels: {
                                            enabled: true,
                                            rotation: -90,
                                            color: '#FFFFFF',
                                            align: 'right',
                                            //format: '{point.y:.1f}', // one decimal
                                            y: 10, // 10 pixels down from the top
                                            style: {
                                              fontSize: '13px',
                                              fontFamily: 'Verdana, sans-serif'
                                            }
                                          }
                                        }]
                                      });
              }







                                         $('#example'+id).DataTable({
                                        dom: 'Bfrtip',
                                        processing: true,
                                       
                                        pageLength: 10,
                                        buttons: [{
                                          extend: 'excel',
                                          title: 'Reporte',
                                          filename: 'reporte'
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
                                                    previous:   "Anterior",
                                                    next:       "Siguiente",
                                                    last:       "Anterior"
                                                }
                                                
                                                }
                                      });

            


               
                 }


        });
}










</script>
</body>


</html>