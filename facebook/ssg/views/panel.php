<hr />
<?php
function generar_id_unico_reporte($length = 20) { 
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!]?})$&%#"), 0, $length); 
  } 
$id_unico_reporte=generar_id_unico_reporte();
//aqui recibe los filtros usados en la busqueda
/* echo"<pre>";
var_dump($arrayPost[1]);
echo"</pre>";
echo 'costo_'.$arrayPost[1]['filtro']; */
$arrayFiltros=$_POST;
$arrayFiltros=json_encode($arrayFiltros);
$cantAMostrar=count($arrayPost)+1;
    //print_r($arrayPost);
?>
<style>
.ir-arriba{
    display: none;
    padding: 18px;
    background: #1792D6;
    font-size: 20px;
    color: #fff;
    cursor: pointer;
    position: fixed;
    bottom: 20px;
    right: 20px;
    border-radius: 5px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	-o-border-radius: 2px;
    transition: background-color 0.1s linear;
	-moz-transition: background-color 0.1s linear;
	-webkit-transition: background-color 0.1s linear;
	-o-transition: background-color 0.1s linear;
}
.ir-arriba:hover {
	background: #fff;
	color: #2EBE9E;
	border: 1px solid #1792D6;
}
.row > div {
     border: none; 
} 

.table-dark td, .table-dark th, .table-dark thead th {
    border-color: #ffffff!important;
}
.text-small{ line-height:16px !important; font-size:12px; display:block;}
</style>
<div class="container-fluid bg-white">
    <?php if(count($arrayPost)>0):?>
        <a id="regresar"> </a>
        <span class="ir-arriba icon-circle-up" ></span>
        <table class="table table-bordered table-sm">
            <thead>
            <form name="form" id="formulario_pdf" action="views/pdf.php" method="post" target="_blank">
            <a class="badge badge-pill badge-warning" href="javascript:deseleccionar_todo()" role="button">Desmarcar todos</a> 
            <input class="btn btn-block" type="button" Value="Generar Reporte" onclick="enviar_form()" />
            <!-- data-toggle="modal" data-target="#enviar_form" -->
            <br>
                <tr>
                <th scope="col">Código</th>
                        <?php formarColumnas($arrayPost,'id_celdaCheck',$cantAMostrar); ?>
                </tr>
                <input type="hidden" name="filtros" value='<?= $arrayFiltros?>'>
                </form>
                <tr>
                    <th scope="col">Id Post</th>
                    <?php formarColumnas($arrayPost,'id',$cantAMostrar); ?>
                </tr>
                <tr>
                    <th scope="col">Publicaciones</th>
                    <?php formarPublicaciones($arrayPost,'picture',$cantAMostrar); ?>
                </tr>
                <tr>
                    <th scope="col">Fecha</th>
                    <?php formarColumnas($arrayPost,'fecha',$cantAMostrar); ?>
                </tr>
                <tr>
                <th scope="col">Hora Creación</th>
                <?php formarColumnas($arrayPost,'hora',$cantAMostrar); ?>
                </tr>
                <tr>
                <th scope="col">Dia Creación </th>
                <?php formarColumnas($arrayPost,'dia_semana',$cantAMostrar); ?>
                </tr>

            </thead>
            <tbody>
            <?php if($arrayPost[1]['nombrekpi']!=''):?>
                <tr class="table-dark" >
                <td colspan="<?= $cantAMostrar; ?>" class="text-center"> <strong>Indicador de Filtro</strong></td>
                </tr>
                <tr>
                <th scope="row"><?= $arrayPost[1]['nombrekpi'] ?></th>
                <?php formarColumnas($arrayPost,$arrayPost[1]['filtro'],$cantAMostrar,valoresTop($arrayPost,$arrayPost[1]['filtro']),valoresDown($arrayPost,$arrayPost[1]['filtro'])); ?>
                </tr>
                <tr>
                <th scope="row">Índice <?= $arrayPost[1]['nombrekpi'] ?></th>
                <?php formarColumnas($arrayPost,'indice_kpi',$cantAMostrar,valoresTop($arrayPost,'indice_kpi'),valoresDown($arrayPost,'indice_kpi')); ?>
                </tr>
                <tr>
                <th scope="row">Índice <?= $arrayPost[1]['nombrekpi'] ?> alcance</th>
                <?php formarColumnas($arrayPost,'indice_kpi_alcance',$cantAMostrar,valoresTop($arrayPost,'indice_kpi_alcance'),valoresDown($arrayPost,'indice_kpi_alcance')); ?>
                </tr>
                <tr>
                <th scope="row">Índice <?= $arrayPost[1]['nombrekpi'] ?> inversión</th>
                <?php formarColumnas($arrayPost,'indice_kpi_inversion',$cantAMostrar,valoresTop($arrayPost,'indice_kpi_inversion'),valoresDown($arrayPost,'indice_kpi_inversion')); ?>
                </tr>
                <tr>
                <th scope="row">Costo por <?= $arrayPost[1]['nombrekpi'] ?> </th>
                <?php formarColumnas($arrayPost,'costo_'.$arrayPost[1]['filtro'],$cantAMostrar,valoresTop($arrayPost,'costo_'.$arrayPost[1]['filtro']),valoresDown($arrayPost,'costo_'.$arrayPost[1]['filtro']),'invertir_colores'); ?>
                </tr>
            <?php endif?>
                <tr class="table-dark" >
                <td colspan="<?= $cantAMostrar; ?>" class="text-center"> <strong>Principales</strong></td>
                </tr>
                <tr>
                <th scope="row">Fans a la Fecha</th>
                <?php formarColumnas($arrayPost,'fanspage',$cantAMostrar); ?>
                </tr>
                <tr>
                <th scope="row">Alcance Total</th>
                <?php formarColumnas($arrayPost,'alcance',$cantAMostrar,valoresTop($arrayPost,'alcance'),valoresDown($arrayPost,'alcance')); ?>
                </tr>
                <tr>
                <th scope="row">Alcance Pagado</th>
                <?php formarColumnas($arrayPost,'alcance_pagado',$cantAMostrar,valoresTop($arrayPost,'alcance_pagado'),valoresDown($arrayPost,'alcance_pagado')); ?>
                </tr>
                <tr>
                <th scope="row">Alcance Orgánico</th>
                <?php formarColumnas($arrayPost,'alcance_organico',$cantAMostrar,valoresTop($arrayPost,'alcance_organico'),valoresDown($arrayPost,'alcance_organico')); ?>
                </tr>
                <tr>
                <th scope="row">Comentario</th>
                <?php formarColumnas($arrayPost,'comentarios',$cantAMostrar,valoresTop($arrayPost,'comentarios'),valoresDown($arrayPost,'comentarios')); ?>
                </tr>
                <tr>
                <th scope="row">Reacciones</th>
                <?php formarColumnas($arrayPost,'reacciones',$cantAMostrar,valoresTop($arrayPost,'reacciones'),valoresDown($arrayPost,'reacciones')); ?>
                </tr>
                <tr>
                <th scope="row">Compartir</th>
                <?php formarColumnas($arrayPost,'compartir',$cantAMostrar,valoresTop($arrayPost,'compartir'),valoresDown($arrayPost,'compartir')); ?>
                </tr>
                <tr>
                <th scope="row">Click a Link </th>
                <?php formarColumnas($arrayPost,'link_clicks',$cantAMostrar,valoresTop($arrayPost,'link_clicks'),valoresDown($arrayPost,'link_clicks')); ?>
                </tr>
                <tr>
                <th scope="row">Vistas de Video </th>
                <?php formarColumnas($arrayPost,'post_video_views_unique',$cantAMostrar,valoresTop($arrayPost,'post_video_views_unique'),valoresDown($arrayPost,'post_video_views_unique')); ?>
                </tr>
                <tr>
                <th scope="row">Interacciones Totales </th>
                <?php formarColumnas($arrayPost,'interacciones_totales',$cantAMostrar,valoresTop($arrayPost,'interacciones_totales'),valoresDown($arrayPost,'interacciones_totales')); ?>
                </tr>
                <tr>
                <th scope="row">Inversión $</th>
                <?php formarColumnas($arrayPost,'inversion',$cantAMostrar,valoresTop($arrayPost,'inversion'),valoresDown($arrayPost,'inversion')); ?>
                </tr>
                <tr class="table-dark" >
                    <td colspan="<?= $cantAMostrar; ?>" class="text-center"> <strong>Índices</strong></td>
                </tr>
                <tr>
                <th scope="row">índice de Interacción</th>
                <?php formarColumnas($arrayPost,'indice_interaccion',$cantAMostrar,valoresTop($arrayPost,'indice_interaccion'),valoresDown($arrayPost,'indice_interaccion')); ?>
                </tr>
                <tr>
                <th scope="row">índice Inter Alcance</th>
                <?php formarColumnas($arrayPost,'indice_inter_alcance',$cantAMostrar,valoresTop($arrayPost,'indice_inter_alcance'),valoresDown($arrayPost,'indice_inter_alcance')); ?>
                </tr>
                <tr>
                <th scope="row">índice Interacción vs Inversión</th>
                <?php formarColumnas($arrayPost,'indice_interaccion_inversion',$cantAMostrar,valoresTop($arrayPost,'indice_interaccion_inversion'),valoresDown($arrayPost,'indice_interaccion_inversion')); ?>
                </tr>
                <tr>
                <th scope="row">índice Inter Alcance vs Inversión</th>
                <?php formarColumnas($arrayPost,'indice_inter_alcance_inversion',$cantAMostrar,valoresTop($arrayPost,'indice_inter_alcance_inversion'),valoresDown($arrayPost,'indice_inter_alcance_inversion')); ?>
                </tr>
                <tr class="table-dark" >
                    <td colspan="<?= $cantAMostrar; ?>" class="text-center"> <strong>Catalogación</strong></td>
                </tr>
                <tr>
                <th scope="row">Objetivos</th>
                <?php formarColumnas($arrayPost,'objetivo',$cantAMostrar); ?>
                </tr>
                <tr>
                <th scope="row">Tipos</th>
                <?php formarColumnas($arrayPost,'tipo',$cantAMostrar); ?>
                </tr>
                <tr>
                <th scope="row">Nivel de Libertad</th>
                <?php formarColumnas($arrayPost,'nivelLibertad',$cantAMostrar); ?>
                </tr>
                <tr class="table-dark" >
                    <td colspan="<?= $cantAMostrar; ?>" class="text-center"> <strong>Logros</strong></td>
                </tr>
                <tr>
                <th scope="row">Formularios Totales</th>
                <?php for ($i=0; $i < $cantAMostrar-1 ; $i++):?>
                <td>0</td>
                <?php endfor ?>
                </tr>
                <tr>
                <th scope="row">Buen Contacto Call</th>
                <?php for ($i=0; $i < $cantAMostrar-1 ; $i++):?>
                <td>0</td>
                <?php endfor ?>
                </tr>
            </tbody>
        </table>
    <?php else : ?>
        <div class="container">
            <h2 > Sin resultados</h2><br><br><br>
        </div>
    <?php endif ?>
</div>
<!--<div class="container">
    <?php $cont=0;?>
    <?php foreach($arrayPost as $array):?>
 <div class="row-12">
        <?php if($cont<$cantAMostrar-1):?>
        <?php $cont++;?>
        <div class="row " style="margin-top:10px">
            <div class="col-3 offset-3">
                <p class="text-left font-weight-bold" id='<?="opcion".$cont; ?>' >P<?=$cont; ?></p>
            </div>
            <div class="col-3">
                <p class="text-right" ><a href="#regresar">Subir ▲</a></p>
            </div>
        </div>
            <div class="col-12" style="text-align:center;border-bottom:1px #ccc solid;padding-top:10px;padding-bottom:20px">
                <div class="fb-post" data-href="<?= $array['link']?>" data-tabs="timeline" data-small-header="false" data-adaptive-container-width="true" data-hide-cover="false" data-show-facepile="true" >
                    <blockquote cite = "<?= $array['link']?>" class=" fb-xfbml-parse-ignore"> 
                        <a href ="<?= $array['link']?>"> 
                        </a> 
                    </blockquote> 
                </div>
            </div>
        <?php endif?>
 </div>
    <?php endforeach ?>
</div>-->

<!-- Modal enviar_form -->
<div class="modal fade" id="enviar_form" tabindex="-1" role="dialog" aria-labelledby="enviar_formTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Ingresa un título para tu reporte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" form="formulario_pdf" name="titulo_reporte" required>
        <input type="hidden" form="formulario_pdf" name="id_unico_reporte" value="<?= $id_unico_reporte?>">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" form="formulario_pdf" class="btn btn-primary" onclick="ocultarmodal()">Generar Reporte</button>
      </div>
    </div>
  </div>
</div>

<script>
	// Evento que se ejecuta al pulsar en un checkbox
	$(".checkForm2").change(function(){

		// Cogemos el elemento actual
		var elemento=this;
		var contador=0;
 
		// Recorremos todos los checkbox para contar los que estan seleccionados
		$(".checkForm2").each(function(){
			if($(this).is(":checked"))
				contador++;
		});
 
		var cantidadMaxima=6;
 
		// Comprovamos si supera la cantidad máxima indicada
		if(contador>cantidadMaxima)
		{
			alert("Puedes filtar máximo seis elementos");
 
			// Desmarcamos el ultimo elemento
			$(elemento).prop('checked', false);
			contador--;
		}
    });
    
$(document).ready(function(){

$('.ir-arriba').click(function(){
    $('table, html').animate({
        scrollTop: '0px'
    }, 300);
});

$(window).scroll(function(){
    if ( $(this).scrollTop() > 0 ) {
        $('.ir-arriba').slideDown(300);
    } else{
        $('.ir-arriba').slideUp(300);
    }
});

});

function deseleccionar_todo(){ 
   for (i=0;i<document.form.elements.length;i++) 
      if(document.form.elements[i].type == "checkbox")	
         document.form.elements[i].checked=0 
}
function enviar_form() {
    var enviar=false;
    $('input[type=checkbox].checkForm2').each(function () {
           if (this.checked) {
            enviar=true;
           }
    });
    if (enviar == true) {
        $('#enviar_form').modal('show');
    }else{
        $.notify({
           title: '<strong>Ops!</strong><br>',
           message: 'Selecciona algún Post para generar tu reporte'
           },{
           type: 'danger'
           });
    }
}
function ocultarmodal(params) {
    $('#enviar_form').modal('hide')
}
</script>