<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("Database.php");
class FacebookModel{
     public function __construct(){}
     
     public function getFacebookPostPageJob($id_ssgfacebookpostpagejob)
            {   
                $conec = Database::getInstance();
                         $stm = $conec->prepare("SELECT id_ssgfacebookpostpagejob, id_adaccount,clicks_restart_day FROM `ssg_facebook_page_primera_carga` WHERE clicks_status='1' LIMIT 1");
                         $stm->execute();
                         $job = $stm->fetchAll();
                         $lastdate = $job['0']['1'];//id_account
                         $lastdate1 =$job['0']['0'];//id_ssg
                         $lastdate2 =$job['0']['2'];//fecha
                       
        
                         $diaconsulta = date(strtotime("$lastdate2")); // la primera vez que comience a jalar datos
                         $now = date ('Y-m-d');
                         $today = date(strtotime("$now"));
                         $diaconsultabreak = date(strtotime("$lastdate2"));
                           $totaldia = (($today - $diaconsultabreak  -86400 )/86400);
                          //echo'Dias: ';
                         //var_dump($lastdate2);
                        // die;
                       
                        $id_ssgfacebookpostpagejob = $lastdate1;
                         try {
        			 $dbh = Database::getInstance();
        			 $sql = "SELECT * FROM `ssg_facebook_post_page_job` WHERE `id_ssgfacebookpostpagejob` = :id_ssgfacebookpostpagejob";
        			 $sth = $dbh->prepare($sql);
        			 $sth->bindParam(':id_ssgfacebookpostpagejob', $id_ssgfacebookpostpagejob, PDO::PARAM_STR);
        			 $sth->execute();
        			 $field = $sth->fetchObject();
        		         // echo "<pre>";
        			 //var_dump($field);
        			 // echo "</pre>";
        			 //die;
        			 
        			 return $field;
        			 }catch (PDOException $e) {
        			     return false;
        			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );  
                                  
                       
                                 }    
            } 
     public function savePageCTAClicks($id_page,$page,$pageDate)
     {
         
        
                         $conec = Database::getInstance();
                         $stm = $conec->prepare("SELECT id_ssgfacebookpostpagejob, id_adaccount,clicks_restart_day FROM `ssg_facebook_page_primera_carga` WHERE clicks_status='1' LIMIT 1 ");
                         $stm->execute();
                         $job = $stm->fetchAll();
                         //var_dump($job);
                         $lastdate = $job['0']['1'];//id_account
                         $lastdate1 =$job['0']['0'];//id_ssg
                         $lastdate2 =$job['0']['2'];//fecha
        
                         $diaconsulta = date(strtotime("$lastdate2")); // la primera vez que comience a jalar datos
                         $now = date ('Y-m-d');
                         $today = date(strtotime("$now"));
                         $diaconsultabreak = date(strtotime("$lastdate2"));
                        // var_dump($job);
                           $totaldia = (($today - $diaconsultabreak  -86400 )/86400);
                           //var_dump($totaldia);
                           //die;
                        
                $id_ssgfacebookpostpagejob = $lastdate1;
        $conec = Database::getInstance();
        
        
        try
        {
            $conec->beginTransaction();
            $statement = $conec->prepare("INSERT INTO `ssg_facebook_page_cta_clicks`
            (`id_page`,
            `page_fans`,
            `page_total_actions`,
            `page_cta_clicks_by_site_logged_in_unique_mobile`,
            `page_cta_clicks_by_site_logged_in_unique_other`,
            `page_call_phone_clicks_by_site_logged_in_unique`,
            `page_get_directions_clicks_logged_in_unique`,
            `page_get_directions_clicks_by_site_logged_in_unique`,
            `page_website_clicks_by_site_logged_in_unique`,
            `end_time`


          


            )VALUES(
            :id_page,
            :page_fans,
            :page_total_actions,
            :page_cta_clicks_by_site_logged_in_unique_mobile,
            :page_cta_clicks_by_site_logged_in_unique_other,
            :page_call_phone_clicks_by_site_logged_in_unique,
            :page_get_directions_clicks_logged_in_unique,
            :page_get_directions_clicks_by_site_logged_in_unique,
            :page_website_clicks_by_site_logged_in_unique,
            :end_time )");
            
            $statement->bindParam(':id_page', $id_page, PDO::PARAM_STR);
            $statement->bindParam(':page_fans', $page['page_fans']);
            $statement->bindParam(':page_total_actions', $page['page_total_actions']);
            $statement->bindParam(':page_cta_clicks_by_site_logged_in_unique_mobile', $page_cta_clicks_by_site_logged_in_unique['MOBILE']);
            $statement->bindParam(':page_cta_clicks_by_site_logged_in_unique_other', $page_cta_clicks_by_site_logged_in_unique["OTHER"]);
            $statement->bindParam(':page_call_phone_clicks_by_site_logged_in_unique', $page['page_call_phone_clicks_by_site_logged_in_unique']['']);
            $statement->bindParam(':page_get_directions_clicks_logged_in_unique', $page['page_get_directions_clicks_logged_in_unique']);
            $statement->bindParam(':page_get_directions_clicks_by_site_logged_in_unique', $page['page_get_directions_clicks_by_site_logged_in_unique']['']);
            $statement->bindParam(':page_website_clicks_by_site_logged_in_unique', $page['page_website_clicks_by_site_logged_in_unique']['']);
            $statement->bindParam(':end_time', $pageDate["page_fans"]);

       

                          $conec = Database::getInstance();
                          $stm = $conec->prepare("update `ssg_facebook_page_primera_carga` set  clicks_restart_day= ADDDATE(clicks_restart_day, INTERVAL  1 DAY)    where id_ssgfacebookpostpagejob=$id_ssgfacebookpostpagejob  ");
                          $stm->execute();
                          $conec = Database::getInstance();
                          $yesterday = date( "Y-m-d", strtotime( "-1 day", strtotime( $now ) ) );
                          $stm = $conec->prepare("update `ssg_facebook_page_primera_carga` set clicks_status='2' where clicks_restart_day='$yesterday' ");
                          $stm->execute();

                          $statement->execute();
                  $conec->commit();
                  $save = true;
    // echo "<pre>";
    // var_dump($statement);
    // echo"</pre>";
    //   die;
        } catch (PDOException $e) {
             $conec->rollback();
            //error_log("Hubo un error en ".__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage(), 0);
            sendMailer("pedro@mimirwell.com","Hubo un error en guardado de page fans",__FUNCTION__." id_page: ".$id_page." ! en ".__FILE__." \n ".$e->getMessage());
              $save = false;
        }
    return $save;
}
         
     }
