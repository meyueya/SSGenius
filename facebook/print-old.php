<?php
  include('../model/Database.php');
  $dbh = Database::getInstance();
  $sql = "SELECT count(valores_catalogacion),`id_post` FROM `ssg_catalogacion_post_facebook` WHERE `valores_catalogacion` in (1,11,20,8) AND `page_id`='192597304105183' GROUP BY id_post HAVING COUNT(valores_catalogacion)=4";
  $sth = $dbh->prepare($sql);
  $sth->execute();
  $array1 = $sth->fetchAll(PDO::FETCH_ASSOC);
  $array_simple=array();
  foreach ($array1 as $value) {
    $srting_post_in .= $value['id_post'].",";
  }
  $srting_post_in = rtrim($srting_post_in,',');
  echo"<pre>"; 
  print_r($array1);
  echo"</pre>"; 
  echo"<pre>"; 
  print_r($srting_post_in);
  echo"</pre>"; 

  /* echo"<pre>"; 
  var_dump($array1,$array2,$array3);
  echo"</pre>"; 
  $inter=(array_intersect ($array1, $array2));
  echo"<pre>"; 
  print_r($inter);
  echo"</pre>"; 
  $inter2=(array_intersect ($inter, $array3));
  echo"<pre>"; 
  print_r($inter2);
  echo"</pre>";  */
die();
session_start();
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
       
        
  
  
  <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://printjs-4de6.kxcdn.com/print.min.css">
  
   <script type="text/javascript">

    function printHtml() {
      printJS({
        printable: 'forprint',
        type: 'html'
      });
    }
        
    </script>

<style type="text/css">
      @page 
      {
      size: A4 ;   /* auto es el valor inicial */
      margin: 0;  /* afecta el margen en la configuración de impresión */
      size: landscape;
      }
      header, footer, nav, aside {
      display: none !important;
      }
      /* cuando vayamos a imprimir ... */
    @media print{
        
   
      body{
          transform:scale(1);
      }
        
        thead {
    display: contents!important;
}
        .card-pricing .card-icon i {
    font-size: 33px;
    width: 50px;
    border: 1px solid #fff;
    border-radius: 50%;
    height: 50px;
    line-height: 50px;
}
      /* indicamos el salto de pagina */
      .saltoDePagina{
        display:block;
        page-break-before:always;
        margin-top: 20px;
      }

      .imag {
      position: fixed;
      width: 180px;
      padding-left: 30px !important;
      top: 0;
      left: 0;
      right: 0;
      }



    .comen {

    text-align: left !important;
}
.a4{
    height: 205mm;
}



    tbody {
    font-size: 8px;
    text-align: center;
  
    }


}

.tabla tbody th, .tabla tbody td{
  padding-left: 5px;
} 


.main-panel {
    /* position: relative; */
    /* float: right; */
    width: 100%;
    background-color: #f4f3ef;
    transition: all .5s cubic-bezier(0.05, 0.99, 0.14, 0.13);
    padding: 5px;
}
h2 {
  text-align: center;
  /* margin-top: -50px */
}

.card-user{
  margin-top: 0px;
}
.card-user .avatar {
    width: 200px;
    height: 200px;
    /* border: 1px solid #fff; */
    position: relative;
    border: 2px solid #ccc;
}
img {
      padding: 20px;
}

.ellipsis {

  height: 55px;
}
.card-pricing .card-category {
    margin: 10px 0;
    color: #2c2c2c;
    font-weight: bold;

    
}
.comen {

    text-align: left !important;
 
}

.comen2 {

    /* text-align: left !important; */
    padding-left: 10px;
}

/* .card {
    margin-top: 5px;
    border: 1px solid #ccc;
} */
       </style>



</head>

<body >
    
  <div class="main-panel" id="forprint">

            <div class="card card-user saltoDePagina a4">
              <div class="image">
                <img src="https://ssgenius.com/wp-content/uploads/2018/10/cropped-logo-1.png" alt="..." class="imag">
              </div>
                <h4 id="titulo_reporte"><?= $_SESSION['titulo_reporte']?></h4>
              <div class="card-body" style="height: 75vh;">
                <div class="author">
                  <a href="#">
                    <img src="https://graph.facebook.com/<?= $_SESSION['id_page']; ?>/picture">
                    <h5 class="title">Cliente:<?= $_SESSION['id_inf']?> </h5>
                  </a>
                  <p class="description">
                      Creacion del Informe <?= $_SESSION['fecha_informe']?>
                  </p>
                  <p class="description">
                      Segmentado por <?= formatPeriod($_SESSION['periodo'])?>
                  </p>
                  <p class="description">
                      Rango de Busqueda <?= $_SESSION['fecha']?>
                  </p>

                  <p class="description text-center">
                      Comentario Principal:
                      <br>
                      <div class="comen2" id="0"></div>
                  </p>
                </div>
              </div>
              <div class="card-footer">
                <hr>
                <div class="button-container">
                  <div class="row">
                  </div>
                </div>
              </div>
            </div>
        



 <div class="card card-user saltoDePagina a4">
              <div class="image">
                <img src="https://ssgenius.com/wp-content/uploads/2018/10/cropped-logo-1.png" alt="..." class="imag">
              </div>
              <div class="card-body" style="height: 75vh;">
                <div class="author">
                  <a href="#">
                    <img src="https://graph.facebook.com/<?= $_SESSION['id_page']; ?>/picture">
                    <h5 class="title">Resumen General </h5>
                  </a>
                  <p class="description">
                      <div class="comen2" id="1">
                        </div>
                  </p>
                </div>
              </div>
              <div class="card-footer">
                <hr>
                <div class="button-container">
                  <div class="row">
                  </div>
                </div>
              </div>
            </div>
        



<div class="row saltoDePagina">
  <div class="col-md-12">
    <h2> Métricas globales:</h2>
  </div>
</div>

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
                    <li style="color:#009900; ">
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
                    <li style="color:#009900; ">
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
                    <li style="color:#009900; ">
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
                    <li style="color:#009900; ">
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
                    <li style="color:#009900; ">
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
                  <h3 class="card-title" style="margin-top: 0 !important;" id="tcominbox"></h3>
                  <p>Total Respuestas</p>
                  <h3 class="card-title" style="margin-top: 0 !important;" id="tcominboxr"></h3>
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
                    <li style="color:#009900; ">
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
                    <li style="color:#009900; ">
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
                    <li style="color:#009900; ">
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
                    <li style="color:#009900; ">
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
                    <li style="color:#009900; ">
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
                    <li style="color:#009900; ">
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
                  <h3 class="card-title" id="likesorg"></h3>
                  <ul>
                    <li style="color:#009900; ">
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
                  <h6 class="card-category">FANS ORGÁNICA</h6>
                </div>
                <div class="card-body">
                  <div class="card-icon icon-primary ">
                    <i class="nc-icon nc-share-66"></i>
                  </div>
                  <h3 class="card-title" id="likespag"></h3>
                  <ul>
                    <li style="color:#009900; ">
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
                  <h6 class="card-category">POST PUBLICADOS</h6>
                </div>
                <div class="card-body">
                  <div class="card-icon icon-primary ">
                    <i class="nc-icon nc-image"></i>
                  </div>
                  <h3 class="card-title" id="nropost"></h3>
                  <ul>
                    <li style="color:#009900; ">
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
                    <li style="color:#009900; ">
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
                  <h3 class="card-title" style="margin-top: 0 !important;" id="tcomen"></h3>
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
                  <h3 class="card-title" style="margin-top: 0 !important;"  id="tinbox"></h3>
                  <p>Total Respuestas</p>
                  <h3 class="card-title" style="margin-top: 0 !important;" id="tinboxr"></h3>
                
                </div>
               
              </div>
            </div>
           
            
</div>
          
             <div class="col-md-12">
               <div class="card card-pricing">
                 <div class="card-header">
                    <h6 class="card-category comen" >Comentarios Metricas Claves:</h6>
                  </div>
                  <div class="comen2" id="2"></div>
                </div>
              </div>
          <div class="col-md-12 saltoDePagina">

        <h2> Métricas de publicación:</h2>
          </div>

        <div class="row">
          <div id="grafica1" class="card" style="min-width: 200px; width:800px; height: 200px; "></div>
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
        


             <div class="col-md-12">
               <div class="card card-pricing">
                 <div class="card-header">
                    <h6 class="card-category comen" > Comentarios Interacción por Publicación:</h6>
                  </div>
                  <div class="comen2" id="3"></div>
                </div>
             
              </div>
            
        
        <div class="col-md-12 saltoDePagina">

            <h2> Métricas de publicación:</h2>
          </div>


          <div class="row">
          <div id="grafica2" class="card" style="min-width: 200px; width:1000px; height: 200px; "></div>
        
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

            <div class="col-md-12">
               <div class="card card-pricing">
                 <div class="card-header">
                    <h6 class="card-category comen" > Comentarios Alcance por Publicación:</h6>
                  </div>
                  <div class="comen2"  id="4"></div>
                </div>
             
              </div>
      

        
        <div class="col-md-12 saltoDePagina">

            <h2> Métricas de publicación:</h2>
          </div>
      

          <div class="row">
          <div id="grafica3" class="card" style="min-width: 200px; width:1200px; height: 200px;"></div>
        
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
       
           
            <div class="col-md-12">
               <div class="card card-pricing">
                 <div class="card-header">
                    <h6 class="card-category comen" > Comentarios Inversión por Publicación:</h6>
                  </div>
                  <div class="comen2"  id="5"></div>
                </div>
             
              </div>
         
         <div class="col-md-12 saltoDePagina">

            <h2> Métricas de publicación:</h2>
          </div>


          <div class="row">
          <div id="grafica4" class="card" style="min-width: 200px; width:1200px; height: 200px; margin:10px auto;"></div>
        
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
          

           <div class="col-md-12">
               <div class="card card-pricing">
                 <div class="card-header">
                    <h6 class="card-category comen" > Comentarios Índices de Publicación:</h6>
                  </div>
                  <div class="comen2" id="6"></div>
                </div>
             
              </div>

        


        <div class="col-md-12 saltoDePagina">

            <h2> Métricas de página:</h2>
          </div>
  

          <div class="row">
          <div class="col-md-8">
             <div class="card-body">
                <div id="container0" style="min-width: 600px;width:1000px; height: 600px; margin: 0 auto"></div>
              </div>

              <div class="form-group">
                  <div class="col-md-12">
               <div class="card card-pricing">
                 <div class="card-header">
                    <h6 class="card-category comen" > Comentario Nuevos Likes vs Dislikes:</h6>
                  </div>
                  <div class="comen2" id="7"></div>
                </div>
             
              </div>
               
              </div>


         </div>
           <div class="col-md-1">
          </div>
          <div class="col-md-3">
          <div class="tab-pane" id="link0" ></div>
          </div>
          </div>
         

        <div class="col-md-12 saltoDePagina">

            <h2> Métricas de página:</h2>
          </div>
               
          <div class="row">         
          <div class="col-md-8">
            
              <div class="card-body">
              
                <div id="container1" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
              
              </div>
              <div class="form-group">
                <div class="col-md-12">
               <div class="card card-pricing">
                 <div class="card-header">
                    <h6 class="card-category comen" > Comentario Likes vs Dislikes:</h6>
                  </div>
                  <div class="comen2" id="8"></div>
                </div>
              </div>
              </div>
          </div>
             <div class="col-md-1">
          </div>
          <div class="col-md-3">
          <div class="tab-pane" id="link1"></div>
          </div>
          </div>

          <div class="col-md-12 saltoDePagina">

            <h2> Métricas de página:</h2>
          </div>
           

          <div class="row">        
            <div class="col-md-8">
            
              <div class="card-body">
              
                <div id="container2" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
              
              </div>
            
               <div class="form-group">
                <div class="col-md-12">
               <div class="card card-pricing">
                 <div class="card-header">
                    <h6 class="card-category comen" > Comentario Crecimiento de Likes:</h6>
                  </div>
                  <div class="comen2" id="9"></div>
                </div>
              </div>
              </div>
            </div>
         <div class="col-md-1">
          </div>
          <div class="col-md-3">
          <div class="tab-pane" id="link2"></div>
          </div>
          </div>


          <div class="col-md-12 saltoDePagina">

            <h2> Métricas de página:</h2>
          </div>
          

          <div class="row">
            <div class="col-md-8">
            
              <div class="card-body">
              
                <div id="container3" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
              
              </div>
               <div class="form-group">
                <div class="col-md-12">
               <div class="card card-pricing">
                 <div class="card-header">
                    <h6 class="card-category comen" > Comentario Como se consiguieron los Likes:</h6>
                  </div>
                  <div class="comen2" id="10"></div>
                </div>
              </div>
              </div>
            </div>
           <div class="col-md-1">
          </div>
          <div class="col-md-3">
          <div class="tab-pane" id="link3"></div>
          </div>
          </div>


          <div class="col-md-12 saltoDePagina">

            <h2> Métricas de página:</h2>
          </div>

          <div class="row">          
           <div class="col-md-8">
            
              <div class="card-body">
              
                <div id="container4" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
              
              </div>
              
              <div class="form-group">
                <div class="col-md-12">
               <div class="card card-pricing">
                 <div class="card-header">
                    <h6 class="card-category comen" > Comentario Como se consiguieron los Likes Totales:</h6>
                  </div>
                  <div class="comen2" id="11"></div>
                </div>
              </div>
              </div>
            </div>
           <div class="col-md-1">
          </div>
          <div class="col-md-3">
          <div class="tab-pane" id="link3"></div>
          </div>
          
          </div>
            

            <div class="col-md-12 saltoDePagina">

            <h2> Métricas de página:</h2>
          </div>

          <div class="row"> 

           <div class="col-md-8">
            
              <div class="card-body">
              
                <div id="container5" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
              
              </div>
            
              <div class="form-group">
                <div class="col-md-12">
               <div class="card card-pricing">
                 <div class="card-header">
                    <h6 class="card-category comen" > Comentario Nuevos Fans Netos:</h6>
                  </div>
                  <div class="comen2" id="12"></div>
                </div>
              </div>
              </div>
            </div>
           <div class="col-md-1">
          </div>
          <div class="col-md-3">
          <div class="tab-pane" id="link5"></div>
          </div>
          </div>


            <div class="col-md-12 saltoDePagina">

            <h2> Métricas de página:</h2>
          </div>

          <div class="row">          
           <div class="col-md-8">
            
              <div class="card-body">
              
                <div id="container6" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
              
              </div>
              
              <div class="form-group">
                <div class="col-md-12">
               <div class="card card-pricing">
                 <div class="card-header">
                    <h6 class="card-category comen" > Comentario Perfil de likes Demográfico:</h6>
                  </div>
                  <div class="comen2" id="13"></div>
                </div>
              </div>
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

           <!-- desde aca -->

             <div class="col-md-12 saltoDePagina">

            <h2> Métricas de página:</h2>
          </div>

          <div class="row">         
            <div class="col-md-8">
            
              <div class="card-body">
              
                <div id="container7" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
              
              </div>
              <div class="form-group">
                <label> Comentario Perfil de fans Edades:</label>

              </div>
               <div class="form-group">
                <div class="col-md-12">
               <div class="card card-pricing">
                 <div class="card-header">
                    <h6 class="card-category comen" > Comentario Perfil de likes Demográfico:</h6>
                  </div>
                  <div class="comen2" id="14"></div>
                </div>
              </div>
              </div>
            </div>
         <div class="col-md-1">
          </div>
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

          
            <div class="col-md-12 saltoDePagina">

            <h2> Métricas de página:</h2>
          </div>

          <div class="row"> 
                   
          <div class="col-md-8">
            
              <div class="card-body">
              
                <div id="container8" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
              
              </div>
            
               <div class="form-group">
                <div class="col-md-12">
               <div class="card card-pricing">
                 <div class="card-header">
                    <h6 class="card-category comen" > Comentario Alcance:</h6>
                  </div>
                  <div class="comen2" id="15"></div>
                </div>
              </div>
              </div>
            </div>
           <div class="col-md-1">
          </div>
          <div class="col-md-3">
          <div class="tab-pane" id="link8"></div>
          </div>
          </div>        
          

            <div class="col-md-12 saltoDePagina">

            <h2> Métricas de página:</h2>
          </div>

          <div class="row"> 
          
            <div class="col-md-8">
            
              <div class="card-body">
              
                <div id="container9" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
              
              </div>
            
               <div class="form-group">
                <div class="col-md-12">
               <div class="card card-pricing">
                 <div class="card-header">
                    <h6 class="card-category comen" > Comentario Interacciones::</h6>
                  </div>
                  <div class="comen2" id="16"></div>
                </div>
              </div>
              </div>
            </div>
           <div class="col-md-1">
          </div>
          <div class="col-md-3">
          <div class="tab-pane" id="link9"></div>
          </div>  
                   
          </div> 

            <div class="col-md-12 saltoDePagina">

            <h2> Métricas de página:</h2>
          </div>

          <div class="row"> 
            <div class="col-md-8">
            
              <div class="card-body">
              
                <div id="container10" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
              
              </div>
           
               <div class="form-group">
                <div class="col-md-12">
               <div class="card card-pricing">
                 <div class="card-header">
                    <h6 class="card-category comen" > Comentario Likes Demográficos:</h6>
                  </div>
                  <div class="comen2" id="17"></div>
                </div>
              </div>
              </div>
            </div>
         <div class="col-md-1">
          </div>
          <div class="col-md-3">
          <div class="tab-pane" id="link10"></div>
          </div>
           </div>        


             <div class="col-md-12 saltoDePagina">

            <h2> Métricas de página:</h2>
          </div>

          <div class="row">  
           <div class="col-md-8">
            
              <div class="card-body">
              
                <div id="container11" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
              
              </div>
            
               <div class="form-group">
                <div class="col-md-12">
               <div class="card card-pricing">
                 <div class="card-header">
                    <h6 class="card-category comen" > Comentario Fans Online:</h6>
                  </div>
                  <div class="comen2" id="18"></div>
                </div>
              </div>
              </div>
            </div>
       <div class="col-md-1">
          </div>
          <div class="col-md-3">
          <div class="tab-pane" id="link11"></div>
          </div>
          </div>


             <div class="col-md-12 saltoDePagina">

            <h2> Métricas de página:</h2>
          </div>

          <div class="row">         
            <div class="col-md-8">
            
              <div class="card-body">
              
                <div id="container12" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
              
              </div>
             
               <div class="form-group">
                <div class="col-md-12">
               <div class="card card-pricing">
                 <div class="card-header">
                    <h6 class="card-category comen" > Comentario Engaged users vs Engagement rate:</h6>
                  </div>
                  <div class="comen2" id="19"></div>
                </div>
              </div>
              </div>
            </div>
           <div class="col-md-1">
          </div>
          <div class="col-md-3">
          <div class="tab-pane" id="link12"></div>
          </div>
          </div>


            <div class="col-md-12 saltoDePagina">

            <h2> Métricas de página:</h2>
          </div>

          <div class="row">       
          <div class="col-md-8">
            
              <div class="card-body">
              
                <div id="container13" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
              
              </div>
         
               <div class="form-group">
                <div class="col-md-12">
               <div class="card card-pricing">
                 <div class="card-header">
                    <h6 class="card-category comen" > Comentario Alcance promedio vs Engagement rate:</h6>
                  </div>
                  <div class="comen2" id="20"></div>
                </div>
              </div>
              </div>
            </div>
           <div class="col-md-1">
          </div>
          <div class="col-md-3">

          <div class="tab-pane" id="link13"></div>
          </div>        
          </div>

            
          <div class="col-md-12 saltoDePagina">
            <h2> Métricas de página:</h2>
          </div>



          <div class="row">
            <div class="col-md-8">
              <div class="card-body">
                <div id="container14" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
              </div>
              <div class="form-group">
               <div class="col-md-12">
                <div class="card card-pricing">
                 <div class="card-header">
                    <h6 class="card-category comen" > Comentario Likes Demográficos Cantidad:</h6>
                 </div>
                 <div class="comen2" id="21"></div>
                </div>
               </div>
              </div>
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-3">
             <div class="tab-pane" id="link14"></div>
            </div>
          </div>



          <div class="row">
            <div class="col-md-8">
              <div class="card-body">
                <div id="container20" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
              </div>
              <div class="form-group">
               <div class="col-md-12">
                <div class="card card-pricing">
                 <div class="card-header">
                    <h6 class="card-category comen" > Comentario impresione:</h6>
                 </div>
                 <div class="comen2" id="22"></div>
                </div>
               </div>
              </div>
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-3">
             <div class="tab-pane" id="link20"></div>
            </div>
          </div>



          <div class="row">
            <div class="col-md-8">
              <div class="card-body">
                <div id="container21" style="min-width: 600px; height: 600px; margin: 0 auto"></div>
              </div>
              <div class="form-group">
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
            <div class="col-md-1">
            </div>
            <div class="col-md-3">
             <div class="tab-pane" id="link21"></div>
            </div>
          </div>
          
                    
        
</div>
  

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

  <script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>



<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
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
</body>
 

</html>