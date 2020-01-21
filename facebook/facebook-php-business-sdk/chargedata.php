<?php 
$token = md5(uniqid(rand(), TRUE));
?>
<!DOCTYPE HTML>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    
	<title>Importador de data de Facebook API Business</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
    body,html{ background-color: #E9EBEE;font-family:Roboto;}
    .container{ background-color: #FFF; margin:0 auto !important; padding:5px; min-height:600px; height:auto;}
        .input-field>label, label {
        color: #4267b2;
        font-size: 1.2rem;
        margin-top:-4px;
        font-weight:bold;
        }
        .input-field>label{ margin-top:-11px;}
       #toast-container {
        min-width: 10%;
        top: 50%;
        right: 50%;
        transform: translateX(50%) translateY(50%);
        color:red !important;
        background-color: white !important; 
    }
    #selectacount{ margin-top:20px;}
    #fechainicio{ margin-top:-6px;}
    .collection-item{transition: all 2s linear;}
    #progress{transition: all 2s linear;visibility:hidden;}
    .success{ color:green;}
    .error{ color:red;}
    </style>
</head>        
<body>
<div class="container">
<center><h5>Importador de Data de Facebook</h5></center>
<p>&nbsp;</p>
<div class="row">
<div class="input-field col s12 m3" id="selectacount">
    <select id="account">
      <option value="" disabled selected>Escoja una cuenta</option>
      <option value="1073271616120634">ILCB</option>
      <option value="263704911080094">Instituto LCB</option>
      <option value="1487762988004826">Movil Tours</option>
    </select>
    <label>Cuenta Publicitaria</label>
  </div>
  <div class="col s12 m3" id="fechainicio">
       <label>Fecha de Inicio</label>
       <input type="text" class="datepicker" id="datepicker">
  </div>
  </div>
<button class="btn waves-effect waves-light" id="savedata" type="submit" name="action">Importar data
  </button>
  <ul id="response" class="collection"></ul>
  <div class="progress" id="progress">
      <div class="indeterminate"></div>
  </div>
</div>
<script type="text/javascript" src="https://aiw-roi.com/sistema/ilcb/administrator2/js/jquery-latest.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script type="text/javascript">
function recursively_ajax(fecha,account_id)
{
	 $('#savedata').attr("disabled", "true");
	 var fecha = $('#datepicker').val();
	 var account_id = $('#account').val();
	 var select = $('select');
$.ajax({
        type:"POST",
        async:false, // set async false to wait for previous response
        //url: "https://aiw-roi.com/sistema/ilcb/administrator2/Classes/facebook_api/facebook-php-business-sdk/guardadatapaginafacebook.php", //para anuncios
        url: "https://aiw-roi.com/sistema/ilcb/administrator2/Classes/facebook_api/facebook-php-business-sdk/insert_page_totals.php",  //para page fans
        dataType:"json",
        data:{token:'<?php echo $token; ?>',date:fecha,account_id:account_id},
        success: function(data)
        {
            if(data.flag == '1'){
            	//console.log(data.mensaje);
                $('#response').append('<li class="collection-item z-depth-5">'+data.mensaje+'</li>');
                $('#progress').css({'visibility':'visible'});
            	setTimeout(recursively_ajax, 1000);
            } else if (data.flag == '0'){
            	var select = $('select');
            	 $('select').val("");
            	 $('select').formSelect();       //Update material select
            	$('#response').append('<li class="collection-item z-depth-5">'+data.mensaje+'</li>');
            	 $('#savedata').removeAttr("disabled");
            	 $('#progress').css({'visibility':'hidden'});
                }
        }
    });
$("html, body").animate({ scrollTop: $(document).height()-$(window).height() }, 1000);
 }
 
        $(document).ready( function(){
        	 $('select').formSelect();
        	 var date = new Date();
        	 date.setDate(date.getDate() - 1);
        	 $('.datepicker').datepicker({
        	        selectMonths: true, // Creates a dropdown to control month
        	        selectYears: 100, // Creates a dropdown of 15 years to control year
        	        format: 'yyyy-mm-dd',
        	        maxDate: date,
                    i18n: {
                        months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                        monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"],
                        weekdays: ["Domingo","Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                        weekdaysShort: ["Dom","Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                        weekdaysAbbrev: ["D","L", "M", "M", "J", "V", "S"]
                    }
        	    });
            $('#savedata').click( function(){   
          	  var fecha = $('#datepicker').val();
        	  var account_id = $('#account').val();
        	  if ((fecha != "") && (account_id != "")){           
            	recursively_ajax(fecha,account_id);
        	  } else {
        		  M.toast({html: 'Faltan llenar campos', classes: 'red rounded'})
            	  }
                });        	
        });      
</script>
</body>
</html>