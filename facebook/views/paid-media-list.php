<?php
 $detallesCampaniaFace = $_POST['detallesCampaniaFace'];
 //echo json_encode($detallesCampaniaFace)."<br>".json_encode($detallesCampaniaPosts);
?>

<table id="list_info_table" class="cell-border compact stripe">
  <thead style="text-align: center;">
    <tr>
      <th> Medio </th>
      <th> Account name </th>
      <th> Campaign name </th>
      <th> Impressions </th>
      <th> Link clicks </th>
      <th> Amount spent </th>
      <th> Reach </th>
      <th> Frequency </th>
      <th> Post shares </th>
      <th> Post reactions </th>
      <th> Post comments </th>
      <th> % Engagement </th>
    </tr>
  </thead>
  <tbody id="example99">
    <?php  $impressionsTotal=0; $link_clicksTotal=0;$spendTotal=0;$reachTotal=0;$frequencyTotal=0;$sharesTotal=0;$reactionsTotal=0;$commentsTotal=0; $engagementTotal=0;?>
    <?php foreach($detallesCampaniaFace as $account_id => $arrayDetalles):?>
        <?php foreach($arrayDetalles as $detalles):
        $engagement =(($detalles['shares']+$detalles['reactions']+$detalles['comments'])/$detalles['reach'])*100;?>
        <tr>
            <td>Facebook</td>
            <td><?= $detalles['adaccount_name']?></td>
            <td><?= $detalles['campaign_name']?></td>
            <td><?= $detalles['impressions']?></td>
            <td><?= $detalles['link_clicks']?></td>
            <td><?= number_format($detalles['spend'], 2,',','.')?></td>
            <td><?= $detalles['reach']?></td>
            <td><?= number_format($detalles['frequency'], 2,',','.') ?></td>
            <td><?php if($detalles['shares']){echo $detalles['shares'];}else{echo 0;}?></td>
            <td><?php if($detalles['reactions']){echo $detalles['reactions'];}else{echo 0;}?></td>
            <td><?php if($detalles['comments']){echo $detalles['comments'];}else{echo 0;}?></td>
            <td><?= number_format($engagement, 2,',','.')  ?>%</td>
        </tr>
        <?php $impressionsTotal +=$detalles['impressions'];$link_clicksTotal +=$detalles['link_clicks'];$spendTotal +=$detalles['spend'];$reachTotal +=$detalles['reach'];  
        $frequencyTotal +=$detalles['frequency']; $sharesTotal +=$detalles['shares']; $reactionsTotal +=$detalles['reactions']; $commentsTotal +=$detalles['comments']; 
        $engagementTotal +=$engagement; endforeach?>
    <?php endforeach?>
  </tbody>
  <tfoot>
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
  </tfoot>
</table>
