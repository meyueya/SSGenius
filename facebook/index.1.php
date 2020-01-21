<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('controller/ssgController.php');
define("NIVEL_MIN_PERMISO",1);
require_once('controller/user.php');
?>
<!DOCTYPE html>
<html  lang="es" dir="ltr">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" sizes="32x32" />
  <link rel="icon" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" sizes="192x192" />
  <!-- <link rel="apple-touch-icon-precomposed" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" /> -->
  <meta name="msapplication-TileImage" content="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" />
  <title>
    SSG
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!-- Extra details for Live View on GitHub Pages -->
  <!-- Canonical SEO -->
  <link rel="canonical" href="https://ssgenius.com" />
  <!--  Social tags      -->
  <meta name="description" content="El SSG mejora tu estrategia de Facebook, te permite lograr tus objetivos y conectar con tu comunidad.">
  <!-- Schema.org markup for Google+ -->
  <meta itemprop="name" content="Social Stats Genius">
  <meta itemprop="description" content="El SSG mejora tu estrategia de Facebook, te permite lograr tus objetivos y conectar con tu comunidad.">
  <meta itemprop="image" content="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png">
  <!-- Twitter Card data -->
  <meta name="twitter:card" content="product">
  <meta name="twitter:site" content="@ssgenius">
  <meta name="twitter:title" content="Social Stats Genius">
  <meta name="twitter:description" content="El SSG mejora tu estrategia de Facebook, te permite lograr tus objetivos y conectar con tu comunidad.">
  <meta name="twitter:creator" content="@ssgenius">
  <meta name="twitter:image" content="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png">
  <!-- Open Graph data -->
  <meta property="fb:app_id" content="292708578241182">
  <meta property="og:title" content="Social Stats Genius" />
  <meta property="og:type" content="article" />
  <meta property="og:url" content="https://ssgenius.com/" />
  <meta property="og:image" content="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" />
  <meta property="og:description" content="El SSG mejora tu estrategia de Facebook, te permite lograr tus objetivos y conectar con tu comunidad." />
  <meta property="og:site_name" content="SSG" />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <!-- <link href="../../../maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet"> -->
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/paper-dashboard.min790f.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <link href="./assets/demo/issg.css" rel="stylesheet" />
  
  <!-- Extra-->
  <link rel="stylesheet" href="assets/css/daterangepicker.css">
  <link rel="stylesheet" href="assets/css/bootstrap-multiselect.css" type="text/css"/>
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.css" rel="stylesheet" />

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
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
    <!-- End Google Tag Manager (noscript) -->
  <?php include('views/ssgmodal.php');?>
  <div class="wrapper ">
    <?php include('views/menuaside.1.php');?>
    <?php //var_dump($page);?>
    <div class="main-panel">
      <!-- Navbar -->
    <?php include('views/menunav.php');?>
      <!-- End Navbar -->

      <div class="content">
          <?php if (!$checkPage && !$checkInfoPage){
   /*  $psid_temp=$_SESSION['firstPageSsg'];
    header("Location: ?psid=$psid_temp"); */
    echo "<div class='message-ssg-alert text-center'>";
    echo "<h3 class='card-title  ssg-wait-title'>A&ntilde;ada una p&aacute;gina y disfrute las ventajas de usar el SSG</h3>";
    echo '<div class="lds-ring"><div></div><div></div><div></div><div></div></div>';
    echo "</div>";
    exit();
}?>
        <?php include('views/filtrosssg.php');?>
        <?php if ($qtyresult > 0){ ?>
        <div class="contain-grapics">
        <?php $nuevo = htmlentities(htmlentities("<a href='test'>Test</a>", ENT_QUOTES));?>
            <?php if($filtro!=null):?><div id="grafica0" class="card" style="min-width: 310px; width:100%; height: 300px; margin:12px auto;"></div><?php endif?>
            <div id="grafica1" class="card" style="min-width: 310px; width:100%; height: 300px; margin:12px auto;"></div>
            <div id="grafica2" class="card" style="min-width: 310px; width:100%; height: 240px; margin:12px auto;"></div>
            <div id="grafica3" class="card" style="min-width: 310px; width:100%; height: 240px; margin:12px auto;"></div>
            <div id="grafica4" class="card" style="min-width: 310px; width:100%; height: 240px; margin:12px auto;"></div>
        </div>
        <?php }  else { ?>
        <div class="card" style="min-width: 310px; width:75%; height: 60px; margin:12px auto;">
            <center><br><p class="text-info">No encontramos resultados para los criterios seleccionados.</p></center>
        </div>
        <?php } ?>
      </div>
      <?php if ($qtyresult > 0){ ?>
      <?php include('views/panel.php'); ?>
      <?php } ?>
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
 $(function () {
     var d = "<?php echo $dateMin;?>";
    if(d!==''){ 
        var des='moment("<?php echo $dateMin;?>")'; 
        var has='moment("<?php echo $dateMax;?>")'; 
        var maxdatefull='moment("<?php echo $dateMaxFull;?>")';
        var mindatefull='moment("<?php echo $dateMinFull;?>")';
    }
    else if(d === ''){ var des=moment().subtract(29, 'days'); var has=moment();  }

    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Hoy'       : [moment(), moment()],
          'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Últimos 7 Días' : [moment().subtract(6, 'days'), moment()],
          'Últimos 30 Días': [moment().subtract(29, 'days'), moment()],
          'Mes Actual'  : [moment().startOf('month'), moment().endOf('month')],
          'Mes Pasado'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: des,
        endDate  : has,
        maxDate  : maxdatefull,
        minDate  : mindatefull,
        "autoApply": true,
        locale : {
        "format": 'YYYY-MM-DD',
        "separator": " | ",
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
        $('#daterange-btn span').html(start.format('dd-mm-yyyy') + ' | ' + end.format('dd-mm-yyyy'))
      }
    );
 }); 


 var array_code = <?php echo $arrayDataIds; ?>;

       (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v3.1';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

       // Grafica #0
  <?php if($filtro!=null):?>
    <?php 
    $costoPorAccion='';
    foreach ($arrayPost as $key => $value) {
        $costoPorAccion.=$value['costo_'.$value['filtro']].',';
    }
    ?>
        Highcharts.chart('grafica0', {
          chart: {
            zoomType: 'xy'
          },

           plotOptions: {
        series: {
            cursor: 'pointer',
            point: {
                events: {
                    click: function (e) {
                        llenar_ssgmodal(this.category,array_code[this.category]);
                        return false;
                    }
                }
            }
        }
    },
     showInLegend: true,
          title: {
            text: '<?=$nombrekpi?> por Publicación'
          },
          subtitle: {
            text: 'Ssgenius.com'
          },
          xAxis: [{
            categories: [<?php echo rtrim($count,','); ?>],
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
              text: '<?=$nombrekpi?>',
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
              text: 'Índice <?=$nombrekpi?>',
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
            name: '<?=$nombrekpi?>',
            color:'#00CA79',
            type: 'column',
            yAxis: 1,
            data: [<?php echo rtrim($kpiData,','); ?>]
           

          }, {
            name: 'Índice <?=$nombrekpi?>',
            color:'#EB7CB4',
            type: 'spline',
            yAxis: 2,
            data: [<?php echo rtrim($indice_kpi_Round ,','); ?>],
            marker: {
              enabled: false
            }

          }, {
            name: 'Índice inter Alcance',
            color:'#9ACA61',
            type: 'spline',
            data:  [<?php echo rtrim($indice_kpi_alcance_Round ,','); ?>],
            marker: {
              enabled: false
            }

          }, {
            name: 'Índice de <?=$nombrekpi?> vs Inversión',
            color:'#9966FF',
            type: 'spline',
            data: [<?php echo rtrim($indice_kpi_inversion_Round ,','); ?>],
            marker: {
              enabled: false
            }

          }, {
            name: 'Índice Alcance vs Inversión',
            color:'#7CB5EC',
            type: 'spline',
            data: [<?php echo rtrim($indice_interalcance_inversionDataRound ,','); ?>],
            marker: {
              enabled: false
            }
          }, {
            name: 'Costo por Acción',
            color:'#7CB5EC',
            type: 'spline',
            data: [<?php echo rtrim($costoPorAccion ,','); ?>],
            marker: {
              enabled: false
            }

          }]
        });
<?php endif?>
       // fin grafica 0
   
       //graficas                             
Highcharts.chart('grafica1', {
    chart: {
        zoomType: 'xy'
    },
    plotOptions: {
        series: {
            cursor: 'pointer',
            point: {
                events: {
                    click: function (e) {
                        llenar_ssgmodal(this.category,array_code[this.category]);
                        return false;
                    }
                }
            }
        }
    },
            showInLegend: true,
    title: {
        text: 'Interacción por Publicación'
    },
    subtitle: {
        text: ''
    },
    credits: {
         enabled: false
     },
    xAxis: [{
        categories: [<?php echo rtrim($count,','); ?>],
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
            format: '{value} ',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        opposite: true
    }],
    tooltip: {
        borderColor: '#FFF',
        useHTML: true,
        shared: true,
        shadow:false,
      formatter: function () {
             var s = '<div class="row"><div class="col-md-8"><b>P' + this.x + ' </b> ' + this.points[0].point.date + '';
            $.each(this.points, function () {
                s += '<br/><span style="color:'+this.series.color+';"><b> &#x25cf; </span></b> ' + this.series.name + ': <b>' +
                    this.y + '</b>';
            });
            s += '<br/></div> <div class="col-md-4 text-center justify-content-center align-self-center" style="padding:0;"><span class="align-middle"><img style="max-width: 100%; height: auto;" src="' + this.points[0].point.img + '"></img></span></div> </div>';

		 /*	var s = [];
     s.push('<b>' +this.x + '</b>');
      this.points.forEach(function(point) {
          if (point.series.name == "Reacciones"){
            s.push('<span style="color:'+point.series.color+'">' + point.series.name + ':</span><b>  ' + point.y + ' </b><img width="100" src="' + point.point.img + '"></img>');
          } else {
              s.push('<span style="color:'+point.series.color+'">' + point.series.name + ':</span><b> ' + point.y + '</b>'); 
          }
      });*/
            return s;
      }
          //,  split: true
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
        data: [<?php echo rtrim($reaccionesData,','); ?>],
        tooltip: {
            valueSuffix: ' '
        }

    },{
        name: 'Compartir',
        type: 'column',
        yAxis: 1,
        data: [<?php echo rtrim($sharesData,','); ?>],
        tooltip: {
            valueSuffix: ' '
        }

    },{
        name: 'Comentario',
        type: 'column',
        yAxis: 1,
        data: [<?php echo rtrim($commentsData,','); ?>],
        tooltip: {
            valueSuffix: ' '
        }

    },{
        name: 'Vistas de video',
        type: 'column',
        yAxis: 1,
        data: [<?php echo rtrim($post_video_views_uniqueData,','); ?>],
        tooltip: {
            valueSuffix: ' '
        }

    },{
        name: 'Clics a links',
        type: 'column',
        yAxis: 1,
        data: [<?php echo rtrim($link_clicksData,','); ?>],
        tooltip: {
            valueSuffix: ' '
        }

    },{
        name: 'Indice de Interacción',
        type: 'spline',
        data: [<?php echo rtrim($indiceInteraccionData,',');?>],
        tooltip: {
            valueSuffix: ''
        },
        color: '#EB7CB4'
    }]
});

//grafica
Highcharts.chart('grafica2', {
    chart: {
        zoomType: 'xy'
    },
    plotOptions: {
        series: {
            cursor: 'pointer',
            point: {
                events: {
                    click: function () {
                        llenar_ssgmodal(this.category,array_code[this.category]);
                        return false;
                    }
                }
            }
        }
    },
    title: {
        text: 'Alcance por Publicación'
    },
    subtitle: {
        text: ''
    },
    credits: {
         enabled: false
     },
    xAxis: [{
        categories: [<?php echo rtrim($count,','); ?>],
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
            format: '{value} ',
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
        data: [<?php echo rtrim($alcanceData,','); ?>],
        tooltip: {
            valueSuffix: ' '
        },
        color: '#609ACA'

    },{
        name: 'Indice de Inter Alcance',
        type: 'spline',
        data: [<?php echo rtrim($indiceInteralcanceData,','); ?>],
        tooltip: {
            valueSuffix: ' '
        },
        color: '#9ACA61'

    }]
});

//grafica

Highcharts.chart('grafica3', {
    chart: {
        zoomType: 'xy'
    },
    plotOptions: {
        series: {
            cursor: 'pointer',
            point: {
                events: {
                    click: function () {
                        llenar_ssgmodal(this.category,array_code[this.category]);
                        return false;
                    }
                }
            }
        }
    },
    title: {
        text: 'Inversión por Publicación'
    },
    subtitle: {
        text: ''
    },
    credits: {
         enabled: false
     },
    xAxis: [{
        categories: [<?php echo rtrim($count,','); ?>],
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
        data: [<?php echo rtrim($inversionData,','); ?>],
        tooltip: {
            valueSuffix: ' '
        },
        color: '#FF9965'

    },{
        name: 'Indice de Interacción Inversión',
        type: 'spline',
        data: [<?php echo rtrim($indiceInteraccionInversionData,','); ?>],
        tooltip: {
            valueSuffix: ' '
        },
        color: '#9966FF'

    }]
});

//grafica

Highcharts.chart('grafica4', {
    chart: {
        zoomType: 'xy'
    },
    plotOptions: {
        series: {
            cursor: 'pointer',
            point: {
                events: {
                    click: function () {
                        llenar_ssgmodal(this.category,array_code[this.category]);
                        return false;
                    }
                }
            }
        }
    },
    title: {
        text: 'Índices de Publicación'
    },
    subtitle: {
        text: ''
    },
    credits: {
         enabled: false
     },
    xAxis: [{
        categories: [<?php echo rtrim($count,','); ?>],
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
        data: [<?php echo rtrim($indiceInteraccionDataRound ,','); ?>],
        tooltip: {
            valueSuffix: ' '
        },
        color: '#EB7CB4'

    },{
        name: 'Índice de Inter Alcance',
        type: 'spline',
        data: [<?php echo rtrim($indiceInteralcanceDataRound ,','); ?>],
        tooltip: {
            valueSuffix: ' '
        },
        color: '#9ACA61'

    },{
        name: 'Índice de Interacción vs Inversión',
        type: 'spline',
        data: [<?php echo rtrim($indiceInteraccionInversionDataRound ,','); ?>],
        tooltip: {
            valueSuffix: ' '
        },
        color: '#9966FF'

    },{
        name: 'Indice de Inter Alcance vs Inversión',
        type: 'spline',
        data: [<?php echo rtrim($indice_interalcance_inversionDataRound ,','); ?>],
        tooltip: {
            valueSuffix: ' '
        },
        color: '#7CB5EC'

    }]
});
function llenar_ssgmodal(id_post,info_post) {
    console.log(id_post);
    console.log(info_post);
    $('#postTitleModal').html(id_post);
    if (info_post['message'].length>200) {
        $('#text-comunity').html(info_post['message'].substr(0, 200));
        $('#text-complement').html(info_post['message'].substr(200, info_post['message'].length));
        $(".more").show();
    } else {
        $('#text-comunity').html(info_post['message']);
        $(".more").hide();
    }
    $('#pic-post').attr("src", info_post['picture']);
    $('#fecha_post').html(info_post['fecha_post']);
    $('#fecha').html(info_post['fecha']);
    $('#hora').html(info_post['hora']);
    $('#dia_semana').html(info_post['dia_semana']);
    $('#link').html('<a href="'+info_post['link']+'" target="_blank">clic aquí</a>');
    $('#anchor-post').attr("href", info_post['link']);
    $('#postsDay').html(info_post['postsDay']);
    $('.nombre_kpi').html(info_post['nombrekpi']);
    $('#kpi_value').html(info_post[info_post['filtro']]);
    $('#indice_kpi').html(info_post['indice_kpi']);
    $('#indice_kpi_alcance').html(info_post['indice_kpi_alcance']);
    $('#indice_kpi_inversion').html(info_post['indice_kpi_inversion']);
    $('#costo_kpi').html(info_post['costo_'+info_post['filtro']]);
    $('#fanpage').html(info_post['fanspage']);
    $('#alcance').html(info_post['alcance']);
    $('#alcance_pagado').html(info_post['alcance_pagado']);
    $('#alcance_organico').html(info_post['alcance_organico']);
    $('#comentarios').html(info_post['comentarios']);
    $('#reacciones').html(info_post['reacciones']);
    $('#compartir').html(info_post['compartir']);
    $('#link_clicks').html(info_post['link_clicks']);
    $('#interacciones_totales').html(info_post['interacciones_totales']);
    $('#post_video_views_unique').html(info_post['post_video_views_unique']);
    //console.log(info_post['post_video_views_unique']);
    $('#inversion').html('$/ '+info_post['inversion']);
    $('#indice_interaccion').html(info_post['indice_interaccion']);
    $('#indice_inter_alcance').html(info_post['indice_inter_alcance']);
    $('#indice_interaccion_inversion').html(info_post['indice_interaccion_inversion']);
    $('#indice_inter_alcance_inversion').html(info_post['indice_inter_alcance_inversion']);
    $('#tipo').html(info_post['tipo']);
    $('#objetivo').html(info_post['objetivo']);
    $('#nivelLibertad').html(info_post['nivelLibertad']);
    $("#ver").modal("show");
}

$('#my_pages').addClass("active");
$('#my_pages_examples').addClass("show");
$("#my_page_<?= $_GET['psid']; ?>").addClass("active");

</script>
</body>
</html>