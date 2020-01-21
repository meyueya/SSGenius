<?php
require_once("Database.php");
class FacebookPageSSGModel{
    
    //valores de catalagocion de los post

    public function getReportesFacebookPage($page_id) {
      $dbh = Database::getInstance();
      $statement= $dbh->prepare("SELECT * FROM `ssg_reporte_facebook_page` WHERE`page_id`='".$page_id."' ORDER BY fecha_creacion DESC");
      $statement->execute();
      $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
      return $arreglo;
    }
    
    public function getReporteFacebookPage($id_unico_reporte) {
      $dbh = Database::getInstance();
      $statement= $dbh->prepare("SELECT * FROM `ssg_reporte_facebook_page` WHERE`id_unico_reporte`='".$id_unico_reporte."'");
      $statement->execute();
      $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
      return $arreglo;
    }
        
    public function setReporteFacebookPage($array)
    {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("INSERT INTO `ssg_reporte_facebook_page`(`id_unico_reporte`, `page_id`, `filtros`, `titulo_reporte`, `contenido_reporte`, `fecha_creacion`) VALUES (:id_unico_reporte,:page_id,:filtros,:titulo_reporte,:contenido_reporte,:fecha_creacion)");
        $statement->bindParam(':id_unico_reporte', htmlspecialchars($array['id_unico_reporte']));
        $statement->bindParam(':page_id', $array['page_id']);
        $statement->bindParam(':filtros', $array['filtros']);
        $statement->bindParam(':titulo_reporte', $array['titulo_reporte']);
        $statement->bindParam(':contenido_reporte', $array['contenido_reporte']);
        $statement->bindParam(':fecha_creacion', $array['fecha_creacion']);
        $statement->execute();
    }

    public function deleteReporteFacebookPage($id_unico_reporte)
    {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("DELETE FROM `ssg_reporte_facebook_page` WHERE `id_unico_reporte` =:id_unico_reporte");
        $statement->bindParam(':id_unico_reporte', $id_unico_reporte);
        $statement->execute();
    }

    public function getNameFiltro($id)
    {
        $dbh = Database::getInstance();
        $sql = "SELECT nombre FROM `ssg_catalogacion` WHERE id = '".$id."'";
        $sth = $dbh->prepare($sql);
        $sth->execute();
        $posts = $sth->fetchAll();
        if ($posts){ return $posts; }	

    }

}