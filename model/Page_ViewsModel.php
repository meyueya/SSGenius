<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("Database.php");
class FacebookModel{
     public function __construct(){}
     
     public function getFacebookPostPageJob($id_ssgfacebookpostpagejob)
            {   
                $conec = Database::getInstance();
                         $stm = $conec->prepare("SELECT id_ssgfacebookpostpagejob, id_adaccount,views_restart_day FROM `ssg_facebook_page_primera_carga` WHERE views_status='1' LIMIT 1");
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
     public function savePageViews($id_page,$page,$pageDate)
     {
         
         
            

                         $conec = Database::getInstance();
                         $stm = $conec->prepare("SELECT id_ssgfacebookpostpagejob, id_adaccount,views_restart_day FROM `ssg_facebook_page_primera_carga` WHERE views_status='1' LIMIT 1 ");
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
            $conec ->beginTransaction();
            $statement = $conec ->prepare("INSERT INTO `ssg_facebook_page_views`
            (`id_page`,
            `page_fans`,
            `page_views_total`,
            `page_views_logged_in_total`,
            `page_views_logged_in_unique`,
            `page_views_external_referrals_movilair`,
            `page_views_external_referrals_google`,
            `page_views_by_profile_tab_total_photos`,
            `page_views_by_profile_tab_total_posts`,
            `page_views_by_profile_tab_total_videos`,
            `page_views_by_profile_tab_total_home`,
            `page_views_by_profile_tab_total_notes`,
            `page_views_by_profile_tab_logged_in_unique_photos`,
            `page_views_by_profile_tab_logged_in_unique_videos`,
            `page_views_by_profile_tab_logged_in_unique_home`,
            `page_views_by_profile_tab_logged_in_unique_posts`,
            `page_views_by_internal_referer_logged_in_unique_search`,
            `page_views_by_internal_referer_logged_in_unique_page_internal`,
            `page_views_by_internal_referer_logged_in_unique_newsfeed`,
            `page_views_by_internal_referer_logged_in_unique_other`,
            `page_views_by_site_logged_in_unique_www`,
            `page_views_by_site_logged_in_unique_mobile`,
            `page_views_by_site_logged_in_unique_other`,
            `page_views_logout`,
            `end_time`


            )VALUES(
            :id_page,
            :page_fans,
            :page_views_total,
            :page_views_logged_in_total,
            :page_views_logged_in_unique,
            :page_views_external_referrals_movilair,
            :page_views_external_referrals_google,
            :page_views_by_profile_tab_total_photos,
            :page_views_by_profile_tab_total_posts,
            :page_views_by_profile_tab_total_videos,
            :page_views_by_profile_tab_total_home,
            :page_views_by_profile_tab_total_notes,
            :page_views_by_profile_tab_logged_in_unique_photos,
            :page_views_by_profile_tab_logged_in_unique_videos,
            :page_views_by_profile_tab_logged_in_unique_home,
            :page_views_by_profile_tab_logged_in_unique_post,
            :page_views_by_internal_referer_logged_in_unique_search,
            :page_views_by_internal_referer_logged_in_unique_page_internal,
            :page_views_by_internal_referer_logged_in_unique_newsfeed,
            :page_views_by_internal_referer_logged_in_unique_other,
            :page_views_by_site_logged_in_unique_www,
            :page_views_by_site_logged_in_unique_mobile,
            :page_views_by_site_logged_in_unique_other,
            :page_views_logout,
            :end_time

 
            
)");
            
            $statement->bindParam(':id_page', $id_page, PDO::PARAM_STR);
            $statement->bindParam(':page_fans', $page['page_fans']);
            $statement->bindParam(':page_views_total', $page['page_views_total']);
            $statement->bindParam(':page_views_logged_in_total', $page['page_views_logged_in_total']);
            $statement->bindParam(':page_views_logged_in_unique', $page['page_views_logged_in_unique']);
            $statement->bindParam(':page_views_external_referrals_movilair', $page['page_views_external_referrals']["http://www.movilair.pe/"]);
            $statement->bindParam(':page_views_external_referrals_google', $page['page_views_external_referrals']["https://www.google.com/"]);
            $statement->bindParam(':page_views_by_profile_tab_total_photos', $page['page_views_by_profile_tab_total']["PHOTOS"]);
            $statement->bindParam(':page_views_by_profile_tab_total_posts', $page['page_views_by_profile_tab_total']["POSTS"]);
            $statement->bindParam(':page_views_by_profile_tab_total_videos', $page['page_views_by_profile_tab_total']["VIDEOS"]);
            $statement->bindParam(':page_views_by_profile_tab_total_home', $page['page_views_by_profile_tab_total']["HOME"]);
            $statement->bindParam(':page_views_by_profile_tab_total_notes', $page['page_views_by_profile_tab_total']["NOTES"]);
            $statement->bindParam(':page_views_by_profile_tab_logged_in_unique_photos', $page['page_views_by_profile_tab_logged_in_unique']['PHOTOS']);
            $statement->bindParam(':page_views_by_profile_tab_logged_in_unique_videos', $page['page_views_by_profile_tab_logged_in_unique']["VIDEOS"]);
            $statement->bindParam(':page_views_by_profile_tab_logged_in_unique_home', $page['page_views_by_profile_tab_logged_in_unique']['HOME']);
            $statement->bindParam(':page_views_by_profile_tab_logged_in_unique_post', $page['page_views_by_profile_tab_logged_in_unique']['POSTS']);
            $statement->bindParam(':page_views_by_internal_referer_logged_in_unique_search', $page['page_views_by_internal_referer_logged_in_unique']['SEARCH']);
            $statement->bindParam(':page_views_by_internal_referer_logged_in_unique_page_internal', $page['page_views_by_internal_referer_logged_in_unique']['PAGE_INTERNAL']);
            $statement->bindParam(':page_views_by_internal_referer_logged_in_unique_newsfeed', $page['page_views_by_internal_referer_logged_in_unique']["NEWSFEED"]);
            $statement->bindParam(':page_views_by_internal_referer_logged_in_unique_other', $page['page_views_by_internal_referer_logged_in_unique']['OTHER']);
            $statement->bindParam(':page_views_by_site_logged_in_unique_www', $page["page_views_by_site_logged_in_unique"]["WWW"]);
            $statement->bindParam(':page_views_by_site_logged_in_unique_mobile', $page['page_views_by_site_logged_in_unique']['MOBILE']);
            $statement->bindParam(':page_views_by_site_logged_in_unique_other', $page['page_views_by_site_logged_in_unique']['OTHER']);
            $statement->bindParam(':page_views_logout', $page['page_views_logout']);
            $statement->bindParam(':end_time', $pageDate["page_fans"]);

                          $conec = Database::getInstance();
                          $stm = $conec->prepare("update `ssg_facebook_page_primera_carga` set  views_restart_day= ADDDATE(views_restart_day, INTERVAL  1 DAY)    where id_ssgfacebookpostpagejob=$id_ssgfacebookpostpagejob  ");
                          $stm->execute();
                          $conec = Database::getInstance();
                          $yesterday = date( "Y-m-d", strtotime( "-1 day", strtotime( $now ) ) );
                          $stm = $conec->prepare("update `ssg_facebook_page_primera_carga` set views_status='2' where views_restart_day='$yesterday' ");
                          $stm->execute();

            // $statement->bindParam(':end_time', $page['end_time']);

        //     echo "<pre>";
        // var_dump($page);
        //     echo"</pre>";
             //die;
           $statement->execute();
                 $conec ->commit();
                  $save = true;
    // echo "<pre>";
    // var_dump($statement);
    // echo"</pre>";
    //   die;
        } catch (PDOException $e) {
             $conec ->rollback();
            //error_log("Hubo un error en ".__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage(), 0);
            sendMailer("jose@mimirwell.com","Hubo un error en guardado de page fans",__FUNCTION__." id_page: ".$id_page." ! en ".__FILE__." \n ".$e->getMessage());
              $save = false;
        }
    return $save;
}
         
     }
