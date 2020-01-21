<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("Database.php");
class FacebookModel{
     public function __construct(){}
     
     public function getFacebookPostPageJob($id_ssgfacebookpostpagejob)
            {   
               
               
                        $conec = Database::getInstance();
                         $stm = $conec->prepare("SELECT id_ssgfacebookpostpagejob, id_adaccount,video_restart_day FROM `ssg_facebook_page_primera_carga` WHERE video_status='1' LIMIT 1");
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
     public function savepageVideoViews($id_page,$page,$pageDate)
     {
         
         
         
                         $conec = Database::getInstance();
                         $stm = $conec->prepare("SELECT id_ssgfacebookpostpagejob, id_adaccount,video_restart_day FROM `ssg_facebook_page_primera_carga` WHERE video_status='1' LIMIT 1 ");
                         $stm->execute();
                         $job = $stm->fetchAll();
                         $lastdate = $job['0']['1'];//id_account
                         $lastdate1 =$job['0']['0'];//id_ssg
                         $lastdate2 =$job['0']['2'];//fecha
        
                         $diaconsulta = date(strtotime("$lastdate2")); // la primera vez que comience a jalar datos
                         $now = date ('Y-m-d');
                         $today = date(strtotime("$now"));
                         $diaconsultabreak = date(strtotime("$lastdate2"));
                         //var_dump($job);
                           $totaldia = (($today - $diaconsultabreak  -86400 )/86400);
                          // die;
                        
                $id_ssgfacebookpostpagejob = $lastdate1;
        $conec = Database::getInstance();
        try
        {
            $conec->beginTransaction();
            $statement = $conec->prepare("INSERT INTO `ssg_facebook_page_video_views`
            (`id_page`,
            `page_fans`,
            `page_video_views`,
            `page_video_views_autoplayed`,
            `page_video_repeat_views`,
            `page_video_views_organic`,
            `page_video_views_unique`,
            `page_video_views_click_to_play`,
            `page_video_views_10s_organic`,
            `page_video_views_10s_click_to_play`,
            `page_video_views_10s_repeat`,
            `page_video_views_10s`,
            `page_video_views_10s_paid`,
            `page_video_views_10s_autoplayed`,
            `page_video_views_10s_unique`,
            `page_video_complete_views_30s_organic`,
            `page_video_complete_views_30s_click_to_play`,
            `page_video_complete_views_30s_repeat_views`,
            `page_video_complete_views_30s`,
            `page_video_complete_views_30s_paid`,
            `page_video_complete_views_30s_autoplayed`,
            `page_video_complete_views_30s_unique`,
            `page_video_views_by_paid_non_paid_paid`,
            `page_video_views_by_paid_non_paid_unpaid`,
            `page_video_views_by_paid_non_paid_total`,
            `page_video_view_time`,
            `end_time`


            )VALUES(
            :id_page,
            :page_fans,
            :page_video_views,
            :page_video_views_autoplayed,
            :page_video_repeat_views,
            :page_video_views_organic,
            :page_video_views_unique,
            :page_video_views_click_to_play,
            :page_video_views_10s_organic,
            :page_video_views_10s_click_to_play,
            :page_video_views_10s_repeat,
            
            :page_video_views_10s,
            
            :page_video_views_10s_paid,
            
            :page_video_views_10s_autoplayed,
            
            :page_video_views_10s_unique,
            
            :page_video_complete_views_30s_organic,
            
            :page_video_complete_views_30s_click_to_play,
            
            :page_video_complete_views_30s_repeat_views,
            
            :page_video_complete_views_30s,
            
            :page_video_complete_views_30s_paid,
            
            :page_video_complete_views_30s_autoplayed,
            :page_video_complete_views_30s_unique,
            :page_video_views_by_paid_non_paid_paid,
            :page_video_views_by_paid_non_paid_unpaid,
            :page_video_views_by_paid_non_paid_total,
            :page_video_view_time,
            :end_time

 
            
)");
            
            $statement->bindParam(':id_page', $id_page, PDO::PARAM_STR);
            $statement->bindParam(':page_fans', $page['page_fans']);
            $statement->bindParam(':page_video_views', $page['page_video_views']);
            $statement->bindParam(':page_video_views_autoplayed', $page['page_video_views_autoplayed']);
            $statement->bindParam(':page_video_repeat_views', $page['page_video_repeat_views']);
            $statement->bindParam(':page_video_views_organic', $page['page_video_views_organic']);
            $statement->bindParam(':page_video_views_unique', $page['page_video_views_unique']);
            $statement->bindParam(':page_video_views_click_to_play', $page['page_video_views_click_to_play']);
            $statement->bindParam(':page_video_views_10s_organic', $page['page_video_views_10s_organic']);
            $statement->bindParam(':page_video_views_10s_click_to_play', $page['page_video_views_10s_click_to_play']);
            $statement->bindParam(':page_video_views_10s_repeat', $page['page_video_views_10s_repeat']);
            $statement->bindParam(':page_video_views_10s', $page['page_video_views_10s']);
            $statement->bindParam(':page_video_views_10s_paid', $page['page_video_views_10s_paid']);
            
            $statement->bindParam(':page_video_views_10s_autoplayed', $page['page_video_views_10s_autoplayed']);
            $statement->bindParam(':page_video_views_10s_unique', $page['page_video_views_10s_unique']);
            
            $statement->bindParam(':page_video_complete_views_30s_organic', $page['page_video_complete_views_30s_organic']);
            
            $statement->bindParam(':page_video_complete_views_30s_click_to_play', $page['page_video_complete_views_30s_click_to_play']);
            $statement->bindParam(':page_video_complete_views_30s_repeat_views', $page['page_video_complete_views_30s_repeat_views']);
            $statement->bindParam(':page_video_complete_views_30s', $page['page_video_complete_views_30s']);
            $statement->bindParam(':page_video_complete_views_30s_paid', $page['page_video_complete_views_30s_paid']);
            $statement->bindParam(':page_video_complete_views_30s_autoplayed', $page["page_video_complete_views_30s_autoplayed"]);
            
            $statement->bindParam(':page_video_complete_views_30s_unique', $page['page_video_complete_views_30s_unique']);
            
            $statement->bindParam(':page_video_views_by_paid_non_paid_paid', $page['page_video_views_by_paid_non_paid']['paid']);
            $statement->bindParam(':page_video_views_by_paid_non_paid_unpaid', $page['page_video_views_by_paid_non_paid']['unpaid']);
            $statement->bindParam(':page_video_views_by_paid_non_paid_total', $page['page_video_views_by_paid_non_paid']['total']);
            $statement->bindParam(':page_video_view_time', $page['page_video_view_time']);
            $statement->bindParam(':end_time', $pageDate["page_fans"]);

          
                          $conec = Database::getInstance();
                          $stm = $conec->prepare("update `ssg_facebook_page_primera_carga` set  video_restart_day= ADDDATE(video_restart_day, INTERVAL  1 DAY)    where id_ssgfacebookpostpagejob=$id_ssgfacebookpostpagejob  ");
                          $stm->execute();
                          $conec = Database::getInstance();
                          $yesterday = date( "Y-m-d", strtotime( "-1 day", strtotime( $now ) ) );
                          $stm = $conec->prepare("update `ssg_facebook_page_primera_carga` set video_status='2' where video_restart_day='$yesterday' ");
                          $stm->execute();

            // $statement->bindParam(':end_time', $page['end_time']);

        //     echo "<pre>";
        // var_dump($page);
        //     echo"</pre>";
             //die;
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
            sendMailer("jose@mimirwell.com","Hubo un error en guardado de page fans",__FUNCTION__." id_page: ".$id_page." ! en ".__FILE__." \n ".$e->getMessage());
              $save = false;
        }
    return $save;
}
         
     }
