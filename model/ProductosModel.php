<?php
require_once("Database.php");
class ProductosModel{ 

    public function getInfoProductos()
    {
        $dbh = Database::getInstance();
        $statement=$dbh->prepare("SELECT * FROM `ssg_productos`");
        //$statement->bindParam(':page_id', $arreglo['page_id']);
        $statement->execute();
        $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }

    public function getInfoProductosByPage($arreglo)
    {
        $dbh = Database::getInstance();
        $sql = "SELECT ssg_productos.`id`, ssg_productos.`name`, ssg_productos.`description` 
        FROM `ssg_productos`
        INNER JOIN `ssg_producto_campaign`
        ON ssg_productos.id = ssg_producto_campaign.product_id
        AND ssg_producto_campaign.page_id = :page_id
        GROUP BY ssg_productos.id";
        $statement=$dbh->prepare($sql);
        $statement->bindParam(':page_id', $arreglo['page_id']);
        $statement->execute();
        $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }

    public function getRelacionesProductoCuentas($arreglo)
    {
        $dbh = Database::getInstance();
        $sql = "SELECT ssg_producto_campaign.adaccount_id,ssg_facebook_adaccount.adaccount_name
        FROM `ssg_producto_campaign`
        INNER JOIN `ssg_facebook_adaccount`
        ON ssg_producto_campaign.adaccount_id = ssg_facebook_adaccount.id_adaccount
        WHERE ssg_producto_campaign.product_id = :product_id
        GROUP BY ssg_producto_campaign.adaccount_id";
        $statement=$dbh->prepare($sql);
        $statement->bindParam(':product_id', $arreglo['product_id']);
        $statement->execute();
        $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }
    
    public function getRelacionesproductCampaign($arreglo)
    {
        $dbh = Database::getInstance();
        $sql = "SELECT ssg_producto_campaign.campaign_id,aiw_facebook_data_ads.campaign_name
        FROM `ssg_producto_campaign`
        INNER JOIN `aiw_facebook_data_ads`
        ON ssg_producto_campaign.campaign_id = aiw_facebook_data_ads.campaign_id
        WHERE ssg_producto_campaign.product_id = :product_id
        AND ssg_producto_campaign.page_id = :page_id
        AND ssg_producto_campaign.adaccount_id = :adaccount_id
        GROUP BY ssg_producto_campaign.campaign_id";
        $statement=$dbh->prepare($sql);
        $statement->bindParam(':product_id', $arreglo['product_id']);
        $statement->bindParam(':page_id', $arreglo['page_id']);
        $statement->bindParam(':adaccount_id', $arreglo['adaccount_id']);
        $statement->execute();
        $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }

    public function setValoresProducto($array)
    {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("INSERT INTO `ssg_productos`(`name`, `description`) VALUES (:name,:description)");
        $statement->bindParam(':name', $array['name']);
        $statement->bindParam(':description', $array['description']);
        $statement->execute();
        return $dbh->lastInsertId();
    }
    
    public function updateProducto($array)
    {
        $dbh = Database::getInstance();
        $sth = $dbh->prepare("UPDATE `ssg_productos` SET `name`=:name, `description`=:description WHERE id=:id");
        $sth->bindParam(':id', $array['id']);
        $sth->bindParam(':name', $array['name']);
        $sth->bindParam(':description', $array['description']);
        $sth->execute();
    }
  
    public function deleteProduct($id)
    {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("DELETE FROM `ssg_productos` WHERE `id` =:id");
        $statement->bindParam(':id', $id);
        $statement->execute();
    }

    public function setRelacionProductoCAmpania($array){
        $dbh = Database::getInstance();
        $statement = $dbh->prepare("INSERT INTO  `ssg_producto_campaign`(`product_id`, `page_id`, `adaccount_id`, `campaign_id`)  VALUES (:product_id, :page_id, :adaccount_id, :campaign_id)");
        $statement->bindParam(':product_id', $array['product_id'], PDO::PARAM_STR);
        $statement->bindParam(':page_id', $array['page_id'], PDO::PARAM_STR);
        $statement->bindParam(':adaccount_id', $array['adaccount_id'], PDO::PARAM_STR);
        $statement->bindParam(':campaign_id', $array['campaign_id'], PDO::PARAM_STR);
        $result = $statement->execute();
    }

    public function deleteRelacionProductoCAmpania($array)
    {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("DELETE FROM `ssg_producto_campaign` 
        WHERE product_id=:product_id
        AND page_id=:page_id
        AND adaccount_id=:adaccount_id
        AND campaign_id=:campaign_id");
        $statement->bindParam(':product_id', $array['product_id'], PDO::PARAM_STR);
        $statement->bindParam(':page_id', $array['page_id'], PDO::PARAM_STR);
        $statement->bindParam(':adaccount_id', $array['adaccount_id'], PDO::PARAM_STR);
        $statement->bindParam(':campaign_id', $array['campaign_id'], PDO::PARAM_STR);
        $statement->execute();
    }

    public function deleteAllRelacionsProduct($id)
    {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("DELETE FROM `ssg_producto_campaign` 
        WHERE product_id=:product_id");
        $statement->bindParam(':product_id', $id, PDO::PARAM_STR);
        $statement->execute();
    }

    public function registroexistente($array){
        $dbh = Database::getInstance();
        $statement = $dbh->prepare("SELECT * FROM `ssg_producto_campaign` 
        WHERE product_id=:product_id
        AND page_id=:page_id
        AND adaccount_id=:adaccount_id
        AND campaign_id=:campaign_id");
        $statement->bindParam(':product_id', $array['product_id'], PDO::PARAM_STR);
        $statement->bindParam(':page_id', $array['page_id'], PDO::PARAM_STR);
        $statement->bindParam(':adaccount_id', $array['adaccount_id'], PDO::PARAM_STR);
        $statement->bindParam(':campaign_id', $array['campaign_id'], PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if (count($result)>0) {
            return true;
        }
        return false;
    }
}