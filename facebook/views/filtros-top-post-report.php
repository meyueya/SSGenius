<form class="form-horizontal" action="#" method="post" id="form_filtros">
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
                        <input  name="psid" id="psid" type="hidden" value="<?= $psid?>">
                      </div>
                    </div>
                  </div>
                  <div class="row  rowform"> 
                    <label class="col-md-3">Ordenar Por</label>
                    <div class="col-md-9">
                      <div class="form-group">
                      <select class="form-control selectpicker" data-style="btn btn-success btn-round" id="orderby" name="orderby">
                          <option value="">Defecto</option>
                        </select>
                      </div>
                    </div>
                  </div>                
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card ">
              <div class="card-header ">
                <p>Indicadores e Índices</p>
              </div>
              <div class="card-body ">
                  <div class="row  rowform container">
                    <div class="form-check col">
                      <input class="form-check-input" type="radio" name="top_down" id="top_down1" value="DESC" checked>
                      <label class="form-check-label" for="top_down1">
                        Mejores
                      </label>
                    </div>
                    <div class="form-check col">
                      <input class="form-check-input" type="radio" name="top_down" id="top_down2" value="ASC">
                      <label class="form-check-label" for="top_down2">
                        Peores
                      </label>
                    </div>
                  </div>
                  <div class="row  rowform">
                    <label class="col-md-3">Indicadores</label>
                    <div class="col-md-9">
                    <div class="form-group">
                        <select class="form-control selectpicker" data-style="btn btn-success btn-round" id="getPostByKpi" name="getPostByKpi">
                          <option value="39">Todos</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row  rowform">
                    <label class="col-md-3">Pauta</label>
                    <div class="col-md-9">
                      <div class="form-group">
                        <select class="form-control selectpicker" data-style="btn btn-success btn-round" id="paidUnPaid" name="paidUnPaid">
                          <option value="">Todos</option>
                          <option value="pagados">Pagados</option>
                          <option value="nopagados">No Pagados</option>
                        </select>
                      </div>
                    </div>
                  </div>
           <!--        <div class="row  rowform">
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
                  </div>  --> 
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card ">
              <div class="card-header ">
                  <div class="row">
                      <div class="col">
                        <p>Catalogación</p> 
                      </div>
                  </div>
              </div>
              <div class="card-body ">
                  <div class="row  rowform">
                    <label class="col-md-3">Categoría</label>
                    <div class="col-md-9">
                      <div class="form-group">
                          <select class="form-control selectpicker" data-style="btn btn-success btn-round" multiple title="CAtegoría" id="tiposSelect" name="tipos[]">
                          </select>
                      </div>
                    </div>
                  </div>
                  <div class="row  rowform">
                    <label class="col-md-3">Objetivo</label>
                    <div class="col-md-9">
                      <div class="form-group">
                          <select class="form-control selectpicker" data-style="btn btn-success btn-round" multiple title="Objetivo" id="objetivosSelect" name="objetivos[]">
                          </select>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
</div>
    <div class="row  rowform">
        <div class="col-md-12">
        <button type="submit" name="greport" id="greport" value="GREPORT" class="btn btn-outline-primary" style="margin-top:8px;"><i class="fa fa-search-plus"></i> Filtrar </button><br><br>
        </div>
    </div>
</form>