<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require_once("Database.php");
class ReporteFacebookModel{

    function getInformesFB($id_page){
        $dbh = Database::getInstance();
        $statement = $dbh->prepare("SELECT * FROM `ssg_informes_fb` WHERE id_page=$id_page GROUP BY `id_inf`");
        $statement->execute();
        $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }

    function getInformeFB($id_page,$id_inf_fb){
        $dbh = Database::getInstance();
        $statement = $dbh->prepare("SELECT * FROM `ssg_informes_fb` WHERE id_page=$id_page AND id_inf=$id_inf_fb");
        $statement->execute();
        $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }

    public function getMaxIDInformeFB($id_page)
    {
        $dbh = Database::getInstance();
        $statement  = $dbh->prepare("SELECT MAX(`id_inf`) as maximo FROM ssg_informes_fb WHERE id_page=$id_page ");
        $statement->execute();
        $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }

    public function setReporteFB($array)
    {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("INSERT INTO ssg_informes_fb (id_inf, titulo_reporte, id_page, fecha, fecha_comparacion, periodo) VALUES (:id_inf, :titulo_reporte, :id_page, :fecha, :fecha_comparacion, :periodo)");
        $statement->bindParam(':id_inf', $array['id_inf']);
        $statement->bindParam(':titulo_reporte', $array['titulo_reporte']);
        $statement->bindParam(':id_page', $array['id_page']);
        $statement->bindParam(':fecha', $array['fecha']);
        $statement->bindParam(':fecha_comparacion', $array['fecha_comparacion']);
        $statement->bindParam(':periodo', $array['periodo']);
        $statement->execute();
    }
    
    public function deleteInformeFB($id_inf_fb)
    {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("DELETE FROM `ssg_informes_fb` WHERE `id_inf`=:id_inf");
        $statement->bindParam(':id_inf', $id_inf_fb);
        $statement->execute();
    }

    public function setComentsInformeFB($array)
    {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("INSERT INTO ssg_informes_fb (id_inf, titulo_reporte, id_page, id_com, comentario, fecha, fecha_comparacion, periodo) VALUES (:id_inf, :titulo_reporte, :id_page, :id_com, :comentario, :fecha, :fecha_comparacion, :periodo)");
        $statement->bindParam(':id_inf', $array['id_inf']);
        $statement->bindParam(':titulo_reporte', $array['titulo_reporte']);
        $statement->bindParam(':id_page', $array['id_page']);
        $statement->bindParam(':id_com', $array['id_com']);
        $statement->bindParam(':comentario', $array['comentario']);
        $statement->bindParam(':fecha', $array['fecha']);
        $statement->bindParam(':fecha_comparacion', $array['fecha_comparacion']);
        $statement->bindParam(':periodo', $array['periodo']);
        $statement->execute();
    }

    public function updateComentsInformeFB($array){
        $dbh = Database::getInstance();
        $sth = $dbh->prepare("UPDATE `ssg_informes_fb` SET comentario = :comentario WHERE id_inf = :id_inf and id_com = :id_com");
        $sth->bindParam(':comentario', $array['comentario']);
        $sth->bindParam(':id_inf', $array['id_inf']);
        $sth->bindParam(':id_com', $array['id_com']);
        $sth->execute();
    }

}