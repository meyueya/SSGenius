<?php

 $allinfo = $_POST['allinfo'];
 $factor_inversion = floatval($_POST['factor_inversion']);
?>
<div class="col-md-12">
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="example1" class="cell-border compact stripe">
          <thead>
            <tr>
              <th>Fecha</th>
              <th>Campaña</th>
              <th>Nombre Anuncio</th>
              <th>Edad</th>
              <th>Sexo</th>
              <th>Impresiones</th>
              <th>Clic</th>
              <th>Inversión</th>
            </tr>
          </thead>
          <tbody style="font-size: 12px;">
          <?php $impressions=0; $clicks=0; $spend=0; foreach($allinfo as $info):?>
            <tr>
            <td><?= $info['date_start']  ?></td>
            <td><?= $info['campaign_name']  ?></td>
            <td><?= $info['ad_name']  ?></td>
            <td><?= $info['age']  ?></td>
            <td><?= $info['gender']  ?></td>
            <td><?= $info['impressions']  ?></td>
            <td><?= $info['clicks']  ?></td>
            <td><?= number_format($info['spend']/$factor_inversion, 2,',','.')  ?></td>
            </tr>
            <?php $impressions +=$info['impressions']; $clicks+=$info['clicks']; $spend+=$info['spend']; endforeach?>
          </tbody> 
          <tfoot>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td><strong> TOTAL</strong></td>
              <td><strong><?= $impressions ?></strong></td>
              <td><strong><?= $clicks ?></strong></td>
              <td><!-- <strong><?= number_format($spend/$factor_inversion, 2,',','.')  ?></strong> --></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>