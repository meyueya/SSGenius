<?php
require_once("Database.php");

class SsgTopReportModel{

    private $stringSELECT = 'post.`id`, post.`page_id`, post.`created_time`, post.`updated_time`, 
    post.`message`, post.`picture`, post.`permalink_url`, post.`subattachments`, 
    post.`admin_creator`, post.`shares`, post.`promotion_status`, post.`reach_paid`, 
    post.`reach_organic`, post.`reach`, post.`comments`, post.`reactions`, 
    post.`post_video_views_unique`, post.`link_clicks`, post.`type`, post.`page_fans`,
    (post.`shares`+post.`comments`+post.`reactions`+post.`post_video_views_unique`+post.`link_clicks`) interactions,
    post.`indice_interaccion`, post.`indice_interalcance`, 
    post.`indice_interaccion_inversion`, post.`indice_interalcance_inversion`,
    SUM(data_post.ad_spend) AS ad_spend';

    private $queryPostsByAllParameters='';
    private $queryPostsByKpiCatalogacion='';
    private $queryPostsRelleno='';

    public function getPostsByAllParameters($arreglo){
        $dbh = Database::getInstance();

        $sql ="SELECT $this->stringSELECT 
        FROM `ssg_post_page_facebook` post 
            INNER JOIN `ssg_catalogacion_post_facebook` post_cat
                ON post.id = post_cat.id_post
            LEFT JOIN `ssg_facebook_adaccount_data` data_post
                ON post.id = data_post.object_story_id
        WHERE  post.`page_id` = :page_id 
        AND post.`created_time` BETWEEN :dateMin AND :dateMax
        ";
        if($arreglo['tipos_objetivos_IN'] !== ''){
            $sql .=" AND post_cat.valores_catalogacion IN (:tipos_objetivos_IN) ";
        }
        $sql .=" GROUP BY post.id ";
        if ($arreglo['paidUnPaid']=='pagados'){
            $sql .=" HAVING SUM(data_post.ad_spend) > 0 ";
        }elseif ($arreglo['paidUnPaid']=='nopagados') {
            $sql .=" HAVING SUM(data_post.ad_spend) =0 OR SUM(data_post.ad_spend) IS NULL ";
        }
        $sql .= $arreglo['getPostByKpi']; //ese es para traer lo mejores o peores 
        $sql .= " LIMIT 6";//maximo 6 post con las caracteristicas 
        if($arreglo['orderby'] != ''){//aqui va el orden para ser mostrados
            $sql = "SELECT * FROM
                    ( ".$sql." )AS posts ".$arreglo['orderby'];
        }
        $this->queryPostsByAllParameters = $sql;
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':page_id', $arreglo['pageId']);
        $stmt->bindParam(':dateMin', $arreglo['dateMin']);
        $stmt->bindParam(':dateMax', $arreglo['dateMax']);
        if($arreglo['tipos_objetivos_IN'] !== ''){
            $stmt->bindParam(':tipos_objetivos_IN', $arreglo['tipos_objetivos_IN']);
        }
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $posts; 
    }

    public function getPostsByKpiCatalogacion($arreglo){
        $idpost_NOT_IN= $arreglo['idpost_NOT_IN'];
        if($idpost_NOT_IN !== ''){
            $excluirid =" AND post.id NOT IN ($idpost_NOT_IN)";
        }else{$excluirid='';}
        $dbh = Database::getInstance();

        $sql ="SELECT $this->stringSELECT 
        FROM `ssg_post_page_facebook` post 
            INNER JOIN `ssg_catalogacion_post_facebook` post_cat
                ON post.id = post_cat.id_post $excluirid
            LEFT JOIN `ssg_facebook_adaccount_data` data_post
                ON post.id = data_post.object_story_id 
        WHERE  post.`page_id` = :page_id 
        ";
        if($arreglo['tipos_objetivos_IN'] !== ''){
            $sql .=" AND post_cat.valores_catalogacion IN (:tipos_objetivos_IN) ";
        }
        $sql .=" GROUP BY post.id ";
        if ($arreglo['paidUnPaid']=='pagados'){
            $sql .=" HAVING SUM(data_post.ad_spend) > 0 ";
        }elseif ($arreglo['paidUnPaid']=='nopagados') {
            $sql .=" HAVING SUM(data_post.ad_spend) =0 OR SUM(data_post.ad_spend) IS NULL ";
        }
        $sql .= $arreglo['getPostByKpi']; //ese es para traer lo mejores o peores 
        $sql .= " LIMIT ".$arreglo['LIMIT'];
        if($arreglo['orderby'] != ''){//aqui va el orden para ser mostrados
            $sql = "SELECT * FROM
                    ( ".$sql." )AS posts ".$arreglo['orderby'];
        }
        $this->queryPostsByKpiCatalogacion = $sql;
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':page_id', $arreglo['pageId']);
        if($arreglo['tipos_objetivos_IN'] !== ''){
            $stmt->bindParam(':tipos_objetivos_IN', $arreglo['tipos_objetivos_IN']);
        }
       /*  if($arreglo['idpost_NOT_IN'] !== ''){
            //$stmt->bindParam(':idpost_NOT_IN1', $arreglo['idpost_NOT_IN']);
        } */
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //echo json_encode($posts);exit;
        return $posts; 
    }

    public function getPostsRelleno($arreglo){
        $idpost_NOT_IN= $arreglo['idpost_NOT_IN'];
        if($idpost_NOT_IN !== ''){
            $excluirid =" AND post.id NOT IN ($idpost_NOT_IN)";
        }else{$excluirid='';}
        $dbh = Database::getInstance();
        
        $sql ="SELECT $this->stringSELECT 
        FROM `ssg_post_page_facebook` post 
            INNER JOIN `ssg_catalogacion_post_facebook` post_cat
                ON post.id = post_cat.id_post $excluirid
            LEFT JOIN `ssg_facebook_adaccount_data` data_post
                ON post.id = data_post.object_story_id
        WHERE  post.`page_id` = :page_id 
        ";
       /*  if($arreglo['idpost_NOT_IN'] !== ''){
            $sql .=" AND post_cat.valores_catalogacion NOT IN (:idpost_NOT_IN2) ";
        } */
        $sql .=" GROUP BY post.id ";
        if ($arreglo['paidUnPaid']=='pagados'){
            $sql .=" HAVING SUM(data_post.ad_spend) > 0 ";
        }elseif ($arreglo['paidUnPaid']=='nopagados') {
            $sql .=" HAVING SUM(data_post.ad_spend) =0 OR SUM(data_post.ad_spend) IS NULL ";
        }
        $sql .= $arreglo['getPostByKpi']; //ese es para traer lo mejores o peores 
        $sql .= " LIMIT ".$arreglo['LIMIT'];
        if($arreglo['orderby'] != ''){//aqui va el orden para ser mostrados
            $sql = "SELECT * FROM
                    ( ".$sql." )AS posts ".$arreglo['orderby'];
        }
        $this->queryPostsRelleno = $sql;
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':page_id', $arreglo['pageId']);
        /* if($arreglo['idpost_NOT_IN'] !== ''){
            $stmt->bindParam(':idpost_NOT_IN2', $arreglo['idpost_NOT_IN']);
        } */
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $posts; 
    }

    public function unirOrdenarPosts($filtrosAllParameters,$filtrosKpiCatalogacion,$filtrosRelleno){
        $dbh = Database::getInstance();
        $sql="
        ($this->queryPostsByAllParameters)
        UNION
        ($this->queryPostsByKpiCatalogacion)
        ";
        if($this->queryPostsRelleno!=''){
            $sql .="        UNION
            ($this->queryPostsRelleno)"; 
        }
        if($filtrosAllParameters['orderby']!=''){
            $sql .=$filtrosAllParameters['orderby'];
        }else{
            $sql .=$filtrosAllParameters['getPostByKpi'];
        }
        
        $stmt = $dbh->prepare($sql);
        //todos los query
        $stmt->bindParam(':page_id', $filtrosAllParameters['pageId']);
        //primer query
        $stmt->bindParam(':dateMin', $filtrosAllParameters['dateMin']);
        $stmt->bindParam(':dateMax', $filtrosAllParameters['dateMax']);
        //primer y segundo query
        if($filtrosAllParameters['tipos_objetivos_IN'] !== ''){
            $stmt->bindParam(':tipos_objetivos_IN', $filtrosAllParameters['tipos_objetivos_IN']);
        }
      /*   //segundo query
        if($filtrosKpiCatalogacion['idpost_NOT_IN'] !== ''){
            $stmt->bindParam(':idpost_NOT_IN1', $filtrosKpiCatalogacion['idpost_NOT_IN']);
        }
        //tercer query
        if($this->queryPostsRelleno!=''){
            if($filtrosRelleno['idpost_NOT_IN'] !== ''){
                $stmt->bindParam(':idpost_NOT_IN2', $filtrosRelleno['idpost_NOT_IN']);
            }
        } */
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $posts; 
    }
    
}