<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//error_reporting(E_ALL & ~E_NOTICE & E_DEPRECATED);
include("/home/ssgenius/public_html/app/model/Database.php");
date_default_timezone_set('America/Lima');
$fecha_historico =date('Y-m-d H:i:s'); 
try {
    $dbh = Database::getInstance();
    $sql = "SELECT 
    post_page.id AS id_post,post_page.page_id,
    post_page.updated_time,post_page.message,
    post_page.shares,post_page.promotion_status,
    post_page.reach_paid,post_page.reach_organic,
    post_page.reach,post_page.comments,
    post_page.reactions,post_page.post_video_views_unique,
    post_page.link_clicks,post_page.type,post_page.page_fans,
    post_page.indice_interaccion,post_page.indice_interalcance,
    post_page.indice_interaccion_inversion,post_page.indice_interalcance_inversion,
    adaccount_data.ad_spend,adaccount_data.ad_reach,adaccount_data.id_adaccount,
    adaccount_data.id_ad,adaccount_data.creative_id
    FROM `ssg_post_page_facebook` post_page
    LEFT JOIN `ssg_facebook_adaccount_data` adaccount_data
    ON post_page.id=adaccount_data.object_story_id";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $arreglo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    //para borrar registros del mismo dia 
    $hoy=date('Y-m-d');
    $sql_delete ="DELETE FROM `ssg_historico_post_page_facebook` 
    WHERE `fecha_historico` LIKE '%$hoy%'";
    $statement = $dbh->prepare($sql_delete);
    $statement->execute();

        $sql_insert = "INSERT INTO `ssg_historico_post_page_facebook`
        (`id_post`, `page_id`, `updated_time`, `message`, `shares`, `promotion_status`, `reach_paid`, `reach_organic`, 
        `reach`, `comments`, `reactions`, `post_video_views_unique`, `link_clicks`, `type`, `page_fans`, `indice_interaccion`, 
        `indice_interalcance`, `ad_spend`, `indice_interaccion_inversion`, `indice_interalcance_inversion`, `id_adaccount`, `ad_reach`, `id_ad`, 
        `creative_id`, `fecha_historico`) 
        VALUES 
        (:id_post,:page_id,:updated_time,:message,:shares,:promotion_status,:reach_paid,:reach_organic,:reach,
        :comments,:reactions,:post_video_views_unique,:link_clicks,:type,:page_fans,:indice_interaccion,
        :indice_interalcance,:ad_spend,:indice_interaccion_inversion,:indice_interalcance_inversion,
        :id_adaccount,:ad_reach,:id_ad,:creative_id,:fecha_historico)";
    foreach ($arreglo as $key => $value) {
        $sth = $dbh->prepare($sql_insert);
        $sth->bindParam(':id_post', $value['id_post'], PDO::PARAM_STR);
        $sth->bindParam(':page_id', $value['page_id'], PDO::PARAM_STR);
        $sth->bindParam(':updated_time', $value['updated_time'], PDO::PARAM_STR);
        $sth->bindParam(':message', $value['message'], PDO::PARAM_STR);
        $sth->bindParam(':shares', $value['shares'], PDO::PARAM_STR);
        $sth->bindParam(':promotion_status', $value['promotion_status'], PDO::PARAM_STR);
        $sth->bindParam(':reach_paid', $value['reach_paid'], PDO::PARAM_STR);
        $sth->bindParam(':reach_organic', $value['reach_organic'], PDO::PARAM_STR);
        $sth->bindParam(':reach', $value['reach'], PDO::PARAM_STR);
        $sth->bindParam(':comments', $value['comments'], PDO::PARAM_STR);
        $sth->bindParam(':reactions', $value['reactions'], PDO::PARAM_STR);
        $sth->bindParam(':post_video_views_unique', $value['post_video_views_unique'], PDO::PARAM_STR);
        $sth->bindParam(':link_clicks', $value['link_clicks'], PDO::PARAM_STR);
        $sth->bindParam(':type', $value['type'], PDO::PARAM_STR);
        $sth->bindParam(':page_fans', $value['page_fans'], PDO::PARAM_STR);
        $sth->bindParam(':indice_interaccion', $value['indice_interaccion'], PDO::PARAM_STR);
        $sth->bindParam(':indice_interalcance', $value['indice_interalcance'], PDO::PARAM_STR);
        $sth->bindParam(':ad_spend', $value['ad_spend'], PDO::PARAM_STR);
        $sth->bindParam(':indice_interaccion_inversion', $value['indice_interaccion_inversion'], PDO::PARAM_STR);
        $sth->bindParam(':indice_interalcance_inversion', $value['indice_interalcance_inversion'], PDO::PARAM_STR);
        $sth->bindParam(':id_adaccount', $value['id_adaccount'], PDO::PARAM_STR);
        $sth->bindParam(':ad_reach', $value['ad_reach'], PDO::PARAM_STR);
        $sth->bindParam(':id_ad', $value['id_ad'], PDO::PARAM_STR);
        $sth->bindParam(':creative_id', $value['creative_id'], PDO::PARAM_STR);
        $sth->bindParam(':fecha_historico', $fecha_historico, PDO::PARAM_STR);
        $sth->execute();
    }
    echo "historico guardado con exito ".$fecha_historico;
} catch(PDOException $e) {
 echo "Oops... {$e->getMessage()}";
}
?>