<?php
// Pass session data over. Only needed if not already passed by another script like WordPress.

require_once('inclu.php');


if (isset($_GET['edit'])) {
  include('controller/getData.php');
  $infoa=traerConsultoria($connection , $_GET['edit']); 
  $infoactual=json_encode($infoa);
  $boton_enviar='Update';
}else{
  $infoactual=null;
  $boton_enviar='Finish';
}

if(isset($_POST['daterange-btn'])){
    $desdehasta = explode(" - ", $_POST['daterange-btn']);
    $desde=date("Y-m-d",strtotime($desdehasta[0]));
    $hasta=date("Y-m-d",strtotime($desdehasta[1]));
    $d=date("Y/m/d",strtotime($desdehasta[0]));
    $h=date("Y/m/d",strtotime($desdehasta[1]));
}
?>
<!doctype html> 
<html lang="en" dir="ltr">
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<meta name="msapplication-TileColor" content="#0061da">
		<meta name="theme-color" content="#1643a3">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<link rel="icon" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" sizes="32x32" />
        <link rel="icon" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" sizes="192x192" />
        <link rel="apple-touch-icon-precomposed" href="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" />
        <meta name="msapplication-TileImage" content="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png" />

		<!-- Title -->
		<title>SSG</title>
		<link rel="stylesheet" href="../../assets/fonts/fonts/font-awesome.min.css">

		<!-- Font Family-->
		<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">

		<!-- Dashboard Css -->
		<link href="../../assets/css/dashboard.css" rel="stylesheet" />

		<!-- c3.js Charts Plugin -->
		<link href="../../assets/plugins/charts-c3/c3-chart.css" rel="stylesheet" />

		<!-- Custom scroll bar css-->
		<link href="../../assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet" />

		<!-- Sidemenu Css -->
		<link href="../../assets/plugins/toggle-sidebar/css/sidemenu.css" rel="stylesheet">

		<!---Font icons-->
		<link href="../../assets/plugins/iconfonts/plugin.css" rel="stylesheet" />
	

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
 .card-text{
   text-align: center;
 }   

 p {
    margin-top: 0;
     margin-bottom: 5px; 
    
}  

.card {
    margin: 5px;
    border: 1px solid #ccc;
}


.card label {
    font-size: .7142em;
    /* margin-bottom: 5px; */
    color: #807b7b;
}

.trans{

  display: flex;
  justify-content: center;
}

.card-wizard .card-title+.description, .h5, h5, .btn   {
  margin: 0;
}

.main-panel>.content {
    padding: 0;
    /* min-height: calc(100vh - 123px); */
    margin-top: 72px;
}






		    .app-content .side-app {
    padding: 42px 0px 0 0px;
}
.ap-social-icon {
    min-width: 10px;
    max-width: 10px;
    min-height: 10px;
    max-height: 10px;
    position:relative;
    top:19px;
    left:-10px;
    background-size: 100%;
    background-repeat: no-repeat;
    -ms-flex-negative: 0;
    flex-shrink: 0;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-font-smoothing: antialiased;    
}
.ap-social-icon.facebook {
    background-image: url(https://ssgenius.com/app/assets/images/facebook-icon.png);
}

		</style>
	</head>
	<body class="app sidebar-mini rtl" >
		<div id="global-loader" ></div>
		<div class="page">
			<div class="page-main">
				
			<?php include('menu.php'); ?>


				<div class="app-content my-3 my-md-5">
					<div class="side-app">
					


					

					
      <div class="content">





         <div class="col-md-12 mr-auto ml-auto">
          <!--      Wizard container        -->
          <div class="wizard-container">
            <div class="card card-wizard" data-color="primary" id="wizardProfile">
            <!--   <form action="#" method=""> -->
                <!--        You can switch " data-color="primary" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
                                                          <div class="card-header text-center">
                                                            <h3 class="card-title">
                                                              Consultoría SSG
                                                            </h3>
                                                            <h5 class="description"> Fecha:</h5>



                                                          <!-- Inicio Fecha  -->
                                                          <div class="row">
                                                          
                                                          <div class="col-md-12 trans">
                                                        <div class="form-group">
                                                           

                                                          <div class="input-group">

                                                            <input  class="btn btn-default pull-right" name="daterange-btn" id="daterange-btn" value="<?php echo $_POST['daterange-btn']; ?>" autocomplete="off">
                                                            </input>
                                                            <input  name="dpag" id="dpag" type="hidden" value="<?php echo $_POST['daterange-btn']; ?>"></input>
                                                            </div>


                                                          </div>
                                                          </div>
                                                          </div>
                                                          <!-- Fin Fecha -->



                                                          <!--  class="wizard-navigation" id="rootwizard" -->
                                                            <div class="wizard-navigation" id="rootwizard">
                                                              <ul>
                                                                <li class="nav-item analisis">
                                                                  <a class="nav-link active" href="#analisis1" data-toggle="tab" role="tab" aria-controls="analisis1" aria-selected="true">
                                                                    <!-- <i class="nc-icon nc-single-02"></i>  -->Analisis #1
                                                                  </a>
                                                                </li>
                                                                <li class="nav-item" id="lista_de_analisis">
                                                                  <a class="nav-link" href="#address" data-toggle="tab" role="tab" aria-controls="address" aria-selected="true">
                                                                    <!-- <i class="nc-icon nc-pin-3"></i> --> Enviar
                                                                  </a>
                                                                </li>
                                                              </ul>
                                                            </div>
                                                          </div>


                   <div class="card-body">
                     <div class="tab-content" id="pantillas_analisis">
                      <div class="tab-pane show active" id="analisis1">       
                        <div class="row justify-content-center">
                          <div class="row">
                          Título Análisis #1:<input type="text" name="titulo_analisis1" id="titulo_analisis1">
                          </div>
                                            <div class="row">
                                            <div class="col-md-6">
                                             <div class="card">
                                                  <div class="card-header">
                                                    <div class="card-text">
                                                      <h4 class="card-title">Tipos y Objetivos #1</h4>
                                                      <p class="card-category">Tipos de Publicasiones y sus objetivos</p>
                                                    </div>
                                                  </div>
                                                  <div class="card-body">
                                                          <div class="row">

                                                            <div class="col-md-6">                   
                                                              <h4 class="card-title" style="margin-top: 0; text-align: center;"> Tipos</h4>  
                                                              <div class="row" id="tipos1">
                                                              </div>                       
                                                            </div>
                                                            <div class="col-md-6">
                                                              <h4 class="card-title" style="margin-top: 0; text-align: center;"> Objetivos</h4>
                                                              <div class="row" id="obj1">
                                                              </div> 
                                                            </div>
                                                         
                                                          </div>
                                                           
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="col-md-6">
                                             <div class="card">
                                                  <div class="card-header">
                                                    <div class="card-text">
                                                      <h4 class="card-title">KPI</h4>
                                                      <p class="card-category">Key Performance Indicators</p>
                                                    </div>
                                                  </div>
                                                  <div class="card-body">
                                                      <div class="row"  id="kpi1">
                                                      </div>
                                                  </div>
                                                </div>
                                              </div>

                                            </div>


                        </div>
                      </div>
                     </div>
                   </div>

                <div class="card-footer">
                  <div class="pull-right">
                    <input type="hidden" id="update_consul">
                    <input type='button' class='btn btn-success' name='new' value='New' onclick="nuevo_analisis()" />
                    <!-- <input type='button' class='btn btn-next btn-fill btn-rose btn-wd' name='next' value='Next' /> -->
                    <input type='button' class='btn btn-finish btn-fill btn-rose btn-wd' name='finish' value='<?=$boton_enviar?>' onclick="GuardarParametros()" />
               
                  </div>
                  <div class="pull-left">
                    <!-- <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' /> -->
                  </div>
                  <div class="clearfix"></div>
                </div>
             <!--  </form> -->
            </div>
          </div>
          <!-- wizard container -->
 















    </div>
  </div>







				
					</div>
					<!--footer-->
					<footer class="footer">
						<div class="container">
							<div class="row align-items-center flex-row-reverse">
								<div class="col-lg-12 col-sm-12 mt-3 mt-lg-0 text-center">
									Copyright © 2018 <a href="#">SSG</a> All rights reserved.
								</div>
							</div>
						</div>
					</footer>
					<!-- End Footer-->
				</div>
			</div>
		</div>

		<!-- Dashboard js -->
		<script src="../../assets/js/vendors/jquery-3.2.1.min.js"></script>
		<script src="../../assets/js/vendors/bootstrap.bundle.min.js"></script>
		<script src="../../assets/js/vendors/jquery.sparkline.min.js"></script>
		<script src="../../assets/js/vendors/selectize.min.js"></script>
		<script src="../../assets/js/vendors/jquery.tablesorter.min.js"></script>
		<script src="../../assets/js/vendors/circle-progress.min.js"></script>
		<script src="../../assets/plugins/rating/jquery.rating-stars.js"></script>

		<!-- Fullside-menu Js-->
		<script src="../../assets/plugins/toggle-sidebar/js/sidemenu.js"></script>

		<!-- Custom scroll bar Js-->
		<script src="../../assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>
		<!-- Custom Js-->
		<script src="../../assets/js/custom.js"></script>
	</body>
</html>