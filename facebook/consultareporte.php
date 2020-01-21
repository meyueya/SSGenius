<?php
session_start();
include('controller/funcionesFormat.php');
error_reporting(E_ALL ^ E_NOTICE);
define("NIVEL_MIN_PERMISO",1);
require_once('controller/user.php');
include('../model/ReporteConsulta.php');
include('variables.php');
$informes_fb = new ReporteConsulta;
$informes_im= new ReporteConsultaimp;
$informes_f = new ReporteConsult;
$informes_rea = new ReporteConsultarea;
$informes_user = new ReporteConsultuser;
$informes_vid = new ReporteConsultvid;
$informes_view = new ReporteConsultview;
$informes_cta = new ReporteConsultcta;
$informes_alc = new ReporteConsultalc;
$informes_fb = $informes_fb->getInformesFB($_GET['psid']);
$informes_im= $informes_im->getInformesimp($_GET['psid']);
$informes_f= $informes_f->getInformes($_GET['psid']);
$informes_rea= $informes_rea->getInformesrea($_GET['psid']);
$informes_user= $informes_user->getInformesuser($_GET['psid']);
$informes_vid= $informes_vid->getInformesvid($_GET['psid']);
$informes_view= $informes_view->getInformesview($_GET['psid']);
$informes_cta= $informes_cta->getInformescta($_GET['psid']);
$informes_alc= $informes_alc->getInformesalc($_GET['psid']);



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
                     
      <td class="text-center">Rango de Fechas: <?php echo $desde.'  ▬  '.$hasta?>  </td>
                       
      
            <table id="example1" class="cell-border compact stripe">
                <thead style="text-align: center;">
                <tr>
                  <th style="width: 10px;">#</th>
                  <th > Nombre </th>
                  <th > Indicadores </th>
                  <th > Sumatoria </th> 
                 
                </tr>
                </thead>
                 <tbody>

               <?php $x=null;?>  
                <?php foreach ($informes_fb as $key => $value):  $x++;?>
                
                
              
                     <tr style=" background: #CDCDCD"> 
                      <td  class="text-center" ><?php  echo $x; ?></td>
                      <td class="text-center"><?php  echo $sfpg; ?></td> 
                      <td class="text-center"> <?php echo $page_fans?></td>
                      <td class="text-left"><?php echo formatPeriod($value['page_fans']);?></td> 
                     </tr>
              
                     <tr style=" background: #CDCDCD">  
                        <td class="text-center"><?php  echo $x; ?></td>
                        <td class="text-center"><?php  echo $sfpg; ?></td>
                        <td class="text-center"><?php  echo  $page_engaged_users;?></td>
                        <td class="text-left"><?php echo formatPeriod($value['page_engaged_users']);?></td> 
                     </tr>
                
                 <tr style=" background: #CDCDCD">  
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpg; ?></td>
                    <td class="text-center"><?php  echo  $page_consumptions;?></td>
                    <td class="text-left"><?php echo formatPeriod($value['page_consumptions']);?></td> 
                 </tr>
                 <tr style=" background: #CDCDCD">   
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpg; ?></td>
                    <td class="text-center"><?php  echo  $page_consumptions_unique;?></td>
                    <td class="text-left"><?php echo formatPeriod($value['page_consumptions_unique']);?></td> 
                 </tr>
                 <tr style=" background: #CDCDCD">   
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpg; ?></td>
                    <td class="text-center"><?php  echo  $page_consumptions_by_consumption_type_link_clicks;?></td>
                    <td class="text-left"><?php echo formatPeriod($value['page_consumptions_by_consumption_type_link_clicks']);?></td> 
                 </tr>
                 <tr style=" background: #CDCDCD">  
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpg; ?></td>
                    <td class="text-center"><?php  echo  $page_consumptions_by_consumption_type_other_clicks;?></td>
                    <td class="text-left"><?php echo formatPeriod($value['page_consumptions_by_consumption_type_other_clicks']);?></td> 
                 </tr>
                 <tr style=" background: #CDCDCD">  
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpg; ?></td>
                    <td class="text-center"><?php  echo  $page_consumptions_by_consumption_type_photo_view;?></td>
                    <td class="text-left"><?php echo formatPeriod($value['page_consumptions_by_consumption_type_photo_view']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">  
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpg; ?></td>
                    <td class="text-center"><?php  echo  $page_consumptions_by_consumption_type_video_play;?></td>
                    <td class="text-left"><?php echo formatPeriod($value['page_consumptions_by_consumption_type_video_play']);?></td> 
                </tr>
                 <tr style=" background: #CDCDCD">   
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpg; ?></td>
                    <td class="text-center"><?php  echo  $page_places_checkin_total;?></td>
                    <td class="text-left"><?php echo formatPeriod($value['page_places_checkin_total']);?></td> 
                </tr>
                 <tr style=" background: #CDCDCD">  
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpg; ?></td>
                    <td class="text-center"><?php  echo  $page_places_checkin_total_unique;?></td>
                    <td class="text-left"><?php echo formatPeriod($value['page_places_checkin_total_unique']);?></td> 
                 </tr>
                 <tr style=" background: #CDCDCD">  
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpg; ?></td>
                    <td class="text-center"><?php  echo  $page_places_checkin_mobile;?></td>
                    <td class="text-left"><?php echo formatPeriod($value['page_places_checkin_mobile']);?></td> 
                 </tr>
                 <tr style=" background: #CDCDCD">   
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpg; ?></td>
                    <td class="text-center"><?php  echo  $page_places_checkin_mobile_unique;?></td>
                    <td class="text-left"><?php echo formatPeriod($value['page_places_checkin_mobile_unique']);?></td>
                </tr>
                 <tr style=" background: #CDCDCD">  
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpg; ?></td>
                    <td class="text-center"><?php  echo  $page_negative_feedback;?></td>
                    <td class="text-left"><?php echo formatPeriod($value['page_negative_feedback']);?></td> 
                </tr>
                 <tr style=" background: #CDCDCD">   
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpg; ?></td>
                    <td class="text-center"><?php  echo  $page_places_checkins_by_age_gender;?></td>
                    <td class="text-left"><?php echo formatPeriod($value['page_places_checkins_by_age_gender']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">   
                    <td class="text-center"><?php  echo $x; ?></td>
                     <td class="text-center"><?php  echo $sfpg; ?></td>
                     <td class="text-center"><?php  echo  $page_positive_feedback_by_type_link;?></td>
                     <td class="text-left"><?php echo formatPeriod($value['page_positive_feedback_by_type_link']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">   
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpg; ?></td>
                    <td class="text-center"><?php  echo  $page_positive_feedback_by_type_like;?></td>
                    <td class="text-left"><?php echo formatPeriod($value['page_positive_feedback_by_type_like']);?></td> 
                 </tr>
                   <tr style=" background: #CDCDCD">   
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpg; ?></td>
                    <td class="text-center"><?php  echo  $page_positive_feedback_by_type_other;?></td>
                    <td class="text-left"><?php echo formatPeriod($value['page_positive_feedback_by_type_other']);?></td>
                  </tr>
                 <tr style=" background: #CDCDCD">   
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpg; ?></td>
                    <td class="text-center"><?php  echo  $page_positive_feedback_by_type_unique_link;?></td>
                    <td class="text-left"><?php echo formatPeriod($value['page_positive_feedback_by_type_unique_link']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">  
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpg; ?></td>
                    <td class="text-center"><?php  echo  $page_positive_feedback_by_type_unique_like;?></td>
                    <td class="text-left"><?php echo formatPeriod($value['page_positive_feedback_by_type_unique_like']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">   
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpg; ?></td>
                    <td class="text-center"><?php  echo  $page_positive_feedback_by_type_unique_other;?></td>
                    <td class="text-left"><?php echo formatPeriod($value['page_positive_feedback_by_type_unique_other']);?></td> 
                  </tr>
                 <tr style=" background: #CDCDCD">   
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpg; ?></td>
                    <td class="text-center"><?php  echo  $shares;?></td>
                    <td class="text-left"><?php echo formatPeriod($value['shares']);?></td> 
                 </tr>
                 <tr style=" background: #CDCDCD">   
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpg; ?></td>
                    <td class="text-center"><?php  echo  $likes;?></td>
                    <td class="text-left"><?php echo formatPeriod($value['likes']);?></td> 
                 </tr>
                 <tr style=" background: #CDCDCD">   
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpg; ?></td>
                    <td class="text-center"><?php  echo  $comments;?></td>
                    <td class="text-left"><?php echo formatPeriod($value['comments']);?></td> 
                 </tr>
                <?php endforeach ?> 
               
              
                 <?php $x=null;?>
                 <?php foreach ($informes_f as $key => $valuess):  $x++;?>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpp; ?></td>      
                    <td class="text-center"><?php  echo  $page_fans;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuess['page_fans']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpp; ?></td>      
                    <td class="text-center"><?php  echo  $page_posts_impressions;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuess['page_posts_impressions']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpp; ?></td>      
                    <td class="text-center"><?php  echo  $page_posts_impressions_unique;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuess['page_posts_impressions_unique']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpp; ?></td>      
                    <td class="text-center"><?php  echo  $page_posts_impressions_paid;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuess['page_posts_impressions_paid']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpp; ?></td>      
                    <td class="text-center"><?php  echo  $page_posts_impressions_paid_unique;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuess['page_posts_impressions_paid_unique']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpp; ?></td>      
                    <td class="text-center"><?php  echo  $page_posts_impressions_organic;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuess['page_posts_impressions_organic']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpp; ?></td>      
                    <td class="text-center"><?php  echo  $page_posts_impressions_organic_unique;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuess['page_posts_impressions_organic_unique']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpp; ?></td>      
                    <td class="text-center"><?php  echo  $page_posts_impressions_viral;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuess['page_posts_impressions_viral']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpp; ?></td>      
                    <td class="text-center"><?php  echo  $page_posts_impressions_viral_unique;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuess['page_posts_impressions_viral_unique']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpp; ?></td>      
                    <td class="text-center"><?php  echo  $page_posts_impressions_nonviral;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuess['page_posts_impressions_nonviral']);?></td>
                 </tr>
                   <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpp; ?></td>      
                    <td class="text-center"><?php  echo  $page_posts_impressions_nonviral_unique;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuess['page_posts_impressions_nonviral_unique']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpp; ?></td>      
                    <td class="text-center"><?php  echo  $page_posts_served_impressions_organic_unique;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuess['page_posts_served_impressions_organic_unique']);?></td>
                 </tr>
                     
                     
                     
                    <?php endforeach ?>
                
                   <?php $x=null;?>
                <?php foreach ($informes_im as $key => $valuesimp):  $x++;?>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_fans;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_fans']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_impressions;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_impressions_unique;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions_unique']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_impressions_paid;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions_paid']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_impressions_paid_unique;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions_paid_unique']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_impressions_organic;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions_organic']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_impressions_organic_unique;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions_organic_unique']);?></td>
                 </tr> <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_impressions_viral;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions_viral']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_impressions_viral_unique;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions_viral_unique']);?></td>
                 </tr> <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_impressions_nonviral;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions_nonviral']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_impressions_nonviral_unique;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions_nonviral_unique']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_impressions_by_story_type;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions_by_story_type']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_impressions_by_story_type_unique;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions_by_story_type_unique']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_impressions_by_age_gender_unique_Female_65;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions_by_age_gender_unique_Female_65']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_impressions_by_age_gender_unique_Female_55_64;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions_by_age_gender_unique_Female_55_64']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_impressions_by_age_gender_unique_Female_45_54;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions_by_age_gender_unique_Female_45_54']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_impressions_by_age_gender_unique_Female_35_44;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions_by_age_gender_unique_Female_35_44']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_impressions_by_age_gender_unique_Female_25_34;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions_by_age_gender_unique_Female_25_34']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_impressions_by_age_gender_unique_Female_18_24;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions_by_age_gender_unique_Female_18_24']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_impressions_by_age_gender_unique_Female_13_17;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions_by_age_gender_unique_Female_13_17']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_impressions_by_age_gender_unique_Male_65;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions_by_age_gender_unique_Male_65']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_impressions_by_age_gender_unique_Male_55_64;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions_by_age_gender_unique_Male_55_64']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_impressions_by_age_gender_unique_Male_45_54;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions_by_age_gender_unique_Male_45_54']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_impressions_by_age_gender_unique_Male_35_44;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions_by_age_gender_unique_Male_35_44']);?></td>
                 </tr>
                <tr style=" background: #CDCDCD">
                     <td class="text-center"><?php  echo $x; ?></td>
                     <td class="text-center"><?php  echo $sfpi; ?></td>      
                     <td class="text-center"><?php  echo  $page_impressions_by_age_gender_unique_Male_25_34;?></td>
                     <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions_by_age_gender_unique_Male_25_34']);?></td>
                </tr>
                <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_impressions_by_age_gender_unique_Male_18_24;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions_by_age_gender_unique_Male_18_24']);?></td>
                </tr>
                <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_impressions_by_age_gender_unique_Male_13_17;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions_by_age_gender_unique_Male_13_17']);?></td>
                </tr>
                <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_impressions_by_age_gender_unique_Undefine_65;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions_by_age_gender_unique_Undefine_65']);?></td>
                 </tr> <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_impressions_by_age_gender_unique_Undefine_55_64;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions_by_age_gender_unique_Undefine_55_64']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_impressions_by_age_gender_unique_Undefine_35_44;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions_by_age_gender_unique_Undefine_35_44']);?></td>
                 </tr>
                <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_impressions_by_age_gender_unique_Undefine_25_34;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions_by_age_gender_unique_Undefine_25_34']);?></td>
                </tr>
                <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $sfpi; ?></td>      
                    <td class="text-center"><?php  echo  $page_impressions_by_age_gender_unique_Undefine_18_24;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesimp['page_impressions_by_age_gender_unique_Undefine_18_24']);?></td>
                </tr>
                     
                  
                    <?php endforeach ?>
                     
                     
                   <?php $x=null;?>  
                <?php foreach ($informes_rea as $key => $valuesrea):  $x++;?>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpr; ?></td>      
                    <td class="text-center"><?php  echo  $page_fans;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesrea['page_fans']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpr; ?></td>      
                    <td class="text-center"><?php  echo  $page_actions_post_reactions_like_total;?> </td>
                    <td class="text-left"><?php echo formatPeriod($valuesrea['page_actions_post_reactions_like_total']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpr; ?></td>      
                    <td class="text-center"><?php  echo  $page_actions_post_reactions_love_total;?> </td>
                    <td class="text-left"><?php echo formatPeriod($valuesrea['page_actions_post_reactions_love_total']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpr; ?></td>      
                    <td class="text-center"><?php  echo  $page_actions_post_reactions_wow_total;?> </td>
                    <td class="text-left"><?php echo formatPeriod($valuesrea['page_actions_post_reactions_wow_total']);?></td>
                 </tr>
                   
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpr; ?></td>      
                    <td class="text-center"><?php  echo  $page_actions_post_reactions_haha_total;?> </td>
                    <td class="text-left"><?php echo formatPeriod($valuesrea['page_actions_post_reactions_haha_total']);?></td>
                 </tr>
                   
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpr; ?></td>      
                    <td class="text-center"><?php  echo  $page_actions_post_reactions_sorry_total;?> </td>
                    <td class="text-left"><?php echo formatPeriod($valuesrea['page_actions_post_reactions_sorry_total']);?></td>
                 </tr>
                   
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpr; ?></td>      
                    <td class="text-center"><?php  echo  $page_actions_post_reactions_anger_total;?> </td>
                    <td class="text-left"><?php echo formatPeriod($valuesrea['page_actions_post_reactions_anger_total']);?></td>
                 </tr>
                   
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpr; ?></td>      
                    <td class="text-center"><?php  echo  $page_actions_post_reactions_total_like;?> </td>
                    <td class="text-left"><?php echo formatPeriod($valuesrea['page_actions_post_reactions_total_like']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpr; ?></td>      
                    <td class="text-center"><?php  echo  $page_actions_post_reactions_total_love;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesrea['page_actions_post_reactions_total_love']);?></td>
                 </tr>
                   
                   
                   <?php endforeach ?>
                <?php $x=null;?>  
                <?php foreach ($informes_user as $key => $valuesuser):  $x++;?>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfud; ?></td>      
                    <td class="text-center"><?php  echo  $page_fans;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesuser['page_fans']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfud; ?></td>      
                    <td class="text-center"><?php  echo  $page_fan_adds_unique;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesuser['page_fan_adds_unique']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfud; ?></td>      
                    <td class="text-center"><?php  echo  $page_fans_gender_age_Female_65;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesuser['page_fans_gender_age_Female_65']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfud; ?></td>      
                    <td class="text-center"><?php  echo  $page_fans_gender_age_Female_55_64;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesuser['page_fans_gender_age_Female_55_64']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfud; ?></td>      
                    <td class="text-center"><?php  echo  $page_fans_gender_age_Female_45_54;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesuser['page_fans_gender_age_Female_45_54']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfud; ?></td>      
                    <td class="text-center"><?php  echo  $page_fans_gender_age_Female_35_44;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesuser['page_fans_gender_age_Female_35_44']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfud; ?></td>      
                    <td class="text-center"><?php  echo  $page_fans_gender_age_Female_25_34;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesuser['page_fans_gender_age_Female_25_34']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfud; ?></td>      
                    <td class="text-center"><?php  echo  $page_fans_gender_age_Female_18_24;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesuser['page_fans_gender_age_Female_18_24']);?></td>
                 </tr>
                     
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfud; ?></td>      
                    <td class="text-center"><?php  echo  $page_fans_gender_age_Female_13_17;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesuser['page_fans_gender_age_Female_13_17']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfud; ?></td>      
                    <td class="text-center">page_fans_gender_age_Male_65</td>
                    <td class="text-left"><?php echo formatPeriod($valuesuser['page_fans_gender_age_Male_65']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfud; ?></td>      
                    <td class="text-center"><?php  echo  $page_fans_gender_age_Male_55_64;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesuser['page_fans_gender_age_Male_55_64']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfud; ?></td>      
                    <td class="text-center"><?php  echo  $page_fans_gender_age_Male_45_54;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesuser['page_fans_gender_age_Male_45_54']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfud; ?></td>      
                    <td class="text-center"><?php  echo  $page_fans_gender_age_Male_35_44;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesuser['page_fans_gender_age_Male_35_44']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfud; ?></td>      
                    <td class="text-center"><?php  echo  $page_fans_gender_age_Male_25_34;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesuser['page_fans_gender_age_Male_25_34']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfud; ?></td>      
                    <td class="text-center"><?php  echo  $page_fans_gender_age_Male_18_24;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesuser['page_fans_gender_age_Male_18_24']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfud; ?></td>      
                    <td class="text-center"><?php  echo  $page_fans_gender_age_Male_13_17;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesuser['page_fans_gender_age_Male_13_17']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfud; ?></td>      
                    <td class="text-center"><?php  echo  $page_fans_gender_age_Undefine_65;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesuser['page_fans_gender_age_Undefine_65']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfud; ?></td>      
                    <td class="text-center"><?php  echo  $page_fans_gender_age_Undefine_55_64;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesuser['page_fans_gender_age_Undefine_55_64']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfud; ?></td>      
                    <td class="text-center"><?php  echo  $page_fans_gender_age_Undefine_45_54;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesuser['page_fans_gender_age_Undefine_45_54']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfud; ?></td>      
                    <td class="text-center"><?php  echo  $page_fans_gender_age_Undefine_35_44;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesuser['page_fans_gender_age_Undefine_35_44']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfud; ?></td>      
                    <td class="text-center"><?php  echo  $page_fans_gender_age_Undefine_25_34;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesuser['page_fans_gender_age_Undefine_25_34']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfud; ?></td>      
                    <td class="text-center"><?php  echo  $page_fans_gender_age_Undefine_18_24;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesuser['page_fans_gender_age_Undefine_18_24']);?></td>
                 </tr>
                     
                      <?php endforeach ?>
                       <?php $x=null;?>
                <?php foreach ($informes_vid as $key => $valuesvid):  $x++;?>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpvw; ?></td>      
                    <td class="text-center"><?php  echo  $page_fans;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesvid['page_fans']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpvw; ?></td>      
                    <td class="text-center"><?php  echo  $page_video_views;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesvid['page_video_views']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpvw; ?></td>      
                    <td class="text-center"><?php  echo  $page_video_views_autoplayed;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesvid['page_video_views_autoplayed']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpvw; ?></td>      
                    <td class="text-center"><?php  echo  $page_video_repeat_views;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesvid['page_video_repeat_views']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpvw; ?></td>      
                    <td class="text-center"><?php  echo  $page_video_views_organic;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesvid['page_video_views_organic']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpvw; ?></td>      
                    <td class="text-center"><?php  echo  $page_video_views_unique;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesvid['page_video_views_unique']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpvw; ?></td>      
                    <td class="text-center"><?php  echo  $page_video_views_click_to_play;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesvid['page_video_views_click_to_play']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpvw; ?></td>      
                    <td class="text-center"><?php  echo  $page_video_views_10s_organic;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesvid['page_video_views_10s_organic']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpvw; ?></td>      
                    <td class="text-center"><?php  echo  $page_video_views_10s_click_to_play;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesvid['page_video_views_10s_click_to_play']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpvw; ?></td>      
                    <td class="text-center"><?php  echo  $page_video_views_10s_repeat;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesvid['page_video_views_10s_repeat']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpvw; ?></td>      
                    <td class="text-center"><?php  echo  $page_video_views_10s;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesvid['page_video_views_10s']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpvw; ?></td>      
                    <td class="text-center"><?php  echo  $page_video_views_10s_paid;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesvid['page_video_views_10s_paid']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpvw; ?></td>      
                    <td class="text-center"><?php  echo  $page_video_views_10s_autoplayed;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesvid['page_video_views_10s_autoplayed']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpvw; ?></td>      
                    <td class="text-center"><?php  echo  $page_video_views_10s_unique;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesvid['page_video_views_10s_unique']);?></td>
                  </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpvw; ?></td>      
                    <td class="text-center"><?php  echo  $page_video_complete_views_30s_organic;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesvid['page_video_complete_views_30s_organic']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpvw; ?></td>      
                    <td class="text-center"><?php  echo  $page_video_complete_views_30s_click_to_play;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesvid['page_video_complete_views_30s_click_to_play']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpvw; ?></td>      
                    <td class="text-center"><?php  echo  $page_video_complete_views_30s_repeat_views;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesvid['page_video_complete_views_30s_repeat_views']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpvw; ?></td>      
                    <td class="text-center"><?php  echo  $page_video_complete_views_30s;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesvid['page_video_complete_views_30s']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpvw; ?></td>      
                    <td class="text-center"><?php  echo  $page_video_complete_views_30s_paid;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesvid['page_video_complete_views_30s_paid']);?></td>
                 </tr>
                 <tr >
                     <td class="text-center"><?php  echo $x; ?></td>
                     <td class="text-center"><?php  echo $Sfpvw; ?></td>      
                     <td class="text-center"><?php  echo  $page_video_complete_views_30s_autoplayed;?></td>
                     <td class="text-left"><?php echo formatPeriod($valuesvid['page_video_complete_views_30s_autoplayed']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpvw; ?></td>      
                    <td class="text-center"><?php  echo  $page_video_complete_views_30s_unique;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesvid['page_video_complete_views_30s_unique']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpvw; ?></td>      
                    <td class="text-center"><?php  echo  $page_video_views_by_paid_non_paid_paid;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesvid['page_video_views_by_paid_non_paid_paid']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpvw; ?></td>      
                    <td class="text-center"><?php  echo  $page_video_views_by_paid_non_paid_unpaid;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesvid['page_video_views_by_paid_non_paid_unpaid']);?></td>
                 </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpvw; ?></td>      
                    <td class="text-center"><?php  echo  $page_video_views_by_paid_non_paid_total;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesvid['page_video_views_by_paid_non_paid_total']);?></td>                     </tr>
                 <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpvw; ?></td>      
                    <td class="text-center"><?php  echo  $page_video_view_time;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesvid['page_video_view_time']);?></td>
                 </tr>
                      <?php endforeach ?>
               
                     <?php $x=null;?>  
                <?php foreach ($informes_view as $key => $valuesview):  $x++;?>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpw; ?></td>      
                    <td class="text-center"><?php  echo  $page_fans;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesview['page_fans']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpw; ?></td>      
                    <td class="text-center"><?php  echo  $page_views_total;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesview['page_views_total']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpw; ?></td>      
                    <td class="text-center"><?php  echo  $page_views_logged_in_total;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesview['page_views_logged_in_total']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpw; ?></td>      
                    <td class="text-center"><?php  echo  $page_views_logged_in_unique;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesview['page_views_logged_in_unique']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpw; ?></td>      
                    <td class="text-center"><?php  echo  $page_views_external_referrals_movilair;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesview['page_views_external_referrals_movilair']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpw; ?></td>      
                    <td class="text-center"><?php  echo  $page_views_external_referrals_google;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesview['page_views_external_referrals_google']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpw; ?></td>      
                    <td class="text-center"><?php  echo  $page_views_by_profile_tab_total_photos;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesview['page_views_by_profile_tab_total_photos']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpw; ?></td>      
                    <td class="text-center"><?php  echo  $page_views_by_profile_tab_total_posts;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesview['page_views_by_profile_tab_total_posts']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpw; ?></td>      
                    <td class="text-center"><?php  echo  $page_views_by_profile_tab_total_videos;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesview['page_views_by_profile_tab_total_videos']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpw; ?></td>      
                    <td class="text-center"><?php  echo  $page_views_by_profile_tab_total_home;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesview['page_views_by_profile_tab_total_home']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpw; ?></td>      
                    <td class="text-center"><?php  echo  $page_views_by_profile_tab_total_notes;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesview['page_views_by_profile_tab_total_notes']);?></td>
                 </tr>
                 <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpw; ?></td>      
                    <td class="text-center"><?php  echo  $page_views_by_profile_tab_logged_in_unique_photos;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesview['page_views_by_profile_tab_logged_in_unique_photos']);?></td>
                 </tr>
                <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpw; ?></td>      
                    <td class="text-center"><?php  echo  $page_views_by_profile_tab_logged_in_unique_videos;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesview['page_views_by_profile_tab_logged_in_unique_videos']);?></td>
                </tr>
                <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpw; ?></td>      
                    <td class="text-center"><?php  echo  $page_views_by_profile_tab_logged_in_unique_home;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesview['page_views_by_profile_tab_logged_in_unique_home']);?></td>
                </tr>
                <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpw; ?></td>      
                    <td class="text-center"><?php  echo  $page_views_by_profile_tab_logged_in_unique_posts;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesview['page_views_by_profile_tab_logged_in_unique_posts']);?></td>
                </tr>
                <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpw; ?></td>      
                    <td class="text-center"><?php  echo  $page_views_by_internal_referer_logged_in_unique_search;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesview['page_views_by_internal_referer_logged_in_unique_search']);?></td>
                </tr>
                <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpw; ?></td>      
                    <td class="text-center"><?php  echo  $page_views_by_internal_referer_logged_in_unique_page_internal;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesview['page_views_by_internal_referer_logged_in_unique_page_internal']);?></td>
                </tr>
                <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpw; ?></td>      
                    <td class="text-center"><?php  echo  $page_views_by_internal_referer_logged_in_unique_newsfeed;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesview['page_views_by_internal_referer_logged_in_unique_newsfeed']);?></td>
                </tr>
                <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpw; ?></td>      
                    <td class="text-center"><?php  echo  $page_views_by_internal_referer_logged_in_unique_other;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesview['page_views_by_internal_referer_logged_in_unique_other']);?></td>
                </tr>
                <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpw; ?></td>      
                    <td class="text-center"><?php  echo  $page_views_by_site_logged_in_unique_www;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesview['page_views_by_site_logged_in_unique_www']);?></td>
                </tr>
                <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpw; ?></td>      
                    <td class="text-center"><?php  echo  $page_views_by_site_logged_in_unique_mobile;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesview['page_views_by_site_logged_in_unique_mobile']);?></td>
                </tr>
                <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpw; ?></td>      
                    <td class="text-center"><?php  echo  $page_views_by_site_logged_in_unique_other;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesview['page_views_by_site_logged_in_unique_other']);?></td>
                </tr>
                <tr style=" background: #CDCDCD">
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpw; ?></td>      
                    <td class="text-center"><?php  echo  $page_views_logout;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuesview['page_views_logout']);?></td>
                </tr>
                     
                     <?php endforeach ?>
                  <?php $x=null;?> 
                   <?php foreach ($informes_cta as $key => $valuescta):  $x++;?>
                <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpcc; ?></td>      
                    <td class="text-center"><?php  echo  $page_fans;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuescta['page_fans']);?></td>
                </tr>
                <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpcc; ?></td>      
                    <td class="text-center"><?php  echo  $page_total_actions;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuescta['page_total_actions']);?></td>
                </tr>
                <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpcc; ?></td>      
                    <td class="text-center"><?php  echo  $page_cta_clicks_by_site_logged_in_unique_mobile;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuescta['page_cta_clicks_by_site_logged_in_unique_mobile']);?></td>
                </tr>
                <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpcc; ?></td>      
                    <td class="text-center"><?php  echo  $page_cta_clicks_by_site_logged_in_unique_other;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuescta['page_cta_clicks_by_site_logged_in_unique_other']);?></td>
                </tr>
                <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpcc; ?></td>      
                    <td class="text-center"><?php  echo  $page_call_phone_clicks_by_site_logged_in_unique;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuescta['page_call_phone_clicks_by_site_logged_in_unique']);?></td>
                </tr>
                <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpcc; ?></td>      
                    <td class="text-center"><?php  echo  $page_get_directions_clicks_logged_in_unique;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuescta['page_get_directions_clicks_logged_in_unique']);?></td>
                </tr>
                <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpcc; ?></td>      
                    <td class="text-center"><?php  echo  $page_get_directions_clicks_by_site_logged_in_unique;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuescta['page_get_directions_clicks_by_site_logged_in_unique']);?></td>
                </tr>
                <tr >
                    <td class="text-center"><?php  echo $x; ?></td>
                    <td class="text-center"><?php  echo $Sfpcc; ?></td>      
                    <td class="text-center"><?php  echo  $page_website_clicks_by_site_logged_in_unique;?></td>
                    <td class="text-left"><?php echo formatPeriod($valuescta['page_website_clicks_by_site_logged_in_unique']);?></td>
                </tr>
                     
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
            title: '¿Estas seguro de eliminar este elemento?',
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
                    title: '¡Éxito!',
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