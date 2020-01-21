<?php
include('../auth.php');


$f = date("m");

$nanuncio=$_GET['nanuncio'];
$camp=$_GET['camp'];


    if(isset($_POST['daterange-btn']) && isset($_POST['anuncio']) && isset($_POST['camp'])){

    if($_POST['daterange-btn']!=''){
    $desdehasta = explode(" - ", $_POST['daterange-btn']);
    $desde=date("Y-m-d",strtotime($desdehasta[0]));
    $hasta=date("Y-m-d",strtotime($desdehasta[1]));
    $d=date("Y/m/d",strtotime($desdehasta[0]));
    $h=date("Y/m/d",strtotime($desdehasta[1]));
    $f=date("m",strtotime($desdehasta[0]));
    $y=date("Y",strtotime($desdehasta[0]));
    $y2=date("Y",strtotime($desdehasta[1]));
    $fechainicial = new DateTime($desde);
    $fechafinal = new DateTime($hasta);
    $diferencia = $fechainicial->diff($fechafinal);
    $meses = ( $diferencia->y * 12 ) + $diferencia->m;
    
    
    if ($meses==0){
    $factor=1;
    $inicio="$y-".$f."-01";
    $fin="$y2-".$f."-31";
    $fecha="`Date` BETWEEN '$desde' and '$hasta'";
    }

    if ($meses>=1){
    $factor=$meses+1;
    $inicio="$y-".$f."-01";
    $fin="$y2-".$f."-31";
    $fecha="`Date` BETWEEN '$desde' and '$hasta'";
    }
    
    
    }
    else{
    $fecha="";
    }


    if($_POST['anuncio']!='0'){
      $anuncio="AND Criteria='".$_POST['anuncio']."'";
    }
    else{
    $anuncio="";
    }

    if($_POST['camp']!='0'){
      $campp="AND CampaignName='".$_POST['camp']."'";

    }
    else{
    $campp="";
    } 
    

    
 
      $result = mysql_query("select CampaignName, Criteria, Date, COUNT(id_reporte_keywords_google) as totalcampos, SUM(Impressions) as imp, SUM(Clicks) as clic, SUM(Cost)/1000000 as costo, SUM(Conversions) conversion, SUM(ClickAssistedConversions) as clicasistido, AVG(QualityScore) as nivelcalidad, (SUM(Clicks)/SUM(Impressions))*100 as CTR , (SUM(Cost)/1000000)/SUM(Conversions) AS costconversion from reporte_keywords_google WHERE ".$fecha."".$anuncio."".$campp." and Cost>'0' group by CampaignId,Id having count(*) > 0");
      $result2 = mysql_query("SELECT COUNT(*) as total FROM `reporte_keywords_google` WHERE Date BETWEEN '".$inicio."' and '".$fin."' and Cost>'0'");
      $result3 = mysql_query("SELECT DISTINCT CampaignName FROM reporte_keywords_google where `Date` BETWEEN '".$inicio."' and '".$fin."' and Cost>'0'");
      //$result4 = mysql_query("SELECT DISTINCT Criteria FROM reporte_keywords_google where `Date` BETWEEN '".$inicio."' and '".$fin."'");
      $row2 = mysql_fetch_array($result2);
      $costom=$factor*236/$row2['total'];
   
    }




    else{
        /* $result = mysql_query("select CampaignName, Criteria, Date, COUNT(id_reporte_keywords_google) as totalcampos, SUM(Impressions) as imp, SUM(Clicks) as clic, SUM(Cost)/1000000 as costo, SUM(Conversions) conversion, SUM(ClickAssistedConversions) as clicasistido, AVG(QualityScore) as nivelcalidad, (SUM(Clicks)/SUM(Impressions))*100 as CTR , (SUM(Cost)/1000000)/SUM(Conversions) AS costconversion from reporte_keywords_google WHERE Date BETWEEN '2018-01-01' AND '2018-01-31' group by CampaignId,Id having count(*) > 0");
         $result2 = mysql_query("SELECT COUNT(*) as total FROM `reporte_keywords_google` WHERE Date BETWEEN '2018-01-01' AND '2018-01-31'");
    $row4 = mysql_fetch_array($result2);
    $costom=236/$row4['total'];*/
   // echo "por anuncio: ".$costom;
    $result3 = mysql_query("SELECT DISTINCT CampaignName FROM reporte_keywords_google");
   
      }
 


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
    Reporte Formularios
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
     font-size: 12px
}

.nav-pills-primary .nav-item .nav-link.active {
    border: 1px solid #6bd098;
    background: #6bd098;
    color: #fff;
    padding: 0px 10px;
    font-size: 12px
}

.nav-pills-primary .nav-link.active {
    background-color: #6bd098!important;
}

.dropdown-toggle.btn.btn-default.btn-round{
  border-radius: 3px;

}

tbody {
    font-size: 12px;
    text-align: center;
}
</style>



</head>

<body>

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
     

       
        <div class="row">
         

            <div class="col-md-1">
          </div>
        
    
          <div class="col-md-2">

        <h5 class="card-title">Periodo:</h5>
                    <div class="row">
                      <div class="col-lg-5 col-md-6 col-sm-3">
                        <select class="selectpicker" data-size="7" data-style="btn btn-default btn-round" title="Single Select" id="periodo">
                          <option disabled selected>Seleccione</option>
                          <option value="a" >Dias</option>
                          <option value="b" selected>Semanas</option>
                          <option value="c">Mes</option>
                        </select>
                      </div>
                            </select></div>
             
            
           
          </div>
        
             <!-- Date and time range -->
              
             <div class="col-md-6">
              <div class="form-group">
                 <h5 class="card-title">Fecha:</h5>

                <div class="input-group">
                  <input  class="btn btn-default pull-right" name="daterange-btn" id="daterange-btn" value="<?php echo $_POST['daterange-btn']; ?>" autocomplete="off">
                  </input>
                  <input  name="dpag" id="dpag" type="hidden" value="<?php echo $_POST['daterange-btn']; ?>"></input>
                  </div>
                </div>
                </div>

                <div class="col-md-12">

                <ul class="nav nav-pills nav-pills-primary nav-pills-icons justify-content-center" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#link100" role="tablist" onClick="GenerarGraficos(100)">
                      <i class="now-ui-icons objects_umbrella-13"></i> Evolución Consultas Atendidas
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
                   <div class="tab-pane active" id="link100"></div>
                  
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
    var d = "<?php echo $d;?>";
    if(d!==''){ var des='moment("<?php echo $d;?>")'; var has='moment("<?php echo $h;?>")'; }
    else if(d === ''){ var des=moment().startOf('year'); var has=moment().endOf('month');  }
 
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          
          'Mes Actual'  : [moment().startOf('month'), moment().endOf('month')],
          'Mes Pasado'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
          'Hace 2 Meses'  : [moment().subtract(2, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
          'Hace 3 Meses'  : [moment().subtract(3, 'month').startOf('month'), moment().subtract(0, 'month').endOf('month')],
          'Hace 6 Meses'  : [moment().subtract(6,'month').startOf('month'), moment().subtract(0, 'month').endOf('month')],
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
      function (start, end, label) {
      
        $('#daterange-btn span').html(start.format('dd/mm/yyyy') + ' - ' + end.format('dd/mm/yyyy'))
      }
    )

   
  })
  
 



 $('#camp').change(function()
  {
    var valor = $(this).val();
    
    // Lista de modelos
    $.post( 'keywords.php', { valor: valor} ).done( function( respuesta )
    {
      $( '#key' ).html( respuesta );
    });
  });






$('#reporte').addClass("show");
$('#r').addClass("active");
$('#gdf').addClass("active");


  /*$('#daterange-btn').change(function()
  {
    var fecha = $(this).val();
    
  console.log(fecha);
  });*/


    
               
    var x = new Array();
    var y = new Array();
    var d = new Array();
    var params ={

            "ACT": '101'             
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

                    if (o.f) {x[i] = parseInt(o.f);}
                    if (o.d) { d[i] ='Semana '+parseInt(o.d);}

                    //if (o.y) {DatosRecuperados[i].y = parseFloat(o.y);}
            //           var x =parseInt(DatosRecuperados[i].x);
            


               });
                    
					$('#link100').html('<table id="example99" class="cell-border compact stripe"><thead style="text-align: center;"><tr><th> Semana </th><th> Cantidad de Consultas </th></tr></thead><tbody id="example99"></tbody></table>');
					$.each(DatosRecuperados, function(i, d) {
					
					$('#example99').append('<tr><td>'+d.d+'</td><td>'+d.f+'</td></tr>');
					});
                //console.log(x);
                         $('#container').highcharts({
					  chart: {
					    type: 'line'
					  },
					  title: {
					    text: 'Evolución de Consultas Atendidas'
					  },
					  subtitle: {
					    text: 'Movil Tours'
					  },
					  xAxis: {
					    categories: d,
					     labels: {
                                           
                                            rotation: -45,
                                            style: {
                                              fontSize: '13px',
                                              fontFamily: 'Verdana, sans-serif',
                                              color: '#00AD82'
                                            }
                                          }
					  },
					  yAxis: {
					    title: {
					      text: 'Formularios'
					    }
					  },
					  plotOptions: {
					    line: {
					      dataLabels: {
					        enabled: true
					      },
					      enableMouseTracking: false
					    }
					  },
					  series: [{
					    name: 'Formularios',
					    data: x
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
                          previous:   "Anteiror",
                          next:       "Siguiente",
                          last:       "Anterior"
                      }
                      
                      }
            });
               
        }


        });


function GenerarGraficos(id){





    var periodo = $('#periodo').val();
    var fecha = $('#daterange-btn').val();
    var x = new Array();
    var y = new Array();
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
    var titulo3;

    var params ={

            "ACT": id,
            "fecha": fecha,
            "periodo": periodo             
        };
console.log(params);
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

                    if (o.f!=null) {x[i] = parseInt(o.f);} else{x[i]=0; }
                    if (o.y) {y[i] = parseInt(o.y);} else{y[i]=0; }
                    if (o.w) {w[i] = parseFloat(o.w);}
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
                   	  titulo3 = 'Dia'; 
                    }

                    if(periodo=='b'){
                      titulo = 'Año'; 
                      titulo2 = 'Semana'; 
                      d[i] ='Semana '+parseInt(o.d);
                      titulo3 = 'Semana'; 
                   
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
                    titulo3 = 'mes';  

                    }
                    

                    


               });
              
              
                  

             if(id==100){

                  $('#link100').html('<table id="example100" class="cell-border compact stripe"><thead style="text-align: center;"><tr><th> '+titulo3+' </th><th> Cantidad de Formularios </th></tr></thead><tbody id="example100"></tbody></table>');
                  $.each(DatosRecuperados, function(i, d) {
                  
                  $('#example100').append('<tr><td>'+d.d+'</td><td>'+d.f+'</td></tr>');
                  });
                  
                  console.log(DatosRecuperados);

      
 


                  $('#container').highcharts({
					  chart: {
					    type: 'line'
					  },
					  title: {
					    text: 'Evolución de Formularios'
					  },
					  subtitle: {
					    text: 'ILCB'
					  },
					  xAxis: {
					    categories: d,
					     labels: {
                                           
                                            rotation: -45,
                                            style: {
                                              fontSize: '13px',
                                              fontFamily: 'Verdana, sans-serif',
                                              color: '#00AD82'
                                            }
                                          }
					  },
					  yAxis: {
					    title: {
					      text: 'Formularios'
					    }
					  },
					  plotOptions: {
					    line: {
					      dataLabels: {
					        enabled: true
					      },
					      enableMouseTracking: false
					    }
					  },
					  series: [{
					    name: 'Formularios',
					    data: x
					  }]
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


                    
                  $('#link4').html('<table id="example4" class="cell-border compact stripe"><thead style="text-align: center;"><tr><th> '+titulo+' </th><th> '+titulo2+' </th><th>Nuevos Likes (%)</th><th>Dislikes (%)</th></tr></thead><tbody id="example4"></tbody></table>');
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
                  
                 // concole.log(d);



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

                    console.log(DatosRecuperados);
                                 $('#container').highcharts({
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
                                                    previous:   "Anteiror",
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