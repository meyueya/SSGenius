<?php
//   require_once('controller/UserPermits.php');
//   $id_user=$_SESSION['id_user'];
//   $userpermits= new UserPermits;
//   $nivel_permiso= $userpermits->getNivelPermiso($id_user);


//     $a = "10";
//     $b = $a+2;
//     var_dump($b);
//  die;

require_once("/home/ssgenius/public_html/app/model/Database.php");
$connection = Database::getInstance(); 
 $username = 'ssgenius_55g';
$password = '$?sqnuk,=;RT';

// user = "ssgenius_55g"
// pass = "$?sqnuk,=;RT"
// database = "ssgenius_app"
//server = "localhost"
//dns = "mysql:dbname=ssgenius_app;host=localhost"
//$connection = new PDO( 'mysql:host=localhost;dbname=ssgenius_app', $username, $password ); 

$db = mysql_connect("localhost", "ssgenius_55g","$?sqnuk,=;RT") or die(mysql_error());
 mysql_select_db("ssgenius_app", $db) or die(mysql_error());
$f = date("m");

$nanuncio= $_GET['nanuncio'];
$camp= $_GET['camp'];


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
// var_dump($fecha);
// var_dump($anuncio);
// var_dump($campp);
 //die;
    
    
      $result = mysql_query("select CampaignName, Criteria, Date, COUNT(id) as totalcampos, SUM(Impressions) as imp, SUM(Clicks) as clic, SUM(Cost)/1000000 as costo,
       SUM(Conversions) conversion, SUM(ClickAssistedConversions) as clicasistido, AVG(QualityScore) as nivelcalidad, (SUM(Clicks)/SUM(Impressions))*100 as CTR , 
       (SUM(Cost)/1000000)/SUM(Conversions) AS costconversion from aiw_google_data_ads WHERE ".$fecha."".$anuncio."".$campp." group by CampaignId,Id having count(*) > 0");
      $result2 = mysql_query("SELECT COUNT(*) as total FROM `aiw_google_data_ads` WHERE Date BETWEEN '".$inicio."' and '".$fin."' and Cost>'0'");
      $result3 = mysql_query("SELECT DISTINCT CampaignName FROM aiw_google_data_ads where `Date` BETWEEN '".$inicio."' and '".$fin."' and Cost>'0'");
      //$result4 = mysql_query("SELECT DISTINCT Criteria FROM aiw_google_data_ads where `Date` BETWEEN '".$inicio."' and '".$fin."'");
      $row2 = mysql_fetch_array($result2);
// var_dump($_GET);
// var_dump($_POST);
// die;
      $costom = $factor*236/$row2['total'];
 var_dump( $costom);
 die;
   
    }




    else{

    $result3 = mysql_query("SELECT DISTINCT CampaignName FROM aiw_google_data_ads");
   
      }
 


?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/iconcool.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Reporte Google
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
<?php //include('views/menuaside.1.php'); ?>

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
            <a class="navbar-brand" href="#pablo">Reporte Google Campañas y Keywords</a>
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
     

        <form id="miform" method="post" name="miform" action="reportegoogle.php">
        <div class="row">
         

            <div class="col-md-1">
          </div>
        
    
          <div class="col-md-2">
             
              <div class="form-group">
                <p> Campañas:</p>

                <div class="input-group">
                <select name="camp" id="camp" class="form-control pull-left" >
                <option value="0" selected>Selecione Campaña:</option>
                <?php
                if($row3 = mysql_fetch_array($result3)){
                  do{
                      $b++; 
                      $a=$b;
                      echo '<option value="'.$row3['CampaignName'].'">'.$a.".- ".$row3['CampaignName'].'</option>';
                        }while($row3 = mysql_fetch_array($result3));
                      }else{
                      }
                    ?>
                  </select>
                </div>
              </div>
           
          </div>
          <div class="col-md-2">
              <div class="form-group">
                <p> Keywords:</p>

                <div class="input-group">
                  <select name="anuncio" id="key" class="form-control pull-left" >
                  <option value="0" selected>Selecione Keyword:</option>
                   
                  </select>
                </div>
              </div>
            
          </div>
             <!-- Date and time range -->
              
             <div class="col-md-2">
              <div class="form-group">
                 Reporte por Fecha:

                <div class="input-group">
                  <input  class="btn btn-default pull-right" name="daterange-btn" id="daterange-btn" value="<?php echo $_POST['daterange-btn']; ?>" autocomplete="off">
                  </input>
                  <input  name="dpag" id="dpag" type="hidden" value="<?php echo $_POST['daterange-btn']; ?>"></input>
                  </div>
                </div>
                </div>
                
                <div class="col-md-5">          
 <button type="submit" name="greport" id="greport" value="GREPORT"  class="btn btn-success" style="float: right;  margin-top: 36px;"><i class="fa fa-print"></i> Generar Reporte</button>
 </div>
                  
          </div>

           <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
            <table id="example1" class="cell-border compact stripe">
                <thead style="text-align: center;">
                <tr>
                  <th style="width: 10px;">#</th>
                  <th> Fecha </th>
                  <th>Campaña</th>
                  <th>Nombre Keyword </th>
                  <th>Impresiones</th>
                  <th>Clic</th>
                  <th>Clic Asistido</th>
                  <th>CTR</th>                  
                  <th>Nivel de Calidad</th>
                  <th>Conversiones</th>
                  <th>Inv. por conversíon</th>
                  <th>Inversión sin impuesto-comision</th>  
                  <th>Inversión  Total</th>           
                </tr>
                </thead>
                 <tbody>
                
                  <?php
                  
                  if($row = mysql_fetch_array($result)){
                  do{
                  $x++;

                    $fecha1 = date("d-m-Y",strtotime($desde));
                    $fecha2 = date("d-m-Y",strtotime($hasta));
                    $reg=$row['totalcampos'];
                    $totalcosto=$costom*$reg;
                    $fecha = date("d-m-Y",strtotime($row['Date']));
                    $gastos = ((((($row['costo'])+$totalcosto) / 0.7) / 0.94) / 0.91);
                    //$costopinv = ((((($row['costconversion'])+$totalcosto)/ 0.7) / 0.94) / 0.91);
                     $gastosin = $gastos-($gastos*0.36);
                  ?>
                 
                  <tr>
                      
                  <td><?php echo $x; ?></a></td>
                  <td style="width: 10px;  font-size: 11px;"><strong><?php echo $fecha1."  ".$fecha2; ?></strong></td>
                  <td><?php echo $row['CampaignName'];?></td>
                  <td><?php echo $row['Criteria']; ?></td>
                  <td><?php echo $row['imp']; ?></td>
                  <td><?php echo $row['clic']; ?></td>
                  <td><?php echo $row['clicasistido']; ?></td>
                  <td><?php echo round($row['CTR'], 2)." %"; ?></td>                  
                  <td><?php echo $row['nivelcalidad']; ?></td>
                  <td><?php echo $row['conversion']; ?></td>
                  <td><?php echo number_format($gastos/$row['conversion'], 2,'.',',')." $"; ?></td>
                  <!--<td><?php echo number_format($gastosin, 2,'.',',')." $"; ?></td>-->
                  <!--<td><?php echo number_format($gastos, 2,'.',',')." $"; ?></td>-->
                 
                 
                  </tr>
                    
                        <?php
                       
                       
                        $impressions+=$row['imp'];
                        $clicks+=$row['clic'];
                        $clicasistido+=$row['clicasistido'];
                        $nivelcalidad+=$row['nivelcalidad'];
                        $CTR+=$row['CTR'];
                        $conversion+=$row['conversion'];
                        $tgastosin+=$gastosin;
                        $tgastos+=$gastos;
                        
               }while($row = mysql_fetch_array($result));
                    }
                    
                    $tcostopinv+=$tgastos/$conversion;
                  ?>
                  

                </tbody> 

                 <tfoot style="text-align: right;">
                 <tr>

                  <td><strong></strong></td>
                  <td><strong></strong></td>
                   <td><strong></strong></td>
                  <td><strong> TOTAL</strong></td>
                  
                  
                  <td><strong><?php echo number_format($impressions, 0,',','.'); ?></strong></td>
                  <td><strong><?php echo number_format($clicks, 0,',','.'); ?></strong></td>
                  <td><strong><?php echo $clicasistido; ?></strong></td>
                  <td><strong><?php echo round($CTR/$x, 2)." %"; ?></strong></td>
                  <td><strong><?php echo number_format($nivelcalidad/$x, 0,',','.'); ?></strong></td>
                  <td><strong><?php echo  $conversion; ?></strong></td>
                  <td><strong><?php echo number_format($tcostopinv, 0,'.',','); ?></strong></td>
                  <!--<td><strong><?php echo number_format($tgastosin, 2,'.',',')." $"; ?></strong></td>-->
                  <!--<td><strong><?php echo number_format($tgastos, 2,'.',',')." $"; ?></strong></td>                  -->
                </tr>
                </tfoot> 
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
    pageLength: 10,
    buttons: [{
      extend: 'excel',
      title: 'Reporte Google MOVIL',
      filename: 'reportegooglemovil'
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
                previous:   "Anterior",
                next:       "Siguiente",
                last:       "Anterior"
            }
            
            }
  });
});


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
$('#gck').addClass("active");
</script>
</body>


<!-- Mirrored from demos.creative-tim.com/paper-dashboard-2-pro/examples/components/panels.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Aug 2018 16:06:47 GMT -->
</html>