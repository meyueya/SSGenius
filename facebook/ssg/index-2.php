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
<?php
include('controller/ssgController.php');
?>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?psid=<?php echo $_GET['psid']; ?>" method="post">
    <div class="container-fluid2" style="background-color:#FFF;">
        
<nav class="navbar bg-light" style="display:inline-block;">
    <span class="navbar-brand">  
    <a href="https://www.facebook.com/<?php echo $page->id_facebook_page; ?>" class="ft-title" target="_blank"><img src="https://ssgenius.com/app/assets/images/facebook-icon.png"> <span class="nameFacebookPage"> <?php echo $page->name; ?></span></a> <!--<span class="ssgtitle"> SSG</span>-->     
</span>

         <div class="container-fluid" style="display:inline-block; ">
             
            <div class="form-group">
                 <label for="daterange-btn" style="margin-bottom: 0rem;">Periodo:</label>
                <div class="input-group">
                  <input  class="btn btn-default pull-right" name="daterange-btn" id="daterange-btn" autocomplete="off">
                  </input>
                  <input  name="dpag" id="dpag" type="hidden" value="<?php echo $dateMin; ?> - <?php echo $dateMax; ?>"></input>
                  <!--<input type="submit" value="Filtrar">-->
                </div>  
            </div>
        </div>
</nav>
     
</div>
  <section class="content">
      <div class="container-fluid">
       <br>
          <div class="row">
           <!-- <div class="col-md-12">
            <div class="form-group" style=" float:left;margin-right:15%;">
                 <label for="daterange-btn">Periodo:</label>
                <div class="input-group">
                  <input  class="btn btn-default pull-right" name="daterange-btn" id="daterange-btn" autocomplete="off">
                  </input>
                  <input  name="dpag" id="dpag" type="hidden" value="<?php echo $dateMin; ?> - <?php echo $dateMax; ?>"></input>
                </div>  
            </div>
        </div>-->
       </div>
    <div class="row">
        <div class="col-md-6 col-xl-6">
            <div class="card">
                 <h6 style="padding-bottom:5px; margin-top:10px; margin-left:10px; ">Indicadores e Índices</h6>
                <hr />
             <div class="row">
         
        <div class="col-xs-1 col-md-2 col-lg-4" style="padding-left:25px;">
              <div class="form-group">
                  <label for="orderby">Ordenar por:</label>
                  <select class="form-control" id="orderby" name="orderby">
                    <option value="">Fecha</option>
                    <option value="interacciones" <?php  if (isset($_POST['orderby'])) {  if ($_POST['orderby'] == 'interacciones') { echo ' selected="selected"'; } } ?>>Interacciones</option>
                    <option value="reacciones" <?php if (isset($_POST['orderby'])) {  if ($_POST['orderby'] == 'reacciones') { echo ' selected="selected"'; } } ?>>Reacciones</option>
                    <option value="compartir" <?php if (isset($_POST['orderby'])) {  if ($_POST['orderby'] == 'compartir') { echo ' selected="selected"'; } } ?>>Compartir</option>
                    <option value="comentario" <?php if (isset($_POST['orderby'])) {  if ($_POST['orderby'] == 'comentario') { echo ' selected="selected"'; } } ?>>Comentario</option>
                    <option value="vistasVideo" <?php if (isset($_POST['orderby'])) {  if ($_POST['orderby'] == 'vistasVideo') { echo ' selected="selected"'; } } ?>>Vistas de video</option>
                    <option value="clickLinks" <?php if (isset($_POST['orderby'])) {  if ($_POST['orderby'] == 'clickLinks') { echo ' selected="selected"'; } } ?>>Clics a Links</option>
                    <option value="alcancetotal" <?php  if (isset($_POST['orderby'])) {  if ($_POST['orderby'] == 'alcancetotal') { echo ' selected="selected"'; } } ?>>Alcance Total</option>
                    <option value="alcancepagado" <?php  if (isset($_POST['orderby'])) {  if ($_POST['orderby'] == 'alcancepagado') { echo ' selected="selected"'; } } ?>>Alcance Pagado</option>
                    <option value="alcanceorganico" <?php  if (isset($_POST['orderby'])) {  if ($_POST['orderby'] == 'alcanceorganico') { echo ' selected="selected"'; } } ?>>Alcance Orgánico</option>
                    <option value="indice_interaccion" <?php  if (isset($_POST['orderby'])) {  if ($_POST['orderby'] == 'indice_interaccion') { echo ' selected="selected"'; } } ?>>Indice de Interacción</option>
                    <option value="indice_interalcance" <?php  if (isset($_POST['orderby'])) {  if ($_POST['orderby'] == 'indice_interalcance') { echo ' selected="selected"'; } } ?>>Indice de Inter Alcance</option>
                    <option value="inversion" <?php  if (isset($_POST['orderby'])) {  if ($_POST['orderby'] == 'inversion') { echo ' selected="selected"'; } } ?>>Inversión</option>
                    <option value="indice_interaccion_inversion" <?php  if (isset($_POST['orderby'])) {  if ($_POST['orderby'] == 'indice_interaccion_inversion') { echo ' selected="selected"'; } } ?>>Indice de Interacción Inversión</option>
                    <option value="indice_interalcance_inversion" <?php  if (isset($_POST['orderby'])) {  if ($_POST['orderby'] == 'indice_interalcance_inversion') { echo ' selected="selected"'; } } ?>>Indice de Inter Alcance Inversión</option>
                  </select>
            </div>
        </div>  
        
       <div class="col-xs-1 col-md-2 col-lg-4"  style="padding-left:40px;">
              <div class="form-group">
                  <label for="paidUnPaid">Ver:</label>
                  <select class="form-control" id="paidUnPaid" name="paidUnPaid">
                    <option value="">Pagados/No Pagados</option>
                    <option value="nopagados" <?php if (isset($_POST['paidUnPaid'])) { if ($_POST['paidUnPaid'] == 'nopagados') { echo ' selected="selected"'; } } ?>>No Pagados</option>
                    <option value="pagados" <?php if (isset($_POST['paidUnPaid'])) { if ($_POST['paidUnPaid'] == 'pagados') { echo ' selected="selected"'; }  } ?>>Pagados</option>
                  </select>
            </div>
        </div>
        <div class="col-xs-1 col-md-2 col-lg-4" style="padding-left:25px;">
              <div class="form-group">
                  <label for="typePost">Tipo de Publicación:</label>
                  <div class="input-group">
                  <select class="form-control" id="typePost" name="typePost[]" multiple="multiple">
                      <option value="event" <?php echo (isset($_POST['typePost']) && in_array('event', $_POST['typePost'])) ? ' selected="selected"' : ''; ?>>Evento</option>
                      <option value="link" <?php echo (isset($_POST['typePost']) && in_array('link', $_POST['typePost'])) ? ' selected="selected"' : ''; ?>>Link</option>
                      <option value="photo" <?php echo (isset($_POST['typePost']) && in_array('photo', $_POST['typePost'])) ? ' selected="selected"' : ''; ?>>Foto</option>
                      <option value="status" <?php echo (isset($_POST['typePost']) && in_array('status', $_POST['typePost'])) ? ' selected="selected"' : ''; ?>>Status</option>
                      <option value="video" <?php echo (isset($_POST['typePost']) && in_array('video', $_POST['typePost'])) ? ' selected="selected"' : ''; ?>>Video</option>
                  </select>
            </div>
            </div>
        </div>
        </div>
        </div>
         </div>
        <div class="col-md-6 col-xl-6">
            <div class="card">
                <h6 style="padding-bottom:5px; margin-top:10px; margin-left:10px; ">Catalogación</h6>
                <hr />
           <div class="row"> 
         <div class="col-xs-1 col-md-4 col-sm-4" style="padding-left:25px;">
              <div class="form-group">
                <label>Tipo:</label>
                <div class="input-group">
                <select id="tiposSelect" name="tipos[]" multiple="multiple" class="form-control">
                <?php
                foreach ($tipos as $optionTipos)
                {
                ?>
                <option value="<?php echo $optionTipos['id'];?>"<?php echo (isset($_POST['tipos']) && in_array($optionTipos['id'], $_POST['tipos'])) ? ' selected="selected"' : ''; ?>><?php echo $optionTipos['nombre'];?></option>
                <?php }
                ?>
                </select>
                </div>
              </div>
          </div>  
      <div class="col-xs-1 col-md-4 col-sm-4" style="max-width:210px;">
              <div class="form-group">
                <label>Objetivo:</label>
                <div class="input-group">
                <select id="objetivosSelect" name="objetivos[]" multiple="multiple" class="form-control">
                <?php
                foreach ($objetivos as $optionObjetivos)
                {?>
                <option value="<?php echo $optionObjetivos['id'];?>"<?php echo (isset($_POST['objetivos']) && in_array($optionObjetivos['id'], $_POST['objetivos'])) ? ' selected="selected"' : ''; ?>><?php echo $optionObjetivos['nombre'];?></option>
                <?php }
                ?>
                </select>
                </div>
              </div>
          </div>  
          <div class="col-xs-1 col-md-4 col-sm-4" style="max-width:150px;">
              <div class="form-group">
                <label>Nivel de Libertad:</label>
                <div class="input-group">
                <select id="nivelLibertadSelect" name="NivelesLibertad[]" multiple="multiple" class="form-control">
                <?php
                foreach ($nivelesLibertad as $optionNivelesLibertad)
                {?>
                <option value="<?php echo $optionNivelesLibertad['id'];?>"<?php echo (isset($_POST['NivelesLibertad']) && in_array($optionNivelesLibertad['id'], $_POST['NivelesLibertad'])) ? ' selected="selected"' : ''; ?>><?php echo $optionNivelesLibertad['nombre'];?></option>
                <?php }
                ?>
                </select>
                </div>
              </div>
          </div>  
          </div> 
           </div>
          </div> 
    </div>
    <div class="row">
        <div class="col-md-12">
        <button type="submit" name="greport" id="greport" value="GREPORT" class="btn btn-outline-primary" style="margin-top:8px;"><i class="fa fa-search-plus"></i> Filtrar </button><br><br>
        </div>
    </div>
     
    </div>
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
                        /*$('#fb-post').attr('data-href','');
                         var postJ = array_code[this.category]['id'].split("_");
                         var PageId = postJ[0];
                         var PostId = postJ[1];
                        $('#fb-post').attr('data-href','https://www.facebook.com/' + PageId + '/posts/'+PostId+'/');
                        FB.XFBML.parse();*/
                        llenar_ssgmodal(this.category,array_code[this.category]);
/*                         $('#postTitleModal').html(this.category);
                        $('#text-comunity').html(array_code[this.category]['message']);
                        $('#pic-post').attr("src", array_code[this.category]['picture']);
                        $('#fecha_post').html(array_code[this.category]['fecha_post']);
                        $('#fecha').html(array_code[this.category]['fecha']);
                        $('#hora').html(array_code[this.category]['hora']);
                        $('#dia_semana').html(array_code[this.category]['dia_semana']);
                        $('#link').html('<a href="'+array_code[this.category]['link']+'" target="_blank">clic aquí</a>');
                        $('#postsDay').html(array_code[this.category]['postsDay']);
                        $('#fanpage').html(array_code[this.category]['fanspage']);
                        $('#alcance').html(array_code[this.category]['alcance']);
                        $('#alcance_pagado').html(array_code[this.category]['alcance_pagado']);
                        $('#alcance_organico').html(array_code[this.category]['alcance_organico']);
                        $('#comentarios').html(array_code[this.category]['comentarios']);
                        $('#reacciones').html(array_code[this.category]['reacciones']);
                        $('#compartir').html(array_code[this.category]['compartir']);
                        $('#link_clicks').html(array_code[this.category]['link_clicks']);
                        $('#post_video_views_unique').html(array_code[this.category]['post_video_views_unique']);
                        $('#inversion').html('$/ '+array_code[this.category]['inversion']);
                        $('#indice_interaccion').html(array_code[this.category]['indice_interaccion']);
                        $('#indice_inter_alcance').html(array_code[this.category]['indice_inter_alcance']);
                        $('#indice_interaccion_inversion').html(array_code[this.category]['indice_interaccion_inversion']);
                        $('#indice_inter_alcance_inversion').html(array_code[this.category]['indice_inter_alcance_inversion']);
                        $('#tipo').html(array_code[this.category]['tipo']);
                        $('#objetivo').html(array_code[this.category]['objetivo']);
                        $('#nivelLibertad').html(array_code[this.category]['nivelLibertad']);
                        $("#ver").modal("show"); */
                         //FB.Event.subscribe('xfbml.render', function(response) {
                             // alert('OMG... All Facebook sociaal plugins on page rendereed.... finally!');
                         // });
                        //alert('category: ' + PostId + ', value: ' + this.y);
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
                        /*$('#fb-post').attr('data-href','');
                         var postJ = array_code[this.category]['id'].split("_");
                         var PageId = postJ[0];
                         var PostId = postJ[1];
                        $('#fb-post').attr('data-href','https://www.facebook.com/' + PageId + '/posts/'+PostId+'/');
                        FB.XFBML.parse();*/
                        llenar_ssgmodal(this.category,array_code[this.category]);
                      /*   $('#postTitleModal').html(this.category);
                        $('#text-comunity').html(array_code[this.category]['message']);
                        $('#pic-post').attr("src", array_code[this.category]['picture']);
                        $('#fecha_post').html(array_code[this.category]['fecha_post']);
                        $('#fecha').html(array_code[this.category]['fecha']);
                        $('#hora').html(array_code[this.category]['hora']);
                        $('#dia_semana').html(array_code[this.category]['dia_semana']);
                        $('#link').html('<a href="'+array_code[this.category]['link']+'" target="_blank">clic aquí</a>');
                        $('#postsDay').html(array_code[this.category]['postsDay']);
                        $('#fanpage').html(array_code[this.category]['fanspage']);
                        $('#alcance').html(array_code[this.category]['alcance']);
                        $('#alcance_pagado').html(array_code[this.category]['alcance_pagado']);
                        $('#alcance_organico').html(array_code[this.category]['alcance_organico']);
                        $('#comentarios').html(array_code[this.category]['comentarios']);
                        $('#reacciones').html(array_code[this.category]['reacciones']);
                        $('#compartir').html(array_code[this.category]['compartir']);
                        $('#link_clicks').html(array_code[this.category]['link_clicks']);
                        $('#post_video_views_unique').html(array_code[this.category]['post_video_views_unique']);
                        $('#inversion').html('$/ '+array_code[this.category]['inversion']);
                        $('#indice_interaccion').html(array_code[this.category]['indice_interaccion']);
                        $('#indice_inter_alcance').html(array_code[this.category]['indice_inter_alcance']);
                        $('#indice_interaccion_inversion').html(array_code[this.category]['indice_interaccion_inversion']);
                        $('#indice_inter_alcance_inversion').html(array_code[this.category]['indice_inter_alcance_inversion']);
                        $('#tipo').html(array_code[this.category]['tipo']);
                        $('#objetivo').html(array_code[this.category]['objetivo']);
                        $('#nivelLibertad').html(array_code[this.category]['nivelLibertad']);
                        $("#ver").modal("show"); */
                         //FB.Event.subscribe('xfbml.render', function(response) {
                             // alert('OMG... All Facebook sociaal plugins on page rendereed.... finally!');
                         // });
                        //alert('category: ' + PostId + ', value: ' + this.y);
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
/*                         $('#postTitleModal').html(this.category);
                        $('#text-comunity').html(array_code[this.category]['message']);
                        $('#pic-post').attr("src", array_code[this.category]['picture']);
                        $('#fecha_post').html(array_code[this.category]['fecha_post']);
                        $('#fecha').html(array_code[this.category]['fecha']);
                        $('#hora').html(array_code[this.category]['hora']);
                        $('#dia_semana').html(array_code[this.category]['dia_semana']);
                        $('#link').html('<a href="'+array_code[this.category]['link']+'" target="_blank">clic aquí</a>');
                        $('#postsDay').html(array_code[this.category]['postsDay']);
                        $('#fanpage').html(array_code[this.category]['fanspage']);
                        $('#alcance').html(array_code[this.category]['alcance']);
                        $('#alcance_pagado').html(array_code[this.category]['alcance_pagado']);
                        $('#alcance_organico').html(array_code[this.category]['alcance_organico']);
                        $('#comentarios').html(array_code[this.category]['comentarios']);
                        $('#reacciones').html(array_code[this.category]['reacciones']);
                        $('#compartir').html(array_code[this.category]['compartir']);
                        $('#link_clicks').html(array_code[this.category]['link_clicks']);
                        $('#post_video_views_unique').html(array_code[this.category]['post_video_views_unique']);
                        $('#inversion').html('$/ '+array_code[this.category]['inversion']);
                        $('#indice_interaccion').html(array_code[this.category]['indice_interaccion']);
                        $('#indice_inter_alcance').html(array_code[this.category]['indice_inter_alcance']);
                        $('#indice_interaccion_inversion').html(array_code[this.category]['indice_interaccion_inversion']);
                        $('#indice_inter_alcance_inversion').html(array_code[this.category]['indice_inter_alcance_inversion']);
                        $('#tipo').html(array_code[this.category]['tipo']);
                        $('#objetivo').html(array_code[this.category]['objetivo']);
                        $('#nivelLibertad').html(array_code[this.category]['nivelLibertad']);
                        $("#ver").modal("show"); */
                         //FB.Event.subscribe('xfbml.render', function(response) {
                             // alert('OMG... All Facebook sociaal plugins on page rendereed.... finally!');
                         // });
                        //alert('category: ' + PostId + ', value: ' + this.y);
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
/*                         $('#postTitleModal').html(this.category);
                        $('#text-comunity').html(array_code[this.category]['message']);
                        $('#pic-post').attr("src", array_code[this.category]['picture']);
                        $('#fecha_post').html(array_code[this.category]['fecha_post']);
                        $('#fecha').html(array_code[this.category]['fecha']);
                        $('#hora').html(array_code[this.category]['hora']);
                        $('#dia_semana').html(array_code[this.category]['dia_semana']);
                        $('#link').html('<a href="'+array_code[this.category]['link']+'" target="_blank">clic aquí</a>');
                        $('#postsDay').html(array_code[this.category]['postsDay']);
                        $('#fanpage').html(array_code[this.category]['fanspage']);
                        $('#alcance').html(array_code[this.category]['alcance']);
                        $('#alcance_pagado').html(array_code[this.category]['alcance_pagado']);
                        $('#alcance_organico').html(array_code[this.category]['alcance_organico']);
                        $('#comentarios').html(array_code[this.category]['comentarios']);
                        $('#reacciones').html(array_code[this.category]['reacciones']);
                        $('#compartir').html(array_code[this.category]['compartir']);
                        $('#link_clicks').html(array_code[this.category]['link_clicks']);
                        $('#post_video_views_unique').html(array_code[this.category]['post_video_views_unique']);
                        $('#inversion').html('$/ '+array_code[this.category]['inversion']);
                        $('#indice_interaccion').html(array_code[this.category]['indice_interaccion']);
                        $('#indice_inter_alcance').html(array_code[this.category]['indice_inter_alcance']);
                        $('#indice_interaccion_inversion').html(array_code[this.category]['indice_interaccion_inversion']);
                        $('#indice_inter_alcance_inversion').html(array_code[this.category]['indice_inter_alcance_inversion']);
                        $('#tipo').html(array_code[this.category]['tipo']);
                        $('#objetivo').html(array_code[this.category]['objetivo']);
                        $('#nivelLibertad').html(array_code[this.category]['nivelLibertad']);
                        $("#ver").modal("show"); */
                         //FB.Event.subscribe('xfbml.render', function(response) {
                             // alert('OMG... All Facebook sociaal plugins on page rendereed.... finally!');
                         // });
                        //alert('category: ' + this.category + ', value: ' + this.y);
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
/*                         $('#postTitleModal').html(this.category);
                        $('#text-comunity').html(array_code[this.category]['message']);
                        $('#pic-post').attr("src", array_code[this.category]['picture']);
                        $('#fecha_post').html(array_code[this.category]['fecha_post']);
                        $('#fecha').html(array_code[this.category]['fecha']);
                        $('#hora').html(array_code[this.category]['hora']);
                        $('#dia_semana').html(array_code[this.category]['dia_semana']);
                        $('#link').html('<a href="'+array_code[this.category]['link']+'" target="_blank">clic aquí</a>');
                        $('#postsDay').html(array_code[this.category]['postsDay']);
                        $('#fanpage').html(array_code[this.category]['fanspage']);
                        $('#alcance').html(array_code[this.category]['alcance']);
                        $('#alcance_pagado').html(array_code[this.category]['alcance_pagado']);
                        $('#alcance_organico').html(array_code[this.category]['alcance_organico']);
                        $('#comentarios').html(array_code[this.category]['comentarios']);
                        $('#reacciones').html(array_code[this.category]['reacciones']);
                        $('#compartir').html(array_code[this.category]['compartir']);
                        $('#link_clicks').html(array_code[this.category]['link_clicks']);
                        $('#post_video_views_unique').html(array_code[this.category]['post_video_views_unique']);
                        $('#inversion').html('$/ '+array_code[this.category]['inversion']);
                        $('#indice_interaccion').html(array_code[this.category]['indice_interaccion']);
                        $('#indice_inter_alcance').html(array_code[this.category]['indice_inter_alcance']);
                        $('#indice_interaccion_inversion').html(array_code[this.category]['indice_interaccion_inversion']);
                        $('#indice_inter_alcance_inversion').html(array_code[this.category]['indice_inter_alcance_inversion']);
                        $('#tipo').html(array_code[this.category]['tipo']);
                        $('#objetivo').html(array_code[this.category]['objetivo']);
                        $('#nivelLibertad').html(array_code[this.category]['nivelLibertad']);
                        $("#ver").modal("show"); */
                         //FB.Event.subscribe('xfbml.render', function(response) {
                             // alert('OMG... All Facebook sociaal plugins on page rendereed.... finally!');
                         // });
                        //alert('category: ' + this.category + ', value: ' + this.y);
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