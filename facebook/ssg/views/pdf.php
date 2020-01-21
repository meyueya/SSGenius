<?php
//esto es para traer los tipos y objetivos
include('../model/SsgModel.php');
require_once('../controller/funcionesFormat.php');
$SsgModel = new SsgModel;
/* echo "<pre>";
var_dump($_POST);
echo "</pre>"; */

/* post trae en su ultimo elemento trae el id_unico_reporte del reporte,este será separado*/
$id_unico_reporte=array_pop($_POST);
/* ahora post trae en su ultimo elemento trae el titulo del reporte,este será separado*/
$titulo_reporte=array_pop($_POST);
/* ahora post trae en su ultimo elemento trae los filtros usados en la consulta, estos seran separados para usarlos en la informacion 
que esta fuera de la tabla */
$arrayFiltros=array_pop($_POST);
$arrayFiltros=json_decode($arrayFiltros,true);

$cantAMostrar=count($_POST)+1;
$datosPDF=array();
foreach($_POST as $datos) { 
    array_push($datosPDF,json_decode($datos,true));
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>SSG</title>
  <meta charset="utf-8">
  <noscript>Your browser does not support JavaScript!</noscript>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link rel="stylesheet" href="https://aiw-roi.com/sistema/AIW/assets/css/bootstrap.min.css"> 
  <!--<link rel="stylesheet" href="https://aiw-roi.com/sistema/ilcb/administrator2/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="https://aiw-roi.com/sistema/ilcb/administrator2/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">-->
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
  <!--<script src="../../assets/js/core/jquery.min.js"></script>
  <script src="../../assets/js/core/popper.min.js"></script>
  <script src="../../assets/js/core/bootstrap.min.js"></script>-->
  <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
  <!--<script src="../../assets/js/plugins/bootstrap-switch.js"></script>-->
  <!--  Plugin for Sweet Alert -->
  <!--<script src="../../assets/js/plugins/sweetalert2.min.js"></script>-->
  <!-- Forms Validations Plugin -->
  <!--<script src="../../assets/js/plugins/jquery.validate.min.js"></script>-->
  <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <!--<script src="../../assets/js/plugins/jquery.bootstrap-wizard.js"></script>-->
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <!-- date-range-picker -->
  
  <!-- bootstrap datepicker -->
<!--<script src="https://aiw-roi.com/sistema/ilcb/administrator2/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

  <script src="https://aiw-roi.com/sistema/ilcb/administrator2/bower_components/moment/min/moment.min.js"></script>
  <script src="https://aiw-roi.com/sistema/ilcb/administrator2/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>-->
<!--
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
-->
<style>
html,body{ font-family:Lat; background-color:#FFF;color:#3C4858;font-weight: 400;}
    .hide {
        display: none!important;
    }
    #daterange-btn {
        color: #333;
        background-color: #fff;
        border-color: #ccc;
        width: 205px;
        float:right!important;
    }
    .content{  margin:0 auto;}

    .row > div {
    border: 1px solid #ccc;
    }
    table {
        font-size: 15px;
    }
    th{
        width: 210px;
    }

    .table-dark td, .table-dark th, .table-dark thead th {
        border-color: #ffffff!important;    
    }


</style>
</head>
<body>
<!--<script>
       (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v3.1';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>-->
<div class="container">
  <span class="navbar-brand mb-0 h1">Página: <img src="<?php echo $datosPDF[0]['page_picture']; ?>"><?php echo $datosPDF[0]['page_name']; ?></span>
  <span class="navbar-brand mb-0 h1">Título: <?php echo $titulo_reporte; ?></span>
</div>

<?php include('mostrarfiltrosPDF.php');?>
<br>
<div class="container">
<table class="table-bordered">
  <thead>
    <tr>
    <th scope="col">Código</th>
            <?php formarColumnasFiltrado($datosPDF,'id'); ?>
    </tr>

    <tr>
    <th scope="col">Fecha</th>
    <?php formarColumnasFiltrado($datosPDF,'fecha'); ?>
    </tr>
    <th scope="col">Hora Creación</th>
    <?php formarColumnasFiltrado($datosPDF,'hora'); ?>
    </tr>
    <th scope="col">Dia Creación</th>
    <?php formarColumnasFiltrado($datosPDF,'dia_semana'); ?>
    </tr>
  </thead>
  <tbody>
<?php if($datosPDF[1]['nombrekpi']!=''):?>
  <tr class="table-dark" >
  <td colspan="<?= $cantAMostrar; ?>" class="text-center"> <strong>Indicador de Filtro</strong></td>
  </tr>
    <tr>
      <th scope="row"><?= $datosPDF[1]['nombrekpi'] ?></th>
    <?php formarColumnasFiltrado($datosPDF,$datosPDF[1]['filtro']); ?>
    </tr>
    <tr>
      <th scope="row">Índice <?= $datosPDF[1]['nombrekpi'] ?></th>
    <?php formarColumnasFiltrado($datosPDF,'indice_kpi'); ?>
    </tr>
    <tr>
      <th scope="row">Índice <?= $datosPDF[1]['nombrekpi'] ?> alcance</th>
    <?php formarColumnasFiltrado($datosPDF,'indice_kpi_alcance'); ?>
    </tr>
    <tr>
      <th scope="row">Índice <?= $datosPDF[1]['nombrekpi'] ?> inversion</th>
    <?php formarColumnasFiltrado($datosPDF,'indice_kpi_inversion'); ?>
    </tr>
    <?php endif?>
  <tr class="table-dark" >
  <td colspan="<?= $cantAMostrar; ?>" class="text-center"> <strong>Principales</strong></td>
  </tr>
    <tr>
      <th scope="row">Fans a la Fecha</th>
    <?php formarColumnasFiltrado($datosPDF,'fanspage'); ?>
    </tr>
    <tr>
      <th scope="row">Alcance Total</th>
    <?php formarColumnasFiltrado($datosPDF,'alcance'); ?>
    </tr>
    <tr>
      <th scope="row">Alcance Pagado</th>
    <?php formarColumnasFiltrado($datosPDF,'alcance_pagado'); ?>
    </tr>
    <tr>
      <th scope="row">Alcance Orgánico</th>
    <?php formarColumnasFiltrado($datosPDF,'alcance_organico'); ?>
    </tr>
    <tr>
      <th scope="row">Comentario</th>
    <?php formarColumnasFiltrado($datosPDF,'comentarios'); ?>
    </tr>
    <tr>
      <th scope="row">Reacciones</th>
    <?php formarColumnasFiltrado($datosPDF,'reacciones'); ?>
    </tr>
    <tr>
      <th scope="row">Compartir</th>
    <?php formarColumnasFiltrado($datosPDF,'compartir'); ?>
    </tr>
    <tr>
      <th scope="row">Click a Link </th>
    <?php formarColumnasFiltrado($datosPDF,'link_clicks'); ?>
    </tr>
    <tr>
      <th scope="row">Vistas Video </th>
    <?php formarColumnasFiltrado($datosPDF,'post_video_views_unique'); ?>
    </tr>
    <tr>
      <th scope="row">Interacciones Totales</th>
    <?php formarColumnasFiltrado($datosPDF,'interacciones_totales'); ?>
    </tr>
    <tr>
      <th scope="row">Inversión $</th>
    <?php formarColumnasFiltrado($datosPDF,'inversion'); ?>
    </tr>
    <tr class="table-dark" >
        <td colspan="<?= $cantAMostrar; ?>" class="text-center"> <strong>Índices</strong></td>
    </tr>
    <tr>
      <th scope="row">índice de Interacción</th>
    <?php formarColumnasFiltrado($datosPDF,'indice_interaccion'); ?>
    </tr>
    <tr>
      <th scope="row">índice Inter Alcance</th>
    <?php formarColumnasFiltrado($datosPDF,'indice_inter_alcance'); ?>
    </tr>
    <tr>
      <th scope="row">índice Interacción vs Inversión</th>
    <?php formarColumnasFiltrado($datosPDF,'indice_interaccion_inversion'); ?>
    </tr>
    <tr>
      <th scope="row">índice Inter Alcance vs Inversión</th>
    <?php formarColumnasFiltrado($datosPDF,'indice_inter_alcance_inversion'); ?>
    </tr>
    <tr class="table-dark" >
        <td colspan="<?= $cantAMostrar; ?>" class="text-center"> <strong>Catalogación</strong></td>
    </tr>
    <tr>
      <th scope="row">Objetivos</th>
      <?php formarColumnasFiltrado($datosPDF,'objetivo',$cantAMostrar); ?>
    </tr>
    <tr>
      <th scope="row">Tipos</th>
      <?php formarColumnasFiltrado($datosPDF,'tipo',$cantAMostrar); ?>
    </tr>
    <tr>
      <th scope="row">Nivel de Libertad</th>
      <?php formarColumnasFiltrado($datosPDF,'nivelLibertad',$cantAMostrar); ?>
    </tr>
    <tr class="table-dark" >
        <td colspan="<?= $cantAMostrar; ?>" class="text-center"> <strong>Logros</strong></td>
    </tr>
    <tr>
      <th scope="row">Formularios Totales</th>
      <?php for ($i=0; $i < $cantAMostrar-1 ; $i++):?>
      <td>0</td>
      <?php endfor ?>
    </tr>
    <tr>
      <th scope="row">Buen Contacto Call</th>
      <?php for ($i=0; $i < $cantAMostrar-1 ; $i++):?>
      <td>0</td>
      <?php endfor ?>
    </tr>
  </tbody>
</table>
</div>
<br><br>
<div class="container">
    <?php foreach($datosPDF as $array):?>
 <div class="row">
        <div class="col-6">
          <div class="row"> 
            <div class="col font-weight-bold">
              Id Post:
            </div>
            <div class="col font-weight-bold">
              <?= substr($array['id'],25)?>
            </div>
          </div>
           
          <div class="row"> 
            <div class="col">
              Fecha:
            </div>
            <div class="col">
              <?= $array['fecha']?>
            </div>
          </div>
        
          <div class="row"> 
            <div class="col">
              Hora Creación
            </div>
            <div class="col">
              <?= $array['hora']?>
            </div>
          </div>
        
          <div class="row"> 
            <div class="col">
              Dia Creación
            </div>
            <div class="col">
              <?= $array['dia_semana']?>
            </div>
          </div>
        
          <div class="row"> 
            <div class="col">
              Fans a la Fecha
            </div>
            <div class="col">
              <?= $array['fanspage']?>
            </div>
          </div>
        
          <div class="row"> 
            <div class="col">
              Alcance Total
            </div>
            <div class="col">
              <?= $array['alcance']?>
            </div>
          </div>
        
          <div class="row"> 
            <div class="col">
              Alcance Pagado
            </div>
            <div class="col">
              <?= $array['alcance_pagado']?>
            </div>
          </div>
        
          <div class="row"> 
            <div class="col">
              Alcance Orgánico
            </div>
            <div class="col">
              <?= $array['alcance_organico']?>
            </div>
          </div>
        
          <div class="row"> 
            <div class="col">
              Comentario
            </div>
            <div class="col">
              <?= $array['comentarios']?>
            </div>
          </div>
        
          <div class="row"> 
            <div class="col">
              Reacciones
            </div>
            <div class="col">
              <?= $array['reacciones']?>
            </div>
          </div>
        
          <div class="row"> 
            <div class="col">
              Compartir
            </div>
            <div class="col">
              <?= $array['compartir']?>
            </div>
          </div>
        
          <div class="row"> 
            <div class="col">
              Click a Link
            </div>
            <div class="col">
              <?= $array['link_clicks']?>
            </div>
          </div>
        
          <div class="row"> 
            <div class="col">
              Vistas Video
            </div>
            <div class="col">
              <?= $array['post_video_views_unique']?>
            </div>
          </div>
        
          <div class="row"> 
            <div class="col">
              Interacciones Totales
            </div>
            <div class="col">
              <?= $array['interacciones_totales']?>
            </div>
          </div>
        
          <div class="row"> 
            <div class="col">
              Inversión $
            </div>
            <div class="col">
              <?= $array['inversion']?>
            </div>
          </div>
        
          <div class="row"> 
            <div class="col">
              Índice de Interacción
            </div>
            <div class="col">
              <?= $array['indice_interaccion']?>
            </div>
          </div>
        
          <div class="row"> 
            <div class="col">
              Índice Inter Alcance
            </div>
            <div class="col">
              <?= $array['indice_inter_alcance']?>
            </div>
          </div>
        
          <div class="row"> 
            <div class="col">
              Índice Interacción vs Inversión
            </div>
            <div class="col">
              <?= $array['indice_interaccion_inversion']?>
            </div>
          </div>
        
          <div class="row"> 
            <div class="col">
              Índice Inter Alcance vs Inversión
            </div>
            <div class="col">
              <?= $array['indice_inter_alcance_inversion']?>
            </div>
          </div>
        
          <div class="row"> 
            <div class="col">
              Objetivos
            </div>
            <div class="col">
              <?php if(isset($array['objetivo'])):?>
              <?= $array['objetivo']?>
              <?php endif?>
            </div>
          </div>
        
          <div class="row"> 
            <div class="col">
              Tipos
            </div>
            <div class="col">
              <?php if(isset($array['tipo'])):?>
              <?= $array['tipo']?>
              <?php endif?>
            </div>
          </div>
                     
          <div class="row"> 
            <div class="col">
              Nivel de Libertad
            </div>
            <div class="col">
              <?php if(isset($array['nivelLibertad'])):?>
              <?= $array['nivelLibertad']?>
              <?php endif?>
            </div>
          </div>
        
        </div>
        <div class="col-6">
                <br>
                <div class="text-center">
                <img class="img-fluid" style="max-width:100%; max-height:350px;" src="<?= $array['picture']?>">
                </div>
                <br>
                <p><?= $array['message']?></p>
                <!--<div class="fb-post" data-href="<?= $array['link']?>" data-tabs="timeline" data-small-header="false" data-adaptive-container-width="true" data-hide-cover="false" data-show-facepile="true" >
                    <blockquote cite = "<?= $array['link']?>" class=" fb-xfbml-parse-ignore"> 
                        <a href ="<?= $array['link']?>"> 
                        </a> 
                    </blockquote> 
                </div>-->
                <br>
        </div>
 </div>
 <br>
    <?php endforeach ?>
</div>