<!DOCTYPE html>
<html lang="es">
<head>
  <title>SSG</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" sizes="32x32" />
  <link rel="icon" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" sizes="192x192" />
  <link rel="apple-touch-icon-precomposed" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" />
  <meta name="msapplication-TileImage" content="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" />
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://aiw-roi.com/sistema/AIW/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/daterangepicker.css">
  <link rel="stylesheet"  href="fonts.css" />
  <link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css"/>
  <link rel="stylesheet"  href="css/ssg.css" />
 <noscript>Your browser does not support JavaScript!</noscript> 
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-127066212-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-127066212-1');
</script>
<?php include('controller/ssgController.php');?>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?psid=<?php echo $_GET['psid']; ?>" method="post" id="form_filtros">
<?php include('views/menunav.php');?>
<?php include('views/filtrosssg.php');?>
  <section class="content">
     </form>
</div>
 <div class="container-fluid contain-grapics">
  
    <?php if($filtro!=null):?><div id="grafica0" class="card" style="min-width: 310px; width:100%; height: 300px; margin:12px auto;"></div><?php endif?>
    <div id="grafica1" class="card" style="min-width: 310px; width:100%; height: 300px; margin:12px auto;"></div>
    <div id="grafica2" class="card" style="min-width: 310px; width:100%; height: 240px; margin:12px auto;"></div>
    <div id="grafica3" class="card" style="min-width: 310px; width:100%; height: 240px; margin:12px auto;"></div>
    <div id="grafica4" class="card" style="min-width: 310px; width:100%; height: 240px; margin:12px auto;"></div>
</div>
<?php include('views/ssgmodal.php');?>
   <script src="https://code.jquery.com/jquery-latest.js"></script>
   <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
   <script src="https://aiw-roi.com/sistema/AIW/assets/js/core/popper.min.js"></script>
   <script src="https://aiw-roi.com/sistema/AIW/assets/js/core/bootstrap.min.js"></script>
  <!-- bootstrap datepicker -->
 
  
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/moment.min.js"></script>
  <script src="js/daterangepicker.js"></script>
  <script type="text/javascript" src="js/bootstrap-multiselect.js"></script>



<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

  <!--  Notifications Plugin    -->
  <script src="../../assets/plugins/notify/js/bootstrap-notify.js"></script>


<script>
$(document).ready(function(){
     $('#tiposSelect,#objetivosSelect,#nivelLibertadSelect,#typePost').multiselect({
            numberDisplayed: 2
        });
      $(".scroll").click(function(event){
            event.preventDefault();
            $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
    });
});
</script>
<script>
 var array_code = <?php echo $arrayDataIds; ?>;
 setTimeout(() => {
    $('.env_form_filtros').change(function(){
        $("#form_filtros").submit();
    });  
 }, 1000);

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
      //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });
 }); 
       (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v3.1';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

       // Grafica #0
  <?php if($filtro!=null):?>

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
    $('#postTitleModal').html(id_post);
    $('#text-comunity').html(info_post['message']);
    $('#pic-post').attr("src", info_post['picture']);
    $('#fecha_post').html(info_post['fecha_post']);
    $('#fecha').html(info_post['fecha']);
    $('#hora').html(info_post['hora']);
    $('#dia_semana').html(info_post['dia_semana']);
    $('#link').html('<a href="'+info_post['link']+'" target="_blank">clic aquí</a>');
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

</script>
<?php include('views/panel.php'); ?>
<footer class="footer">
				<div class="container">
					<div class="row align-items-center flex-row-reverse">
						<div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
							Copyright © 2018 <a href="https://ssgenius.com" target="_blank">SSG</a>. Developed with <i class="fa fa-heart heart"></i> by <a href="http://aiw-roi.com/sistema/" target="_blank">AIW</a> & <a href="#" target="_blank">Renato Carabelli</a> All rights reserved.
						</div>
					</div>
				</div>
			</footer>
</body>
</html>