<?php
session_start();
define("NIVEL_MIN_PERMISO",1);
require_once('controller/user.php');
include('controller/funcionesFormat.php');
if (isset($_GET['edit'])) {
  include('../model/ReporteFacebookModel.php');
  $informes_fb = new ReporteFacebookModel;
  $infoa = $informes_fb->getInformeFB($_GET['psid'],$_GET['edit']);
    $_SESSION['id_inf']=$infoa[0]['id_inf'];
    $_SESSION['titulo_reporte']=$infoa[0]['titulo_reporte'];
    $_SESSION['id_page']=$infoa[0]['id_page'];
    $_SESSION['periodo']=$infoa[0]['periodo'];
    $_SESSION['fecha']=$infoa[0]['fecha'];
    $_SESSION['fecha_comparacion']=$infoa[0]['fecha_comparacion'];
    $_SESSION['fecha_informe']=$infoa[0]['fecha_informe'];
    $infoactual=json_encode($infoa);
}else{
    $infoactual=array();
}

foreach($pages as $page){
  if($page["id_facebook_page"]==$_SESSION["id_page"]){
    $pagina_actual=$page;
  }
}

?>
<!DOCTYPE html>
<html  lang="en" dir="ltr">
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
  <meta property="fb:app_id" content="655968634437471">
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

<style>
.main-print {
    background-color: #f4f3ef;
    padding: 20px;
}
.row{
margin-left: 5px;
margin-right: 5px;
}

.comen2 {
  
    text-align: left;
    padding: 10px;
    font-family: Montserrat,Helvetica Neue,Arial,sans-serif;
    line-height: 1.8rem;
}
</style>
</head>

<body class="">
  <!-- Extra details for Live View on GitHub Pages -->
  <!-- Google Tag Manager (noscript) -->
  <noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe>
  </noscript>
  <!-- End Google Tag Manager (noscript) -->
  <div class="wrapper">
    <div class="main-print">
      <div class="content">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-sm-3">
                          <img src="https://graph.facebook.com/<?= $_SESSION['id_page']; ?>/picture">
                      </div>
                      <div class="col-sm-6">
                          <h5 class="big-title"><strong><?= $pagina_actual['name']?></strong></h5>
                          <h6 class="big-title"><strong><?= $_SESSION['titulo_reporte']?></strong></h6>
                      </div>
                      <div class="col-sm-3">
                        <div class="pull-right">
                            <img width="80" height="50" src="https://ssgenius.com/wp-content/uploads/2018/10/cropped-logo-1.png" alt="..." class="imag">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-3">
                          <h6 class="big-title"> <strong>Creacion del Informe:</strong></h6>
                          <h6 class="big-title"><?= $_SESSION['fecha_informe']?></h6>
                      </div>
                      <div class="col-md-3">
                          <h6 class="big-title"> <strong>Segmentado por:</strong></h6>
                          <h6 class="big-title"><?= formatPeriod($_SESSION['periodo'])?></h6>
                      </div>
                      <div class="col-md-3">
                          <h6 class="big-title"> <strong>Rango de Busqueda:</strong></h6>
                          <h6 class="big-title"><?= $_SESSION['fecha']?></h6>
                      </div>
                      <div class="col-md-3">
                          <h6 class="big-title"> <strong>Rango de Comparación:</strong></h6>
                          <h6 class="big-title"><?= $_SESSION['fecha_comparacion']?></h6>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <hr>
                    <div class="row">
                        <div class="footer-title"><strong> Comentario Principal:</strong></div>
                    </div>
                    <div class="row">
                        <div class="container comen2" id="0"></div>
                    </div>
                  </div>
              </div>
              <div class="card ">
                <div class="card-body">
                  <div class="row">
                    <div class="footer-title"><strong> Resumen General:</strong></div>
                  </div>
                  <div class="row">
                    <div class="comen2" id="1"></div>
                  </div>
                </div>
              </div>


              <div class="card ">
                <div class="card-body">
                  <div class="row">
                    <div class="footer-title"><strong> Anexos adjuntos: </strong></div>
                  </div>
                  <div class="row">
                    <div id="archivos_subidos"></div>
                  </div>
                </div>
              </div>


            </div>
          </div>
        </div>


  
        
        <div class="row">
            <div class="col-md-12">
              <h4> Métricas globales:</h4>
            </div>
        </div>
        <div class="row">
          <div class="col-sm-2">
            <div class="card card-pricing ">
              <div class="card-header">
                <h6 class="card-category">ALCANCE TOTAL</h6>
              </div>
              <div class="card-body">
                <div class="card-icon icon-primary ">
                  <i class="nc-icon nc-spaceship"></i>
                </div>
                <h3 class="card-title" id="talcance"></h3>
                <ul>
                  <li>
                    <div id="talcance_comp">
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="card card-pricing ">
              <div class="card-header">
                <h6 class="card-category">IMPRESIONES TOTAL</h6>
              </div>
              <div class="card-body">
                <div class="card-icon icon-primary ">
                  <i class="nc-icon nc-share-66"></i>
                </div>
                <h3 class="card-title" id="timp"></h3>
                <ul>
                  <li>
                    <div id="timp_comp">
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="card card-pricing ">
              <div class="card-header">
                <h6 class="card-category">CLICS TOTAL</h6>
              </div>
              <div class="card-body">
                <div class="card-icon icon-primary ">
                  <i class="nc-icon nc-tap-01"></i>
                </div>
                <h3 class="card-title" id="tclics"></h3>
                <ul>
                  <li>
                    <div id="tclics_comp">
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="card card-pricing ">
              <div class="card-header">
                <h6 class="card-category">ENGAGEMENT GLOBAL</h6>
              </div>
              <div class="card-body">
                <div class="card-icon icon-primary ">
                  <i class="nc-icon nc-globe"></i>
                </div>
                <h3 class="card-title" id="engagements"></h3>
                <ul>
                  <li>
                    <div id="engagements_comp">
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="card card-pricing ">
              <div class="card-header">
                <h6 class="card-category">CRECIMIENTO DE FANS</h6>
              </div>
              <div class="card-body">
                <div class="card-icon icon-primary ">
                  <i class="nc-icon nc-satisfied"></i>
                </div>
                <h3 class="card-title" id="nfansn"></h3>
                <ul>
                  <li>
                    <div id="nfansn_comp">
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="card card-pricing ">
              <div class="card-header">
                <h6 class="card-category">TOTAL COMENTARIOS</h6>
              </div>
              <div class="card-body">
                <div class="card-icon icon-primary ">
                  <i class="nc-icon nc-email-85"></i>
                </div>
                <p>Total Comentarios</p>
                <h3 class="card-title" style="margin-top: -18px !important;" id="tcominbox"></h3>
                <p>Total Respuestas</p>
                <h3 class="card-title" style="margin-top: -18px !important;" id="tcominboxr"></h3>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="card card-pricing ">
              <div class="card-header">
                <h6 class="card-category">ALCANCE PAUTA</h6>
              </div>
              <div class="card-body">
                <div class="card-icon icon-primary ">
                  <i class="nc-icon nc-spaceship"></i>
                </div>
                <h3 class="card-title" id="alcancep"></h3>
                <ul>
                  <li>
                    <div id="alcancep_comp">
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="card card-pricing ">
              <div class="card-header">
                <h6 class="card-category">IMPRESIONES PAUTA</h6>
              </div>
              <div class="card-body">
                <div class="card-icon icon-primary ">
                  <i class="nc-icon nc-share-66"></i>
                </div>
                <h3 class="card-title" id="impresionsp"></h3>
                <ul>
                  <li>
                    <div id="impresionsp_comp">
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="card card-pricing ">
              <div class="card-header">
                <h6 class="card-category">CLICS PAUTA</h6>
              </div>
              <div class="card-body">
                <div class="card-icon icon-primary ">
                  <i class="nc-icon nc-tap-01"></i>
                </div>
                <h3 class="card-title" id="clicsp"></h3>
                <ul>
                  <li>
                    <div id="clicsp_comp">
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="card card-pricing ">
              <div class="card-header">
                <h6 class="card-category">ALCANCE ORGÁNICO</h6>
              </div>
              <div class="card-body">
                <div class="card-icon icon-primary ">
                  <i class="nc-icon nc-spaceship"></i>
                </div>
                <h3 class="card-title" id="alcance"></h3>
                <ul>
                  <li>
                    <div id="alcance_comp">
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="card card-pricing ">
              <div class="card-header">
                <h6 class="card-category">IMPRESIONES ORGÁNICA</h6>
              </div>
              <div class="card-body">
                <div class="card-icon icon-primary ">
                  <i class="nc-icon nc-share-66"></i>
                </div>
                <h3 class="card-title" id="impresions"></h3>
                <ul>
                  <li>
                    <div id="impresions_comp">
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="card card-pricing ">
              <div class="card-header">
                <h6 class="card-category">CLICS ORGÁNICA</h6>
              </div>
              <div class="card-body">
                <div class="card-icon icon-primary ">
                  <i class="nc-icon nc-tap-01"></i>
                </div>
                <h3 class="card-title" id="clics"></h3>
                <ul>
                  <li>
                    <div id="clics_comp">
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="card card-pricing ">
              <div class="card-header">
                <h6 class="card-category">FANS PAUTA</h6>
              </div>
              <div class="card-body">
                <div class="card-icon icon-primary ">
                  <i class="nc-icon nc-spaceship"></i>
                </div>
                <h3 class="card-title" id="likespag"></h3>
                <ul>
                  <li>
                    <div id="likespag_comp">
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="card card-pricing ">
              <div class="card-header">
                <h6 class="card-category">FANS ORGÁNICA</h6>
              </div>
              <div class="card-body">
                <div class="card-icon icon-primary ">
                  <i class="nc-icon nc-share-66"></i>
                </div>
                <h3 class="card-title" id="likesorg"></h3>
                <ul>
                  <li>
                    <div id="likesorg_comp">
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="card card-pricing ">
              <div class="card-header">
                <h6 class="card-category">POST PUBLICADOS</h6>
              </div>
              <div class="card-body">
                <div class="card-icon icon-primary ">
                  <i class="nc-icon nc-image"></i>
                </div>
                <h3 class="card-title" id="nropost"></h3>
                <ul>
                  <li>
                    <div id="nropost_comp">
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="card card-pricing ">
              <div class="card-header">
                <h6 class="card-category">ENGAGEMENT ESPECÍFICO</h6>
              </div>
              <div class="card-body">
                <div class="card-icon icon-primary ">
                  <i class="nc-icon nc-globe"></i>
                </div>
                <h3 class="card-title" id="engagements_users"></h3>
                <ul>
                  <li>
                    <div id="engagements_users_comp">
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="card card-pricing ">
              <div class="card-header">
                <h6 class="card-category">COMENTARIOS</h6>
              </div>
              <div class="card-body">
                <div class="card-icon icon-primary ">
                  <i class="nc-icon nc-email-85"></i>
                </div>
                <p>Total Comentarios</p>
                <h3 class="card-title" style="margin-top: -18px !important;" id="tcomen"></h3>
                <p>Total Respuestas</p>
                <h3 class="card-title" style="margin-top: -18px !important;" id="tcomenr"></h3>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="card card-pricing ">
              <div class="card-header">
                <h6 class="card-category">INBOX </h6>
              </div>
              <div class="card-body">
                <div class="card-icon icon-primary ">
                  <i class="nc-icon nc-email-85"></i>
                </div>
                <p>Total Inbox</p>
                <h3 class="card-title" style="margin-top: -18px !important;"  id="tinbox"></h3>
                <p>Total Respuestas</p>
                <h3 class="card-title" style="margin-top: -18px !important;" id="tinboxr"></h3>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-pricing">
              <div class="card-header">
                 <h6 class="card-category comen" >Comentarios Metricas Claves:</h6>
              </div>
              <div class="comen2" id="2"></div>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12">
              <h4> Métricas de publicación:</h4>
            </div>
        </div>
        <div class="row">
            <div id="grafica1" class="card" style="min-width: 200px; width:100%; height: 200px;"></div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="tab-pane" id="pi0"></div>
          </div>
          <div class="col-md-3">
            <div class="tab-pane" id="pi1"></div>
          </div>
          <div class="col-md-3">
            <div class="tab-pane" id="pi2"></div>
          </div>
          <div class="col-md-3">
            <div class="tab-pane" id="pi3"></div>
          </div>         
        </div> 
        <div class="row">
          <div class="col-md-12">
            <div class="card card-pricing">
              <div class="card-header">
                 <h6 class="card-category comen" >Comentarios Interacción por Publicación:</h6>
              </div>
              <div class="comen2" id="3"></div>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12">
              <h4> Métricas de publicación:</h4>
            </div>
        </div>
        <div class="row">
          <div id="grafica2" class="card" style="min-width: 200px; width:100%; height: 200px; "></div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="tab-pane" id="pa0"></div>
          </div>
          <div class="col-md-3">
            <div class="tab-pane" id="pa1"></div>
          </div>
          <div class="col-md-3">
            <div class="tab-pane" id="pa2"></div>
          </div>
          <div class="col-md-3">
            <div class="tab-pane" id="pa3"></div>
          </div>
        </div> 
        <div class="row">
          <div class="col-md-12">
            <div class="card card-pricing">
              <div class="card-header">
                 <h6 class="card-category comen" >Comentarios Alcance por Publicación:</h6>
              </div>
              <div class="comen2"  id="4"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h4> Métricas de publicación:</h4>
          </div>
        </div>   
        <div class="row">
          <div id="grafica3" class="card" style="min-width: 200px; width:100%; height: 200px;"></div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="tab-pane" id="inv0"></div>
          </div>
          <div class="col-md-3">
            <div class="tab-pane" id="inv1"></div>
          </div>
          <div class="col-md-3">
            <div class="tab-pane" id="inv2"></div>
          </div>
          <div class="col-md-3">
            <div class="tab-pane" id="inv3"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-pricing">
              <div class="card-header">
                 <h6 class="card-category comen" >Comentarios Inversión por Publicación:</h6>
              </div>
              <div class="comen2"  id="5"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h4> Métricas de publicación:</h4>
          </div>
        </div>   
        <div class="row">
          <div id="grafica4" class="card" style="min-width: 200px; width:100%; height: 200px; margin:10px auto;"></div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="tab-pane" id="inii0"></div>
          </div>
          <div class="col-md-3">
            <div class="tab-pane" id="inii1"></div>
          </div>
          <div class="col-md-3">
            <div class="tab-pane" id="inii2"></div>
          </div>
          <div class="col-md-3">
            <div class="tab-pane" id="inii3"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-pricing">
              <div class="card-header">
                 <h6 class="card-category comen" >Comentarios Índices de Publicación:</h6>
              </div>
              <div class="comen2" id="6"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h4> Métricas de página:</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8">
            <div class="card-body">
              <div id="container0" style="min-width: 600px;width:1000px; height: 600px; margin: 0 auto"></div>
            </div>
          </div>
          <div class="col-md-1">
          </div>
          <div class="col-md-3">
            <div class="tab-pane" id="link0" ></div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-pricing">
              <div class="card-header">
                <h6 class="card-category comen" > Comentario Nuevos Likes vs Dislikes:</h6>
              </div>
              <div class="comen2" id="7"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h4> Métricas de página:</h4>
          </div>
        </div> 
        <div class="row">
          <div class="col-md-8">
            <div class="card-body">
              <div id="container1" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
            </div>
          </div>
          <div class="col-md-1">
          </div>
          <div class="col-md-3">
            <div class="tab-pane" id="link1"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-pricing">
              <div class="card-header">
                <h6 class="card-category comen" > Comentario Likes vs Dislikes:</h6>
              </div>
              <div class="comen2" id="8"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h4> Métricas de página:</h4>
          </div>
        </div> 
        <div class="row">
          <div class="col-md-8">
            <div class="card-body">
              <div id="container2" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
            </div>
          </div>
         <div class="col-md-1">
          </div>
          <div class="col-md-3">
          <div class="tab-pane" id="link2"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-pricing">
              <div class="card-header">
                <h6 class="card-category comen" > Comentario Crecimiento de Likes:</h6>
              </div>
              <div class="comen2" id="9"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h4> Métricas de página:</h4>
          </div>
        </div>         
        <div class="row">
          <div class="col-md-8">
            <div class="card-body">
                <div id="container3" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
            </div>
          </div>
          <div class="col-md-1">
          </div>
          <div class="col-md-3">
            <div class="tab-pane" id="link3"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-pricing">
              <div class="card-header">
                <h6 class="card-category comen" > Comentario Como se consiguieron los Likes:</h6>
              </div>
              <div class="comen2" id="10"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h4> Métricas de página:</h4>
          </div>
        </div> 
        <div class="row">          
          <div class="col-md-8">
            <div class="card-body">
              <div id="container4" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
            </div>
          </div>
          <div class="col-md-1">
          </div>
          <div class="col-md-3">
            <div class="tab-pane" id="link4"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-pricing">
              <div class="card-header">
                <h6 class="card-category comen" > Comentario Como se consiguieron los Likes Totales:</h6>
              </div>
              <div class="comen2" id="11"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h4> Métricas de página:</h4>
          </div>
        </div> 
        <div class="row"> 
          <div class="col-md-8">
            <div class="card-body">
              <div id="container5" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
            </div>
          </div>
          <div class="col-md-1">
          </div>
          <div class="col-md-3">
            <div class="tab-pane" id="link5"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-pricing">
              <div class="card-header">
                <h6 class="card-category comen" > Comentario Nuevos Fans Netos:</h6>
              </div>
              <div class="comen2" id="12"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h4> Métricas de página:</h4>
          </div>
        </div> 
        <div class="row">          
          <div class="col-md-8">
            <div class="card-body">
              <div id="container6" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
            </div>
          </div>
          <div class="col-md-1">
          </div>
          <div class="col-md-3">
            <div class="row">
              <div class="tab-pane" id="link6"></div>
            </div>
            <div class="row">
              <p style="margin-top: 50px;">Tabla de Comparación</p><br>
            </div>
            <div class="row">
              <div class="tab-pane" id="link6_comparacion"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-pricing">
              <div class="card-header">
                <h6 class="card-category comen" > Comentario Perfil de likes Demográfico:</h6>
              </div>
              <div class="comen2" id="13"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h4> Métricas de página:</h4>
          </div>
        </div> 
        <div class="row">         
          <div class="col-md-8">
            <div class="card-body">
              <div id="container7" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
            </div>
            <div class="form-group">
              <label> Comentario Perfil de fans Edades:</label>
            </div>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-3">
            <div class="row">
              <div class="tab-pane" id="link7"></div>
            </div>
            <div class="row">
              <p style="margin-top: 50px;">Tabla de Comparación</p><br>
            </div>
            <div class="row">
              <div class="tab-pane" id="link7_comparacion"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-pricing">
              <div class="card-header">
                <h6 class="card-category comen" > Comentario Perfil de likes Demográfico:</h6>
              </div>
              <div class="comen2" id="14"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h4> Métricas de página:</h4>
          </div>
        </div> 
        <div class="row"> 
          <div class="col-md-8">
            <div class="card-body">
              <div id="container8" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
            </div>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-3">
            <div class="tab-pane" id="link8"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-pricing">
              <div class="card-header">
                <h6 class="card-category comen" > Comentario Alcance:</h6>
              </div>
              <div class="comen2" id="15"></div>
            </div>
          </div>
        </div> 
        <div class="row">
          <div class="col-md-12">
            <h4> Métricas de página:</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8">
            <div class="card-body">
              <div id="container9" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
            </div>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-3">
            <div class="tab-pane" id="link9"></div>
          </div>      
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-pricing">
              <div class="card-header">
                <h6 class="card-category comen" > Comentario Interacciones::</h6>
              </div>
              <div class="comen2" id="16"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h4> Métricas de página:</h4>
          </div>
        </div>
        <div class="row"> 
          <div class="col-md-8">
            <div class="card-body">
              <div id="container10" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
            </div>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-3">
            <div class="tab-pane" id="link10"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-pricing">
              <div class="card-header">
                <h6 class="card-category comen" > Comentario Likes Demográficos:</h6>
              </div>
              <div class="comen2" id="17"></div>
            </div>
          </div>
        </div>    
        <div class="row">
          <div class="col-md-12">
            <h4> Métricas de página:</h4>
          </div>
        </div>
        <div class="row">  
          <div class="col-md-8">
            <div class="card-body">
              <div id="container11" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
            </div>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-3">
            <div class="tab-pane" id="link11"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-pricing">
              <div class="card-header">
                <h6 class="card-category comen" > Comentario Fans Online:</h6>
              </div>
              <div class="comen2" id="18"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h4> Métricas de página:</h4>
          </div>
        </div>
        <div class="row">         
          <div class="col-md-8">
            <div class="card-body">
              <div id="container12" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
            </div>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-3">
            <div class="tab-pane" id="link12"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-pricing">
              <div class="card-header">
                <h6 class="card-category comen" > Comentario Engaged users vs Engagement rate:</h6>
              </div>
              <div class="comen2" id="19"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h4> Métricas de página:</h4>
          </div>
        </div>
        <div class="row">       
          <div class="col-md-8">
            <div class="card-body">
              <div id="container13" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
            </div>
          </div>
           <div class="col-md-1">
          </div>
          <div class="col-md-3">
            <div class="tab-pane" id="link13"></div>
          </div>        
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-pricing">
              <div class="card-header">
                <h6 class="card-category comen" > Comentario Alcance promedio vs Engagement rate:</h6>
              </div>
              <div class="comen2" id="20"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h4> Métricas de página:</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8">
            <div class="card-body">
              <div id="container14" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
            </div>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-3">
            <div class="tab-pane" id="link14"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-pricing">
              <div class="card-header">
                <h6 class="card-category comen" > Comentario Likes Demográficos Cantidad:</h6>
              </div>
              <div class="comen2" id="21"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h4> Métricas de página:</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8">
            <div class="card-body">
              <div id="container20" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
            </div>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-3">
            <div class="tab-pane" id="link20"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-pricing">
              <div class="card-header">
                <h6 class="card-category comen" > Comentario impresione:</h6>
              </div>
              <div class="comen2" id="22"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h4> Métricas de página:</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8">
            <div class="card-body">
              <div id="container21" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
            </div>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-3">
            <div class="tab-pane" id="link21"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-pricing">
             <div class="card-header">
                <h6 class="card-category comen" > Comentario clics:</h6>
             </div>
             <div class="comen2" id="23"></div>
            </div>
          </div>
        </div>
      </div>
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

<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>



<!-- <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script> -->
<script>
    var id_inf = '<?= $_SESSION['id_inf'] ?>';
    var id_page = '<?= $_SESSION['id_page'] ?>';
    var periodo = '<?= $_SESSION['periodo'] ?>';
    var fecha = '<?= $_SESSION['fecha'] ?>';
    var fecha_comparacion = '<?= $_SESSION['fecha_comparacion'] ?>';
    var categorias = '';
    var infoactual = <?php echo json_encode($infoactual);?>;
</script>
<script src="js/main.js">

</script>

<script src="js/main.js"></script>
<script src="js/uploadfile.js"></script>
        <!--<script src="js/bootstrap.min.js"></script>-->
        <script type="text/javascript">
            function subirArchivos() {
                $("#archivo").upload('subir_archivo.php',
                {
                    nombre_archivo: $("#nombre_archivo").val(),
                    id: '<?= $_GET['edit'] ?>'
                },
                function(respuesta) {
                    //Subida finalizada.
                    $("#barra_de_progreso").val(0);
                    if (respuesta === 1) {
                        mostrarRespuesta('El archivo ha sido subido correctamente.', true);
                        $("#nombre_archivo, #archivo").val('');
                    } else {
                        mostrarRespuesta('El archivo NO se ha podido subir.', false);
                    }
                    mostrarArchivos();
                }, function(progreso, valor) {
                    //Barra de progreso.
                    $("#barra_de_progreso").val(valor);
                });
            }
            function eliminarArchivos(archivo) {
                $.ajax({
                    url: 'eliminar_archivo.php',
                    type: 'POST',
                    timeout: 10000,
                    data: {archivo: archivo},
                    error: function() {
                        mostrarRespuesta('Error al intentar eliminar el archivo.', false);
                    },
                    success: function(respuesta) {
                        if (respuesta == 1) {
                            mostrarRespuesta('El archivo ha sido eliminado.', true);
                        } else {
                            mostrarRespuesta('Error al intentar eliminar el archivo.', false);                            
                        }
                        mostrarArchivos();
                    }
                });
            }
            function mostrarArchivos() {
                $.ajax({
                    url: 'mostrar_archivos.php',
                    type: "POST",
                    dataType: 'JSON',
                    data: {id: '<?= $_GET['edit'] ?>'},
                    success: function(respuesta) {
                        if (respuesta) {
                            var html = '';
                            for (var i = 0; i < respuesta.length; i++) {
                                if (respuesta[i] != undefined) {
                                    html += '<div class="row"> <a href="https://ssgenius.com/app/facebook/archivos_subidos/' + respuesta[i] + ' "><span class="col-lg-2"> ' + respuesta[i] + ' </span></a> <div class="col-lg-2"> </div> </div> <hr />';
                                }
                            }
                            $("#archivos_subidos").html(html);
                        }
                    }
                });
            }
            function mostrarRespuesta(mensaje, ok){
                $("#respuesta").removeClass('alert-success').removeClass('alert-danger').html(mensaje);
                if(ok){
                    $("#respuesta").addClass('alert-success');
                }else{
                    $("#respuesta").addClass('alert-danger');
                }
            }
            $(document).ready(function() {
                mostrarArchivos();
                $("#boton_subir").on('click', function() {
                    subirArchivos();
                });
                $("#archivos_subidos").on('click', '.eliminar_archivo', function() {
                    var archivo = $(this).parents('.row').eq(0).find('span').text();
                    archivo = $.trim(archivo);
                    eliminarArchivos(archivo);
                });
            });
        </script>
</body>
</html>