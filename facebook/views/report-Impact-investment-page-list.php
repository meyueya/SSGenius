<?php
 /* ob_start(); */
 $infoPage = $_POST['infoPage'];
 $indicador = $_POST['indicador'];
 $nombreKpi = $_POST['nombre_kpi'];
 //echo json_encode($_POST['prueba']["prueba"])."<br>".json_encode($_POST['prueba']["infoPage"])."<br>".json_encode($_POST['prueba']["infoPautaPage"]);exit;
?>

<table id="list_info_table" class="cell-border compact stripe">
  <thead style="text-align: center;">
    <tr>
      <th> Año </th>
      <th> Mes </th>
      <th> Semana </th>
      <th> Dia </th>
      <th><?= $nombreKpi?></th>
    </tr>
  </thead>
  <tbody id="example99">
    <?php foreach($infoPage as $info):?>
      <tr>
        <td><?= $info['anio']?></td>
        <td><?= $info['mes']?></td>
        <td><?= $info['semana']?></td>
        <td><?= $info['dia']?></td>
        <td><?= $info[$indicador]?></td>
      </tr>
    <?php endforeach?>
  </tbody>
</table>
