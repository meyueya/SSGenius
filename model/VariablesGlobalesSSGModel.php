<?php
require_once("Database.php");
class VariablesGlobalesSSGModel{ 

    public function getSSGFactor($arreglo){
         
        $dbh = Database::getInstance();
        $sql="SELECT valor
        FROM ssg_valores_por_paginas
        WHERE  `page_id` = :page_id
        AND `fecha_inicio` <= :hoy
        AND `fecha_fin` >= :hoy
        ";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':page_id', $arreglo['page_id']);
        $stmt->bindParam(':hoy', $arreglo['hoy']);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $info; 
    }
    
}