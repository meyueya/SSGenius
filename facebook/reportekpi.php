<?php
session_start();
include('controller/functionsformat.php');
include('../model/ConsultoriaModel.php');
$consultoriapost = new ConsultoriaModel;
$informespost = $consultoriapost->traerConsultoriasPost();
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




 <div class="row" id="analisis">    </div>  
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
 
<script>
  
    var consultoria ={

            "op" : '2',
            "id": '1'
                   
        };

 $.ajax({
            data:   consultoria,  
            url:    'consultoria.php', 
            type:   'post',
         
            success: function(DatosRecuperados) {

             /*  console.log(DatosRecuperados); */

            

 $.each(DatosRecuperados, function(i, d) {
  var conte = i+1;
/* console.log(DatosRecuperados); */
      var ordenby = d.kpi_principal;
      var fecha = '2018/10/01 - 2018/10/31';
      var nombre = d.nombre;
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

  $('#analisis').append('<h2>Análisis #'+conte+' KPI Principal: '+nombre+'.</h2><div id="grafica'+conte+'" class="card" style="min-width: 310px; width:100%; height: 300px; margin:12px auto;"></div><div class="col-md-2"><div class="tab-pane" id="pi0'+conte+'"></div></div><div class="col-md-2"><div class="tab-pane" id="pi1'+conte+'"></div></div><div class="col-md-2"><div class="tab-pane" id="pi2'+conte+'"></div></div><div class="col-md-2"><div class="tab-pane" id="pi3'+conte+'"></div></div><div class="col-md-2"><div class="tab-pane" id="pi4'+conte+'"></div></div><div class="col-md-2"><div class="tab-pane" id="pi5'+conte+'"></div></div>');

  // $('#analisis').append('<div id="grafica'+conte+'" class="card" style="min-width: 310px; width:100%; height: 300px; margin:12px auto;"></div>');



 $.each( [ 10,11,23,24 ], function( i, l ){
      var id = l;

     
      
   var params ={
            "ACT": id,
            "fecha": fecha,
            "periodo": periodo,
            "id_page": '<?= $_GET['psid'] ?>',
            "ordenby": ordenby             
        };

   $.ajax({
            data:   params,  
            url:    'datos.php', 
            type:   'post',
            beforeSend: function () { //before make the ajax call
                var chart = $('#container').highcharts();
                //chart.showLoading();
            },
            // error: function(response){ //if an error happens it will be processed here
            //     var chart = $('#container').highcharts();
            //     chart.hideLoading();
            //     alert("error: Chart error"); 
            //     popup('popUpDiv');
            // },
            success: function(DatosRecuperados) {


                    if(id==10){

                        console.log(DatosRecuperados);

                    
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
                                var indicei = new Array();
                                var alcance = new Array();
                                var indicei = new Array();
                                var indiceia = new Array();
                                var indiceii = new Array();
                                var indiceiai = new Array();
                                var count = 0;
                                var int;
                                var intp=0;
                                //var fecha; 
                                var inv = new Array();
                                //var fecha; 
                                
                                var last = Object.keys(DatosRecuperados['uno']).length;
                                last = parseInt(last)-1;
                                
                               /*  console.log(DatosRecuperados); */
                      $.each(DatosRecuperados['uno'], function(i, d) {
                      
                      if (d.reactions) {reactions[i] = parseInt(d.reactions);}
                      if (d.shares) {shares[i] = parseInt(d.shares);}
                      if (d.comments) {comments[i] = parseInt(d.comments);}
                      if (d.post_video_views_unique) {video[i] = parseInt(d.post_video_views_unique);}
                      if (d.link_clicks) {clink[i] = parseInt(d.link_clicks);}
                      if (d.indice_interaccion) {indicei[i] = parseFloat(d.indice_interaccion);}
                      if (d.reach) {alcance[i] = parseInt(d.reach);}
                      
                      if(i<last){
                      intp += parseInt(d.reactions)+parseInt(d.shares)+parseInt(d.comments)+parseInt(d.post_video_views_unique)+parseInt(d.link_clicks);
                      
                      }
                      
                      });
                      
                        $.each(DatosRecuperados['uno'], function(i, d) {
                     
                      if (d.reactions) {reactions[i] = parseInt(d.reactions);}
                      if (d.shares) {shares[i] = parseInt(d.shares);}
                      if (d.comments) {comments[i] = parseInt(d.comments);}
                      if (d.post_video_views_unique) {video[i] = parseInt(d.post_video_views_unique);}
                      if (d.link_clicks) {clink[i] = parseInt(d.link_clicks);}
                       if (d.indice_interaccion) {if(d.indice_interaccion>=100){ indicei[i] = parseInt(d.indice_interaccion)/100; } else if(d.indice_interaccion>=10){ indicei[i] = parseInt(d.indice_interaccion)/10; } else{ indicei[i] = parseInt(d.indice_interaccion); }}
                      if (d.indice_interalcance) {if(d.indice_interalcance>=100){ indiceia[i] = parseInt(d.indice_interalcance)/100; } else if(d.indice_interalcance>=10){ indiceia[i] = parseInt(d.indice_interalcance)/10; } else{ indiceia[i] = parseInt(d.indice_interalcance); }}
                      if (d.indice_interaccion_inversion) {if(d.indice_interaccion_inversion>=100){ indiceii[i] = parseInt(d.indice_interaccion_inversion)/100; } else if(d.indice_interaccion_inversion>=10){ indiceii[i] = parseInt(d.indice_interaccion_inversion)/10; } else{ indiceii[i] = parseInt(d.indice_interaccion_inversion); }}
                      if (d.indice_interalcance_inversion) {if(d.indice_interalcance_inversion>=100){ indiceiai[i] = parseInt(d.indice_interalcance_inversion)/100; } else if(d.indice_interalcance_inversion>=10){ indiceiai[i] = parseInt(d.indice_interalcance_inversion)/10; } else{ indiceiai[i] = parseInt(d.indice_interaccion_inversion); }}
                      if (d.reach) {alcance[i] = parseInt(d.reach);}
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

                    


                  
                      
                      if(i<6)
                      {
                        int = parseInt(d.reactions)+parseInt(d.shares)+parseInt(d.comments)+parseInt(d.post_video_views_unique)+parseInt(d.link_clicks);

                           $('#pi'+i+conte).html('<table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" class="tabla" style="border-collapse:collapse;border-color:#ddd; font-size: 10px;"><thead><tr><th colspan="2"><a  href="'+d.permalink_url+'"" target="_blank"><div style="height: 180px; width: 100%; background-size:cover;background-repeat: no-repeat; background-image:url('+d.picture+'); background-position: center;" alt=""></div></a></th></tr></thead><tbody style="text-align: left;"><tr><td colspan="2"><a  href="'+d.permalink_url+'"" target="_blank">'+d.message+'</a></td></tr><tr><th width="55%"> Fecha:</th><td> '+fecha+'</td> </tr><tr><th width="55%"> Fans a la fecha:</th><td>'+d.page_fans+'</td></tr><tr><th width="55%"> Nuevos Me gusta a la Pagína:</th><td>'+DatosRecuperados['dos'][0]['fans']+'</td></tr><tr><th> Total de interacción en la pagína: </th> <td>'+intp+'</td></tr><tr><th> Total interacción en el post: </th> <td>'+int+'</td> </tr><tr><th> Alcance:</th><td>'+d.reach+'</td></tr><tr><th> Alcance organico: </th><td>'+d.reach_organic+'</td></tr><tr><th>Alcance pagdo:</th><td>'+d.reach_paid+'</td></tr><tr><th>Inversión (S/):</th><td>S/.'+d.inversion+'</td></tr><tr><th> Veces compartido:</th> <td>'+d.shares+'</td></tr><tr><th> Comentarios:</th><td>'+d.comments+'</td></tr><tr><th> Reacciones:</th><td>'+d.reactions+'</td></tr><tr><th> Clic unicos a link:</th><td>'+d.link_clicks+'</td></tr><tr><th> Vistas unicas a video:</th><td>'+d.post_video_views_unique+'</td></tr><tr><th> Indice de interacción:</th><td>'+d.indice_interaccion+'</td></tr><tr><th> Indice inter alcance:</th><td>'+d.indice_interalcance+'</td></tr><tr><th> Indice interacción vs inversión:</th><td>'+d.indice_interaccion_inversion+'</td></tr><tr><th> Indice Inter alcance vs inversión:</th><td>'+d.indice_interalcance_inversion+'</td></tr></tbody></table>'); 
                         

                      }





                       
                       });
                    
                        if(ordenby==45 || ordenby==46 || ordenby==47){

                              
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
                                          text: 'Indice de Interacción Alcance',
                                          style: {
                                              color: Highcharts.getOptions().colors[1]
                                          }
                                      }
                                    }, { // Secondary yAxis
                                        title: {
                                        text: 'Alcance',
                                        style: {
                                            color: Highcharts.getOptions().colors[0]
                                        }
                                        },
                                        labels: {
                                            format: 'P{value} ',
                                            style: {
                                                color: Highcharts.getOptions().colors[0]
                                            }
                                        },
                                        opposite: true
                                    }],
                                    tooltip: {
                                            pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b> {point.y}</b><br/>',
                                            shared: true,
                                            crosshairs: true,
                                            animation: true,
                                            outside: true,
                                            split: true,
                                            followPointer: true
                                        },
                                        legend: {
                                            layout: 'vertical',
                                            align: 'left',
                                            x: 60,
                                            verticalAlign: 'top',
                                            y: 0,
                                            floating: true,
                                            backgroundColor: 'rgba(255, 255, 255, 0.4)'
                                        },
                                        series: [{
                                            name: 'Alcance',
                                            type: 'column',
                                            yAxis: 1,
                                            data: alcance,
                                            tooltip: {
                                                valueSuffix: ' '
                                            },
                                            color: '#609ACA'

                                        },{
                                            name: 'Indice de Inter Alcance',
                                            type: 'spline',
                                            data: indiceia,
                                            tooltip: {
                                                valueSuffix: ' '
                                            },
                                            color: '#9ACA61'

                                        }]
                                });

                                }

                                 else if(ordenby==50){


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
                                          name: 'Inversión',
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
                                          data: indiceii,
                                          tooltip: {
                                              valueSuffix: ' '
                                          },
                                          color: '#9966FF'

                                      }]
                                      });

                                }



                                else if(ordenby==48 || ordenby==49 || ordenby==52 || ordenby==53){



                                         
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
                                       /* formatter: function () {
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
                                            split: true,*/
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
                                        data: indiceii,
                                        tooltip: {
                                            valueSuffix: ' '
                                        },
                                        color: '#9966FF'

                                    },{
                                        name: 'Indice de Inter Alcance vs Inversión',
                                        type: 'spline',
                                        data: indiceiai,
                                        tooltip: {
                                            valueSuffix: ' '
                                        },
                                        color: '#7CB5EC'

                                    }]
                                      });


                                  }


                                else{


                      
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
                                            text: 'Indice de Interacción',
                                            style: {
                                                color: Highcharts.getOptions().colors[1]
                                            }
                                        }
                                    }, { // Secondary yAxis
                                        title: {
                                            text: 'Reacciones',
                                            style: {
                                                color: Highcharts.getOptions().colors[0]
                                            }
                                        },
                                        labels: {
                                            format: 'P{value} ',
                                            style: {
                                                color: Highcharts.getOptions().colors[0]
                                            }
                                        },
                                        opposite: true
                                    }],
                                    tooltip: {
                                        format: 'P{value}',
                                        borderColor: '#FFF',
                                        useHTML: true,
                                        shared: true,
                                        shadow:false,
                                    
                                    },
                                    legend: {
                                        layout: 'vertical',
                                        align: 'left',
                                        x: 60,
                                        verticalAlign: 'top',
                                        y: 0,
                                        floating: true,
                                        backgroundColor: 'rgba(255, 255, 255, 0.4)'
                                    },
                                    series: [{
                                        name: 'Reacciones',
                                        type: 'column',
                                        yAxis: 1,
                                        data: reactions,
                                        tooltip: {
                                            valueSuffix: ' '
                                        }

                                    },{
                                        name: 'Compartir',
                                        type: 'column',
                                        yAxis: 1,
                                        data: shares,
                                        tooltip: {
                                            valueSuffix: ' '
                                        }

                                    },{
                                        name: 'Comentario',
                                        type: 'column',
                                        yAxis: 1,
                                        data: comments,
                                        tooltip: {
                                            valueSuffix: ' '
                                        }

                                    },{
                                        name: 'Vistas de video',
                                        type: 'column',
                                        yAxis: 1,
                                        data: video,
                                        tooltip: {
                                            valueSuffix: ' '
                                        }

                                    },{
                                        name: 'Clics a links',
                                        type: 'column',
                                        yAxis: 1,
                                        data: clink,
                                        tooltip: {
                                            valueSuffix: ' '
                                        }

                                    },{
                                        name: 'Indice de Interacción',
                                        type: 'spline',
                                        data: indicei,
                                        tooltip: {
                                            valueSuffix: ''
                                        },
                                        color: '#EB7CB4'
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

                       // console.log(DatosRecuperados);
                   
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
});

},
error: function(status) {
  console.log(status);
}

             });

</script>

 


</body>



</html>