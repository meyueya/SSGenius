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
      
.box {
  width: 40%;
  margin: 0 auto;
  background: rgba(255,255,255,0.2);
  padding: 35px;
  border: 2px solid #fff;
  border-radius: 20px/50px;
  background-clip: padding-box;
  text-align: center;
}

.button {
  font-size: 1em;
  padding: 3px;
  color: black;
  border-radius: 10px/20px;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.3s ease-out;
}
.button:hover {
  color:#fff;
  background: #06D85F;
}

.overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
}
.overlay2 {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
}
.overlay3 {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
}
.overlay4 {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
}
.overlay5 {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
}
.overlay:target {
  visibility: visible;
  opacity: 1;
}
.overlay2:target {
  visibility: visible;
  opacity: 1;
}
.overlay3:target {
  visibility: visible;
  opacity: 1;
}
.overlay4:target {
  visibility: visible;
  opacity: 1;
}
.overlay5:target {
  visibility: visible;
  opacity: 1;
}


.popup {
  margin: 70px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 70%;
  position: relative;
  top: 110px;
  left: 100px;
  transition: all 5s ease-in-out;
}
.popup2 {
  margin: 70px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 70%;
  position: relative; 
  top: 110px;
  left: 100px;
  transition: all 5s ease-in-out;
}
.popup3 {
  margin: 70px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 70%;
  position: relative;
  top: 110px;
  left: 100px;
  transition: all 5s ease-in-out;
}
.popup4 {
  margin: 70px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 70%;
  position: relative;
  top: 110px;
  left: 100px;
  transition: all 5s ease-in-out;
}
.popup5 {
  margin: 70px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 70%;
  position: relative;
  top: 110px;
  left: 100px;
  transition: all 5s ease-in-out;
}

.popup h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}

.popup2 h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}
.popup3 h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}
.popup4 h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}
.popup5 h2 {
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
.popup2 .close2 {
  position: absolute;
  top: 20px;
  right: 30px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup3 .close3 {
  position: absolute;
  top: 20px;
  right: 30px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup4 .close4 {
  position: absolute;
  top: 20px;
  right: 30px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup5 .close5 {
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
.popup2 .close:hover {
  color: #06D85F;
}
.popup3 .close:hover {
  color: #06D85F;
}
.popup4 .close:hover {
  color: #06D85F;
}
.popup5 .close:hover {
  color: #06D85F;
}
.popup .content {
  max-height: 30%;
  overflow: auto;
}
.popup2 .content2 {
  max-height: 30%;
  overflow: auto;
}
.popup3 .content3 {
  max-height: 30%;
  overflow: auto;
}
.popup4 .content4 {
  max-height: 30%;
  overflow: auto;
}
.popup5 .content5 {
  max-height: 30%;
  overflow: auto;
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
                     <td class="text-center">
	<a class="button" href="#popup1"><?php echo $value['total_inbox']; ?></a>

                                                  
                                              <div id="popup1" class="overlay" >
	                                      <div class="popup">
		                              <a class="close" href="#">&times;</a>
		                              <div class="content">
                                                   
                                                  <table>
                                                      
                                                        <tr>
                                                        <th   style="background-color: #828783" > <p style="color:#1c1b1b"> Conversacion ID</th>
                                                        <th   style="background-color: #828783" > <p style="color:#1c1b1b"> Usuario </th>
                                                        <th   style="background-color: #828783"> <p style="color:#1c1b1b"> ID Usuario</th>
                                                        <th   style="background-color: #828783"> <p style="color:#1c1b1b"> ID Cuenta</th>
                                                        <th   style="background-color: #828783"> <p style="color:#1c1b1b"> Mensaje</th>
                                                        </tr>
                                                       
                                                             <?php foreach ($informes_im as  $valuen) {
                                                             if($value['fecha']!=$valuen['created_time_fecha'])
                                                             {  ?>
                                                                 
                                                                 
                                                                 <?php   
                                                             } 
                                                              
                                                             else{ ?><tr> 
                                                         <td style="background-color: #828783"> <?php echo $valuen['conversation_id']; ?></td>
                                                         <td style="background-color: #828783"> <?php echo $valuen['from_name']; ?></td>
                                                         <td style="background-color: #828783"> <?php echo $valuen['to_id']; ?></td>
                                                         <td style="background-color: #828783"> <?php echo $valuen['from_id']; ?></td> 
                                                         <td style="background-color: #828783"> <?php echo $valuen['message']; }?></td> 
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
                                       <td class="text-center">
	<a class="button" href="#popup2"><?php echo $tabla2['total_mesajes']; ?></a>

                                       <div id="popup2" class="overlay2">
	<div class="popup2">
		<a class="close2" href="#">&times;</a>
		<div class="content2">
                                                   
                                                  <table>
                                                      
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
</div>
                                       </td>
                                      <?php foreach ($informes_alc as $keyyyyy => $tabla5) 
                                         if($value['fecha']!=$tabla5['fecha'])
                                                             {  ?>
                                                                 
                                                                 
                                                                 <?php   
                                                             } 
                                                             else{ ?>
                                       <td class="text-center">
	<a class="button" href="#popup3"><?php echo $tabla5['personas']; ?></a>

                                      <div id="popup3" class="overlay3">
	<div class="popup3">
		<a class="close3" href="#">&times;</a>
		<div class="content3">           
                                                  <table>
                                                      
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
</div>
                                       </td>
                                      
                                      
                              <?php foreach ($informes_user as $keyyy => $tabla3)
                                   if($value['fecha']!=$tabla3['fecha'])
                                                             {  ?>
                                                                 
                                                                 
                                                                 <?php   
                                                             } 
                                                             else{ ?>
                                       <td class="text-center">
	<a class="button" href="#popup4"><?php echo $tabla3['Total_respondido']; ?></a>

                                       <div id="popup4" class="overlay4" >
	<div class="popup4">
		<a class="close4" href="#">&times;</a>
		<div class="content4">
                                                   
                                                  <table>
                                                      
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
                                       <td>
	<a class="button" href="#popup5"><?php echo abs($tabla4['minutos']);?></a>
                                        <div id="popup5" class="overlay5" >
	<div class="popup5" class="text-center">
		<a class="close5" href="#">&times;</a>
		<div class="content5">
                                                   
                                                  <table>
                                                      
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
            title: 'Ã‚Â¿Estas seguro de eliminar este elemento?',
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
                    title: 'Ã‚Â¡Ãƒâ€°xito!',
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