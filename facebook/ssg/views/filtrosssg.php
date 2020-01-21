<script>
    function toggle_filtros(selector) {
        $(selector).toggle('fadeOut');
        return false;
    }
</script>
<ul class="nav justify-content-center">
  <li class="nav-item">
    <p class="nav-link" href="#">Periodo:</p>
  </li>
  <li class="nav-item">
    <div class="col" style="display:inline-block; ">
        <div class="form-group">
            <div class="input-group">
              <input  class="btn btn-default pull-right env_form_filtros" name="daterange-btn" id="daterange-btn" autocomplete="off">
              </input>
              <input  name="dpag" id="dpag" type="hidden" value="<?php echo $dateMin; ?> - <?php echo $dateMax; ?>"></input>
              <!--<input type="submit" value="Filtrar">-->
            </div>  
        </div>
    </div>
  </li>
  <!-- <li class="nav-item">
    <p class="nav-link active" href="#">Filtros:</p>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="javascript:void(0)" onclick="toggle_filtros('#loquesea')">Indicadores e Índices</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="javascript:void(0)" onclick="toggle_filtros('#loquesea2')">Catalogación</a>
  </li>
  <li class="nav-item">
    <button type="submit" name="greport" id="greport" value="GREPORT" class="btn btn-outline-primary" style="margin-top:8px;"><i class="fa fa-search-plus"></i> Aplicar </button><br><br>
  </li> -->
</ul>

<div class="container-fluid">
    <br>
    <div class="row">
    </div>
    <div class="row">
        <div class="col-md-6 col-xl-6">
            <div class="card">
                <h6 style="padding-bottom:5px; margin-top:10px; margin-left:10px; ">Indicadores e Índices</h6>
                <hr />
                <div class="row">
         
        <div class="col-xs-1 col-md-2 col-lg-4" style="padding-left:25px;">
              <div class="form-group">
                  <label for="orderby">Ordenar por:</label>
                  <select class="form-control" id="orderby" name="orderby">
                    <option value="">Fecha</option>
                    <option value="interacciones" <?php  if (isset($_POST['orderby'])) {  if ($_POST['orderby'] == 'interacciones') { echo ' selected="selected"'; } } ?>>Interacciones</option>
                    <option value="reacciones" <?php if (isset($_POST['orderby'])) {  if ($_POST['orderby'] == 'reacciones') { echo ' selected="selected"'; } } ?>>Reacciones</option>
                    <option value="compartir" <?php if (isset($_POST['orderby'])) {  if ($_POST['orderby'] == 'compartir') { echo ' selected="selected"'; } } ?>>Compartir</option>
                    <option value="comentario" <?php if (isset($_POST['orderby'])) {  if ($_POST['orderby'] == 'comentario') { echo ' selected="selected"'; } } ?>>Comentario</option>
                    <option value="vistasVideo" <?php if (isset($_POST['orderby'])) {  if ($_POST['orderby'] == 'vistasVideo') { echo ' selected="selected"'; } } ?>>Vistas de video</option>
                    <option value="clickLinks" <?php if (isset($_POST['orderby'])) {  if ($_POST['orderby'] == 'clickLinks') { echo ' selected="selected"'; } } ?>>Clics a Links</option>
                    <option value="alcancetotal" <?php  if (isset($_POST['orderby'])) {  if ($_POST['orderby'] == 'alcancetotal') { echo ' selected="selected"'; } } ?>>Alcance Total</option>
                    <option value="alcancepagado" <?php  if (isset($_POST['orderby'])) {  if ($_POST['orderby'] == 'alcancepagado') { echo ' selected="selected"'; } } ?>>Alcance Pagado</option>
                    <option value="alcanceorganico" <?php  if (isset($_POST['orderby'])) {  if ($_POST['orderby'] == 'alcanceorganico') { echo ' selected="selected"'; } } ?>>Alcance Orgánico</option>
                    <option value="indice_interaccion" <?php  if (isset($_POST['orderby'])) {  if ($_POST['orderby'] == 'indice_interaccion') { echo ' selected="selected"'; } } ?>>Indice de Interacción</option>
                    <option value="indice_interalcance" <?php  if (isset($_POST['orderby'])) {  if ($_POST['orderby'] == 'indice_interalcance') { echo ' selected="selected"'; } } ?>>Indice de Inter Alcance</option>
                    <option value="inversion" <?php  if (isset($_POST['orderby'])) {  if ($_POST['orderby'] == 'inversion') { echo ' selected="selected"'; } } ?>>Inversión</option>
                    <option value="indice_interaccion_inversion" <?php  if (isset($_POST['orderby'])) {  if ($_POST['orderby'] == 'indice_interaccion_inversion') { echo ' selected="selected"'; } } ?>>Indice de Interacción Inversión</option>
                    <option value="indice_interalcance_inversion" <?php  if (isset($_POST['orderby'])) {  if ($_POST['orderby'] == 'indice_interalcance_inversion') { echo ' selected="selected"'; } } ?>>Indice de Inter Alcance Inversión</option>
                  </select>
            </div>
        </div>  
        
       <div class="col-xs-1 col-md-2 col-lg-4"  style="padding-left:40px;">
              <div class="form-group">
                  <label for="paidUnPaid">Ver:</label>
                  <select class="form-control" id="paidUnPaid" name="paidUnPaid">
                    <option value="">Pagados/No Pagados</option>
                    <option value="nopagados" <?php if (isset($_POST['paidUnPaid'])) { if ($_POST['paidUnPaid'] == 'nopagados') { echo ' selected="selected"'; } } ?>>No Pagados</option>
                    <option value="pagados" <?php if (isset($_POST['paidUnPaid'])) { if ($_POST['paidUnPaid'] == 'pagados') { echo ' selected="selected"'; }  } ?>>Pagados</option>
                  </select>
            </div>
        </div>
        <div class="col-xs-1 col-md-2 col-lg-4" style="padding-left:25px;">
              <div class="form-group">
                  <label for="typePost">Tipo de Publicación:</label>
                  <div class="input-group">
                  <select class="form-control" id="typePost" name="typePost[]" multiple="multiple">
                      <option value="event" <?php echo (isset($_POST['typePost']) && in_array('event', $_POST['typePost'])) ? ' selected="selected"' : ''; ?>>Evento</option>
                      <option value="link" <?php echo (isset($_POST['typePost']) && in_array('link', $_POST['typePost'])) ? ' selected="selected"' : ''; ?>>Link</option>
                      <option value="photo" <?php echo (isset($_POST['typePost']) && in_array('photo', $_POST['typePost'])) ? ' selected="selected"' : ''; ?>>Foto</option>
                      <option value="status" <?php echo (isset($_POST['typePost']) && in_array('status', $_POST['typePost'])) ? ' selected="selected"' : ''; ?>>Status</option>
                      <option value="video" <?php echo (isset($_POST['typePost']) && in_array('video', $_POST['typePost'])) ? ' selected="selected"' : ''; ?>>Video</option>
                  </select>
            </div>
            </div>
        </div>
        </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-6">
            <div class="card">
                <h6 style="padding-bottom:5px; margin-top:10px; margin-left:10px; ">Catalogación</h6>
                <hr />
           <div class="row"> 
         <div class="col-xs-1 col-md-4 col-sm-4" style="padding-left:25px;">
              <div class="form-group">
                <label>Tipo:</label>
                <div class="input-group">
                <select id="tiposSelect" name="tipos[]" multiple="multiple" class="form-control">
                <?php
                foreach ($tipos as $optionTipos)
                {
                ?>
                <option value="<?php echo $optionTipos['id'];?>"<?php echo (isset($_POST['tipos']) && in_array($optionTipos['id'], $_POST['tipos'])) ? ' selected="selected"' : ''; ?>><?php echo $optionTipos['nombre'];?></option>
                <?php }
                ?>
                </select>
                </div>
              </div>
          </div>  
      <div class="col-xs-1 col-md-4 col-sm-4" style="max-width:210px;">
              <div class="form-group">
                <label>Objetivo:</label>
                <div class="input-group">
                <select id="objetivosSelect" name="objetivos[]" multiple="multiple" class="form-control">
                <?php
                foreach ($objetivos as $optionObjetivos)
                {?>
                <option value="<?php echo $optionObjetivos['id'];?>"<?php echo (isset($_POST['objetivos']) && in_array($optionObjetivos['id'], $_POST['objetivos'])) ? ' selected="selected"' : ''; ?>><?php echo $optionObjetivos['nombre'];?></option>
                <?php }
                ?>
                </select>
                </div>
              </div>
          </div>  
          <div class="col-xs-1 col-md-4 col-sm-4" style="max-width:150px;">
              <div class="form-group">
                <label>Nivel de Libertad:</label>
                <div class="input-group">
                <select id="nivelLibertadSelect" name="NivelesLibertad[]" multiple="multiple" class="form-control">
                <?php
                foreach ($nivelesLibertad as $optionNivelesLibertad)
                {?>
                <option value="<?php echo $optionNivelesLibertad['id'];?>"<?php echo (isset($_POST['NivelesLibertad']) && in_array($optionNivelesLibertad['id'], $_POST['NivelesLibertad'])) ? ' selected="selected"' : ''; ?>><?php echo $optionNivelesLibertad['nombre'];?></option>
                <?php }
                ?>
                </select>
                </div>
              </div>
          </div>  
          </div> 
           </div>
          </div> 
    </div>
    <div class="row">
    <!--     <?php 
        if ($_POST!="") {
            $ordenadosPor = ($_POST["orderby"]=="") ? 'Fecha' : $_POST["orderby"];
            switch ($_POST["paidUnPaid"]) {
                case 'nopagados':$pagadosNoPagados='No Pagados';break;
                case 'pagados':$pagadosNoPagados='Pagados';break;
                default:$pagadosNoPagados='Pagados / No Pagados';break;
            }
            $tipoPublicacion = ($_POST["typePost"]=="") ? null : implode(",", $_POST["typePost"]);
            $tipoCatalogacion = ($_POST["tipos"]=="") ? null : implode(",", $_POST["tipos"]);
            $objetivosCatalogacion = ($_POST["objetivos"]=="") ? null : implode(",", $_POST["objetivos"]);
            $nivelesLibertadCatalogacion = ($_POST["NivelesLibertad"]=="") ? null : implode(",", $_POST["NivelesLibertad"]);
        }
        ?>
        <?php if($_POST!=""):?>
        <p>Ordenados por <?= $ordenadosPor;?>,
        <span>
            Filtros usados.
        </span> 
        Indicadores e Índices: Post <?= $pagadosNoPagados;?>. Tipo de Publicación <?= $tipoPublicacion;?>. 
        Catalogación: Tipos <?= $tipoCatalogacion;?>. Objetivos: <?= $objetivosCatalogacion;?>. Nivel de Libertad <?= $nivelesLibertadCatalogacion;?>.</p>
        <?php endif?> -->
        <div class="col-md-12">
        <button type="submit" name="greport" id="greport" value="GREPORT" class="btn btn-outline-primary" style="margin-top:8px;"><i class="fa fa-search-plus"></i> Filtrar </button><br><br>
        </div>
    </div>
</div>
