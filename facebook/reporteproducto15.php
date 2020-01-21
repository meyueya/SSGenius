<?php
include('../auth.php');




$f = date("m");

$nanuncio=$_GET['nanuncio'];
$camp=$_GET['camp'];


    if(isset($_POST['daterange-btn'])){

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
    $fecha="and a.fecha_registro BETWEEN '$desde' and '$hasta'";
    }

    if ($meses>=1){
    $factor=$meses+1;
    $inicio="$y-".$f."-01";
    $fin="$y2-".$f."-31";
    $fecha="and a.fecha_registro BETWEEN '$desde' and '$hasta'";
    }
    
    
    }
    else{
    $fecha="";
    }

    if($_POST['prod']!='0'){
      $prod="AND a.modelo='".$_POST['prod']."'";
    }
    else{
    $prod="";
    }

    
   $result = mysql_query("SELECT COUNT(a.id) as Form, b.NombreModelo, a.modelo FROM cliente as a, modelo as b WHERE a.modelo=b.inicialmodelo and b.e NOT IN('1111','3000')  ".$fecha."".$prod." GROUP BY modelo");
  

 
    }





    else{

         $desde=date("Y-m-d",strtotime($desdehasta[0]));
         $hasta=date("Y-m-d",strtotime($desdehasta[1]));
         $result = mysql_query("SELECT COUNT(a.id) as Form, b.NombreModelo, a.modelo FROM cliente as a, modelo as b WHERE a.modelo=b.inicialmodelo and b.e NOT IN('1111','3000')  and a.fecha_registro '".$desde."' AND '".$hasta."' GROUP BY modelo");
         }
   


?>
<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
  
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/iconcool.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Reporte Producto
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
.daterangepicker.ltr .calendar{
    display: none !important;
}

.range_inputs{
    display: none !important;
}
</style>


</head>

<body class="">

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
            <a class="navbar-brand" href="#pablo">Reporte 15 dias Producto</a>
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
     

        <form id="miform" method="post" name="miform" action="reporteproducto15.php">
        <div class="row">
         

            <div class="col-md-3">
          </div>
          <div class="col-md-4">
             
              <div class="form-group">
                <p> Producto:</p>

                <div class="input-group">
                <select name="prod" id="prod" class="form-control pull-left" >
                <option value="0" selected>Selecione Produccto:</option>
                <?php


                 $resultp = mysql_query("SELECT DISTINCT `NombreModelo`, `inicialmodelo` FROM `modelo` WHERE e NOT IN('1111','3000')");
                if($rowp = mysql_fetch_array($resultp)){
                  do{
                      $b++; 
                      $a=$b;
                      echo '<option value="'.$rowp['inicialmodelo'].'">'.$a.".- ".$rowp['NombreModelo'].'</option>';
                        }while($rowp = mysql_fetch_array($resultp));
                      }else{
                      }
                    ?>
                  </select>
                </div>
              </div>
           
          </div>
         
             <!-- Date and time range -->
              
             <div class="col-md-2">
              <div class="form-group">
                 Reporte por Fecha:

                <div class="input-group">
                  <input  class="btn btn-default pull-right" name="daterange-btn" id="daterange-btn" autocomplete="off">
                  </input>
                  <input  name="dpag" id="dpag" type="hidden" value="<?php echo $_POST['daterange-btn']; ?>"></input>
                  </div>
                </div>
                </div>
                 <div class="col-md-3">          
 <button type="submit" name="greport" id="greport" value="GREPORT"  class="btn btn-success" style="float: right;"><i class="fa fa-print"></i> Generar Reporte</button>
 </div>
                
              
            
   

           <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
             <table id="example1" class="cell-border compact stripe">
                <thead style="text-align: center;">
                <tr>
                  <th style="width: 10px;">#</th>
                  <th>Producto</th>
                  <th>Impresiones</th>
                  <th>Clics</th>
                  <th>CTR (%)</th>
                  <th>Total Inversión</th>
                  <th>Total Formulario</th>
                  <th>Total Inversión Form</th>
                  <th>Total Form Pauta</th>
                  <th>Inversión por Form, Pauta</th>
                  <th>Clic a Form (%)</th>
                  <th>Meta Form</th>
                  <th>Leads</th>
                  <th>Meta Leads</th>
                  <th>Cant. no ubicados a la fecha</th>
                  <th>Prom. llamadas a no ubicados</th>
                  <th>% de llamadas por encima de 4 a los no ubicado</th>
                </tr>
                </thead>
                 <tbody>
                
                  <?php
                
                  $x=1;
                  if($row = mysql_fetch_array($result)){
                  do{

                  $modelo= $row['modelo'];
                  $mes=$row['mes'];
                  if($mes<10){$mes="0".$mes;}
                  $ano=$row['ano']; 
                 
                 $result1 = mysql_query("SELECT SUM(tabla.costo) as costo, tabla.imp, tabla.clic, tabla.campaign_name  FROM (SELECT SUM(impressions) as imp, SUM(clicks) as clic, SUM(spend) as costo, campaign_name FROM reportefacebook where campaign_name LIKE '%".$modelo."%' AND date_start BETWEEN '".$desde."' AND '".$hasta."' GROUP BY campaign_id) as tabla");
                // echo "SELECT SUM(tabla.costo) as costo, tabla.imp, tabla.clic, tabla.campaign_name  FROM (SELECT SUM(impressions) as imp, SUM(clicks) as clic, SUM(spend) as costo, campaign_name FROM reportefacebook where campaign_name LIKE '%".$modelo."%' AND date_start BETWEEN '".$desde."' AND '".$hasta."' GROUP BY campaign_name) as tabla";
                  //$result1 = mysql_query(" SELECT SUM(impressions) as imp, SUM(clicks) as clic, SUM(spend) as costo, campaign_name FROM reportefacebook where ad_name LIKE '%".$modelo."%' and date_start BETWEEN '".$desde."' AND '".$hasta."' GROUP BY campaign_id");  
                  $row1 = mysql_fetch_array($result1);
    
                  $result2 = mysql_query("SELECT SUM(Impresiones) as imp, SUM(Clics) as clic, SUM(Costo) as costo, Campana FROM reportegoogle where Costo!='0' AND Campana LIKE '%".$modelo."%' AND Dia BETWEEN '".$desde."' AND '".$hasta."' GROUP BY Campana");
                  
                  $row2 = mysql_fetch_array($result2); 
                  $result3 = mysql_query("SELECT COUNT(id) as formp FROM `cliente` WHERE modelo = '".$modelo."' and fecha_registro BETWEEN '".$desde."' AND '".$hasta."' AND a IN(1,2) ");
                  $row3 = mysql_fetch_array($result3); 
                  $result4= mysql_query("SELECT COUNT(DISTINCT(modelo)) as divide FROM `cliente` WHERE fecha_registro BETWEEN '".$desde."' AND '".$hasta."' ");
                  $row4 = mysql_fetch_array($result4);
                  $result5 = mysql_query("SELECT COUNT(*) as bci FROM (SELECT COUNT(*) as bci FROM cliente  WHERE modelo = '".$modelo."' and fecha_registro BETWEEN '".$desde."' AND '".$hasta."' AND estado NOT IN('C11','C002','c111','c112','c113','C12','C13','C14') GROUP by id) as tabla");
                  $row5 = mysql_fetch_array($result5);
                  $result6 = mysql_query("SELECT COUNT(*) AS bci FROM (SELECT COUNT(b.idcliente) as total FROM cliente as a, mensajeria as b WHERE a.id=b.idcliente AND a.modelo = '".$modelo."' and a.fecha_registro BETWEEN '".$desde."' AND '".$hasta."' AND a.estado='C002' GROUP BY b.idcliente HAVING COUNT(*)<5) as tabla"); 
                  $row6 = mysql_fetch_array($result6);
                  
                  $result7 = mysql_query("SELECT COUNT(total) AS nc, SUM(total) as suma FROM (SELECT COUNT(b.idcliente) as total FROM cliente as a, mensajeria as b WHERE a.id=b.idcliente  and a.modelo = '".$modelo."' and a.fecha_registro BETWEEN '".$desde."' AND '".$hasta."' AND a.estado='C002' GROUP BY b.idcliente ) as tabla");
                  $row7 = mysql_fetch_array($result7);

                  
                  
                  $bci=$row5['bci']+$row6['bci'];
                  $inv= $row1['costo']+$row2['costo'];
                  $imp=$row1['imp']+$row2['imp'];
                  $clic=$row1['clic']+$row2['clic'];
                  $gasto= 425/$row4['divide'];
                   if ($inv==0){
                    $gasto=0;
                  }
                  $inv=((((($inv*3.6)+$gasto)/0.7)/0.94)/0.91);
                  $formp=$row3['formp'];
                  $invform=$inv/$row['Form'];
                  $invformp=$inv/$formp;
                  $cantpllam=($row7['suma']/$row7['nc']);
                  $cantpllammas4=(($row7['nc']-$row6['bci'])*100)/$row7['nc'];


                  ?>
                 


                  <tr>
                      
                  <td><?php echo $x; ?></a></td>  
                  <td><?php echo $row['NombreModelo']; ?></td>
                  <td><?php echo $imp; ?></td>
                  <td><?php echo $clic; ?></td>
                  <td><?php echo number_format(($clic/$imp)*100, 2,'.',''); ?>%</td>
                  <td><?php echo number_format($inv, 2,'.','');?></td>
                  <td><?php echo $row['Form']; ?></td>
                  <td><?php echo number_format($invform, 2,'.',','); ?></td>
                  <td><?php echo number_format($formp, 0,'.',','); ?></td>
                  <td><?php echo number_format($invformp, 2,'.',','); ?></td>
                  <td><?php echo number_format(($row['Form']/$clic)*100, 2,'.','');?>%</td>                  
                  <td></td> 
                  <td><?php echo number_format($bci, 0,'.','');?></td>                
                  <td></td>                 
                  <td><?php echo number_format($row7['nc'], 0,'.','');?></td>
                  <td><?php echo number_format($cantpllam, 2,'.','');?></td>
                  <td><?php echo number_format($cantpllammas4, 2,'.','')."% ";?></td>                
                 
                  </tr>
                    
                        <?php
                        $x++;
                        $tform+=$row['Form'];
                        $tinv+=$inv;
                        $tclic+=$clic;
                        $timp+=$imp;
                        $tinvform+=$invform;
                        $tformp+=$formp;
                        $tinvformp+=$invformp;
                        $tbci+=$bci;
                        $tcantpllam+=$cantpllam;
                        $tcantpllammas4+=$cantpllammas4;
                        $tnb+=$row7['nc'];
                       
               }while($row = mysql_fetch_array($result));
                    }
                   
                        ?>


                </tbody> 
                 <tfoot>
                 <tr>
                    <td></td>
                    <td><strong> TOTAL</strong></td>
                    <td><strong><?php echo number_format($timp, 0,'.',','); ?></strong></td>
                    <td><strong><?php echo number_format($tclic, 0,'.',','); ?></strong></td>
                    <td><strong><?php echo number_format(($tclic/$timp)*100, 2,'.',','); ?>%</strong></td> 
                    <td><strong><?php echo number_format($tinv, 2,'.',','); ?></strong></td>                     
                    <td><strong><?php echo number_format($tform, 0,'.',','); ?></strong></td>
                    <td><strong><?php echo number_format($tinv/$tform, 2,'.',','); ?></strong></td>
                    <td><strong><?php echo number_format($tformp, 0,'.',','); ?></strong></td>
                    <td><strong><?php echo number_format($tinv/$tformp, 2,'.',','); ?></strong></td>                    
                    <td><strong><?php echo number_format(($tform/$tclic)*100, 2,'.',','); ?>%</strong></td>
                    <td></td>
                    <td><strong><?php echo number_format($tbci, 0,'.',','); ?></strong></td>                    
                    <td></td>   
                    <td><strong><?php echo number_format($tnb, 0,'.',','); ?></strong></td>
                    <td><strong><?php echo number_format($tcantpllam/$x, 2,'.',','); ?></strong></td> 
                    <td><strong><?php echo number_format($tcantpllammas4/$x, 2,'.',','); ?>%</strong></td> 
                    
                </tr>
                </tfoot>
              
                
                
              </table>
              
</div>
              </div>
            </div>
          </div>
          



</form>







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
    else if(d === ''){ var des=moment().startOf('month'); var has=moment().startOf('month').add(14, 'days');  }
 
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
         
          '15 mes actual'  : [moment().startOf('month'), moment().startOf('month').add(14, 'days')],
          '30 mes Actual'  : [moment().startOf('month').add(15, 'days'),moment().endOf('month')],
          '15 Mes Pasado'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').startOf('month').add(14, 'days')],
          '30 Meses Pasado'  : [moment().subtract(1, 'month').startOf('month').add(15, 'days'), moment().subtract(1, 'month').endOf('month')],
          '15 hace 2 meses'  : [moment().subtract(2, 'month').startOf('month'), moment().subtract(2, 'month').startOf('month').add(14, 'days')],
          '30 hace 2 meses'  : [moment().subtract(2, 'month').startOf('month').add(15, 'days'), moment().subtract(2, 'month').endOf('month')],
          '15 hace 3 meses'  : [moment().subtract(3, 'month').startOf('month'), moment().subtract(3, 'month').startOf('month').add(14, 'days')],
          '30 hace 3 meses'  : [moment().subtract(3, 'month').startOf('month').add(15, 'days'), moment().subtract(3, 'month').endOf('month')]
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
        "customRangeLabel": "",
              
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
    /*  function (start, end, label) {
      
        $('#daterange-btn span').html(start.format('dd/mm/yyyy') + ' - ' + end.format('dd/mm/yyyy'))
      }*/
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
    /* columnDefs: [
    {
        targets: [-5,-6],
        className: 'dt-body-right'
    }
  ],*/
    pageLength: 15,
    buttons: [{
      extend: 'excel',
      title: 'Reporte Producto',
      filename: 'reporteproducto'
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






$('#reporte').addClass("show");
$('#r').addClass("active");
$('#rp15').addClass("active");
</script>
</body>


<!-- Mirrored from demos.creative-tim.com/paper-dashboard-2-pro/examples/components/panels.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Aug 2018 16:06:47 GMT -->
</html>