<?php
require_once('../controller/funcionesFormat.php');
include('../../model/FacebookPageSSGModel.php');
$reporte_fb_post_ssg = new FacebookPageSSGModel;
$SsgModel = new FacebookPageSSGModel;

if (isset($_GET['code']) && $_GET['code']!='') {

    $reporte_fb_post = $reporte_fb_post_ssg->getReporteFacebookPage($_GET['code']);
    $page_id=$reporte_fb_post[0]['page_id'];
    $id_unico_reporte=$reporte_fb_post[0]['id_unico_reporte'];
    $titulo_reporte=$reporte_fb_post[0]['titulo_reporte'];
    $arrayFiltros=$reporte_fb_post[0]['filtros'];
    $arrayFiltros=json_decode($arrayFiltros,true);
    $post_del_reporte=json_decode($reporte_fb_post[0]['contenido_reporte']);
    $datosPDF=array();
    foreach($post_del_reporte as $datos) { 
        array_push($datosPDF,json_decode($datos,true));
    }
    $cantAMostrar=count($datosPDF)+1;

}else{

    /* post trae en su ultimo elemento trae el page_id del reporte,este será separado*/
    $page_id=array_pop($_POST);
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
}
?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from demos.creative-tim.com/paper-dashboard-2-pro/examples/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Aug 2018 16:06:28 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" sizes="32x32" />
  <link rel="icon" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" sizes="192x192" />
  <!-- <link rel="apple-touch-icon-precomposed" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" /> -->
  <meta name="msapplication-TileImage" content="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" />
  <title>
    Reporte SSG
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!-- Extra details for Live View on GitHub Pages -->
  <!-- Canonical SEO -->
  <link rel="canonical" href="https://www.creative-tim.com/product/paper-dashboard-2-pro" />
  <!--  Social tags      -->
  <meta name="keywords" content="creative tim, html dashboard, html css dashboard, web dashboard, bootstrap 4 dashboard, bootstrap 4, css3 dashboard, bootstrap 4 admin, paper dashboard bootstrap 4 dashboard, frontend, responsive bootstrap 4 dashboard, paper design, paper dashboard bootstrap 4 dashboard">
  <meta name="description" content="Paper Dashboard PRO is a beautiful Bootstrap 4 admin dashboard with a large number of components, designed to look beautiful, clean and organized. If you are looking for a tool to manage dates about your business, this dashboard is the thing for you.">
  <!-- Schema.org markup for Google+ -->
  <meta itemprop="name" content="Paper Dashboard PRO by Creative Tim">
  <meta itemprop="description" content="Paper Dashboard PRO is a beautiful Bootstrap 4 admin dashboard with a large number of components, designed to look beautiful, clean and organized. If you are looking for a tool to manage dates about your business, this dashboard is the thing for you.">
  <meta itemprop="image" content="../../../s3.amazonaws.com/creativetim_bucket/products/84/opt_pd2p_thumbnail.jpg">
  <!-- Twitter Card data -->
  <meta name="twitter:card" content="product">
  <meta name="twitter:site" content="@creativetim">
  <meta name="twitter:title" content="Paper Dashboard PRO by Creative Tim">
  <meta name="twitter:description" content="Paper Dashboard PRO is a beautiful Bootstrap 4 admin dashboard with a large number of components, designed to look beautiful, clean and organized. If you are looking for a tool to manage dates about your business, this dashboard is the thing for you.">
  <meta name="twitter:creator" content="@creativetim">
  <meta name="twitter:image" content="../../../s3.amazonaws.com/creativetim_bucket/products/84/opt_pd2p_thumbnail.jpg">
  <!-- Open Graph data -->
  <meta property="fb:app_id" content="655968634437471">
  <meta property="og:title" content="Paper Dashboard PRO by Creative Tim" />
  <meta property="og:type" content="article" />
  <meta property="og:url" content="https://creativetimofficial.github.io/paper-dashboard-2-pro/examples/dashboard.html" />
  <meta property="og:image" content="../../../s3.amazonaws.com/creativetim_bucket/products/84/opt_pd2p_thumbnail.jpg" />
  <meta property="og:description" content="Paper Dashboard PRO is a beautiful Bootstrap 4 admin dashboard with a large number of components, designed to look beautiful, clean and organized. If you are looking for a tool to manage dates about your business, this dashboard is the thing for you." />
  <meta property="og:site_name" content="Creative Tim" />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="../../../maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/paper-dashboard.min790f.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <!-- Extra details for Live View on GitHub Pages -->
</head>

<body class="">
    <div class="container">
            <div style="margin-top: 20px; margin-bottom: 20px;" class="row">
                <div class="col-sm-4 text-center">
                        <span><img src="<?php echo $datosPDF[0]['page_picture']; ?>"> <?php echo $datosPDF[0]['page_name']; ?></span>
                </div>
                <div class="col-sm-4 text-center">
                        <span>Título: <?php echo $titulo_reporte; ?></span>
                </div>
                <div class="col-sm-4 text-center">
                        <h6 class="card-subtitle mb-2 text-muted">Rango de fecha</h6>
                        <?php if(isset($arrayFiltros["daterange-btn"])):?>
                            <p class="card-text"><?= $arrayFiltros["daterange-btn"]?></p>
                        <?php else:?>
                            <p class="card-text">Sin filtros</p>
                        <?php endif ?>
                </div>
            </div> 
    </div>
<?php include('mostrarfiltrosPDF.php');?>
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
                <tr>
                    <th scope="col">Hora Creación</th>
                    <?php formarColumnasFiltrado($datosPDF,'hora'); ?>
                </tr>
                <tr>
                <th scope="col">Dia Creación</th>
                    <?php formarColumnasFiltrado($datosPDF,'dia_semana'); ?>
                </tr>
              </thead>
              <tbody>
                <?php if($datosPDF[0]['nombrekpi']!=''):?>
                <tr class="table-dark" >
                    <td colspan="<?= $cantAMostrar; ?>" class="text-center"> <strong>Indicador de Filtro</strong></td>
                </tr>
                <tr>
                  <th scope="row"><?= $datosPDF[0]['nombrekpi'] ?></th>
                  <?php formarColumnasFiltrado($datosPDF,$datosPDF[0]['filtro']); ?>
                </tr>
                <tr>
                  <th scope="row">Índice <?= $datosPDF[0]['nombrekpi'] ?></th>
                  <?php formarColumnasFiltrado($datosPDF,'indice_kpi'); ?>
                </tr>
                <tr>
                  <th scope="row">Índice <?= $datosPDF[0]['nombrekpi'] ?> alcance</th>
                  <?php formarColumnasFiltrado($datosPDF,'indice_kpi_alcance'); ?>
                </tr>
                <tr>
                  <th scope="row">Índice <?= $datosPDF[0]['nombrekpi'] ?> inversion</th>
                  <?php formarColumnasFiltrado($datosPDF,'indice_kpi_inversion'); ?>
                </tr>
                <tr>
                <th scope="row">Costo por <?= $datosPDF[0]['nombrekpi'] ?> </th>
                <?php formarColumnasFiltrado($datosPDF,'costo_'.$datosPDF[0]['filtro']); ?>
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
  <script async defer src="../../../buttons.github.io/buttons.js"></script>
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
</body>


<!-- Mirrored from demos.creative-tim.com/paper-dashboard-2-pro/examples/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Aug 2018 16:06:45 GMT -->
</html>