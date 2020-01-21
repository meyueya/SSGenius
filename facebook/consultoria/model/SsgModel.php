<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require("Database.php");
class SsgModel{
    public function __construct(){}
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
    
    public function getPostsOfFacebookPage($page_id=null,$dateMin,$dateMax)
    	{
    	    try {
    			 $dbh = Database::getInstance();
    			 /*$sql = "SELECT p.`id`,adc.ad_id,p.`page_id`,p.`created_time`,p.`shares`,p.`reach`,p.`comments`,p.`reactions`,p.`post_video_views_unique`,p.`link_clicks`,p.`permalink_url` FROM `post_page_facebook` p LEFT JOIN ad_creative_facebook adc ON adc.object_story_id = p.id AND p.`page_id` = '".$page_id."' WHERE p.`created_time` BETWEEN '".$dateMin."' AND '".$dateMax."' ORDER BY p.id";*/
    			 $sql = "SELECT p.`id`,p.`page_id`,p.`created_time`,p.`shares`,p.`reach`,p.`reach_paid`,p.`reach_organic`,p.`comments`,p.`reactions`,p.`post_video_views_unique`,p.`link_clicks`,p.`permalink_url` FROM `post_page_facebook` p  WHERE p.`page_id` = '".$page_id."' AND p.`created_time` BETWEEN '".$dateMin."' AND '".$dateMax."' ORDER BY p.id";
    			 $sth = $dbh->prepare($sql);
    			 $sth->execute();
    			 $posts = $sth->fetchAll();
    			  return $posts; 	
    			 }catch (PDOException $e) {
    			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}
    	}
    	
     public function getPostsOfFacebookPageAndTypes($page_id=null,$dateMin,$dateMax,$subquery=null)
    	{
    	    try {
    	        if ($subquery != ""){$subquery = 'IN ('.$subquery.')';}
    			 $dbh = Database::getInstance();
    			 /*$sql = "SELECT * FROM `catalogacion_post_facebook` as cpf,(SELECT p.`id` as id,adc.ad_id,p.`page_id`,p.`created_time`,p.`shares`,p.`reach`,p.`comments`,p.`reactions`,p.`post_video_views_unique`,p.`link_clicks`,p.`permalink_url` FROM `post_page_facebook` p LEFT JOIN ad_creative_facebook adc ON adc.object_story_id = p.id AND p.`page_id` = '".$page_id."' WHERE p.`created_time` BETWEEN '".$dateMin."' AND '".$dateMax."'  ORDER BY p.id) as posts WHERE posts.id = cpf.id_post AND cpf.valores_catalogacion IN (".$subquery.") GROUP BY posts.id ORDER BY posts.id";*/
    			 $sql = "SELECT * FROM `catalogacion_post_facebook` as cpf,(SELECT p.`id` as id,p.`page_id`,p.`created_time`,p.`shares`,p.`reach`,p.`reach_paid`,p.`reach_organic`,p.`comments`,p.`reactions`,p.`post_video_views_unique`,p.`link_clicks`,p.`permalink_url` FROM `post_page_facebook` p WHERE  p.`page_id` = '".$page_id."' AND p.`created_time` BETWEEN '".$dateMin."' AND '".$dateMax."'  ORDER BY p.id) as posts WHERE posts.id = cpf.id_post AND cpf.valores_catalogacion  ".$subquery." GROUP BY posts.id ORDER BY posts.id";
    			 $sth = $dbh->prepare($sql);
    			 $sth->execute();
    			 $posts = $sth->fetchAll();
    		 	 return $posts; 
    		 	 //return $sql;
    			 }catch (PDOException $e) {
    			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}
    	}
    	

 	    public function getTypeFromFacebookPost($idPost,$grupo)
        {
         	 try {
			 $dbh = Database::getInstance();
			 $sql = "SELECT * FROM `catalogacion_post_facebook` cpf, catalogacion c WHERE cpf.valores_catalogacion = c.id AND cpf.`id_post` = '".$idPost."' AND c.grupo = '".$grupo."'";
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
			 $sql = "select max(created_time) as created_time from post_page_facebook WHERE page_id = '".$page_id."'";
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
			 $sql = "select min(created_time) as created_time from post_page_facebook WHERE page_id = '".$page_id."'";
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
    
   public function getOptionsSsg($tipo)
    {
     	    try {
    			 $dbh = Database::getInstance();
    			 $sql = "SELECT * FROM `catalogacion` WHERE `grupo` = '".$tipo."'";
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