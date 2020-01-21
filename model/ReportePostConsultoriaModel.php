<?php
require_once("Database.php");
class ReportePostConsultoriaModel{

    public $page_name;

    public function getIdDesempenioPautaPost($page_id){
        $hasta = date("Y-m-d");
        $desde = date("Y-m-d",strtotime($hasta."- 7 days")); 
        $unDiaAntes = date("Y-m-d",strtotime($hasta."- 8 days")); //si tenia pauta ese dia ya no me interesa el post
        $con = Database::getInstance();
		$sql = "SELECT id_post 
        FROM `ssg_historico_post_page_facebook`
        WHERE page_id = :page_id
        AND id_post IN (SELECT id_post 
        FROM `ssg_historico_post_page_facebook`
        WHERE fecha_historico LIKE '%$unDiaAntes%'
        AND ad_spend IN(0,NULL)
        GROUP BY `id_post`)
        AND fecha_historico BETWEEN :desde AND :hasta
        AND ad_spend>0
        GROUP BY `id_post`
        ";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':page_id', $page_id, PDO::PARAM_STR);        
        $stmt->bindParam(':desde', $desde, PDO::PARAM_STR);        
        $stmt->bindParam(':hasta', $hasta, PDO::PARAM_STR);        
       // $stmt->bindParam(':unDiaAntes', $unDiaAntes, PDO::PARAM_STR);        
        $stmt->execute();
        $arreglo = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }

    public function getInfoHistoricoPostByDate($id_post){
        $hasta = date("Y-m-d");
        //resto 1 día
        $desde = date("Y-m-d",strtotime($hasta."- 14 days")); 
        $con = Database::getInstance();
		$sql = "SELECT  `id`, `id_post`, `page_id`, `updated_time`, 
        `message`, `shares`, `promotion_status`, `reach_paid`, 
        `reach_organic`, `reach`, `comments`, `reactions`, 
        `post_video_views_unique`, `link_clicks`, `type`, 
        `page_fans`, `indice_interaccion`, `indice_interalcance`, 
        SUM(`ad_spend`) as ad_spend, `indice_interaccion_inversion`, `indice_interalcance_inversion`, 
        `id_adaccount`, `ad_reach`, `id_ad`, `creative_id`, `fecha_historico`
        FROM ssg_historico_post_page_facebook 
        WHERE id_post=:id_post
        AND fecha_historico >:desde
        GROUP BY `fecha_historico`
        ORDER BY id DESC
        ";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_post', $id_post, PDO::PARAM_STR);     
        $stmt->bindParam(':desde', $desde, PDO::PARAM_STR);        
        //$stmt->bindParam(':hasta', $hasta, PDO::PARAM_STR);      
        $stmt->execute();
        $arreglo = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }

    public function getInfoHistoricoPost($id_post){
        $con = Database::getInstance();
		$sql = "SELECT  `id`, `id_post`, `page_id`, `updated_time`, 
        `message`, `shares`, `promotion_status`, `reach_paid`, 
        `reach_organic`, `reach`, `comments`, `reactions`, 
        `post_video_views_unique`, `link_clicks`, `type`, 
        `page_fans`, `indice_interaccion`, `indice_interalcance`, 
        SUM(`ad_spend`) as ad_spend, `indice_interaccion_inversion`, `indice_interalcance_inversion`, 
        `id_adaccount`, `ad_reach`, `id_ad`, `creative_id`, `fecha_historico`
        FROM ssg_historico_post_page_facebook 
        WHERE id_post=:id_post
        GROUP BY `fecha_historico`";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_post', $id_post, PDO::PARAM_STR);        
        $stmt->execute();
        $arreglo = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }

    public function getInfoPost($id_post){
        $con = Database::getInstance();
		$sql = "SELECT *
        FROM ssg_post_page_facebook 
        WHERE id=:id_post";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_post', $id_post, PDO::PARAM_STR);        
        $stmt->execute();
        $arreglo = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }

    public function setPageName($id_page){
        $con = Database::getInstance();
		$sql = "SELECT `name`
        FROM ssg_facebook_page 
        WHERE id_facebook_page=:id_page";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_page', $id_page, PDO::PARAM_STR);        
        $stmt->execute();
        $page_name=$stmt->fetchObject();
        $this->page_name=$page_name->name;
    }

    public function getInfoConsultoriaYAnalisisPadre($id_analisis,$id_page,$id_consultoria){
        $con = Database::getInstance();
        $sql=" SELECT consultoria.titulo_consultoria,consultoria.titulo AS titulo_analisis_padre,
        consultoria.tipo,consultoria.objetivo,consultoria.kpi_principal,consultoria.fecha
        FROM ssg_consultoria consultoria
        WHERE id_consultoria=:id_consultoria AND page_id=:id_page AND id_analisis=:id_analisis
        LIMIT 1";
        $statement=$con->prepare($sql);
        $statement->bindParam(':id_analisis',$id_analisis);
        $statement->bindParam(':id_consultoria',$id_consultoria);
        $statement->bindParam(':id_page',$id_page);
        $statement->execute();
        $arreglo = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }

    public function getInfoKpisAnalisisPadre($id_analisis,$id_page,$id_consultoria){
        $con = Database::getInstance();
        $sql=" SELECT kpi
        FROM ssg_consultoria consultoria
        WHERE id_consultoria=:id_consultoria AND page_id=:id_page AND id_analisis=:id_analisis AND kpi!=kpi_principal ";
        $statement=$con->prepare($sql);
        $statement->bindParam(':id_analisis',$id_analisis);
        $statement->bindParam(':id_consultoria',$id_consultoria);
        $statement->bindParam(':id_page',$id_page);
        $statement->execute();
        $arreglo = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
    }

    public function getNombreDeTablaCatalogacion($id){
        $con = Database::getInstance();
		$sql = "SELECT nombre
        FROM ssg_catalogacion 
        WHERE id=:id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);        
        $stmt->execute();
        $objeto = $stmt->fetchObject();
        $nombre = $objeto->nombre;
        return $nombre;
    }
    
    public function getNombreDeTablaKPI($id){
        $con = Database::getInstance();
		$sql = "SELECT nombre
        FROM ssg_kpi
        WHERE id=:id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);        
        $stmt->execute();
        $objeto = $stmt->fetchObject();
        $nombre = $objeto->nombre;
        return $nombre;
    }
    
    public function getKPIs($grupo){
        $con = Database::getInstance();
		$sql = "SELECT * FROM `ssg_kpi` WHERE grupo=:grupo";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':grupo', $grupo, PDO::PARAM_STR);        
        $stmt->execute();
        $objeto = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $objeto;
    }
}