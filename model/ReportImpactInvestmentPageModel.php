<?php
require_once("Database.php");

class ReportImpactInvestmentPageModel{

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

    
}