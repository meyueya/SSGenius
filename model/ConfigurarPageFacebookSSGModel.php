<?php
require_once("Database.php");
class ConfigurarPageFacebookSSGModel{
    
    //valores de configuracion de la paginas 

    public function getValoresConfig() {
      $dbh = Database::getInstance();
      $statement= $dbh->prepare("SELECT * FROM `ssg_configuracion_page_facebook`");
      $statement->execute();
      $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
      return $arreglo;
    }

    public function getGruposValoresConfig() {
      $dbh = Database::getInstance();
      $statement= $dbh->prepare("SELECT DISTINCT(grupo) FROM `ssg_configuracion_page_facebook`");
      $statement->execute();
      $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
      return $arreglo;
    }

    public function getPaginasConfiguradas() {
      $dbh = Database::getInstance();
      $statement= $dbh->prepare("SELECT DISTINCT(page_id) FROM `ssg_catalogacion`");
      $statement->execute();
      $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
      return $arreglo;
    }
    
    
    public function getValuesPaginasConfiguradas() {
      $dbh = Database::getInstance();
      $statement= $dbh->prepare("SELECT DISTINCT id_adaccount, id_facebook, adaccount_name, adaccount_status , aiw_status FROM ssg_facebook_adaccount");
      $statement->execute();
      $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
      return $arreglo;
    }

    public function getValoresPaginaConfiguradas($page_id) {
      $dbh = Database::getInstance();
      $statement= $dbh->prepare("SELECT * FROM `ssg_catalogacion` WHERE `page_id`=$page_id");
      $statement->execute();
      $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
      return $arreglo;
    }

    public function getAllPageSSG() {
      $dbh = Database::getInstance();
      $statement= $dbh->prepare("SELECT 
      ssg_facebook_page.*,
      COUNT(ssg_post_page_facebook.id) AS cant_post, 
      MIN(ssg_post_page_facebook.created_time) AS fecha_primer_post,
      MAX(ssg_post_page_facebook.created_time) AS fecha_ultimo_post
      FROM `ssg_facebook_page`
      LEFT JOIN `ssg_post_page_facebook` 
      ON ssg_facebook_page.id_facebook_page=ssg_post_page_facebook.page_id
      GROUP BY ssg_facebook_page.id_facebook_page");
      $statement->execute();
      $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
      return $arreglo;
    }

    public function setConfigPage($array){
      $dbh = Database::getInstance();
      $statement= $dbh->prepare("INSERT INTO `ssg_configuracion_page_facebook` (`nombre`, `grupo`, `subgrupo`, `descripcion`) VALUES (:nombre, :grupo, :subgrupo, :descripcion)");
      $statement->bindParam(':nombre', $array['nombre'], PDO::PARAM_STR);
      $statement->bindParam(':grupo', $array['grupo'], PDO::PARAM_STR);
      $statement->bindParam(':subgrupo', $array['subgrupo'], PDO::PARAM_STR);
      $statement->bindParam(':descripcion', $array['descripcion'], PDO::PARAM_STR);
      $result = $statement->execute(); 
  }

}