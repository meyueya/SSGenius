crear_plantilla_analisis(1);

if (infoactual!=null) {
  var infoactual = jQuery.parseJSON(infoactual);
  var cant_analisis=get_cant_analisis(infoactual);
  //se le resta uno, ya que hay un analisis por defecto
  if (cant_analisis.length>1) {
    for (i = 0; i < cant_analisis.length-1; i++) {
      nuevo_analisis();
    }
  }
  setTimeout(function() {
    actualizarEstadosCheckbox(infoactual,cant_analisis);
  }, 1000);
  
}

  function recoger_datos(selector) {
        var client = [];
        $(selector).each(function(){
             client.push($(this).val());
        }); 
        return client;
    }        

    $(document).ready(function() {
      // Initialise the wizard
      demo.initWizard();
      setTimeout(function() {
        $('.card.card-wizard').addClass('active');
      }, 600);
    })

    function nuevo_analisis() {
        var contador=1;
        $( "li.analisis" ).each(function() {
            contador++;
          });
        $('#lista_de_analisis').before('<li class="nav-item analisis"><a class="nav-link" href="#analisis'+contador+'" data-toggle="tab" role="tab" aria-controls="analisis'+contador+'" aria-selected="true"><!-- <i class="nc-icon nc-single-02"></i> --> Analisis #'+contador+'</a></li>');
        $('#pantillas_analisis').append('<div class="tab-pane" id="analisis'+contador+'"><div class="row justify-content-center"><div class="row">Título Análisis #'+contador+' :<input type="text" name="titulo_analisis'+contador+'" id="titulo_analisis'+contador+'"></div><div class="row"><div class="col-md-6"><div class="card"><div class="card-header"><div class="card-text"><h4 class="card-title">Tipos y Objetivos #'+contador+'</h4><p class="card-category">Tipos de Publicasiones y sus objetivos</p></div></div><div class="card-body"><div class="row"><div class="col-md-6"><h4 class="card-title" style="margin-top: 0; text-align: center;"> Tipos</h4>  <div class="row" id="tipos'+contador+'"></div></div><div class="col-md-6"><h4 class="card-title" style="margin-top: 0; text-align: center;"> Objetivos</h4><div class="row" id="obj'+contador+'"></div> </div></div></div></div></div><div class="col-md-6"><div class="card"><div class="card-header"><div class="card-text"><h4 class="card-title">KPI</h4><p class="card-category">Key Performance Indicators</p></div></div><div class="card-body"><div class="row"  id="kpi'+contador+'"></div></div></div></div></div></div></div>'); 
        crear_plantilla_analisis(contador);
        $.getScript("../assets/demo/demo.js");
        //demo.initWizard();
        //$('#rootwizard').bootstrapWizard('fixNavigationButtons'); 
    }

    function activar_pareja_checkbox(selector){
      $(selector).bootstrapSwitch('state',true);
    }


function GuardarParametros(){
  var id_edit=$('#update_consul').val();
  var tipo  = new Array();
  var obj   = new Array();
  var kpi   = new Array();
  var principal  = new Array();
  var titulo  = new Array();
  var contador=1;
  $( "li.analisis" ).each(function() {
    var tipothis = $("input:radio[name=tipo"+contador+"]:checked").val();
    var objthis = $("input:radio[name=obj"+contador+"]:checked").val();
    var kpithis = recoger_datos("input:checkbox[name=kpi"+contador+"]:checked");
    var principalthis = $("input:radio[name=principal"+contador+"]:checked").val();
    var titulothis = $("input:text[name=titulo_analisis"+contador+"]").val();
    tipo.push(tipothis);
    obj.push(objthis);
    kpi.push(kpithis);
    principal.push(principalthis);
    titulo.push(titulothis);
    contador++;
  });
/*   console.log('KPI->',principal);
  console.log(kpi,tipo,obj,titulo); */

    var periodo = '';
    var titulo_consultoria = $('#titulo_consultoria').val();
    var page_id=$('#page_id').val();
    //$("#fecha").val(fecha);
    $("#pdo").val(periodo);

    var params ={
            "op" : '1',
            "kpi" : kpi,
            "tipo": tipo,
            "obj" :  obj,
            "principal": principal,
            "titulo": titulo,
            "id_edit": id_edit,
            "titulo_consultoria":titulo_consultoria,
            "page_id":page_id
        };
  $.ajax({
              data:   params,  
              url:    'controller/procesarconsultoriassg.php', 
              type:   'post',
              success:function(DatosRecuperados) {
                //console.log(DatosRecuperados);
                window.location.href ='reporteconsultoria.php?psid='+page_id; 
              },error:function(e){
                console.log(e);
              }

          });
}

function crear_plantilla_analisis(contador) {
  var params ={
    "ACT": 0,
    "page_id":page_id
        };
  //console.log(params);
        $.ajax({
         url : "datossg.php",
         method:"POST", 
        data:   params,
         success:function(data){
          $.each(data, function(i, item) {
          var on = "<i class='nc-icon nc-check-2'></i>";
          var off = "<i class='nc-icon nc-simple-remove'></i>";
  
          if(item.grupo=="tipo"){      
          $('#tipos'+contador).append('<div class="col-md-6"><p class="category">'+item.nombre+'</p><input class="bootstrap-switch" type="radio" data-toggle="switch"  data-on-label="'+on+'" data-off-label="'+off+'" data-on-color="success" data-off-color="success" value="'+item.id+'" name="tipo'+contador+'" id="tipocheck'+contador+item.id+'" /></div>');
          $('#tipocheck'+contador+item.id).bootstrapSwitch(); 
          }
          if(item.grupo=="objetivo"){         
          $('#obj'+contador).append('<div class="col-md-6"><p class="category">'+item.nombre+'</p><input class="bootstrap-switch" type="radio" data-toggle="switch"  data-on-label="'+on+'" data-off-label="'+off+'" data-on-color="success" data-off-color="success" value="'+item.id+'" name="obj'+contador+'" id="objcheck'+contador+item.id+'"/></div>');
          $('#objcheck'+contador+item.id).bootstrapSwitch(); 
          }
          if(item.grupo=="kpi"){         
            $('#kpi'+contador).append('<div class="col-md-3"><p class="category">'+item.nombre+'</p><input class="bootstrap-switch" type="checkbox" data-toggle="switch"  data-on-label="'+on+'" data-off-label="'+off+'" data-on-color="success" data-off-color="success" value="'+item.id+'" name="kpi'+contador+'" id="kpicheck'+contador+item.id+'"/><div class="form-check-radio"><label class="form-check-label"><input class="form-check-input radio " type="radio" name="principal'+contador+'" id="principal'+contador+item.id+'" value="'+item.id+'" onclick="activar_pareja_checkbox(kpicheck'+contador+item.id+')" >Principal<span class="form-check-sign"></span></label></div></div>'); 
            $('#kpicheck'+contador+item.id).bootstrapSwitch(); 
          }
       });
         }
        });
}


function get_cant_analisis(arreglo) {
  //primero a serpara los id analisis
  var cant_analisis=Array();
  $.each(arreglo, function(i, value) {
    cant_analisis.push(value.id_analisis);
  });
  //ahora a quitar los id repetidos
  var uniqs = cant_analisis.filter(function(item, index, array) {
    return array.indexOf(item) === index;
  })
  return uniqs; 
}

function actualizarEstadosCheckbox(infoactual,analisis_realizados) {
  $.each(analisis_realizados,function(i,contador) {
    $.each(infoactual,function(key,value){
      var analisis=parseInt(contador)+1;
      if (value.id_analisis==contador) {
        $('#titulo_analisis'+analisis).val(value.titulo);
        $('#tipocheck'+analisis+value.tipo).bootstrapSwitch('state',true);
        $('#objcheck'+analisis+value.objetivo).bootstrapSwitch('state',true);
        $('#kpicheck'+analisis+value.kpi).bootstrapSwitch('state',true);
        $('#principal'+analisis+value.kpi_principal).attr('checked','checked');
      }
    });
  });
  $('#update_consul').val(infoactual[0].id_consultoria);
  $('#titulo_consultoria').val(infoactual[0].titulo_consultoria);
}



// Cambio de logos //


var numero=0;
    $("#minimizeSidebar").click(function() {
           numero++;
        if( $( "#body" ).hasClass( "sidebar-mini" ) ) {
            //$(".logo-image-small").remove();
           
           // $('#logogrande').html('<div class="logo-image-big"><img src="https://ssgenius.com/wp-content/uploads/2018/10/cropped-logo-1.png" style="padding-left: 15px;"></div>');
            $( "#body" ).removeClass( "sidebar-mini" );
           
                }
            else{
                
            //$('#minilogo').html('<div class="logo-image-small"><img src="https://ssgenius.com/wp-content/uploads/2018/11/favicon.png"></div>');
           // $(".logo-image-big").remove();
             $( "#body" ).removeClass( "sidebar-mini" );
             
            }
		   	 
		});

