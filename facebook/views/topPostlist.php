<?php
 /* ob_start(); */
 $infoposts = $_POST['infoposts'];
 $allinfo = $_POST['allinfo'];
 //echo json_encode($_POST);exit;
?>
<?php foreach($infoposts as $info):?>
  <?php foreach($allinfo as $key => $post):?>
    <?php if($info['id'] == $post['id']):?>
      <div class="col-md-2">
        <div class="tab-pane" id="post_">
          <p>
          <?=$key?>
          </p>
          <!-- <input type="checkbox" name="post[]" form="CrearReporte" value=""> -->
          <table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" class="tabla" style="border-collapse:collapse;border-color:#ddd; font-size: 10px;">
            <thead>
              <tr>
                <th colspan="2">
                  <a href="<?=$post['permalink_url']?>" "="" target="_blank">
                    <div style="height: 180px; width: 100%; background-size:cover;background-repeat: no-repeat; background-image:url(<?=$post['picture']?>); background-position: center;" alt="">
                    </div>
                  </a>
                </th>
              </tr>
            </thead>
            <tbody style="text-align: left;">
              <tr>
                <td colspan="2">
                  <a href="<?=$post['permalink_url']?>" "="" target="_blank">
                    <?=$post['message']?>
                  </a>
                </td>
              </tr>
              <tr>
                <th width="55%">Fecha:</th>
                <td><?=$post['created_time']?></td> 
              </tr>
              <tr>
                <th width="55%">Fans a la fecha:</th>
                <td><?=$post['page_fans']?></td>
              </tr>
              <tr>
                <th>Comentarios:</th>
                <td><?=$post['comments']?></td>
              </tr>
              <tr>
                <th>Reacciones</th>
                <td> <?=$post['reactions']?></td>
              </tr>
              <tr>
                <th>clic a link</th>
                <td> <?=$post['link_clicks']?></td>
              </tr>
              <tr>
                <th>compartir</th>
                <td> <?=$post['shares']?></td>
              </tr>
              <tr>
                <th>vista de videos</th>
                <td> <?=$post['post_video_views_unique']?></td>
              </tr>
              <tr>
                <th>interacciones:</th>
                <td><?=$post['interactions']?></td>
              </tr>
              <tr>
                <th>Alcance:</th>
                <td><?=$post['reach']?></td>
              </tr>
              <tr>
                <th>Alcance orgánico:</th>
                <td><?=$post['reach_organic']?></td>
              </tr>
              <tr>
                <th>Alcance pagado:</th>
                <td><?=$post['reach_paid']?></td>
              </tr>
              <tr>
                <th>Indice de interracción</th>
                <td> <?=$post['indice_interaccion']?></td>
              </tr>
              <tr>
                <th>Indice de interracción inversión</th>
                <td> <?=$post['indice_interaccion_inversion']?></td>
              </tr>
              <tr>
                <th>Indice de interalcance</th>
                <td> <?=$post['indice_interalcance']?></td>
              </tr>
              <tr>
                <th>Indice de interalcance inversión</th>
                <td> <?=$post['indice_interalcance_inversion']?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    <?php break; endif?>
  <?php endforeach?>
<?php endforeach?>
<?php
/* 
$salida = ob_get_contents();
echo $salida;
exit; */
?>