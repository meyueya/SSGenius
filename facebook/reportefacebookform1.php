<?php
include('../auth.php');


$f = date("m");

$nanuncio=$_GET['nanuncio'];
$camp=$_GET['camp'];


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
    $fecha="date_start BETWEEN '$desde' and '$hasta'";
    }

    if ($meses>=1){
    $factor=$meses+1;
    $inicio="$y-".$f."-01";
    $fin="$y2-".$f."-31";
    $fecha="date_start BETWEEN '$desde' and '$hasta'";
    }
    
    
    }
    else{
    $fecha="";
    }

    if($_POST['anuncio']!='0'){
      $anuncio="AND ad_name='".$_POST['anuncio']."'";
    }
    else{
    $anuncio="";
    }

    if($_POST['camp']!='0'){
      $campp="AND campaign_name='".$_POST['camp']."'";

    }
    else{
    $campp="";
    } 

     $result = mysql_query("select a.`date_start`,a.`ad_id`, b.`ad_id`,a.`campaign_name`,a.`ad_name`,a.`age`,a.`gender`,sum(a.`impressions`) as impressions,sum(a.`clicks`) as clicks,sum(a.`spend`) as spend, COUNT(a.`ad_name`) as totalcampos, b.`thumbnail_url`, b.`effective_object_story_id` from aiw_facebook_data_ads as a, ad_creative_facebook as b WHERE ".$fecha."".$anuncio."".$campp." AND  b.`ad_id`=a.`ad_id`  group by a.`ad_name` having count(*) > 0");


 
    $result4 = mysql_query("SELECT COUNT(*) as totala FROM `aiw_facebook_data_ads` where `date_start` BETWEEN '".$desde."' AND '".$hasta."'");
    $result5 = mysql_query("SELECT COUNT(*) as totalof FROM `cliente` where a!='1' and b!='4' AND `fecha_registro` BETWEEN '".$desde."' AND '".$hasta."'");
    $row5 = mysql_fetch_array($result5);
    $otrosform=$row5['totalof'];
    $row4 = mysql_fetch_array($result4);
    $costom=($factor*850)/$row4['totala'];
   // echo $otrosform." SELECT COUNT(*) as totala FROM `reportefacebook2` where `date_start` BETWEEN '".$desde."' AND '".$hasta."'";
   
    }




    else{
         // $result = mysql_query("select * from reportefacebook2 where date_start BETWEEN '".$inicio."' and '".$fin."' order by id asc");
      }
 

    $result2 = mysql_query("SELECT DISTINCT campaign_name FROM aiw_facebook_data_ads where date_start BETWEEN '".$inicio."' and '".$fin."'");
    $result3 = mysql_query("SELECT DISTINCT ad_name FROM aiw_facebook_data_ads where date_start BETWEEN '".$inicio."' and '".$fin."'");
    $result4 = mysql_query("SELECT COUNT(*) as totala FROM `aiw_facebook_data_ads` where date_start BETWEEN '".$inicio."' and '".$hasta."'");
    $row4 = mysql_fetch_array($result4);
    //$costom=850/$row4['totala'];

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
            <a class="navbar-brand" href="#pablo">Reporte Facebook Demográfico</a>
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
     

        <form id="miform" method="post" name="miform" action="reportefacebookform1.php">
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
                if($row2 = mysql_fetch_array($result2)){
                  do{
                      $b++; 
                      $a=$b;
                      echo '<option value="'.$row2['campaign_name'].'">'.$a." ".$row2['campaign_name'].'</option>';
                        }while($row2 = mysql_fetch_array($result2));
                      }else{
                      }
                    ?>
                  </select>
                </div>
              </div>
           
          </div>
          <div class="col-md-2">
              <div class="form-group">
                <p> Anuncios:</p>

                <div class="input-group">
                  <select name="anuncio" id="anuncio" class="form-control pull-left" >
                  <option value="0" selected>Selecione Anuncio:</option>
                   <?php
                   if($row3 = mysql_fetch_array($result3)){
                   do{
                      $b++; 
                      $a=$b;
                      echo '<option value="'.$row3['ad_name'].'">'.$a." ".$row3['ad_name'].'</option>';
                        }while($row3 = mysql_fetch_array($result3));
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
                
             <div class="col-md-5">          
             <button type="submit" name="greport" id="greport" value="GREPORT"  class="btn btn-success" style="float: right; margin-top: 36px;"><i class="fa fa-print"></i> Generar Reporte</button>
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
                  <th>Nombre Anuncio</th>
                  <th>Tipo Anuncio</th>
                  <th>Formularios</th>
                  <th>Impresiones</th>
                  <th>Clic</th>
                  <th>CTR</th>
                  <th>Clic por Formulario (%)</th>
                  <th>En Proceso</th>
                  <th>Interesados</th>
                  <th>Vendidos</th>
                  <th>Inv. por Formulario</th>
                  <th> Inversión sin impuestos y comision </th>
                  <th> Inversión </th>
                  
                
                </tr>
                </thead>
                 <tbody>
                
                   <?php
                //   echo "select a.`date_start`,a.`ad_id`, b.`ad_id`,a.`campaign_name`,a.`ad_name`,a.`age`,a.`gender`,sum(a.`impressions`) as impressions,sum(a.`clicks`) as clicks,sum(a.`spend`) as spend, COUNT(a.`ad_name`) as totalcampos, b.`thumbnail_url`, b.`effective_object_story_id` from aiw_facebook_data_ads as a, ad_creative_facebook as b WHERE ".$fecha."".$anuncio."".$campp." AND  b.`ad_id`=a.`ad_id`  group by a.`ad_name` having count(*) > 0";

                  $x=1;
                  if($row = mysql_fetch_array($result)){
                  do{
                    $totalcosto=$costom*$row['totalcampos'];
                    $fecha = date("d-m-Y",strtotime($row['date_start']));
                    $gastos = ((((($row['spend'] * 3.60)+$totalcosto) / 0.7) / 0.94) / 0.91);
                    

                    if($row['gender']=='female'){ $genero="Mujer";}
                    elseif($row['gender']=='male'){ $genero="Hombre";}
                    elseif($row['gender']=='unknown'){ $genero="Sin Clasificar";}
                    $ctr = round(($row['clicks'] / $row['impressions']) * 100, 2);
                    $tctr+=$ctr;
                    $ad = explode("-",$row['ad_name']);
                    $modelo=$ad[0];
                    $camp=$ad[1];
                    $nad=(int)$ad[2];
                   // echo "Modelo: ".$modelo." Campa: ".$camp." Nro. Anuncio: ".$nad."<br/>";
                    $result_b3 = mysql_query("SELECT COUNT(*) as totalf FROM `cliente` WHERE `modelo`='$modelo' AND a='1' AND b='$camp' and c='$nad' and fecha_registro BETWEEN '".$desde."' AND '".$hasta."'");
                    $rowf = mysql_fetch_array($result_b3);
                    $totalf= $rowf['totalf'];
                    
                    $result_b4 = mysql_query("SELECT COUNT(*) as totalfi FROM `cliente` WHERE `modelo`='$modelo' AND a='1' AND b='$camp' and c='$nad' and fecha_registro BETWEEN '".$desde."' AND '".$hasta."' AND `estado`='C59'");
                    $rowfi = mysql_fetch_array($result_b4);
                    $totalfi= $rowfi['totalfi'];
                    
                    $result_b5 = mysql_query("SELECT COUNT(*) as totalfp FROM `cliente` WHERE `modelo`='$modelo' AND a='1' AND b='$camp' and c='$nad' and fecha_registro BETWEEN '".$desde."' AND '".$hasta."' AND `estado`='C41'");
                    $rowfp = mysql_fetch_array($result_b5);
                    $totalfp= $rowfp['totalfp'];
                    
                    $result_b6 = mysql_query("SELECT COUNT(*) as totalfv FROM `cliente` WHERE `modelo`='$modelo' AND a='1' AND b='$camp' and c='$nad' and fecha_registro BETWEEN '".$desde."' AND '".$hasta."' AND `estado`='C82'");
                    $rowfv = mysql_fetch_array($result_b6);
                    $totalfv= $rowfv['totalfv'];
                    
                    $result_b7 = mysql_query("SELECT * FROM `campana` WHERE a='1' AND b='$camp'");
                    $rowta = mysql_fetch_array($result_b7);
                    $tipoanuncio= $rowta['NombreCampana'];
                    
                    
                    $fecha1 = date("d-m-Y",strtotime($desde));
                    $fecha2 = date("d-m-Y",strtotime($hasta));
                  
                    $url="https://www.facebook.com/".$row['effective_object_story_id'];
                  ?>
                  <!--<a href="reportefacebook.php?camp=<?php echo $row['campaign_name'];?>">   <a href="reportefacebook.php?nanuncio=<?php echo $row['ad_name'];?>">-->
                  <tr>
                      
                  <td><?php echo $x; ?></a></td>
                  <td style="width: 10px;  font-size: 11px;"><strong><?php echo $fecha1."  ".$fecha2; ?></strong></td>
                  <td><?php echo $row['campaign_name'];?></td>
                  <td><a href="<?php echo $url;?>" target="_blank"><img src="<?php echo $row['thumbnail_url'];?>"></a><?php echo $row['ad_name']; ?></td>
                  <td><?php echo $tipoanuncio; ?></td>
                  <td><?php echo $totalf; ?></td>
                  <td><?php echo $row['impressions']; ?></td>
                  <td><?php echo $row['clicks']; ?></td>
                  <td><?php echo $ctr; ?></td>
                  <td><?php echo round(($totalf / $row['clicks']) * 100, 2)." %"; ?></td>
                  <td><?php echo $totalfp; ?></td>
                  <td><?php echo $totalfi; ?></td>
                  <td><?php echo $totalfv; ?></td>
                  <td><?php echo "S/. ".number_format($gastos/$totalf, 2,',','.');?></td>
                  <td><?php echo "S/. ".number_format($gastos-($gastos*0.36), 2,',','.');?></td>
                  <td><?php echo "S/. ".number_format($gastos, 2,',','.');?></td>
                  
                 
                  </tr>
                    
                        <?php
                        $x++;
                        $costo+=$gastos;
                        $impressions+=$row['impressions'];
                        $clicks+=$row['clicks'];
                        $totalform+=$totalf;
                        $totalformp+=$totalfp;
                        $totalformi+=$totalfi;
                        $totalformv+=$totalfv;
               }while($row = mysql_fetch_array($result));
                    }
                    $result_form = mysql_query("SELECT COUNT(*) as form, a FROM `cliente` WHERE a!='1' AND b!='4' and fecha_registro BETWEEN '".$desde."' AND '".$hasta."' group by `a` having count(*) > 0");

                    if($row6 = mysql_fetch_array($result_form)){
                  do{
                    
                    if($row6['a']=='5'){
                        
                    $result_b4 = mysql_query("SELECT COUNT(*) as totalfi FROM `cliente` WHERE a='5' and fecha_registro BETWEEN '".$desde."' AND '".$hasta."' AND `estado`='C59'");
                    $rowfi = mysql_fetch_array($result_b4);
                    $totalfi2+= $rowfi['totalfi'];
                    
                    $result_b5 = mysql_query("SELECT COUNT(*) as totalfp FROM `cliente` WHERE a='5' and fecha_registro BETWEEN '".$desde."' AND '".$hasta."' AND `estado`='C41'");
                    $rowfp = mysql_fetch_array($result_b5);
                    $totalfp2+= $rowfp['totalfp'];
                    
                    $result_b6 = mysql_query("SELECT COUNT(*) as totalfv FROM `cliente` WHERE a='5' and fecha_registro BETWEEN '".$desde."' AND '".$hasta."' AND `estado`='C82'");
                    $rowfv = mysql_fetch_array($result_b6);
                    $totalfv2+= $rowfv['totalfv'];
                    
                        $campana="Enlaces Directos";
                    }
                    
                    if($row6['a']=='4'){
                        
                    $result_b4 = mysql_query("SELECT COUNT(*) as totalfi FROM `cliente` WHERE a='4' and fecha_registro BETWEEN '".$desde."' AND '".$hasta."' AND `estado`='C59'");
                    $rowfi = mysql_fetch_array($result_b4);
                    $totalfi2+= $rowfi['totalfi'];
                    
                    $result_b5 = mysql_query("SELECT COUNT(*) as totalfp FROM `cliente` WHERE a='4' and fecha_registro BETWEEN '".$desde."' AND '".$hasta."' AND `estado`='C41'");
                    $rowfp = mysql_fetch_array($result_b5);
                    $totalfp2+= $rowfp['totalfp'];
                    
                    $result_b6 = mysql_query("SELECT COUNT(*) as totalfv FROM `cliente` WHERE a='4' and fecha_registro BETWEEN '".$desde."' AND '".$hasta."' AND `estado`='C82'");
                    $rowfv = mysql_fetch_array($result_b6);
                    $totalfv2+= $rowfv['totalfv'];
                        $campana="Facebook Page";
                    }
                    
                    if($row6['a']=='12'){
                        
                    $result_b4 = mysql_query("SELECT COUNT(*) as totalfi FROM `cliente` WHERE a='12' and fecha_registro BETWEEN '".$desde."' AND '".$hasta."' AND `estado`='C59'");
                    $rowfi = mysql_fetch_array($result_b4);
                    $totalfi2+= $rowfi['totalfi'];
                    
                    $result_b5 = mysql_query("SELECT COUNT(*) as totalfp FROM `cliente` WHERE a='12' and fecha_registro BETWEEN '".$desde."' AND '".$hasta."' AND `estado`='C41'");
                    $rowfp = mysql_fetch_array($result_b5);
                    $totalfp2+= $rowfp['totalfp'];
                    
                    $result_b6 = mysql_query("SELECT COUNT(*) as totalfv FROM `cliente` WHERE a='12' and fecha_registro BETWEEN '".$desde."' AND '".$hasta."' AND `estado`='C82'");
                    $rowfv = mysql_fetch_array($result_b6);
                    $totalfv2+= $rowfv['totalfv'];
                        $campana="Mailing ";
                    }
                  ?>
                  <!--<a href="reportefacebook.php?camp=<?php echo $row['campaign_name'];?>">   <a href="reportefacebook.php?nanuncio=<?php echo $row['ad_name'];?>">-->
                  <tr>
                  <td><?php echo $x; ?></a></td>
                  <td style="width: 10px;  font-size: 11px;"><strong><?php echo $fecha1."  ".$fecha2; ?></strong></td>
                  <td><strong><?php echo $campana;?></strong></td>
                  <td></td>
                  <td></td>
                  <td><?php echo $row6['form']; ?></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>0</td>
                  <td><?php echo $totalfi2; ?></td>
                  <td>0</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  </tr>

                        <?php
                        $x++;
                        $costo+=$gastos;
                        $impressions+=$row['impressions'];
                        $clicks+=$row['clicks'];
                        $totalform+=$row6['form'];
                        $totalformp+=$totalfp2;
                        $totalformi+=$totalfi2;
                        $totalformv+=$totalfv2;
                        $totalfv2=0;
                        $totalfi2=0;
                        $totalfp2=0;
               }while($row6 = mysql_fetch_array($result_form));
                    }
                    
                    $cxform=round(($costo/($totalform+$otrosform)),2);
                     $costo=round($costo,2);
                      $clic_perc_form = round(($totalform / $clicks) * 100, 2);
                        ?>


                </tbody> 

                 <tfoot style="text-align: right;">
                 <tr>
                 
                  <td></td>
                  
                  
                  <td><strong></strong></td>
                  <td><strong></strong></td>
                  <td><strong></strong></td>
                  <td><strong> TOTAL</strong></td>
                  
                  <td><strong><?php echo number_format($totalform, 0,',','.'); ?></strong></td>
                  <td><strong><?php echo number_format($impressions, 0,',','.'); ?></strong></td>
                  <td><strong><?php echo number_format($clicks, 0,',','.'); ?></strong></td>
                  <td><strong><?php echo round((($clicks/$impressions)*100),2); ?></strong></td>
                  <td><strong><?php echo $clic_perc_form." %"; ?></strong></td>
                  <td><strong><?php echo number_format($totalformp, 0,',','.'); ?></strong></td>
                  <td><strong><?php echo number_format($totalformi, 0,',','.'); ?></strong></td>
                  <td><strong><?php echo number_format($totalformv, 0,',','.'); ?></strong></td>
                  <td><strong><?php echo "S/. ".number_format($cxform, 2,',','.'); ?></strong></td>
                  <td><strong><?php echo "S/. ".number_format($costo-($costo*0.36), 2,',','.'); ?></strong></td>
                  <td><strong><?php echo "S/. ".number_format($costo, 2,',','.'); ?></strong></td>
                  
                
                  
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
    pageLength: 15,
    buttons: [{
      extend: 'excel',
      title: 'Reporte Facabook ILCB',
      filename: 'reportefacebook_ilcb'
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
$('#fdf').addClass("active");
</script>
</body>


<!-- Mirrored from demos.creative-tim.com/paper-dashboard-2-pro/examples/components/panels.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Aug 2018 16:06:47 GMT -->
</html>