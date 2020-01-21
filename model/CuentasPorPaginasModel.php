<?php
require_once("Database.php");

class CuentasPorPaginasModel{

    public function getCuentasPorPagina($arreglo){
        $page_id =$arreglo['page_id'];
        $dbh = Database::getInstance();
        $sql="SELECT ssg_facebook_adaccount.id_adaccount,ssg_facebook_adaccount.adaccount_name,ssg_cuenta_por_pagina.estado
        FROM `ssg_facebook_adaccount_data` 
        INNER JOIN ssg_facebook_adaccount 
        ON ssg_facebook_adaccount_data.id_adaccount=ssg_facebook_adaccount.id_adaccount
        LEFT JOIN ssg_cuenta_por_pagina
        ON ssg_facebook_adaccount_data.id_adaccount=ssg_cuenta_por_pagina.id_adaccount AND ssg_cuenta_por_pagina.id_user = :id_user
        WHERE `object_story_id` LIKE'$page_id%'
        GROUP BY ssg_facebook_adaccount.id_adaccount
        ";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':id_user', $arreglo['id_user'], PDO::PARAM_STR);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $info; 
    }

    public function getCuentasAprobadasPorPagina($arreglo){
        $page_id =$arreglo['page_id'];
        $dbh = Database::getInstance();
        $sql="SELECT ssg_facebook_adaccount.id_adaccount,ssg_facebook_adaccount.adaccount_name
            FROM `ssg_cuenta_por_pagina`
            INNER JOIN ssg_facebook_adaccount 
            ON ssg_cuenta_por_pagina.id_adaccount=ssg_facebook_adaccount.id_adaccount
            WHERE ssg_cuenta_por_pagina.page_id=:page_id
            AND ssg_cuenta_por_pagina.estado='active'
            GROUP BY ssg_facebook_adaccount.id_adaccount
        ";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':page_id', $arreglo['page_id'], PDO::PARAM_STR);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $info; 
    }

    public function getCuentasPorPaginaUser($array){
        $dbh = Database::getInstance();
        $sql="SELECT `ssg_facebook_adaccount`.`id_adaccount`,`ssg_facebook_adaccount`.`adaccount_name` 
        FROM `ssg_cuenta_por_pagina` 
        INNER JOIN `ssg_facebook_adaccount` 
        ON `ssg_cuenta_por_pagina`.`id_adaccount`=`ssg_facebook_adaccount`.`id_adaccount`
        WHERE `ssg_cuenta_por_pagina`.`estado`='active'
        AND `ssg_cuenta_por_pagina`.`page_id`=:page_id
        AND `ssg_cuenta_por_pagina`.`id_user`=:id_user
        GROUP BY `ssg_cuenta_por_pagina`.`id_adaccount`
        ";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':page_id', $array['page_id'], PDO::PARAM_STR);
        $stmt->bindParam(':id_user', $array['id_user'], PDO::PARAM_STR);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $info; 
    }

    public function getCampaignByAccount($arreglo){
        $dbh = Database::getInstance();
        $sql = "SELECT campaign_id, campaign_name
        FROM `aiw_facebook_data_ads`
        WHERE account_id =:account_id
        GROUP BY campaign_id
        ";
        $statement=$dbh->prepare($sql);
        $statement->bindParam(':account_id',$arreglo['account_id']);
        $statement->execute();
        $results=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public function registroexistente($array){
        $dbh = Database::getInstance();
        $statement = $dbh->prepare("SELECT * FROM `ssg_cuenta_por_pagina` 
        WHERE id_adaccount=:id_adaccount
        AND page_id=:page_id
        AND id_user=:id_user");
        $statement->bindParam(':id_adaccount', $array['id_adaccount'], PDO::PARAM_STR);
        $statement->bindParam(':page_id', $array['page_id'], PDO::PARAM_STR);
        $statement->bindParam(':id_user', $array['id_user'], PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if (count($result)>0) {
            return true;
        }
        return false;
    }

    public function setCuentasPorPagina($array){
        $dbh = Database::getInstance();
        $statement = $dbh->prepare("INSERT INTO  `ssg_cuenta_por_pagina`(`id_adaccount`, `page_id`, `id_user`, `estado`)  VALUES (:id_adaccount, :page_id, :id_user, :estado)");
        $statement->bindParam(':id_adaccount', $array['id_adaccount'], PDO::PARAM_STR);
        $statement->bindParam(':page_id', $array['page_id'], PDO::PARAM_STR);
        $statement->bindParam(':id_user', $array['id_user'], PDO::PARAM_STR);
        $statement->bindParam(':estado', $array['estado'], PDO::PARAM_STR);
        $result = $statement->execute();
    }

    public function updateCuentasPorPagina($array){
        $dbh = Database::getInstance();
        $sql="UPDATE `ssg_cuenta_por_pagina` 
        SET `estado`=:estado 
        WHERE id_adaccount=:id_adaccount
        AND page_id=:page_id
        AND id_user=:id_user";
        $statement = $dbh->prepare($sql);
        $statement->bindParam(':estado', $array['estado'], PDO::PARAM_STR);
        $statement->bindParam(':id_adaccount', $array['id_adaccount'], PDO::PARAM_STR);
        $statement->bindParam(':page_id', $array['page_id'], PDO::PARAM_STR);
        $statement->bindParam(':id_user', $array['id_user'], PDO::PARAM_STR);
        $statement->execute();
    }
}