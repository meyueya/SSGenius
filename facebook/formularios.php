<?php
// $seleccionBase selecciona a que base de datos se va a conectar
$seleccionBase = $_SERVER['REQUEST_URI'];
include('../auth.php');

 
    if(isset($_POST['daterange-btn']) && isset($_POST['carrera']) && isset($_POST['estado'])){

    if($_POST['daterange-btn']!=''){
    $desdehasta = explode(" - ", $_POST['daterange-btn']);
    $inicio=date("Y-m-d 00:00:00",strtotime($desdehasta[0]));
    $fin=date("Y-m-d 23:59:00",strtotime($desdehasta[1]));
    $fecha="AND fecha_registro BETWEEN '$inicio' and '$fin'";
    $d=date("Y/m/d",strtotime($desdehasta[0]));
    $h=date("Y/m/d",strtotime($desdehasta[1]));
  
    }   
  
    else{
    $fecha="";
    }

    if($_POST['estado']!='0'){
      $estado="AND estado='".$_POST['estado']."'";
    }
    else{
    $estado="";
    }

    if($_POST['carrera']!='0'){
      $carrera="AND modelo='".$_POST['carrera']."'";

    }
    else{
    $campp="";
    } 

    if($_POST['medio']!='00'){
      $medio="AND a='".$_POST['medio']."'";

    }
    else{
    $medio="";
    } 

    if($_POST['obj']!='00'){
      $obj="AND b='".$_POST['obj']."'";

    }
    else{
    $obj="";
    } 
    
      $result = mysql_query("select cliente.id as clientecodigo, nombres_apellidos, apellidos, identificacion, e_descripcion, nombremodelo, correo, telefono, fecha_registro,fecha_actua,comentario,a,b,c,d,cliente.e as e,f,user from cliente, modelo g, estado_cliente s where g.inicialmodelo=modelo and estado=s.id_estado ".$fecha."".$carrera."".$estado."".$medio."".$obj." ORDER BY clientecodigo DESC");
   
    }


    else{
         
         $f = date("m");
         $inicio="2018-".$f."-01";
         $fin="2018-".$f."-31";
         $result = mysql_query("select cliente.id as clientecodigo, nombres_apellidos, apellidos, identificacion, e_descripcion, nombremodelo, correo, telefono, fecha_registro,fecha_actua,comentario,a,b,c,d,cliente.e as e,f,user from cliente, modelo g, estado_cliente s where g.inicialmodelo=modelo and estado=s.id_estado and fecha_registro BETWEEN '".$inicio."' and '".$fin."' ORDER BY clientecodigo DESC");
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
    Reporte Formularios Llenos vs Estados inConcert
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


</head>

<body class="sidebar-mini">

  <!-- End Google Tag Manager (noscript) -->
  <div class="wrapper ">
    
  <?php include('menu.php'); ?>


    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-minimize">
              <button id="minimizeSidebar" class="btn btn-icon btn-round">
                <i class="nc-icon nc-minimal-right text-center visible-on-sidebar-mini"></i>
                <i class="nc-icon nc-minimal-left text-center visible-on-sidebar-regular"></i>
              </button>
            </div>
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Reporte Formularios Llenos vs Estados inConcert</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="nc-icon nc-zoom-split"></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link btn-magnify" href="#pablo">
                  <i class="nc-icon nc-layout-11"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a>
              </li>
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com/" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-bell-55"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link btn-rotate" href="#pablo">
                  <i class="nc-icon nc-settings-gear-65"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>
                  </p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <!-- <div class="panel-header panel-header-sm">
  
  
</div> -->
      <div class="content">
     

        <form id="miform" method="post" name="miform" action="formularios.php">
        <div class="row">
         

             <div class="col-md-2">
             
              <div class="form-group">
                <p> Carrera:</p>

           
                <select name="carrera" id="carrera" class="form-control  pull-left">
                <option value="0" selected>Selecione Carrera:</option>
                <?php
                $result2 = mysql_query("SELECT * FROM `modelo` where inicialmodelo!='ILCB'");
                $a=0;
                if($row2 = mysql_fetch_array($result2)){
                  do{
                      $a++; 
                      
                      echo '<option value="'.$row2['inicialmodelo'].'">'.$a." - ".$row2['NombreModelo'].'</option>';
                        }while($row2 = mysql_fetch_array($result2));
                      }
                    ?>
                  </select>
              
              </div>
           
          </div>
          <div class="col-md-2">
              <div class="form-group">
                <p> Estados:</p>

               
                  <select name="estado" id="estado" class="form-control pull-left" >
                  <option value="0" selected>Selecione Estado:</option>
                   <?php
                   $result3 = mysql_query("SELECT * FROM `estado_cliente` where e_descripcion!=''");
                   $a=0;
                   if($row3 = mysql_fetch_array($result3)){
                   do{
                      $a++;
                      echo '<option value="'.$row3['id_estado'].'">'.$a." - ".$row3['e_descripcion'].'</option>';
                        }while($row3 = mysql_fetch_array($result3));
                      }
                    ?>
                  </select>
               
              </div>
            
          </div>

          <div class="col-md-2">
              <div class="form-group">
                <p> Medios:</p>

               
                  <select name="medio" id="medio" class="form-control pull-left" >
                  <option value="00" selected>Selecione Medio:</option>
                   <?php
                   $result4 = mysql_query("SELECT * FROM `medios`");
                   $a=0;
                   if($row4 = mysql_fetch_array($result4)){
                   do{
                      $a++;
                      echo '<option value="'.$row4['valor_a'].'">'.$a." - ".$row4['descripcion_medio'].'</option>';
                        }while($row4 = mysql_fetch_array($result4));
                      }
                    ?>
                  </select>
            
              </div>
            
          </div>


            <div class="col-md-2">
              <div class="form-group">
                <p> Objetivo:</p>

              
                  <select name="obj" id="obj" class="form-control pull-left" >
                  <option value="00" selected>Selecione Objetivo:</option>
                  
                  </select>
               
              </div>
            
          </div>
             <!-- Date and time range -->
              
             <div class="col-md-2">
              <div class="form-group">
                 Reporte por Fecha:
                <div class="input-group">
                  <input  class="btn btn-default pull-right" name="daterange-btn" id="daterange-btn" >
                  </input>
                  <input  name="dpag" id="dpag" type="hidden" value="<?php echo $_POST['daterange-btn']; ?>"></input>
                  </div>
                </div>
                </div>

                <div class="col-md-2">
                <div class="form-group">  
              
             <button type="submit" name="greport" id="greport" value="GREPORT"  class="btn btn-success" style="margin-top: 36px;"><i class="fa fa-print"></i> Generar Reporte</button>
             </div>
           </div>
            
          </div>

           <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
             <table id="example1" class="display compact">
                <thead style="text-align: center;">
                <tr>
                  <th>#</th>
                  <th class="not-export-col">Ver más</th>
                  <th>Nombres</th>
                  <th>Nacionalidad</th>
                  <th>Carrera</th>
                  <th>Correo</th>
                  <th>Teléfono</th>
                  <th>a</th>
                  <th>b</th>
                  <th>c</th>
                  <th>d</th>
                  <th>e</th>
                  <th>f</th>
                  <th>fecha registro</th>
                  <th>Estado</th>
                  <th>Ultima actualizacíon</th>
                </tr>
                </thead>
                 <tbody style="font-size: 12px;">
                  <?php
                  if($row = mysql_fetch_array($result)){
                  do{
                   $x++;
                  ?>
                  <tr>
                  <td><?php echo $x; ?></td>
                  <td><button type="button" class="btn btn-success" onclick="javascript:GetUserDetails('<?= $row['clientecodigo']; ?>')"><span class="nc-icon nc-zoom-split"></span></button> </td>
                  <td><?php echo $row['nombres_apellidos']." ".$row['apellidos'];?></td>
                  <td><?php echo $row['identificacion']; ?></td>
                  <td><?php echo $row['nombremodelo']; ?></td>
                  <td><?php echo $row['correo']; ?></td>
                  <td><?php echo $row['telefono']; ?></td>
                  <td><?php echo $row['a']; ?></td>
                  <td><?php echo $row['b']; ?></td>
                  <td><?php echo $row['c']; ?></td>
                  <td><?php echo $row['d']; ?></td>
                  <td><?php echo $row['e']; ?></td>
                  <td><?php echo $row['f']; ?></td>
                  <td><?php echo $row['fecha_registro']; ?></td>
                  <td><?php echo $row['e_descripcion']; ?></td>
                  
                  <td><?php echo $row['fecha_actua']; ?></td>
                  </tr>
                        <?php    
               }while($row = mysql_fetch_array($result));
                    }
                    ?>
               </tbody>     
              </table>
</div>
              </div>
            </div>
          </div>
          



</form>



               <!-- Modal - Update User details -->
<div class="modal fade" id="ver" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h3 class="modal-title" id="exampleModalLongTitle"><strong> Detalles cliente: <span class="glyphicon glyphicon-user form-control-feedback"></span> </strong></h3>
               </div>
            <div class="modal-body ">
              <div class="box"><div class="box-body row">
                <div class="col-md-4">
                <div class="form-group">
                <strong><b>Nombre: </b></strong><p id="nomb"></p>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                <strong><b>Correo: </b></strong><p id="correo"> </p>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                <strong><b>Telefono: </b></strong><p id="tlf"> </p>
                </div>
                </div>
                
                <hr/>
              
              <div class="col-md-4">
                <div class="form-group">
                <strong><b>Fecha de Registro: </b></strong><p id="fr"></p>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                <strong><b>Carrera: </b></strong><p id="carr"> </p>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                <strong><b>Estado Actual: </b></strong><p id="est"> </p>
                </div>
                </div>

               <div class="col-md-4">
                <div class="form-group">
                <strong><b>Comentario de Registro: </b></strong><p id="com"> </p>
                </div>
                </div>

                </div>
              </div>
           
            
             
              <div id='tbl' class="col-md-12"></div>
              

             

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
            
                <input type="hidden" id="hidden_user_id">
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->



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
  
 
 <script>
  $(function () {
    var d = "<?php echo $d;?>";
    if(d!==''){ var des='moment("<?php echo $d;?>")'; var has='moment("<?php echo $h;?>")'; }
    else if(d === ''){ var des=moment().subtract(29, 'days'); var has=moment();  }
 
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Hoy'       : [moment(), moment()],
          'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Ultimos 7 Dias' : [moment().subtract(6, 'days'), moment()],
          'Ultimos 30 Dias': [moment().subtract(29, 'days'), moment()],
          'Mes Actual'  : [moment().startOf('month'), moment().endOf('month')],
          'Mes Pasado'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
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
  
  


$(document).ready(function() {if (dTable instanceof $.fn.dataTable.Api) {
     $('#dvLoading').fadeIn(800); 
} else {
    $('#dvLoading').fadeOut(800); 
}
  var dTable = $('#example1').DataTable({
    dom: 'Bfrtip',
    processing: true,
    "fnInitComplete": function(oSettings, json) {
      $('#dvLoading').fadeOut(800); 
    },
     columnDefs: [
    {
        targets: [ -1, -2,-3,-4,-5,-6,-7,-8,-9,-10],
        className: 'dt-body-right'
    }
  ],
    pageLength: 15,
    buttons: [{
      extend: 'excel',
      title: 'Reporte Formularios ILCB',
      filename: 'ReporteFormularios_Ilcb',
      exportOptions: {
          columns: ':visible:not(.not-export-col)'
        }
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
});





  $('#medio').change(function()
  {
    var valor = $(this).val();
    
    // Lista de modelos
    $.post( 'obj.php', { valor: valor} ).done( function( respuesta )
    {
      $( '#obj' ).html( respuesta );
    });
  });

$('#reporte').addClass("show");
$('#r').addClass("active");
$('#l').addClass("active");
</script>










    <script >
        
        function GetUserDetails(id) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(id);
    
    /*$.post("readUserDetails.php", {
            id: id
        },*/



    $.post("readUserDetails.php",{
            id: id
        },
         function(data, status){
        //alert("Data: " + data + "\nStatus: " + status);
           // var detalle = JSON.parse(data);                                     
            //alert("Data: " + detalle);
            //console.log(detalle);ssqwsqwsqw
            //$(".modal-body").html(data);
            //console.log(data);ssqwsqwsqw
            //var json = JSON.parse(data);ssqwsqwsqw

                    //var datos2 = JSON.parse(data);
                    console.log(data);
                $("#nomb").html(" "+data[0].nombres_apellidos+" "+data[0].apellidos+" ");
                $("#correo").html(data[0].correo);
                $("#tlf").html(data[0].telefono);
                $("#fr").html(data[0].fecha_registro);
                $("#carr").html(data[0].nombremodelo);
                $("#est").html(data[0].e_descripcion);
                $("#com").html(data[0].primercomentario);
                //$("#ape").html(data.apellidos);

           // $("#comentario").val(data.comentario);
            $("#estado").val(data.estado);
            $("#idestado").val(data.idestado);
            var count = 0;
            var val = data[0].fechasistema;
           
            $('#tbl').html("");
            $(document).ready( function () {
            $('#example2').DataTable({
            dom: 'Bfrtip',
            processing: true,
            responsive: true,
            pageLength: 5,
            buttons: [{
            extend: 'excel',
            title: 'Reporte Historial '+data[0].nombres_apellidos+' '+data[0].apellidos+'',
            filename: 'ReporteHistorial'
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
             } );

  if(val!=undefined){
   $('#tbl').html("<div class='box'><div class='box-header'><h3 class='box-title'>Historial Callcenter</h3></div><div class='box-body'><table id='example2' class='cell-border compact stripe'><thead><tr><th># </th><th>Fecha de ultima Actualizacion</th><th>Usuario</th><th>Comentario</th></tr></thead><tbody id='example3'></tbody></table></div></div>");
   $.each(data, function(i, item) {
    count++;
      console.log(item.fecha_registro);
       $('#example3').append( "<tr><td>" + count + "</td><td>"+ item.fechasistema +"</td><td>"+ item.idvendedor +"</td><td>"+ item.comentario +"</td></tr>");
  });
   

      
     }       
    }
      
      /*  function (data, status) {
            // PARSE json data
            var detalle = JSON.parse(data);
            console.log('XXX');
            console.log(detalle);
            // Assing existing values to the modal popup fields
            $("#comentario").val(detalle.comentario);
            $("#estado").val(detalle.estado);
            $("#idestado").val(detalle.idestado);
        }*/
    );

    





    // Open modal popup

    $("#ver").modal("show");





}
 
 
</script>
</body>


<!-- Mirrored from demos.creative-tim.com/paper-dashboard-2-pro/examples/components/panels.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Aug 2018 16:06:47 GMT -->
</html>