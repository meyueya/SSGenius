<?php include('cabecera.php'); ?>
<script src="../js/pluginFB.js"></script>
<script>

$(document).ready( function(){
    $(".boton").click( function(){
        var idform = $(this).data('submit');
        
 $.ajax({
           type: "POST",
           url: "procesar.php",
           data: $("#"+idform+"").serialize(), // serializes the form's elements.
           success: function(data)
           {
               //alert(data);  show response from the php script.
               $("#"+idform+"").hide();
           }
         });
});
});
</script>
<nav class="navbar navbar-light bg-light">
    <div class="container">
    <span class="navbar-brand mb-0 h1">Actualizar Post</span>
    </div>
</nav>
<br>
    <?php foreach($sinCatalogar as $array): ?>
    <div>
<form id="<?= $array['id']?>" method="post">
     <?php //echo $array["id"]?>
     <br>
       <div class="container">
        <div class='row'>
            <div class="col-md-6">
            <input type="hidden" value="<?= $array['id']?>" name="id_post">
                    <div id="fb-root">
                                <div class="fb-post" data-href="<?= $array['permalink_url']?>" data-tabs="timeline" data-small-header="false" data-adaptive-container-width="true" data-hide-cover="false" data-show-facepile="true" >
                                    <blockquote cite="<?= $array['permalink_url']?>" class=" fb-xfbml-parse-ignore"> 
                                        <a href="<?= $array['permalink_url']?>"> 
                                        </a> 
                                    </blockquote> 
                                </div>
                    </div>
            </div>
            <div class="col-md-2">
              <div class="panel panel-default">
                <div class="panel-heading">Tipo</div>
                <ul class="list-group">
                  <?php foreach ($catalogacion as $arrayCatalogacion):?>
                   <?php if($arrayCatalogacion["grupo"] == "tipo"): 
                   $PostEstaCatalogadoConUnValor = $conectar->checkSiPostEstaCatalogadoConUnValor($arrayCatalogacion['id'],$array['id']);
                   if ($PostEstaCatalogadoConUnValor){?>
                       <li class="list-group-item">
                        <input type="checkbox" value="<?= $arrayCatalogacion['id']?>"  id="<?= $array['id'] ?>---<?= $arrayCatalogacion['id']?>" name="<?= $array['id'] ?>---<?= $arrayCatalogacion['id']?>" checked />
                        <label for="<?= $array['id'] ?>---<?= $arrayCatalogacion['id']?>"><?= $arrayCatalogacion['nombre']?></label>
                    </li>
                   <?php }else {
                   ?>
                    <li class="list-group-item">
                        <input type="checkbox" value="<?= $arrayCatalogacion['id']?>"  id="<?= $array['id'] ?>---<?= $arrayCatalogacion['id']?>" name="<?= $array['id'] ?>---<?= $arrayCatalogacion['id']?>"/>
                        <label for="<?= $array['id'] ?>---<?= $arrayCatalogacion['id']?>"><?= $arrayCatalogacion['nombre']?></label>
                    </li>
                   <?php } 
                   endif ?>
                  <?php endforeach ?>
                </ul>
              </div>
            </div>
            <div class="col-md-2">
              <div class="panel panel-default">
                <div class="panel-heading">Objetivo</div>
                <ul class="list-group">
                  <?php foreach ($catalogacion as $arrayCatalogacion):?>
                   <?php if($arrayCatalogacion["grupo"] == "objetivo"): 
                    $PostEstaCatalogadoConUnValor = $conectar->checkSiPostEstaCatalogadoConUnValor($arrayCatalogacion['id'],$array['id']); 
                    if ($PostEstaCatalogadoConUnValor){ ?>
                    <li class="list-group-item">
                        <input type="checkbox" value="<?= $arrayCatalogacion['id']?>" name="<?= $array['id'] ?>---<?= $arrayCatalogacion['id']?>" checked />
                        <label><?= $arrayCatalogacion['nombre']?></label>
                    </li>
                     <?php }else { ?>
                       <li class="list-group-item">
                        <input type="checkbox" value="<?= $arrayCatalogacion['id']?>" name="<?= $array['id'] ?>---<?= $arrayCatalogacion['id']?>"/>
                        <label><?= $arrayCatalogacion['nombre']?></label>
                    </li>   
                   <?php } endif ?>
                  <?php endforeach ?>
                </ul>
              </div>
            </div>
            <div class="col-md-2">
              <div class="panel panel-default">
                <div class="panel-heading">Nivel de Libertad</div>
                <ul class="list-group">
                  <?php foreach ($catalogacion as $arrayCatalogacion):?>
                   <?php if($arrayCatalogacion["grupo"] == "nivelLibertad"):  $PostEstaCatalogadoConUnValor = $conectar->checkSiPostEstaCatalogadoConUnValor($arrayCatalogacion['id'],$array['id']); 
                    if ($PostEstaCatalogadoConUnValor){ ?>
                    <li class="list-group-item">
                        <input type="checkbox" value="<?= $arrayCatalogacion['id']?>" name="<?= $array['id'] ?>---<?= $arrayCatalogacion['id']?>" checked />
                        <label><?= $arrayCatalogacion['nombre']?></label>
                    </li>
                     <?php }else { ?>
                     <li class="list-group-item">
                        <input type="checkbox" value="<?= $arrayCatalogacion['id']?>" name="<?= $array['id'] ?>---<?= $arrayCatalogacion['id']?>" />
                        <label><?= $arrayCatalogacion['nombre']?></label>
                    </li>
                   <?php } endif ?>
                  <?php endforeach ?>
                </ul>
              </div>
            </div>
       </div>
       <br>
    <input class="boton" data-submit="<?= $array['id']?>" type="button" value="Actualizar" >
</form>
</div>
    <?php endforeach ?>
          <hr>

    <a href="catalogar.php">Recargar página</a>
    <?php 
    // var_dump($_POST); ?>
           <br><br><br><br><br><br><br>

<?php include('pie.php'); ?>

