<?php
require_once("Database.php");

class AiwFacebookDemograficoModel{

    public function getInfoFaceDEmografico($arreglo){
         
        $dbh = Database::getInstance();
        $sql="SELECT `date_start`,`ad_id`,`campaign_name`,`ad_name`,`age`,`gender`,
        sum(`impressions`) as impressions,sum(`clicks`) as clicks,sum(`spend`) as spend, 
        COUNT(`ad_name`) as totalcampos
        FROM aiw_facebook_data_ads
        -- WHERE  `adset_id` = 23843549308390497
        -- WHERE  `account_id` = 1487762988004826
        AND `date_stop` BETWEEN :dateMin AND :dateMax
        GROUP BY `ad_name`,`gender`,`age`
        ";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':dateMin', $arreglo['dateMin']);
        $stmt->bindParam(':dateMax', $arreglo['dateMax']);
        $stmt->execute();
        $infoFaceDemog = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $infoFaceDemog; 
    }

    public function getAnuncios($arreglo){
         
        $dbh = Database::getInstance();
        $sql="SELECT DISTINCT(`ad_name`)
        FROM aiw_facebook_data_ads
        -- WHERE  `account_id` = 1487762988004826
        -- WHERE  `adset_id` = 23843549308390497
        ";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $info; 
    }

}