<div class="tab-pane" id="analisis<?= $_POST['contador']?>">
  <div class="row justify-content-center">
    <div class="row">
        Título Análsis #<?= $_POST['contador']?>:<input type="text" name="titulo_analisis<?= $_POST['contador']?>" id="titulo_analisis<?= $_POST['contador']?>">
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <div class="card-text">
              <h4 class="card-title">Tipos y Objetivos #<?= $_POST['contador']?></h4>
              <p class="card-category">Tipos de Publicasiones y sus objetivos</p>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6"><h4 class="card-title" style="margin-top: 0; text-align: center;"> Tipos</h4>  
                <div class="row" id="tipos<?= $_POST['contador']?>">
                </div>
              </div>
              <div class="col-md-6">
                <h4 class="card-title" style="margin-top: 0; text-align: center;"> Objetivos</h4>
                <div class="row" id="obj<?= $_POST['contador']?>">
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
          <div class="row"  id="kpi<?= $_POST['contador']?>">
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>