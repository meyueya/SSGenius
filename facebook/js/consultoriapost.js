crear_plantilla_post(1);

if (infoactual!=null) {
  var infoactual = jQuery.parseJSON(infoactual);
  var cant_post=get_cant_post(infoactual);
  //se le resta uno, ya que hay un post por defecto
  if (cant_post.length>1) {
    for (i = 0; i < cant_post.length-1; i++) {
      nuevo_post();
    }
  }
  setTimeout(function() {
    actualizarEstadosCheckbox(infoactual,cant_post);
  }, 1000);
  
}

  function recoger_datos(selector) {
        var client = [];
        $(selector).each(function(){
             client.push($(this).val());
        }); 
        return client;
    }        

    $(document).ready(function(e) {
      // Initialise the wizard
      // demo.preventDefault();
      demo.initWizard()
      setTimeout(function(e) {
         
         // $('#facebook').addClass("show");

        $('.card.card-wizard').addClass('active');
      }, 600);
    })



    function nuevo_post() {
        var contador=1;
        
        
        $( "li.post" ).each(function() {
            contador++;
          });
        $('#lista_de_post').before('<li class="nav-item post"><a class="nav-link" href="#post'+contador+'" data-toggle="tab" role="tab" aria-controls="post'+contador+'" aria-selected="true"><i class="nc-icon nc-single-02"></i> post #'+contador+'</a></li>');
        $('#pantillas_post').append('<div class="tab-pane" id="post'+contador+'"><div class="row justify-content-center"><div class="row"><div class="col-md-12"><div class="card"><div class="card-header"><div class="card-text"><h4 class="card-title">Consultoría #'+contador+'</h4><p class="card-category">Definir El Post De Acuerdo A Sus Análisis</p></div></div><div class="card-body"><div class="row"><div class="col-md-12"><h4 class="card-title" style="margin-top: 0; text-align: center;"> Post #'+contador+'</h4><div class="row" id="tipos'+contador+'"></div></div></div></div></div></div></div></div></div>'); 
        crear_plantilla_post(contador);
       
        demo.initWizard();
        $('#rootwizard').bootstrapWizard();
    
      
       


    }

    function activar_pareja_checkbox(selector){
      $(selector).bootstrapSwitch('state',true);
    }

 
function GuardarParametros(){
  var id_edit=$('#update_consul').val();
  var post_id=$('#post_id').val();
  var analisis  = new Array();
 
  var contador=1;
  $( "li.post" ).each(function() {
   /*  var analisisthis = $("input:checkbox[name=tipo"+contador+"]:checked").val(); */
    var analisisthis = recoger_datos("input:checkbox[name=tipo"+contador+"]:checked");
   
    analisis.push(analisisthis);
    
    contador++;
  });
/*   console.log('KPI->',principal);
  console.log(kpi,tipo,obj); */

    var periodo = '';
    var fecha = $('#daterange-btn').val();
    $("#fecha").val(fecha);
    $("#pdo").val(periodo);

    var params ={
            "op" : '4',
            "analisis": analisis,
            "id_consultoria": a,
            "page_id": page_id,
            "post_id": post_id
        };
  $.ajax({ 
              data:   params,  
              url:    'controller/procesarconsultoriassg.php', 
              type:   'post', 
              success:function(DatosRecuperados) {
                /* console.log(DatosRecuperados); */
                window.location.href ='reporteconsultoria.php?psid='+page_id; 
              },error:function(e){
                console.log(e);
              }

          });
}

function crear_plantilla_post(contador) {
  var params ={
    "ACT": 1,
    "a" : a,
    "page_id": page_id 
        };  
        
        $.ajax({
         url : "datossg.php",
         method:"POST", 
        data:   params,
        success:function(data){
        /*   console.log(data); */
          $.each(data, function(i, item) {
          var on = "<i class='nc-icon nc-check-2'></i>";
          var off = "<i class='nc-icon nc-simple-remove'></i>";
                  
          $('#tipos'+contador).append('<div class="col-md-3"><p class="category">'+item.titulo+'</p><input class="bootstrap-switch" type="checkbox" data-toggle="switch"  data-on-label="'+on+'" data-off-label="'+off+'" data-on-color="success" data-off-color="success" value="'+item.id+'" name="tipo'+contador+'" id="tipocheck'+contador+item.id+'" /></div>');
          $('#tipocheck'+contador+item.id).bootstrapSwitch(); 
 
       });
         }
        });
}


function get_cant_post(arreglo) {
  //primero a serpara los id post
  var cant_post=Array();
  $.each(arreglo, function(i, value) {
    cant_post.push(value.id_post);
  });
  //aora a quitar los id repetidos
  var uniqs = cant_post.filter(function(item, index, array) {
    return array.indexOf(item) === index;
  })
  return uniqs; 
}

function actualizarEstadosCheckbox(infoactual,post_realizados) {
  $.each(post_realizados,function(i,contador) {
    $.each(infoactual,function(key,value){
      var post=parseInt(contador)+1;
      if (value.id_post==contador) {
        $('#tipocheck'+post+value.tipo).bootstrapSwitch('state',true);
        $('#objcheck'+post+value.objetivo).bootstrapSwitch('state',true);
        $('#kpicheck'+post+value.kpi).bootstrapSwitch('state',true);
        $('#principal'+post+value.kpi_principal).attr('checked','checked');
      }
    });
  });
  $('#update_consul').val(infoactual[0].id_consultoria);
}