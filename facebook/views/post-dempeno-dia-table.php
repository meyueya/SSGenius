<?php
$arrayColumnasTabla=array(
  'fecha_historico'=>'fecha',
  'promotion_status'=>'Status de Promoción',
  'reach'=>'Alcance',
  'reach_organic'=>'Alcance Orgánico',
  'reach_paid'=>'Alccance Pagado',
  'comments'=>'Comentarios',
  'reactions'=>'Reacciones',
  'shares'=>'Compartir',
  'post_video_views_unique'=>'Vista de Video',
  'link_clicks'=>'Clic a Link',
  'type'=>'tipo',
  'page_fans'=>'Fans',
  'indice_interaccion'=>'Índice de Interacción',
  'indice_interalcance'=>'Índice de Interalcance',
  'ad_spend'=>'Inversión',
  'indice_interaccion_inversion'=>'Índice de Interacción vs Inversión',
  'indice_interalcance_inversion'=>'Índice de Interalcance vs Inversión',
  'id_adaccount'=>'id_adaccount',
  'creative_id'=>'creative_id',
);
 $infoHistPostConsultoria = $_POST['infoHistPostConsultoria']; 
?>
<table class="table table-striped">
    <?php foreach ($arrayColumnasTabla as $key => $columna):?>
    <tr>
         <th scope="col"><?= $columna?></th>                            
        <?php foreach ($infoHistPostConsultoria as $clave => $value):
                $valorAmostrar = ($value[$key])?$value[$key]:0;
                if($key == 'ad_spend' && $clave!=0){
                    $valorAmostrar = $valorAmostrar-$infoHistPostConsultoria[$clave-1][$key];
                    if ($psid == '192597304105183') {
                        $valorAmostrar = number_format($valorAmostrar/0.55, 2, '.', '');
                    }
                }
            ?>
            <td>
                    <?= $valorAmostrar?>
            </td>
        <?php endforeach?>
    </tr>
    <?php endforeach?>
</table>