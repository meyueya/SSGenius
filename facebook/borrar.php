<?php
session_start();
include('controller/funcionesFormat.php');
error_reporting(E_ALL ^ E_NOTICE);
define("NIVEL_MIN_PERMISO",1);
require_once('controller/user.php');
include('../model/ReporteInbox.php');
include('variables.php');
$informes_fb = new ReporteConsulta;//1era tabla
$informes_im= new ReporteConsultaimp;//desglose
$informes_f = new ReporteConsult;//2da tabla
$informes_rea = new ReporteConsultarea;//desglose
$informes_user = new ReporteConsultuser;//3 era tabla
$informes_vid = new ReporteConsultvid;//desglose
$informes_view = new ReporteConsultview;//tabla 4 desglose
$informes_cta = new ReporteConsultcta;//tabla 4
$informes_alc = new ReporteConsultalc;//tabla 5
$informes_tabla = new Reportetabla;//tabla 5 desglose
$informes_fb = $informes_fb->getInformesFB($_GET['psid']);
$informes_im= $informes_im->getInformesimp($_GET['psid']);
$informes_f= $informes_f->getInformes($_GET['psid']);
$informes_rea= $informes_rea->getInformesrea($_GET['psid']);
$informes_user= $informes_user->getInformesuser($_GET['psid']);
$informes_vid= $informes_vid->getInformesvid($_GET['psid']);
$informes_view= $informes_view->getInformesview($_GET['psid']);
$informes_cta= $informes_cta->getInformescta($_GET['psid']);
$informes_alc= $informes_alc->getInformesalc($_GET['psid']);
$informes_tabla= $informes_tabla->getInformestabla($_GET['psid']);



var_dump($_GET['psid']);
?> 
<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <link rel="icon" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" sizes="32x32" />
  <link rel="icon" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" sizes="192x192" />
  <!-- <link rel="apple-touch-icon-precomposed" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" /> -->
  <meta name="msapplication-TileImage" content="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" />
  <title>
    Consulta
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
      table .bajo {
	background-color:CDCDCD;
}
  /*    
.popup{
    
  display:none;
  float:none;
  width: auto;
  height:auto;
  left:auto;
  background-color: #292525;
  color: #fff;
  font-weight: 900px;
  position:auto;
  border: 2px double gray;
  text-align: auto;
  margin:auto auto ;
  margin-top:100px;
  right: 500px;
  padding:10px;// el border blanco que esta alrededor
  min-height:100px;
  border-radius:4px;
  background-color:#000000;
  box-shadow: 0 2px 5px #666666;
  
  
   
}
.popup-button:hover .popup{
  display: block;
}
/*we need to style the popup with CSS so it is placed as a popup does*/

h1 {
  text-align: center;
  font-family: Tahoma, Arial, sans-serif;
  color: #06D85F;
  margin: 80px 0;
}

.box {
  width: 40%;
  margin: 0 auto;
  padding: 35px;
  border-radius: 20px/50px;
  background-clip: padding-box;
  text-align: center;
}

.button {
  font-size: 1em;
  padding: 10px;
  color: black;
  border: 2px solid #06D85F;
  border-radius: 20px/50px;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.3s ease-out;
}
.button:hover {
  background: #06D85F;
}

.overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 700ms;
  visibility: hidden;
  opacity: 0;
}
.overlay:target {
  visibility: visible;
  opacity: 1;
}

.popup {
  margin: 150px 320px;
  padding: 10px;
  background: #fff;
  border-radius: 5px;
  width: 80%;
  position: relative;
  transition: all 5s ease-in-out;
}

.popup h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}
.popup .close {
  position: absolute;
  top: 20px;
  right: 30px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup .close:hover {
  color: #06D85F;
}
.popup .content {
  max-height: 30%;
  overflow: auto;
}

@media screen and (max-width: 700px){
  .box{
    width: 70%;
  }
  .popup{
    width: 70%;
  }
}
</style>

</head>


<body id="body">

  <!-- End Google Tag Manager (noscript) -->
  <div class="wrapper ">
    
 <?php include('views/menuaside.1.php');?>
    <div class="main-panel">
      <!-- Navbar -->
    <?php include('views/menunav.php');?>
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
                       
      
            <table id="example1" class="cell-border compact stripe">
                <thead style="text-align: center;">
                <tr>
                  <th style="width: 10px;">#</th>
                  <th style="width: 10px; "> Fecha </th>
                  <th style="width: 10px;"> Total Inbox </th>
                  <th style="width: 10px;"> Conversaciones Unicas </th>
                  <th style="width: 10px;"> Usuarios Diferentes escribieron</th>
                  <th style="width: 10px;"> Total Respuestas a Usuarios </th>
                  <th style="width: 10px;"> Respondido despues de 48 horas </th>
                  <th style="width: 10px;"> Total no respondido </th>
                  <th style="width: 10px;"> Tiempo promedio Respuesta </th>
                </tr>
                </thead>
                 <tbody>
                             
                            <?php $x=null;?> 
                      <?php foreach ($informes_fb as $key => $value): $x++; ?>
                      <tr>   
                                        <td  class="text-center" ><?php  echo $x; ?></td>
                                        <td><?php echo $value['fecha']; ?></td>
                     <td> <div class="box"><a class="button" href="#popup1"><?php echo $value['total_inbox']; ?></a></div>
                                                  
                                                <div id="popup1" class="overlay">
	                                        <div class="popup">
                                               	<div class="content">       
                                                 
                                                  <table>
                                                    <a class="close" href="#">&times;</a>  
                                                        <tr>
                                                        <th> <p style="color:#1c1b1b"> Conversacion ID</th>
                                                        <th> <p style="color:#1c1b1b"> Usuario </th>
                                                        <th> <p style="color:#1c1b1b"> ID Usuario</th>
                                                        <th> <p style="color:#1c1b1b"> ID Cuenta</th>
                                                        <th> <p style="color:#1c1b1b"> Mensaje</th>
                                                        </tr>
                                                       
                                                             <?php foreach ($informes_im as  $valuen) {
                                                             if($value['fecha']!=$valuen['created_time_fecha'])
                                                             {  ?>
                                                                 
                                                                 
                                                                 <?php   
                                                             } 
                                                              
                                                             else{ ?><tr> 
                                                         <td> <?php echo $valuen['conversation_id']; ?></td>
                                                         <td> <?php echo $valuen['from_name']; ?></td>
                                                         <td> <?php echo $valuen['to_id']; ?></td>
                                                         <td> <?php echo $valuen['from_id']; ?></td> 
                                                         <td> <?php echo $valuen['message']; }?></td> 
                                                        </tr>
                                                        <?php } ?>
                                                          
                                                  </table>
                                                  
                                               </div>
                                               </div>
                           </div>
                                        </td>
                    
                      <?php foreach ($informes_f as $keyy => $tabla2) 
                                         if($value['fecha']!=$tabla2['fecha'])
                                                             {  ?>
                                                                 
                                                                 
                                                                 <?php   
                                                             } 
                                                             else{ ?>
                                       <td> <div class="box"><a class="button" href="#popup1"><?php echo $tabla2['total_mesajes']; ?></a></div>
                                      <div id="popup1" class="overlay">
	                                        <div class="popup">
                                               	<div class="content">       
                                                 
                                                  <table>
                                                    <a class="close" href="#">&times;</a> 
                                                      
                                                        <tr>
                                                        <th   style="background-color: #828783" > <p style="color:#1c1b1b"> Conversacion ID</th>
                                                        <th   style="background-color: #828783" > <p style="color:#1c1b1b"> Usuario </th>
                                                        <th   style="background-color: #828783"> <p style="color:#1c1b1b"> ID Usuario</th>
                                                        <th   style="background-color: #828783"> <p style="color:#1c1b1b"> ID Cuenta</th>
                                                        <th   style="background-color: #828783"> <p style="color:#1c1b1b"> Mensaje</th>
                                                        </tr>
                                                         
                                                             <?php foreach ($informes_rea as  $tabla2d) {
                                                             if($value['fecha']!=$tabla2d['created_time_fecha'])
                                                             {  ?>
                                                                 
                                                                 
                                                                 <?php   
                                                             } 
                                                             else{ ?><tr>                                                       
                                                         <td style="background-color: #828783"> <?php echo $tabla2d['conversation_id']; ?></td>
                                                         <td style="background-color: #828783"> <?php echo $tabla2d['from_name']; ?></td>
                                                         <td style="background-color: #828783"> <?php echo $tabla2d['from_id']; ?></td>
                                                         <td style="background-color: #828783"> <?php echo $tabla2d['to_id']; ?></td> 
                                                         <td style="background-color: #828783"> <?php echo $tabla2d['message']; }?></td> 
                                                        </tr>
                                                        <?php } ?>
                                                         
                                                  </table>
                                                  
                                               </div>
                                               </div>
                                       </td>
                                      <?php foreach ($informes_alc as $keyyyyy => $tabla5) 
                                         if($value['fecha']!=$tabla5['fecha'])
                                                             {  ?>
                                                                 
                                                                 
                                                                 <?php   
                                                             } 
                                                             else{ ?>
                                       <td><div class="box"><a class="button" href="#popup1"><?php echo $tabla5['personas']; ?></a></div>
                                        <div id="popup1" class="overlay">
	                                        <div class="popup">
                                               	<div class="content">       
                                                 
                                                  <table>
                                                    <a class="close" href="#">&times;</a> 
                                                        <tr>
                                                          <th   style="background-color: #828783" > <p style="color:#1c1b1b"> fecha </th>
                                                        <th   style="background-color: #828783" > <p style="color:#1c1b1b"> ID Conversacion </th>
                                                        <th   style="background-color: #828783"> <p style="color:#1c1b1b"> Nombre Usuario</th>
                                                        <th   style="background-color: #828783"> <p style="color:#1c1b1b"> Cuenta </th>
                                                        <th   style="background-color: #828783"> <p style="color:#1c1b1b"> Mensaje</th>
                                                        </tr>
                                                         
                                                             <?php foreach ($informes_tabla as  $tabla5d) {
                                                             if($value['fecha']!=$tabla5d['created_time_fecha'])
                                                             {  ?>
                                                                 
                                                                 
                                                                 <?php   
                                                             } 
                                                             else{ ?><tr>                                                       
                                                          <td style="background-color: #828783"> <?php echo $tabla5d['created_time_fecha']; ?></td>
                                                         <td style="background-color: #828783"> <?php echo $tabla5d['conversation_id']; ?></td>
                                                         <td style="background-color: #828783"> <?php echo $tabla5d['from_name']; ?></td>
                                                         <td style="background-color: #828783"> <?php echo $tabla5d['to_name']; ?></td> 
                                                         <td style="background-color: #828783"> <?php echo $tabla5d['message']; }?></td> 
                                                        </tr>
                                                        <?php } ?>
                                                         
                                                  </table>
                                                  
                                               </div>
                                               </div>
                                       </td>
                                      
                                      
                              <?php foreach ($informes_user as $keyyy => $tabla3)
                                   if($value['fecha']!=$tabla3['fecha'])
                                                             {  ?>
                                                                 
                                                                 
                                                                 <?php   
                                                             } 
                                                             else{ ?>
                                       <td><div class="box"><a class="button" href="#popup1"><?php echo $tabla3['Total_respondido']; ?></a></div>
                                       <div id="popup1" class="overlay">
	                                        <div class="popup">
                                               	<div class="content">       
                                                 
                                                  <table>
                                                    <a class="close" href="#">&times;</a> 
                                                        <tr>
                                                        <th   style="background-color: #828783" > <p style="color:#1c1b1b"> Conversacion ID</th>
                                                        <th   style="background-color: #828783" > <p style="color:#1c1b1b"> Usuario </th>
                                                        <th   style="background-color: #828783"> <p style="color:#1c1b1b"> ID Usuario</th>
                                                        <th   style="background-color: #828783"> <p style="color:#1c1b1b"> ID Cuenta</th>
                                                        <th   style="background-color: #828783"> <p style="color:#1c1b1b"> Mensaje</th>
                                                        </tr>
                                                        
                                                             <?php foreach ($informes_vid as  $tabla3d) {
                                                             if($value['fecha']!=$tabla3d['created_time_fecha'])
                                                             {  ?>
                                                                 
                                                                 
                                                                 <?php   
                                                             } 
                                                             else{ ?> <tr>
                                                         <td style="background-color: #828783"> <?php echo $tabla3d['conversation_id']; ?></td>
                                                         <td style="background-color: #828783"> <?php echo $tabla3d['from_name']; ?></td>
                                                         <td style="background-color: #828783"> <?php echo $tabla3d['from_id']; ?></td>
                                                         <td style="background-color: #828783"> <?php echo $tabla3d['to_id']; ?></td> 
                                                         <td style="background-color: #828783"> <?php echo $tabla3d['message']; }?></td> 
                                                        </tr>
                                                        <?php } ?>
                                                          
                                                  </table>
                                                  
                                               </div>
                                               </div>
                                       </td> 
                         <?php foreach ($informes_cta as  $tabla4d)?>
                              
                         <td> <?php echo $tabla4d['Respodido_despues_de_48_horas'];?></td>
                         
                         
                         <?php foreach ($informes_cta as  $tabla4d)?>
                              
                         <td> <?php echo $tabla4d['total_no_respondido'];?></td>
                                       
                          <?php foreach ($informes_view as $keyyyy => $tabla4)
                              if($value['fecha']!=$tabla4['created_time_fecha'] )
                                                             {  ?>
                      
                                                            <?php } 
                                                             else{  ?>
                                       <td><div class="box"><a class="button" href="#popup1"><?php echo abs($tabla4['minutos']);?></a></div>
                                         <div id="popup1" class="overlay">
	                                        <div class="popup">
                                               	<div class="content">       
                                                 
                                                  <table>
                                                    <a class="close" href="#">&times;</a> 
                                                      
                                                        <tr>
                                                        <th   style="background-color: #828783" > <p style="color:#1c1b1b"> Nombre Usuario</th>
                                                        <th   style="background-color: #828783" > <p style="color:#1c1b1b"> ID Usuario </th>
                                                        <th   style="background-color: #828783"> <p style="color:#1c1b1b"> Pagina</th>
                                                        <th   style="background-color: #828783"> <p style="color:#1c1b1b"> Fecha</th>
                                                        <th   style="background-color: #828783"> <p style="color:#1c1b1b"> Mensaje de usuario</th>
                                                        <th   style="background-color: #828783"> <p style="color:#1c1b1b"> Cuenta</th>
                                                        <th   style="background-color: #828783"> <p style="color:#1c1b1b"> Usuario </th>
                                                        <th   style="background-color: #828783"> <p style="color:#1c1b1b"> Mensaje de cuenta</th>
                                                        <th   style="background-color: #828783"> <p style="color:#1c1b1b"> tiempo</th>
                                                        <th   style="background-color: #828783"> <p style="color:#1c1b1b"> total no respondido</th>
                                                        <th   style="background-color: #828783"> <p style="color:#1c1b1b"> total respondido</th>
                                                        </tr>
                                                         
                                                             <?php foreach ($informes_cta as  $tabla4d) {
                                                             if($value['fecha']!=$tabla4d['created_time_fecha'])
                                                             {  ?>
                                                                 
                                                                 
                                                                 <?php   
                                                             } 
                                                             else{ ?><tr>
                                                         <td style="background-color: #828783"> <?php echo $tabla4d['Nombre_usuario']; ?></td>
                                                         <td style="background-color: #828783"> <?php echo $tabla4d['id_usuario']; ?></td>
                                                         <td style="background-color: #828783"> <?php echo $tabla4d['Nombre_Pagina']; ?></td>
                                                         <td style="background-color: #828783"> <?php echo $tabla4d['Fecha']; ?></td>
                                                         <td style="background-color: #828783"> <?php echo $tabla4d['M_usuario']; ?></td> 
                                                         <td style="background-color: #828783"> <?php echo $tabla4d['fmovil']; ?></td>
                                                         <td style="background-color: #828783"> <?php echo $tabla4d['tmovil']; ?></td>
                                                         <td style="background-color: #828783"> <?php echo $tabla4d['mmovil']; ?></td>
                                                         <td style="background-color: #828783"> <?php echo $tabla4d['minutos']; ?></td>
                                                         <td style="background-color: #828783"> <?php echo $tabla4d['total_no_respondido']; ?></td>
                                                         <td style="background-color: #828783"> <?php echo $tabla4d['total_respondido']; }?></td>
                                                        </tr>
                                                        <?php } ?>
                                                          
                                                  </table>
                                                  
                                               </div>
                                       </div>
                                             </div>
                                     </td> 
                                      
                                  
                     </tr>
                     <?php } ?>
                     <?php } ?>
                     <?php } ?>
                     <?php } ?>
        <?php endforeach ?>
                    
         
                   </tbody>
                      
              </table>
    
      
            </div>
            </div>
          </div>
            
</form>
 
        <?php include('views/pie-pagina.php'); ?>
    </div>
  </div>

  <!--   Core JS Files   -->
  <script> //with this first line we're saying: "when the page loads (document is ready) run the following script"
$(document).ready(function () {
    //select the POPUP FRAME and show it
    $("#popupp").hide().fadeIn(1000);

    //close the POPUP if the button with id="close" is clicked
    $("#close").on("click", function (e) {
        e.preventDefault();
        $("#popupp").fadeOut(1000);
    });
});</script>
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
        targets: [ -1, -2,-3],
        className: 'dt-body-right'
    }
  ],
    pageLength: 160,
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
                first:      "Inicio",
                previous:   "Anterior",
                next:       "Siguiente",
                last:       "Anterior"
            }
            
            }
  });
});



    function deleteReport(id) {
        swal({
            title: 'Â¿Estas seguro de eliminar este elemento?',
            text: '',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, estoy seguro',
            cancelButtonText: 'No',
            confirmButtonClass: "btn btn-success",
            cancelButtonClass: "btn btn-danger",
            buttonsStyling: false
        }).then(function() {
            console.log(id);
            $.ajax({
                type: "post",
                url: 'controller/procesarinformefb.php',
                data: {'id_informe_fb_delete':id},
                success: function(result){
                $('tr[data-id="'+id+'"]').fadeOut('slow','swing');
                swal({
                    title: 'Â¡Ã‰xito!',
                    text: result,
                    type: 'success',
                    confirmButtonClass: "btn btn-success",
                    buttonsStyling: false
                }).catch(swal.noop)
        }
            });
            
        }, function(dismiss) {
            // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
            if (dismiss === 'cancel') {
                swal({
                    title: 'Cancelado',
                    text: '',
                    type: 'info',
                    confirmButtonClass: "btn btn-info",
                    buttonsStyling: false
                }).catch(swal.noop)
            }
        })
    }

$('#my_reports').addClass("active");
$('#my_reports_examples').addClass("show");
$('#reports_fb').addClass("active");
</script>
</body>
<?php } ?>

<!-- Mirrored from demos.creative-tim.com/paper-dashboard-2-pro/examples/components/panels.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Aug 2018 16:06:47 GMT -->
</html>