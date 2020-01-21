<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>?psid=<?php echo $_GET['psid']; ?>" method="post" id="form_filtros">
<div class="row  rowform">
          <div class="col-md-4"> 
            <div class="card ">
              <div class="card-header ">
                <p>Periodo/Ordenar</p>
              </div>
              <div class="card-body ">
                  <div class="row  rowform">
                    <label class="col-md-3">Rango</label>
                    <div class="col-md-9">
                      <div class="form-group">           
                        <input style="margin-bottom: 20px;"  class="env_form_filtros media form-control datetimepicker" name="daterange-btn" id="daterange-btn" autocomplete="off">
                        <input  name="dpag" id="dpag" type="hidden" value="<?php echo $dateMin; ?> - <?php echo $dateMax; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row  rowform">
                    <label class="col-md-3">Ordenar Por</label>
                    <div class="col-md-9">
                      <div class="form-group">
                          <select class="form-control selectpicker " data-style="btn btn-success btn-round" id="orderby" name="orderby">
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
                  </div>                
              </div>
        <!--       <div class="card-footer ">
                <div class="row  rowform">
                </div>
              </div> -->
            </div>
          </div>
          <div class="col-md-4">
            <div class="card ">
              <div class="card-header ">
                <p>Indicadores e Índices</p>
              </div>
              <div class="card-body ">
                  <div class="row  rowform">
                    <label class="col-md-3">Indicadores</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <select class="form-control selectpicker" data-style="btn btn-success btn-round" id="showgraphby" name="showgraphby">
                          <option value="">Todos</option>
                          <option value="interacciones" <?php  if (isset($_POST['showgraphby'])) {  if ($_POST['showgraphby'] == 'interacciones') { echo ' selected="selected"'; } } ?>>Interacciones</option>
                          <option value="reacciones" <?php if (isset($_POST['showgraphby'])) {  if ($_POST['showgraphby'] == 'reacciones') { echo ' selected="selected"'; } } ?>>Reacciones</option>
                          <option value="compartir" <?php if (isset($_POST['showgraphby'])) {  if ($_POST['showgraphby'] == 'compartir') { echo ' selected="selected"'; } } ?>>Compartir</option>
                          <option value="comentario" <?php if (isset($_POST['showgraphby'])) {  if ($_POST['showgraphby'] == 'comentario') { echo ' selected="selected"'; } } ?>>Comentario</option>
                          <option value="vistasVideo" <?php if (isset($_POST['showgraphby'])) {  if ($_POST['showgraphby'] == 'vistasVideo') { echo ' selected="selected"'; } } ?>>Vistas de video</option>
                          <option value="clickLinks" <?php if (isset($_POST['showgraphby'])) {  if ($_POST['showgraphby'] == 'clickLinks') { echo ' selected="selected"'; } } ?>>Clics a Links</option>
                          <option value="alcancetotal" <?php  if (isset($_POST['showgraphby'])) {  if ($_POST['showgraphby'] == 'alcancetotal') { echo ' selected="selected"'; } } ?>>Alcance Total</option>
                          <option value="alcancepagado" <?php  if (isset($_POST['showgraphby'])) {  if ($_POST['showgraphby'] == 'alcancepagado') { echo ' selected="selected"'; } } ?>>Alcance Pagado</option>
                          <option value="alcanceorganico" <?php  if (isset($_POST['showgraphby'])) {  if ($_POST['showgraphby'] == 'alcanceorganico') { echo ' selected="selected"'; } } ?>>Alcance Orgánico</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row  rowform">
                    <label class="col-md-3">Ver</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <select class="form-control selectpicker" data-style="btn btn-success btn-round" id="paidUnPaid" name="paidUnPaid">
                          <option value="">Pagados/No Pagados</option>
                          <option value="nopagados" <?php if (isset($_POST['paidUnPaid'])) { if ($_POST['paidUnPaid'] == 'nopagados') { echo ' selected="selected"'; } } ?>>No Pagados</option>
                          <option value="pagados" <?php if (isset($_POST['paidUnPaid'])) { if ($_POST['paidUnPaid'] == 'pagados') { echo ' selected="selected"'; }  } ?>>Pagados</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row  rowform">
                    <label class="col-md-3">Tipo de Publicación</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <select class="form-control selectpicker" data-style="btn btn-success btn-round" multiple title="Tipo de Publicación" data-size="10" id="typePost" name="typePost[]">
                            <?php foreach ($postTypes as $optionPostTypes){?>
                          <option value="<?= $optionPostTypes["type"]?>" <?php echo (isset($_POST['typePost']) && in_array($optionPostTypes["type"], $_POST['typePost'])) ? ' selected="selected"' : ''; ?>><?= tipoPostSpanish($optionPostTypes["type"])?></option>
                            <?php }?>
                        </select>
                      </div>
                    </div>
                  </div>  
              </div>
             <!--  <div class="card-footer ">
                <div class="row  rowform">
                </div>
              </div> -->
            </div>
          </div>
          <div class="col-md-4">
            <div class="card ">
              <div class="card-header ">
                  <div class="row">
                      <div class="col">
                        <p>Catalogación</p> 
                      </div>
                      <div class="col">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="busqueda_exacta" value="true" <?php if (isset($_POST['busqueda_exacta'])) { echo 'checked'; } ?>>busqueda exacta
                            <span class="form-check-sign"></span>
                        </label>
                      </div>
                  </div>
              </div>
              <div class="card-body ">
                  <div class="row  rowform">
                    <label class="col-md-3">Tipo</label>
                    <div class="col-md-9">
                      <div class="form-group">
                          <select class="form-control selectpicker" data-style="btn btn-success btn-round" multiple title="Tipo" data-size="10" id="tiposSelect" name="tipos[]">
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
                  <div class="row  rowform">
                    <label class="col-md-3">Objetivo</label>
                    <div class="col-md-9">
                      <div class="form-group">
                          <select class="form-control selectpicker" data-style="btn btn-success btn-round" multiple title="Objetivo" data-size="10" id="objetivosSelect" name="objetivos[]">
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
                  <div class="row  rowform">
                    <label class="col-md-3">Nivel de Libertad</label>
                    <div class="col-md-9">
                      <div class="form-group">
                          <select class="form-control selectpicker" data-style="btn btn-success btn-round" multiple title="Nivel de Libertad" data-size="10" id="nivelLibertadSelect" name="NivelesLibertad[]">
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
              <!-- <div class="card-footer ">
                <div class="row  rowform">
                </div>
              </div> -->
            </div>
          </div>
</div>
    <div class="row  rowform">
        <div class="col-md-2">
        <button type="submit" name="greport" id="greport" value="GREPORT" class="btn btn-outline-primary" style="margin-top:8px;"><i class="fa fa-search-plus"></i> Filtrar </button><br><br>
        </div>
        <div class="col-md-2">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
            Sentiment
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Sentiment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-right">
                        <p class="">Comentarios totales:  <?= $sentimentPage['cantComentariosTotales']?></p>
                        <p class="">Comentarios analizados:  <?= $sentimentPage['cantComentariosSentiment']?></p>
                        <p class="">comentarios sentiment positivo:  <?= $sentimentPage['cantComentariosPositivos']?></p>
                        <p class="">comentarios sentiment negativo:  <?= $sentimentPage['cantComentariosNegativos']?></p>
                        <p class="">sentiment total promedio:  <?= $sentimentPage['infoCommentsPost']?></p>
                        <p class="">sentiment positivo promedio:  <?= $sentimentPage['infoComentariosPositivos']?></p>
                        <p class="">sentiment negativo promedio:  <?= $sentimentPage['infoComentariosNegativos']?></p>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-md-8"></div>
    </div>
</form>