
<!DOCTYPE html>
<html lang="en">



  
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
/*img.imgface  {
    border-radius: 10px !important;
    width: 81px !important;
}

.cont{
  font-size: 16px;
}*/
</style>

</head>

<body >

    

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

  <!--   Core JS Files   -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
var infoactual =  <?= json_encode($infoactual);?> 
 $(function () {
    var d = "<?php echo $d;?>";
    if(d!==''){ var des='moment("<?php echo $d;?>")'; var has='moment("<?php echo $h;?>")'; }
    else if(d === ''){ var des=moment().startOf('year'); var has=moment().endOf('month');  }
 
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          
          'Mes Actual'  : [moment().startOf('month'), moment().endOf('month')],
          'Mes Pasado'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
          'Hace 2 Meses': [moment().subtract(2, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
          'Hace 3 Meses': [moment().subtract(3, 'month').startOf('month'), moment().subtract(0, 'month').endOf('month')],
          'Hace 6 Meses': [moment().subtract(6,'month').startOf('month'), moment().subtract(0, 'month').endOf('month')],
          'Año Actual'  : [moment().startOf('year'), moment().endOf('month')],
          'Año pasado'  : [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
          'Hace 1 año'  : [moment().subtract(12, 'month').startOf('month'), moment().subtract(0, 'month').endOf('month')],
          'Hace 2 año'  : [moment().subtract(24, 'month').startOf('month'), moment().subtract(0, 'month').endOf('month')]
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
      function (des, has, label) {
      
        $('#daterange-btn span').html(des.format('YYYY/MM/DD') + ' | ' + has.format('YYYY/MM/DD'));
         
      }



    )
    $('#fecha').val(des.format('YYYY/MM/DD') + ' - ' + has.format('YYYY/MM/DD'));
   
  })
</script>
<script src="js/consultoria.js"></script>
  


</body>



</html>

