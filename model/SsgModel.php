<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require_once("Database.php");
class SsgModel{

    public function insert($table, $rows, $values) {
      $params = rtrim(", ", str_repeat("?, ", count($values)));
      try {
           $dbh = Database::getInstance();
          $stmt = $dbh->prepare("INSERT INTO $table ($rows) VALUES ($params)");
            for($i = 1; $i <= count($values); $i++) {
              $stmt->bindValue($i, $values[$i-1]);
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch(PDOException $e) {
        echo "Oops... {$e->getMessage()}";
      }
    }
    
     public function checkPage($id_facebook_page) {
            $con = Database::getInstance();
            $stmt = $con->prepare("SELECT id_facebook_page FROM ssg_facebook_page WHERE id_facebook_page = :id_facebook_page");
            $stmt->bindParam(':id_facebook_page', $id_facebook_page);
            $stmt->execute();
                if($stmt->rowCount() > 0){
                    return true;
                } else {
                    return false;
                }
            }
            
    public function checkInfoPage($page_id) {
            $con = Database::getInstance();
            $stmt = $con->prepare("SELECT page_id FROM ssg_post_page_facebook WHERE page_id = :page_id");
            $stmt->bindParam(':page_id', $page_id);
            $stmt->execute();
                if($stmt->rowCount() > 0){
                    return true;
                } else {
                    return false;
                }
            }        
    
     public function getPage($id_facebook_page)
        {
         	 try {
			 $dbh = Database::getInstance();
			 $sql = "SELECT * FROM ssg_facebook_page WHERE id_facebook_page = :id_facebook_page";
			 $sth = $dbh->prepare($sql);
			 $sth->bindParam(':id_facebook_page', $id_facebook_page);
			 $sth->execute();
			 $page = $sth->fetchObject();
			 return $page;
			 //return $sql;
			 }catch (PDOException $e) {
			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}   
        }
        
    public function getPostsOfFacebookPage($page_id=null,$dateMin,$dateMax,$paidUnPaid=null,$queryTypePost=null,$orderbyvalue=null)
    	{
    	    try {
    			 $dbh = Database::getInstance();
    			 switch ($orderbyvalue) {
                    case "interacciones":
                        $orderby = " ORDER BY (p.shares+p.comments+p.reactions+p.post_video_views_unique+p.link_clicks) DESC";
                        break;
                    case "reacciones":
                        $orderby = " ORDER BY p.reactions DESC";
                        break;
                    case "compartir":
                        $orderby = " ORDER BY p.shares DESC";
                        break;
                            case "comentario":
                       $orderby = " ORDER BY p.comments DESC";
                        break;
                            case "vistasVideo":
                       $orderby = " ORDER BY p.post_video_views_unique DESC";
                        break;
                            case "clickLinks":
                        $orderby = " ORDER BY p.link_clicks DESC";
                        break;
                         case "alcancetotal":
                        $orderby = " ORDER BY p.reach DESC";
                        break;
                         case "alcancepagado":
                        $orderby = " ORDER BY p.reach_paid DESC";
                        break;
                         case "alcanceorganico":
                        $orderby = " ORDER BY p.reach_organic DESC";
                        break;
                        case "indice_interaccion":
                        $orderby = " ORDER BY p.indice_interaccion DESC";
                        break;
                        case "indice_interalcance":
                        $orderby = " ORDER BY p.indice_interalcance DESC";
                        break;
                        case "inversion":
                        $orderby = " ORDER BY p.inversion DESC";
                        break;
                        case "indice_interaccion_inversion":
                        $orderby = " ORDER BY p.indice_interaccion_inversion DESC";
                        break;
                        case "indice_interalcance_inversion":
                        $orderby = " ORDER BY p.indice_interalcance_inversion DESC";
                        break;
                    default:
                       $orderby = " ORDER BY p.created_time ASC";
                }
                
                switch ($paidUnPaid) {
                    case "nopagados":
                        $wherePaidUnPaid = " AND p.reach_paid = '0' ";
                        break;
                    case "pagados":
                        $wherePaidUnPaid = " AND p.reach_paid > '0' ";
                        break;
                    default:
                       $wherePaidUnPaid = "";
                }
                
                if ($queryTypePost != ""){
                     if (strpos($queryTypePost, 'video') !== false) 
                        {
                            // $otherVideoTypeSql = " AND p.post_video_views_unique = '0' " ;
                             $otherVideoTypeSql = "";
                        } else { $otherVideoTypeSql = "";}
                    $queryTypePost = 'AND p.type IN ('.$queryTypePost.')'.$otherVideoTypeSql;
                                         }
                                  
    			 /*$sql = "SELECT p.`id`,adc.ad_id,p.`page_id`,p.`created_time`,p.`shares`,p.`reach`,p.`comments`,p.`reactions`,p.`post_video_views_unique`,p.`link_clicks`,p.`permalink_url` FROM `post_page_facebook` p LEFT JOIN ad_creative_facebook adc ON adc.object_story_id = p.id AND p.`page_id` = '".$page_id."' WHERE p.`created_time` BETWEEN '".$dateMin."' AND '".$dateMax."' ORDER BY p.id";*/
    			 $sql = "SELECT p.`id`,p.`page_id`,p.`created_time`,p.`message`,p.`picture`,p.`shares`,p.`reach`,p.`reach_paid`,p.`reach_organic`,p.`comments`,p.`reactions`,p.`post_video_views_unique`,p.`link_clicks`,p.`permalink_url`,p.`page_fans`,p.`indice_interaccion`,p.`indice_interalcance`,p.`inversion`, p.`indice_interaccion_inversion`,p.`indice_interalcance_inversion` FROM `ssg_post_page_facebook` p  WHERE p.`page_id` = '".$page_id."' AND p.`created_time` BETWEEN '".$dateMin."' AND '".$dateMax."' ".$wherePaidUnPaid.$queryTypePost.$orderby;
    			 $sth = $dbh->prepare($sql);
    			 $sth->execute();
    			 $posts = $sth->fetchAll();
    			  return $posts; 
    			  //return $sql;
    			 }catch (PDOException $e) {
    			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}
    	}
    	
    public function getPostsOfFacebookPageAndTypes($page_id=null,$dateMin,$dateMax,$paidUnPaid=null,$queryTypePost=null,$subquery=null,$orderbyvalue=null,$exact_search=false)
    {
    	try {
    	    switch ($orderbyvalue) {
                case "interacciones":
                    $orderby = "ORDER BY (posts.shares+posts.comments+posts.reactions+posts.post_video_views_unique+posts.link_clicks) DESC";
                    break;
                case "reacciones":
                    $orderby = "ORDER BY posts.reactions DESC";
                    break;
                case "compartir":
                    $orderby = "ORDER BY posts.shares DESC";
                    break;
                case "comentario":
                   $orderby = "ORDER BY posts.comments DESC";
                    break;
                case "vistasVideo":
                   $orderby = "ORDER BY posts.post_video_views_unique DESC";
                    break;
                case "clickLinks":
                    $orderby = "ORDER BY posts.link_clicks DESC";
                    break;
                case "alcancetotal":
                    $orderby = " ORDER BY posts.reach DESC";
                    break;
                case "alcancepagado":
                    $orderby = " ORDER BY posts.reach_paid DESC";
                    break;
                case "alcanceorganico":
                    $orderby = " ORDER BY posts.reach_organic DESC";
                    break;
                case "indice_interaccion":
                    $orderby = " ORDER BY posts.indice_interaccion DESC";
                    break;
                case "indice_interalcance":
                    $orderby = " ORDER BY posts.indice_interalcance DESC";
                    break;
                case "inversion":
                    $orderby = " ORDER BY posts.inversion DESC";
                    break;
                case "indice_interaccion_inversion":
                    $orderby = " ORDER BY posts.indice_interaccion_inversion DESC";
                    break;
                case "indice_interalcance_inversion":
                    $orderby = " ORDER BY posts.indice_interalcance_inversion DESC";
                    break;
                default:
                   $orderby = "ORDER BY posts.id";
            }
                
            switch ($paidUnPaid) {
                case "nopagados":
                    $wherePaidUnPaid = " AND posts.reach_paid = '0' ";
                    break;
                case "pagados":
                    $wherePaidUnPaid = " AND posts.reach_paid > '0' ";
                    break;
                default:
                   $wherePaidUnPaid = "";
            }
            if ($queryTypePost != ""){
                if (strpos($queryTypePost, 'video') !== false){
                    // $otherVideoTypeSql = " AND post.post_video_views_unique = '0' ";
                    $otherVideoTypeSql = "";
                } else { 
                    $otherVideoTypeSql = "";
                }
                $queryTypePost = 'AND posts.type IN ('.$queryTypePost.')'.$otherVideoTypeSql;
            }
                $cantidad_de_coincidencias=0;
                if (isset($subquery['tipos'])){
                    $tiposSelect = $subquery['tipos'];
                    $srting_subquery = "";
                    foreach ($tiposSelect as $selectedOption){
                        $srting_subquery .= $selectedOption.",";
                    }
                    $cantidad_de_coincidencias +=count($tiposSelect);
                }
                if (isset($subquery['objetivos'])){
                    $objetivosSelect = $subquery['objetivos'];
                    foreach ($objetivosSelect as $selectedOption0){
                        $srting_subquery .= $selectedOption0.",";
                    } 
                    $cantidad_de_coincidencias +=count($objetivosSelect);
                }
                if (isset($subquery['NivelesLibertad'])){
                    $nivelesLibertadSelect = $subquery['NivelesLibertad'];
                    foreach ($nivelesLibertadSelect as $selectedOptionN){
                        $srting_subquery .= $selectedOptionN.",";
                    } 
                    $cantidad_de_coincidencias +=count($nivelesLibertadSelect);
                }
                
                if ($srting_subquery != ""){
                    $srting_subquery = rtrim($srting_subquery,',');
                }

                $srting_subquery = ' AND cpf.valores_catalogacion IN ('.$srting_subquery.')';
  
    		$dbh = Database::getInstance();
    		/*$sql = "SELECT * FROM `ssg_catalogacion_post_facebook` as cpf,(SELECT p.`id` as id,adc.ad_id,p.`page_id`,p.`created_time`,p.`shares`,p.`reach`,p.`comments`,p.`reactions`,p.`post_video_views_unique`,p.`link_clicks`,p.`permalink_url` FROM `post_page_facebook` p LEFT JOIN ad_creative_facebook adc ON adc.object_story_id = p.id AND p.`page_id` = '".$page_id."' WHERE p.`created_time` BETWEEN '".$dateMin."' AND '".$dateMax."'  ORDER BY p.id) as posts WHERE posts.id = cpf.id_post AND cpf.valores_catalogacion IN (".$subquery.") GROUP BY posts.id ORDER BY posts.id";*/
            if ($exact_search == false){
                $sql = "SELECT * FROM `ssg_catalogacion_post_facebook` as cpf,(SELECT p.`id` as id,p.`page_id`,p.`created_time`,p.`message`,p.`picture`,p.`shares`,p.`reach`,p.`reach_paid`,p.`reach_organic`,p.`comments`,p.`reactions`,p.`post_video_views_unique`,p.`link_clicks`,p.`permalink_url`,p.`page_fans`,p.`indice_interaccion`,p.`indice_interalcance`,p.`inversion`,p.`indice_interalcance_inversion`,p.`indice_interaccion_inversion` FROM `ssg_post_page_facebook` p WHERE  p.`page_id` = '".$page_id."' AND p.`created_time` BETWEEN '".$dateMin."' AND '".$dateMax."'  ORDER BY p.id) as posts WHERE posts.id = cpf.id_post ".$wherePaidUnPaid." ".$srting_subquery." GROUP BY posts.id ".$orderby;
            }else{
                $sql = "SELECT * FROM `ssg_catalogacion_post_facebook` as cpf,(SELECT p.`id` as id,p.`page_id`,p.`created_time`,p.`message`,p.`picture`,p.`shares`,p.`reach`,p.`reach_paid`,p.`reach_organic`,p.`comments`,p.`reactions`,p.`post_video_views_unique`,p.`link_clicks`,p.`permalink_url`,p.`page_fans`,p.`indice_interaccion`,p.`indice_interalcance`,p.`inversion`,p.`indice_interalcance_inversion`,p.`indice_interaccion_inversion` FROM `ssg_post_page_facebook` p WHERE  p.`page_id` = '".$page_id."' AND p.`created_time` BETWEEN '".$dateMin."' AND '".$dateMax."'  ORDER BY p.id) as posts WHERE posts.id = cpf.id_post ".$wherePaidUnPaid." ".$srting_subquery." GROUP BY posts.id HAVING COUNT(valores_catalogacion)=".$cantidad_de_coincidencias." ".$orderby;
            }
            $sth = $dbh->prepare($sql);
    		$sth->execute();
    		$posts = $sth->fetchAll();
    		return $posts; 
             //return $sql;
                  
    	}catch (PDOException $e) {
            die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );
        }
    }

 	public function getTypeFromFacebookPost($idPost,$grupo)
        {
         	 try {
			 $dbh = Database::getInstance();
			 $sql = "SELECT * FROM `ssg_catalogacion_post_facebook` cpf, catalogacion c WHERE cpf.valores_catalogacion = c.id AND cpf.`id_post` = '".$idPost."' AND c.grupo = '".$grupo."'";
			 $sth = $dbh->prepare($sql);
			 $sth->execute();
			 $type = $sth->fetchAll();
			 return $type;
			 //return $sql;
			 }catch (PDOException $e) {
			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}   
        }	
        
    public function getCountPostsBetweenDates($page_id=null,$dateMin,$dateMax){
        try {
			 $dbh = Database::getInstance();
			 $sql = "SELECT count(*) as count FROM `post_page_facebook` WHERE `created_time` BETWEEN '".$dateMin."' AND '".$dateMax."' AND page_id = '".$page_id."'";
			 $sth = $dbh->prepare($sql);
			 $sth->execute();
			 $type = $sth->fetchObject();
			 return $type;
			 //return $sql;
			 }catch (PDOException $e) {
			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}
    }     
    
    public function getTypesPosts($page_id){
        try {
			 $dbh = Database::getInstance();
			 $sql = " SELECT `type` FROM `ssg_post_page_facebook` WHERE page_id='".$page_id."' GROUP BY type";
			 $sth = $dbh->prepare($sql);
			 $sth->execute();
			 $type = $sth->fetchAll();
			 return $type;
			 //return $sql;
			 }catch (PDOException $e) {
			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}
    }    
    
    public function getMaxDateFromFacebook($page_id=null)
        {
         	 try {
			 $dbh = Database::getInstance();
			 $sql = "select max(created_time) as created_time from ssg_post_page_facebook WHERE page_id = '".$page_id."'";
			 $sth = $dbh->prepare($sql);
			 $sth->execute();
			 $maxdate = $sth->fetchObject();
			 return $maxdate->created_time; 
			 }catch (PDOException $e) {
			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}   
    }	
    
    public function getMinDateFromFacebook($page_id=null)
        {
         	 try {
			 $dbh = Database::getInstance();
			 $sql = "select min(created_time) as created_time from ssg_post_page_facebook WHERE page_id = '".$page_id."'";
			 $sth = $dbh->prepare($sql);
			 $sth->execute();
			 $mindate = $sth->fetchObject();
			 return $mindate->created_time; 
			 }catch (PDOException $e) {
			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}   
    }
   
     public function getIdAdFacebook($postId)
    {
     	    try {
    			 $dbh = Database::getInstance();
    			 $sql = "SELECT ad_id FROM `ad_creative_facebook` WHERE `object_story_id` = '".$postId."'";
    			 $sth = $dbh->prepare($sql);
    			 $sth->execute();
    			 $spend = $sth->fetchAll();
    			 return $spend;
    			 }catch (PDOException $e) {
    			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}   
    }
    public function getTotalSpendFacebookAd($ad_id=null)
    {
     	    try {
    			 $dbh = Database::getInstance();
    			 $sql = "SELECT SUM(spend) as inversion FROM `aiw_facebook_data_ads` WHERE `ad_id` = '".$ad_id."'";
    			 $sth = $dbh->prepare($sql);
    			 $sth->execute();
    			 $spend = $sth->fetchObject();
    			 return $spend->inversion; 
    			 }catch (PDOException $e) {
    			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}   
    }
    
        public function getTotalReachFacebookAd($ad_id=null)
    {
     	    try {
    			 $dbh = Database::getInstance();
    			 $sql = "SELECT SUM(reach) as alcance_pagado FROM `aiw_facebook_data_ads` WHERE `ad_id` = '".$ad_id."'";
    			 $sth = $dbh->prepare($sql);
    			 $sth->execute();
    			 $reach = $sth->fetchObject();
    			 return $reach->alcance_pagado; 
    			 }catch (PDOException $e) {
    			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}   
    }
    
   public function getOptionsSsg($tipo,$page_id)
    {
     	    try {
    			 $dbh = Database::getInstance();
    			 $sql = "SELECT * FROM `ssg_catalogacion` WHERE `grupo` = '".$tipo."' AND `page_id` = '".$page_id."'";
    			 $sth = $dbh->prepare($sql);
    			 $sth->execute();
    			 $options = $sth->fetchAll();
    			  return $options; 
    			 }catch (PDOException $e) {
    			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}   
    }
    
    public function getFansOfFacebookFanPage($id_page,$end_time)
    {
     	    try {
    			 $dbh = Database::getInstance();
    			 $sql = 'SELECT id_page,page_fans FROM page_fans_facebook WHERE id_page = "'.$id_page.'" AND end_time = "'.$end_time.'"';
    			 $sth = $dbh->prepare($sql);
    			 $sth->execute();
    			 $result = $sth->fetchObject();
    			 if ($result){ return $result; }
    			 }catch (PDOException $e) {
    			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}   
    }
    public function getNameFiltro($id)
    {
        try {
             $dbh = Database::getInstance();
             $sql = "SELECT nombre FROM `catalogacion` WHERE id = '".$id."'";
             $sth = $dbh->prepare($sql);
             $sth->execute();
             $posts = $sth->fetchAll();
             if ($posts){ return $posts; }	
             }catch (PDOException $e) {
              die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}
    }

    
}