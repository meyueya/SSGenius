<?php
require_once("Database.php");
class CatalogarModel{ 
    
    //valores de catalagocion de los post

    public function getPostsCatalogados($page_id) {
      $dbh = Database::getInstance();
      $statement= $dbh->prepare("SELECT * FROM `ssg_post_page_facebook` WHERE id IN(SELECT DISTINCT(P.id) FROM ssg_post_page_facebook P INNER JOIN ssg_catalogacion_post_facebook C ON P.id=C.id_post) AND `page_id`='".$page_id."' ORDER BY created_time DESC");
      $statement->execute();
      $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
      return $arreglo;
    }

    public function getPostCatalogadoById($post_id) {
      $dbh = Database::getInstance();
      $statement= $dbh->prepare("SELECT * FROM `ssg_post_page_facebook` 
      WHERE id 
      IN(SELECT DISTINCT(P.id) 
      FROM ssg_post_page_facebook P 
      INNER JOIN ssg_catalogacion_post_facebook C 
      ON P.id=C.id_post) 
      AND `id`='".$post_id."'");
      $statement->execute();
      $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
      return $arreglo;
    }

    public function getPostsCatalogadosReporte($page_id) {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("SELECT COUNT(a.id) as cant, a.valores_catalogacion, b.nombre, b.grupo
        FROM ssg_catalogacion_post_facebook a 
        LEFT JOIN ssg_catalogacion b ON a.valores_catalogacion=b.id 
        WHERE a.page_id=$page_id AND b.grupo!='nivelLibertad' 
        GROUP BY valores_catalogacion
        ORDER BY `grupo`");
        $statement->execute();
        $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
      }
    public function getPostsCatalogadosLimit($page_id,$desde,$hasta) {
      $dbh = Database::getInstance();
      $statement= $dbh->prepare("SELECT 
      ssg_post_page_facebook.id, ssg_post_page_facebook.created_time, 
      ssg_post_page_facebook.message, ssg_post_page_facebook.picture, 
      ssg_post_page_facebook.permalink_url, ssg_post_page_facebook.admin_creator, 
      ssg_catalogacion_post_facebook.fecha as fecha_catalogacion
      FROM ssg_post_page_facebook 
      INNER JOIN ssg_catalogacion_post_facebook 
      ON ssg_post_page_facebook.id=ssg_catalogacion_post_facebook.id_post 
      WHERE ssg_post_page_facebook.page_id=$page_id GROUP BY ssg_post_page_facebook.id
      LIMIT $desde, $hasta");
      $statement->execute();
      $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
      return $arreglo;
    }
    public function getCantPostsCatalogados($page_id) {
      $dbh = Database::getInstance();
      $statement= $dbh->prepare("SELECT COUNT(DISTINCT(ssg_post_page_facebook.id)) AS cant_posts_catalogados
      FROM ssg_post_page_facebook 
      INNER JOIN ssg_catalogacion_post_facebook 
      ON ssg_post_page_facebook.id=ssg_catalogacion_post_facebook.id_post 
      WHERE ssg_post_page_facebook.page_id=$page_id");
      $statement->execute();
      $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
      return $arreglo;
    }
    public function getPostsCatalogadosInfoCatalogacion($page_id) {
      $dbh = Database::getInstance();
      $statement= $dbh->prepare("SELECT cpf.id_post, c.id, c.nombre, c.grupo FROM ssg_catalogacion_post_facebook cpf INNER JOIN ssg_catalogacion c ON cpf.valores_catalogacion=c.id AND cpf.page_id='".$page_id."' ORDER BY `cpf`.`id_post` ASC");
      $statement->execute();
      $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
      return $arreglo;
    }
    
    public function getPostsNoCatalogados($page_id, $limit=10) {
      $dbh = Database::getInstance();
      $statement= $dbh->prepare("SELECT * FROM `ssg_post_page_facebook` WHERE id NOT IN(SELECT DISTINCT(P.id) FROM ssg_post_page_facebook P INNER JOIN ssg_catalogacion_post_facebook C ON P.id=C.id_post) AND `page_id`='".$page_id."' ORDER BY created_time DESC LIMIT ".$limit);
      $statement->execute();
      $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
      return $arreglo;
    }

    public function getPostById($post_id) {
      $dbh = Database::getInstance();
      $statement= $dbh->prepare("SELECT * FROM `ssg_post_page_facebook` 
      WHERE id 
      NOT IN(SELECT DISTINCT(P.id) 
      FROM ssg_post_page_facebook P 
      INNER JOIN ssg_catalogacion_post_facebook C ON P.id=C.id_post) 
      AND `id`='".$post_id."'");
      $statement->execute();
      $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
      return $arreglo;
    }


    public function getInfoCatalagocacion($whereSQL=1)
    {
        $dbh = Database::getInstance();
        $statement=$dbh->prepare("SELECT * FROM `ssg_catalogacion_post_facebook` WHERE $whereSQL");
        $statement->execute();
        $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }

    public function getInfoCatalagocacionTotal($page_id)
    {
        $dbh = Database::getInstance();
        $statement=$dbh->prepare("SELECT 
        COUNT(DISTINCT(`id_post`)) as post, 
        MIN(`fecha`) AS fecha_primer_catalogado, 
        MAX(`fecha`) AS fecha_ultimo_catalogado
         FROM `ssg_catalogacion_post_facebook` 
         WHERE page_id=$page_id");
        $statement->execute();
        $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);

        $statement=$dbh->prepare("SELECT COUNT(id) AS total_post FROM `ssg_post_page_facebook` WHERE `page_id`=$page_id");
        $statement->execute();
        $info_page=$statement->fetchAll(PDO::FETCH_ASSOC);
        array_push($arreglo,$info_page[0]);
        return $arreglo;
    }
        
    public function setCatalogacion($array)
    {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("INSERT INTO `ssg_catalogacion_post_facebook`(`valores_catalogacion`, `id_post`, `page_id`, `fecha`) VALUES (:valores_catalogacion,:id_post,:page_id,:fecha)");
        $statement->bindParam(':valores_catalogacion', $array['valores_catalogacion']);
        $statement->bindParam(':id_post', $array['id_post']);
        $statement->bindParam(':page_id', $array['page_id']);
        $statement->bindParam(':fecha', $array['fecha']);
        $statement->execute();
    }

    public function deleteCatalogacion($idpost)
    {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("DELETE FROM `ssg_catalogacion_post_facebook` WHERE `id_post` =:id_post");
        $statement->bindParam(':id_post', $idpost);
        $statement->execute();
    }

    // valores de catalogacion
    
    public function getCatalagocacion($whereSQL=1)
    {
        $dbh = Database::getInstance();
        $statement=$dbh->prepare("SELECT * FROM `ssg_catalogacion` WHERE $whereSQL AND `status`='active'");
        $statement->execute();
        $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }

    public function getGruposCatalogacion($page_id) {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("SELECT DISTINCT(grupo) FROM `ssg_catalogacion` WHERE `page_id`=:id AND `grupo`!='kpi' ");
        $statement->bindParam(':id', $page_id);
        $statement->execute();
        $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
      }

    public function getCatalagocacion_1($page_id)
    {
        $dbh = Database::getInstance();
        $statement=$dbh->prepare("SELECT * FROM `ssg_catalogacion` WHERE `page_id`=:id");
        $statement->bindParam(':id', $page_id);
        $statement->execute();
        $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }
    
    public function getInfoCatalagocacionUnaPagina($page_id)
    {
        $dbh = Database::getInstance();
        $statement=$dbh->prepare("SELECT * FROM `ssg_catalogacion` WHERE `page_id` =:id");
        $statement->bindParam(':id', $page_id);
        $statement->execute();
        $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }

    public function getGruposCatalagocacion()
    {
        $dbh = Database::getInstance();
        $statement=$dbh->prepare("SELECT DISTINCT(grupo) FROM `ssg_catalogacion` ORDER BY `grupo` ASC");
        $statement->execute();
        $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }
             
    public function setValoresCatalogacion($array)
    {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("INSERT INTO `ssg_catalogacion`(`nombre`, `grupo`, `subgrupo`, `status`, `page_id`) VALUES (:nombre,:grupo,:subgrupo,:status,:page_id)");
        $statement->bindParam(':nombre', $array['nombre']);
        $statement->bindParam(':grupo', $array['grupo']);
        $statement->bindParam(':subgrupo', $array['subgrupo']);
        $statement->bindParam(':status', $array['status']);
        $statement->bindParam(':page_id', $array['page_id']);
        $statement->execute();
    }

    public function deleteValoresCatalogacion($id)
    {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("DELETE FROM `ssg_catalogacion` WHERE `id` =:id");
        $statement->bindParam(':id', $id);
        $statement->execute();
    }

    public function deleteTodosLosValoresCatalogacion($page_id)
    {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("DELETE FROM `ssg_catalogacion` WHERE `page_id` =:id");
        $statement->bindParam(':id', $page_id);
        $statement->execute();
    }

    public function updateValoresCatalogacion($array)
    {
        $dbh = Database::getInstance();
        $sth = $dbh->prepare("UPDATE `ssg_catalogacion` SET `nombre`=:nombre, `grupo`=:grupo, `status`=:status, `page_id`=:page_id WHERE id=:id");
        $sth->bindParam(':id', $array['id']);
        $sth->bindParam(':nombre', $array['nombre']);
        $sth->bindParam(':grupo', $array['grupo']);
        $sth->bindParam(':status', $array['status']);
        $sth->bindParam(':page_id', $array['page_id']);
        $sth->execute();
    }
    
    //  public function updateFacebookAiw($array)
    //   {
    //       $dbh = Database::getInstance();
    //       $sth = $dbh->prepare("UPDATE `ssg_facebook_adaccount` SET  `status`=:status,  WHERE id =:id");
    //       $sth->bindParam(':status', $array['status']);
    //       var_dump($array['status']);die;
    //       $sth->execute();
    //     }
    

    public function updateStatusCatalogacion($array)
    {
        $dbh = Database::getInstance();
        $sth = $dbh->prepare("UPDATE `ssg_catalogacion` SET `status`=:status WHERE nombre=:nombre AND  `page_id`=:page_id");
        $sth->bindParam(':nombre', $array['nombre']);
        $sth->bindParam(':status', $array['status']);
        $sth->bindParam(':page_id', $array['page_id']);
        $sth->execute();
    }
}