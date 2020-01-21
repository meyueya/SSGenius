<?php
session_start();
define("NIVEL_MIN_PERMISO",4);
require_once('controller/user.php');
include('../model/ProductosModel.php');
$ProductosModel= new ProductosModel;
$array_productos= $ProductosModel->getInfoProductos();
if(isset($pages)){
    foreach($pages as $page){
        if($page["id_facebook_page"]==$_SESSION['psid']){
            $nombre_pagina=$page['name'];
        }
    }
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
    Productos
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

/*img.imgface  {
    border-radius: 10px !important;
    width: 81px !important;
}

.cont{
  font-size: 16px;
}*/
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

      <div class="content">
            <div class="row" style="height: 20px;"></div>
        <div class="col-md-12">
            <div class="card">
            <div class="container-fluid" >
                <div class="row">
                    <div style="margin-top: 15px;" class="col-6 text-center">
                        <!-- <?= $nombre_pagina ?> -->
                    </div>
                    <div class="col-6 text-right">
                        <button style="margin-top: 15px; margin-right: 30px;" class="btn btn-success btn-round btn-icon btn-sm" onclick="newRecord()">
                            <i class="nc-icon nc-simple-add"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
        <form id="miform" method="post" name="miform" action="reportegoogle.php">
                <div class="table-responsive">
            <table id="example1" class="cell-border compact stripe">
                <thead style="text-align: center;">
                <tr>
                  <th> Nombre </th> 
                  <th> Descripción</th>
                  <th> Accion</th>
                </tr>
                </thead>
                 <tbody>
                <?php foreach ($array_productos as $key => $value): ?>
                <tr data-id=<?= $value['id']?>>   
                    <td class="name"><?= $value['name'];?></td>
                    <td class="description"><?= $value['description'];?></td> 
                    <td class="text-center">
                    <a href="admin-relaciones-producto.php?product_id=<?= $value['id']?>" class="btn btn-info">
                     administrar relaciones
                    </a>  
                    <button type="button" rel="tooltip" class="btn btn-warning" onclick=updateRecord(<?= $value['id']?>)>
                            <i class="material-icons">edit</i>
                    </button>    
                    <button type="button" rel="tooltip" class="btn btn-danger" onclick=deleteRecord(<?= $value['id']?>)>
                            <i class="material-icons">delete</i>
                    </button>    
                    </td>
                </tr>
                <?php endforeach?>               
                </tbody> 
              </table>
              <?php // var_dump( $informes) ?>
                </div>
              </div>
            </div>
        </div>
</form>

<!-- add Modal -->

<div class="modal fade" id="addRecord" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-signup" role="document">
      <div class="modal-content">
        <div class="card card-signup card-plain">
          <div class="modal-header">
            <div class="row">
                <div class="col">
                    <h5 class="modal-title card-title">Crear Producto</h5>
                </div>
                <div class="col text-right">
                    <i class="nc-icon nc-simple-remove">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    </i>
                </div>
            </div>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12 ml-auto">
                  <form method="POST" action="controller/productosController.php">
                        <div class="form-group">
                          <input type="hidden" class="form-control" name="create_product" value="crear" > 
                          <label for="exampleFormControlInput1">Nombre</label>
                          <input type="text" class="form-control" name="name" placeholder="" required> 
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlInput1">Descripción</label><br>
                          <textarea name="description" class="form-control" id="" placeholder="describe el producto (puedes omitir esto)"></textarea>
                        </div>
    <!-- 
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Grupo</label>
                            <select class="form-control selectpicker" data-style="btn btn-link" name="grupo" required>
                                <option value=""></option>
                                <?php foreach ($grupos as $key => $value): ?>
                                <option value="<?= $value['grupo'];?>"><?= $value['grupo'];?></option>
                                <?php endforeach?>               
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Estado</label>
                            <select class="form-control selectpicker" data-style="btn btn-link" name="status" required>
                                <option value=""></option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div> -->
                      <button type="submit" class="btn btn-fill btn-rose">Crear<div class="ripple-container"></div></button> 
                    </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!--  Modal --> 
<!-- update Modal -->

<div class="modal fade" id="updateRecord" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-signup" role="document">
      <div class="modal-content">
        <div class="card card-signup card-plain">
          <div class="modal-header">
            <div class="row">
                <div class="col">
                    <h5 class="modal-title card-title">Actualizar Producto</h5>
                </div>
                <div class="col text-right">
                    <i class="nc-icon nc-simple-remove">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    </i>
                </div>
            </div>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12 ml-auto">
                  <form method="POST" action="controller/productosController.php">
                      <input type="hidden" name="id_update" id='update'>
                      <div class="form-group">
                          <label for="exampleFormControlInput1">Nombre</label>
                          <input type="text" class="form-control" id="update_name" name="name" placeholder="" required> 
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlInput1">Descripción</label><br>
                          <textarea name="description" id="update_description" class="form-control" id="" placeholder="describe el producto (puedes omitir esto)"></textarea>
                        </div>
                      <!-- <input type="hidden" name="page_id" value="<?= $_GET['psid']?>" >                       
                      <div class="form-group">
                          <label for="exampleFormControlInput1">Nombre</label>
                          <input type="text" class="form-control" name="nombre" placeholder="" id="update_nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Grupo</label>
                            <select class="form-control selectpicker" data-style="btn btn-link" name="grupo" id="update_grupo" required>
                                <option value=""></option>
                                <?php foreach ($grupos as $key => $value): ?>
                                <option value="<?= $value['grupo'];?>"><?= $value['grupo'];?></option>
                                <?php endforeach?>               
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Estado</label>
                            <select class="form-control selectpicker" data-style="btn btn-link" name="status" id="update_status" required>
                                <option value=""></option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div> -->
                      <button type="submit" class="btn btn-fill btn-primary">Actualizar<div class="ripple-container"></div></button>
                    </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!--  Modal -->

<!-- Large modal -->


<div class="modal fade bd-example-modal-lg" id="relaciones_producto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="card card-signup card-plain">
          <div class="modal-header">
            <div class="row">
                <div class="col">
                    <h5 class="modal-title card-title" id="nombre_producto"></h5>
                </div>
                <div class="col text-right">
                    <i class="nc-icon nc-simple-remove">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    </i>
                </div>
            </div>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12 ml-auto">
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
<!-- Large modal -->
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
<script src="js/productos.js"></script>
</body>
</html>