<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("Database.php");
class FacebookModel{
     public function __construct(){}
     
  
     public function getFacebookPostPageJob($id_ssgfacebookpostpagejob)
            {   
         
                        $conec = Database::getInstance();
                         $stm = $conec->prepare("SELECT id_ssgfacebookpostpagejob, id_adaccount,engagement_restart_day FROM `ssg_facebook_page_primera_carga` WHERE engagement_status='1' LIMIT 1");
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
                         // echo'Dias: ';
                         //var_dump($missingdaybreakk);
                       
                        $id_ssgfacebookpostpagejob = $lastdate1;
         

                //die;
                
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
            
               public function extraeridbd($id_adaccount) {
        
         
            $con = Database::getInstance();
            $stmt = $con->prepare("SELECT id_ssgfacebookpostpagejob, id_adaccount FROM `ssg_facebook_page_primera_carga` WHERE engagement_status='1' ");
            $stmt->execute();
          $data = $stmt->fetchAll();
                    return $data;
             
     //var_dump($data);
            }
     
            
            
     public function savePageEngagement($id_page,$page)
     {
            

                         $conec = Database::getInstance();
                         $stm = $conec->prepare("SELECT id_ssgfacebookpostpagejob, id_adaccount,engagement_restart_day FROM `ssg_facebook_page_primera_carga` WHERE engagement_status='1' LIMIT 1 ");
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
                        
                $id_ssgfacebookpostpagejob = $lastdate1;
        $conn = Database::getInstance();
        
        try
        {
            
            $conn->beginTransaction();
            $statement = $conn->prepare("INSERT INTO `ssg_facebook_page_engagement`
            (`id_page`,
            `page_fans`,
            `page_engaged_users`,
            `page_consumptions`,
            `page_consumptions_unique`,
            `page_consumptions_by_consumption_type_link_clicks`,
            `page_consumptions_by_consumption_type_other_clicks`,
            `page_consumptions_by_consumption_type_photo_view`,
            `page_consumptions_by_consumption_type_video_play`,
            `page_places_checkin_total`,
            `page_places_checkin_total_unique`,
            `page_places_checkin_mobile`,
            `page_places_checkin_mobile_unique`,
            `page_negative_feedback`,
            `page_places_checkins_by_age_gender`,
            `page_positive_feedback_by_type_link`,
            `page_positive_feedback_by_type_like`,
            `page_positive_feedback_by_type_other`,
            `page_positive_feedback_by_type_unique_link`,
            `page_positive_feedback_by_type_unique_like`,
            `page_positive_feedback_by_type_unique_other`,
            `shares`,
            `likes`,
            `comments`,
            `end_time`

            )VALUES(
            :id_page,
            :page_fans,
            :page_engaged_users,
            :page_consumptions,
            :page_consumptions_unique,
            :page_consumptions_by_consumption_type_link_clicks,
            :page_consumptions_by_consumption_type_other_clicks,
            :page_consumptions_by_consumption_type_photo_view,
            :page_consumptions_by_consumption_type_video_play,
            :page_places_checkin_total,
            :page_places_checkin_total_unique,
            :page_places_checkin_mobile,
            :page_places_checkin_mobile_unique,
            :page_negative_feedback,
            :page_places_checkins_by_age_gender,
            :page_positive_feedback_by_type_link,
            :page_positive_feedback_by_type_like,
            :page_positive_feedback_by_type_other,
            :page_positive_feedback_by_type_unique_link,
            :page_positive_feedback_by_type_unique_like,
            :page_positive_feedback_by_type_unique_other,
            :shares,
            :likes,
            :comments,
            :end_time)");
            
            $statement->bindParam(':id_page', $id_page, PDO::PARAM_STR);
            $statement->bindParam(':page_fans', $page['page_fans']);
            $statement->bindParam(':page_engaged_users', $page['page_engaged_users']);
            $statement->bindParam(':page_consumptions', $page['page_consumptions']);
            $statement->bindParam(':page_consumptions_unique', $page['page_consumptions_unique']);
            $statement->bindParam(':page_consumptions_by_consumption_type_link_clicks', $page['page_consumptions_by_consumption_type']["link clicks"]);
            $statement->bindParam(':page_consumptions_by_consumption_type_other_clicks', $page['page_consumptions_by_consumption_type']["other clicks"]);
            $statement->bindParam(':page_consumptions_by_consumption_type_photo_view', $page['page_consumptions_by_consumption_type']["photo view"]);
            $statement->bindParam(':page_consumptions_by_consumption_type_video_play', $page['page_consumptions_by_consumption_type']["video play"]);
            $statement->bindParam(':page_places_checkin_total', $page['page_places_checkin_total']);
            $statement->bindParam(':page_places_checkin_total_unique', $page['page_places_checkin_total_unique']);
            $statement->bindParam(':page_places_checkin_mobile', $page['page_places_checkin_mobile']);
            $statement->bindParam(':page_places_checkin_mobile_unique', $page['page_places_checkin_mobile_unique']);
            $statement->bindParam(':page_negative_feedback',  $page['page_negative_feedback']);
            $statement->bindParam(':page_places_checkins_by_age_gender',$page["page_places_checkins_by_age_gender"]);    
            $statement->bindParam(':page_positive_feedback_by_type_link', $page['page_positive_feedback_by_type']["link"]);
            $statement->bindParam(':page_positive_feedback_by_type_like', $page['page_positive_feedback_by_type']["like"]);
            $statement->bindParam(':page_positive_feedback_by_type_other', $page['page_positive_feedback_by_type']["other"]);
            $statement->bindParam(':page_positive_feedback_by_type_unique_link', $page['page_positive_feedback_by_type_unique']["link"]);
            $statement->bindParam(':page_positive_feedback_by_type_unique_like', $page['page_positive_feedback_by_type_unique']["like"]);
            $statement->bindParam(':page_positive_feedback_by_type_unique_other', $page['page_positive_feedback_by_type_unique']["other"]);
            $statement->bindParam(':shares', $page['shares']);
            $statement->bindParam(':likes', $page['likes']);
            $statement->bindParam(':comments', $page['comments']);
            $statement->bindParam(':end_time', $page['end_time']);
            
                         $conec = Database::getInstance();
                         $stm = $conec->prepare("update `ssg_facebook_page_primera_carga` set  engagement_restart_day= ADDDATE(engagement_restart_day, INTERVAL  1 DAY)    where id_ssgfacebookpostpagejob=$id_ssgfacebookpostpagejob  ");
                         $stm->execute();
                         $conec = Database::getInstance();
                         $yesterday = date( "Y-m-d", strtotime( "-1 day", strtotime( $now ) ) );
                         $stm = $conec->prepare("update `ssg_facebook_page_primera_carga` set engagement_status='2' where engagement_restart_day='$yesterday'");
                         $stm->execute();
                          // echo'ayer  ';
                         //var_dump($stm);
            

        //     echo "<pre>";
        // var_dump($page);
        //     echo"</pre>";
             //die;
           $statement->execute();
                  $conn->commit();
                  $save = true;
    // echo "<pre>";
    // var_dump($statement);
    // echo"</pre>";
    //   die;
        } catch (PDOException $e) {
             $conn->rollback();
            //error_log("Hubo un error en ".__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage(), 0);
            sendMailer("jose@mimirwell.com","Hubo un error en guardado de page fans",__FUNCTION__." id_page: ".$id_page." ! en ".__FILE__." \n ".$e->getMessage());
              $save = false;
        }
    return $save;
}
           
                       
     
     

}