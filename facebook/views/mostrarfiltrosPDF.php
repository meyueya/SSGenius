      
            <div class="container">
            <h5 class="card-title">Filtros Usados</h5>

            <?php if(count($arrayFiltros)!==0):?>
        <div class="row">
            <div class="col-sm-3 col-lg-3">
              <div class="card">
                <div class="card-body text-center"> 
                    <h6 class="card-subtitle mb-2 text-muted">Tipos</h6>
                    <?php if(isset($arrayFiltros["tipos"])):?>
                        <?php foreach($arrayFiltros['tipos'] as $array):?>
                            <?php $nombre = $SsgModel->getNameFiltro($array);?>
                            <p class="card-text">&bull; <?=  $nombre[0]['nombre']?></p>
                        <?php endforeach?>
                    <?php else:?>
                        <p class="card-text">Sin filtros</p>
                    <?php endif ?>
                </div>
              </div>
            </div>
            <div class="col-sm-3 col-lg-3">
              <div class="card">
                <div class="card-body text-center">
                    <h6 class="card-subtitle mb-2 text-muted">Objetivos</h6>
                    <?php if(isset($arrayFiltros["objetivos"])):?>
                        <?php foreach($arrayFiltros['objetivos'] as $array):?>
                            <?php $nombre = $SsgModel->getNameFiltro($array);?>
                            <p class="card-text">&bull; <?=  $nombre[0]['nombre']?></p>
                        <?php endforeach?>
                    <?php else:?>
                        <p class="card-text">Sin filtros</p>
                    <?php endif ?>
                </div>
              </div>
            </div>
            <div class="col-sm-3 col-lg-3">
              <div class="card">
                <div class="card-body text-center">
                    <h6 class="card-subtitle mb-2 text-muted">Nivel de Libertad</h6>
                    <?php if(isset($arrayFiltros["NivelesLibertad"])):?>
                        <?php foreach($arrayFiltros['NivelesLibertad'] as $array):?>
                            <?php $nombre = $SsgModel->getNameFiltro($array);?>
                            <p class="card-text"> &bull; <?=  $nombre[0]['nombre']?></p>
                        <?php endforeach?>
                    <?php else:?>
                        <p class="card-text">Sin filtros</p>
                    <?php endif ?>
                </div>
              </div>
            </div>
            <div class="col-sm-3 col-lg-3">
              <div class="card">
                <div class="card-body text-center">
                <h6 class="card-subtitle mb-2 text-muted">Pauta</h6>
                <?php if(isset($arrayFiltros["paidUnPaid"]) && $arrayFiltros["paidUnPaid"]!=""):?>
                    <p class="card-text"> &bull; <?= $arrayFiltros["paidUnPaid"]?></p>
                <?php else:?>
                    <p class="card-text">Pagados/NoPagados</p>
                <?php endif ?>
                </div>
              </div>
            </div>
        </div>
        
        <?php else: ?>
        <h6 class="card-subtitle mb-2 text-muted">Sin filtros</h6>
        <?php endif ?>
    </div>