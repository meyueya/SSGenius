<?php
session_start();
include('controller/functionsformat.php');
define("NIVEL_MIN_PERMISO",2);
require_once('controller/user.php');
include('../model/ConsultoriaModel.php');
/* $consultoriapost = new ConsultoriaModel;
$informespost = $consultoriapost->traerConsultoriasPost(); */
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
<meta charset="utf-8" />
  <link rel="icon" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" sizes="32x32" />
  <link rel="icon" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" sizes="192x192" />
  <!-- <link rel="apple-touch-icon-precomposed" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" />
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

        .row {
  
      margin-right: 10px;
      margin-left: 10px;
  }

  tbody {
      font-size: 10px;
  }
</style>

</head>
  
<body id="body">


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
        <div class="row" id="analisis">    </div>  
        <div class="container">
        <form id="CrearReporte" action="views/reportekpisreporte.php" method="post">
            <input type="hidden" name="kpis_seleccionados" id="kpis_seleccionados_form"/>
            <input type="hidden" name="kpi_principal" id="kpi_principal_form"/>
            <!-- <input type="text" name="foo" /> -->
            <button type="submit" >Enviar</button>
        </form>

        </div>
        <div class="form-group">
          <label> Comentarios Interacción por Publicación:</label>
            <textarea rows="4" cols="80" class="form-control textarea" id="3"></textarea>
        </div>

 

    <div class="row">
     <div class="col-md-8 saltoDePagina">
      
        <div class="card-body">
        
          <div id="container11" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
        
        </div>
        <div class="form-group">
          <label> Comentario Fans Online:</label>
            <textarea rows="4" cols="80" class="form-control textarea" id="18"></textarea>
        </div>
      </div>

    <div class="col-md-4">
    <div class="tab-pane" id="link11"></div>
    </div>


    <div class="col-md-8 saltoDePagina">
      
        <div class="card-body">
        
          <div id="container10" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
        
        </div>
        <div class="form-group">
          <label> Comentario Likes Demográficos:</label>
            <textarea rows="4" cols="80" class="form-control textarea" id="17"></textarea>
        </div>
      </div>
 
    <div class="col-md-4">
    <div class="tab-pane" id="link10"></div>
    </div>




       <div class="col-md-8 saltoDePagina">
      
        <div class="card-body">
        
          <div id="container24" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
        
        </div>
        <div class="form-group">
          <label> Comentario Likes Demográficos:</label>
            <textarea rows="4" cols="80" class="form-control textarea" id="24"></textarea>
        </div>
      </div>
 
    <div class="col-md-4">
    <div class="tab-pane" id="link24"></div>
    </div>

    </div>



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
  
 
<script>
  var anl = <?= $_GET['anl'] ?>;
  var page_id =<?= $_GET['psid'] ?>;
  var consultoria ={

          "op" : '2',
          "id": <?= $_GET['watch'] ?>,
          "anl": anl,
          "page_id": page_id,
                 
      };

$.ajax({
          data:   consultoria,  
          url:    'controller/procesarconsultoriassg.php', 
          type:   'post',
       
          success: function(DatosRecuperados) {
  var DatosRecuperados=JSON.parse(DatosRecuperados);
$.each(DatosRecuperados['consultoria'], function(i, d) {
if(d.id_analisis==anl){
var conte = i+1;
    var ordenby = d.kpi_principal;
    var titulo_analisis = d.titulo;
    var clave_kpi_principal = d.kpi_principal;
    var info_kpi_analisis = DatosRecuperados['kpiAnalisis'];
    var info_kpi_analisis_json_string =JSON.stringify(DatosRecuperados['kpiAnalisis']);
    //para el formulario
    $( "#kpi_principal_form" ).val(clave_kpi_principal);
    $( "#kpis_seleccionados_form" ).val(info_kpi_analisis_json_string);

    var fecha = '2018/01/01 - 2018/12/31';
    var nombre = d.nombre; // del kpi principal
    var tipo = d.tipo;
    var objetivo = d.objetivo;
    var xx = new Array();
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
    var periodo = 'a';

    switch(nombre) {
            case "Interacciones":
                var clavekpi="interacciones_totales";
                break;
            case "Reacciones":
                var clavekpi="reactions";
                break;
            case "Compartir":
                var clavekpi="shares";
                break;
            case "Comentario":
                var clavekpi="comments";
                break;
            case "Vistas de Video":
                var clavekpi="post_video_views_unique";
                break;
            case "Clicks a Links":
                var clavekpi="link_clicks";
                break;
            case "Alcance Total":
                var clavekpi="reach";
                break;
            case "Alcance Pagado":
                var clavekpi="reach_paid";
                break;
            case "Alcance Orgánico":
                var clavekpi="reach_organic";
                break;
            case "Índice de Interacción":
                var clavekpi="";
                break;
            case "Índice de Inter Alcance":
                var clavekpi="";
                break;
            case "Inversión":
                var clavekpi="";
                break;
            case "Índice de Interacción Inversión":
                var clavekpi="";
                break;
            case "Índice de Inter Alcance inversión":
                var clavekpi="";
                break;
            default:
                var clavekpi="";
             
    }

    var clavesKpis = {
      39:"interacciones_totales",
      40:"reactions",
      41:"shares",
      42:"comments",
      43:"post_video_views_unique",
      44:"link_clicks",
      45:"reach",
      46:"reach_paid",
      47:"reach_organic",
      48:"Índice de Interacción",
      49:"Índice de Inter Alcance",
      50:"Inversión",
      52:"Índice de Interacción Inversión",
      53:"Índice de Inter Alcance inversión",
      };
                        var otros_kpis_seleccionados='';
                        $.each( info_kpi_analisis, function( v, k ){

                            otros_kpis_seleccionados +='<p>-'+k.nombre+'</p>';

                        });
      

$('#analisis').append('<h2>'+titulo_analisis+'</h2><div class="container"><div class="row"><div class="col-md-4"> KPI Principal: '+nombre+'</div><div class="col-md-4"> Objetivo: '+tipo+'</div><div class="col-md-4"> Tipo: '+objetivo+'</div></div><div class="row text-center">Otros Kpis seleccionados:    '+otros_kpis_seleccionados+'</div></div><div id="grafica'+conte+'" class="card" style="min-width: 310px; width:100%; height: 300px; margin:12px auto;"></div><div class="col-md-2"><div class="tab-pane" id="pi0'+conte+'"></div></div><div class="col-md-2"><div class="tab-pane" id="pi1'+conte+'"></div></div><div class="col-md-2"><div class="tab-pane" id="pi2'+conte+'"></div></div><div class="col-md-2"><div class="tab-pane" id="pi3'+conte+'"></div></div><div class="col-md-2"><div class="tab-pane" id="pi4'+conte+'"></div></div><div class="col-md-2"><div class="tab-pane" id="pi5'+conte+'"></div></div><div class="col-md-2"><div class="tab-pane" id="pi6'+conte+'"></div></div><div class="col-md-2"><div class="tab-pane" id="pi7'+conte+'"></div></div><div class="col-md-2"><div class="tab-pane" id="pi8'+conte+'"></div></div><div class="col-md-2"><div class="tab-pane" id="pi9'+conte+'"></div></div><div class="col-md-2"><div class="tab-pane" id="pi10'+conte+'"></div></div><div class="col-md-2"><div class="tab-pane" id="pi11'+conte+'"></div></div><div class="col-md-2"><div class="tab-pane" id="pi12'+conte+'"></div></div><div class="col-md-2"><div class="tab-pane" id="pi13'+conte+'"></div></div><div class="col-md-2"><div class="tab-pane" id="pi14'+conte+'"></div></div><div class="col-md-2"><div class="tab-pane" id="pi15'+conte+'"></div></div><div class="col-md-2"><div class="tab-pane" id="pi16'+conte+'"></div></div><div class="col-md-2"><div class="tab-pane" id="pi17'+conte+'"></div></div>');

$.each( [ 10,11,23,24 ], function( i, l ){
    var id = l;
 var params ={
          "ACT": id,
          "fecha": fecha,
          "periodo": periodo,
          "id_page": page_id,
          "ordenby": ordenby             
      };
      

 $.ajax({
          data:   params,  
          url:    'datos.php', 
          type:   'post',
          beforeSend: function () { 
              var chart = $('#container').highcharts();
          
          },

            error: function(response){ 
                 var chart = $('#container').highcharts();
                chart.hideLoading();
                alert("error: Chart error"); 
                 popup('popUpDiv');
            },
      
          success: function(DatosRecuperados) {
                  if(id==10){

                $('#link10').html('<table id="example10" class="display compact"><thead style="text-align: center; font-size: 10px;"><tr><th> Mes </th><th> Dia </th><th>Hombre</th><th>Mujer</th><th>Otros</th></tr></thead><tbody id="example10"></tbody></table>');
                    $.each(DatosRecuperados, function(i, d) {
                  if (d.f) {ef[i] = parseFloat(d.f);}
                  if (d.m) {em[i] = parseFloat(d.m);}
                  if (d.u) {eu[i] = parseFloat(d.u);}
                  if (d.ds) {ds[i] = d.ds;}
                     
                     $('#example10').append('<tr><td>'+d.z+'</td><td>'+d.d+'</td><td>'+d.m+'</td><td>'+d.f+'</td><td>'+d.u+'</td></tr>');
                     });
                     
                    
                 
                               $('#container'+id).highcharts({
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

              $('#link11').html('<table id="example11" class="display compact"><thead style="text-align: center; font-size: 10px;"><tr><th> Hora </th><th>Max Fans</th></tr></thead><tbody id="example11"></tbody></table>');
              
                $.each(DatosRecuperados, function(i, d) {

                  if (d.h) {ds[i] = parseInt(d.h);}
                  if (d.f) {xx[i] = parseInt(d.f);}
                 
                
                $('#example11').append('<tr><td>'+d.h+'</td><td>'+d.f+'</td></tr>');
                });
                          $('#container'+id).highcharts({
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
                                        name: 'Fans Online',
                                        data: xx,
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





              if(id==23){

                              var reactions = new Array();
                              var shares = new Array();
                              var comments = new Array();
                              var video = new Array();
                              var clink = new Array();
                              var interacciones_totales = new Array();
                              var indicei = new Array();
                              var alcance = new Array();
                              var indicei = new Array();
                              var indiceia = new Array();
                              var indiceii = new Array();
                              var indiceiai = new Array();
                              var kpi_actual = new Array();
                              var indice_kpi = new Array();
                              var indice_kpi_inversion = new Array();
                              var costo_kpi = new Array();
                              var indiceInteralcance = new Array();
                              var indice_alcance_inversion = new Array();
                              var indice_interaccion_inversion = new Array();
                              var indice_interalcance_inversion = new Array();
                              var count = 0;
                              var int;
                              var intp=0;
                              //var fecha; 
                              var inv = new Array();
                              //var fecha; 
                              
                              var last = Object.keys(DatosRecuperados['uno']).length;
                              last = parseInt(last)-1;
                              console.log(DatosRecuperados['uno']);    
                    $.each(DatosRecuperados['uno'], function(i, d) {
                      
                    //if (page_id=="192597304105183") {d.inversion=(d.inversion*3.6)/0.55;}
                    if (d.reactions) {reactions[i] = parseInt(d.reactions);}
                    if (d.shares) {shares[i] = parseInt(d.shares);}
                    if (d.comments) {comments[i] = parseInt(d.comments);}
                    if (d.post_video_views_unique) {video[i] = parseInt(d.post_video_views_unique);}
                    if (d.link_clicks) {clink[i] = parseInt(d.link_clicks);}
                    if (d.indice_interaccion) {indicei[i] = parseFloat(d.indice_interaccion);}
                    if (d.indice_interalcance) {indiceInteralcance[i] = parseFloat(d.indice_interalcance);}
                    if (d.reach) {alcance[i] = parseInt(d.reach);}
                    if (d.inversion) {indice_alcance_inversion[i] = parseFloat(d.reach/d.inversion);}
                    if (d.inversion) {indice_interaccion_inversion[i] = parseFloat(d.indice_interaccion/d.inversion);}
                    if (d.inversion) {indice_interalcance_inversion[i] = parseFloat(d.indice_interalcance/d.inversion);}
                    interacciones_totales[i]=parseInt(d.link_clicks)+parseInt(d.shares)+parseInt(d.reactions)+parseInt(d.comments)+parseInt(d.post_video_views_unique);
                    if (clavekpi!='interacciones_totales') {
                        if (d[clavekpi]) {kpi_actual[i] = parseInt(d[clavekpi]);}
                        if (d.page_fans) {indice_kpi[i] = parseFloat((d[clavekpi]/d.page_fans).toFixed(6));}
                        if (d.page_fans) {indice_kpi_inversion[i] = parseFloat(((d[clavekpi]/d.page_fans)/d.inversion).toFixed(6));}  
                        costo_kpi[i] = d[clavekpi] > 0 ? parseFloat((d.inversion/d[clavekpi]).toFixed(6)) : 0;
                    } else {
                        var todas_las_interacciones=parseInt(d.link_clicks)+parseInt(d.shares)+parseInt(d.reactions)+parseInt(d.comments)+parseInt(d.post_video_views_unique);
                        kpi_actual[i]=parseInt(todas_las_interacciones);
                        if (d.page_fans) {indice_kpi[i] = parseFloat((todas_las_interacciones/d.page_fans).toFixed(6));}                      
                        if (d.page_fans) {indice_kpi_inversion[i] = parseFloat(((todas_las_interacciones/d.page_fans)/d.inversion).toFixed(6));}  
                        costo_kpi[i] = todas_las_interacciones > 0 ? parseFloat((d.inversion/todas_las_interacciones).toFixed(6)) : 0;
                    }
                    if(i<last){
                    intp += parseInt(d.reactions)+parseInt(d.shares)+parseInt(d.comments)+parseInt(d.post_video_views_unique)+parseInt(d.link_clicks);
                    }
                    if (d.indice_interaccion) {if(d.indice_interaccion>=100){ indicei[i] = parseInt(d.indice_interaccion)/100; } else if(d.indice_interaccion>=10){ indicei[i] = parseInt(d.indice_interaccion)/10; } else{ indicei[i] = parseInt(d.indice_interaccion); }}
                    if (d.indice_interalcance) {if(d.indice_interalcance>=100){ indiceia[i] = parseInt(d.indice_interalcance)/100; } else if(d.indice_interalcance>=10){ indiceia[i] = parseInt(d.indice_interalcance)/10; } else{ indiceia[i] = parseInt(d.indice_interalcance); }}
                    if (d.indice_interaccion_inversion) {if(d.indice_interaccion_inversion>=100){ indiceii[i] = parseInt(d.indice_interaccion_inversion)/100; } else if(d.indice_interaccion_inversion>=10){ indiceii[i] = parseInt(d.indice_interaccion_inversion)/10; } else{ indiceii[i] = parseInt(d.indice_interaccion_inversion); }}
                    if (d.indice_interalcance_inversion) {if(d.indice_interalcance_inversion>=100){ indiceiai[i] = parseInt(d.indice_interalcance_inversion)/100; } else if(d.indice_interalcance_inversion>=10){ indiceiai[i] = parseInt(d.indice_interalcance_inversion)/10; } else{ indiceiai[i] = parseInt(d.indice_interaccion_inversion); }}
                    if (d.inversion) {inv[i] = parseInt(d.inversion);}

                  //Hacemos una función para hacer las operaciones
                  function textoFecha(fecha){
                  var numDiaSem = fecha.getDay(); //getDay() devuelve el dia de la semana.(0-6).
                  //Creamos un Array para los nombres de los días    
                  var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
                  var diaLetras = diasSemana[fecha.getDay()];   //El día de la semana en letras. getDay() devuelve el dia de la semana.(0-6).
                  //Otro Array para los nombres de los meses    
                  var meses = new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                  var mesLetras = meses[fecha.getMonth()];  //El mes en letras
                  var diaMes = (fecha.getDate());   //getDate() devuelve el dia(1-31).
                  var anho = fecha.getFullYear();  //getFullYear() devuelve el año(4 dígitos).
                  var hora = fecha.getHours();    //getHours() devuelve la hora(0-23).
                  var min = fecha.getMinutes();   //getMinutes() devuelve los minutos(0-59).
                  if ((min >= 0) && (min < 10)) {    //Algoritmo para añadir un cero cuando el min tiene 1 cifra.
                  min = "0" + min;
                  }
                  var devolver =  diaLetras+ ", " + diaMes + " de " + mesLetras + " de " + anho + " a las " + hora + ":" + min + " horas.";
                  return devolver;
                  }
                   var fecha = new Date(d.created_time); //Declaramos el objeto fecha actual//Declaramos el objeto fecha actual
                  fecha = textoFecha(fecha);

                    if(i<18)
                    {
                      var filasTablasKpiSeleccionados='';
                        $.each( info_kpi_analisis, function( v, k ){
                          var verificador=$.inArray( k.kpi, [ '39','40','41','42','43','44','46','47'] );
                          if (verificador!=-1) {
                            filasTablasKpiSeleccionados +='<tr><th width="55%">'+k.nombre+'</th><td>'+d[clavesKpis[k.kpi]]+'</td></tr>';
                          }
                          if (k.kpi==48) {
                            filasTablasKpiSeleccionados +='<tr><th width="55%">Índice de Interacción</th><td>'+d.indice_interaccion+'</td></tr>';
                          }
                          if (k.kpi==49) {
                            filasTablasKpiSeleccionados +='<tr><th width="55%">Índice de Inter Alcance</th><td>'+d.indice_interalcance+'</td></tr>';
                          }
                          if (k.kpi==50) {
                            filasTablasKpiSeleccionados +='<tr><th width="55%">Inversin</th><td>'+d.inversion+'</td></tr>';
                          }
                          if (k.kpi==52) {
                            filasTablasKpiSeleccionados +='<tr><th width="55%">Índice de Interacción Inversión</th><td>'+indice_interaccion_inversion[i]+'</td></tr>';
                          }
                          if (k.kpi==53) {
                            filasTablasKpiSeleccionados +='<tr><th width="55%">Índice de Inter Alcance inversión</th><td>'+indice_interalcance_inversion[i]+'</td></tr>';
                          }
                        });
                      int = parseInt(d.reactions)+parseInt(d.shares)+parseInt(d.comments)+parseInt(d.post_video_views_unique)+parseInt(d.link_clicks);

                      var verificadorkpiPrincipal=$.inArray( ordenby, [ '39','40','41','42','43','44','45','46','47'] );
                          if (verificadorkpiPrincipal!=-1) {//kpi principal
                              var kpiprincipal_fila= ordenby!=45 ? '<tr><th>'+nombre+'</th><td>'+kpi_actual[i]+'</td></tr>' : ''; 
                              $('#pi'+i+conte).html('<input type="checkbox" name="post[]" form="CrearReporte" value="'+d.id+'"><table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" class="tabla" style="border-collapse:collapse;border-color:#ddd; font-size: 10px;"><thead><tr><th colspan="2"><a  href="'+d.permalink_url+'"" target="_blank"><div style="height: 180px; width: 100%; background-size:cover;background-repeat: no-repeat; background-image:url('+d.picture+'); background-position: center;" alt=""></div></a></th></tr></thead><tbody style="text-align: left;"><tr><td colspan="2"><a  href="'+d.permalink_url+'"" target="_blank">'+d.message+'</a></td></tr><tr><th width="55%"> Fecha:</th><td> '+fecha+'</td> </tr><tr><th width="55%"> Fans a la fecha:</th><td>'+d.page_fans+'</td></tr><tr><th> Alcance:</th><td>'+d.reach+'</td></tr>'+kpiprincipal_fila+'<tr><th>Índice '+nombre+'</th><td>'+indice_kpi[i]+'</td></tr><tr><th>Índice '+nombre+' Inversión</th><td>'+indice_kpi_inversion[i]+'</td></tr><tr><th>Costo por '+nombre+'</th><td>'+costo_kpi[i]+'</td></tr>'+filasTablasKpiSeleccionados+'</tbody></table>'); 
                          }
                          if (ordenby==50) {//inversion
                            $('#pi'+i+conte).html('<table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" class="tabla" style="border-collapse:collapse;border-color:#ddd; font-size: 10px;"><thead><tr><th colspan="2"><a  href="'+d.permalink_url+'"" target="_blank"><div style="height: 180px; width: 100%; background-size:cover;background-repeat: no-repeat; background-image:url('+d.picture+'); background-position: center;" alt=""></div></a></th></tr></thead><tbody style="text-align: left;"><tr><td colspan="2"><a  href="'+d.permalink_url+'"" target="_blank">'+d.message+'</a></td></tr><tr><th width="55%"> Fecha:</th><td> '+fecha+'</td> </tr><tr><th width="55%"> Fans a la fecha:</th><td>'+d.page_fans+'</td></tr><tr><th> Alcance:</th><td>'+d.reach+'</td></tr><tr><th>'+nombre+'</th><td>'+d.inversion+'</td></tr><tr><th>Índice interacción '+nombre+'</th><td>'+indice_interaccion_inversion[i]+'</td></tr>'+filasTablasKpiSeleccionados+'</tbody></table>');
                          }
                          //indices
                          var verificadorkpiPrincipal=$.inArray( ordenby, [ '48','49','52','53'] );
                          if (verificadorkpiPrincipal!=-1) {//kpi principal
                            $('#pi'+i+conte).html('<table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" class="tabla" style="border-collapse:collapse;border-color:#ddd; font-size: 10px;"><thead><tr><th colspan="2"><a  href="'+d.permalink_url+'"" target="_blank"><div style="height: 180px; width: 100%; background-size:cover;background-repeat: no-repeat; background-image:url('+d.picture+'); background-position: center;" alt=""></div></a></th></tr></thead><tbody style="text-align: left;"><tr><td colspan="2"><a  href="'+d.permalink_url+'"" target="_blank">'+d.message+'</a></td></tr><tr><th width="55%"> Fecha:</th><td> '+fecha+'</td> </tr><tr><th width="55%"> Fans a la fecha:</th><td>'+d.page_fans+'</td></tr><tr><th> Alcance:</th><td>'+d.reach+'</td></tr><tr><th>Índice de interacción </th><td>'+indicei[i]+'</td></tr><tr><th>Índice inter alcance</th><td>'+indiceia[i]+'</td></tr><tr><th>Índice Interacción Inversión</th><td>'+indice_interaccion_inversion[i]+'</td></tr><tr><th>Índice inter alcance inversión </th><td>'+indice_interalcance_inversion[i]+'</td></tr></tbody></table>'); 
                          }                          
                         //$('#pi'+i+conte).html('<table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" class="tabla" style="border-collapse:collapse;border-color:#ddd; font-size: 10px;"><thead><tr><th colspan="2"><a  href="'+d.permalink_url+'"" target="_blank"><div style="height: 180px; width: 100%; background-size:cover;background-repeat: no-repeat; background-image:url('+d.picture+'); background-position: center;" alt=""></div></a></th></tr></thead><tbody style="text-align: left;"><tr><td colspan="2"><a  href="'+d.permalink_url+'"" target="_blank">'+d.message+'</a></td></tr><tr><th width="55%"> Fecha:</th><td> '+fecha+'</td> </tr><tr><th width="55%"> Fans a la fecha:</th><td>'+d.page_fans+'</td></tr><tr><th width="55%"> Nuevos Me gusta a la Pagína:</th><td>'+DatosRecuperados['dos'][0]['fans']+'</td></tr><tr><th> Total de interacción en la pagína: </th> <td>'+intp+'</td></tr><tr><th> Total interacción en el post: </th> <td>'+int+'</td> </tr><tr><th> Alcance:</th><td>'+d.reach+'</td></tr><tr><th> Alcance organico: </th><td>'+d.reach_organic+'</td></tr><tr><th>Alcance pagdo:</th><td>'+d.reach_paid+'</td></tr><tr><th>Inversión (S/):</th><td>S/.'+d.inversion+'</td></tr><tr><th> Veces compartido:</th> <td>'+d.shares+'</td></tr><tr><th> Comentarios:</th><td>'+d.comments+'</td></tr><tr><th> Reacciones:</th><td>'+d.reactions+'</td></tr><tr><th> Clic unicos a link:</th><td>'+d.link_clicks+'</td></tr><tr><th> Vistas unicas a video:</th><td>'+d.post_video_views_unique+'</td></tr><tr><th> Indice de interacción:</th><td>'+d.indice_interaccion+'</td></tr><tr><th> Indice inter alcance:</th><td>'+d.indice_interalcance+'</td></tr><tr><th> Indice interacción vs inversión:</th><td>'+d.indice_interaccion/d.inversion+'</td></tr><tr><th> Indice Inter alcance vs inversión:</th><td>'+d.indice_interalcance/d.inversion+'</td></tr></tbody></table>'); 
                    }

                     });
                   if(ordenby==50){

                                //esta es la graf para kpi inversion 
                                Highcharts.chart('grafica'+conte, {
                                  chart: {
                                      zoomType: 'xy'
                                  },
                                  
                                          showInLegend: true,
                                  title: {
                                      text: nombre+' por Publicación'
                                  },
                                  subtitle: {
                                      text: ''
                                  },
                                  credits: {
                                       enabled: false
                                   },
                                  xAxis:  {
                                       
                                        labels: {
                                          format: 'P{value}',
                                          rotation: -45,
                                          style: {
                                            fontSize: '13px',
                                            fontFamily: 'Verdana, sans-serif',
                                            color: '#00AD82'
                                          }
                                        }
                                      },
                                  yAxis: [{ // Primary yAxis
                                      labels: {
                                          format: '{value}',
                                          style: {
                                              color: Highcharts.getOptions().colors[1]
                                          }
                                      },
                                      title: {
                                          text: 'Indice de Interacción Inversión',
                                          style: {
                                              color: Highcharts.getOptions().colors[1]
                                          }
                                      }
                                  }, { // Secondary yAxis
                                      title: {
                                          text: 'Inversión',
                                          style: {
                                              color:  '#FF9965'
                                          }
                                      },
                                      labels: {
                                          format: '{value} ',
                                          style: {
                                              color: Highcharts.getOptions().colors[0]
                                          }
                                      },
                                      opposite: true
                                  }],
                                 tooltip: {
                                        formatter: function () {
                                             var s = [];
                                 
                                      s.push('<b>' +this.x + '</b>');
                                      this.points.forEach(function(point) {
                                          if (point.series.name == "Inversión"){
                                            s.push('<span style="color:'+point.series.color+'">' + point.series.name + ':</span><b>  ' + point.y + ' $</b>');
                                          } else {
                                              s.push('<span style="color:'+point.series.color+'">' + point.series.name + ':</span><b> ' + point.y + '</b>'); 
                                          }
                                      });
                                            return s;
                                        },
                                            split: true
                                    },
                                    legend: {
                                        layout: 'vertical',
                                        align: 'left',
                                        x: 60,
                                        verticalAlign: 'top',
                                        y: 0,
                                        floating: true,
                                        backgroundColor:  'rgba(255, 255, 255, 0.4)'
                                    },
                                    series: [{
                                        name: 'Inversión',//////////////////////////////////////
                                        type: 'column',
                                        yAxis: 1,
                                        data: inv,
                                        tooltip: {
                                            valueSuffix: ' '
                                        },
                                        color: '#FF9965'

                                    },{
                                        name: 'Indice de Interacción Inversión',
                                        type: 'spline',
                                        data: indice_interaccion_inversion,
                                        tooltip: {
                                            valueSuffix: ' '
                                        },
                                        color: '#9966FF'

                                    }]
                                    });

                              }

                              else if(ordenby==48 || ordenby==49 || ordenby==52 || ordenby==53){
                                //graficas de indices
                               Highcharts.chart('grafica'+conte, {
                                  chart: {
                                      zoomType: 'xy'
                                  },
                                  
                                          showInLegend: true,
                                 title: {
                                      text: nombre+' de Publicación'
                                  },
                                  subtitle: {
                                      text: ''
                                  },
                                  credits: {
                                       enabled: false
                                   },
                                  xAxis: {
                                        labels: {
                                          format: 'P{value}',
                                          rotation: -45,
                                          style: {
                                            fontSize: '13px',
                                            fontFamily: 'Verdana, sans-serif',
                                            color: '#00AD82'
                                          }
                                        }
                                      },

                                  yAxis: [{ // Primary yAxis
                                      labels: {
                                          format: '{value}',
                                          style: {
                                              color: Highcharts.getOptions().colors[1]
                                          }
                                      },
                                      title: {
                                          text: 'Indice de Interacción Inversión',
                                          style: {
                                              color: Highcharts.getOptions().colors[1]
                                          }
                                      },
                                      showFirstLabel: false
                                  }, { // Secondary yAxis
                                      title: {
                                          text: 'Indice Inter Alcance',
                                          style: {
                                              color: Highcharts.getOptions().colors[0]
                                          }
                                      },
                                      labels: {
                                          format: '{value} ',
                                          style: {
                                              color: Highcharts.getOptions().colors[0]
                                          }
                                      },
                                      showFirstLabel: false,
                                      opposite: true
                                  }],
                                  tooltip: {
                                           shared: true,
                                          crosshairs: true,
                                  },
                                  legend: {
                                      layout: 'vertical',
                                      align: 'left',
                                      x: 60,
                                      verticalAlign: 'top',
                                      y: 0,
                                      floating: true,
                                      backgroundColor:  'rgba(255, 255, 255, 0.4)'
                                  },
                                  series: [{
                                      name: 'Índice de Interacción',
                                      type: 'spline',
                                      yAxis: 1,
                                      data: indicei,
                                      tooltip: {
                                          valueSuffix: ' '
                                      },
                                      color: '#EB7CB4'

                                  },{
                                      name: 'Índice de Inter Alcance',
                                      type: 'spline',
                                      data: indiceia,
                                      tooltip: {
                                          valueSuffix: ' '
                                      },
                                      color: '#9ACA61'

                                  },{
                                      name: 'Índice de Interacción vs Inversión',
                                      type: 'spline',
                                      data: indice_interaccion_inversion,
                                      tooltip: {
                                          valueSuffix: ' '
                                      },
                                      color: '#9966FF'

                                  },{
                                      name: 'Indice de Inter Alcance vs Inversión',
                                      type: 'spline',
                                      data: indice_interalcance_inversion,
                                      tooltip: {
                                          valueSuffix: ' '
                                      },
                                      color: '#7CB5EC'

                                  }]
                            });

                                }
                              else{
                                //esta es la graf kpis no indices
                                Highcharts.chart('grafica'+conte, {
                                    chart: {
                                        zoomType: 'xy'
                                    },
                                          showInLegend: true,
                                      title: {
                                          text: nombre+' por Publicación'
                                      },
                                      subtitle: {
                                          text: ''
                                      },
                                      xAxis: [{
                                        categories: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18],
                                        crosshair: true
                                      }],
                                      yAxis: [{ // Primary yAxis
                                        labels: {
                                          format: '{value}',
                                          style: {
                                            color: Highcharts.getOptions().colors[1]
                                          }
                                        },
                                        title: {
                                          text: 'Índice inter Alcance',
                                          style: {
                                            color: Highcharts.getOptions().colors[1]
                                          }
                                        },
                                        opposite: true
                                      }, { // Secondary yAxis
                                        gridLineWidth: 0,
                                        title: {
                                          text: nombre,
                                          style: {
                                            color: Highcharts.getOptions().colors[1]
                                          }
                                        },
                                        labels: {
                                          format: '{value}',
                                          style: {
                                            color: Highcharts.getOptions().colors[1]
                                          }
                                        }
                                      }, { // Tertiary yAxis
                                        gridLineWidth: 0,
                                        title: {
                                          text: 'Índice '+nombre,
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
                                        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || 'rgba(255,255,255,0.25)'
                                      },
                                      series: [{
                                        name: nombre,
                                        color:'#00CA79',
                                        type: 'column',
                                        yAxis: 1,
                                        data: kpi_actual
                                      }, {
                                        name: 'Índice '+nombre,
                                        color:'#EB7CB4',
                                        type: 'spline',
                                        yAxis: 2,
                                        data: indice_kpi,
                                        marker: {
                                          enabled: false
                                        }
                                      }, {
                                        name: 'Índice inter Alcance',
                                        color:'#9ACA61',
                                        type: 'spline',
                                        data:  indiceInteralcance,
                                        marker: {
                                          enabled: false
                                        }
                                      }, {
                                        name: 'Índice de '+nombre+' vs Inversión',
                                        color:'#9966FF',
                                        type: 'spline',
                                        data: indice_kpi_inversion,
                                        marker: {
                                          enabled: false
                                        }
                                      }, {
                                        name: 'Índice Alcance vs Inversión',
                                        color:'#7CB5EC',
                                        type: 'spline',
                                        data: indice_alcance_inversion,
                                        marker: {
                                          enabled: false
                                        }
                                      }, {
                                        name: 'Costo por Acción',
                                        color:'#7CB5EC',
                                        type: 'spline',
                                        data: costo_kpi,
                                        marker: {
                                          enabled: false
                                        }
                                      }]
                                }); 
                          } 
                          }

                  if(id==24){



                  
                $('#link24').html('<table id="example24" class="display compact"><thead style="text-align: center; font-size: 10px;"><tr><th> Mes </th><th> Dia </th><th>Hombre</th><th>Mujer</th><th>Otros</th></tr></thead><tbody id="example24"></tbody></table>');
                    $.each(DatosRecuperados, function(i, d) {
                  if (d.f) {ef[i] = parseFloat(d.f);}
                  if (d.m) {em[i] = parseFloat(d.m);}
                  if (d.u) {eu[i] = parseFloat(d.u);}
                  if (d.ds) {ds[i] = d.ds;}
                     
                     $('#example24').append('<tr><td>'+d.z+'</td><td>'+d.d+'</td><td>'+d.m+'</td><td>'+d.f+'</td><td>'+d.u+'</td></tr>');
                     });

                 
                               $('#container'+id).highcharts({
                              chart: {
                                type: 'bar'
                              },
                              title: {
                                text: 'Como se consiguieron los Likes (Total)'
                              },
                              xAxis: {

                                categories: ds
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

                       $('#example'+id).DataTable({
                  "paging":   false,
                  "ordering": false,
                  "info":     false,
                  "searching": false
                  });






             
      }
    });

      });
    }});
          
},
error: function(status) {
console.log(status);
}

           });

</script>
</body>

</html>