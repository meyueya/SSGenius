<div class="container">
    <div class="card" style="width: 18rem;">
        <div class="card-body">
        
            <h5 class="card-title">Filtros Usados</h5>

            <?php if(count($arrayFiltros)!==0):?>

                <h6 class="card-subtitle mb-2 text-muted">Rango de fecha</h6>
                <?php if(isset($arrayFiltros["daterange-btn"])):?>
                    <p class="card-text"><?= $arrayFiltros["daterange-btn"]?></p>
                <?php else:?>
                    <p class="card-text">Sin filtros</p>
                <?php endif ?>

                <h6 class="card-subtitle mb-2 text-muted">Tipos</h6>
                <?php if(isset($arrayFiltros["tipos"])):?>
                    <?php foreach($arrayFiltros['tipos'] as $array):?>
                        <?php $nombre = $SsgModel->getNameFiltro($array);?>
                        <p class="card-text">&bull; <?=  $nombre[0]['nombre']?></p>
                    <?php endforeach?>
                <?php else:?>
                    <p class="card-text">Sin filtros</p>
                <?php endif ?>

                <h6 class="card-subtitle mb-2 text-muted">Objetivos</h6>
                <?php if(isset($arrayFiltros["objetivos"])):?>
                    <?php foreach($arrayFiltros['objetivos'] as $array):?>
                        <?php $nombre = $SsgModel->getNameFiltro($array);?>
                        <p class="card-text">&bull; <?=  $nombre[0]['nombre']?></p>
                    <?php endforeach?>
                <?php else:?>
                    <p class="card-text">Sin filtros</p>
                <?php endif ?>

                <h6 class="card-subtitle mb-2 text-muted">Nivel de Libertad</h6>
                <?php if(isset($arrayFiltros["NivelesLibertad"])):?>
                    <?php foreach($arrayFiltros['NivelesLibertad'] as $array):?>
                        <?php $nombre = $SsgModel->getNameFiltro($array);?>
                        <p class="card-text"> &bull; <?=  $nombre[0]['nombre']?></p>
                    <?php endforeach?>
                <?php else:?>
                    <p class="card-text">Sin filtros</p>
                <?php endif ?>
                           
                <h6 class="card-subtitle mb-2 text-muted">Pauta</h6>
                <?php if(isset($arrayFiltros["paidUnPaid"])):?>
                    <p class="card-text"> &bull; <?= $arrayFiltros["paidUnPaid"]?></p>
                <?php else:?>
                    <p class="card-text">Todos</p>
                <?php endif ?>

            <?php else: ?>
                <h6 class="card-subtitle mb-2 text-muted">Sin filtros</h6>
            <?php endif ?>

        </div>
    </div>
</div>