<?php
session_start();
define("NIVEL_MIN_PERMISO", 1);
require_once('controller/user.php');
include('controller/funcionesFormat.php');


var_dump($_GET);
// die;



if (isset($_GET['edit'])) {
    include('../model/ReporteFacebookModel.php');
    $informes_fb = new ReporteFacebookModel;
    $infoa = $informes_fb->getInformeFB($_GET['psid'], $_GET['edit']);
    $_SESSION['id_inf'] = $infoa[0]['id_inf'];
    $_SESSION['titulo_reporte'] = $infoa[0]['titulo_reporte'];
    $_SESSION['id_page'] = $infoa[0]['id_page'];
    $_SESSION['periodo'] = $infoa[0]['periodo'];
    $_SESSION['fecha'] = $infoa[0]['fecha'];
    $_SESSION['fecha_comparacion'] = $infoa[0]['fecha_comparacion'];
    $_SESSION['fecha_informe'] = $infoa[0]['fecha_informe'];
    $infoactual = json_encode($infoa);
} else {
    $infoactual = array();
}
foreach ($pages as $page) {

    if ($page["id_facebook_page"] == $_SESSION["id_page"]) {
        $pagina_actual = $page;
    }
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
        <link href="./dist/css/editor.css" rel="stylesheet" />

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

            .tabla tbody th, .tabla tbody td{
                padding-left: 5px;
            } 
            .card-pricing .card-title {
                margin-top: 45px!important;
                margin-bottom: 12px;
            }

            p {
                margin-top: 0;
                margin-bottom: 6px;
            }
        </style>



    </head>

    <body id="body">

        <!-- End Google Tag Manager (noscript) -->
        <div class="wrapper ">

<?php include('views/menuaside.1.php'); ?>
            <div class="main-panel">
                <!-- Navbar -->
            <?php include('views/menunav.php'); ?>
                <!-- End Navbar -->
                <!-- <div class="panel-header panel-header-sm">
            
            
          </div> -->
                <div class="content">
                    <div class="row" style="height: 20px;"></div>
                    <a class="btn btn-primary" href="./print.php?edit=<?= $_SESSION['id_inf'] ?>&psid=<?= $_GET['psid'] ?>" role="button" target="_blank">
                        <i class="material-icons">print</i>
                    </a>



                    <div class="container">
                        <!--  <h1> Subida y precarga ajax  </h1> -->
                        <div id="respuesta" class="alert"></div>
                        <form action="javascript:void(0);">
                            <div class="row">
                                <div class="col-lg-2"> 
                                    <label> Nombre el archivo: </label> 
                                </div>
                                <div class="col-lg-2">
                                    <input type="text" name="nombre_archivo" id="nombre_archivo" />
                                </div>
                                <div class="col-lg-2">
                                    <input type="file" name="archivo" id="archivo" />
                                </div>                    
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-lg-2">
                                    <input type="submit" id="boton_subir" value="Subir" class="btn btn-success" />
                                </div>
                                <div class="col-lg-4">
                                    <progress id="barra_de_progreso" value="0" max="100"></progress>
                                </div>
                            </div>
                        </form>
                        <hr />
                        <div id="archivos_subidos"></div>
                    </div>


                    <!-- Este bloque crea la barra de título del informe donde muestra la fecha del informe, el rango de fechas, el nombre del informe, etc -->

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <img src="https://graph.facebook.com/<?= $_SESSION['id_page']; ?>/picture">
                                            </div>
                                            <div class="col-sm-6">
                                                <h5 class="big-title"><?= $pagina_actual['name'] ?></h5>
                                                <h6 class="big-title"><?= $_SESSION['titulo_reporte'] ?></h6>
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
                                                <h6 class="big-title"> Creacion del Informe:</h6>
                                                <h6 class="big-title"><?= $_SESSION['fecha_informe'] ?></h6>
                                            </div>
                                            <div class="col-md-3">
                                                <h6 class="big-title">Segmentado por:</h6>
                                                <h6 class="big-title"><?= formatPeriod($_SESSION['periodo']) ?></h6>
                                            </div>
                                            <div class="col-md-3">
                                                <h6 class="big-title"> Rango de Busqueda:</h6>
                                                <h6 class="big-title"><?= $_SESSION['fecha'] ?></h6>
                                            </div>
                                            <div class="col-md-3">
                                                <h6 class="big-title"> Rango de Comparación:</h6>
                                                <h6 class="big-title"><?= $_SESSION['fecha_comparacion'] ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="navbar-wrapper">      
                        <span class="navbar-brand"> Métricas Clave: </span >
                    </div>

                    <!-- Este bloque son los rectángulos con los indicadores principales del reporte. Termina cerca de la línea 600 -->


                    <div class="row">

                        <div class="col-md-2">
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
                                        <li >
                                            <div id="talcance_comp">
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-2">
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
                                        <li >
                                            <div id="timp_comp">
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-2">
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
                                        <li >
                                            <div id="tclics_comp">
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>



                        <div class="col-md-2">
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
                                        <li >
                                            <div id="engagements_comp">
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-2">
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
                                        <li >
                                            <div id="nfansn_comp">
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>


                        <div class="col-md-2">
                            <div class="card card-pricing ">
                                <div class="card-header">
                                    <h6 class="card-category">TOTAL COMENTARIOS</h6>
                                </div>
                                <div class="card-body">
                                    <div class="card-icon icon-primary ">
                                        <i class="nc-icon nc-email-85"></i>
                                    </div>
                                    <p>Total Comentarios</p>
                                    <div><h3 class="card-title" style="margin-top: 0 !important; margin-bottom: 0!important;" id="tcominbox"> </h3>(<span id="tcominboxu"></span>)</div>
                                    <p>Total Respuestas</p>
                                    <h3 class="card-title" style="margin-top: 0 !important;" id="tcominboxr"></h3>

                                </div>

                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="card card-pricing ">
                                <div class="card-header">
                                    <h6 class="card-category">ALCANCE PAUTA SOLO PAGE</h6>
                                </div>
                                <div class="card-body">
                                    <div class="card-icon icon-primary ">
                                        <i class="nc-icon nc-spaceship"></i>
                                    </div>
                                    <h3 class="card-title" id="alcancep"></h3>


                                    <ul>
                                        <li >
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
                                    <h6 class="card-category">IMPRESIONES PAUTA SOLO PAGE</h6>
                                </div>
                                <div class="card-body">
                                    <div class="card-icon icon-primary ">
                                        <i class="nc-icon nc-share-66"></i>
                                    </div>
                                    <h3 class="card-title" id="impresionsp"></h3>
                                    <ul>
                                        <li >
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
                                    <h6 class="card-category">CLICS PAUTA SOLO PAGE</h6>
                                </div>
                                <div class="card-body">
                                    <div class="card-icon icon-primary ">
                                        <i class="nc-icon nc-tap-01"></i>
                                    </div>
                                    <h3 class="card-title" id="clicsp"></h3>
                                    <ul>
                                        <li >
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
                                        <li >
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
                                    <h6 class="card-category">IMPRESIONES ORGÁNICO</h6>
                                </div>
                                <div class="card-body">
                                    <div class="card-icon icon-primary ">
                                        <i class="nc-icon nc-share-66"></i>
                                    </div>
                                    <h3 class="card-title" id="impresions"></h3>
                                    <ul>
                                        <li >
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
                                    <h6 class="card-category">CLICS ORGÁNICO</h6>
                                </div>
                                <div class="card-body">
                                    <div class="card-icon icon-primary ">
                                        <i class="nc-icon nc-tap-01"></i>
                                    </div>
                                    <h3 class="card-title" id="clics"></h3>
                                    <ul>
                                        <li >
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
                                        <li >
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
                                    <h6 class="card-category">FANS ORGÁNICO</h6>
                                </div>
                                <div class="card-body">
                                    <div class="card-icon icon-primary ">
                                        <i class="nc-icon nc-share-66"></i>
                                    </div>
                                    <h3 class="card-title" id="likesorg"></h3>
                                    <ul>
                                        <li >
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
                                        <li >
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
                                        <li >
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
                                    <div><h3 class="card-title" style="margin-top: 0 !important; margin-bottom: 0!important;" id="tcomen"> </h3>(<span id="tcomu"></span>)</div>
                                    <p>Total Respuestas</p>
                                    <h3 class="card-title" style="margin-top: 0 !important;" id="tcomenr"></h3>

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
                                    <div><h3 class="card-title" style="margin-top: 0 !important; margin-bottom: 0!important;" id="tinbox"> </h3>(<span id="tinboxu"></span>)</div>
                                    <p>Total Respuestas</p>
                                    <h3 class="card-title" style="margin-top: 0 !important;" id="tinboxr"></h3>

                                </div>

                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card card-pricing ">
                                <div class="card-header">
                                    <h6 class="card-category">ALCANCE PAUTA TOTAL</h6>
                                </div>
                                <div class="card-body">
                                    <div class="card-icon icon-primary ">
                                        <i class="nc-icon nc-spaceship"></i>
                                    </div>
                                    <h3 class="card-title" id="alcanceep"></h3>


                                    <ul>
                                        <li >
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
                                    <h6 class="card-category">IMPRESIONES PAUTA TOTAL</h6>
                                </div>
                                <div class="card-body">
                                    <div class="card-icon icon-primary ">
                                        <i class="nc-icon nc-share-66"></i>
                                    </div>
                                    <h3 class="card-title" id="impt"></h3>
                                    <ul>
                                        <li >
                                            <div id="">
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card card-pricing ">
                                <div class="card-header">
                                    <h6 class="card-category">CLICS PAUTA TOTAL</h6>
                                </div>
                                <div class="card-body">
                                    <div class="card-icon icon-primary ">
                                        <i class="nc-icon nc-tap-01"></i>
                                    </div>
                                    <h3 class="card-title" id="clicst"></h3>
                                    <ul>
                                        <li >
                                            <div id="">
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>



                    </div>



                    <div class="form-group">
                        <label> Comentarios Métricas Clave:</label>
                        <textarea rows="4" cols="80" class="form-control textarea" id="2"></textarea>
                    </div>



                    <div class="form-group">
                        <label> Título del Informe:</label>
                        <textarea rows="4" cols="80" class="form-control textarea" id="0"></textarea>
                    </div>

                    <div class="form-group">
                        <label> Comentarios Resumen General:</label>
                        <textarea rows="4" cols="80" class="form-control textarea" id="1"></textarea>
                    </div>


                    <!-- Este bloque es el informe de Interacción de cada publicaciones, donde se muestran las publicaciones de la que tuvo más interacción a la que tuvo menos interacción (top 4) -->

                    <div class="row">
                        <div id="grafica1" class="card" style="min-width: 310px; width:100%; height: 300px; margin:12px auto;"></div>

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
                    <div class="form-group">
                        <label> Comentarios Interacción por Publicación:</label>
                        <textarea rows="4" cols="80" class="form-control textarea" id="3"></textarea>
                    </div>

                    <!-- Este bloque es el informe de Alcance de cada publicaciones, donde se muestran las publicaciones de la que tuvo más alcance a la que tuvo menos alcance (top 4) -->


                    <div class="row">
                        <div id="grafica2" class="card" style="min-width: 310px; width:100%; height: 300px; margin:12px auto;"></div>

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
                    <div class="form-group">
                        <label> Comentarios Alcance por Publicación:</label>
                        <textarea rows="4" cols="80" class="form-control textarea" id="4"></textarea>
                    </div>

                    <!-- Este bloque es el informe de Inversión de cada publicaciones, donde se muestran las publicaciones de la que tuvo más inversión a la que tuvo menos inversión (top 4) -->


                    <div class="row">
                        <div id="grafica3" class="card" style="min-width: 310px; width:100%; height: 300px; margin:12px auto;"></div>

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
                    <div class="form-group">
                        <label> Comentarios Inversión por Publicación:</label>
                        <textarea rows="4" cols="80" class="form-control textarea" id="5"></textarea>
                    </div>


                    <!-- Este bloque es el informe de líneas de índices del top de publicaciones en el periodo (top 4) -->


                    <div class="row">
                        <div id="grafica4" class="card" style="min-width: 310px; width:100%; height: 300px; margin:12px auto;"></div>

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
                    <div class="form-group">
                        <label> Comentarios Índices de Publicación:</label>
                        <textarea rows="4" cols="80" class="form-control textarea" id="6"></textarea>
                    </div> 





                    <!-- A partir de acá están los gráficos (charts), es decir barras y pies, de los reportes. Acaba aproximadamente en la línea 1060 -->


                    <div class="row">
                        <div class="col-md-8">
                            <div class="card-body">
                                <div id="container0" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
                            </div>


                            <div class="form-group">
                                <label> Comentario Nuevos Likes vs Dislikes:</label>
                                <textarea rows="4" cols="80" class="form-control textarea" id="7"></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="tab-pane" id="link0" ></div>
                        </div>




                        <div class="col-md-8 saltoDePagina">

                            <div class="card-body">

                                <div id="container1" style="min-width: 600px; height: 600px; margin: 0 auto"></div>

                            </div>
                            <div class="form-group">
                                <label> Comentario Likes vs Dislikes:</label>
                                <textarea rows="4" cols="80" class="form-control textarea" id="8"></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="tab-pane" id="link1"></div>
                        </div>



                        <div class="col-md-8 saltoDePagina">

                            <div class="card-body">

                                <div id="container2" style="min-width: 600px; height: 600px; margin: 0 auto"></div>

                            </div>
                            <div class="form-group">
                                <label> Comentario Crecimiento de Likes:</label>
                                <textarea rows="4" cols="80" class="form-control textarea" id="9"></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="tab-pane" id="link2"></div>
                        </div>



                        <div class="col-md-8 saltoDePagina">

                            <div class="card-body">

                                <div id="container3" style="min-width: 600px; height: 600px; margin: 0 auto"></div>

                            </div>
                            <div class="form-group">
                                <label> Comentario Como se consiguieron los Likes:</label>
                                <textarea rows="4" cols="80" class="form-control textarea" id="10"></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="tab-pane" id="link3"></div>
                        </div>




                        <div class="col-md-8 saltoDePagina">

                            <div class="card-body">

                                <div id="container4" style="min-width: 600px; height: 600px; margin: 0 auto"></div>

                            </div>
                            <div class="form-group">
                                <label> Comentario Como se consiguieron los Likes Totales:</label>
                                <textarea rows="4" cols="80" class="form-control textarea" id="11"></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="tab-pane" id="link4"></div>
                        </div>



                        <div class="col-md-8 saltoDePagina">

                            <div class="card-body">

                                <div id="container5" style="min-width: 600px; height: 600px; margin: 0 auto"></div>

                            </div>
                            <div class="form-group">
                                <label> Comentario Nuevos Fans Netos:</label>
                                <textarea rows="4" cols="80" class="form-control textarea" id="12"></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="tab-pane" id="link5"></div>
                        </div>



                        <!--        
                        <div class="col-md-8 saltoDePagina">
                         
                           <div class="card-body">
                           
                             <div id="container6" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
                           
                           </div>
                           <div class="form-group">
                             <label> Comentario Perfil de likes Demográfico:</label>
                               <textarea rows="4" cols="80" class="form-control textarea" id="13"></textarea>
                           </div>
                         </div>
                     
                       <div class="col-md-4">
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
             
             
                                
                         <div class="col-md-8 saltoDePagina">
                         
                           <div class="card-body">
                           
                             <div id="container7" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
                           
                           </div>
                           <div class="form-group">
                             <label> Comentario Perfil de fans Edades:</label>
                               <textarea rows="4" cols="80" class="form-control textarea" id="14"></textarea>
                           </div>
                         </div>
                    
                       <div class="col-md-4">
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
                        -->



                        <div class="col-md-8 saltoDePagina">

                            <div class="card-body">

                                <div id="container8" style="min-width: 600px; height: 600px; margin: 0 auto"></div>

                            </div>
                            <div class="form-group">
                                <label> Comentario Alcance:</label>
                                <textarea rows="4" cols="80" class="form-control textarea" id="15"></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="tab-pane" id="link8"></div>
                        </div>




                        <div class="col-md-8 saltoDePagina">

                            <div class="card-body">

                                <div id="container9" style="min-width: 600px; height: 600px; margin: 0 auto"></div>

                            </div>
                            <div class="form-group">
                                <label> Comentario Interacciones:</label>
                                <textarea rows="4" cols="80" class="form-control textarea" id="16"></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="tab-pane" id="link9"></div>
                        </div>  


                        <!--
                        
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
                        -->



                        <div class="col-md-8 saltoDePagina">

                            <div class="card-body">

                                <div id="container12" style="min-width: 600px; height: 600px; margin: 0 auto"></div>

                            </div>
                            <div class="form-group">
                                <label> Comentario Engaged users vs Engagement rate:</label>
                                <textarea rows="4" cols="80" class="form-control textarea" id="19"></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="tab-pane" id="link12"></div>
                        </div>




                        <div class="col-md-8 saltoDePagina">

                            <div class="card-body">

                                <div id="container13" style="min-width: 600px; height: 600px; margin: 0 auto"></div>

                            </div>
                            <div class="form-group">
                                <label> Comentario Alcance promedio vs Engagement rate:</label>
                                <textarea rows="4" cols="80" class="form-control textarea" id="20"></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">

                            <div class="tab-pane" id="link13"></div>
                        </div>        
                        <!--
                        
                                           
                                    <div class="col-md-8 saltoDePagina">
                                    
                                      <div class="card-body">
                                      
                                        <div id="container14" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
                                      
                                      </div>
                                      <div class="form-group">
                                        <label> Comentario Likes Demográficos Cantidad:</label>
                                          <textarea rows="4" cols="80" class="form-control textarea" id="21"></textarea>
                                      </div>
                                    </div>
                                
                                  <div class="col-md-4">
                                  <div class="tab-pane" id="link14"></div>
                                  </div>
                        
                        -->



                        <div class="col-md-8 saltoDePagina">

                            <div class="card-body">

                                <div id="container20" style="min-width: 600px; height: 600px; margin: 0 auto"></div>

                            </div>
                            <div class="form-group">
                                <label> Comentario impresiones</label>
                                <textarea rows="4" cols="80" class="form-control textarea" id="22"></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="tab-pane" id="link20"></div>
                        </div>


                        <div class="col-md-8 saltoDePagina">

                            <div class="card-body">

                                <div id="container21" style="min-width: 600px; height: 600px; margin: 0 auto"></div>

                            </div>
                            <div class="form-group">
                                <label> Comentario clics</label>
                                <textarea rows="4" cols="80" class="form-control textarea" id="23"></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="tab-pane" id="link21"></div>
                        </div>

                        <!-- Pie de la página -->

                    </div>
<?php include('views/pie-pagina.php'); ?>
                </div>
            </div>

            <!-- Librerías para crear los gráficos (solo visual) -->


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
            <script src="./dist/js/editor.js"></script>

            <script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>



            <!-- A partir de acá está el exportador en PDF y el envío de datos para generar los reportes (js/main.js), quizás acá este la funcionalidad que permite editar los valores del reporte -->


            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script src="https://code.highcharts.com/modules/series-label.js"></script>
            <script src="https://code.highcharts.com/modules/exporting.js"></script>
            <script src="https://code.highcharts.com/modules/export-data.js"></script>
            <script>
                var id_inf = '<?= $_SESSION['id_inf'] ?>';
                var titulo_reporte = '<?= $_SESSION['titulo_reporte'] ?>';
                var id_page = '<?= $_SESSION['id_page'] ?>';
                var periodo = '<?= $_SESSION['periodo'] ?>';
                var fecha = '<?= $_SESSION['fecha'] ?>';
                var fecha_comparacion = '<?= $_SESSION['fecha_comparacion'] ?>';
                var categorias = '';
                var infoactual = <?php echo json_encode($infoactual); ?>;

                $('#consultoria').addClass("show");
                $('#IC').addClass("active");
            //$('#2').Editor(); 
            //$('#grf').addClass("active");
            </script>

            <!-- A partir de acá está el exportador en PDF, el subir archivos que acompañen al reporte y el envío de datos para generar los reportes (js/main.js), quizás acá este la funcionalidad que permite editar los valores del reporte -->


            <script src="js/main.js"></script>  <!-- <************************************************************ -->
            <script src="js/uploadfile.js"></script>
            <script type="text/javascript">
        function subirArchivos() {
            $("#archivo").upload('subir_archivo.php'),
                    {
                        nombre_archivo: $("#nombre_archivo").val(),
                        id: '<?= $_GET['edit'] ?>'
                    },
                    function (respuesta) {
                        //Subida finalizada.
                        $("#barra_de_progreso").val(0);
                        if (respuesta === 1) {
                            mostrarRespuesta('El archivo ha sido subido correctamente.', true);
                            $("#nombre_archivo, #archivo").val('');
                        } else {
                            mostrarRespuesta('El archivo NO se ha podido subir.', false);
                        }
                        mostrarArchivos();
                    }, function (progreso, valor) {
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
                error: function () {
                    mostrarRespuesta('Error al intentar eliminar el archivo.', false);
                },
                success: function (respuesta) {
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
                success: function (respuesta) {
                    if (respuesta) {
                        var html = '';
                        for (var i = 0; i < respuesta.length; i++) {
                            if (respuesta[i] != undefined) {
                                html += '<div class="row"> <a href="https://ssgenius.com/app/facebook/archivos_subidos/' + respuesta[i] + ' "><span class="col-lg-2"> ' + respuesta[i] + ' </span></a> <div class="col-lg-2"> <a class="eliminar_archivo btn btn-danger" href="javascript:void(0);"> Eliminar </a> </div> </div> <hr />';
                            }
                        }
                        $("#archivos_subidos").html(html);
                    }
                }
            });
        }
        function mostrarRespuesta(mensaje, ok) {
            $("#respuesta").removeClass('alert-success').removeClass('alert-danger').html(mensaje);
            if (ok) {
                $("#respuesta").addClass('alert-success');
            } else {
                $("#respuesta").addClass('alert-danger');
            }
        }
        $(document).ready(function () {
            mostrarArchivos();
            $("#boton_subir").on('click', function () {
                subirArchivos();
            });
            $("#archivos_subidos").on('click', '.eliminar_archivo', function () {
                var archivo = $(this).parents('.row').eq(0).find('span').text();
                archivo = $.trim(archivo);
                eliminarArchivos(archivo);
            });
        });
            </script>

    </body>

</html>