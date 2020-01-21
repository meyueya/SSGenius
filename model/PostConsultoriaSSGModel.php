<?php
require_once("Database.php");

class PostConsultoriaSSGModel{ 

    public function getAnalisisConsultoria($id_consultoria,$page_id){
        $connection = Database::getInstance();
        $statement = $connection->prepare("SELECT * FROM `ssg_consultoria` 
        WHERE `id_consultoria`=:id_consultoria AND `page_id`=:page_id 
        GROUP BY id_analisis");
        $statement->bindParam(':page_id', $page_id, PDO::PARAM_STR);
        $statement->bindParam(':id_consultoria', $id_consultoria, PDO::PARAM_STR);        
        $statement->execute();
        $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }
    
    public function getTiposAnalisis($id_analisis,$id_consultoria,$page_id){
        $connection = Database::getInstance();
        $statement = $connection->prepare("SELECT analisis.tipo_analisis AS id_tipo_analisis ,tipos.nombre
        FROM `ssg_analisis_consultoria` analisis
        INNER JOIN `ssg_tipos_analisis` tipos
        ON analisis.tipo_analisis=tipos.id
        WHERE `id_consultoria`=:id_consultoria AND analisis.`page_id`=:page_id AND analisis.`nanalisis`=:id_analisis 
        GROUP BY analisis.tipo_analisis");
        $statement->bindParam(':id_analisis', $id_analisis, PDO::PARAM_STR);        
        $statement->bindParam(':id_consultoria', $id_consultoria, PDO::PARAM_STR);        
        $statement->bindParam(':page_id', $page_id, PDO::PARAM_STR);
        $statement->execute();
        $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }

    public function getInfoAnalisisConTipoAna($id_tipo_analisis,$id_analisis,$id_consultoria,$page_id){
        $connection = Database::getInstance();
        $statement= $connection->prepare("SELECT ssg_analisis_consultoria.*,ssg_tipos_analisis.nombre AS nombre_tipo_analisis 
        FROM ssg_analisis_consultoria 
        INNER JOIN ssg_tipos_analisis
        ON ssg_analisis_consultoria.tipo_analisis=ssg_tipos_analisis.id
        WHERE ssg_analisis_consultoria.`id_consultoria`=:id_consultoria AND ssg_analisis_consultoria.`page_id`=:page_id AND ssg_analisis_consultoria.`nanalisis`=:id_analisis AND ssg_analisis_consultoria.`tipo_analisis`=:id_tipo_analisis ");
        $statement->bindParam(':id_tipo_analisis', $id_tipo_analisis, PDO::PARAM_STR);        
        $statement->bindParam(':id_analisis', $id_analisis, PDO::PARAM_STR);        
        $statement->bindParam(':id_consultoria', $id_consultoria, PDO::PARAM_STR);
        $statement->bindParam(':page_id', $page_id, PDO::PARAM_STR);
        $statement->execute();
        $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }


    public function getPostRecientes($page_id){ 
        $desde=date('Y-m-d', strtotime('-7 day'));
        $connection = Database::getInstance();
        $statement = $connection->prepare("SELECT id,created_time,picture FROM `ssg_post_page_facebook` WHERE `created_time`>=:created_time AND `page_id`=:page_id");
        $statement->bindParam(':page_id', $page_id, PDO::PARAM_STR);
        $statement->bindParam(':created_time', $desde, PDO::PARAM_STR);        
        $statement->execute();
        $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }

        
    public function getPostsGeneradosPorAnalisis($id_analisis,$id_consultoria,$page_id){
        $connection = Database::getInstance();
        $statement = $connection->prepare("SELECT *
        FROM `ssg_consultoria_generarpost`
        WHERE `id_consultoria`=:id_consultoria AND `page_id`=:page_id AND `analisis_padre`=:id_analisis 
        GROUP BY post");
        $statement->bindParam(':id_analisis', $id_analisis, PDO::PARAM_STR);        
        $statement->bindParam(':id_consultoria', $id_consultoria, PDO::PARAM_STR);        
        $statement->bindParam(':page_id', $page_id, PDO::PARAM_STR);
        $statement->execute();
        $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }

      
    public function setPostConsultoria($array){
        $dbh = Database::getInstance();
        $statement = $dbh->prepare("INSERT INTO `ssg_consultoria_generarpost`(`id_consultoria`, `page_id`, `post`, `id_analisis`, `analisis_padre`, `fecha`, `post_id`) VALUES (:id_consultoria, :page_id, :post, :id_analisis, :analisis_padre, :fecha, :post_id)");
        $statement->bindParam(':id_consultoria', $array['id_consultoria'], PDO::PARAM_STR);
        $statement->bindParam(':post', $array['post'], PDO::PARAM_STR);
        $statement->bindParam(':id_analisis', $array['analisis'], PDO::PARAM_STR);
        $statement->bindParam(':analisis_padre', $array['analisis_padre'], PDO::PARAM_STR);
        $statement->bindParam(':fecha', $array['fecha'], PDO::PARAM_STR);
        $statement->bindParam(':page_id', $array['page_id'], PDO::PARAM_STR);
        $statement->bindParam(':post_id', $array['post_id'], PDO::PARAM_STR);
        $result = $statement->execute();
    }
    
    public function getMaxIDPostAnalisis($id_consultoria,$page_id){
        $dbh = Database::getInstance();
        $statement=$dbh->prepare("SELECT max(`post`) as max FROM `ssg_consultoria_generarpost` WHERE `page_id`=$page_id AND `id_consultoria`=$id_consultoria");
        $statement->execute();
        $maximo=$statement->fetch();	
        return $maximo;
    }
    
    public function deletePostConsultoria($id_consultoria,$page_id,$post){
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("DELETE FROM `ssg_consultoria_generarpost` WHERE `id_consultoria`=:id_consultoria AND `page_id` =:page_id AND `post` =:post");
        $statement->bindParam(':id_consultoria', $id_consultoria);
        $statement->bindParam(':page_id', $page_id);
        $statement->bindParam(':post', $post);
        $statement->execute();
    }
}