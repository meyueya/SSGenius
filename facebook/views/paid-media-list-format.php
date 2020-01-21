<?php
 $detallesFormatos = $_POST['detallesFormatos'];
 //echo json_encode($_POST);exit; 
?> 

<table id="list_info_format_table" class="cell-border compact stripe">
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
    <?php foreach($detallesFormatos as $format_name => $info_format):?>
        <tr>
            <td><?= $format_name?></td>
            <td><?= $info_format['totales']['impressions']?></td>
            <td><?= $info_format['totales']['link_clicks']?></td>
            <td><?= number_format($info_format['totales']['spend'], 2,',','.')?></td>
            <td><?= number_format($info_format['totales']['link_clicks']/$info_format['totales']['spend'], 2,',','.')?></td>
            <td><?= number_format($info_format['totales']['link_clicks']/$info_format['totales']['impressions'], 2,',','.')?></td>
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
