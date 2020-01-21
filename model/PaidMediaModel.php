<?php
require_once("Database.php");

class PaidMediaModel{

    public function getInfoPageByAccountCampaignFacebook($arreglo){
        $dbh = Database::getInstance();
        $sql = "SELECT campaign_id, campaign_name, date_start, date_stop, objective,
        SUM(reach) AS reach, SUM(impressions) AS impressions, 
        SUM(impressions)/SUM(reach) AS frequency, SUM(spend) AS spend, 
        SUM(`inline_link_clicks`) AS link_clicks
        FROM `aiw_facebook_data_ads`
        WHERE account_id =:account_id
        AND date_stop BETWEEN :desde and :hasta 
        GROUP BY campaign_id
        ";
        $statement=$dbh->prepare($sql);
        $statement->bindParam(':account_id',$arreglo['account_id']);
        $statement->bindParam(':desde',$arreglo['desde']);
        $statement->bindParam(':hasta',$arreglo['hasta']); 
        $statement->execute();
        $results=$statement->fetchAll(PDO::FETCH_ASSOC);
        //echo json_encode($arreglo).$sql;exit;
        return $results;
    }

    public function getIDdPostByCAmpaing($arreglo){
        $dbh = Database::getInstance();
        $sql = "SELECT object_story_id
        FROM `ssg_facebook_adaccount_data`
        WHERE campaign_id =:campaign_id
        GROUP BY object_story_id
        ";
        $statement=$dbh->prepare($sql);
        $statement->bindParam(':campaign_id',$arreglo['campaign_id']);
        $statement->execute();
        $results=$statement->fetchAll(PDO::FETCH_NUM);
        //echo json_encode($results);exit;
        return $results;
    }

    public function getInfoPage_ssg_historico_post_page_facebookByAccountCampaign($arreglo){
        $idpostIN = $arreglo['idpostIN'];
        //en caso dwe que no haya post relacionados
        if ($idpostIN == '') {
            return[[
                'link_clicks'=>null,
                'shares'=>null,
                'reactions'=>null,
                'comments'=>null,
            ]];
        }
        $dbh = Database::getInstance();
        $sql = "SELECT SUM(link_clicks) AS link_clicks, SUM(shares) AS shares, SUM(reactions) AS reactions, SUM(comments) AS comments
        FROM (SELECT historico.`fecha_historico`,MAX(historico.`link_clicks`) AS link_clicks, MAX(historico.`shares`) AS shares,
         MAX(historico.reactions) AS reactions, MAX(historico.comments) as comments
                FROM ssg_historico_post_page_facebook historico
                    WHERE historico.fecha_historico BETWEEN :desde and :hasta
                    AND historico.id_post IN($idpostIN) 
		            GROUP BY  historico.id_post)as info 
        ";
        $statement=$dbh->prepare($sql);
        $statement->bindParam(':desde',$arreglo['desde']);
        $statement->bindParam(':hasta',$arreglo['hasta']);
        $statement->execute();
        $results=$statement->fetchAll(PDO::FETCH_ASSOC);
        //echo $sql;exit;
        return $results;
    }

    public function getInfoPageByAccountCampaignGoogle($arreglo){
        $dbh = Database::getInstance();
        $sql = "SELECT CampaignId, CampaignName, 
        SUM(Impressions) AS impressions,
        FROM `aiw_google_data_ads`
        WHERE Id_keywords_google =:Id_keywords_google
        GROUP BY CampaignId
        AND Date BETWEEN :desde and :hasta 
        ";
        $statement=$dbh->prepare($sql);
        $statement->bindParam(':account_id',$arreglo['account_id']);
        $statement->bindParam(':desde',$arreglo['desde']);
        $statement->bindParam(':hasta',$arreglo['hasta']); 
        $statement->execute();
        $results=$statement->fetchAll(PDO::FETCH_ASSOC);
        //echo json_encode($arreglo).$sql;exit;
        return $results;
    }

    public function getInfoMetaConsumo($arreglo)
    {
        $dbh = Database::getInstance();
        $fechaLike = substr($arreglo['desde'],0,7)."%";
        $sql = "SELECT SUM(cantidad) AS meta
        FROM `ssg_inversion_cuenta_mes` 
        WHERE id_adaccount = :id_adaccount
        AND fecha BETWEEN :desde and :hasta
        OR fecha LIKE '$fechaLike'
        ";
        $statement=$dbh->prepare($sql);
        $statement->bindParam(':id_adaccount',$arreglo['account_id']);
        $statement->bindParam(':desde',$arreglo['desde']);
        $statement->bindParam(':hasta',$arreglo['hasta']);
        $statement->execute();
        $results=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $results[0]['meta']; 
    }
    
    
    public function getProductosASociados($array){
        $dbh = Database::getInstance();
        $statement = $dbh->prepare("SELECT ssg_productos.id,ssg_productos.name
        FROM `ssg_producto_campaign` 
        INNER JOIN ssg_productos
        ON ssg_productos.id=ssg_producto_campaign.product_id
        WHERE ssg_producto_campaign.page_id=:page_id
        AND ssg_producto_campaign.adaccount_id=:adaccount_id
        AND ssg_producto_campaign.campaign_id=:campaign_id");
        $statement->bindParam(':page_id', $array['page_id'], PDO::PARAM_STR);
        $statement->bindParam(':adaccount_id', $array['adaccount_id'], PDO::PARAM_STR);
        $statement->bindParam(':campaign_id', $array['campaign_id'], PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getInfoPage_ssg_page_fans_facebook($arreglo){
        $dbh = Database::getInstance();
        $indicadorSELECT=$arreglo['indicador'];
        $sql = "SELECT $indicadorSELECT,
        YEAR(`end_time`) as anio, month(`end_time`) as mes, WEEK(`end_time`) as semana, DAY(`end_time`) as dia
        FROM `ssg_page_fans_facebook` 
        WHERE id_page =:page_id
        AND end_time BETWEEN :desde and :hasta
        ";
        $sql .= $arreglo['agrupar_por'];
        $statement=$dbh->prepare($sql);
        $statement->bindParam(':page_id',$arreglo['page_id']);
        $statement->bindParam(':desde',$arreglo['desde']);
        $statement->bindParam(':hasta',$arreglo['hasta']);
        $statement->execute();
        $results=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    
    public function getInfoPage_ssg_post_page_facebook($arreglo){
        $dbh = Database::getInstance();
        $indicadorSELECT=$arreglo['indicador'];
        $sql = "SELECT $indicadorSELECT,
        YEAR(`created_time`) as anio, month(`created_time`) as mes, WEEK(`created_time`) as semana, DAY(`created_time`) as dia
        FROM `ssg_post_page_facebook` 
        WHERE page_id =:page_id
        AND created_time BETWEEN :desde and :hasta
        ";
        $sql .= $arreglo['agrupar_por'];
        $statement=$dbh->prepare($sql);
        $statement->bindParam(':page_id',$arreglo['page_id']);
        $statement->bindParam(':desde',$arreglo['desde']);
        $statement->bindParam(':hasta',$arreglo['hasta']);
        $statement->execute();
        $results=$statement->fetchAll(PDO::FETCH_ASSOC);
        //echo $arreglo['indicador'];exit;
        return $results;
    }
    
    public function getInfoPage_ssg_historico_post_page_facebook($arreglo){
        $dbh = Database::getInstance();
        $indicadorSELECT =explode(' ---- ',$arreglo['indicador']);
        $indicadorSELECT1=$indicadorSELECT[0];
        $indicadorSELECT2=$indicadorSELECT[1];
        $sql = "SELECT $indicadorSELECT1,
        YEAR(`fecha_historico`) as anio, month(`fecha_historico`) as mes, WEEK(`fecha_historico`) as semana, DAY(`fecha_historico`) as dia
        FROM (SELECT $indicadorSELECT2,`fecha_historico`
                FROM ssg_historico_post_page_facebook
                    WHERE page_id =:page_id
                    AND fecha_historico BETWEEN :desde and :hasta
		            GROUP BY  id_post)as info 
        ";
        $sql .= $arreglo['agrupar_por'];
        $statement=$dbh->prepare($sql);
        $statement->bindParam(':page_id',$arreglo['page_id']);
        $statement->bindParam(':desde',$arreglo['desde']);
        $statement->bindParam(':hasta',$arreglo['hasta']);
        $statement->execute();
        $results=$statement->fetchAll(PDO::FETCH_ASSOC);
        //echo $indicadorSELECT1.$indicadorSELECT2;exit;
        return $results;
    }

    public function getInfoPage_aiw_facebook_data_ads($arreglo){
        $dbh = Database::getInstance();
        $sql = "SELECT SUM(spend) as spend,
        YEAR(`date_stop`) as anio, month(`date_stop`) as mes, WEEK(`date_stop`) as semana, DAY(`date_stop`) as dia
        FROM `aiw_facebook_data_ads` 
        WHERE account_id =:account_id
        AND objective =:objective
        AND date_stop BETWEEN :desde and :hasta 
        ";
        $sql .= $arreglo["agrupar_por"];
        $statement=$dbh->prepare($sql);
        $statement->bindParam(':account_id',$arreglo['account_id']);
        $statement->bindParam(':objective',$arreglo['objective']);
        $statement->bindParam(':desde',$arreglo['desde']);
        $statement->bindParam(':hasta',$arreglo['hasta']); 
        $statement->execute();
        $results=$statement->fetchAll(PDO::FETCH_ASSOC);
        //echo json_encode($arreglo).$sql;exit;
        return $results;
    }

    public function getInfoPage_aiw_facebook_data_ads_indicador($arreglo){
        $dbh = Database::getInstance();
        $indicadorSELECT=$arreglo['indicador'];
        $objective=$arreglo['objective'];
        $sql = "SELECT $indicadorSELECT,
        YEAR(`date_stop`) as anio, month(`date_stop`) as mes, WEEK(`date_stop`) as semana, DAY(`date_stop`) as dia
        FROM `aiw_facebook_data_ads` 
        WHERE account_id =:account_id
        AND objective IN ($objective)
        AND date_stop BETWEEN :desde and :hasta 
        ";
        $sql .= $arreglo["agrupar_por"];
        $statement=$dbh->prepare($sql);
        $statement->bindParam(':account_id',$arreglo['account_id']);
        $statement->bindParam(':desde',$arreglo['desde']);
        $statement->bindParam(':hasta',$arreglo['hasta']); 
        $statement->execute();
        $results=$statement->fetchAll(PDO::FETCH_ASSOC);
        //echo json_encode($arreglo).$sql;exit;
        return $results;
    }

    public function getNameAccount($id)
    {
        $dbh = Database::getInstance();
        $sql = "SELECT adaccount_name
            FROM ssg_facebook_adaccount
            WHERE id_adaccount =:id_adaccount";
        $statement=$dbh->prepare($sql);
        $statement->bindParam(':id_adaccount',$id);
        $statement->execute();
        $results=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $results[0]['adaccount_name'];
    }
}