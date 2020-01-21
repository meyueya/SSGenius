<?php
session_start();
include('controller/funcionesFormat.php');
define("NIVEL_MIN_PERMISO", 1);
require_once('controller/user.php');
include('../model/Reporteleads.php');
$informes_fb = new Reporteleads;
$informes_fb = $informes_fb->getInformesFB($_GET['psid']);
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
            Reporte Leads
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
        <div class="row" style="height: 30px; alignment-adjust: "></div>
     
  <div class="col-md-3"></div>
  <div class="col-md-6 well">
  
    <form class="form-inline" method="POST" action="">
      <label> Fecha Desde:</label>
      <input type="date" class="form-control" placeholder="Start"  name="date1" />
      <label> Hasta</label>
      <input type="date" class="form-control" placeholder="End"  name="date2"/>
        <div class="col-md-3">
                <form id="miform" method="post" name="miform" action="controller/procesar.php">
                    <input id="fecha" name="fecha" type="hidden"> 
                    <input id="fecha_comparacion" name="fecha_comparacion" type="hidden">
                    <input id="pdo" name="pdo" type="hidden">
                    <input id="id_page" name="id_page_create" type="hidden">
                    <input id="var" name="var" type="hidden" value="1">       
                   <button type="submit" name="greport" id="greport" value="GREPORT"  class="btn btn-success" style=" margin-top: 5px;"><i class="fa fa-print"></i> Generar Reporte</button>
                    </form> 
        </div>      
      </div>
        
    

        <form id="miform" method="post" name="miform">
           <div class="col-md-12">
            <div class="card">
              <div class="card-body">
              <?php 
              if($_SERVER['REQUEST_METHOD']=='POST'){
                  
              $desde = date("Y-m-d", strtotime($_POST['date1']));
              $hasta = date("Y-m-d", strtotime($_POST['date2']));
              
              
              ?>
                  <center>
                     
      <td class="text-center">Rango de Fechas: <?php echo $desde.'  --  '.$hasta?>  </td>
                       
                <div class="content">
                    <div class="row" style="height: 20px;"></div>

                    <form id="miform" method="post" name="miform" action="reportegoogle.php">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">

                                    <table id="example1" class="cell-border compact stripe">
                                        <thead style="text-align: center;">
                                            <tr>
                                                <th style="width: 10px;">#</th>
                                                <th> id usuario ssg </th>
                                                <th> fuente </th> 
                                                <th> variable 01 </th>
                                                <th> variable 02 </th>
                                                <th> id usuario fuente </th>
                                                <th> Nombre de Usuario </th>
                                                <th> Fecha Contacto </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $x = null; ?>  
                                            <?php foreach ($informes_fb as $key => $value): $x++; ?>
                                                <tr data-id=<?= $value['id'] ?>>   
                                                    <td class="text-center"><?php echo $x; ?></td>
                                                    <td><?php echo $value['id_usuario_ssg']; ?></td>
                                                    <td><?php echo formatPeriod($value['fuente']); ?></td> 
                                                    <td><?php echo $value['var_de_id_01']; ?></td>
                                                    <td><?php echo $value['var_de_id_20']; ?></td>
                                                    <td><?php echo $value['id_usuario_fuente']; ?></td>
                                                    <td><?php echo $value['nombre_usuario']; ?></td>
                                                    <td><?php echo $value['fecha_1er_contacto']; ?></td>
                                                </tr>
                                            <?php endforeach ?>               
                                        </tbody> 
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
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



        <script>


            $(document).ready(function () {
                if (dTable instanceof $.fn.dataTable.Api) {
                    $('#dvLoading').fadeIn(800);
                } else {
                    $('#dvLoading').fadeOut(800);
                }
                var dTable = $('#example1').DataTable({
                    dom: 'Bfrtip',
                    processing: true,
                    "fnInitComplete": function (oSettings, json) {
                        $('#dvLoading').fadeOut(800);
                    },
                    columnDefs: [
                        {
                            targets: [-1, -2, -3],
                            className: 'dt-body-right'
                        }
                    ],
                    pageLength: 10,
                    buttons: [{
                            extend: 'excel',
                            title: 'Reporte Informes Facebook',
                            filename: 'reportesFB'
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
                            first: "Inicio",
                            previous: "Anterior",
                            next: "Siguiente",
                            last: "Anterior"
                        }

                    }
                });
            });

            $('#my_reports').addClass("active");
            $('#my_reports_examples').addClass("show");
            $('#reports_fb').addClass("active");
        </script>
    </body>
<?php } ?>

    <!-- Mirrored from demos.creative-tim.com/paper-dashboard-2-pro/examples/components/panels.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Aug 2018 16:06:47 GMT -->
</html>