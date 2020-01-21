<?php
require_once("Database.php");
class ValoresPorPaginaModel{ 

    public function getInfoSSGFactorByPage($arreglo)
    {
        $dbh = Database::getInstance();
        $statement=$dbh->prepare("SELECT * FROM `ssg_valores_por_paginas` WHERE `page_id` =:page_id ");
        $statement->bindParam(':page_id', $arreglo['page_id']);
        $statement->execute();
        $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }
                 
    public function setValoresByPage($array)
    {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("INSERT INTO `ssg_valores_por_paginas`(`page_id`, `valor`, `fecha_inicio`, `fecha_fin`) VALUES (:page_id,:valor,:fecha_inicio,:fecha_fin)");
        $statement->bindParam(':page_id', $array['page_id']);
        $statement->bindParam(':valor', $array['valor']);
        $statement->bindParam(':fecha_inicio', $array['fecha_inicio']);
        $statement->bindParam(':fecha_fin', $array['fecha_fin']);
        $statement->execute();
    }
    
    public function updateValoresByPage($array)
    {
        $dbh = Database::getInstance();
        $sth = $dbh->prepare("UPDATE `ssg_valores_por_paginas` SET `valor`=:valor, `fecha_inicio`=:fecha_inicio, `fecha_fin`=:fecha_fin WHERE id=:id");
        $sth->bindParam(':id', $array['id']);
        $sth->bindParam(':valor', $array['valor']);
        $sth->bindParam(':fecha_inicio', $array['fecha_inicio']);
        $sth->bindParam(':fecha_fin', $array['fecha_fin']);
        $sth->execute();
    }
  
    public function deleteValorPage($id)
    {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("DELETE FROM `ssg_valores_por_paginas` WHERE `id` =:id");
        $statement->bindParam(':id', $id);
        $statement->execute();
    }
    /*  <li id="valores_globales">
                                <a href="./allPageSSG.php">
                                    <span class="sidebar-mini-icon">DV</span>
                                    <span class="sidebar-normal"> Definir Valores </span>
                                </a>
                            </li> */
}