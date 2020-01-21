<?php
 $detallesProductos = $_POST['detallesProductos'];
 //echo json_encode($_POST);exit;
?> 

<table id="list_info_product_table" class="cell-border compact stripe">
  <thead style="text-align: center;">
    <tr>
      <th> producto </th>
      <th> Impressions </th>
      <th> Clicks </th>
      <th> spent </th>
      <th> CPC </th>
      <th> CTR </th>
    </tr>
  </thead>
  <tbody id="">
    <?php foreach($detallesProductos as $product_id => $info_product):?>
        <tr>
            <td><?= $info_product['nombre_producto']?></td>
            <td><?= array_sum($info_product['valores']['impressions'])?></td>
            <td><?= array_sum($info_product['valores']['link_clicks'])?></td>
            <td><?= number_format(array_sum($info_product['valores']['spend']), 2,',','.')?></td>
            <td><?= number_format(array_sum($info_product['valores']['link_clicks'])/array_sum($info_product['valores']['spend']), 2,',','.')?></td>
            <td><?= number_format(array_sum($info_product['valores']['link_clicks'])/array_sum($info_product['valores']['impressions']), 2,',','.')?></td>
        </tr>
    <?php endforeach?>
  </tbody>
<!--   <tfoot>
    <tr>
      <td>Total Campañas</td>
      <td></td>
      <td></td>
      <td><?= $impressionsTotal?></td>
      <td><?= $link_clicksTotal?></td>
      <td><?= number_format($spendTotal, 2,',','.')?></td>
      <td><?= $reachTotal?></td>
      <td><?= number_format($frequencyTotal, 2,',','.') ?></td>
      <td><?= $sharesTotal?></td>
      <td><?= $reactionsTotal?></td>
      <td><?= $commentsTotal?></td>
      <td><?= number_format($engagementTotal, 2,',','.')  ?>%</td>
    </tr>
  </tfoot> -->
</table>
